<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Shopify SEO Services — restores the structured Shopify SEO page
 * (NOT Shopify Development theme HTML).
 *
 * Theme-html import was pointing at shopify-development HTML by mistake.
 * Correct content lives in ShopifySeoServiceSeeder (ecommerce-seo theme).
 *
 * Run: php artisan db:seed --class=ShopifySeoThemeHtmlSeeder
 *  or: php artisan db:seed --class=ShopifySeoServiceSeeder
 */
class ShopifySeoThemeHtmlSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ShopifySeoServiceSeeder::class);
        $this->command?->info('Shopify SEO Services restored via ShopifySeoServiceSeeder (ecommerce-seo theme).');
    }
}
