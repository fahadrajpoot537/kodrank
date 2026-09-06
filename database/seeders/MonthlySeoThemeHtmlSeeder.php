<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use App\Support\ThemeHtmlImporter;
use Illuminate\Database\Seeder;

/**
 * Monthly SEO Services only — imports theme HTML into /monthly-seo-services.
 * Does not touch any other service page.
 *
 * - Keeps all theme body sections (intro/pain, included, process, compare, testimonials, FAQ)
 * - Shared KodRank hero (no theme hero chrome)
 * - Skips hero eyebrow line "Monthly SEO Services"
 * - CSS scoped to .monthly-theme-page + page-only extras
 *
 * Run:
 *   php artisan db:seed --class=MonthlySeoThemeHtmlSeeder
 */
class MonthlySeoThemeHtmlSeeder extends Seeder
{
    public function run(): void
    {
        $htmlPath = public_path('theme/New folder/monthly-seo-services.html');
        if (! is_file($htmlPath)) {
            $this->command?->error('Missing theme HTML: '.$htmlPath);

            return;
        }

        $mediaFrom = public_path('theme/New folder');
        $mediaTo = 'media/services/monthly-seo';
        $cssRel = 'css/theme-monthly-seo.css';
        $scope = 'monthly-theme-page';
        $slug = 'monthly-seo-services';
        $name = 'Monthly SEO Services';

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

        // User request: no "Monthly SEO Services" eyebrow line in hero.
        unset($hero['eyebrow']);
        $hero['eyebrow'] = '';

        $hero['breadcrumb'] = [
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Services', 'url' => '/services'],
            ['label' => $name, 'url' => ''],
        ];
        $hero['cta_url'] = '#contact';
        if (($hero['cta_text'] ?? '') === '') {
            $hero['cta_text'] = 'Get My Free SEO Plan';
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
                $hero['image'] = $mediaTo.'/monthly-seo-hero.jpg';
            }
        }

        $storedHtmlPath = ThemeHtmlImporter::storeHtmlFile($slug, $html);

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => $slug],
            [
                'parent_id' => $parentId,
                'name' => $name,
                'is_active' => true,
                'sort_order' => 16,
                'seo' => [
                    'theme' => 'theme-html',
                    'css' => $cssRel,
                    'extra_css' => 'css/theme-monthly-seo-page.css',
                    'hide_from_nav' => true,
                    'seo_title' => $title,
                    'seo_description' => $desc,
                    'og_title' => $title,
                    'og_description' => $desc,
                    'og_image' => $hero['image'] ?? '',
                    'keywords' => 'monthly SEO services, SEO retainer, ongoing SEO, monthly SEO agency, SEO management, KodRank',
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

        // <div class="stat"><b>+187%</b><span>label</span></div>
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

        return $badges;
    }

    private function extractHeroImageFromTheme(string $rawThemeHtml, string $mediaTo): string
    {
        if (preg_match(
            '/\.hero-bg\s*\{[^}]*background-image\s*:\s*url\(\s*[\'"]?(data:image\/[^\'"\)]+)/is',
            $rawThemeHtml,
            $m
        )) {
            return ThemeHtmlImporter::writeDataUriPublic($m[1], 'monthly-seo-hero.jpg', $mediaTo);
        }

        if (preg_match('/url\(\s*[\'"]?(data:image\/(?:jpeg|jpg|webp|png);base64,[^\'"\)]+)/i', $rawThemeHtml, $m)) {
            return ThemeHtmlImporter::writeDataUriPublic($m[1], 'monthly-seo-hero.jpg', $mediaTo);
        }

        return '';
    }
}
