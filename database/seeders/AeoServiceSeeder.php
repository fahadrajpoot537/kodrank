<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class AeoServiceSeeder extends Seeder
{
    public function run(): void
    {
        $parent = ServicePage::query()->where('slug', 'digital-marketing-services')->first();

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'aeo-services'],
            [
                'parent_id' => $parent?->id,
                'name' => 'AEO Services',
                'is_active' => true,
                'sort_order' => 4,
                'seo' => [
                    'theme' => 'seo-service',
                    'seo_title' => 'AEO Services | Answer Engine Optimization | KodRank',
                    'seo_description' => 'KodRank\'s AEO services rebuild your content, schema, and authority so ChatGPT, Google AI Overviews, Perplexity, Gemini, and Copilot cite your brand inside the answer — not just link to you.',
                    'og_title' => 'AEO Services | Answer Engine Optimization | KodRank',
                    'og_description' => 'KodRank\'s AEO services rebuild your content, schema, and authority so AI answer engines cite your brand inside the answer — not just link to you.',
                    'og_image' => 'media/services/aeo/aeo-services-answer-engine-optimization-diagram.webp',
                    'keywords' => 'AEO services, answer engine optimization, AI Overviews, ChatGPT citations, Perplexity, Gemini, Copilot, schema markup, KodRank',
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
                    'eyebrow' => 'AEO Services',
                    'breadcrumb' => [
                        ['label' => 'Home', 'url' => '/'],
                        ['label' => 'Services', 'url' => '#'],
                        ['label' => 'AEO Services', 'url' => ''],
                    ],
                    'title' => 'AEO Services That Put You Inside The Answer — Not Just On The Results Page',
                    'title_html' => 'AEO Services That Put You <span class="accent">Inside The Answer</span> — Not Just On The Results Page',
                    'lede' => 'Someone typed a question into Google or ChatGPT this morning that only your business could answer well — and an AI system answered it using a competitor\'s page instead. That\'s the exact gap KodRank\'s AEO services are built to close: rebuilding your content, schema, and authority so the next answer names you, not them.',
                    'cta_text' => 'Get A Free AI Visibility Audit',
                    'cta_url' => '#contact',
                    'badges' => [
                        ['num' => '60%+', 'label' => 'Searches Now End With Zero Clicks'],
                        ['num' => '4', 'label' => 'AI Engines We Optimize For'],
                        ['num' => '90 Days', 'label' => 'To First Measurable AI Citations'],
                    ],
                    'image' => 'media/services/aeo/aeo-services-answer-engine-optimization-diagram.webp',
                    'image_alt' => 'Answer engine optimization diagram for AEO services',
                    'visual_aria_label' => 'Answer engine optimization diagram for AEO services',
                ],
            ],
            [
                'key' => 'trust',
                'label' => 'Trust bar',
                'sort_order' => 1,
                'data' => [
                    'label' => 'AEO Services Built For',
                    'logos' => [
                        'Google AI Overviews',
                        'ChatGPT',
                        'Perplexity',
                        'Gemini',
                        'Copilot',
                    ],
                ],
            ],
            [
                'key' => 'problem',
                'label' => 'Problem',
                'sort_order' => 2,
                'data' => [
                    'eyebrow' => 'The Problem',
                    'title' => 'The Gap Only AEO Services Can Close',
                    'title_html' => 'The Gap Only AEO Services Can Close',
                    'lede' => 'Your rankings can be perfect and your traffic can still fall — because the person never made it to a results page at all. This is exactly where AEO services pick up where traditional SEO stops.',
                    'cards' => [
                        [
                            'title' => 'Google Answers The Question Before They Click',
                            'body' => 'AI Overviews pull an answer from someone else\'s page and put it above your listing. The searcher gets what they needed and never scrolls down to you.',
                            'icon_key' => 'ai',
                        ],
                        [
                            'title' => 'ChatGPT Recommends A Competitor, Not You',
                            'body' => 'Ask an AI assistant who\'s best for what you sell, and it names three brands. If yours isn\'t structured for machines to parse, it\'s never one of the three.',
                            'icon_key' => 'silence',
                        ],
                        [
                            'title' => 'You Have No Idea If You\'re Even Cited',
                            'body' => 'Rank trackers show blue-link positions. They don\'t show whether Perplexity mentioned your brand this week, or which of your pages ChatGPT is quoting from.',
                            'icon_key' => 'vendors',
                        ],
                        [
                            'title' => 'Content Built For Keywords, Not For Questions',
                            'body' => 'Old-school SEO copy repeats a phrase for density. AI answer engines are resolving a real, often multi-part question — and skip content that doesn\'t directly answer it.',
                            'icon_key' => 'content',
                        ],
                        [
                            'title' => 'Schema Is Missing, Broken, Or Never Updated',
                            'body' => 'Structured data is how machines read your page instead of guessing at it. Without clean FAQ, Product, and Organization schema, most AI systems quietly pass you by.',
                            'icon_key' => 'schema',
                        ],
                        [
                            'title' => 'Your Agency Isn\'t Really Doing AEO Services',
                            'body' => 'Plenty of "AI SEO" is a rebrand with no new methodology behind it. If your team can\'t explain how they track AI citations, they aren\'t actually delivering AEO services — just old SEO with a new label.',
                            'icon_key' => 'revenue',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'services',
                'label' => 'Core AEO Services',
                'sort_order' => 3,
                'data' => [
                    'eyebrow' => 'Core AEO Services',
                    'title' => 'Six Moving Parts That Make Up Our AEO Services',
                    'title_html' => 'Six Moving Parts That Make Up Our AEO Services',
                    'lede' => 'AEO isn\'t one tactic bolted onto old SEO — it\'s a full stack of audit, structure, authority, and measurement work, built specifically for how AI systems choose what to cite.',
                    'cards' => [
                        [
                            'title' => 'AI Search Visibility Audit',
                            'body' => 'We run your brand and your top competitors through ChatGPT, AI Overviews, Perplexity, and Copilot to see exactly who\'s getting cited today, and why you aren\'t.',
                            'icon_key' => 'audit',
                            'num' => '01',
                        ],
                        [
                            'title' => 'Schema & Structured Data',
                            'body' => 'FAQ, HowTo, Product, and Organization markup, built and validated so answer engines can parse your pages with confidence instead of skipping them.',
                            'icon_key' => 'schema',
                            'num' => '02',
                        ],
                        [
                            'title' => 'Answer-First Content Engineering',
                            'body' => 'We rebuild pages so the direct answer sits in the first two sentences, with the supporting depth AI models pull from right underneath it.',
                            'icon_key' => 'content',
                            'num' => '03',
                        ],
                        [
                            'title' => 'Citation & Entity Building',
                            'body' => 'The mentions, profiles, and links that build the authority signal AI systems check before naming a brand in an answer — earned, not bought.',
                            'icon_key' => 'digitalpr',
                            'num' => '04',
                        ],
                        [
                            'title' => 'Featured Snippet & Voice Optimization',
                            'body' => 'Capturing the position-zero answer box and the phrasing voice assistants read aloud — often the same content, formatted for two different engines.',
                            'icon_key' => 'snippet',
                            'num' => '05',
                        ],
                        [
                            'title' => 'AI Visibility Monitoring & Reporting',
                            'body' => 'A monthly report on where you\'re being cited, by which engine, and how that visibility connects to actual inquiries — not just a ranking screenshot.',
                            'icon_key' => 'report',
                            'num' => '06',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'process',
                'label' => 'Process',
                'sort_order' => 4,
                'data' => [
                    'eyebrow' => 'How It Works',
                    'title' => 'Our AEO Services Follow One Repeatable Process',
                    'title_html' => 'Our AEO Services Follow One Repeatable Process',
                    'lede' => 'No mystery, no black box — every AEO engagement runs through the same four stages, in order, with a report at the end of each one.',
                    'steps' => [
                        [
                            'num' => '01',
                            'title' => 'Audit Your AI Footprint',
                            'body' => 'We test your brand across every major AI engine and map exactly where you\'re cited, where a competitor is, and where nobody\'s showing up at all.',
                        ],
                        [
                            'num' => '02',
                            'title' => 'Structure Content & Schema',
                            'body' => 'Priority pages get rebuilt answer-first and wrapped in the schema that makes them legible to machines, not just search engine crawlers.',
                        ],
                        [
                            'num' => '03',
                            'title' => 'Build Authority Signals',
                            'body' => 'Citations, mentions, and entity data get built out so AI systems have a reason to trust your brand as the source worth quoting.',
                        ],
                        [
                            'num' => '04',
                            'title' => 'Monitor & Iterate',
                            'body' => 'We track citation share monthly across every engine and adjust the plan as AI systems change how they pull and rank answers.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'compare',
                'label' => 'Comparison',
                'sort_order' => 5,
                'data' => [
                    'eyebrow' => 'Old Playbook vs. New Playbook',
                    'title' => 'SEO Alone Wasn\'t Built For This Moment. AEO Services Were.',
                    'title_html' => 'SEO Alone Wasn\'t Built For This Moment. AEO Services Were.',
                    'lede' => 'We\'re not telling you to drop SEO — technical and on-page fundamentals still matter. We\'re saying a second, AI-specific layer of work now decides whether you\'re visible at all.',
                    'section_class' => 'sec-ink',
                    'pro_badge' => 'KodRank AEO',
                    'columns' => [
                        [
                            'title' => 'Traditional SEO Alone',
                            'variant' => 'muted',
                            'items' => [
                                ['mark' => 'x', 'text' => 'Optimizes for a spot on a results page a person has to scroll to'],
                                ['mark' => 'x', 'text' => 'Tracks keyword rank position, not AI citation share'],
                                ['mark' => 'x', 'text' => 'Content written for crawlers, not the way AI models parse answers'],
                                ['mark' => 'x', 'text' => 'Schema treated as an afterthought, if it\'s used at all'],
                                ['mark' => 'x', 'text' => 'Reporting stops at rankings and organic sessions'],
                            ],
                        ],
                        [
                            'title' => 'KodRank\'s AEO Services',
                            'variant' => 'pro',
                            'items' => [
                                ['mark' => 'v', 'text' => 'Optimizes for the actual answer an AI system shows a searcher'],
                                ['mark' => 'v', 'text' => 'Tracks citations across ChatGPT, Perplexity, AI Overviews, and Copilot'],
                                ['mark' => 'v', 'text' => 'Content structured answer-first, built for how models extract meaning'],
                                ['mark' => 'v', 'text' => 'FAQ, HowTo, Product, and Organization schema built and validated'],
                                ['mark' => 'v', 'text' => 'Monthly AI visibility report tied to real inquiries, not vanity metrics'],
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
                    'eyebrow' => '',
                    'title' => '',
                    'lede' => '',
                    'compact' => true,
                    'items' => [
                        ['value' => '60%+', 'label' => 'Of Searches End Without A Click', 'signal' => true],
                        ['value' => '4', 'label' => 'Major AI Engines We Track Citations Across', 'signal' => false],
                        ['value' => '1 In 2', 'label' => 'Google Results Now Show An AI-Generated Answer', 'signal' => true],
                        ['value' => 'Monthly', 'label' => 'AI Visibility Reporting, Not A One-Time Audit', 'signal' => false],
                    ],
                ],
            ],
            [
                'key' => 'testimonials',
                'label' => 'Testimonials',
                'sort_order' => 7,
                'data' => [
                    'eyebrow' => 'Client Results',
                    'title' => 'What Happens When AEO Services Actually Work',
                    'title_html' => 'What Happens When AEO Services Actually Work',
                    'items' => [
                        [
                            'quote' => 'Within a quarter we started showing up inside ChatGPT answers for the exact questions our sales team used to have to explain from scratch. That alone changed our first calls.',
                            'name' => 'Rachel M.',
                            'role' => 'VP Marketing, B2B SaaS',
                            'avatar' => 'RM',
                            'stars' => '★★★★★',
                        ],
                        [
                            'quote' => 'Our rankings were already decent. What we didn\'t have was any idea whether AI Overviews even knew we existed. KodRank showed us the gap and closed most of it in two months.',
                            'name' => 'David K.',
                            'role' => 'Founder, DTC Ecommerce Brand',
                            'avatar' => 'DK',
                            'stars' => '★★★★★',
                        ],
                        [
                            'quote' => 'The monthly AI citation report is the first SEO deliverable our CFO actually reads. It ties straight to leads instead of a ranking number nobody outside marketing understood.',
                            'name' => 'Sofia L.',
                            'role' => 'Head Of Growth, FinTech',
                            'avatar' => 'SL',
                            'stars' => '★★★★★',
                        ],
                        [
                            'quote' => 'We\'d been told our SEO agency "handled AI stuff too." They didn\'t. KodRank\'s audit found broken schema on every product page — fixing it alone moved the needle.',
                            'name' => 'James T.',
                            'role' => 'Ecommerce Director, Retail',
                            'avatar' => 'JT',
                            'stars' => '★★★★★',
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
                    'title' => 'AEO Services, Explained Without The Jargon',
                    'title_html' => 'AEO Services, Explained Without The Jargon',
                    'items' => [
                        [
                            'q' => 'What is AEO, exactly?',
                            'a' => 'AEO stands for Answer Engine Optimization. It\'s the discipline of structuring your content, data, and authority signals so AI systems like ChatGPT, Google AI Overviews, and Perplexity can understand your page well enough to cite it directly inside a generated answer — instead of just linking to it.',
                        ],
                        [
                            'q' => 'How is AEO different from regular SEO?',
                            'a' => 'SEO earns you a position on a results page a person has to click through. AEO earns you a mention inside the answer itself, before any click happens. The technical standards are different too — clean schema, answer-first structure, and machine-readable clarity matter more than keyword density ever did.',
                        ],
                        [
                            'q' => 'Is AEO the same thing as GEO?',
                            'a' => 'They overlap heavily. GEO, Generative Engine Optimization, is usually used for the same work — getting cited inside AI-generated answers. Most agencies, including us, treat them as two names for one discipline, so if you hear either term used for this kind of work, it\'s the same service.',
                        ],
                        [
                            'q' => 'How do you measure success if there\'s no click to track?',
                            'a' => 'We track citation share directly — how often and where your brand appears inside AI Overviews, ChatGPT responses, and Perplexity answers for your priority questions — alongside branded search lift and direct inquiries, since visibility without a click can still drive a person straight to you by name.',
                        ],
                        [
                            'q' => 'How long until we see AI citations?',
                            'a' => 'Schema fixes and technical cleanup can show up within a few weeks. Meaningful citation share, where AI systems consistently name your brand, usually builds over 90 days as content and authority signals compound. Anyone promising it overnight isn\'t describing how these systems actually work.',
                        ],
                        [
                            'q' => 'Do we still need traditional SEO if we\'re doing AEO?',
                            'a' => 'Yes. AI answer engines still rely on the same technical foundation — crawlability, site speed, clean structure — that traditional SEO builds. AEO is a layer added on top, not a replacement, which is why we build both into the same engagement rather than treating them separately.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'cta',
                'label' => 'CTA band',
                'sort_order' => 9,
                'data' => [
                    'title' => 'See What Our AEO Services Would Fix First.',
                    'title_html' => 'See What Our AEO Services Would Fix <span class="accent">First.</span>',
                    'body' => 'We\'ll run your brand through ChatGPT, Google AI Overviews, and Perplexity, show you exactly where you stand, and tell you what an AEO services engagement would actually fix first.',
                    'cta_text' => 'Get My Free AI Visibility Audit',
                    'cta_url' => '#contact',
                    'image' => 'media/services/aeo/aeo-services-ai-visibility-audit-diagram.webp',
                    'image_alt' => 'AI visibility audit diagram for AEO services',
                ],
            ],
            [
                'key' => 'contact',
                'label' => 'Contact',
                'sort_order' => 10,
                'data' => [
                    'eyebrow' => 'Get In Touch',
                    'title' => 'Tell Us What You Sell. We\'ll Show You Where AEO Services Would Help First.',
                    'lede' => 'Fill this out and within one business day you\'ll get a personal note from a strategist — with three specific things we found in your AI visibility audit, not a form-letter pitch.',
                    'meta' => [
                        ['label' => 'Email', 'value' => 'info@kodrank.com', 'icon_key' => 'email'],
                        ['label' => 'Phone', 'value' => '+92 305 9202732', 'icon_key' => 'phone'],
                        ['label' => 'Response Time', 'value' => 'Within 1 Business Day', 'icon_key' => 'clock'],
                    ],
                    'fields' => [
                        'first_name_label' => 'First Name',
                        'last_name_label' => 'Last Name',
                        'email_label' => 'Work Email',
                        'phone_label' => 'Phone (Optional)',
                        'company_label' => 'Company',
                        'service_label' => 'What Do You Need Most?',
                        'message_label' => 'What\'s The Main Goal?',
                    ],
                    'service_options' => [
                        'Free AI Visibility Audit',
                        'Schema & Structured Data',
                        'Answer-First Content Engineering',
                        'Citation & Entity Building',
                        'Full AEO Services Package',
                        'Not Sure — Need Advice',
                    ],
                    'default_service' => 'Full AEO Services Package',
                    'submit_text' => 'Send & Get My AI Visibility Audit',
                    'success_message' => 'Thanks — we\'ve got it. Expect a reply within one business day.',
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
