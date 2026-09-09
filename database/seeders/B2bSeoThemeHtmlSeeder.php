<?php

namespace Database\Seeders;

use App\Support\ThemeHtmlNichePageImporter;
use Illuminate\Database\Seeder;

/**
 * B2B SEO Services — imports theme HTML into /b2b-seo-services.
 * Skips hero text: "B2B SEO Agency"
 *
 * Run: php artisan db:seed --class=B2bSeoThemeHtmlSeeder
 */
class B2bSeoThemeHtmlSeeder extends Seeder
{
    public function run(): void
    {
        ThemeHtmlNichePageImporter::import([
            'slug' => 'b2b-seo-services',
            'name' => 'B2B SEO Services',
            'htmlPath' => public_path('theme/New folder (2)/B2b seo services/b2b-seo-services.html'),
            'mediaFrom' => public_path('theme/New folder (2)/B2b seo services'),
            'mediaTo' => 'media/services/b2b-seo',
            'cssRel' => 'css/theme-b2b-seo.css',
            'extraCssRel' => 'css/theme-b2b-seo-page.css',
            'scope' => 'b2b-theme-page',
            'bodyClass' => 'page-b2bseo',
            'sort' => 18,
            'hideFromNav' => true,
            'clearEyebrow' => true,
            'excludeHeroTexts' => ['B2B SEO Agency'],
            'ctaText' => 'Get My Free B2B SEO Audit',
            'heroImageFilename' => 'b2b-seo-hero.jpg',
            'keywords' => 'B2B SEO services, B2B SEO agency, enterprise SEO, KodRank',
        ], fn ($msg) => str_starts_with($msg, 'ERROR:')
            ? $this->command?->error(substr($msg, 7))
            : $this->command?->info($msg));
    }
}
