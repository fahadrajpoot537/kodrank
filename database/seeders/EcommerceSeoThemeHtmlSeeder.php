<?php

namespace Database\Seeders;

use App\Support\ThemeHtmlNichePageImporter;
use Illuminate\Database\Seeder;

/**
 * eCommerce SEO Services — imports theme HTML into /ecommerce-seo-services.
 *
 * Run: php artisan db:seed --class=EcommerceSeoThemeHtmlSeeder
 */
class EcommerceSeoThemeHtmlSeeder extends Seeder
{
    public function run(): void
    {
        ThemeHtmlNichePageImporter::import([
            'slug' => 'ecommerce-seo-services',
            'name' => 'eCommerce SEO Services',
            'htmlPath' => public_path('theme/New folder (2)/ecommerce-seo-services/ecommerce-seo-services.html'),
            'mediaFrom' => public_path('theme/New folder (2)/ecommerce-seo-services'),
            'mediaTo' => 'media/services/ecommerce-seo',
            'cssRel' => 'css/theme-ecommerce-seo.css',
            'extraCssRel' => 'css/theme-ecommerce-seo-page.css',
            'scope' => 'ecom-theme-page',
            'bodyClass' => 'page-ecomseo',
            'sort' => 19,
            'hideFromNav' => true,
            'clearEyebrow' => false,
            'excludeHeroTexts' => [],
            'ctaText' => 'Get a free store audit',
            'heroImageFilename' => 'ecommerce-seo-hero.jpg',
            'keywords' => 'ecommerce SEO services, eCommerce SEO agency, product page SEO, KodRank',
        ], fn ($msg) => str_starts_with($msg, 'ERROR:')
            ? $this->command?->error(substr($msg, 7))
            : $this->command?->info($msg));
    }
}
