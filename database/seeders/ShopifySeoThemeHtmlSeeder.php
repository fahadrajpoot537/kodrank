<?php

namespace Database\Seeders;

use App\Support\ThemeHtmlNichePageImporter;
use Illuminate\Database\Seeder;

/**
 * Shopify SEO Services — imports theme HTML into /shopify-seo-services.
 * Source is shopify development theme content adapted to existing KodRank SEO page shell.
 *
 * Run: php artisan db:seed --class=ShopifySeoThemeHtmlSeeder
 */
class ShopifySeoThemeHtmlSeeder extends Seeder
{
    public function run(): void
    {
        ThemeHtmlNichePageImporter::import([
            'slug' => 'shopify-seo-services',
            'name' => 'Shopify SEO Services',
            'htmlPath' => public_path('theme/shopify/shopify-development-services (1).html'),
            'mediaFrom' => public_path('theme/shopify'),
            'mediaTo' => 'media/services/shopify-seo',
            'cssRel' => 'css/theme-shopify-seo.css',
            'extraCssRel' => 'css/theme-shopify-seo-page.css',
            'scope' => 'shopifyseo-theme-page',
            'bodyClass' => 'page-shopifyseo',
            'sort' => 21,
            'hideFromNav' => true,
            'clearEyebrow' => false,
            'excludeHeroTexts' => [],
            'ctaText' => 'Get My Free Shopify SEO Audit',
            'heroImageFilename' => 'shopify-seo-hero.jpg',
            'keywords' => 'Shopify SEO services, Shopify SEO agency, Shopify search optimization, KodRank',
        ], fn ($msg) => str_starts_with($msg, 'ERROR:')
            ? $this->command?->error(substr($msg, 7))
            : $this->command?->info($msg));
    }
}
