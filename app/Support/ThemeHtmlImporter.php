<?php

namespace App\Support;

/**
 * Imports standalone theme HTML files into CMS-ready HTML + CSS.
 * Site chrome (nav/footer) and KodRank hero stay outside imported markup.
 */
class ThemeHtmlImporter
{
    /**
     * @return array{
     *   title: string,
     *   description: string,
     *   canonical: string,
     *   robots: string,
     *   css: string,
     *   html: string,
     *   hero: array<string, mixed>
     * }
     */
    public static function extract(string $absoluteHtmlPath, string $mediaPublicPrefix = ''): array
    {
        if (! is_file($absoluteHtmlPath)) {
            throw new \InvalidArgumentException("Theme HTML not found: {$absoluteHtmlPath}");
        }

        $raw = file_get_contents($absoluteHtmlPath);
        if ($raw === false) {
            throw new \RuntimeException("Unable to read: {$absoluteHtmlPath}");
        }

        $title = self::meta($raw, 'title') ?: self::tagText($raw, 'title');
        $description = self::meta($raw, 'description');
        $canonical = self::linkHref($raw, 'canonical');
        $robots = self::meta($raw, 'robots') ?: 'index, follow';

        $css = '';
        $search = $raw;
        $offset = 0;
        while (($start = stripos($search, '<style', $offset)) !== false) {
            $openEnd = strpos($search, '>', $start);
            if ($openEnd === false) {
                break;
            }
            $close = stripos($search, '</style>', $openEnd);
            if ($close === false) {
                break;
            }
            $chunk = substr($search, $openEnd + 1, $close - $openEnd - 1);
            $css .= ($css === '' ? '' : "\n\n").trim($chunk);
            $offset = $close + 8;
        }

        // Prefer <main>…</main>; otherwise body without chrome.
        $html = '';
        if (preg_match('/<main\b[^>]*>(.*?)<\/main>/is', $raw, $main)) {
            $html = trim($main[1]);
        } else {
            $bodyOpen = stripos($raw, '<body');
            $bodyClose = strripos($raw, '</body>');
            if ($bodyOpen !== false && $bodyClose !== false) {
                $gt = strpos($raw, '>', $bodyOpen);
                $html = $gt !== false ? trim(substr($raw, $gt + 1, $bodyClose - $gt - 1)) : '';
            } else {
                $html = $raw;
            }
        }

        $html = self::stripThemeChrome($html);

        // Pull KodRank-shared hero fields, then drop theme hero markup.
        [$hero, $html] = self::extractAndStripHero($html, $css, $mediaPublicPrefix);

        $stripBadges = self::extractStatStrip($html);
        if ($stripBadges !== []) {
            $existing = is_array($hero['badges'] ?? null) ? $hero['badges'] : [];
            $hero['badges'] = array_merge($existing, $stripBadges);
        }

        // Drop leftover nav/mobile fragments before the first real section.
        $html = self::trimBeforeFirstSection($html);

        // Drop theme-local scripts (site uses its own JS); keep markup intact.
        $html = preg_replace('/<script\b[^>]*>.*?<\/script>/is', '', $html) ?? $html;

        if ($mediaPublicPrefix !== '') {
            $prefix = '/'.trim(str_replace('\\', '/', $mediaPublicPrefix), '/').'/';
            $html = self::rewriteAssetUrls($html, $prefix);
            $css = self::rewriteCssUrls($css, $prefix);
            // NOTE: do NOT explode data: URIs here — huge base64 makes preg catastrophically slow.
            // Only rewrite bare filenames, never paths that already include a folder.
            if (! empty($hero['image'])) {
                $img = (string) $hero['image'];
                if (
                    ! str_starts_with($img, 'data:')
                    && ! str_starts_with($img, '/')
                    && ! str_starts_with($img, 'http')
                    && ! str_contains($img, '/')
                ) {
                    $hero['image'] = trim(str_replace('\\', '/', $mediaPublicPrefix), '/').'/'.$img;
                }
            }
        }

        // Fix absolute marketing-site crumbs to local roots.
        $html = str_replace('https://kodrank.com/', '/', $html);
        $html = str_replace('href="#"', 'href="/contact"', $html);

        return [
            'title' => html_entity_decode(trim($title), ENT_QUOTES | ENT_HTML5, 'UTF-8'),
            'description' => html_entity_decode(trim($description), ENT_QUOTES | ENT_HTML5, 'UTF-8'),
            'canonical' => trim($canonical),
            'robots' => trim($robots),
            'css' => $css,
            'html' => trim($html),
            'hero' => $hero,
        ];
    }

    /**
     * Strip theme nav / footer / mobile chrome. Never drop content sections.
     */
    public static function stripThemeChrome(string $html): string
    {
        $html = preg_replace('/<header\b[^>]*class=["\'][^"\']*\bnav\b[^"\']*["\'][^>]*>.*?<\/header>/is', '', $html) ?? $html;
        $html = preg_replace('/<footer\b[^>]*>.*?<\/footer>/is', '', $html) ?? $html;
        $html = preg_replace('/<div\b[^>]*class=["\'][^"\']*\bmnav\b[^"\']*["\'][^>]*>.*?<\/div>\s*/is', '', $html) ?? $html;
        // Nested mobile panels — match by comment markers (non-greedy </div> misses inner wrappers)
        $html = preg_replace('/<!--\s*MOBILE MENU\s*-->.*?(?=<!--\s*[A-Z]|<section\b)/is', '', $html) ?? $html;
        $html = preg_replace('/<!--\s*NAV\s*-->\s*/i', '', $html) ?? $html;
        $html = preg_replace('/<div\b[^>]*class=["\'][^"\']*\bmpanel\b[^"\']*["\'][^>]*>.*?<\/div>\s*/is', '', $html) ?? $html;
        $html = preg_replace('/<div\b[^>]*class=["\'][^"\']*\bmobile-menu\b[^"\']*["\'][^>]*>.*?<\/div>\s*/is', '', $html) ?? $html;
        $html = preg_replace('/<div\b[^>]*id=["\']mnav["\'][^>]*>.*?<\/div>\s*/is', '', $html) ?? $html;
        $html = preg_replace('/<div\b[^>]*id=["\']mpanel["\'][^>]*>.*?<\/div>\s*/is', '', $html) ?? $html;
        $html = preg_replace('/<button\b[^>]*class=["\'][^"\']*\bburger\b[^"\']*["\'][^>]*>.*?<\/button>\s*/is', '', $html) ?? $html;
        $html = preg_replace('/<nav\b[^>]*class=["\'][^"\']*\bnav-links\b[^"\']*["\'][^>]*>.*?<\/nav>\s*/is', '', $html) ?? $html;
        $html = preg_replace('/<div\b[^>]*class=["\'][^"\']*\bmobile-drawer\b[^"\']*["\'][^>]*>.*?<\/div>\s*/is', '', $html) ?? $html;

        return $html;
    }

    /**
     * Drop orphaned chrome fragments left before the first content section.
     */
    public static function trimBeforeFirstSection(string $html): string
    {
        $html = preg_replace('/<!--\s*HERO\s*-->\s*/i', '', $html) ?? $html;
        if (preg_match('/<section\b/i', $html, $m, PREG_OFFSET_CAPTURE)) {
            return trim(substr($html, $m[0][1]));
        }

        return trim($html);
    }

    /**
     * Pull hero stat strip (e.g. off-page) into badge data and remove from body HTML.
     *
     * @return list<array{num: string, label: string}>
     */
    private static function extractStatStrip(string &$html): array
    {
        $badges = [];
        if (! preg_match('/<div\b[^>]*class=["\'][^"\']*\bstatstrip\b[^"\']*["\'][^>]*>/is', $html)) {
            return $badges;
        }

        if (preg_match_all('/<div class=["\']st["\'][^>]*>\s*<div class=["\']n["\']>(.*?)<\/div>\s*<div class=["\']l["\']>(.*?)<\/div>\s*<\/div>/is', $html, $rows, PREG_SET_ORDER)) {
            foreach ($rows as $row) {
                $num = trim(strip_tags($row[1]));
                $label = trim(strip_tags($row[2]));
                if ($num !== '' || $label !== '') {
                    $badges[] = ['num' => $num, 'label' => $label];
                }
            }
        }

        $html = preg_replace('/<!--\s*stat strip\s*-->\s*/i', '', $html) ?? $html;
        $html = preg_replace('/<div\b[^>]*class=["\'][^"\']*\bstatstrip\b[^"\']*["\'][^>]*>[\s\S]*?<\/div>\s*<\/div>\s*(?=\s*(?:<!--|<section))/i', '', $html, 1) ?? $html;

        return $badges;
    }

    /**
     * @return array{0: array<string, mixed>, 1: string}
     */
    public static function extractAndStripHero(string $html, string $css = '', string $mediaPublicPrefix = ''): array
    {
        $heroChunk = '';
        $patterns = [
            // <section … class="…hero…" …>…</section>
            '/<(section|header)\b(?=[^>]*\bclass=["\'][^"\']*\bhero\b[^"\']*["\'])[^>]*>.*?<\/\1>/is',
            // <section id="top" …>…</section> when class missed
            '/<section\b(?=[^>]*\bid=["\']top["\'])[^>]*>.*?<\/section>/is',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $html, $m)) {
                $heroChunk = $m[0];
                $html = preg_replace($pattern, '', $html, 1) ?? $html;
                break;
            }
        }

        $hero = self::parseHeroChunk($heroChunk, $css, $mediaPublicPrefix);

        return [$hero, $html];
    }

    /**
     * @return array<string, mixed>
     */
    private static function parseHeroChunk(string $chunk, string $css, string $mediaPublicPrefix): array
    {
        $title = '';
        $titleHtml = '';
        if ($chunk !== '' && preg_match('/<h1\b[^>]*>(.*?)<\/h1>/is', $chunk, $m)) {
            $titleHtml = trim($m[1]);
            $title = trim(preg_replace('/\s+/', ' ', strip_tags(str_replace(['<br>', '<br/>', '<br />'], ' ', $titleHtml))) ?? '');
        }

        $lede = '';
        if ($chunk !== '') {
            // Prefer explicit lede / first substantive paragraph
            if (preg_match('/<p\b[^>]*class=["\'][^"\']*\b(lede|lede|sub|hero-sub|hero-lede)\b[^"\']*["\'][^>]*>(.*?)<\/p>/is', $chunk, $m)) {
                $lede = trim(strip_tags($m[2]));
            } elseif (preg_match('/<p\b[^>]*>(.*?)<\/p>/is', $chunk, $m)) {
                $lede = trim(strip_tags($m[1]));
            }
        }

        $ctaText = 'Get A Free Proposal';
        $ctaUrl = '/contact';
        if ($chunk !== '' && preg_match('/<(a)\b[^>]*class=["\'][^"\']*\bbtn-primary\b[^"\']*["\'][^>]*href=["\']([^"\']+)["\'][^>]*>(.*?)<\/\1>/is', $chunk, $m)) {
            $ctaUrl = trim($m[2]) !== '' ? trim($m[2]) : $ctaUrl;
            $ctaText = trim(preg_replace('/\s+/', ' ', strip_tags($m[3])) ?? '') ?: $ctaText;
        } elseif ($chunk !== '' && preg_match('/<a\b[^>]*href=["\']([^"\']+)["\'][^>]*class=["\'][^"\']*\bbtn-primary\b[^"\']*["\'][^>]*>(.*?)<\/a>/is', $chunk, $m)) {
            $ctaUrl = trim($m[1]) !== '' ? trim($m[1]) : $ctaUrl;
            $ctaText = trim(preg_replace('/\s+/', ' ', strip_tags($m[2])) ?? '') ?: $ctaText;
        }
        if (str_starts_with($ctaUrl, '#')) {
            $ctaUrl = '/contact';
        }

        $eyebrow = '';
        if ($chunk !== '' && preg_match('/<span\b[^>]*class=["\'][^"\']*\beyebrow\b[^"\']*["\'][^>]*>(.*?)<\/span>/is', $chunk, $m)) {
            $eyebrow = trim(html_entity_decode(strip_tags($m[1]), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        }

        $badges = [];
        $trustPoints = [];
        if ($chunk !== '') {
            // Nested .hero-trust children: <div><strong>187%</strong><span>label</span></div>
            if (preg_match_all(
                '/<(?:div|li)\b[^>]*>\s*<(?:strong|b)>(.*?)<\/(?:strong|b)>\s*<span\b[^>]*>(.*?)<\/span>\s*<\/(?:div|li)>/is',
                $chunk,
                $strongRows,
                PREG_SET_ORDER
            )) {
                foreach ($strongRows as $row) {
                    $num = trim(strip_tags($row[1]));
                    $label = trim(strip_tags($row[2]));
                    if ($num !== '' || $label !== '') {
                        $badges[] = ['num' => $num, 'label' => $label];
                    }
                }
            }

            if ($badges === [] && preg_match('/<div\b[^>]*class=["\'][^"\']*\bhero-trust\b[^"\']*["\'][^>]*>(.*?)<\/div>/is', $chunk, $trustWrap)) {
                $inner = $trustWrap[1];
                if (preg_match_all('/<span[^>]*>\s*(?:<svg\b[^>]*>.*?<\/svg>\s*)?(.*?)<\/span>/is', $inner, $spans, PREG_SET_ORDER)) {
                    foreach ($spans as $span) {
                        $text = trim(strip_tags($span[1]));
                        if ($text !== '') {
                            $trustPoints[] = $text;
                        }
                    }
                }
                if ($trustPoints === [] && preg_match_all('/<div>\s*<div class=["\']num["\']>(.*?)<\/div>\s*<div class=["\']lbl["\']>(.*?)<\/div>\s*<\/div>/is', $inner, $trust, PREG_SET_ORDER)) {
                    foreach ($trust as $row) {
                        $num = trim(strip_tags($row[1]));
                        $label = trim(strip_tags($row[2]));
                        if ($num !== '' || $label !== '') {
                            $badges[] = ['num' => $num, 'label' => $label];
                        }
                    }
                }
            }

            if ($badges === []) {
                // <b>num</b><span>label</span> or .n/.l / .num/.lbl pairs
                if (preg_match_all('/<(?:div|li)\b[^>]*>\s*(?:<b>(.*?)<\/b>|<div class=["\'](?:n|num)["\']>(.*?)<\/div>)\s*(?:<span>(.*?)<\/span>|<div class=["\'](?:l|lbl)["\']>(.*?)<\/div>)/is', $chunk, $rows, PREG_SET_ORDER)) {
                    foreach ($rows as $row) {
                        $num = trim(strip_tags($row[1] !== '' ? $row[1] : ($row[2] ?? '')));
                        $label = trim(strip_tags($row[3] !== '' ? $row[3] : ($row[4] ?? '')));
                        if ($num !== '' || $label !== '') {
                            $badges[] = ['num' => $num, 'label' => $label];
                        }
                    }
                }
                if ($badges === [] && preg_match_all('/<div>\s*<div class=["\']num["\']>(.*?)<\/div>\s*<div class=["\']lbl["\']>(.*?)<\/div>\s*<\/div>/is', $chunk, $trust, PREG_SET_ORDER)) {
                    foreach ($trust as $row) {
                        $num = trim(strip_tags($row[1]));
                        $label = trim(strip_tags($row[2]));
                        if ($num !== '' || $label !== '') {
                            $badges[] = ['num' => $num, 'label' => $label];
                        }
                    }
                }
            }
        }

        $image = self::findHeroImage($chunk, $css, $mediaPublicPrefix);

        return array_filter([
            'title' => $title,
            'title_html' => $titleHtml !== '' ? $titleHtml : null,
            'eyebrow' => $eyebrow,
            'lede' => $lede,
            'cta_text' => $ctaText,
            'cta_url' => $ctaUrl,
            'image' => $image,
            'trust_points' => $trustPoints !== [] ? $trustPoints : null,
            'badges' => $badges !== [] ? $badges : null,
        ], static fn ($v) => $v !== null && $v !== '');
    }

    private static function findHeroImage(string $chunk, string $css, string $mediaPublicPrefix): string
    {
        // 0) Theme HTML comment names the hero file; persist inline data URI to that filename
        if ($chunk !== '' && preg_match('/BACKGROUND IMAGE[^|]*\|\s*file:\s*[^\|]*?([^\s\/\|]+\.(?:webp|jpe?g|png|gif|avif))/i', $chunk, $comment)) {
            $filename = basename($comment[1]);
            if (preg_match('/background(?:-image)?\s*:\s*[^;]*url\(\s*[\'"]?(data:image\/[^\'"\)]+)/i', $chunk, $dataMatch)) {
                $saved = self::writeDataUriToMedia($dataMatch[1], $filename, $mediaPublicPrefix);
                if ($saved !== '') {
                    return $saved;
                }
            }
            if ($mediaPublicPrefix !== '') {
                $named = trim(str_replace('\\', '/', $mediaPublicPrefix), '/').'/'.$filename;
                if (is_file(public_path($named))) {
                    return $named;
                }
            }
        }

        // 1) <img src="…file…"> (skip data URIs)
        if ($chunk !== '' && preg_match_all('/<img\b[^>]*\bsrc=["\']([^"\']+)["\']/i', $chunk, $imgs)) {
            foreach ($imgs[1] as $src) {
                $src = trim($src);
                if ($src === '' || str_starts_with($src, 'data:')) {
                    continue;
                }
                if (preg_match('/\.(webp|jpe?g|png|gif|avif)(\?|$)/i', $src)) {
                    return self::normalizeMediaPath($src, $mediaPublicPrefix);
                }
            }
        }

        // 2) inline style background-image
        if ($chunk !== '' && preg_match('/background(?:-image)?\s*:\s*[^;]*url\(\s*[\'"]?(?!data:)([^\'"\)]+)/i', $chunk, $m)) {
            return self::normalizeMediaPath(trim($m[1]), $mediaPublicPrefix);
        }

        // 3) CSS .hero { … url(file.ext) … }
        if ($css !== '' && preg_match('/\.hero\b[^{]*\{[^}]*url\(\s*[\'"]?(?!data:)([^\'"\)]+\.(?:webp|jpe?g|png|gif|avif))/is', $css, $m)) {
            return self::normalizeMediaPath(trim($m[1]), $mediaPublicPrefix);
        }

        // 4) first hero/banner/background image already copied into media folder
        if ($mediaPublicPrefix !== '') {
            $dir = public_path(trim(str_replace('\\', '/', $mediaPublicPrefix), '/'));
            if (is_dir($dir)) {
                $candidates = [];
                foreach (scandir($dir) ?: [] as $file) {
                    if ($file === '.' || $file === '..') {
                        continue;
                    }
                    if (! preg_match('/\.(webp|jpe?g|png|gif|avif)$/i', $file)) {
                        continue;
                    }
                    $rank = 99;
                    if (preg_match('/hero/i', $file)) {
                        $rank = 0;
                    } elseif (preg_match('/banner/i', $file)) {
                        $rank = 1;
                    } elseif (preg_match('/background|bg/i', $file)) {
                        $rank = 2;
                    } elseif (preg_match('/services/i', $file)) {
                        $rank = 3;
                    } else {
                        continue;
                    }
                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $extRank = match ($ext) {
                        'webp' => 0,
                        'jpg', 'jpeg' => 1,
                        default => 2,
                    };
                    $candidates[] = [$rank, $extRank, $file];
                }
                usort($candidates, static fn ($a, $b) => ($a[0] <=> $b[0]) ?: ($a[1] <=> $b[1]));
                if ($candidates !== []) {
                    return trim(str_replace('\\', '/', $mediaPublicPrefix), '/').'/'.$candidates[0][2];
                }
            }
        }

        return 'media/services/on-page-seo/on-page-seo-services-agency-banner.jpg';
    }

    /**
     * Public helper: persist a data URI into public/$mediaPublicPrefix/$filename.
     * Used by banner-only seeders. Overwrites when $force is true.
     */
    public static function writeDataUriPublic(string $dataUri, string $filename, string $mediaPublicPrefix, bool $force = true): string
    {
        if ($mediaPublicPrefix === '' || ! preg_match('#^data:image/(png|jpe?g|webp|gif|avif);base64,(.+)$#is', $dataUri, $m)) {
            return '';
        }

        $bin = base64_decode($m[2], true);
        if ($bin === false || $bin === '') {
            return '';
        }

        $dir = public_path(trim(str_replace('\\', '/', $mediaPublicPrefix), '/'));
        if (! is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        $filename = basename(str_replace('\\', '/', $filename));
        $path = $dir.DIRECTORY_SEPARATOR.$filename;
        if ($force || ! is_file($path)) {
            file_put_contents($path, $bin);
        }

        return trim(str_replace('\\', '/', $mediaPublicPrefix), '/').'/'.$filename;
    }

    private static function writeDataUriToMedia(string $dataUri, string $filename, string $mediaPublicPrefix): string
    {
        return self::writeDataUriPublic($dataUri, $filename, $mediaPublicPrefix, false);
    }

    private static function normalizeMediaPath(string $src, string $mediaPublicPrefix): string
    {
        $src = str_replace('\\', '/', $src);
        if (str_starts_with($src, '/') || str_starts_with($src, 'http')) {
            return ltrim($src, '/');
        }
        $file = basename($src);
        if ($mediaPublicPrefix !== '') {
            return trim(str_replace('\\', '/', $mediaPublicPrefix), '/').'/'.$file;
        }

        return $file;
    }

    /**
     * Dump data:image/... URIs to public media files and rewrite references.
     *
     * @return array{0:string,1:string}
     */
    public static function extractDataUris(string $html, string $css, string $mediaPublicPrefix): array
    {
        $dir = public_path(trim(str_replace('\\', '/', $mediaPublicPrefix), '/'));
        if (! is_dir($dir)) {
            mkdir($dir, 0775, true);
        }
        $webPrefix = '/'.trim(str_replace('\\', '/', $mediaPublicPrefix), '/').'/';
        $n = 0;

        $replace = static function (string $dataUri) use ($dir, $webPrefix, &$n): string {
            if (! preg_match('#^data:image/(png|jpe?g|webp|gif|svg\+xml);base64,(.+)$#is', $dataUri, $m)) {
                return $dataUri;
            }
            $ext = strtolower($m[1]);
            if ($ext === 'jpeg') {
                $ext = 'jpg';
            }
            if ($ext === 'svg+xml') {
                $ext = 'svg';
            }
            $bin = base64_decode($m[2], true);
            if ($bin === false || $bin === '') {
                return $dataUri;
            }
            // Skip tiny spacers
            if (strlen($bin) < 2048) {
                return $dataUri;
            }
            $n++;
            $name = 'embed-'.sprintf('%03d', $n).'-'.substr(md5($bin), 0, 10).'.'.$ext;
            $path = $dir.DIRECTORY_SEPARATOR.$name;
            if (! is_file($path)) {
                file_put_contents($path, $bin);
            }

            return $webPrefix.$name;
        };

        $html = preg_replace_callback(
            '/\b(src|href)=([\'"])(data:image\/[^\'"]+)\2/i',
            static function ($m) use ($replace) {
                return $m[1].'='.$m[2].$replace($m[3]).$m[2];
            },
            $html
        ) ?? $html;

        $html = preg_replace_callback(
            '/url\(\s*([\'"]?)(data:image\/[^\'"\)]+)\1\s*\)/i',
            static function ($m) use ($replace) {
                return 'url('.$m[1].$replace($m[2]).$m[1].')';
            },
            $html
        ) ?? $html;

        $css = preg_replace_callback(
            '/url\(\s*([\'"]?)(data:image\/[^\'"\)]+)\1\s*\)/i',
            static function ($m) use ($replace) {
                return 'url('.$m[1].$replace($m[2]).$m[1].')';
            },
            $css
        ) ?? $css;

        return [$html, $css];
    }

    /**
     * Persist large HTML bodies on disk; return public-relative path.
     */
    public static function storeHtmlFile(string $slug, string $html): string
    {
        $rel = 'theme-html/'.$slug.'.html';
        $path = storage_path('app/'.$rel);
        $dir = dirname($path);
        if (! is_dir($dir)) {
            mkdir($dir, 0775, true);
        }
        file_put_contents($path, $html);

        return $rel;
    }

    public static function writeCss(string $relativePublicCss, string $css, string $scopeClass = ''): void
    {
        $path = public_path($relativePublicCss);
        $dir = dirname($path);
        if (! is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        $body = $css;
        if ($scopeClass !== '') {
            $body = self::scopeCss($body, $scopeClass);
            $body = "/* imported theme CSS — scoped to .{$scopeClass} (site nav/footer/hero stay KodRank) */\n".$body;
        }

        file_put_contents($path, $body);
    }

    /**
     * Prefix selectors so theme rules cannot restyle site nav/footer/hero.
     */
    public static function scopeCss(string $css, string $scopeClass): string
    {
        $scope = '.'.ltrim($scopeClass, '.');

        // Drop comments so they cannot sit between a scope prefix and a real selector
        // (e.g. ".scope /* nav */\n.nav" — valid but fragile; we want ".scope .nav").
        $css = preg_replace('/\/\*.*?\*\//s', '', $css) ?? $css;

        $out = preg_replace_callback(
            '/(^|})\s*([^{}]+?)\{/s',
            static function ($m) use ($scope) {
                $prefix = $m[1];
                $selectors = trim($m[2]);

                if ($selectors === '') {
                    return $m[0];
                }

                // @keyframes / @font-face / @import / @charset — leave alone
                if (preg_match('/^@(keyframes|font-face|import|charset|property|page|counter-style)/i', $selectors)) {
                    return $m[0];
                }

                // @media / @supports / @layer — leave the wrapper; inner rules are matched separately
                if (preg_match('/^@(media|supports|layer|document)/i', $selectors)) {
                    return $m[0];
                }

                // keyframe steps
                if (preg_match('/^(from|to|\d+(\.\d+)?%)$/i', $selectors)) {
                    return $m[0];
                }

                $parts = array_map('trim', explode(',', $selectors));
                $scoped = [];
                foreach ($parts as $p) {
                    if ($p === '') {
                        continue;
                    }
                    if (str_starts_with($p, $scope)) {
                        $scoped[] = $p;
                    } elseif (preg_match('/^(html|body|:root)$/i', $p)) {
                        $scoped[] = $scope;
                    } else {
                        $scoped[] = $scope.' '.$p;
                    }
                }

                if ($scoped === []) {
                    return $m[0];
                }

                return $prefix."\n".implode(', ', $scoped).'{';
            },
            $css
        );

        return $out ?? $css;
    }

    public static function copyDirImages(string $fromDir, string $toPublicRelative): void
    {
        if (! is_dir($fromDir)) {
            return;
        }
        $dest = public_path($toPublicRelative);
        if (! is_dir($dest)) {
            mkdir($dest, 0775, true);
        }
        $exts = ['webp', 'jpg', 'jpeg', 'png', 'gif', 'svg', 'avif'];
        foreach (scandir($fromDir) ?: [] as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            $src = $fromDir.DIRECTORY_SEPARATOR.$file;
            if (! is_file($src)) {
                continue;
            }
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (! in_array($ext, $exts, true)) {
                continue;
            }
            copy($src, $dest.DIRECTORY_SEPARATOR.$file);
        }
    }

    private static function rewriteAssetUrls(string $html, string $prefix): string
    {
        // src="file.ext" or src='./file.ext' (same-folder assets)
        $html = preg_replace_callback(
            '/\b(src|href)=([\'"])(?!https?:|\/|#|mailto:|tel:|data:)(?:\.\/)?([^\'"]+\.(?:webp|jpg|jpeg|png|gif|svg|avif))\2/i',
            static function ($m) use ($prefix) {
                $file = basename(str_replace('\\', '/', $m[3]));

                return $m[1].'='.$m[2].$prefix.$file.$m[2];
            },
            $html
        ) ?? $html;

        return $html;
    }

    private static function rewriteCssUrls(string $css, string $prefix): string
    {
        return preg_replace_callback(
            '/url\(\s*([\'"]?)(?!https?:|\/|data:)(?:\.\/)?([^\'"\)]+\.(?:webp|jpg|jpeg|png|gif|svg|avif))\1\s*\)/i',
            static function ($m) use ($prefix) {
                $file = basename(str_replace('\\', '/', $m[2]));

                return 'url('.$m[1].$prefix.$file.$m[1].')';
            },
            $css
        ) ?? $css;
    }

    private static function meta(string $html, string $name): string
    {
        if (preg_match('/<meta\b[^>]*name=[\'"]'.preg_quote($name, '/').'[\'"][^>]*content=[\'"]([^\'"]*)[\'"]/i', $html, $m)) {
            return $m[1];
        }
        if (preg_match('/<meta\b[^>]*content=[\'"]([^\'"]*)[\'"][^>]*name=[\'"]'.preg_quote($name, '/').'[\'"]/i', $html, $m)) {
            return $m[1];
        }

        return '';
    }

    private static function linkHref(string $html, string $rel): string
    {
        if (preg_match('/<link\b[^>]*rel=[\'"]'.preg_quote($rel, '/').'[\'"][^>]*href=[\'"]([^\'"]*)[\'"]/i', $html, $m)) {
            return $m[1];
        }

        return '';
    }

    private static function tagText(string $html, string $tag): string
    {
        if (preg_match('/<'.preg_quote($tag, '/').'\b[^>]*>(.*?)<\/'.preg_quote($tag, '/').'>/is', $html, $m)) {
            return trim(strip_tags($m[1]));
        }

        return '';
    }
}
