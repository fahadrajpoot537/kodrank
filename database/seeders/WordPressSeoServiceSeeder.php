<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class WordPressSeoServiceSeeder extends Seeder
{
    public function run(): void
    {
        $parent = ServicePage::query()->where('slug', 'digital-marketing-services')->first();

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'wordpress-seo-services'],
            [
                'parent_id' => $parent?->id,
                'name' => 'WordPress SEO Services',
                'is_active' => true,
                'sort_order' => 9,
                'seo' => [
                    'theme' => 'wordpress-seo',
                    'hide_from_nav' => true,
                    'seo_title' => 'WordPress SEO Services | Rank Higher, Load Faster, Convert More | KodRank',
                    'seo_description' => 'KodRank\'s WordPress SEO Services fix the technical issues holding your site back — plugin bloat, slow Core Web Vitals, misconfigured Yoast/Rank Math — then build the content and authority that ranks. Get a free site audit.',
                    'og_title' => 'WordPress SEO Services | Rank Higher, Load Faster, Convert More | KodRank',
                    'og_description' => 'Fix plugin bloat, Core Web Vitals, and Yoast/Rank Math — then rank for the searches your buyers actually use.',
                    'og_image' => 'media/services/wordpress-seo/wordpress-seo-services-hero.webp',
                    'keywords' => 'WordPress SEO services, Yoast, Rank Math, Core Web Vitals, WooCommerce SEO, KodRank',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();

        $sections = [
            ['hero', 'Hero', [
                'eyebrow' => 'WordPress SEO Services',
                'title_html' => 'WordPress SEO Services that get your site found, clicked, and <span class="pop">chosen</span>.',
                'lede' => 'Your WordPress site looks great — but it\'s buried on page three. We fix the technical drag, sharpen your content, and build the authority that moves you up. Then we keep you there.',
                'cta_text' => 'Get a free site audit',
                'cta_url' => '#contact',
                'note' => 'No lock-in contracts. Clear reporting. You own everything we build.',
                'stats' => [
                    ['value' => '380+', 'label' => 'WordPress sites optimized', 'highlight' => true],
                    ['value' => '2.9×', 'label' => 'Avg. organic traffic lift'],
                    ['value' => '<1.8s', 'label' => 'Typical load time we hit', 'highlight' => true],
                    ['value' => '11 yrs', 'label' => 'In WordPress & SEO'],
                ],
            ]],
            ['pain', 'Why sites stall', [
                'eyebrow' => 'Why sites stall',
                'title' => 'Good WordPress SEO Services start by fixing what\'s quietly holding you back.',
                'paragraphs_html' => [
                    ['html' => 'WordPress is easy to launch and hard to rank. Themes, page builders, and a dozen plugins pile up until Google sees a slow, tangled site — no matter how good your work is. Most agencies bolt SEO on top of that mess. We clear it first, then build from a foundation search engines actually trust.'],
                ],
                'aside' => [
                    'eyebrow' => 'What a cleanup typically moves',
                    'title' => 'Real, measurable shifts',
                    'items' => [
                        'PageSpeed (mobile) 48 → 92',
                        'Largest Contentful Paint 4.1s → 1.7s',
                        'Indexed money pages +64%',
                        'Keywords in top 10: 3.2× more',
                    ],
                ],
                'pain_eyebrow' => 'The usual leaks',
                'pain_title' => 'What\'s quietly holding you back',
                'cards' => [
                    ['num' => '01', 'title' => 'Slow load, failing Core Web Vitals', 'body' => 'Plugin bloat, heavy page builders and unoptimized images push your load time past three seconds. Google notices — and so do the visitors who leave before your page loads.'],
                    ['num' => '02', 'title' => 'Yoast or Rank Math, set up wrong', 'body' => 'The plugin is installed, but titles, schema and indexing are misconfigured. You\'re doing "SEO" and still invisible where it counts.'],
                    ['num' => '03', 'title' => 'Messy URLs & duplicate pages', 'body' => 'Default permalinks, tag archives and thin category pages split your authority and confuse crawlers, so Google never ranks the page you want.'],
                    ['num' => '04', 'title' => 'Only found for your own name', 'body' => 'Type your brand and you\'re there. Type what customers actually search, and you vanish. Your site isn\'t broken — it just isn\'t built to be found.'],
                ],
            ]],
            ['included', 'What\'s included', [
                'eyebrow' => 'What\'s included',
                'title' => 'Full-stack WordPress SEO Services, handled end to end.',
                'lede' => 'One team for the technical fixes, the content, and the links. No hand-offs, no finger-pointing — just measurable movement in your rankings.',
                'cards' => [
                    ['title' => 'Technical SEO', 'body' => 'We clean the foundation so search engines can crawl, render and index every page that matters.', 'bullets' => ['Core Web Vitals & speed tuning', 'Crawl, index & sitemap fixes', 'Schema, permalinks & redirects']],
                    ['title' => 'On-Page & Content', 'body' => 'Keyword research mapped to real buyer intent, then pages written to rank and read like a human wrote them.', 'bullets' => ['Intent-driven keyword mapping', 'Titles, meta & internal links', 'Service & landing page copy']],
                    ['title' => 'Off-Page Authority', 'body' => 'Clean, editorial links and digital PR that build the trust Google rewards — no spam, no shortcuts that get you penalized.', 'bullets' => ['White-hat link building', 'Digital PR & outreach', 'Toxic backlink cleanup']],
                    ['title' => 'Local SEO', 'body' => 'Own the map pack in your service area with a tuned Google Business Profile, local pages and consistent citations.', 'bullets' => ['Google Business Profile tuning', 'Location landing pages', 'Citations & review strategy']],
                    ['title' => 'WooCommerce SEO', 'body' => 'Product and category pages built to rank and sell, with clean structure that scales past hundreds of SKUs.', 'bullets' => ['Product & category optimization', 'Faceted-nav & index control', 'Product schema & rich results']],
                    ['title' => 'Reporting & Growth', 'body' => 'You see rankings, traffic and leads in plain English every month — plus what we did and what\'s next.', 'bullets' => ['Rank & traffic dashboards', 'Conversion & lead tracking', 'Monthly strategy calls']],
                ],
            ]],
            ['process', 'How it works', [
                'eyebrow' => 'How it works',
                'title' => 'A clear path from audit to rankings.',
                'lede' => 'SEO tuned to how WordPress actually works — page builders, plugins, hosting, and Yoast or Rank Math done right.',
                'steps' => [
                    ['num' => '01', 'title' => 'Audit', 'body' => 'We run a full technical, content and backlink audit to find exactly what\'s capping your rankings — and put a number on the opportunity.'],
                    ['num' => '02', 'title' => 'Fix', 'body' => 'Speed, crawlability, schema, broken URLs and plugin bloat get resolved first, so every effort after this compounds instead of leaking.'],
                    ['num' => '03', 'title' => 'Build', 'body' => 'We map keywords to intent, publish pages that answer them, and earn the authoritative links that make Google trust your site.'],
                    ['num' => '04', 'title' => 'Grow', 'body' => 'We track, refine and expand what\'s working month over month — turning early wins into a steady, defensible lead pipeline.'],
                ],
            ]],
            ['compare', 'Why KodRank', [
                'eyebrow' => 'Why KodRank',
                'title' => 'A partner who knows the code and the rankings.',
                'lede' => 'We build WordPress sites for a living, so we don\'t guess at what\'s slowing yours down — we\'ve fixed it a hundred times before.',
                'other' => [
                    'title' => 'A typical WordPress SEO shop',
                    'items' => [
                        'Another plugin stacked on a slow theme',
                        'Yoast installed, never configured',
                        'Reports you can\'t read',
                        'Long contracts and vague retainers',
                    ],
                ],
                'us' => [
                    'tag' => 'KodRank',
                    'title' => 'Developers, not just marketers',
                    'items' => [
                        'Technical fixes done in the code — no fragile plugin band-aids',
                        'Reporting you can read: rankings, traffic and leads',
                        'No lock-in, no fluff — month-to-month, white-hat only',
                        'You own every page, link and asset we create',
                    ],
                ],
            ]],
            ['testimonials', 'Results', [
                'eyebrow' => 'Results',
                'title' => 'Sites that were stuck — until they weren\'t.',
                'items' => [
                    ['quote' => 'Our old agency kept adding plugins to "fix" speed. KodRank stripped it back, rebuilt the technical layer, and our mobile PageSpeed went from the 40s to the 90s. Leads followed within two months.', 'initials' => 'RM', 'name' => 'Rachel M.', 'role' => 'Founder, Home Services Co.'],
                    ['quote' => 'We ranked for our brand name and nothing else. They mapped out the searches our buyers actually use and built pages around them. Six months later we\'re on page one for the terms that pay.', 'initials' => 'DT', 'name' => 'Daniel T.', 'role' => 'Marketing Lead, B2B SaaS'],
                    ['quote' => 'Our WooCommerce store had 600 products and a crawl mess Google ignored. They fixed the structure and product schema — organic revenue is up and I finally understand my own reports.', 'initials' => 'PK', 'name' => 'Priya K.', 'role' => 'Owner, Online Retailer'],
                ],
            ]],
            ['faq', 'FAQ', [
                'eyebrow' => 'Questions',
                'title' => 'WordPress SEO Services, answered.',
                'items' => [
                    ['q' => 'How are WordPress SEO Services different from regular SEO?', 'a' => 'The strategy is the same, but the execution isn\'t. WordPress ranking problems usually live in the platform itself — bloated page builders, conflicting plugins, default permalinks, and misconfigured SEO plugins. We fix those at the code and configuration level, not with another plugin stacked on top.'],
                    ['q' => 'How long until I see results?', 'a' => 'Technical fixes like speed and crawlability often show up in weeks. Ranking and traffic gains from content and links typically build over three to six months. SEO compounds — the work you do now keeps paying off long after it\'s done.'],
                    ['q' => 'Will you slow down or break my site making changes?', 'a' => 'The opposite. We work on a staging copy first, test every change, and back everything up. Most of our work makes your site noticeably faster, not slower — speed is one of the first things we improve.'],
                    ['q' => 'Do I need to switch away from Elementor, Divi or my theme?', 'a' => 'Almost never. We optimize the builder and theme you already use, trimming the excess they load. If something is genuinely holding you back, we\'ll show you the data and the options before touching anything.'],
                    ['q' => 'Do you lock me into a long contract?', 'a' => 'No. We work month-to-month and earn your business with results. You own every page, link and asset we create, so nothing walks out the door if you leave.'],
                    ['q' => 'What do I get to start?', 'a' => 'A free audit of your site\'s technical health, content gaps and backlink profile — plus a plain-English breakdown of what\'s capping your rankings and what it\'s worth to fix. No obligation to continue.'],
                ],
            ]],
            ['contact', 'Contact', [
                'eyebrow' => 'Get started',
                'title' => 'Let\'s find out what\'s capping your rankings.',
                'lede' => 'Tell us about your site and we\'ll send back a free audit — the real reasons you\'re not ranking, and exactly what we\'d fix first. No pressure, no jargon.',
                'points' => [
                    'Free technical & content audit',
                    'Reply within one business day',
                    'No contracts, no obligation',
                ],
                'form_title' => 'Request your free audit',
                'form_sub' => 'Takes under a minute.',
                'fields' => [
                    'name_label' => 'Name',
                    'email_label' => 'Email',
                    'website_label' => 'Website URL',
                    'service_label' => 'Primary goal',
                    'message_label' => 'What\'s your biggest SEO frustration?',
                ],
                'service_options' => ['Rank higher', 'Speed / Core Web Vitals', 'WooCommerce SEO', 'Local SEO'],
                'default_service' => 'Rank higher',
                'submit_text' => 'Send my free audit request',
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
