@extends('frontend.layouts.master')
@section('title', $name . "'s Nakshatra Report - " . $report['nakshatra'])
@section('content')
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('nakshatra-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Name Title -->
            <div class="num-report-header">
                <h2><span class="highlight">{{ $report['nakshatra'] }} Nakshatra</span></h2>
                <span class="num-system-tag">{{ $name }}'s Birth Star Analysis</span>
            </div>

            <!-- Star, pada and lord -->
            <div class="num-main-grid calc-grid-3">
                <div class="num-stat-card">
                    <div class="num-circle bg-purple">{{ $report['number'] }}</div>
                    <h4>{{ $report['nakshatra'] }}</h4>
                    <p>The {{ $report['number'] }}{{ in_array($report['number'] % 100, [11, 12, 13]) ? 'th' : (['th', 'st', 'nd', 'rd'][$report['number'] % 10] ?? 'th') }} of the 27 nakshatras. The Moon was in this star when you were born.</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-pink">{{ $report['pada'] }}</div>
                    <h4>Pada {{ $report['pada'] }}</h4>
                    <p>The quarter of the nakshatra. Its name syllable is "{{ $report['padaSyllable'] }}".</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-blue">{{ \App\Helpers\DashaHelper::SYMBOLS[$report['nakLord']] }}</div>
                    <h4>Ruling Planet: {{ $report['nakLord'] }}</h4>
                    <p>Your life began in the {{ $report['nakLord'] }} Mahadasha of {{ $report['dashaYears'] }} years.</p>
                </div>
            </div>

            <div class="num-breakdown">
                <h4>Birth details used</h4>
                <p class="num-breakdown-note">
                    {{ $birth->format('d F Y') }}{{ $timeUnknown ? '' : ', ' . $birth->format('h:i A') }} · {{ $place }}
                </p>
                <p class="num-breakdown-note">Moon at {{ $report['degree'] }}° {{ sprintf('%02d', $report['minute']) }}′ {{ $report['sign'] }} ({{ $report['hindi'] }} rashi)</p>
                @if ($timeUnknown)
                    <p class="num-breakdown-note">Birth time was not given, so 12:00 noon was used. The Moon stays in one nakshatra for about a day and in one pada for about six hours, so the nakshatra is usually right but the pada may be different for your real birth time.</p>
                @elseif ($report['nearCusp'])
                    <p class="num-breakdown-note">The Moon was very close to the border between two nakshatras. A birth time that is off by an hour could change your nakshatra, so please confirm your exact time of birth.</p>
                @endif
            </div>

            <!-- What the nakshatra says -->
            <div class="num-seo-content calc-reading">
                <h3>Characteristics</h3>
                <p>{{ $report['nature'] }}</p>
                <p>{{ $report['nakshatra'] }} is ruled by {{ $report['nakLord'] }} and its presiding deity is {{ $report['deity'] }}. Its symbol is the {{ strtolower($report['nakSymbol']) }}.</p>

                <h3>Professional Life</h3>
                <p>{{ $report['career'] }}</p>

                <h3>Marriage &amp; Compatibility</h3>
                <p>{{ $report['marriage'] }}</p>

                <h3>Health</h3>
                <p>{{ $report['health'] }}</p>
            </div>

            <!-- The four quarters of the star -->
            <div class="num-seo-content calc-reading">
                <h3>Pada Analysis</h3>
                @foreach ($report['padas'] as $number => $pada)
                    <h4>Pada {{ $number }}{{ $number === $report['pada'] ? ' (your pada)' : '' }}</h4>
                    <p>{{ $pada['text'] }}</p>
                @endforeach
            </div>

            <!-- Details of the nakshatra -->
            <div class="traits-grid">
                @foreach ([
                    ['🪐', 'Ruling Planet', $report['nakLord']],
                    ['🙏', 'Deity', $report['deity']],
                    ['🔱', 'Symbol', $report['nakSymbol']],
                    ['🌙', 'Rashi (Moon Sign)', $report['hindi'] . ' (' . $report['sign'] . ')'],
                    ['👥', 'Gana', $report['gana']],
                    ['🐾', 'Yoni (Animal)', $report['animal']],
                    ['〰️', 'Nadi', $report['nadi']],
                    ['🔤', 'Name Syllable for Pada ' . $report['pada'], $report['padaSyllable']],
                    ['🔡', 'All Syllables of the Nakshatra', $report['syllables']],
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
                <h3>How these details are used</h3>
                <ul>
                    <li><strong>Name syllable:</strong> a baby's name traditionally begins with the syllable of the birth pada, here "{{ $report['padaSyllable'] }}".</li>
                    <li><strong>Gana, Yoni and Nadi:</strong> these three are compared with the partner's in <a href="{{ route('kundli-matching') }}">kundli matching</a>.</li>
                    <li><strong>Ruling planet:</strong> it decides the first Mahadasha of your life. See all your periods in the <a href="{{ route('dasha-calculator') }}">Dasha Calculator</a>.</li>
                </ul>
            </div>

            <div class="calc-result-actions">
                <button type="button" class="btn-view-more" id="num-share-btn">Share It with others ↗</button>
                <a href="{{ route('nakshatra-calculator') }}" class="btn-primary">Calculate Again</a>
            </div>

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>Want a name, muhurat or match based on your nakshatra?</h3>
                    <p>Talk to a Vedic astrologer for personal guidance.</p>
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
                const title = 'Check my Nakshatra Report';
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
