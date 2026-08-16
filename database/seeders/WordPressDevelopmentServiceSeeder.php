<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class WordPressDevelopmentServiceSeeder extends Seeder
{
    public function run(): void
    {
        $parent = ServicePage::query()->where('slug', 'web-design-and-development-services')->first();

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'wordpress-development-services'],
            [
                'parent_id' => $parent?->id,
                'name' => 'WordPress Development Services',
                'is_active' => true,
                'sort_order' => 0,
                'seo' => [
                    'theme' => 'wordpress',
                    'seo_title' => 'WordPress Development Services That Convert — KodRank',
                    'seo_description' => "KodRank's WordPress development services cover custom theme builds, speed, security, and SEO-ready architecture — one team, transparent pricing, and a site built to grow with you.",
                    'og_title' => 'WordPress Development Services That Convert — KodRank',
                    'og_description' => 'Custom WordPress websites built for speed, security, and search — without the plugin bloat or the surprise invoices.',
                    'og_image' => 'media/services/wordpress/hero.jpg',
                    'keywords' => 'WordPress development services, custom WordPress development, WordPress speed optimization, WooCommerce development, WordPress migration, WordPress security',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();

        $sections = [
            ['key' => 'hero', 'label' => 'Hero', 'sort_order' => 0, 'data' => [
                'breadcrumb' => [
                    ['label' => 'Home', 'url' => '/'],
                    ['label' => 'Services', 'url' => '/digital-marketing-services'],
                    ['label' => 'WordPress Development', 'url' => ''],
                ],
                'title' => 'WordPress development services built to load fast, rank, and actually hold up.',
                'title_html' => 'WordPress development services <span class="accent">built to load fast, rank, and actually hold up.</span>',
                'lede' => "Most WordPress sites collapse under their own plugins within a year. KodRank's WordPress development services give you a custom-built theme, clean code, and an architecture that's SEO-ready from day one — so you're not rebuilding this again in twelve months.",
                'cta_text' => 'Get A Free Site Audit',
                'cta_url' => '#contact',
                'cta2_text' => "See What's Included",
                'cta2_url' => '#services',
                'badges' => [
                    ['num' => '240+', 'label' => 'WordPress Sites Shipped'],
                    ['num' => '98', 'unit' => '%', 'label' => 'Under 2.5s LCP'],
                    ['num' => '9yrs', 'label' => 'Building On WordPress'],
                    ['num' => '30-day', 'label' => 'Launch Warranty'],
                ],
                'image' => 'media/services/wordpress/hero.jpg',
                'image_alt' => 'WordPress development services architecture diagram showing custom theme development, plugin integration, speed optimization, and security',
            ]],

            ['key' => 'trust', 'label' => 'Trust bar', 'sort_order' => 1, 'data' => [
                'label' => 'Trusted for WordPress builds by',
                'logos' => ['Northline Legal', 'Berkshire Dental Group', 'Cove & Co.', 'Vantage Real Estate', 'Harlow Supply Co.'],
            ]],

            ['key' => 'pain', 'label' => 'The real problem', 'sort_order' => 2, 'data' => [
                'eyebrow' => 'The Real Problem',
                'title' => "Your WordPress site isn't slow by accident — it was built that way",
                'lede' => 'Fifteen plugins stacked on a $9 theme. Nobody documented what any of it does. Every update feels like a gamble. This is what most WordPress "development" actually looks like, and it\'s why so many businesses come to us after a site has already broken once.',
                'cards' => [
                    ['icon_key' => 'speed', 'title' => 'Pages that crawl on mobile', 'body' => 'Bloated themes and unoptimized images push load times past 5 seconds — and every extra second bleeds visitors before they even see your offer.'],
                    ['icon_key' => 'plugin', 'title' => "Plugin conflicts you can't diagnose", 'body' => 'One update breaks the checkout, another kills your homepage layout. Without clean code underneath, every fix is a guess.'],
                    ['icon_key' => 'security', 'title' => "A site that's one hack away from disaster", 'body' => "Outdated cores, nulled plugins, and weak logins turn a WordPress build into an open door. Most breaches trace back to something that should've been patched months earlier."],
                    ['icon_key' => 'seo', 'title' => 'Built with zero SEO foundation', 'body' => "No schema, bloated DOM, broken heading structure. The theme wasn't built for search, so no amount of content strategy on top of it will fully fix that."],
                    ['icon_key' => 'docs', 'title' => 'No one left who understands the build', 'body' => 'The freelancer who built it is long gone. Every new developer has to reverse-engineer the theme before they can touch anything.'],
                    ['icon_key' => 'email', 'title' => 'Editing the site means calling someone', 'body' => 'A theme built without a real content structure means every small change becomes a support ticket instead of a two-minute edit.'],
                ],
            ]],

            ['key' => 'services', 'label' => "What's included", 'sort_order' => 3, 'data' => [
                'eyebrow' => "What's Included",
                'title' => 'Our WordPress development services, end to end',
                'lede' => "We don't hand you a theme and disappear. Our WordPress development services cover the full build — architecture, custom design, backend logic, and the technical SEO foundation your site needs to actually get found.",
                'cards' => [
                    ['icon_key' => 'wordpress', 'title' => 'Custom Theme Development', 'body' => 'A theme built from scratch around your brand and content — not a $59 template with your logo dropped in. Clean, documented, block-editor-native code your team can actually edit.'],
                    ['icon_key' => 'speed', 'title' => 'Speed & Performance Optimization', 'body' => 'Image compression, lazy loading, database cleanup, and server-level caching tuned until your Core Web Vitals actually pass — not just look fine on paper.'],
                    ['icon_key' => 'security', 'title' => 'Website Security Hardening', 'body' => 'Firewall rules, brute-force protection, malware scanning, and a patch schedule that keeps core, theme, and plugins current — so a missed update never becomes a breach.'],
                    ['icon_key' => 'mobile', 'title' => 'Responsive & Mobile-First Design', 'body' => 'Every layout is designed for the phone screen first, then scaled up — because most of your traffic is arriving on mobile, whether your current site accounts for it or not.'],
                    ['icon_key' => 'seo', 'title' => 'SEO-Ready Site Architecture', 'body' => 'Clean URL structure, schema markup, proper heading hierarchy, and a fast, crawlable codebase — the technical groundwork every SEO campaign needs to actually work.'],
                    ['icon_key' => 'integrations', 'title' => 'Plugin Integration & Custom Functionality', 'body' => 'We integrate the tools you need — booking systems, membership logic, custom forms — and build lightweight custom code where a plugin would just add bloat.'],
                    ['icon_key' => 'ecommerce', 'title' => 'WooCommerce Development', 'body' => "Custom storefronts built for conversion — product filtering that works, checkout flows that don't leak revenue, and inventory logic that scales with the catalog."],
                    ['icon_key' => 'migration', 'title' => 'Website Migration & Replatforming', 'body' => 'Moving from Wix, Squarespace, or a tired legacy WordPress build — we migrate content, preserve your rankings, and cut over with no downtime.'],
                    ['icon_key' => 'support', 'title' => 'Ongoing Maintenance & Support', 'body' => 'Monthly core and plugin updates, uptime monitoring, backups, and a real person to call when something looks off — not a ticket queue that answers in three days.'],
                ],
            ]],

            ['key' => 'answer', 'label' => 'Why WordPress, built right', 'sort_order' => 4, 'data' => [
                'eyebrow' => 'Why WordPress, Built Right',
                'title' => "WordPress isn't the problem. Bad WordPress development is",
                'lede' => "WordPress runs a huge share of the web because it's flexible, extendable, and doesn't lock you into one vendor. The businesses that get burned by it almost always got burned by how it was built — not by the platform itself. Here's what changes when the foundation is done properly.",
                'items' => [
                    ['icon_key' => 'speed', 'title' => 'Fewer plugins, more control', 'body' => 'We hand-code what a plugin would normally bolt on. Fewer moving parts means fewer things that can break on the next update.'],
                    ['icon_key' => 'wordpress', 'title' => 'You can edit it without a developer', 'body' => 'Content blocks and templates are structured so your team can update copy, images, and pages without touching code.'],
                    ['icon_key' => 'seo', 'title' => 'Built to be found, not just built', 'body' => "Every WordPress development project ships with clean semantic markup and schema in place — SEO isn't an afterthought bolted on later."],
                    ['icon_key' => 'security', 'title' => 'Documented, not tribal knowledge', 'body' => 'Every build ships with a handover doc — theme structure, custom functions, plugin list — so no future developer starts from zero.'],
                    ['icon_key' => 'migration', 'title' => 'Room to grow, not a rebuild', 'body' => 'The architecture is designed to absorb new pages, new functionality, and new integrations without needing to be torn down.'],
                    ['icon_key' => 'email', 'title' => 'One team, start to finish', 'body' => 'The same developers who build your site are the ones you call after launch — no handoff between a build team and a support team.'],
                ],
            ]],

            ['key' => 'process', 'label' => 'How we work', 'sort_order' => 5, 'data' => [
                'eyebrow' => 'How We Work',
                'title' => "From kickoff to launch, here's exactly what happens",
                'lede' => "No black box. Every WordPress development engagement follows the same five steps, and you'll know what's happening at each one.",
                'steps' => [
                    ['num' => '01', 'title' => 'Discovery & Scope', 'body' => 'We audit your current site (or your goals, if starting fresh), map out pages, functionality, and a fixed price before a line of code gets written.'],
                    ['num' => '02', 'title' => 'Design & Architecture', 'body' => "Wireframes and visual design get approved before development starts, so there's no rebuilding pages after the fact."],
                    ['num' => '03', 'title' => 'Build & Integrate', 'body' => 'Custom theme development, functionality, and integrations happen in a private staging environment you can watch progress on.'],
                    ['num' => '04', 'title' => 'QA & SEO Check', 'body' => 'Cross-browser testing, mobile checks, Core Web Vitals, and a technical SEO pass — before anything touches your live domain.'],
                    ['num' => '05', 'title' => 'Launch & Support', 'body' => 'We handle the cutover, monitor the first 30 days closely, and hand you off to a care plan if you want ongoing coverage.'],
                ],
            ]],

            ['key' => 'stats', 'label' => 'By the numbers', 'sort_order' => 6, 'data' => [
                'eyebrow' => 'By The Numbers',
                'title' => 'What clients actually get from a proper WordPress build',
                'items' => [
                    ['value' => '240+', 'label' => 'WordPress Sites Delivered', 'signal' => true],
                    ['value' => '1.8s', 'label' => 'Average Load Time Post-Launch', 'signal' => false],
                    ['value' => '98%', 'label' => 'Pass Core Web Vitals', 'signal' => true],
                    ['value' => '0', 'label' => 'Breaches On Sites We Maintain', 'signal' => false],
                    ['value' => '4.9/5', 'label' => 'Average Client Rating', 'signal' => true],
                ],
            ]],

            ['key' => 'compare', 'label' => 'Compare builds', 'sort_order' => 7, 'data' => [
                'eyebrow' => 'Custom Build vs. Template Stack',
                'title' => 'The difference shows up six months after launch',
                'lede' => "A cheap theme and a pile of plugins can look fine on day one. The gap opens once you need to change something, an update breaks a feature, or your competitors' sites start outranking yours.",
                'columns' => [
                    ['variant' => 'muted', 'title' => 'Typical WordPress Build', 'items' => [
                        ['mark' => 'x', 'text' => 'Off-the-shelf theme with 10–20 stacked plugins'],
                        ['mark' => 'x', 'text' => 'No documentation, no handover'],
                        ['mark' => 'x', 'text' => 'SEO bolted on after launch, if at all'],
                        ['mark' => 'x', 'text' => 'Updates break things without warning'],
                        ['mark' => 'x', 'text' => 'Support means finding a new freelancer'],
                    ]],
                    ['variant' => 'pro', 'badge' => 'KodRank', 'title' => 'KodRank WordPress Development Services', 'items' => [
                        ['mark' => 'v', 'text' => 'Custom theme, minimal plugins, clean code'],
                        ['mark' => 'v', 'text' => 'Full handover doc and editable content blocks'],
                        ['mark' => 'v', 'text' => 'SEO-ready architecture from day one'],
                        ['mark' => 'v', 'text' => 'Staging-tested updates, monitored uptime'],
                        ['mark' => 'v', 'text' => 'One team for the build and everything after'],
                    ]],
                ],
            ]],

            ['key' => 'why', 'label' => 'Why KodRank', 'sort_order' => 8, 'data' => [
                'eyebrow' => 'Why KodRank',
                'title' => 'What makes our WordPress development services different',
                'lede' => "We're not a marketplace of freelancers or a factory pumping out templated sites. It's one accountable team, from the first wireframe to the maintenance plan a year later.",
                'cards' => [
                    ['icon_key' => 'email', 'title' => 'Fixed pricing, no surprise invoices', 'body' => 'You get a scoped quote before work starts. What we quote is what you pay — no "extra hours" line item at the end.'],
                    ['icon_key' => 'seo', 'title' => 'SEO built in, not bolted on', 'body' => 'Our developers and SEO strategists work off the same brief, so the site is fast and crawlable before content strategy even starts.'],
                    ['icon_key' => 'security', 'title' => "Security isn't an add-on package", 'body' => "Hardening, monitoring, and update discipline are part of every build — not an upsell you find out about after you've been hacked."],
                    ['icon_key' => 'wordpress', 'title' => 'A site your team can actually run', 'body' => "We build for the person who'll be updating pages next year, not just for launch day. Clear blocks, clear naming, no guesswork."],
                    ['icon_key' => 'support', 'title' => '30-day launch warranty', 'body' => 'If something surfaces in the first month that we missed, we fix it — no change order, no debate.'],
                    ['icon_key' => 'migration', 'title' => 'Nine years, one platform', 'body' => "We don't split focus across five CMS platforms. WordPress development is what we do, so we've seen almost every way it can go wrong."],
                ],
            ]],

            ['key' => 'testimonials', 'label' => 'Client stories', 'sort_order' => 9, 'data' => [
                'eyebrow' => 'What Clients Say',
                'title' => 'Businesses that switched to a proper build',
                'items' => [
                    ['quote' => "Our old site went down twice a month and nobody could tell us why. KodRank rebuilt it, and eight months later we've had zero downtime and our load time dropped from 6 seconds to under 2.", 'name' => 'Marcus Reyes', 'role' => 'Owner, Berkshire Dental Group', 'avatar' => 'MR'],
                    ['quote' => "I've hired three different WordPress \"experts\" before this. First team that actually documented what they built. My marketing manager can now edit pages herself without calling anyone.", 'name' => 'Sarah Patton', 'role' => 'Marketing Director, Vantage Real Estate', 'avatar' => 'SP'],
                    ['quote' => "We migrated a 400-product WooCommerce catalog with them and didn't lose a single ranking. Genuinely expected to lose traffic during the cutover — it never happened.", 'name' => 'David Kim', 'role' => 'Founder, Harlow Supply Co.', 'avatar' => 'DK'],
                ],
            ]],

            ['key' => 'faq', 'label' => 'FAQ', 'sort_order' => 10, 'data' => [
                'eyebrow' => 'Questions',
                'title' => 'WordPress development services, straight answers',
                'items' => [
                    ['q' => 'How much do WordPress development services cost?', 'a' => 'Most custom builds land between $3,500 and $18,000, depending on page count, custom functionality, and whether WooCommerce is involved. You get a fixed quote after a short scoping call — not an hourly estimate that grows as we go.'],
                    ['q' => 'How long does a custom WordPress website take to build?', 'a' => 'A standard marketing site takes 4 to 6 weeks from kickoff to launch. Larger builds with custom plugins, membership logic, or a full WooCommerce catalog usually run 8 to 12 weeks.'],
                    ['q' => 'Will my site be built with page builders or custom code?', 'a' => 'We build custom themes on the WordPress block editor and hand-code functionality in PHP rather than stacking page-builder plugins on top of each other. That keeps the codebase lean, fast, and far easier for the next developer to work in.'],
                    ['q' => 'Can you migrate my existing WordPress site without downtime?', 'a' => 'Yes. We build and test the new site in a private staging environment, migrate content and the database during a low-traffic window, and keep the old site as a fallback until DNS has fully propagated.'],
                    ['q' => 'Do you offer ongoing maintenance after launch?', 'a' => 'Every build ships with a 30-day launch warranty, and most clients move onto a monthly care plan afterward covering core and plugin updates, uptime monitoring, backups, and security scans.'],
                    ['q' => 'Do you work with existing designs or Figma files?', 'a' => 'Yes. If you already have brand guidelines or a Figma design, we build the WordPress theme to match it exactly rather than starting design from zero.'],
                    ['q' => 'What happens if a plugin update breaks something after launch?', 'a' => "Sites on a care plan get updates tested in staging before they touch production, so this rarely happens. If it does, it's covered under the plan — not billed as an emergency fix."],
                ],
            ]],

            ['key' => 'cta', 'label' => 'Final CTA', 'sort_order' => 11, 'data' => [
                'eyebrow' => 'Ready When You Are',
                'title' => "Let's build a WordPress site that doesn't need rescuing next year",
                'body' => "Send us your current site or your project brief. You'll get a straight answer on scope, timeline, and price — no sales pitch attached.",
                'cta_text' => 'Get A Free Site Audit',
                'cta_url' => '#contact',
            ]],

            ['key' => 'contact', 'label' => 'Contact', 'sort_order' => 12, 'data' => [
                'eyebrow' => 'Get In Touch',
                'title' => "Tell us about the site. We'll tell you the plan.",
                'lede' => "Fill this out and within one business day you'll get a personal reply from a developer — not a bot — with a few specific notes on your current site and how we'd approach the build.",
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
                    'company_label' => 'Current Website (If Any)',
                    'service_label' => "I'm Interested In",
                    'message_label' => "What's going on with your site?",
                    'message_placeholder' => 'Current platform, page count, timeline, anything that matters…',
                ],
                'service_options' => [
                    'New Custom WordPress Website',
                    'WordPress Site Redesign',
                    'WooCommerce Store Build',
                    'Speed & Performance Optimization',
                    'Security Hardening',
                    'Website Migration',
                    'Ongoing Maintenance Plan',
                    'Not Sure — Need Advice',
                ],
                'default_service' => 'New Custom WordPress Website',
                'submit_text' => 'Send & Get A Personal Reply',
            ]],
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
