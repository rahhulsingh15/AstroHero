<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            
            // Left Banner Image & Alt
            $table->string('banner_image')->nullable();
            $table->string('banner_alt')->nullable();

            // Right Hero Image & Alt
            $table->string('right_image')->nullable();
            $table->string('right_image_alt')->nullable();

            // Button 1 (Free Call)
            $table->string('btn1_icon')->nullable();  // e.g. fa-solid fa-phone
            $table->string('btn1_title')->nullable(); // e.g. Free Call
            $table->string('btn1_link')->nullable();  // e.g. #

            // Button 2 (Free Chat)
            $table->string('btn2_icon')->nullable();  // e.g. fa-brands fa-twitch
            $table->string('btn2_title')->nullable(); // e.g. Free Chat
            $table->string('btn2_link')->nullable();  // e.g. chat-astrologer.html

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};