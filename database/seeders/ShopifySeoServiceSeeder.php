<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

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
                    'seo_title' => 'Shopify SEO Services | Rank Your Store & Collections | KodRank',
                    'seo_description' => 'Shopify SEO services that fix duplicate URLs, speed up your store, and rank collections and products for buyer-intent searches. Get a free Shopify audit.',
                    'og_title' => 'Shopify SEO Services | KodRank',
                    'og_description' => 'Duplicate URL cleanup, collection SEO, Liquid speed fixes, and app bloat audits — Shopify SEO built to rank and sell.',
                    'og_image' => 'media/services/shopify-development/shopify-seo-friendly-store-development.jpg',
                    'keywords' => 'Shopify SEO services, Shopify store SEO, collection SEO, Liquid optimization, KodRank',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();

        $sections = [
            ['hero', 'Hero', [
                'eyebrow' => 'Shopify SEO Services',
                'title_html' => 'Shopify SEO Services that turn<br>collections into<br><span class="hl">Revenue Pages</span>',
                'lede' => 'Shopify\'s defaults get you part of the way there — then duplicate URLs, thin collections, and app bloat stall growth. We clean the technical mess and rank the pages that actually sell.',
                'cta_text' => 'Get a free Shopify audit',
                'cta_url' => '#contact',
                'trust' => [
                    ['value' => 'Fix', 'label' => 'Duplicate URLs & canonicals'],
                    ['value' => 'Rank', 'label' => 'Collections & products'],
                    ['value' => 'Speed', 'label' => 'Liquid & Core Web Vitals'],
                ],
            ]],
            ['intro', 'Introduction', [
                'eyebrow' => 'Introduction',
                'title' => 'Shopify SEO Services Built for Store Owners Who Need Rankings, Not Reports',
                'kicker' => 'Human-led Shopify SEO — technical fixes and content that compound.',
                'paragraphs_html' => [
                    ['html' => 'Most Shopify stores look polished but rank like a brochure site. We audit crawl paths, collection architecture, and app overhead first — then optimize the pages shoppers actually search for.'],
                    ['html' => 'No generic checklists. Our team ships the Liquid tweaks, schema, and internal linking your theme needs so Google sees a fast, structured store — not a plugin graveyard.'],
                ],
                'card_value' => '+164%',
                'card_label' => 'Avg. organic traffic lift on Shopify stores',
                'card_rows' => [
                    'Duplicate URL & canonical cleanup',
                    'Collection pages mapped to buyer intent',
                    'App bloat audits that recover speed',
                ],
            ]],
            ['pain', 'Sound familiar?', [
                'eyebrow' => 'Sound familiar?',
                'title_html' => 'Why your Shopify store isn\'t ranking',
                'lede' => 'These are the patterns we see on almost every Shopify audit before we start fixing.',
                'cards' => [
                    ['title' => 'Duplicate URLs everywhere', 'body' => 'Tags, filters, and collection variants spawn near-identical pages that split authority and confuse crawlers.'],
                    ['title' => 'Collections with no search intent', 'body' => 'Beautiful category pages with thin copy that never match how buyers actually search.'],
                    ['title' => 'Apps slowing every page', 'body' => 'Tracking scripts, pop-ups, and review widgets stack until Core Web Vitals fail and rankings stall.'],
                    ['title' => 'Blog traffic that never converts', 'body' => 'Content exists but isn\'t wired to collections or products — so rankings don\'t show up in revenue.'],
                ],
            ]],
            ['services', 'What\'s included', [
                'eyebrow' => 'What\'s included',
                'title_html' => 'Everything your Shopify store needs to rank',
                'lede' => 'A complete Shopify SEO program scoped to your catalog and theme.',
                'cards' => [
                    ['title' => 'Technical Shopify SEO', 'body' => 'Canonicals, indexation, sitemap hygiene, structured data, and speed — the foundation everything else stands on.'],
                    ['title' => 'Collection & Product SEO', 'body' => 'Intent-matched titles, descriptions, internal links, and layouts tuned for commercial queries.'],
                    ['title' => 'Duplicate URL Cleanup', 'body' => 'We resolve tag, filter, and pagination duplicates so authority flows to the URLs that should rank.'],
                    ['title' => 'Speed & Liquid Optimization', 'body' => 'Theme and app audits with fixes that improve load time without breaking your checkout flow.'],
                    ['title' => 'Content & Blog Architecture', 'body' => 'Buying guides and comparison content that ranks and routes shoppers into your collections.'],
                    ['title' => 'Authority Link Building', 'body' => 'Editorial links to priority categories — the trust signals that move competitive terms.'],
                ],
            ]],
            ['process', 'How we work', [
                'eyebrow' => 'How we work',
                'title_html' => 'From Shopify audit to compounding traffic',
                'lede' => 'Clear milestones — you always know what we\'re fixing and why.',
                'steps' => [
                    ['num' => '01', 'title' => 'Store audit', 'body' => 'Crawl, apps, collections, and competitors — we find what\'s blocking indexation and sales.'],
                    ['num' => '02', 'title' => 'Technical cleanup', 'body' => 'URLs, speed, schema, and structure fixed before we invest in content or links.'],
                    ['num' => '03', 'title' => 'Collection optimization', 'body' => 'Money pages rewritten and interlinked around the searches that convert.'],
                    ['num' => '04', 'title' => 'Content & authority', 'body' => 'Blog, guides, and links that compound rankings month over month.'],
                    ['num' => '05', 'title' => 'Report & refine', 'body' => 'Rankings, traffic, and revenue — then we double down on what moves the needle.'],
                ],
            ]],
            ['stats', 'Why KodRank', [
                'eyebrow' => 'Why KodRank',
                'title_html' => 'Developers and SEOs on one Shopify team',
                'lede' => 'We build and rank Shopify stores — so fixes actually ship instead of sitting in a backlog.',
                'points' => [
                    ['title' => 'We implement in Liquid', 'body' => 'Theme tweaks, schema, and speed fixes handled by our dev team — not a PDF for your freelancer.'],
                    ['title' => 'Revenue-focused reporting', 'body' => 'Organic sessions and sales matter more than vanity keyword counts.'],
                    ['title' => 'Senior specialists only', 'body' => 'The people who plan your strategy execute it — no hand-off to juniors.'],
                ],
                'items' => [
                    ['value' => '+164%', 'label' => 'Organic traffic growth'],
                    ['value' => '2.1×', 'label' => 'Collection page visibility'],
                    ['value' => '18mo', 'label' => 'Avg. client retention'],
                    ['value' => '90+', 'label' => 'Shopify stores optimized'],
                ],
            ]],
            ['platforms', 'Platforms', [
                'eyebrow' => 'Shopify focus',
                'title' => 'Built for the Shopify ecosystem',
                'lede' => 'Plus, standard Shopify, headless, and custom theme stacks.',
                'items' => ['Shopify', 'Shopify Plus', 'Hydrogen', 'Custom themes', 'Marketplace apps'],
            ]],
            ['testimonials', 'In their words', [
                'eyebrow' => 'In their words',
                'title' => 'Shopify merchants who stopped guessing',
                'items' => [
                    ['quote' => 'They found duplicate collection URLs we\'d ignored for years. Traffic to our best sellers finally moved within a few months.', 'initials' => 'JT', 'name' => 'James T.', 'role' => 'Founder, DTC brand'],
                    ['quote' => 'Speed fixes alone recovered rankings we lost after a theme update. The team speaks Shopify, not just SEO theory.', 'initials' => 'LM', 'name' => 'Lena M.', 'role' => 'Head of Ecommerce'],
                ],
            ]],
            ['faq', 'FAQ', [
                'eyebrow' => 'Questions',
                'title_html' => 'Shopify SEO services, answered',
                'items' => [
                    ['q' => 'Do you work with Shopify Plus?', 'a' => 'Yes — standard Shopify, Plus, and headless builds. We adapt to your theme and app stack without forcing a replatform.'],
                    ['q' => 'Can you fix duplicate URLs without breaking filters?', 'a' => 'Yes. We use canonicals, noindex rules, and faceted navigation best practices so shoppers keep filtering while Google sees clean URLs.'],
                    ['q' => 'How long until we see movement?', 'a' => 'Technical wins often show in weeks. Competitive collection terms typically build over three to six months and keep compounding.'],
                ],
            ]],
            ['contact', 'Contact', [
                'eyebrow' => 'Contact',
                'title_html' => 'Request your free <span class="hl">Shopify audit</span>',
                'lede' => 'Share your store URL and we\'ll reply with duplicate URL issues, collection gaps, and the fastest path to organic sales.',
                'points' => ['No spam, no obligation.', 'Reply within 1 business day.'],
                'fields' => [
                    'name_label' => 'Full name',
                    'email_label' => 'Work email',
                    'website_label' => 'Shopify store URL',
                    'service_label' => 'Platform',
                    'message_label' => 'What do you need help with?',
                    'message_placeholder' => 'Tell us about your store, catalog size, and biggest SEO headache…',
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
