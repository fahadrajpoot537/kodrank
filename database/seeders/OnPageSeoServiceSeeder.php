<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class OnPageSeoServiceSeeder extends Seeder
{
    public function run(): void
    {
        $parent = ServicePage::query()->where('slug', 'digital-marketing-services')->first();

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'on-page-seo-services'],
            [
                'parent_id' => $parent?->id,
                'name' => 'On-Page SEO Services',
                'is_active' => true,
                'sort_order' => 0,
                'seo' => [
                    'theme' => 'seo-service',
                    'seo_title' => 'On-Page SEO Services That Get Your Pages Found & Chosen - KodRank',
                    'seo_description' => 'KodRank\'s on-page SEO services rebuild every signal Google and AI search read on your pages — content, title tags, headings, internal links, schema and speed — so the right buyers land, stay, and convert.',
                    'og_title' => 'On-Page SEO Services That Get Your Pages Found & Chosen - KodRank',
                    'og_description' => 'You\'ve got the pages and the offer. What you don\'t have is a spot on page one. KodRank rebuilds every on-page ranking signal so your best pages get found — and chosen.',
                    'og_image' => 'media/services/on-page-seo/on-page-seo-services-agency-banner.jpg',
                    'keywords' => 'on-page SEO services, on page SEO, content optimisation, title tags, meta descriptions, heading structure, internal linking, schema markup, Core Web Vitals, KodRank',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
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
                    'eyebrow' => 'On-Page SEO for pages that should already rank',
                    'breadcrumb' => [
                        ['label' => 'Home', 'url' => '/'],
                        ['label' => 'Services', 'url' => '#'],
                        ['label' => 'On-Page SEO Services', 'url' => ''],
                    ],
                    'title' => 'On Page SEO Services That Get Your Best Pages Found — And Chosen',
                    'title_accent' => 'Found — And Chosen',
                    'title_html' => 'On Page SEO Services That Get Your Best Pages <span class="hl">Found — And Chosen</span>',
                    'lede' => 'You\'ve got the pages. You\'ve got the offer. What you don\'t have is a spot on page one. KodRank\'s on page SEO services rebuild every signal Google and AI search read on the page — content, structure, tags and speed — so the right buyers land, stay, and convert.',
                    'cta_text' => 'Get a Free Page Audit',
                    'cta_url' => '#contact',
                    'badges' => [
                        ['num' => '200+', 'label' => 'Pages Re-optimised'],
                        ['num' => '14', 'label' => 'Ranking Signals Tuned'],
                        ['num' => '100%', 'label' => 'Human-Written Copy'],
                    ],
                    'image' => 'media/services/on-page-seo/on-page-seo-services-agency-banner.jpg',
                    'image_alt' => 'On-page SEO services specialist optimizing a website, surrounded by SEO icons for keywords, rankings and content',
                    'visual_aria_label' => 'On-page SEO services specialist optimizing a website, surrounded by SEO icons for keywords, rankings and content',
                ],
            ],
            [
                'key' => 'problem',
                'label' => 'Problem',
                'sort_order' => 1,
                'data' => [
                    'eyebrow' => 'The Problem',
                    'title' => 'Good pages shouldn\'t be invisible.',
                    'title_html' => 'Good pages shouldn\'t be <span class="hl">invisible</span>.',
                    'lede' => 'If you\'re pouring budget into a site that traffic ignores, the issue usually isn\'t your product — it\'s what search engines can (and can\'t) read on the page. These are the leaks we find most.',
                    'cards' => [
                        [
                            'title' => 'Stuck below page one',
                            'body' => 'Your content is genuinely good, yet it never breaks past position 11–30 where almost nobody clicks.',
                            'icon_key' => 'search',
                        ],
                        [
                            'title' => 'Thin or off-intent content',
                            'body' => 'Pages answer half the question. Google sends visitors to the competitor who covered the whole thing.',
                            'icon_key' => 'content',
                        ],
                        [
                            'title' => 'Duplicate & identical tags',
                            'body' => 'Repeated title tags and meta descriptions confuse crawlers and quietly cap what your whole site can rank for.',
                            'icon_key' => 'tags',
                        ],
                        [
                            'title' => 'Traffic that never converts',
                            'body' => 'People arrive, then bounce — because the page structure, speed and message don\'t match what they searched for.',
                            'icon_key' => 'traffic',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'services',
                'label' => 'Services',
                'sort_order' => 2,
                'data' => [
                    'eyebrow' => 'On-page SEO, explained',
                    'title' => 'What Are On Page SEO Services?',
                    'title_html' => 'What Are On Page SEO Services?',
                    'lede' => 'On page SEO services are the hands-on work of optimising everything on your own pages so search engines — and now AI answer engines — understand them and rank them for the terms your customers actually search.',
                    'lede_html' => 'On page SEO services are the hands-on work of optimising everything <em>on</em> your own pages so search engines — and now AI answer engines — understand them and rank them for the terms your customers actually search.',
                    'body' => 'That means the words on the page, the title tags and meta descriptions, your heading structure, internal links, image alt text, structured data and how fast the page loads. Unlike backlinks, every one of these signals is fully in your control — which is exactly why on-page work is the most predictable way to move rankings.',
                    'body_html' => 'That means the words on the page, the <strong>title tags and meta descriptions</strong>, your heading structure, internal links, image alt text, structured data and how fast the page loads. Unlike backlinks, <span class="hl">every one of these signals is fully in your control</span> — which is exactly why on-page work is the most predictable way to move rankings.',
                    'note' => 'Get it right and you build the foundation that makes every other marketing dollar — ads, content, links — work harder.',
                    'list_title' => 'On-page SEO covers, in plain terms:',
                    'list_lede' => 'The stuff a search engine reads before it decides where you rank.',
                    'list' => [
                        'Content that matches real search intent, not just keywords',
                        'Titles & meta descriptions written to earn the click',
                        'Clean H1–H3 structure crawlers can follow',
                        'Internal links that pass authority to money pages',
                        'Schema & Core Web Vitals that Google rewards',
                    ],
                ],
            ],
            [
                'key' => 'included',
                'label' => 'What\'s included',
                'sort_order' => 3,
                'data' => [
                    'eyebrow' => 'What\'s Included',
                    'title' => 'Everything our on-page SEO services tune on the page.',
                    'title_html' => 'Everything our on-page SEO services <span class="hl">tune on the page</span>.',
                    'lede' => 'No vague retainers. Each engagement covers the on-page elements that actually decide rankings — audited, fixed, and re-checked against the same surface AI search reads to pick who it cites.',
                    'cards' => [
                        [
                            'title' => 'Keyword & intent research',
                            'body' => 'We map every page to the exact terms — and the intent behind them — that your buyers type, so you rank for searches that convert, not vanity phrases.',
                            'icon_key' => 'keyword',
                        ],
                        [
                            'title' => 'Content optimisation',
                            'body' => 'We rewrite, expand and re-structure thin pages until they fully answer the query — human-written, genuinely useful, never keyword-stuffed.',
                            'icon_key' => 'content',
                        ],
                        [
                            'title' => 'Title tags & meta descriptions',
                            'body' => 'Unique, click-worthy titles and descriptions on every page — the difference between showing up and getting chosen in the results.',
                            'icon_key' => 'tags',
                        ],
                        [
                            'title' => 'Heading & structure fixes',
                            'body' => 'A clean, logical H1–H3 hierarchy so both readers and crawlers instantly understand what each page is about.',
                            'icon_key' => 'structure',
                        ],
                        [
                            'title' => 'Internal linking',
                            'body' => 'Strategic links that guide visitors deeper and funnel ranking authority toward the pages that make you money.',
                            'icon_key' => 'links',
                        ],
                        [
                            'title' => 'Image & media optimisation',
                            'body' => 'Compressed, correctly-sized images with descriptive alt text — faster loads and an extra path into search visibility.',
                            'icon_key' => 'image',
                        ],
                        [
                            'title' => 'Schema & structured data',
                            'body' => 'Markup that helps you win rich results and gives AI engines the structured context they need to quote your page.',
                            'icon_key' => 'schema',
                        ],
                        [
                            'title' => 'Core Web Vitals & speed',
                            'body' => 'We fix the page-experience signals — load speed, stability, responsiveness — that quietly hold rankings and conversions back.',
                            'icon_key' => 'speed',
                        ],
                        [
                            'title' => 'Reporting you can read',
                            'body' => 'Clear before-and-after tracking on rankings, traffic and conversions — tied to revenue, not jargon.',
                            'icon_key' => 'report',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'process',
                'label' => 'Process',
                'sort_order' => 4,
                'data' => [
                    'eyebrow' => 'How it works',
                    'title' => 'How our on-page SEO services actually run.',
                    'title_html' => 'How our on-page SEO services <span class="hl">actually run</span>.',
                    'lede' => 'A tight, four-step loop — so you always know what\'s happening, what changed, and what it moved.',
                    'steps' => [
                        [
                            'num' => '01',
                            'title' => 'Audit every page',
                            'body' => 'We crawl your site, benchmark it against the pages already ranking, and pinpoint exactly which on-page signals are holding you back.',
                        ],
                        [
                            'num' => '02',
                            'title' => 'Prioritise by impact',
                            'body' => 'You get a plain-English roadmap sorted by the fixes that\'ll move rankings and revenue fastest — not a 200-item to-do dump.',
                        ],
                        [
                            'num' => '03',
                            'title' => 'Optimise & ship',
                            'body' => 'Our writers and SEOs rework content, tags, structure and speed — you approve every change before it goes live.',
                        ],
                        [
                            'num' => '04',
                            'title' => 'Measure & compound',
                            'body' => 'We track movement, refine what\'s working, and keep optimising — because on-page gains build on each other over time.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'compare',
                'label' => 'Comparison',
                'sort_order' => 5,
                'data' => [
                    'eyebrow' => 'Why most on-page work falls flat',
                    'title' => 'Checkbox SEO vs. on-page done right.',
                    'title_html' => 'Checkbox SEO vs. <span class="hl">on-page done right</span>.',
                    'lede' => 'Plenty of providers "optimise" a page by dropping keywords into tags and calling it done. Here\'s the difference that actually shows up in your rankings.',
                    'columns' => [
                        [
                            'title' => 'Typical "On-Page" Package',
                            'subtitle' => 'Boxes ticked, needle unmoved',
                            'variant' => 'muted',
                            'items' => [
                                ['mark' => 'x', 'text' => 'Keywords stuffed into tags, no real content work'],
                                ['mark' => 'x', 'text' => 'Same template title on dozens of pages'],
                                ['mark' => 'x', 'text' => 'Ignores search intent and page experience'],
                                ['mark' => 'x', 'text' => 'AI-spun copy that reads like nobody wrote it'],
                                ['mark' => 'x', 'text' => 'Reports full of metrics, empty on meaning'],
                            ],
                        ],
                        [
                            'title' => 'KodRank On Page SEO Services',
                            'subtitle' => 'Every signal earning its place',
                            'variant' => 'pro',
                            'items' => [
                                ['mark' => 'v', 'text' => 'Content rewritten to fully answer the query'],
                                ['mark' => 'v', 'text' => 'Unique, click-earning title on every page'],
                                ['mark' => 'v', 'text' => 'Built around intent, speed and structure'],
                                ['mark' => 'v', 'text' => 'Human-written copy your readers actually trust'],
                                ['mark' => 'v', 'text' => 'Reporting tied to traffic, leads and revenue'],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'key' => 'stats',
                'label' => 'Stats',
                'sort_order' => 6,
                'data' => [
                    'eyebrow' => 'Why on-page pays off',
                    'title' => 'The pages you already own are your cheapest growth.',
                    'title_html' => 'The pages you already own are your <span class="hl">cheapest growth</span>.',
                    'items' => [
                        ['value' => '68%', 'label' => 'of online journeys start with a search engine', 'signal' => true],
                        ['value' => '<1%', 'label' => 'of searchers click through to page two', 'signal' => false],
                        ['value' => '2–4 months', 'label' => 'for competitive pages to settle higher', 'signal' => false],
                        ['value' => '100%', 'label' => 'of on-page signals are in your control', 'signal' => true],
                    ],
                ],
            ],
            [
                'key' => 'why_us',
                'label' => 'Why us',
                'sort_order' => 7,
                'data' => [
                    'eyebrow' => 'Why KodRank',
                    'title' => 'On-page SEO built by people who also build the site.',
                    'title_html' => 'On-page SEO built by people who <span class="hl">also build the site</span>.',
                    'lede' => 'We\'re a web development and SEO team — so nothing gets lost between "the SEO recommended it" and "the developer shipped it." It\'s all us.',
                    'cards' => [
                        [
                            'title' => 'Devs and SEOs, one team',
                            'body' => 'Recommendations don\'t sit in a PDF. We implement schema, speed and structure fixes directly — correctly, the first time.',
                            'icon_key' => 'team',
                        ],
                        [
                            'title' => 'Written by humans, on purpose',
                            'body' => 'Every word is written and edited by real writers with subject knowledge — the kind of content Google and readers keep rewarding.',
                            'icon_key' => 'human',
                        ],
                        [
                            'title' => 'Ranked and readable',
                            'body' => 'We optimise for search without wrecking the experience — so pages rank higher and turn visitors into enquiries.',
                            'icon_key' => 'readable',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'faq',
                'label' => 'FAQ',
                'sort_order' => 8,
                'data' => [
                    'eyebrow' => 'Questions, answered',
                    'title' => 'On page SEO services — the common questions.',
                    'title_html' => 'On page SEO services — <span class="hl">the common questions</span>.',
                    'items' => [
                        [
                            'q' => 'What are on page SEO services, exactly?',
                            'a' => 'They\'re the work of optimising everything on your own pages — content, title tags, meta descriptions, headings, internal links, images, structured data and page speed — so search engines understand your pages and rank them for the searches your customers make. Everything on the page, tuned to earn and keep a top position.',
                        ],
                        [
                            'q' => 'How long before I see results?',
                            'a' => 'Some pages improve within a few weeks of re-optimisation. Competitive terms usually take two to four months to settle, then keep climbing. Because on-page fixes compound, the gains tend to hold and build rather than fade the moment you stop.',
                        ],
                        [
                            'q' => 'What\'s the difference between on-page and off-page SEO?',
                            'a' => 'On-page SEO is everything on your site — content, structure, tags, speed, internal links. Off-page SEO is signals from other sites, mainly backlinks and mentions. On-page is fully in your control and is the right place to start, because it builds the foundation that makes any off-page effort pay off.',
                        ],
                        [
                            'q' => 'Do you rewrite my content or just tweak the tags?',
                            'a' => 'Both, where it\'s warranted. We tune tags and structure on every page, and we rewrite or expand content when a page is thin, off-intent or missing the depth it needs to rank. You approve every change before it ships — nothing goes live behind your back.',
                        ],
                        [
                            'q' => 'Will the content read like it was written by a human?',
                            'a' => 'Yes — that\'s the point. Real writers with subject knowledge craft and edit every page. We optimise for search without draining the personality out of your copy, so it ranks well and still sounds like your brand.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'cta',
                'label' => 'CTA band',
                'sort_order' => 9,
                'data' => [
                    'eyebrow' => 'Ready when you are',
                    'title' => 'Let\'s find the rankings your pages are leaving on the table.',
                    'title_html' => 'Let\'s find the rankings your pages are <span class="accent">leaving on the table</span>.',
                    'body' => 'Send us your URL and we\'ll run a free on-page audit — the exact fixes, prioritised by what\'ll move rankings and revenue first. No obligation, no jargon.',
                    'cta_text' => 'Get My Free Page Audit',
                    'cta_url' => '#contact',
                    'secondary_text' => 'Review the Deliverables',
                    'secondary_url' => '#included',
                ],
            ],
            [
                'key' => 'contact',
                'label' => 'Contact',
                'sort_order' => 10,
                'data' => [
                    'eyebrow' => 'Start here',
                    'title' => 'Tell us where you want to rank.',
                    'lede' => 'Share a little about your site and goals. We\'ll come back with a plain-English read on your biggest on-page opportunities — usually within one business day.',
                    'meta' => [
                        ['label' => 'Email', 'value' => 'info@kodrank.com', 'icon_key' => 'email'],
                        ['label' => 'Phone', 'value' => '+92 305 9202732', 'icon_key' => 'phone'],
                        ['label' => 'Response Time', 'value' => 'Within one business day', 'icon_key' => 'clock'],
                    ],
                    'fields' => [
                        'first_name_label' => 'First Name',
                        'last_name_label' => 'Last Name',
                        'email_label' => 'Work Email',
                        'phone_label' => 'Phone (Optional)',
                        'company_label' => 'Company',
                        'website_label' => 'Website URL',
                        'service_label' => 'I\'m Interested In',
                        'message_label' => 'What\'s Not Ranking?',
                        'message_placeholder' => 'Tell us which pages or keywords matter most...',
                    ],
                    'service_options' => [
                        'On-Page SEO Services',
                        'Off-Page SEO Services',
                        'Technical SEO Services',
                        'Full Digital Marketing Services',
                        'Not Sure — Need Advice',
                    ],
                    'default_service' => 'On-Page SEO Services',
                    'submit_text' => 'Get My Free Audit',
                    'success_message' => 'Thanks — we\'ll be in touch within one business day.',
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
    }
}
