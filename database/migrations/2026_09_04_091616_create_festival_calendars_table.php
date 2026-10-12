<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('festival_calendars', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();            // Ninth Day of Navratri
            $table->string('festival_day', 10);          // 1, 2, 15
            $table->string('festival_month', 15);        // Oct, Nov
            $table->text('short_desc')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('link')->default('#');
            $table->integer('sort_order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('festival_calendars');
    }
};