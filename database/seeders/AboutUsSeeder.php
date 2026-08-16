<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    public function run(): void
    {
        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'about-us'],
            [
                'parent_id' => null,
                'name' => 'About Us',
                'is_active' => true,
                'sort_order' => 99,
                'seo' => [
                    'theme' => 'about',
                    'hide_from_nav' => true,
                    'seo_title' => 'About KodRank — We\'re Not An Agency, We\'re Your Technical Team',
                    'seo_description' => 'Founded by three professionals. One team, one price — SEO, web development, and content without phased agency invoices.',
                    'og_title' => 'About KodRank — We\'re Not An Agency, We\'re Your Technical Team',
                    'og_description' => 'Founded by three professionals. One team, one price — SEO, web development, and content without phased agency invoices.',
                    'og_image' => 'media/about/kodrank-hero-team.jpg',
                    'keywords' => 'about KodRank, SEO agency alternative, web development team',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
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
                    'eyebrow' => '— About KodRank',
                    'title' => 'We\'re not an agency. We\'re your technical team.',
                    'title_html' => 'We\'re not an agency.<br>We\'re your <span class="hl">technical team.</span>',
                    'lede' => 'Founded by three professionals who got tired of watching agencies milk clients phase by phase. So we built the alternative: one team, one price, everything solved.',
                    'lede_html' => 'Founded by three professionals who got tired of watching agencies milk clients phase by phase. So we built the alternative: <span class="accent">one team, one price, everything solved.</span>',
                    'image' => 'media/about/kodrank-hero-team.jpg',
                    'image_alt' => 'KodRank team — technical specialists delivering SEO and web development',
                    'visual_aria_label' => 'KodRank team — technical specialists delivering SEO and web development',
                    'stats' => [
                        ['value' => '150', 'suffix' => '+', 'label' => 'SEO projects delivered'],
                        ['value' => '100', 'suffix' => '+', 'label' => 'Websites built'],
                        ['value' => '1', 'suffix' => ' invoice', 'label' => 'Not four'],
                        ['num' => 'Worldwide', 'label' => 'Client base, one team'],
                    ],
                ],
            ],
            [
                'key' => 'why_exist',
                'label' => 'Why we exist',
                'sort_order' => 1,
                'data' => [
                    'eyebrow' => '— Why We Exist',
                    'title' => 'We watched agencies turn one website into four separate invoices.',
                    'title_html' => 'We watched agencies turn one website into <span class="accent">four separate invoices.</span>',
                    'lede' => 'Build the site — charge. Fix the technical issues that should\'ve been caught the first time — charge again. Write the content — another charge. On-page optimization — yet another. Same project, broken into billable phases, and the client pays for the agency\'s own gaps every time.',
                    'columns' => [
                        [
                            'tag' => 'The typical agency',
                            'title' => 'One project, four bills',
                            'variant' => 'muted',
                            'items' => [
                                ['mark' => 'x', 'text' => 'Website built — technical debt left behind for later'],
                                ['mark' => 'x', 'text' => 'Technical fixes billed as a separate "phase 2"'],
                                ['mark' => 'x', 'text' => 'Content writing quoted and invoiced on its own'],
                                ['mark' => 'x', 'text' => 'On-page SEO sold as yet another add-on'],
                            ],
                            'footer' => 'Result: wasted time, rising costs, a frustrated client',
                        ],
                        [
                            'tag' => 'The KodRank way',
                            'title' => 'One project, one price',
                            'variant' => 'pro',
                            'items' => [
                                ['mark' => 'v', 'text' => 'Website built <b style="color:#fff">technically sound</b> from day one', 'html' => true],
                                ['mark' => 'v', 'text' => 'Any technical fix included — no second invoice'],
                                ['mark' => 'v', 'text' => 'SEO-ready content written in, not sold on'],
                                ['mark' => 'v', 'text' => 'On-page optimization done before we call it finished'],
                            ],
                            'footer' => 'Result: cost-effective, one-time, done right the first time',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'values',
                'label' => 'Values',
                'sort_order' => 2,
                'data' => [
                    'eyebrow' => '— How We Work',
                    'title' => 'Professionals, not a pipeline.',
                    'title_html' => 'Professionals, not a pipeline.',
                    'lede' => 'We\'re not a big agency with a sales team standing between you and the people doing the work. You talk directly to the specialists building your site — worldwide clients, straightforward pricing, zero hidden phases.',
                    'lede_html' => 'We\'re not a big agency with a sales team standing between you and the people doing the work. You talk directly to the <span class="accent">specialists building your site</span> — worldwide clients, straightforward pricing, zero hidden phases.',
                    'cards' => [
                        [
                            'title' => 'SEO-optimized by build, not by add-on',
                            'body' => 'Every site ships technically sound and search-ready — structure, speed, and on-page fundamentals are part of the build, not a phase two.',
                            'icon_key' => 'structure',
                        ],
                        [
                            'title' => 'One-time, cost-effective pricing',
                            'body' => 'You get a single quote that covers the build, the fixes, and the optimization. No surprise invoices six weeks in.',
                            'icon_key' => 'pricing',
                        ],
                        [
                            'title' => 'Worldwide clients, direct access',
                            'body' => 'Small businesses to growing brands, across timezones — you work directly with the people who deliver, not account managers relaying messages.',
                            'icon_key' => 'geo',
                        ],
                        [
                            'title' => 'Fixes included, not re-billed',
                            'body' => 'If something needs fixing after launch because of our work, we fix it. That\'s covered — not a new line item.',
                            'icon_key' => 'check',
                        ],
                        [
                            'title' => 'Content that\'s built to rank',
                            'body' => 'Written by a language specialist, not filler text — every page is written to read well and perform in search from the start.',
                            'icon_key' => 'content',
                        ],
                        [
                            'title' => 'No wasted time',
                            'body' => 'No waiting on the next phase to be scoped and quoted. We move through the project as one continuous engagement.',
                            'icon_key' => 'speed',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'leadership',
                'label' => 'Leadership',
                'sort_order' => 3,
                'data' => [
                    'eyebrow' => '— Leadership',
                    'title' => 'Three specialists. No layers between.',
                    'title_html' => 'Three specialists.<br>No layers between.',
                    'lede' => 'The people named below are the people who work on your project — there\'s no bench of juniors you never meet.',
                    'background_image' => 'media/about/kodrank-leadership-bg.jpg',
                    'members' => [
                        [
                            'name' => 'Hidayatul Haq',
                            'role' => 'Founder · SEO Strategist',
                            'linkedin' => 'https://www.linkedin.com/in/hidayatul-haq',
                            'bio' => '150+ SEO projects delivered worldwide. Hidayatul has spent his career turning small businesses into recognized digital brands — the strategy behind every KodRank engagement runs through him.',
                            'tags' => ['SEO Strategy', '150+ Projects'],
                            'image' => 'media/about/hidayatul-haq.jpg',
                        ],
                        [
                            'name' => 'Fahad Bin Khalid',
                            'role' => 'Co-Founder · AI & Software Architect',
                            'linkedin' => 'https://www.linkedin.com/in/fahad-bin-khalid-laravel',
                            'bio' => 'Builds the technical foundation every KodRank site stands on — fast, stable, and engineered to hold up long after launch.',
                            'tags' => ['AI Architecture', 'Software Engineering'],
                            'image' => 'media/about/fahad-bin-khalid.jpg',
                            'image_position' => 'center 8%',
                        ],
                        [
                            'name' => 'Manzoor ul Haq',
                            'role' => 'Content Lead',
                            'linkedin' => 'https://www.linkedin.com/in/manzoor-ul-haq',
                            'bio' => 'Master\'s in English Literature & Linguistics, and a top-rated writer. Manzoor writes the words that make a site sound like a brand — and rank like one.',
                            'tags' => ['Content Strategy', 'Top Rated Writer'],
                            'image' => 'media/about/manzoor-ul-haq.jpg',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'mission',
                'label' => 'Mission',
                'sort_order' => 4,
                'data' => [
                    'num' => '01',
                    'eyebrow' => '— Our Vision',
                    'title' => 'A website that\'s technically sound and built to rank — from one team, at one price.',
                    'title_html' => 'A website that\'s <span class="accent">technically sound and built to rank</span> — from one team, at one price.',
                    'lede' => 'We\'re a small group of professionals, not a large agency layered with account managers and upsells. That\'s deliberate. It means every project gets senior attention, and every client gets a single, cost-effective quote instead of a drip of invoices.',
                    'items' => [
                        [
                            'title' => 'Build once, right.',
                            'body' => 'Technical soundness and SEO aren\'t a later phase — they\'re built in from line one.',
                        ],
                        [
                            'title' => 'One quote covers it all.',
                            'body' => 'Development, fixes, content, and on-page optimization — priced together, not piecemeal.',
                        ],
                        [
                            'title' => 'Global clients, real access.',
                            'body' => 'Whoever and wherever you are, you work directly with the specialists on your project.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'cta',
                'label' => 'CTA band',
                'sort_order' => 5,
                'data' => [
                    'eyebrow' => '— Ready When You Are',
                    'title' => 'Let\'s build a site that ranks — without the phased invoices.',
                    'title_html' => 'Let\'s build a site that ranks —<br>without the phased invoices.',
                    'body' => 'Tell us about your project. You\'ll get one straightforward, cost-effective quote — development, fixes, content, and optimization included.',
                    'lede' => 'Tell us about your project. You\'ll get one straightforward, cost-effective quote — development, fixes, content, and optimization included.',
                    'cta_text' => 'Get A Free Quote',
                    'cta_url' => '#contact',
                    'secondary_text' => 'See Our Work',
                    'secondary_url' => '/#work',
                ],
            ],
            [
                'key' => 'contact',
                'label' => 'Contact',
                'sort_order' => 6,
                'data' => [
                    'eyebrow' => '— Get In Touch',
                    'title' => 'Talk to the team, not a salesperson.',
                    'cards' => [
                        [
                            'title' => 'Email Us',
                            'body' => 'For quotes, project scopes, or general questions — a real specialist replies, not a ticket queue.',
                            'link_text' => 'info@kodrank.com',
                            'link_url' => 'mailto:info@kodrank.com',
                            'icon_key' => 'email',
                        ],
                        [
                            'title' => 'Book A Call',
                            'body' => '15 minutes to walk through your project and get a straight answer on scope and cost — one price, no phases.',
                            'link_text' => 'Schedule A Call',
                            'link_url' => '#contact',
                            'icon_key' => 'phone',
                        ],
                    ],
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
