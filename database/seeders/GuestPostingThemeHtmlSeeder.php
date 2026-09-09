<?php

namespace Database\Seeders;

use App\Support\ThemeHtmlNichePageImporter;
use Illuminate\Database\Seeder;

/**
 * Guest Posting Services — imports theme HTML into /guest-posting-services.
 * Skips hero text: "Guest Posting Services"
 *
 * Run: php artisan db:seed --class=GuestPostingThemeHtmlSeeder
 */
class GuestPostingThemeHtmlSeeder extends Seeder
{
    public function run(): void
    {
        ThemeHtmlNichePageImporter::import([
            'slug' => 'guest-posting-services',
            'name' => 'Guest Posting Services',
            'htmlPath' => public_path('theme/newone/Guest-posting-services/kodrank-guest-posting-services.html'),
            'mediaFrom' => public_path('theme/newone/Guest-posting-services'),
            'mediaTo' => 'media/services/guest-posting',
            'cssRel' => 'css/theme-guest-posting.css',
            'extraCssRel' => 'css/theme-guest-posting-page.css',
            'scope' => 'gp-theme-page',
            'bodyClass' => 'page-gpseo',
            'sort' => 40,
            'hideFromNav' => true,
            'clearEyebrow' => true,
            'excludeHeroTexts' => ['Guest Posting Services'],
            'ctaText' => 'Get My Free Guest Posting Plan',
            'heroImageFilename' => 'guest-posting-hero.jpg',
            'keywords' => 'guest posting services, guest posts, link building, KodRank',
        ], fn ($msg) => str_starts_with($msg, 'ERROR:')
            ? $this->command?->error(substr($msg, 7))
            : $this->command?->info($msg));
    }
}
