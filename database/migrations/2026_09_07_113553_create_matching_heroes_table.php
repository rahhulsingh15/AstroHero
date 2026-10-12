<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matching_heroes', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title')->default('Kundli Matching');
            $table->string('subtitle')->nullable()->default('Find your right one, through matchmaking');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matching_heroes');
    }
};