@extends('frontend.layouts.master')
@section('title', 'FLAMES Result for ' . $name1 . ' and ' . $name2 . ' - ' . $report['result']['title'])
@section('content')
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('flames-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Result card -->
            <div class="calc-result">
                <div class="calc-result-head">
                    <h2>FLAMES Result</h2>
                    <p>{{ $name1 }} 🔥 {{ $name2 }}</p>
                </div>
                <div class="calc-result-body">
                    <div class="calc-big-emoji">{{ $report['result']['emoji'] }}</div>
                    <h3>{{ $report['result']['title'] }}</h3>
                    <p class="calc-result-sub">{{ $report['letter'] }} is the letter left at the end of the count</p>

                    <div class="calc-analysis">
                        <h4>What it means</h4>
                        <p>{{ $report['result']['text'] }}</p>
                    </div>
                </div>
            </div>

            <div class="calc-result-actions">
                <button type="button" class="btn-view-more" id="num-share-btn">Share It with others ↗</button>
                <a href="{{ route('flames-calculator') }}" class="btn-primary">Calculate Again</a>
            </div>

            <!-- How the result was worked out -->
            <div class="num-breakdown">
                <h4>How your FLAMES was counted</h4>
                <p class="num-breakdown-note"><strong>Step 1:</strong> {{ $report['struck'] === '' ? 'The names have no letters in common, so nothing is struck out.' : 'Common letters struck out, one pair at a time: ' . $report['struck'] }}</p>
                <p class="num-breakdown-note"><strong>Step 2:</strong> Left in {{ $name1 }}: {{ $report['left1'] ?: 'nothing' }} · Left in {{ $name2 }}: {{ $report['left2'] ?: 'nothing' }} · Total {{ $report['count'] }}</p>
                <p class="num-breakdown-note"><strong>Step 3:</strong> Counting {{ $report['count'] }} along F L A M E S and striking the letter each count ends on:</p>
            </div>

            <div class="num-seo-content calc-reading">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Round</th>
                            <th>Letter struck off</th>
                            <th>Letters remaining</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($report['rounds'] as $i => $round)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $round['out'] }}</td>
                                <td><strong>{{ $round['left'] }}</strong></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3>What each letter means</h3>
                <ul>
                    @foreach (\App\Helpers\NumerologyHelper::FLAMES as $letter => $meaning)
                        <li><strong>{{ $meaning['emoji'] }} {{ $letter }} - {{ $meaning['title'] }}</strong>{{ $letter === $report['letter'] ? ' (your result)' : '' }}</li>
                    @endforeach
                </ul>
                <p>FLAMES is a game played for fun and has no basis in astrology. For a real compatibility check, try <a href="{{ route('kundli-matching') }}">Kundli Matching</a> or the <a href="{{ route('name-compatibility-calculator') }}">Name Compatibility Calculator</a>.</p>
            </div>

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>Want to know what the stars say about this bond?</h3>
                    <p>Talk to an astrologer for a real compatibility reading.</p>
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
                const title = 'Check our FLAMES result';
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
