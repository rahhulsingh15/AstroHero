@extends('frontend.layouts.master')
@section('title', $name . "'s Rising Sign Report - " . $report['sign'] . ' Ascendant')
@section('content')
    @php $r = $report['reading']; @endphp
    <section class="ascendant-report-section">
        <div class="container">
            <a href="{{ route('rising-ascendant-sign-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <div class="report-header-card">
                <div class="asc-sign-badge">{{ $report['symbol'] }}</div>
                <h2>{{ $name }}'s Rising Sign Report</h2>
                <p class="asc-sign-line">
                    Your Ascendant (Lagna) is <strong>{{ $report['sign'] }}</strong> ({{ $report['hindi'] }})
                    at {{ $report['degree'] }}° {{ sprintf('%02d', $report['minute']) }}′
                </p>
            </div>

            @if ($timeUnknown)
                <div class="asc-notice">
                    You did not enter a birth time, so this report uses 12:00 noon. The rising sign changes about every
                    two hours, so your real Ascendant may be a different sign.
                </div>
            @elseif ($report['nearCusp'])
                <div class="asc-notice">
                    Your Ascendant is very close to the border between two signs. A birth time that is off by even a few
                    minutes could change it, so please confirm your exact time of birth.
                </div>
            @endif

            <!-- Calculated from the birth details -->
            <div class="traits-grid">
                @foreach ([
                    ['📅', 'Date of Birth', $birth->format('d F Y')],
                    ['🕒', 'Time of Birth', $timeUnknown ? 'Not known (12:00 PM used)' : $birth->format('h:i A')],
                    ['📍', 'Place of Birth', $place],
                    ['🌐', 'Latitude / Longitude', abs($lat) . '° ' . ($lat >= 0 ? 'N' : 'S') . ', ' . abs($lng) . '° ' . ($lng >= 0 ? 'E' : 'W')],
                    ['⏱️', 'Time Zone', $birth->timezoneName . ' (UTC' . $birth->format('P') . ')'],
                    [$report['symbol'], 'Ascendant (Lagna)', $report['sign'] . ' (' . $report['hindi'] . ')'],
                    ['👑', 'Lagna Lord', $report['lord']],
                    ['⭐', 'Lagna Nakshatra', $report['nakshatra'] . ', Pada ' . $report['pada']],
                    ['🔥', 'Element', $report['element']],
                    ['♻️', 'Nature', $report['quality']],
                    ['🌙', 'Moon Sign (Rashi)', $report['moonSign']],
                    ['☀️', 'Sun Sign (Vedic)', $report['sunSign']],
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
                Calculated for your exact birth moment and place using the sidereal zodiac (Lahiri ayanamsa), as used in
                Vedic astrology. The reading below is the traditional description of this rising sign.
            </p>

            <div class="asc-card highlight-card">
                <h3 class="card-title"><span class="icon">✨</span> About Your Ascendant (Lagna)</h3>
                <p><strong>{{ $report['sign'] }} Ascendant</strong>: {{ $r['about'] }}</p>
            </div>

            <div class="asc-grid-3">
                <div class="asc-card">
                    <h3 class="card-title"><span class="icon">👤</span> Personality Traits</h3>
                    <ul>
                        @foreach ($r['personality'] as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="asc-card">
                    <h3 class="card-title"><span class="icon">👁️</span> Physical Traits</h3>
                    <ul>
                        @foreach ($r['physical'] as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="asc-card">
                    <h3 class="card-title"><span class="icon">❤️‍🩹</span> Health Insights</h3>
                    <ul>
                        @foreach ($r['health'] as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="asc-card">
                <h3 class="card-title"><span class="icon">💼</span> Career Path</h3>
                <p>{{ $r['career'] }}</p>
            </div>

            <div class="asc-card">
                <h3 class="card-title"><span class="icon">🔮</span> Karma & Life Path</h3>
                <p>{{ $r['karma'] }}</p>
            </div>

            <div class="asc-action-center">
                <a href="{{ route('talk-to-astrologers') }}" class="btn-primary">Talk to an Astrologer for Detailed Insights</a>
            </div>

            <div class="asc-seo-content">
                <h3>What is a Rising Sign (Ascendant)?</h3>
                <p>Your Rising Sign, also known as your Ascendant or Lagna, is the zodiac sign that was ascending on the
                    eastern horizon at the exact moment and location of your birth. In Vedic astrology, the Ascendant is
                    the most important element of your birth chart (Kundli). It acts as the mask you wear in public,
                    your physical appearance, and the initial impression you make on others.</p>

                <h4>Sun Sign vs. Rising Sign</h4>
                <p>While your Sun Sign represents your core ego and internal motivations, your Rising Sign determines
                    your external behavior and how you naturally interact with the world. Think of the Sun Sign as the
                    driver of a car, and the Rising Sign as the car itself—it defines your physical body, style, and
                    approach to life.</p>

                <h4>Why is the Exact Birth Time Required?</h4>
                <p>The Ascendant changes approximately every two hours. Therefore, even a small error in your birth time
                    can result in calculating the wrong Rising Sign, entirely changing the accuracy of your horoscope.
                    It's crucial to use your exact time and place of birth for precise astrological readings.</p>

                <h4>The 12 Ascendants and Their Rulers</h4>
                <ul>
                    <li><strong>Aries:</strong> Ruled by Mars (Active, energetic)</li>
                    <li><strong>Taurus:</strong> Ruled by Venus (Grounded, aesthetic)</li>
                    <li><strong>Gemini:</strong> Ruled by Mercury (Communicative, curious)</li>
                    <li><strong>Cancer:</strong> Ruled by Moon (Nurturing, emotional)</li>
                    <li><strong>Leo:</strong> Ruled by Sun (Confident, charismatic)</li>
                    <li><strong>Virgo:</strong> Ruled by Mercury (Analytical, precise)</li>
                    <li><strong>Libra:</strong> Ruled by Venus (Charming, diplomatic)</li>
                    <li><strong>Scorpio:</strong> Ruled by Mars/Pluto (Intense, secretive)</li>
                    <li><strong>Sagittarius:</strong> Ruled by Jupiter (Optimistic, adventurous)</li>
                    <li><strong>Capricorn:</strong> Ruled by Saturn (Ambitious, disciplined)</li>
                    <li><strong>Aquarius:</strong> Ruled by Saturn/Uranus (Innovative, eccentric)</li>
                    <li><strong>Pisces:</strong> Ruled by Jupiter/Neptune (Compassionate, mystical)</li>
                </ul>
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
                        <span>What is a Rising Sign (Ascendant)?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>Your Rising Sign, also known as the Ascendant, is the exact zodiac sign that was rising on
                            the eastern horizon at the moment you were born. It represents your physical appearance,
                            first impressions, and your outer personality.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>How is the Rising Sign different from my Sun Sign?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>While your Sun Sign reveals your inner core, ego, and basic personality traits, your Rising
                            Sign acts as a "mask" or filter. It dictates how the outside world perceives you when they
                            first meet you, and heavily influences your physical traits.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>Why do you need my exact time of birth?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>The Ascendant changes approximately every two hours. Even a difference of just 5-10 minutes
                            can completely change your Rising Sign and the entire layout of the 12 houses in your
                            Kundli. Exact birth time ensures a 100% accurate chart.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>Does my Rising Sign change as I grow older?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>No, your Rising Sign never changes. It is a permanent fixture of your birth chart based
                            entirely on the specific coordinates and time of your birth.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>Which is more important in Vedic astrology, Sun or Rising sign?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>In Vedic astrology, the Ascendant (Lagna) and the Moon Sign are considered much more
                            significant than the Sun Sign for predicting daily life, personality, and major life events.
                        </p>
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
