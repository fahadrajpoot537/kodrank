<?php

namespace App\Support;

/**
 * Turns the visible text of a theme-html page body into admin fields
 * and writes those edits back without rebuilding the markup.
 */
final class ThemeHtmlContentEditor
{
    /**
     * @return list<array{id: string, label: string, value: string, rows: int}>
     */
    public static function fields(string $html): array
    {
        $fields = [];
        self::walk($html, function (string $id, string $raw, string $plain, string $label) use (&$fields): ?string {
            $fields[] = [
                'id' => $id,
                'label' => $label,
                'value' => $plain,
                'rows' => strlen($plain) > 90 ? 3 : 1,
            ];

            return null;
        });

        return $fields;
    }

    /**
     * @param  array<string, mixed>  $values
     */
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
            $class = $parent['class'] ?? '';
            if (
                ($parent['tag'] ?? '') === 'h1'
                || ($parent['tag'] ?? '') === 'h2'
                || str_contains($class, 'eyebrow')
            ) {
                $section = self::short($plain);
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
        if ($tag === 'section' && $id !== '') {
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
}
