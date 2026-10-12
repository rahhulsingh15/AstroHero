<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expert_astrologers', function (Blueprint $table) {
            $table->id();
            $table->string('section_title')->nullable(); // Get Your First Call or Chat FREE with Our Expert Astrologers..
            $table->string('name')->index();
            $table->string('expertise')->nullable();     // Love, Marriage, Career
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('call_title')->default('Free Call');
            $table->string('call_link')->default('#');
            $table->string('chat_title')->default('Free Chat');
            $table->string('chat_link')->default('chat-astrologer.html');
            $table->integer('sort_order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expert_astrologers');
    }
};