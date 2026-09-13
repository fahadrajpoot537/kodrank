<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

/**
 * Shopify SEO Services — structured ecommerce-seo theme content.
 * Copy sourced from public/replace/shopify-seo-services (1).html
 * (content only; Blade/CSS design unchanged).
 *
 * Run: php artisan db:seed --class=ShopifySeoServiceSeeder
 */
class ShopifySeoServiceSeeder extends Seeder
{
    public function run(): void
    {
        $parent = ServicePage::query()->where('slug', 'digital-marketing-services')->first();

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'shopify-seo-services'],
            [
                'parent_id' => $parent?->id,
                'name' => 'Shopify SEO Services',
                'is_active' => true,
                'sort_order' => 10,
                'seo' => [
                    'theme' => 'ecommerce-seo',
                    'hide_from_nav' => true,
                    'seo_title' => 'Shopify SEO Services | Shopify SEO Agency — KodRank',
                    'seo_description' => 'KodRank\'s Shopify SEO Services fix duplicate collection URLs, thin category pages, slow Liquid themes and weak internal links — and rank your Shopify store for buyers who convert. Get a free Shopify SEO audit.',
                    'og_title' => 'Shopify SEO Services | Shopify SEO Agency — KodRank',
                    'og_description' => 'Rank your Shopify collection and product pages, fix the technical debt Shopify hides, and grow organic revenue you can forecast.',
                    'og_image' => 'media/services/shopify-seo/shopify-seo-services-hero.jpg',
                    'keywords' => 'Shopify SEO services, Shopify SEO agency, collection SEO, Liquid optimization, Core Web Vitals, KodRank',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();

        $sections = [
            ['hero', 'Hero', [
                'eyebrow' => 'Shopify SEO Agency',
                'title_html' => 'Shopify SEO Services that turn your store into a <span class="hl">revenue engine</span>',
                'lede_html' => 'Your products are great. Google just can\'t see them. We fix the <b>duplicate collection URLs, slow Liquid themes, and thin category pages</b> quietly draining your organic sales — then rebuild your Shopify store to rank for buyers ready to check out.',
                'cta_text' => 'Get a free Shopify SEO audit',
                'cta_url' => '#contact',
                'image' => 'media/services/shopify-seo/shopify-seo-services-hero.jpg',
                'trust_points' => [
                    'Rank collection and product pages for high-intent, ready-to-buy searches',
                    'Fix the technical SEO debt Shopify ships with by default',
                    'Grow organic revenue you can actually forecast, not just hope for',
                ],
                'proof_chip' => [
                    'stars' => '★★★★★',
                    'html' => '<b>4.9/5</b> from Shopify client reviews · Partner-grade SEO team',
                ],
            ]],
            ['trust', 'Trust strip', [
                'label' => 'Trusted across store types',
                'logos' => ['DTC Brands', 'Shopify Plus', 'B2B Stores', 'High-SKU Catalogs', 'Headless'],
            ]],
            ['intro', 'Introduction', [
                'eyebrow' => 'What we do',
                'title' => 'Professional Shopify SEO Services, built around how Shopify actually works',
                'lead_html' => 'Shopify SEO Services that connect collections, product pages, site speed, and content into one growth plan.',
                'paragraphs_html' => [
                    ['html' => 'Shopify gives you a fast checkout and a clean storefront. It does not give you rankings. Straight out of the box it spawns <span class="hl">duplicate URLs</span> from filters and tags, buries collection pages under thin templates, and lets apps pile scripts onto your theme until Core Web Vitals collapse.'],
                    ['html' => 'Our Shopify SEO Services close that gap. We treat your store as a catalog with revenue at stake — not a checklist. Every fix is prioritized by the money it can move, from the collection pages that should own category searches to the product templates buyers actually convert on. No vanity metrics, no filler reports. Just <span class="hl">more qualified traffic and more orders</span>.'],
                ],
                'card_title' => 'What a focused Shopify SEO program moves',
                'stats' => [
                    ['num' => '3–4mo', 'label' => 'to early ranking traction'],
                    ['num' => '100%', 'label' => 'Shopify-specific execution'],
                    ['num' => '6–9mo', 'label' => 'to compounding revenue'],
                    ['num' => '1', 'label' => 'team for SEO, dev & content'],
                ],
            ]],
            ['pain', 'The problem', [
                'section_class' => 'sec-ink',
                'eyebrow' => 'The problem',
                'title_html' => 'Where your Shopify store is quietly leaking revenue',
                'lede' => 'Most Shopify stores lose sales to the same handful of platform issues — and they rarely show up in a standard report until rankings have already stalled. These are the ones we see draining organic revenue first.',
                'cards' => [
                    [
                        'title' => 'Duplicate URLs eating your crawl budget',
                        'body' => 'Collection filters, sort orders, tags and auto-generated canonicals spawn hundreds of near-identical pages. Google splits ranking signals across all of them — and your real category pages never break through.',
                        'icon_key' => 'clock',
                    ],
                    [
                        'title' => 'Thin collection pages that can\'t rank',
                        'body' => 'Your highest-intent pages read like empty product grids. With no real copy, FAQs or internal links, they lose category searches to competitors who treat collections as landing pages.',
                        'icon_key' => 'search',
                    ],
                    [
                        'title' => 'Slow, app-heavy Liquid themes',
                        'body' => 'Every app injects scripts. Bloated Liquid and unoptimized images wreck LCP and INP, so shoppers bounce before they see your best products — and Google notices.',
                        'icon_key' => 'speed',
                    ],
                    [
                        'title' => 'Internal links going nowhere',
                        'body' => 'Products sit in silos with no path between them. Authority never flows to the pages that sell, so link equity is wasted on your blog instead of your catalog.',
                        'icon_key' => 'links',
                    ],
                    [
                        'title' => 'Variant & out-of-stock chaos',
                        'body' => 'Variant URLs fracture your ranking signals, while discontinued products leak authority into dead ends. Both confuse Google about what your store is actually about.',
                        'icon_key' => 'structure',
                    ],
                    [
                        'title' => 'Migrations that tank rankings',
                        'body' => 'Replatformed to Shopify and watched traffic fall off a cliff? Broken redirects, lost metadata and mangled URLs erase years of equity — recoverable with the right map.',
                        'icon_key' => 'traffic',
                    ],
                ],
                'foot_html' => 'A focused <span class="hl">Shopify SEO audit</span> turns every one of these into a prioritized, revenue-ranked fix list.',
            ]],
            ['services', 'What\'s included', [
                'eyebrow' => 'The scope',
                'title_html' => 'What\'s inside our Shopify SEO Services',
                'lede' => 'One connected program that moves from audit to shipped changes — covering the technical, on-page, content and authority work your Shopify store needs to rank and convert.',
                'cards' => [
                    [
                        'title' => 'Shopify SEO Audit & Roadmap',
                        'body' => 'A full crawl of indexation, collection depth, product quality, Core Web Vitals, schema and apps — turned into a prioritized roadmap ranked by revenue impact.',
                        'icon_key' => 'audit',
                    ],
                    [
                        'title' => 'Collection & Category Architecture',
                        'body' => 'We decide which collections deserve to rank, then build real landing-page copy, FAQs, breadcrumbs and internal links — and control the filter URLs that waste crawl budget.',
                        'icon_key' => 'onpage',
                    ],
                    [
                        'title' => 'Product Page Optimization',
                        'body' => 'Titles, meta, H1 patterns, descriptions, variant logic, alt text, reviews and Product schema — tuned on the templates that drive the most sales first.',
                        'icon_key' => 'ecommerce',
                    ],
                    [
                        'title' => 'Technical SEO & Indexation Control',
                        'body' => 'Canonical consolidation, robots and sitemap rules, redirects, pagination, hreflang and JavaScript rendering — so Google reads your store right.',
                        'icon_key' => 'technical',
                    ],
                    [
                        'title' => 'Theme Speed & Core Web Vitals',
                        'body' => 'We hunt render-blocking scripts, trim app overhead, fix responsive images and lazy-loading, and lift LCP, INP and CLS across revenue templates.',
                        'icon_key' => 'speed',
                    ],
                    [
                        'title' => 'Structured Data & Product Schema',
                        'body' => 'Product, Offer, Review and Breadcrumb markup done right — so you win rich results and stronger snippets in both Google and AI search.',
                        'icon_key' => 'schema',
                    ],
                    [
                        'title' => 'Content That Ranks & Sells',
                        'body' => 'Buying guides, comparisons, sizing and care pages built around real search demand — each one linking back to the collections and products that make money.',
                        'icon_key' => 'content',
                    ],
                    [
                        'title' => 'Migration & Replatforming SEO',
                        'body' => 'URL mapping, redirect strategy, metadata and content preservation, plus launch QA — so moving to Shopify protects your rankings instead of resetting them.',
                        'icon_key' => 'traffic',
                    ],
                    [
                        'title' => 'Authority, Analytics & Reporting',
                        'body' => 'Selective link building for competitive niches, plus GA4, Search Console and rank tracking tied to orders and revenue — not sessions you can\'t bank.',
                        'icon_key' => 'report',
                    ],
                ],
            ]],
            ['process', 'How it works', [
                'section_class' => 'sec-ink',
                'per_desktop' => 4,
                'eyebrow' => 'How it works',
                'title_html' => 'Your Shopify SEO roadmap, in four clear moves',
                'lede' => 'No black boxes. You\'ll always know what we\'re fixing, why it matters, and what it\'s doing to your organic revenue.',
                'steps' => [
                    [
                        'num' => '01',
                        'title' => 'Audit & baseline',
                        'body' => 'We crawl the whole store, expose the technical blockers and indexation waste, and set the baseline your growth is measured against.',
                    ],
                    [
                        'num' => '02',
                        'title' => 'Architecture & keyword map',
                        'body' => 'Every collection and product group gets a commercial search role, mapped to the high-intent keywords most likely to convert.',
                    ],
                    [
                        'num' => '03',
                        'title' => 'Priority fixes shipped',
                        'body' => 'We move from recommendations into real edits — templates, schema, speed, content and redirects — starting with what moves revenue fastest.',
                    ],
                    [
                        'num' => '04',
                        'title' => 'Reporting tied to revenue',
                        'body' => 'Rankings, indexed pages, organic orders and revenue in one view — so you can see exactly what changed and what\'s next.',
                    ],
                ],
            ]],
            ['compare', 'Why KodRank', [
                'eyebrow' => 'Why KodRank',
                'title' => 'A Shopify SEO agency that ships, not just advises',
                'lede' => 'Most SEO vendors hand you a PDF of recommendations and disappear. We\'re a web development and SEO team — so the fixes actually make it into your theme.',
                'other' => [
                    'tag' => 'Typical SEO vendor',
                    'title' => 'Advice you\'re left to implement',
                    'items' => [
                        'Treats Shopify like any other CMS, ignoring Liquid and collection quirks',
                        'Obsesses over titles and blog posts while collection pages drive the revenue',
                        'Hands off technical fixes with no one to build them',
                        'Reports rankings and sessions you can\'t tie to a single order',
                    ],
                ],
                'us' => [
                    'tag' => 'KodRank',
                    'title' => 'Strategy and implementation under one roof',
                    'items' => [
                        'Shopify-specific execution across templates, apps, variants and feeds',
                        'Collection pages treated as revenue landing pages, not afterthoughts',
                        'Our developers ship the fixes — no waiting on a queue that never clears',
                        'Every report ties work to organic orders, revenue and conversion rate',
                    ],
                ],
            ]],
            ['testimonials', 'Client results', [
                'eyebrow' => 'Client results',
                'title' => 'Store owners who stopped guessing at SEO',
                'lede' => 'A snapshot of the kind of feedback we build toward — real organic growth, tied to the numbers that show up in your Shopify dashboard.',
                'items' => [
                    [
                        'quote' => 'They found duplicate collection URLs no one else had flagged in two years. Fixing them alone moved our category pages onto page one.',
                        'initials' => 'SA',
                        'name' => 'Sarah A.',
                        'role' => 'Founder — Apparel DTC',
                    ],
                    [
                        'quote' => 'Reports we could finally understand. Every task was tied to revenue, and our Core Web Vitals went green for the first time.',
                        'initials' => 'MR',
                        'name' => 'Marcus R.',
                        'role' => 'eCommerce Lead — Home & Living',
                    ],
                    [
                        'quote' => 'Our Shopify migration nearly wiped us out. KodRank rebuilt the redirect map and we recovered our rankings within a quarter.',
                        'initials' => 'JL',
                        'name' => 'Jordan L.',
                        'role' => 'Owner — Outdoor Gear',
                    ],
                ],
            ]],
            ['faq', 'FAQ', [
                'eyebrow' => 'Questions',
                'title_html' => 'Shopify SEO Services FAQs',
                'lede' => 'The things store owners ask us most before getting started.',
                'items' => [
                    [
                        'q' => 'What are Shopify SEO Services?',
                        'a' => 'Shopify SEO Services are strategies built specifically to grow a Shopify store\'s organic visibility and revenue. The work covers keyword research, collection and product page optimization, technical SEO, theme speed, structured data, content and link building — all tuned to how Shopify handles URLs, Liquid templates and product data. The goal is simple: rank the pages that make sales, and turn organic search into a dependable channel.',
                    ],
                    [
                        'q' => 'Isn\'t Shopify already good for SEO out of the box?',
                        'a' => 'Shopify gives you a solid foundation — clean URLs, auto sitemaps, mobile themes and canonical tags. But that foundation also creates duplicate filter URLs, thin collection pages and app-driven speed problems that cap your rankings. Good bones aren\'t the same as a store that ranks. That\'s the gap our Shopify SEO Services are built to close.',
                    ],
                    [
                        'q' => 'How long does Shopify SEO take to show results?',
                        'a' => 'Most stores see early ranking traction in 3–4 months and meaningful revenue impact between 6 and 9 months, depending on competition, site authority and how much technical debt we start with. Technical and on-page fixes create early signals; larger ranking and revenue gains compound from there.',
                    ],
                    [
                        'q' => 'What\'s the most common Shopify SEO problem you find?',
                        'a' => 'Duplicate URLs and indexation waste from collection filters, tags and auto-generated canonicals. They split ranking signals across hundreds of near-identical pages, which quietly caps the visibility of the collection pages that should be driving most of your revenue.',
                    ],
                    [
                        'q' => 'Do you handle Shopify migrations without losing rankings?',
                        'a' => 'Yes. Migrations are where most stores lose traffic — usually from broken redirects and lost metadata. We map every URL, build the redirect strategy, preserve content and metadata, QA the launch and monitor afterwards so your equity carries over instead of resetting.',
                    ],
                    [
                        'q' => 'How much do Shopify SEO Services cost?',
                        'a' => 'It depends on your catalog size, competition, current rankings and how much technical and content work is needed. A small DTC store with clean templates needs a very different scope than a Shopify Plus store with thousands of SKUs and multiple markets. The fastest way to a real number is a free audit — we\'ll scope the opportunity and quote accordingly.',
                    ],
                ],
            ]],
            ['contact', 'Contact', [
                'eyebrow' => 'Let\'s grow your store',
                'title_html' => 'Get your free <span class="hl">Shopify SEO audit</span>',
                'lede' => 'Send us your store and we\'ll show you the blockers holding it back, the biggest opportunities, and the exact fixes we\'d ship first — no obligation, no jargon.',
                'points' => [
                    'A prioritized, revenue-ranked list of fixes for your store',
                    'The high-intent keywords your collections should own',
                    'A clear read on your technical, speed and indexation gaps',
                ],
                'form_title' => 'Request your free audit',
                'fields' => [
                    'name_label' => 'Full name',
                    'email_label' => 'Work email',
                    'website_label' => 'Shopify store URL',
                    'service_label' => 'Platform',
                    'message_label' => 'What do you need help with?',
                    'message_placeholder' => 'Traffic dropped after our migration, collection pages won\'t rank, slow theme…',
                ],
                'service_options' => ['Shopify', 'Shopify Plus', 'Other'],
                'default_service' => 'Shopify',
                'submit_text' => 'Get my free audit',
            ]],
        ];

        foreach ($sections as $sort => [$key, $label, $data]) {
            ServicePageSection::query()->create([
                'service_page_id' => $page->id,
                'key' => $key,
                'label' => $label,
                'sort_order' => $sort,
                'data' => $data,
            ]);
        }

        ServicePage::forgetCache($page->slug);
        ServicePage::forgetNavCache();
    }
}
