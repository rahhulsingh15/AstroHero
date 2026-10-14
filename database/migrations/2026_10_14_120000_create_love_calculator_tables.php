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
        // Love calculator + love report page ka content (ek hi row)
        Schema::create('love_calculator_contents', function (Blueprint $table) {
            $table->id();

            // Calculator page
            $table->string('meta_title')->nullable();
            $table->string('breadcrumb_label')->nullable();
            $table->string('hero_title')->nullable();
            $table->string('hero_highlight')->nullable();
            $table->text('hero_intro')->nullable();
            $table->text('hero_more')->nullable();
            $table->string('form_title')->nullable();
            $table->string('form_highlight')->nullable();
            $table->longText('main_content')->nullable();   // Jodit
            $table->string('bands_title')->nullable();
            $table->longText('extra_content')->nullable();  // Jodit
            $table->string('tools_title')->nullable();
            $table->string('faq_subtitle')->nullable();
            $table->string('faq_title')->nullable();

            // Report page
            $table->string('report_meta_title')->nullable();
            $table->string('report_banner_tag')->nullable();
            $table->string('report_banner_title')->nullable();
            $table->text('report_banner_text')->nullable();
            $table->string('report_banner_button')->nullable();
            $table->string('report_experts_title')->nullable();

            $table->timestamps();
        });

        // Love % ke 4 hisse (80+, 60+, 40+, 0+): calculator page ke cards aur report page ka result text
        Schema::create('love_calculator_bands', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('min_percent')->unique();
            $table->string('range_label');
            $table->string('title');
            $table->text('card_text')->nullable();
            $table->text('report_text')->nullable();
            $table->timestamps();
        });

        // "Other Compatibility Tools" cards
        Schema::create('love_calculator_tools', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('link')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });

        Schema::create('love_calculator_faqs', function (Blueprint $table) {
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

        DB::table('love_calculator_contents')->insert([
            'meta_title'       => 'Love Calculator by Name | Love Compatibility Test',
            'breadcrumb_label' => 'LOVE CALCULATOR',
            'hero_title'       => 'Love Calculator',
            'hero_highlight'   => 'by Name',
            'hero_intro'       => "Ever wondered whether your current partner truly loves you, or if it's all in your head? Has someone new sparked your interest, but you are unsure if they are the right match for you? If yes, the Love Calculator by Name might just be the right tool for you",
            'hero_more'        => "Simply enter your name and your partner's name below to get a detailed love percentage and uncover the hidden dynamics of your relationship based on numerology!",
            'form_title'       => 'Check Your Love',
            'form_highlight'   => 'Compatibility',
            'main_content'     => '<h3>What is a Love Calculator?</h3>
<p>A Love Calculator is an online tool that determines the compatibility between two individuals based on their names or date of birth. It uses ancient numerology and astrological principles to give you a detailed compatibility report.</p>
<h3>How Does Love Calculator By Name Work?</h3>
<p>The name-based calculator converts your names into numbers. It checks for compatibility of both the names using principles of numerology and astrology. It makes a complex calculation to arrive at a definitive love percentage.</p>
<h3>Name-Based Calculator</h3>
<p>Calculating love compatibility by name is quite popular among the youth. According to numerology, each alphabet in your name has a particular value. Our system sums these values to compute the numeric total of your names.</p>
<p>Then the numbers from both names are analyzed using numerological rules to arrive at a percentage of love.</p>',
            'bands_title'      => 'What Does Your Love Percentage Say?',
            'extra_content'    => '<h3>Love Compatibility by Zodiac Sign</h3>
<div class="zodiac-table-wrapper"><table class="zodiac-table">
<thead><tr><th>Zodiac Elements</th><th>Compatible With</th><th>Relationship Style</th></tr></thead>
<tbody>
<tr><td><span class="z-icon">♈</span> Fire (Aries, Leo, Sagittarius)</td><td>Air &amp; Fire</td><td>Passionate, energetic, adventurous, action-oriented</td></tr>
<tr><td><span class="z-icon">♉</span> Earth (Taurus, Virgo, Capricorn)</td><td>Water &amp; Earth</td><td>Practical, stable, reliable, focused on building</td></tr>
<tr><td><span class="z-icon">♊</span> Air (Gemini, Libra, Aquarius)</td><td>Fire &amp; Air</td><td>Intellectual, communicative, social, independent</td></tr>
<tr><td><span class="z-icon">♋</span> Water (Cancer, Scorpio, Pisces)</td><td>Earth &amp; Water</td><td>Emotional, intuitive, deeply connected, sensitive</td></tr>
</tbody></table></div>
<h3>How to Use the Love Calculator</h3>
<ul class="clean-list">
<li>1. Enter your name in the first field.</li>
<li>2. Enter your partner\'s name in the second field.</li>
<li>3. Select the genders correctly.</li>
<li>4. Click on \'Calculate Love %\' to see the magic happen!</li>
</ul>
<h3>Why Use AstroHero\'s Love Calculator?</h3>
<p>We combine accurate numerological patterns with astrological insights to give you not just a number, but real guidance on your relationship. It is an advanced algorithm tested over thousands of real relationship queries.</p>
<p>If you wish to explore more, you can connect directly with our expert astrologers for an in-depth reading.</p>
<h3>Other Love Compatibility Tools</h3>
<p>We offer other specialized tools such as Kundli Matching and Tarot reading for more nuanced compatibility insights.</p>',
            'tools_title'      => 'Other Compatibility Tools',
            'faq_subtitle'     => 'FREQUENTLY ASKED',
            'faq_title'        => 'Got doubts? <span class="highlight">Find</span> your answers<br>here.',

            'report_meta_title'    => 'Love Report | Find Your Love Compatibility',
            'report_banner_tag'    => 'LIMITED-TIME OFFER',
            'report_banner_title'  => 'Have Questions About Your Score?',
            'report_banner_text'   => 'Ask our verified love astrologers anything about this calculation — what your numbers mean, where the friction lies, and what to do next. Your first conversation is free.',
            'report_banner_button' => 'Start a Free Chat →',
            'report_experts_title' => 'Talk to Love Experts',

            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('love_calculator_bands')->insert([
            [
                'min_percent' => 80, 'range_label' => '80-100%', 'title' => 'Soulmate Bond',
                'card_text'   => 'A score in this range indicates that you two share a deep connection. You are practically soulmates. It implies a high level of understanding and mutual respect.',
                'report_text' => 'You two share a deep connection and are practically soulmates. Your names point to a high level of understanding and mutual respect, so keep nurturing the trust you already have and this bond will only grow stronger.',
                'created_at'  => $now, 'updated_at' => $now,
            ],
            [
                'min_percent' => 60, 'range_label' => '60-80%', 'title' => 'A Promising Bond',
                'card_text'   => 'This percentage shows you have a promising bond that can develop into a strong relationship with a little effort and communication.',
                'report_text' => 'You have a promising bond that can develop into a strong relationship. With a little effort, open communication and time for each other, this connection has everything it needs to last.',
                'created_at'  => $now, 'updated_at' => $now,
            ],
            [
                'min_percent' => 40, 'range_label' => '40-60%', 'title' => 'A Growing Bond',
                'card_text'   => 'There is potential here, but it requires patience. Focus on building trust and spending quality time together to strengthen this bond.',
                'report_text' => 'There is real potential here, but it needs patience. Focus on building trust and spending quality time together, and you will see this bond grow steadily.',
                'created_at'  => $now, 'updated_at' => $now,
            ],
            [
                'min_percent' => 0, 'range_label' => 'Below 40%', 'title' => 'A Fainter Bond',
                'card_text'   => "A lower percentage doesn't mean it's impossible, but it does mean that making the relationship work will require significant effort and compromise.",
                'report_text' => 'A lower score does not mean it is impossible, but making this relationship work will need sincere effort and compromise from both of you. Honest conversations are the best place to start.',
                'created_at'  => $now, 'updated_at' => $now,
            ],
        ]);

        DB::table('love_calculator_tools')->insert([
            ['icon' => '💑', 'title' => 'Kundli Matching', 'description' => 'Check marriage compatibility based on stars.', 'link' => '/kundli-matching', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['icon' => '🤝', 'title' => 'Friendship Calculator', 'description' => 'Find out if you are true friends.', 'link' => '/friendship-calculator', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['icon' => '🔮', 'title' => 'Flames Calculator', 'description' => 'The classic childhood game.', 'link' => '/flames-calculator', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);

        $faqs = [
            ['Is my first astrology call session completely free?', 'Yes! As a new user on AstroHero, you get a complimentary first call session. You can connect with our premium astrologers instantly to experience our guidance without any upfront payment.'],
            ['How do I know if an astrologer is genuine?', 'Every astrologer on our platform goes through a strict 4-step verification process. We conduct thorough background checks and live panel interviews to ensure you only speak with authentic, highly qualified experts.'],
            ['Are online call consultations as effective as physical meetings?', 'Absolutely. Online call sessions offer the exact same level of accuracy as face-to-face meetings. In fact, they provide more privacy and give you the flexibility to get predictions and remedies that you can refer back to anytime.'],
            ['Will I receive specific remedies during the call?', 'Yes, our astrologers provide highly personalized and practical remedies—such as specific gemstone advice, powerful mantras, and easy daily rituals—tailored precisely to your unique birth chart.'],
            ['What details do I need to provide for a consultation?', 'For the most accurate reading, you simply need to share your exact date of birth, time of birth, and place of birth. Our experts will use these details to generate your Kundli instantly and answer your queries.'],
        ];

        DB::table('love_calculator_faqs')->insert(array_map(fn ($faq) => [
            'question'   => $faq[0],
            'answer'     => '<p>' . $faq[1] . '</p>',
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
        Schema::dropIfExists('love_calculator_faqs');
        Schema::dropIfExists('love_calculator_tools');
        Schema::dropIfExists('love_calculator_bands');
        Schema::dropIfExists('love_calculator_contents');
    }
};
