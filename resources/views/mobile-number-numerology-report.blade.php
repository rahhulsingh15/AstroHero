@extends('frontend.layouts.master')
@section('title', 'Lucky Mobile Number Analysis - ' . $mobile)
@section('content')
    @php
        $status = $report['compatible'] ? 'Compatible' : 'Not Compatible';
    @endphp
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('mobile-number-numerology-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Result card -->
            <div class="calc-result">
                <div class="calc-result-head">
                    <h2>Lucky Mobile Number Analysis</h2>
                    <p>{{ $mobile }} · Born on {{ $birth->format('d F Y') }}</p>
                </div>
                <div class="calc-result-body">
                    <div class="calc-versus">
                        <div>
                            <span>Destiny Number</span>
                            <strong>{{ $report['destiny'] }}</strong>
                        </div>
                        <div>
                            <span>Mobile Number</span>
                            <strong>{{ $report['number'] }}</strong>
                        </div>
                    </div>

                    <div class="calc-big-emoji">{{ $report['compatible'] ? '👍' : '👎' }}</div>
                    <p class="calc-result-sub">Compatibility Status</p>
                    <span class="calc-pill {{ $report['compatible'] ? '' : 'is-care' }}">{{ $status }}</span>

                    <div class="calc-analysis">
                        <h4>{{ $status }}</h4>
                        <p>{{ $report['message'] }}</p>
                    </div>
                </div>
            </div>

            <div class="calc-result-actions">
                <button type="button" class="btn-view-more" id="num-share-btn">Share It with others ↗</button>
                <a href="{{ route('mobile-number-numerology-calculator') }}" class="btn-primary">Calculate Again</a>
            </div>

            <!-- How the numbers were worked out -->
            <div class="num-breakdown">
                <h4>How your numbers add up</h4>
                <p class="num-breakdown-note"><strong>Destiny Number:</strong> {{ $birth->format('d-m-Y') }} → {{ $report['destinySteps'] }}</p>
                <p class="num-breakdown-note"><strong>Mobile Number:</strong> {{ $report['steps'] }}</p>
            </div>

            <!-- What the mobile total stands for -->
            <div class="num-seo-content calc-reading">
                <h3>Mobile number {{ $report['number'] }}, ruled by {{ $report['planet'] }}</h3>
                <p>{{ $report['vibe'] }}</p>
                <ul>
                    <li><strong>Mobile totals that suit destiny number {{ $report['destiny'] }}:</strong> {{ $report['lucky'] }}</li>
                    <li><strong>Totals that do not suit it:</strong> {{ $report['unlucky'] }}</li>
                </ul>
            </div>

            <!-- Details of the number -->
            <div class="traits-grid">
                @foreach ([
                    ['🔢', 'Lucky Mobile Totals for You', $report['lucky']],
                    ['🪐', 'Planet of this Mobile Number', $report['planet']],
                    ['🎂', 'Your Mulank (Birth Number)', $report['mulank']],
                    ['🔁', 'Digit Used Most', $report['mostUsed'] !== null ? $report['mostUsed'] . ' (' . $report['mostCount'] . ' times)' : 'No digit repeats'],
                    ['➖', 'Digits Missing (1-9)', $report['missing'] !== '' ? $report['missing'] : 'None'],
                    ['📱', 'Last Four Digits', $report['lastFour'] . ' → ' . $report['lastNumber']],
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
                <h3>Choosing a new number</h3>
                <p>If you are picking a new mobile number, look for one whose ten digits reduce to {{ $report['lucky'] }}. These totals agree with your destiny number {{ $report['destiny'] }}. You do not need to change a number you already use; this is guidance, not a rule.</p>
            </div>

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>Want help choosing a lucky mobile number?</h3>
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
                const title = 'Check my Lucky Mobile Number Analysis';
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
