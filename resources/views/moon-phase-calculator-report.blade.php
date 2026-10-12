@extends('frontend.layouts.master')
@section('title', $name . "'s Moon Phase Report - " . $report['name'])
@section('content')

    <section class="moon-report-section">
        <div class="container">
            <a href="{{ route('moon-phase-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <div class="moon-report-header">
                <h2>{{ $name }}'s <span class="highlight">Moon Phase Report</span></h2>
            </div>

            @if ($timeUnknown)
                <div class="asc-notice">
                    You did not enter a birth time, so this report uses 12:00 noon. The Moon's angle changes by about
                    12° a day, so your real figures may differ slightly, and near the border of two phases the phase
                    itself may be different.
                </div>
            @endif

            <!-- Main Dashboard Card -->
            <div class="moon-dashboard">
                <div class="moon-dashboard-left">
                    <h3 class="moon-phase-title">{{ $report['name'] }}</h3>
                    <span class="moon-sub-phase">{{ $report['title'] }}</span>

                    <div class="key-characteristics">
                        <h4>Key Characteristics</h4>
                        <div class="char-tags">
                            @foreach ($report['tags'] as $tag)
                                <span class="tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="moon-stats-grid moon-stats-two">
                        @foreach ([
                            'Phase Number' => '#' . $report['number'] . ' of 8',
                            'Phase Range'  => $report['start'] . '° - ' . $report['end'] . '°',
                            'Moon Angle'   => $report['angle'] . '°',
                            'Illumination' => $report['illumination'] . '%',
                            'Moon Age'     => $report['age'] . ' Days',
                            'Tithi'        => $report['tithi'],
                            'Paksha'       => $report['paksha'],
                            'Moon Sign'    => $report['moonSign'],
                            'Nakshatra'    => $report['nakshatra'],
                            'Sun Sign (Vedic)' => $report['sunSign'],
                        ] as $label => $value)
                            <div class="moon-stat-item">
                                <span class="moon-stat-label">{{ $label }}</span>
                                <span class="moon-stat-value">{{ $value }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="moon-dashboard-right">
                    <!-- The Moon as it looked at birth, drawn from the real Sun-Moon angle -->
                    <svg class="moon-phase-svg" viewBox="0 0 240 240" role="img" aria-label="{{ $report['name'] }}, {{ $report['illumination'] }}% illuminated">
                        <defs>
                            <radialGradient id="moon-lit" cx="40%" cy="35%" r="75%">
                                <stop offset="0%" stop-color="#fffdf2"/>
                                <stop offset="100%" stop-color="#d9d2b8"/>
                            </radialGradient>
                        </defs>
                        <circle cx="120" cy="120" r="100" fill="#1b1d2e" stroke="rgba(255,255,255,0.12)"/>
                        <path d="{{ $report['svgPath'] }}" fill="url(#moon-lit)"/>
                    </svg>
                    <p class="moon-svg-caption">{{ $birth->format('d M Y') }}{{ $timeUnknown ? '' : ', ' . $birth->format('h:i A') }} · {{ $place }}</p>
                </div>
            </div>

            <div class="moon-report-actions">
                <a href="{{ route('talk-to-astrologers') }}" class="btn-primary">Talk to Astrologer</a>
                <a href="{{ route('moon-phase-calculator') }}" class="btn-secondary">Calculate Again</a>
            </div>

            <!-- Content Article -->
            <div class="moon-article">
                <h3>Your Moon Phase: {{ $report['name'] }}</h3>
                <p>{{ $report['about'] }}</p>
                <p>
                    At your birth the Moon was {{ $report['angle'] }}° ahead of the Sun, {{ $report['illumination'] }}% lit and
                    {{ $report['waxing'] ? 'waxing (growing)' : 'waning (decreasing)' }}. In the Vedic calendar this is
                    {{ $report['tithi'] }} of {{ $report['paksha'] }}, with the Moon in {{ $report['moonSign'] }}
                    ({{ $report['nakshatra'] }} nakshatra).
                </p>

                <h4>Personality & Traits</h4>
                <ul>
                    @foreach ($report['traits'] as $trait => $text)
                        <li><strong>{{ $trait }}:</strong> {{ $text }}</li>
                    @endforeach
                </ul>

                <h4>Challenges</h4>
                <p>{{ $report['challenges'] }}</p>

                <h3>What Are Moon Phases?</h3>
                <p>The moon phases, or lunar phases, refer to the shape of the moon's directly sunlit portion as viewed from Earth. As the moon orbits the Earth, its position relative to the Earth and Sun changes, causing it to go through a cycle of phases over approximately 29.5 days.</p>
                <p>Your natal moon phase (the phase the moon was in when you were born) is believed to deeply influence your core personality, emotional needs, and how you naturally process life's challenges. It provides a blueprint of your inner psychological landscape.</p>
            </div>

            <!-- Discover More Tools -->
            <div class="discover-more" style="margin-top: 60px;">
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
                    <a href="{{ route('dasha-calculator') }}" class="calc-card">
                        <span class="c-icon">🪐</span>
                        <h4>Dasha Calculator</h4>
                        <p>See your planetary periods</p>
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
                        <span>Is my moon phase the same as my Moon Sign?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>No, they are different. Your Moon Sign indicates which zodiac constellation the moon was passing through when you were born. Your Moon Phase indicates the angle between the Sun and the Moon (how illuminated the moon was).</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>Can moon phases affect my mood?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>Astrologically and culturally, it is widely believed that the moon impacts human emotions. Full moons are often associated with heightened emotions and climax, while new moons are associated with low energy and introspection.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>Which moon phase is best for starting something new?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>The New Moon phase is considered the best time for setting intentions, starting new projects, or beginning a new chapter in your life, as it represents a fresh cycle of energy.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>Why do I need to enter my time of birth?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>Because the moon moves very quickly (changing signs every 2.5 days and phases continuously), an exact time is necessary to calculate the precise angle between the Sun and Moon at the moment you were born.</p>
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
