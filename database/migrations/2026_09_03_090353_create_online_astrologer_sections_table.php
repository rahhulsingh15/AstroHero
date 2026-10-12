<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('online_astrologer_sections', function (Blueprint $table) {
            $table->id();
            $table->text('sign_name')->nullable();    // Comma separated: Aries, Taurus, Gemini...
            $table->text('badge_class')->nullable();  // Comma separated: z-aries, z-taurus...
            $table->text('image_alt')->nullable();    // Comma separated: aries_alt, taurus_alt...
            $table->text('images')->nullable();       // Comma separated image paths
            $table->string('title')->nullable();      // Default Horoscope Title
            $table->text('description')->nullable();  // Default Horoscope Description
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('online_astrologer_sections');
    }
};