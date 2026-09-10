<?php

namespace Database\Seeders;

use App\Support\ThemeHtmlNichePageImporter;
use Illuminate\Database\Seeder;

/**
 * Real Estate SEO Services — imports theme HTML into /real-estate-seo-services.
 *
 * Run: php artisan db:seed --class=RealEstateSeoThemeHtmlSeeder
 */
class RealEstateSeoThemeHtmlSeeder extends Seeder
{
    public function run(): void
    {
        ThemeHtmlNichePageImporter::import([
            'slug' => 'real-estate-seo-services',
            'name' => 'Real Estate SEO Services',
            'htmlPath' => public_path('theme/newone/kodrank-real-estate-seo/real-estate-seo-services.html'),
            'mediaFrom' => public_path('theme/newone/kodrank-real-estate-seo'),
            'mediaTo' => 'media/services/real-estate-seo',
            'cssRel' => 'css/theme-real-estate-seo.css',
            'extraCssRel' => 'css/theme-real-estate-seo-page.css',
            'scope' => 're-theme-page',
            'bodyClass' => 'page-reseo',
            'sort' => 43,
            'hideFromNav' => true,
            'clearEyebrow' => false,
            'excludeHeroTexts' => [],
            'ctaText' => 'Get My Free SEO Audit',
            'heroImageFilename' => 'real-estate-seo-hero.jpg',
            'keywords' => 'real estate SEO services, realtor SEO, property SEO, KodRank',
        ], fn ($msg) => str_starts_with($msg, 'ERROR:')
            ? $this->command?->error(substr($msg, 7))
            : $this->command?->info($msg));
    }
}
