<?php

namespace Database\Seeders;

use App\Support\ThemeHtmlNichePageImporter;
use Illuminate\Database\Seeder;

/**
 * SaaS SEO Services — imports theme HTML into /saas-seo-services.
 * Source: public/theme/New folder/saas-seo-services-images/saas-seo-services.html
 *
 * Run: php artisan db:seed --class=SaasSeoThemeHtmlSeeder
 */
class SaasSeoThemeHtmlSeeder extends Seeder
{
    public function run(): void
    {
        ThemeHtmlNichePageImporter::import([
            'slug' => 'saas-seo-services',
            'name' => 'SaaS SEO Services',
            'htmlPath' => public_path('theme/New folder/saas-seo-services-images/saas-seo-services.html'),
            'mediaFrom' => public_path('theme/New folder/saas-seo-services-images'),
            'mediaTo' => 'media/services/saas-seo',
            'cssRel' => 'css/theme-saas-seo.css',
            'extraCssRel' => 'css/theme-saas-seo-page.css',
            'scope' => 'saasseo-theme-page',
            'bodyClass' => 'page-saasseo',
            'sort' => 17,
            'hideFromNav' => true,
            'clearEyebrow' => true,
            'excludeHeroTexts' => [
                'SaaS SEO Agency',
                'SaaS SEO Services',
            ],
            'ctaText' => 'Get My Free SaaS SEO Plan',
            'heroImageFilename' => 'saas-seo-hero.jpg',
            'keywords' => 'SaaS SEO services, SaaS SEO agency, B2B SaaS SEO, organic pipeline, KodRank',
        ], fn ($msg) => str_starts_with($msg, 'ERROR:')
            ? $this->command?->error(substr($msg, 7))
            : $this->command?->info($msg));
    }
}
