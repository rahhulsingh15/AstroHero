@extends('frontend.layouts.master')
@section('title', $name . "'s Destiny Number Report - Bhagyank " . $report['bhagyank'])
@section('content')
    @php
        $d = $report['luck'];
        $t = $report['destiny'];
    @endphp
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('destiny-number-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Result card -->
            <div class="calc-result">
                <div class="calc-result-head">
                    <h2>{{ $name }}'s Destiny Number Report</h2>
                    <p>Born on {{ $birth->format('d F Y') }}</p>
                </div>
                <div class="calc-result-body">
                    <div class="calc-big-number">{{ $report['bhagyank'] }}</div>
                    <p class="calc-result-sub">Destiny Number</p>
                    <span class="calc-pill">{{ $t['title'] }}</span>

                    <div class="calc-analysis">
                        <h4>Destiny Number {{ $report['bhagyank'] }}: {{ $t['title'] }}</h4>
                        <p>{{ $t['path'] }}</p>
                    </div>
                </div>
            </div>

            <div class="calc-result-actions">
                <button type="button" class="btn-view-more" id="num-share-btn">Share It with others ↗</button>
                <a href="{{ route('destiny-number-calculator') }}" class="btn-primary">Calculate Again</a>
            </div>

            <!-- Three Main Numbers -->
            <div class="num-main-grid calc-grid-3">
                <div class="num-stat-card">
                    <div class="num-circle bg-pink">{{ $report['bhagyank'] }}</div>
                    <h4>Bhagyank (Destiny Number)</h4>
                    <p>From your full date of birth. Ruled by {{ $d['planet'] }}. Shows the direction of your life.</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-purple">{{ $report['mulank'] }}</div>
                    <h4>Mulank (Birth Number)</h4>
                    <p>From the day you were born. Shows your basic nature.</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-blue">{{ $report['namank'] }}</div>
                    <h4>Namank (Name Number)</h4>
                    <p>From the letters of your name (Chaldean system). {{ $report['nameRelation'] }} to your destiny number.</p>
                </div>
            </div>

            <!-- How the numbers were worked out -->
            <div class="num-breakdown">
                <h4>How your numbers add up</h4>
                <p class="num-breakdown-note">
                    <strong>Bhagyank:</strong> {{ $birth->format('d-m-Y') }} → {{ $report['bhagyankSteps'] }}
                </p>
                <p class="num-breakdown-note">
                    <strong>Mulank:</strong> day of birth {{ $birth->day }} → {{ $report['mulankSteps'] }}
                </p>
            </div>

            <!-- What this destiny number says -->
            <div class="num-seo-content calc-reading">
                <h3>Destiny Number {{ $report['bhagyank'] }}: {{ $t['title'] }}</h3>
                <p>{{ $t['path'] }}</p>
                <ul>
                    <li><strong>Work that suits you:</strong> {{ $t['work'] }}</li>
                    <li><strong>The lesson that keeps returning:</strong> {{ $t['lesson'] }}</li>
                    <li><strong>Numbers that support you:</strong> {{ $report['friendly'] }}</li>
                    <li><strong>Numbers to be careful with:</strong> {{ $report['avoid'] }}</li>
                </ul>
                <p>
                    Your name number is {{ $report['namank'] }}, which is {{ strtolower($report['nameRelation']) }} to your destiny number {{ $report['bhagyank'] }}.
                    @if ($report['nameRelation'] === 'Friendly')
                        Your name supports the path your date of birth has set.
                    @elseif ($report['nameRelation'] === 'Unfriendly')
                        Your name pulls a little against the path your date of birth has set. Check it in the <a href="{{ route('lucky-name-numerology-calculator') }}">Lucky Name Calculator</a>.
                    @else
                        Your name neither helps nor hinders the path your date of birth has set.
                    @endif
                </p>
            </div>

            <!-- Details for the destiny number -->
            <div class="traits-grid">
                @foreach ([
                    ['🪐', 'Ruling Planet', $d['planet']],
                    ['🔢', 'Favourable Number', $d['numbers']],
                    ['📅', 'Favourable Day(s)', $d['days']],
                    ['🎨', 'Auspicious Colour', $d['colours']],
                    ['💎', 'Gemstone', $d['gemstone']],
                    ['♈', 'Favourable Sign', $d['signs']],
                    ['🧭', 'Direction', $d['direction']],
                    ['🙏', 'God/Goddess', $d['deity']],
                    ['🌙', 'Fast', $d['fast']],
                    ['🕉️', 'Mantra', $d['mantra']],
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

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>Want to know what your destiny number means for career and money?</h3>
                    <p>Talk to an expert numerologist for a personal reading.</p>
                </div>
                <div class="banner-buttons">
                    <a href="{{ route('chat-with-astrologers') }}" class="btn-chat">Chat with Astrologer</a>
                    <a href="{{ route('talk-to-astrologers') }}" class="btn-call">Call Astrologer</a>
                </div>
            </div>

            <!-- All destiny numbers -->
            <div class="num-seo-content">
                <h3>All destiny numbers</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Destiny Number</th>
                            <th>Ruling Planet</th>
                            <th>Known as</th>
                            <th>Work that suits</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (\App\Helpers\NumerologyHelper::DESTINY_TRAITS as $number => $traits)
                            <tr>
                                <td>{{ $number }}</td>
                                <td>{{ \App\Helpers\NumerologyHelper::DETAILS[$number]['planet'] }}</td>
                                <td>{{ $traits['title'] }}</td>
                                <td>{{ $traits['work'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        // Share: phone share sheet where available, otherwise copy the report link
        const shareBtn = document.getElementById('num-share-btn');
        if (shareBtn) {
            shareBtn.addEventListener('click', async () => {
                const title = 'Check my Destiny Number Report';
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
