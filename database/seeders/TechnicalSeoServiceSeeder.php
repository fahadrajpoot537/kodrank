<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class TechnicalSeoServiceSeeder extends Seeder
{
    public function run(): void
    {
        $parent = ServicePage::query()->where('slug', 'digital-marketing-services')->first();

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'serviceType' => 'Technical SEO Services',
            'provider' => [
                '@type' => 'Organization',
                'name' => 'KodRank',
                'url' => 'https://www.kodrank.com',
            ],
            'areaServed' => 'Worldwide',
            'description' => 'Technical SEO services covering full-site audits, crawlability, Core Web Vitals, indexation, structured data, and site migration SEO.',
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name' => 'Technical SEO Services',
                'itemListElement' => [
                    ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Technical SEO Audit']],
                    ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Site Migration SEO']],
                    ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Core Web Vitals Optimization']],
                ],
            ],
        ];

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'technical-seo-services'],
            [
                'parent_id' => $parent?->id,
                'name' => 'Technical SEO Services',
                'is_active' => true,
                'sort_order' => 2,
                'seo' => [
                    'theme' => 'seo-service',
                    'seo_title' => 'Technical SEO Services | Fix Crawl, Index & Speed Issues — KodRank',
                    'seo_description' => 'KodRank\'s technical SEO services find and fix the crawl errors, indexation gaps, and speed issues holding your rankings back. Get a free technical SEO audit.',
                    'og_title' => 'Technical SEO Services | KodRank',
                    'og_description' => 'Technical SEO services that find and fix the crawl, indexation, and speed issues blocking your rankings — backed by a prioritized, revenue-ranked roadmap.',
                    'og_image' => 'media/services/technical-seo/technical-seo-services-dashboard-hero.jpg',
                    'og_type' => 'website',
                    'keywords' => 'technical SEO services, crawlability, Core Web Vitals, indexation, structured data, site migration SEO, KodRank',
                    'robots' => 'index, follow',
                    'canonical_url' => 'https://www.kodrank.com/services/technical-seo/',
                    'schema_json' => json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT),
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
                    'eyebrow' => '— Technical SEO Services',
                    'breadcrumb' => [
                        ['label' => 'Home', 'url' => '/'],
                        ['label' => 'Services', 'url' => '#'],
                        ['label' => 'Technical SEO Services', 'url' => ''],
                    ],
                    'title' => 'Technical SEO Services Built to Fix What\'s Actually Holding Your Rankings Back',
                    'title_accent' => 'Holding Your Rankings Back',
                    'title_html' => 'Technical SEO Services Built to Fix What\'s Actually <span class="hl">Holding Your Rankings Back</span>',
                    'lede' => 'Great content doesn\'t rank on a broken foundation. Our technical SEO services find the crawl errors, indexation gaps, and speed issues search engines are quietly penalizing you for — then fix them, so every page you publish finally gets a fair shot at ranking.',
                    'cta_text' => 'Get a Free Technical SEO Audit',
                    'cta_url' => '#contact',
                    'badges' => [
                        ['num' => '187%', 'label' => 'Avg. organic traffic lift'],
                        ['num' => '3,400+', 'label' => 'Technical issues resolved'],
                        ['num' => '45 days', 'label' => 'Avg. full-site audit'],
                    ],
                    'image' => 'media/services/technical-seo/technical-seo-services-dashboard-hero.jpg',
                    'image_alt' => 'Technical SEO services dashboard showing site performance, crawl data, and architecture diagram',
                    'visual_aria_label' => 'Technical SEO services dashboard showing site performance, crawl data, and architecture diagram',
                ],
            ],
            [
                'key' => 'problem',
                'label' => 'Problem',
                'sort_order' => 1,
                'data' => [
                    'eyebrow' => '— The Problem',
                    'title' => 'Why Your Rankings Are Stuck, Even When Your Content Is Good',
                    'title_html' => 'Why Your Rankings Are Stuck, Even When Your Content Is Good',
                    'lede' => 'Most sites don\'t need more blog posts. They need someone to look under the hood. If any of this sounds familiar, it\'s usually a sign that technical SEO services — not more content — are what\'s missing from your strategy.',
                    'cards' => [
                        [
                            'title' => 'Traffic Flatlined After a Redesign',
                            'body' => 'Your dev team relaunched the site, redirects got missed, and rankings that took years to build quietly disappeared in weeks.',
                            'icon_key' => 'traffic',
                        ],
                        [
                            'title' => 'Google Isn\'t Indexing What Matters',
                            'body' => 'Search Console shows "crawled, not indexed" on your best content, and nobody on the team can explain why.',
                            'icon_key' => 'search',
                        ],
                        [
                            'title' => 'Core Web Vitals Keep Failing',
                            'body' => 'Marketing blames dev, dev blames the CMS, and page speed keeps failing Google\'s thresholds every quarter.',
                            'icon_key' => 'speed',
                        ],
                        [
                            'title' => 'Duplicate Pages Dilute Your Authority',
                            'body' => 'Faceted navigation, tag pages, and old posts are splitting ranking signals across near-identical URLs.',
                            'icon_key' => 'links',
                        ],
                        [
                            'title' => 'You\'re Guessing at What to Fix First',
                            'body' => 'A generic audit handed you 200 flagged issues with zero prioritization, so nothing ever actually gets fixed.',
                            'icon_key' => 'stuck',
                        ],
                        [
                            'title' => 'Every Dev Sprint Risks Breaking SEO',
                            'body' => 'New features ship without anyone checking canonicals, robots.txt, or schema — and the site quietly bleeds visibility.',
                            'icon_key' => 'technical',
                        ],
                    ],
                    'closing' => 'If two or more of these sound like your site, it\'s time for technical SEO services that actually diagnose the root cause — not another surface-level checklist.',
                    'closing_html' => 'If two or more of these sound like your site, it\'s time for <em class="hl">technical SEO services</em> that actually diagnose the root cause — not another surface-level checklist.',
                ],
            ],
            [
                'key' => 'services',
                'label' => 'Services',
                'sort_order' => 2,
                'data' => [
                    'eyebrow' => '— What\'s Included',
                    'title' => 'Our Technical SEO Services Cover Every Layer of Your Site',
                    'title_html' => 'Our Technical SEO Services Cover Every Layer of Your Site',
                    'lede' => 'Technical SEO isn\'t one fix — it\'s a set of interconnected systems. We work through all of them, so the rest of your marketing has something solid to build on.',
                    'image' => 'media/services/technical-seo/technical-seo-services-website-architecture.jpg',
                    'cards' => [
                        [
                            'title' => 'Technical SEO Audits',
                            'body' => 'A full crawl and log-file analysis, prioritized by revenue impact instead of a raw issue count.',
                            'icon_key' => 'audit',
                        ],
                        [
                            'title' => 'Site Architecture & Crawlability',
                            'body' => 'A logical URL structure, internal linking, and XML sitemaps built for how crawlers actually move through a site.',
                            'icon_key' => 'structure',
                        ],
                        [
                            'title' => 'Core Web Vitals & Page Speed',
                            'body' => 'LCP, INP, and CLS fixes across both desktop and mobile, tied to the elements actually slowing you down.',
                            'icon_key' => 'speed',
                        ],
                        [
                            'title' => 'Indexation & Canonicalization',
                            'body' => 'Cleaning up duplicate content, index bloat, and orphan pages that are quietly wasting crawl budget.',
                            'icon_key' => 'search',
                        ],
                        [
                            'title' => 'Structured Data & Schema Markup',
                            'body' => 'Implementation validated against Google\'s guidelines, so your pages qualify for rich results.',
                            'icon_key' => 'schema',
                        ],
                        [
                            'title' => 'Site Migration SEO',
                            'body' => 'Full redirect mapping and pre/post-launch monitoring, so a re-platform doesn\'t cost you rankings.',
                            'icon_key' => 'links',
                        ],
                        [
                            'title' => 'International & Multilingual SEO',
                            'body' => 'Hreflang audits and fixes for sites serving multiple countries or languages from one domain.',
                            'icon_key' => 'geo',
                        ],
                        [
                            'title' => 'AI Search Readiness',
                            'body' => 'Structuring content and markup so it can be reliably retrieved and cited by AI Overviews and answer engines.',
                            'icon_key' => 'ai',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'process',
                'label' => 'Process',
                'sort_order' => 3,
                'data' => [
                    'eyebrow' => '— Our Process',
                    'title' => 'How We Deliver Technical SEO Services, Step by Step',
                    'title_html' => 'How We Deliver Technical SEO Services, Step by Step',
                    'lede' => 'No black box. Every engagement follows the same four stages, so you always know what\'s happening and why.',
                    'steps' => [
                        [
                            'num' => '01',
                            'title' => 'Full-Site Technical Audit',
                            'body' => 'We crawl your entire site, analyze server logs, and check indexation against Search Console data to find every real issue.',
                        ],
                        [
                            'num' => '02',
                            'title' => 'Prioritized Fix Roadmap',
                            'body' => 'Every finding gets ranked by traffic and revenue impact, so your team fixes the issues that matter first.',
                        ],
                        [
                            'num' => '03',
                            'title' => 'Hands-On Implementation',
                            'body' => 'We work directly inside your CMS or with your dev team to ship fixes, not just hand over a PDF and disappear.',
                        ],
                        [
                            'num' => '04',
                            'title' => 'Monitoring & Reporting',
                            'body' => 'We track crawl stats, indexation, and rankings monthly, and catch new issues before they cost you traffic.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'stats',
                'label' => 'Stats',
                'sort_order' => 4,
                'data' => [
                    'eyebrow' => '— By the Numbers',
                    'title' => 'What Our Technical SEO Services Actually Move',
                    'title_html' => 'What Our Technical SEO Services Actually Move',
                    'items' => [
                        ['value' => '187%', 'label' => 'Avg. organic traffic increase in 6 months', 'signal' => true],
                        ['value' => '3,400+', 'label' => 'Technical issues diagnosed & resolved', 'signal' => false],
                        ['value' => '45 Days', 'label' => 'Avg. full-site audit turnaround', 'signal' => false],
                        ['value' => '92%', 'label' => 'Clients still active after year one', 'signal' => true],
                    ],
                ],
            ],
            [
                'key' => 'compare',
                'label' => 'Comparison',
                'sort_order' => 5,
                'data' => [
                    'eyebrow' => '— The Difference',
                    'title' => 'Generic SEO Fixes vs. KodRank\'s Technical SEO Services',
                    'title_html' => 'Generic SEO Fixes vs. KodRank\'s Technical SEO Services',
                    'lede' => 'Most agencies stop at a checklist. We stay until the fixes are live and the numbers move.',
                    'columns' => [
                        [
                            'title' => 'Typical Agency',
                            'subtitle' => '',
                            'variant' => 'muted',
                            'items' => [
                                ['mark' => 'x', 'text' => 'Surface-level crawl report with no log-file analysis'],
                                ['mark' => 'x', 'text' => '200-item issue list with no clear priority order'],
                                ['mark' => 'x', 'text' => 'PDF handed off — your dev team implements alone'],
                                ['mark' => 'x', 'text' => 'No migration support or post-launch monitoring'],
                                ['mark' => 'x', 'text' => 'Reports focus on vanity metrics, not rankings or revenue'],
                            ],
                        ],
                        [
                            'title' => 'KodRank Technical SEO Services',
                            'subtitle' => '',
                            'variant' => 'pro',
                            'items' => [
                                ['mark' => 'v', 'text' => 'Full crawl + server log analysis, cross-checked against Search Console'],
                                ['mark' => 'v', 'text' => 'Every fix ranked by traffic and revenue impact'],
                                ['mark' => 'v', 'text' => 'We implement directly with your CMS or dev team'],
                                ['mark' => 'v', 'text' => 'Full redirect mapping and pre/post-launch monitoring'],
                                ['mark' => 'v', 'text' => 'Monthly reporting tied to rankings, indexation, and revenue'],
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
                    'eyebrow' => '— Client Results',
                    'title' => 'What Clients Say About Working With Us',
                    'title_html' => 'What Clients Say About Working With Us',
                    'items' => [
                        [
                            'quote' => 'Our old agency gave us a 90-page audit and left us to figure out the rest. KodRank\'s technical SEO services team told us exactly what to fix first, then fixed most of it themselves.',
                            'name' => 'Rachel Moreno',
                            'role' => 'Head of Growth, SaaS Platform',
                            'avatar' => 'RM',
                            'stars' => '★★★★★',
                        ],
                        [
                            'quote' => 'We lost 40% of our organic traffic after a platform migration. KodRank mapped every redirect and had us fully recovered within two months.',
                            'name' => 'Daniel Kessler',
                            'role' => 'Ecommerce Director',
                            'avatar' => 'DK',
                            'stars' => '★★★★★',
                        ],
                        [
                            'quote' => 'Core Web Vitals had been failing for a year before we called them. Three weeks later every page passed, and rankings started climbing within the month.',
                            'name' => 'Amara Singh',
                            'role' => 'Marketing Lead, B2B Software',
                            'avatar' => 'AS',
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
                    'eyebrow' => '— Common Questions',
                    'title' => 'Technical SEO Services: Frequently Asked Questions',
                    'title_html' => 'Technical SEO Services: Frequently Asked Questions',
                    'items' => [
                        [
                            'q' => 'What\'s included in technical SEO services?',
                            'a' => 'A full technical SEO audit covering crawlability, indexation, site architecture, Core Web Vitals, structured data, canonicalization, and internal linking — followed by a prioritized fix roadmap and hands-on implementation.',
                        ],
                        [
                            'q' => 'How long does a technical SEO audit take?',
                            'a' => 'Most full-site audits take two to six weeks depending on how large your site is, with an average turnaround of around 45 days for larger, more complex builds.',
                        ],
                        [
                            'q' => 'Do I need technical SEO if my content is already good?',
                            'a' => 'Yes. Strong content on a site with crawl errors, indexation gaps, or slow page speed often fails to rank, because search engines can\'t properly access, render, or trust the page in the first place.',
                        ],
                        [
                            'q' => 'How is technical SEO different from on-page SEO?',
                            'a' => 'Technical SEO focuses on how search engines crawl, render, and index your site — speed, architecture, structured data. On-page SEO focuses on the content and keyword relevance of individual pages.',
                        ],
                        [
                            'q' => 'Can you fix problems from a bad site migration?',
                            'a' => 'Yes — migration recovery is one of the most common reasons clients come to us, usually involving redirect mapping, canonical cleanup, and close indexation monitoring until traffic stabilizes.',
                        ],
                        [
                            'q' => 'How soon will I see results?',
                            'a' => 'Indexation and crawl fixes can show movement within a few weeks. Ranking and traffic gains from deeper structural changes typically build over three to six months.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'cta',
                'label' => 'CTA band',
                'sort_order' => 8,
                'data' => [
                    'eyebrow' => '— Get Started',
                    'title' => 'Stop Losing Rankings to Fixable Problems',
                    'title_html' => 'Stop Losing Rankings to Fixable Problems',
                    'body' => 'Book a free technical SEO audit and get a prioritized list of what\'s actually costing you traffic — no obligation, no jargon, just a clear next step.',
                    'cta_text' => 'Get Your Free Technical SEO Audit',
                    'cta_url' => '#contact',
                    'image' => 'media/services/technical-seo/technical-seo-services-ranking-network-diagram.jpg',
                ],
            ],
            [
                'key' => 'contact',
                'label' => 'Contact',
                'sort_order' => 9,
                'data' => [
                    'eyebrow' => '— Talk to Us',
                    'title' => 'Get Your Free Technical SEO Audit',
                    'lede' => 'Tell us about your site and we\'ll come back with real findings — not a generic sales pitch.',
                    'bullets' => [
                        'A real technical SEO specialist reviews your site — not an automated report generator.',
                        'You\'ll hear back within one business day with next steps.',
                        'No lock-in contracts — start with a single audit if that\'s all you need.',
                    ],
                    'meta' => [
                        ['label' => 'Email', 'value' => 'info@kodrank.com', 'icon_key' => 'email'],
                        ['label' => 'Phone', 'value' => '+92 305 9202732', 'icon_key' => 'phone'],
                        ['label' => 'Response Time', 'value' => 'Within one business day', 'icon_key' => 'clock'],
                    ],
                    'fields' => [
                        'first_name_label' => 'First Name',
                        'last_name_label' => 'Last Name',
                        'email_label' => 'Work Email',
                        'phone_label' => 'Phone (Optional)',
                        'company_label' => 'Company',
                        'website_label' => 'Website URL',
                        'service_label' => 'I\'m Interested In',
                        'message_label' => 'What\'s going on with your rankings?',
                        'message_placeholder' => 'Tell us what prompted you to look for technical SEO services...',
                    ],
                    'service_options' => [
                        'Technical SEO Services',
                        'On-Page SEO Services',
                        'Off-Page SEO Services',
                        'GEO Services',
                        'Full Digital Marketing Services',
                        'Not Sure — Need Advice',
                    ],
                    'default_service' => 'Technical SEO Services',
                    'submit_text' => 'Request My Free Audit',
                    'success_message' => 'Thanks — we\'ll be in touch within one business day.',
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
