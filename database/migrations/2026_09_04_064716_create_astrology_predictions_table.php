<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('astrology_predictions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();        // aries, taurus, etc.
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->integer('sort_order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('astrology_predictions');
    }
};