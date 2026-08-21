<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class SaasSeoServiceSeeder extends Seeder
{
    public function run(): void
    {
        $parent = ServicePage::query()->where('slug', 'digital-marketing-services')->first();

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'saas-seo-services'],
            [
                'parent_id' => $parent?->id,
                'name' => 'SaaS SEO Services',
                'is_active' => true,
                'sort_order' => 5,
                'seo' => [
                    'theme' => 'saas-seo',
                    'hide_from_nav' => true,
                    'seo_title' => 'SaaS SEO Services That Turn Rankings Into Recurring Revenue | KodRank',
                    'seo_description' => 'KodRank SaaS SEO services fill your pipeline with trials, demos and SQLs — not vanity traffic. Full-funnel strategy, technical SEO, content, links and AI search, measured as MRR.',
                    'og_title' => 'SaaS SEO Services That Turn Rankings Into Recurring Revenue | KodRank',
                    'og_description' => 'Organic search that fills your SaaS pipeline with trials, demos and SQLs. Strategy, technical, content, links and AI search — reported as revenue.',
                    'og_image' => 'media/services/saas-seo/saas-seo-services-organic-search-traffic-keyword-clusters-technical-seo-dashboard.jpg',
                    'keywords' => 'SaaS SEO services, SaaS SEO agency, B2B SaaS SEO, SaaS content SEO, GEO AEO SaaS, SaaS organic growth',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();

        $sections = [
            ['hero', 'Hero', [
                'eyebrow' => 'SaaS SEO Agency',
                'title_html' => 'SaaS SEO Services That Turn Rankings <span class="brk">Into <span class="hl">Recurring Revenue</span></span>',
                'lede_html' => 'You don\'t need more traffic. You need organic search that fills your pipeline with <b>trials, demos and SQLs</b> — and keeps your CAC from climbing every quarter. That\'s the only outcome we build for.',
                'cta_text' => 'Get your free SEO audit',
                'cta_url' => '#contact',
                'trust' => [
                    ['value' => 'Full-funnel', 'label' => 'Awareness to signup'],
                    ['value' => 'Google + AI', 'label' => 'Search & answer engines'],
                    ['value' => 'CRM-tied', 'label' => 'Reported as pipeline'],
                ],
            ]],
            ['intro', 'Intro', [
                'eyebrow' => 'The problem with most SaaS SEO',
                'title' => 'Where most SaaS SEO services stop at traffic, ours start at pipeline',
                'paragraphs_html' => [
                    ['html' => 'Ranking on page one feels like winning. Then the quarter closes and the numbers haven\'t moved — no new trials, no demos your sales team can actually close, no dent in acquisition cost. The traffic is real. The revenue isn\'t.'],
                    ['html' => 'Our <span class="emph">SaaS SEO services</span> exist to close that gap. We reverse-engineer every keyword, page and link from the metric you report to your board: qualified pipeline and MRR. Rankings are a byproduct, not the goal.'],
                ],
                'card_value' => '1 in 2',
                'card_label' => 'website visits worldwide start with an organic search — the channel that compounds instead of resetting every budget cycle.',
                'card_rows' => [
                    'Built around buyer intent, not search volume',
                    'Visible in Google, ChatGPT, Perplexity & G2',
                    'Every result traced back to your CRM',
                ],
            ]],
            ['pain', 'Sound familiar?', [
                'eyebrow' => 'Sound familiar?',
                'title_html' => 'The reasons your SEO isn\'t <span class="hl">moving the numbers</span>',
                'lede' => 'Most SaaS teams don\'t have a traffic problem. They have a pipeline problem dressed up as an SEO report. Here\'s where it usually breaks down.',
                'cards' => [
                    ['title' => 'Rankings that don\'t convert', 'body' => 'You rank for dozens of terms, but almost none of them bring in a trial or a demo. Traffic is up and to the right; pipeline is flat.'],
                    ['title' => 'CAC that climbs every quarter', 'body' => 'Paid works until the budget review. Every new dollar buys a lower-intent click, and your blended acquisition cost creeps up with it.'],
                    ['title' => 'Content that reads but doesn\'t sell', 'body' => 'You publish every week and it ranks. Then the reader hits the end of the post and there\'s nowhere to go — nothing tied to the product.'],
                    ['title' => 'Invisible in AI search', 'body' => 'Buyers ask ChatGPT, Perplexity and Google\'s AI Overviews for a shortlist. Your competitors get named. You don\'t get mentioned at all.'],
                    ['title' => 'No proof it\'s working', 'body' => 'Leadership wants revenue, not rankings. Without attribution, SEO looks like a cost center and its budget is the first thing on the chopping block.'],
                    ['title' => 'No bandwidth to execute', 'body' => 'Keyword strategy, technical fixes, content and links — all at once, at scale — is more than a lean team can carry. Things slip and momentum dies.'],
                ],
            ]],
            ['services', 'What\'s inside', [
                'eyebrow' => 'What\'s inside',
                'title_html' => 'Full-funnel SaaS SEO services, <span class="hl">engineered for MRR</span>',
                'lede' => 'One team covering strategy, technical, content, links and AI search — sequenced by revenue impact, shipped every month, and measured against pipeline.',
                'cards' => [
                    ['title' => 'Full-funnel keyword & intent mapping', 'body' => 'We map the terms your buyers search at every stage — problem-aware to ready-to-buy — and prioritize by conversion potential, not just volume.'],
                    ['title' => 'Technical SEO & site health', 'body' => 'JavaScript rendering, Core Web Vitals, crawl and index hygiene, structured data — so Google and AI crawlers can read every page that matters.'],
                    ['title' => 'Conversion-first content', 'body' => 'Topic clusters built around real sales objections and product value, each with a clear path from the page to a trial or a booked demo.'],
                    ['title' => 'Link building & digital PR', 'body' => 'Editorial links and brand mentions from sites your buyers and Google already trust. Earned through outreach and PR — never spammy placements.'],
                    ['title' => 'AI & generative search (GEO/AEO)', 'body' => 'We optimize so your product gets cited in ChatGPT, Perplexity, Gemini and AI Overviews — and shows up on the review sites buyers actually check.'],
                    ['title' => 'Attribution & reporting', 'body' => 'GA4, Search Console and your CRM tied together, so every trial, demo and closed deal traces back to organic. You see pipeline, not pageviews.'],
                ],
            ]],
            ['process', 'How we work', [
                'eyebrow' => 'How we work',
                'title_html' => 'A SaaS SEO engine, built in <span class="hl">four moves</span>',
                'lede' => 'No 60-page strategy deck that sits in a drawer. A tight loop of audit, plan, ship and measure — with work going live from the first month.',
                'steps' => [
                    ['num' => '01', 'title' => 'Audit & benchmark', 'body' => 'We tear down your search footprint, technical health, and where you stand in AI answers. You get a prioritized gap list in week one.'],
                    ['num' => '02', 'title' => 'Strategy & roadmap', 'body' => 'Keyword map, content plan and technical fixes, sequenced by revenue impact and reverse-engineered from your pipeline targets.'],
                    ['num' => '03', 'title' => 'Build & ship', 'body' => 'Technical fixes, conversion-first content and authority links go live every month. Execution over endless planning.'],
                    ['num' => '04', 'title' => 'Measure & scale', 'body' => 'We tie results to CRM data, double down on what drives SQLs, and compound the wins quarter over quarter.'],
                ],
            ]],
            ['stats', 'Why organic compounds', [
                'eyebrow' => 'Why organic compounds',
                'title_html' => 'The channel that keeps <span class="hl">paying you back</span>',
                'lede' => 'A few numbers that explain why disciplined SaaS SEO beats renting attention through ads — quarter after quarter.',
                'items' => [
                    ['value' => '53%', 'label' => 'of trackable web traffic starts with organic search'],
                    ['value' => '8–12%', 'label' => 'conversion rates conversion-first content can reach, vs 2–4% typical'],
                    ['value' => '40%', 'label' => 'of searches now end with no click — AI & SERP visibility is non-negotiable'],
                    ['value' => '700%+', 'label' => 'reported B2B SaaS SEO ROI benchmark over a 12–24 month horizon'],
                ],
                'note' => 'Figures are widely cited industry benchmarks, shown to illustrate the opportunity — not a guarantee of specific results.',
            ]],
            ['compare', 'The difference', [
                'eyebrow' => 'The difference',
                'title_html' => 'A typical SEO agency vs <span class="hl">KodRank</span>',
                'lede' => 'Same deliverables on paper. A completely different scoreboard.',
                'other' => [
                    'tag' => 'Typical SEO agency',
                    'title' => 'Optimizes for the report',
                    'items' => [
                        'Reports rankings and traffic volume',
                        'Picks keywords by search volume',
                        'Content that ranks but doesn\'t convert',
                        'Ignores AI search and review sites',
                        'SEO in a silo, no link to your CRM',
                        'Big strategy deck, slow execution',
                    ],
                ],
                'us' => [
                    'tag' => 'KodRank SaaS SEO',
                    'title' => 'Optimizes for pipeline',
                    'items' => [
                        'Reports pipeline, SQLs and revenue',
                        'Picks keywords by buyer intent & conversion',
                        'Conversion-first content tied to product',
                        'Optimized for Google, ChatGPT & G2',
                        'Attribution from click to closed deal',
                        'Ships fixes, content & links every month',
                    ],
                ],
            ]],
            ['faq', 'FAQ', [
                'eyebrow' => 'Good questions',
                'title_html' => 'SaaS SEO services, <span class="hl">answered plainly</span>',
                'items' => [
                    ['q' => 'What exactly do your SaaS SEO services include?', 'a' => 'Everything under one roof: full-funnel keyword and intent research, technical SEO, conversion-first content, link building and digital PR, AI/generative search optimization, and CRM-tied reporting. We scope the mix to where your growth is actually stuck rather than selling a fixed package you don\'t need.'],
                    ['q' => 'How is SaaS SEO different from regular SEO?', 'a' => 'SaaS buying is a long, multi-stakeholder decision for an intangible product, and success is measured in trials, demos, SQLs and recurring revenue — not one-off sales. That changes everything: the keywords you target, how content maps to the funnel, and the fact that retention matters as much as acquisition. Generic SEO ignores all of it.'],
                    ['q' => 'How long until we see results?', 'a' => 'Early wins usually come within the first few months by optimizing existing high-intent pages and fixing technical drag. Larger, compounding growth in signups and pipeline builds over 6–12 months and depends on your domain authority, competition and sales-cycle length. We\'re upfront about timelines from the first call.'],
                    ['q' => 'Do you optimize for AI search like ChatGPT and Perplexity?', 'a' => 'Yes. Generative and answer-engine optimization is built into every engagement. We structure content, authority signals and review-site presence so your product gets surfaced and cited in AI Overviews, ChatGPT, Gemini and Perplexity — the exact moment high-intent buyers are building a shortlist.'],
                    ['q' => 'How do you prove SEO is actually driving revenue?', 'a' => 'We connect Search Console and GA4 to your CRM and attribute organic touchpoints to trials, demos and closed deals. Reporting is framed in the language your leadership uses — pipeline, SQLs, CAC and revenue influence — so SEO reads as a growth engine, not a line item to defend.'],
                    ['q' => 'What size and stage of SaaS companies do you work with?', 'a' => 'Mostly B2B SaaS teams from seed through Series C who have product-market fit and want organic to become a dependable growth channel. Whether you have an in-house marketer who needs execution firepower or no SEO function at all, we slot into the gap.'],
                ],
            ]],
            ['contact', 'Contact', [
                'eyebrow' => 'Let\'s talk',
                'title_html' => 'Get your free <span class="hl">SaaS SEO audit</span>',
                'lede' => 'Tell us your domain and where you\'re stuck. Within a few days you\'ll get a prioritized teardown — technical gaps, keyword and content opportunities, and where you\'re losing ground in AI search.',
                'points' => [
                    'A real audit, not an automated PDF',
                    'Prioritized by revenue impact',
                    'No pitch deck, no obligation',
                ],
                'fields' => [
                    'name_label' => 'Your name',
                    'email_label' => 'Work email',
                    'website_label' => 'Website / domain',
                    'service_label' => 'Current MRR range',
                    'message_label' => 'Where are you stuck?',
                    'message_placeholder' => 'Traffic is up but signups are flat, invisible in AI search, CAC climbing…',
                ],
                'service_options' => [
                    'Pre-revenue / early',
                    '$10k – $50k MRR',
                    '$50k – $200k MRR',
                    '$200k+ MRR',
                ],
                'default_service' => 'Pre-revenue / early',
                'submit_text' => 'Send my audit request',
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
