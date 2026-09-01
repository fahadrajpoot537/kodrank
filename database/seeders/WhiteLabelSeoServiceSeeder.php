<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class WhiteLabelSeoServiceSeeder extends Seeder
{
    public function run(): void
    {
        $parent = ServicePage::query()->where('slug', 'digital-marketing-services')->first();

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'white-label-seo-services'],
            [
                'parent_id' => $parent?->id,
                'name' => 'White Label SEO Services',
                'is_active' => true,
                'sort_order' => 11,
                'seo' => [
                    'theme' => 'ecommerce-seo',
                    'hide_from_nav' => true,
                    'seo_title' => 'White Label SEO Services | Scale Your Agency Under Your Brand | KodRank',
                    'seo_description' => 'White label SEO for agencies and consultants — fully branded deliverables, dedicated account managers, and reliable delivery under your logo. Partner with KodRank.',
                    'og_title' => 'White Label SEO Services | KodRank',
                    'og_description' => 'Ship SEO under your brand with white-labeled reports, Slack support, and senior strategists behind the scenes.',
                    'og_image' => 'media/services/digital-marketing/digital-marketing-services-hero.webp',
                    'keywords' => 'white label SEO services, agency SEO partner, reseller SEO, KodRank',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();

        $sections = [
            ['hero', 'Hero', [
                'eyebrow' => 'White Label SEO Services',
                'title_html' => 'White Label SEO<br>Your clients think it\'s you.<br><span class="hl">We deliver behind the scenes.</span>',
                'lede' => 'For agencies, freelancers, and consultancies who want to sell SEO without hiring a full in-house team. Branded reports, reliable delivery, and senior strategists on your timeline.',
                'cta_text' => 'Become a partner',
                'cta_url' => '#contact',
                'trust' => [
                    ['value' => '100%', 'label' => 'White-labeled deliverables'],
                    ['value' => '1:1', 'label' => 'Dedicated partner manager'],
                    ['value' => 'Scale', 'label' => 'Up or down monthly'],
                ],
            ]],
            ['intro', 'Introduction', [
                'eyebrow' => 'Introduction',
                'title' => 'White Label SEO Services That Protect Your Brand and Your Margins',
                'kicker' => 'Partner-ready SEO — you keep the relationship, we do the work.',
                'paragraphs_html' => [
                    ['html' => 'Your clients expect SEO results under your agency name. We operate as your backend team — audits, content, links, and reporting delivered with your branding and your voice.'],
                    ['html' => 'No subcontractor roulette. One dedicated partner manager, shared Slack, and deliverables you can forward without rewriting.'],
                ],
                'card_value' => '92%',
                'card_label' => 'Partner retention rate',
                'card_rows' => [
                    'Fully white-labeled PDF & slide decks',
                    'Shared Slack + weekly syncs',
                    'Scale capacity without new hires',
                ],
            ]],
            ['pain', 'Sound familiar?', [
                'eyebrow' => 'Sound familiar?',
                'title_html' => 'Why agencies struggle to scale SEO',
                'lede' => 'If you\'ve tried outsourcing before, these will feel familiar.',
                'cards' => [
                    ['title' => 'Freelancers who disappear', 'body' => 'Inconsistent quality and missed deadlines erode client trust — and your reputation.'],
                    ['title' => 'Reports you have to rewrite', 'body' => 'Generic exports that don\'t match your brand force hours of cleanup before clients see them.'],
                    ['title' => 'No one owns the outcome', 'body' => 'When rankings stall, you\'re stuck mediating between the client and a faceless vendor.'],
                    ['title' => 'Hiring is slow and expensive', 'body' => 'Building an in-house SEO bench takes months — while clients expect results now.'],
                ],
            ]],
            ['services', 'What\'s included', [
                'eyebrow' => 'What\'s included',
                'title_html' => 'Everything your agency needs to resell SEO',
                'lede' => 'Pick the modules you need — technical, content, links, or full retainers.',
                'cards' => [
                    ['title' => 'White-Labeled Audits & Roadmaps', 'body' => 'Technical and content audits formatted with your logo, colors, and executive summary.'],
                    ['title' => 'Monthly SEO Delivery', 'body' => 'On-page, technical fixes, content, and link building executed to your client\'s roadmap.'],
                    ['title' => 'Branded Reporting', 'body' => 'Rankings, traffic, and actions taken — ready to send without editing.'],
                    ['title' => 'Dedicated Partner Manager', 'body' => 'One point of contact who knows your clients, SLAs, and communication style.'],
                    ['title' => 'Slack & Async Updates', 'body' => 'Shared channels for fast questions, approvals, and status — no ticket black holes.'],
                    ['title' => 'Flexible Capacity', 'body' => 'Add clients or pull back month to month without long-term lock-ins.'],
                ],
            ]],
            ['process', 'How we work', [
                'eyebrow' => 'How we work',
                'title_html' => 'Onboarding to delivery in days, not months',
                'lede' => 'A partner workflow designed for agencies that move fast.',
                'steps' => [
                    ['num' => '01', 'title' => 'Partner onboarding', 'body' => 'Brand assets, report templates, communication rules, and client intake process.'],
                    ['num' => '02', 'title' => 'Client kickoff', 'body' => 'We audit under your brand and deliver the roadmap you present to the client.'],
                    ['num' => '03', 'title' => 'Monthly delivery', 'body' => 'Execution, QA, and white-labeled reporting on your schedule.'],
                    ['num' => '04', 'title' => 'Sync & refine', 'body' => 'Weekly or bi-weekly partner calls to adjust priorities and capacity.'],
                    ['num' => '05', 'title' => 'Grow together', 'body' => 'Add seats, services, or clients as your agency scales.'],
                ],
            ]],
            ['stats', 'Why KodRank', [
                'eyebrow' => 'Why KodRank',
                'title_html' => 'A partner team agencies actually keep',
                'lede' => 'Built for agencies who\'ve been burned by outsourcing before.',
                'points' => [
                    ['title' => 'Your brand, always', 'body' => 'Clients never see KodRank unless you want them to. Deliverables ship under your identity.'],
                    ['title' => 'Senior execution', 'body' => 'Strategists and developers who\'ve run retainers for years — not offshore task workers.'],
                    ['title' => 'Transparent partner pricing', 'body' => 'Wholesale rates that protect your margin with clear scope per client.'],
                ],
                'items' => [
                    ['value' => '92%', 'label' => 'Partner retention'],
                    ['value' => '48hr', 'label' => 'Typical audit turnaround'],
                    ['value' => '40+', 'label' => 'Agency partners'],
                    ['value' => '6yr', 'label' => 'Avg. strategist tenure'],
                ],
            ]],
            ['platforms', 'Partner types', [
                'eyebrow' => 'Who we partner with',
                'title' => 'Built for agency workflows',
                'lede' => 'From solo consultants to multi-service shops.',
                'items' => ['Digital agencies', 'Web studios', 'Freelance consultants', 'Marketing collectives', 'B2B SaaS agencies'],
            ]],
            ['testimonials', 'In their words', [
                'eyebrow' => 'In their words',
                'title' => 'Partners who scale without hiring',
                'items' => [
                    ['quote' => 'Two years white-labeling with KodRank. My clients think I have a 20-person SEO team. Delivery is on time and the reports need zero cleanup.', 'initials' => 'AP', 'name' => 'Agency Partner', 'role' => 'Digital agency owner'],
                    ['quote' => 'The Slack channel and dedicated manager changed everything. I finally have a backend I trust with enterprise clients.', 'initials' => 'RC', 'name' => 'Rachel C.', 'role' => 'Consultancy founder'],
                ],
            ]],
            ['faq', 'FAQ', [
                'eyebrow' => 'Questions',
                'title_html' => 'White label SEO, answered',
                'items' => [
                    ['q' => 'Will my clients know about KodRank?', 'a' => 'No — unless you choose to introduce us. All deliverables and reports are white-labeled under your agency brand.'],
                    ['q' => 'How is pricing structured?', 'a' => 'Wholesale monthly rates per client based on scope — audits, content volume, and link building tiers. We quote after a quick partner call.'],
                    ['q' => 'Can we start with one client?', 'a' => 'Yes. Many partners onboard a single account to test workflow, then scale once delivery rhythm is proven.'],
                ],
            ]],
            ['contact', 'Contact', [
                'eyebrow' => 'Contact',
                'title_html' => 'Apply to become a <span class="hl">SEO partner</span>',
                'lede' => 'Tell us about your agency, typical client size, and how many accounts you want to onboard.',
                'points' => ['Partner inquiry — not a client lead form.', 'We reply within 1 business day.'],
                'fields' => [
                    'name_label' => 'Your name',
                    'email_label' => 'Agency email',
                    'website_label' => 'Agency website',
                    'service_label' => 'Partner type',
                    'message_label' => 'Tell us about your agency',
                    'message_placeholder' => 'Client count, services you sell, and what you need from a white label partner…',
                ],
                'service_options' => ['Digital agency', 'Web studio', 'Freelancer', 'Other'],
                'default_service' => 'Digital agency',
                'submit_text' => 'Start partner conversation',
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
