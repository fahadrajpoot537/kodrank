<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class OffPageSeoServiceSeeder extends Seeder
{
    public function run(): void
    {
        $parent = ServicePage::query()->where('slug', 'digital-marketing-services')->first();

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'off-page-seo-services'],
            [
                'parent_id' => $parent?->id,
                'name' => 'Off-Page SEO Services',
                'is_active' => true,
                'sort_order' => 1,
                'seo' => [
                    'theme' => 'seo-service',
                    'seo_title' => 'Off-Page SEO Services That Turn Backlinks Into Rankings - KodRank',
                    'seo_description' => 'KodRank\'s off-page SEO services build real editorial authority — manual link building, guest posting, digital PR and brand mentions. No PBNs, no link farms, every link reported.',
                    'og_title' => 'Off-Page SEO Services That Turn Backlinks Into Rankings - KodRank',
                    'og_description' => 'Your pages are optimized. Your content is good. So why do thinner competitors keep outranking you? Nine times out of ten it\'s authority — and KodRank earns it the safe, white-hat way.',
                    'og_image' => 'media/services/off-page-seo/off-page-seo-services-agency-banner.jpg',
                    'keywords' => 'off-page SEO services, link building, guest posting, digital PR, backlink audit, brand mentions, local citations, anchor text strategy, KodRank',
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
                    'eyebrow' => 'Off-page SEO & link building',
                    'breadcrumb' => [
                        ['label' => 'Home', 'url' => '/'],
                        ['label' => 'Services', 'url' => '#'],
                        ['label' => 'Off-Page SEO Services', 'url' => ''],
                    ],
                    'title' => 'Off Page SEO Services That Turn Backlinks Into Rankings',
                    'title_accent' => 'Rankings',
                    'title_html' => 'Off Page SEO Services That Turn Backlinks Into <span class="hl">Rankings</span>',
                    'lede' => 'Your pages are optimized. Your content is good. So why do thinner competitors keep outranking you? Nine times out of ten it\'s authority — and authority is earned off your site, not on it.',
                    'cta_text' => 'Get a Free Link Audit',
                    'cta_url' => '#contact',
                    'badges' => [
                        ['label' => 'Real editorial links'],
                        ['label' => 'No PBNs or link farms'],
                        ['label' => 'Every link reported'],
                    ],
                    'image' => 'media/services/off-page-seo/off-page-seo-services-agency-banner.jpg',
                    'image_alt' => 'Off-page SEO link building specialist reviewing backlink reports and referring domains',
                    'visual_aria_label' => 'Off-page SEO link building dashboard with backlinks, domain authority and referral traffic icons',
                ],
            ],
            [
                'key' => 'problem',
                'label' => 'Problem',
                'sort_order' => 1,
                'data' => [
                    'eyebrow' => 'The real reason you\'re stuck',
                    'title' => 'Great content doesn\'t rank itself.',
                    'title_html' => 'Great content doesn\'t <span class="hl">rank itself</span>.',
                    'lede' => 'You can nail every on-page checklist and still sit on page two. Google needs proof that other people trust you — and that proof lives out on the web. If any of these sound familiar, off-page is the gap.',
                    'cards' => [
                        [
                            'title' => 'Stuck on page two',
                            'body' => 'Your rankings crept up, then flatlined — because the competitors above you simply have stronger, more relevant backlinks.',
                            'icon_key' => 'stuck',
                        ],
                        [
                            'title' => 'Burned by cheap links',
                            'body' => 'A past "SEO guy" pointed a pile of spammy links at your domain, and now you\'re worried a penalty is one update away.',
                            'icon_key' => 'burned',
                        ],
                        [
                            'title' => 'No time for outreach',
                            'body' => 'Pitching editors is a grind full of rejection. It\'s real work you don\'t have the hours — or the contacts — to do in-house.',
                            'icon_key' => 'time',
                        ],
                        [
                            'title' => 'Paying, but blind',
                            'body' => 'You get a vague monthly invoice and no proof. You honestly can\'t tell if a single quality link was ever built.',
                            'icon_key' => 'blind',
                        ],
                    ],
                    'note_title' => 'Here\'s how we close it',
                    'note' => 'Our off page SEO services replace guesswork and risky shortcuts with links you\'d be happy to show your CEO. Relevant sites. Real traffic. Full transparency.',
                    'note_list' => [
                        'Manual outreach to sites that actually fit your niche',
                        'A diversified, natural anchor profile that keeps you safe',
                        'Toxic links found, disavowed and cleaned up first',
                        'A live report so you see every placement we earn',
                    ],
                ],
            ],
            [
                'key' => 'services',
                'label' => 'Services',
                'sort_order' => 2,
                'data' => [
                    'eyebrow' => 'What\'s inside',
                    'title' => 'Off Page SEO Services built around links that actually count.',
                    'title_html' => 'Off Page SEO Services built around <span class="hl">links that actually count</span>.',
                    'lede' => 'One link from a trusted, relevant site beats a hundred from directories nobody reads. Every part of our off-page work is aimed at that kind of signal — the kind Google rewards and your competitors can\'t fake.',
                    'cards' => [
                        [
                            'title' => 'Manual Link Building',
                            'body' => 'We reach out to real editors and site owners by hand and earn contextual links inside genuine content — never inserted into a footer or a network you\'d be ashamed of.',
                            'icon_key' => 'linkbuilding',
                        ],
                        [
                            'title' => 'Guest Posting & Placements',
                            'body' => 'Original articles written to a publisher\'s standard, placed on sites your audience already reads. You get the backlink and the referral traffic that comes with it.',
                            'link_text' => 'Get Placements',
                            'link_url' => '#contact',
                            'icon_key' => 'guestpost',
                        ],
                        [
                            'title' => 'Digital PR & Brand Mentions',
                            'body' => 'Data-led stories and expert commentary pitched to journalists, so your brand earns links from publications that move both Google and the people reading it.',
                            'icon_key' => 'digitalpr',
                        ],
                        [
                            'title' => 'Local Citations & NAP',
                            'body' => 'Consistent name, address and phone listings across the directories that matter, so local searches and map results trust that your business is the real thing.',
                            'icon_key' => 'citations',
                        ],
                        [
                            'title' => 'Backlink Audit & Cleanup',
                            'body' => 'We map your whole link profile, flag the toxic links dragging you down, and disavow what needs to go — so new authority isn\'t fighting old damage.',
                            'icon_key' => 'audit',
                        ],
                        [
                            'title' => 'Anchor Text Strategy',
                            'body' => 'We plan every anchor so your profile reads natural, not manufactured — the balance of branded, partial and exact-match links that keeps you on the right side of Google.',
                            'icon_key' => 'anchor',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'process',
                'label' => 'Process',
                'sort_order' => 3,
                'data' => [
                    'eyebrow' => 'How it works',
                    'title' => 'Our off page SEO process, step by step.',
                    'title_html' => 'Our off page SEO process, <span class="hl">step by step</span>.',
                    'lede' => 'No black boxes. You\'ll always know what we\'re doing, why we\'re doing it, and what it moved. Four steps, run on repeat until you own your search results.',
                    'steps' => [
                        [
                            'num' => '01',
                            'title' => 'Audit & benchmark',
                            'body' => 'We tear down your backlink profile and your top competitors\', find the authority gap, and flag anything toxic that needs cleaning up first.',
                        ],
                        [
                            'num' => '02',
                            'title' => 'Strategy & targets',
                            'body' => 'We map the pages that need links, the anchors they should earn, and a shortlist of relevant, high-trust sites worth pitching for your niche.',
                        ],
                        [
                            'num' => '03',
                            'title' => 'Outreach & placement',
                            'body' => 'Our team pitches editors by hand, writes to their standard, and secures editorial placements — every one approved against our quality checklist.',
                        ],
                        [
                            'num' => '04',
                            'title' => 'Report & scale',
                            'body' => 'You get a live report of every link and its impact. We double down on what\'s working and keep compounding your authority month over month.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'compare',
                'label' => 'Comparison',
                'sort_order' => 4,
                'data' => [
                    'eyebrow' => 'Not all links are equal',
                    'title' => 'The cheap link vendor vs KodRank.',
                    'title_html' => 'The cheap link vendor <span class="hl">vs KodRank</span>.',
                    'lede' => 'There are faster ways to get links. They also get you penalized. We\'d rather build authority that still stands after the next core update.',
                    'columns' => [
                        [
                            'title' => 'Typical Link Vendor',
                            'subtitle' => 'Fast, cheap, risky',
                            'variant' => 'muted',
                            'items' => [
                                ['mark' => 'x', 'text' => 'Links from PBNs and link farms you never see'],
                                ['mark' => 'x', 'text' => 'Same spun article blasted to hundreds of sites'],
                                ['mark' => 'x', 'text' => 'Exact-match anchors that scream manipulation'],
                                ['mark' => 'x', 'text' => 'A vague report, if you get one at all'],
                                ['mark' => 'x', 'text' => 'A penalty waiting for the next core update'],
                            ],
                        ],
                        [
                            'title' => 'The KodRank Way',
                            'subtitle' => 'Slower, safer, it lasts',
                            'variant' => 'pro',
                            'items' => [
                                ['mark' => 'v', 'text' => 'Editorial links on real sites with real traffic'],
                                ['mark' => 'v', 'text' => 'Original content written for each publisher'],
                                ['mark' => 'v', 'text' => 'A natural anchor mix planned to keep you safe'],
                                ['mark' => 'v', 'text' => 'A live report showing every single placement'],
                                ['mark' => 'v', 'text' => 'Authority that survives whatever Google ships next'],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'key' => 'stats',
                'label' => 'Stats',
                'sort_order' => 5,
                'data' => [
                    'eyebrow' => 'What good off-page looks like',
                    'title' => 'The numbers our clients care about.',
                    'title_html' => 'The numbers our clients <span class="hl">care about</span>.',
                    'lede' => 'Vanity metrics don\'t pay the bills. These are the outcomes we build toward on every off page SEO campaign.',
                    'tone' => 'light',
                    'items' => [
                        ['value' => '+68%', 'label' => 'Average lift in organic traffic within 6 months', 'signal' => true],
                        ['value' => '3.4×', 'label' => 'More keywords ranking in the top 10', 'signal' => false],
                        ['value' => '92%', 'label' => 'Of links still live a year after placement', 'signal' => true],
                        ['value' => '48h', 'label' => 'Turnaround on your free backlink audit', 'signal' => false],
                    ],
                ],
            ],
            [
                'key' => 'why_us',
                'label' => 'Why us',
                'sort_order' => 6,
                'data' => [
                    'eyebrow' => 'Why KodRank',
                    'title' => 'Off-page done the safe, boring, effective way.',
                    'title_html' => 'Off-page done the <span class="hl">safe, boring, effective</span> way.',
                    'lede' => 'There are faster ways to get links. They also get you penalized. We\'d rather build authority that still stands after the next core update.',
                    'image' => 'media/services/digital-marketing/bg-3.webp',
                    'cards' => [
                        [
                            'title' => 'White-hat, full stop',
                            'body' => 'No PBNs, no link farms, no automated junk. Every link is a placement you could proudly show a search engineer at Google.',
                            'icon_key' => 'whitehat',
                        ],
                        [
                            'title' => 'Total transparency',
                            'body' => 'You see the live URL, the anchor, the domain rating and the go-live date for every link. Nothing hidden behind a monthly summary.',
                            'icon_key' => 'transparency',
                        ],
                        [
                            'title' => 'Relevance over volume',
                            'body' => 'We\'d rather earn five links that fit your niche than fifty that don\'t. Relevance is what actually moves rankings, so that\'s what we chase.',
                            'icon_key' => 'relevance',
                        ],
                        [
                            'title' => 'Tied to your goals',
                            'body' => 'Links are a means, not the point. We build toward the rankings, traffic and leads that actually grow your business.',
                            'icon_key' => 'goals',
                        ],
                        [
                            'title' => 'A real team, real contacts',
                            'body' => 'Outreach lives or dies on relationships. Ours are built over years — which is why editors actually reply to our pitches.',
                            'icon_key' => 'team',
                        ],
                        [
                            'title' => 'Built to compound',
                            'body' => 'Off-page isn\'t a one-off spend. Every month adds to the last, so your authority keeps climbing long after the campaign starts.',
                            'icon_key' => 'compound',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'testimonials',
                'label' => 'Testimonials',
                'sort_order' => 7,
                'data' => [
                    'eyebrow' => 'In their words',
                    'title' => 'Rankings moved. So did the revenue.',
                    'title_html' => 'Rankings moved. <span class="hl">So did the revenue.</span>',
                    'items' => [
                        [
                            'quote' => 'We\'d been stuck below three competitors for a year. KodRank cleaned up our old links first, then earned us placements that actually fit our niche. Four months in, we\'re number one for our money keyword.',
                            'name' => 'Rachel M.',
                            'role' => 'Founder, B2B SaaS',
                            'avatar' => 'RM',
                            'stars' => '★★★★★',
                        ],
                        [
                            'quote' => 'What sold me was the reporting. I can see every link they build — where it lives, the anchor, the site\'s rating. After a bad experience with a cheap provider, that honesty was everything.',
                            'name' => 'David K.',
                            'role' => 'Marketing Lead, e-commerce',
                            'avatar' => 'DK',
                            'stars' => '★★★★★',
                        ],
                        [
                            'quote' => 'Their digital PR landed us in two industry publications we\'d never have reached on our own. The links were a bonus — the referral traffic and credibility were the real win.',
                            'name' => 'Sana A.',
                            'role' => 'Owner, professional services',
                            'avatar' => 'SA',
                            'stars' => '★★★★★',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'faq',
                'label' => 'FAQ',
                'sort_order' => 8,
                'data' => [
                    'eyebrow' => 'Straight answers',
                    'title' => 'Off page SEO services, questions answered.',
                    'title_html' => 'Off page SEO services, <span class="hl">questions answered</span>.',
                    'lede' => 'The things clients ask us before they sign. If yours isn\'t here, just send it over.',
                    'items' => [
                        [
                            'q' => 'What exactly are off page SEO services?',
                            'a' => 'Off page SEO services cover everything done outside your website to raise its authority in search — manual link building, guest posting, digital PR, brand mentions and local citations. The goal is simple: earn signals from trusted third-party sites that tell Google your pages deserve to rank. On-page work makes your site worthy; off-page work convinces search engines the rest of the web agrees.',
                        ],
                        [
                            'q' => 'Do you use PBNs, link farms or automated links?',
                            'a' => 'Never. Every link we build is a manual, editorial placement on a real site with real traffic. We don\'t touch private blog networks, link farms or automated directories — those are exactly the tactics that trigger Google penalties. Safe, slow and lasting beats fast and risky every time.',
                        ],
                        [
                            'q' => 'How long until I see results?',
                            'a' => 'Most clients see early movement in 60 to 90 days as new links get indexed and equity flows through to your target pages. Competitive keywords take longer. The important thing to understand about off-page is that it compounds — the campaigns that started six months ago are the ones pulling clear of the pack right now.',
                        ],
                        [
                            'q' => 'Will I actually see the links you build?',
                            'a' => 'Every one of them. You get a live report listing each placement — the URL, the anchor text, the domain rating and the date it went live. No hidden links, no "trust us" monthly summaries. If we built it, you can click it.',
                        ],
                        [
                            'q' => 'I think I\'ve been hit by bad links. Can you help?',
                            'a' => 'Yes — and it\'s usually the first thing we do. We audit your full backlink profile, identify the toxic links dragging you down, and disavow what needs to go. There\'s no point building new authority while old damage is still holding you back, so cleanup comes first.',
                        ],
                        [
                            'q' => 'How much do your off page SEO services cost?',
                            'a' => 'It depends on your niche, how competitive your keywords are, and how fast you want to move. Rather than a one-size box, we scope every campaign after a free backlink audit — so you only pay for the link volume and outreach your rankings actually need. No lock-in, no padding.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'cta',
                'label' => 'CTA band',
                'sort_order' => 9,
                'data' => [
                    'eyebrow' => 'Ready when you are',
                    'title' => 'Let\'s build the authority that gets you ranked.',
                    'title_html' => 'Let\'s build the authority that <span class="accent">gets you ranked</span>.',
                    'body' => 'Start with a free backlink audit. We\'ll show you where the authority gap is and exactly how we\'d close it — no pressure, no jargon.',
                    'cta_text' => 'Get My Free Link Audit',
                    'cta_url' => '#contact',
                ],
            ],
            [
                'key' => 'contact',
                'label' => 'Contact',
                'sort_order' => 10,
                'data' => [
                    'eyebrow' => 'Get started',
                    'title' => 'Tell us about your site.',
                    'lede' => 'Send us your domain and your biggest ranking headache. You\'ll get an honest audit and a plan back within two working days — not a sales script.',
                    'meta' => [
                        ['label' => 'Email', 'value' => 'info@kodrank.com', 'icon_key' => 'email'],
                        ['label' => 'Phone', 'value' => '+92 305 9202732', 'icon_key' => 'phone'],
                        ['label' => 'Response Time', 'value' => 'Audit back within 48 working hours', 'icon_key' => 'clock'],
                    ],
                    'fields' => [
                        'first_name_label' => 'First Name',
                        'last_name_label' => 'Last Name',
                        'email_label' => 'Work Email',
                        'phone_label' => 'Phone (Optional)',
                        'company_label' => 'Company',
                        'website_label' => 'Website',
                        'service_label' => 'I\'m Interested In',
                        'budget_label' => 'Monthly Budget',
                        'message_label' => 'What\'s Your Biggest Ranking Headache?',
                        'message_placeholder' => 'Tell us where you\'re stuck and what you want to change.',
                    ],
                    'service_options' => [
                        'Off-Page SEO Services',
                        'On-Page SEO Services',
                        'Technical SEO Services',
                        'Full Digital Marketing Services',
                        'Not Sure — Need Advice',
                    ],
                    'default_service' => 'Off-Page SEO Services',
                    'budget_options' => [
                        'Not sure yet',
                        '$500 – $1,500',
                        '$1,500 – $3,500',
                        '$3,500+',
                    ],
                    'submit_text' => 'Send & Get My Audit',
                    'success_message' => 'Thanks — we\'ve got it. Check your inbox within 48 working hours.',
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
