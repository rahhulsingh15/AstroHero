<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Home page: "Browse by Category" cards
        Schema::create('astrologer_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');                      // Love & Relationships
            $table->string('astro_count')->nullable();   // 4,280+ astrologers
            $table->string('link')->nullable();
            $table->string('icon')->default('love-relationships'); // config/home_icons.php ki key
            $table->string('color')->default('love');    // icon badge ka rang
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });

        // Home page: "Our Services" slider cards
        Schema::create('home_services', function (Blueprint $table) {
            $table->id();
            $table->string('title');                     // Free Kundli
            $table->string('description')->nullable();   // Detailed birth chart in 60 sec
            $table->string('link')->nullable();
            $table->string('icon')->default('free-kundli'); // config/home_icons.php ki key
            $table->tinyInteger('slider_row')->default(1);  // 1 = upar wali row, 2 = neeche wali row
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });

        // Jo cards pehle home page par static the, wahi shuruaati data
        $now = now();

        $categories = [
            ['Love & Relationships', '4,280+ astrologers', 'love-relationships', 'love'],
            ['Marriage & Kundli', '6,120+ astrologers', 'marriage-kundli', 'marriage'],
            ['Career Guidance', '5,840+ astrologers', 'career-guidance', 'career'],
            ['Women Astrologers', '9,210+ astrologers', 'women-astrologers', 'women'],
            ['Business & Money', '3,760+ astrologers', 'business-money', 'business'],
            ['Health & Family', '2,480+ astrologers', 'health-family', 'health'],
        ];

        foreach ($categories as $i => [$name, $count, $icon, $color]) {
            DB::table('astrologer_categories')->insert([
                'name' => $name, 'astro_count' => $count, 'link' => '#', 'icon' => $icon, 'color' => $color,
                'sort_order' => $i + 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now,
            ]);
        }

        $services = [
            ['Free Kundli', 'Detailed birth chart in 60 sec', 'free-kundli', 1],
            ['Daily Horoscope', 'For all 12 raashis', 'daily-horoscope', 1],
            ['Tarot Reading', '3-card, love, career, finance', 'tarot-reading', 1],
            ['Book a Pooja', 'Live pooja, verified pandits', 'book-a-pooja', 1],
            ['Numerology', 'Name & life-path numbers', 'numerology', 1],
            ['Vastu Consultation', 'For home, office, plot', 'vastu-consultation', 1],
            ['Kundali Matching', 'Guna milan score', 'kundali-matching', 1],
            ['Planet Transit', 'Live planetary positions', 'planet-transit', 2],
            ['Love Calculator', 'Compatibility score', 'love-calculator', 2],
            ['Panchang', 'Daily tithi & nakshatra', 'panchang', 2],
            ['Subh Muhurat', 'Auspicious timings', 'subh-muhurat', 2],
            ['Gemstone Suggestion', 'Lucky gems for your rashi', 'gemstone-suggestion', 2],
            ['Palmistry Reading', 'Hand line analysis', 'palmistry-reading', 2],
            ['Face Reading', 'Personality & future traits', 'face-reading', 2],
        ];

        foreach ($services as $i => [$title, $description, $icon, $row]) {
            DB::table('home_services')->insert([
                'title' => $title, 'description' => $description, 'link' => '#', 'icon' => $icon, 'slider_row' => $row,
                'sort_order' => $i + 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('home_services');
        Schema::dropIfExists('astrologer_categories');
    }
};
