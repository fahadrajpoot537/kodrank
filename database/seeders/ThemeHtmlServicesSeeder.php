<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use App\Support\ThemeHtmlImporter;
use Illuminate\Database\Seeder;

/**
 * Import EVERY service theme HTML file as theme-html so no content is lost.
 * Run after structured service seeders so this overwrites page bodies.
 */
class ThemeHtmlServicesSeeder extends Seeder
{
    public function run(): void
    {
        $t = public_path('theme');

        $pages = [
            // ── Digital marketing / SEO ──
            // digital-marketing-services uses DigitalMarketingServiceSeeder + blade partials (not theme-html).
            [
                'slug' => 'on-page-seo-services',
                'name' => 'On-Page SEO Services',
                'html' => $t.'/on-page-seo-services.html',
                'mediaFrom' => $t,
                'mediaTo' => 'media/services/on-page-seo',
                'css' => 'css/theme-on-page-seo.css',
                'scope' => 'onpage-theme-page',
                'parentSlug' => 'digital-marketing-services',
                'sort' => 11,
            ],
            [
                'slug' => 'off-page-seo-services',
                'name' => 'Off-Page SEO Services',
                'html' => $t.'/off-page-seo-services.html',
                'mediaFrom' => $t,
                'mediaTo' => 'media/services/off-page-seo',
                'css' => 'css/theme-off-page-seo.css',
                'scope' => 'offpage-theme-page',
                'parentSlug' => 'digital-marketing-services',
                'sort' => 12,
            ],
            [
                'slug' => 'technical-seo-services',
                'name' => 'Technical SEO Services',
                'html' => $t.'/kodrank-technical-seo-services/technical-seo-services.html',
                'mediaFrom' => $t.'/kodrank-technical-seo-services',
                'mediaTo' => 'media/services/technical-seo',
                'css' => 'css/theme-technical-seo.css',
                'scope' => 'techseo-theme-page',
                'parentSlug' => 'digital-marketing-services',
                'sort' => 13,
            ],
            [
                'slug' => 'aeo-services',
                'name' => 'AEO Services',
                'html' => $t.'/aeo-services-page/aeo-services.html',
                'mediaFrom' => $t.'/aeo-services-page',
                'mediaTo' => 'media/services/aeo',
                'css' => 'css/theme-aeo.css',
                'scope' => 'aeo-theme-page',
                'parentSlug' => 'digital-marketing-services',
                'sort' => 14,
            ],
            [
                'slug' => 'geo-services',
                'name' => 'GEO Services',
                'html' => $t.'/kodrank-geo-landing-page/geo-services.html',
                'mediaFrom' => $t.'/kodrank-geo-landing-page',
                'mediaTo' => 'media/services/geo',
                'css' => 'css/theme-geo.css',
                'scope' => 'geo-theme-page',
                'parentSlug' => 'digital-marketing-services',
                'sort' => 15,
            ],
            [
                'slug' => 'monthly-seo-services',
                'name' => 'Monthly SEO Services',
                'html' => $t.'/New folder/monthly-seo-services.html',
                'mediaFrom' => $t.'/New folder',
                'mediaTo' => 'media/services/monthly-seo',
                'css' => 'css/theme-monthly-seo.css',
                'scope' => 'monthly-theme-page',
                'parentSlug' => 'digital-marketing-services',
                'sort' => 16,
            ],
            [
                'slug' => 'saas-seo-services',
                'name' => 'SaaS SEO Services',
                'html' => $t.'/New folder/saas-seo-services-images/saas-seo-services.html',
                'mediaFrom' => $t.'/New folder/saas-seo-services-images',
                'mediaTo' => 'media/services/saas-seo',
                'css' => 'css/theme-saas-seo.css',
                'scope' => 'saasseo-theme-page',
                'parentSlug' => 'digital-marketing-services',
                'sort' => 17,
            ],
            [
                'slug' => 'b2b-seo-services',
                'name' => 'B2B SEO Services',
                'html' => $t.'/New folder (2)/B2b seo services/b2b-seo-services.html',
                'mediaFrom' => $t.'/New folder (2)/B2b seo services',
                'mediaTo' => 'media/services/b2b-seo',
                'css' => 'css/theme-b2b-seo.css',
                'scope' => 'b2b-theme-page',
                'parentSlug' => 'digital-marketing-services',
                'sort' => 18,
            ],
            [
                'slug' => 'ecommerce-seo-services',
                'name' => 'Ecommerce SEO Services',
                'html' => $t.'/New folder (2)/ecommerce-seo-services/ecommerce-seo-services.html',
                'mediaFrom' => $t.'/New folder (2)/ecommerce-seo-services',
                'mediaTo' => 'media/services/ecommerce-seo',
                'css' => 'css/theme-ecommerce-seo.css',
                'scope' => 'ecom-theme-page',
                'parentSlug' => 'digital-marketing-services',
                'sort' => 19,
            ],
            [
                'slug' => 'wordpress-seo-services',
                'name' => 'WordPress SEO Services',
                'html' => $t.'/New folder (2)/wordpress-seo-services-hero/wordpress-seo-services.html',
                'mediaFrom' => $t.'/New folder (2)/wordpress-seo-services-hero',
                'mediaTo' => 'media/services/wordpress-seo',
                'css' => 'css/theme-wordpress-seo.css',
                'scope' => 'wpseo-theme-page',
                'parentSlug' => 'digital-marketing-services',
                'sort' => 20,
            ],
            [
                'slug' => 'guest-posting-services',
                'name' => 'Guest Posting Services',
                'html' => $t.'/newone/Guest-posting-services/kodrank-guest-posting-services.html',
                'mediaFrom' => $t.'/newone/Guest-posting-services',
                'mediaTo' => 'media/services/guest-posting',
                'css' => 'css/theme-guest-posting.css',
                'scope' => 'gp-theme-page',
                'parentSlug' => 'digital-marketing-services',
                'sort' => 40,
            ],
            [
                'slug' => 'restaurant-seo-services',
                'name' => 'Restaurant SEO Services',
                'html' => $t.'/newone/kodrank-restaurant-seo-images/restaurant-seo.html',
                'mediaFrom' => $t.'/newone/kodrank-restaurant-seo-images',
                'mediaTo' => 'media/services/restaurant-seo',
                'css' => 'css/theme-restaurant-seo.css',
                'scope' => 'rest-theme-page',
                'parentSlug' => 'digital-marketing-services',
                'sort' => 41,
            ],
            [
                'slug' => 'healthcare-seo-services',
                'name' => 'Healthcare SEO Services',
                'html' => $t.'/newone/healthcare-seo-services-kodrank/kodrank-healthcare-seo.html',
                'mediaFrom' => $t.'/newone/healthcare-seo-services-kodrank',
                'mediaTo' => 'media/services/healthcare-seo',
                'css' => 'css/theme-healthcare-seo.css',
                'scope' => 'hc-theme-page',
                'parentSlug' => 'digital-marketing-services',
                'sort' => 42,
            ],
            [
                'slug' => 'real-estate-seo-services',
                'name' => 'Real Estate SEO Services',
                'html' => $t.'/newone/kodrank-real-estate-seo/real-estate-seo-services.html',
                'mediaFrom' => $t.'/newone/kodrank-real-estate-seo',
                'mediaTo' => 'media/services/real-estate-seo',
                'css' => 'css/theme-real-estate-seo.css',
                'scope' => 're-theme-page',
                'parentSlug' => 'digital-marketing-services',
                'sort' => 43,
            ],

            // ── Web development ──
            [
                'slug' => 'wordpress-development-services',
                'name' => 'WordPress Development Services',
                'html' => $t.'/blog/kodrank-wordpress-development-services/wordpress-development-services.html',
                'mediaFrom' => $t.'/blog/kodrank-wordpress-development-services',
                'mediaTo' => 'media/services/wordpress-development',
                'css' => 'css/theme-wordpress-development.css',
                'scope' => 'wpdev-theme-page',
                'parentSlug' => 'web-design-and-development-services',
                'sort' => 30,
            ],
            [
                'slug' => 'shopify-development-services',
                'name' => 'Shopify Development Services',
                'html' => $t.'/shopify/shopify-development-services (1).html',
                'mediaFrom' => $t.'/shopify',
                'mediaTo' => 'media/services/shopify',
                'css' => 'css/theme-shopify.css',
                'scope' => 'shopify-theme-page',
                'parentSlug' => 'web-design-and-development-services',
                'sort' => 31,
            ],
            [
                'slug' => 'ai-chatbot-development-services',
                'name' => 'AI Chatbot Development Services',
                'html' => $t.'/serv/kodrank-ai-chatbot-development-services.html',
                'mediaFrom' => $t.'/serv',
                'mediaTo' => 'media/services/ai-chatbot',
                'css' => 'css/theme-ai-chatbot.css',
                'scope' => 'aibot-theme-page',
                'parentSlug' => 'web-design-and-development-services',
                'sort' => 32,
            ],
            [
                'slug' => 'cms-development-services',
                'name' => 'CMS Development Services',
                'html' => $t.'/newservices/kodrank-cms-development-services/cms-development-services.html',
                'mediaFrom' => $t.'/newservices/kodrank-cms-development-services',
                'mediaTo' => 'media/services/cms',
                'css' => 'css/theme-cms.css',
                'scope' => 'cms-theme-page',
                'parentSlug' => 'web-design-and-development-services',
                'sort' => 33,
            ],
            [
                'slug' => 'website-redesign-services',
                'name' => 'Website Redesign Services',
                'html' => $t.'/newservices/kodrank-website-redesign-services/website-redesign-services.html',
                'mediaFrom' => $t.'/newservices/kodrank-website-redesign-services',
                'mediaTo' => 'media/services/website-redesign',
                'css' => 'css/theme-website-redesign.css',
                'scope' => 'redesign-theme-page',
                'parentSlug' => 'web-design-and-development-services',
                'sort' => 34,
            ],
            [
                'slug' => 'electrician-website-design-services',
                'name' => 'Electrician Website Design Services',
                'html' => $t.'/newone/Electrician-Website-Design-Services/electrician-website-design.html',
                'mediaFrom' => $t.'/newone/Electrician-Website-Design-Services',
                'mediaTo' => 'media/services/electrician-website',
                'css' => 'css/theme-electrician.css',
                'scope' => 'elec-theme-page',
                'parentSlug' => 'web-design-and-development-services',
                'sort' => 40,
            ],
            [
                'slug' => 'saas-software-development-services',
                'name' => 'SaaS Software Development Services',
                'html' => $t.'/newone/saas-software-development/kodrank-saas-development.html',
                'mediaFrom' => $t.'/newone/saas-software-development',
                'mediaTo' => 'media/services/saas-development',
                'css' => 'css/theme-saas-development.css',
                'scope' => 'saas-theme-page',
                'parentSlug' => 'web-design-and-development-services',
                'sort' => 41,
            ],
        ];

        $ok = 0;
        $fail = 0;
        foreach ($pages as $cfg) {
            if ($this->import($cfg)) {
                $ok++;
            } else {
                $fail++;
            }
        }

        ServicePage::forgetNavCache();
        $this->command?->info("Theme HTML services: {$ok} imported, {$fail} skipped/failed.");
    }

    /**
     * @param  array{
     *   slug:string,name:string,html:string,mediaFrom:string,mediaTo:string,
     *   css:string,scope:string,parentSlug:?string,sort:int
     * }  $cfg
     */
    private function import(array $cfg): bool
    {
        if (! is_file($cfg['html'])) {
            $this->command?->error('Missing HTML: '.$cfg['html']);

            return false;
        }

        try {
            ThemeHtmlImporter::copyDirImages($cfg['mediaFrom'], $cfg['mediaTo']);
            $extracted = ThemeHtmlImporter::extract($cfg['html'], $cfg['mediaTo']);
            ThemeHtmlImporter::writeCss($cfg['css'], $extracted['css'] ?? '', $cfg['scope']);
        } catch (\Throwable $e) {
            $this->command?->error($cfg['slug'].': '.$e->getMessage());

            return false;
        }

        $html = trim((string) ($extracted['html'] ?? ''));
        if ($html === '') {
            $this->command?->error('Empty HTML: '.$cfg['slug']);

            return false;
        }

        $parentId = null;
        if (! empty($cfg['parentSlug'])) {
            $parentId = ServicePage::query()->where('slug', $cfg['parentSlug'])->value('id');
        }

        $title = ($extracted['title'] ?? '') !== '' ? $extracted['title'] : ($cfg['name'].' | KodRank');
        $desc = $extracted['description'] ?? '';
        $hero = $extracted['hero'] ?? [];
        if (($hero['title'] ?? '') === '' && ($hero['title_html'] ?? '') === '') {
            $hero['title'] = $cfg['name'];
        }
        if (($hero['lede'] ?? '') === '' && $desc !== '') {
            $hero['lede'] = $desc;
        }
        $hero['breadcrumb'] = [
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Services', 'url' => '/services'],
            ['label' => $cfg['name'], 'url' => ''],
        ];
        if (empty($hero['image'])) {
            $hero['image'] = 'media/services/on-page-seo/on-page-seo-services-agency-banner.jpg';
        }

        // Always file-store HTML — avoids MySQL max_allowed_packet on embed-heavy themes
        $htmlPath = ThemeHtmlImporter::storeHtmlFile($cfg['slug'], $html);

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => $cfg['slug']],
            [
                'parent_id' => $parentId,
                'name' => $cfg['name'],
                'is_active' => true,
                'sort_order' => $cfg['sort'],
                'seo' => [
                    'theme' => 'theme-html',
                    'css' => $cfg['css'],
                    // Niche / long-tail pages: Services mega shows "View all services" instead
                    'hide_from_nav' => $this->shouldHideFromNav($cfg['slug']),
                    'seo_title' => $title,
                    'seo_description' => $desc,
                    'og_title' => $title,
                    'og_description' => $desc,
                    'og_image' => $hero['image'] ?? '',
                    'keywords' => strtolower($cfg['name']).', KodRank',
                    'robots' => ($extracted['robots'] ?? '') !== '' ? $extracted['robots'] : 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();
        ServicePageSection::query()->create([
            'service_page_id' => $page->id,
            'key' => 'hero',
            'label' => 'Hero (KodRank)',
            'sort_order' => 0,
            'data' => $hero,
        ]);
        ServicePageSection::query()->create([
            'service_page_id' => $page->id,
            'key' => 'body',
            'label' => 'Theme body (below hero)',
            'sort_order' => 1,
            'data' => [
                'html' => '',
                'html_path' => $htmlPath,
                'scope' => $cfg['scope'],
            ],
        ]);

        ServicePage::forgetCache($page->slug);
        $this->command?->info('OK '.$cfg['slug'].' (file '.$htmlPath.', '.strlen($html).' bytes)');

        return true;
    }

    /**
     * Niche / long-tail service pages stay off the Services mega;
     * users reach them via "View all services" (/services).
     */
    private function shouldHideFromNav(string $slug): bool
    {
        return in_array($slug, [
            'monthly-seo-services',
            'saas-seo-services',
            'b2b-seo-services',
            'ecommerce-seo-services',
            'wordpress-seo-services',
            'guest-posting-services',
            'restaurant-seo-services',
            'healthcare-seo-services',
            'real-estate-seo-services',
            'electrician-website-design-services',
            'saas-software-development-services',
        ], true);
    }
}
