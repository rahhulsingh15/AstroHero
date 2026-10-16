@extends('frontend.layouts.master')
@section('title', $name . "'s Mangal Dosha Report - " . $report['status'])
@section('content')
    @php
        $charts = $report['charts'];
        $chartColor = fn ($manglik) => $manglik ? 'var(--red-text)' : 'var(--green-text)';
    @endphp
    <section class="mangal-dosha-section">
        <div class="container">
            <a href="{{ route('mangal-dosha-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Main Dashboard Card -->
            <div class="md-dashboard">
                <div class="md-header-main">
                    <h2>{{ strtr($content->heading ?: "{name}'s Mangal Dosha Analysis", ['{name}' => $name]) }}</h2>
                    <div class="md-status-badge {{ $report['safe'] ? 'safe' : 'danger' }}">
                        @if ($report['safe'])
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        @else
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        @endif
                        {{ $report['status'] }}
                    </div>
                    <div class="md-intro-note">
                        Mars is in {{ $report['marsSignLabel'] }}, in the {{ $charts['Lagna']['ordinal'] }} house of your birth chart
                        ({{ $charts['Lagna']['sign'] }} Ascendant). {{ $report['summary'] }}
                        This is a computer-generated result; consult an astrologer to confirm it against your full chart.
                    </div>
                </div>

                @if ($timeUnknown)
                    <div class="asc-notice" style="margin-top: 24px;">
                        You did not enter a birth time, so this report uses 12:00 noon. The Lagna changes about every two
                        hours, so the Lagna-chart result may be different for your real birth time. The Moon and Venus
                        chart results are more reliable.
                    </div>
                @elseif ($report['nearCusp'])
                    <div class="asc-notice" style="margin-top: 24px;">
                        Your Ascendant is very close to the border between two signs. A birth time that is off by a few
                        minutes could change the house of Mars, so please confirm your exact time of birth.
                    </div>
                @endif

                <div class="md-data-group">
                    <h3><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> Dosha Status</h3>
                    <div class="md-data-grid">
                        <div class="md-data-card">
                            <span class="md-data-label">Overall Result</span>
                            <span class="md-data-value" style="color: {{ $chartColor(!$report['safe']) }};">{{ $report['status'] }}</span>
                        </div>
                        @foreach (['Lagna' => 'Lagna Chart', 'Moon' => 'Moon Chart', 'Venus' => 'Venus Chart'] as $key => $label)
                            <div class="md-data-card">
                                <span class="md-data-label">{{ $label }}</span>
                                <span class="md-data-value" style="color: {{ $chartColor($charts[$key]['manglik']) }};">
                                    {{ $charts[$key]['manglik'] ? 'Manglik' : 'Non-Manglik' }}
                                </span>
                            </div>
                        @endforeach
                        <div class="md-data-card">
                            <span class="md-data-label">Cancellation</span>
                            <span class="md-data-value" style="color: var(--muted);">
                                {{ !$report['present'] ? 'Not Needed' : ($report['cancellations'] ? 'Cancelled' : 'Not Cancelled') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="md-data-group">
                    <h3><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"></circle><path d="M12 2v2"></path><path d="M12 20v2"></path><path d="M2 12h2"></path><path d="M20 12h2"></path></svg> Planetary Information</h3>
                    <div class="md-data-grid">
                        @foreach ([
                            'Lagna (Ascendant)' => $charts['Lagna']['signLabel'],
                            'Moon Rashi'        => $charts['Moon']['signLabel'],
                            'Mars Rashi'        => $report['marsSignLabel'],
                            'Mars Degree'       => $report['marsDegree'] . '° ' . sprintf('%02d', $report['marsMinute']) . '′ ' . $report['marsSign'],
                            'Venus Rashi'       => $charts['Venus']['signLabel'],
                            'Jupiter Rashi'     => $report['jupiterSignLabel'],
                        ] as $label => $value)
                            <div class="md-data-card">
                                <span class="md-data-label">{{ $label }}</span>
                                <span class="md-data-value">{{ $value }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="md-data-group">
                    <h3><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg> Mars House Position</h3>
                    <div class="md-data-grid">
                        @foreach (['Lagna', 'Moon', 'Venus'] as $key)
                            <div class="md-data-card">
                                <span class="md-data-label">From {{ $key }} ({{ $charts[$key]['sign'] }})</span>
                                <span class="md-data-value" style="color: {{ $chartColor($charts[$key]['manglik']) }};">
                                    {{ $charts[$key]['ordinal'] }} House
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="md-data-group">
                    <h3><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect x="3" y="4" width="18" height="18" rx="2"></rect><path d="M3 10h18"></path></svg> Birth Details</h3>
                    <div class="md-data-grid">
                        <div class="md-data-card">
                            <span class="md-data-label">Date of Birth</span>
                            <span class="md-data-value">{{ $birth->format('d F Y') }}</span>
                        </div>
                        <div class="md-data-card">
                            <span class="md-data-label">Time of Birth</span>
                            <span class="md-data-value">{{ $timeUnknown ? 'Not known (12:00 PM used)' : $birth->format('h:i A') }}</span>
                        </div>
                        <div class="md-data-card">
                            <span class="md-data-label">Place of Birth</span>
                            <span class="md-data-value">{{ $place }}</span>
                        </div>
                    </div>
                </div>

                @if ($report['formation'])
                    <div class="md-data-group">
                        <h3>How the Dosha is Formed</h3>
                        <div class="md-intro-note" style="max-width: none; text-align: left;">
                            <p style="margin: 0 0 10px;">Mangal Dosha forms when Mars is in the 1st, 2nd, 4th, 7th, 8th or 12th house. In your chart:</p>
                            <ul style="margin: 0; padding-left: 20px;">
                                @foreach ($report['formation'] as $line)
                                    <li>{{ $line }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @if ($report['cancellations'])
                    <div class="md-data-group">
                        <h3>Dosha Cancellation</h3>
                        <div class="md-cancel-box">
                            <strong class="md-cancel-heading">✓ Cancellation Factors</strong>
                            <p>The dosha is present in your chart, but it is cancelled for the following {{ count($report['cancellations']) > 1 ? 'reasons' : 'reason' }}:</p>
                            <ul>
                                @foreach ($report['cancellations'] as $reason)
                                    <li>
                                        <strong>{{ $reason['title'] }}</strong>
                                        <span>{{ $reason['detail'] }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <p>Any one of these conditions is traditionally enough to cancel Mangal Dosha, so it is not counted against you in marriage matching.</p>
                        </div>
                    </div>
                @elseif ($report['effect'])
                    <div class="md-data-group">
                        <h3>What This Means for You</h3>
                        <div class="md-intro-note" style="max-width: none; text-align: left;">
                            {{ $report['effect'] }} The remedies below{{ $gender === 'female' ? ' for females' : ' for males' }} are traditionally advised, and matching with another Manglik partner is said to balance the dosha.
                        </div>
                    </div>
                @endif

                <div class="md-actions">
                    <a href="{{ route('talk-to-astrologers') }}" class="btn-primary">Talk to Astrologer for Detailed Insights</a>
                    <a href="{{ route('mangal-dosha-calculator') }}" class="btn-secondary">Calculate Again</a>
                </div>
            </div>

            <!-- Content Article -->
            @if($content->main_content)
                <div class="md-article">
                    {!! $content->main_content !!}
                </div>
            @endif

            <!-- Discover More Tools -->
            <div class="discover-more" style="margin-bottom: 60px;">
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
                    <a href="{{ route('rising-ascendant-sign-calculator') }}" class="calc-card">
                        <span class="c-icon">🌅</span>
                        <h4>Rising Sign Calculator</h4>
                        <p>Discover your ascendant</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQs -->
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
