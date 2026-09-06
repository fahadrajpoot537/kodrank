<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use App\Support\ThemeHtmlImporter;
use Illuminate\Database\Seeder;

/**
 * AEO Services only — imports theme HTML into /aeo-services.
 * Does not touch any other service page.
 *
 * - Keeps all theme body sections (trust, pain, services, process, compare, results, FAQ)
 * - Shared KodRank hero (no theme hero chrome)
 * - Skips hero eyebrow line "AEO Services"
 * - CSS scoped to .aeo-theme-page + page-only extras
 *
 * Run:
 *   php artisan db:seed --class=AeoThemeHtmlSeeder
 */
class AeoThemeHtmlSeeder extends Seeder
{
    public function run(): void
    {
        $htmlPath = public_path('theme/aeo-services-page/aeo-services.html');
        if (! is_file($htmlPath)) {
            $this->command?->error('Missing theme HTML: '.$htmlPath);

            return;
        }

        $mediaFrom = public_path('theme/aeo-services-page');
        $mediaTo = 'media/services/aeo';
        $cssRel = 'css/theme-aeo.css';
        $scope = 'aeo-theme-page';
        $slug = 'aeo-services';
        $name = 'AEO Services';

        try {
            ThemeHtmlImporter::copyDirImages($mediaFrom, $mediaTo);
            $extracted = ThemeHtmlImporter::extract($htmlPath, $mediaTo);
            ThemeHtmlImporter::writeCss($cssRel, $extracted['css'] ?? '', $scope);
        } catch (\Throwable $e) {
            $this->command?->error($slug.': '.$e->getMessage());

            return;
        }

        $html = trim((string) ($extracted['html'] ?? ''));
        if ($html === '') {
            $this->command?->error('Empty HTML after extract: '.$slug);

            return;
        }

        // Theme contact is replaced by shared Laravel form at render time.
        $html = preg_replace(
            '/<section\b[^>]*\bid=["\']contact["\'][^>]*>.*?<\/section>\s*/is',
            '',
            $html
        ) ?? $html;

        $parentId = ServicePage::query()->where('slug', 'digital-marketing-services')->value('id');
        $title = ($extracted['title'] ?? '') !== '' ? $extracted['title'] : ($name.' | KodRank');
        $desc = $extracted['description'] ?? '';
        $hero = is_array($extracted['hero'] ?? null) ? $extracted['hero'] : [];

        if (($hero['title'] ?? '') === '' && ($hero['title_html'] ?? '') === '') {
            $hero['title'] = $name;
        }
        if (($hero['lede'] ?? '') === '' && $desc !== '') {
            $hero['lede'] = $desc;
        }

        // User request: no "AEO Services" eyebrow line in hero.
        unset($hero['eyebrow']);
        $hero['eyebrow'] = '';

        $hero['breadcrumb'] = [
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Services', 'url' => '/services'],
            ['label' => $name, 'url' => ''],
        ];
        $hero['cta_url'] = '#contact';
        if (($hero['cta_text'] ?? '') === '') {
            $hero['cta_text'] = 'Get A Free AI Visibility Audit';
        }

        $rawTheme = (string) file_get_contents($htmlPath);
        if (empty($hero['badges'])) {
            $hero['badges'] = $this->extractHeroBadges($rawTheme);
        }

        $heroImage = (string) ($hero['image'] ?? '');
        if ($heroImage === '' || ! is_file(public_path($heroImage))) {
            $saved = $this->extractHeroImageFromTheme($rawTheme, $mediaTo);
            if ($saved !== '') {
                $hero['image'] = $saved;
            } elseif ($heroImage === '') {
                $hero['image'] = $mediaTo.'/aeo-services-ai-visibility-audit-diagram.webp';
            }
        }

        $storedHtmlPath = ThemeHtmlImporter::storeHtmlFile($slug, $html);

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => $slug],
            [
                'parent_id' => $parentId,
                'name' => $name,
                'is_active' => true,
                'sort_order' => 14,
                'seo' => [
                    'theme' => 'theme-html',
                    'css' => $cssRel,
                    'extra_css' => 'css/theme-aeo-page.css',
                    'hide_from_nav' => false,
                    'seo_title' => $title,
                    'seo_description' => $desc,
                    'og_title' => $title,
                    'og_description' => $desc,
                    'og_image' => $hero['image'] ?? '',
                    'keywords' => 'AEO services, answer engine optimization, AI Overviews, ChatGPT citations, schema markup, KodRank',
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

        $this->command?->info('OK '.$slug.' — hero eyebrow cleared, CSS scoped to .'.$scope);
        $this->command?->info('Hero badges: '.count($hero['badges'] ?? []).' | image: '.($hero['image'] ?? '').' | body: '.$storedHtmlPath);
    }

    /**
     * @return list<array{num:string,label:string}>
     */
    private function extractHeroBadges(string $rawThemeHtml): array
    {
        if (! preg_match('/<(section|header)\b(?=[^>]*\bclass=["\'][^"\']*\bhero\b[^"\']*["\'])[^>]*>.*?<\/\1>/is', $rawThemeHtml, $m)) {
            return [];
        }

        $chunk = $m[0];
        $badges = [];
        if (preg_match_all(
            '/<span\b[^>]*class=["\'][^"\']*\bnum\b[^"\']*["\'][^>]*>(.*?)<\/span>\s*<span\b[^>]*class=["\'][^"\']*\blbl\b[^"\']*["\'][^>]*>(.*?)<\/span>/is',
            $chunk,
            $rows,
            PREG_SET_ORDER
        )) {
            foreach ($rows as $row) {
                $num = trim(strip_tags($row[1]));
                $label = trim(strip_tags($row[2]));
                if ($num !== '' || $label !== '') {
                    $badges[] = ['num' => $num, 'label' => $label];
                }
            }
        }

        return $badges;
    }

    private function extractHeroImageFromTheme(string $rawThemeHtml, string $mediaTo): string
    {
        if (preg_match(
            '/\.hero-visual\s+\.img-layer\s*\{[^}]*background-image\s*:\s*url\(\s*[\'"]?(data:image\/[^\'"\)]+)/is',
            $rawThemeHtml,
            $m
        )) {
            return ThemeHtmlImporter::writeDataUriPublic($m[1], 'aeo-services-ai-visibility-audit-diagram.webp', $mediaTo);
        }

        if (preg_match('/url\(\s*[\'"]?(data:image\/webp;base64,[^\'"\)]+)/i', $rawThemeHtml, $m)) {
            return ThemeHtmlImporter::writeDataUriPublic($m[1], 'aeo-services-ai-visibility-audit-diagram.webp', $mediaTo);
        }

        return '';
    }
}
