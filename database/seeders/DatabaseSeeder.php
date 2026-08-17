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
        $this->call(WebsiteRedesignServiceSeeder::class);
        $this->call(CmsDevelopmentServiceSeeder::class);
        $this->call(AboutUsSeeder::class);
        $this->call(BlogSeeder::class);
    }
}
