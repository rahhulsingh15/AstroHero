<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Moon Phase Calculator Contents
        Schema::create('moon_phase_calculator_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('description')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });

        // 2. Moon Phase Report Contents
        Schema::create('moon_phase_report_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('description')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });

        // 3. Flames Calculator Contents
        Schema::create('flames_calculator_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('description')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });

        // 4. Flames Report Contents
        Schema::create('flames_report_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('description')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });

        // Seed Moon Phase Calculator Page
        DB::table('moon_phase_calculator_contents')->insert([
            'heading' => 'Moon Phase Calculator',
            'description' => 'Discover the exact phase of the moon at the moment of your birth. The lunar phase reveals deep insights into your emotional nature, subconscious patterns, and spiritual path.',
            'main_content' => <<<'EOT'
<div class="container nnc-content-wrapper">
    <h3>What Are Moon Phases?</h3>
    <p>The moon phases, or lunar phases, refer to the shape of the moon's directly sunlit portion as viewed from Earth. As the moon orbits the Earth, its position relative to the Earth and Sun changes, causing it to go through a cycle of phases over approximately 29.5 days.</p>
    <p>Your natal moon phase (the phase the moon was in when you were born) is believed to deeply influence your core personality, emotional needs, and how you naturally process life's challenges. It provides a blueprint of your inner psychological landscape.</p>

    <h3>What are All the 8 Moon Phases?</h3>
    <p>The lunar cycle consists of eight distinct phases. Here is a detailed breakdown of each phase and what it signifies for those born under it:</p>

    <h4>1. New Moon</h4>
    <p>The New Moon occurs when the Moon is positioned between the Earth and the Sun, making the side facing Earth completely dark.</p>
    <ul class="nnc-list">
        <li><strong>Personality:</strong> Innovative, pioneering, impulsive, and full of fresh energy.</li>
        <li><strong>Traits:</strong> You love starting new projects, have a childlike curiosity, and tend to act on intuition rather than logic.</li>
        <li><strong>Challenge:</strong> You may struggle to finish what you start, constantly seeking the thrill of the "new."</li>
    </ul>

    <h4>2. Waxing Crescent</h4>
    <p>A sliver of the moon becomes visible on the right side as it begins its journey toward fullness.</p>
    <ul class="nnc-list">
        <li><strong>Personality:</strong> Determined, assertive, and focused on growth.</li>
        <li><strong>Traits:</strong> You have a strong drive to push forward, overcome obstacles, and establish yourself. You are highly motivated to succeed.</li>
        <li><strong>Challenge:</strong> You might feel a constant underlying tension or urgency to prove yourself.</li>
    </ul>

    <h4>3. First Quarter</h4>
    <p>The moon is exactly half-illuminated on its right side. This is a point of crisis and action in the lunar cycle.</p>
    <ul class="nnc-list">
        <li><strong>Personality:</strong> Action-oriented, strong-willed, and rebellious.</li>
        <li><strong>Traits:</strong> You thrive in high-pressure situations and love a good challenge. You are a natural manager and problem-solver.</li>
        <li><strong>Challenge:</strong> Prone to clashes with authority and impulsive decision-making during stressful times.</li>
    </ul>

    <h4>4. Waxing Gibbous</h4>
    <p>The moon is mostly illuminated, just a few days away from becoming a Full Moon.</p>
    <ul class="nnc-list">
        <li><strong>Personality:</strong> Analytical, nurturing, and perfectionist.</li>
        <li><strong>Traits:</strong> You have an innate desire to perfect your skills and contribute to society. You analyze situations deeply before acting.</li>
        <li><strong>Challenge:</strong> Overthinking and getting caught up in the details, leading to anxiety.</li>
    </ul>

    <h4>5. Full Moon</h4>
    <p>The Earth is between the Sun and the Moon, fully illuminating the Moon's face. This is the peak of the cycle.</p>
    <ul class="nnc-list">
        <li><strong>Personality:</strong> Expressive, highly emotional, dramatic, and relationship-oriented.</li>
        <li><strong>Traits:</strong> You are deeply affected by the people around you and seek meaning through relationships. You are likely highly intuitive, creative, and drawn to public life.</li>
        <li><strong>Challenge:</strong> Balancing your extreme emotional highs and lows. You may struggle with codependency.</li>
    </ul>

    <h4>6. Waning Gibbous</h4>
    <p>The moon begins to shrink, with darkness creeping in from the right side.</p>
    <ul class="nnc-list">
        <li><strong>Personality:</strong> Communicative, philosophical, and eager to share knowledge.</li>
        <li><strong>Traits:</strong> You feel a calling to teach, share experiences, and disseminate information. You want to leave a legacy based on what you've learned.</li>
        <li><strong>Challenge:</strong> Becoming too preachy or fanatical about your own beliefs.</li>
    </ul>

    <h4>7. Last Quarter</h4>
    <p>The moon is half-illuminated again, but this time on the left side.</p>
    <ul class="nnc-list">
        <li><strong>Personality:</strong> Transition-focused, introspective, and transformative.</li>
        <li><strong>Traits:</strong> You are going through an internal shift. You often evaluate what works and what needs to be discarded in life. You are independent and self-sufficient.</li>
        <li><strong>Challenge:</strong> Letting go of the past and embracing the unknown can be painful.</li>
    </ul>

    <h4>8. Waning Crescent (Balsamic Moon)</h4>
    <p>Only a tiny sliver remains visible on the left before the moon goes completely dark again.</p>
    <ul class="nnc-list">
        <li><strong>Personality:</strong> Spiritual, psychic, solitary, and wise.</li>
        <li><strong>Traits:</strong> You are an old soul, deeply connected to the spiritual realm. You possess innate wisdom and often act as a healer for others.</li>
        <li><strong>Challenge:</strong> Feelings of isolation or being misunderstood by the highly material world.</li>
    </ul>

    <h3>What is the Moon Cycle?</h3>
    <p>The moon cycle is the continuous orbit of the moon around the Earth, which takes approximately 29.5 days. This rhythm has guided agriculture, navigation, and astrology for thousands of years. Just as the moon controls the ocean's tides, astrology posits that the moon also governs our internal emotional tides, influencing our moods, instincts, and subconscious mind.</p>

    <div class="discover-more" style="margin-top: 50px;">
        <h3>Discover More about yourself</h3>
        <div class="calc-cards">
            <div class="calc-card">
                <span class="c-icon">🔮</span>
                <h4>Birth Chart Calculator</h4>
                <p>Generate your detailed Kundli</p>
            </div>
            <div class="calc-card">
                <span class="c-icon">🔥</span>
                <h4>Mangal Dosha Calculator</h4>
                <p>Check Mars influence in your chart</p>
            </div>
            <div class="calc-card">
                <span class="c-icon">❤️</span>
                <h4>Love Calculator</h4>
                <p>Check your compatibility</p>
            </div>
        </div>
    </div>
</div>
EOT,
            'faq_content' => <<<'EOT'
<div class="acord-container">
    <div class="acord-left">
        <span class="acord-subtitle">FREQUENTLY ASKED</span>
        <h2 class="acord-title">Got doubts? <span class="highlight">Find</span> your answers<br>here.</h2>
    </div>

    <div class="acord-right">
        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Is my moon phase the same as my Moon Sign?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>No, they are different. Your Moon Sign indicates which zodiac constellation the moon was passing through when you were born. Your Moon Phase indicates the angle between the Sun and the Moon (how illuminated the moon was).</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Can moon phases affect my mood?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Astrologically and culturally, it is widely believed that the moon impacts human emotions. Full moons are often associated with heightened emotions and climax, while new moons are associated with low energy and introspection.</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Which moon phase is best for starting something new?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>The New Moon and Waxing Crescent phases are considered ideal for setting intentions, initiating projects, and planting the seeds for future success.</p>
            </div>
        </div>
    </div>
</div>
EOT,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Moon Phase Report Page
        DB::table('moon_phase_report_contents')->insert([
            'heading' => "{name}'s Moon Phase Report",
            'description' => null,
            'main_content' => <<<'EOT'
<h3>What Are Moon Phases?</h3>
<p>The moon phases, or lunar phases, refer to the shape of the moon's directly sunlit portion as viewed from Earth. As the moon orbits the Earth, its position relative to the Earth and Sun changes, causing it to go through a cycle of phases over approximately 29.5 days.</p>
<p>Your natal moon phase (the phase the moon was in when you were born) is believed to deeply influence your core personality, emotional needs, and how you naturally process life's challenges. It provides a blueprint of your inner psychological landscape.</p>
EOT,
            'faq_content' => <<<'EOT'
<div class="acord-container">
    <div class="acord-left">
        <span class="acord-subtitle">FREQUENTLY ASKED</span>
        <h2 class="acord-title">Got doubts? <span class="highlight">Find</span> your answers<br>here.</h2>
    </div>

    <div class="acord-right">
        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Is my moon phase the same as my Moon Sign?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>No, they are different. Your Moon Sign indicates which zodiac constellation the moon was passing through when you were born. Your Moon Phase indicates the angle between the Sun and the Moon (how illuminated the moon was).</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Can moon phases affect my mood?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Astrologically and culturally, it is widely believed that the moon impacts human emotions. Full moons are often associated with heightened emotions and climax, while new moons are associated with low energy and introspection.</p>
            </div>
        </div>
    </div>
</div>
EOT,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Flames Calculator Page
        DB::table('flames_calculator_contents')->insert([
            'heading' => 'FLAMES Calculator - Find the Bond Between Two Names',
            'description' => 'FLAMES is the classic name game that tells you whether two people are Friends, Lovers, Affectionate, heading for Marriage, Enemies or like Siblings. Enter the two names to play.',
            'main_content' => <<<'EOT'
<div class="container nnc-content-wrapper">
    <h3>What Is FLAMES?</h3>
    <p>FLAMES is a game that has been played in school notebooks for generations. It takes two names and, through a simple counting method, lands on one of six letters, each standing for a kind of relationship.</p>

    <h3>How Is FLAMES Calculated?</h3>
    <ul class="nnc-list">
        <li><strong>Step 1:</strong> Write both names and cross out the letters they have in common, one pair at a time.</li>
        <li><strong>Step 2:</strong> Count the letters that are left in both names.</li>
        <li><strong>Step 3:</strong> Write F, L, A, M, E, S and count along it using that number. Strike off the letter you land on.</li>
        <li><strong>Step 4:</strong> Start counting again from the next letter and repeat until only one letter remains.</li>
    </ul>

    <h3>What Each Letter Means</h3>
    <ul class="nnc-list">
        <li><strong>F - Friends:</strong> an easy, trusting friendship.</li>
        <li><strong>L - Lovers:</strong> a romantic attraction.</li>
        <li><strong>A - Affection:</strong> warmth and care for each other.</li>
        <li><strong>M - Marriage:</strong> a bond that could last a lifetime.</li>
        <li><strong>E - Enemies:</strong> frequent clashes and disagreements.</li>
        <li><strong>S - Siblings:</strong> a protective, family-like bond.</li>
    </ul>

    <div class="discover-more">
        <h3>Discover More about yourself</h3>
        <div class="calc-cards">
            <a href="/horoscope/daily" class="calc-card">
                <span class="c-icon">📅</span>
                <h4>Daily Horoscope</h4>
                <p>Read your daily predictions</p>
            </a>
            <a href="/love-calculator" class="calc-card">
                <span class="c-icon">❤️</span>
                <h4>Love Calculator</h4>
                <p>Check love percentage</p>
            </a>
            <a href="/numerology-calculator" class="calc-card">
                <span class="c-icon">🔢</span>
                <h4>Numerology Calculator</h4>
                <p>Find the numbers in your name</p>
            </a>
            <a href="/dasha-calculator" class="calc-card">
                <span class="c-icon">🪐</span>
                <h4>Dasha Calculator</h4>
                <p>See your planetary periods</p>
            </a>
        </div>
    </div>
</div>
EOT,
            'faq_content' => <<<'EOT'
<div class="acord-container">
    <div class="acord-left">
        <span class="acord-subtitle">FREQUENTLY ASKED</span>
        <h2 class="acord-title">Got doubts? <span class="highlight">Find</span> your answers<br>here.</h2>
    </div>

    <div class="acord-right">
        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>What does FLAMES stand for?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>F is Friends, L is Lovers, A is Affection, M is Marriage, E is Enemies and S is Siblings.</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Is the FLAMES result accurate?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>FLAMES is a game played for fun and has no basis in astrology. For a real compatibility check, kundli matching uses the birth charts of both people.</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Does the spelling of the name matter?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Yes. The game works on letters, so a different spelling, a nickname or adding a surname can change the result.</p>
            </div>
        </div>
    </div>
</div>
EOT,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Flames Report Page
        DB::table('flames_report_contents')->insert([
            'heading' => 'FLAMES Result for {name1} and {name2}',
            'description' => null,
            'main_content' => <<<'EOT'
<h3>What each letter means</h3>
<ul>
    <li><strong>🤝 F - Friends</strong>: An easy, trusting bond of companionship.</li>
    <li><strong>❤️ L - Lovers</strong>: Romantic sparks and attraction.</li>
    <li><strong>✨ A - Affection</strong>: Deep care, warmth, and gentleness for each other.</li>
    <li><strong>💍 M - Marriage</strong>: A lifetime commitment and strong partnership.</li>
    <li><strong>⚡ E - Enemies</strong>: Frequent differences, misunderstandings, or clashes.</li>
    <li><strong>🌱 S - Siblings</strong>: A pure, protective, and family-like connection.</li>
</ul>
<p>FLAMES is a fun game. For genuine astrological matching, explore our <a href="/kundli-matching">Kundli Matching</a> service.</p>
EOT,
            'faq_content' => <<<'EOT'
<div class="acord-container">
    <div class="acord-left">
        <span class="acord-subtitle">FREQUENTLY ASKED</span>
        <h2 class="acord-title">Got doubts? <span class="highlight">Find</span> your answers<br>here.</h2>
    </div>

    <div class="acord-right">
        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Can FLAMES predict real love?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>FLAMES is an entertaining childhood game based on names. Real love and compatibility depend on understanding, communication, and planetary charts.</p>
            </div>
        </div>
    </div>
</div>
EOT,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flames_report_contents');
        Schema::dropIfExists('flames_calculator_contents');
        Schema::dropIfExists('moon_phase_report_contents');
        Schema::dropIfExists('moon_phase_calculator_contents');
    }
};
