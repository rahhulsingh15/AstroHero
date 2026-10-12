@extends('frontend.layouts.master')
@section('title', 'Lo Shu Grid Calculator Result for ' . $birth->format('d F Y'))
@section('content')
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('lo-shu-grid-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Title -->
            <div class="num-report-header">
                <h2>Lo Shu Grid <span class="highlight">Calculator Result</span></h2>
                <span class="num-system-tag">Born on {{ $birth->format('d F Y') }}</span>
            </div>

            <!-- The grid: every number keeps its own box -->
            <div class="loshu-grid">
                @foreach (\App\Helpers\NumerologyHelper::LOSHU_GRID as $gridRow)
                    @foreach ($gridRow as $number)
                        @php $cell = $report['numbers'][$number]; @endphp
                        <div class="loshu-cell {{ $cell['count'] ? '' : 'is-missing' }}">
                            <div class="loshu-digits">{{ $cell['count'] ? implode(' ', array_fill(0, $cell['count'], $number)) : $number . ' ✗' }}</div>
                            <small class="loshu-keywords">{{ $cell['keywords'] }}</small>
                            <small class="loshu-meta">Element: {{ $cell['element'] }}</small>
                            <small class="loshu-meta">Planet: {{ $cell['planet'] }}</small>
                            <small class="loshu-meta">Merit: {{ $cell['merit'] }}</small>
                            <small class="loshu-meta">Direction: {{ $cell['direction'] }}</small>
                        </div>
                    @endforeach
                @endforeach
            </div>

            <div class="num-breakdown">
                <h4>How your grid was filled</h4>
                <p class="num-breakdown-note"><strong>Digits of your date of birth:</strong> {{ $report['digits'] }} (zero is not placed)</p>
                <p class="num-breakdown-note"><strong>Driver Number (Mulank):</strong> {{ $report['mulank'] }} · <strong>Conductor Number (Bhagyank):</strong> {{ $report['bhagyank'] }}. Both are added to the grid.</p>
                <p class="num-breakdown-note">A box marked ✗ is a number missing from your grid.</p>
            </div>

            <div class="calc-result-actions">
                <button type="button" class="btn-view-more" id="num-share-btn">Share It with others ↗</button>
                <a href="{{ route('lo-shu-grid-calculator') }}" class="btn-primary">Calculate Again</a>
            </div>

            <!-- Numbers present -->
            <div class="num-seo-content calc-reading">
                <h3>🔷 Numbers Present in Your Lo Shu Grid</h3>
                @foreach ($report['present'] as $number => $row)
                    <h4>{{ $number }} · {{ $row['name'] }}{{ $row['count'] > 1 ? ' (' . $row['count'] . ' times)' : '' }}</h4>
                    <p>{{ $row['text'] }}</p>
                @endforeach
            </div>

            <!-- Numbers missing -->
            <div class="num-seo-content calc-reading">
                <h3>🔶 Numbers Missing from Your Grid</h3>
                @forelse ($report['missing'] as $number => $row)
                    <h4>{{ $number }} · {{ $row['name'] }}</h4>
                    <p>{{ $row['text'] }}</p>
                @empty
                    <p>No number is missing. Every box of your grid is filled, which is rare and shows a well-balanced set of qualities.</p>
                @endforelse
                @if ($report['missing'])
                    <p>A missing number is not bad luck. It points to a quality that does not come by itself and has to be built with practice. Many people keep the missing number around them, for example in a phone number, a house number or the date on which they begin important work.</p>
                @endif
            </div>

            <!-- Complete lines -->
            <div class="num-seo-content calc-reading">
                <h3>Complete lines (planes) in your grid</h3>
                @if ($report['planes'])
                    <p>A line is complete when all three of its numbers are present. Your grid has:</p>
                    <ul>
                        @foreach ($report['planes'] as $plane)
                            <li><strong>{{ $plane['name'] }} ({{ $plane['numbers'] }}):</strong> {{ $plane['text'] }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>A line is complete when all three of its numbers are present. Your grid has no complete row, column or diagonal, which is common. The qualities of your missing numbers are the ones to build with effort.</p>
                @endif
            </div>

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>Want remedies for the missing numbers in your grid?</h3>
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
                const title = 'Check my Lo Shu Grid';
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
