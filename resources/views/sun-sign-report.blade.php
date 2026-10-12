@extends('frontend.layouts.master')
@section('title', $name . "'s Sun Sign Report - " . $report['western']['sign'])
@section('content')
    @php
        $sun = $report['western'];
        $vedic = $report['vedic'];
        $p = $report['profile'];
    @endphp
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('sun-sign-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Name Title -->
            <div class="num-report-header">
                <h2>{{ $name }}'s <span class="highlight">Sun Sign is {{ $sun['sign'] }}</span></h2>
                <span class="num-system-tag">Born on {{ $birth->format('d F Y') }}</span>
            </div>

            <!-- Sun sign in both zodiacs -->
            <div class="num-main-grid calc-grid-3">
                <div class="num-stat-card">
                    <div class="num-circle is-picture"><img src="{{ asset('assets/images/' . sprintf('horoscope-%02d.avif', array_search($sun['sign'], \App\Helpers\TransitHelper::SIGNS) + 1)) }}" alt="{{ $sun['sign'] }}"></div>
                    <h4>Western Astrology: {{ $sun['sign'] }}</h4>
                    <p>Based on the Tropical Zodiac<br>{{ $report['dates'] }}<br>Element: {{ $sun['element'] }} · Ruling Planet: {{ $sun['lord'] }}<br>Sun at {{ $sun['degree'] }}° {{ sprintf('%02d', $sun['minute']) }}′ {{ $sun['sign'] }}</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle is-picture"><img src="{{ asset('assets/images/' . sprintf('horoscope-%02d.avif', array_search($vedic['sign'], \App\Helpers\TransitHelper::SIGNS) + 1)) }}" alt="{{ $vedic['sign'] }}"></div>
                    <h4>Vedic Astrology: {{ $vedic['sign'] }}</h4>
                    <p>Based on the Sidereal Zodiac<br>{{ $report['vedicDates'] }}<br>Element: {{ $vedic['element'] }} · Ruling Planet: {{ $vedic['lord'] }}<br>Sun at {{ $vedic['degree'] }}° {{ sprintf('%02d', $vedic['minute']) }}′ {{ $vedic['hindi'] }}</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-pink">{{ ['Fire' => '🔥', 'Earth' => '🌍', 'Air' => '🌬️', 'Water' => '💧'][$sun['element']] }}</div>
                    <h4>{{ $sun['element'] }} Sign</h4>
                    <p>{{ $sun['sign'] }} is {{ $sun['quality'] }} in nature and is ruled by {{ $sun['lord'] }}.</p>
                </div>
            </div>

            <div class="num-breakdown">
                <h4>Your Astrological Profile</h4>
                <p class="num-breakdown-note">
                    Born on {{ $birth->format('d F Y') }}{{ $timeUnknown ? '' : ', ' . $birth->format('h:i A') }} in {{ $place }}
                </p>
                <p class="num-breakdown-note">Your Western Sun Sign is {{ $sun['sign'] }}{{ $sun['sign'] === $vedic['sign'] ? ', and your Vedic Sun Sign is the same.' : ', while your Vedic Sun Sign is ' . $vedic['sign'] . '.' }} Western astrology uses the Tropical zodiac, which follows the seasons, while Vedic astrology uses the Sidereal zodiac, which follows the fixed stars.</p>
                @if ($report['nearCusp'])
                    <p class="num-breakdown-note">You were born on the day the Sun changed sign. {{ $timeUnknown ? 'Birth time was not given, so 12:00 noon was used, and your Sun sign may be the neighbouring one. Enter your exact time of birth to be certain.' : 'Your sign has been worked out from your exact time of birth, so please make sure the time is correct.' }}</p>
                @endif
            </div>

            <!-- What the sign says -->
            <div class="num-seo-content calc-reading">
                <h3>{{ $sun['sign'] }} ({{ $report['dates'] }})</h3>
                <p>{{ $p['sun'] }}</p>
                <ul>
                    <li><strong>Strengths:</strong> {{ $p['strengths'] }}</li>
                    <li><strong>Watch out for:</strong> {{ $p['weaknesses'] }}</li>
                    <li><strong>Gets along best with:</strong> {{ $p['compatible'] }}</li>
                </ul>
            </div>

            <!-- Details of the sign -->
            <div class="traits-grid">
                @foreach ([
                    ['🪐', 'Ruling Planet', $sun['lord']],
                    ['🌿', 'Element', $sun['element']],
                    ['🔁', 'Quality', $sun['quality']],
                    ['🗓️', 'Sun Sign Dates', $report['dates']],
                    ['📅', 'Favourable Day', $report['luck']['day']],
                    ['🎨', 'Favourable Colour', $report['luck']['colour']],
                    ['🔢', 'Favourable Number', $report['luck']['number']],
                    ['💎', 'Gemstone', $report['luck']['gem']],
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

            @if ($sun['sign'] !== $vedic['sign'])
                <div class="num-seo-content calc-reading">
                    <h3>Your Vedic Sun sign: {{ $vedic['sign'] }} ({{ $report['vedicDates'] }})</h3>
                    <p>{{ $report['vedicProfile']['sun'] }}</p>
                    <ul>
                        <li><strong>Strengths:</strong> {{ $report['vedicProfile']['strengths'] }}</li>
                        <li><strong>Watch out for:</strong> {{ $report['vedicProfile']['weaknesses'] }}</li>
                    </ul>
                </div>
            @endif

            <div class="num-seo-content calc-reading">
                <h3>Why are there two Sun signs?</h3>
                <p>Western astrology measures the zodiac from the spring equinox, while Vedic astrology measures it against the fixed stars. The two have drifted about 24° apart, so the Vedic Sun sign is often one sign behind the Western one. Your Western Sun sign is {{ $sun['sign'] }} and your Vedic Sun sign is {{ $vedic['sign'] }}{{ $sun['sign'] === $vedic['sign'] ? ', the same in both systems.' : '.' }} Read <a href="{{ route('horoscope.landing', ['period' => 'daily']) }}">daily horoscopes</a> with the sign of the system you follow.</p>
            </div>

            <div class="calc-result-actions">
                <button type="button" class="btn-view-more" id="num-share-btn">Share It with others ↗</button>
                <a href="{{ route('sun-sign-calculator') }}" class="btn-primary">Calculate Again</a>
            </div>

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>Your Sun sign is only one part of your chart.</h3>
                    <p>Talk to an astrologer to understand your Moon sign, rising sign and the planets together.</p>
                </div>
                <div class="banner-buttons">
                    <a href="{{ route('chat-with-astrologers') }}" class="btn-chat">Chat with Astrologer</a>
                    <a href="{{ route('talk-to-astrologers') }}" class="btn-call">Call Astrologer</a>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Share: phone share sheet where available, otherwise copy the report link
        const shareBtn = document.getElementById('num-share-btn');
        if (shareBtn) {
            shareBtn.addEventListener('click', async () => {
                const title = 'Check my Sun Sign Report';
                try {
                    if (navigator.share) {
                        await navigator.share({ title, url: location.href });
                    } else {
                        await navigator.clipboard.writeText(location.href);
                        shareBtn.textContent = 'Link copied ✓';
                        setTimeout(() => shareBtn.textContent = 'Share It with others ↗', 2000);
                    }
                } catch (e) {}
            });
        }
    </script>
@endsection
