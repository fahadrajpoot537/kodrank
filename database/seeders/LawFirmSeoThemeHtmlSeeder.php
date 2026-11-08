<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Support\ThemeHtmlImporter;
use App\Support\ThemeHtmlNichePageImporter;
use Illuminate\Database\Seeder;

/**
 * Law Firm SEO only. Does not delete or rewrite any other service page.
 *
 *   php artisan db:seed --class=LawFirmSeoThemeHtmlSeeder --force
 */
class LawFirmSeoThemeHtmlSeeder extends Seeder
{
    public function run(): void
    {
        $ok = ThemeHtmlNichePageImporter::import([
            'slug' => 'law-firm-seo-services',
            'name' => 'Law Firm SEO Services',
            'htmlPath' => public_path('law-firm-seo-services.html'),
            'mediaFrom' => public_path('theme/law-firm-seo'),
            'mediaTo' => 'media/services/law-firm-seo',
            'cssRel' => 'css/theme-law-firm-seo.css',
            'extraCssRel' => 'css/theme-law-firm-seo-page.css',
            'scope' => 'law-theme-page',
            'bodyClass' => 'page-lawseo',
            'sort' => 42,
            'hideFromNav' => true,
            'clearEyebrow' => false,
            'excludeHeroTexts' => [],
            'ctaText' => 'Book Your Free SEO Consultation',
            'heroImageFilename' => 'law-firm-hero.jpg',
            'keywords' => 'law firm SEO, attorney SEO, legal SEO, Google Business Profile for lawyers, map pack',
        ], function (string $line): void {
            if (str_starts_with($line, 'ERROR')) {
                $this->command?->error($line);

                return;
            }
            $this->command?->info($line);
        });

        if (! $ok) {
            $this->command?->error('Law firm SEO theme import failed.');

            return;
        }

        $this->publishPhotos();
    }

    /**
     * Pull the banner and process photos out of the stylesheet so admin uploads can replace them.
     */
    private function publishPhotos(): void
    {
        $cssPath = public_path('css/theme-law-firm-seo.css');
        if (! is_file($cssPath)) {
            return;
        }

        $css = (string) file_get_contents($cssPath);
        $heroPath = $this->liftCssPhoto($css, '.law-theme-page .hero-bg{', 'law-firm-hero.jpg');
        $processPath = $this->liftCssPhoto($css, '.law-theme-page .proc-bg{', 'law-firm-process.jpg');
        file_put_contents($cssPath, $css);

        $page = ServicePage::query()->where('slug', 'law-firm-seo-services')->first();
        if ($page === null) {
            return;
        }

        if ($heroPath !== '') {
            $hero = $page->sections()->where('key', 'hero')->first();
            if ($hero !== null) {
                $data = is_array($hero->data) ? $hero->data : [];
                $current = ltrim(str_replace('\\', '/', trim((string) ($data['image'] ?? ''))), '/');
                $ownsHero = str_starts_with($current, 'media/services/law-firm-seo/');
                if ($current === '' || ! is_file(public_path($current)) || ! $ownsHero) {
                    $data['image'] = $heroPath;
                    $hero->data = $data;
                    $hero->save();
                }
            }
        }

        if ($processPath !== '') {
            $body = $page->sections()->where('key', 'body')->first();
            if ($body !== null) {
                $data = is_array($body->data) ? $body->data : [];
                $data['results_background_image'] = $processPath;
                $body->data = $data;
                $body->save();
            }
        }

        ServicePage::forgetCache($page->slug);
        $this->command?->info('Photos ready for admin: hero '.($heroPath !== '' ? $heroPath : 'unchanged').' | process '.($processPath !== '' ? $processPath : 'unchanged'));
    }

    private function liftCssPhoto(string &$css, string $marker, string $filename): string
    {
        $at = strpos($css, $marker);
        if ($at === false) {
            return '';
        }

        $url = strpos($css, 'url(', $at);
        if ($url === false || $url > $at + 500) {
            return '';
        }

        $open = $url + 4;
        $quote = $css[$open] ?? '';
        $quoted = $quote === "'" || $quote === '"';
        $start = $quoted ? $open + 1 : $open;
        $end = $quoted ? strpos($css, $quote, $start) : strpos($css, ')', $start);
        if ($end === false) {
            return '';
        }

        $value = substr($css, $start, $end - $start);
        if (! str_starts_with($value, 'data:image/')) {
            return ltrim($value, '/');
        }

        $path = ThemeHtmlImporter::writeDataUriPublic($value, $filename, 'media/services/law-firm-seo');
        if ($path === '') {
            return '';
        }

        $css = substr($css, 0, $start).'/'.$path.substr($css, $end);

        return $path;
    }
}
