<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class WebDesignDevelopmentServiceSeeder extends Seeder
{
    public function run(): void
    {
        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'web-design-and-development-services'],
            [
                'parent_id' => null,
                'name' => 'Web Design and Development Services',
                'is_active' => true,
                'sort_order' => 1,
                'seo' => [
                    'seo_title' => 'Web Design and Development Services | SEO-Ready Websites | KodRank',
                    'seo_description' => 'KodRank\'s Web Design and Development Services deliver custom-built, SEO-optimized, technically sound websites in one package. No second agency needed. Rank from day one.',
                    'og_title' => 'Web Design and Development Services | SEO-Ready Websites | KodRank',
                    'og_description' => 'KodRank\'s Web Design and Development Services deliver custom-built, SEO-optimized, technically sound websites in one package. No second agency needed. Rank from day one.',
                    'og_image' => 'media/services/web-design/hero.jpg',
                    'keywords' => 'Web Design and Development Services, SEO web design, WordPress development, Shopify development, CMS development, website redesign, AI chatbot development',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
                    'theme' => 'web-development',
                ],
            ]
        );

        $page->sections()->delete();

        $sections = [
            [
                'key' => 'hero',
                'label' => 'Hero',
                'sort_order' => 0,
                'data' => [
                    'eyebrow' => 'Web Design and Development Services',
                    'breadcrumb' => [
                        ['label' => 'Home', 'url' => '/'],
                        ['label' => 'Services', 'url' => '#'],
                        ['label' => 'Web Design and Development', 'url' => ''],
                    ],
                    'title' => 'Web Design and Development Services That Ship SEO-Ready Websites — Not Fixer-Uppers.',
                    'title_html' => 'Web Design and Development Services That Ship <span class="accent">SEO-Ready</span> Websites — Not Fixer-Uppers.',
                    'lede' => 'Most agencies hand you a good-looking site, then quietly point you at an SEO team to fix everything they missed. We don\'t. Every site we build ships technically clean, search-optimised, and ready to rank the day it goes live — one team, one package, one bill.',
                    'cta_text' => 'Start Your Project',
                    'cta_url' => '#cta',
                    'image' => 'media/services/web-design/hero.jpg',
                    'badges' => [
                        ['label' => '100/100 Core Web Vitals target'],
                        ['label' => 'Technical SEO baked in, not bolted on'],
                        ['label' => 'Handover with Search Console live'],
                    ],
                ],
            ],
            [
                'key' => 'pain',
                'label' => 'Pain points',
                'sort_order' => 1,
                'data' => [
                    'eyebrow' => 'The Real Problem',
                    'title' => 'Your Website Looks Fine. So Why Isn\'t It Bringing In Business?',
                    'title_html' => 'Your Website Looks Fine. So Why Isn\'t It Bringing In <span class="orange">Business?</span>',
                    'lede' => 'You paid for a site. You paid again for SEO. You\'re still not on page one. That\'s not a budget problem — it\'s a stack problem. Here\'s what\'s usually broken under the hood.',
                    'cards' => [
                        [
                            'num' => '01',
                            'title' => 'The site loads like it\'s 2011',
                            'body' => 'Uncompressed images, bloated themes, cheap shared hosting. Google measured it, users bounced, rankings dropped. 53% of visitors leave when a page takes more than 3 seconds. Yours takes six.',
                            'body_html' => 'Uncompressed images, bloated themes, cheap shared hosting. Google measured it, users bounced, rankings dropped. <strong class="pop">53% of visitors leave</strong> when a page takes more than 3 seconds. Yours takes six.',
                        ],
                        [
                            'num' => '02',
                            'title' => 'SEO was an afterthought',
                            'body' => 'No proper H1s. Missing meta descriptions. No schema. No sitemap that actually reflects the site. Your designer built pretty pages — nobody built them for search.',
                            'body_html' => 'No proper H1s. Missing meta descriptions. No schema. No sitemap that actually reflects the site. Your designer built pretty pages — nobody built them <strong class="pop">for search</strong>.',
                        ],
                        [
                            'num' => '03',
                            'title' => 'Mobile experience is broken',
                            'body' => 'Tap targets too small. Text unreadable. Menu buried. Over 60% of your traffic is mobile — and Google indexes the mobile version first. You\'re being judged on the worst version of your site.',
                            'body_html' => 'Tap targets too small. Text unreadable. Menu buried. <strong class="pop">Over 60% of your traffic is mobile</strong> — and Google indexes the mobile version first. You\'re being judged on the worst version of your site.',
                        ],
                        [
                            'num' => '04',
                            'title' => 'You need a dev for every edit',
                            'body' => 'Change a hero image? Ticket. Update a phone number? Ticket. The CMS is either untouchable or a plugin graveyard. Your team can\'t move fast because the site owns you, not the other way around.',
                            'body_html' => 'Change a hero image? Ticket. Update a phone number? Ticket. The CMS is either untouchable or a plugin graveyard. Your team can\'t move fast because <strong class="pop">the site owns you</strong>, not the other way around.',
                        ],
                        [
                            'num' => '05',
                            'title' => 'Two agencies, one problem',
                            'body' => 'Your web agency says "ask your SEO team". Your SEO team says "ask your web agency". You\'re stuck in the middle paying two retainers to fix the same website twice.',
                            'body_html' => 'Your web agency says "ask your SEO team". Your SEO team says "ask your web agency". You\'re stuck in the middle paying <strong class="pop">two retainers</strong> to fix the same website twice.',
                        ],
                        [
                            'num' => '06',
                            'title' => 'Traffic comes — nothing converts',
                            'body' => 'Weak calls to action. Confusing navigation. No trust signals above the fold. People land, look, and leave. You\'re paying for clicks that go nowhere — because nobody designed for the sale.',
                            'body_html' => 'Weak calls to action. Confusing navigation. No trust signals above the fold. People land, look, and leave. You\'re paying for clicks that go nowhere — because <strong class="pop">nobody designed for the sale</strong>.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'answer',
                'label' => 'The answer',
                'sort_order' => 2,
                'data' => [
                    'eyebrow' => 'One Package. Everything Included.',
                    'title' => 'Custom Web Design and Development Services Built to Rank From Day One.',
                    'title_html' => 'Custom Web Design and Development Services <span class="accent">Built to Rank</span> From Day One.',
                    'lede' => 'Our Web Design and Development Services aren\'t split into a "design phase" and an "SEO fix" months later. We plan the URL structure, keyword targets, schema, and speed budget before anyone opens Figma. By launch day your site is fast, indexed, and already talking to Google in a language it understands.',
                    'lede_html' => 'Our Web Design and Development Services aren\'t split into a "design phase" and an "SEO fix" months later. We plan the URL structure, keyword targets, schema, and speed budget <em>before</em> anyone opens Figma. By launch day your site is fast, indexed, and already talking to Google in a language it understands.',
                    'items' => [
                        [
                            'title' => 'Keyword & SERP research before design',
                            'body' => 'We map what your pages need to say — and what needs to exist as a page — before a wireframe is drawn.',
                        ],
                        [
                            'title' => 'Semantic HTML and clean code',
                            'body' => 'Real H1s, real hierarchy, no div-soup. What Google reads matches what your user sees.',
                        ],
                        [
                            'title' => 'Core Web Vitals target: all green',
                            'body' => 'We optimise images, defer scripts, lazy-load smartly, and ship on hosting that doesn\'t choke under load.',
                        ],
                        [
                            'title' => 'Schema, sitemap, and Search Console — day one',
                            'body' => 'You get keys to a live, indexed, and monitored site. No "we\'ll set that up later."',
                        ],
                    ],
                    'viz' => [
                        'title' => 'PageSpeed Report — After Launch',
                        'badge' => 'Live',
                        'rows' => [
                            ['label' => 'Performance', 'value' => '98', 'good' => true],
                            ['label' => 'Accessibility', 'value' => '100', 'good' => true],
                            ['label' => 'Best Practices', 'value' => '100', 'good' => true],
                            ['label' => 'SEO', 'value' => '100', 'good' => true],
                            ['label' => 'Largest Contentful Paint', 'value' => '1.2 s', 'good' => false],
                            ['label' => 'Cumulative Layout Shift', 'value' => '0.00', 'good' => false],
                        ],
                        'score' => 'A+',
                        'note' => 'Real target we hit on live client launches — before a single link is built.',
                    ],
                ],
            ],
            [
                'key' => 'services',
                'label' => 'Sub-services',
                'sort_order' => 3,
                'data' => [
                    'eyebrow' => 'What We Build',
                    'title' => 'Web Design and Development Services Across Every Platform You\'d Actually Use.',
                    'title_html' => 'Web Design and Development Services Across <span class="orange">Every Platform</span> You\'d Actually Use.',
                    'lede' => 'Pick the stack that fits your business — not the one your agency knows best. We build native on each platform, so you\'re not fighting the tool while you scale.',
                    'cards' => [
                        [
                            'title' => 'WordPress Development Services',
                            'body' => 'Custom themes, block-based editing, and no plugin bloat. Your marketing team ships pages themselves — without breaking anything.',
                            'link_text' => 'Explore Service',
                            'link_url' => '/wordpress-development-services',
                            'icon_key' => 'wordpress',
                            'large' => false,
                        ],
                        [
                            'title' => 'Shopify Development Services',
                            'body' => 'Custom Liquid stores, fast themes, and checkout flows built to convert. We ship Shopify sites that look premium and rank for money keywords.',
                            'link_text' => 'Explore Service',
                            'link_url' => '/shopify-development-services',
                            'icon_key' => 'shopify',
                            'large' => false,
                        ],
                        [
                            'title' => 'AI Chatbot Development Services',
                            'body' => 'Trained on your product, docs, and FAQs. Handles lead capture, support, and booking around the clock — without the awkward canned answers.',
                            'link_text' => 'Explore Service',
                            'link_url' => '/ai-chatbot-development-services',
                            'icon_key' => 'chatbot',
                            'large' => false,
                        ],
                        [
                            'title' => 'Website Redesign Services',
                            'body' => 'Stuck with a site that looks tired, ranks worse than last year, and nobody wants to touch? We rebuild it — keeping every ounce of hard-earned SEO equity, and shipping something you\'ll actually want to send to prospects.',
                            'link_text' => 'Explore Service',
                            'link_url' => '/website-redesign-services',
                            'icon_key' => 'redesign',
                            'large' => true,
                            'tags' => [
                                '301 mapping done right',
                                'No traffic drop-off',
                                'Brand-consistent rebuild',
                                'Fresh CMS, no lock-in',
                            ],
                        ],
                        [
                            'title' => 'CMS Development Services',
                            'body' => 'Headless, hybrid, or classic — we build content systems your team can actually run. Editors get real preview, marketers get real speed, developers get real APIs.',
                            'link_text' => 'Explore Service',
                            'link_url' => '/cms-development-services',
                            'icon_key' => 'cms',
                            'large' => false,
                        ],
                    ],
                ],
            ],
            [
                'key' => 'included',
                'label' => 'What\'s included',
                'sort_order' => 4,
                'data' => [
                    'eyebrow' => 'Included In Every Package',
                    'title' => 'Every Site Ships With The Whole Kit — Design And Technical SEO Together.',
                    'title_html' => 'Every Site Ships With The <span class="accent">Whole Kit</span> — Design And Technical SEO Together.',
                    'lede' => 'You shouldn\'t have to hire three vendors to launch one site. Here\'s what\'s baked into every Web Design and Development Services engagement, at no upsell.',
                    'image' => 'media/services/web-design/included-bg.jpg',
                    'tiles' => [
                        [
                            'title' => 'Custom UI Design',
                            'body' => 'No cookie-cutter templates. Every layout built from scratch to your brand.',
                            'icon_key' => 'ui',
                        ],
                        [
                            'title' => 'Full On-Page SEO',
                            'body' => 'Titles, meta, headings, alt text, internal linking — all done, not just "recommended".',
                            'icon_key' => 'onpage',
                        ],
                        [
                            'title' => 'Core Web Vitals Tuning',
                            'body' => 'LCP under 2.5s, CLS near zero, INP fast. Green scores or we don\'t ship.',
                            'icon_key' => 'vitals',
                        ],
                        [
                            'title' => 'Schema Markup',
                            'body' => 'Organization, Product, FAQ, Article — whatever your pages need to earn rich results.',
                            'icon_key' => 'schema',
                        ],
                        [
                            'title' => 'Mobile-First Build',
                            'body' => 'Designed on a phone, not squashed onto one. Real thumb-zone thinking.',
                            'icon_key' => 'mobile',
                        ],
                        [
                            'title' => 'SSL + Security Headers',
                            'body' => 'HTTPS forced, CSP, HSTS, and hardened logins. Trust signals to Google and users.',
                            'icon_key' => 'security',
                        ],
                        [
                            'title' => 'Analytics & Search Console',
                            'body' => 'GA4, Search Console, and event tracking configured. You see traffic from day one.',
                            'icon_key' => 'analytics',
                        ],
                        [
                            'title' => 'Clean URL Structure',
                            'body' => 'Human-readable, hierarchical, no query-string mess. Easier to rank, easier to share.',
                            'icon_key' => 'urls',
                        ],
                        [
                            'title' => 'SEO-Ready Copy Structure',
                            'body' => 'Content architecture built for search intent, not just what looks nice in a hero.',
                            'icon_key' => 'copy',
                        ],
                        [
                            'title' => 'XML Sitemap + Robots.txt',
                            'body' => 'Configured properly, submitted to Google. Every page crawled, every rule respected.',
                            'icon_key' => 'sitemap',
                        ],
                        [
                            'title' => 'Editable CMS Training',
                            'body' => 'We hand you a Loom walkthrough of the CMS. Your team runs the site from day one.',
                            'icon_key' => 'training',
                        ],
                        [
                            'title' => '30-Day Post-Launch Support',
                            'body' => 'Bug fixes, tweaks, and Google Search Console monitoring — included, not extra.',
                            'icon_key' => 'support',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'process',
                'label' => 'Process',
                'sort_order' => 5,
                'data' => [
                    'eyebrow' => 'How It Works',
                    'title' => 'Four Stages, No Surprises. Here\'s How Our Web Design and Development Services Come Together.',
                    'title_html' => 'Four Stages, No Surprises. Here\'s How Our <span class="orange">Web Design and Development Services</span> Come Together.',
                    'lede' => 'No mystery-box "creative process". You\'ll always know what\'s next, what we need, and when you\'ll see it.',
                    'steps' => [
                        [
                            'num' => '01',
                            'title' => 'Audit & Strategy',
                            'body' => 'We look at your current site, your traffic, and your top three competitors. Then we map the URL structure and target keywords before any pixel gets pushed.',
                        ],
                        [
                            'num' => '02',
                            'title' => 'Design & Copy',
                            'body' => 'Wireframes, then visual design, then SEO-structured copy — reviewed in a single Figma link. One round of feedback per stage, so nothing spirals.',
                        ],
                        [
                            'num' => '03',
                            'title' => 'Build & Optimise',
                            'body' => 'Semantic HTML, image compression, script deferral, schema, sitemap. We test Core Web Vitals daily during build — not once at the end.',
                        ],
                        [
                            'num' => '04',
                            'title' => 'Launch & Handover',
                            'body' => '301 redirects mapped, Search Console configured, GA4 tracking live, CMS training recorded. You get a site — and a system your team can run.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'compare',
                'label' => 'Comparison',
                'sort_order' => 6,
                'data' => [
                    'eyebrow' => 'The Difference',
                    'title' => 'Design Agencies Build Sites. SEO Agencies Fix Them. We Do Both — First Time.',
                    'title_html' => 'Design Agencies Build Sites. SEO Agencies Fix Them. <span class="accent">We Do Both — First Time.</span>',
                    'lede' => 'Here\'s what typically happens after a "successful" launch with a design-only agency — and how our Web Design and Development Services approach compares.',
                    'other' => [
                        'title' => 'Typical Web Agency',
                        'items' => [
                            'Pretty homepage, but H1 says "Welcome to Our Site"',
                            'Images uploaded at 4000px, no compression',
                            'No schema. No sitemap. No robots.txt tweaks.',
                            'Slow CMS, plugin-heavy, needs a dev to edit',
                            'SEO quoted separately, starting at $2K/month',
                            '"Handover" is a WordPress login and radio silence',
                            'Redesign kills your ranking for six months',
                        ],
                    ],
                    'us' => [
                        'tag' => 'KodRank',
                        'title' => 'Web Design and Development Services by KodRank',
                        'items' => [
                            'Every H1 mapped to real target keywords',
                            'All images WebP, responsive, lazy-loaded',
                            'Schema, sitemap, and robots.txt configured on launch',
                            'Fast, editor-friendly CMS your marketers can actually use',
                            'Technical SEO included in the build, not billed on top',
                            'Handover with Loom walkthrough, training, and 30 days support',
                            '301 map preserves — and often lifts — existing rankings',
                        ],
                    ],
                    'stats' => [
                        ['num' => '2.5×', 'label' => 'Avg. Organic Lift Post-Launch', 'white' => false],
                        ['num' => '98+', 'label' => 'PageSpeed Score Target', 'white' => true],
                        ['num' => '6-8', 'label' => 'Weeks From Kickoff to Launch', 'white' => false],
                        ['num' => '1', 'label' => 'Team. One Package. One Bill.', 'white' => true],
                    ],
                ],
            ],
            [
                'key' => 'why',
                'label' => 'Why KodRank',
                'sort_order' => 7,
                'data' => [
                    'eyebrow' => 'Why KodRank',
                    'title' => 'What Makes Our Web Design and Development Services Different.',
                    'title_html' => 'What Makes Our Web Design and Development Services <span class="orange">Different.</span>',
                    'cards' => [
                        [
                            'num' => '01',
                            'title' => 'SEO built in, not glued on',
                            'body' => 'Most agencies treat SEO like a plugin — installed at the end. We plan for it in step one. That\'s why our sites don\'t lose rankings after launch; they gain them.',
                            'body_html' => 'Most agencies treat SEO like <span class="em">a plugin</span> — installed at the end. We plan for it in step one. That\'s why our sites don\'t lose rankings after launch; they gain them.',
                        ],
                        [
                            'num' => '02',
                            'title' => 'One team from strategy to schema',
                            'body' => 'Your designer talks to your developer talks to your SEO strategist — because they\'re all under one roof. No handoffs, no finger-pointing, no gaps.',
                            'body_html' => 'Your designer talks to your developer talks to your SEO strategist — because <span class="em">they\'re all under one roof</span>. No handoffs, no finger-pointing, no gaps.',
                        ],
                        [
                            'num' => '03',
                            'title' => 'You own everything',
                            'body' => 'Code, hosting, CMS, analytics, ad accounts — all in your name. Some agencies hold your website hostage. We hand you the keys.',
                            'body_html' => 'Code, hosting, CMS, analytics, ad accounts — all in <span class="em">your name</span>. Some agencies hold your website hostage. We hand you the keys.',
                        ],
                        [
                            'num' => '04',
                            'title' => 'Real timelines, not "creative buffers"',
                            'body' => 'We ship in 6-8 weeks for most projects, not six months. Speed doesn\'t mean corners cut — it means a tight process and a team that doesn\'t juggle 20 clients.',
                            'body_html' => 'We ship in <span class="em">6-8 weeks</span> for most projects, not six months. Speed doesn\'t mean corners cut — it means a tight process and a team that doesn\'t juggle 20 clients.',
                        ],
                        [
                            'num' => '05',
                            'title' => 'Content that ranks and converts',
                            'body' => 'We write for both the search bot and the buyer. No AI slop, no keyword stuffing — just structured, human copy that earns clicks and closes them.',
                            'body_html' => 'We write for both <span class="em">the search bot and the buyer</span>. No AI slop, no keyword stuffing — just structured, human copy that earns clicks and closes them.',
                        ],
                        [
                            'num' => '06',
                            'title' => 'Post-launch that actually launches',
                            'body' => 'Most agencies vanish on day one. We monitor Search Console for 30 days, catch indexing issues fast, and hand you a report — not a support ticket queue.',
                            'body_html' => 'Most agencies vanish on day one. We monitor <span class="em">Search Console for 30 days</span>, catch indexing issues fast, and hand you a report — not a support ticket queue.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'faq',
                'label' => 'FAQ',
                'sort_order' => 8,
                'data' => [
                    'eyebrow' => 'Common Questions',
                    'title' => 'Straight Answers About Our Web Design and Development Services.',
                    'title_html' => 'Straight Answers About Our <span class="orange">Web Design and Development Services.</span>',
                    'items' => [
                        [
                            'q' => 'Do I really not need a separate SEO agency after launch?',
                            'a' => '<strong>Correct — not for on-page and technical SEO.</strong> Every site we build ships with keyword-mapped content, semantic HTML, schema, sitemaps, Search Console configured, and Core Web Vitals tuned. If you later want off-page work — link building, digital PR, ongoing content publishing — that\'s a separate service. But the site itself is search-ready the day it goes live, without a monthly retainer just to "fix" it.',
                        ],
                        [
                            'q' => 'How long do your Web Design and Development Services take?',
                            'a' => 'Most projects ship in <strong>6-8 weeks</strong> from kickoff. Complex builds — heavy e-commerce, custom integrations, multi-language — can go 10-12. We give a firm timeline at the strategy stage, not a vague range, and we stick to it because the team doesn\'t juggle twenty clients at once.',
                        ],
                        [
                            'q' => 'Which platform will you build my site on?',
                            'a' => 'The one that fits your business — not the one we prefer. We build on <strong>WordPress</strong> for content-heavy sites and marketing teams, <strong>Shopify</strong> for e-commerce, <strong>headless CMS setups</strong> (Sanity, Contentful, Payload) when you need speed and API access, and <strong>custom stacks</strong> when the platform gets in the way. We\'ll recommend the platform in the strategy call and tell you exactly why.',
                        ],
                        [
                            'q' => 'I already have a site. Will a redesign kill my rankings?',
                            'a' => 'Only if you handle the migration badly — which is why so many redesigns hurt SEO. We do a <strong>full crawl and 301 redirect map</strong> before launch, preserve URL structures where they\'re already ranking, keep working H1s and meta data intact, and monitor Search Console daily for the first two weeks. On most redesigns we actually <strong>lift</strong> rankings — because the new site is faster and better structured than the old one.',
                        ],
                        [
                            'q' => 'What\'s included in the price? Any surprise fees?',
                            'a' => 'The price you sign for is the price you pay. Custom design, development, content structure, on-page SEO, technical SEO, schema, analytics, Search Console setup, CMS training, and 30 days post-launch support — <strong>all included</strong>. Third-party costs (hosting, premium plugins if you want them, stock imagery) are always disclosed upfront and billed at cost. No mystery invoices at the end.',
                        ],
                        [
                            'q' => 'Can my team edit the site without breaking it?',
                            'a' => 'Yes — that\'s the whole point. We build with <strong>editor-friendly CMS blocks</strong>, guarded fields, and preview modes so your marketing team can update headlines, swap images, add case studies, and publish blog posts without touching code. On handover you get a Loom walkthrough and a written editorial guide. If anything\'s confusing, we\'re a message away for 30 days.',
                        ],
                        [
                            'q' => 'Do you offer ongoing SEO or maintenance after launch?',
                            'a' => 'Yes, but it\'s optional. Once your Web Design and Development Services package is delivered, the site is fully SEO-ready and technically sound — you\'re not forced into a retainer. If you want <strong>ongoing content, link building, ranking tracking, or maintenance</strong>, we offer separate plans. But if you\'d rather run it yourself with the setup we hand you, that works too.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'cta',
                'label' => 'Final CTA',
                'sort_order' => 9,
                'data' => [
                    'eyebrow' => 'Ready When You Are',
                    'title' => 'Get A Website That\'s Fast, Beautiful, And Already Ranking.',
                    'title_html' => 'Get A Website That\'s Fast, Beautiful, And <span class="accent">Already Ranking.</span>',
                    'body' => 'Skip the two-agency runaround. Tell us what you\'re building — we\'ll come back with a scope, a timeline, and a fixed price. No sales calls unless you ask for one.',
                    'image' => 'media/services/web-design/cta-bg.webp',
                    'primary' => [
                        'text' => 'Get A Free Proposal',
                        'url' => '#contact',
                    ],
                    'secondary' => [
                        'text' => 'Book A 20-Min Call',
                        'url' => '#contact',
                    ],
                ],
            ],
        ];

        foreach ($sections as $section) {
            ServicePageSection::query()->create([
                'service_page_id' => $page->id,
                'key' => $section['key'],
                'label' => $section['label'],
                'sort_order' => $section['sort_order'],
                'data' => $section['data'],
            ]);
        }

        ServicePage::forgetCache($page->slug);
        ServicePage::forgetNavCache();
    }
}
