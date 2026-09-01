<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@kodrank.com'],
            [
                'name' => 'Admin',
                'password' => 'password',
            ]
        );

        $this->call(HomepageSeeder::class);
        $this->call(DigitalMarketingServiceSeeder::class);
        $this->call(WebDesignDevelopmentServiceSeeder::class);
        $this->call(ServiceNavSeeder::class);
        $this->call(OnPageSeoServiceSeeder::class);
        $this->call(OffPageSeoServiceSeeder::class);
        $this->call(GeoServiceSeeder::class);
        $this->call(TechnicalSeoServiceSeeder::class);
        $this->call(AeoServiceSeeder::class);
        $this->call(WordPressDevelopmentServiceSeeder::class);
        $this->call(AiChatbotDevelopmentServiceSeeder::class);
        $this->call(ShopifyDevelopmentServiceSeeder::class);
        $this->call(WebsiteRedesignServiceSeeder::class);
        $this->call(CmsDevelopmentServiceSeeder::class);
        $this->call(SaasSeoServiceSeeder::class);
        $this->call(MonthlySeoServiceSeeder::class);
        $this->call(B2bSeoServiceSeeder::class);
        $this->call(EcommerceSeoServiceSeeder::class);
        $this->call(WordPressSeoServiceSeeder::class);
        $this->call(ShopifySeoServiceSeeder::class);
        $this->call(WhiteLabelSeoServiceSeeder::class);
        $this->call(AboutUsSeeder::class);
        $this->call(NewonePagesSeeder::class);
        // Full theme HTML for ALL service pages (overwrites structured bodies — no missing content)
        $this->call(ThemeHtmlServicesSeeder::class);
        $this->call(BlogSeeder::class);
    }
}
