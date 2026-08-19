<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class MonthlySeoServiceSeeder extends Seeder
{
    public function run(): void
    {
        $parent = ServicePage::query()->where('slug', 'digital-marketing-services')->first();

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'monthly-seo-services'],
            [
                'parent_id' => $parent?->id,
                'name' => 'Monthly SEO Services',
                'is_active' => true,
                'sort_order' => 6,
                'seo' => [
                    'theme' => 'monthly-seo',
                    'seo_title' => 'Monthly SEO Services That Compound Into Real Revenue | KodRank',
                    'seo_description' => 'KodRank monthly SEO services run search as an ongoing engine — technical fixes, content, links and reporting every month, with no lock-in contracts.',
                    'og_title' => 'Monthly SEO Services That Compound Into Real Revenue | KodRank',
                    'og_description' => 'Ongoing SEO that stacks: technical work, content, links and plain-English reporting every month. Month-to-month, no lock-in.',
                    'og_image' => 'media/services/monthly-seo/monthly-seo-hero.jpg',
                    'keywords' => 'monthly SEO services, SEO retainer, ongoing SEO, monthly SEO agency, SEO management, KodRank',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();

        $sections = [
            ['hero', 'Hero', [
                'eyebrow' => 'Monthly SEO Services',
                'title_html' => 'Monthly SEO Services That Compound Into <span class="pop">Real Revenue</span>',
                'lede' => 'One-off SEO fixes fade fast. Rankings slip, traffic flattens, and you\'re back to square one. We run search as an ongoing engine — so every month your site climbs higher, loads faster, and gets harder for competitors to overtake.',
                'cta_text' => 'Get My Free SEO Plan',
                'cta_url' => '#contact',
                'note' => 'No lock-in contracts',
                'stats' => [
                    ['value' => '+187%', 'label' => 'Avg organic traffic in 6 months', 'highlight' => true],
                    ['value_html' => '340<span class="u">+</span>', 'label' => 'Keywords ranked page one'],
                    ['value' => '1', 'label' => 'Dedicated SEO team per client'],
                    ['value' => '90 days', 'label' => 'To first measurable wins', 'highlight' => true],
                ],
            ]],
            ['pain', 'Why ongoing SEO wins', [
                'eyebrow' => 'Why ongoing SEO wins',
                'title' => 'Why Monthly SEO Services Beat One-and-Done Projects',
                'paragraphs_html' => [
                    ['html' => 'Search engines don\'t sit still, and neither do your competitors. A single audit fixes today\'s problems, then Google ships an update, a rival publishes a better page, and your hard-won rankings quietly erode. That\'s the trap of project-based SEO — <span class="hl">you pay once, then watch the results drain away.</span>'],
                    ['html' => 'Our <strong>monthly SEO services</strong> treat search like the long game it actually is. Every month we ship real work — technical fixes, fresh content, new links, sharper targeting — and measure exactly what moved. Progress stacks instead of resetting. That\'s how <span class="hl">rankings hold, traffic keeps climbing, and SEO turns into your most predictable growth channel.</span>'],
                ],
                'aside' => [
                    'eyebrow' => 'Every single month',
                    'title' => 'What lands in your account',
                    'items' => [
                        'Technical fixes shipped, not just flagged',
                        'New, search-ready content published',
                        'Quality backlinks earned from real sites',
                        'A plain-English report on what changed',
                    ],
                ],
                'pain_eyebrow' => 'Sound familiar?',
                'pain_title' => 'You\'ve probably been burned by one of these',
                'cards' => [
                    ['num' => '01', 'title' => 'Rankings that slipped', 'body' => 'You paid for an audit, saw a bump, then watched positions fade month after month with nobody keeping them up.'],
                    ['num' => '02', 'title' => 'Reports you can\'t read', 'body' => 'Your last agency sent charts full of jargon but never a straight answer on what they did or what it earned you.'],
                    ['num' => '03', 'title' => 'Traffic that plateaued', 'body' => 'The basics are handled, yet growth stalled. You\'re stuck on the same keywords while competitors quietly pull ahead.'],
                    ['num' => '04', 'title' => 'Cheap SEO that backfired', 'body' => 'A bargain package promised page one in weeks, then buried you with spammy links and results that never showed.'],
                ],
            ]],
            ['included', 'What\'s included', [
                'eyebrow' => 'What\'s inside',
                'title' => 'What Your Monthly SEO Services Include',
                'lede' => 'No vague retainers or mystery hours. Every month covers the full stack of work that actually moves rankings — planned around your goals, not a copy-paste checklist.',
                'cards' => [
                    ['title' => 'Technical SEO & Site Health', 'body' => 'We keep crawlability, indexing, Core Web Vitals, schema, and site speed in shape — the plumbing that lets everything else rank.'],
                    ['title' => 'On-Page Optimization', 'body' => 'Titles, headings, internal links, and copy tuned to match how buyers actually search — page by page, priority pages first.'],
                    ['title' => 'Keyword Strategy & Mapping', 'body' => 'We find the terms with real buying intent, map them to the right pages, and expand your reach into keywords worth winning.'],
                    ['title' => 'Link Building & Authority', 'body' => 'Real backlinks from relevant sites through outreach and digital PR — the clean, lasting kind that lifts your whole domain.'],
                    ['title' => 'Content Creation', 'body' => 'Human-written service pages, guides, and blog posts built to rank and convert — no thin, AI-spun filler on your site.'],
                    ['title' => 'Reporting & ROI Tracking', 'body' => 'A clear monthly report on rankings, traffic, leads, and revenue — so you always know what shipped and what it earned.'],
                ],
            ]],
            ['process', 'The monthly loop', [
                'eyebrow' => 'The monthly loop',
                'title' => 'How Your Monthly SEO Program Runs',
                'lede' => 'SEO works when it\'s a cycle, not a one-time push. Each month feeds the next, so your rankings, content, and authority build on top of everything that came before.',
                'steps' => [
                    ['num' => '01', 'title' => 'Audit & Strategy', 'body' => 'We dig into your site, competitors, and search data to set the month\'s priorities where they\'ll move the needle most.'],
                    ['num' => '02', 'title' => 'Execute the Work', 'body' => 'Technical fixes, content, and link building all ship — real deliverables, not a list of things we plan to get to.'],
                    ['num' => '03', 'title' => 'Track & Report', 'body' => 'We measure rankings, traffic, and conversions, then send a report that says plainly what changed and what it earned.'],
                    ['num' => '04', 'title' => 'Refine & Scale', 'body' => 'We double down on what\'s working and cut what isn\'t, so next month starts stronger than the last. Then repeat.'],
                ],
            ]],
            ['compare', 'The difference', [
                'eyebrow' => 'The difference',
                'title' => 'Monthly SEO Services Built on Results, Not Busywork',
                'lede' => 'Plenty of agencies bill you for activity. We\'d rather be judged on what actually moves — rankings, traffic, and revenue you can see.',
                'other' => [
                    'title' => 'The typical retainer',
                    'items' => [
                        'Reports full of jargon, thin on results',
                        'Same recycled checklist for every client',
                        'Locked into long contracts to keep you',
                        'Content spun by bots, links bought in bulk',
                        'No line of sight from SEO to revenue',
                    ],
                ],
                'us' => [
                    'tag' => 'KodRank monthly SEO',
                    'title' => 'Our monthly SEO',
                    'items' => [
                        'Plain-English reports tied to real outcomes',
                        'A strategy built around your goals',
                        'Month-to-month — we earn the renewal',
                        'Human-written content, white-hat links only',
                        'Leads and revenue tracked end to end',
                    ],
                ],
            ]],
            ['testimonials', 'Client results', [
                'eyebrow' => 'Client results',
                'title' => 'Businesses That Grew With Our Monthly SEO',
                'items' => [
                    ['quote' => 'We\'d been through two agencies that just sent screenshots. KodRank actually shipped work every month — our organic leads roughly doubled in a quarter and I can finally see why.', 'initials' => 'SR', 'name' => 'Sana Riaz', 'role' => 'Founder, Meridian Interiors'],
                    ['quote' => 'Our traffic had been flat for a year. Six months into their monthly SEO plan we\'re ranking for terms we never touched before — and they\'re the ones that bring in real enquiries.', 'initials' => 'DK', 'name' => 'Daniyal Khan', 'role' => 'Director, NorthPeak Logistics'],
                    ['quote' => 'No contract, no fluff. They explained everything in language I understood and let the results keep them hired. That confidence is exactly why we\'re still working together.', 'initials' => 'AM', 'name' => 'Ayesha Malik', 'role' => 'CEO, Bloomwell Skincare'],
                ],
            ]],
            ['faq', 'FAQ', [
                'eyebrow' => 'Questions',
                'title' => 'Monthly SEO Services FAQs',
                'items' => [
                    ['q' => 'How long until monthly SEO services show results?', 'a' => 'SEO compounds, so it isn\'t instant. Most clients see early signals — faster indexing, better keyword visibility, higher click-through — within the first 30 to 90 days. Meaningful jumps in traffic and leads usually land around the three-to-six month mark, and they keep building from there. Competitive niches take a little longer, and we\'ll always tell you honestly where yours sits.'],
                    ['q' => 'Do I have to sign a long-term contract?', 'a' => 'No. Our monthly SEO services run month to month. We ask for a fair runway to let the work take hold, but we don\'t trap you in a year-long lock-in. If we\'re doing our job, the results keep us hired — that\'s the arrangement we prefer.'],
                    ['q' => 'What\'s actually included each month?', 'a' => 'Technical SEO and site-health fixes, on-page optimization, keyword research and mapping, human-written content, white-hat link building, and a clear monthly report tying it all to rankings, traffic, and revenue. The exact mix is built around your goals and your site — never a copy-paste checklist.'],
                    ['q' => 'How much do monthly SEO services cost?', 'a' => 'It depends on your industry, competition, and how aggressively you want to grow. We build a plan scoped to your goals and quote it upfront — no surprise fees, no padded hours. Share your site and targets, and we\'ll put together a custom plan you can say yes or no to.'],
                    ['q' => 'Is monthly SEO better than a one-time project?', 'a' => 'For lasting growth, yes. A one-time project fixes a snapshot in time, but algorithms shift and competitors keep moving, so those gains fade. Monthly SEO keeps strategy, content, and optimization compounding — rankings don\'t just improve, they hold and grow. Project work is fine for a quick, specific fix; it won\'t deliver the steady stream of leads that ongoing SEO does.'],
                    ['q' => 'Will you use AI to write my content?', 'a' => 'Your content is written and edited by real people. We may use tools to research faster, but nothing thin or auto-spun goes on your site. Google rewards genuine expertise and experience, and so do your customers — so every page reads like a human wrote it, because one did.'],
                ],
            ]],
            ['contact', 'Contact', [
                'eyebrow' => 'Start now',
                'title' => 'Get Your Free Monthly SEO Plan',
                'lede' => 'Tell us about your site and where you want to grow. We\'ll send back a straight-talking plan — the keywords worth chasing, what\'s holding you back, and how our monthly SEO services would get you there.',
                'points' => [
                    'A free audit of your biggest ranking gaps',
                    'Upfront pricing — no obligation, no pressure',
                    'A reply from a real SEO strategist, not a bot',
                ],
                'form_title' => 'Request your plan',
                'form_sub' => 'Takes under a minute. We\'ll be in touch within one business day.',
                'fields' => [
                    'name_label' => 'Full name',
                    'email_label' => 'Work email',
                    'website_label' => 'Website URL',
                    'service_label' => 'Primary goal',
                    'message_label' => 'Anything else we should know?',
                ],
                'service_options' => [
                    'Grow organic traffic',
                    'Rank for more keywords',
                    'Recover lost rankings',
                    'Generate more leads or sales',
                ],
                'default_service' => 'Grow organic traffic',
                'submit_text' => 'Send Me My Free Plan',
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
