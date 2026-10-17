@extends('frontend.layouts.master')
@section('title', $name . "'s Mulank Report - Birth Number " . $report['mulank'])
@section('content')
    @php
        $d = $report['details'];
        $t = $report['traits'];
    @endphp
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('mulank-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Name Title -->
            <div class="num-report-header">
                <h2>{{ strtr($content->heading ?: "{name}'s Mulank Report", ['{name}' => $name]) }}</h2>
                <span class="num-system-tag">Born on {{ $birth->format('d F Y') }}</span>
            </div>

            <!-- Three Main Numbers -->
            <div class="num-main-grid calc-grid-3">
                <div class="num-stat-card">
                    <div class="num-circle bg-purple">{{ $report['mulank'] }}</div>
                    <h4>Mulank (Birth Number)</h4>
                    <p>From the day you were born. Shows your basic nature.</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-pink">{{ $report['bhagyank'] }}</div>
                    <h4>Bhagyank (Destiny Number)</h4>
                    <p>From your full date of birth. Shows the direction of your life.</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-blue">{{ $namank }}</div>
                    <h4>Namank (Name Number)</h4>
                    <p>From the letters of your name (Chaldean system).</p>
                </div>
            </div>

            <!-- How the numbers were worked out -->
            <div class="num-breakdown">
                <h4>How your numbers add up</h4>
                <p class="num-breakdown-note">
                    <strong>Mulank:</strong> day of birth {{ $birth->day }} → {{ $report['mulankSteps'] }}
                </p>
                <p class="num-breakdown-note">
                    <strong>Bhagyank:</strong> {{ $birth->format('d-m-Y') }} → {{ $report['bhagyankSteps'] }}
                </p>
            </div>

            <!-- What this Mulank says -->
            <div class="num-seo-content calc-reading">
                <h3>Mulank {{ $report['mulank'] }}: {{ $t['title'] }}</h3>
                <p>{{ $t['nature'] }}</p>
                <ul>
                    <li><strong>Strengths:</strong> {{ $t['strengths'] }}</li>
                    <li><strong>Watch out for:</strong> {{ $t['challenges'] }}</li>
                    <li><strong>Suitable careers:</strong> {{ $t['careers'] }}</li>
                </ul>
            </div>

            <!-- Details for the Mulank -->
            <div class="traits-grid">
                @foreach ([
                    ['🪐', 'Ruling Planet', $d['planet']],
                    ['🔢', 'Favourable Number', $d['numbers']],
                    ['📅', 'Favourable Day(s)', $d['days']],
                    ['🗓️', 'Favourable Date(s)', $d['dates']],
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

            <div class="view-more-container">
                <button type="button" class="btn-view-more" id="num-share-btn">Share this report ↗</button>
            </div>

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>Want to know what your numbers mean for marriage, career and money?</h3>
                    <p>Talk to an expert numerologist for a personal reading.</p>
                </div>
                <div class="banner-buttons">
                    <a href="{{ route('chat-with-astrologers') }}" class="btn-chat">Chat with Astrologer</a>
                    <a href="{{ route('talk-to-astrologers') }}" class="btn-call">Call Astrologer</a>
                </div>
            </div>

            <!-- More about Mulank -->
            <div class="num-seo-content">
                <h3>Mulank and Bhagyank</h3>
                <p>Mulank comes only from the day of the month you were born on, so it never changes and is shared by everyone born on those dates. Bhagyank adds the month and year as well, so it is more personal. Numerologists read both together: Mulank for your nature, Bhagyank for the path your life takes.</p>

                <h4>All Mulank numbers</h4>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Mulank</th>
                            <th>Born on</th>
                            <th>Ruling Planet</th>
                            <th>Nature</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (\App\Helpers\NumerologyHelper::MULANK_TRAITS as $number => $traits)
                            <tr>
                                <td>{{ $number }}</td>
                                <td>{{ \App\Helpers\NumerologyHelper::DETAILS[$number]['dates'] }}</td>
                                <td>{{ \App\Helpers\NumerologyHelper::DETAILS[$number]['planet'] }}</td>
                                <td>{{ $traits['title'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if(!empty($content->main_content))
                <div class="num-seo-content">
                    {!! strtr($content->main_content, ['{name}' => $name]) !!}
                </div>
            @endif
        </div>
    </section>

    @if(!empty($content->faq_content))
        <section class="acording_section">
            {!! $content->faq_content !!}
        </section>
    @endif

    <script>
        // Share: phone share sheet where available, otherwise copy the report link
        const shareBtn = document.getElementById('num-share-btn');
        if (shareBtn) {
            shareBtn.addEventListener('click', async () => {
                const title = 'Check my Mulank Report';
                try {
                    if (navigator.share) {
                        await navigator.share({ title, url: location.href });
                    } else {
                        await navigator.clipboard.writeText(location.href);
                        shareBtn.textContent = 'Link copied ✓';
                        setTimeout(() => shareBtn.textContent = 'Share this report ↗', 2000);
                    }
                } catch (e) {}
            });
        }

        // Accordion FAQ Logic
        document.querySelectorAll('.acord-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const item = btn.parentElement;
                const isActive = item.classList.contains('active');
                document.querySelectorAll('.acord-item').forEach(other => other.classList.remove('active'));
                if (!isActive) item.classList.add('active');
            });
        });
    </script>
@endsection
