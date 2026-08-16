<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->json('seo')->nullable();
            $table->timestamps();
        });

        Schema::create('service_page_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_page_id')->constrained()->cascadeOnDelete();
            $table->string('key');
            $table->string('label');
            $table->unsignedInteger('sort_order')->default(0);
            $table->json('data');
            $table->timestamps();

            $table->unique(['service_page_id', 'key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_page_sections');
        Schema::dropIfExists('service_pages');
    }
};
