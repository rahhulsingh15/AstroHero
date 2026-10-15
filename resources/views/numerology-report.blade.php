@extends('frontend.layouts.master')
@section('title', $name . "'s Numerology Report - Destiny, Soul Urge & Personality Number")
@section('content')
    @php $d = $report['details']; @endphp
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('numerology-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Name Title -->
            <div class="num-report-header">
                <h2>{{ $name }}'s <span class="highlight">Numerology Report</span></h2>
                <span class="num-system-tag">{{ $report['systemLabel'] }}</span>
            </div>

            <!-- Four Main Numbers -->
            <div class="num-main-grid">
                <div class="num-stat-card">
                    <div class="num-circle bg-purple">{{ $report['total'] }}</div>
                    <h4>Numerology Total</h4>
                    <p>The total sum of all letters in your name</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-pink">{{ $report['destiny'] }}</div>
                    <h4>Destiny Number</h4>
                    <p>Your life path and ultimate purpose</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-blue">{{ $report['soulUrge'] }}</div>
                    <h4>Soul Urge Number</h4>
                    <p>Your inner desires and deepest motivations</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-green">{{ $report['personality'] }}</div>
                    <h4>Personality Number</h4>
                    <p>How others perceive you and your outer self</p>
                </div>
            </div>

            <!-- How the numbers were worked out -->
            <div class="num-breakdown">
                <h4>How your name adds up</h4>
                <div class="num-letters">
                    @foreach ($report['letters'] as $letter)
                        <div class="num-letter {{ $letter['vowel'] ? 'is-vowel' : '' }}">
                            <b>{{ $letter['char'] }}</b>
                            <span>{{ $letter['value'] }}</span>
                        </div>
                    @endforeach
                </div>
                <p class="num-breakdown-note">
                    All letters add up to <strong>{{ $report['total'] }}</strong>, which reduces to Destiny Number
                    <strong>{{ $report['destiny'] }}</strong>.
                    <span class="num-key is-vowel"></span> Vowels give the Soul Urge Number,
                    <span class="num-key"></span> consonants give the Personality Number.
                </p>
            </div>

            <!-- Details for the Destiny Number -->
            <div class="traits-grid">
                @foreach ([
                    ['👤', 'Name', $name],
                    ['♈', 'Favourable Sign', $d['signs']],
                    ['🔤', 'Favourable Alphabets', $report['alphabets']],
                    ['💎', 'Gemstone', $d['gemstone']],
                    ['📅', 'Favourable Day(s)', $d['days']],
                    ['🔢', 'Favourable Number', $d['numbers']],
                    ['🧭', 'Direction', $d['direction']],
                    ['🎨', 'Auspicious Colour', $d['colours']],
                    ['🪐', 'Ruling Planet', $d['planet']],
                    ['🙏', 'God/Goddess', $d['deity']],
                    ['🌙', 'Fast', $d['fast']],
                    ['🗓️', 'Favourable Date(s)', $d['dates']],
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
                    <h3>{{ $content->report_banner_title ?: 'Want deeper insights into your destiny?' }}</h3>
                    @if($content->report_banner_text)
                        <p>{{ $content->report_banner_text }}</p>
                    @endif
                </div>
                <div class="banner-buttons">
                    <a href="{{ route('chat-with-astrologers') }}" class="btn-chat">Chat with Astrologer</a>
                    <a href="{{ route('talk-to-astrologers') }}" class="btn-call">Call Astrologer</a>
                </div>
            </div>

            <!-- SEO Content & Tables (Admin > Numerology Calculator > Report Page) -->
            @if($content->report_content)
                <div class="num-seo-content">
                    {!! $content->report_content !!}
                </div>
            @endif

            <!-- Discover More Tools -->
            <div class="discover-more">
                <h3 style="text-align: center; color: var(--gold-soft); margin-bottom: 30px;">Discover More Astrology Tools</h3>
                <div class="calc-cards">
                    <a href="{{ route('love-calculator') }}" class="calc-card">
                        <span class="c-icon">❤️</span>
                        <h4>Love Calculator</h4>
                        <p>Check love percentage</p>
                    </a>
                    <a href="{{ route('rising-ascendant-sign-calculator') }}" class="calc-card">
                        <span class="c-icon">🌅</span>
                        <h4>Rising Sign Calculator</h4>
                        <p>Find your ascendant</p>
                    </a>
                    <a href="{{ route('dasha-calculator') }}" class="calc-card">
                        <span class="c-icon">🪐</span>
                        <h4>Dasha Calculator</h4>
                        <p>See your planetary periods</p>
                    </a>
                    <a href="{{ route('mangal-dosha-calculator') }}" class="calc-card">
                        <span class="c-icon">🔥</span>
                        <h4>Mangal Dosha Calculator</h4>
                        <p>Check for Manglik dosha</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        const topTicker = document.getElementById('top-ticker');
        if (topTicker) {
            topTicker.innerHTML += topTicker.innerHTML;
        }

        const menuToggle = document.getElementById('menu-toggle');
        const navLinks = document.getElementById('nav-links');

        if (menuToggle && navLinks) {
            menuToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                navLinks.classList.toggle('open');
            });

            document.addEventListener('click', (e) => {
                if (!navLinks.contains(e.target) && !menuToggle.contains(e.target)) {
                    navLinks.classList.remove('open');
                }
            });

            navLinks.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => navLinks.classList.remove('open'));
            });
        }

        // Share: phone share sheet where available, otherwise copy the report link
        const shareBtn = document.getElementById('num-share-btn');
        if (shareBtn) {
            shareBtn.addEventListener('click', async () => {
                const title = 'Check my Name Numerology Report';
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
    </script>
@endsection
