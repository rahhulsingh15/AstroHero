@extends('frontend.layouts.master')
@section('title', 'Name Compatibility of ' . $name1 . ' and ' . $name2 . ' - ' . $report['percent'] . '%')
@section('content')
    @php
        $first = $report['first'];
        $second = $report['second'];
    @endphp
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('name-compatibility-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Result card -->
            <div class="calc-result">
                <div class="calc-result-head">
                    <h2>Name Compatibility</h2>
                    <p>Your connection results</p>
                </div>
                <div class="calc-result-body">
                    <div class="calc-names">
                        <div class="calc-name-box">{{ $name1 }}</div>
                        <div class="calc-names-link">💞</div>
                        <div class="calc-name-box">{{ $name2 }}</div>
                    </div>

                    <div class="calc-ring" style="--percent: {{ $report['percent'] }};">
                        <div class="calc-ring-inner">
                            <strong>{{ $report['percent'] }}%</strong>
                            <span>MATCH</span>
                        </div>
                    </div>
                    <span class="calc-pill">{{ $report['band']['title'] }}</span>

                    <div class="calc-analysis">
                        <h4>Your Name Compatibility Analysis</h4>
                        <p>{{ $report['band']['text'] }}</p>
                    </div>
                </div>
            </div>

            <div class="calc-result-actions">
                <button type="button" class="btn-view-more" id="num-share-btn">Share It with others ↗</button>
                <a href="{{ route('name-compatibility-calculator') }}" class="btn-primary">Calculate Again</a>
            </div>

            <!-- How the score was worked out -->
            <div class="num-seo-content calc-reading">
                <h3>How your score was worked out</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Letter values (Chaldean)</th>
                            <th>Total</th>
                            <th>Name Number</th>
                            <th>Ruling Planet</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ([[$name1, $first], [$name2, $second]] as [$label, $data])
                            <tr>
                                <td><strong>{{ $label }}</strong></td>
                                <td>{{ implode(' + ', array_map(fn ($l) => $l['char'] . '(' . $l['value'] . ')', $data['letters'])) }}</td>
                                <td>{{ $data['total'] }}</td>
                                <td><strong>{{ $data['destiny'] }}</strong></td>
                                <td>{{ $data['details']['planet'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>Each name is turned into a number with the Chaldean chart and reduced to a single digit. Your name numbers are {{ $first['destiny'] }} and {{ $second['destiny'] }}, which are {{ $report['gap'] === 0 ? 'the same' : $report['gap'] . ' ' . ($report['gap'] === 1 ? 'step' : 'steps') . ' apart' }}. The score is 100% when the two numbers are equal and drops by 10 for every step between them, down to a minimum of 40%.</p>

                <h3>The other numbers in your names</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Number</th>
                            <th>What it shows</th>
                            <th>{{ $name1 }}</th>
                            <th>{{ $name2 }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ([
                            ['Name Number', 'Your overall nature', 'destiny'],
                            ['Soul Urge Number', 'What you want at heart (from the vowels)', 'soulUrge'],
                            ['Personality Number', 'How others see you (from the consonants)', 'personality'],
                        ] as [$label, $shows, $key])
                            <tr>
                                <td><strong>{{ $label }}</strong></td>
                                <td>{{ $shows }}</td>
                                <td>{{ $first[$key] ?: '-' }}</td>
                                <td>{{ $second[$key] ?: '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3>What each score means</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Score</th>
                            <th>Match</th>
                            <th>Meaning</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (array_reverse(\App\Helpers\NumerologyHelper::MATCH_BANDS, true) as $score => $band)
                            <tr>
                                <td>{{ $score }}%</td>
                                <td><strong>{{ $band[1] }}</strong>{{ $score === $report['percent'] ? ' (yours)' : '' }}</td>
                                <td>{{ $band[2] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>Name compatibility is a quick first look. Traditional <a href="{{ route('kundli-matching') }}">kundli matching</a>, which uses the birth charts of both people, is far more detailed.</p>
            </div>

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>Thinking about marriage or a business partnership?</h3>
                    <p>Talk to an expert for a complete compatibility reading.</p>
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
                const title = 'Check our Name Compatibility';
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
