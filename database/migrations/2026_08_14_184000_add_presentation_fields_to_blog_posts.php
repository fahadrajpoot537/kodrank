<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->string('post_tags')->nullable()->after('tag_label');
            $table->string('author_role')->nullable()->after('author_name');
            $table->text('author_bio')->nullable()->after('author_role');
            $table->string('author_linkedin')->nullable()->after('author_bio');
            $table->string('inline_cta_title')->nullable()->after('post_tags');
            $table->text('inline_cta_body')->nullable()->after('inline_cta_title');
            $table->string('inline_cta_text')->nullable()->after('inline_cta_body');
            $table->string('inline_cta_url')->nullable()->after('inline_cta_text');
        });
    }

    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn([
                'post_tags',
                'author_role',
                'author_bio',
                'author_linkedin',
                'inline_cta_title',
                'inline_cta_body',
                'inline_cta_text',
                'inline_cta_url',
            ]);
        });
    }
};
