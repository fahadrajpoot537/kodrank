<?php

namespace Database\Seeders;

use App\Models\CmsSection;
use Illuminate\Database\Seeder;

/**
 * Updates only the footer social links.
 * Does not touch the rest of the footer or any other homepage section.
 */
class FooterSocialLinksSeeder extends Seeder
{
    public function run(): void
    {
        $footer = CmsSection::query()->where('key', 'footer')->first();
        if (! $footer) {
            $this->command?->warn('Footer section is missing. Social links were not updated.');

            return;
        }

        $data = is_array($footer->data) ? $footer->data : [];
        $data['social'] = [
            ['label' => 'facebook', 'url' => 'https://www.facebook.com/share/1C31fz3agJ/'],
            ['label' => 'youtube', 'url' => 'https://www.youtube.com/@kodrank_official'],
            ['label' => 'instagram', 'url' => 'https://www.instagram.com/kodrank_official'],
            ['label' => 'linkedin', 'url' => 'https://www.linkedin.com/company/kodrank/'],
        ];

        $footer->update(['data' => $data]);

        $this->command?->info('Footer social links updated.');
    }
}
