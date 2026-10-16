@extends('frontend.layouts.master')
@section('title', 'Free Kundli Online by Date of Birth | Janam Kundli')
@section('content')

    <section class="ras-banner-section">
        <div class="container ras-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">FREE KUNDLI</span>
            </div>
            <h1>Free Kundli Online by Date of Birth</h1>
            <p class="ras-subtitle">Your Janam Kundli is the map of the sky at the moment you were born. It shows your lagna, rashi, nakshatra, the twelve houses and the place of every planet. Enter your birth details below to create your kundli.</p>
        </div>
    </section>

    <section class="km-form-section">
        <div class="container">
            <h2 class="km-heading">Create Your <span>Kundli</span></h2>
            <p class="km-sub">Enter your birth details. Accurate time and place give the sharpest reading.</p>
            {{-- Abhi sirf HTML hai: calculation baad me jodni hai --}}
            <form class="km-form" onsubmit="return false;" autocomplete="off">
                <div class="km-grid">
                    <div class="km-person">
                        <div class="km-person-head">
                            <span class="km-badge">👤</span>
                            <h3>New Kundli</h3>
                        </div>
                        <div class="km-fields">
                            <div class="form-group">
                                <label for="km-name">Name *</label>
                                <input type="text" id="km-name" name="name" placeholder="Enter full name, e.g. Rahul Sharma" maxlength="50" required>
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <input type="hidden" name="gender" value="male">
                                <div class="km-gender">
                                    <button type="button" class="active" data-gender="male">Male</button>
                                    <button type="button" data-gender="female">Female</button>
                                    <button type="button" data-gender="other">Other</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="km-divider"></span>
                    <div class="km-person">
                        <div class="km-person-head">
                            <span class="km-badge">🗓️</span>
                            <h3>Birth Details</h3>
                        </div>
                        <div class="km-fields">
                            <div class="form-group">
                                <label>Birth Date *</label>
                                <div class="date-inputs">
                                    <select name="day" required aria-label="Day">
                                        <option value="">Day</option>
                                        @for ($i = 1; $i <= 31; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <select name="month" required aria-label="Month">
                                        <option value="">Month</option>
                                        @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $i => $monthName)
                                            <option value="{{ $i + 1 }}">{{ $monthName }}</option>
                                        @endforeach
                                    </select>
                                    <select name="year" required aria-label="Year">
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
                                    <select name="hour" aria-label="Hour">
                                        <option value="">Hour</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">{{ sprintf('%02d', $i) }}</option>
                                        @endfor
                                    </select>
                                    <select name="minute" aria-label="Minute">
                                        <option value="">Minute</option>
                                        @for ($i = 0; $i <= 59; $i++)
                                            <option value="{{ $i }}">{{ sprintf('%02d', $i) }}</option>
                                        @endfor
                                    </select>
                                    <select name="ampm" aria-label="AM or PM">
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                    </select>
                                </div>
                                <small class="km-hint">Defaults to 12:00 AM if not provided</small>
                            </div>
                            <div class="form-group">
                                <label for="km-place">Birth Place *</label>
                                <input type="text" id="km-place" name="place" placeholder="Enter city, e.g. New Delhi, India" maxlength="120" required>
                                <small class="km-hint">Exact birth time fixes the Lagna and sharpens the reading.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="km-foot">
                    <p>Name, birth date and birth place are needed to make a kundli.</p>
                    <button type="submit" class="km-submit">Generate Kundli</button>
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
                    <h3>What Is a Kundli?</h3>
                    <p>The word kundli comes from the Sanskrit "kundali", meaning coiled or circular. It is a chart that records where the Sun, the Moon and the planets were in the zodiac at the exact time and place of your birth. Because the sky changes every few minutes, two people born on the same day can have different kundlis, which is why the time and place of birth matter so much.</p>
                    <p>Astrologers read the kundli to understand a person's nature, strengths and weak points, and to judge the timing of events such as education, career, marriage and health.</p>

                    <h3>What Does Your Kundli Include?</h3>
                    <ul class="nnc-list">
                        <li><strong>Lagna (Ascendant):</strong> the sign rising in the east at your birth. It becomes the first house and decides which planets work for you and which against you.</li>
                        <li><strong>Rashi (Moon sign):</strong> the sign the Moon was in. It shows your mind and emotions, and horoscopes are read from it.</li>
                        <li><strong>Nakshatra:</strong> the star of the Moon. It adds detail to your nature and fixes the dasha your life begins with.</li>
                        <li><strong>Twelve houses (Bhavas):</strong> each house stands for an area of life, from self and wealth to marriage, career and gains.</li>
                        <li><strong>Dasha:</strong> the Vimshottari system divides life into planetary periods that tell when the results of a planet will be felt.</li>
                        <li><strong>Yogas and Doshas:</strong> special combinations of planets that lift a chart, such as Gaj Kesari Yoga, or trouble it, such as Mangal Dosha.</li>
                    </ul>

                    <h3>The Nine Planets and What They Stand For</h3>
                    <div class="table-responsive">
                        <table class="nnc-table">
                            <thead>
                                <tr><th>Planet</th><th>Stands For</th></tr>
                            </thead>
                            <tbody>
                                <tr><td>Sun (Surya)</td><td>Soul, confidence, father, authority</td></tr>
                                <tr><td>Moon (Chandra)</td><td>Mind, emotions, mother, peace</td></tr>
                                <tr><td>Mars (Mangal)</td><td>Courage, energy, property, siblings</td></tr>
                                <tr><td>Mercury (Budh)</td><td>Speech, intellect, business, studies</td></tr>
                                <tr><td>Jupiter (Guru)</td><td>Wisdom, luck, children, wealth</td></tr>
                                <tr><td>Venus (Shukra)</td><td>Love, marriage, comfort, the arts</td></tr>
                                <tr><td>Saturn (Shani)</td><td>Discipline, hard work, delay, karma</td></tr>
                                <tr><td>Rahu</td><td>Ambition, sudden change, foreign links</td></tr>
                                <tr><td>Ketu</td><td>Detachment, spirituality, past karma</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <p>No planet is good or bad for everyone. Even Saturn and Rahu give great success when they are well placed in a chart.</p>

                    <h3>North Indian and South Indian Kundli</h3>
                    <p>Both styles show the same chart. Only the way it is drawn is different.</p>
                    <div class="table-responsive">
                        <table class="nnc-table">
                            <thead>
                                <tr><th>Feature</th><th>North Indian Kundli</th><th>South Indian Kundli</th></tr>
                            </thead>
                            <tbody>
                                <tr><td>Shape</td><td>Diamond-shaped boxes</td><td>Square boxes</td></tr>
                                <tr><td>What stays fixed</td><td>The houses</td><td>The zodiac signs</td></tr>
                                <tr><td>First house</td><td>Always the top centre diamond</td><td>Marked in the box of the lagna sign</td></tr>
                                <tr><td>Reading direction</td><td>Anti-clockwise</td><td>Clockwise</td></tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>How to Make Your Kundli Online</h3>
                    <ul class="nnc-list">
                        <li><strong>Step 1:</strong> Enter your full name and choose your gender.</li>
                        <li><strong>Step 2:</strong> Select your date of birth.</li>
                        <li><strong>Step 3:</strong> Select your time of birth as exactly as you can. Your birth certificate or hospital record is the best source.</li>
                        <li><strong>Step 4:</strong> Type the city where you were born.</li>
                        <li><strong>Step 5:</strong> Click Generate Kundli.</li>
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
                <a href="{{ route('kundli-matching') }}"><span>💞</span> Kundli Matching</a>
                <a href="{{ route('compatibility') }}"><span>♊</span> Zodiac Compatibility</a>
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
                    'What details do I need to make a kundli?' => 'Your date of birth, the exact time of birth and the place of birth. These three fix the positions of the planets and the lagna.',
                    'What if I do not know my time of birth?' => 'The kundli can still show the planets in their signs, but the lagna and the houses cannot be trusted. An astrologer can estimate the time through birth time rectification.',
                    'Is a Janam Kundli the same as a birth chart?' => 'Yes. Janam Kundli, Janam Patri, birth chart and natal chart are different names for the same chart.',
                    'Does my kundli change with time?' => 'No. The birth chart is fixed for life. What changes are the dasha periods and the planets moving over the chart, which bring its results at different times.',
                    'Is the online kundli free?' => 'Yes. You can create a kundli for yourself and your family as many times as you like.',
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
