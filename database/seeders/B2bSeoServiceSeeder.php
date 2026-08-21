<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class B2bSeoServiceSeeder extends Seeder
{
    public function run(): void
    {
        $this->hideFromNav(['saas-seo-services', 'monthly-seo-services']);

        $parent = ServicePage::query()->where('slug', 'digital-marketing-services')->first();

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'b2b-seo-services'],
            [
                'parent_id' => $parent?->id,
                'name' => 'B2B SEO Services',
                'is_active' => true,
                'sort_order' => 7,
                'seo' => [
                    'theme' => 'b2b-seo',
                    'hide_from_nav' => true,
                    'seo_title' => 'B2B SEO Services | Turn Search Into Qualified Pipeline — KodRank',
                    'seo_description' => 'KodRank\'s B2B SEO Services help you rank for the high-intent, low-volume keywords your buyers actually use — and turn that organic visibility into qualified pipeline, not vanity traffic.',
                    'og_title' => 'B2B SEO Services | Turn Search Into Qualified Pipeline — KodRank',
                    'og_description' => 'In B2B, a handful of the right searches outweigh a million wrong ones. KodRank maps buyer-intent keywords and ties reporting to pipeline.',
                    'og_image' => 'media/services/b2b-seo/b2b-seo-services-hero-section-banner.webp',
                    'keywords' => 'B2B SEO services, B2B SEO agency, buyer-intent SEO, B2B pipeline SEO, KodRank',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();

        $sections = [
            ['hero', 'Hero', [
                'eyebrow' => 'B2B SEO Agency',
                'title_html' => 'B2B SEO Services that grow pipeline, <span class="hl">not vanity traffic</span>',
                'lede' => 'In B2B, a handful of the right searches outweigh a million wrong ones. We help you own the low-volume, high-intent keywords your buyers actually type — then turn that organic visibility into demos, meetings, and revenue your sales team can close.',
                'cta_text' => 'Book a free SEO teardown',
                'cta_url' => '#contact',
                'trust' => [
                    ['value' => '3.4×', 'label' => 'Avg. lift in qualified organic leads'],
                    ['value' => 'Top 3', 'label' => 'Rankings for buyer-intent terms'],
                    ['value' => '90 days', 'label' => 'To first pipeline signals'],
                ],
            ]],
            ['intro', 'What makes us different', [
                'eyebrow' => 'Why KodRank',
                'title' => 'What makes our B2B SEO Services different',
                'paragraphs_html' => [
                    ['html' => 'Most B2B SEO underperforms for one reason: it chases rankings and forgets revenue. Our B2B SEO Services are built around a single, harder question — did it create pipeline?'],
                    ['html' => 'We map the exact terms your buying committee uses across a long sales cycle, build the technical foundation and content that ranks for them, and tie every report back to opportunities and closed deals — not impressions you can\'t bank. If a keyword won\'t move a real buyer closer to a contract, we don\'t waste your budget on it.'],
                ],
                'card_value' => 'Built for',
                'card_label' => 'how B2B buyers actually search',
                'card_rows' => [
                    'High-intent, low-volume keywords that convert — not broad terms that never buy.',
                    'Content for every stakeholder — the champion, the technical lead, and procurement.',
                    'Reporting tied to revenue, so leadership sees SEO\'s contribution to the pipeline.',
                    'Visibility in AI search — get named in AI Overviews, ChatGPT, and Perplexity answers.',
                ],
            ]],
            ['pain', 'Why B2B SEO underdelivers', [
                'eyebrow' => 'The real problem',
                'title_html' => 'Why most B2B SEO quietly <span class="hl">underdelivers</span>',
                'lede' => 'If you\'ve paid for SEO before and walked away frustrated, it probably wasn\'t your market — it was the playbook. Here\'s where B2B programs break, and what we fix.',
                'cards' => [
                    ['title' => 'Your best keywords look "too small"', 'body' => 'Most agencies skip terms with low search volume. But in B2B, a niche query with 90 searches a month can be worth a six-figure contract. We target intent, not vanity volume.'],
                    ['title' => 'Traffic climbs, pipeline doesn\'t', 'body' => 'Rankings and sessions look great in the deck, yet nothing reaches sales. That\'s the gap between traffic and demand — we build pages that qualify and convert, not just attract.'],
                    ['title' => 'The long sales cycle hides ROI', 'body' => 'When deals take 6–12 months, leadership stops believing SEO works. We report leading indicators — pipeline influenced, opportunities created — so the value is visible long before the close.'],
                    ['title' => 'You\'re invisible to the buying committee', 'body' => 'Seven to eleven people weigh in on a B2B purchase, each searching differently. One generic page can\'t satisfy them all. We create content mapped to every role and stage.'],
                    ['title' => 'AI answers are eating your clicks', 'body' => 'AI Overviews and ChatGPT now answer buyers before they reach your site. If your brand isn\'t cited, you\'re losing demand you never see. We optimize to get you referenced.'],
                    ['title' => 'Your agency runs a B2C playbook', 'body' => 'Templated tactics built for impulse purchases fall flat with cautious business buyers. B2B is a different game — longer trust cycles, technical proof, and multiple decision-makers.'],
                ],
            ]],
            ['services', 'What\'s included', [
                'eyebrow' => 'What you get',
                'title_html' => 'Everything inside our B2B SEO Services',
                'lede' => 'One connected program across technical, content, authority, and reporting — engineered to compound into qualified pipeline, month after month.',
                'image' => 'media/services/b2b-seo/seo-that-shows-up-on-the-revenue-line-banner.webp',
                'cards' => [
                    ['title' => 'Buyer-intent keyword mapping', 'body' => 'We mine your sales calls, support tickets, and lost-deal notes to find the exact terms real buyers use — then map them to every funnel stage and stakeholder.'],
                    ['title' => 'Technical SEO foundation', 'body' => 'Crawlability, site architecture, indexation, Core Web Vitals, schema, and rendering — the groundwork that lets everything else rank instead of stalling.'],
                    ['title' => 'Buyer-journey content', 'body' => 'Category primers, comparison pages, ROI frameworks, and technical explainers — content that answers real objections and moves a deal forward, not filler blog posts.'],
                    ['title' => 'Authority & link building', 'body' => 'Placements and digital PR inside the publications your buyers already trust — building the topical authority Google rewards in competitive B2B niches.'],
                    ['title' => 'AI search visibility (GEO / AEO)', 'body' => 'We structure your content so AI engines can quote it — earning citations in AI Overviews, ChatGPT, and Perplexity where a growing share of buyers now start.'],
                    ['title' => 'Revenue reporting & CRO', 'body' => 'GA4, Search Console, and a revenue dashboard that ties rankings to pipeline — plus conversion work so more of the right traffic turns into booked calls.'],
                ],
            ]],
            ['stats', 'Outcomes', [
                'eyebrow' => 'Outcomes we build toward',
                'title_html' => 'SEO that shows up on the <span class="hl">revenue line</span>',
                'lede' => 'Representative results across the SaaS, manufacturing, fintech, and professional-services clients we partner with.',
                'tone' => 'light',
                'items' => [
                    ['value' => '260%', 'label' => 'Average program ROI'],
                    ['value' => '3.4×', 'label' => 'Growth in sales-qualified organic leads'],
                    ['value' => '+182%', 'label' => 'More page-one keywords in six months'],
                    ['value' => '6 mo', 'label' => 'Typical time to compounding pipeline'],
                ],
            ]],
            ['process', 'How we work', [
                'eyebrow' => 'How we work',
                'title_html' => 'A B2B SEO process built for <span class="hl">long sales cycles</span>',
                'lede' => 'No black boxes. A clear, senior-led sequence from first audit to compounding growth — so you always know what we\'re doing and why.',
                'steps' => [
                    ['num' => '01', 'title' => 'Audit & discovery', 'body' => 'We interview your sales team and audit your site, backlinks, and competitors to find the gaps holding rankings back.'],
                    ['num' => '02', 'title' => 'Strategy & keyword map', 'body' => 'A prioritized plan built on buyer intent — the terms you can realistically win that a real prospect actually searches.'],
                    ['num' => '03', 'title' => 'Build & optimize', 'body' => 'We fix technical issues, restructure key pages, and ship the on-page work that makes your site rankable.'],
                    ['num' => '04', 'title' => 'Content & authority', 'body' => 'We publish buyer-journey content and earn links in trusted publications to build defensible topical authority.'],
                    ['num' => '05', 'title' => 'Report & compound', 'body' => 'Monthly reporting tied to pipeline, plus continuous testing so results build on themselves quarter over quarter.'],
                ],
            ]],
            ['compare', 'The difference', [
                'eyebrow' => 'The difference',
                'title_html' => 'A typical SEO agency vs. <span class="hl">KodRank</span>',
                'lede' => 'The tactics look similar on a proposal. The results diverge fast once the work — and the reporting — has to hold up to your CFO.',
                'other' => [
                    'tag' => 'Typical agency',
                    'title' => 'Traffic-first, revenue-blind',
                    'items' => [
                        'Chases high-volume keywords that rarely convert',
                        'Reports on impressions and rankings you can\'t bank',
                        'Recycles a B2C playbook across every client',
                        'Ignores AI search and the buying committee',
                        'Junior account managers, outsourced content',
                    ],
                ],
                'us' => [
                    'tag' => 'KodRank B2B SEO Services',
                    'title' => 'Pipeline-first, revenue-proven',
                    'items' => [
                        'Targets high-intent terms tied to real buying decisions',
                        'Reports pipeline influenced and opportunities created',
                        'Builds a strategy around your niche and sales cycle',
                        'Optimizes for AI search and every decision-maker',
                        'Senior strategists on your account from day one',
                    ],
                ],
            ]],
            ['testimonials', 'Client voices', [
                'eyebrow' => 'Client voices',
                'title' => 'What partnering with KodRank feels like',
                'items' => [
                    ['quote' => 'They finally connected our rankings to actual pipeline. For the first time, our leadership sees SEO as a revenue channel instead of a cost line.', 'initials' => 'DR', 'name' => 'Head of Demand Gen', 'role' => 'B2B SaaS platform'],
                    ['quote' => 'KodRank understood our niche in the first call. No fluff, no templates — just the specific terms our buyers use and a plan to own them.', 'initials' => 'MT', 'name' => 'VP Marketing', 'role' => 'Industrial manufacturing'],
                    ['quote' => 'Six months in, we\'re ranking for comparison terms we\'d chased for years — and those pages now drive our best-fit demo requests.', 'initials' => 'SP', 'name' => 'Growth Lead', 'role' => 'Fintech / payments'],
                ],
            ]],
            ['faq', 'FAQ', [
                'eyebrow' => 'Questions, answered',
                'title_html' => 'B2B SEO Services FAQ',
                'items' => [
                    ['q' => 'How are B2B SEO Services different from regular SEO?', 'a' => 'B2B buyers research for months, involve multiple decision-makers, and search using specific, technical, often low-volume terms. B2B SEO Services prioritize buyer intent and pipeline over raw traffic — targeting the queries that signal a real purchase decision, and building content for every stakeholder in the buying committee rather than a single casual visitor.'],
                    ['q' => 'My keywords have low search volume. Is SEO even worth it?', 'a' => 'Yes — often more so than in B2C. In niche B2B markets, a keyword with modest monthly volume can represent a six-figure contract. We evaluate keywords by commercial intent and deal value, not just volume, and we capture the long tail of related queries by covering each topic with genuine depth.'],
                    ['q' => 'How long before we see results?', 'a' => 'You\'ll usually see early signals — rankings, impressions, and qualified traffic — within 90 days, with meaningful pipeline contribution typically building around the six-month mark. Because B2B sales cycles are long, we report leading indicators (pipeline influenced, opportunities created) so value is visible well before deals close.'],
                    ['q' => 'How do you measure ROI on a long sales cycle?', 'a' => 'We connect Search Console and GA4 to your CRM and report on the metrics leadership actually cares about: sales-qualified leads, pipeline influenced, and revenue contribution — not just rankings. You get a live dashboard that shows SEO\'s role in deals in progress, not only deals already closed.'],
                    ['q' => 'Do you help us show up in AI Overviews and ChatGPT?', 'a' => 'Yes. A growing share of B2B research now starts inside AI answers. We structure your content, entities, and data so AI engines can quote it — earning citations in AI Overviews, ChatGPT, and Perplexity alongside your traditional organic rankings.'],
                    ['q' => 'Do you write the content, or do we?', 'a' => 'Either way works. Our team can produce the full buyer-journey content, or provide detailed, SEO-ready outlines for your in-house writers. Everything is 100% original, grounded in your subject-matter expertise, and reviewed against search intent before it ships.'],
                ],
            ]],
            ['contact', 'Contact', [
                'eyebrow' => 'Let\'s talk pipeline',
                'title_html' => 'Get your free <span class="hl">B2B SEO teardown</span>',
                'lede' => 'Tell us where you are and we\'ll audit your site, surface the buyer-intent keywords you\'re missing, and show you exactly where the pipeline is hiding — no obligation, no sales-rep runaround.',
                'points' => [
                    'A senior strategist reviews your site personally — not a junior running a tool.',
                    'You get specific keyword and page opportunities, not a generic checklist.',
                    'We reply within one business day. No pressure, no spam.',
                ],
                'fields' => [
                    'name_label' => 'Full name',
                    'email_label' => 'Work email',
                    'website_label' => 'Website',
                    'service_label' => 'Monthly SEO budget',
                    'message_label' => 'Your biggest SEO challenge',
                ],
                'service_options' => ['Under $2k / month', '$2k–$5k / month', '$5k–$10k / month', '$10k+ / month'],
                'default_service' => '$2k–$5k / month',
                'submit_text' => 'Send my teardown request',
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

    private function hideFromNav(array $slugs): void
    {
        foreach ($slugs as $slug) {
            $page = ServicePage::query()->where('slug', $slug)->first();
            if (! $page) {
                continue;
            }
            $seo = $page->seo ?? [];
            $seo['hide_from_nav'] = true;
            $page->update(['seo' => $seo]);
            ServicePage::forgetCache($slug);
        }
    }
}
