<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Love % cards ab Page Content ke Jodit mein hain, report ka result text LoveCalculaterController::BANDS se aata hai.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('love_calculator_bands');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('love_calculator_bands', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('min_percent')->unique();
            $table->string('title');
            $table->text('report_text')->nullable();
            $table->timestamps();
        });
    }
};
