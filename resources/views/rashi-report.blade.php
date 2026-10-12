@extends('frontend.layouts.master')
@section('title', $name . "'s Rashi Report - " . $report['hindi'] . ' (' . $report['sign'] . ')')
@section('content')
    @php
        $p = $report['profile'];
    @endphp
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('rashi-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Name Title -->
            <div class="num-report-header">
                <h2>{{ $name }}'s <span class="highlight">Rashi Report</span></h2>
                <span class="num-system-tag">Your Rashi: {{ $report['sign'] }} ({{ $report['hindi'] }})</span>
            </div>

            <!-- Moon sign, star and lord -->
            <div class="num-main-grid calc-grid-3">
                <div class="num-stat-card">
                    <div class="num-circle is-picture"><img src="{{ asset('assets/images/' . sprintf('horoscope-%02d.avif', array_search($report['sign'], \App\Helpers\TransitHelper::SIGNS) + 1)) }}" alt="{{ $report['sign'] }}"></div>
                    <h4>Rashi: {{ $report['hindi'] }}</h4>
                    <p>{{ $report['sign'] }}. The Moon was at {{ $report['degree'] }}° {{ sprintf('%02d', $report['minute']) }}′ of this sign when you were born.</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-pink">☆</div>
                    <h4>Nakshatra: {{ $report['nakshatra'] }}</h4>
                    <p>Pada {{ $report['pada'] }}. The star the Moon was in at your birth.</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-blue">{{ \App\Helpers\DashaHelper::SYMBOLS[$report['lord']] }}</div>
                    <h4>Rashi Lord: {{ $report['lord'] }}</h4>
                    <p>The planet that rules {{ $report['hindi'] }} rashi and guides your mind.</p>
                </div>
            </div>

            <div class="num-breakdown">
                <h4>Personal Details</h4>
                <dl class="calc-details">
                    <div><dt>Name</dt><dd>{{ $name }}</dd></div>
                    <div><dt>Gender</dt><dd>{{ ucfirst($gender) }}</dd></div>
                    <div><dt>Date of Birth</dt><dd>{{ $birth->format('d F Y') }}</dd></div>
                    <div><dt>Time of Birth</dt><dd>{{ $timeUnknown ? 'Not known (12:00 PM used)' : $birth->format('h:i A') }}</dd></div>
                    <div><dt>Place of Birth</dt><dd>{{ $place }}</dd></div>
                </dl>
                @if ($timeUnknown)
                    <p class="num-breakdown-note">Birth time was not given, so 12:00 noon was used. The Moon changes sign about every two and a quarter days, so if it changed sign on your day of birth your rashi may be the neighbouring one.</p>
                @elseif ($report['nearCusp'])
                    <p class="num-breakdown-note">The Moon was within one degree of the border between two signs. A birth time that is off by an hour or two could change your rashi, so please confirm your exact time of birth.</p>
                @endif
            </div>

            <!-- What the rashi says -->
            <div class="num-seo-content calc-reading">
                <h3>{{ $report['hindi'] }} Rashi: your mind and nature</h3>
                <p>{{ $p['moon'] }}</p>
                <ul>
                    <li><strong>Strengths:</strong> {{ $p['strengths'] }}</li>
                    <li><strong>Watch out for:</strong> {{ $p['weaknesses'] }}</li>
                    <li><strong>Gets along best with:</strong> {{ $p['compatible'] }}</li>
                </ul>
            </div>

            <!-- Details of the rashi -->
            <div class="traits-grid">
                @foreach ([
                    ['🪐', 'Rashi Lord', $report['lord']],
                    ['🌿', 'Element', $report['element']],
                    ['🔁', 'Quality', $report['quality']],
                    ['🔤', 'Name Letters for this Rashi', $report['syllables']],
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

            <div class="num-seo-content calc-reading">
                <h3>Where to use your rashi</h3>
                <p>Read your <a href="{{ route('horoscope.landing', ['period' => 'daily']) }}">daily horoscope</a> for {{ $report['sign'] }}, check <a href="{{ route('shani-sade-sati-calculator') }}">Sade Sati</a> from this Moon sign, and see your planetary periods in the <a href="{{ route('dasha-calculator') }}">Dasha Calculator</a>. The gemstone shown is the stone of the rashi lord; wear it only after a full chart reading.</p>
            </div>

            <div class="calc-result-actions">
                <button type="button" class="btn-view-more" id="num-share-btn">Share It with others ↗</button>
                <a href="{{ route('rashi-calculator') }}" class="btn-primary">Calculate Again</a>
            </div>

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>Want to know what your rashi means for career and marriage?</h3>
                    <p>Talk to a Vedic astrologer for a reading of your complete birth chart.</p>
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
                const title = 'Check my Rashi Report';
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
