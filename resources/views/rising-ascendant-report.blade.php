@extends('frontend.layouts.master')
@section('title', $name . "'s Rising Sign Report - " . $report['sign'] . ' Ascendant')
@section('content')
    @php $r = $report['reading']; @endphp
    <section class="ascendant-report-section">
        <div class="container">
            <a href="{{ route('rising-ascendant-sign-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <div class="report-header-card">
                <div class="asc-sign-badge">{{ $report['symbol'] }}</div>
                <h2>{{ strtr($content->heading ?: "{name}'s Rising Sign Report", ['{name}' => $name, '{sign}' => $report['sign']]) }}</h2>
                <p class="asc-sign-line">
                    Your Ascendant (Lagna) is <strong>{{ $report['sign'] }}</strong> ({{ $report['hindi'] }})
                    at {{ $report['degree'] }}° {{ sprintf('%02d', $report['minute']) }}′
                </p>
                @if($content->description)
                    <p>{{ $content->description }}</p>
                @endif
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

            <!-- SEO Content (Admin > Report Page) -->
            @if($content->main_content)
                <div class="asc-seo-content">
                    {!! $content->main_content !!}
                </div>
            @endif

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
    @if($content->faq_content)
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
