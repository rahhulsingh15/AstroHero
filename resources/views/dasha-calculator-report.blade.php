@extends('frontend.layouts.master')
@section('title', $name . "'s Dasha Report - " . $report['planet'] . ' Mahadasha')
@section('content')
    @php $p = $report['profile']; @endphp
    <section class="dasha-report-section">
        <div class="container">
            <a href="{{ route('dasha-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <div class="dasha-header">
                <div class="asc-sign-badge">{{ $report['symbol'] }}</div>
                <h2>{{ strtr($content->heading ?: "{name}'s {planet} Mahadasha Report", ['{name}' => $name, '{planet}' => $report['planet']]) }}</h2>
                <p>
                    You are currently going through <strong>{{ $report['planet'] }} ({{ $report['hindi'] }}) Mahadasha</strong>,
                    from {{ $report['start']->format('d M Y') }} to {{ $report['end']->format('d M Y') }}.
                    @if ($report['currentAntar'])
                        The running Antardasha is <strong>{{ $report['currentAntar']['name'] }}</strong>,
                        until {{ $report['currentAntar']['end']->format('d M Y') }}.
                    @endif
                </p>
                @if($content->description)
                    <p>{{ $content->description }}</p>
                @endif
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
            <!-- SEO Content (Admin > Report Page) -->
            @if($content->main_content)
                <div class="dasha-seo-content">
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
