<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Support\ContentTemplates;
use Illuminate\Database\Seeder;

class ServiceNavSeeder extends Seeder
{
    /**
     * Restore original Services mega menu: main services + sub services.
     */
    public function run(): void
    {
        // Migrate old nav slug → canonical URL slug
        $legacy = ServicePage::query()->where('slug', 'web-development-services')->first();
        $canonical = ServicePage::query()->where('slug', 'web-design-and-development-services')->first();
        if ($legacy && $canonical && $legacy->id !== $canonical->id) {
            ServicePage::query()->where('parent_id', $legacy->id)->update(['parent_id' => $canonical->id]);
            $legacy->delete();
            ServicePage::forgetCache('web-development-services');
        } elseif ($legacy && ! $canonical) {
            $legacy->update([
                'slug' => 'web-design-and-development-services',
                'name' => 'Web Design and Development Services',
            ]);
            ServicePage::forgetCache('web-development-services');
        }

        $tree = [
            [
                'slug' => 'digital-marketing-services',
                'name' => 'Digital Marketing Services',
                'sort_order' => 0,
                'seed_sections' => false, // already seeded with full DM content
                'children' => [
                    ['slug' => 'on-page-seo-services', 'name' => 'On-Page SEO Services', 'sort_order' => 0, 'seed_sections' => false],
                    ['slug' => 'off-page-seo-services', 'name' => 'Off-Page SEO Services', 'sort_order' => 1, 'seed_sections' => false],
                    ['slug' => 'technical-seo-services', 'name' => 'Technical SEO Services', 'sort_order' => 2, 'seed_sections' => false],
                    ['slug' => 'geo-services', 'name' => 'GEO Services', 'sort_order' => 3, 'seed_sections' => false],
                    ['slug' => 'aeo-services', 'name' => 'AEO Services', 'sort_order' => 4, 'seed_sections' => false],
                ],
            ],
            [
                'slug' => 'web-design-and-development-services',
                'name' => 'Web Design and Development Services',
                'sort_order' => 1,
                'seed_sections' => false, // full content from WebDesignDevelopmentServiceSeeder
                'children' => [
                    ['slug' => 'wordpress-development-services', 'name' => 'WordPress Development Services', 'sort_order' => 0, 'seed_sections' => false],
                    ['slug' => 'shopify-development-services', 'name' => 'Shopify Development Services', 'sort_order' => 1],
                    ['slug' => 'ai-chatbot-development-services', 'name' => 'AI Chatbot Development Services', 'sort_order' => 2, 'seed_sections' => false],
                    ['slug' => 'website-redesign-services', 'name' => 'Website Redesign Services', 'sort_order' => 3, 'seed_sections' => false],
                    ['slug' => 'cms-development-services', 'name' => 'CMS Development Services', 'sort_order' => 4, 'seed_sections' => false],
                ],
            ],
        ];

        foreach ($tree as $mainData) {
            $main = $this->upsertPage($mainData, null, (bool) ($mainData['seed_sections'] ?? true));

            foreach ($mainData['children'] as $childData) {
                $this->upsertPage($childData, $main->id, (bool) ($childData['seed_sections'] ?? true));
            }
        }

        ServicePage::forgetNavCache();
    }

    private function upsertPage(array $data, ?int $parentId, bool $seedSections): ServicePage
    {
        $existing = ServicePage::query()->where('slug', $data['slug'])->first();

        // Preserve Digital Marketing full SEO/content; only fix hierarchy fields
        if ($existing && $data['slug'] === 'digital-marketing-services') {
            $existing->update([
                'parent_id' => null,
                'name' => 'Digital Marketing Services',
                'is_active' => true,
                'sort_order' => $data['sort_order'] ?? 0,
            ]);
            ServicePage::forgetCache($existing->slug);

            return $existing->fresh();
        }

        if ($existing && $data['slug'] === 'web-design-and-development-services') {
            $existing->update([
                'parent_id' => null,
                'name' => 'Web Design and Development Services',
                'is_active' => true,
                'sort_order' => $data['sort_order'] ?? 0,
            ]);
            ServicePage::forgetCache($existing->slug);

            return $existing->fresh();
        }

        $payload = [
            'parent_id' => $parentId,
            'name' => $data['name'],
            'is_active' => true,
            'sort_order' => $data['sort_order'] ?? 0,
        ];

        if (! $existing) {
            $payload['seo'] = [
                'seo_title' => $data['name'].' | KodRank',
                'seo_description' => $data['name'].' by KodRank.',
                'og_title' => $data['name'].' | KodRank',
                'og_description' => $data['name'].' by KodRank.',
                'og_image' => 'media/services/digital-marketing/hero.png',
                'keywords' => '',
                'robots' => 'index, follow',
                'canonical_url' => '',
            ];
        }

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => $data['slug']],
            $payload
        );

        if ($seedSections && $page->sections()->count() === 0) {
            foreach (ContentTemplates::servicePageSections() as $section) {
                $sectionData = $section['data'];
                if (isset($sectionData['title'])) {
                    $sectionData['title'] = $data['name'];
                }
                if (($section['key'] ?? '') === 'hero') {
                    $sectionData['eyebrow'] = $parentId ? 'Sub service' : 'Main service';
                    $sectionData['title'] = $data['name'];
                }
                $page->sections()->create([
                    'key' => $section['key'],
                    'label' => $section['label'],
                    'sort_order' => $section['sort_order'],
                    'data' => $sectionData,
                ]);
            }
        }

        ServicePage::forgetCache($page->slug);

        return $page->fresh();
    }
}
