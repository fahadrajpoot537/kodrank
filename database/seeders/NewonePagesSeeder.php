<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use App\Support\ThemeHtmlImporter;
use Illuminate\Database\Seeder;

/**
 * Newone pages: import FULL theme HTML (+ CSS) so no section/copy is lost.
 * Legal pages + industries hub stay structured; service pages use theme-html.
 */
class NewonePagesSeeder extends Seeder
{
    public function run(): void
    {
        $base = public_path('theme/newone');

        $this->importLegal(
            slug: 'privacy-policy',
            name: 'Privacy Policy',
            htmlFile: $base.'/privacy-policy.html',
            cssRel: 'css/page-legal.css',
            scope: 'legal-page',
            sort: 90,
            hideFromNav: true
        );
        $this->importLegal(
            slug: 'terms-and-conditions',
            name: 'Terms & Conditions',
            htmlFile: $base.'/terms-and-conditions.html',
            cssRel: 'css/page-legal.css',
            scope: 'legal-page',
            sort: 91,
            hideFromNav: true
        );
        $this->seedIndustriesHub();

        $pages = [
            [
                'slug' => 'guest-posting-services',
                'name' => 'Guest Posting Services',
                'html' => $base.'/Guest-posting-services/kodrank-guest-posting-services.html',
                'mediaFrom' => $base.'/Guest-posting-services',
                'mediaTo' => 'media/services/guest-posting',
                'css' => 'css/theme-guest-posting.css',
                'scope' => 'gp-theme-page',
                'parentSlug' => 'digital-marketing-services',
                'sort' => 40,
            ],
            [
                'slug' => 'restaurant-seo-services',
                'name' => 'Restaurant SEO Services',
                'html' => $base.'/kodrank-restaurant-seo-images/restaurant-seo.html',
                'mediaFrom' => $base.'/kodrank-restaurant-seo-images',
                'mediaTo' => 'media/services/restaurant-seo',
                'css' => 'css/theme-restaurant-seo.css',
                'scope' => 'rest-theme-page',
                'parentSlug' => 'digital-marketing-services',
                'sort' => 41,
            ],
            [
                'slug' => 'healthcare-seo-services',
                'name' => 'Healthcare SEO Services',
                'html' => $base.'/healthcare-seo-services-kodrank/kodrank-healthcare-seo.html',
                'mediaFrom' => $base.'/healthcare-seo-services-kodrank',
                'mediaTo' => 'media/services/healthcare-seo',
                'css' => 'css/theme-healthcare-seo.css',
                'scope' => 'hc-theme-page',
                'parentSlug' => 'digital-marketing-services',
                'sort' => 42,
            ],
            [
                'slug' => 'real-estate-seo-services',
                'name' => 'Real Estate SEO Services',
                'html' => $base.'/kodrank-real-estate-seo/real-estate-seo-services.html',
                'mediaFrom' => $base.'/kodrank-real-estate-seo',
                'mediaTo' => 'media/services/real-estate-seo',
                'css' => 'css/theme-real-estate-seo.css',
                'scope' => 're-theme-page',
                'parentSlug' => 'digital-marketing-services',
                'sort' => 43,
            ],
            [
                'slug' => 'electrician-website-design-services',
                'name' => 'Electrician Website Design Services',
                'html' => $base.'/Electrician-Website-Design-Services/electrician-website-design.html',
                'mediaFrom' => $base.'/Electrician-Website-Design-Services',
                'mediaTo' => 'media/services/electrician-website',
                'css' => 'css/theme-electrician.css',
                'scope' => 'elec-theme-page',
                'parentSlug' => 'web-design-and-development-services',
                'sort' => 40,
            ],
            [
                'slug' => 'saas-software-development-services',
                'name' => 'SaaS Software Development Services',
                'html' => $base.'/saas-software-development/kodrank-saas-development.html',
                'mediaFrom' => $base.'/saas-software-development',
                'mediaTo' => 'media/services/saas-development',
                'css' => 'css/theme-saas-development.css',
                'scope' => 'saas-theme-page',
                'parentSlug' => 'web-design-and-development-services',
                'sort' => 41,
            ],
        ];

        foreach ($pages as $cfg) {
            $this->importThemeHtmlPage($cfg);
        }

        ServicePage::forgetNavCache();
    }

    /**
     * @param  array{
     *   slug:string,name:string,html:string,mediaFrom:string,mediaTo:string,
     *   css:string,scope:string,parentSlug:?string,sort:int
     * }  $cfg
     */
    private function importThemeHtmlPage(array $cfg): void
    {
        if (! is_file($cfg['html'])) {
            $this->command?->error('Missing HTML: '.$cfg['html']);

            return;
        }

        ThemeHtmlImporter::copyDirImages($cfg['mediaFrom'], $cfg['mediaTo']);
        $extracted = ThemeHtmlImporter::extract($cfg['html'], $cfg['mediaTo']);
        ThemeHtmlImporter::writeCss($cfg['css'], $extracted['css'] ?? '', $cfg['scope']);

        $html = trim((string) ($extracted['html'] ?? ''));
        if ($html === '') {
            $this->command?->error('Empty HTML after extract: '.$cfg['slug']);

            return;
        }

        $parentId = null;
        if (! empty($cfg['parentSlug'])) {
            $parentId = ServicePage::query()->where('slug', $cfg['parentSlug'])->value('id');
        }

        $title = $extracted['title'] !== '' ? $extracted['title'] : ($cfg['name'].' | KodRank');
        $desc = $extracted['description'] ?? '';

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
                    'hide_from_nav' => true,
                    'seo_title' => $title,
                    'seo_description' => $desc,
                    'og_title' => $title,
                    'og_description' => $desc,
                    'og_image' => '',
                    'keywords' => strtolower($cfg['name']).', KodRank',
                    'robots' => ($extracted['robots'] ?? '') !== '' ? $extracted['robots'] : 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();
        ServicePageSection::query()->create([
            'service_page_id' => $page->id,
            'key' => 'body',
            'label' => 'Full theme HTML',
            'sort_order' => 0,
            'data' => [
                'html' => $html,
                'scope' => $cfg['scope'],
            ],
        ]);

        ServicePage::forgetCache($page->slug);
        $this->command?->info('Imported theme-html: '.$cfg['slug'].' ('.strlen($html).' bytes)');
    }

    private function importLegal(
        string $slug,
        string $name,
        string $htmlFile,
        string $cssRel,
        string $scope,
        int $sort,
        bool $hideFromNav
    ): void {
        if (! is_file($htmlFile)) {
            return;
        }
        $extracted = ThemeHtmlImporter::extract($htmlFile);
        $contentHtml = $this->stripLegalChrome($extracted['html'] ?? '');
        $updated = $this->extractLegalUpdated($extracted['html'] ?? '');
        $lede = $this->extractLegalLede($extracted['html'] ?? '', $extracted['description'] ?? '');

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => $slug],
            [
                'parent_id' => null,
                'name' => $name,
                'is_active' => true,
                'sort_order' => $sort,
                'seo' => [
                    'theme' => 'legal',
                    'css' => 'css/page-legal.css',
                    'hide_from_nav' => $hideFromNav,
                    'seo_title' => $extracted['title'] !== '' ? $extracted['title'] : ($name.' | KodRank'),
                    'seo_description' => $extracted['description'],
                    'og_title' => $extracted['title'] !== '' ? $extracted['title'] : $name,
                    'og_description' => $extracted['description'],
                    'og_image' => 'media/about/kodrank-leadership-bg.jpg',
                    'keywords' => strtolower($name).', KodRank',
                    'robots' => $extracted['robots'] ?: 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();
        $page->sections()->create([
            'key' => 'hero',
            'label' => 'Hero',
            'sort_order' => 0,
            'data' => [
                'eyebrow' => 'Legal',
                'title_html' => $name,
                'lede' => $lede,
                'cta_text' => 'Contact Us',
                'cta_url' => '/contact',
                'image' => 'media/about/kodrank-leadership-bg.jpg',
                'breadcrumb' => [
                    ['label' => 'Home', 'url' => '/'],
                    ['label' => $name, 'url' => ''],
                ],
            ],
        ]);
        $page->sections()->create([
            'key' => 'body',
            'label' => 'Page content',
            'sort_order' => 1,
            'data' => [
                'eyebrow' => 'Legal',
                'updated' => $updated,
                'html' => $contentHtml,
            ],
        ]);
        ServicePage::forgetCache($page->slug);
    }

    private function stripLegalChrome(string $html): string
    {
        $html = preg_replace('/<nav\b[^>]*class="[^"]*\bcrumbs\b[^"]*"[^>]*>.*?<\/nav>\s*/is', '', $html) ?? $html;
        $html = preg_replace('/<header\b[^>]*>.*?<\/header>\s*/is', '', $html) ?? $html;
        $html = preg_replace('/<\/?main\b[^>]*>/i', '', $html) ?? $html;
        $html = preg_replace('/^\s*<hr\b[^>]*>\s*/i', '', trim($html)) ?? $html;

        return trim($html);
    }

    private function extractLegalUpdated(string $html): string
    {
        if (preg_match('/class="[^"]*\bupdated\b[^"]*"[^>]*>\s*(?:Last updated:\s*)?([^<]+)/i', $html, $m)) {
            return trim(html_entity_decode($m[1], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        }

        return '';
    }

    private function extractLegalLede(string $html, string $fallback): string
    {
        if (preg_match('/class="[^"]*\blede\b[^"]*"[^>]*>(.*?)<\/p>/is', $html, $m)) {
            return trim(html_entity_decode(strip_tags($m[1]), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        }

        return trim($fallback);
    }

    private function seedIndustriesHub(): void
    {
        $items = [
            ['title' => 'B2B SEO', 'body' => 'Search strategies that turn traffic into qualified pipeline.', 'url' => '/b2b-seo-services'],
            ['title' => 'Real Estate SEO', 'body' => 'Rank listings and capture high-intent buyers locally.', 'url' => '/real-estate-seo-services'],
            ['title' => 'Law Firm SEO', 'body' => 'Own your practice areas and win case-ready clients.', 'url' => '/contact'],
            ['title' => 'SaaS SEO', 'body' => 'Content and search engineered to grow recurring revenue.', 'url' => '/saas-seo-services'],
            ['title' => 'SaaS Software Development', 'body' => 'Custom SaaS products built to ship and scale.', 'url' => '/saas-software-development-services'],
            ['title' => 'Ecommerce SEO', 'body' => 'Grow product visibility and organic store revenue.', 'url' => '/ecommerce-seo-services'],
            ['title' => 'Healthcare SEO', 'body' => 'Compliant, trust-first SEO that reaches patients.', 'url' => '/healthcare-seo-services'],
            ['title' => 'Restaurant SEO', 'body' => 'Local search that fills tables and books covers.', 'url' => '/restaurant-seo-services'],
            ['title' => 'Electrician Website Design', 'body' => 'Fast, converting sites that book more jobs.', 'url' => '/electrician-website-design-services'],
        ];

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'industries'],
            [
                'parent_id' => null,
                'name' => 'Industries',
                'is_active' => true,
                'sort_order' => 20,
                'seo' => [
                    'theme' => 'industries',
                    'css' => 'css/page-industries.css',
                    'hide_from_nav' => true,
                    'seo_title' => 'Industries We Serve | KodRank',
                    'seo_description' => 'SEO and web solutions tuned to how your market actually searches — B2B, SaaS, healthcare, real estate, restaurants, and more.',
                    'og_title' => 'Industries We Serve | KodRank',
                    'og_description' => 'Search and web solutions for the industries we know best.',
                    'og_image' => '',
                    'keywords' => 'industries, SEO, KodRank',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();
        $page->sections()->create([
            'key' => 'hero',
            'label' => 'Hero',
            'sort_order' => 0,
            'data' => [
                'eyebrow' => 'Industries',
                'title_html' => 'Built to <span>Rank</span>',
                'lede' => 'Search and web solutions tuned to how your market actually searches. We grow qualified traffic, leads, and revenue — one industry at a time.',
            ],
        ]);
        $page->sections()->create([
            'key' => 'grid',
            'label' => 'Industry grid',
            'sort_order' => 1,
            'data' => ['items' => $items],
        ]);
        ServicePage::forgetCache($page->slug);
    }
}
