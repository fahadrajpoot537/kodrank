<?php

namespace App\Support;

use App\Models\ServicePage;
use App\Models\ServicePageSection;

/**
 * Shared import pipeline for dedicated niche SEO *ThemeHtmlSeeder classes.
 * Each seeder remains separate; this only centralizes idempotent upsert logic.
 */
class ThemeHtmlNichePageImporter
{
    /**
     * @param  array{
     *   slug: string,
     *   name: string,
     *   htmlPath: string,
     *   mediaFrom: string,
     *   mediaTo: string,
     *   cssRel: string,
     *   extraCssRel: string,
     *   scope: string,
     *   sort: int,
     *   keywords?: string,
     *   hideFromNav?: bool,
     *   clearEyebrow?: bool,
     *   excludeHeroTexts?: list<string>,
     *   ctaText?: string,
     *   heroImageFilename?: string,
     *   parentSlug?: string,
     * }  $cfg
     */
    public static function import(array $cfg, ?callable $log = null): bool
    {
        $info = static function (string $msg) use ($log): void {
            if ($log) {
                $log($msg);
            }
        };
        $error = static function (string $msg) use ($log): void {
            if ($log) {
                $log('ERROR: '.$msg);
            }
        };

        $htmlPath = $cfg['htmlPath'];
        if (! is_file($htmlPath)) {
            $error('Missing theme HTML: '.$htmlPath);

            return false;
        }

        $slug = $cfg['slug'];
        $name = $cfg['name'];
        $mediaFrom = $cfg['mediaFrom'];
        $mediaTo = $cfg['mediaTo'];
        $cssRel = $cfg['cssRel'];
        $extraCssRel = $cfg['extraCssRel'];
        $scope = $cfg['scope'];
        $sort = (int) ($cfg['sort'] ?? 50);
        $hideFromNav = (bool) ($cfg['hideFromNav'] ?? true);
        $clearEyebrow = (bool) ($cfg['clearEyebrow'] ?? false);
        $excludeHeroTexts = array_values(array_filter(array_map('strval', $cfg['excludeHeroTexts'] ?? [])));
        $ctaDefault = (string) ($cfg['ctaText'] ?? 'Get A Free Proposal');
        $heroImageFilename = (string) ($cfg['heroImageFilename'] ?? ($slug.'-hero.jpg'));
        $parentSlug = (string) ($cfg['parentSlug'] ?? 'digital-marketing-services');
        $keywords = (string) ($cfg['keywords'] ?? $name.', KodRank');

        try {
            ThemeHtmlImporter::copyDirImages($mediaFrom, $mediaTo);
            $extracted = ThemeHtmlImporter::extract($htmlPath, $mediaTo);
            ThemeHtmlImporter::writeCss($cssRel, $extracted['css'] ?? '', $scope);
        } catch (\Throwable $e) {
            $error($slug.': '.$e->getMessage());

            return false;
        }

        $html = trim((string) ($extracted['html'] ?? ''));
        if ($html === '') {
            $error('Empty HTML after extract: '.$slug);

            return false;
        }

        // Theme contact / quote / form sections replaced by shared Laravel form at render time.
        $html = preg_replace(
            '/<section\b[^>]*\bid=["\'](?:contact|quote)["\'][^>]*>.*?<\/section>\s*/is',
            '',
            $html
        ) ?? $html;
        // Any leftover section that still embeds a <form>.
        $html = preg_replace(
            '/<section\b[^>]*>[\s\S]*?<form\b[\s\S]*?<\/section>\s*/i',
            '',
            $html
        ) ?? $html;

        $parentId = ServicePage::query()->where('slug', $parentSlug)->value('id');
        $title = ($extracted['title'] ?? '') !== '' ? $extracted['title'] : ($name.' | KodRank');
        $desc = $extracted['description'] ?? '';
        $hero = is_array($extracted['hero'] ?? null) ? $extracted['hero'] : [];

        // Prefer a clean plain title from title_html (span.line heroes lose spaces on strip_tags).
        if (! empty($hero['title_html']) && is_string($hero['title_html'])) {
            $tmp = preg_replace('/<\s*br\s*\/?\s*>/i', ' ', $hero['title_html']) ?? $hero['title_html'];
            $tmp = preg_replace('/<\/(?:span|div|p|strong|em|i|b)\s*>/i', ' ', $tmp) ?? $tmp;
            $plain = trim(html_entity_decode(strip_tags($tmp), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
            $plain = preg_replace('/\s+/u', ' ', $plain) ?? $plain;
            if ($plain !== '') {
                $hero['title'] = $plain;
            }
        }

        if (($hero['title'] ?? '') === '' && ($hero['title_html'] ?? '') === '') {
            $hero['title'] = $name;
        }
        if (($hero['lede'] ?? '') === '' && $desc !== '') {
            $hero['lede'] = $desc;
        }

        if ($clearEyebrow) {
            unset($hero['eyebrow']);
            $hero['eyebrow'] = '';
        }

        // Remove exact excluded hero strings from eyebrow/tag fields only (never carve out of H1).
        foreach (['eyebrow', 'subtitle', 'tag', 'tagline'] as $key) {
            $val = trim((string) ($hero[$key] ?? ''));
            if ($val !== '' && self::matchesExcluded($val, $excludeHeroTexts)) {
                unset($hero[$key]);
                $hero[$key] = '';
            }
        }
        // If title/lede is exactly the excluded label (and nothing else), clear it —
        // never fall back to $name when that name is the excluded string itself.
        foreach (['title', 'lede', 'subtitle'] as $key) {
            $val = trim(html_entity_decode(strip_tags((string) ($hero[$key] ?? '')), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
            if ($val !== '' && self::matchesExcluded($val, $excludeHeroTexts)) {
                $hero[$key] = '';
            }
        }
        if (! empty($hero['title_html'])) {
            $plain = trim(html_entity_decode(strip_tags((string) $hero['title_html']), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
            if ($plain !== '' && self::matchesExcluded($plain, $excludeHeroTexts)) {
                $hero['title_html'] = '';
            }
        }
        // Prefer marketing H1 over empty title after exclusions.
        if (($hero['title'] ?? '') === '' && ($hero['title_html'] ?? '') === '') {
            $hero['title'] = $name;
        }

        $hero['breadcrumb'] = [
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Services', 'url' => '/services'],
            ['label' => $name, 'url' => ''],
        ];
        $hero['cta_url'] = '#contact';
        if (($hero['cta_text'] ?? '') === '') {
            $hero['cta_text'] = $ctaDefault;
        } else {
            $hero['cta_text'] = trim(preg_replace('/\s*(?:→|->|»|›)+\s*$/u', '', (string) $hero['cta_text']));
        }

        $rawTheme = (string) file_get_contents($htmlPath);
        if (empty($hero['badges'])) {
            $hero['badges'] = self::extractHeroBadges($rawTheme);
        }

        $heroImage = (string) ($hero['image'] ?? '');
        if ($heroImage === '' || ! is_file(public_path($heroImage))) {
            $saved = self::extractHeroImageFromTheme($rawTheme, $mediaTo, $heroImageFilename);
            if ($saved !== '') {
                $hero['image'] = $saved;
            } elseif ($heroImage === '') {
                $hero['image'] = $mediaTo.'/'.$heroImageFilename;
            }
        }

        self::ensurePageCssStub($extraCssRel, $scope, $cfg['bodyClass'] ?? '', $name);

        $storedHtmlPath = ThemeHtmlImporter::storeHtmlFile($slug, $html);

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => $slug],
            [
                'parent_id' => $parentId,
                'name' => $name,
                'is_active' => true,
                'sort_order' => $sort,
                'seo' => [
                    'theme' => 'theme-html',
                    'css' => $cssRel,
                    'extra_css' => $extraCssRel,
                    'hide_from_nav' => $hideFromNav,
                    'seo_title' => $title,
                    'seo_description' => $desc,
                    'og_title' => $title,
                    'og_description' => $desc,
                    'og_image' => $hero['image'] ?? '',
                    'keywords' => $keywords,
                    'robots' => ($extracted['robots'] ?? '') !== '' ? $extracted['robots'] : 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();

        ServicePageSection::query()->create([
            'service_page_id' => $page->id,
            'key' => 'hero',
            'label' => 'Hero (KodRank)',
            'sort_order' => 0,
            'data' => $hero,
        ]);

        ServicePageSection::query()->create([
            'service_page_id' => $page->id,
            'key' => 'body',
            'label' => 'Theme body (below hero)',
            'sort_order' => 1,
            'data' => [
                'html' => '',
                'html_path' => $storedHtmlPath,
                'scope' => $scope,
            ],
        ]);

        ServicePage::forgetCache($page->slug);
        ServicePage::forgetNavCache();

        $info('OK '.$slug.' — scoped .'.$scope.' | badges: '.count($hero['badges'] ?? []).' | body: '.$storedHtmlPath);

        return true;
    }

    /**
     * @param  list<string>  $excluded
     */
    private static function matchesExcluded(string $value, array $excluded): bool
    {
        $norm = self::normalizeText($value);
        foreach ($excluded as $ex) {
            if ($norm === self::normalizeText($ex)) {
                return true;
            }
        }

        return false;
    }

    private static function normalizeText(string $value): string
    {
        $value = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $value = str_replace(["\xC2\xB7", '·', '•', '–', '—', '−'], ['-', '-', '-', '-', '-', '-'], $value);
        $value = preg_replace('/\s+/u', ' ', $value) ?? $value;

        return mb_strtolower(trim($value));
    }

    /**
     * @return list<array{num:string,label:string}>
     */
    private static function extractHeroBadges(string $rawThemeHtml): array
    {
        if (! preg_match('/<(section|header)\b(?=[^>]*\bclass=["\'][^"\']*\bhero\b[^"\']*["\'])[^>]*>.*?<\/\1>/is', $rawThemeHtml, $m)) {
            return [];
        }

        $chunk = $m[0];
        $badges = [];

        if (preg_match_all(
            '/<(?:div|li)\b[^>]*class=["\'][^"\']*\bstat\b[^"\']*["\'][^>]*>\s*<b\b[^>]*>(.*?)<\/b>\s*<span\b[^>]*>(.*?)<\/span>/is',
            $chunk,
            $rows,
            PREG_SET_ORDER
        )) {
            foreach ($rows as $row) {
                $num = trim(html_entity_decode(strip_tags($row[1]), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                $label = trim(html_entity_decode(strip_tags($row[2]), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                if ($num !== '' || $label !== '') {
                    $badges[] = ['num' => $num, 'label' => $label];
                }
            }
        }

        // Alternate: .hero-stats .hn / .hl
        if ($badges === [] && preg_match_all(
            '/class=["\'][^"\']*\bhn\b[^"\']*["\'][^>]*>(.*?)<\/[^>]+>\s*<[^>]+class=["\'][^"\']*\bhl\b[^"\']*["\'][^>]*>(.*?)<\//is',
            $chunk,
            $rows,
            PREG_SET_ORDER
        )) {
            foreach ($rows as $row) {
                $num = trim(html_entity_decode(strip_tags($row[1]), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                $label = trim(html_entity_decode(strip_tags($row[2]), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                if ($num !== '' || $label !== '') {
                    $badges[] = ['num' => $num, 'label' => $label];
                }
            }
        }

        return $badges;
    }

    private static function extractHeroImageFromTheme(string $rawThemeHtml, string $mediaTo, string $filename): string
    {
        if (preg_match(
            '/\.hero-bg\s*\{[^}]*background-image\s*:\s*url\(\s*[\'"]?(data:image\/[^\'"\)]+)/is',
            $rawThemeHtml,
            $m
        )) {
            return ThemeHtmlImporter::writeDataUriPublic($m[1], $filename, $mediaTo);
        }

        if (preg_match(
            '/class=["\'][^"\']*\bhero-bg\b[^"\']*["\'][^>]*>\s*<img\b[^>]+src=["\'](data:image\/[^"\']+)["\']/is',
            $rawThemeHtml,
            $m
        )) {
            return ThemeHtmlImporter::writeDataUriPublic($m[1], $filename, $mediaTo);
        }

        if (preg_match('/url\(\s*[\'"]?(data:image\/(?:jpeg|jpg|webp|png);base64,[^\'"\)]+)/i', $rawThemeHtml, $m)) {
            return ThemeHtmlImporter::writeDataUriPublic($m[1], $filename, $mediaTo);
        }

        return '';
    }

    private static function ensurePageCssStub(string $extraCssRel, string $scope, string $bodyClass, string $name): void
    {
        $path = public_path($extraCssRel);
        if (is_file($path)) {
            return;
        }

        $dir = dirname($path);
        if (! is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        $bodySel = $bodyClass !== '' ? 'body.'.$bodyClass : 'body.page-theme-html';
        $css = <<<CSS
/**
 * {$name} page-only extras.
 * Loaded only via seo.extra_css — scoped so other pages are unaffected.
 */
{$bodySel} .{$scope}.theme-html-root {
  /* namespace hook */
}

{$bodySel} .{$scope} .sec-paper,
{$bodySel} .{$scope} .sec-mist,
{$bodySel} .{$scope} .sec-ink {
  position: relative;
}

{$bodySel} .hero-eyebrow {
  display: none !important;
}

{$bodySel} .hero-badges.hero-trust,
{$bodySel} .hero-trust.hero-badges {
  margin-top: 1.25rem;
}

CSS;
        file_put_contents($path, $css);
    }
}
