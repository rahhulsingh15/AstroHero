<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matching_cta_sections', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->string('btn1_text')->default('Talk to Astrologer');
            $table->string('btn1_link')->default('chat-astrologer');
            $table->string('btn2_text')->default('Chat with Astrologer');
            $table->string('btn2_link')->default('#');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matching_cta_sections');
    }
};