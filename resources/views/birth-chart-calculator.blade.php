@extends('frontend.layouts.master')
@section('title', 'Birth / Natal Chart Calculator - Create Your Free Kundli')
@section('content')

    <section class="ras-banner-section">
        <div class="container ras-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">BIRTH CHART CALCULATOR</span>
            </div>
            <h1>Birth / Natal Chart Calculator - Create Your Free Kundli</h1>
            <p class="ras-subtitle">A birth chart, or kundli, is a map of the sky at the exact moment and place you were born. It shows your ascendant, the twelve houses and the position of every planet. Enter your birth details to create yours.</p>
        </div>
    </section>

    <section class="ras-form-section">
        <div class="container">
            <div class="ras-card">
                <div class="card-header">
                    <h2>Create your Birth Chart here</h2>
                </div>
                <form class="ras-form" method="GET" action="{{ route('birth-chart-report') }}" autocomplete="off">
                    @if ($errors->any())
                        <div class="ras-form-error">{{ $errors->first() }}</div>
                    @endif
                    <div class="form-group">
                        <label for="ras-name">Name *</label>
                        <input type="text" id="ras-name" name="name" value="{{ old('name') }}" placeholder="Enter your full name" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="ras-gender">Gender *</label>
                        <select id="ras-gender" name="gender">
                            <option value="male" @selected(old('gender') === 'male')>Male</option>
                            <option value="female" @selected(old('gender') === 'female')>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date of Birth *</label>
                        <div class="date-inputs">
                            <select name="day" required aria-label="Day">
                                <option value="">Day</option>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}" @selected(old('day') == $i)>{{ $i }}</option>
                                @endfor
                            </select>
                            <select name="month" required aria-label="Month">
                                <option value="">Month</option>
                                @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $i => $monthName)
                                    <option value="{{ $i + 1 }}" @selected(old('month') == $i + 1)>{{ $monthName }}</option>
                                @endforeach
                            </select>
                            <select name="year" required aria-label="Year">
                                <option value="">Year</option>
                                @for ($i = date('Y'); $i >= 1900; $i--)
                                    <option value="{{ $i }}" @selected(old('year') == $i)>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Time of Birth *</label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="time_unknown" value="1" id="ras-time-unknown" @checked(old('time_unknown'))> I don't know my exact time of birth
                        </label>
                        <div class="time-inputs" id="ras-time-inputs">
                            <select name="hour" required aria-label="Hour">
                                <option value="">Hour</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" @selected(old('hour') == $i)>{{ sprintf('%02d', $i) }}</option>
                                @endfor
                            </select>
                            <select name="minute" required aria-label="Minute">
                                <option value="">Minute</option>
                                @for ($i = 0; $i <= 59; $i++)
                                    <option value="{{ $i }}" @selected(old('minute') !== null && old('minute') == $i)>{{ sprintf('%02d', $i) }}</option>
                                @endfor
                            </select>
                            <select name="ampm" required aria-label="AM or PM">
                                <option value="AM" @selected(old('ampm') === 'AM')>AM</option>
                                <option value="PM" @selected(old('ampm') === 'PM')>PM</option>
                            </select>
                        </div>
                        <small class="ras-hint" id="ras-time-hint" hidden>Without a birth time we will use 12:00 noon, so the result may be less accurate.</small>
                    </div>
                    <div class="form-group ras-place-group">
                        <label for="ras-place">Place of Birth *</label>
                        <input type="text" id="ras-place" name="place" value="{{ old('place') }}" placeholder="Type your city, e.g. New Delhi" maxlength="120" required>
                        <input type="hidden" name="lat" value="{{ old('lat') }}">
                        <input type="hidden" name="lng" value="{{ old('lng') }}">
                        <input type="hidden" name="tz" value="{{ old('tz') }}">
                        <ul class="ras-place-list" id="ras-place-list" hidden></ul>
                    </div>
                    <div class="form-actions center">
                        <button type="submit" class="btn-primary">Get Birth Chart</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="nnc-promo-section">
        <div class="container">
            <div class="promo-banner">
                <div class="promo-text">
                    <h3>Connect with our Astrologers on Call or Chat for more personalized detailed predictions.</h3>
                </div>
                <div class="promo-actions">
                    <a href="{{ route('talk-to-astrologers') }}" class="btn-call">📞 Call Astrologer</a>
                    <a href="{{ route('chat-with-astrologers') }}" class="btn-chat">💬 Chat Astrologer</a>
                </div>
            </div>
        </div>
    </section>

    <section class="ras-content-section">
        <div class="container ras-content-wrapper">
            <h3>What Is a Vedic Birth Chart (Janam Kundli)?</h3>
            <p>A <strong>Vedic Birth Chart</strong>, known as <strong>Janam Kundli</strong> or <em>Horoscope</em>, is a sacred celestial snapshot of the heavens captured at the precise astronomical moment and geographical coordinates of your birth. In Vedic astrology (<em>Jyotish Shastra</em>), the chart maps the exact positions of the nine celestial bodies (<em>Navagrahas</em>) across twelve zodiac signs (<em>Rashis</em>) and twelve houses (<em>Bhavas</em>).</p>
            <p>Your Kundli is far more than a personality summary; it is your soul’s blueprint and karmic roadmap (<em>Prarabdha Karma</em>). It reveals your innate strengths, career inclinations, relationship dynamics, financial prospects, health tendencies, and ultimate spiritual calling. While the static positions in your birth chart never change throughout your lifetime, dynamic transits (<em>Gochar</em>) and cyclical planetary periods (<em>Vimshottari Dasha</em>) trigger the latent potential of your chart at specific milestones in your life journey.</p>

            <h3>The Core Anatomical Pillars of a Birth Chart</h3>
            <p>A comprehensive Kundli analysis rests upon four fundamental cosmic pillars:</p>
            <ul class="nnc-list">
                <li><strong>Lagna (Ascendant / Rising Sign):</strong> The exact zodiac sign rising on the eastern horizon at the moment of your birth. The Lagna determines the 1st house, defining your physical constitution, vitality, outlook on life, and personal temperament.</li>
                <li><strong>Janma Rashi (Moon Sign):</strong> The zodiac sign occupied by the Moon at birth. Because the Moon governs the subconscious mind, emotional reactions, and memory, the Rashi is crucial for daily transits, Sade Sati, and emotional compatibility.</li>
                <li><strong>Surya Rashi (Sun Sign):</strong> The sign holding the Sun at birth, representing your core soul vitality, professional authority, leadership drive, and conscious ego.</li>
                <li><strong>Janma Nakshatra (Lunar Mansion):</strong> The specific star constellation of the Moon at birth out of the 27 Vedic Nakshatras. It determines your planetary Mahadasha balance at birth and auspicious naming syllables.</li>
            </ul>

            <h3>The Four Sacred Purushartha Life Dimensions</h3>
            <p>Vedic philosophy organizes the twelve houses into the four universal pursuits of human existence (<em>Purusharthas</em>):</p>

            <div class="table-responsive">
                <table class="nnc-table">
                    <thead>
                        <tr>
                            <th>Purushartha</th>
                            <th>Associated Houses</th>
                            <th>Core Purpose & Life Representation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Dharma (Righteousness & Purpose)</strong></td>
                            <td>1st, 5th, and 9th Houses (Trikona)</td>
                            <td>Self-realization, creative intelligence, spiritual devotion, past-life merit (Purva Punya), ethical conduct, and divine guidance.</td>
                        </tr>
                        <tr>
                            <td><strong>Artha (Wealth & Vocational Duty)</strong></td>
                            <td>2nd, 6th, and 10th Houses</td>
                            <td>Accumulation of resources, ancestral wealth, daily work ethic, overcoming competition, social status, and professional achievements.</td>
                        </tr>
                        <tr>
                            <td><strong>Kama (Desires & Relationships)</strong></td>
                            <td>3rd, 7th, and 11th Houses</td>
                            <td>Courage, mental ambition, artistic passions, marital alliances, long-term friendships, and substantial monetary gains.</td>
                        </tr>
                        <tr>
                            <td><strong>Moksha (Liberation & Spirituality)</strong></td>
                            <td>4th, 8th, and 12th Houses</td>
                            <td>Inner emotional sanctuary, motherly bond, occult wisdom, mystical transformation, foreign settlement, and eventual spiritual emancipation.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h3>The 12 Houses (Bhavas) of the Horoscope Detailed</h3>
            <div class="table-responsive">
                <table class="nnc-table">
                    <thead>
                        <tr>
                            <th>House</th>
                            <th>Sanskrit Name</th>
                            <th>Key Life Spheres Governed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td><strong>1st House</strong></td><td>Tanu Bhava</td><td>Self, physical appearance, longevity, core vitality, and overall life path.</td></tr>
                        <tr><td><strong>2nd House</strong></td><td>Dhana Bhava</td><td>Liquid wealth, family heritage, speech, dietary habits, and early childhood values.</td></tr>
                        <tr><td><strong>3rd House</strong></td><td>Sahaja Bhava</td><td>Younger siblings, courage, willpower, short travels, manual skills, and communication.</td></tr>
                        <tr><td><strong>4th House</strong></td><td>Sukha Bhava</td><td>Mother, domestic happiness, home property, conveyances, mental peace, and ancestral land.</td></tr>
                        <tr><td><strong>5th House</strong></td><td>Putra Bhava</td><td>Children, intellect, higher learning, speculative gains, romantic love, and mantra siddhi.</td></tr>
                        <tr><td><strong>6th House</strong></td><td>Shatru Bhava</td><td>Health resilience, overcoming debt, daily workplace service, litigation, and competitors.</td></tr>
                        <tr><td><strong>7th House</strong></td><td>Kalatra Bhava</td><td>Spouse, marital harmony, business partnerships, legal contracts, and public interactions.</td></tr>
                        <tr><td><strong>8th House</strong></td><td>Ayu Bhava</td><td>Longevity, sudden transformations, joint assets, inheritances, occult research, and mysteries.</td></tr>
                        <tr><td><strong>9th House</strong></td><td>Dharma Bhava</td><td>Good fortune (Bhagya), relationship with father, guru's grace, higher wisdom, and pilgrimages.</td></tr>
                        <tr><td><strong>10th House</strong></td><td>Karma Bhava</td><td>Career, profession, reputation, leadership, public fame, and relationship with authorities.</td></tr>
                        <tr><td><strong>11th House</strong></td><td>Labha Bhava</td><td>Fulfillment of ambitions, large wealth gains, elder siblings, social circles, and influential networks.</td></tr>
                        <tr><td><strong>12th House</strong></td><td>Vyaya Bhava</td><td>Expenditures, foreign relocation, isolation, spiritual surrender, dreams, and subconscious release.</td></tr>
                    </tbody>
                </table>
            </div>

            <h3>Crucial House Classifications: Kendra, Trikona & Dusthana</h3>
            <p>Houses in your birth chart do not carry equal influence. Vedic astrology categorizes them into functional powerhouses:</p>
            <ul class="nnc-list">
                <li><strong>Kendra Houses (1, 4, 7, 10):</strong> Known as the <em>Vishnu Sthanas</em>. These are the four pillars of life representing action, stability, and societal presence. Planets placed here gain extraordinary potency to manifest their promises.</li>
                <li><strong>Trikona Houses (1, 5, 9):</strong> Known as the <em>Lakshmi Sthanas</em>. These are the most auspicious houses in any horoscope, representing divine grace, spiritual merit, and effortless fortune.</li>
                <li><strong>Upachaya Houses (3, 6, 10, 11):</strong> The houses of steady growth. Malefic planets like Mars, Saturn, and Rahu placed in Upachaya houses fight through obstacles and yield remarkable prosperity over time.</li>
                <li><strong>Dusthana / Trik Houses (6, 8, 12):</strong> The challenging houses. While they test the native through diseases, obstacles, or expenses, they also forge spiritual detachment and profound wisdom when positively channeled.</li>
            </ul>

            <div class="discover-more">
                <h3>Discover More about yourself</h3>
                <div class="calc-cards">
                    <a href="{{ route('horoscope.landing', ['period' => 'daily']) }}" class="calc-card">
                        <span class="c-icon">📅</span>
                        <h4>Daily Horoscope</h4>
                        <p>Read your daily predictions</p>
                    </a>
                    <a href="{{ route('love-calculator') }}" class="calc-card">
                        <span class="c-icon">❤️</span>
                        <h4>Love Calculator</h4>
                        <p>Check love percentage</p>
                    </a>
                    <a href="{{ route('numerology-calculator') }}" class="calc-card">
                        <span class="c-icon">🔢</span>
                        <h4>Numerology Calculator</h4>
                        <p>Find the numbers in your name</p>
                    </a>
                    <a href="{{ route('dasha-calculator') }}" class="calc-card">
                        <span class="c-icon">🪐</span>
                        <h4>Dasha Calculator</h4>
                        <p>See your planetary periods</p>
                    </a>
                </div>
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
                    'What exact details are needed to generate a birth chart?' => 'To calculate an authentic Vedic Kundli, you need your exact date of birth, precise time of birth, and exact place of birth (city/town). The time and place establish the Ascendant (Lagna), which changes roughly every two hours.',
                    'What happens if I do not know my exact birth time?' => 'If your exact birth time is unavailable, planetary sign placements like the Sun and slow-moving planets can still be determined. However, house boundaries and the Ascendant become approximate. A trained Vedic astrologer can perform "Birth Time Rectification" (Nashta Jataka) using key life events to narrow down your accurate rising sign.',
                    'What is the difference between North Indian and South Indian chart formats?' => 'Both chart styles read the identical planetary positions. In the North Indian chart format, the houses are fixed with the 1st house (Lagna) always at the top center diamond, while the zodiac signs rotate. In the South Indian chart format, the zodiac signs are fixed in a clockwise square, while the Ascendant and planets change position.',
                    'What is the D9 Navamsha chart and why is it important?' => 'The Navamsha (D9) chart is the most critical harmonic divisional chart in Vedic astrology. While the main Rashi chart (D1) represents the tree, the Navamsha represents the fruit. It is analyzed to verify the true strength of planets, assess marriage prospects, and decode life path after the age of 30-36.',
                    'How does a birth chart predict future events?' => 'Future events are predicted by synthesizing your birth chart’s foundational promises with the Vimshottari Dasha system (planetary time cycles) and current planetary transits (Gochar). When a supportive Dasha operates in harmony with favorable transits, the events promised in your chart materialize.',
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
        // Birth-time unknown: switch the time boxes off
        (function () {
            const unknown = document.getElementById('ras-time-unknown');
            const selects = document.querySelectorAll('#ras-time-inputs select');
            const hint = document.getElementById('ras-time-hint');
            const sync = () => {
                selects.forEach(s => s.disabled = unknown.checked);
                hint.hidden = !unknown.checked;
            };
            unknown.addEventListener('change', sync);
            sync();
        })();

        // Birth place: suggest matching cities and remember the chosen one's coordinates and timezone
        (function () {
            const input = document.getElementById('ras-place');
            const list = document.getElementById('ras-place-list');
            const form = input.form;
            const fields = { lat: form.elements.lat, lng: form.elements.lng, tz: form.elements.tz };
            let timer = null;

            const close = () => { list.hidden = true; list.innerHTML = ''; };

            input.addEventListener('input', () => {
                fields.lat.value = fields.lng.value = fields.tz.value = '';
                clearTimeout(timer);
                const q = input.value.trim();
                if (q.length < 2) return close();

                timer = setTimeout(async () => {
                    try {
                        const res = await fetch(@json(route('place-search')) + '?q=' + encodeURIComponent(q));
                        const places = await res.json();
                        if (input.value.trim() !== q) return;

                        list.innerHTML = '';
                        places.forEach(place => {
                            const li = document.createElement('li');
                            li.textContent = place.label;
                            li.addEventListener('mousedown', (e) => {
                                e.preventDefault();
                                input.value = place.label;
                                fields.lat.value = place.lat;
                                fields.lng.value = place.lng;
                                fields.tz.value = place.tz;
                                close();
                            });
                            list.appendChild(li);
                        });
                        list.hidden = places.length === 0;
                    } catch (e) {
                        close();
                    }
                }, 300);
            });

            input.addEventListener('blur', () => setTimeout(close, 150));
        })();
    </script>
@endsection
