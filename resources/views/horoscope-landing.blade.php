@extends('frontend.layouts.master')
@section('title', $periods[$period]['title'])
@section('content')

@php
    $current = $periods[$period];
    $title = $current['title'];
    $span = strtolower($current['suffix']); // today, tomorrow, this week, this month, this year

    $lifeAreas = [
        ['icon' => '💞', 'name' => 'Love', 'text' => 'How the 5th and 7th houses from your rashi are placed: romance, marriage, family bonds and the mood between you and your partner.'],
        ['icon' => '💼', 'name' => 'Career', 'text' => 'What the 10th and 6th houses say about work pressure, recognition, studies, interviews and dealing with colleagues.'],
        ['icon' => '💸', 'name' => 'Money', 'text' => 'The 2nd and 11th houses show income, savings and gains, and when it is wiser to hold back on spending or lending.'],
        ['icon' => '🛡️', 'name' => 'Health', 'text' => 'The 1st, 6th and 8th houses point to your energy levels, stress and the routines that need a little more care.'],
    ];

    $benefits = [
        ['icon' => '🧭', 'name' => 'Clearer decisions', 'text' => 'Knowing which area is supported and which is under strain helps you choose what to take up now and what to leave for later.'],
        ['icon' => '🌙', 'name' => 'Understanding your moods', 'text' => 'The Moon governs the mind. Seeing where it sits explains why some days feel light and others feel heavy, without blaming yourself.'],
        ['icon' => '⏳', 'name' => 'Better timing', 'text' => 'The same effort gives different results at different times. A reading helps you pick a better day for the things that matter.'],
    ];

    $planets = [
        ['Sun (Surya)', 'Soul, confidence, father, authority and government matters.'],
        ['Moon (Chandra)', 'Mind, emotions, mother, sleep and peace at home.'],
        ['Mars (Mangal)', 'Courage, energy, property, siblings and anger.'],
        ['Mercury (Budh)', 'Speech, intellect, business, studies and communication.'],
        ['Jupiter (Guru)', 'Wisdom, luck, children, teachers and wealth.'],
        ['Venus (Shukra)', 'Love, marriage, comfort, beauty and the arts.'],
        ['Saturn (Shani)', 'Discipline, hard work, delays, duty and long-term results.'],
        ['Rahu', 'Ambition, sudden change, foreign links and illusion.'],
        ['Ketu', 'Detachment, spirituality, past karma and intuition.'],
    ];

    $tools = [
        ['route' => 'love-calculator', 'icon' => '❤️', 'name' => 'Love Calculator', 'text' => 'Check how well two names match.'],
        ['route' => 'numerology-calculator', 'icon' => '🔢', 'name' => 'Numerology Calculator', 'text' => 'Find your numbers and what they mean.'],
        ['route' => 'mangal-dosha-calculator', 'icon' => '🔥', 'name' => 'Mangal Dosha Calculator', 'text' => 'See whether Mars affects your marriage chart.'],
        ['route' => 'dasha-calculator', 'icon' => '🪐', 'name' => 'Dasha Calculator', 'text' => 'Know which planetary period you are running.'],
        ['route' => 'moon-phase-calculator', 'icon' => '🌗', 'name' => 'Moon Phase Calculator', 'text' => 'Find the Moon phase on any date.'],
        ['route' => 'flames-calculator', 'icon' => '🔥', 'name' => 'FLAMES Calculator', 'text' => 'Find the bond between two names.'],
        ['route' => 'rising-ascendant-sign-calculator', 'icon' => '🌅', 'name' => 'Rising Sign Calculator', 'text' => 'Discover your ascendant (lagna).'],
    ];

    $steps = [
        'Find your zodiac sign in the grid at the top of this page. If you are not sure, match your date of birth with the date range on each card.',
        'Tap your sign to open its full reading for ' . $span . '.',
        'Read the main prediction first, then look at the scores for love, career, money and health.',
        'Note the lucky colour, lucky number and auspicious time shown beside the reading.',
        'Use the Daily, Tomorrow, Weekly, Monthly and Yearly tabs to compare the short-term picture with the long-term one.',
    ];

    $faqs = [
        ['How is this horoscope prepared?', 'Planet positions are calculated for the date using the sidereal zodiac with Lahiri ayanamsa. The reading is then written from the house each planet occupies from your sign, following classical Vedic gochar (transit) rules.'],
        ['Should I read it by my Moon sign or my Sun sign?', 'Vedic astrology reads transits from the Moon sign (rashi). If you know your rashi, use that. If you only know your date of birth, the date range on each card gives your Sun sign, which is a good place to start.'],
        ['How accurate is a horoscope?', 'A sign-based horoscope is general guidance for everyone born under that sign, so it cannot be exact for one person. For a personal prediction your full birth chart, with date, time and place of birth, has to be studied.'],
        ['Can a horoscope predict a specific event?', 'It shows favourable and difficult periods and the areas of life they touch. It does not promise a particular event, and it should not replace medical, legal or financial advice.'],
        ['What should I do if my reading looks difficult?', 'Treat it as a caution, not a verdict. Slow down in that area, avoid big risks for the period, and follow the simple remedy suggested in the reading. For anything serious, speak to an astrologer.'],
    ];
@endphp

<!-- Banner & Breadcrumb Section -->
<section class="view-all-astrologers">
    <div class="view-all-astrologers-container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}">HOME</a>
            <span class="separator">›</span>
            <span class="current">{{ $title }}</span>
        </div>
        <div class="astrologers-banner">
            <div class="banner-content">
                <div class="banner-text">
                    <h1>{{ $title }}</h1>
                    <p>{{ $current['intro'] }}</p>
                    <div>
                        <a href="{{ route('chat-with-astrologers') }}" class="hl-btn">Chat with an astrologer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="tab_section">
    <div class="tab_container">
        <!-- Daily / Tomorrow / Weekly / Monthly / Yearly -->
        <div class="tabs-nav">
            @foreach($periods as $slug => $p)
                <a href="{{ route('horoscope.landing', ['period' => $slug]) }}"
                   class="tab-btn {{ $slug === $period ? 'active' : '' }}">
                    {{ $p['tab'] }}
                </a>
            @endforeach
        </div>

        @include('frontend.partials.zodiac-grid', [
            'title' => 'Choose Your Sign',
            'subtitle' => 'Select your rashi to read ' . strtolower($title),
        ])

        <!-- What moves the sky -->
        <div class="hl-block">
            <h2 class="section-title">What shapes your horoscope {{ $span }}</h2>
            <p class="hl-text">{{ $current['sky'] }}</p>
        </div>

        <!-- Life areas -->
        <div class="hl-block">
            <h2 class="section-title">Four areas every reading covers</h2>
            <p class="section-subtitle">Each sign's reading looks at {{ $span }} through these four parts of life.</p>
            <div class="hl-grid hl-grid-4">
                @foreach($lifeAreas as $area)
                    <div class="hl-card">
                        <span class="hl-icon">{{ $area['icon'] }}</span>
                        <h3>{{ $area['name'] }}</h3>
                        <p>{{ $area['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Benefits -->
        <div class="hl-block">
            <h2 class="section-title">Why read your horoscope</h2>
            <p class="section-subtitle">A horoscope does not decide things for you. It gives you a little more to decide with.</p>
            <div class="hl-grid hl-grid-3">
                @foreach($benefits as $benefit)
                    <div class="hl-card">
                        <span class="hl-icon">{{ $benefit['icon'] }}</span>
                        <h3>{{ $benefit['name'] }}</h3>
                        <p>{{ $benefit['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Nine grahas -->
        <div class="hl-block">
            <h2 class="section-title">The nine grahas and what they govern</h2>
            <p class="section-subtitle">When a reading names a planet, this is the part of life it speaks for.</p>
            <div class="hl-grid hl-grid-3">
                @foreach($planets as [$planetName, $planetText])
                    <div class="hl-card">
                        <h3>{{ $planetName }}</h3>
                        <p>{{ $planetText }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- How to check -->
        <div class="hl-block">
            <h2 class="section-title">How to check your horoscope for {{ $span }}</h2>
            <ol class="hl-steps">
                @foreach($steps as $step)
                    <li>{{ $step }}</li>
                @endforeach
            </ol>
        </div>

        <!-- How to read -->
        <div class="hl-block">
            <h2 class="section-title">How to read it well</h2>
            <p class="hl-text">Read the prediction as a weather report for {{ $span }}, not as a fixed result. A good score means the effort you put in is likely to be rewarded; a low score means go slower and avoid unnecessary risk in that area. The planets named in the reading tell you why, so over time you will start to notice the same patterns in your own life.</p>
        </div>

        <!-- Free tools -->
        <div class="hl-block">
            <h2 class="section-title">Free astrology tools</h2>
            <p class="section-subtitle">Go a step beyond your sign with these free calculators.</p>
            <div class="hl-grid hl-grid-3">
                @foreach($tools as $tool)
                    <a href="{{ route($tool['route']) }}" class="hl-card hl-card-link">
                        <span class="hl-icon">{{ $tool['icon'] }}</span>
                        <h3>{{ $tool['name'] }}</h3>
                        <p>{{ $tool['text'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Talk to an astrologer -->
        <div class="hl-block hl-cta">
            <div>
                <h2 class="section-title">Want a reading made only for you?</h2>
                <p class="hl-text">A sign horoscope is the same for everyone born under it. An astrologer reads your own birth chart.</p>
            </div>
            <div class="hl-cta-actions">
                <a href="{{ route('chat-with-astrologers') }}" class="hl-btn">Chat with an astrologer</a>
                <a href="{{ route('talk-to-astrologers') }}" class="hl-btn hl-btn-outline">Talk to an astrologer</a>
            </div>
        </div>

        <!-- FAQs -->
        <div class="hl-block">
            <h2 class="section-title">Frequently asked questions</h2>
            <div class="hl-faqs">
                @foreach($faqs as [$question, $answer])
                    <details class="hl-faq">
                        <summary>{{ $question }}</summary>
                        <p>{{ $answer }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
