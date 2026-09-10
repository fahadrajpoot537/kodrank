<?php

namespace Database\Seeders;

use App\Support\ThemeHtmlNichePageImporter;
use Illuminate\Database\Seeder;

/**
 * Web Design + all development child pages — import theme HTML bodies
 * into KodRank shell (shared hero + theme-html body). Design stays local.
 *
 * Run: php artisan db:seed --class=WebDevThemeHtmlSeeder
 */
class WebDevThemeHtmlSeeder extends Seeder
{
    public function run(): void
    {
        $t = public_path('theme');

        $pages = [
            [
                'slug' => 'web-design-and-development-services',
                'name' => 'Web Design and Development Services',
                'htmlPath' => $t.'/index (9).html',
                'mediaFrom' => $t,
                'mediaTo' => 'media/services/web-design',
                'cssRel' => 'css/theme-web-design.css',
                'extraCssRel' => 'css/theme-web-design-page.css',
                'scope' => 'webdesign-theme-page',
                'bodyClass' => 'page-webdesign',
                'parentSlug' => null,
                'sort' => 1,
                'hideFromNav' => false,
                'ctaText' => 'Start Your Project',
                'heroImageFilename' => 'web-design-hero.jpg',
                'keywords' => 'Web Design and Development Services, SEO web design, KodRank',
            ],
            [
                'slug' => 'wordpress-development-services',
                'name' => 'WordPress Development Services',
                'htmlPath' => $t.'/blog/kodrank-wordpress-development-services/wordpress-development-services.html',
                'mediaFrom' => $t.'/blog/kodrank-wordpress-development-services',
                'mediaTo' => 'media/services/wordpress-development',
                'cssRel' => 'css/theme-wordpress-development.css',
                'extraCssRel' => 'css/theme-wordpress-development-page.css',
                'scope' => 'wpdev-theme-page',
                'bodyClass' => 'page-wpdev',
                'parentSlug' => 'web-design-and-development-services',
                'sort' => 30,
                'hideFromNav' => false,
                'ctaText' => 'Get A Free Site Audit',
                'heroImageFilename' => 'wordpress-development-hero.jpg',
                'keywords' => 'WordPress development services, custom WordPress, KodRank',
            ],
            [
                'slug' => 'shopify-development-services',
                'name' => 'Shopify Development Services',
                'htmlPath' => $t.'/shopify/shopify-development-services (1).html',
                'mediaFrom' => $t.'/shopify',
                'mediaTo' => 'media/services/shopify',
                'cssRel' => 'css/theme-shopify-development.css',
                'extraCssRel' => 'css/theme-shopify-development-page.css',
                'scope' => 'shopify-theme-page',
                'bodyClass' => 'page-shopify',
                'parentSlug' => 'web-design-and-development-services',
                'sort' => 31,
                'hideFromNav' => false,
                'ctaText' => 'Get a free store teardown',
                'heroImageFilename' => 'shopify-development-hero.jpg',
                'keywords' => 'Shopify development services, Shopify store development, KodRank',
            ],
            [
                'slug' => 'ai-chatbot-development-services',
                'name' => 'AI Chatbot Development Services',
                'htmlPath' => $t.'/serv/kodrank-ai-chatbot-development-services.html',
                'mediaFrom' => $t.'/serv',
                'mediaTo' => 'media/services/ai-chatbot',
                'cssRel' => 'css/theme-ai-chatbot.css',
                'extraCssRel' => 'css/theme-ai-chatbot-page.css',
                'scope' => 'aibot-theme-page',
                'bodyClass' => 'page-aibot',
                'parentSlug' => 'web-design-and-development-services',
                'sort' => 32,
                'hideFromNav' => false,
                'ctaText' => 'Book A Free Strategy Call',
                'heroImageFilename' => 'ai-chatbot-hero.jpg',
                'keywords' => 'AI chatbot development services, custom AI assistants, KodRank',
            ],
            [
                'slug' => 'cms-development-services',
                'name' => 'CMS Development Services',
                'htmlPath' => $t.'/newservices/kodrank-cms-development-services/cms-development-services.html',
                'mediaFrom' => $t.'/newservices/kodrank-cms-development-services',
                'mediaTo' => 'media/services/cms',
                'cssRel' => 'css/theme-cms.css',
                'extraCssRel' => 'css/theme-cms-page.css',
                'scope' => 'cms-theme-page',
                'bodyClass' => 'page-cms',
                'parentSlug' => 'web-design-and-development-services',
                'sort' => 33,
                'hideFromNav' => false,
                'ctaText' => 'Get a free CMS audit',
                'heroImageFilename' => 'cms-development-hero.jpg',
                'keywords' => 'CMS development services, custom CMS, KodRank',
            ],
            [
                'slug' => 'website-redesign-services',
                'name' => 'Website Redesign Services',
                'htmlPath' => $t.'/newservices/kodrank-website-redesign-services/website-redesign-services.html',
                'mediaFrom' => $t.'/newservices/kodrank-website-redesign-services',
                'mediaTo' => 'media/services/website-redesign',
                'cssRel' => 'css/theme-website-redesign.css',
                'extraCssRel' => 'css/theme-website-redesign-page.css',
                'scope' => 'redesign-theme-page',
                'bodyClass' => 'page-redesign',
                'parentSlug' => 'web-design-and-development-services',
                'sort' => 34,
                'hideFromNav' => false,
                'ctaText' => 'Get a free redesign audit',
                'heroImageFilename' => 'website-redesign-hero.jpg',
                'keywords' => 'website redesign services, website rebuild, KodRank',
            ],
            [
                'slug' => 'electrician-website-design-services',
                'name' => 'Electrician Website Design Services',
                'htmlPath' => $t.'/newone/Electrician-Website-Design-Services/electrician-website-design.html',
                'mediaFrom' => $t.'/newone/Electrician-Website-Design-Services',
                'mediaTo' => 'media/services/electrician-website',
                'cssRel' => 'css/theme-electrician.css',
                'extraCssRel' => 'css/theme-electrician-page.css',
                'scope' => 'elec-theme-page',
                'bodyClass' => 'page-elec',
                'parentSlug' => 'web-design-and-development-services',
                'sort' => 40,
                'hideFromNav' => true,
                'ctaText' => 'Get My Free Website Audit',
                'heroImageFilename' => 'electrician-website-hero.jpg',
                'keywords' => 'electrician website design, electrician web design, KodRank',
            ],
            [
                'slug' => 'saas-software-development-services',
                'name' => 'SaaS Software Development Services',
                'htmlPath' => $t.'/newone/saas-software-development/kodrank-saas-development.html',
                'mediaFrom' => $t.'/newone/saas-software-development',
                'mediaTo' => 'media/services/saas-development',
                'cssRel' => 'css/theme-saas-development.css',
                'extraCssRel' => 'css/theme-saas-development-page.css',
                'scope' => 'saas-theme-page',
                'bodyClass' => 'page-saas',
                'parentSlug' => 'web-design-and-development-services',
                'sort' => 41,
                'hideFromNav' => true,
                'ctaText' => 'Get my project estimate',
                'heroImageFilename' => 'saas-development-hero.jpg',
                'keywords' => 'SaaS software development services, multi-tenant SaaS, KodRank',
            ],
        ];

        foreach ($pages as $cfg) {
            ThemeHtmlNichePageImporter::import(array_merge($cfg, [
                'clearEyebrow' => false,
                'excludeHeroTexts' => [],
            ]), fn ($msg) => str_starts_with($msg, 'ERROR:')
                ? $this->command?->error(substr($msg, 7))
                : $this->command?->info($msg));
        }
    }
}
