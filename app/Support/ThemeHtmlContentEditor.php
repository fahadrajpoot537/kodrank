<?php

namespace App\Support;

/**
 * Turns the visible text of a theme-html page body into admin fields
 * and writes those edits back without rebuilding the markup.
 */
final class ThemeHtmlContentEditor
{
    /** @var array<int, string>|null */
    private static ?array $groupTitles = null;

    private static int $groupIndex = 0;
    /**
     * @return list<array{id: string, label: string, value: string, rows: int}>
     */
    public static function fields(string $html): array
    {
        $fields = [];
        self::$groupTitles = [0 => 'Page'];
        self::$groupIndex = 0;
        self::walk($html, function (string $id, string $raw, string $plain, string $label) use (&$fields): ?string {
            $fields[] = [
                'id' => $id,
                'label' => $label,
                'value' => $plain,
                'rows' => strlen($plain) > 90 ? 3 : 1,
                'group_index' => self::$groupIndex,
            ];

            return null;
        });
        $titles = self::$groupTitles ?? [];
        self::$groupTitles = null;

        foreach ($fields as &$field) {
            $index = (int) $field['group_index'];
            $title = trim((string) ($titles[$index] ?? ''));
            $field['group'] = $title !== '' ? $title : 'Section '.$index;
            unset($field['group_index']);
        }
        unset($field);

        return $fields;
    }

    /**
     * @param  array<string, mixed>  $values
     */
    /**
     * Pictures stored in the page HTML (img src or an inline background), in document order.
     * Embedded data URIs are not copied into the result.
     *
     * @return list<array{id: string, group: string, label: string, alt: string, kind: string, embedded: bool, src: string}>
     */
    public static function media(string $html): array
    {
        $items = [];
        self::$groupTitles = [0 => 'Page'];
        self::$groupIndex = 0;
        $stack = [];
        $section = 'Page';
        $skip = 0;
        $n = 0;
        $len = strlen($html);
        $i = 0;

        while ($i < $len) {
            if ($html[$i] !== '<') {
                $next = strpos($html, '<', $i);
                if ($next === false) {
                    break;
                }
                if ($skip === 0) {
                    self::captureHeadingTitle($stack, substr($html, $i, $next - $i));
                }
                $i = $next;
                continue;
            }

            if (substr($html, $i, 4) === '<!--') {
                $end = strpos($html, '-->', $i + 4);
                $i = $end === false ? $len : $end + 3;
                continue;
            }

            $tagEnd = self::findTagEnd($html, $i);
            if ($tagEnd === null) {
                break;
            }
            $rawTag = substr($html, $i, $tagEnd - $i);
            $i = $tagEnd;
            self::updateStack($rawTag, $stack, $skip, $section);
            if ($skip > 0) {
                continue;
            }
            $item = self::mediaFromTag($rawTag, $n);
            if ($item === null) {
                continue;
            }
            $item['group_index'] = self::$groupIndex;
            $items[] = $item;
            $n++;
        }

        $titles = self::$groupTitles ?? [];
        self::$groupTitles = null;
        foreach ($items as &$item) {
            $index = (int) $item['group_index'];
            $title = trim((string) ($titles[$index] ?? ''));
            $item['group'] = $title !== '' ? $title : 'Section '.$index;
            unset($item['group_index']);
        }
        unset($item);

        return $items;
    }

    /**
     * Replace specific pictures by their media() id. A missing url keeps the current file.
     *
     * @param  array<string, array{url?: string, alt?: string}>  $changes
     */
    public static function replaceMedia(string $html, array $changes): string
    {
        if ($changes === [] || $html === '') {
            return $html;
        }

        $len = strlen($html);
        $i = 0;
        $n = 0;
        $out = '';
        $skip = 0;

        while ($i < $len) {
            if ($html[$i] !== '<') {
                $next = strpos($html, '<', $i);
                if ($next === false) {
                    $out .= substr($html, $i);
                    break;
                }
                $out .= substr($html, $i, $next - $i);
                $i = $next;
                continue;
            }

            if (substr($html, $i, 4) === '<!--') {
                $end = strpos($html, '-->', $i + 4);
                if ($end === false) {
                    $out .= substr($html, $i);
                    break;
                }
                $end += 3;
                $out .= substr($html, $i, $end - $i);
                $i = $end;
                continue;
            }

            $tagEnd = self::findTagEnd($html, $i);
            if ($tagEnd === null) {
                $out .= substr($html, $i);
                break;
            }
            $rawTag = substr($html, $i, $tagEnd - $i);
            $i = $tagEnd;
            if ($skip > 0) {
                if (preg_match('/^<\s*\/\s*(script|style|svg|noscript)\b/i', $rawTag)) {
                    $skip--;
                }
                $out .= $rawTag;
                continue;
            }
            if (preg_match('/^<\s*(script|style|svg|noscript)\b/i', $rawTag)) {
                $skip++;
                $out .= $rawTag;
                continue;
            }
            $item = self::mediaFromTag($rawTag, $n);
            if ($item === null) {
                $out .= $rawTag;
                continue;
            }
            $change = $changes[$item['id']] ?? null;
            $n++;
            if (! is_array($change)) {
                $out .= $rawTag;
                continue;
            }
            $url = trim((string) ($change['url'] ?? ''));
            if ($url !== '') {
                $rawTag = self::rewritePictureUrl($rawTag, $url);
            }
            if (array_key_exists('alt', $change) && stripos($rawTag, '<img') !== false) {
                $rawTag = self::rewriteAlt($rawTag, (string) $change['alt']);
            }
            $out .= $rawTag;
        }

        return $out;
    }

    public static function apply(string $html, array $values): string
    {
        return self::walk($html, function (string $id, string $raw, string $plain, string $label) use ($values): ?string {
            if (! array_key_exists($id, $values)) {
                return null;
            }

            $next = trim(preg_replace('/\s+/', ' ', (string) $values[$id]) ?? '');
            if ($next === $plain) {
                return null;
            }

            return self::preserveEdges($raw, self::encodeText($next));
        });
    }

    /**
     * @param  callable(string, string, string, string): ?string  $onText
     */
    private static function walk(string $html, callable $onText): string
    {
        $len = strlen($html);
        $i = 0;
        $out = '';
        $stack = [];
        $section = 'Page';
        $n = 0;
        $skip = 0;

        while ($i < $len) {
            if ($html[$i] === '<') {
                if (substr($html, $i, 4) === '<!--') {
                    $end = strpos($html, '-->', $i + 4);
                    if ($end === false) {
                        $out .= substr($html, $i);
                        break;
                    }
                    $end += 3;
                    $out .= substr($html, $i, $end - $i);
                    $i = $end;
                    continue;
                }

                $tagEnd = self::findTagEnd($html, $i);
                if ($tagEnd === null) {
                    $out .= substr($html, $i);
                    break;
                }
                $rawTag = substr($html, $i, $tagEnd - $i);
                $out .= $rawTag;
                $i = $tagEnd;
                self::updateStack($rawTag, $stack, $skip, $section);
                continue;
            }

            $next = strpos($html, '<', $i);
            if ($next === false) {
                $next = $len;
            }
            $raw = substr($html, $i, $next - $i);
            $i = $next;

            if ($skip > 0) {
                $out .= $raw;
                continue;
            }

            $plain = trim(preg_replace('/\s+/', ' ', self::decodeText($raw)) ?? '');
            if ($plain === '' || strlen($plain) < 2) {
                $out .= $raw;
                continue;
            }

            $parent = $stack !== [] ? $stack[count($stack) - 1] : ['tag' => 'div', 'class' => ''];
            $id = 'b'.$n;
            $n++;
            $label = self::fieldLabel($section, $parent);
            $replacement = $onText($id, $raw, $plain, $label);
            if (
                self::$groupTitles !== null
                && in_array(($parent['tag'] ?? ''), ['h2', 'h3'], true)
                && trim((string) (self::$groupTitles[self::$groupIndex] ?? '')) === ''
            ) {
                self::$groupTitles[self::$groupIndex] = self::short($plain);
            }
            $out .= is_string($replacement) ? $replacement : $raw;
        }

        return $out;
    }

    /**
     * @param  list<array{tag: string, class: string}>  $stack
     */
    private static function updateStack(string $rawTag, array &$stack, int &$skip, string &$section): void
    {
        if (! preg_match('/^<\s*(\/)?\s*([a-zA-Z0-9]+)/', $rawTag, $m)) {
            return;
        }

        $closing = $m[1] === '/';
        $tag = strtolower($m[2]);
        $selfClosing = str_ends_with(rtrim($rawTag), '/>')
            || in_array($tag, ['br', 'hr', 'img', 'meta', 'link', 'input', 'source', 'wbr'], true);

        if ($closing) {
            if (in_array($tag, ['script', 'style', 'svg', 'noscript'], true) && $skip > 0) {
                $skip--;
            }
            for ($i = count($stack) - 1; $i >= 0; $i--) {
                if ($stack[$i]['tag'] === $tag) {
                    array_splice($stack, $i);
                    break;
                }
            }

            return;
        }

        $id = '';
        $class = '';
        if (preg_match('/\sid\s*=\s*(["\'])(.*?)\1/i', $rawTag, $im)) {
            $id = $im[2];
        }
        if (preg_match('/\sclass\s*=\s*(["\'])(.*?)\1/i', $rawTag, $cm)) {
            $class = $cm[2];
        }
        if ($tag === 'section' && self::$groupTitles !== null) {
            self::$groupIndex++;
            self::$groupTitles[self::$groupIndex] = self::sectionTitle($id, $class);
            if (self::$groupTitles[self::$groupIndex] !== '') {
                $section = self::$groupTitles[self::$groupIndex];
            }
        } elseif ($tag === 'section' && $id !== '') {
            $section = self::short(ucwords(str_replace(['-', '_'], ' ', $id)));
        }
        if (in_array($tag, ['script', 'style', 'svg', 'noscript'], true)) {
            $skip++;
        }
        if (! $selfClosing) {
            $stack[] = ['tag' => $tag, 'class' => $class];
        }
    }

    private static function findTagEnd(string $html, int $start): ?int
    {
        $len = strlen($html);
        $quote = '';
        for ($i = $start + 1; $i < $len; $i++) {
            $c = $html[$i];
            if ($quote !== '') {
                if ($c === $quote) {
                    $quote = '';
                }
                continue;
            }
            if ($c === '"' || $c === "'") {
                $quote = $c;
                continue;
            }
            if ($c === '>') {
                return $i + 1;
            }
        }

        return null;
    }

    /**
     * @param  array{tag: string, class: string}  $parent
     */
    private static function fieldLabel(string $section, array $parent): string
    {
        $tag = $parent['tag'] ?? 'div';
        $class = $parent['class'] ?? '';
        $kind = match (true) {
            str_contains($class, 'eyebrow') => 'Eyebrow',
            str_contains($class, 'num') || str_contains($class, 't-num') => 'Number',
            $tag === 'h1', $tag === 'h2' => 'Heading',
            $tag === 'h3', $tag === 'h4', $tag === 'h5' => 'Card heading',
            $tag === 'p' => 'Paragraph',
            $tag === 'li' => 'List item',
            $tag === 'a', $tag === 'button' => 'Button',
            $tag === 'blockquote' => 'Quote',
            default => 'Text',
        };

        return $section.' · '.$kind;
    }

    private static function sectionTitle(string $id, string $class): string
    {
        if ($id !== '') {
            return self::short(ucwords(str_replace(['-', '_'], ' ', $id)));
        }

        $skip = [
            'section', 'sec-ink', 'sec-paper', 'sec-mist', 'sec-compare', 'sec',
            'rv', 'in', 'on', 'bgwrap', 'ctaband', 'wrap', 'paper',
        ];
        foreach (preg_split('/\s+/', trim($class)) ?: [] as $token) {
            if ($token === '' || in_array($token, $skip, true)) {
                continue;
            }

            return self::short(ucwords(str_replace(['-', '_'], ' ', $token)));
        }

        return '';
    }

    private static function short(string $text): string
    {
        $text = trim($text);
        if (strlen($text) <= 52) {
            return $text;
        }

        return rtrim(substr($text, 0, 49)).'…';
    }

    private static function preserveEdges(string $raw, string $encodedNew): string
    {
        if (! preg_match('/^(\s*)(.*?)(\s*)$/s', $raw, $m)) {
            return $encodedNew;
        }

        return $m[1].$encodedNew.$m[3];
    }

    private static function encodeText(string $text): string
    {
        return str_replace(
            ['&', '<', '>', '"'],
            ['&amp;', '&lt;', '&gt;', '&quot;'],
            $text
        );
    }

    private static function decodeText(string $raw): string
    {
        return html_entity_decode($raw, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * @param  list<array{tag: string, class: string}>  $stack
     */
    private static function captureHeadingTitle(array $stack, string $raw): void
    {
        if (self::$groupTitles === null || $stack === []) {
            return;
        }
        $parent = $stack[count($stack) - 1];
        if (! in_array($parent['tag'] ?? '', ['h2', 'h3'], true)) {
            return;
        }
        if (trim((string) (self::$groupTitles[self::$groupIndex] ?? '')) !== '') {
            return;
        }
        $plain = trim(preg_replace('/\s+/', ' ', self::decodeText($raw)) ?? '');
        if ($plain === '') {
            return;
        }
        self::$groupTitles[self::$groupIndex] = self::short($plain);
    }

    /**
     * @return array{id: string, label: string, alt: string, kind: string, embedded: bool, src: string}|null
     */
    private static function mediaFromTag(string $rawTag, int $index): ?array
    {
        if (! preg_match('/^<\s*([a-zA-Z0-9]+)/', $rawTag, $m)) {
            return null;
        }
        $tag = strtolower($m[1]);
        $alt = '';
        if (preg_match('/\salt\s*=\s*(["\'])(.*?)\1/i', $rawTag, $am)) {
            $alt = html_entity_decode($am[2], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        $src = '';
        $kind = '';
        $embedded = false;
        if ($tag === 'img') {
            $found = self::quotedValueHead($rawTag, 'src');
            if ($found !== null) {
                $src = $found['value'];
                $embedded = $found['embedded'];
                $kind = 'Image';
            }
        } elseif (stripos($rawTag, 'background-image') !== false || stripos($rawTag, 'background:') !== false) {
            $urlPos = stripos($rawTag, 'url(');
            if ($urlPos !== false) {
                $found = self::quotedValueHead($rawTag, '', $urlPos + 4);
                if ($found !== null) {
                    $src = $found['value'];
                    $embedded = $found['embedded'];
                    $kind = 'Background';
                }
            }
        }

        if ($kind === '' || ($src === '' && ! $embedded) || str_starts_with($src, 'data:image/svg')) {
            return null;
        }

        $label = $alt !== '' ? self::short($alt) : $kind.' '.($index + 1);

        return [
            'id' => 'm'.$index,
            'label' => $label,
            'alt' => $alt,
            'kind' => $kind === 'Background' ? 'background' : 'image',
            'embedded' => $embedded,
            'src' => $embedded ? '' : $src,
        ];
    }

    /**
     * Read a quoted attribute, or a quoted value at $at, without a regex over a huge data URI.
     *
     * @return array{value: string, embedded: bool}|null
     */
    private static function quotedValueHead(string $tag, string $attr, ?int $at = null): ?array
    {
        if ($at === null) {
            $pos = stripos($tag, $attr.'=');
            if ($pos === false) {
                return null;
            }
            $at = $pos + strlen($attr) + 1;
            while (isset($tag[$at]) && ctype_space($tag[$at])) {
                $at++;
            }
        }

        $quote = $tag[$at] ?? '';
        if ($quote !== '"' && $quote !== "'") {
            return null;
        }
        $start = $at + 1;
        $end = strpos($tag, $quote, $start);
        if ($end === false) {
            return null;
        }
        $head = substr($tag, $start, 20);
        if (str_starts_with($head, 'data:image/svg')) {
            return ['value' => 'data:image/svg', 'embedded' => true];
        }
        if (str_starts_with($head, 'data:')) {
            return ['value' => '', 'embedded' => true];
        }

        return [
            'value' => substr($tag, $start, $end - $start),
            'embedded' => false,
        ];
    }

    private static function rewritePictureUrl(string $tag, string $url): string
    {
        $safe = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
        $src = stripos($tag, 'src=');
        if ($src !== false && preg_match('/^<\s*img\b/i', $tag)) {
            return self::rewriteQuotedValue($tag, $src + 4, $safe);
        }
        $urlPos = stripos($tag, 'url(');
        if ($urlPos === false) {
            return $tag;
        }

        return self::rewriteQuotedValue($tag, $urlPos + 4, $safe);
    }

    private static function rewriteQuotedValue(string $tag, int $quoteAt, string $value): string
    {
        $quote = $tag[$quoteAt] ?? '';
        if ($quote !== '"' && $quote !== "'") {
            return $tag;
        }
        $start = $quoteAt + 1;
        $end = strpos($tag, $quote, $start);
        if ($end === false) {
            return $tag;
        }

        return substr($tag, 0, $start).$value.substr($tag, $end);
    }

    private static function rewriteAlt(string $tag, string $alt): string
    {
        $safe = htmlspecialchars($alt, ENT_QUOTES, 'UTF-8');
        if (preg_match('/\salt\s*=\s*(["\'])/i', $tag, $m, PREG_OFFSET_CAPTURE)) {
            return self::rewriteQuotedValue($tag, (int) $m[1][1], $safe);
        }
        $end = strrpos($tag, '>');
        if ($end === false) {
            return $tag;
        }

        return substr($tag, 0, $end).' alt="'.$safe.'"'.substr($tag, $end);
    }
}
