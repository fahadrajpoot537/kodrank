<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class EcommerceSeoServiceSeeder extends Seeder
{
    public function run(): void
    {
        $parent = ServicePage::query()->where('slug', 'digital-marketing-services')->first();

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'ecommerce-seo-services'],
            [
                'parent_id' => $parent?->id,
                'name' => 'eCommerce SEO Services',
                'is_active' => true,
                'sort_order' => 8,
                'seo' => [
                    'theme' => 'ecommerce-seo',
                    'hide_from_nav' => true,
                    'seo_title' => 'eCommerce SEO Services | KodRank — Rank Products, Grow Store Revenue',
                    'seo_description' => 'KodRank\'s eCommerce SEO services help online stores rank product and category pages, cut ad dependency, and grow organic revenue. Get a free store audit.',
                    'og_title' => 'eCommerce SEO Services | KodRank',
                    'og_description' => 'Rank product and category pages, cut ad dependency, and grow organic store revenue with KodRank eCommerce SEO.',
                    'og_image' => 'media/services/ecommerce-seo/ecommerce-seo-services-banner-hero.webp',
                    'keywords' => 'eCommerce SEO services, product page SEO, category SEO, Shopify SEO, WooCommerce SEO, KodRank',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();

        $sections = [
            ['hero', 'Hero', [
                'eyebrow' => 'eCommerce SEO Agency',
                'title_html' => 'eCommerce SEO Services<br>That Turn Product Pages Into<br><span class="hl">Paying Customers</span>',
                'lede' => 'Most stores lose sales they never see — deep product pages that never rank, category pages Google ignores, ad spend covering for weak organic search. We fix all of it, so search becomes your cheapest, highest-converting channel.',
                'cta_text' => 'Get a free store audit',
                'cta_url' => '#contact',
                'trust' => [
                    ['value' => 'Rank', 'label' => 'Product & category pages'],
                    ['value' => 'Own', 'label' => 'Traffic instead of renting ads'],
                    ['value' => 'AI', 'label' => 'Google, Overviews & ChatGPT'],
                ],
            ]],
            ['intro', 'Introduction', [
                'eyebrow' => 'Introduction',
                'title' => 'eCommerce SEO Services Built Around Revenue, Not Vanity Metrics',
                'kicker' => 'Human-led eCommerce SEO services for store owners who are done guessing.',
                'paragraphs_html' => [
                    ['html' => 'Rankings that don\'t sell are just a report you scroll past. At KodRank, every recommendation ties back to one question: <strong>does this bring qualified buyers to your store and help them check out?</strong> We start with a full audit of your catalog, then fix what\'s actually holding traffic back — broken crawl paths, thin category pages, duplicate variants, sluggish load times — before we ever touch link building.'],
                    ['html' => 'No templated checklists. No outsourced guesswork. Just a senior team that has ranked stores on Shopify, WooCommerce, Magento, and custom stacks, writing <span class="hl">original strategy and copy</span> for yours.'],
                ],
                'card_value' => '+187%',
                'card_label' => 'Avg. organic revenue in 9 months',
                'card_rows' => [
                    '6.4× more indexed product pages, on average',
                    '120+ online stores ranked & scaled',
                    'Rank product & category pages buyers actually type',
                ],
            ]],
            ['pain', 'Sound familiar?', [
                'eyebrow' => 'Sound familiar?',
                'title_html' => 'The reasons your store isn\'t showing up — and isn\'t selling',
                'lede' => 'Most stores don\'t have a traffic problem. They have a findability problem. Here\'s what\'s usually draining your organic sales.',
                'cards' => [
                    ['title' => 'Thousands of pages, none of them rank', 'body' => 'Google crawls a fraction of your catalog. Deep product pages never get indexed, so they can never be found or bought.'],
                    ['title' => 'Weaker competitors outrank you', 'body' => 'Stores with worse products sit above you simply because their site structure and links are cleaner. That\'s fixable.'],
                    ['title' => 'Every sale is rented from ads', 'body' => 'The moment you pause spend, traffic dies. Rising CPCs quietly eat your margin while organic sits untapped.'],
                    ['title' => 'Faceted filters create duplicate chaos', 'body' => 'Colors, sizes, and sort orders spawn endless near-identical URLs that split ranking signals and confuse crawlers.'],
                    ['title' => 'Slow pages kill the conversion', 'body' => 'A visitor who waited to load isn\'t a visitor who buys. Poor Core Web Vitals hurt both rankings and checkout rates.'],
                    ['title' => 'You\'re invisible in AI answers', 'body' => 'Shoppers now ask ChatGPT and AI Overviews for product picks. If your store isn\'t cited, that demand goes to rivals.'],
                ],
            ]],
            ['services', 'What\'s included', [
                'eyebrow' => 'What\'s included',
                'title_html' => 'Everything your store needs to rank and sell',
                'lede' => 'A complete program — not a single tactic. Each piece is scoped to your catalog and priced transparently after the audit.',
                'cards' => [
                    ['title' => 'Technical eCommerce SEO', 'body' => 'Crawl budget, indexation, site architecture, Core Web Vitals, canonicalization, and schema — the foundation everything else stands on.'],
                    ['title' => 'Category & Product Page Optimization', 'body' => 'We turn your money pages into ranking machines — intent-matched titles, descriptions, internal links, and layouts that convert.'],
                    ['title' => 'Buyer-Intent Keyword Research', 'body' => 'We map the exact phrases shoppers use before they buy — high-commercial-intent terms, not the vanity keywords that never convert.'],
                    ['title' => 'Content & Product Copy', 'body' => 'Original product descriptions, buying guides, and comparison content that earn rankings and give shoppers a reason to click "add to cart."'],
                    ['title' => 'Authority Link Building', 'body' => 'Clean, editorially-earned backlinks to your priority categories — the trust signals that finally move competitive terms.'],
                    ['title' => 'AI Search & AEO Visibility', 'body' => 'We structure your product data and content so your store gets surfaced and cited inside AI Overviews and chat-based shopping.'],
                ],
            ]],
            ['process', 'How we work', [
                'eyebrow' => 'How we work',
                'title_html' => 'A clear path from audit to compounding revenue',
                'lede' => 'No black boxes. You\'ll always know what we\'re doing, why, and what it\'s moving.',
                'steps' => [
                    ['num' => '01', 'title' => 'Audit & discovery', 'body' => 'We dig into your store, catalog, competitors, and analytics to find what\'s really blocking growth.'],
                    ['num' => '02', 'title' => 'Strategy & roadmap', 'body' => 'You get a prioritized plan tied to revenue — fixed first by impact, not by what\'s easy.'],
                    ['num' => '03', 'title' => 'Technical fixes', 'body' => 'Crawl, index, speed, and structure get cleaned up so every page has a fair shot at ranking.'],
                    ['num' => '04', 'title' => 'Content & authority', 'body' => 'We optimize money pages, publish intent-led content, and earn the links that build trust.'],
                    ['num' => '05', 'title' => 'Report & iterate', 'body' => 'Transparent monthly reporting on rankings, traffic, and revenue — then we double down on winners.'],
                ],
            ]],
            ['stats', 'Why KodRank', [
                'eyebrow' => 'Why KodRank',
                'title_html' => 'A web dev and SEO team under one roof',
                'lede' => 'Most agencies hand you a list of fixes and hope your developers implement them. We build storefronts and rank them — so recommendations actually ship.',
                'points' => [
                    ['title' => 'We implement, not just advise', 'body' => 'Our developers ship the technical fixes ourselves, so nothing stalls in a backlog for six months.'],
                    ['title' => 'Tied to revenue, always', 'body' => 'We report on sales and organic revenue — not just keyword positions that look nice in a slide.'],
                    ['title' => 'Senior people on your store', 'body' => 'No junior hand-offs. The specialists who plan your strategy are the ones executing it.'],
                ],
                'items' => [
                    ['value' => '+187%', 'label' => 'Organic revenue growth'],
                    ['value' => '6.4×', 'label' => 'More pages indexed'],
                    ['value' => '21mo', 'label' => 'Average client retention'],
                    ['value' => '120+', 'label' => 'Stores ranked to date'],
                ],
            ]],
            ['platforms', 'Platforms', [
                'eyebrow' => 'Platform experience',
                'title' => 'We speak your store\'s language',
                'lede' => 'Hands-on with the platforms online stores actually run on — no forced replatforming.',
                'items' => ['Shopify', 'WooCommerce', 'Magento', 'BigCommerce', 'Wix', 'Custom builds'],
            ]],
            ['testimonials', 'In their words', [
                'eyebrow' => 'In their words',
                'title' => 'Store owners who stopped guessing',
                'items' => [
                    ['quote' => 'They found indexing issues three agencies missed. Within a few months our best category pages were finally ranking — and it showed up in sales, not just a report.', 'initials' => 'AR', 'name' => 'Ayesha R.', 'role' => 'Founder, Home & Décor store'],
                    ['quote' => 'What sold me was that they fixed the technical side themselves. No more waiting on my dev team. Organic is now our biggest channel by revenue.', 'initials' => 'MD', 'name' => 'Marcus D.', 'role' => 'Head of Growth, Apparel brand'],
                    ['quote' => 'Straight, honest, and clearly senior. They told us what wouldn\'t work as fast as what would, and the roadmap actually reflected our margins.', 'initials' => 'SK', 'name' => 'Sana K.', 'role' => 'Owner, Supplements store'],
                ],
            ]],
            ['faq', 'FAQ', [
                'eyebrow' => 'Questions',
                'title_html' => 'eCommerce SEO services, answered',
                'items' => [
                    ['q' => 'How much do eCommerce SEO services cost?', 'a' => 'It depends on your catalog size, competition, and how much technical debt your store is carrying. Most stores work with us on a monthly retainer. Every engagement starts with a free audit and a fixed-scope proposal, so you see exactly what you\'re paying for before you commit.'],
                    ['q' => 'How long until I see results?', 'a' => 'Technical wins — indexation, speed, crawl fixes — can show within the first few weeks. Meaningful movement on competitive product and category terms typically builds over three to six months and keeps compounding, because SEO is an asset, not an ad you switch off.'],
                    ['q' => 'Which platforms do you support?', 'a' => 'Shopify, WooCommerce, Magento, BigCommerce, Wix, and custom builds. As a web development and SEO team, we adapt to your existing stack instead of pushing an expensive replatform you don\'t need.'],
                    ['q' => 'Is the content written by real people or AI?', 'a' => 'Real people. Strategy, product copy, and content are written by our team for your store and your buyers — original, on-brand, and built to rank, never spun or mass-generated.'],
                    ['q' => 'Do you work with our in-house team?', 'a' => 'Both ways work. If you have developers and writers, we lead strategy and hand off clear, prioritized tasks. If you\'d rather we handle everything, our team implements the fixes and ships the content end to end.'],
                    ['q' => 'Can you help us show up in AI search?', 'a' => 'Yes. We structure your product data, categories, and content so your store can be surfaced and cited in AI Overviews and chat-based shopping — capturing high-intent demand that\'s moving out of classic search results.'],
                ],
            ]],
            ['contact', 'Contact', [
                'eyebrow' => 'Contact',
                'title_html' => 'Request your free <span class="hl">store audit</span>',
                'lede' => 'Tell us about your store and we\'ll come back with the crawl and indexing gaps, the category pages leaving money on the table, and the fastest path to organic revenue.',
                'points' => [
                    'No spam, no obligation.',
                    'We reply within 1 business day.',
                    'We only use your details to prepare your audit.',
                ],
                'fields' => [
                    'name_label' => 'Full name',
                    'email_label' => 'Work email',
                    'website_label' => 'Store URL',
                    'service_label' => 'Platform',
                    'message_label' => 'What do you need help with?',
                    'message_placeholder' => 'Tell us about your store, goals, and biggest SEO headache…',
                ],
                'service_options' => ['Shopify', 'WooCommerce', 'Magento', 'BigCommerce', 'Wix', 'Custom / Other'],
                'default_service' => 'Shopify',
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
        ServicePage::forgetNavCache();
    }
}
