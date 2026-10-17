@extends('frontend.layouts.master')
@section('title', 'Nakshatra Calculator - Find Your Birth Star and Pada')
@section('content')

    <section class="ras-banner-section">
        <div class="container ras-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">NAKSHATRA CALCULATOR</span>
            </div>
            <h1>Nakshatra Calculator - Find Your Birth Star and Pada</h1>
            <p class="ras-subtitle">Your Janma Nakshatra is the star group the Moon was passing through when you were born. It adds a finer layer to your Moon sign and is the starting point of your dasha. Enter your birth details to find your nakshatra and pada.</p>
        </div>
    </section>

    <section class="ras-form-section">
        <div class="container">
            <div class="ras-card">
                <div class="card-header">
                    <h2>Calculate your Nakshatra here</h2>
                </div>
                <form class="ras-form" method="GET" action="{{ route('nakshatra-report') }}" autocomplete="off">
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
                        <button type="submit" class="btn-primary">Find My Nakshatra</button>
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
            <h3>What Is a Nakshatra? The 27 Celestial Mansions of the Vedic Cosmos</h3>
            <p>In Vedic astronomy and astrology (<em>Jyotish</em>), the <strong>Nakshatras</strong> are the 27 sacred lunar mansions that form the profound celestial backdrop to the 12 zodiac signs. The Moon takes approximately <strong>27.3 days</strong> to complete a full sidereal orbit around Earth, traversing through roughly one Nakshatra every single day.</p>
            <p>While the 12 signs (<em>Rashis</em>) span 30 degrees each, the ancient Vedic seers divided the 360-degree zodiac wheel into <strong>27 equal sectors of 13° 20′ (13 degrees and 20 arcminutes)</strong>. Each Nakshatra is overseen by a specific ruling planet (<em>Graha Swami</em>), a patron Vedic divinity (<em>Devata</em>), and an archetypal spiritual symbol. Your <strong>Janma Nakshatra</strong> (the star occupied by the Moon at birth) is the ultimate key to understanding your subconscious conditioning, your instinctual behavioral patterns, and your soul’s karmic blueprint.</p>

            <h3>The Four Padas: The Sacred 108 Cosmic Steps</h3>
            <p>Every single Nakshatra is further subdivided into <strong>four equal quarters called Padas (or Charans)</strong>, spanning exactly <strong>3° 20′ each</strong>:</p>
            <ul class="nnc-list">
                <li><strong>The Sacred Number 108:</strong> With 27 Nakshatras containing 4 Padas each, the entire zodiac comprises <strong>108 Padas (27 × 4 = 108)</strong>. This is the exact astronomical reason why 108 is considered the holiest number in Hinduism and japa malas contain 108 beads.</li>
                <li><strong>Direct Link to Navamsha (D9 Chart):</strong> Each 3° 20′ Pada directly corresponds to one sign in the 9th harmonic divisional chart (Navamsha). Your birth Pada determines your D9 Lagna and planetary positions in the chart of destiny and marriage.</li>
                <li><strong>Naming Syllables (Janma Akshara):</strong> Each Pada carries an assigned Sanskrit phonetic sound (syllable). Naming a child using this sound aligns the individual's auric vibration with their guiding birth star.</li>
            </ul>

            <h3>The Three Primary Ganas (Soul Temperaments)</h3>
            <p>In classical Vedic compatibility (<em>Gana Milan</em>), every Nakshatra belongs to one of three universal energetic archetypes:</p>
            <div class="table-responsive">
                <table class="nnc-table">
                    <thead>
                        <tr>
                            <th>Gana (Nature)</th>
                            <th>Guiding Principles & Traits</th>
                            <th>Representative Nakshatras</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Deva Gana (Divine)</strong></td>
                            <td>Virtuous, generous, compassionate, calm, spiritually inclined, peaceful conflict resolution.</td>
                            <td>Ashwini, Mrigashira, Punarvasu, Pushya, Hasta, Swati, Anuradha, Shravana, Revati.</td>
                        </tr>
                        <tr>
                            <td><strong>Manushya Gana (Human)</strong></td>
                            <td>Industrious, relationship-oriented, socially grounded, pragmatic, motivated by community and family duty.</td>
                            <td>Bharani, Rohini, Ardra, Purva Phalguni, Uttara Phalguni, Purva Ashadha, Uttara Ashadha, Purva Bhadrapada, Uttara Bhadrapada.</td>
                        </tr>
                        <tr>
                            <td><strong>Rakshasa Gana (Fierce)</strong></td>
                            <td>Intuitive, intensely perceptive, fearless, strong-willed, penetrating insight, intolerance of superficiality.</td>
                            <td>Krittika, Ashlesha, Magha, Chitra, Vishakha, Jyeshtha, Mula, Dhanishta, Shatabhisha.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h3>The 27 Nakshatras, Planetary Lords & Cosmic Symbols</h3>
            <div class="table-responsive">
                <table class="nnc-table">
                    <thead>
                        <tr>
                            <th>Nakshatra</th>
                            <th>Ruling Planet</th>
                            <th>Patron Divinity (Devata)</th>
                            <th>Cosmic Symbol</th>
                            <th>Core Life Orientation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td><strong>Ashwini</strong></td><td>Ketu</td><td>Ashwini Kumaras</td><td>Horse's Head</td><td>Miraculous healing, quick speed, pioneer energy.</td></tr>
                        <tr><td><strong>Bharani</strong></td><td>Venus</td><td>Lord Yama</td><td>Yoni (Vessel of Life)</td><td>Sacred creation, transformative endurance, truth.</td></tr>
                        <tr><td><strong>Krittika</strong></td><td>Sun</td><td>Agni Deva</td><td>Razor / Flame</td><td>Penetrating sharpness, purifying digestion, courage.</td></tr>
                        <tr><td><strong>Rohini</strong></td><td>Moon</td><td>Lord Brahma / Prajapati</td><td>Chariot / Temple</td><td>Sensual beauty, fertile creativity, material abundance.</td></tr>
                        <tr><td><strong>Mrigashira</strong></td><td>Mars</td><td>Soma (Moon)</td><td>Deer's Head</td><td>Inquisitive searching, gentle agility, truth-seeking.</td></tr>
                        <tr><td><strong>Ardra</strong></td><td>Rahu</td><td>Rudra (Shiva)</td><td>Teardrop / Diamond</td><td>Stormy emotional catharsis, genius breakthroughs.</td></tr>
                        <tr><td><strong>Punarvasu</strong></td><td>Jupiter</td><td>Aditi (Cosmic Mother)</td><td>Bow & Quiver</td><td>Renewal, homecoming, benevolent restoration.</td></tr>
                        <tr><td><strong>Pushya</strong></td><td>Saturn</td><td>Brihaspati</td><td>Cow's Udder / Lotus</td><td>Supreme spiritual nourishment, wisdom, auspiciousness.</td></tr>
                        <tr><td><strong>Ashlesha</strong></td><td>Mercury</td><td>Sarpas (Nagas)</td><td>Coiled Serpent</td><td>Kundalini power, psychological depth, hypnotic wit.</td></tr>
                        <tr><td><strong>Magha</strong></td><td>Ketu</td><td>Pitris (Ancestors)</td><td>Royal Throne</td><td>Ancestral legacy, regal leadership, high honour.</td></tr>
                        <tr><td><strong>Purva Phalguni</strong></td><td>Venus</td><td>Bhaga (Fortune)</td><td>Front Legs of Couch</td><td>Romantic bliss, creative relaxation, prosperity.</td></tr>
                        <tr><td><strong>Uttara Phalguni</strong></td><td>Sun</td><td>Aryaman (Friendship)</td><td>Back Legs of Couch</td><td>Patronage, durable alliances, selfless service.</td></tr>
                        <tr><td><strong>Hasta</strong></td><td>Moon</td><td>Savitur (Sun)</td><td>Open Hand</td><td>Artisanal skill, dexterity, healing touch, manifest craft.</td></tr>
                        <tr><td><strong>Chitra</strong></td><td>Mars</td><td>Vishwakarma</td><td>Bright Pearl / Jewel</td><td>Architectural elegance, artistic design, visual charm.</td></tr>
                        <tr><td><strong>Swati</strong></td><td>Rahu</td><td>Vayu Deva</td><td>Young Shoot in Wind</td><td>Flexibility, independence, trade, intellectual freedom.</td></tr>
                        <tr><td><strong>Vishakha</strong></td><td>Jupiter</td><td>Indra & Agni</td><td>Triumphal Archway</td><td>Focused ambition, purposeful triumph, dual drive.</td></tr>
                        <tr><td><strong>Anuradha</strong></td><td>Saturn</td><td>Mitra (Divine Friend)</td><td>Lotus Flower</td><td>Devotional brotherhood, organizational mastery, loyalty.</td></tr>
                        <tr><td><strong>Jyeshtha</strong></td><td>Mercury</td><td>Lord Indra</td><td>Circular Amulet</td><td>Seniority, protective vigilance, intellectual authority.</td></tr>
                        <tr><td><strong>Mula</strong></td><td>Ketu</td><td>Nirriti (Goddess of Dissolution)</td><td>Tied Roots</td><td>Root exploration, dismantling illusion, spiritual research.</td></tr>
                        <tr><td><strong>Purva Ashadha</strong></td><td>Venus</td><td>Apas (Water Goddess)</td><td>Winnowing Basket / Fan</td><td>Invincible victory, purity, philosophical discernment.</td></tr>
                        <tr><td><strong>Uttara Ashadha</strong></td><td>Sun</td><td>Vishvadevas (Universal Gods)</td><td>Elephant Tusk</td><td>Permanent victory, ethical leadership, collective duty.</td></tr>
                        <tr><td><strong>Shravana</strong></td><td>Moon</td><td>Lord Vishnu</td><td>Three Footprints / Ear</td><td>Active listening, oral Vedic tradition, scholarly wisdom.</td></tr>
                        <tr><td><strong>Dhanishta</strong></td><td>Mars</td><td>Ashta Vasus</td><td>Musical Drum (Mridangam)</td><td>Rhythmic wealth, musical resonance, universal harmony.</td></tr>
                        <tr><td><strong>Shatabhisha</strong></td><td>Rahu</td><td>Lord Varuna</td><td>Hundred Physicians / Circle</td><td>Mystic healing, cosmic medicine, esoteric vision.</td></tr>
                        <tr><td><strong>Purva Bhadrapada</strong></td><td>Jupiter</td><td>Aja Ekapada</td><td>Two-Faced Sword</td><td>Spiritual tapas, fiery transformation, ascetic depth.</td></tr>
                        <tr><td><strong>Uttara Bhadrapada</strong></td><td>Saturn</td><td>Ahirbudhnya</td><td>Twin Back-Legs of Cot</td><td>Deep meditation, ocean calm, stability, Kundalini wisdom.</td></tr>
                        <tr><td><strong>Revati</strong></td><td>Mercury</td><td>Pushan (Nourisher)</td><td>Pair of Fish</td><td>Safe spiritual journey, gentle completion, boundless empathy.</td></tr>
                    </tbody>
                </table>
            </div>

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
                    'What is my Janma Nakshatra and why is it so important?' => 'Your Janma Nakshatra is the specific lunar constellation occupied by the Moon at your birth. It determines the beginning Mahadasha of your life, defines your subconscious mindset, and serves as the foundation for wedding compatibility (Ashtakoota Milan) and auspicious naming.',
                    'How are Nakshatras used in Kundli matching for marriage?' => 'In the classical 36-Guna matching system, nearly all critical factors—including Nadi (8 points), Gana (6 points), Yoni (4 points), and Tara (3 points)—are calculated directly by comparing the birth Nakshatras and Padas of the bride and groom.',
                    'What is a Pada (quarter) of a Nakshatra?' => 'Every Nakshatra is divided into four equal divisions of 3 degrees 20 minutes each, called Padas. The 4 Padas connect the 27 Nakshatras with the Navamsha (D9) chart and provide the authentic Sanskrit starting sound for naming an infant.',
                    'What does my Gana (Deva, Manushya, Rakshasa) signify?' => 'Gana describes your instinctual behavioral temperament. Deva Gana natives are gentle and principled; Manushya Gana natives are practical and family-oriented; Rakshasa Gana natives possess penetrating intuition, fierce determination, and unconventional insight.',
                    'Can two people with the same Nakshatra get married?' => 'Marriage between partners having the identical Nakshatra (Eka Nakshatra) is often permissible and auspicious, provided their birth Padas or Moon signs are different, or when the Nakshatra is one of the designated exceptions in classical texts (like Rohini, Pushya, Magha, or Anuradha).',
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
