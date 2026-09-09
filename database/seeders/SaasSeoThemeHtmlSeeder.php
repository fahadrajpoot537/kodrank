<?php

namespace Database\Seeders;

use App\Support\ThemeHtmlNichePageImporter;
use Illuminate\Database\Seeder;

/**
 * SaaS SEO Services — imports theme HTML into /saas-seo-services.
 * Skips hero text: "Web Development & SEO · Built for SaaS"
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
            'htmlPath' => public_path('theme/newone/saas-software-development/kodrank-saas-development.html'),
            'mediaFrom' => public_path('theme/newone/saas-software-development'),
            'mediaTo' => 'media/services/saas-seo',
            'cssRel' => 'css/theme-saas-seo.css',
            'extraCssRel' => 'css/theme-saas-seo-page.css',
            'scope' => 'saasseo-theme-page',
            'bodyClass' => 'page-saasseo',
            'sort' => 17,
            'hideFromNav' => true,
            'clearEyebrow' => true,
            'excludeHeroTexts' => [
                'Web Development & SEO · Built for SaaS',
                'Web Development & SEO - Built for SaaS',
            ],
            'ctaText' => 'Get My Free SaaS SEO Plan',
            'heroImageFilename' => 'saas-seo-hero.jpg',
            'keywords' => 'SaaS SEO services, SaaS SEO agency, B2B SaaS SEO, KodRank',
        ], fn ($msg) => str_starts_with($msg, 'ERROR:')
            ? $this->command?->error(substr($msg, 7))
            : $this->command?->info($msg));
    }
}
