<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_service_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('page_type', 32); // on_page | off_page
            $table->string('service_name')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('website')->nullable();
            $table->text('message');
            $table->string('ip', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('status', 32)->default('new'); // new | read | replied
            $table->timestamps();

            $table->index(['page_type', 'status']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_service_inquiries');
    }
};
