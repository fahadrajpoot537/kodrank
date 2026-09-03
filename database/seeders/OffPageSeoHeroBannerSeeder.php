<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use App\Support\ThemeHtmlImporter;
use Illuminate\Database\Seeder;

/**
 * Banner-only seeder for /off-page-seo-services.
 * Pulls the hero background image from public/theme/off-page-seo-services.html
 * and updates only hero.image + seo.og_image — no other content.
 */
class OffPageSeoHeroBannerSeeder extends Seeder
{
    public function run(): void
    {
        $htmlPath = public_path('theme/off-page-seo-services.html');
        if (! is_file($htmlPath)) {
            $this->command?->warn('Theme HTML missing: '.$htmlPath);

            return;
        }

        $html = (string) file_get_contents($htmlPath);
        $mediaTo = 'media/services/off-page-seo';
        $bannerRel = $mediaTo.'/off-page-seo-services-agency-banner.jpg';

        // Prefer the inline hero .bg data URI from the theme (same visual as the HTML page).
        $saved = '';
        if (preg_match(
            '/<section[^>]*class=["\'][^"\']*\bhero\b[^"\']*["\'][^>]*>.*?<div[^>]*class=["\'][^"\']*\bbg\b[^"\']*["\'][^>]*style=["\'][^"\']*url\(\s*[\'"]?(data:image\/[^\'"\)]+)/is',
            $html,
            $m
        )) {
            $saved = ThemeHtmlImporter::writeDataUriPublic($m[1], 'off-page-seo-services-agency-banner.jpg', $mediaTo);
        }

        if ($saved === '' && preg_match('/url\(\s*[\'"]?(data:image\/jpeg;base64,[^\'"\)]+)/i', $html, $m)) {
            $saved = ThemeHtmlImporter::writeDataUriPublic($m[1], 'off-page-seo-services-agency-banner.jpg', $mediaTo);
        }

        if ($saved === '' && is_file(public_path($bannerRel))) {
            $saved = $bannerRel;
        }

        if ($saved === '') {
            $this->command?->error('Could not extract off-page hero banner from theme HTML.');

            return;
        }

        $page = ServicePage::query()->where('slug', 'off-page-seo-services')->first();
        if (! $page) {
            $this->command?->error('Service page off-page-seo-services not found. Run ThemeHtmlServicesSeeder first.');

            return;
        }

        $hero = ServicePageSection::query()
            ->where('service_page_id', $page->id)
            ->where('key', 'hero')
            ->first();

        if ($hero) {
            $data = is_array($hero->data) ? $hero->data : [];
            $data['image'] = $saved;
            $data['image_alt'] = $data['image_alt']
                ?? 'Off-page SEO link building specialist reviewing backlink reports and referring domains';
            $hero->data = $data;
            $hero->save();
        }

        $seo = is_array($page->seo) ? $page->seo : [];
        $seo['og_image'] = $saved;
        $page->seo = $seo;
        $page->save();

        $this->command?->info('Off-page hero banner set to: '.$saved);
    }
}
