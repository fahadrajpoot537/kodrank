<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class ShopifyDevelopmentServiceSeeder extends Seeder
{
    public function run(): void
    {
        $parent = ServicePage::query()->where('slug', 'web-design-and-development-services')->first();

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'shopify-development-services'],
            [
                'parent_id' => $parent?->id,
                'name' => 'Shopify Development Services',
                'is_active' => true,
                'sort_order' => 1,
                'seo' => [
                    'theme' => 'shopify',
                    'seo_title' => 'Shopify Development Services That Convert | KodRank',
                    'seo_description' => 'KodRank builds fast, search-ready Shopify stores that turn traffic into sales. Custom themes, migrations, Shopify Plus, speed & CRO — built by an SEO agency.',
                    'og_title' => 'Shopify Development Services That Convert | KodRank',
                    'og_description' => 'Fast, search-ready Shopify stores that turn traffic into sales. Custom builds, migrations, Shopify Plus, speed & CRO — engineered by an SEO agency.',
                    'og_image' => 'media/services/shopify-development/shopify-development-services-custom-store-build.jpg',
                    'keywords' => 'Shopify development services, custom Shopify theme, Shopify migration, Shopify Plus, Shopify SEO, Shopify speed optimization',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();

        $sections = [
            ['hero', 'Hero', [
                'image' => 'media/services/shopify-development/shopify-development-services-custom-store-build.jpg',
                'image_alt' => 'Shopify development services – custom store interface with eCommerce integrations by KodRank',
                'breadcrumb' => [
                    ['label' => 'Home', 'url' => '/'],
                    ['label' => 'Services', 'url' => '#services'],
                    ['label' => 'Shopify Development Services', 'url' => ''],
                ],
                'title_html' => '<span class="line">Shopify Development</span><span class="line">Services that turn <span class="mark">browsers</span></span><span class="line mark">into buyers</span>',
                'lede_html' => 'You\'re paying for the traffic. It\'s landing on your store. So why isn\'t it buying? KodRank builds and rebuilds Shopify stores that load fast, feel right on mobile, and are engineered to <strong>convert</strong> — by a team that does the SEO too, so you rank <em>and</em> sell.',
                'cta_text' => 'Get a free store teardown',
                'cta_url' => '#contact',
                'strip' => [
                    ['value_html' => '200<span class="mark">+</span>', 'label' => 'Stores built & rebuilt'],
                    ['value_html' => '&lt;2.5<span class="mark">s</span>', 'label' => 'Target load time'],
                    ['value_html' => '100<span class="mark">%</span>', 'label' => 'SEO-ready on handover'],
                ],
            ]],
            ['pain', 'The real problem', [
                'eyebrow' => 'Sound familiar?',
                'title_html' => 'Your traffic isn\'t the problem. <span class="mark">Your store is.</span>',
                'lede' => 'Most store owners think a low conversion rate means they need more visitors. Usually they need a better store. Here\'s what\'s quietly costing you sales right now.',
                'cards' => [
                    ['icon_key' => 'clock', 'title' => 'It loads too slow', 'body' => 'More than half of shoppers leave a page that takes over three seconds. Bloated themes and stacked apps drag your load time — and your revenue — straight down.'],
                    ['icon_key' => 'phone', 'title' => 'Mobile feels broken', 'body' => 'Three in four Shopify visitors are on a phone, yet most stores are designed on a desktop and squeezed down after. Tiny buttons and buried checkout buttons cost you the sale.'],
                    ['icon_key' => 'cart', 'title' => 'Checkout leaks buyers', 'body' => 'Carts fill up and then go quiet. Surprise shipping, clunky forms and a buy button they have to scroll to find quietly drain the customers you already paid to get.'],
                    ['icon_key' => 'search', 'title' => 'Nobody can find you', 'body' => 'A beautiful store that doesn\'t rank is an expensive brochure. If SEO was an afterthought, you\'re stuck buying every visitor through ads.'],
                    ['icon_key' => 'migrate', 'title' => 'Migration scares you', 'body' => 'You know you\'ve outgrown WooCommerce or Magento, but you\'re terrified of losing rankings, data and momentum on switch-over day. So you stall.'],
                    ['icon_key' => 'vanish', 'title' => 'Your last dev vanished', 'body' => 'The site shipped, the invoice cleared, and then silence. No testing, no iteration, no one to call when something breaks at 9pm on launch week.'],
                ],
                'footer_html' => 'Every one of these is fixable. Our <span class="mark">Shopify Development Services</span> exist to close the gap between the traffic you\'re buying and the sales you\'re actually banking — <b>diagnose first, then build only what moves the number.</b>',
                'cta_text' => 'See the fixes',
                'cta_url' => '#services',
            ]],
            ['services', 'What we do', [
                'eyebrow' => 'What we do',
                'title' => 'Shopify Development Services, end to end',
                'lede' => 'Take the whole build or one piece of it. Whether you\'re launching your first store or rescuing one that stopped growing, here\'s how we help — every service built on clean, modular Liquid and Online Store 2.0.',
                'cards' => [
                    ['icon_key' => 'theme', 'title' => 'Custom Shopify theme development', 'body' => 'No off-the-shelf template forced to fit your brand. We build bespoke themes from scratch — flexible sections your team can edit, brand-true design, and 90+ Lighthouse scores baked in.'],
                    ['icon_key' => 'arrow', 'title' => 'Store migration, done safely', 'body' => 'Moving from WooCommerce, Magento, BigCommerce or Salesforce? We map every URL, redirect and data field before we touch a thing — so you keep your rankings, your history and your sanity.'],
                    ['icon_key' => 'bolt', 'title' => 'Speed & Core Web Vitals', 'body' => 'We strip out app bloat, clean up the theme code and tune your images so pages load in under 2.5 seconds. Faster stores don\'t just rank better — they convert dramatically more on mobile.'],
                    ['icon_key' => 'chart', 'title' => 'CRO & conversion design', 'body' => 'Sticky add-to-cart, friction-free checkout, trust signals in the right places, product pages that answer every objection. We test, we iterate, we grow the revenue you already have traffic for.'],
                    ['icon_key' => 'search', 'title' => 'Shopify SEO & content', 'body' => 'This is our home turf. Technical SEO, clean site architecture, structured data and content that earns organic traffic — so the store we build for you shows up in Google and AI answers, not just direct links.'],
                    ['icon_key' => 'plus', 'title' => 'Shopify Plus & custom apps', 'body' => 'High volume, B2B pricing, multi-market? We put Shopify Flow, Scripts, Launchpad and custom apps to work — automating operations and building the features the App Store simply doesn\'t sell.'],
                ],
                'stats' => [
                    ['value_html' => '<span class="mark">2.4×</span>', 'label' => 'Avg. mobile speed gain'],
                    ['value_html' => '<span class="mark">+38%</span>', 'label' => 'Median conversion lift'],
                    ['value_html' => '4–8<span class="mark"> wks</span>', 'label' => 'Typical build to launch'],
                    ['value_html' => '90<span class="mark">+</span>', 'label' => 'Lighthouse score target'],
                ],
            ]],
            ['process', 'Process', [
                'eyebrow' => 'How it works',
                'title_html' => 'A build process that removes the <span class="mark">guesswork</span>',
                'lede' => 'Our Shopify Development Services follow a clear, six-stage path. No mystery, no radio silence — you always know what\'s happening and what\'s next.',
                'steps' => [
                    ['num' => '01', 'title' => 'Discovery', 'body' => 'We dig into your catalog, customers, tech stack and goals before writing a line of code. If a rebuild isn\'t the right call, we\'ll tell you.'],
                    ['num' => '02', 'title' => 'Strategy & scope', 'body' => 'A clear plan: what we build, the SEO architecture, the integrations, the timeline and a fixed number. No surprise invoices later.'],
                    ['num' => '03', 'title' => 'Design', 'body' => 'Conversion-first, mobile-first mockups shaped around how your shoppers actually behave — reviewed with you before anything is coded.'],
                    ['num' => '04', 'title' => 'Development', 'body' => 'Clean, modular Liquid on Online Store 2.0. Fast, secure, and fully editable by your team without a developer on speed-dial.'],
                    ['num' => '05', 'title' => 'QA & launch', 'body' => 'Cross-device testing, redirect mapping and Core Web Vitals checks. We launch carefully so rankings and revenue survive go-live.'],
                    ['num' => '06', 'title' => 'Grow & support', 'body' => 'The real wins come after launch. We test, iterate and optimise on a retainer that flexes with your season and your roadmap.'],
                ],
            ]],
            ['why', 'Why KodRank', [
                'eyebrow' => 'Why KodRank',
                'title_html' => 'Development and SEO from the <span class="mark">same team</span>',
                'lede_html' => 'Most agencies hand you a gorgeous store, then send you off to find someone else to make it rank. We\'re a web development <em>and</em> SEO agency — so search performance is designed into the build, not patched on after launch.',
                'image' => 'media/services/shopify-development/shopify-seo-friendly-store-development.jpg',
                'image_alt' => 'SEO-optimized Shopify development – site architecture, structured data, and conversion-focused design by KodRank',
                'features' => [
                    ['icon_key' => 'search', 'title' => 'SEO built into the code', 'body' => 'Site architecture, structured data, clean URLs and Core Web Vitals are handled during development — so you launch ranking-ready.'],
                    ['icon_key' => 'shield', 'title' => 'Migration without the drop', 'body' => 'Redirects and metadata mapped in advance means you switch platforms without watching your organic traffic fall off a cliff.'],
                    ['icon_key' => 'chart', 'title' => 'We diagnose before we prescribe', 'body' => 'If your store needs a speed fix, not a full rebuild, we\'ll say so. We quote after discovery — never a number before we understand the job.'],
                    ['icon_key' => 'grow', 'title' => 'We don\'t ship and vanish', 'body' => 'Flexible retainers keep testing, updating and improving your store long after launch — because that\'s where the compounding gains live.'],
                ],
                'other' => [
                    'tag' => 'A typical dev shop',
                    'items' => [
                        'Pretty store that Google can\'t find',
                        'SEO is "your problem" after launch',
                        'Migration gambles with your rankings',
                        'Price quoted before they understand you',
                        'Disappears once the invoice clears',
                    ],
                ],
                'us' => [
                    'tag' => 'KodRank',
                    'items' => [
                        ['html' => 'Built to rank <em>and</em> convert from day one'],
                        'SEO engineered into the build',
                        'Migrations that protect your traffic',
                        'Scope and price after discovery',
                        'Ongoing testing and optimisation',
                    ],
                ],
            ]],
            ['industries', 'Industries', [
                'eyebrow' => 'Who we build for',
                'title_html' => 'Shopify Development Services shaped to <span class="mark">how you sell</span>',
                'lede' => 'A fashion store and a B2B wholesaler don\'t sell the same way, so we don\'t build them the same way. Our Shopify Development Services flex to your model.',
                'cards' => [
                    ['icon_key' => 'bag', 'title' => 'Fashion & apparel', 'body' => 'Visual-led stores with fast image loading and merchandising that keeps browsers scrolling to checkout.'],
                    ['icon_key' => 'spark', 'title' => 'Beauty & wellness', 'body' => 'Heavy imagery and loyalty widgets tuned so they build trust without wrecking page speed.'],
                    ['icon_key' => 'wholesale', 'title' => 'B2B & wholesale', 'body' => 'Customer-specific pricing, bulk ordering and tiered workflows that keep purchasing fast and organised.'],
                    ['icon_key' => 'globe', 'title' => 'Subscription & DTC', 'body' => 'Recurring billing, retention flows and campaign-ready pages for brands that live on repeat purchases.'],
                    ['icon_key' => 'electronics', 'title' => 'Electronics & tech', 'body' => 'Comparison tables, spec-rich product pages and clear guidance for longer, higher-value decisions.'],
                    ['icon_key' => 'food', 'title' => 'Food & beverage', 'body' => 'Local delivery logic, bundles and impulse-friendly layouts built for quick, repeat baskets.'],
                    ['icon_key' => 'home', 'title' => 'Home & furniture', 'body' => 'High-AOV storytelling, financing options and rich media for considered, big-ticket purchases.'],
                    ['icon_key' => 'clock', 'title' => 'Not listed? Still yes.', 'body' => 'If you sell on Shopify, we can build for you. Tell us your model on the call and we\'ll shape the store around it.'],
                ],
            ]],
            ['testimonials', 'Testimonials', [
                'eyebrow' => 'Proof, not promises',
                'title_html' => 'Stores we shipped, results they <span class="mark">felt</span>',
                'lede' => 'A store is only as good as the numbers it moves. Here\'s what founders say after working with our team.',
                'items' => [
                    ['quote' => 'We were drowning in ad spend with nothing to show for it. KodRank rebuilt the store and our conversion rate went from 1.6% to 2.7% — same traffic, nearly double the orders.', 'initials' => 'RM', 'name' => 'Rachel M.', 'role' => 'Founder, apparel brand'],
                    ['quote' => 'The Magento migration terrified me. They mapped every redirect first, and we didn\'t lose a single ranking. Traffic actually climbed the month after we switched.', 'initials' => 'DS', 'name' => 'Daniel S.', 'role' => 'eCommerce lead, home goods'],
                    ['quote' => 'Our old site took six seconds to load on mobile. After their speed work it\'s under two, and mobile checkouts jumped over 40%. Best money we\'ve spent this year.', 'initials' => 'PA', 'name' => 'Priya A.', 'role' => 'Owner, beauty & skincare'],
                ],
            ]],
            ['faq', 'FAQ', [
                'eyebrow' => 'Good questions',
                'title' => 'Shopify Development Services FAQs',
                'lede' => 'Still weighing it up? Here are the things founders ask us most before they get started.',
                'items' => [
                    ['q' => 'What do your Shopify Development Services include?', 'a' => 'Custom theme development, platform migration, Shopify Plus builds, custom app work, speed and Core Web Vitals optimisation, conversion rate optimisation, and technical SEO. You can take the full build or just one piece — like a speed fix or a migration.'],
                    ['q' => 'How long does a Shopify store build take?', 'a' => 'Most small-to-medium builds go live in four to eight weeks. Migrations and Shopify Plus projects run longer, depending on your catalog size and integrations. You get a firm timeline after the discovery call — never a made-up one before.'],
                    ['q' => 'Will my store still rank after a redesign or migration?', 'a' => 'Yes. Because we\'re also an SEO agency, we map URLs, redirects, metadata and structured data before launch. That\'s the difference between keeping your traffic and watching it disappear on go-live day.'],
                    ['q' => 'Do you fix slow stores, or only build new ones?', 'a' => 'Both. We take on speed audits, app-bloat cleanups and Core Web Vitals work on existing stores, as well as full custom builds from scratch. If a rebuild isn\'t what you need, we\'ll tell you straight.'],
                    ['q' => 'How much do your Shopify Development Services cost?', 'a' => 'It depends on scope — catalog size, custom features and integrations all move the number. We scope first, then quote. If anyone hands you a price before a discovery call, treat it as a placeholder, not a real estimate.'],
                    ['q' => 'What happens after the store launches?', 'a' => 'We stick around. Flexible retainers cover maintenance, updates, testing and ongoing CRO. Honestly, the biggest gains usually show up after launch, once real shopper behaviour reveals exactly where the friction is.'],
                ],
            ]],
            ['contact', 'Contact', [
                'eyebrow' => 'Let\'s talk',
                'title' => 'Get a free store teardown',
                'lede' => 'Tell us where your store is stuck. We\'ll review it and send back the three things costing you the most sales — no pitch, no obligation. If our Shopify Development Services are the right fit, we\'ll scope it from there.',
                'meta' => [
                    ['label' => 'info@kodrank.com', 'hint' => 'We reply within one business day', 'value' => 'info@kodrank.com', 'icon_key' => 'email'],
                    ['label' => 'Book a discovery call', 'hint' => 'A 30-minute, no-pressure chat', 'value' => '+92 305 9202732', 'icon_key' => 'call'],
                    ['label' => 'Fixed-scope or retainer', 'hint' => 'Whichever fits where you are', 'icon_key' => 'check'],
                ],
                'fields' => [
                    'name_label' => 'Your name',
                    'email_label' => 'Work email',
                    'website_label' => 'Store URL',
                    'service_label' => 'What you need',
                    'message_label' => 'Where\'s it stuck?',
                    'message_placeholder' => 'Traffic\'s fine but sales are flat, mobile feels slow, thinking about migrating...',
                ],
                'service_options' => [
                    'New custom Shopify build',
                    'Migration to Shopify',
                    'Speed & Core Web Vitals fix',
                    'CRO & conversion work',
                    'Shopify SEO',
                    'Shopify Plus / custom app',
                    'Not sure yet',
                ],
                'default_service' => 'New custom Shopify build',
                'submit_text' => 'Send my teardown request',
                'disclaimer' => 'No spam, no obligation. Just a straight answer on what\'s holding your store back.',
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
