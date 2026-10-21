@extends('frontend.layouts.master')
@section('title', 'How to Read Planets in Astrology — Navagraha Dignity & Aspects | AstroHero')
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
            <span class="active">HOW TO READ PLANETS IN ASTROLOGY</span>
        </nav>

        <!-- Guide Header -->
        <header class="fk-guide-header">
            <h1>How to Read Planets in <span class="gold-title">Astrology</span></h1>
        </header>

        <!-- Main Editorial Content -->
        <article class="fk-guide-body">
            <p>In Vedic astrology (Jyotish), planets are called <strong>Grahas</strong>, a Sanskrit word meaning "that which grasps, seizes, or influences." Planets are not merely distant physical orbs; they are cosmic distributors of human karma. Each planet vibrates at a distinct cosmic frequency, shaping your psychological traits, physical vitality, inclinations, and outer life events.</p>

            <p>Vedic astrology centers on the <strong>Navagrahas</strong> (the nine celestial forces): the Sun, Moon, Mars, Mercury, Jupiter, Venus, Saturn, and the two karmic lunar nodes—Rahu (North Node) and Ketu (South Node). Deciphering how these planets operate inside your Janam Kundli is key to understanding your inner strengths and life path.</p>

            <h2>Benefic vs Malefic Planets in Vedic Astrology</h2>
            <p>Planets are classified into two broad energetic categories based on their natural predisposition:</p>
            <ul>
                <li><strong>Natural Benefics (Saumya / Shubha Grahas):</strong> Jupiter (Guru), Venus (Shukra), waxing Moon (Shukla Paksha Chandra), and unafflicted Mercury (Budh). These planets radiate grace, wisdom, harmony, abundance, empathy, and intellectual expansion.</li>
                <li><strong>Natural Malefics (Krura / Papa Grahas):</strong> Saturn (Shani), Mars (Mangal), Rahu, Ketu, the Sun (Surya - considered mildly cruel or harsh), and the waning Moon (Krishna Paksha Chandra). These planets bring discipline, tests, sudden detachment, relentless focus, and karmic lessons.</li>
            </ul>
            <p><em>Note:</em> In individual horoscopes, a natural malefic can become a <strong>functional benefic</strong> depending on the rising Lagna. For example, Saturn is the supreme Yogakaraka (best benefic) for Taurus and Libra ascendants.</p>

            <h2>Table of Planetary Dignities (Exaltation &amp; Debilitation)</h2>
            <p>The strength and behavior of any planet depend heavily on the zodiac sign it occupies. A planet in its exaltation sign delivers its highest virtues, while a debilitated planet faces initial struggles until supported by Neecha Bhanga (cancellation of debilitation):</p>

            <div class="kd-table-responsive" style="margin-bottom: 24px;">
                <table class="kd-table">
                    <thead>
                        <tr>
                            <th>Planet (Graha)</th>
                            <th>Own Sign (Swakshetra)</th>
                            <th>Exaltation (Uccha)</th>
                            <th>Debilitation (Neecha)</th>
                            <th>Core Karakatva (Significations)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Sun (Surya)</strong></td>
                            <td>Leo (Simha)</td>
                            <td>Aries (Mesha) - 10°</td>
                            <td>Libra (Tula) - 10°</td>
                            <td>Soul, Father, Vitality, Leadership, Willpower</td>
                        </tr>
                        <tr>
                            <td><strong>Moon (Chandra)</strong></td>
                            <td>Cancer (Karka)</td>
                            <td>Taurus (Vrishabha) - 3°</td>
                            <td>Scorpio (Vrischika) - 3°</td>
                            <td>Mind, Emotions, Mother, Mental Peace, Intuition</td>
                        </tr>
                        <tr>
                            <td><strong>Mars (Mangal)</strong></td>
                            <td>Aries &amp; Scorpio</td>
                            <td>Capricorn (Makara) - 28°</td>
                            <td>Cancer (Karka) - 28°</td>
                            <td>Courage, Energy, Real Estate, Siblings, Ambition</td>
                        </tr>
                        <tr>
                            <td><strong>Mercury (Budh)</strong></td>
                            <td>Gemini &amp; Virgo</td>
                            <td>Virgo (Kanya) - 15°</td>
                            <td>Pisces (Meena) - 15°</td>
                            <td>Intellect, Communication, Speech, Commerce, Logic</td>
                        </tr>
                        <tr>
                            <td><strong>Jupiter (Guru)</strong></td>
                            <td>Sagittarius &amp; Pisces</td>
                            <td>Cancer (Karka) - 5°</td>
                            <td>Capricorn (Makara) - 5°</td>
                            <td>Wisdom, Spiritual Teacher, Fortune, Children, Dharma</td>
                        </tr>
                        <tr>
                            <td><strong>Venus (Shukra)</strong></td>
                            <td>Taurus &amp; Libra</td>
                            <td>Pisces (Meena) - 27°</td>
                            <td>Virgo (Kanya) - 27°</td>
                            <td>Love, Marriage, Arts, Luxury, Beauty, Diplomacy</td>
                        </tr>
                        <tr>
                            <td><strong>Saturn (Shani)</strong></td>
                            <td>Capricorn &amp; Aquarius</td>
                            <td>Libra (Tula) - 20°</td>
                            <td>Aries (Mesha) - 20°</td>
                            <td>Karma, Longevity, Discipline, Perseverance, Service</td>
                        </tr>
                        <tr>
                            <td><strong>Rahu (North Node)</strong></td>
                            <td>Aquarius (Co-ruler)</td>
                            <td>Taurus / Gemini</td>
                            <td>Scorpio / Sagittarius</td>
                            <td>Ambition, Unconventionality, Foreign Lands, Tech</td>
                        </tr>
                        <tr>
                            <td><strong>Ketu (South Node)</strong></td>
                            <td>Scorpio (Co-ruler)</td>
                            <td>Sagittarius / Scorpio</td>
                            <td>Gemini / Taurus</td>
                            <td>Detachment, Moksha, Occult, Deep Research, Intuition</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2>Planetary Aspects (Graha Drishti)</h2>
            <p>Planets do not only affect the house they occupy; they also cast their gaze (Drishti) on other houses across the chart, activating those sectors:</p>
            <ul>
                <li><strong>Standard Aspect (7th House):</strong> All nine planets cast a full 100% aspect on the 7th house directly opposite to them.</li>
                <li><strong>Special Aspects of Mars:</strong> In addition to the 7th house, Mars casts special full aspects on the <strong>4th and 8th houses</strong> from its location.</li>
                <li><strong>Special Aspects of Jupiter:</strong> Jupiter radiates benevolent trine aspects on the <strong>5th and 9th houses</strong> in addition to the 7th house, bestowing protection and wisdom.</li>
                <li><strong>Special Aspects of Saturn:</strong> Saturn casts stern, karmic gaze on the <strong>3rd and 10th houses</strong> from its position, demanding effort and responsibility.</li>
                <li><strong>Rahu &amp; Ketu Aspects:</strong> By classical Parashari consensus, Rahu and Ketu also cast trinal aspects on the <strong>5th and 9th houses</strong> from their stations.</li>
            </ul>

            <h2>Retrograde and Combust States</h2>
            <p>Two essential conditions profoundly alter a planet's ordinary functioning:</p>
            <ul>
                <li><strong>Retrograde Planets (Vakra Grahas):</strong> When an outer planet (Mars, Mercury, Jupiter, Venus, Saturn) appears to move backwards against the stars due to relative orbital geometry, it achieves maximum proximity to Earth and possesses very high <em>Chesta Bala</em> (motional strength). Retrograde planets symbolize unresolved past-life karma, prompting introspection and non-linear paths to accomplishment.</li>
                <li><strong>Combust Planets (Asta Grahas):</strong> When a planet travels too close to the blazing disc of the Sun within its specific combustion degrees, it is rendered combust (Asta). While combustion may temporarily suppress the external worldly fruits of that planet, it frequently purifies and internalizes its spiritual and philosophical essence.</li>
            </ul>

            <!-- Related Guides & Popular Tools Section -->
            <div class="fk-tags-section">
                <div class="fk-tags-cat-title">MASTER VEDIC ASTROLOGY GUIDES (5 CHAPTERS)</div>
                <div class="fk-tags-wrap" style="margin-bottom: 24px;">
                    <a href="{{ route('guide.read-kundli') }}" class="fk-tag-pill">How to Read Kundli Online <span class="fk-pill-arrow">→</span></a>
                    <a href="{{ route('guide.read-houses') }}" class="fk-tag-pill">How to Read Houses in Kundli <span class="fk-pill-arrow">→</span></a>
                    <a href="{{ route('guide.read-planets') }}" class="fk-tag-pill active" style="background: rgba(227, 181, 104, 0.3); border-color: #e3b568; color: #fff;">How to Read Planets in Astrology <span class="fk-pill-arrow">→</span></a>
                    <a href="{{ route('guide.planets-signs-houses') }}" class="fk-tag-pill">Planets, Signs &amp; Houses in Astrology <span class="fk-pill-arrow">→</span></a>
                    <a href="{{ route('guide.planets-signs-significance') }}" class="fk-tag-pill">Planets, Signs and Their Significance <span class="fk-pill-arrow">→</span></a>
                </div>

                <div class="fk-tags-cat-title">FREE ASTROLOGY CALCULATORS</div>
                <div class="fk-tags-wrap">
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
                        <span>What does it mean when a planet is exalted or debilitated?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>An exalted planet is at the peak of its celestial dignity, capable of giving auspicious, effortless, and noble results in the houses it influences. A debilitated planet feels uncomfortable in the sign's environment, requiring extra effort, self-discipline, and Vedic remedies to express its positive potential.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-question">
                        <span>Does a retrograde planet always produce adverse results?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>No, retrograde planets are not necessarily harmful. Because they are closest to Earth, they possess high Chesta Bala (motional strength). A retrograde benefic like Jupiter or Venus can give extraordinary spiritual depth and intuitive brilliance, though the path may be unconventional.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-question">
                        <span>How do planets manifest their results during their Mahadasha?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>In the Vimshottari Dasha system, each planet rules a designated time window ranging from 6 to 20 years. During its Mahadasha, that planet becomes the active cosmic driver, bringing to fruition the matters of the houses it rules, the house it occupies, and its natural significations.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-question">
                        <span>What happens when a planet is combust with the Sun?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>When a planet moves within a certain degree threshold of the Sun (e.g., within 14° for Mercury or 11° for Jupiter), it is called combust (Asta). Its outer material results may experience delays or friction, but its spiritual wisdom and subtle psychological qualities often become intensified.</p>
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
