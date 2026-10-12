<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('free_kundli_sections', function (Blueprint $table) {
            $table->id();
            // Left Box
            $table->string('main_heading')->default('Kundli');
            $table->text('description')->nullable();
            $table->string('main_image')->nullable();

            // Right Box - Multiple items in single row
            $table->text('titles')->nullable();       // "KUNDLI, MATCHING, ASCENDANT, ..."
            $table->longText('images')->nullable();    // JSON array ya comma-separated paths

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('free_kundli_sections');
    }
};