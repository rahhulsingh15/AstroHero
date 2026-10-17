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
        // 1. Friendship Calculator Contents
        Schema::create('friendship_calculator_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('description')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });

        // 2. Friendship Report Contents
        Schema::create('friendship_report_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });

        // 3. Ishta Devata Calculator Contents
        Schema::create('ishta_devata_calculator_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('description')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });

        // 4. Ishta Devata Report Contents
        Schema::create('ishta_devata_report_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });

        // 5. Transit Chart Calculator Contents
        Schema::create('transit_chart_calculator_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('description')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });

        // 6. Transit Chart Report Contents
        Schema::create('transit_chart_report_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });

        // 7. Mulank Calculator Contents
        Schema::create('mulank_calculator_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('description')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });

        // 8. Mulank Report Contents
        Schema::create('mulank_report_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });

        // 9. Age Calculator Contents
        Schema::create('age_calculator_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('description')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });

        // 10. Age Report Contents
        Schema::create('age_report_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });

        // Seed 1: Friendship Calculator Content
        DB::table('friendship_calculator_contents')->insert([
            'heading' => 'Friendship Calculator - Test How Strong Your Friendship Is',
            'description' => 'Curious how well you and your friend click? Enter both names to get a friendship score based on the numbers hidden in your names.',
            'main_content' => <<<'EOT'
<div class="container nnc-content-wrapper">
    <h3>What Is a Friendship Calculator?</h3>
    <p>A friendship calculator is a light-hearted tool that gives a compatibility score for two friends. It uses name numerology: every name is reduced to a single number with the Chaldean chart, and the closer the two numbers are, the higher the score. Equal numbers give 100%, and every step between them takes away 10%, down to a minimum of 40%.</p>

    <h3>How to Read Your Score</h3>
    <ul class="nnc-list">
        <li><strong>100% - Soul Friends:</strong> both names reduce to the same number. You think and feel alike.</li>
        <li><strong>90% - Excellent Pair:</strong> a lasting friendship built on trust.</li>
        <li><strong>80% - Strong Bond:</strong> you understand and support each other.</li>
        <li><strong>70% - Good Match:</strong> things flow easily and you enjoy each other's company.</li>
        <li><strong>60% - Mild Bond:</strong> you get along well, most of all over a shared interest.</li>
        <li><strong>50% - Neutral Ground:</strong> neither a strong pull nor a clash. Respect lets it grow.</li>
        <li><strong>40% - Fragile Tie:</strong> very different natures. Patience will matter most.</li>
    </ul>

    <h3>What Makes a Friendship Last?</h3>
    <ul class="nnc-list">
        <li>being honest even when it is uncomfortable</li>
        <li>showing up in difficult times, not only the happy ones</li>
        <li>respecting each other's space and choices</li>
        <li>forgiving small mistakes quickly</li>
    </ul>

    <div class="discover-more">
        <h3>Discover More about yourself</h3>
        <div class="calc-cards">
            <a href="/horoscope/daily-horoscope" class="calc-card">
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
                <span>How does the friendship calculator work?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Each letter of a name has a number in numerology. The numbers of both names are compared to see how naturally the two people get along.</p>
            </div>
        </div>
        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Is the friendship score accurate?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>It is meant for fun. Real friendship depends on trust, time and effort, which no calculator can measure.</p>
            </div>
        </div>
        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Can I check more than one friend?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Yes. You can try as many names as you like.</p>
            </div>
        </div>
    </div>
</div>
EOT,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed 2: Friendship Report Content
        DB::table('friendship_report_contents')->insert([
            'heading' => 'Friendship Compatibility for {name1} and {name2}',
            'main_content' => <<<'EOT'
<h3>What Each Score Means</h3>
<p>Each score reflects a unique resonance between two individuals based on their numerological frequencies:</p>
<ul>
    <li><strong>100% Soul Friends:</strong> Pure harmony and intuitive mutual understanding.</li>
    <li><strong>90% Excellent Pair:</strong> High trust, genuine loyalty, and long-lasting companionship.</li>
    <li><strong>80% Strong Bond:</strong> Reliable communication and unconditional support in tough times.</li>
    <li><strong>70% Good Match:</strong> Fun, easy-going relationship filled with enjoyable moments.</li>
    <li><strong>60% Mild Bond:</strong> Good bond that flourishes best through shared hobbies and activities.</li>
    <li><strong>50% Neutral Ground:</strong> Balanced mutual respect where friendship can grow with time.</li>
    <li><strong>40% Fragile Tie:</strong> Very different perspectives; requires open communication and patience.</li>
</ul>
<p>Friendship is built with love, patience, and mutual respect.</p>
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
                <span>How is the friendship percentage calculated?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>It uses Chaldean numerology to convert the letters of both names into single root numbers and assesses the vibration between them.</p>
            </div>
        </div>
        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Can our friendship score change over time?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>The numerology score based on names is constant unless names or spellings change, but actual human friendships grow and deepen through life experiences.</p>
            </div>
        </div>
    </div>
</div>
EOT,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed 3: Ishta Devata Calculator Content
        DB::table('ishta_devata_calculator_contents')->insert([
            'heading' => 'Ishta Devata Calculator - Find Your Personal Deity from Your Kundli',
            'description' => 'Your Ishta Devata is the deity who guides your soul towards liberation. It is found from the Atmakaraka planet in your Navamsa chart. Enter your birth details to know your Ishta Devata.',
            'main_content' => <<<'EOT'
<div class="container ras-content-wrapper">
    <h3>What Is an Ishta Devata?</h3>
    <p>Jaimini astrology treats the Atmakaraka, the planet with the highest degree in your chart, as the king of the horoscope. The Ishta Devata is the deity who helps this soul planet complete its journey, and worshipping that form is said to bring peace and direction.</p>

    <h3>The Deity of Your Birth Star</h3>
    <p>Each of the 27 nakshatras has a presiding deity, for example Brahma for Rohini, Vishnu for Shravana and Rudra for Ardra. The deity of the nakshatra your Moon was in at birth is the first one shown in your result, with the name used in the North and in the South. Because the Moon rules the mind, this deity is worshipped for peace and protection.</p>

    <h3>How Is the Ishta Devata Found?</h3>
    <ul class="nnc-list">
        <li><strong>Step 1:</strong> Find the Atmakaraka, the planet with the highest degree in the birth chart.</li>
        <li><strong>Step 2:</strong> See which sign the Atmakaraka occupies in the Navamsa (D9) chart. This sign is called the Karakamsa.</li>
        <li><strong>Step 3:</strong> Look at the 12th sign from the Karakamsa. A planet placed there, or the lord of that sign if it is empty, shows the Ishta Devata.</li>
    </ul>

    <h3>Planets and Their Deities</h3>
    <div class="table-responsive">
        <table class="nnc-table">
            <thead>
                <tr><th>Planet</th><th>Deity</th></tr>
            </thead>
            <tbody>
                <tr><td>Sun</td><td>Lord Shiva, Lord Rama</td></tr>
                <tr><td>Moon</td><td>Goddess Parvati, Lord Krishna</td></tr>
                <tr><td>Mars</td><td>Lord Hanuman, Lord Kartikeya</td></tr>
                <tr><td>Mercury</td><td>Lord Vishnu</td></tr>
                <tr><td>Jupiter</td><td>Lord Vishnu, Lord Dattatreya</td></tr>
                <tr><td>Venus</td><td>Goddess Lakshmi</td></tr>
                <tr><td>Saturn</td><td>Lord Shani, Lord Hanuman</td></tr>
                <tr><td>Rahu</td><td>Goddess Durga</td></tr>
                <tr><td>Ketu</td><td>Lord Ganesha</td></tr>
            </tbody>
        </table>
    </div>
    <p>Different traditions give slightly different deities for the same planet, so treat the table as a general guide.</p>

    <div class="discover-more">
        <h3>Discover More about yourself</h3>
        <div class="calc-cards">
            <a href="/horoscope/daily-horoscope" class="calc-card">
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
                <span>What is an Ishta Devata?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Ishta means cherished and Devata means deity. It is the form of the divine that your birth chart points to as your personal guide.</p>
            </div>
        </div>
        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Is the Ishta Devata the same as the Kul Devata?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>No. The Kul Devata is the deity of your family line, while the Ishta Devata is personal and is read from your own chart.</p>
            </div>
        </div>
        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Can I worship a different deity?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Of course. The Ishta Devata is a suggestion from the chart. Worship offered with faith to any form is never wasted.</p>
            </div>
        </div>
    </div>
</div>
EOT,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed 4: Ishta Devata Report Content
        DB::table('ishta_devata_report_contents')->insert([
            'heading' => "{name}'s Ishta Devata Results",
            'main_content' => <<<'EOT'
<h3>Significance of Ishta Devata in Vedic Astrology</h3>
<p>In Vedic astrology, your Ishta Devata (cherished deity) represents the divine form that resonates with your innermost soul. Worshipping your Ishta Devata brings mental peace, removes spiritual obstacles, and aligns your life with your highest spiritual purpose.</p>
<h3>Daily Puja & Mantras</h3>
<p>Chanting the sacred mantra of your Ishta Devata with devotion every morning and lighting a ghee lamp fosters spiritual growth and protection.</p>
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
                <span>How often should I chant the Ishta Devata mantra?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Chanting 108 times daily (1 mala) facing North or East during sunrise is considered most auspicious.</p>
            </div>
        </div>
        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Can my Ishta Devata change over time?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>No, your Ishta Devata is determined by your natal horoscope and Navamsa chart, which remain constant throughout your life.</p>
            </div>
        </div>
    </div>
</div>
EOT,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed 5: Transit Chart Calculator Content
        DB::table('transit_chart_calculator_contents')->insert([
            'heading' => "Transit Chart Calculator - See Today's Planets on Your Birth Chart",
            'description' => "A transit chart places the planets as they are in the sky today over the houses of your birth chart. It shows which areas of your life are active right now. Enter your birth details to see your transits.",
            'main_content' => <<<'EOT'
<div class="container ras-content-wrapper">
    <h3>What Is a Transit Chart?</h3>
    <p>Your birth chart is fixed, but the planets never stop moving. In Vedic astrology their movement over your chart is called gochar. A transit chart lets you see at a glance where each planet is today, counted from your Moon sign or your ascendant.</p>

    <h3>How Long Does Each Planet Stay in a Sign?</h3>
    <div class="table-responsive">
        <table class="nnc-table">
            <thead>
                <tr><th>Planet</th><th>Time in One Sign</th></tr>
            </thead>
            <tbody>
                <tr><td>Moon</td><td>About 2¼ days</td></tr>
                <tr><td>Sun</td><td>About 1 month</td></tr>
                <tr><td>Mercury</td><td>About 3 to 4 weeks</td></tr>
                <tr><td>Venus</td><td>About 1 month</td></tr>
                <tr><td>Mars</td><td>About 45 days</td></tr>
                <tr><td>Jupiter</td><td>About 1 year</td></tr>
                <tr><td>Saturn</td><td>About 2½ years</td></tr>
                <tr><td>Rahu and Ketu</td><td>About 18 months</td></tr>
            </tbody>
        </table>
    </div>
    <p>Mercury, Venus and Mars can stay longer in a sign when they turn retrograde.</p>

    <h3>What Is a Transit Chart Used For?</h3>
    <ul class="nnc-list">
        <li>timing events promised in the birth chart</li>
        <li>checking Sade Sati and Jupiter's yearly transit</li>
        <li>choosing a better period for a job change, marriage or investment</li>
        <li>understanding why a particular area of life suddenly feels busy</li>
    </ul>

    <div class="discover-more">
        <h3>Discover More about yourself</h3>
        <div class="calc-cards">
            <a href="/horoscope/daily-horoscope" class="calc-card">
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
                <span>What is a transit chart?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>It is your birth chart with the current positions of the planets added to it, so you can see which house each planet is passing through for you.</p>
            </div>
        </div>
        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>How is a transit different from a dasha?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>A dasha is a planetary period counted from your birth star and lasts for years. A transit is the actual movement of planets in the sky. Astrologers read both together.</p>
            </div>
        </div>
        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Which transits matter the most?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>The slow planets: Saturn, Jupiter, Rahu and Ketu. They stay in a sign for a year or more and shape the longer chapters of life.</p>
            </div>
        </div>
    </div>
</div>
EOT,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed 6: Transit Chart Report Content
        DB::table('transit_chart_report_contents')->insert([
            'heading' => "{name}'s Transit Chart",
            'main_content' => <<<'EOT'
<h3>How to Read Your Transit Chart</h3>
<p>Houses are counted from your Moon sign: the sign your Moon is in is the 1st house, the next sign is the 2nd, and so on. A planet passing through a house brings its nature to that area of your life for as long as it stays in that sign.</p>
<p>Transits trigger and manifest events indicated in your natal horoscope according to the timing of planetary motions.</p>
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
                <span>Should transits be read from Moon or Lagna?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>In Vedic astrology, transits (Gochar) are traditionally evaluated primarily from the Moon sign, while transits from the Lagna reveal physical and circumstantial manifestations.</p>
            </div>
        </div>
    </div>
</div>
EOT,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed 7: Mulank Calculator Content
        DB::table('mulank_calculator_contents')->insert([
            'heading' => 'Mulank Calculator - Find Your Birth Number from Date of Birth',
            'description' => 'Mulank, also called the birth number or root number, is the day of the month you were born on reduced to a single digit. It describes your basic nature. Enter your date of birth to find your Mulank.',
            'main_content' => <<<'EOT'
<div class="container nnc-content-wrapper">
    <h3>What Is Mulank?</h3>
    <p>In Indian numerology the Mulank is the first number read for any person. It shows your natural temperament, the way you think and the first impression you leave. Each Mulank is ruled by a planet, and the qualities of that planet colour your personality.</p>

    <h3>Mulank by Date of Birth</h3>
    <div class="table-responsive">
        <table class="nnc-table">
            <thead>
                <tr><th>Mulank</th><th>Born on</th><th>Ruling Planet</th><th>Nature</th></tr>
            </thead>
            <tbody>
                <tr><td>1</td><td>1, 10, 19, 28</td><td>Sun</td><td>Leader, confident, independent</td></tr>
                <tr><td>2</td><td>2, 11, 20, 29</td><td>Moon</td><td>Gentle, emotional, imaginative</td></tr>
                <tr><td>3</td><td>3, 12, 21, 30</td><td>Jupiter</td><td>Wise, cheerful, disciplined</td></tr>
                <tr><td>4</td><td>4, 13, 22, 31</td><td>Rahu</td><td>Practical, hard-working, unconventional</td></tr>
                <tr><td>5</td><td>5, 14, 23</td><td>Mercury</td><td>Quick, sociable, adaptable</td></tr>
                <tr><td>6</td><td>6, 15, 24</td><td>Venus</td><td>Charming, artistic, family-loving</td></tr>
                <tr><td>7</td><td>7, 16, 25</td><td>Ketu</td><td>Thoughtful, spiritual, private</td></tr>
                <tr><td>8</td><td>8, 17, 26</td><td>Saturn</td><td>Serious, patient, determined</td></tr>
                <tr><td>9</td><td>9, 18, 27</td><td>Mars</td><td>Bold, energetic, generous</td></tr>
            </tbody>
        </table>
    </div>

    <h3>What Is Mulank Used For?</h3>
    <ul class="nnc-list">
        <li>understanding your basic personality</li>
        <li>finding your lucky numbers, days and colours</li>
        <li>checking whether your name, mobile number or vehicle number suits you</li>
        <li>comparing compatibility with a partner</li>
    </ul>

    <div class="discover-more">
        <h3>Discover More about yourself</h3>
        <div class="calc-cards">
            <a href="/horoscope/daily-horoscope" class="calc-card">
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
                <span>What is Mulank?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Mulank is the single digit you get by adding the digits of your day of birth. Someone born on the 29th has 2 + 9 = 11, and 1 + 1 = 2, so the Mulank is 2.</p>
            </div>
        </div>
        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Is Mulank the same as Bhagyank?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>No. Mulank uses only the day of birth. Bhagyank, the destiny number, uses the full date including the month and year.</p>
            </div>
        </div>
        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Can two people have the same Mulank?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Yes. Everyone born on the 1st, 10th, 19th or 28th of any month has Mulank 1, and so on for the other numbers.</p>
            </div>
        </div>
    </div>
</div>
EOT,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed 8: Mulank Report Content
        DB::table('mulank_report_contents')->insert([
            'heading' => "{name}'s Mulank Report",
            'main_content' => <<<'EOT'
<h3>Mulank and Bhagyank in Harmony</h3>
<p>Mulank comes only from the day of the month you were born on, so it never changes and is shared by everyone born on those dates. Bhagyank adds the month and year as well, so it is more personal. Numerologists read both together: Mulank for your nature, Bhagyank for the path your life takes.</p>
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
                <span>How can I activate my lucky Mulank energy?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Wearing your auspicious colour on your lucky days, chanting the ruling planet's mantra, and aligning important events with your favourable dates enhances positivity.</p>
            </div>
        </div>
    </div>
</div>
EOT,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed 9: Age Calculator Content
        DB::table('age_calculator_contents')->insert([
            'heading' => 'Age Calculator - Find Your Exact Age in Years, Months and Days',
            'description' => 'Enter your date of birth to know your exact age in years, months and days, along with the number of days left until your next birthday.',
            'main_content' => <<<'EOT'
<div class="container nnc-content-wrapper">
    <h3>What Is an Age Calculator?</h3>
    <p>An age calculator tells you exactly how old you are on a given day. It saves you from counting months of different lengths and leap years by hand, which is where most mistakes happen.</p>

    <h3>How Is Age Calculated?</h3>
    <p>Take someone born on <strong>15 August 1990</strong>, with age needed on <strong>7 October 2026</strong>:</p>
    <ul class="nnc-list">
        <li>From 15 August 1990 to 15 August 2026 is 36 completed years.</li>
        <li>From 15 August 2026 to 15 September 2026 is 1 completed month.</li>
        <li>From 15 September 2026 to 7 October 2026 is 22 days.</li>
        <li>The age is <strong>36 years, 1 month and 22 days</strong>.</li>
    </ul>

    <h3>Where Do You Need Your Exact Age?</h3>
    <ul class="nnc-list">
        <li>filling forms for government jobs and competitive exams with age limits</li>
        <li>school and college admissions</li>
        <li>insurance, pension and retirement planning</li>
        <li>finding the dasha and antardasha running at your current age</li>
    </ul>

    <div class="discover-more">
        <h3>Discover More about yourself</h3>
        <div class="calc-cards">
            <a href="/horoscope/daily-horoscope" class="calc-card">
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
                <span>How is age calculated?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>The date of birth is subtracted from today's date. Completed years are counted first, then the remaining months, then the remaining days.</p>
            </div>
        </div>
        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Does the calculator handle leap years?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Yes. February is counted with 29 days in a leap year and 28 days otherwise.</p>
            </div>
        </div>
        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Can I find my age on a past or future date?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Yes. Change the "Age as on" date to any day and the age will be worked out for that day.</p>
            </div>
        </div>
    </div>
</div>
EOT,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed 10: Age Report Content
        DB::table('age_report_contents')->insert([
            'heading' => 'Your Exact Age Breakdown',
            'main_content' => <<<'EOT'
<h3>How this age was counted</h3>
<p>Completed years are counted first, then the completed months after your last birthday, and then the remaining days. Months of different lengths and leap years are taken into account, so the result matches the way age is written on official forms.</p>
<ul>
    <li><strong>Age in days</strong> is the total number of days between the two dates.</li>
    <li><strong>Age in weeks</strong> is the number of completed weeks in those days.</li>
    <li><strong>Age in hours</strong> counts 24 hours for every completed day.</li>
</ul>
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
                <span>Why is exact chronological age important in astrology?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Astrological systems like Vimshottari Dasha, Varshphal (Solar Return), and planetary returns rely on precise completed years and days to calculate timing of life events.</p>
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
        Schema::dropIfExists('age_report_contents');
        Schema::dropIfExists('age_calculator_contents');
        Schema::dropIfExists('mulank_report_contents');
        Schema::dropIfExists('mulank_calculator_contents');
        Schema::dropIfExists('transit_chart_report_contents');
        Schema::dropIfExists('transit_chart_calculator_contents');
        Schema::dropIfExists('ishta_devata_report_contents');
        Schema::dropIfExists('ishta_devata_calculator_contents');
        Schema::dropIfExists('friendship_report_contents');
        Schema::dropIfExists('friendship_calculator_contents');
    }
};
