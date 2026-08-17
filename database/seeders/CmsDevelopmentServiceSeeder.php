<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class CmsDevelopmentServiceSeeder extends Seeder
{
    public function run(): void
    {
        $parent = ServicePage::query()->where('slug', 'web-design-and-development-services')->first();

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'cms-development-services'],
            [
                'parent_id' => $parent?->id,
                'name' => 'CMS Development Services',
                'is_active' => true,
                'sort_order' => 4,
                'seo' => [
                    'theme' => 'cms',
                    'seo_title' => 'CMS Development Services | KodRank — Web Development & SEO Agency',
                    'seo_description' => 'KodRank builds fast, secure, editable CMS development services engineered to rank. Custom CMS, headless builds, migrations and support — own your website again.',
                    'og_title' => 'CMS Development Services Built to Rank | KodRank',
                    'og_description' => 'A fast, secure CMS your team can run — engineered for search from day one.',
                    'og_image' => 'media/services/cms-development/cms-development-services-web-platform-architecture.jpg',
                    'keywords' => 'CMS development services, custom CMS development, headless CMS, CMS migration, content management system',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();

        $sections = [
            ['hero', 'Hero', [
                'eyebrow' => 'CMS Development Services',
                'title_html' => 'Own your website again with <span class="hl">CMS development services</span> built to rank',
                'lede_html' => 'Stop waiting three days for a developer to swap one headline. We build fast, secure content platforms your whole team can run — and because we’re an SEO shop first, every CMS we ship is engineered to <span class="em">get found on Google and convert the traffic it earns.</span>',
                'cta_text' => 'Get a free CMS audit',
                'cta_url' => '#contact',
                'strip' => [
                    ['value' => '120+', 'label' => 'CMS builds shipped'],
                    ['value' => '43%', 'label' => 'Avg. faster load'],
                    ['value' => '98%', 'label' => 'Rankings kept on migration'],
                    ['value' => '4.9/5', 'label' => 'Client rating'],
                ],
            ]],
            ['pain', 'The real problem', [
                'eyebrow' => 'The real problem',
                'title' => 'Most websites aren’t broken. The CMS underneath them is.',
                'lede' => 'A slow, rigid, developer-only content management system quietly leaks traffic, leads, and hours every single week. Here’s what that looks like on a normal Tuesday — and why off-the-shelf CMS development services rarely fix the root cause.',
                'cards' => [
                    ['num' => '01', 'title' => 'Every edit needs a developer', 'body_html' => 'You email a change, wait two days, then pay for an hour of dev time to move a button. Your marketing team is <span class="em">stuck in a queue</span> instead of shipping.'],
                    ['num' => '02', 'title' => 'Your pages load slowly', 'body_html' => 'Bloated themes and a stack of plugins drag your Core Web Vitals down. Google notices — and so do the visitors who <span class="em">bounce before they read a word.</span>'],
                    ['num' => '03', 'title' => 'It doesn’t fit how you work', 'body_html' => 'Templated systems force your process into someone else’s boxes. You end up <span class="em">fighting the tool</span> every time your content doesn’t match the mold.'],
                    ['num' => '04', 'title' => 'One plugin from a breach', 'body_html' => 'Outdated plugins and patched-together code leave the door open. A single hack can knock you offline — and <span class="em">wipe you out of search</span> overnight.'],
                ],
            ]],
            ['services', 'What we build', [
                'eyebrow' => 'What we build',
                'title' => 'CMS development services built around how your team actually works',
                'lede_html' => 'Whether you need a custom platform from scratch, a headless build, or a rescue of the mess you inherited, our <span class="em">CMS development services</span> cover the full journey — strategy, build, migration, and the support that keeps it running.',
                'cards' => [
                    ['icon_key' => 'code', 'title' => 'Custom CMS development', 'body' => 'Built from the ground up around your workflows, roles, and content types. No bloat, no plugin roulette — just a platform that maps to your business, not the other way round.', 'link_text' => 'Build mine', 'link_url' => '#contact'],
                    ['icon_key' => 'ui', 'title' => 'Headless & composable CMS', 'body' => 'A lightning-fast front end plus a flexible content back end — Strapi, Sanity, Contentful — that feeds your site, app, and channels from one source. Publish once, appear everywhere.', 'link_text' => 'Go headless', 'link_url' => '#contact'],
                    ['icon_key' => 'migrate', 'title' => 'CMS migration', 'body_html' => 'Move off an ageing or slow platform with zero data loss, every URL preserved, and your <span class="em">rankings protected</span> through the switch. No traffic cliff on launch day.', 'link_text' => 'Plan a move', 'link_url' => '#contact'],
                    ['icon_key' => 'integration', 'title' => 'Integrations & automation', 'body_html' => 'Connect your CRM, e-commerce, email, and analytics so content and data flow on their own. Kill the copy-paste and the <span class="em">“which spreadsheet is right?”</span> guessing.', 'link_text' => 'Connect it up', 'link_url' => '#contact'],
                    ['icon_key' => 'seo', 'title' => 'SEO-ready builds', 'body_html' => 'Clean markup, structured data, quick Core Web Vitals, and editable meta on every page. With us, <span class="em">ranking isn’t an add-on</span> bolted on later — it’s poured into the foundation.', 'link_text' => 'Rank higher', 'link_url' => '#contact'],
                    ['icon_key' => 'support', 'title' => 'Support & maintenance', 'body_html' => 'Updates, security patches, backups, and a real person to call when something breaks. Your site stays <span class="em">fast, safe, and current</span> — without you thinking about it.', 'link_text' => 'Stay covered', 'link_url' => '#contact'],
                ],
            ]],
            ['why', 'Why KodRank', [
                'eyebrow' => 'Why KodRank',
                'title' => 'A web build and an SEO team, finally on the same side of the table',
                'lede_html' => 'Most agencies hand you a pretty CMS and leave the ranking to someone else. We don’t split the two. Because SEO is what we do, our <span class="em">CMS development services</span> start with the question every other shop skips: will Google — and your customers — actually find this?',
                'checks' => [
                    'No lock-in and no mystery code — you get clean docs and full ownership.',
                    'A senior developer on your project from day one, not a rotating cast.',
                    'Fixed scope, fixed price, and a launch date we actually hit.',
                ],
                'cta_text' => 'Book a discovery call',
                'cta_url' => '#contact',
                'features' => [
                    ['icon_key' => 'bolt', 'title' => 'Rank-first architecture', 'body' => 'Every CMS we ship is structured to be crawled, indexed, and ranked — fast, clean, and schema-rich by default.'],
                    ['icon_key' => 'edit', 'title' => 'Editable by humans', 'body' => 'Your team publishes, edits, and reorganizes pages without touching code or raising a support ticket.'],
                    ['icon_key' => 'scale', 'title' => 'Built to scale', 'body' => 'Add a page, a language, or a whole new brand site — without an expensive rebuild every time you grow.'],
                    ['icon_key' => 'lock', 'title' => 'Secure by design', 'body' => 'Hardened builds, managed updates, and monitoring — so a stray plugin never becomes a headline.'],
                ],
            ]],
            ['process', 'Process', [
                'eyebrow' => 'How it works',
                'title' => 'From first call to launch, without the guesswork',
                'lede' => 'A clear, five-step path with no vanishing acts. You’ll always know what’s happening, what’s next, and what it costs.',
                'steps' => [
                    ['num' => '01', 'title' => 'Audit & discovery', 'body' => 'We dig into your current setup, content, rankings, and the way your team really works day to day.'],
                    ['num' => '02', 'title' => 'Plan & architecture', 'body' => 'We map content types, user roles, integrations, and the SEO structure before a line of code is written.'],
                    ['num' => '03', 'title' => 'Design & build', 'body' => 'We design the editing experience and build the platform, showing you working progress every sprint.'],
                    ['num' => '04', 'title' => 'Migrate & QA', 'body' => 'We move your content, preserve your URLs, test on real devices, and protect your search rankings.'],
                    ['num' => '05', 'title' => 'Launch & support', 'body' => 'We ship it, train your team, and stay on to keep the site fast, patched, and quietly reliable.'],
                ],
            ]],
            ['stats', 'Stats', [
                'eyebrow' => 'The numbers',
                'title' => 'Results our CMS development services keep repeating',
                'items' => [
                    ['value' => '120', 'unit' => '+', 'label' => 'Content platforms delivered'],
                    ['value' => '43', 'unit' => '%', 'label' => 'Average load-time improvement'],
                    ['value' => '98', 'unit' => '%', 'label' => 'Of migrated URLs kept ranking'],
                    ['value' => '2', 'unit' => '×', 'label' => 'Faster content publishing'],
                ],
            ]],
            ['included', 'Platforms', [
                'eyebrow' => 'Platforms',
                'title' => 'We build on the right platform for you — not the one we’re used to',
                'lede' => 'The best CMS is the one your team can run and Google can read. We’ll recommend the fit, then build it properly — from popular open platforms to a fully custom stack.',
                'tiles' => [
                    ['icon_key' => 'wordpress', 'title' => 'WordPress'],
                    ['icon_key' => 'strapi', 'title' => 'Strapi'],
                    ['icon_key' => 'sanity', 'title' => 'Sanity'],
                    ['icon_key' => 'contentful', 'title' => 'Contentful'],
                    ['icon_key' => 'web', 'title' => 'Webflow'],
                    ['icon_key' => 'shopify', 'title' => 'Shopify'],
                    ['icon_key' => 'statamic', 'title' => 'Statamic'],
                    ['icon_key' => 'stack', 'title' => 'Custom stack'],
                ],
                'note_html' => 'Not sure which one fits? <span class="em">That’s the first thing we figure out together</span> — no pressure, no jargon.',
            ]],
            ['testimonials', 'Testimonials', [
                'eyebrow' => 'What clients say',
                'title' => 'Teams that stopped fighting their CMS',
                'items' => [
                    ['quote' => 'We used to open a ticket for every tiny change. Now my content team ships updates before lunch. The site’s faster and we’re finally on page one for the terms that matter.', 'initials' => 'RM', 'name' => 'Rebecca Mora', 'role' => 'Head of Marketing, Northwind Retail'],
                    ['quote' => 'The migration was the part I dreaded most. KodRank moved 4,000 pages without losing a single ranking. Traffic actually went up the week after launch.', 'initials' => 'DA', 'name' => 'Daniel Achebe', 'role' => 'Founder, Loop Health'],
                    ['quote' => 'They built exactly the CMS we described, not the one that was easiest for them. Editors love it, developers aren’t needed for content, and I finally understand my own website.', 'initials' => 'SP', 'name' => 'Sana Patel', 'role' => 'Ops Director, Vantage Studios'],
                ],
            ]],
            ['faq', 'FAQ', [
                'eyebrow' => 'Questions',
                'title' => 'CMS development services, answered',
                'items' => [
                    ['q' => 'What exactly are CMS development services?', 'a' => 'CMS development services cover everything involved in building, customizing, and maintaining the content management system that runs your website — the tool your team uses to add pages, edit text, publish blog posts, and manage media. Good CMS development goes past installing a template: it means designing the editing experience around your workflow, wiring in the integrations you rely on, and making sure the whole thing loads fast and ranks well.'],
                    ['q' => 'Custom CMS or off-the-shelf — which should I choose?', 'a' => 'It depends on how unusual your content and workflows are. Off-the-shelf platforms are quick and affordable and fit most standard sites. A custom or headless build wins when you’re fighting the limits of a template, running multiple sites or languages, or need tight control over performance and structure. We’ll tell you honestly which one your situation calls for — even when that’s the cheaper option.'],
                    ['q' => 'Will rebuilding or migrating hurt my SEO?', 'a' => 'Not when it’s done properly — and that’s exactly where an SEO-first team earns its keep. We map and preserve your URLs, set up redirects, keep your metadata and structured data intact, and monitor rankings through launch. Across recent migrations, 98% of URLs held their positions, and several clients saw traffic climb once the faster, cleaner build went live.'],
                    ['q' => 'Can my team edit the site without a developer?', 'a' => 'Yes — that’s the whole point. We design the editing interface for the people who’ll actually use it, with clear fields, roles, and guardrails so non-technical staff can publish and update confidently. No code, no tickets, no waiting on us to move a headline.'],
                    ['q' => 'How long does a CMS project take?', 'a' => 'A focused build or migration typically runs four to eight weeks; a large custom platform with heavy integrations can take longer. After discovery we give you a fixed timeline and a launch date — and we plan sprints so you see working progress the whole way through, not just at the end.'],
                    ['q' => 'Do you support the site after launch?', 'a' => 'We do. Our CMS development services include ongoing updates, security patching, backups, monitoring, and a real person to reach when you need one. You can hand maintenance to us entirely or keep it in-house with our documentation and training — your call.'],
                    ['q' => 'How much does it cost?', 'a' => 'Every project is scoped to what you actually need, so there’s no one-size price. After a short discovery call we send a fixed quote with clear line items — no surprise invoices later. The fastest way to a real number is a free CMS audit, where we look at your current setup and tell you what a fix or rebuild would take.'],
                ],
            ]],
            ['cta', 'Final CTA', [
                'eyebrow' => 'Let’s talk',
                'title' => 'Ready for a CMS you can actually run?',
                'body' => 'Book a free CMS audit and we’ll show you exactly where your current setup is costing you speed, rankings, and time — and what a better build would look like.',
                'cta_text' => 'Get your free CMS audit',
                'cta_url' => '#contact',
                'cta2_text' => 'Explore services',
                'cta2_url' => '#services',
            ]],
            ['contact', 'Contact', [
                'eyebrow' => 'Get a quote',
                'title' => 'Tell us about your website',
                'lede' => 'Share a few details and we’ll come back within one business day with next steps and a rough estimate — no obligation, no hard sell.',
                'meta' => [
                    ['label' => 'Email us', 'value' => 'info@kodrank.com', 'icon_key' => 'email'],
                    ['label' => 'Call us', 'value' => '+92 305 9202732', 'icon_key' => 'phone'],
                    ['label' => 'Response time', 'value' => 'Within one business day', 'icon_key' => 'clock'],
                ],
                'fields' => [
                    'name_label' => 'Your name',
                    'email_label' => 'Work email',
                    'company_label' => 'Company',
                    'website_label' => 'Website URL',
                    'service_label' => 'What do you need?',
                    'message_label' => 'What do you need help with?',
                    'message_placeholder' => 'A new CMS, a migration, a rescue job…',
                ],
                'service_options' => ['Custom CMS development', 'Headless & composable CMS', 'CMS migration', 'Integrations & automation', 'SEO-ready build', 'Support & maintenance', 'Not sure yet'],
                'default_service' => 'Custom CMS development',
                'submit_text' => 'Send my request',
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
