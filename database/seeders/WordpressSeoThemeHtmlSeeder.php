<?php

namespace Database\Seeders;

use App\Support\ThemeHtmlNichePageImporter;
use Illuminate\Database\Seeder;

/**
 * WordPress SEO Services — imports theme HTML into /wordpress-seo-services.
 * Skips hero text: "WordPress SEO Services"
 *
 * Run: php artisan db:seed --class=WordpressSeoThemeHtmlSeeder
 */
class WordpressSeoThemeHtmlSeeder extends Seeder
{
    public function run(): void
    {
        ThemeHtmlNichePageImporter::import([
            'slug' => 'wordpress-seo-services',
            'name' => 'WordPress SEO Services',
            'htmlPath' => public_path('theme/New folder (2)/wordpress-seo-services-hero/wordpress-seo-services.html'),
            'mediaFrom' => public_path('theme/New folder (2)/wordpress-seo-services-hero'),
            'mediaTo' => 'media/services/wordpress-seo',
            'cssRel' => 'css/theme-wordpress-seo.css',
            'extraCssRel' => 'css/theme-wordpress-seo-page.css',
            'scope' => 'wpseo-theme-page',
            'bodyClass' => 'page-wpseo',
            'sort' => 20,
            'hideFromNav' => true,
            'clearEyebrow' => true,
            'excludeHeroTexts' => ['WordPress SEO Services'],
            'ctaText' => 'Get My Free WordPress SEO Audit',
            'heroImageFilename' => 'wordpress-seo-hero.jpg',
            'keywords' => 'WordPress SEO services, WordPress SEO agency, WP SEO, KodRank',
        ], fn ($msg) => str_starts_with($msg, 'ERROR:')
            ? $this->command?->error(substr($msg, 7))
            : $this->command?->info($msg));
    }
}
