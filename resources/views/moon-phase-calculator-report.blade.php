@extends('frontend.layouts.master')
@section('title', $name . "'s Moon Phase Report - " . $report['name'])
@section('content')

    <section class="moon-report-section">
        <div class="container">
            <a href="{{ route('moon-phase-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <div class="moon-report-header">
                <h2>{!! strtr($content->heading ?: "{name}'s <span class=\"highlight\">Moon Phase Report</span>", ['{name}' => $name, '{phase}' => $report['name']]) !!}</h2>
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

                @if(!empty($content->main_content))
                    {!! strtr($content->main_content, ['{name}' => $name, '{phase}' => $report['name']]) !!}
                @endif
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

    @if(!empty($content->faq_content))
        <section class="acording_section">
            {!! $content->faq_content !!}
        </section>
    @endif
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
