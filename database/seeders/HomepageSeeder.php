<?php

namespace Database\Seeders;

use App\Models\CmsSection;
use App\Support\CmsPageDefaults;
use Illuminate\Database\Seeder;

class HomepageSeeder extends Seeder
{
    /**
     * Seed homepage CMS sections from the KodRank body_v1 theme.
     */
    public function run(): void
    {
        $sections = [
            [
                'key' => 'site',
                'label' => 'Site settings',
                'sort_order' => 0,
                'data' => [
                    'meta_title' => 'Web Development & SEO Services in One Build | KodRank',
                    'meta_description' => 'KodRank builds fast, technically sound websites with SEO engineered in from the first line of code — so your site launches indexed, structured and ready to rank. One team, one package, no second invoice.',
                    'seo_title' => 'Web Development & SEO Services in One Build | KodRank',
                    'seo_description' => 'KodRank builds fast, technically sound websites with SEO engineered in from the first line of code — so your site launches indexed, structured and ready to rank. One team, one package, no second invoice.',
                    'og_title' => 'Web Development & SEO Services in One Build | KodRank',
                    'og_description' => 'KodRank builds fast, technically sound websites with SEO engineered in from the first line of code — so your site launches indexed, structured and ready to rank. One team, one package, no second invoice.',
                    'og_image' => '/media/hero-poster.jpg',
                    'og_image_alt' => 'KodRank — custom web development and SEO services built to rank from launch day',
                    'hero_image_alt' => 'KodRank — custom web development and SEO services built to rank from launch day',
                    'og_type' => 'website',
                    'twitter_card' => 'summary_large_image',
                    'twitter_site' => '',
                    'canonical_url' => '',
                    'robots' => 'index, follow',
                    'keywords' => 'web development, SEO services, technical SEO, on-page SEO, local SEO, AEO, GEO, answer engine optimization, generative engine optimization, custom websites, e-commerce development, KodRank',
                    'brand_name' => 'KodRank',
                    'logo' => 'logo.png',
                    'phone' => '+92 305 9202732',
                    'email' => 'info@kodrank.com',
                    'copyright' => '© 2026 KodRank. All rights reserved.',
                ],
            ],
            [
                'key' => 'nav',
                'label' => 'Navigation',
                'sort_order' => 1,
                'data' => [
                    'cta_text' => 'Get A Quote',
                    'cta_url' => '/contact',
                    'links' => [
                        ['label' => 'Home', 'url' => '/'],
                        ['label' => 'Industries', 'url' => '/industries'],
                        ['label' => 'Results', 'url' => '/results'],
                        ['label' => 'Insights', 'url' => '/blogs'],
                    ],
                    'industries_mega' => [
                        'eyebrow' => '— Industries',
                        'title_html' => 'Built to <span>Rank</span>',
                        'body' => 'Search and web solutions tuned to how your market actually searches. We grow qualified traffic, leads, and revenue — one industry at a time.',
                        'stats' => [
                            ['value' => '9+', 'label' => 'Industries served'],
                            ['value' => '3.4×', 'label' => 'Avg. traffic lift'],
                        ],
                        'cta_text' => 'Get a free audit',
                        'cta_url' => '/contact',
                        'items' => CmsPageDefaults::industryNavItems(),
                    ],
                    'mega' => [
                        'eyebrow' => 'What we do',
                        'title' => 'Built to be found.',
                        'body' => 'Web development and SEO engineered as one build — so you launch ready to rank.',
                        'cta_text' => 'Get a free audit',
                        'cta_url' => '/contact',
                        'columns' => [
                            [
                                'title' => 'Digital Marketing Services',
                                'url' => '/digital-marketing-services',
                                'links' => [
                                    ['label' => 'On-Page SEO Services', 'url' => '#'],
                                    ['label' => 'Off-Page SEO Services', 'url' => '#'],
                                    ['label' => 'Technical SEO Services', 'url' => '#'],
                                    ['label' => 'GEO Services', 'url' => '#services'],
                                    ['label' => 'AEO Services', 'url' => '#services'],
                                ],
                            ],
                            [
                                'title' => 'Web Development Services',
                                'url' => '#',
                                'links' => [
                                    ['label' => 'WordPress Development Services', 'url' => '/wordpress-development-services'],
                                    ['label' => 'Shopify Development Services', 'url' => '#'],
                                    ['label' => 'AI Chatbot Development Services', 'url' => '/ai-chatbot-development-services'],
                                    ['label' => 'Website Redesign Services', 'url' => '#'],
                                    ['label' => 'CMS Development Services', 'url' => '#'],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'key' => 'hero',
                'label' => 'Hero',
                'sort_order' => 2,
                'data' => [
                    'eyebrow' => '',
                    'title' => 'Web development and SEO services that make your site',
                    'title_em' => 'rank the day it launches.',
                    'sub' => 'Most agencies build your website, then sell you SEO to fix what they broke. We do it once, together.',
                    'supporting' => 'KodRank combines custom web development and SEO into one package — engineered as a single build. You get a fast, technically sound, fully optimized website, with no expensive SEO cleanup waiting for you after launch.',
                    'primary_cta_text' => 'Get your free site audit',
                    'primary_cta_url' => '#contact',
                    'secondary_cta_text' => 'See how it works',
                    'secondary_cta_url' => '#process',
                    'video_alt' => 'KodRank web development and SEO services background video',
                ],
            ],
            [
                'key' => 'strip',
                'label' => 'Tech strip',
                'sort_order' => 3,
                'data' => [
                    'items' => [
                        'Next.js',
                        'React',
                        'WordPress',
                        'Shopify',
                        'Schema.org',
                        'Core Web Vitals',
                    ],
                ],
            ],
            [
                'key' => 'problem',
                'label' => 'Problem',
                'sort_order' => 4,
                'data' => [
                    'eyebrow' => 'The problem nobody warns you about',
                    'title' => 'You paid for a website. Then found out it can’t be found.',
                    'lede' => 'It happens to most business owners. The site looks great — and then it just sits there, invisible on page 5 of Google.',
                    'statement' => 'KodRank removes the handoff entirely. By combining web development and SEO services into <strong>one team that builds the site and the search foundation at the same time</strong>, nothing gets lost between “designed” and “discovered.”',
                    'cards' => [
                        [
                            'num' => '01',
                            'title' => 'The “beautiful but buried” site',
                            'body' => 'Your developer delivered a gorgeous design, then handed you a site with <strong class="warn">no headings, no schema, and no keyword structure</strong>. Pretty doesn’t rank.',
                        ],
                        [
                            'num' => '02',
                            'title' => 'The second invoice',
                            'body' => 'Launch was just the start. Now you need a <strong class="warn">separate SEO agency</strong> to undo slow load times, broken structure, and thin content — for a fee you never budgeted.',
                        ],
                        [
                            'num' => '03',
                            'title' => 'The blame game',
                            'body' => 'Your dev blames SEO. Your SEO blames the dev. You’re stuck in the middle, <strong class="warn">paying two teams</strong> who won’t take responsibility for results.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'process',
                'label' => 'Process',
                'sort_order' => 5,
                'data' => [
                    'eyebrow' => 'How we work',
                    'title' => 'Our web development and SEO services start with research, not a template.',
                    'lede' => 'SEO isn’t a phase we bolt on at the end — it’s the blueprint we build from. Every decision, from your sitemap to your button copy, is made with rankings and conversions in mind from day one.',
                    'steps' => [
                        [
                            'num' => '01',
                            'title' => 'Research first',
                            'body' => 'We map your market, competitors, and the exact keywords your buyers search before a single wireframe exists.',
                            'tag' => 'Keyword + intent mapping',
                        ],
                        [
                            'num' => '02',
                            'title' => 'Architect for search',
                            'body' => 'Your site structure, URLs, and content hierarchy are designed around how Google crawls — and how humans decide.',
                            'tag' => 'SEO-led architecture',
                        ],
                        [
                            'num' => '03',
                            'title' => 'Build it right',
                            'body' => 'Clean code, fast loads, mobile-perfect, schema baked in. Technically sound at the source, not patched later.',
                            'tag' => 'Performance engineering',
                        ],
                        [
                            'num' => '04',
                            'title' => 'Launch ready to rank',
                            'body' => 'You go live optimized — indexed, structured, and written to convert. No cleanup project waiting in the wings.',
                            'tag' => 'Optimized handover',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'get',
                'label' => 'What you get',
                'sort_order' => 6,
                'data' => [
                    'eyebrow' => 'Everything in one package',
                    'title' => 'What you actually get — no add-ons, no asterisks.',
                    'lede' => 'Web development and SEO services engineered together, delivered as one complete, ranking-ready website.',
                    'cards' => [
                        [
                            'title' => 'Custom web development',
                            'body' => 'Hand-built, fast, and secure — no bloated templates that drag your speed and rankings down.',
                            'checks' => [
                                'Responsive across every device',
                                'Clean, crawlable, semantic code',
                                'Sub-second load times',
                            ],
                        ],
                        [
                            'title' => 'Technical SEO, built in',
                            'body' => 'Schema, meta, sitemaps, and Core Web Vitals handled at the code level — not sprinkled on after.',
                            'checks' => [
                                'Structured data & schema markup',
                                'Optimized titles, meta & alt tags',
                                'Passing Core Web Vitals by default',
                            ],
                        ],
                        [
                            'title' => 'Content that ranks & converts',
                            'body' => 'Human-written copy mapped to real search intent — pages people read and Google rewards.',
                            'checks' => [
                                'Keyword-targeted, never keyword-stuffed',
                                'Written to guide visitors to action',
                                'Structured for featured snippets',
                            ],
                        ],
                        [
                            'title' => 'Conversion-first design',
                            'body' => 'Traffic means nothing if it bounces. Every page is designed to turn visitors into customers.',
                            'checks' => [
                                'Clear CTAs & friction-free journeys',
                                'Trust signals in the right places',
                                'Built to convert, not just impress',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'key' => 'services',
                'label' => 'Services',
                'sort_order' => 7,
                'data' => CmsPageDefaults::homepageServices(),
            ],
            [
                'key' => 'difference',
                'label' => 'Difference',
                'sort_order' => 8,
                'data' => [
                    'eyebrow' => 'The KodRank difference',
                    'title' => 'Two teams, two invoices, one headache — or one build that just works.',
                    'lede' => 'The usual route treats search as a phase that starts after the site is live. That is why the first six months are spent undoing decisions no one flagged at the time.',
                    'side_title' => 'Search is not a phase. It is a constraint on the build.',
                    'side_body' => 'Every decision a developer makes — how the sitemap is shaped, how content renders, what the URLs look like, how fast the first paint arrives — either helps you rank or quietly costs you. Retrofitting those decisions is slow, expensive and often partial.',
                    'usual_title' => 'The typical route',
                    'usual_items' => [
                        'Developer builds first, SEO is patched on later',
                        'You find out it cannot rank after paying for it',
                        'A second agency, a second contract, a second bill',
                        'Slow load times and messy code holding you back',
                        'Nobody owns the outcome when rankings do not move',
                    ],
                    'kodrank_title' => 'The KodRank way',
                    'kodrank_items' => [
                        'Development and SEO engineered as one process',
                        'You go live already optimised and ready to rank',
                        'One team, one package, one clear price',
                        'Fast, clean, technically sound from the first commit',
                        'One team fully accountable for your results',
                    ],
                ],
            ],
            [
                'key' => 'industries',
                'label' => 'Industries',
                'sort_order' => 9,
                'data' => [
                    'eyebrow' => 'Industries we serve',
                    'title' => 'We know where the searches are in your sector.',
                    'lede' => 'Search behaviour isn’t generic, so our research isn’t either — from regulated fields to fast-moving retail, we already know the SERP, the intent, and the competition.',
                    'items' => [
                        ['name' => 'Healthcare', 'url' => '#contact'],
                        ['name' => 'eCommerce', 'url' => '#contact'],
                        ['name' => 'Real Estate', 'url' => '#contact'],
                        ['name' => 'Finance & Banking', 'url' => '#contact'],
                        ['name' => 'Technology', 'url' => '#contact'],
                        ['name' => 'Education', 'url' => '#contact'],
                        ['name' => 'Travel', 'url' => '#contact'],
                        ['name' => 'Automotive', 'url' => '#contact'],
                        ['name' => 'Retail', 'url' => '#contact'],
                        ['name' => 'Food & Beverage', 'url' => '#contact'],
                        ['name' => 'Fashion & Apparel', 'url' => '#contact'],
                        ['name' => 'Manufacturing', 'url' => '#contact'],
                        ['name' => 'Entertainment & Media', 'url' => '#contact'],
                        ['name' => 'Non-Profit', 'url' => '#contact'],
                        ['name' => 'Legal Services', 'url' => '#contact'],
                    ],
                ],
            ],
            [
                'key' => 'work',
                'label' => 'Selected work',
                'sort_order' => 10,
                'data' => \App\Support\ResultsPageDefaults::homepageWork(),
            ],
            [
                'key' => 'tech',
                'label' => 'Technologies',
                'sort_order' => 11,
                'data' => [
                    'eyebrow' => 'Technologies we use',
                    'title' => 'Chosen for what they do to your rankings.',
                    'lede' => 'We are not loyal to a stack. We pick what will render fast, stay crawlable and be maintainable by your team after we hand it over.',
                    'columns' => [
                        [
                            'title' => 'Build',
                            'chips' => ['Next.js', 'React', 'TypeScript', 'Astro', 'Laravel', 'Node.js', 'Tailwind', 'Vite'],
                        ],
                        [
                            'title' => 'Platforms',
                            'chips' => ['WordPress', 'WooCommerce', 'Shopify', 'Shopify Plus', 'Webflow', 'Sanity', 'Contentful'],
                        ],
                        [
                            'title' => 'Search & performance',
                            'chips' => ['Schema.org', 'Search Console', 'GA4', 'Semrush', 'Screaming Frog', 'Lighthouse CI', 'Core Web Vitals'],
                        ],
                    ],
                ],
            ],
            [
                'key' => 'stats',
                'label' => 'Stats',
                'sort_order' => 12,
                'data' => [
                    'items' => [
                        ['value' => '100%', 'accent' => true, 'label' => 'Sites launched SEO-ready'],
                        ['value' => '0.9', 'suffix' => 's', 'label' => 'Average page load speed'],
                        ['value' => '1', 'label' => 'Package — dev & SEO combined'],
                        ['value' => '+300', 'suffix' => '%', 'label' => 'Typical organic traffic lift'],
                    ],
                ],
            ],
            [
                'key' => 'testimonials',
                'label' => 'Testimonials',
                'sort_order' => 13,
                'data' => \App\Support\CmsPageDefaults::homepageTestimonials(),
            ],
            [
                'key' => 'faq',
                'label' => 'FAQ',
                'sort_order' => 14,
                'data' => [
                    'eyebrow' => 'Straight answers',
                    'title' => 'The questions you’re right to ask.',
                    'items' => [
                        [
                            'q' => 'Do I still need to hire an SEO agency after you build my site?',
                            'a' => 'No — that’s the entire point. Your website leaves our hands technically sound and fully optimized: structured content, schema, clean code, fast load times, and keyword-targeted pages. There’s no cleanup project waiting for you, because the SEO work is built into the development itself.',
                        ],
                        [
                            'q' => 'What does “web development and SEO services in one package” actually include?',
                            'a' => 'A complete build: custom development, technical SEO, on-page optimization, keyword research and strategy, SEO content writing, and conversion-first design — delivered together as one ranking-ready website, for one price, by one team.',
                        ],
                        [
                            'q' => 'How is this different from a normal web design agency?',
                            'a' => 'A design agency hands you a site that looks good and hopes it ranks. We architect every decision — sitemap, URLs, code, content — around how search engines crawl and how buyers convert. Search is the blueprint, not an afterthought bolted on once the site is live.',
                        ],
                        [
                            'q' => 'Will my new site actually load fast and pass Core Web Vitals?',
                            'a' => 'Yes. Speed is engineered at the code level from the first commit — clean markup, optimized assets, and lean frameworks rather than bloated templates. Passing Core Web Vitals is a default of how we build, not a fix we sell you later.',
                        ],
                        [
                            'q' => 'Is the content written by real people or AI?',
                            'a' => 'Real people. Every page and blog is human-written and mapped to genuine search intent — engaging enough to read, and structured to win featured snippets. We use research tools to guide the strategy, but the words are written to be read.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'band',
                'label' => 'CTA band',
                'sort_order' => 15,
                'data' => [
                    'eyebrow' => 'Free, no-obligation',
                    'title' => 'See exactly why your site isn’t ranking — free.',
                    'body' => 'Get a no-cost audit of your current website’s SEO and technical health, plus a clear plan to fix it. See exactly how our web development and SEO services would get you ranking — no pressure, no jargon, just a straight look under the hood.',
                    'cta_text' => 'Get my free site audit',
                    'cta_url' => '#contact',
                    'secondary_cta_text' => 'Book a 15-min call',
                    'secondary_cta_url' => '#contact',
                    'items' => [
                        ['num' => '01', 'text' => 'A crawl of your site with every indexation and speed blocker listed'],
                        ['num' => '02', 'text' => 'The keywords you should be ranking for, and who is taking them instead'],
                        ['num' => '03', 'text' => 'A prioritized fix list, sized by effort against likely return'],
                        ['num' => '04', 'text' => 'A straight answer on whether you need a rebuild or a repair'],
                    ],
                ],
            ],
            [
                'key' => 'contact',
                'label' => 'Contact',
                'sort_order' => 16,
                'data' => [
                    'eyebrow' => 'Start here',
                    'title' => 'Let’s Connect With Our Experts',
                    'lede' => 'Book a free, no-obligation site audit to talk through what’s holding your rankings back. We’re here to answer every question — in plain English, with no sales pressure.',
                    'sub_title' => 'Built, Not Retrofitted',
                    'sub_body' => 'Work with one team that builds your site and its search foundation together — so you launch ready to rank, not waiting on a fix.',
                    'proof' => [
                        ['value' => '5.0', 'label' => 'Client rating'],
                        ['value' => '100%', 'label' => 'Launched SEO-ready'],
                        ['value' => '+300%', 'label' => 'Avg. organic lift'],
                    ],
                    'form_title' => 'Get in Touch Now!',
                    'consent_html' => 'By submitting this form, you agree to our <a href="/privacy-policy">Privacy Policy</a>.',
                    'submit_text' => 'Get In Touch',
                ],
            ],
            [
                'key' => 'footer',
                'label' => 'Footer',
                'sort_order' => 17,
                'data' => [
                    'blurb' => 'Web development and SEO services under one roof. We build websites that are technically sound and ready to rank — the day they launch.',
                    'columns' => [
                        [
                            'title' => 'Web Development',
                            'links' => [
                                ['label' => 'Custom Website Development', 'url' => '#'],
                                ['label' => 'E-Commerce Development', 'url' => '#'],
                                ['label' => 'WordPress Development', 'url' => '/wordpress-development-services'],
                                ['label' => 'Shopify Development', 'url' => '#'],
                                ['label' => 'Redesign & Migration', 'url' => '#'],
                                ['label' => 'Web Applications', 'url' => '#'],
                            ],
                        ],
                        [
                            'title' => 'SEO Services',
                            'links' => [
                                ['label' => 'Technical SEO', 'url' => '/technical-seo-services'],
                                ['label' => 'On-Page SEO', 'url' => '/on-page-seo-services'],
                                ['label' => 'Off-Page SEO', 'url' => '/off-page-seo-services'],
                                ['label' => 'GEO Services', 'url' => '/geo-services'],
                                ['label' => 'AEO Services', 'url' => '/aeo-services'],
                                ['label' => 'Digital Marketing', 'url' => '/digital-marketing-services'],
                                ['label' => 'Link Building', 'url' => '/off-page-seo-services'],
                            ],
                        ],
                        [
                            'title' => 'Company',
                            'links' => [
                                ['label' => 'Blog', 'url' => '/blogs'],
                                ['label' => 'About Us', 'url' => '/about-us'],
                                ['label' => 'Industries', 'url' => '/industries'],
                                ['label' => 'Our Process', 'url' => '#process'],
                                ['label' => 'Results', 'url' => '/results'],
                                ['label' => 'FAQ', 'url' => '/#faq'],
                                ['label' => 'Privacy Policy', 'url' => '/privacy-policy'],
                                ['label' => 'Terms & Conditions', 'url' => '/terms-and-conditions'],
                            ],
                        ],
                    ],
                    'audit_text' => 'Free Site Audit',
                    'audit_url' => '/contact',
                    'social' => [
                        ['label' => 'facebook', 'url' => '#'],
                        ['label' => 'x', 'url' => '#'],
                        ['label' => 'youtube', 'url' => '#'],
                        ['label' => 'instagram', 'url' => '#'],
                        ['label' => 'linkedin', 'url' => '#'],
                    ],
                ],
            ],
        ];

        foreach (\App\Support\CmsPageDefaults::sections() as $key => $def) {
            $sections[] = [
                'key' => $key,
                'label' => $def['label'],
                'sort_order' => $def['sort_order'],
                'data' => $def['data'],
            ];
        }

        foreach ($sections as $section) {
            CmsSection::updateOrCreate(
                ['key' => $section['key']],
                [
                    'label' => $section['label'],
                    'sort_order' => $section['sort_order'],
                    'data' => $section['data'],
                ]
            );
        }
    }
}
