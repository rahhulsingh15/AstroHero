<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('astrologer_faqs', function (Blueprint $table) {
            $table->id();
            $table->string('main_heading')->default('How Can Talking to an Astrologer Help You?');
            $table->text('question');
            $table->longText('answer');
            $table->integer('sort_order')->default(0)->index();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('astrologer_faqs');
    }
};