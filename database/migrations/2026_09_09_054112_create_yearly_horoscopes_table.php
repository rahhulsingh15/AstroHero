<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('yearly_horoscopes', function (Blueprint $table) {
            $table->id();
            $table->string('zodiac_sign', 50);          // e.g., Aries, Taurus
            $table->string('title', 150);                // e.g., Aries Yearly Horoscope
            $table->string('year', 10)->default('2026'); // e.g., 2026
            $table->string('image')->nullable();         // e.g., images/hioroscope1.png
            $table->text('description');                 // Prediction text
            $table->integer('sort_order')->default(1);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('yearly_horoscopes');
    }
};