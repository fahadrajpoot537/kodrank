<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPageSetting;
use App\Models\BlogPost;
use App\Models\CmsSection;
use DOMDocument;
use DOMXPath;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['slug' => 'seo', 'name' => 'SEO', 'sort_order' => 1],
            ['slug' => 'web-development', 'name' => 'Web Development', 'sort_order' => 2],
            ['slug' => 'aeo-geo', 'name' => 'AEO & GEO', 'sort_order' => 3],
        ];

        $catIds = [];
        foreach ($categories as $cat) {
            $row = BlogCategory::query()->updateOrCreate(
                ['slug' => $cat['slug']],
                ['name' => $cat['name'], 'sort_order' => $cat['sort_order']]
            );
            $catIds[$cat['slug']] = $row->id;
        }

        $settingsRow = BlogPageSetting::query()->first();
        if ($settingsRow) {
            $settingsRow->update([
                'data' => array_merge(
                    BlogPageSetting::defaults(),
                    $settingsRow->data ?? [],
                    $this->themeNewsletterSettings()
                ),
            ]);
        } else {
            BlogPageSetting::query()->create(['data' => BlogPageSetting::defaults()]);
        }
        BlogPageSetting::forgetCache();

        $posts = $this->posts($catIds);
        $seenTitles = [];

        foreach ($posts as $i => $post) {
            $title = $post['title'];
            if (isset($seenTitles[$title])) {
                continue;
            }
            $seenTitles[$title] = true;

            $slug = $post['slug'] ?? Str::slug($title);
            unset($post['slug']);

            if (stripos((string) ($post['author_name'] ?? ''), 'Fahad') !== false) {
                $post['author_linkedin'] = 'https://www.linkedin.com/in/fahad-bin-khalid-laravel';
            }

            BlogPost::query()->updateOrCreate(
                ['slug' => $slug],
                array_merge($post, [
                    'sort_order' => $post['sort_order'] ?? $i,
                    'is_published' => true,
                ])
            );
        }

        $this->seedInternalThemePost();
        $this->ensureFooterBlogLink();
    }

    private function seedInternalThemePost(): void
    {
        $themePath = public_path('theme/blog/blog-post-internal-page (1).html');
        $content = '';

        if (is_file($themePath)) {
            $theme = file_get_contents($themePath);
            if (preg_match('/<article class="content">(.*?)<\/article>/is', $theme, $match)) {
                $content = $this->stripManagedThemeBlocks($match[1]);
            }
        }

        BlogPost::query()
            ->where('slug', 'crawl-budget-explained')
            ->first()
            ?->update([
                'title' => 'Crawl budget waste: why Google ignores your best pages.',
                'excerpt' => 'A step-by-step technical audit for finding and fixing crawl budget waste — the silent reason your best pages never get indexed or ranked.',
                'content_html' => $content,
                'read_minutes' => 11,
                'published_at' => Carbon::parse('2026-08-04 12:00:00'),
                'featured_image' => null,
                'featured_image_alt' => 'Technical SEO crawl budget analysis on a laptop screen',
                'seo_title' => 'Crawl Budget Waste: Why Google Ignores Your Best Pages | KodRank',
                'seo_description' => 'A practical crawl budget audit: why Google ignores important pages, the warning signs, and the technical fixes that move the needle.',
                'seo_keywords' => 'crawl budget, crawl budget audit, Google crawling, indexation, technical SEO',
                'og_title' => 'Crawl Budget Waste: How to Stop Google From Ignoring Your Best Pages',
                'og_description' => 'A step-by-step technical audit for finding and fixing crawl budget waste before it costs you rankings.',
                'robots' => 'index, follow',
                'post_tags' => 'Technical SEO, Crawl & Indexation, eCommerce SEO, Log File Analysis',
                'author_name' => 'Hidayatul Haq',
                'author_role' => 'Founder, KodRank · SEO Strategist',
                'author_bio' => 'Hidayat is the founder of KodRank and a top-rated SEO strategist who has delivered 150+ projects across the globe — spanning technical audits, crawl-budget recovery, on-page optimization, and full-scale organic growth programs.',
                'inline_cta_title' => 'Want us to run this audit on your site?',
                'inline_cta_body' => 'We\'ll pull your log files, map the crawl split by template, and hand you a prioritized fix list — no retainer required to start.',
                'inline_cta_text' => 'Request the Audit',
                'inline_cta_url' => '/contact',
            ]);
    }

    private function themeNewsletterSettings(): array
    {
        return [
            'newsletter_eyebrow' => 'Straight to your inbox',
            'newsletter_title' => 'One technical SEO breakdown, every other week.',
            'newsletter_title_html' => 'One technical SEO breakdown, <span class="hl">every other week.</span>',
            'newsletter_copy' => 'No fluff, no "10 tips" listicles — just the audits, log-file findings, and fixes our team is running right now.',
            'newsletter_fine' => '',
            'newsletter_placeholder' => 'you@company.com',
        ];
    }

    private function stripManagedThemeBlocks(string $content): string
    {
        $previous = libxml_use_internal_errors(true);
        $document = new DOMDocument('1.0', 'UTF-8');
        $document->loadHTML(
            '<?xml encoding="UTF-8"><div id="theme-article">'.$content.'</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        $xpath = new DOMXPath($document);
        foreach ($xpath->query(
            '//*[@class and (contains(concat(" ", normalize-space(@class), " "), " post-tags ") or contains(concat(" ", normalize-space(@class), " "), " author-card "))]'
        ) as $node) {
            $node->parentNode?->removeChild($node);
        }

        $root = $document->getElementById('theme-article');
        $html = '';
        foreach ($root?->childNodes ?? [] as $child) {
            $html .= $document->saveHTML($child);
        }

        return trim($html);
    }

    private function ensureFooterBlogLink(): void
    {
        $footer = CmsSection::query()->where('key', 'footer')->first();
        if (! $footer) {
            return;
        }

        $data = $footer->data ?? [];
        $columns = $data['columns'] ?? [];
        $changed = false;

        foreach ($columns as &$col) {
            if (strcasecmp($col['title'] ?? '', 'Company') !== 0) {
                continue;
            }
            $links = $col['links'] ?? [];
            $hasBlog = collect($links)->contains(fn ($l) => strcasecmp($l['label'] ?? '', 'Blog') === 0);
            if (! $hasBlog) {
                array_unshift($links, ['label' => 'Blog', 'url' => '/blogs']);
                $col['links'] = $links;
                $changed = true;
            } else {
                foreach ($links as &$link) {
                    if (strcasecmp($link['label'] ?? '', 'Blog') === 0 && ($link['url'] ?? '') === '/blog') {
                        $link['url'] = '/blogs';
                        $changed = true;
                    }
                }
                unset($link);
                $col['links'] = $links;
            }
        }
        unset($col);

        if ($changed) {
            $data['columns'] = $columns;
            $footer->update(['data' => $data]);
            CmsSection::forgetCache();
        }
    }

    private function body(string $excerpt, array $paragraphs = []): string
    {
        $parts = array_merge([$excerpt], $paragraphs ?: [
            'This guide walks through the practical steps our team uses with clients — measured against rankings, pipeline, and AI visibility rather than vanity metrics.',
            'Start with the diagnosis, prioritize the highest-leverage fixes, and only then expand into content and distribution. That sequencing is what separates durable growth from busywork.',
        ]);

        return implode("\n\n", $parts);
    }

    private function date(string $human): ?Carbon
    {
        try {
            return Carbon::parse($human);
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * @param  array<string,int>  $catIds
     * @return list<array<string,mixed>>
     */
    private function posts(array $catIds): array
    {
        $hidayat = 'Hidayatul Haq';
        $fahad = 'Fahad Bin Khalid';

        return [
            // Latest / featured
            [
                'title' => 'Topical authority: why search engines and AI now rank topics, not just pages',
                'slug' => 'topical-authority-topics-not-pages',
                'excerpt' => 'A single optimized page isn\'t enough anymore. Here\'s the framework we use to build, measure, and grow topical authority across Google and AI answer engines at once.',
                'body' => $this->body(
                    'A single optimized page isn\'t enough anymore. Here\'s the framework we use to build, measure, and grow topical authority across Google and AI answer engines at once.',
                    [
                        'Topical authority is earned when your site covers a subject with depth, internal linking, and consistent entity signals — not when you publish one long pillar and call it done.',
                        'We map clusters to buyer journeys, close content gaps competitors leave open, and measure both classic rankings and AI citations as parallel outcomes.',
                    ]
                ),
                'tag_label' => 'General SEO',
                'author_name' => $hidayat,
                'category_id' => $catIds['seo'],
                'read_minutes' => 9,
                'published_at' => $this->date('2026-08-11'),
                'is_featured' => true,
                'is_editors_pick' => false,
                'show_in_latest' => true,
                'sort_order' => 10,
            ],
            [
                'title' => 'Technical SEO audits: the 12-point checklist we run every month',
                'slug' => 'technical-seo-audits-12-point-checklist',
                'excerpt' => 'Crawl budget, indexation, structured data, Core Web Vitals — the exact checklist our team runs on every retainer client, in order of impact.',
                'body' => $this->body('Crawl budget, indexation, structured data, Core Web Vitals — the exact checklist our team runs on every retainer client, in order of impact.'),
                'tag_label' => 'Technical SEO',
                'author_name' => $hidayat,
                'category_id' => $catIds['seo'],
                'read_minutes' => 11,
                'published_at' => $this->date('2026-08-09'),
                'is_featured' => false,
                'show_in_latest' => true,
                'sort_order' => 20,
            ],
            [
                'title' => 'What is AEO? A practical guide to Answer Engine Optimization',
                'slug' => 'what-is-aeo-practical-guide',
                'excerpt' => 'AEO optimizes for AI Overviews, featured snippets, and voice assistants. Here\'s how it differs from classic SEO — and where the two overlap.',
                'body' => $this->body('AEO optimizes for AI Overviews, featured snippets, and voice assistants. Here\'s how it differs from classic SEO — and where the two overlap.'),
                'tag_label' => 'Answer Engine Optimization',
                'author_name' => $hidayat,
                'category_id' => $catIds['aeo-geo'],
                'read_minutes' => 8,
                'published_at' => $this->date('2026-08-08'),
                'is_featured' => false,
                'show_in_latest' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Core Web Vitals in 2026: the five metrics that actually correlate with rankings',
                'slug' => 'core-web-vitals-2026-five-metrics',
                'excerpt' => 'LCP and INP still matter, but two newer signals are quietly influencing rankings. We break down what to fix first on real client sites.',
                'body' => $this->body('LCP and INP still matter, but two newer signals are quietly influencing rankings. We break down what to fix first on real client sites.'),
                'tag_label' => 'Site Speed',
                'author_name' => $fahad,
                'category_id' => $catIds['web-development'],
                'read_minutes' => 10,
                'published_at' => $this->date('2026-08-07'),
                'is_featured' => false,
                'show_in_latest' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'How a B2B SaaS brand 3x\'d organic pipeline in 7 months',
                'slug' => 'b2b-saas-3x-organic-pipeline',
                'excerpt' => 'A full breakdown of the technical fixes, content wave, and AEO layer that took a stalled SaaS site from flat traffic to compounding pipeline.',
                'body' => $this->body('A full breakdown of the technical fixes, content wave, and AEO layer that took a stalled SaaS site from flat traffic to compounding pipeline.'),
                'tag_label' => 'Case Study',
                'author_name' => $hidayat,
                'category_id' => $catIds['seo'],
                'read_minutes' => 7,
                'published_at' => $this->date('2026-08-05'),
                'is_featured' => false,
                'show_in_latest' => true,
                'sort_order' => 50,
            ],
            [
                'title' => 'Link building without the spam: 6 approaches that still work',
                'slug' => 'link-building-without-spam',
                'excerpt' => 'Manual outreach is slow but durable. Here are six link acquisition tactics we actually use in 2026 — and three we\'ve retired.',
                'body' => $this->body('Manual outreach is slow but durable. Here are six link acquisition tactics we actually use in 2026 — and three we\'ve retired.'),
                'tag_label' => 'Link Building',
                'author_name' => $hidayat,
                'category_id' => $catIds['seo'],
                'read_minutes' => 9,
                'published_at' => $this->date('2026-08-03'),
                'is_featured' => false,
                'show_in_latest' => true,
                'sort_order' => 60,
            ],

            // Editors picks
            [
                'title' => 'What is SEO? A complete guide for 2026',
                'slug' => 'what-is-seo-complete-guide-2026',
                'excerpt' => 'Search engine optimization, explained from first principles — for teams starting from zero.',
                'body' => $this->body('Search engine optimization, explained from first principles — for teams starting from zero.'),
                'tag_label' => 'General SEO',
                'author_name' => $hidayat,
                'category_id' => $catIds['seo'],
                'read_minutes' => 13,
                'published_at' => $this->date('2026-07-01'),
                'is_editors_pick' => true,
                'show_in_latest' => false,
                'sort_order' => 100,
            ],
            [
                'title' => 'Technical SEO: basics and best practices',
                'slug' => 'technical-seo-basics-best-practices',
                'excerpt' => 'Crawling, indexing, and site health — the foundation everything else is built on.',
                'body' => $this->body('Crawling, indexing, and site health — the foundation everything else is built on.'),
                'tag_label' => 'Technical SEO',
                'author_name' => $hidayat,
                'category_id' => $catIds['seo'],
                'read_minutes' => 18,
                'published_at' => $this->date('2026-07-02'),
                'is_editors_pick' => true,
                'show_in_latest' => false,
                'sort_order' => 110,
            ],
            [
                'title' => 'GEO vs SEO: how to get cited by ChatGPT & Gemini',
                'slug' => 'geo-vs-seo-chatgpt-gemini',
                'excerpt' => 'Generative Engine Optimization, unpacked — and how it sits alongside classic search.',
                'body' => $this->body('Generative Engine Optimization, unpacked — and how it sits alongside classic search.'),
                'tag_label' => 'AI',
                'author_name' => $hidayat,
                'category_id' => $catIds['aeo-geo'],
                'read_minutes' => 10,
                'published_at' => $this->date('2026-07-03'),
                'is_editors_pick' => true,
                'show_in_latest' => false,
                'sort_order' => 120,
            ],
            [
                'title' => 'How to do keyword research in 2026',
                'slug' => 'how-to-do-keyword-research-2026',
                'excerpt' => 'Six methods and a repeatable framework for mapping topics, not just terms.',
                'body' => $this->body('Six methods and a repeatable framework for mapping topics, not just terms.'),
                'tag_label' => 'Keyword Research',
                'author_name' => $hidayat,
                'category_id' => $catIds['seo'],
                'read_minutes' => 13,
                'published_at' => $this->date('2026-07-04'),
                'is_editors_pick' => true,
                'show_in_latest' => false,
                'sort_order' => 130,
            ],

            // SEO category extras
            [
                'title' => 'On-page SEO in 2026: what actually moves rankings now',
                'slug' => 'on-page-seo-2026',
                'excerpt' => 'Title tags and alt text still matter, but they\'re not the lever they used to be. Here\'s what does.',
                'body' => $this->body('Title tags and alt text still matter, but they\'re not the lever they used to be. Here\'s what does.'),
                'tag_label' => 'On-Page SEO',
                'author_name' => $hidayat,
                'category_id' => $catIds['seo'],
                'read_minutes' => 10,
                'published_at' => $this->date('2026-07-30'),
                'show_in_latest' => false,
                'sort_order' => 1,
            ],
            [
                'title' => 'Local SEO for multi-location brands: fixing duplicate listings at scale',
                'slug' => 'local-seo-multi-location-duplicate-listings',
                'excerpt' => 'A practical playbook for cleaning up NAP inconsistencies and duplicate listings across 20+ locations.',
                'body' => $this->body('A practical playbook for cleaning up NAP inconsistencies and duplicate listings across 20+ locations.'),
                'tag_label' => 'Local SEO',
                'author_name' => $hidayat,
                'category_id' => $catIds['seo'],
                'read_minutes' => 12,
                'published_at' => $this->date('2026-07-27'),
                'show_in_latest' => false,
                'sort_order' => 2,
            ],
            [
                'title' => 'Crawl budget waste: why Google ignores your best pages.',
                'slug' => 'crawl-budget-explained',
                'excerpt' => 'A step-by-step technical audit for finding and fixing crawl budget waste — the silent reason your best pages never get indexed or ranked.',
                'body' => $this->body('A step-by-step technical audit for finding and fixing crawl budget waste — the silent reason your best pages never get indexed or ranked.'),
                'tag_label' => 'Technical SEO',
                'author_name' => $hidayat,
                'category_id' => $catIds['seo'],
                'read_minutes' => 11,
                'published_at' => $this->date('2026-08-04'),
                'show_in_latest' => false,
                'sort_order' => 3,
            ],
            [
                'title' => 'Keyword research reimagined: mapping topics instead of terms',
                'slug' => 'keyword-research-reimagined-topics',
                'excerpt' => 'Stop chasing individual keywords. Build topic clusters that capture entire search — and AI answer — journeys.',
                'body' => $this->body('Stop chasing individual keywords. Build topic clusters that capture entire search — and AI answer — journeys.'),
                'tag_label' => 'Keyword Research',
                'author_name' => $hidayat,
                'category_id' => $catIds['seo'],
                'read_minutes' => 11,
                'published_at' => $this->date('2026-07-18'),
                'show_in_latest' => false,
                'sort_order' => 4,
            ],

            // Web Development
            [
                'title' => 'WordPress vs. headless: choosing an SEO-proof CMS for growth',
                'slug' => 'wordpress-vs-headless-seo-cms',
                'excerpt' => 'Headless isn\'t automatically better. Here\'s the decision framework we walk clients through before migrating.',
                'body' => $this->body('Headless isn\'t automatically better. Here\'s the decision framework we walk clients through before migrating.'),
                'tag_label' => 'WordPress',
                'author_name' => $fahad,
                'category_id' => $catIds['web-development'],
                'read_minutes' => 12,
                'published_at' => $this->date('2026-07-29'),
                'show_in_latest' => false,
                'sort_order' => 1,
            ],
            [
                'title' => 'Shopify site speed: cutting load time without losing your theme',
                'slug' => 'shopify-site-speed',
                'excerpt' => 'Image pipelines, app bloat, and render-blocking scripts — where Shopify stores actually lose speed, and how to fix it.',
                'body' => $this->body('Image pipelines, app bloat, and render-blocking scripts — where Shopify stores actually lose speed, and how to fix it.'),
                'tag_label' => 'Shopify',
                'author_name' => $fahad,
                'category_id' => $catIds['web-development'],
                'read_minutes' => 9,
                'published_at' => $this->date('2026-07-24'),
                'show_in_latest' => false,
                'sort_order' => 2,
            ],
            [
                'title' => 'Conversion-ready UX: designing pages that rank and convert',
                'slug' => 'conversion-ready-ux',
                'excerpt' => 'SEO-friendly and conversion-friendly aren\'t opposing goals. Here\'s how we design pages that do both.',
                'body' => $this->body('SEO-friendly and conversion-friendly aren\'t opposing goals. Here\'s how we design pages that do both.'),
                'tag_label' => 'UX & Conversion',
                'author_name' => $fahad,
                'category_id' => $catIds['web-development'],
                'read_minutes' => 8,
                'published_at' => $this->date('2026-07-15'),
                'show_in_latest' => false,
                'sort_order' => 4,
            ],

            // AEO & GEO
            [
                'title' => 'GEO vs SEO: how to get cited by ChatGPT, Perplexity, and Gemini',
                'slug' => 'geo-vs-seo-perplexity-gemini',
                'excerpt' => 'Generative Engine Optimization is the newest layer — making sure LLMs recommend and cite your brand.',
                'body' => $this->body('Generative Engine Optimization is the newest layer — making sure LLMs recommend and cite your brand.'),
                'tag_label' => 'Generative Engine Optimization',
                'author_name' => $hidayat,
                'category_id' => $catIds['aeo-geo'],
                'read_minutes' => 10,
                'published_at' => $this->date('2026-07-20'),
                'show_in_latest' => false,
                'sort_order' => 2,
            ],
            [
                'title' => 'Structuring content so AI Overviews quote you first',
                'slug' => 'structuring-content-ai-overviews',
                'excerpt' => 'The formatting and source-signal patterns we\'re seeing correlate with AI Overview citations right now.',
                'body' => $this->body('The formatting and source-signal patterns we\'re seeing correlate with AI Overview citations right now.'),
                'tag_label' => 'AI Overviews',
                'author_name' => $hidayat,
                'category_id' => $catIds['aeo-geo'],
                'read_minutes' => 7,
                'published_at' => $this->date('2026-07-12'),
                'show_in_latest' => false,
                'sort_order' => 3,
            ],
            [
                'title' => 'Tracking LLM visibility: how we measure brand mentions across AI platforms',
                'slug' => 'tracking-llm-visibility',
                'excerpt' => 'Rankings still matter, but "does ChatGPT mention us" is now a metric leadership asks about too.',
                'body' => $this->body('Rankings still matter, but "does ChatGPT mention us" is now a metric leadership asks about too.'),
                'tag_label' => 'LLM Visibility',
                'author_name' => $hidayat,
                'category_id' => $catIds['aeo-geo'],
                'read_minutes' => 9,
                'published_at' => $this->date('2026-07-05'),
                'show_in_latest' => false,
                'sort_order' => 4,
            ],
        ];
    }
}
