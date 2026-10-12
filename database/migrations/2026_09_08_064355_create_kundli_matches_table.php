<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kundli_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // Agar user logged in ho
            
            // Boy details
            $table->string('boy_name');
            $table->date('boy_dob');
            $table->time('boy_tob');
            $table->string('boy_place');
            $table->string('boy_rashi')->nullable();
            $table->string('boy_nakshatra')->nullable();

            // Girl details
            $table->string('girl_name');
            $table->date('girl_dob');
            $table->time('girl_tob');
            $table->string('girl_place');
            $table->string('girl_rashi')->nullable();
            $table->string('girl_nakshatra')->nullable();

            // Result
            $table->decimal('total_score', 4, 1); // e.g. 26.0 / 36
            $table->string('verdict_status');     // e.g. Good Match, Excellent
            $table->json('score_breakdown')->nullable(); // Poora 8 Kootas ka breakdown JSON me

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kundli_matches');
    }
};