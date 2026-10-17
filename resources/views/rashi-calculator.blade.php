@extends('frontend.layouts.master')
@section('title', 'Rashi Calculator - Find Your Moon Sign by Date of Birth')
@section('content')

    <section class="ras-banner-section">
        <div class="container ras-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">RASHI CALCULATOR</span>
            </div>
            <h1>Rashi Calculator - Find Your Moon Sign by Date of Birth</h1>
            <p class="ras-subtitle">In Vedic astrology your rashi is the zodiac sign the Moon was in at the moment of your birth. Horoscopes, name letters and kundli matching are all read from it. Enter your birth details to find your rashi.</p>
        </div>
    </section>

    <section class="ras-form-section">
        <div class="container">
            <div class="ras-card">
                <div class="card-header">
                    <h2>Calculate your Rashi here</h2>
                </div>
                <form class="ras-form" method="GET" action="{{ route('rashi-report') }}" autocomplete="off">
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
                        <button type="submit" class="btn-primary">Find My Rashi</button>
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
            <h3>What Is Janma Rashi? The Lunar Soul Mirror in Vedic Astrology</h3>
            <p>In Vedic astrology (<em>Jyotish Shastra</em>), your <strong>Janma Rashi</strong>—commonly referred to as your <strong>Moon Sign</strong>—is the specific zodiac sign that was occupied by the Moon at the precise moment and location of your birth. The 360-degree celestial zodiac belt is partitioned into twelve equal segments of 30 degrees each, forming the 12 classical Rashis.</p>
            <p>While Western astrology primarily centers on the Sun Sign (the conscious ego and external persona), Vedic astrology grants supreme primacy to the Moon Sign. The Moon is the fastest celestial body in our sky, spending approximately <strong>2.25 days (about 54 hours)</strong> in each zodiac sign before moving forward. Symbolizing <em>"Manas"</em> (the mind), emotions, instinctual responses, memory, and psychological resilience, your Chandra Rashi reflects your true emotional baseline—how you feel, react, love, and experience reality when the external world falls away.</p>

            <h3>The 12 Rashis: Planetary Lords, Elements & Cosmic Modalities</h3>
            <p>Every Rashi belongs to one of four elemental energies (<em>Tatvas</em>) and one of three dynamic behavioral temperaments (<em>Gunas / Modalities</em>):</p>

            <div class="table-responsive">
                <table class="nnc-table">
                    <thead>
                        <tr>
                            <th>Vedic Rashi</th>
                            <th>Western Sign</th>
                            <th>Ruling Planet (Swami)</th>
                            <th>Element (Tatva)</th>
                            <th>Modality (Nature)</th>
                            <th>Core Personality Signature</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td><strong>Mesh</strong></td><td>Aries</td><td>Mars (Mangal)</td><td>Fire (Agni)</td><td>Chara (Movable)</td><td>Dynamic initiative, bravery, pioneering drive, spontaneous passion.</td></tr>
                        <tr><td><strong>Vrishabh</strong></td><td>Taurus</td><td>Venus (Shukra)</td><td>Earth (Prithvi)</td><td>Sthira (Fixed)</td><td>Patience, material stability, sensual refinement, steadfast loyalty.</td></tr>
                        <tr><td><strong>Mithun</strong></td><td>Gemini</td><td>Mercury (Budh)</td><td>Air (Vayu)</td><td>Dwiswabhava (Dual)</td><td>Intellectual curiosity, linguistic charm, versatility, analytical wit.</td></tr>
                        <tr><td><strong>Kark</strong></td><td>Cancer</td><td>Moon (Chandra)</td><td>Water (Jala)</td><td>Chara (Movable)</td><td>Deep maternal intuition, emotional empathy, protective instincts.</td></tr>
                        <tr><td><strong>Singh</strong></td><td>Leo</td><td>Sun (Surya)</td><td>Fire (Agni)</td><td>Sthira (Fixed)</td><td>Regal dignity, generosity, innate leadership, creative flair.</td></tr>
                        <tr><td><strong>Kanya</strong></td><td>Virgo</td><td>Mercury (Budh)</td><td>Earth (Prithvi)</td><td>Dwiswabhava (Dual)</td><td>Meticulous precision, problem-solving, selfless service, discernment.</td></tr>
                        <tr><td><strong>Tula</strong></td><td>Libra</td><td>Venus (Shukra)</td><td>Air (Vayu)</td><td>Chara (Movable)</td><td>Diplomacy, aesthetic harmony, legal fairness, partnership orientation.</td></tr>
                        <tr><td><strong>Vrishchik</strong></td><td>Scorpio</td><td>Mars (Mangal)</td><td>Water (Jala)</td><td>Sthira (Fixed)</td><td>Magnetic depth, intense passion, psychic resilience, transformative power.</td></tr>
                        <tr><td><strong>Dhanu</strong></td><td>Sagittarius</td><td>Jupiter (Guru)</td><td>Fire (Agni)</td><td>Dwiswabhava (Dual)</td><td>Philosophical optimism, spiritual exploration, truth-seeking, freedom.</td></tr>
                        <tr><td><strong>Makar</strong></td><td>Capricorn</td><td>Saturn (Shani)</td><td>Earth (Prithvi)</td><td>Chara (Movable)</td><td>Disciplined endurance, strategic ambition, institutional mastery, perseverance.</td></tr>
                        <tr><td><strong>Kumbh</strong></td><td>Aquarius</td><td>Saturn (Shani)</td><td>Air (Vayu)</td><td>Sthira (Fixed)</td><td>Visionary innovation, humanitarian ideals, scientific detachment, uniqueness.</td></tr>
                        <tr><td><strong>Meen</strong></td><td>Pisces</td><td>Jupiter (Guru)</td><td>Water (Jala)</td><td>Dwiswabhava (Dual)</td><td>Spiritual compassion, mystical daydreaming, artistic surrender, universal love.</td></tr>
                    </tbody>
                </table>
            </div>

            <h3>Why Vedic Astrology Values Moon Sign Over Sun Sign</h3>
            <p>In Vedic tradition, evaluating your horoscope from the Moon (<em>Chandra Kundli</em>) is considered indispensable for four essential reasons:</p>
            <ul class="nnc-list">
                <li><strong>Dynamic Planetary Transits (Gochar):</strong> Major cosmic transits—including Saturn's 7.5-year Sade Sati, Jupiter's 1-year transit, and Rahu-Ketu’s 18-month shifts—are calculated strictly from your Moon Sign.</li>
                <li><strong>The Vimshottari Dasha System:</strong> The 120-year planetary progression timeline of your life is rooted in the exact position of the Moon within its Nakshatra at the moment of your birth.</li>
                <li><strong>Ashtakoota Kundli Milan (Marriage Compatibility):</strong> The 36-gun matching system for marriage compatibility assesses the distance and friendship between the Moon signs and Nakshatras of both partners (evaluating Bhakoot and Nadi doshas).</li>
                <li><strong>Mental & Emotional Health:</strong> While the Sun dictates professional ego, the Moon governs inner happiness, peace of mind (<em>Chitta</em>), emotional stability, and interpersonal relationship harmony.</li>
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
                    'What is the difference between my Moon Sign and Sun Sign?' => 'Your Sun Sign (Surya Rashi) reflects your conscious ego, vitality, and external career drive based on the Sun’s position. Your Moon Sign (Chandra Rashi) reflects your internal mind, emotional instincts, and subconscious patterns. In Vedic astrology, the Moon Sign is regarded as far more influential in day-to-day life and relationships.',
                    'Why do I need exact birth time and place to calculate my Rashi?' => 'The Moon is very fast-moving and changes signs approximately every 2.25 days (about 54 hours). On days when the Moon transitions from one sign to another, an error of even a few minutes can assign you the wrong Moon sign. Accurate coordinates ensure correct planetary longitude calculation.',
                    'Which horoscope should I read: Sun Sign or Moon Sign?' => 'For authentic Vedic astrological predictions, daily horoscopes, and transit forecasts (like Sade Sati or Jupiter Gochar), you should always read predictions corresponding to your Moon Sign (Janma Rashi).',
                    'How does Janma Rashi impact marriage compatibility?' => 'In traditional 36 Guna Milan, the Moon signs and Nakshatras form the core foundation of points like Bhakoot (7 points) and Nadi (8 points). Harmonious lunar elements between prospective partners ensure emotional intimacy, psychological harmony, and healthy progeny.',
                    'Can my Moon Sign change over my lifetime?' => 'No. Your Janma Rashi is permanently set at the exact astronomical coordinate of the Moon at the moment of your birth and never changes throughout your earthly lifetime.',
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
