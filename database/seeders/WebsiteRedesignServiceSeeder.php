<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class WebsiteRedesignServiceSeeder extends Seeder
{
    public function run(): void
    {
        $parent = ServicePage::query()->where('slug', 'web-design-and-development-services')->first();

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'website-redesign-services'],
            [
                'parent_id' => $parent?->id,
                'name' => 'Website Redesign Services',
                'is_active' => true,
                'sort_order' => 3,
                'seo' => [
                    'theme' => 'website-redesign',
                    'seo_title' => 'Website Redesign Services That Convert | KodRank',
                    'seo_description' => 'Website redesign services that improve speed, SEO, usability, and conversions without sacrificing the rankings you have earned.',
                    'og_title' => 'Website Redesign Services That Convert | KodRank',
                    'og_description' => 'Turn a slow, dated website into your best salesperson with a conversion-first redesign.',
                    'og_image' => 'media/services/website-redesign/website-redesign-services-before-after-transformation.jpg',
                    'keywords' => 'website redesign services, professional website redesign, website redesign agency, website migration, conversion focused website design',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();

        $sections = [
            ['hero', 'Hero', [
                'eyebrow' => 'Website Redesign Services',
                'title_html' => 'Website Redesign Services That Turn a Tired Site Into Your <span class="o">Best Salesperson.</span>',
                'lede_html' => 'Your website is the first handshake most customers ever get — and a slow, dated one sends them straight to a competitor. Our website redesign services rebuild your site around one job: <strong>turning visitors into booked calls and paying clients.</strong>',
                'cta_text' => 'Get a free redesign audit',
                'cta_url' => '#contact',
                'strip' => [
                    ['value' => '40+', 'label' => 'Sites rebuilt'],
                    ['value' => '3.4×', 'label' => 'Avg. lead lift'],
                    ['value' => '1.8s', 'label' => 'Avg. load time'],
                    ['value' => '98%', 'label' => 'Client retention'],
                ],
            ]],
            ['pain', 'The real cost of an outdated site', [
                'eyebrow' => 'The real cost of an outdated site',
                'title' => 'Is your current website quietly losing you customers?',
                'lede_html' => 'Most businesses don’t lose leads in a dramatic crash. They lose them slowly — one bounced visitor, one confused click, one “looks a bit old” impression at a time. Here’s where a site that needs <span class="o">professional website redesign services</span> usually leaks money.',
                'cards' => [
                    ['icon' => '🐌', 'title' => 'It loads too slowly', 'body' => 'Every extra second of load time pushes more visitors to hit back before they ever see your offer. Slow sites don’t just annoy people — they cost you sales and rankings.'],
                    ['icon' => '📱', 'title' => 'It falls apart on mobile', 'body' => 'Most of your traffic is on a phone. Pinch-to-zoom menus, tiny buttons and broken layouts make people give up and go to a competitor who got it right.'],
                    ['icon' => '🕰️', 'title' => 'It looks dated', 'body' => 'Visitors judge your credibility in milliseconds. An old design makes a great business look risky, unprofessional, or worse — closed.'],
                    ['icon' => '🧭', 'title' => 'Nobody knows what to do next', 'body' => 'No clear path, a buried contact form, five competing buttons. Confused visitors don’t ask questions — they just leave without converting.'],
                    ['icon' => '🔍', 'title' => 'It’s invisible on Google', 'body' => 'Thin content, slow speed and messy structure quietly sink your rankings. If nobody can find you, even a beautiful site earns nothing.'],
                    ['icon' => '💬', 'title' => 'It talks about the old you', 'body' => 'Your business grew. Your site didn’t. When the messaging no longer matches what you sell today, every visitor gets the wrong first impression.'],
                ],
            ]],
            ['included', 'What you actually get', [
                'eyebrow' => 'What you actually get',
                'title' => 'Website redesign services built around conversions, not just looks',
                'lede' => 'A pretty site that doesn’t sell is just expensive decoration. Every KodRank redesign is engineered to look sharp and pull its weight — faster, clearer, easier to find, and built to turn traffic into revenue.',
                'tiles' => [
                    ['icon' => '◎', 'title' => 'Conversion-first design', 'body' => 'Every page has one clear job and one clear next step.', 'bullets' => ['Message-led hero sections', 'Clear calls-to-action', 'Trust & proof placed to convert']],
                    ['icon' => '⚡', 'title' => 'Speed & Core Web Vitals', 'body' => 'Rebuilt clean so it loads fast and Google approves.', 'bullets' => ['Sub-2-second load targets', 'Optimized images & code', 'Green Core Web Vitals']],
                    ['icon' => '↗', 'title' => 'SEO-safe migration', 'body' => 'Keep the rankings you’ve earned — and climb higher.', 'bullets' => ['Full redirect mapping', 'Preserved & improved structure', 'Technical SEO baked in']],
                    ['icon' => '✎', 'title' => 'Built for you to manage', 'body' => 'Update content confidently without calling a developer.', 'bullets' => ['Clean, editable CMS', 'Reusable page blocks', 'Handover & training']],
                ],
            ]],
            ['process', 'Process', [
                'eyebrow' => 'How it works',
                'title' => 'Our website redesign process, from audit to launch',
                'lede_html' => 'No guesswork, no disappearing for three months. A clear, collaborative path with our <span class="o">website redesign services</span> so you always know what’s happening and why.',
                'steps' => [
                    ['num' => '01', 'title' => 'Audit & discovery', 'body' => 'We dig into your traffic, drop-offs and goals to find exactly what’s costing you leads.'],
                    ['num' => '02', 'title' => 'Strategy & wireframes', 'body' => 'We map the pages, journeys and messaging before a single pixel is styled.'],
                    ['num' => '03', 'title' => 'Design', 'body' => 'On-brand, conversion-focused design that looks current and builds instant trust.'],
                    ['num' => '04', 'title' => 'Build & optimize', 'body' => 'Fast, clean development with SEO, speed and accessibility handled from day one.'],
                    ['num' => '05', 'title' => 'Launch & measure', 'body' => 'We ship it safely, track the numbers, and keep improving what converts.'],
                ],
            ]],
            ['stats', 'Stats', [
                'eyebrow' => 'Redesigns that pay for themselves',
                'title' => 'The numbers our redesigns move',
                'items' => [
                    ['value' => '+214%', 'label' => 'Avg. leads after launch', 'signal' => true],
                    ['value' => '68%', 'label' => 'Faster page loads'],
                    ['value' => '0.05s', 'label' => 'To form a first impression', 'signal' => true],
                    ['value' => '40+', 'label' => 'Websites relaunched'],
                ],
            ]],
            ['compare', 'Before vs after', [
                'eyebrow' => 'Before vs after',
                'title' => 'The difference a real redesign makes',
                'lede' => 'Same business, same traffic — a completely different result once the site stops working against you.',
                'other' => [
                    'tag' => 'Your site today',
                    'title' => 'Working against you',
                    'items' => [
                        'Loads slowly and bounces visitors',
                        'Clunky, frustrating on mobile',
                        'Looks dated and hurts credibility',
                        'No clear path to contact or buy',
                        'Buried under competitors in search',
                        'Hard to edit without a developer',
                    ],
                ],
                'us' => [
                    'tag' => 'After a KodRank redesign',
                    'title' => 'Working for you',
                    'items' => [
                        'Loads in under two seconds',
                        'Flawless, thumb-friendly on mobile',
                        'Modern design that earns trust fast',
                        'One clear path to every conversion',
                        'Structured to rank and be found',
                        'Simple for your team to update',
                    ],
                ],
            ]],
            ['services', 'Redesign done fully', [
                'eyebrow' => 'Redesign, done fully',
                'title' => 'Everything included in our website redesign services',
                'lede' => 'One partner for the whole rebuild — strategy, design, words, code and SEO — so nothing falls through the cracks between freelancers.',
                'cards' => [
                    ['icon' => '◈', 'title' => 'UX & UI design', 'body' => 'Clean, modern interfaces mapped around how your visitors actually decide and buy.', 'link_text' => 'Explore', 'link_url' => '#contact'],
                    ['icon' => '✎', 'title' => 'Conversion copywriting', 'body' => 'Original, human-written messaging that speaks to your customer’s problem — never filler.', 'link_text' => 'Explore', 'link_url' => '#contact'],
                    ['icon' => '◎', 'title' => 'Development', 'body' => 'Fast, secure, standards-based builds on the platform that fits your team best.', 'link_text' => 'Explore', 'link_url' => '#contact'],
                    ['icon' => '↗', 'title' => 'Technical SEO', 'body' => 'Structure, speed and metadata handled so your redesign gains rankings, not loses them.', 'link_text' => 'Explore', 'link_url' => '#contact'],
                    ['icon' => '⇄', 'title' => 'Migration & launch', 'body' => 'Careful redirects and QA so you go live without downtime or lost traffic.', 'link_text' => 'Explore', 'link_url' => '#contact'],
                    ['icon' => '◆', 'title' => 'Care & support', 'body' => 'Ongoing updates, monitoring and tweaks that keep your new site converting.', 'link_text' => 'Explore', 'link_url' => '#contact'],
                ],
            ]],
            ['testimonials', 'Testimonials', [
                'eyebrow' => 'Client results',
                'title' => 'What clients say after the redesign',
                'items' => [
                    ['quote' => 'Our old site looked fine to us — until KodRank showed us how many leads it was losing. Three months after the redesign, enquiries more than doubled. Best money we’ve spent.', 'initials' => 'MR', 'name' => 'Maria Reyes', 'role' => 'Founder, Northline Interiors'],
                    ['quote' => 'They rebuilt the whole thing without dropping a single ranking — we actually climbed. Fast, clear, and they explained every decision. No agency jargon, just results.', 'initials' => 'DT', 'name' => 'David Tan', 'role' => 'Director, Apex Legal'],
                    ['quote' => 'The new site loads instantly and finally works on mobile. Our bounce rate dropped by half and my team can update pages themselves. Wish we’d done it two years ago.', 'initials' => 'SK', 'name' => 'Sarah Klein', 'role' => 'Marketing Lead, Vireo Health'],
                ],
            ]],
            ['faq', 'FAQ', [
                'eyebrow' => 'Good questions',
                'title' => 'Website redesign services FAQ',
                'lede' => 'Everything business owners usually ask before starting a redesign with us.',
                'items' => [
                    ['q' => 'How long do your website redesign services take?', 'a' => 'Most redesigns launch in six to ten weeks, depending on the number of pages and how quickly we get content and feedback. After the discovery audit, you’ll get a clear timeline with milestones — so there are no surprises.'],
                    ['q' => 'Will a redesign hurt my Google rankings?', 'a' => 'Not when it’s done right. We treat SEO as part of the redesign, not an afterthought — mapping every redirect, preserving your best-performing content, and improving site structure and speed. The goal is to protect the rankings you have and gain new ones.'],
                    ['q' => 'Do I need a full redesign or just a refresh?', 'a' => 'It depends on what’s holding you back. If your site is only visually dated, a refresh may be enough. If it’s slow, hard to update, poorly structured or losing leads, a full redesign fixes the foundation. Our free audit tells you honestly which one you need.'],
                    ['q' => 'Can you write the content, or do I have to?', 'a' => 'We can handle it. Our team writes original, human, conversion-focused copy built around your customers and your goals. You review and approve everything — you know your business best, and we make sure the site sounds like you.'],
                    ['q' => 'Which platform will you build on?', 'a' => 'Whatever fits your team and goals — WordPress, Webflow, Shopify or a custom build. We recommend the platform that’s easiest for you to manage long-term, not the one that locks you into us.'],
                    ['q' => 'What does a redesign cost?', 'a' => 'Every project is scoped to its size and goals, so there’s no one-size price. After a quick call and audit we send a fixed, itemized quote — no hourly surprises. Most clients see the redesign pay for itself through the extra leads it brings in.'],
                ],
            ]],
            ['cta', 'Final CTA', [
                'eyebrow' => 'Let’s fix it',
                'title' => 'Ready to give your website a job worth doing?',
                'body' => 'Book a free redesign audit and we’ll show you exactly where your current site is losing leads — and what it’s worth to fix.',
                'cta_text' => 'Get your free redesign audit',
                'cta_url' => '#contact',
            ]],
            ['contact', 'Contact', [
                'eyebrow' => 'Start your redesign',
                'title' => 'Tell us about your site',
                'lede' => 'Send a few details and we’ll get back within one business day with next steps and a free audit of what’s slowing your site down.',
                'meta' => [
                    ['label' => 'Email', 'value' => 'info@kodrank.com', 'note' => 'We reply within one business day', 'icon' => '✉'],
                    ['label' => 'Phone', 'value' => '+92 305 9202732', 'note' => 'Mon–Fri, 9am–6pm', 'icon' => '☎'],
                    ['label' => 'Remote', 'value' => '100% remote', 'note' => 'Working with clients worldwide', 'icon' => '◎'],
                ],
                'fields' => [
                    'name_label' => 'Your name',
                    'email_label' => 'Email',
                    'website_label' => 'Current website',
                    'service_label' => 'What do you need?',
                    'message_label' => 'What’s wrong with your current site?',
                    'message_placeholder' => 'It’s slow, looks old, and we’re barely getting enquiries…',
                ],
                'service_options' => ['Full website redesign', 'Website refresh', 'SEO-safe migration', 'UX & conversion redesign', 'Not sure yet'],
                'default_service' => 'Full website redesign',
                'submit_text' => 'Get my free audit',
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
    }
}
