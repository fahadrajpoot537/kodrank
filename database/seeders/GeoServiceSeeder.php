<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class GeoServiceSeeder extends Seeder
{
    public function run(): void
    {
        $parent = ServicePage::query()->where('slug', 'digital-marketing-services')->first();

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'geo-services'],
            [
                'parent_id' => $parent?->id,
                'name' => 'GEO Services',
                'is_active' => true,
                'sort_order' => 3,
                'seo' => [
                    'theme' => 'seo-service',
                    'seo_title' => 'AI Search & GEO Services - Get Cited by ChatGPT, Gemini & AI Overviews | KodRank',
                    'seo_description' => 'Your customers are asking ChatGPT and Gemini before they ever open Google. KodRank\'s GEO services get your brand cited, recommended, and chosen — not just ranked.',
                    'og_title' => 'AI Search & GEO Services - Get Cited by ChatGPT, Gemini & AI Overviews | KodRank',
                    'og_description' => 'Your customers are asking ChatGPT and Gemini before they ever open Google. KodRank\'s GEO services get your brand cited, recommended, and chosen — not just ranked.',
                    'og_image' => 'media/services/geo/geo-services-ai-search-visibility-hero-kodrank.webp',
                    'keywords' => 'GEO services, generative engine optimization, AI search visibility, ChatGPT citations, Gemini, Perplexity, Google AI Overviews, KodRank',
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
                    'eyebrow' => 'GEO SERVICES & AI SEARCH VISIBILITY',
                    'breadcrumb' => [
                        ['label' => 'Home', 'url' => '/'],
                        ['label' => 'Services', 'url' => '#'],
                        ['label' => 'GEO Services', 'url' => ''],
                    ],
                    'title' => 'Rank #1 on Google. Invisible on ChatGPT. Our GEO services fix that.',
                    'title_accent' => 'GEO services',
                    'title_html' => 'Rank #1 on Google. Invisible on ChatGPT. Our <span class="hl">GEO services</span> fix that.',
                    'lede' => 'KodRank\'s GEO services (Generative Engine Optimization) get your brand cited inside ChatGPT, Gemini, Perplexity, and Google AI Overviews — the AI search visibility your current SEO agency was never built to deliver. Nearly half of your buyers now start their research inside an AI answer before they ever type into Google, and most brands never get named there.',
                    'cta_text' => 'Get My Free AI Visibility Audit',
                    'cta_url' => '#contact',
                    'secondary_text' => 'See why this is happening',
                    'secondary_url' => '#problem',
                    'badges' => [
                        ['num' => '27%', 'label' => 'avg. conversion rate on AI-referred traffic'],
                        ['num' => '~50%', 'label' => 'of buyers now research with AI first'],
                        ['num' => '0', 'label' => 'mentions is where most brands start'],
                    ],
                    'image' => 'media/services/geo/geo-services-ai-search-visibility-hero-kodrank.webp',
                    'image_alt' => 'GEO services and AI search visibility network illustration',
                    'visual_aria_label' => 'GEO services and AI search visibility network illustration',
                ],
            ],
            [
                'key' => 'problem',
                'label' => 'Problem',
                'sort_order' => 1,
                'data' => [
                    'eyebrow' => 'THE PROBLEM',
                    'title' => 'This is probably why you\'re looking into GEO services.',
                    'title_html' => 'This is probably why you\'re looking into GEO services.',
                    'lede' => 'You didn\'t come looking for another SEO pitch. Something felt off — a lead who "found someone else on ChatGPT," a competitor showing up in an AI answer where you should be. This is exactly what GEO services are built to fix. If any of this sounds familiar, you\'re not imagining it.',
                    'cards' => [
                        [
                            'title' => 'ChatGPT recommends everyone except you',
                            'body' => 'You type the exact question your customers ask. It names three competitors — confidently, with sources — and never mentions you once. That\'s not a fluke. It\'s what happens when a model can\'t find, understand, or trust your site enough to cite it.',
                            'icon_key' => 'ai',
                        ],
                        [
                            'title' => 'You have no idea if you\'re invisible',
                            'body' => 'Google Analytics doesn\'t show you what ChatGPT said about you yesterday. Most businesses find out they\'re missing from AI answers by accident — a client mentions it in passing, and by then, they\'ve already picked someone else.',
                            'icon_key' => 'silence',
                        ],
                        [
                            'title' => 'Your agency is still selling last decade\'s SEO',
                            'body' => 'Keyword lists. Backlink counts. A monthly rankings screenshot. None of it explains why a model chose to cite a competitor instead of you. You\'re paying for a report card on a test that stopped counting.',
                            'icon_key' => 'vendors',
                        ],
                        [
                            'title' => 'The leads that reach you already cost more',
                            'body' => 'Every buyer who doesn\'t find you inside an AI answer builds their shortlist without you. By the time they land on your site, they\'ve already ruled you out once — and you\'re fighting to win back a decision that was made somewhere you weren\'t in the room.',
                            'icon_key' => 'revenue',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'stats',
                'label' => 'Stats',
                'sort_order' => 2,
                'data' => [
                    'eyebrow' => 'WHY GEO SERVICES MATTER NOW',
                    'title' => 'Search stopped being a list of blue links.',
                    'title_html' => 'Search stopped being a list of blue links.',
                    'lede' => 'Buyers used to click through ten results and compare. Now they ask one question and get one confident answer, with a short list of brands attached. GEO services exist because that list is where deals get won or lost — if you\'re not on it, the sale is often over before your website ever loads.',
                    'image' => 'media/services/geo/ai-search-visibility-brand-network-geo-services.webp',
                    'image_alt' => 'AI network connecting brands, search, and audiences illustration',
                    'items' => [
                        ['value' => '~50%', 'label' => 'of buyers now use AI tools somewhere in how they research and choose a business', 'signal' => true],
                        ['value' => '27%', 'label' => 'average conversion rate on AI-referred traffic, well above typical organic search', 'signal' => false],
                        ['value' => 'Most', 'label' => 'brands asked about their own category get zero mentions in a ChatGPT answer', 'signal' => true],
                        ['value' => '3–6', 'label' => 'months for AI visibility to build and start compounding once the work begins', 'signal' => false],
                    ],
                ],
            ],
            [
                'key' => 'included',
                'label' => 'What\'s included',
                'sort_order' => 3,
                'data' => [
                    'eyebrow' => 'WHAT\'S INCLUDED IN OUR GEO SERVICES',
                    'title' => 'Everything our GEO services do to get you cited, not just crawled.',
                    'title_html' => 'Everything our <span class="hl">GEO services</span> do to get you cited, not just crawled.',
                    'lede' => 'GEO services aren\'t a switch you flip. It\'s rebuilding your brand\'s footprint so every system a model trusts — your site, your schema, your press mentions, your reviews — tells the same clear story about who you are.',
                    'cards' => [
                        [
                            'title' => 'AI Visibility Audit',
                            'body' => 'The starting point of every GEO services engagement: we ask ChatGPT, Gemini, Perplexity, and Google AI Overviews the same questions your buyers do, and show you exactly where you appear, where you\'re missing, and who\'s getting cited instead.',
                            'icon_key' => 'audit',
                        ],
                        [
                            'title' => 'Entity & Topic Mapping',
                            'body' => 'We map the exact topics, questions, and entities your brand needs to own, so models learn to associate your name with the category before a competitor\'s.',
                            'icon_key' => 'keyword',
                        ],
                        [
                            'title' => 'Content Restructuring',
                            'body' => 'We rewrite your key pages so the answer sits in the first two lines, not buried under marketing copy — the format a model can actually lift and quote.',
                            'icon_key' => 'content',
                        ],
                        [
                            'title' => 'Schema & Technical Markup',
                            'body' => 'FAQ, HowTo, Organization, and Product schema, implemented properly so AI systems can parse exactly who you are and what you offer without guessing.',
                            'icon_key' => 'schema',
                        ],
                        [
                            'title' => 'Digital PR & Citation Building',
                            'body' => 'We earn mentions on the publications and directories AI models already trust, so your brand gets referenced outside your own website too.',
                            'icon_key' => 'digitalpr',
                        ],
                        [
                            'title' => 'Monthly AI Visibility Reporting',
                            'body' => 'A plain-language report every month: where you\'re mentioned, what sentiment looks like, and how much traffic is actually coming from AI referrals.',
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
                    'eyebrow' => 'HOW OUR GEO SERVICES WORK',
                    'title' => 'A five-step GEO services process, run every month.',
                    'title_html' => 'A five-step GEO services process, run every month.',
                    'lede' => 'No black box. Here\'s the actual order of work our GEO services follow, from the first audit to the report that shows it\'s working.',
                    'steps' => [
                        [
                            'num' => '01',
                            'title' => 'Audit & baseline',
                            'body' => 'We test where you currently show up — or don\'t — across ChatGPT, Perplexity, Gemini, and Google AI Overviews, using the real questions your buyers ask.',
                        ],
                        [
                            'num' => '02',
                            'title' => 'Map the territory',
                            'body' => 'We identify the topics, entities, and buyer personas your brand should own, and where competitors currently hold ground you can take.',
                        ],
                        [
                            'num' => '03',
                            'title' => 'Rebuild for retrieval',
                            'body' => 'Your key pages get restructured with direct-answer formatting and schema markup, so a model can find, parse, and quote you cleanly.',
                        ],
                        [
                            'num' => '04',
                            'title' => 'Earn the citations',
                            'body' => 'Our PR work secures mentions on the authoritative sites and directories that AI models already lean on when forming an answer.',
                        ],
                        [
                            'num' => '05',
                            'title' => 'Track, refine, repeat',
                            'body' => 'Every month we measure mentions, sentiment, and referral traffic, then adjust the strategy based on what\'s actually moving.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'compare',
                'label' => 'Comparison',
                'sort_order' => 5,
                'data' => [
                    'eyebrow' => 'GEO SERVICES VS. SEO-ONLY',
                    'title' => 'Ranking on Google isn\'t the same job anymore.',
                    'title_html' => 'Ranking on Google isn\'t the same job anymore.',
                    'lede' => 'Traditional SEO alone still matters — it\'s the foundation GEO services build on. But it was never built to answer the question a model is actually asking: who deserves to be cited?',
                    'columns' => [
                        [
                            'title' => 'Doing SEO alone',
                            'subtitle' => 'The old approach',
                            'variant' => 'muted',
                            'items' => [
                                ['mark' => 'x', 'text' => 'Optimizes for a rankings screenshot, not for being the answer'],
                                ['mark' => 'x', 'text' => 'Content built around keyword density, not direct answers'],
                                ['mark' => 'x', 'text' => 'No visibility into what AI platforms say about you'],
                                ['mark' => 'x', 'text' => 'Generic backlinks from wherever will take a guest post'],
                                ['mark' => 'x', 'text' => 'Buyer gets a link to click and compare against everyone else'],
                            ],
                        ],
                        [
                            'title' => 'GEO Services with KodRank',
                            'subtitle' => 'Built for AI search',
                            'variant' => 'pro',
                            'items' => [
                                ['mark' => 'v', 'text' => 'Built to be the answer inside ChatGPT, Gemini & AI Overviews'],
                                ['mark' => 'v', 'text' => 'Direct, citable answers backed by proper schema'],
                                ['mark' => 'v', 'text' => 'Monthly tracking of mentions, sentiment & AI referral traffic'],
                                ['mark' => 'v', 'text' => 'Citations earned on sources models already trust'],
                                ['mark' => 'v', 'text' => 'Buyer gets a recommendation with your name already on it'],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'key' => 'testimonials',
                'label' => 'Testimonials',
                'sort_order' => 6,
                'data' => [
                    'eyebrow' => 'WHAT CLIENTS SAY ABOUT OUR GEO SERVICES',
                    'title' => 'We don\'t sell visibility. We build it.',
                    'title_html' => 'We don\'t sell visibility. We build it.',
                    'items' => [
                        [
                            'quote' => 'We\'d been ranking page one on Google for years and had no idea we were completely absent from ChatGPT. Six weeks into KodRank\'s GEO services restructuring our service pages, we started showing up in the exact questions our leads were typing.',
                            'name' => 'Maria R.',
                            'role' => 'Operations Director, mid-market SaaS',
                            'avatar' => 'MR',
                            'stars' => '★★★★★',
                        ],
                        [
                            'quote' => 'What sold me wasn\'t the pitch, it was the audit. They showed me the actual ChatGPT answer where our biggest competitor was named three times and we weren\'t mentioned once. That\'s when it stopped being theoretical.',
                            'name' => 'David K.',
                            'role' => 'Founder, home services company',
                            'avatar' => 'DK',
                            'stars' => '★★★★★',
                        ],
                        [
                            'quote' => 'Our old agency gave us a rankings PDF every month that told us nothing about AI search. KodRank\'s reporting actually shows where we\'re cited and where we\'re not. It\'s the first time this has felt measurable.',
                            'name' => 'Sana P.',
                            'role' => 'Marketing Lead, B2B consultancy',
                            'avatar' => 'SP',
                            'stars' => '★★★★★',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'faq',
                'label' => 'FAQ',
                'sort_order' => 7,
                'data' => [
                    'eyebrow' => 'GEO SERVICES: QUESTIONS, ANSWERED',
                    'title' => 'Before you reach out',
                    'title_html' => 'Before you reach out',
                    'items' => [
                        [
                            'q' => 'What\'s the actual difference between SEO and GEO services?',
                            'a' => 'SEO gets your page onto page one of Google. GEO services get your brand named inside the answer a model gives before the buyer ever reaches page one. They overlap heavily — strong SEO fundamentals are still the foundation — but GEO services add entity clarity, structured content, and citation building on top, aimed specifically at how AI systems decide who to trust.',
                        ],
                        [
                            'q' => 'How long before GEO services start showing results?',
                            'a' => 'Some signals move fast — fresh content and schema fixes can shift within a few weeks. Broader citation frequency in ChatGPT and Perplexity builds over 3 to 6 months as digital PR and entity authority compound. We report monthly so you can watch the trend, not just wait for a finish line.',
                        ],
                        [
                            'q' => 'Can a smaller business actually compete with GEO services?',
                            'a' => 'Often more easily than on Google. AI answers only surface a handful of names, and there\'s no paid placement to buy your way in. A smaller brand using GEO services in a specific niche can outcite a much bigger competitor who never bothered to structure their content for AI.',
                        ],
                        [
                            'q' => 'Do GEO services replace our existing SEO, or work alongside it?',
                            'a' => 'Alongside it. GEO services are built on the same foundation as good SEO — technical health, quality content, real authority. We\'ll tell you honestly if your existing SEO needs work first, since a shaky foundation limits how much GEO services can achieve.',
                        ],
                        [
                            'q' => 'How do I find out if I need GEO services right now?',
                            'a' => 'That\'s exactly what our free audit does. We run the real questions your customers ask through ChatGPT, Gemini, Perplexity, and Google AI Overviews, and show you precisely where you appear, where you don\'t, and who\'s showing up instead of you.',
                        ],
                        [
                            'q' => 'What does the monthly GEO services report actually show me?',
                            'a' => 'Where and how often you\'re mentioned across AI platforms, the sentiment attached to those mentions, referral traffic coming from AI tools, and a plain breakdown of what we changed and why. No jargon, no vanity metrics.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'cta',
                'label' => 'CTA band',
                'sort_order' => 8,
                'data' => [
                    'eyebrow' => 'GEO SERVICES, READY WHEN YOU ARE',
                    'title' => 'Your next customer is asking AI right now. Are you in the answer?',
                    'title_html' => 'Your next customer is asking AI right now. <span class="accent">Are you in the answer?</span>',
                    'body' => 'Get a free, no-pressure look at exactly where your brand stands across ChatGPT, Gemini, Perplexity, and Google AI Overviews — and what our GEO services would take to change it.',
                    'cta_text' => 'Get My Free AI Visibility Audit',
                    'cta_url' => '#contact',
                    'image' => 'media/services/geo/ai-search-knowledge-graph-results-geo-services.webp',
                    'image_alt' => 'AI search results and knowledge graph illustration',
                ],
            ],
            [
                'key' => 'contact',
                'label' => 'Contact',
                'sort_order' => 9,
                'data' => [
                    'eyebrow' => 'GET IN TOUCH',
                    'title' => 'Let\'s find out if you need GEO services.',
                    'lede' => 'Tell us a little about your business and we\'ll run your free AI visibility audit — real answers from real AI platforms, no obligation attached.',
                    'meta' => [
                        ['label' => 'Email', 'value' => 'info@kodrank.com', 'hint' => 'We reply within one business day', 'icon_key' => 'email'],
                        ['label' => 'Phone', 'value' => '+92 305 9202732', 'hint' => 'Mon–Fri, 9am–6pm', 'icon_key' => 'phone'],
                        ['label' => 'Team', 'value' => 'Remote-first team', 'hint' => 'Working with clients across web dev & SEO, globally', 'icon_key' => 'clock'],
                    ],
                    'fields' => [
                        'first_name_label' => 'First name',
                        'last_name_label' => 'Last name',
                        'email_label' => 'Work email',
                        'phone_label' => 'Phone (Optional)',
                        'company_label' => 'Company',
                        'website_label' => 'Website URL',
                        'website_placeholder' => 'yourcompany.com',
                        'service_label' => 'I\'m Interested In',
                        'message_label' => 'What\'s prompting the search? (optional)',
                        'message_placeholder' => 'e.g. noticed we\'re missing from ChatGPT answers...',
                    ],
                    'service_options' => [
                        'GEO Services',
                        'On-Page SEO Services',
                        'Off-Page SEO Services',
                        'Technical SEO Services',
                        'Full Digital Marketing Services',
                        'Not Sure — Need Advice',
                    ],
                    'default_service' => 'GEO Services',
                    'submit_text' => 'Send it, get my audit',
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
    }
}
