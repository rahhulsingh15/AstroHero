<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kundli_blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('link')->nullable()->default('#');
            $table->string('image')->nullable();
            $table->string('author_name')->default('Team Astroyogi');
            $table->string('author_image')->nullable();
            $table->date('published_date')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kundli_blogs');
    }
};