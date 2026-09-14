<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

/**
 * White Label SEO Services — content from public/replace/white-label-seo.html
 * Design stays ecommerce-seo theme; page polish via css/white-label-seo-page.css
 *
 * Run: php artisan db:seed --class=WhiteLabelSeoServiceSeeder
 */
class WhiteLabelSeoServiceSeeder extends Seeder
{
    public function run(): void
    {
        $parent = ServicePage::query()->where('slug', 'digital-marketing-services')->first();
        $heroImage = 'media/services/white-label-seo/white-label-seo-services-hero.jpg';

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'white-label-seo-services'],
            [
                'parent_id' => $parent?->id,
                'name' => 'White Label SEO Services',
                'is_active' => true,
                'sort_order' => 11,
                'seo' => [
                    'theme' => 'ecommerce-seo',
                    'hide_from_nav' => true,
                    'extra_css' => 'css/white-label-seo-page.css',
                    'seo_title' => 'White Label SEO Services for Agencies | KodRank',
                    'seo_description' => 'KodRank\'s white label SEO services let your agency deliver rankings under your own brand — no in-house hires, no tools to manage. You keep the client, the credit, and the margins.',
                    'og_title' => 'White Label SEO Services for Agencies | KodRank',
                    'og_description' => 'Deliver SEO under your brand. Audits, content, links, and branded reports — NDA-backed fulfillment for agencies.',
                    'og_image' => $heroImage,
                    'keywords' => 'white label SEO services, agency SEO partner, reseller SEO, white label SEO, KodRank',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();

        $sections = [
            ['hero', 'Hero', [
                'eyebrow' => 'Built for agencies & resellers',
                'title_html' => 'White Label SEO Services that rank <span class="hl">under your brand.</span>',
                'lede_html' => 'You close the client. We do the SEO. Every audit, backlink, and ranking report ships with <span class="hl">your logo on it</span> — so your agency looks bigger, ships faster, and keeps the margins. Your clients never know we exist.',
                'cta_text' => 'Get Your White Label Quote',
                'cta_url' => '#contact',
                'image' => $heroImage,
                'breadcrumb' => [
                    ['label' => 'Home', 'url' => '/'],
                    ['label' => 'Services', 'url' => '/services'],
                    ['label' => 'White Label SEO Services', 'url' => ''],
                ],
                'trust_points' => [
                    '150+ agency partners',
                    '100% white-labeled',
                    'NDA-backed fulfillment',
                ],
            ]],
            ['intro', 'Introduction', [
                'eyebrow' => 'Your brand, our engine',
                'title' => '',
                'lead_html' => 'White Label SEO Services built for agencies that are scaling faster than they can hire.',
                'paragraphs_html' => [
                    ['html' => 'KodRank is the SEO team behind the curtain. We plug straight into your workflow and handle keyword research, technical fixes, content, and link building as a <span class="hl">seamless extension of your agency</span> — never a vendor your client sees. You stay the single point of contact. We stay invisible. The rankings show up with your name on the report.'],
                    ['html' => 'No new salaries. No tool stack to babysit. No SEO expertise to build from scratch. Just <span class="hl">done-for-you fulfillment</span> you can resell at your own price.'],
                ],
                'stats' => [
                    ['num' => '2–3x', 'label' => 'Recurring revenue growth for partner agencies'],
                    ['num' => '14', 'label' => 'Days to first client campaign live'],
                    ['num' => '100%', 'label' => 'Branded reports — your logo, your colors'],
                    ['num' => '0', 'label' => 'Direct contact between us and your client'],
                ],
            ]],
            ['pain', 'The agency squeeze', [
                'section_class' => 'sec-mist',
                'eyebrow' => 'The agency squeeze',
                'title_html' => 'Winning the client was easy. <span class="hl">Delivering the SEO is where it breaks.</span>',
                'lede' => 'You sold the retainer. Now they want rankings, traffic, and a report every month — and SEO isn\'t something you can hand to just anyone. Sound familiar?',
                'cards' => [
                    [
                        'title' => 'Your team is already maxed out',
                        'body' => 'Every new SEO client stretches a small team thinner. Audits, keyword research, and content pile up — and delivery quality is the first thing to slip.',
                        'icon_key' => 'team',
                    ],
                    [
                        'title' => 'Reporting eats your week',
                        'body' => 'Pulling rankings, formatting dashboards, writing the recap — hours gone every month on work that doesn\'t win you a single new deal.',
                        'icon_key' => 'report',
                    ],
                    [
                        'title' => 'Hiring in-house is slow and expensive',
                        'body' => 'A senior SEO costs a full salary plus a stack of paid tools, and takes months to find. That\'s a heavy bet for a service line you\'re still testing.',
                        'icon_key' => 'clock',
                    ],
                    [
                        'title' => 'Results are inconsistent',
                        'body' => 'One campaign flies, the next stalls. Without a repeatable process, quality swings — and your client starts questioning the invoice.',
                        'icon_key' => 'traffic',
                    ],
                    [
                        'title' => 'You\'re turning good clients away',
                        'body' => 'Demand you can\'t fulfill is revenue you hand to a competitor. Saying "no" to SEO work quietly caps how far your agency can grow.',
                        'icon_key' => 'links',
                    ],
                    [
                        'title' => 'Overpromising, then scrambling',
                        'body' => 'To close the deal you said yes to everything. Now you\'re stitching SEO together on the fly and hoping the numbers move before the renewal call.',
                        'icon_key' => 'structure',
                    ],
                ],
            ]],
            ['cost', 'The math on hiring', [
                'eyebrow' => 'The math on hiring',
                'title' => 'Building an SEO department in-house is the expensive way to solve this.',
                'lede' => 'Before you post that job listing, here\'s what going in-house actually costs you — in cash, time, and focus:',
                'image' => $heroImage,
                'list' => [
                    ['html' => '<b>A full senior salary</b> for one experienced SEO — before benefits, before you\'ve served a single extra client.'],
                    ['html' => '<b>Months of hiring and onboarding</b> before that person is productive and trusted with client accounts.'],
                    ['html' => '<b>A paid tool stack</b> — rank trackers, audit crawlers, backlink data — stacking up every month whether you win work or not.'],
                    ['html' => '<b>Your own attention</b> pulled off sales and client relationships to manage deliverables instead.'],
                ],
                'closing_html' => 'Our <span class="hl">white label SEO services</span> give you the whole team — strategists, writers, link builders, and a dedicated account lead — for a fraction of that, with none of the fixed risk.',
                'items' => [
                    ['value' => '62%', 'label' => 'Lower cost vs. a first in-house SEO hire'],
                    ['value' => '10k+', 'label' => 'Campaigns delivered behind the scenes'],
                    ['value' => '92%', 'label' => 'On-time delivery across partner accounts'],
                    ['value' => '4–8', 'label' => 'Months to visible ranking movement'],
                ],
            ]],
            ['services', 'What\'s included', [
                'eyebrow' => 'What\'s included',
                'title_html' => 'Our White Label SEO Services — <span class="hl">the full stack, under your name.</span>',
                'lede' => 'Resell any piece or the whole program. Every deliverable ships white-labeled and ready to hand to your client as your own.',
                'cards' => [
                    ['title' => 'SEO Audits & Keyword Research', 'body' => 'Full technical and content audits, plus intent-mapped keyword targets and competitor gap analysis to set the strategy.', 'icon_key' => 'audit'],
                    ['title' => 'On-Page Optimization', 'body' => 'Meta, headings, internal links, and content structure tuned for both search engines and the humans who convert.', 'icon_key' => 'onpage'],
                    ['title' => 'Technical SEO', 'body' => 'Site speed, Core Web Vitals, crawlability, indexation, and schema fixes that clear the way for rankings to land.', 'icon_key' => 'technical'],
                    ['title' => 'Link Building', 'body' => 'White-hat outreach and genuine high-authority placements — no PBNs, no spam — that build lasting domain authority.', 'icon_key' => 'links'],
                    ['title' => 'Content Writing', 'body' => 'Human-written, SEO-driven blogs, landing pages, and service copy built for readers first and rankings second.', 'icon_key' => 'content'],
                    ['title' => 'Local SEO', 'body' => 'Google Business Profile optimization, citations, and location targeting that gets your client into the map pack.', 'icon_key' => 'local'],
                    ['title' => 'Branded Reporting', 'body' => 'Clean, client-ready reports with your logo and colors — rankings, traffic, and wins that prove your value.', 'icon_key' => 'report'],
                    ['title' => 'Dedicated Account Lead', 'body' => 'One point of contact who knows your agency, your clients, and your goals — so nothing gets lost in handoff.', 'icon_key' => 'human'],
                ],
            ]],
            ['process', 'How it works', [
                'section_class' => 'sec-mist',
                'per_desktop' => 4,
                'eyebrow' => 'How it works',
                'title_html' => 'From handshake to first ranking report in <span class="hl">four steps.</span>',
                'lede' => 'No heavy onboarding, no learning curve on your side. You bring the client relationship — we handle everything behind it.',
                'steps' => [
                    ['num' => '01', 'title' => 'Tell us the account', 'body' => 'Share the client\'s site, niche, and goals. We run the initial audit and map out the opportunity — no cost to you.'],
                    ['num' => '02', 'title' => 'Approve the strategy', 'body' => 'You get a clear roadmap with deliverables, timelines, and KPIs. Nothing ships until it matches what you sold.'],
                    ['num' => '03', 'title' => 'We execute quietly', 'body' => 'Audits, on-page, content, and links get done under your brand while you focus on closing the next deal.'],
                    ['num' => '04', 'title' => 'You present the wins', 'body' => 'Branded reports land on schedule. You share the results, keep the credit, and grow the retainer.'],
                ],
            ]],
            ['why', 'Why KodRank', [
                'section_class' => 'sec-ink',
                'eyebrow' => 'Why partner with KodRank',
                'title_html' => 'A fulfillment partner that acts like <span class="hl">part of your team.</span>',
                'lede' => 'Plenty of providers will take your order. Fewer will protect your brand, hit your deadlines, and make you look good to the client every single month.',
                'cards' => [
                    ['title' => '100% invisible to your client', 'body' => 'Reports, dashboards, emails, deliverables — all under your brand. We stay behind the scenes, always, backed by a strict NDA.', 'icon_key' => 'whitelabel'],
                    ['title' => 'Data-driven, not guesswork', 'body' => 'Every campaign runs on a proven playbook and real analytics — keyword relevance, technical precision, and links that move rankings.', 'icon_key' => 'report'],
                    ['title' => 'Consistent, on-time delivery', 'body' => 'Deadlines you can build client promises around. No dropped balls, no last-minute scrambling before the renewal call.', 'icon_key' => 'clock'],
                    ['title' => 'Tailored to every niche', 'body' => 'Local service business or competitive national brand — we adapt the strategy to the client instead of forcing a template.', 'icon_key' => 'structure'],
                    ['title' => 'Full team, one roof', 'body' => 'Strategists, writers, technical specialists, and link builders — all the roles you\'d have to hire, without the payroll.', 'icon_key' => 'team'],
                    ['title' => 'Scales with you', 'body' => 'Add or pause campaigns as your client list moves. No hiring, no firing — just fulfillment that flexes to your pipeline.', 'icon_key' => 'traffic'],
                ],
            ]],
            ['compare', 'Compare', [
                'eyebrow' => 'The honest comparison',
                'title_html' => 'Doing it alone vs. <span class="hl">partnering with KodRank.</span>',
                'other' => [
                    'tag' => 'Going it alone',
                    'title' => 'In-house or DIY',
                    'items' => [
                        'Full salary plus paid tools before you serve one client',
                        'Months of hiring and training before anything ships',
                        'Quality swings with whoever has capacity that week',
                        'Hours lost to reporting instead of selling',
                        'Growth capped by your team\'s bandwidth',
                    ],
                ],
                'us' => [
                    'tag' => 'The KodRank way',
                    'title' => 'White label partnership',
                    'items' => [
                        'One predictable cost you mark up at your own margin',
                        'First campaign live in about two weeks',
                        'A proven playbook and a full team on every account',
                        'Branded reports done for you, on schedule',
                        'Take on every client — fulfillment scales with you',
                    ],
                ],
            ]],
            ['testimonials', 'Partner agencies', [
                'eyebrow' => 'Partner agencies',
                'title_html' => 'Agencies that stopped saying <span class="hl">"no" to SEO work.</span>',
                'items' => [
                    [
                        'quote' => 'We were turning away SEO retainers because we couldn\'t staff them. Now KodRank runs fulfillment and we just sell. Same team, double the accounts.',
                        'initials' => 'DM',
                        'name' => 'Daniel M.',
                        'role' => 'Founder, Web & Marketing Studio',
                    ],
                    [
                        'quote' => 'The reports come back branded and on time, every month. I present them like our own work — because to the client, it is. That trust is everything.',
                        'initials' => 'SR',
                        'name' => 'Sara R.',
                        'role' => 'SEO Lead, Growth Agency',
                    ],
                    [
                        'quote' => 'Consistency was our problem — some campaigns worked, some didn\'t. KodRank\'s process fixed that. Retention is up and I finally offer SEO with confidence.',
                        'initials' => 'AK',
                        'name' => 'Adam K.',
                        'role' => 'Director, Digital Agency',
                    ],
                ],
            ]],
            ['faq', 'FAQ', [
                'eyebrow' => 'Common questions',
                'title_html' => 'White Label SEO Services, <span class="hl">answered.</span>',
                'items' => [
                    [
                        'q' => 'What exactly are white label SEO services?',
                        'a' => 'White label SEO services let your agency sell SEO under your own brand while a specialist partner does the work behind the scenes. You own the client relationship, set the pricing, and present the results. We handle audits, keyword research, content, technical fixes, link building, and reporting — all delivered under your name. Your client sees you; they never see us.',
                    ],
                    [
                        'q' => 'Will my clients ever find out you\'re involved?',
                        'a' => 'No. Every report, dashboard, and deliverable carries your logo and branding, and our partnership is protected by an NDA. We never contact your clients directly. You stay the single point of contact and take full credit for the results.',
                    ],
                    [
                        'q' => 'How is this different from hiring an in-house SEO?',
                        'a' => 'Instead of one salaried hire plus a paid tool stack, you get an entire team — strategists, writers, technical specialists, link builders, and a dedicated account lead — for a fraction of the cost. There\'s nothing to recruit, train, or manage, and you can scale campaigns up or down as your client list changes without touching your payroll.',
                    ],
                    [
                        'q' => 'What\'s included in the program?',
                        'a' => 'Full-service fulfillment: technical and content audits, keyword research, on-page optimization, technical SEO, content writing, white-hat link building, local SEO, and fully branded reporting. You can resell the complete program or pick the individual services you need for each account.',
                    ],
                    [
                        'q' => 'How quickly can we onboard a new client?',
                        'a' => 'Most accounts go from kickoff to a live campaign in about two weeks. Once you share the client\'s site and goals, we run the initial audit, build the strategy for your approval, and start execution under your brand — usually within a few business days of sign-off.',
                    ],
                    [
                        'q' => 'Can the reports match my agency\'s branding?',
                        'a' => 'Yes. Reports are fully white-labeled with your logo, colors, and preferred metrics. You can set the reporting frequency and the level of detail so what your client receives always looks like it came straight from your team.',
                    ],
                    [
                        'q' => 'How much involvement do I need to have?',
                        'a' => 'As much or as little as you want. You set the goals, pricing, and brand standards; we handle execution and keep you updated through your dedicated account lead. Most partners stay focused on selling and client relationships while we run fulfillment quietly in the background.',
                    ],
                ],
            ]],
            ['contact', 'Contact', [
                'eyebrow' => 'Let\'s talk fulfillment',
                'title_html' => 'Ready to deliver SEO <span class="hl">without hiring for it?</span>',
                'lede' => 'Tell us about your agency and the accounts you want to serve. We\'ll come back with a white-label plan and pricing you can mark up as your own — no obligation, no hard sell.',
                'points' => [
                    'NDA-backed & confidential',
                    'Reply within one business day',
                ],
                'form_title' => 'Get your white label quote',
                'fields' => [
                    'name_label' => 'Full name',
                    'email_label' => 'Work email',
                    'website_label' => 'Agency website',
                    'service_label' => 'What do you need?',
                    'message_label' => 'Your message',
                    'message_placeholder' => 'Tell us about your clients, timelines, monthly volume, or anything specific you want us to know…',
                ],
                'service_options' => [
                    'Full white label SEO program',
                    'Link building only',
                    'Content writing only',
                    'Technical SEO / audits',
                    'Local SEO',
                    'Not sure yet — advise me',
                ],
                'default_service' => 'Full white label SEO program',
                'submit_text' => 'Send & get my quote',
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
