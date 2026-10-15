<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dasha_calculator_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('description')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dasha_calculator_contents');
    }
};
