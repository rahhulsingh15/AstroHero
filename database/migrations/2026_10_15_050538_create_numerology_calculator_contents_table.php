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
        // Numerology calculator + numerology report page ka content (ek hi row)
        Schema::create('numerology_calculator_contents', function (Blueprint $table) {
            $table->id();

            // Calculator page
            $table->string('meta_title')->nullable();
            $table->string('breadcrumb_label')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_intro')->nullable();
            $table->string('form_title')->nullable();
            $table->string('promo_text')->nullable();
            $table->longText('main_content')->nullable();   // Jodit
            $table->string('faq_subtitle')->nullable();
            $table->string('faq_title')->nullable();

            // Report page
            $table->string('report_banner_title')->nullable();
            $table->string('report_banner_text')->nullable();
            $table->longText('report_content')->nullable(); // Jodit

            $table->timestamps();
        });

        Schema::create('numerology_calculator_faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer')->nullable(); // Jodit
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });

        $this->seedDefaults();
    }

    /**
     * Abhi page par jo content hai wahi shuru ka data bana diya, taaki page waisa hi dikhe.
     */
    private function seedDefaults(): void
    {
        $now = now();

        DB::table('numerology_calculator_contents')->insert([
            'meta_title'       => 'Numerology Calculator - Find Your Destiny, Personality & Soul Number',
            'breadcrumb_label' => 'NAME NUMEROLOGY CALCULATOR',
            'hero_title'       => 'Name Numerology Calculator - Find Your Destiny, Personality & Soul Number',
            'hero_intro'       => 'Name Numerology helps you uncover the hidden numbers in your name that influence your personality and destiny. Discover your Expression Number, Soul Urge Number, and Personality Number by simply entering your details below.',
            'form_title'       => 'Enter Your Details',
            'promo_text'       => 'Connect with our Astrologers on Call or Chat for more personalized detailed predictions.',
            'main_content'     => <<<'EOT'
<h3>What Is Name Numerology?</h3>
<p>Name numerology is the study of the numbers hidden in your name. Each letter of the alphabet is linked to a number, and when the letters of a name are added together they give a small set of numbers that numerologists read as a picture of your nature, your strengths and the kind of life you are drawn towards.</p>
<p>Because you hear, write and sign your name every day, numerology treats it as a vibration that travels with you. A name whose numbers sit well with your date of birth is believed to support you, while a mismatch is believed to make the same effort feel heavier.</p>

<h3>What Is the Difference Between the Name Numerology Systems?</h3>
<p>Our calculator supports the two systems that are used most often. They give different results for the same name because they number the letters differently.</p>
<div class="table-responsive">
    <table class="nnc-table">
        <thead>
            <tr>
                <th>Feature</th>
                <th>Chaldean System</th>
                <th>Pythagorean System</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Origin</td>
                <td>Ancient Babylon</td>
                <td>Ancient Greece</td>
            </tr>
            <tr>
                <td>How letters get their number</td>
                <td>By the sound and vibration of each letter</td>
                <td>By the order of the alphabet (A=1, B=2 … then repeat)</td>
            </tr>
            <tr>
                <td>Numbers used</td>
                <td>1 to 8 (9 is kept sacred and given to no letter)</td>
                <td>1 to 9</td>
            </tr>
            <tr>
                <td>Name usually taken</td>
                <td>The name you are known by</td>
                <td>Your full birth name</td>
            </tr>
            <tr>
                <td>Best known for</td>
                <td>Name correction and spelling changes</td>
                <td>Personality and life-path readings</td>
            </tr>
        </tbody>
    </table>
</div>

<h3>What Are the 3 Numbers in Your Name?</h3>
<p>Every name gives three numbers: the <strong>Destiny (Expression) Number</strong>, the <strong>Soul Urge (Heart's Desire) Number</strong> and the <strong>Personality (Dream) Number</strong>. All three come from the same letter chart, shown below for both systems.</p>

<h4>Chaldean letter chart</h4>
<div class="table-responsive">
    <table class="nnc-table values-table">
        <thead>
            <tr>
                <th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>A, I, J, Q, Y</td>
                <td>B, K, R</td>
                <td>C, G, L, S</td>
                <td>D, M, T</td>
                <td>E, H, N, X</td>
                <td>U, V, W</td>
                <td>O, Z</td>
                <td>F, P</td>
            </tr>
        </tbody>
    </table>
</div>

<h4>Pythagorean letter chart</h4>
<div class="table-responsive">
    <table class="nnc-table values-table">
        <thead>
            <tr>
                <th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>A, J, S</td>
                <td>B, K, T</td>
                <td>C, L, U</td>
                <td>D, M, V</td>
                <td>E, N, W</td>
                <td>F, O, X</td>
                <td>G, P, Y</td>
                <td>H, Q, Z</td>
                <td>I, R</td>
            </tr>
        </tbody>
    </table>
</div>

<h3>What Is the Destiny / Expression Number?</h3>
<p>The Destiny Number is the main number of your name. It describes the direction your life tends to take and the abilities you bring with you. It is read to understand:</p>
<ul class="nnc-list">
    <li>the purpose you keep returning to in life</li>
    <li>the natural talents you can build a career on</li>
    <li>the kind of obstacles you are likely to meet, and how you deal with them</li>
    <li>the work and goals that suit you best</li>
</ul>

<h3>How Is the Destiny Number Calculated?</h3>
<p>Write your name, put the chart number under each letter, add them all, and keep adding the digits until one digit is left. Take the name <strong>ANJALI</strong> in the Chaldean system:</p>
<div class="table-responsive">
    <table class="nnc-table values-table">
        <thead>
            <tr><th>A</th><th>N</th><th>J</th><th>A</th><th>L</th><th>I</th></tr>
        </thead>
        <tbody>
            <tr><td>1</td><td>5</td><td>1</td><td>1</td><td>3</td><td>1</td></tr>
        </tbody>
    </table>
</div>
<p>1 + 5 + 1 + 1 + 3 + 1 = 12, and 1 + 2 = 3. So the Numerology Total is 12 and the Destiny Number is <strong>3</strong>.</p>

<h3>What Is the Personality / Dream Number?</h3>
<p>The Personality Number is the side of you that other people see first. It is read to understand:</p>
<ul class="nnc-list">
    <li>the first impression you make</li>
    <li>how you carry yourself in public</li>
    <li>the qualities strangers notice in you before they know you</li>
    <li>the mood you bring into a room</li>
</ul>

<h3>How Is the Personality Number Calculated?</h3>
<p>Add only the consonants of the name. In ANJALI the consonants are N (5), J (1) and L (3), which add up to 9. The Personality Number is <strong>9</strong>.</p>

<h3>What Is the Soul Urge / Heart's Desire Number?</h3>
<p>The Soul Urge Number is the most private of the three. It points to what you want deep down, even when you do not say it. It is read to understand:</p>
<ul class="nnc-list">
    <li>what truly motivates you</li>
    <li>the kind of relationship you long for</li>
    <li>what brings you peace of mind</li>
    <li>what makes life feel meaningful to you</li>
</ul>

<h3>How Is the Soul Urge Number Calculated?</h3>
<p>Add only the vowels (A, E, I, O, U) of the name. In ANJALI the vowels are A (1), A (1) and I (1), which add up to 3. The Soul Urge Number is <strong>3</strong>.</p>

<h3>Name Numerology: What Each Number Means</h3>
<p>Whether it appears as your Destiny, Soul Urge or Personality Number, each number carries the nature of the planet that rules it.</p>
<ul class="nnc-list">
    <li><strong>Number 1 (Sun):</strong> a leader. Confident, self-reliant, driven and happiest when in charge.</li>
    <li><strong>Number 2 (Moon):</strong> a nurturer. Gentle, feeling, imaginative and good at reading people.</li>
    <li><strong>Number 3 (Jupiter):</strong> an optimist. Expressive, cheerful, good with words and eager to learn.</li>
    <li><strong>Number 4 (Rahu):</strong> a builder. Practical, steady, dependable and unconventional in thinking.</li>
    <li><strong>Number 5 (Mercury):</strong> a quick mind. Curious, flexible, sociable and fond of change and travel.</li>
    <li><strong>Number 6 (Venus):</strong> a harmoniser. Warm, attractive, artistic and devoted to home and loved ones.</li>
    <li><strong>Number 7 (Ketu):</strong> a seeker. Thoughtful, private, spiritual and drawn to deeper questions.</li>
    <li><strong>Number 8 (Saturn):</strong> an achiever. Serious, patient, determined and able to carry responsibility.</li>
    <li><strong>Number 9 (Mars):</strong> a fighter. Bold, energetic, generous and quick to act.</li>
</ul>

<h3>When Should You Change Your Name?</h3>
<p>Numerologists compare the Destiny Number of your name with your <strong>Birth Number</strong>, which is your date of birth reduced to one digit (born on the 19th: 1 + 9 = 10, 1 + 0 = 1). When the planets that rule the two numbers are friends, the name is said to support you. When they are natural enemies, a small spelling change is often suggested. The table follows the natural friendship of the ruling planets.</p>
<div class="table-responsive">
    <table class="nnc-table">
        <thead>
            <tr>
                <th>Birth Number</th>
                <th>Friendly Destiny Numbers</th>
                <th>Destiny Numbers to Avoid</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>1 (Sun)</td><td>1, 2, 3, 9</td><td>6, 8</td></tr>
            <tr><td>2 (Moon)</td><td>1, 2, 5</td><td>4, 7</td></tr>
            <tr><td>3 (Jupiter)</td><td>1, 2, 3, 9</td><td>5, 6</td></tr>
            <tr><td>4 (Rahu)</td><td>4, 5, 6, 8</td><td>1, 2, 9</td></tr>
            <tr><td>5 (Mercury)</td><td>1, 5, 6</td><td>2</td></tr>
            <tr><td>6 (Venus)</td><td>5, 6, 8</td><td>1, 2</td></tr>
            <tr><td>7 (Ketu)</td><td>6, 7, 8, 9</td><td>1, 2</td></tr>
            <tr><td>8 (Saturn)</td><td>5, 6, 8</td><td>1, 2, 9</td></tr>
            <tr><td>9 (Mars)</td><td>1, 2, 3, 9</td><td>5</td></tr>
        </tbody>
    </table>
</div>
<p><strong>Note:</strong> in the Chaldean system no letter is given the number 9, but a name can still reduce to 9 when its letters are added.</p>
<p>Here is how a correction works. Suppose Pooja is born on the 1st, so her Birth Number is 1 (Sun). In the Chaldean system POOJA adds up to 24, which reduces to 6 (Venus), a number the table says to avoid for Birth Number 1. Adding an H at the end changes the total to 29, which reduces to 2 (Moon), a friendly number.</p>
<div class="table-responsive">
    <table class="nnc-table values-table">
        <thead>
            <tr><th></th><th>P</th><th>O</th><th>O</th><th>J</th><th>A</th><th>H</th><th>Total</th><th>Destiny</th></tr>
        </thead>
        <tbody>
            <tr><td>Before</td><td>8</td><td>7</td><td>7</td><td>1</td><td>1</td><td>–</td><td>24</td><td>6</td></tr>
            <tr><td>After</td><td>8</td><td>7</td><td>7</td><td>1</td><td>1</td><td>5</td><td>29</td><td>2</td></tr>
        </tbody>
    </table>
</div>
<p>A name is part of your identity and your documents, so treat this as guidance and speak to a numerologist before making a real change.</p>

<h3>How Does the Name Numerology Calculator Work?</h3>
<p>Besides your three numbers, the report also lists what is traditionally linked with your Destiny Number: favourable sign, alphabets, days, dates and numbers, gemstone, direction, colour, ruling planet, deity, fast and mantra.</p>
<ul class="nnc-list">
    <li><strong>Step 1:</strong> Type your name in English letters.</li>
    <li><strong>Step 2:</strong> Choose Chaldean or Pythagorean numerology.</li>
    <li><strong>Step 3:</strong> Click Calculate.</li>
    <li><strong>Step 4:</strong> Read your numbers, see how each letter was counted, and go through the details for your Destiny Number.</li>
</ul>
EOT,
            'faq_subtitle'     => 'FREQUENTLY ASKED',
            'faq_title'        => 'Got doubts? <span class="highlight">Find</span> your answers<br>here.',

            'report_banner_title' => 'Want deeper insights into your destiny?',
            'report_banner_text'  => 'Consult our expert numerologists for a personalized reading today.',
            'report_content'      => <<<'EOT'
<h3>The Power of Name Numerology</h3>
<p>Every letter in your name carries a specific vibrational frequency. In Chaldean and Pythagorean numerology, these letters are translated into numbers, revealing profound insights into your destiny, hidden traits, and life purpose. A balanced name can attract wealth, health, and harmonious relationships.</p>

<h4>What the Numbers Reveal About You</h4>
<ul>
    <li><strong>Numerology Number:</strong> Represents your overall vibration and the energy you emit into the universe.</li>
    <li><strong>Destiny Number:</strong> Highlights your ultimate goal, life path, and what you are meant to achieve.</li>
    <li><strong>Soul Urge Number:</strong> Uncovers your deepest, most hidden inner desires and emotional cravings.</li>
    <li><strong>Personality Number:</strong> Shows the 'outer you'—how others perceive you at first glance.</li>
</ul>

<h4>Chaldean Numerology Alphabet Chart</h4>
<p>The Chaldean system is considered one of the oldest and most accurate numerology systems. It assigns numbers 1 through 8 to letters based on their vibrational frequencies.</p>

<table class="data-table">
    <thead>
        <tr>
            <th>Number</th>
            <th>Letters Assigned</th>
            <th>Planetary Ruling</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>A, I, J, Q, Y</td>
            <td>Sun</td>
        </tr>
        <tr>
            <td>2</td>
            <td>B, K, R</td>
            <td>Moon</td>
        </tr>
        <tr>
            <td>3</td>
            <td>C, G, L, S</td>
            <td>Jupiter</td>
        </tr>
        <tr>
            <td>4</td>
            <td>D, M, T</td>
            <td>Rahu</td>
        </tr>
        <tr>
            <td>5</td>
            <td>E, H, N, X</td>
            <td>Mercury</td>
        </tr>
        <tr>
            <td>6</td>
            <td>U, V, W</td>
            <td>Venus</td>
        </tr>
        <tr>
            <td>7</td>
            <td>O, Z</td>
            <td>Ketu</td>
        </tr>
        <tr>
            <td>8</td>
            <td>F, P</td>
            <td>Saturn</td>
        </tr>
    </tbody>
</table>

<h4>Should you change your name spelling?</h4>
<p>Many successful individuals, from Bollywood celebrities to top business tycoons, have altered their name spellings to align with a luckier numerology vibration. If your current Name Number clashes with your Birth Number, you might face unnecessary hurdles in career and relationships. Our expert numerologists can suggest minor spelling adjustments to unlock maximum fortune.</p>
EOT,

            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $faqs = [
            ['What is the name number in astrology?', 'Your name gives three numbers. The Destiny Number shows the path your life tends to follow, the Personality Number shows how others see you, and the Soul Urge Number shows what you want at heart. Together they are called your name numbers.'],
            ['Which number is good in name numerology?', 'Numbers 1, 3, 5 and 6 are widely regarded as fortunate name numbers. Still, a number is only good for you if it is friendly with your Birth Number, so always check the two together.'],
            ['What is the best number in name numerology?', 'There is no single best number for everyone. 5, ruled by Mercury, is often called the most adaptable because it gets along with many Birth Numbers, but the right number for you is the one that suits your own date of birth.'],
            ['How do I check my name numerology?', 'Enter your name in the calculator above to get your Destiny Number. Then reduce your date of birth to one digit to get your Birth Number and compare the two using the table on this page.'],
            ['Which numerology system is more accurate?', 'Both are respected. Chaldean is older and is preferred for name correction, while Pythagorean is simpler and more common in the West. Trying both gives you a fuller picture.'],
            ['Is this name numerology calculator free?', 'Yes. You can check as many names as you like, in both systems, without paying or signing up.'],
        ];

        DB::table('numerology_calculator_faqs')->insert(array_map(fn ($faq) => [
            'question'   => $faq[0],
            'answer'     => '<p>' . e($faq[1]) . '</p>',
            'is_active'  => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ], $faqs));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('numerology_calculator_faqs');
        Schema::dropIfExists('numerology_calculator_contents');
    }
};
