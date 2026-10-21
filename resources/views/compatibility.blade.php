@extends('frontend.layouts.master')
@section('title', 'Zodiac Sign Compatibility | Love Compatibility by Sign')
@section('content')

    <section class="nnc-banner-section">
        <div class="container nnc-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">COMPATIBILITY</span>
            </div>
            <h1>Compatibility With Zodiac Signs</h1>
            <p class="nnc-subtitle">Some people feel easy to be with from the first meeting, and others take effort. Zodiac compatibility explains why, by comparing the nature of two signs in love, friendship and work. Choose your sign to see which signs suit you best.</p>
        </div>
    </section>

    <!-- Main Content & Sidebar -->
    <section class="km-main-section">
        <div class="container">
            <div class="km-split">
                <!-- Left Content -->
                <div class="km-left nnc-content-wrapper">
                    <!-- Choose Your Sign -->
                    <h3>Choose Your Sign</h3>
                    <div class="zodiac-grid">
                        @foreach ([
                            'Aries' => ['Mar 21 – Apr 19', 'horoscope-01.avif'],
                            'Taurus' => ['Apr 20 – May 20', 'horoscope-02.avif'],
                            'Gemini' => ['May 21 – Jun 20', 'horoscope-03.avif'],
                            'Cancer' => ['Jun 21 – Jul 22', 'horoscope-04.avif'],
                            'Leo' => ['Jul 23 – Aug 22', 'horoscope-05.avif'],
                            'Virgo' => ['Aug 23 – Sep 22', 'horoscope-06.avif'],
                            'Libra' => ['Sep 23 – Oct 22', 'horoscope-07.avif'],
                            'Scorpio' => ['Oct 23 – Nov 21', 'horoscope-08.avif'],
                            'Sagittarius' => ['Nov 22 – Dec 21', 'horoscope-09.avif'],
                            'Capricorn' => ['Dec 22 – Jan 19', 'horoscope-10.avif'],
                            'Aquarius' => ['Jan 20 – Feb 18', 'horoscope-11.avif'],
                            'Pisces' => ['Feb 19 – Mar 20', 'horoscope-12.avif'],
                        ] as $sign => [$dates, $image])
                            <a href="{{ route('compatibility.sign', ['sign' => strtolower($sign)]) }}" class="zodiac-card">
                                <img src="{{ asset('assets/images/' . $image) }}" alt="{{ $sign }}">
                                <h4>{{ $sign }}</h4>
                                <span>{{ $dates }}</span>
                            </a>
                        @endforeach
                    </div>

                    <h3>What Is Zodiac Compatibility?</h3>
                    <p>Every zodiac sign has an element, a ruling planet and a way of dealing with the world. When two signs share an element, or belong to elements that support each other, the relationship tends to flow. When they do not, the same relationship asks for more understanding from both sides.</p>
                    <p>Compatibility is not only about romance. It also tells you how you are likely to get along with a friend, a parent, a business partner or a colleague.</p>

                    <h3>Compatibility by Element</h3>
                    <div class="table-responsive">
                        <table class="nnc-table">
                            <thead>
                                <tr><th>Element</th><th>Signs</th><th>Nature</th><th>Gets Along Best With</th></tr>
                            </thead>
                            <tbody>
                                <tr><td>Fire</td><td>Aries, Leo, Sagittarius</td><td>Bold, energetic, expressive</td><td>Fire and Air</td></tr>
                                <tr><td>Earth</td><td>Taurus, Virgo, Capricorn</td><td>Practical, steady, loyal</td><td>Earth and Water</td></tr>
                                <tr><td>Air</td><td>Gemini, Libra, Aquarius</td><td>Curious, social, thoughtful</td><td>Air and Fire</td></tr>
                                <tr><td>Water</td><td>Cancer, Scorpio, Pisces</td><td>Emotional, caring, intuitive</td><td>Water and Earth</td></tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>Best Matches for Each Sign</h3>
                    <div class="table-responsive">
                        <table class="nnc-table">
                            <thead>
                                <tr><th>Sign</th><th>Element</th><th>Most Compatible Signs</th></tr>
                            </thead>
                            <tbody>
                                <tr id="match-aries"><td>Aries</td><td>Fire</td><td>Gemini, Leo, Libra, Sagittarius, Aquarius</td></tr>
                                <tr id="match-taurus"><td>Taurus</td><td>Earth</td><td>Cancer, Virgo, Scorpio, Capricorn, Pisces</td></tr>
                                <tr id="match-gemini"><td>Gemini</td><td>Air</td><td>Aries, Leo, Libra, Sagittarius, Aquarius</td></tr>
                                <tr id="match-cancer"><td>Cancer</td><td>Water</td><td>Taurus, Virgo, Scorpio, Capricorn, Pisces</td></tr>
                                <tr id="match-leo"><td>Leo</td><td>Fire</td><td>Aries, Gemini, Libra, Sagittarius, Aquarius</td></tr>
                                <tr id="match-virgo"><td>Virgo</td><td>Earth</td><td>Taurus, Cancer, Scorpio, Capricorn, Pisces</td></tr>
                                <tr id="match-libra"><td>Libra</td><td>Air</td><td>Aries, Gemini, Leo, Sagittarius, Aquarius</td></tr>
                                <tr id="match-scorpio"><td>Scorpio</td><td>Water</td><td>Taurus, Cancer, Virgo, Capricorn, Pisces</td></tr>
                                <tr id="match-sagittarius"><td>Sagittarius</td><td>Fire</td><td>Aries, Gemini, Leo, Libra, Aquarius</td></tr>
                                <tr id="match-capricorn"><td>Capricorn</td><td>Earth</td><td>Taurus, Cancer, Virgo, Scorpio, Pisces</td></tr>
                                <tr id="match-aquarius"><td>Aquarius</td><td>Air</td><td>Aries, Gemini, Leo, Libra, Sagittarius</td></tr>
                                <tr id="match-pisces"><td>Pisces</td><td>Water</td><td>Taurus, Cancer, Virgo, Scorpio, Capricorn</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <p>These are general matches by Sun sign. Two people from signs that are not listed together can still be very happy, because a full comparison also looks at the Moon, Venus, Mars and the ascendant of both charts.</p>

                    <h3>What Can Compatibility Tell You?</h3>
                    <ul class="nnc-list">
                        <li>how the two of you express love and what each expects in return</li>
                        <li>where you naturally agree and where arguments are likely to start</li>
                        <li>how you handle money, family and responsibility together</li>
                        <li>what each partner can do to make the relationship easier</li>
                    </ul>
                </div>

                <!-- Right Sidebar -->
                <div class="km-right">
                    <div class="sidebar-widget">
                        <div class="widget-header">
                            <h4>Talk to Horoscope experts</h4>
                            <p>Our top rated astrologers to answer your queries</p>
                        </div>
                        <div class="expert-list">
                            <!-- Expert 1 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg1.webp') }}" alt="Prachesta" class="exp-img">
                                <div class="expert-info">
                                    <h5>Prachesta</h5>
                                    <p>Vedic Astrology, Numerology</p>
                                    <span class="rate">₹ 40/min</span>
                                </div>
                                <button class="btn-view">View</button>
                            </div>
                            <!-- Expert 2 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg3.webp') }}" alt="Nevibala" class="exp-img">
                                <div class="expert-info">
                                    <h5>Nevibala</h5>
                                    <p>Vedic, Tarot</p>
                                    <span class="rate">₹ 29/min</span>
                                </div>
                                <button class="btn-view">View</button>
                            </div>
                            <!-- Expert 3 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg1.webp') }}" alt="Swarna" class="exp-img">
                                <div class="expert-info">
                                    <h5>Swarna</h5>
                                    <p>Vedic, Numerology</p>
                                    <span class="rate">₹ 69/min</span>
                                </div>
                                <button class="btn-view">View</button>
                            </div>
                            <!-- Expert 4 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg2.webp') }}" alt="Supransh" class="exp-img">
                                <div class="expert-info">
                                    <h5>Supransh</h5>
                                    <p>Vedic, Life Coach</p>
                                    <span class="rate">₹ 20/min</span>
                                </div>
                                <button class="btn-view">View</button>
                            </div>
                            <!-- Expert 5 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg3.webp') }}" alt="Aarav" class="exp-img">
                                <div class="expert-info">
                                    <h5>Aarav</h5>
                                    <p>Vedic, Vastu</p>
                                    <span class="rate">₹ 35/min</span>
                                </div>
                                <button class="btn-view">View</button>
                            </div>
                        </div>
                        <a href="{{ route('chat-with-astrologers') }}" class="btn-view-all" style="display: block; text-align: center; text-decoration: none;">View all astrologers</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Other free tools -->
    <section class="km-tools-section">
        <div class="container">
            <h2 class="km-heading">Other free tools</h2>
            <div class="km-tools">
                <a href="{{ route('free-kundli') }}"><span>📜</span> Free Kundli</a>
                <a href="{{ route('kundli-matching') }}"><span>💞</span> Kundli Matching</a>
                <a href="{{ route('tarot') }}"><span>🔮</span> Tarot Reading</a>
                <a href="{{ route('love-calculator') }}"><span>❤️</span> Love Calculator</a>
                <a href="{{ route('mangal-dosha-calculator') }}"><span>🔥</span> Mangal Dosha Calculator</a>
                <a href="{{ route('dasha-calculator') }}"><span>🪐</span> Dasha Calculator</a>
                <a href="{{ route('numerology-calculator') }}"><span>🔢</span> Numerology Calculator</a>
                <a href="{{ route('rising-ascendant-sign-calculator') }}"><span>🌅</span> Rising Sign Calculator</a>
                <a href="{{ route('moon-phase-calculator') }}"><span>🌗</span> Moon Phase Calculator</a>
                <a href="{{ route('flames-calculator') }}"><span>🔥</span> FLAMES Calculator</a>
            </div>
        </div>
    </section>

    <section class="acording_section">
        <div class="acord-container">
            <!-- Left Side: Title -->
            <div class="acord-left">
                <span class="acord-subtitle">FREQUENTLY ASKED</span>
                <h2 class="acord-title">Got doubts? <span class="highlight">Find</span> your answers<br>here.</h2>
            </div>

            <!-- Right Side: Accordion List -->
            <div class="acord-right">
                @foreach ([
                    'Which zodiac signs are most compatible?' => 'Signs of the same element usually understand each other best. Fire also pairs well with Air, and Earth pairs well with Water.',
                    'Can two incompatible signs have a good relationship?' => 'Yes. Sun sign compatibility is a general guide. Many happy couples come from signs that are said to clash, because the rest of their charts fit well.',
                    'Is zodiac compatibility the same as kundli matching?' => 'No. Zodiac compatibility compares two signs. Kundli matching compares two full birth charts and gives a score out of 36 gunas.',
                    'Should I check by Sun sign or Moon sign?' => 'Both are useful. The Sun sign shows the basic nature, while the Moon sign shows emotions. Vedic astrology gives more weight to the Moon sign.',
                ] as $question => $answer)
                    <div class="acord-item">
                        <button class="acord-btn">
                            <span>{{ $question }}</span>
                            <div class="acord-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </div>
                        </button>
                        <div class="acord-content">
                            <p>{{ $answer }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Accordion FAQ Logic
            const acordBtns = document.querySelectorAll('.acord-btn');

            acordBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const item = btn.parentElement;
                    const isActive = item.classList.contains('active');

                    // Close all
                    document.querySelectorAll('.acord-item').forEach(otherItem => {
                        otherItem.classList.remove('active');
                    });

                    // Toggle current
                    if (!isActive) {
                        item.classList.add('active');
                    }
                });
            });
        });
    </script>
@endsection
