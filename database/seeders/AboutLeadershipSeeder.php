<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

/**
 * Adds Hidayatul Haq to the About page leadership grid.
 * Does not delete or rewrite the rest of the About page.
 */
class AboutLeadershipSeeder extends Seeder
{
    public function run(): void
    {
        $page = ServicePage::query()->where('slug', 'about-us')->first();
        $section = $page
            ? ServicePageSection::query()
                ->where('service_page_id', $page->id)
                ->where('key', 'leadership')
                ->first()
            : null;

        if (! $section) {
            $this->command?->warn('About leadership section is missing. Nothing was updated.');

            return;
        }

        $data = is_array($section->data) ? $section->data : [];
        $members = is_array($data['members'] ?? null) ? $data['members'] : [];
        $hidayat = [
            'name' => 'Hidayatul Haq',
            'role' => 'Founder · SEO Strategist',
            'linkedin' => 'https://www.linkedin.com/in/hidayatul-haq',
            'bio' => 'Founder of KodRank. Leads the search work on every project — technical audits, on-page optimization, and organic growth — with no account layer in between.',
            'tags' => ['SEO Strategy', 'Technical SEO'],
            'image' => 'media/about/hidayatul-haq.jpg',
            'image_position' => 'center 18%',
        ];

        $found = false;
        foreach ($members as $i => $member) {
            if (stripos((string) ($member['name'] ?? ''), 'Hidayat') === false) {
                continue;
            }
            $members[$i] = array_merge($member, $hidayat);
            $found = true;
            $current = $members[$i];
            unset($members[$i]);
            array_unshift($members, $current);
            $members = array_values($members);
            break;
        }

        if (! $found) {
            array_unshift($members, $hidayat);
        }

        $data['members'] = $members;
        if (($data['title'] ?? '') === 'Two specialists. No layers between.') {
            $data['title'] = 'The specialists. No layers between.';
        }
        if (($data['title_html'] ?? '') === 'Two specialists.<br>No layers between.') {
            $data['title_html'] = 'The specialists.<br>No layers between.';
        }

        $section->update(['data' => $data]);

        $this->command?->info('About leadership now includes Hidayatul Haq.');
    }
}
