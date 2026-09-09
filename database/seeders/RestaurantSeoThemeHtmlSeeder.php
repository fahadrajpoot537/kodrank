<?php

namespace Database\Seeders;

use App\Support\ThemeHtmlNichePageImporter;
use Illuminate\Database\Seeder;

/**
 * Restaurant SEO Services — imports theme HTML into /restaurant-seo-services.
 * Skips hero text: "KodRank · Restaurant SEO"
 *
 * Run: php artisan db:seed --class=RestaurantSeoThemeHtmlSeeder
 */
class RestaurantSeoThemeHtmlSeeder extends Seeder
{
    public function run(): void
    {
        ThemeHtmlNichePageImporter::import([
            'slug' => 'restaurant-seo-services',
            'name' => 'Restaurant SEO Services',
            'htmlPath' => public_path('theme/newone/kodrank-restaurant-seo-images/restaurant-seo.html'),
            'mediaFrom' => public_path('theme/newone/kodrank-restaurant-seo-images'),
            'mediaTo' => 'media/services/restaurant-seo',
            'cssRel' => 'css/theme-restaurant-seo.css',
            'extraCssRel' => 'css/theme-restaurant-seo-page.css',
            'scope' => 'rest-theme-page',
            'bodyClass' => 'page-restseo',
            'sort' => 41,
            'hideFromNav' => true,
            'clearEyebrow' => true,
            'excludeHeroTexts' => [
                'KodRank · Restaurant SEO',
                'KodRank · Restaurant SEO',
                'KodRank - Restaurant SEO',
            ],
            'ctaText' => 'Get My Free Restaurant SEO Audit',
            'heroImageFilename' => 'restaurant-seo-hero.jpg',
            'keywords' => 'restaurant SEO services, local restaurant SEO, Google Business Profile, KodRank',
        ], fn ($msg) => str_starts_with($msg, 'ERROR:')
            ? $this->command?->error(substr($msg, 7))
            : $this->command?->info($msg));
    }
}
