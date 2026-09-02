<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('country', 120)->nullable()->after('phone');
        });

        Schema::table('seo_service_inquiries', function (Blueprint $table) {
            $table->string('country', 120)->nullable()->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn('country');
        });

        Schema::table('seo_service_inquiries', function (Blueprint $table) {
            $table->dropColumn('country');
        });
    }
};
