<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Rising aur Dasha report page ki alag tables (ek hi row). Heading mein {name}, {sign} / {planet} chalega
    public function up(): void
    {
        Schema::create('rising_ascendant_report_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('description')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });

        Schema::create('dasha_report_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('description')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });

        // Abhi report page par jo content hai wahi shuru ka data, taaki page waisa hi dikhe
        DB::table('rising_ascendant_report_contents')->insert([
            'heading' => '{name}\'s Rising Sign Report',
            'description' => null,
            'main_content' => <<<'EOT'
<h3>What is a Rising Sign (Ascendant)?</h3>
<p>Your Rising Sign, also known as your Ascendant or Lagna, is the zodiac sign that was ascending on the
    eastern horizon at the exact moment and location of your birth. In Vedic astrology, the Ascendant is
    the most important element of your birth chart (Kundli). It acts as the mask you wear in public,
    your physical appearance, and the initial impression you make on others.</p>

<h4>Sun Sign vs. Rising Sign</h4>
<p>While your Sun Sign represents your core ego and internal motivations, your Rising Sign determines
    your external behavior and how you naturally interact with the world. Think of the Sun Sign as the
    driver of a car, and the Rising Sign as the car itself—it defines your physical body, style, and
    approach to life.</p>

<h4>Why is the Exact Birth Time Required?</h4>
<p>The Ascendant changes approximately every two hours. Therefore, even a small error in your birth time
    can result in calculating the wrong Rising Sign, entirely changing the accuracy of your horoscope.
    It's crucial to use your exact time and place of birth for precise astrological readings.</p>

<h4>The 12 Ascendants and Their Rulers</h4>
<ul>
    <li><strong>Aries:</strong> Ruled by Mars (Active, energetic)</li>
    <li><strong>Taurus:</strong> Ruled by Venus (Grounded, aesthetic)</li>
    <li><strong>Gemini:</strong> Ruled by Mercury (Communicative, curious)</li>
    <li><strong>Cancer:</strong> Ruled by Moon (Nurturing, emotional)</li>
    <li><strong>Leo:</strong> Ruled by Sun (Confident, charismatic)</li>
    <li><strong>Virgo:</strong> Ruled by Mercury (Analytical, precise)</li>
    <li><strong>Libra:</strong> Ruled by Venus (Charming, diplomatic)</li>
    <li><strong>Scorpio:</strong> Ruled by Mars/Pluto (Intense, secretive)</li>
    <li><strong>Sagittarius:</strong> Ruled by Jupiter (Optimistic, adventurous)</li>
    <li><strong>Capricorn:</strong> Ruled by Saturn (Ambitious, disciplined)</li>
    <li><strong>Aquarius:</strong> Ruled by Saturn/Uranus (Innovative, eccentric)</li>
    <li><strong>Pisces:</strong> Ruled by Jupiter/Neptune (Compassionate, mystical)</li>
</ul>
EOT,
            'faq_content' => <<<'EOT'
<div class="acord-container">
    <!-- Left Side: Title -->
    <div class="acord-left">
        <span class="acord-subtitle">FREQUENTLY ASKED</span>
        <h2 class="acord-title">Got doubts? <span class="highlight">Find</span> your answers<br>here.</h2>
    </div>

    <!-- Right Side: Accordion List -->
    <div class="acord-right">

        <div class="acord-item">
            <button class="acord-btn">
                <span>What is a Rising Sign (Ascendant)?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Your Rising Sign, also known as the Ascendant, is the exact zodiac sign that was rising on
                    the eastern horizon at the moment you were born. It represents your physical appearance,
                    first impressions, and your outer personality.</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn">
                <span>How is the Rising Sign different from my Sun Sign?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>While your Sun Sign reveals your inner core, ego, and basic personality traits, your Rising
                    Sign acts as a "mask" or filter. It dictates how the outside world perceives you when they
                    first meet you, and heavily influences your physical traits.</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn">
                <span>Why do you need my exact time of birth?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>The Ascendant changes approximately every two hours. Even a difference of just 5-10 minutes
                    can completely change your Rising Sign and the entire layout of the 12 houses in your
                    Kundli. Exact birth time ensures a 100% accurate chart.</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn">
                <span>Does my Rising Sign change as I grow older?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>No, your Rising Sign never changes. It is a permanent fixture of your birth chart based
                    entirely on the specific coordinates and time of your birth.</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn">
                <span>Which is more important in Vedic astrology, Sun or Rising sign?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>In Vedic astrology, the Ascendant (Lagna) and the Moon Sign are considered much more
                    significant than the Sun Sign for predicting daily life, personality, and major life events.
                </p>
            </div>
        </div>

    </div>
</div>
EOT,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dasha_report_contents')->insert([
            'heading' => '{name}\'s {planet} Mahadasha Report',
            'description' => null,
            'main_content' => <<<'EOT'
<h3>Mastering Your Destiny with Vimshottari Dasha</h3>
<p>Vimshottari Dasha is the most profoundly accurate predictive system in Vedic Astrology. Derived from the ancient Sanskrit words <em>Vimshati</em> (120) and <em>Dasha</em> (Period), it mathematically divides the maximum human lifespan of 120 years into distinct planetary cycles. The exact sequence and duration of these cycles are calculated purely based on the precise degree of the Moon in your birth chart (your Janma Nakshatra).</p>

<h4>The Deep Impact of a Mahadasha</h4>
<p>A Mahadasha is an overarching planetary phase that acts as the primary "operating system" for a specific period of your life. For instance, a Jupiter Mahadasha (lasting 16 years) will cast a golden glow of wisdom, expansion, and spiritual growth over your life, whereas a Saturn Mahadasha (lasting 19 years) will rigorously test your discipline, patience, and karmic debts.</p>

<p>However, the broad themes of the Mahadasha are fine-tuned by the <strong>Antardasha</strong> (sub-period) and <strong>Pratyantardasha</strong> (sub-sub-period). The true art of prediction lies in analyzing the relationship between the Mahadasha lord and the Antardasha lord. If they are natural friends placed well in your Kundli, the period brings spectacular success. If they are antagonistic, you are meant to navigate carefully and perform specific astrological remedies.</p>

<h4>The Complete 120-Year Planetary Cycle</h4>
<p>Below is the universal sequence of the Vimshottari Dasha system. Every human goes through this exact sequence, though everyone starts at a different point based on their birth Moon:</p>

<table class="data-table">
    <thead>
        <tr>
            <th>Ruling Planet</th>
            <th>Duration</th>
            <th>Core Themes &amp; Lifelong Impact</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>Sun (Surya)</td><td>6 Years</td><td>Authority, ego development, career peaks, soul-searching, and father figures.</td></tr>
        <tr><td>Moon (Chandra)</td><td>10 Years</td><td>Emotional growth, deep intuition, changes in residence, mother, and mental peace.</td></tr>
        <tr><td>Mars (Mangal)</td><td>7 Years</td><td>Courage, high energy, real estate gains, siblings, and overcoming enemies.</td></tr>
        <tr><td>Rahu (North Node)</td><td>18 Years</td><td>Intense worldly ambition, foreign travel, sudden wealth, illusions, and tech success.</td></tr>
        <tr><td>Jupiter (Guru)</td><td>16 Years</td><td>Wisdom, prosperity, divine blessings, marriage, childbirth, and higher learning.</td></tr>
        <tr><td>Saturn (Shani)</td><td>19 Years</td><td>Strict discipline, career foundations, karmic paybacks, delays, and structural success.</td></tr>
        <tr><td>Mercury (Budh)</td><td>17 Years</td><td>Intellectual leaps, business expansion, communication skills, writing, and networking.</td></tr>
        <tr><td>Ketu (South Node)</td><td>7 Years</td><td>Spiritual awakening, detachment from materialism, sudden losses, and mystical experiences.</td></tr>
        <tr><td>Venus (Shukra)</td><td>20 Years</td><td>Peak luxury, romantic partnerships, artistic expression, comforts, and material wealth.</td></tr>
    </tbody>
</table>
EOT,
            'faq_content' => <<<'EOT'
<div class="acord-container">
    <!-- Left Side: Title -->
    <div class="acord-left">
        <span class="acord-subtitle">FREQUENTLY ASKED</span>
        <h2 class="acord-title">Got doubts? <span class="highlight">Find</span> your answers<br>here.</h2>
    </div>

    <!-- Right Side: Accordion List -->
    <div class="acord-right">

        <div class="acord-item">
            <button class="acord-btn">
                <span>What is Vimshottari Dasha?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Vimshottari Dasha is a 120-year cycle of planetary periods used in Vedic Astrology. It predicts which planet's energy is currently influencing your life and helps time major life events accurately.</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn">
                <span>How is my starting Dasha determined?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Your starting Dasha is calculated based on your Janma Nakshatra (the constellation the Moon was in at your exact time of birth). The planetary ruler of that Nakshatra becomes your first Mahadasha.</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn">
                <span>What is the difference between Mahadasha and Antardasha?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>A Mahadasha is the major, overarching planetary period (lasting up to 20 years). An Antardasha is a shorter sub-period within that Mahadasha ruled by another planet, triggering specific events within the major theme.</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn">
                <span>Are Rahu and Ketu Dashas always bad?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Not at all! While Rahu and Ketu can bring sudden and unexpected changes, they can also bring immense wealth, spiritual growth, and worldly success depending on their placement in your chart.</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn">
                <span>How can I reduce the negative effects of a bad Dasha?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Astrology offers specific remedies such as chanting mantras, wearing authentic gemstones, donating to charity, and performing specific pujas (rituals) to pacify the negative effects of any difficult period.</p>
            </div>
        </div>

    </div>
</div>
EOT,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('rising_ascendant_report_contents');
        Schema::dropIfExists('dasha_report_contents');
    }
};
