@extends('frontend.layouts.master')
@section('title', $name . "'s Ishta Devata Results - " . $report['north'])
@section('content')
    @php
        $moon = $report['moon'];
        $atma = $report['atma'];
        $deity = $report['deity'];
        $symbols = \App\Helpers\DashaHelper::SYMBOLS;
    @endphp
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('ishta-devata-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Name Title -->
            <div class="num-report-header">
                <h2>{{ strtr($content->heading ?: "{name}'s Ishta Devata Results", ['{name}' => $name]) }}</h2>
                <span class="num-system-tag">Birth Star: {{ $moon['nakshatra'] }} · Lahiri Ayanamsa</span>
            </div>

            <!-- Deity of the birth star, as named in the North and in the South -->
            <div class="num-main-grid" style="grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));">
                <div class="num-stat-card">
                    <div class="num-circle bg-purple">🙏</div>
                    <p style="margin-bottom: 6px;">North</p>
                    <h4>{{ $moon['nakshatra'] }} - {{ $report['north'] }}</h4>
                    <p>{{ $report['about'] }}</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-pink">🛕</div>
                    <p style="margin-bottom: 6px;">South</p>
                    <h4>{{ $moon['nakshatra'] }} - {{ $report['south'] }}</h4>
                    <p>The name by which the deity of {{ $moon['nakshatra'] }} is worshipped in the South Indian tradition.</p>
                </div>
            </div>

            <div class="num-breakdown">
                <h4>Birth details used</h4>
                <p class="num-breakdown-note">
                    {{ $birth->format('d F Y') }}{{ $timeUnknown ? '' : ', ' . $birth->format('h:i A') }} · {{ $place }}
                </p>
                <p class="num-breakdown-note">Moon at {{ $moon['degree'] }}° {{ sprintf('%02d', $moon['minute']) }}′ {{ $moon['sign'] }}, in {{ $moon['nakshatra'] }} nakshatra, pada {{ $moon['pada'] }}</p>
                @if ($timeUnknown)
                    <p class="num-breakdown-note">Birth time was not given, so 12:00 noon was used. The Moon stays in one nakshatra for about a day, so the birth star is usually right, but the Jaimini result below may be different for your real birth time.</p>
                @elseif ($report['starCusp'])
                    <p class="num-breakdown-note">The Moon was very close to the border between two nakshatras. A birth time that is off by an hour could change your birth star and its deity, so please confirm your exact time of birth.</p>
                @endif
            </div>

            <div class="calc-result-actions">
                <button type="button" class="btn-view-more" id="num-share-btn">Share It with others ↗</button>
                <a href="{{ route('ishta-devata-calculator') }}" class="btn-primary">Calculate Again</a>
            </div>

            <!-- Why this deity -->
            <div class="num-seo-content calc-reading">
                <h3>{{ $report['north'] }}, the deity of your birth star</h3>
                <p>Every nakshatra has a presiding deity who gives the star its nature. You were born with the Moon in {{ $moon['nakshatra'] }}, whose deity is {{ $report['north'] }}{{ $report['north'] !== $report['south'] ? ', known in the South as ' . $report['south'] : '' }}. Because the Moon rules the mind, worship of the deity of the birth star is said to steady the mind and to bring protection through life.</p>
                <p>{{ $report['about'] }}</p>
            </div>

            <!-- The Jaimini method -->
            <div class="num-seo-content calc-reading">
                <h3>Your Ishta Devata by the Jaimini method: {{ $deity['deity'] }}</h3>
                <p>Jaimini astrology finds the Ishta Devata from the Atmakaraka, the soul planet, in the Navamsa chart. This is the deity who is said to guide the soul towards liberation.</p>
                <ul>
                    <li><strong>Step 1:</strong> Of the seven planets, {{ $atma['planet'] }} has crossed the most degrees in its sign ({{ $atma['degree'] }}° {{ sprintf('%02d', $atma['minute']) }}′ {{ $atma['sign'] }}), so it is your Atmakaraka.</li>
                    <li><strong>Step 2:</strong> In the Navamsa chart {{ $atma['planet'] }} falls in {{ $report['karakamsa'] }}. This is your Karakamsa.</li>
                    <li><strong>Step 3:</strong> The 12th sign from {{ $report['karakamsa'] }} is {{ $report['twelfth'] }}.
                        @if ($report['byLord'])
                            No planet is placed there in your Navamsa, so its lord, {{ $report['planet'] }}, shows the deity.
                        @else
                            {{ implode(' and ', $report['occupants']) }} {{ count($report['occupants']) > 1 ? 'are' : 'is' }} placed there in your Navamsa{{ count($report['occupants']) > 1 ? ', and ' . $report['planet'] . ', the strongest of them, shows the deity' : ', so it shows the deity' }}.
                        @endif
                    </li>
                    <li><strong>Result:</strong> {{ $report['planet'] }} stands for {{ $deity['deity'] }}{{ $deity['also'] ? ' (some traditions say ' . $deity['also'] . ')' : '' }}.</li>
                </ul>
                @if (!$timeUnknown && $report['nearCusp'])
                    <p>Your Atmakaraka is very close to the border between two Navamsa signs, so a small error in the birth time could change this result.</p>
                @endif
            </div>

            <!-- Details of the worship -->
            <div class="traits-grid">
                @foreach (array_filter([
                    ['⭐', 'Deity of the Birth Star', $report['north']],
                    ['🙏', 'Ishta Devata (Jaimini)', $deity['deity']],
                    $deity['also'] ? ['🛕', 'Also Worshipped', $deity['also']] : null,
                    ['🪐', 'Deity Planet', $report['planet']],
                    ['📅', 'Day of Worship', $deity['day']],
                    ['🕉️', 'Mantra', $deity['mantra']],
                    ['🌸', 'Offering', $deity['offering']],
                ]) as [$icon, $label, $value])
                    <div class="trait-card">
                        <span class="t-icon">{{ $icon }}</span>
                        <div class="t-info">
                            <span class="t-label">{{ $label }}</span>
                            <strong class="t-value">{{ $value }}</strong>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($report['others'])
                <div class="num-seo-content calc-reading">
                    <h3>Other deities shown in your chart</h3>
                    <p>More than one planet is in the 12th from your Karakamsa, so these deities are also favourable for you:</p>
                    <ul>
                        @foreach ($report['others'] as $other)
                            <li><strong>{{ $other['planet'] }}:</strong> {{ $other['deity'] }}. Mantra: {{ $other['mantra'] }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="num-seo-content calc-reading">
                <p>The deity of the birth star and the Ishta Devata of the Jaimini method are found in two different ways, so they are often two different deities. Both are favourable for you. Different traditions also give slightly different deities for the same planet, so treat this result as a guide and follow the form of the divine you feel drawn to.</p>
            </div>

            @if(!empty($content->main_content))
                <div class="num-seo-content calc-reading">
                    {!! strtr($content->main_content, ['{name}' => $name]) !!}
                </div>
            @endif

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>Want to know the right mantra and puja for you?</h3>
                    <p>Talk to a Vedic astrologer for guidance based on your full chart.</p>
                </div>
                <div class="banner-buttons">
                    <a href="{{ route('chat-with-astrologers') }}" class="btn-chat">Chat with Astrologer</a>
                    <a href="{{ route('talk-to-astrologers') }}" class="btn-call">Call Astrologer</a>
                </div>
            </div>
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
                const title = 'Check my Ishta Devata';
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
