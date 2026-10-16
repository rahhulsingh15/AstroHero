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
        Schema::create('mangal_dosha_calculator_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('description')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });

        Schema::create('mangal_dosha_report_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('description')->nullable();
            $table->longText('main_content')->nullable();
            $table->longText('faq_content')->nullable();
            $table->timestamps();
        });

        // Default content for Mangal Dosha Calculator Page
        DB::table('mangal_dosha_calculator_contents')->insert([
            'heading' => 'Mangal Dosha Calculator – Check Manglik Dosh Online',
            'description' => "Mangal Dosha could be the hidden reason behind your delayed or troubled marriage. Find out instantly with our free Mangal Dosha Calculator. Just enter your birth details and discover the intensity of Mars dosha in your kundali, so you can take corrective action before it's too late.",
            'main_content' => <<<'EOT'
<div class="container ras-content-wrapper">
    <h3>What is Mangal Dosha?</h3>
    <p>Mangal Dosha, also known as Kuja Dosha or Bhom Dosha, occurs when Mars (Mangal) is placed in the 1st, 2nd, 4th, 7th, 8th, or 12th house of a person's Kundli. This planetary alignment is believed to bring challenges in marital harmony and relationships.</p>

    <h3>Impact of Mangal Dosha</h3>
    <div class="signs-list">
        <div class="sign-item">
            <h4><span class="sign-icon">❤️</span> Delayed Marriage</h4>
            <p>One of the most common effects of Mangal Dosha is a delay in marriage. It is believed to create obstacles in finding the right partner.</p>
        </div>
        <div class="sign-item">
            <h4><span class="sign-icon">⚔️</span> Marital Discord</h4>
            <p>Mars is a fiery planet, representing aggression. Its influence can cause misunderstandings, arguments, and tension between partners.</p>
        </div>
        <div class="sign-item">
            <h4><span class="sign-icon">💼</span> Professional Challenges</h4>
            <p>In some cases, Manglik individuals may face hurdles in their career or financial stability, though Mars can also give immense energy to overcome them.</p>
        </div>
        <div class="sign-item">
            <h4><span class="sign-icon">🛡️</span> Remedies and Solutions</h4>
            <p>Various remedies like Kumbh Vivah, chanting Mangal mantras, and wearing specific gemstones can help nullify the negative effects.</p>
        </div>
    </div>

    <h3 style="margin-top: 40px;">Conclusion</h3>
    <p>While Mangal Dosha can seem daunting, it is a very common placement. Understanding its presence in your chart is the first step towards mitigating its effects and leading a harmonious life. Consulting an expert astrologer can provide personalized remedies.</p>

    <div class="discover-more">
        <h3>Explore More Astrology Tools</h3>
        <div class="calc-cards">
            <div class="calc-card">
                <span class="c-icon">⏱️</span>
                <h4>Dasha Calculator</h4>
                <p>Find your Mahadasha</p>
            </div>
            <div class="calc-card">
                <span class="c-icon">📜</span>
                <h4>Free Kundli (Birth Chart)</h4>
                <p>Detailed astrological profile</p>
            </div>
            <div class="calc-card">
                <span class="c-icon">🪐</span>
                <h4>Sade Sati Calculator</h4>
                <p>Check Saturn's impact</p>
            </div>
            <div class="calc-card">
                <span class="c-icon">💞</span>
                <h4>Kundli Matching</h4>
                <p>Check marriage compatibility</p>
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
                <span>What is a Manglik?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>A Manglik is a person whose Kundli has Mars placed in the 1st, 2nd, 4th, 7th, 8th, or 12th house, creating Mangal Dosha. This position of Mars can affect marriage and relationships.</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Can a Manglik marry a Non-Manglik?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Yes, a Manglik can marry a non-Manglik if certain astrological remedies are performed or if there are specific planetary cancellations (Dosha Parihara) in their respective birth charts.</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>At what age does Mangal Dosha end?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Astrologically, it is believed that the intensity of Mangal Dosha reduces significantly after the age of 28, bringing more maturity and stability to the individual.</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>What happens if Mangal is in the 7th house?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>The 7th house governs marriage. Mars placed here can cause high expectations, ego clashes, and potential discord if not properly matched with a compatible partner or remedied.</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>How can I cancel Mangal Dosha?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Mangal Dosha can be canceled or its effects reduced through specific remedies like Kumbh Vivah, fasting on Tuesdays, chanting the Hanuman Chalisa, or matching charts correctly.</p>
            </div>
        </div>
    </div>
</div>
EOT,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Default content for Mangal Dosha Report Page
        DB::table('mangal_dosha_report_contents')->insert([
            'heading' => "{name}'s Mangal Dosha Analysis",
            'description' => null,
            'main_content' => <<<'EOT'
<h2>What Does Manglik Dosha Mean?</h2>
<p>Manglik dosha is when Mars is placed in the 1st, 2nd, 4th, 7th, 8th, or 12th house from the ascendant, moon, and Venus chart. As Mars represents drive, passion, energy, and aggression, its placement in these houses in a Kundli (birth chart) can profoundly affect marital life, professional life, and physical endurance. Mars is known to naturally bring a fiery or aggressive aura.</p>
<p>High Manglik (Purna Manglik Dosha) is formed when Mars is placed in any of these houses from the Ascendant (Lagna) and the Moon chart. Double Manglik Dosha is when Mars is in the 1st, 2nd, 4th, 7th, 8th, or 12th house in both the ascendant and the Moon chart.</p>

<h2>What Are the Effects of Mangal in Different Houses?</h2>
<p>The effects of Manglik Dosha in every house are different. Analyze Mars placement by using our Mangal Dosha calculator. First, let's look at the houses where Mars is placed and see how it works out for the native if you are finding it in your chart.</p>

<div class="houses-grid">
    <div class="house-card">
        <h4>Mangal in 1st House</h4>
        <p>Aggressive nature, dominating behaviour, and ego clashes in relationships.</p>
    </div>
    <div class="house-card">
        <h4>Mangal in 2nd House</h4>
        <p>Family disputes, harsh speech, and potential financial turbulence.</p>
    </div>
    <div class="house-card">
        <h4>Mangal in 4th House</h4>
        <p>Lack of mental peace, domestic instability, and career issues.</p>
    </div>
    <div class="house-card">
        <h4>Mangal in 7th House</h4>
        <p>Marriage delays, high friction with partners, and severe compatibility issues.</p>
    </div>
    <div class="house-card">
        <h4>Mangal in 8th House</h4>
        <p>Financial hurdles, health issues, and potential delays in career paths.</p>
    </div>
    <div class="house-card">
        <h4>Mangal in 12th House</h4>
        <p>Hidden enemies, sudden financial losses, and disrupted peace of mind.</p>
    </div>
</div>

<h3>Manglik Dosha Remedies</h3>
<p>Due to the effects of Mars, it can instigate Manglik Dosha inside you. To lessen the intensity of the dosha, especially for double Manglik or partial Manglik, you should perform certain astrological remedies based on whether you are male or female.</p>

<h4>Remedies for Male</h4>
<ul>
    <li>Wearing red coral (Moonga) in a copper or gold ring on the ring finger.</li>
    <li>Fasting on Tuesdays and donating blood to reduce aggressive energy.</li>
    <li>Worshiping Lord Hanuman and reciting the Hanuman Chalisa daily.</li>
</ul>

<h4>Remedies for Female</h4>
<ul>
    <li>Kumbh Vivah (a symbolic marriage ritual with a clay pot) before actual marriage.</li>
    <li>Donating red clothes and masoor dal (red lentils) on Tuesdays.</li>
    <li>Regular chanting of the Mangal Gayatri Mantra or Navagraha Stotra.</li>
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
                <span>How do I know my Mangal Dosha?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>To check Manglik Dosha, you need to calculate the position of Mars in the 1st, 2nd, 4th, 7th, 8th, or 12th house from the Ascendant chart or Moon chart. You can use our free Mangal Dosha Calculator for an accurate result.</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Which god can control Mangal?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Lord Hanuman is considered the ruling deity for Mars. Worshipping Lord Hanuman regularly and reciting the Hanuman Chalisa helps mitigate the negative effects of Mangal.</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>Which dosha is bad for marriage?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Mangal Dosha is highly significant for marriage compatibility. A severe mismatch between a Manglik and a Non-Manglik can lead to disputes and marital discord, which is why matching Kundlis is crucial.</p>
            </div>
        </div>

        <div class="acord-item">
            <button class="acord-btn" type="button">
                <span>In which house is Mars bad for marriage?</span>
                <div class="acord-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </button>
            <div class="acord-content">
                <p>Mars placed in the 7th House (house of marriage) and the 8th House (house of longevity and sudden events) are generally considered the most challenging for marital harmony.</p>
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
        Schema::dropIfExists('mangal_dosha_report_contents');
        Schema::dropIfExists('mangal_dosha_calculator_contents');
    }
};
