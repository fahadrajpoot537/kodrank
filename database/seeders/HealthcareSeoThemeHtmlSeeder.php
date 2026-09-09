<?php

namespace Database\Seeders;

use App\Support\ThemeHtmlNichePageImporter;
use Illuminate\Database\Seeder;

/**
 * Healthcare SEO Services — imports theme HTML into /healthcare-seo-services.
 *
 * Run: php artisan db:seed --class=HealthcareSeoThemeHtmlSeeder
 */
class HealthcareSeoThemeHtmlSeeder extends Seeder
{
    public function run(): void
    {
        ThemeHtmlNichePageImporter::import([
            'slug' => 'healthcare-seo-services',
            'name' => 'Healthcare SEO Services',
            'htmlPath' => public_path('theme/newone/healthcare-seo-services-kodrank/kodrank-healthcare-seo.html'),
            'mediaFrom' => public_path('theme/newone/healthcare-seo-services-kodrank'),
            'mediaTo' => 'media/services/healthcare-seo',
            'cssRel' => 'css/theme-healthcare-seo.css',
            'extraCssRel' => 'css/theme-healthcare-seo-page.css',
            'scope' => 'hc-theme-page',
            'bodyClass' => 'page-hcseo',
            'sort' => 42,
            'hideFromNav' => true,
            'clearEyebrow' => false,
            'excludeHeroTexts' => [],
            'ctaText' => 'Get My Free Healthcare SEO Audit',
            'heroImageFilename' => 'healthcare-seo-hero.jpg',
            'keywords' => 'healthcare SEO services, medical SEO, clinic SEO, KodRank',
        ], fn ($msg) => str_starts_with($msg, 'ERROR:')
            ? $this->command?->error(substr($msg, 7))
            : $this->command?->info($msg));
    }
}
