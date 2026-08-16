<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->longText('content_html')->nullable()->after('body');
            $table->json('table_of_contents')->nullable()->after('content_html');
            $table->string('featured_image_alt')->nullable()->after('featured_image');
            $table->string('seo_title')->nullable()->after('featured_image_alt');
            $table->text('seo_description')->nullable()->after('seo_title');
            $table->string('seo_keywords')->nullable()->after('seo_description');
            $table->string('canonical_url')->nullable()->after('seo_keywords');
            $table->string('robots')->default('index, follow')->after('canonical_url');
            $table->string('og_title')->nullable()->after('robots');
            $table->text('og_description')->nullable()->after('og_title');
            $table->string('og_image')->nullable()->after('og_description');
            $table->string('og_image_alt')->nullable()->after('og_image');
        });
    }

    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn([
                'content_html',
                'table_of_contents',
                'featured_image_alt',
                'seo_title',
                'seo_description',
                'seo_keywords',
                'canonical_url',
                'robots',
                'og_title',
                'og_description',
                'og_image',
                'og_image_alt',
            ]);
        });
    }
};
