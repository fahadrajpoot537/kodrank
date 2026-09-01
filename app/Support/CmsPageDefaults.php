<?php

namespace App\Support;

use App\Models\CmsSection;
use App\Models\ServicePage;

class CmsPageDefaults
{
    /**
     * Extra CMS sections that live next to homepage blocks (contact, services index, authors).
     *
     * @return array<string, array{label:string, sort_order:int, data:array<string, mixed>}>
     */
    public static function sections(): array
    {
        return [
            'contact_page' => [
                'label' => 'Contact page',
                'sort_order' => 80,
                'data' => self::contactPage(),
            ],
            'services_index' => [
                'label' => 'Services listing (/services)',
                'sort_order' => 81,
                'data' => self::servicesIndex(),
            ],
            'blog_authors' => [
                'label' => 'Blog authors',
                'sort_order' => 82,
                'data' => [
                    'authors' => self::defaultAuthors(),
                ],
            ],
            'results_page' => [
                'label' => 'Results page',
                'sort_order' => 83,
                'data' => ResultsPageDefaults::data(),
            ],
        ];
    }

    public static function ensure(): void
    {
        static $done = false;
        if ($done) {
            return;
        }
        $done = true;

        foreach (self::sections() as $key => $def) {
            CmsSection::query()->firstOrCreate(
                ['key' => $key],
                [
                    'label' => $def['label'],
                    'sort_order' => $def['sort_order'],
                    'data' => $def['data'],
                ]
            );
        }

        $site = CmsSection::query()->where('key', 'site')->first();
        if ($site) {
            $data = is_array($site->data) ? $site->data : [];
            if (! array_key_exists('logo', $data)) {
                $data['logo'] = 'logo.png';
                $site->update(['data' => $data]);
            }
        }

        self::pointResultsNavToPage();
        self::seedHomepageWorkIfPlaceholder();
        self::seedHomepageTestimonialsIfPlaceholder();
        self::syncHomepageServiceUrls();
        self::fixIndustryContactLinks();
    }

    /**
     * @return array<string, mixed>
     */
    public static function contactPage(): array
    {
        return [
            'seo_title' => 'Contact — KodRank',
            'seo_description' => 'Tell us what you\'re working on. We\'ll reply within 24 hours with a realistic scope, plain-English plan, and a number you can use.',
            'hero_eyebrow' => 'Get in touch',
            'hero_title' => 'Let\'s build a site that',
            'hero_title_accent' => 'ranks. And converts.',
            'hero_lede' => 'Tell us what you\'re working on. We\'ll come back within 24 hours with honest input — a realistic scope, a plain-English plan, and a number you can actually use.',
            'stats' => [
                ['value' => '24h', 'label' => "Response\nTime"],
                ['value' => 'Free', 'label' => "Audit &\nProposal"],
                ['value' => '180+', 'label' => "Sites\nRanked"],
            ],
            'quote' => 'The scoping call itself was worth more than the last two agencies we hired. Rebuilt our platform and doubled organic leads in four months.',
            'quote_initials' => 'SC',
            'quote_name' => 'Sarah Chen',
            'quote_role' => 'CMO, Nexus Retail',
            'how_eyebrow' => 'Here\'s how it works',
            'how_title' => 'What happens after you hit send.',
            'how_lede' => 'No sales-y follow-ups. No 40-page proposals. Just a real conversation with the person who\'d do the work.',
            'steps' => [
                ['num' => '01', 'title' => 'You send the form', 'desc' => 'The more context you share, the sharper our first reply. Rough is fine — we\'ll ask the rest.', 'meta' => 'Takes 2 minutes'],
                ['num' => '02', 'title' => 'We reply within 24 hours', 'desc' => 'A real message from a strategist — not a booking link. If we\'re not the right fit, we\'ll tell you and point you somewhere better.', 'meta' => 'One human, one email'],
                ['num' => '03', 'title' => '30-minute discovery call', 'desc' => 'We walk your site, look at the numbers, and sketch a plan. You leave with an audit whether we work together or not.', 'meta' => 'Free, no pressure'],
            ],
            'skip_title' => 'Prefer to skip the form?',
            'call_hours' => 'Call us — Mon–Fri, 9a–6p PKT',
            'studios_label' => 'Studios',
            'studios_value' => 'Lahore · Dubai · Remote',
            'form_eyebrow' => 'Let\'s get started',
            'form_title' => 'Tell us about your project.',
            'form_lede' => 'Seven fields. Two minutes. A real reply from a strategist — not an auto-responder.',
            'service_options' => ['SEO', 'Web Development', 'Local SEO', 'E-commerce', 'Technical SEO', 'Content & Copy', 'Not sure yet'],
            'timeline_options' => [
                ['value' => 'ASAP', 'label' => 'ASAP'],
                ['value' => '1–3 months', 'label' => 'In 1–3 months'],
                ['value' => '3–6 months', 'label' => 'In 3–6 months'],
                ['value' => 'Just exploring', 'label' => 'Just exploring'],
            ],
            'message_placeholder' => 'What are you trying to achieve? What\'s not working today? Any specific challenges — traffic that isn\'t converting, a rebuild that stalled, a rank drop after an update? The more you tell us, the sharper we can be.',
            'consent_html' => 'I agree to KodRank\'s <a href="/privacy-policy">Privacy Policy</a> and to receive project-related communications. No spam, no lists, no third parties — ever.',
            'submit_text' => 'Get My Free Proposal',
            'success_message' => 'Thanks — we received your message. Our team will contact you within 24 hours.',
            'offices_eyebrow' => 'Not a new project?',
            'offices_title' => 'Reach the right team, faster.',
            'offices_lede' => 'If you\'re an existing client, a partner, or looking for something outside a project quote — these go to a real person on that team, not a shared inbox.',
            'offices' => [
                ['title' => 'New business', 'body' => 'Quotes, discovery calls, and RFPs. You\'ll hear back from our strategy lead within one working day.', 'meta' => 'Response: within 24 hours'],
                ['title' => 'Existing clients', 'body' => 'Support tickets, campaign questions, reporting requests. Goes straight to your dedicated account lead.', 'meta' => 'Response: same working day'],
                ['title' => 'Careers & partners', 'body' => 'Job openings, contractor rosters, tool integrations, and co-marketing. Talk to our ops lead directly.', 'meta' => 'Response: within 3 working days'],
            ],
            'faq_eyebrow' => 'Before you send',
            'faq_title' => 'Quick answers, so you don\'t have to ask.',
            'faqs' => [
                ['q' => 'How fast will I actually hear back?', 'a' => 'Within 24 hours on any working day. If you send the form on a Friday evening, you\'ll hear back Monday morning at the latest. A real strategist reads every submission — not a bot, not an SDR pipeline.'],
                ['q' => 'What size projects do you usually take?', 'a' => 'Most engagements start at $2k/month for SEO retainers and $8k+ for site builds. If your budget is smaller, we\'ll be honest about it and often point you to a solid alternative. Being straight upfront saves everyone time.'],
                ['q' => 'Do I need to have a website already?', 'a' => 'Nope. Roughly a third of our projects are ground-up builds. If you have something existing, we\'ll audit it. If you don\'t, we\'ll design and build from scratch — with SEO wired in from the first line of code, not bolted on later.'],
                ['q' => 'Do you work with clients outside Pakistan?', 'a' => 'Yes — most of our clients are in the US, UK, UAE, and Australia. We work across time zones with overlap hours guaranteed, and every client has a dedicated account lead in their preferred time zone.'],
                ['q' => 'Am I signing a long contract?', 'a' => 'No 12-month lock-ins. SEO retainers are month-to-month after a 90-day initial period (needed to actually see results move). Web builds are milestone-based. If we\'re not delivering, you can walk — and you own everything we\'ve built.'],
                ['q' => 'What info should I have ready?', 'a' => 'Not much — just your site URL (if you have one) and a rough sense of what you\'re trying to fix or build. If you have GSC or GA4 data, even better, but it\'s not required. We\'ll ask for what we need.'],
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function servicesIndex(): array
    {
        return [
            'seo_title' => 'Our Services — KodRank | Web Development & SEO Agency',
            'seo_description' => 'Explore KodRank\'s full range of SEO and web development services — from monthly SEO and technical optimization to WordPress, Shopify, and custom AI chatbots.',
            'hero_title' => 'Everything you need to',
            'hero_title_accent_1' => 'rank higher',
            'hero_title_and' => 'and',
            'hero_title_accent_2' => 'convert more',
            'hero_lede' => 'From technical SEO to custom-built websites, KodRank ships work that moves rankings and revenue. Pick a service below — or let us build the plan for you.',
            'cta_primary' => 'Book A Free Audit',
            'cta_secondary' => 'Browse Services',
            'stat_2_value' => '2',
            'stat_2_label' => 'Core Disciplines',
            'stat_3_value' => '100%',
            'stat_3_label' => 'In-House Team',
            'stat_1_label' => 'Specialist Services',
            'jump_label' => 'Jump to',
            'jump_seo' => 'SEO & Search Growth',
            'jump_web' => 'Web Design & Development',
            'jump_cta' => 'Talk To Us',
            'seo_group_slug' => 'digital-marketing-services',
            'web_group_slug' => 'web-design-and-development-services',
            'seo_eyebrow' => 'SEO & Search Growth',
            'seo_title_h2' => 'Get found where your customers are',
            'seo_title_accent' => 'searching',
            'seo_lede' => 'Classic search, AI answers, and generative results — we optimize for all of it, so your business shows up first no matter how people search.',
            'web_eyebrow' => 'Web Design & Development',
            'web_title_h2' => 'Websites built to',
            'web_title_accent' => 'perform',
            'web_title_after' => ', not just look good.',
            'web_lede' => 'Fast, modern, conversion-focused builds on the platform that fits your business — from WordPress and Shopify to custom AI chatbots.',
            'card_cta' => 'Explore service',
            'bottom_eyebrow' => 'Ready When You Are',
            'bottom_title' => 'Not sure which service you need?',
            'bottom_title_accent' => 'Let\'s map it out.',
            'bottom_lede' => 'Tell us your goals and we\'ll recommend the exact mix of SEO and development to get you there — no pressure, no jargon.',
            'bottom_cta_primary' => 'Get A Free Quote',
            'bottom_cta_secondary' => 'Book A Strategy Call',
        ];
    }

    /**
     * @return list<array{key:string, name:string, role:string, linkedin:string, image:string, bio:string}>
     */
    public static function defaultAuthors(): array
    {
        return [
            [
                'key' => 'hidayatul-haq',
                'name' => 'Hidayatul Haq',
                'role' => 'Founder, KodRank · SEO Strategist',
                'linkedin' => 'https://www.linkedin.com/in/hidayatul-haq',
                'image' => 'media/blog/hidayatul-haq.jpg',
                'bio' => 'Hidayat is the <strong>founder of KodRank</strong> and a <strong>top-rated SEO strategist</strong> who has delivered <strong>150+ projects across the globe</strong> — spanning technical audits, crawl-budget recovery, on-page optimization, and full-scale organic growth programs for founders, agencies, and in-house teams.',
            ],
            [
                'key' => 'fahad-bin-khalid',
                'name' => 'Fahad Bin Khalid',
                'role' => 'Co-founder, KodRank',
                'linkedin' => 'https://www.linkedin.com/in/fahad-bin-khalid-laravel',
                'image' => 'media/blog/fahad-bin-khalid.jpg',
                'bio' => 'Fahad is a <strong>co-founder of KodRank</strong>, building fast WordPress and custom web platforms with clean architecture, Core Web Vitals performance, and SEO-ready foundations from day one.',
            ],
        ];
    }

    private static function pointResultsNavToPage(): void
    {
        $nav = CmsSection::query()->where('key', 'nav')->first();
        if ($nav) {
            $data = is_array($nav->data) ? $nav->data : [];
            $changed = false;
            foreach ($data['links'] ?? [] as $i => $link) {
                if (strcasecmp((string) ($link['label'] ?? ''), 'Results') !== 0) {
                    continue;
                }
                $url = $link['url'] ?? '';
                if (in_array($url, ['#work', '/#work'], true)) {
                    $data['links'][$i]['url'] = '/results';
                    $changed = true;
                }
            }
            if ($changed) {
                $nav->update(['data' => $data]);
            }
        }

        $footer = CmsSection::query()->where('key', 'footer')->first();
        if (! $footer) {
            return;
        }
        $data = is_array($footer->data) ? $footer->data : [];
        $changed = false;
        foreach ($data['columns'] ?? [] as $ci => $col) {
            foreach ($col['links'] ?? [] as $li => $link) {
                if (strcasecmp((string) ($link['label'] ?? ''), 'Results') !== 0) {
                    continue;
                }
                $url = $link['url'] ?? '';
                if (in_array($url, ['#work', '/#work'], true)) {
                    $data['columns'][$ci]['links'][$li]['url'] = '/results';
                    $changed = true;
                }
            }
        }
        if ($changed) {
            $footer->update(['data' => $data]);
        }
    }

    private static function seedHomepageWorkIfPlaceholder(): void
    {
        $work = CmsSection::query()->where('key', 'work')->first();
        if (! $work) {
            return;
        }
        $data = is_array($work->data) ? $work->data : [];
        $fresh = ResultsPageDefaults::homepageWork();
        $first = $data['cases'][0]['title'] ?? '';
        if ($first === 'Northline Interiors') {
            $work->update(['data' => array_merge($data, $fresh)]);

            return;
        }

        $changed = false;
        foreach ($fresh['cases'] as $i => $case) {
            $currentTitle = $data['cases'][$i]['title'] ?? '';
            if ($currentTitle !== ($case['title'] ?? '')) {
                continue;
            }
            $wanted = $case['image'] ?? '';
            if ($wanted !== '' && ($data['cases'][$i]['image'] ?? '') !== $wanted) {
                $data['cases'][$i]['image'] = $wanted;
                $data['cases'][$i]['image_alt'] = $case['image_alt'] ?? ($data['cases'][$i]['image_alt'] ?? '');
                $changed = true;
            }
        }
        if ($changed) {
            $work->update(['data' => $data]);
        }
    }

    /**
     * @return array<string, mixed>
     */
    public static function homepageTestimonials(): array
    {
        return [
            'eyebrow' => 'Results, not promises',
            'title' => 'Businesses that stopped paying twice.',
            'lede' => 'Every engagement ends with a documented handover — and a client who can explain what was built and why.',
            'items' => [
                [
                    'quote' => 'If you’re looking for a team that will handle your project from A to Z — from keyword research to building an SEO-optimized website or application — this is the team for you. Great group of guys. I couldn’t recommend them enough. Hands down the best I’ve worked with. Thank you, KodRank.',
                    'initials' => 'CK',
                    'name' => 'Chris Kind',
                    'role' => 'CEO, HVAC Software',
                ],
                [
                    'quote' => 'I initially tried their keyword research service, and the quality was outstanding — that convinced me to build our website with them. Once it was completed, we signed up for a three-month SEO retainer. Their services have been excellent and they delivered exactly what they promised. Six months in, we’re extremely satisfied with the results and the whole experience.',
                    'initials' => 'VE',
                    'name' => 'Vladimir Evtodienko',
                    'role' => 'CEO, Evik Diagnostics',
                ],
                [
                    'quote' => 'I had a great experience working with them. They delivered the work on time, and the results exceeded my expectations. They’re very professional, polite in communication, and always ready to answer questions. The quality is outstanding and their dedication to the best results is truly impressive. I highly recommend KodRank to anyone looking for reliable, high-quality service.',
                    'initials' => 'VA',
                    'name' => 'Vaibhav Awasthi',
                    'role' => 'Founder',
                ],
            ],
        ];
    }

    private static function seedHomepageTestimonialsIfPlaceholder(): void
    {
        $section = CmsSection::query()->where('key', 'testimonials')->first();
        if (! $section) {
            return;
        }
        $data = is_array($section->data) ? $section->data : [];
        $first = $data['items'][0]['name'] ?? '';
        if (! in_array($first, ['Rana Malik', 'Sara Khan'], true)) {
            return;
        }
        $section->update(['data' => array_merge($data, self::homepageTestimonials())]);
    }

    /**
     * Homepage #services cards — KodRank carousel design, copy + URLs from the live service pages.
     *
     * @return array<string, mixed>
     */
    public static function homepageServices(): array
    {
        return [
            'eyebrow' => 'Our services',
            'title' => 'Web development and SEO services, à la carte or all at once.',
            'lede' => 'Whether you need a brand-new build, a technical rescue, or the complete package, here’s exactly what KodRank delivers.',
            'groups' => [
                [
                    'title' => 'Web Development Services',
                    'subtitle' => 'Built to be found',
                    'items' => [
                        [
                            'title' => 'Custom Website Development',
                            'body' => 'Hand-coded, fast, and secure websites built on modern frameworks — no bloated templates dragging down your speed or your rankings.',
                            'link_text' => 'Build my site',
                            'link_url' => '/web-design-and-development-services',
                        ],
                        [
                            'title' => 'E-Commerce Development',
                            'body' => 'Shopify, WooCommerce, and custom stores engineered to load fast, rank for product searches, and turn browsers into buyers.',
                            'link_text' => 'Sell more online',
                            'link_url' => '/shopify-development-services',
                        ],
                        [
                            'title' => 'Website Redesign & Migration',
                            'body' => 'Modernize an ageing site without losing your hard-won rankings. We migrate safely, preserving SEO equity every step of the way.',
                            'link_text' => 'Redesign safely',
                            'link_url' => '/website-redesign-services',
                        ],
                    ],
                ],
                [
                    'title' => 'SEO Services',
                    'subtitle' => 'Ranking, not guesswork',
                    'items' => [
                        [
                            'title' => 'Technical SEO',
                            'body' => 'Schema markup, crawlability, indexing, site architecture, and clean code — the foundation search engines actually reward.',
                            'link_text' => 'Audit my tech',
                            'link_url' => '/technical-seo-services',
                        ],
                        [
                            'title' => 'On-Page SEO',
                            'body' => 'Titles, meta descriptions, headings, internal links, and alt text optimized around the exact keywords your buyers are searching.',
                            'link_text' => 'Optimize my pages',
                            'link_url' => '/on-page-seo-services',
                        ],
                        [
                            'title' => 'Monthly SEO Services',
                            'body' => 'Ongoing, done-for-you SEO on a monthly retainer — technical fixes, content, links, and reporting that compound your rankings month after month.',
                            'link_text' => 'See monthly plans',
                            'link_url' => '/monthly-seo-services',
                        ],
                        [
                            'title' => 'SaaS SEO Services',
                            'body' => 'SEO built for software companies — product-led content, high-intent keywords, and technical architecture that turns organic search into a pipeline.',
                            'link_text' => 'Grow my SaaS',
                            'link_url' => '/saas-seo-services',
                        ],
                        [
                            'title' => 'Healthcare SEO Services',
                            'body' => 'Specialist SEO for clinics and practices — local visibility, Google Business Profile, and compliant content that helps patients find and trust you.',
                            'link_text' => 'Get more patients',
                            'link_url' => '/healthcare-seo-services',
                        ],
                        [
                            'title' => 'Guest Posting Services',
                            'body' => 'High-authority guest posts and digital PR — real editorial links from relevant sites that build your domain authority and lift rankings the safe way.',
                            'link_text' => 'Build my backlinks',
                            'link_url' => '/guest-posting-services',
                        ],
                    ],
                ],
                [
                    'title' => 'AI Search Optimization',
                    'subtitle' => 'Rank in AI answers, not just Google',
                    'layout' => 'aeo-geo',
                    'items' => [
                        [
                            'title' => 'AEO Services',
                            'body' => 'Answer Engine Optimization — structured content, schema, and FAQs built to win featured snippets and the direct answers people ask for.',
                            'link_text' => 'Own the answer',
                            'link_url' => '/aeo-services',
                        ],
                        [
                            'title' => 'GEO Services',
                            'body' => 'Generative Engine Optimization — get cited inside AI Overviews, ChatGPT, and Gemini, where more of your buyers now start their search.',
                            'link_text' => 'Get cited by AI',
                            'link_url' => '/geo-services',
                        ],
                    ],
                ],
            ],
            'web_cta_text' => 'View all web development services',
            'web_cta_url' => '/web-design-and-development-services',
            'seo_cta_text' => 'View all SEO services',
            'seo_cta_url' => '/digital-marketing-services',
        ];
    }

    /**
     * Industries mega + hub cards. Each URL maps to an existing service page
     * (Law Firm SEO has no dedicated page yet, so it uses the SEO hub).
     *
     * @return list<array{title:string, body:string, url:string}>
     */
    public static function industryNavItems(): array
    {
        return [
            ['title' => 'B2B SEO', 'body' => 'Search strategies that turn traffic into qualified pipeline.', 'url' => '/b2b-seo-services'],
            ['title' => 'Real Estate SEO', 'body' => 'Rank listings and capture high-intent buyers locally.', 'url' => '/real-estate-seo-services'],
            ['title' => 'Law Firm SEO', 'body' => 'Own your practice areas and win case-ready clients.', 'url' => '/digital-marketing-services'],
            ['title' => 'SaaS SEO', 'body' => 'Content and search engineered to grow recurring revenue.', 'url' => '/saas-seo-services'],
            ['title' => 'SaaS Software Development', 'body' => 'Custom SaaS products built to ship and scale.', 'url' => '/saas-software-development-services'],
            ['title' => 'Ecommerce SEO', 'body' => 'Grow product visibility and organic store revenue.', 'url' => '/ecommerce-seo-services'],
            ['title' => 'Healthcare SEO', 'body' => 'Compliant, trust-first SEO that reaches patients.', 'url' => '/healthcare-seo-services'],
            ['title' => 'Restaurant SEO', 'body' => 'Local search that fills tables and books covers.', 'url' => '/restaurant-seo-services'],
            ['title' => 'Electrician Website Design', 'body' => 'Fast, converting sites that book more jobs.', 'url' => '/electrician-website-design-services'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function homepageServiceUrls(): array
    {
        $map = [];
        $data = self::homepageServices();
        foreach ($data['groups'] as $group) {
            foreach ($group['items'] ?? [] as $item) {
                $title = trim((string) ($item['title'] ?? ''));
                if ($title !== '') {
                    $map[$title] = (string) ($item['link_url'] ?? '');
                }
            }
        }
        $map[(string) ($data['web_cta_text'] ?? 'View all web development services')] = (string) ($data['web_cta_url'] ?? '/web-design-and-development-services');
        $map[(string) ($data['seo_cta_text'] ?? 'View all SEO services')] = (string) ($data['seo_cta_url'] ?? '/digital-marketing-services');

        return $map;
    }

    public static function resolveHomepageServiceUrl(?string $title, ?string $url = null): string
    {
        $url = trim((string) $url);
        $dead = $url === '' || $url === '#' || strcasecmp(rtrim($url, '/'), '/contact') === 0;
        if (! $dead) {
            if (! str_starts_with($url, '/') && ! str_starts_with($url, 'http://') && ! str_starts_with($url, 'https://')) {
                return '/'.ltrim($url, '/');
            }

            return $url;
        }

        $map = self::homepageServiceUrls();
        $key = trim((string) $title);

        return $map[$key] ?? '#';
    }

    private static function syncHomepageServiceUrls(): void
    {
        $section = CmsSection::query()->where('key', 'services')->first();
        if (! $section) {
            return;
        }
        $data = is_array($section->data) ? $section->data : [];
        $seoTitles = array_column($data['groups'][1]['items'] ?? [], 'title');
        if (in_array('Keyword Research & Strategy', $seoTitles, true)) {
            $section->update(['data' => array_merge($data, self::homepageServices())]);

            return;
        }

        $changed = false;
        foreach ($data['groups'] ?? [] as $gi => $group) {
            foreach ($group['items'] ?? [] as $ii => $item) {
                $resolved = self::resolveHomepageServiceUrl($item['title'] ?? '', $item['link_url'] ?? '');
                if ($resolved !== '#' && $resolved !== (string) ($item['link_url'] ?? '')) {
                    $data['groups'][$gi]['items'][$ii]['link_url'] = $resolved;
                    $changed = true;
                }
            }
        }
        foreach (['web_cta_url' => $data['web_cta_text'] ?? 'View all web development services', 'seo_cta_url' => $data['seo_cta_text'] ?? 'View all SEO services'] as $key => $label) {
            $resolved = self::resolveHomepageServiceUrl($label, $data[$key] ?? '');
            if ($resolved !== '#' && $resolved !== (string) ($data[$key] ?? '')) {
                $data[$key] = $resolved;
                $changed = true;
            }
        }
        if ($changed) {
            $section->update(['data' => $data]);
        }
    }

    private static function isDeadPublicUrl(?string $url): bool
    {
        $url = strtolower(rtrim(trim((string) $url), '/'));

        return $url === '' || $url === '#' || $url === '/contact' || $url === 'contact';
    }

    private static function fixIndustryContactLinks(): void
    {
        $defaults = self::industryNavItems();
        $map = [];
        foreach ($defaults as $item) {
            $map[strtolower($item['title'])] = $item['url'];
        }

        $nav = CmsSection::query()->where('key', 'nav')->first();
        if ($nav) {
            $data = is_array($nav->data) ? $nav->data : [];
            $mega = is_array($data['industries_mega'] ?? null) ? $data['industries_mega'] : [];
            $items = $mega['items'] ?? [];
            $changed = false;
            if (count($items) < 8) {
                $mega['items'] = $defaults;
                $changed = true;
            } else {
                foreach ($items as $i => $item) {
                    if (! self::isDeadPublicUrl($item['url'] ?? '')) {
                        continue;
                    }
                    $key = strtolower(trim((string) ($item['title'] ?? '')));
                    if (isset($map[$key])) {
                        $items[$i]['url'] = $map[$key];
                        $changed = true;
                    }
                }
                if ($changed) {
                    $mega['items'] = $items;
                }
            }
            if ($changed) {
                $data['industries_mega'] = $mega;
                $nav->update(['data' => $data]);
            }
        }

        $page = ServicePage::query()->where('slug', 'industries')->first();
        if (! $page) {
            return;
        }
        $grid = $page->sections()->where('key', 'grid')->first();
        if (! $grid) {
            return;
        }
        $gdata = is_array($grid->data) ? $grid->data : [];
        $items = $gdata['items'] ?? [];
        $changed = false;
        foreach ($items as $i => $item) {
            if (! self::isDeadPublicUrl($item['url'] ?? '')) {
                continue;
            }
            $key = strtolower(trim((string) ($item['title'] ?? '')));
            if (isset($map[$key])) {
                $items[$i]['url'] = $map[$key];
                $changed = true;
            }
        }
        if (! $changed) {
            return;
        }
        $gdata['items'] = $items;
        $grid->update(['data' => $gdata]);
        ServicePage::forgetCache('industries');
    }
}
