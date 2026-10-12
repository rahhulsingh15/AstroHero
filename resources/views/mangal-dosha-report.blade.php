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
                    <h2>{{ $name }}'s Mangal Dosha Analysis</h2>
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
            <div class="md-article">
                <h2>What Does Manglik Dosha Mean?</h2>
                <p>Manglik dosha is when Mars is placed in the 1st, 2nd, 4th, 7th, 8th, or 12th house from the ascendant, moon, and Venus chart. As Mars represents drive, passion, energy, and aggression, its placement in these houses in a Kundli (birth chart) can profoundly affect marital life, professional life, and physical endurance. Mars is known to naturally bring a fiery or aggressive aura.</p>
                <p>High Manglik (Purna Manglik Dosha) is formed when Mars is placed in any of these houses from the Ascendant (Lagna) and the Moon chart. Double Manglik Dosha is when Mars is in the 1st, 2nd, 4th, 7th, 8th, or 12th house in both the ascendant and the Moon chart.</p>
                
                <h2>What Are the Effects of Mangal in Different Houses?</h2>
                <p>The effects of Manglik Dosha in every house are different. Analyze Mars placement by using our Mangal Dosha calculator. First, let's look at the houses where Mars is placed and see how it works out for the native if you are finding it in your chart.</p>
                
                <div class="houses-grid">
                    <div class="house-card">
                        <h4>Mangal in 1st House</h4>
                        <p>Aggressive nature, dominating behaviour, and ego clashes in relationships.</p>
                    </div>
                    <div class="house-card">
                        <h4>Mangal in 2nd House</h4>
                        <p>Family disputes, harsh speech, and potential financial turbulence.</p>
                    </div>
                    <div class="house-card">
                        <h4>Mangal in 4th House</h4>
                        <p>Lack of mental peace, domestic instability, and career issues.</p>
                    </div>
                    <div class="house-card">
                        <h4>Mangal in 7th House</h4>
                        <p>Marriage delays, high friction with partners, and severe compatibility issues.</p>
                    </div>
                    <div class="house-card">
                        <h4>Mangal in 8th House</h4>
                        <p>Financial hurdles, health issues, and potential delays in career paths.</p>
                    </div>
                    <div class="house-card">
                        <h4>Mangal in 12th House</h4>
                        <p>Hidden enemies, sudden financial losses, and disrupted peace of mind.</p>
                    </div>
                </div>

                <h3>Manglik Dosha Remedies</h3>
                <p>Due to the effects of Mars, it can instigate Manglik Dosha inside you. To lessen the intensity of the dosha, especially for double Manglik or partial Manglik, you should perform certain astrological remedies based on whether you are male or female.</p>
                
                <h4>Remedies for Male</h4>
                <ul>
                    <li>Wearing red coral (Moonga) in a copper or gold ring on the ring finger.</li>
                    <li>Fasting on Tuesdays and donating blood to reduce aggressive energy.</li>
                    <li>Worshiping Lord Hanuman and reciting the Hanuman Chalisa daily.</li>
                </ul>

                <h4>Remedies for Female</h4>
                <ul>
                    <li>Kumbh Vivah (a symbolic marriage ritual with a clay pot) before actual marriage.</li>
                    <li>Donating red clothes and masoor dal (red lentils) on Tuesdays.</li>
                    <li>Regular chanting of the Mangal Gayatri Mantra or Navagraha Stotra.</li>
                </ul>
            </div>

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
                        <span>How do I know my Mangal Dosha?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>To check Manglik Dosha, you need to calculate the position of Mars in the 1st, 2nd, 4th, 7th, 8th, or 12th house from the Ascendant chart or Moon chart. You can use our free Mangal Dosha Calculator for an accurate result.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>Which god can control Mangal?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>Lord Hanuman is considered the ruling deity for Mars. Worshipping Lord Hanuman regularly and reciting the Hanuman Chalisa helps mitigate the negative effects of Mangal.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>Which dosha is bad for marriage?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>Mangal Dosha is highly significant for marriage compatibility. A severe mismatch between a Manglik and a Non-Manglik can lead to disputes and marital discord, which is why matching Kundlis is crucial.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>In which house is Mars bad for marriage?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>Mars placed in the 7th House (house of marriage) and the 8th House (house of longevity and sudden events) are generally considered the most challenging for marital harmony.</p>
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
