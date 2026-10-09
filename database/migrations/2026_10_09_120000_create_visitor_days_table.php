<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitor_days', function (Blueprint $table) {
            $table->id();
            $table->char('visitor_key', 36);
            $table->date('visited_on');
            $table->timestamps();

            $table->unique(['visitor_key', 'visited_on']);
            $table->index('visited_on');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_days');
    }
};
