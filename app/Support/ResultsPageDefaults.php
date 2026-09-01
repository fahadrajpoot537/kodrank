<?php

namespace App\Support;

class ResultsPageDefaults
{
    /**
     * Full /results page copy, metrics, and screenshot paths (admin-editable).
     *
     * @return array<string, mixed>
     */
    public static function data(): array
    {
        $img = 'media/results/';

        return [
            'seo_title' => 'Results — KodRank | Real Dashboards, Real Growth',
            'seo_description' => 'Live Search Console, Analytics, and PageSpeed proof from KodRank web builds and SEO campaigns — impressions, clicks, and platforms we shipped from scratch.',
            'og_image' => $img.'google-search-console-seo-results-16-months-manufacturer.jpg',
            'crumb_home' => 'Home',
            'crumb_here' => 'Results',
            'watermark' => 'results',
            'hero_title_html' => 'Real Dashboards. Real Growth.<br><span class="hl">Real Proof.</span>',
            'hero_lede' => 'KodRank isn\'t just another agency. We build fast websites, rank them to the top, and prove every result in the dashboards that matter — Search Console, Analytics, Clarity and PageSpeed, straight from live client accounts.',
            'hero_feats' => [
                'Custom Web Development',
                'Technical & Content SEO',
                'AI Search Visibility',
                'Dashboard-Verified Results',
            ],
            'form_title_html' => 'Book a Free<span class="hl">Consultation</span>',
            'form_lede' => 'Tell us about your website or growth goals — we\'ll show you exactly where the opportunity is.',
            'form_name_label' => 'Full Name',
            'form_name_placeholder' => 'Your name',
            'form_email_label' => 'Email',
            'form_email_placeholder' => 'you@company.com',
            'form_phone_label' => 'Number',
            'form_phone_placeholder' => '+92 300 0000000',
            'form_message_label' => 'Describe Your Project Need',
            'form_message_placeholder' => 'A few lines about your project…',
            'form_consent_html' => 'By submitting this form, you agree to our <a href="/privacy-policy">Privacy Policy</a>.',
            'form_submit' => 'Get In Touch',
            'stats' => [
                ['count' => '58', 'suffix' => 'M+', 'html' => '', 'label' => 'Search impressions generated'],
                ['count' => '460', 'suffix' => 'K+', 'html' => '', 'label' => 'Organic clicks delivered'],
                ['count' => '700', 'suffix' => 'K+', 'html' => '', 'label' => 'Users reached across clients'],
                ['count' => '', 'suffix' => '', 'html' => 'Top 7', 'label' => 'Avg. Google ranking position'],
            ],
            'seo_eyebrow' => 'SEO & Growth Results',
            'seo_title_html' => 'The screenshots behind the <span class="hl">growth.</span>',
            'seo_lede' => 'Live analytics from real client accounts. Sensitive brand names are kept confidential — everything else is exactly as it appears in the dashboard.',
            'seo_cases' => [
                self::showcase([
                    'tag' => 'Surgical Instruments · Manufacturer · SEO',
                    'title' => '34.8M impressions from a standing start.',
                    'body_html' => 'A live Google Search Console account — 16 months of it. We rebuilt the site architecture, cleared technical debt, and shipped intent-driven product and category pages in three languages. The payoff: <b>307K organic clicks</b> at an average position of <b>6.8</b>. Analytics confirms <b>497K users</b> and <b>2.9M on-site events</b> over the same window.',
                    'image' => $img.'google-search-console-seo-results-16-months-manufacturer.jpg',
                    'image_alt' => 'Google Search Console showing 34.8M impressions and 307K clicks over 16 months for a surgical instruments manufacturer',
                    'image_thumb' => $img.'google-analytics-497k-users-manufacturer.jpg',
                    'image_thumb_alt' => 'Google Analytics 4 dashboard showing 497K active users and 2.9M events for a surgical instruments manufacturer',
                    'frame_label' => 'Google Search Console — 16 months',
                    'frame_thumb_label' => 'Google Analytics 4 — 497K users',
                    'badge_value' => '34.8M',
                    'badge_label' => 'Impressions',
                    'metrics' => [
                        ['value' => '34.8', 'suffix' => 'M', 'label' => 'Impressions'],
                        ['value' => '307', 'suffix' => 'K', 'label' => 'Clicks'],
                        ['value' => '497', 'suffix' => 'K', 'label' => 'Users'],
                        ['value' => '6.8', 'suffix' => '', 'label' => 'Avg position'],
                    ],
                ]),
                self::showcase([
                    'flip' => '1',
                    'tag' => 'Surgical Instruments · Exporter · SEO + AI',
                    'title' => 'A curve that keeps climbing — into AI results too.',
                    'body_html' => 'Another surgical-instruments brand, rebuilt for export markets. From near-zero, impressions scaled to <b>21.2M</b> with <b>161K clicks</b> at an average position of <b>6.3</b>. It now also surfaces inside <b>Google\'s AI Overviews — 2.42M impressions</b> there alone, keeping the brand visible as search shifts to AI.',
                    'image' => $img.'google-search-console-seo-results-16-months-exporter.jpg',
                    'image_alt' => 'Google Search Console showing 21.2M impressions and 161K clicks over 16 months for a surgical instruments exporter',
                    'image_thumb' => $img.'google-search-console-generative-ai-visibility-exporter.jpg',
                    'image_thumb_alt' => 'Google Search Console Generative AI features showing 2.42M impressions for AI search visibility',
                    'frame_label' => 'Google Search Console — 16 months',
                    'frame_thumb_label' => 'Search Console — Generative AI (2.42M)',
                    'badge_value' => '21.2M',
                    'badge_label' => 'Impressions',
                    'metrics' => [
                        ['value' => '21.2', 'suffix' => 'M', 'label' => 'Impressions'],
                        ['value' => '161', 'suffix' => 'K', 'label' => 'Clicks'],
                        ['value' => '2.42', 'suffix' => 'M', 'label' => 'AI overview views'],
                        ['value' => '6.3', 'suffix' => '', 'label' => 'Avg position'],
                    ],
                ]),
                self::showcase([
                    'tag' => 'Real Estate · New Project',
                    'title' => 'Ranking fast — inside the first 28 days.',
                    'body_html' => 'A brand-new real-estate site we just launched. In its <b>first 28 days</b> it\'s already earning <b>16.6K impressions</b> and a <b>1.9% CTR</b> — proof our foundations start working from day one, not month six.',
                    'image' => $img.'google-search-console-new-website-28-days-serik-realty.jpg',
                    'image_alt' => 'Google Search Console showing 16.6K impressions in first 28 days for a new real-estate website',
                    'frame_label' => 'Google Search Console — first 28 days',
                    'badge_value' => '28 days',
                    'badge_label' => 'To traction',
                    'badge_pos' => 'bl2',
                    'badge_icon' => 'bolt',
                    'metrics' => [
                        ['value' => '16.6', 'suffix' => 'K', 'label' => 'Impressions'],
                        ['value' => '307', 'suffix' => '', 'label' => 'Clicks'],
                        ['value' => '1.9', 'suffix' => '%', 'label' => 'Avg CTR'],
                        ['value' => '28', 'suffix' => '', 'label' => 'Days live'],
                    ],
                ]),
            ],
            'projects_eyebrow' => 'Web Development Projects',
            'projects_title_html' => 'Platforms and sites we <span class="hl">built from scratch.</span>',
            'projects_lede' => 'Custom code, real integrations, and performance scores most agencies can\'t touch — no page builders.',
            'project_cases' => [
                self::showcase([
                    'flip' => '1',
                    'tag' => 'Pharma / Biotech · Built from scratch',
                    'title' => 'Hand-built, and it scores 98.',
                    'body_html' => 'A complete website we built from scratch for a Canadian freeze-drying company. Clean custom code — no page builders — so it lands <b>98 Performance</b>, <b>100 Best Practices</b>, <b>92 SEO</b> and <b>94 Accessibility</b> on Google PageSpeed, with identical scores on mobile and desktop.',
                    'image' => $img.'lyovial-pharma-website-built-from-scratch.jpg',
                    'image_alt' => 'Lyovial pharma website homepage built from scratch with custom code',
                    'image_thumb' => $img.'google-pagespeed-score-98-lyovial.jpg',
                    'image_thumb_alt' => 'Google PageSpeed Insights score of 98 Performance 94 Accessibility 100 Best Practices 92 SEO for Lyovial',
                    'frame_label' => 'lyovial.com — built from scratch',
                    'frame_thumb_label' => 'Google PageSpeed — 98 / 94 / 100 / 92',
                    'badge_value' => '98',
                    'badge_label' => 'PageSpeed',
                    'badge_icon' => 'bolt',
                    'metrics' => [
                        ['value' => '98', 'suffix' => '', 'label' => 'Performance'],
                        ['value' => '100', 'suffix' => '', 'label' => 'Best practices'],
                        ['value' => '92', 'suffix' => '', 'label' => 'SEO'],
                        ['value' => '94', 'suffix' => '', 'label' => 'Accessibility'],
                    ],
                ]),
                self::showcase([
                    'tag' => 'Property · AI-Powered Platform',
                    'title' => 'A full investment platform, powered by AI.',
                    'body_html' => 'A large-scale property-sourcing platform on <b>Laravel 12</b>. AI writes and parses listings, valuations run automatically, and investors and agents each get their own dashboards — with <b>Stripe</b> payments, <b>WhatsApp OTP</b> login and email automation wired in.',
                    'image' => $img.'laravel-property-investment-platform-ai-powered.jpg',
                    'image_alt' => 'Laravel 12 property investment platform with AI-powered listings and Stripe payments',
                    'frame_label' => 'Property investment platform',
                    'chips' => ['Laravel 12', 'OpenAI', 'Stripe', 'Twilio', 'Google Maps', 'MySQL'],
                ]),
                self::showcase([
                    'flip' => '1',
                    'tag' => 'IT Services · Corporate Website',
                    'title' => 'A corporate site with real motion.',
                    'body_html' => 'A polished website for an IT-services company, built with smooth, purpose-built animations and a clear services, industries and portfolio structure — fully responsive and conversion-focused.',
                    'image' => $img.'it-services-corporate-website-smooth-animations.jpg',
                    'image_alt' => 'IT services corporate website with smooth scroll animations',
                    'frame_label' => 'IT solutions website',
                    'feats' => [
                        'Smooth scroll & motion interactions throughout',
                        'Structured services, industries & portfolio',
                        'Responsive, conversion-focused layout',
                    ],
                ]),
                self::showcase([
                    'tag' => 'Transport · Booking Platform',
                    'title' => 'Book a ride — fare calculated live.',
                    'body_html' => 'A cab-booking platform with live distance and fare calculation via the <b>Google Matrix API</b>, secure <b>PayPal</b> and <b>Square</b> checkout, and a fully responsive booking flow.',
                    'image' => $img.'cab-booking-platform-google-matrix-api-melair.jpg',
                    'image_alt' => 'MelAir cab booking platform with Google Matrix API fare calculation',
                    'frame_label' => 'Cab booking platform',
                    'feats' => [
                        'Live distance & fare via Google Matrix API',
                        'Secure payments with PayPal & Square',
                        'Fully responsive, ride-ready booking',
                    ],
                ]),
                self::showcase([
                    'flip' => '1',
                    'tag' => 'SaaS · Leads & Task Management',
                    'title' => 'A CRM that tracks 260K+ leads.',
                    'body_html' => 'A full task-and-lead management system with a live sales dashboard — <b>263K+ total leads</b> across project groups, real-time conversion tracking, and an activity overview that separates new leads from conversions at a glance.',
                    'image' => $img.'task-management-system-crm-263k-leads-dashboard.jpg',
                    'image_alt' => 'Task management system CRM dashboard showing 263K total leads and conversion tracking',
                    'frame_label' => 'Task Management System — dashboard',
                    'badge_value' => '263K+',
                    'badge_label' => 'Leads',
                    'feats' => [
                        'Live leads, conversions & follow-ups',
                        'Grouped lead databases & project groups',
                        'Role-based admin dashboard',
                    ],
                ]),
                self::showcase([
                    'tag' => 'PropTech · UK Property Portal',
                    'title' => 'A property search portal for the UK.',
                    'body_html' => 'A clean, fast property marketplace — search <b>for sale, to rent and house prices</b> across the UK, with area, type, price and bedroom filters wired into a responsive search experience.',
                    'image' => $img.'property-search-portal-uk-propertyfinda.jpg',
                    'image_alt' => 'PropertyFinda UK property search portal with sale rent and price filters',
                    'frame_label' => 'PropertyFinda — property search',
                    'feats' => [
                        'For sale, to rent & house prices',
                        'Area, type, price & bedroom filters',
                        'Responsive UK-wide search',
                    ],
                ]),
                self::showcase([
                    'flip' => '1',
                    'tag' => 'Transport · Fleet & Booking Admin',
                    'title' => 'A complete car-hire back office.',
                    'body_html' => 'An admin console for a car-hire business — manage cars, drivers and bookings, raise <b>invoices and receipts</b>, log expenses, and track a live income-vs-expenses trend, all in one dashboard.',
                    'image' => $img.'car-hire-fleet-booking-admin-dashboard-arrow.jpg',
                    'image_alt' => 'Arrow Car Hire fleet and booking admin dashboard with income tracking',
                    'frame_label' => 'Arrow Car Hire — admin dashboard',
                    'feats' => [
                        'Cars, drivers & bookings in one place',
                        'Invoices, receipts & ledger',
                        'Income vs expenses tracking',
                    ],
                ]),
                self::showcase([
                    'tag' => 'Real Estate · Corporate Website',
                    'title' => 'A polished site for a property investment firm.',
                    'body_html' => 'A corporate website for a real-estate investment and development group — mission and vision, an <b>animated growth journey</b>, partner CTAs and a full leadership team section, all on-brand and responsive.',
                    'image' => $img.'real-estate-investment-corporate-website-aton.jpg',
                    'image_alt' => 'ATON Property Group real estate investment corporate website',
                    'frame_label' => 'ATON Property Group — website',
                    'feats' => [
                        'Mission, vision & services',
                        'Animated growth metrics',
                        'Leadership team & clear CTAs',
                    ],
                ]),
                self::showcase([
                    'flip' => '1',
                    'tag' => 'Healthcare · Product Design Case Study',
                    'title' => 'An AI maternal-health triage system, end to end.',
                    'body_html' => 'A full product case study for an <b>AI-powered maternal-health triage system</b> — problem framing, three connected apps (mothers, health volunteers and USSD), user personas, a seven-day delivery timeline and measurable success criteria.',
                    'image' => $img.'ai-maternal-health-triage-case-study-afya-mama.jpg',
                    'image_alt' => 'Afya Mama AI-powered maternal health triage system case study',
                    'frame_label' => 'Afya Mama — case study',
                    'feats' => [
                        'Web + CHV + USSD connected systems',
                        'User personas & journey mapping',
                        'AI-powered risk prediction',
                    ],
                ]),
                self::showcase([
                    'tag' => 'HealthTech · Provider Analytics',
                    'title' => 'A provider console for 122K+ patients.',
                    'body_html' => 'A healthcare analytics console — <b>payer mix, risk distribution and population health</b> by condition, plus service-area breakdowns across 122K+ patients, with CSV export on every panel.',
                    'image' => $img.'healthcare-provider-analytics-console-122k-patients-care-ai.jpg',
                    'image_alt' => 'Care AI healthcare provider analytics console tracking 122K patients',
                    'frame_label' => 'Care AI — provider console',
                    'badge_value' => '122K+',
                    'badge_label' => 'Patients',
                    'feats' => [
                        'Payer & risk analytics',
                        'Population health by condition',
                        'Service-area & CSV export',
                    ],
                ]),
            ],
            'process_eyebrow' => 'How We Work',
            'process_title_html' => 'Why the numbers keep <span class="hl">going up.</span>',
            'process_lede' => 'Results aren\'t luck. They come from a system we run on every project.',
            'process_steps' => [
                ['n' => '01', 'title' => 'Build it right', 'body_html' => 'Hand-coded, <b>fast and clean</b> — sites that score 90+ on Core Web Vitals so Google and users both stay happy.'],
                ['n' => '02', 'title' => 'Rank it hard', 'body_html' => 'Intent-driven pages, technical SEO and <b>multilingual reach</b> that turn impressions into qualified clicks.'],
                ['n' => '03', 'title' => 'Prove it works', 'body_html' => 'Every result tracked in <b>Search Console, GA4 & Clarity</b> — so you see exactly what your investment returns.'],
            ],
            'clients_eyebrow' => 'Clients & Platforms',
            'clients_title_html' => 'Trusted by real clients — proven on the <span class="hl">platforms that matter.</span>',
            'clients_lede' => 'Brands we\'ve built and ranked for, and the marketplaces where our work speaks for itself.',
            'clients' => [
                ['image' => $img.'client-logo-lyovial-pharma.jpg', 'alt' => 'Lyovial'],
                ['image' => $img.'client-logo-evik-lyobeads.jpg', 'alt' => 'EVIK Lyobeads'],
                ['image' => $img.'platform-logo-upwork.jpg', 'alt' => 'Upwork'],
                ['image' => $img.'platform-logo-fiverr.jpg', 'alt' => 'Fiverr'],
            ],
        ];
    }

    /**
     * Homepage “Selected work” cards (same three builds + dashboard images).
     *
     * @return array<string, mixed>
     */
    public static function homepageWork(): array
    {
        $img = 'media/work/';

        return [
            'eyebrow' => 'Selected work',
            'title' => 'Sites that were found, not just admired.',
            'lede' => 'Three recent builds where development and search were scoped together from the first call.',
            'cases' => [
                [
                    'tag' => 'Web build · Technical & on-page SEO',
                    'title' => 'Surgical Instruments Manufacturer',
                    'body' => 'A B2B manufacturer with strong products but weak visibility. We rebuilt the site on a fast, crawlable foundation and mapped content to buyer search intent — traffic and engagement climbed across the board.',
                    'image' => $img.'google-analytics-494k-users-manufacturer.png',
                    'image_alt' => 'Google Analytics dashboard showing 494K active users and 2.9M events after an SEO rebuild',
                    'metric1_value' => '494K',
                    'metric1_label' => 'Active users',
                    'metric2_value' => '2.9M',
                    'metric2_label' => 'Events tracked',
                ],
                [
                    'tag' => 'SEO campaign · Organic growth',
                    'title' => 'Organic Search Performance',
                    'body' => 'Search-led architecture, technical fixes, and content built for intent — compounding into a steep, sustained climb in clicks and impressions over the campaign, not a short-lived spike.',
                    'image' => $img.'google-search-console-307k-clicks.png',
                    'image_alt' => 'Google Search Console showing 307K clicks and 34.6M impressions on an upward trend',
                    'metric1_value' => '307K',
                    'metric1_label' => 'Total clicks',
                    'metric2_value' => '34.6M',
                    'metric2_label' => 'Impressions',
                ],
                [
                    'tag' => 'Web development · Local SEO',
                    'title' => 'Realtor Cash-Back Platform',
                    'body' => 'A conversion-first real-estate site for an Ontario realtor — custom cash-back and mortgage calculators, clear CTAs, and local SEO built in so buyers and sellers find it and act.',
                    'image' => $img.'realtor-cash-back-platform-ontario.png',
                    'image_alt' => 'Ontario real-estate website homepage built by KodRank with cash-back and mortgage tools',
                    'metric1_value' => '1.5%',
                    'metric1_label' => 'Cash-back tool built',
                    'metric2_value' => 'Local',
                    'metric2_label' => 'Optimized to rank',
                ],
            ],
        ];
    }

    /**
     * @param  array<string, mixed>  $over
     * @return array<string, mixed>
     */
    private static function showcase(array $over): array
    {
        return array_merge([
            'flip' => '',
            'tag' => '',
            'title' => '',
            'body_html' => '',
            'image' => '',
            'image_alt' => '',
            'image_thumb' => '',
            'image_thumb_alt' => '',
            'frame_label' => '',
            'frame_thumb_label' => '',
            'badge_value' => '',
            'badge_label' => '',
            'badge_pos' => 'tr',
            'badge_icon' => 'trend',
            'metrics' => [],
            'chips' => [],
            'feats' => [],
        ], $over);
    }
}
