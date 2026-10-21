@extends('frontend.layouts.master')
@section('title', 'Planets, Signs and Their Significance in Astrology | AstroHero')
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
            <span class="active">PLANETS, SIGNS AND THEIR SIGNIFICANCE</span>
        </nav>

        <!-- Guide Header -->
        <header class="fk-guide-header">
            <h1>Planets, Signs and Their <span class="gold-title">Significance</span></h1>
        </header>

        <!-- Main Editorial Content -->
        <article class="fk-guide-body">
            <p>Every element in the cosmos resonates with specific archetypal vibrations. In Vedic astrology, the <strong>12 Zodiac Signs (Rashis)</strong> and the <strong>9 Grahas (Planets)</strong> serve as an alphabet of human destiny, psychology, health, and soul karma. Understanding their exact significations (<em>Karakatvas</em>) unlocks the ability to decode any horoscope with profound clarity.</p>

            <h2>The 12 Zodiac Signs &amp; Their Cosmic Significations</h2>
            <p>The twelve Rashis represent the stages of human consciousness and physical manifestation. Each sign possesses distinct planetary lordship, elemental composition, and behavioral traits:</p>

            <div class="kd-table-responsive" style="margin-bottom: 24px;">
                <table class="kd-table">
                    <thead>
                        <tr>
                            <th>Sign (Rashi)</th>
                            <th>Lord</th>
                            <th>Symbol</th>
                            <th>Element &amp; Quality</th>
                            <th>Significations &amp; Body Parts</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Aries (Mesha)</strong></td>
                            <td>Mars</td>
                            <td>The Ram</td>
                            <td>Fire · Movable</td>
                            <td>Initiative, courage, independence, competitive instinct · Head, brain, cranium</td>
                        </tr>
                        <tr>
                            <td><strong>Taurus (Vrishabha)</strong></td>
                            <td>Venus</td>
                            <td>The Bull</td>
                            <td>Earth · Fixed</td>
                            <td>Wealth preservation, stability, sensuality, vocal arts · Face, throat, neck</td>
                        </tr>
                        <tr>
                            <td><strong>Gemini (Mithuna)</strong></td>
                            <td>Mercury</td>
                            <td>The Twins</td>
                            <td>Air · Dual</td>
                            <td>Communication, writing, versatility, intellectual networking · Shoulders, arms, hands</td>
                        </tr>
                        <tr>
                            <td><strong>Cancer (Karka)</strong></td>
                            <td>Moon</td>
                            <td>The Crab</td>
                            <td>Water · Movable</td>
                            <td>Maternal care, emotional depth, intuition, home loyalty · Chest, lungs, breasts</td>
                        </tr>
                        <tr>
                            <td><strong>Leo (Simha)</strong></td>
                            <td>Sun</td>
                            <td>The Lion</td>
                            <td>Fire · Fixed</td>
                            <td>Regal authority, nobility, creative expression, magnanimity · Heart, upper spine</td>
                        </tr>
                        <tr>
                            <td><strong>Virgo (Kanya)</strong></td>
                            <td>Mercury</td>
                            <td>The Maiden</td>
                            <td>Earth · Dual</td>
                            <td>Analytical rigor, healing, meticulous organization, service · Abdomen, digestive system</td>
                        </tr>
                        <tr>
                            <td><strong>Libra (Tula)</strong></td>
                            <td>Venus</td>
                            <td>The Balance</td>
                            <td>Air · Movable</td>
                            <td>Harmony, justice, trade diplomacy, partnership, elegance · Kidneys, lower back</td>
                        </tr>
                        <tr>
                            <td><strong>Scorpio (Vrishchika)</strong></td>
                            <td>Mars / Ketu</td>
                            <td>The Scorpion</td>
                            <td>Water · Fixed</td>
                            <td>Karmic regeneration, occult mystery, intensity, research · Reproductive organs, pelvis</td>
                        </tr>
                        <tr>
                            <td><strong>Sagittarius (Dhanu)</strong></td>
                            <td>Jupiter</td>
                            <td>The Archer</td>
                            <td>Fire · Dual</td>
                            <td>Spiritual philosophy, moral ethics, long journeys, truth · Hips, thighs, arterial system</td>
                        </tr>
                        <tr>
                            <td><strong>Capricorn (Makara)</strong></td>
                            <td>Saturn</td>
                            <td>The Sea-Goat</td>
                            <td>Earth · Movable</td>
                            <td>Patience, administrative status, executive discipline · Knees, skeleton, joints</td>
                        </tr>
                        <tr>
                            <td><strong>Aquarius (Kumbha)</strong></td>
                            <td>Saturn / Rahu</td>
                            <td>Water Bearer</td>
                            <td>Air · Fixed</td>
                            <td>Universal brotherhood, technological innovation, reform · Calves, ankles, circulatory</td>
                        </tr>
                        <tr>
                            <td><strong>Pisces (Meena)</strong></td>
                            <td>Jupiter</td>
                            <td>The Two Fishes</td>
                            <td>Water · Dual</td>
                            <td>Spiritual surrender, divine compassion, cosmic imagination · Feet, toes, lymphatic system</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2>The Navagrahas &amp; Their Deep Karmic Roles</h2>
            <p>In Vedic astrology, planetary forces govern specific physical organs, relational figures, and emotional drives:</p>

            <h3>1. The Sun (Surya) — The Royal Soul (Atma Karaka)</h3>
            <p>The Sun is the source of all life and consciousness. It signifies the father, governmental authority, self-respect, immune vitality, and public stature. A well-placed Sun gives natural leadership, while an afflicted Sun breeds arrogance or cardiac and eye complaints.</p>

            <h3>2. The Moon (Chandra) — The Receptive Mind (Mana Karaka)</h3>
            <p>The Moon represents the mother, memory, mental equilibrium, emotional contentment, and bodily fluids. A luminous waxing Moon provides immense psychological peace, maternal warmth, and intuitive genius.</p>

            <h3>3. Mars (Mangal) — The Victorious Commander (Bhratri Karaka)</h3>
            <p>Mars governs biological stamina, ambition, defense forces, surgical aptitude, and property ownership. It drives human courage. Balanced Mars confers executive boldness; afflicted Mars triggers haste, aggression, or accidental injuries.</p>

            <h3>4. Mercury (Budh) — The Prince of Intellect (Budhi Karaka)</h3>
            <p>Mercury presides over analytical reasoning, commercial trading, computational mathematics, linguistic mastery, and wit. As the neutral messenger, Mercury adapts quickly to the nature of the planets it conjoins.</p>

            <h3>5. Jupiter (Guru / Brihaspati) — The Great Benefactor (Jnana Karaka)</h3>
            <p>Jupiter signifies divine grace, sacred wisdom, progeny (children), accumulated wealth, teachers, and law. Jupiter's aspect on any difficult house neutralizes up to 75% of negative karmic suffering.</p>

            <h3>6. Venus (Shukra) — The Harmonizer (Kalatra Karaka)</h3>
            <p>Venus represents the spouse, aesthetic beauty, diplomacy, vehicles, romantic bliss, and the reproductive essence (Shukra Dhatu). It refines desires and attracts material comfort.</p>

            <h3>7. Saturn (Shani) — The Karmic Taskmaster (Ayush Karaka)</h3>
            <p>Saturn is the divine arbiter of justice, time (Kala), and longevity. It demands accountability, discipline, humility, and steady persistence. A benevolent Saturn delivers permanent worldly heights and lasting detachment.</p>

            <h3>8. Rahu &amp; Ketu — The Karmic Axes</h3>
            <p>Rahu (North Node) acts as the accelerator of worldly ambition, foreign migration, and innovative breakthroughs. Ketu (South Node) acts as the brake, inspiring detachment, spiritual enlightenment (Moksha), and esoteric wisdom.</p>

            <h2>Planetary Friendships &amp; Enmities (Graha Maitri)</h2>
            <p>Planets interact with one another according to natural friendships (Naisargika Sambandha):</p>
            <ul>
                <li><strong>The Divine Camp:</strong> Sun, Moon, Mars, and Jupiter are natural allies. They share a common spiritual, ethical, and dharmic wavelength.</li>
                <li><strong>The Material / Intellectual Camp:</strong> Mercury, Venus, and Saturn are close friends, sharing practical, artistic, and organizational harmony.</li>
                <li><strong>The Great Neutral:</strong> Mercury considers Jupiter neutral; Saturn considers Mercury a trusted ally.</li>
            </ul>

            <!-- Master Vedic Astrology Guides (5 Guides) -->
            <div class="fk-tags-section">
                <div class="fk-tags-cat-title">MASTER VEDIC ASTROLOGY GUIDES (5 CHAPTERS)</div>
                <div class="fk-tags-wrap" style="margin-bottom: 20px;">
                    <a href="{{ route('guide.read-kundli') }}" class="fk-tag-pill">How to Read Kundli Online <span class="fk-pill-arrow">→</span></a>
                    <a href="{{ route('guide.read-houses') }}" class="fk-tag-pill">How to Read Houses in Kundli <span class="fk-pill-arrow">→</span></a>
                    <a href="{{ route('guide.read-planets') }}" class="fk-tag-pill">How to Read Planets in Astrology <span class="fk-pill-arrow">→</span></a>
                    <a href="{{ route('guide.planets-signs-houses') }}" class="fk-tag-pill">Planets, Signs &amp; Houses in Astrology <span class="fk-pill-arrow">→</span></a>
                    <a href="{{ route('guide.planets-signs-significance') }}" class="fk-tag-pill active" style="background: rgba(227, 181, 104, 0.3); border-color: #e3b568; color: #fff;">Planets, Signs and Their Significance <span class="fk-pill-arrow">→</span></a>
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
                        <span>How do sign significations affect my health?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>In Medical Astrology (Ayur Jyotish), the twelve signs from Aries to Pisces map anatomically to the human body from head to toe. For example, Gemini rules the respiratory tracts and shoulders, while Virgo rules the intestines and digestive tract. Afflictions in these signs signal vulnerable areas.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-question">
                        <span>What is the difference between a natural benefic and a functional benefic?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>A natural benefic (like Jupiter or Venus) has an inherent peaceful nature. However, a functional benefic is determined specifically by your rising Lagna. For example, for a Taurus Ascendant, Saturn becomes a functional benefic (Yogakaraka) because it rules both a Kendra (10th) and a Trikona (9th) house.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-question">
                        <span>Can an enemy planet produce favorable outcomes?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>Yes. If an enemy planet occupies an Upachaya house (3rd, 6th, 10th, or 11th) or receives positive aspects from benefics like Jupiter, it channels its aggressive or frictional energy into extraordinary competitive triumph and resilience.</p>
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
