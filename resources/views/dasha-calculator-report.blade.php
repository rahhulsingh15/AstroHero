@extends('frontend.layouts.master')
@section('title', $name . "'s Dasha Report - " . $report['planet'] . ' Mahadasha')
@section('content')
    @php $p = $report['profile']; @endphp
    <section class="dasha-report-section">
        <div class="container">
            <a href="{{ route('dasha-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <div class="dasha-header">
                <div class="asc-sign-badge">{{ $report['symbol'] }}</div>
                <h2>{{ $name }}'s {{ $report['planet'] }} Mahadasha Report</h2>
                <p>
                    You are currently going through <strong>{{ $report['planet'] }} ({{ $report['hindi'] }}) Mahadasha</strong>,
                    from {{ $report['start']->format('d M Y') }} to {{ $report['end']->format('d M Y') }}.
                    @if ($report['currentAntar'])
                        The running Antardasha is <strong>{{ $report['currentAntar']['name'] }}</strong>,
                        until {{ $report['currentAntar']['end']->format('d M Y') }}.
                    @endif
                </p>
            </div>

            @if ($timeUnknown)
                <div class="asc-notice">
                    You did not enter a birth time, so this report uses 12:00 noon. The Moon moves about 13° a day, so
                    your real dasha dates may differ by several months, and near a Nakshatra border the starting dasha
                    itself may be different.
                </div>
            @elseif ($report['nearCusp'])
                <div class="asc-notice">
                    Your Moon is very close to the border between two Nakshatras. A birth time that is off by a few
                    minutes could change your starting dasha, so please confirm your exact time of birth.
                </div>
            @endif

            <!-- Calculated from the birth details -->
            <div class="traits-grid">
                @foreach ([
                    ['📅', 'Date of Birth', $birth->format('d F Y')],
                    ['🕒', 'Time of Birth', $timeUnknown ? 'Not known (12:00 PM used)' : $birth->format('h:i A')],
                    ['📍', 'Place of Birth', $place],
                    ['🌙', 'Moon Sign (Rashi)', $report['moonSign'] . ' ' . $report['moonDegree'] . '° ' . sprintf('%02d', $report['moonMinute']) . '′'],
                    ['⭐', 'Birth Nakshatra', $report['nakshatra'] . ', Pada ' . $report['pada']],
                    ['👑', 'Nakshatra Lord', $report['nakshatraLord']],
                    ['⏳', 'Dasha Balance at Birth', $report['nakshatraLord'] . ' ' . $report['balance']['years'] . 'y ' . $report['balance']['months'] . 'm ' . $report['balance']['days'] . 'd'],
                    [$report['symbol'], 'Current Mahadasha', $report['planet'] . ' (' . $report['hindi'] . ')'],
                    ['🔁', 'Current Antardasha', $report['currentAntar']['name'] ?? '-'],
                ] as [$icon, $label, $value])
                    <div class="trait-card">
                        <span class="t-icon">{{ $icon }}</span>
                        <div class="t-info">
                            <span class="t-label">{{ $label }}</span>
                            <strong class="t-value">{{ $value }}</strong>
                        </div>
                    </div>
                @endforeach
            </div>
            <p class="asc-method-note">
                Calculated from the Moon's position at your exact birth moment using the sidereal zodiac (Lahiri
                ayanamsa) and the Vimshottari system. The reading below is the traditional description of this Mahadasha.
            </p>

            <!-- 3x3 Grid (9 cards) -->
            <div class="dasha-grid-3">
                @foreach ([
                    ['🪐', 'The Ruling Planet', $p['ruling']],
                    ['💼', 'Career & Wealth', $p['career']],
                    ['❤️', 'Relationships', $p['relations']],
                    ['🏥', 'Health Focus', $p['health']],
                    ['🧘', 'Spirituality & Mind', $p['spirit']],
                    ['⚠️', 'Major Challenges', $p['challenges']],
                    ['🎓', 'Education & Travel', $p['education']],
                    ['💎', 'Remedies (Gemstone)', $p['gemstone']],
                ] as [$icon, $title, $text])
                    <div class="dasha-card">
                        <h3><span>{{ $icon }}</span> {{ $title }}</h3>
                        <p>{{ $text }}</p>
                    </div>
                @endforeach
                <div class="dasha-card">
                    <h3><span>🕉️</span> Mantra & Karma</h3>
                    <p>Chant the {{ $report['planet'] }} Beej Mantra <strong>"{{ $p['mantra'] }}"</strong> 108 times daily. {{ $p['karma'] }}</p>
                </div>
            </div>

            <!-- Antardashas of the running Mahadasha -->
            <div class="dasha-timeline-wrapper">
                <h3 class="dasha-timeline-title">Antardashas (Sub-periods) of {{ $report['planet'] }} Mahadasha</h3>
                <div class="antar-grid">
                    @foreach ($report['antardashas'] as $antar)
                        @continue($antar['beforeBirth'])
                        <div class="antar-item {{ $antar['current'] ? 'current' : ($antar['past'] ? 'past' : '') }}">
                            <div class="antar-content">
                                <h4>
                                    {{ $antar['name'] }}
                                    @if ($antar['current'])
                                        <span class="timeline-tag">Running now</span>
                                    @endif
                                </h4>
                                <p class="antar-dates">{{ $antar['start']->format('d M Y') }} - {{ $antar['end']->format('d M Y') }}</p>
                                <p class="antar-note">{{ $antar['note'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="dasha-stats">
                    <div class="d-stat">
                        <strong>{{ $report['totalYears'] }}</strong>
                        <span>Total Years</span>
                    </div>
                    <div class="d-stat">
                        <strong>{{ $report['yearsLeft'] }}</strong>
                        <span>Years Left</span>
                    </div>
                    <div class="d-stat">
                        <strong>{{ $report['monthsLeft'] }}</strong>
                        <span>Months Left</span>
                    </div>
                </div>
            </div>

            <!-- Full Mahadasha sequence from birth -->
            <div class="dasha-timeline-wrapper">
                <h3 class="dasha-timeline-title">Your Mahadasha Timeline</h3>
                <table class="data-table dasha-table">
                    <thead>
                        <tr>
                            <th>Mahadasha</th>
                            <th>Starts</th>
                            <th>Ends</th>
                            <th>Full Length</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($report['mahadashas'] as $maha)
                            <tr @class(['current' => $maha['current']])>
                                <td>{{ $maha['planet'] }} ({{ \App\Helpers\DashaHelper::HINDI[$maha['planet']] }})@if ($maha['current']) <span class="timeline-tag">Now</span>@endif</td>
                                <td>{{ $maha['start']->format('d M Y') }}{{ $loop->first ? ' (birth)' : '' }}</td>
                                <td>{{ $maha['end']->format('d M Y') }}</td>
                                <td>{{ $maha['years'] }} Years</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Action Center -->
            <div class="dasha-actions">
                <a href="{{ route('talk-to-astrologers') }}" class="btn-primary">Talk to an Astrologer for Detailed Insights</a>
            </div>

            <!-- SEO Content -->
            <div class="dasha-seo-content">
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
                            <th>Core Themes & Lifelong Impact</th>
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
            </div>

            <!-- Discover More Tools -->
            <div class="discover-more" style="margin-bottom: 0;">
                <h3 style="text-align: center; color: var(--gold-soft); margin-bottom: 30px;">Discover More Astrology
                    Tools</h3>
                <div class="calc-cards">
                    <a href="{{ route('love-calculator') }}" class="calc-card">
                        <span class="c-icon">❤️</span>
                        <h4>Love Calculator</h4>
                        <p>Check love percentage</p>
                    </a>
                    <a href="{{ route('numerology-calculator') }}" class="calc-card">
                        <span class="c-icon">🔢</span>
                        <h4>Name Numerology</h4>
                        <p>Find your destiny number</p>
                    </a>
                    <a href="{{ route('rising-ascendant-sign-calculator') }}" class="calc-card">
                        <span class="c-icon">🌅</span>
                        <h4>Rising Sign Calculator</h4>
                        <p>Discover your ascendant</p>
                    </a>
                    <a href="{{ route('mangal-dosha-calculator') }}" class="calc-card">
                        <span class="c-icon">🔥</span>
                        <h4>Mangal Dosha Calculator</h4>
                        <p>Check for Manglik dosha</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="acording_section">
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
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
    </section>
    <script>
        const topTicker = document.getElementById('top-ticker');
        if (topTicker) {
            topTicker.innerHTML += topTicker.innerHTML;
        }

        const menuToggle = document.getElementById('menu-toggle');
        const navLinks = document.getElementById('nav-links');

        if (menuToggle && navLinks) {
            menuToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                navLinks.classList.toggle('open');
            });

            document.addEventListener('click', (e) => {
                if (!navLinks.contains(e.target) && !menuToggle.contains(e.target)) {
                    navLinks.classList.remove('open');
                }
            });

            navLinks.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => navLinks.classList.remove('open'));
            });
        }

        function toggleReadMore() {
            const moreText = document.querySelector('.more-text');
            const dots = document.querySelector('.more-dots');
            const btnText = document.querySelector('.read-more');

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Read more";
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Read less";
                moreText.style.display = "inline";
            }
        }
    </script>
    <script>
        // FAQ accordion
        document.querySelectorAll('.acord-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const item = btn.parentElement;
                const isActive = item.classList.contains('active');
                document.querySelectorAll('.acord-item').forEach(other => other.classList.remove('active'));
                if (!isActive) item.classList.add('active');
            });
        });
    </script>
@endsection
