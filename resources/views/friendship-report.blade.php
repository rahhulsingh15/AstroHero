@extends('frontend.layouts.master')
@section('title', 'Friendship Compatibility of ' . $name1 . ' and ' . $name2 . ' - ' . $report['percent'] . '%')
@section('content')
    @php
        $first = $report['first'];
        $second = $report['second'];
    @endphp
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('friendship-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Result card -->
            <div class="calc-result">
                <div class="calc-result-head">
                    <h2>Friendship Compatibility</h2>
                    <p>Your connection results</p>
                </div>
                <div class="calc-result-body">
                    <div class="calc-names">
                        <div class="calc-name-box">{{ $name1 }}</div>
                        <div class="calc-names-link">🤝</div>
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
                        <h4>Your Friendship Analysis</h4>
                        <p>{{ $report['band']['text'] }}</p>
                    </div>
                </div>
            </div>

            <div class="calc-result-actions">
                <button type="button" class="btn-view-more" id="num-share-btn">Share It with others ↗</button>
                <a href="{{ route('friendship-calculator') }}" class="btn-primary">Calculate Again</a>
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
                <p>Each name is turned into a number with the Chaldean chart and reduced to a single digit. Your name numbers are {{ $first['destiny'] }} and {{ $second['destiny'] }}, which are {{ $report['gap'] === 0 ? 'the same' : $report['gap'] . ' ' . ($report['gap'] === 1 ? 'step' : 'steps') . ' apart' }}. The score is 100% when the two numbers are equal and drops by 10 for every step between them, down to a minimum of 40%. The same two names always give the same score.</p>
                @if ($report['common'] !== '')
                    <p>Letters your names share: {{ $report['common'] }}.</p>
                @endif

                <h3>What each score means</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Score</th>
                            <th>Bond</th>
                            <th>Meaning</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (array_reverse(\App\Helpers\NumerologyHelper::MATCH_BANDS, true) as $score => $band)
                            <tr>
                                <td>{{ $score }}%</td>
                                <td><strong>{{ $band[0] }}</strong>{{ $score === $report['percent'] ? ' (yours)' : '' }}</td>
                                <td>{{ $band[2] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>The score is meant for fun. Real friendship depends on trust, time and effort, which no calculator can measure.</p>
            </div>

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>Curious what your numbers say about you?</h3>
                    <p>Talk to an expert numerologist for a personal reading.</p>
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
                const title = 'Check our Friendship Compatibility';
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
