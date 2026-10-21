@extends('frontend.layouts.master')
@section('title', 'Planets, Signs & Houses in Astrology — The Cosmic Interplay | AstroHero')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/freekundli.css') }}?v={{ time() }}">

<main class="fk-guide-page">
    <div class="fk-guide-container">
        <!-- Breadcrumbs -->
        <nav class="fk-guide-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">HOME</a>
            <span class="sep">&gt;</span>
            <a href="{{ route('free-kundli') }}">FREE KUNDLI</a>
            <span class="sep">&gt;</span>
            <span class="active">PLANETS, SIGNS &amp; HOUSES IN ASTROLOGY</span>
        </nav>

        <!-- Guide Header -->
        <header class="fk-guide-header">
            <h1>Planets, Signs &amp; Houses in <span class="gold-title">Astrology</span></h1>
        </header>

        <!-- Main Editorial Content -->
        <article class="fk-guide-body">
            <p>Vedic astrology operates on a sublime celestial trinity: <strong>Planets (Grahas)</strong>, <strong>Zodiac Signs (Rashis)</strong>, and <strong>Houses (Bhavas)</strong>. Every prediction, personality reading, and life milestone in your Janam Kundli is born from the intricate interplay among these three foundational elements.</p>

            <p>To grasp this relationship intuitively, classical Vedic masters use a theatrical metaphor:</p>
            <ul>
                <li><strong>The Planet is the Actor:</strong> It represents the <em>source of energy</em> and <em>intent</em>. Mars acts with courage and aggression; Venus acts with romance and harmony; Jupiter acts with wisdom and expansion.</li>
                <li><strong>The Sign is the Costume &amp; Role:</strong> It represents the <em>style, mood, and temperament</em> through which the planet expresses its nature. An actor behaves differently in the role of a fiery warrior (Aries) than in the role of a sensitive nurturer (Cancer).</li>
                <li><strong>The House is the Stage / Arena:</strong> It represents the <em>physical department of life</em> where the drama unfolds. The 10th house is the professional workplace; the 7th house is the marriage alter; the 2nd house is the financial treasury.</li>
            </ul>

            <h2>1. The Planets (Grahas) — The Cosmic Energetic Drivers</h2>
            <p>The nine planets of Vedic astrology (Navagrahas) are not inert physical spheres; they are conscious distributaries of human karma. Each planet possesses intrinsic significations (Karakatvas):</p>
            <ul>
                <li><strong>Sun (Surya):</strong> Soul consciousness, leadership, father, vitality, self-esteem, government favor.</li>
                <li><strong>Moon (Chandra):</strong> Mind, emotional fluctuations, mother, subconscious memory, mental peace.</li>
                <li><strong>Mars (Mangal):</strong> Physical stamina, courage, real estate, engineering, brotherly bonds.</li>
                <li><strong>Mercury (Budh):</strong> Analytical intellect, commerce, verbal speech, diplomacy, calculation.</li>
                <li><strong>Jupiter (Guru):</strong> Higher wisdom, spiritual dharma, children, wealth accumulation, divine luck.</li>
                <li><strong>Venus (Shukra):</strong> Aesthetic refinement, romantic love, marital bliss, fine arts, luxuries.</li>
                <li><strong>Saturn (Shani):</strong> Discipline, karmic delays, perseverance, hard labor, detachment, justice.</li>
                <li><strong>Rahu:</strong> Intense worldly desires, innovation, foreign connections, obsession, sudden rise.</li>
                <li><strong>Ketu:</strong> Spiritual emancipation (Moksha), detachment, occult research, past-life expertise.</li>
            </ul>

            <h2>2. The Zodiac Signs (Rashis) — The Energetic Temperament</h2>
            <p>The 360-degree zodiac belt is segmented into 12 equal divisions of 30 degrees, each possessing a distinct elemental triplicity and operational modality:</p>
            <div class="kd-table-responsive" style="margin-bottom: 24px;">
                <table class="kd-table">
                    <thead>
                        <tr>
                            <th>Sign (Rashi)</th>
                            <th>Element (Tatva)</th>
                            <th>Modality (Guna)</th>
                            <th>Ruling Planet</th>
                            <th>Core Expression</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Aries (Mesha)</strong></td>
                            <td>Fire</td>
                            <td>Movable (Chara)</td>
                            <td>Mars</td>
                            <td>Pioneering, bold, impulsive, competitive</td>
                        </tr>
                        <tr>
                            <td><strong>Taurus (Vrishabha)</strong></td>
                            <td>Earth</td>
                            <td>Fixed (Sthira)</td>
                            <td>Venus</td>
                            <td>Steadfast, patient, sensual, material builder</td>
                        </tr>
                        <tr>
                            <td><strong>Gemini (Mithuna)</strong></td>
                            <td>Air</td>
                            <td>Dual (Dwisvabhava)</td>
                            <td>Mercury</td>
                            <td>Curious, communicative, versatile, intellectual</td>
                        </tr>
                        <tr>
                            <td><strong>Cancer (Karka)</strong></td>
                            <td>Water</td>
                            <td>Movable (Chara)</td>
                            <td>Moon</td>
                            <td>Nurturing, intuitive, protective, emotionally deep</td>
                        </tr>
                        <tr>
                            <td><strong>Leo (Simha)</strong></td>
                            <td>Fire</td>
                            <td>Fixed (Sthira)</td>
                            <td>Sun</td>
                            <td>Regal, magnanimous, confident, charismatic</td>
                        </tr>
                        <tr>
                            <td><strong>Virgo (Kanya)</strong></td>
                            <td>Earth</td>
                            <td>Dual (Dwisvabhava)</td>
                            <td>Mercury</td>
                            <td>Methodical, analytical, detail-oriented, service-minded</td>
                        </tr>
                        <tr>
                            <td><strong>Libra (Tula)</strong></td>
                            <td>Air</td>
                            <td>Movable (Chara)</td>
                            <td>Venus</td>
                            <td>Diplomatic, harmonious, equitable, aesthetic</td>
                        </tr>
                        <tr>
                            <td><strong>Scorpio (Vrishchika)</strong></td>
                            <td>Water</td>
                            <td>Fixed (Sthira)</td>
                            <td>Mars / Ketu</td>
                            <td>Intense, transformative, secretive, investigative</td>
                        </tr>
                        <tr>
                            <td><strong>Sagittarius (Dhanu)</strong></td>
                            <td>Fire</td>
                            <td>Dual (Dwisvabhava)</td>
                            <td>Jupiter</td>
                            <td>Philosophical, adventurous, optimistic, truth-seeking</td>
                        </tr>
                        <tr>
                            <td><strong>Capricorn (Makara)</strong></td>
                            <td>Earth</td>
                            <td>Movable (Chara)</td>
                            <td>Saturn</td>
                            <td>Ambitious, disciplined, pragmatic, status-conscious</td>
                        </tr>
                        <tr>
                            <td><strong>Aquarius (Kumbha)</strong></td>
                            <td>Air</td>
                            <td>Fixed (Sthira)</td>
                            <td>Saturn / Rahu</td>
                            <td>Humanitarian, visionary, unconventional, networking</td>
                        </tr>
                        <tr>
                            <td><strong>Pisces (Meena)</strong></td>
                            <td>Water</td>
                            <td>Dual (Dwisvabhava)</td>
                            <td>Jupiter</td>
                            <td>Compassionate, mystical, imaginative, surrender</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2>3. The Houses (Bhavas) — The Earthly Arenas</h2>
            <p>The houses establish where celestial energy touches ground. While the signs continuously rotate, the houses are fixed relative to your local horizon:</p>
            <ul>
                <li><strong>1st House (Lagna):</strong> The personal self, physical health, aura, and outlook.</li>
                <li><strong>2nd House (Dhana):</strong> Liquid wealth, savings, speech, family lineage.</li>
                <li><strong>3rd House (Sahaja):</strong> Courage, communication, younger siblings, short trips.</li>
                <li><strong>4th House (Sukha):</strong> Mother, home, inner peace, real estate, vehicles.</li>
                <li><strong>5th House (Putra):</strong> Intelligence, children, romance, past-life merits (Purva Punya).</li>
                <li><strong>6th House (Ari):</strong> Daily service, debts, diseases, enemies, competition.</li>
                <li><strong>7th House (Yuvati):</strong> Marriage partner, contracts, business alliances, public dealings.</li>
                <li><strong>8th House (Randhra):</strong> Longevity, sudden upheavals, hidden knowledge, transformations.</li>
                <li><strong>9th House (Dharma):</strong> Higher wisdom, guru, fortune, spirituality, pilgrimage.</li>
                <li><strong>10th House (Karma):</strong> Profession, career status, authority, public acclaim.</li>
                <li><strong>11th House (Labha):</strong> Gains, income streams, long-term ambitions, friends.</li>
                <li><strong>12th House (Vyaya):</strong> Spiritual liberation (Moksha), foreign travels, expenditures, solitude.</li>
            </ul>

            <h2>Synthesizing the Holy Trinity: Real-Life Interpretation Examples</h2>
            <p>To master Kundli reading, observe how altering any one of the three components changes the manifestation completely:</p>

            <div class="kd-card" style="margin-bottom: 20px; background: rgba(0,0,0,0.25);">
                <h3 style="color: #e3b568; margin-top: 0;">Example A: Mars in Aries in the 10th House</h3>
                <p><strong>Planet:</strong> Mars (Action, Command, Courage)<br>
                <strong>Sign:</strong> Aries (Own Sign, Fire, Movable — pioneering, fearless)<br>
                <strong>House:</strong> 10th House (Career, Authority, Government)<br>
                <strong>Synthesis:</strong> Here Mars gains <em>Digbala</em> (directional strength in the 10th house) and forms the majestic <strong>Ruchaka Yoga</strong>. The native emerges as a commanding leader—such as a military general, premier surgeon, top police official, or decisive corporate CEO.</p>
            </div>

            <div class="kd-card" style="margin-bottom: 20px; background: rgba(0,0,0,0.25);">
                <h3 style="color: #e3b568; margin-top: 0;">Example B: Mars in Cancer in the 4th House</h3>
                <p><strong>Planet:</strong> Mars (Fiery drive, assertiveness)<br>
                <strong>Sign:</strong> Cancer (Debilitated Sign, Water — emotional, sensitive, defensive)<br>
                <strong>House:</strong> 4th House (Domestic peace, home, mother)<br>
                <strong>Synthesis:</strong> The fiery warrior planet feels smothered in the watery, sentimental sign of Cancer. Placed in the domestic 4th house, it creates Manglik Dosha, domestic friction, or property disputes unless counterbalanced by strong Jupiter aspects or Neecha Bhanga.</p>
            </div>

            <!-- Master Vedic Astrology Guides (5 Guides) -->
            <div class="fk-tags-section">
                <div class="fk-tags-cat-title">MASTER VEDIC ASTROLOGY GUIDES (5 CHAPTERS)</div>
                <div class="fk-tags-wrap" style="margin-bottom: 20px;">
                    <a href="{{ route('guide.read-kundli') }}" class="fk-tag-pill">How to Read Kundli Online <span class="fk-pill-arrow">→</span></a>
                    <a href="{{ route('guide.read-houses') }}" class="fk-tag-pill">How to Read Houses in Kundli <span class="fk-pill-arrow">→</span></a>
                    <a href="{{ route('guide.read-planets') }}" class="fk-tag-pill">How to Read Planets in Astrology <span class="fk-pill-arrow">→</span></a>
                    <a href="{{ route('guide.planets-signs-houses') }}" class="fk-tag-pill active" style="background: rgba(227, 181, 104, 0.3); border-color: #e3b568; color: #fff;">Planets, Signs &amp; Houses in Astrology <span class="fk-pill-arrow">→</span></a>
                    <a href="{{ route('guide.planets-signs-significance') }}" class="fk-tag-pill">Planets, Signs and Their Significance <span class="fk-pill-arrow">→</span></a>
                </div>

                <div class="fk-tags-cat-title">FREE ASTROLOGY CALCULATORS</div>
                <div class="fk-tags-wrap">
                    <a href="{{ route('free-kundli') }}" class="fk-tag-pill">📜 Free Janam Kundli</a>
                    <a href="{{ route('kundli-matching') }}" class="fk-tag-pill">💞 Kundli Matching</a>
                    <a href="{{ route('compatibility') }}" class="fk-tag-pill">♊ Compatibility</a>
                    <a href="{{ route('tarot') }}" class="fk-tag-pill">🔮 Tarot Reading</a>
                    <a href="{{ route('love-calculator') }}" class="fk-tag-pill">❤️ Love Calculator</a>
                    <a href="{{ route('mangal-dosha-calculator') }}" class="fk-tag-pill">🔥 Mangal Dosha</a>
                    <a href="{{ route('shani-sade-sati-calculator') }}" class="fk-tag-pill">🪐 Shani Sade Sati</a>
                    <a href="{{ route('kaal-sarp-dosh-calculator') }}" class="fk-tag-pill">🐍 Kaal Sarp Dosh</a>
                    <a href="{{ route('dasha-calculator') }}" class="fk-tag-pill">⏳ Dasha Calculator</a>
                    <a href="{{ route('birth-chart-calculator') }}" class="fk-tag-pill">🗺️ Birth Chart</a>
                </div>
            </div>

            <!-- Call to Action Box -->
            <div class="fk-guide-cta-box">
                <a href="{{ route('free-kundli') }}" class="fk-btn-gold-action">Generate Free Kundli →</a>
            </div>

            <!-- FAQs Section -->
            <h2>Frequently Asked Questions</h2>
            <div class="faq-list">
                <div class="faq-item">
                    <button type="button" class="faq-question">
                        <span>Which is more important: the Planet, the Sign, or the House?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>All three are interdependent and cannot be read in isolation. The Planet provides the motive force; the Sign determines its quality and strength (exalted, debilitated, comfortable); and the House dictates which practical department of life experiences the outcome.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-question">
                        <span>What is Dispositor theory in Vedic astrology?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>The dispositor is the planetary ruler of the zodiac sign a given planet sits in. For example, if Jupiter sits in Aries, Mars is its dispositor. If Mars is strongly placed in the chart, Jupiter gains extraordinary strength and can deliver magnificent results.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-question">
                        <span>Can an exalted planet in a bad house give good results?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>Yes. If an exalted planet sits in a Dusthana house (6th, 8th, or 12th), it elevates the positive potentials of that difficult house while protecting the native from catastrophe. For instance, exalted Venus in the 12th house fosters divine spiritual surrender and overseas affluence.</p>
                    </div>
                </div>
            </div>
        </article>
    </div>
</main>

<script>
    document.querySelectorAll('.faq-question').forEach(button => {
        button.addEventListener('click', () => {
            const item = button.parentElement;
            const isOpen = item.classList.contains('active');

            document.querySelectorAll('.faq-item').forEach(otherItem => {
                otherItem.classList.remove('active');
                const icon = otherItem.querySelector('.faq-icon');
                if (icon) icon.textContent = '+';
            });

            if (!isOpen) {
                item.classList.add('active');
                const icon = item.querySelector('.faq-icon');
                if (icon) icon.textContent = '−';
            }
        });
    });
</script>

@endsection
