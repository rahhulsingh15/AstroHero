@extends('frontend.layouts.master')
@section('title', 'Lucky Vehicle Number Report - ' . $report['plate'] . ' - ' . $report['status'])
@section('content')
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('lucky-vehicle-number-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Result card -->
            <div class="calc-result">
                <div class="calc-result-head">
                    <h2>Lucky Vehicle Number Report</h2>
                    <p>{{ $report['plate'] }} · Born on {{ $birth->format('d F Y') }}</p>
                </div>
                <div class="calc-result-body">
                    <div class="calc-versus">
                        <div>
                            <span>Destiny Number</span>
                            <strong>{{ $report['destiny'] }}</strong>
                        </div>
                        <div>
                            <span>Vehicle Number</span>
                            <strong>{{ $report['number'] }}</strong>
                        </div>
                    </div>

                    <div class="calc-big-emoji">{{ ['full' => '🚗', 'ok' => '👍', 'no' => '⚠️'][$report['level']] }}</div>
                    <p class="calc-result-sub">Compatibility Status</p>
                    <span class="calc-pill {{ $report['level'] === 'no' ? 'is-care' : '' }}">{{ $report['status'] }}</span>

                    <div class="calc-analysis">
                        <h4>{{ $report['status'] }}</h4>
                        <p>{{ $report['message'] }}</p>
                    </div>
                </div>
            </div>

            <div class="calc-result-actions">
                <button type="button" class="btn-view-more" id="num-share-btn">Share It with others ↗</button>
                <a href="{{ route('lucky-vehicle-number-calculator') }}" class="btn-primary">Calculate Again</a>
            </div>

            <!-- How the numbers were worked out -->
            <div class="num-breakdown">
                <h4>How your numbers add up</h4>
                <p class="num-breakdown-note"><strong>Destiny Number:</strong> {{ $birth->format('d-m-Y') }} → {{ $report['destinySteps'] }}</p>
                <p class="num-breakdown-note"><strong>Vehicle Number:</strong> last four digits {{ $report['digits'] }} → {{ $report['steps'] }}</p>
            </div>

            <!-- What the vehicle number stands for -->
            <div class="num-seo-content calc-reading">
                <h3>Vehicle number {{ $report['number'] }}, ruled by {{ $report['planet'] }}</h3>
                <p>{{ $report['vibe'] }}</p>

                <h3>Vehicle numbers for destiny number {{ $report['destiny'] }}</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Result</th>
                            <th>Vehicle numbers</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="calc-tag is-good">Fully Compatible</span></td>
                            <td>{{ $report['friendly'] }}</td>
                        </tr>
                        <tr>
                            <td><span class="calc-tag is-good">Compatible</span></td>
                            <td>{{ $report['neutral'] !== '' ? $report['neutral'] : 'None' }}</td>
                        </tr>
                        <tr>
                            <td><span class="calc-tag is-care">Not Compatible</span></td>
                            <td>Every other number</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Details for the owner -->
            <div class="traits-grid">
                @foreach ([
                    ['🔢', 'Luckiest Vehicle Numbers for You', $report['friendly']],
                    ['🎨', 'Lucky Vehicle Colour', $report['colours']],
                    ['📅', 'Good Day to Buy or Take Delivery', $report['days']],
                    ['🪐', 'Planet of this Number', $report['planet']],
                    ['🎂', 'Your Mulank (Birth Number)', $report['mulank']],
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
                <h3>Choosing your next vehicle number</h3>
                <p>When you book a new number, pick four digits that reduce to {{ $report['friendly'] }}. These agree best with your destiny number {{ $report['destiny'] }}. If your present number is not compatible, there is no need to worry: many people simply keep a lucky colour for the vehicle and choose a compatible number the next time.</p>
            </div>

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>Buying a new vehicle? Choose the right number and day.</h3>
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
                const title = 'Check my Lucky Vehicle Number';
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
