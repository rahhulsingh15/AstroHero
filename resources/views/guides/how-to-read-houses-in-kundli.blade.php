@extends('frontend.layouts.master')
@section('title', 'How to Read Houses in Kundli — Complete 12 Bhavas Guide | AstroHero')
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
            <span class="active">HOW TO READ HOUSES IN KUNDLI</span>
        </nav>

        <!-- Guide Header -->
        <header class="fk-guide-header">
            <h1>How to Read Houses in <span class="gold-title">Kundli</span></h1>
        </header>

        <!-- Main Editorial Content -->
        <article class="fk-guide-body">
            <p>In Vedic astrology, a Janam Kundli is divided into 12 distinct segments called
                <strong>Bhavas</strong> (houses). Each house corresponds to specific domains of human
                existence—ranging from personal health, wealth, and marriage to career accomplishments, spiritual
                enlightenment, and hidden challenges. Understanding how to read these houses is the fundamental
                cornerstone of deciphering your cosmic destiny.</p>

            <p>When an astrologer creates your horoscope, the zodiac sign rising on the eastern horizon at the exact
                moment and place of your birth is fixed as the <strong>1st House (Lagna / Ascendant)</strong>. The
                subsequent 11 houses are counted in a fixed sequence, each anchoring 30 degrees of the 360-degree
                celestial zodiac sphere.</p>

            <h2>Understanding the 12 Houses in Astrology</h2>
            <p>Here is an in-depth breakdown of what each of the twelve Bhavas represents in your birth chart:</p>

            <ul>
                <li><strong>1st House (Tanu Bhava / Ascendant):</strong> The house of self, physical body,
                    appearance, overall vitality, innate temperament, ego, and life outlook. It governs your general
                    wellness and how the outer world perceives you.</li>
                <li><strong>2nd House (Dhana Bhava):</strong> The house of accumulated wealth, family heritage,
                    speech, financial security, oral expressions, facial features, and early childhood values.</li>
                <li><strong>3rd House (Sahaja Bhava):</strong> The house of siblings (especially younger ones),
                    courage, valor, communication skills, creative writing, short journeys, and personal enterprise.
                </li>
                <li><strong>4th House (Bandhu / Sukha Bhava):</strong> The house of mother, home environment,
                    emotional happiness, landed property, real estate, vehicles, and inner peace of mind.</li>
                <li><strong>5th House (Putra / Purva Punya Bhava):</strong> The house of intelligence, children,
                    romance, creative arts, past-life good karma, mantras, speculative gains, and higher learning.
                </li>
                <li><strong>6th House (Ari / Shatru Bhava):</strong> The house of daily routine, debts, diseases,
                    enemies, competitive exams, legal disputes, litigation, and selfless service.</li>
                <li><strong>7th House (Yuvati / Kalatra Bhava):</strong> The house of marriage, spouse, long-term
                    romantic commitments, legal business partnerships, and interactions with the public.</li>
                <li><strong>8th House (Randhra / Ayur Bhava):</strong> The house of longevity, sudden
                    transformations, occult sciences, inheritance, unearned wealth, research, hidden secrets, and
                    marital longevity (Mangalya).</li>
                <li><strong>9th House (Dharma / Bhagya Bhava):</strong> The house of good fortune, destiny, father,
                    spiritual preceptors (Gurus), pilgrimages, ethical values, philosophy, and higher foreign
                    education.</li>
                <li><strong>10th House (Karma Bhava):</strong> The house of profession, career ambitions, public
                    reputation, authority, leadership, government favors, and life purpose.</li>
                <li><strong>11th House (Labha Bhava):</strong> The house of gains, recurring income, fulfillment of
                    long-held desires, elder siblings, social networks, and community associations.</li>
                <li><strong>12th House (Vyaya Bhava):</strong> The house of expenses, foreign settlements,
                    isolation, spiritual liberation (Moksha), subconscious dreams, hospitals, and bedroom pleasures.
                </li>
            </ul>

            <h2>Key Classifications of Houses in Vedic Astrology</h2>
            <p>Vedic astrology classifies the twelve houses into functional categories based on their nature and
                karmic purpose:</p>

            <h3>1. Kendra Houses (Angles / Pillars of Strength)</h3>
            <p>The <strong>1st, 4th, 7th, and 10th houses</strong> are known as Kendra Bhavas. Dedicated to Lord
                Vishnu, they form the cornerstone of your birth chart. Strong planets placed in Kendra houses
                provide immense vitality, domestic stability, successful partnerships, and stellar professional
                accomplishments.</p>

            <h3>2. Trikona Houses (Trines / Divine Blessings)</h3>
            <p>The <strong>1st, 5th, and 9th houses</strong> are called Trikona Bhavas. Dedicated to Goddess
                Lakshmi, they represent virtue, intelligence, fortune, and auspicious karma carried over from past
                lives. Benefic planets placed here shower unearned luck and effortless prosperity.</p>

            <h3>3. Upachaya Houses (Growth Over Time)</h3>
            <p>The <strong>3rd, 6th, 10th, and 11th houses</strong> are Upachaya Bhavas. These houses represent
                sectors of life where challenges gradually diminish and results improve with age, maturity, and
                focused discipline. Malefic planets like Mars, Saturn, and Rahu often excel in Upachaya houses.</p>

            <h3>4. Dushtana Houses (Karmic Hurdles &amp; Transformation)</h3>
            <p>The <strong>6th, 8th, and 12th houses</strong> are known as Trika or Dushtana Bhavas. They govern
                physical illness, debts, unexpected delays, secret fears, and ultimate spiritual liberation. When
                channeled wisely or occupied by natural benefics in dignified states, they trigger profound healing,
                research mastery, and spiritual wisdom.</p>

            <h2>Step-by-Step Method to Read Any House</h2>
            <ol>
                <li><strong>Identify the House Lord (Bhavesh):</strong> Note the zodiac sign present in the house
                    and check where its ruling lord is placed. For example, if Aries sits in the 10th house, Mars is
                    the 10th lord. The placement of Mars dictates your career trajectory.</li>
                <li><strong>Analyze Resident Planets:</strong> Discover which planets occupy the house. Benefic
                    planets (Jupiter, Venus) generally enhance house matters, while afflicted malefics can introduce
                    struggles or friction.</li>
                <li><strong>Examine Planetary Aspects (Drishti):</strong> Check which external planets cast their
                    gaze upon the house. An auspicious aspect from Jupiter can protect an afflicted house.</li>
                <li><strong>Evaluate Planetary Strength &amp; Dashas:</strong> Even a promising house only manifests its
                    fullest potential when its governing lord's Mahadasha or Antardasha becomes active in your life
                    timeline.</li>
            </ol>

            <!-- Related Guides & Popular Tools Section -->
            <div class="fk-tags-section">
                <div class="fk-tags-cat-title">MASTER VEDIC ASTROLOGY GUIDES (5 CHAPTERS)</div>
                <div class="fk-tags-wrap" style="margin-bottom: 24px;">
                    <a href="{{ route('guide.read-kundli') }}" class="fk-tag-pill">How to Read Kundli Online <span class="fk-pill-arrow">→</span></a>
                    <a href="{{ route('guide.read-houses') }}" class="fk-tag-pill active" style="background: rgba(227, 181, 104, 0.3); border-color: #e3b568; color: #fff;">How to Read Houses in Kundli <span class="fk-pill-arrow">→</span></a>
                    <a href="{{ route('guide.read-planets') }}" class="fk-tag-pill">How to Read Planets in Astrology <span class="fk-pill-arrow">→</span></a>
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
                        <span>What are the most powerful houses in a Kundli?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>The Kendra houses (1st, 4th, 7th, 10th) and Trikona houses (1st, 5th, 9th) are the most
                            powerful and auspicious in Vedic astrology. Among these, the 1st house is uniquely both
                            a Kendra and a Trikona, while the 10th house represents the peak of worldly strength and
                            authority.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-question">
                        <span>What happens if a house is empty without any planets?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>An empty house is completely normal and does not mean that the sector of life is inactive
                            or missing. To evaluate an empty house, astrologers analyze the placement, dignity, and
                            aspects of that house's ruling lord (Bhavesh), along with any external planetary aspects
                            falling on that house.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-question">
                        <span>Which house represents career, fame, and professional success?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>The 10th house (Karma Bhava) is the primary house for career, status, public reputation,
                            and authority. In addition, the 2nd house (earned wealth), 6th house (daily
                            service/job), and 11th house (financial gains and professional network) work in concert
                            with the 10th house to determine your complete financial and professional standing.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-question">
                        <span>Are Dushtana houses (6th, 8th, 12th) always harmful?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>No, Dushtana houses are not inherently bad. While they represent challenges such as
                            debts, obstacles, and expenses, they are also the houses of competitive victory (6th),
                            deep occult wisdom and research (8th), and spiritual enlightenment and foreign travel
                            (12th). Beneficial yogas like Vipreet Raj Yoga can transform these difficult houses into
                            sources of extraordinary triumph.</p>
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
