<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class DigitalMarketingServiceSeeder extends Seeder
{
    public function run(): void
    {
        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'digital-marketing-services'],
            [
                'parent_id' => null,
                'name' => 'Digital Marketing Services',
                'is_active' => true,
                'sort_order' => 0,
                'seo' => [
                    'seo_title' => 'Digital Marketing Services That Grow Revenue - KodRank',
                    'seo_description' => 'KodRank delivers digital marketing services built around a single outcome — pipeline. On-page, off-page, technical, AEO, GEO, and industry-specific SEO under one roof, one strategist, one monthly report.',
                    'og_title' => 'Digital Marketing Services That Grow Revenue - KodRank',
                    'og_description' => 'One team. One strategy. Full-stack digital marketing services engineered to move rankings, traffic, and revenue — every single month.',
                    'og_image' => 'media/services/digital-marketing/hero.png',
                    'keywords' => 'digital marketing services, SEO services, AEO, GEO, on-page SEO, technical SEO, B2B SEO, SaaS SEO, KodRank',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $sections = [
            [
                'key' => 'hero',
                'label' => 'Hero',
                'sort_order' => 0,
                'data' => [
                    'breadcrumb' => [
                        ['label' => 'Home', 'url' => '/'],
                        ['label' => 'Services', 'url' => '#'],
                        ['label' => 'Digital Marketing', 'url' => ''],
                    ],
                    'title' => 'Digital marketing services built around',
                    'title_accent' => 'one metric — pipeline.',
                    'title_html' => 'Digital marketing services built around <span class="accent">one metric — pipeline.</span>',
                    'lede' => 'Most agencies sell you dashboards. We sell you customers. KodRank runs full-stack digital marketing services — on-page, off-page, technical, AEO, GEO, and industry-specific SEO — under one team, one strategy, and one monthly number that actually moves.',
                    'cta_text' => 'Get A Free Marketing Proposal',
                    'cta_url' => '#contact',
                    'badges' => [
                        ['num' => '380+', 'label' => 'Sites Ranked'],
                        ['num' => '4.9/5', 'label' => 'Client Rating'],
                        ['num' => '11yrs', 'label' => 'In Search'],
                        ['num' => '27', 'label' => 'Industries Served'],
                    ],
                    'image' => 'media/services/digital-marketing/hero.png',
                    'image_alt' => 'Digital marketing services dashboard illustrating SEO, SEM, keywords, and analytics',
                    'visual_aria_label' => 'Digital marketing services dashboard with SEO, SEM, and analytics icons',
                ],
            ],
            [
                'key' => 'trust',
                'label' => 'Trust bar',
                'sort_order' => 1,
                'data' => [
                    'label' => 'Trusted by growth teams at',
                    'logos' => [
                        'Northline',
                        'Verityx',
                        'Palladio',
                        'Kavu Co.',
                        'Meridian',
                        'Bright & Blue',
                    ],
                ],
            ],
            [
                'key' => 'problem',
                'label' => 'Problem',
                'sort_order' => 2,
                'data' => [
                    'eyebrow' => 'The Problem',
                    'title' => "You didn't hire a marketing agency for",
                    'title_accent' => 'pretty reports.',
                    'title_html' => 'You didn\'t hire a marketing agency for <span class="hl">pretty reports.</span>',
                    'lede' => 'You hired one because traffic stalled, rankings slipped, and the budget stopped converting. If any of these sound familiar, you\'re not the problem — the setup is.',
                    'cards' => [
                        [
                            'title' => 'Six months in, still no leads',
                            'body' => 'Traffic is up but the sales team is quiet. Your "digital marketing services" retainer is producing charts, not customers.',
                            'icon_key' => 'clock',
                        ],
                        [
                            'title' => 'Three vendors, zero ownership',
                            'body' => 'SEO here, PPC there, content somewhere else. Nobody talks. Everyone blames the other guy when numbers dip.',
                            'icon_key' => 'vendors',
                        ],
                        [
                            'title' => 'AI search is eating your traffic',
                            'body' => 'ChatGPT, Perplexity, Google\'s AI Overviews now answer questions before users click. If you\'re not optimized for AEO and GEO, you\'re invisible.',
                            'icon_key' => 'ai',
                        ],
                        [
                            'title' => 'Rankings up, revenue flat',
                            'body' => 'Position 3 for a keyword nobody buys from. Your agency chases metrics, not money. Traffic quality is the silent killer.',
                            'icon_key' => 'revenue',
                        ],
                        [
                            'title' => 'Radio silence between reports',
                            'body' => 'You email on Tuesday. You hear back Friday. Meanwhile, Google shipped an update, a competitor overtook you, and nothing changed on your site.',
                            'icon_key' => 'silence',
                        ],
                        [
                            'title' => 'Generic strategy for a specific business',
                            'body' => 'Your SaaS gets the same "checklist" a plumber gets. B2B, eCommerce, and Shopify each need a different playbook — most agencies own one.',
                            'icon_key' => 'generic',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'services',
                'label' => 'Services',
                'sort_order' => 3,
                'data' => [
                    'eyebrow' => 'What We Do',
                    'title' => 'Full-stack digital marketing services, not a menu of tricks.',
                    'title_html' => 'Full-stack digital marketing services, <span class="hl">not a menu of tricks.</span>',
                    'lede' => 'Every service below is delivered in-house by a specialist who does it every day — not a generalist juggling twelve accounts. Pick a single service or run the whole engine.',
                    'group_label' => 'Core SEO Disciplines',
                    'cards' => [
                        [
                            'title' => 'On-Page SEO',
                            'body' => 'Title tags, meta descriptions, headings, internal links, schema, and content quality — rebuilt page by page so search engines and humans both know exactly what each URL is for.',
                            'link_text' => 'Optimize My Pages',
                            'link_url' => '#contact',
                            'icon_key' => 'onpage',
                        ],
                        [
                            'title' => 'Off-Page SEO',
                            'body' => 'Editorial links from real sites your audience actually reads. Digital PR, guest placements, and citation building — no PBNs, no comment spam, no shortcuts that break in six months.',
                            'link_text' => 'Build My Authority',
                            'link_url' => '#contact',
                            'icon_key' => 'offpage',
                        ],
                        [
                            'title' => 'Technical SEO',
                            'body' => 'Core Web Vitals, crawl budgets, indexation, canonicals, structured data, JavaScript rendering, and site architecture — the plumbing that decides whether your content ever gets a fair shot.',
                            'link_text' => 'Fix My Foundation',
                            'link_url' => '#contact',
                            'icon_key' => 'technical',
                        ],
                        [
                            'title' => 'Answer Engine Optimization (AEO)',
                            'body' => 'Optimize for how ChatGPT, Perplexity, and Google\'s AI Overviews pull answers. Structured content, clean entity relationships, and citation-worthy phrasing so AI names your brand — not your competitor.',
                            'link_text' => 'Show Up In AI Answers',
                            'link_url' => '#contact',
                            'icon_key' => 'aeo',
                        ],
                        [
                            'title' => 'Generative Engine Optimization (GEO)',
                            'body' => 'The next-gen playbook for generative search surfaces. We shape your content, schema, and knowledge graph so large language models recommend you when they generate answers — not just when they crawl.',
                            'link_text' => 'Rank In Generative Search',
                            'link_url' => '#contact',
                            'icon_key' => 'geo',
                        ],
                        [
                            'title' => 'Keyword Research',
                            'body' => 'We don\'t chase volume — we chase intent. Every target keyword gets scored on business value, buyer stage, and rankability so you invest content dollars where they close deals, not where they trend.',
                            'link_text' => 'Find Buyer Keywords',
                            'link_url' => '#contact',
                            'icon_key' => 'keyword',
                        ],
                        [
                            'title' => 'Monthly SEO Services',
                            'body' => 'Predictable retainers, not project chaos. A monthly cadence of audits, content, links, and technical work — with one strategist you can actually reach and one report that says what changed and why.',
                            'link_text' => 'Start Monthly Growth',
                            'link_url' => '/monthly-seo-services',
                            'icon_key' => 'monthly',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'playbook',
                'label' => 'Playbook',
                'sort_order' => 4,
                'data' => [
                    'eyebrow' => 'Platform & Industry SEO',
                    'title' => 'Different business? Different playbook.',
                    'title_html' => 'Different business? <span class="hl">Different playbook.</span>',
                    'lede' => 'A B2B SaaS ranking for "workflow automation" needs almost nothing the same as a Shopify store ranking for "leather boots." We staff and specialize accordingly — pick the track that fits your business.',
                    'cards' => [
                        [
                            'title' => 'B2B SEO Services',
                            'body' => 'Long sales cycles, decision committees, technical buyers. We map content to every stage — from "what is" to "how to buy" — so pipeline shows up in your CRM, not just your dashboard.',
                            'bullets' => [
                                'Intent-mapped content architecture',
                                'Buyer-committee keyword targeting',
                                'Sales & SEO alignment loops',
                                'LinkedIn + organic co-strategy',
                            ],
                            'link_text' => 'Explore B2B SEO',
                            'link_url' => '/b2b-seo-services/',
                            'icon_key' => 'b2b',
                        ],
                        [
                            'title' => 'SaaS SEO Services',
                            'body' => 'Product-led growth needs product-led content. We build programmatic pages, comparison content, and integration hubs that turn organic traffic into trials, and trials into MRR.',
                            'bullets' => [
                                'Programmatic SEO for feature pages',
                                '"Alternative to" & comparison funnels',
                                'Integration + template hubs',
                                'Trial-to-signup CRO built-in',
                            ],
                            'link_text' => 'Explore SaaS SEO',
                            'link_url' => '/saas-seo-services/',
                            'icon_key' => 'saas',
                        ],
                        [
                            'title' => 'eCommerce SEO Services',
                            'body' => 'Category pages, product pages, filters, and structured data — engineered to rank for commercial-intent queries and convert the click into a checkout. Zero fluff, all revenue.',
                            'bullets' => [
                                'Category + collection page optimization',
                                'Product schema & rich results',
                                'Faceted navigation done right',
                                'Content-driven top-of-funnel',
                            ],
                            'link_text' => 'Explore eCommerce SEO',
                            'link_url' => '/ecommerce-seo-services/',
                            'icon_key' => 'ecommerce',
                        ],
                        [
                            'title' => 'WordPress SEO Services',
                            'body' => 'Bloated themes, plugin overload, ancient page builders — the reason your WordPress site loads slow and ranks slower. We rebuild performance, structure, and schema so it competes.',
                            'bullets' => [
                                'Core Web Vitals fixed for real',
                                'Plugin audit + consolidation',
                                'Custom schema without bloat',
                                'Elementor / Gutenberg / classic',
                            ],
                            'link_text' => 'Explore WordPress SEO',
                            'link_url' => '/wordpress-seo-services/',
                            'icon_key' => 'wordpress',
                        ],
                        [
                            'title' => 'Shopify SEO Services',
                            'body' => 'Shopify\'s defaults get you 40% of the way there. We handle the rest — duplicate URL cleanup, collection SEO, blog architecture, and Liquid tweaks that speed everything up.',
                            'bullets' => [
                                'Duplicate URL & canonical cleanup',
                                'Collection page revenue targeting',
                                'Speed & Liquid optimization',
                                'App bloat audit',
                            ],
                            'link_text' => 'Explore Shopify SEO',
                            'link_url' => '/shopify-seo-services/',
                            'icon_key' => 'shopify',
                        ],
                        [
                            'title' => 'White Label SEO Services',
                            'body' => 'For agencies, freelancers, and consultancies who want to ship SEO without hiring a team. Fully branded reports, dedicated Slack channels, and delivery on your timeline — under your logo.',
                            'bullets' => [
                                'Fully white-labeled deliverables',
                                'Dedicated account manager per partner',
                                'Shared Slack + weekly syncs',
                                'Scale up or down monthly',
                            ],
                            'link_text' => 'Explore White Label',
                            'link_url' => '/white-label-seo-services/',
                            'icon_key' => 'whitelabel',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'process',
                'label' => 'Process',
                'sort_order' => 5,
                'data' => [
                    'eyebrow' => 'How We Work',
                    'title' => 'A five-step process built to show numbers by day 60.',
                    'title_html' => 'A five-step process built to <span class="hl">show numbers by day 60.</span>',
                    'lede' => 'No 90-day "onboarding" that produces nothing. We audit fast, prioritize sharper, and start shipping in week two. Here\'s exactly what happens when you sign on.',
                    'steps' => [
                        [
                            'num' => '01',
                            'title' => 'Discovery & Audit',
                            'body' => 'Deep-dive into your site, analytics, competitors, and current keyword footprint. We surface the leaks and the low-hanging wins in the same document.',
                        ],
                        [
                            'num' => '02',
                            'title' => 'Strategy & Roadmap',
                            'body' => 'One page. Priorities ranked by ROI, not by effort. You know exactly what we\'re doing in weeks 1–4, 5–8, and 9–12 — and why.',
                        ],
                        [
                            'num' => '03',
                            'title' => 'Technical Foundation',
                            'body' => 'We fix crawl, index, speed, and schema before we spend a dollar on content or links. No point pouring water into a leaky bucket.',
                        ],
                        [
                            'num' => '04',
                            'title' => 'Content & Authority',
                            'body' => 'Published pages that match search intent, structured for AEO/GEO, and backed by editorial links from sites your buyers actually visit.',
                        ],
                        [
                            'num' => '05',
                            'title' => 'Report, Refine, Repeat',
                            'body' => 'Monthly report you can read in five minutes. A working session where we decide what to double down on and what to kill. Then we do it again.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'stats',
                'label' => 'Stats',
                'sort_order' => 6,
                'data' => [
                    'eyebrow' => 'Numbers, Not Adjectives',
                    'title' => 'What our digital marketing services move in the first 6 months.',
                    'title_html' => 'What our digital marketing services move in <span class="hl">the first 6 months.</span>',
                    'lede' => 'Averages across active retainer clients from the last 18 months. Not a cherry-picked case study. Real medians from real accounts.',
                    'items' => [
                        ['value' => '+186%', 'label' => 'Organic Traffic Growth', 'signal' => true],
                        ['value' => '73%', 'label' => 'Keywords In Top 10', 'signal' => false],
                        ['value' => '3.4x', 'label' => 'Qualified Lead Volume', 'signal' => true],
                        ['value' => '47%', 'label' => 'Lower Cost Per Lead', 'signal' => false],
                        ['value' => '92%', 'label' => 'Client Retention Rate', 'signal' => true],
                    ],
                ],
            ],
            [
                'key' => 'platforms',
                'label' => 'Comparison',
                'sort_order' => 7,
                'data' => [
                    'eyebrow' => 'The Difference',
                    'title' => 'Typical agency vs. KodRank digital marketing services.',
                    'title_html' => 'Typical agency vs. <span class="hl">KodRank digital marketing services.</span>',
                    'lede' => 'You\'ve probably worked with an agency before. If it went well, you wouldn\'t be here. Here\'s exactly what changes when you switch.',
                    'columns' => [
                        [
                            'title' => 'Typical Agency',
                            'variant' => 'muted',
                            'items' => [
                                ['mark' => 'x', 'text' => 'Assigns you to a junior account manager who reads a script'],
                                ['mark' => 'x', 'text' => 'Sends a 40-page PDF report you never open'],
                                ['mark' => 'x', 'text' => 'Chases keyword rankings without checking search intent'],
                                ['mark' => 'x', 'text' => 'Ignores AI search, still optimizes like it\'s 2019'],
                                ['mark' => 'x', 'text' => 'Ships one blog post a month and calls it "content strategy"'],
                                ['mark' => 'x', 'text' => 'Bills the same rate for a plumber and a SaaS platform'],
                                ['mark' => 'x', 'text' => 'Blames the algorithm when results dip'],
                            ],
                        ],
                        [
                            'title' => 'KodRank',
                            'variant' => 'pro',
                            'items' => [
                                ['mark' => 'v', 'text' => 'A senior strategist owns your account from day one'],
                                ['mark' => 'v', 'text' => 'A five-minute monthly report anyone in the room can act on'],
                                ['mark' => 'v', 'text' => 'Every keyword is scored on business value, not just volume'],
                                ['mark' => 'v', 'text' => 'AEO and GEO baked into content from day one'],
                                ['mark' => 'v', 'text' => 'Multi-format content: pages, videos, comparison hubs, tools'],
                                ['mark' => 'v', 'text' => 'Specialized playbooks for B2B, SaaS, eCommerce, WordPress, Shopify'],
                                ['mark' => 'v', 'text' => 'Own the outcome — we tell you what we broke and how we fixed it'],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'key' => 'why_us',
                'label' => 'Why us',
                'sort_order' => 8,
                'data' => [
                    'eyebrow' => 'Why KodRank',
                    'title' => 'Fewer accounts, deeper work, bigger outcomes.',
                    'title_html' => 'Fewer accounts, deeper work, <span class="hl">bigger outcomes.</span>',
                    'lede' => 'We cap every strategist at eight clients. That\'s not marketing — that\'s math. It\'s the only way to actually think about your business instead of processing it.',
                    'cards' => [
                        [
                            'title' => 'Senior strategists, not agencies-in-training',
                            'body' => 'Every account is led by someone with 8+ years shipping SEO. No pass-throughs to a junior. No "let me ask the senior team" delays.',
                            'bullets' => [
                                'Direct Slack access to your strategist',
                                'Bi-weekly working sessions',
                                'Same-day answers to real questions',
                            ],
                            'icon_key' => 'senior',
                        ],
                        [
                            'title' => 'Revenue-tied reporting',
                            'body' => 'We report on the metrics your CFO cares about — pipeline, MQLs, revenue attribution. Rankings and traffic are context, not the point.',
                            'bullets' => [
                                'Attribution built into every report',
                                'Lead quality scored, not just counted',
                                'Kill/scale calls made monthly',
                            ],
                            'icon_key' => 'revenue',
                        ],
                        [
                            'title' => 'Built for the AI search era',
                            'body' => 'We optimize for ChatGPT, Perplexity, Gemini, and Google\'s AI Overviews with the same seriousness we optimize for classic search. Because half the queries never see a blue link anymore.',
                            'bullets' => [
                                'Entity + knowledge graph optimization',
                                'Citation-worthy answer formatting',
                                'AEO and GEO on every content brief',
                            ],
                            'icon_key' => 'ai',
                        ],
                        [
                            'title' => 'Transparent pricing, no surprise invoices',
                            'body' => 'Fixed monthly retainer. Scope on paper. Extras quoted before they start. You\'ll never open an invoice and wonder what the $2,400 line item is.',
                            'bullets' => [
                                'Fixed monthly investment',
                                'Pause or scale month-to-month after 90 days',
                                'No agency lock-in contracts',
                            ],
                            'icon_key' => 'pricing',
                        ],
                        [
                            'title' => 'One team, one throat to grab',
                            'body' => 'Strategy, content, links, technical, and design under one roof. When something breaks, you have one number to call — and one person accountable for fixing it.',
                            'bullets' => [
                                'In-house content, links, and dev',
                                'Single point of contact',
                                'Nothing outsourced to random freelancers',
                            ],
                            'icon_key' => 'team',
                        ],
                        [
                            'title' => 'Industry-specific playbooks',
                            'body' => 'B2B SaaS, DTC eCommerce, professional services, Shopify, WordPress — each has a battle-tested playbook we\'ve refined over years. We don\'t reinvent every time.',
                            'bullets' => [
                                'Specialized teams per industry',
                                'Proven templates & frameworks',
                                'Faster time-to-first-win',
                            ],
                            'icon_key' => 'playbooks',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'testimonials',
                'label' => 'Testimonials',
                'sort_order' => 9,
                'data' => [
                    'eyebrow' => 'What Clients Say',
                    'title' => 'The kind of results that make CFOs stop asking questions.',
                    'title_html' => 'The kind of results that make <span class="hl">CFOs stop asking questions.</span>',
                    'lede' => 'A few honest words from teams who switched to KodRank after being burned by generic digital marketing services elsewhere.',
                    'items' => [
                        [
                            'quote' => 'We came off a 14-month retainer with a big-name agency and got more done in our first 60 days with KodRank than the previous year. The difference is you can tell they actually read the site before opening their mouth.',
                            'name' => 'Sarah M.',
                            'role' => 'Head of Growth, B2B SaaS',
                            'avatar' => 'SM',
                            'stars' => '★★★★★',
                        ],
                        [
                            'quote' => 'Rankings are nice. Revenue is nicer. Our Shopify store crossed seven figures in year one after switching to KodRank — and the checkout traffic isn\'t tire-kickers. It\'s people who typed in exactly what we sell.',
                            'name' => 'James R.',
                            'role' => 'Founder, DTC eCommerce Brand',
                            'avatar' => 'JR',
                            'stars' => '★★★★★',
                        ],
                        [
                            'quote' => 'I\'ve used their white-label SEO service under my own agency\'s brand for two years. My clients think I have a 20-person SEO team. I don\'t tell them otherwise. Delivery is on time, deliverables are actually good, and I sleep better.',
                            'name' => 'Mira K.',
                            'role' => 'Owner, Marketing Consultancy',
                            'avatar' => 'MK',
                            'stars' => '★★★★★',
                        ],
                        [
                            'quote' => 'The AEO work alone was worth the retainer. We started showing up as the cited source inside ChatGPT and Perplexity answers for our category. Inbound demo requests went up 60% in a quarter with no extra spend.',
                            'name' => 'David L.',
                            'role' => 'VP Marketing, SaaS Platform',
                            'avatar' => 'DL',
                            'stars' => '★★★★★',
                        ],
                        [
                            'quote' => 'Straightforward people. They told us upfront which of our goals were realistic in six months and which needed a year. Every other agency told us we\'d rank number one by month three. KodRank told the truth — and then delivered.',
                            'name' => 'Amina T.',
                            'role' => 'CMO, Professional Services',
                            'avatar' => 'AT',
                            'stars' => '★★★★★',
                        ],
                        [
                            'quote' => 'Our WordPress site was a mess of plugins and slow pages. Their technical team stripped it clean, kept the design, and Core Web Vitals went from failing to green in eight weeks. Organic traffic followed the next month.',
                            'name' => 'Ryan P.',
                            'role' => 'Marketing Director, B2B Manufacturer',
                            'avatar' => 'RP',
                            'stars' => '★★★★★',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'cta',
                'label' => 'CTA band',
                'sort_order' => 10,
                'data' => [
                    'eyebrow' => 'Ready When You Are',
                    'title' => 'Let\'s build a digital marketing engine that actually pays for itself.',
                    'title_html' => 'Let\'s build a digital marketing engine <span class="accent">that actually pays for itself.</span>',
                    'body' => 'Book a free 30-minute strategy call. We\'ll pull your site apart live, show you the three biggest wins we see, and tell you if we\'re the right fit — or point you to someone who is.',
                    'cta_text' => 'Book A Free Strategy Call',
                    'cta_url' => '#contact',
                ],
            ],
            [
                'key' => 'faq',
                'label' => 'FAQ',
                'sort_order' => 11,
                'data' => [
                    'eyebrow' => 'Common Questions',
                    'title' => 'Everything you\'d ask on a first call, answered here first.',
                    'title_html' => 'Everything you\'d ask on a first call, <span class="hl">answered here first.</span>',
                    'lede' => 'If your question isn\'t on the list, message us — same-day response, no gatekeepers.',
                    'items' => [
                        [
                            'q' => 'How long before I see results from your digital marketing services?',
                            'a' => 'Honest answer: technical wins and quick-hit on-page fixes show up in weeks 4–8. Meaningful ranking and traffic growth starts around month 3. Compounding revenue impact — the kind you can point to in a board meeting — usually shows around months 5–7. Any agency promising page-one rankings in 30 days is either lying or targeting keywords nobody searches. We\'d rather set the right expectation and beat it than the reverse.',
                        ],
                        [
                            'q' => 'What\'s the difference between SEO, AEO, and GEO?',
                            'a' => 'SEO optimizes for the classic Google search results page. AEO — Answer Engine Optimization — optimizes for direct-answer surfaces like Google\'s AI Overviews, featured snippets, and voice assistants. GEO — Generative Engine Optimization — is the newest layer, focused on making sure large language models (ChatGPT, Perplexity, Gemini, Claude) recommend and cite your brand when they generate answers. All three matter now, and we build for all three on the same content — because half your future traffic will never see a blue link.',
                        ],
                        [
                            'q' => 'Do you work with businesses outside the US?',
                            'a' => 'Yes — we\'ve served clients across North America, the UK, Europe, Australia, and the Middle East. Our monthly SEO services work in any English-language market. For multilingual campaigns, we coordinate with in-country content partners while keeping strategy, technical, and reporting centralized with us.',
                        ],
                        [
                            'q' => 'Can I hire you for just one service — say, only technical SEO?',
                            'a' => 'Absolutely. Not every business needs the full stack. A common starting point is a one-time technical SEO fix, a keyword research sprint, or an on-page overhaul. Once you see how we work, most clients graduate to a monthly retainer — but there\'s zero pressure. Every service is available standalone or bundled.',
                        ],
                        [
                            'q' => 'How is white-label SEO different from your other services?',
                            'a' => 'Same delivery quality, different wrapper. White-label clients get fully branded reports, a dedicated account manager who shows up as part of their team, and delivery timelines that match their client agreements. Your clients see your brand. We stay invisible. It\'s built for agencies, consultancies, and freelancers who want to offer SEO without hiring a team.',
                        ],
                        [
                            'q' => 'What does a monthly retainer actually include?',
                            'a' => 'Every retainer includes a dedicated senior strategist, monthly technical monitoring, on-page optimization, keyword research and content briefs, link acquisition, AEO/GEO integration, and a monthly report with a working session. Content production, development hours, and PR outreach are scoped by plan tier — we\'ll quote yours based on goals, not a "package" you\'re forced into.',
                        ],
                        [
                            'q' => 'Are there long-term contracts I need to sign?',
                            'a' => 'No. We ask for a 90-day initial commitment so the technical foundation and first content wave have time to land. After that it\'s month-to-month. If we\'re not earning the retainer, you should be free to walk — and if we are, you won\'t want to.',
                        ],
                        [
                            'q' => 'How do you measure success beyond rankings?',
                            'a' => 'Rankings and organic sessions are inputs, not outcomes. We measure success in qualified leads, sales opportunities, revenue attribution, and cost per acquisition. Every reporting dashboard is customized to the metrics your leadership actually asks about — because "we ranked #4 for a keyword" is not an answer to "did marketing pay for itself this month."',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'contact',
                'label' => 'Contact',
                'sort_order' => 12,
                'data' => [
                    'eyebrow' => 'Get In Touch',
                    'title' => 'Tell us the goal. We\'ll tell you the plan.',
                    'lede' => 'Fill this out. Within one business day you\'ll get a personalized note from a senior strategist — not a bot, not a form-letter — with three things we noticed about your site and how we\'d approach them.',
                    'meta' => [
                        ['label' => 'Email', 'value' => 'info@kodrank.com', 'icon_key' => 'email'],
                        ['label' => 'Phone', 'value' => '+92 305 9202732', 'icon_key' => 'phone'],
                        ['label' => 'Response Time', 'value' => 'Within 1 business day', 'icon_key' => 'clock'],
                    ],
                    'fields' => [
                        'first_name_label' => 'First Name',
                        'last_name_label' => 'Last Name',
                        'email_label' => 'Work Email',
                        'phone_label' => 'Phone (Optional)',
                        'company_label' => 'Company',
                        'service_label' => 'I\'m Interested In',
                        'message_label' => 'What\'s the main goal?',
                        'message_placeholder' => 'A sentence or two on where you\'re stuck and what you want to change.',
                    ],
                    'service_options' => [
                        'Full Digital Marketing Services',
                        'On-Page SEO',
                        'Off-Page SEO',
                        'Technical SEO',
                        'AEO / GEO',
                        'Keyword Research',
                        'B2B SEO Services',
                        'SaaS SEO Services',
                        'eCommerce SEO Services',
                        'WordPress SEO Services',
                        'Shopify SEO Services',
                        'White Label SEO Services',
                        'Monthly SEO Retainer',
                        'Not Sure — Need Advice',
                    ],
                    'submit_text' => 'Send & Get A Personal Reply',
                ],
            ],
        ];

        foreach ($sections as $section) {
            ServicePageSection::query()->updateOrCreate(
                [
                    'service_page_id' => $page->id,
                    'key' => $section['key'],
                ],
                [
                    'label' => $section['label'],
                    'sort_order' => $section['sort_order'],
                    'data' => $section['data'],
                ]
            );
        }

        ServicePage::forgetCache($page->slug);
    }
}
