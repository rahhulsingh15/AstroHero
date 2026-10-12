@extends('frontend.layouts.master')
@section('title', 'Kundli Matching for Marriage | Free Horoscope Matching')
@section('content')

    <section class="ras-banner-section">
        <div class="container ras-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">KUNDLI MATCHING</span>
            </div>
            <h1>Kundli Matching for Marriage</h1>
            <p class="ras-subtitle">Kundli Milan compares the birth charts of two people to see how well they suit each other in marriage. It gives a score out of 36 gunas and checks for Mangal Dosha. Enter the birth details of both partners below.</p>
        </div>
    </section>

    <section class="km-form-section">
        <div class="container">
            <h2 class="km-heading">Match Your <span>Kundli</span></h2>
            <p class="km-sub">Enter both birth details. Accurate time and place give the sharpest reading.</p>
            {{-- Abhi sirf HTML hai: calculation baad me jodni hai --}}
            <form class="km-form" onsubmit="return false;" autocomplete="off">
                <div class="km-grid">
                    <div class="km-person">
                        <div class="km-person-head">
                            <span class="km-badge">👤</span>
                            <h3>Your Details</h3>
                        </div>
                        <div class="km-fields">
                            <div class="form-group">
                                <label for="km-you_name">Name *</label>
                                <input type="text" id="km-you_name" name="you_name" placeholder="Enter full name, e.g. Rahul Sharma" maxlength="50" required>
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <input type="hidden" name="you_gender" value="male">
                                <div class="km-gender">
                                    <button type="button" class="active" data-gender="male">Male</button>
                                    <button type="button" data-gender="female">Female</button>
                                    <button type="button" data-gender="other">Other</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Birth Date *</label>
                                <div class="date-inputs">
                                    <select name="you_day" required aria-label="Day">
                                        <option value="">Day</option>
                                        @for ($i = 1; $i <= 31; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <select name="you_month" required aria-label="Month">
                                        <option value="">Month</option>
                                        @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $i => $monthName)
                                            <option value="{{ $i + 1 }}">{{ $monthName }}</option>
                                        @endforeach
                                    </select>
                                    <select name="you_year" required aria-label="Year">
                                        <option value="">Year</option>
                                        @for ($i = date('Y'); $i >= 1900; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Birth Time <i class="km-optional">optional</i></label>
                                <div class="time-inputs">
                                    <select name="you_hour" aria-label="Hour">
                                        <option value="">Hour</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">{{ sprintf('%02d', $i) }}</option>
                                        @endfor
                                    </select>
                                    <select name="you_minute" aria-label="Minute">
                                        <option value="">Minute</option>
                                        @for ($i = 0; $i <= 59; $i++)
                                            <option value="{{ $i }}">{{ sprintf('%02d', $i) }}</option>
                                        @endfor
                                    </select>
                                    <select name="you_ampm" aria-label="AM or PM">
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                    </select>
                                </div>
                                <small class="km-hint">Defaults to 12:00 AM if not provided</small>
                            </div>
                            <div class="form-group">
                                <label for="km-you_place">Birth Place *</label>
                                <input type="text" id="km-you_place" name="you_place" placeholder="Enter city, e.g. New Delhi, India" maxlength="120" required>
                                <small class="km-hint">Exact birth time fixes the Lagna and sharpens the reading.</small>
                            </div>
                        </div>
                    </div>
                    <span class="km-divider"></span>
                    <div class="km-person">
                        <div class="km-person-head">
                            <span class="km-badge">💞</span>
                            <h3>Partner's Details</h3>
                        </div>
                        <div class="km-fields">
                            <div class="form-group">
                                <label for="km-partner_name">Name *</label>
                                <input type="text" id="km-partner_name" name="partner_name" placeholder="Enter full name, e.g. Priya Verma" maxlength="50" required>
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <input type="hidden" name="partner_gender" value="female">
                                <div class="km-gender">
                                    <button type="button" data-gender="male">Male</button>
                                    <button type="button" class="active" data-gender="female">Female</button>
                                    <button type="button" data-gender="other">Other</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Birth Date *</label>
                                <div class="date-inputs">
                                    <select name="partner_day" required aria-label="Day">
                                        <option value="">Day</option>
                                        @for ($i = 1; $i <= 31; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <select name="partner_month" required aria-label="Month">
                                        <option value="">Month</option>
                                        @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $i => $monthName)
                                            <option value="{{ $i + 1 }}">{{ $monthName }}</option>
                                        @endforeach
                                    </select>
                                    <select name="partner_year" required aria-label="Year">
                                        <option value="">Year</option>
                                        @for ($i = date('Y'); $i >= 1900; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Birth Time <i class="km-optional">optional</i></label>
                                <div class="time-inputs">
                                    <select name="partner_hour" aria-label="Hour">
                                        <option value="">Hour</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">{{ sprintf('%02d', $i) }}</option>
                                        @endfor
                                    </select>
                                    <select name="partner_minute" aria-label="Minute">
                                        <option value="">Minute</option>
                                        @for ($i = 0; $i <= 59; $i++)
                                            <option value="{{ $i }}">{{ sprintf('%02d', $i) }}</option>
                                        @endfor
                                    </select>
                                    <select name="partner_ampm" aria-label="AM or PM">
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                    </select>
                                </div>
                                <small class="km-hint">Defaults to 12:00 AM if not provided</small>
                            </div>
                            <div class="form-group">
                                <label for="km-partner_place">Birth Place *</label>
                                <input type="text" id="km-partner_place" name="partner_place" placeholder="Enter city, e.g. Jaipur, India" maxlength="120" required>
                                <small class="km-hint">Exact birth time fixes the Lagna and sharpens the reading.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="km-foot">
                    <p>Name, birth date and birth place are needed for both partners.</p>
                    <button type="submit" class="km-submit">Match Horoscope</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Main Content & Sidebar -->
    <section class="km-main-section">
        <div class="container">
            <div class="km-split">
                <!-- Left Content -->
                <div class="km-left nnc-content-wrapper">
                    <h3>What Is Kundli Matching?</h3>
                    <p>Kundli matching, also called Kundli Milan or horoscope matching, is the Vedic method of comparing two birth charts before marriage. It looks at the Moon sign and nakshatra of both partners and scores them on eight points of compatibility, known together as Ashtakoota Guna Milan.</p>
                    <p>It was traditionally done for arranged marriages, but many couples in love marriages also use it to understand where they fit easily and where they will need patience.</p>

                    <h3>Why Is Kundli Matching Done?</h3>
                    <ul class="nnc-list">
                        <li><strong>Mental and emotional fit:</strong> whether the two natures get along day to day.</li>
                        <li><strong>Family and finances:</strong> how the couple is likely to grow together after marriage.</li>
                        <li><strong>Health and children:</strong> the well-being of both partners and of the family they build.</li>
                        <li><strong>Doshas:</strong> whether Mangal Dosha or Nadi Dosha is present, and whether it is cancelled.</li>
                    </ul>

                    <h3>The 8 Kootas of Guna Milan</h3>
                    <p>Each koota carries a fixed number of points. Together they add up to 36.</p>
                    <div class="table-responsive">
                        <table class="nnc-table">
                            <thead>
                                <tr><th>Koota</th><th>Points</th><th>What It Shows</th></tr>
                            </thead>
                            <tbody>
                                <tr><td>Varna</td><td>1</td><td>Spiritual outlook and ego</td></tr>
                                <tr><td>Vashya</td><td>2</td><td>Mutual attraction and influence</td></tr>
                                <tr><td>Tara</td><td>3</td><td>Health and good fortune of the couple</td></tr>
                                <tr><td>Yoni</td><td>4</td><td>Physical and intimate compatibility</td></tr>
                                <tr><td>Graha Maitri</td><td>5</td><td>Friendship and mental compatibility</td></tr>
                                <tr><td>Gana</td><td>6</td><td>Temperament and behaviour</td></tr>
                                <tr><td>Bhakoot</td><td>7</td><td>Emotional bond, family welfare and prosperity</td></tr>
                                <tr><td>Nadi</td><td>8</td><td>Health and children</td></tr>
                                <tr><td><strong>Total</strong></td><td><strong>36</strong></td><td></td></tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>What Does the Score Mean?</h3>
                    <div class="table-responsive">
                        <table class="nnc-table">
                            <thead>
                                <tr><th>Gunas Matched</th><th>Result</th></tr>
                            </thead>
                            <tbody>
                                <tr><td>Below 18</td><td>Not recommended without an astrologer's advice</td></tr>
                                <tr><td>18 to 24</td><td>Acceptable match</td></tr>
                                <tr><td>25 to 32</td><td>Good match</td></tr>
                                <tr><td>33 to 36</td><td>Excellent match</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <p>The score is only the first step. An astrologer also looks at Mangal Dosha, the 7th house, the Navamsa chart and the dasha periods of both partners before giving a final opinion.</p>

                    <h3>How Does Kundli Matching Work?</h3>
                    <ul class="nnc-list">
                        <li><strong>Step 1:</strong> The birth chart of each partner is prepared from the date, time and place of birth.</li>
                        <li><strong>Step 2:</strong> The Moon sign and nakshatra of both are compared on the eight kootas to get the score out of 36.</li>
                        <li><strong>Step 3:</strong> Both charts are checked for Mangal Dosha and whether one cancels the other.</li>
                        <li><strong>Step 4:</strong> The 7th house of marriage and its lord are studied in both charts.</li>
                        <li><strong>Step 5:</strong> The running dasha periods are compared to see how the coming years look for the couple.</li>
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
                                <img src="{{ asset('assets/images/chatimg1.png') }}" alt="Prachesta" class="exp-img">
                                <div class="expert-info">
                                    <h5>Prachesta</h5>
                                    <p>Vedic Astrology, Numerology</p>
                                    <span class="rate">₹ 40/min</span>
                                </div>
                                <button class="btn-view">View</button>
                            </div>
                            <!-- Expert 2 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg3.png') }}" alt="Nevibala" class="exp-img">
                                <div class="expert-info">
                                    <h5>Nevibala</h5>
                                    <p>Vedic, Tarot</p>
                                    <span class="rate">₹ 29/min</span>
                                </div>
                                <button class="btn-view">View</button>
                            </div>
                            <!-- Expert 3 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg1.png') }}" alt="Swarna" class="exp-img">
                                <div class="expert-info">
                                    <h5>Swarna</h5>
                                    <p>Vedic, Numerology</p>
                                    <span class="rate">₹ 69/min</span>
                                </div>
                                <button class="btn-view">View</button>
                            </div>
                            <!-- Expert 4 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg2.png') }}" alt="Supransh" class="exp-img">
                                <div class="expert-info">
                                    <h5>Supransh</h5>
                                    <p>Vedic, Life Coach</p>
                                    <span class="rate">₹ 20/min</span>
                                </div>
                                <button class="btn-view">View</button>
                            </div>
                            <!-- Expert 5 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg3.png') }}" alt="Aarav" class="exp-img">
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
                <a href="{{ route('compatibility') }}"><span>♊</span> Zodiac Compatibility</a>
                <a href="{{ route('tarot') }}"><span>🔮</span> Tarot Reading</a>
                <a href="{{ route('love-calculator') }}"><span>❤️</span> Love Calculator</a>
                <a href="{{ route('mangal-dosha-calculator') }}"><span>🔥</span> Mangal Dosha Calculator</a>
                <a href="{{ route('dasha-calculator') }}"><span>🪐</span> Dasha Calculator</a>
                <a href="{{ route('numerology-calculator') }}"><span>🔢</span> Numerology Calculator</a>
                <a href="{{ route('rising-ascendant-sign-calculator') }}"><span>🌅</span> Rising Sign Calculator</a>
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
                    'How many gunas should match for marriage?' => 'At least 18 out of 36 is traditionally considered acceptable. A score of 25 or more is seen as a good match.',
                    'Can we marry if fewer than 18 gunas match?' => 'The score is not the whole picture. Other parts of the charts can make up for a low score, so an astrologer should look at both kundlis before deciding.',
                    'What is Nadi Dosha?' => 'When both partners have the same Nadi, the 8 points of that koota are lost. It is traditionally linked with health and children, and it has several cancellations.',
                    'Is kundli matching needed for a love marriage?' => 'It is not compulsory, but it helps a couple understand their strong and weak areas and prepare for them.',
                    'Can kundli matching be done by name?' => 'When the birth details are not known, the first letter of the name is used to find the nakshatra and rashi. It is less accurate than matching by date, time and place of birth.',
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
    <script>
        // Gender ke teen button: jo dabao wahi active, aur hidden input me uski value
        document.querySelectorAll('.km-gender').forEach(group => {
            const buttons = group.querySelectorAll('button');
            const hidden = group.parentElement.querySelector('input[type="hidden"]');
            buttons.forEach(button => button.addEventListener('click', () => {
                buttons.forEach(b => b.classList.toggle('active', b === button));
                hidden.value = button.dataset.gender;
            }));
        });
    </script>
@endsection
