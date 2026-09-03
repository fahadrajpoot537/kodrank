<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use App\Support\ThemeHtmlImporter;
use Illuminate\Database\Seeder;

/**
 * Technical SEO only — imports theme HTML into /technical-seo-services.
 * Does not touch any other service page.
 *
 * Skips the mid-page CTA band:
 *   "Stop Losing Rankings to Fixable Problems" / Get Your Free Technical SEO Audit
 *
 * CSS is scoped to .techseo-theme-page only (public/css/theme-technical-seo.css)
 * plus page-only extras in public/css/theme-technical-seo-page.css.
 *
 * Run:
 *   php artisan db:seed --class=TechnicalSeoThemeHtmlSeeder
 */
class TechnicalSeoThemeHtmlSeeder extends Seeder
{
    public function run(): void
    {
        $htmlPath = public_path('theme/kodrank-technical-seo-services/technical-seo-services.html');
        if (! is_file($htmlPath)) {
            $this->command?->error('Missing theme HTML: '.$htmlPath);

            return;
        }

        $mediaFrom = public_path('theme/kodrank-technical-seo-services');
        $mediaTo = 'media/services/technical-seo';
        $cssRel = 'css/theme-technical-seo.css';
        $scope = 'techseo-theme-page';
        $slug = 'technical-seo-services';
        $name = 'Technical SEO Services';

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

        // Strip mid-page CTA band (keep contact for shared form replacement at render).
        $html = $this->stripCtaBand($html);

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
        $hero['breadcrumb'] = [
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Services', 'url' => '/services'],
            ['label' => $name, 'url' => ''],
        ];
        if (empty($hero['image'])) {
            $hero['image'] = $mediaTo.'/technical-seo-services-dashboard-hero.jpg';
        }
        $hero['cta_url'] = '#contact';
        if (($hero['cta_text'] ?? '') === '') {
            $hero['cta_text'] = 'Get a Free Technical SEO Audit';
        }

        // Ensure theme hero trust stats land as badges (187% / 3,400+ / 45 days).
        if (empty($hero['badges'])) {
            $hero['badges'] = $this->extractHeroTrustBadges((string) file_get_contents($htmlPath));
        }

        $storedHtmlPath = ThemeHtmlImporter::storeHtmlFile($slug, $html);

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => $slug],
            [
                'parent_id' => $parentId,
                'name' => $name,
                'is_active' => true,
                'sort_order' => 13,
                'seo' => [
                    'theme' => 'theme-html',
                    'css' => $cssRel,
                    'extra_css' => 'css/theme-technical-seo-page.css',
                    'hide_from_nav' => false,
                    'seo_title' => $title,
                    'seo_description' => $desc,
                    'og_title' => $title,
                    'og_description' => $desc,
                    'og_image' => $hero['image'] ?? '',
                    'keywords' => 'technical SEO services, crawlability, Core Web Vitals, indexation, structured data, site migration SEO, KodRank',
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

        $this->command?->info('OK '.$slug.' — CTA band skipped, CSS scoped to .'.$scope);
        $this->command?->info('Hero badges: '.count($hero['badges'] ?? []).' | body file: '.$storedHtmlPath);
    }

    private function stripCtaBand(string $html): string
    {
        $html = preg_replace(
            '/<!--\s*[^>]*CTA BAND[^>]*-->\s*<section\b[^>]*>.*?<\/section>\s*/is',
            '',
            $html
        ) ?? $html;

        $html = preg_replace(
            '/<section\b[^>]*\b(?:cta-bg|cta-band|cta-sec|sec-cta-bg|sec-cta|ctaband|cta-final)\b[^>]*>.*?<\/section>\s*/is',
            '',
            $html
        ) ?? $html;

        // Fallback: exact heading from theme CTA
        $html = preg_replace(
            '/<section\b[^>]*>[\s\S]*?Stop Losing Rankings to Fixable Problems[\s\S]*?<\/section>\s*/i',
            '',
            $html
        ) ?? $html;

        return $html;
    }

    /**
     * @return list<array{num:string,label:string}>
     */
    private function extractHeroTrustBadges(string $rawThemeHtml): array
    {
        if (! preg_match('/<(section|header)\b(?=[^>]*\bclass=["\'][^"\']*\bhero\b[^"\']*["\'])[^>]*>.*?<\/\1>/is', $rawThemeHtml, $m)) {
            return [];
        }

        $chunk = $m[0];
        $badges = [];
        if (preg_match_all(
            '/<(?:div|li)\b[^>]*>\s*<(?:strong|b)>(.*?)<\/(?:strong|b)>\s*<span\b[^>]*>(.*?)<\/span>\s*<\/(?:div|li)>/is',
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
}
