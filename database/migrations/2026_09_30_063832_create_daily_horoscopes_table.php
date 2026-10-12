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
    Schema::create('daily_horoscopes', function (Blueprint $table) {
        $table->id();
        $table->string('sign_name');      // Aries, Taurus, etc.
        $table->string('period');         // Today, Tomorrow, Week, Month
        $table->text('reading');          // Prediction text
        $table->string('mood')->nullable();
        $table->string('lucky_number')->nullable();
        $table->string('lucky_color')->nullable();
        $table->integer('love_percent')->default(70);
        $table->string('love_status')->default('Good');
        $table->integer('career_percent')->default(70);
        $table->string('career_status')->default('Good');
        $table->integer('health_percent')->default(70);
        $table->string('health_status')->default('Good');
        $table->integer('money_percent')->default(70);
        $table->string('money_status')->default('Good');
        $table->date('horoscope_date');   // Roz ka record track rakhne ke liye
        $table->timestamps();

        // Unique constraint taaki ek sign ka ek din me duplicate na bane
        $table->unique(['sign_name', 'period', 'horoscope_date']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_horoscopes');
    }
};
