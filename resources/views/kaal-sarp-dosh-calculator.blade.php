@extends('frontend.layouts.master')
@section('title', 'Kaal Sarp Dosh Calculator - Check Kaal Sarp Yoga in Your Kundli')
@section('content')

    <section class="ras-banner-section">
        <div class="container ras-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">KAAL SARP DOSH CALCULATOR</span>
            </div>
            <h1>Kaal Sarp Dosh Calculator - Check Kaal Sarp Yoga in Your Kundli</h1>
            <p class="ras-subtitle">Kaal Sarp Dosh is formed when all seven planets of the birth chart fall on one side of the Rahu-Ketu axis. Enter your birth details to check whether it is present in your kundli and which type it is.</p>
        </div>
    </section>

    <section class="ras-form-section">
        <div class="container">
            <div class="ras-card">
                <div class="card-header">
                    <h2>Check Kaal Sarp Dosh here</h2>
                </div>
                <form class="ras-form" method="GET" action="{{ route('kaal-sarp-dosh-report') }}" autocomplete="off">
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
                        <button type="submit" class="btn-primary">Check Kaal Sarp Dosh</button>
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
            <h3>What Is Kaal Sarp Dosh? The Cosmic Serpent Yoga in Vedic Astrology</h3>
            <p><strong>Kaal Sarp Dosh</strong> (also revered as <em>Kaal Sarp Yoga</em>) is one of the most widely discussed and intriguing planetary configurations in Vedic astrology. The Sanskrit term <em>"Kaal"</em> represents Time or Eternity, while <em>"Sarp"</em> signifies the Serpent. In the astrological birth chart (Kundli), this yoga occurs when the shadow planets <strong>Rahu (the serpent's head)</strong> and <strong>Ketu (the serpent's tail)</strong> enclose all seven classical luminaries and planets—the <strong>Sun, Moon, Mars, Mercury, Jupiter, Venus, and Saturn</strong>—within one hemisphere of the zodiac.</p>
            <p>Because Rahu and Ketu are always placed exactly 180 degrees opposite each other, they bisect the horoscope into two equal halves. When all physical planets sit on one side of this nodal axis, the chart is described as being hemmed in or constricted by the cosmic serpent. Astrologically, this creates intense karmic momentum. While it often brings early-life hurdles, delays, and unexpected fluctuations, it also forges immense resilience, ambition, and singular focus that can propel an individual to historic heights later in life.</p>

            <h3>Purna vs. Anshik (Partial) Kaal Sarp Dosh</h3>
            <p>Classical astrologers divide Kaal Sarp Dosh into two primary categories based on the exact degrees of the planets:</p>
            <ul class="nnc-list">
                <li><strong>Purna Kaal Sarp Dosh (Full):</strong> Every single planet without exception lies trapped between Rahu and Ketu. The intensity of karmic trials and spiritual awakenings is at its highest during the major periods (Mahadasha/Antardasha) of Rahu or Ketu.</li>
                <li><strong>Anshik Kaal Sarp Dosh (Partial):</strong> When six planets are caught between Rahu and Ketu, but even a single planet (often the Moon, Mars, or Jupiter) escapes outside the nodal axis, the yoga becomes partial. The severity is significantly diluted, and the lone planet acts as a divine anchor or relief valve for the entire chart.</li>
                <li><strong>Udit vs. Anudit Golaardha:</strong> If all planets move forward toward Rahu’s mouth, it is termed <em>Udit Golaardha</em> (Ascending Kaal Sarp). If the planets move away toward Ketu’s tail, it is termed <em>Anudit Golaardha</em> (Descending Kaal Sarp), which often manifests more internally on the psychological and spiritual plane.</li>
            </ul>

            <h3>The 12 Classical Types of Kaal Sarp Dosh</h3>
            <p>Vedic tradition categorizes Kaal Sarp Dosh into 12 distinct types, determined strictly by the house position of Rahu in the birth chart:</p>

            <div class="table-responsive">
                <table class="nnc-table">
                    <thead>
                        <tr>
                            <th>Type of Dosh</th>
                            <th>Rahu Position</th>
                            <th>Ketu Position</th>
                            <th>Primary Areas Affected & Astrological Nature</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>1. Anant Kaal Sarp</strong></td>
                            <td>1st House (Lagna)</td>
                            <td>7th House</td>
                            <td>Tests personal identity, physical health, decision-making, and marital harmony. Grants sharp intellect but inner anxiety.</td>
                        </tr>
                        <tr>
                            <td><strong>2. Kulik Kaal Sarp</strong></td>
                            <td>2nd House (Dhana)</td>
                            <td>8th House</td>
                            <td>Touches accumulated savings, family legacy, dietary habits, and speech. Success comes after learning fiscal restraint.</td>
                        </tr>
                        <tr>
                            <td><strong>3. Vasuki Kaal Sarp</strong></td>
                            <td>3rd House (Sahaja)</td>
                            <td>9th House</td>
                            <td>Impacts younger siblings, courage, communications, and relations with the father. Bestows restless drive and eventual entrepreneurial success.</td>
                        </tr>
                        <tr>
                            <td><strong>4. Shankhpal Kaal Sarp</strong></td>
                            <td>4th House (Sukha)</td>
                            <td>10th House</td>
                            <td>Creates friction in domestic peace, real estate acquisitions, educational continuity, and mother's well-being.</td>
                        </tr>
                        <tr>
                            <td><strong>5. Padma Kaal Sarp</strong></td>
                            <td>5th House (Putra)</td>
                            <td>11th House</td>
                            <td>Brings delays in higher education, speculation, childbearing, or romantic relationships. Inspires deep spiritual creativity.</td>
                        </tr>
                        <tr>
                            <td><strong>6. Mahapadma Kaal Sarp</strong></td>
                            <td>6th House (Shatru)</td>
                            <td>12th House</td>
                            <td>Engages with secret adversaries, legal disputes, and health vitality. Over time, blesses the native with extraordinary victory over competitors.</td>
                        </tr>
                        <tr>
                            <td><strong>7. Takshak Kaal Sarp</strong></td>
                            <td>7th House (Kalatra)</td>
                            <td>1st House</td>
                            <td>Affects marital alliances, business partnerships, and public image. Requires mutual compromise and transparent communication.</td>
                        </tr>
                        <tr>
                            <td><strong>8. Karkotak Kaal Sarp</strong></td>
                            <td>8th House (Ayu)</td>
                            <td>2nd House</td>
                            <td>Linked with sudden life events, ancestral inheritances, hidden knowledge, and joint finances. Heightens occult interest and intuition.</td>
                        </tr>
                        <tr>
                            <td><strong>9. Shankhachur Kaal Sarp</strong></td>
                            <td>9th House (Dharma)</td>
                            <td>3rd House</td>
                            <td>Brings fluctuations in fortune, higher belief systems, and paternal ties. Rewards steady virtue, pilgrimage, and ethical conduct.</td>
                        </tr>
                        <tr>
                            <td><strong>10. Ghatak Kaal Sarp</strong></td>
                            <td>10th House (Karma)</td>
                            <td>4th House</td>
                            <td>Challenges professional stability, authority relations, and career reputation. Creates resilient, self-made leaders who rise from humble beginnings.</td>
                        </tr>
                        <tr>
                            <td><strong>11. Vishdhar Kaal Sarp</strong></td>
                            <td>11th House (Labha)</td>
                            <td>5th House</td>
                            <td>Touches large financial gains, elder siblings, and social networking. Income stabilizes remarkably after the age of 32–36.</td>
                        </tr>
                        <tr>
                            <td><strong>12. Sheshnag Kaal Sarp</strong></td>
                            <td>12th House (Vyaya)</td>
                            <td>6th House</td>
                            <td>Associated with unexpected expenditures, foreign residence, secret worries, and insomnia. Highly favorable for foreign settlement and spiritual detachment.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h3>Is Kaal Sarp Dosh a Curse? Dispelling the Myth</h3>
            <p>In modern sensationalist astrology, Kaal Sarp Dosh is frequently portrayed as an insurmountable curse. In reality, history demonstrates that many world-renowned leaders, inventors, and cultural icons possessed powerful Kaal Sarp configurations in their charts—including <strong>Jawaharlal Nehru, Abraham Lincoln, Sachin Tendulkar, and Nelson Mandela</strong>.</p>
            <p>Kaal Sarp acts like a coiled spring: the early years often feature intense friction and hurdles, but the intense karmic energy forces the native to develop extraordinary discipline, unconventional problem-solving abilities, and unmatched mental stamina. Once the native crosses the age of <strong>32 to 36</strong>, or completes the relevant planetary periods, the dosha frequently reverses into a source of spectacular social rise and public achievement.</p>

            <h3>Effective Vedic Remedies for Kaal Sarp Dosh</h3>
            <p>Vedic tradition outlines authentic, peaceful remedial measures to calm the agitated energies of Rahu and Ketu and invoke divine protection:</p>

            <ul class="nnc-list">
                <li><strong>Worship of Lord Shiva & Rudrabhishekam:</strong> Lord Shiva is the supreme master of time (<em>Mahakal</em>) and wears snakes as ornaments. Performing regular Jalabhishekam on a Shivling with pure water, milk, and bilva leaves—especially on Mondays and Pradosh Vrat—is the highest remedy for Kaal Sarp Dosh.</li>
                <li><strong>Maha Mrityunjaya Mantra Sadhana:</strong> Chanting the sacred Maha Mrityunjaya Mantra 108 times daily shields the physical body and mental aura from all negative planetary vibrations:
                    <br><strong style="display:inline-block; margin: 6px 0; color: #1e293b;">"ॐ त्र्यम्बकं यजामहे सुगन्धिं पुष्टिवर्धनम्। उर्वारुकमिव बन्धनान्मृत्योर्मुक्षीय मामृतात्॥"</strong></li>
                <li><strong>Nag Panchami Rituals:</strong> On the festival of Nag Panchami, offer milk, yellow flowers, and prayers to Nag Devta. Avoid harming any reptile or serpent.</li>
                <li><strong>Pair of Silver Serpents (Nag-Nagin Daan):</strong> Offering a consecrated pair of small silver serpents (<em>Nag-Nagin Joda</em>) into a sacred flowing river while praying to Lord Shiva helps dissolve deep-seated karmic blocks.</li>
                <li><strong>Pilgrimage & Dosh Nivaran Puja:</strong> In cases of intense Purna Kaal Sarp Dosh, natives traditionally perform a specialized Kaal Sarp Shanti Puja at revered Shiva kshetras like <strong>Trimbakeshwar (Nashik, Maharashtra)</strong>, <strong>Mahakaleshwar (Ujjain)</strong>, or <strong>Sri Kalahasti (Andhra Pradesh)</strong>.</li>
                <li><strong>Rahu & Ketu Beej Mantras:</strong> Recite the Rahu Beej Mantra (<em>"Om Bhram Bhreem Bhroum Sah Rahave Namah"</em>) and Ketu Beej Mantra (<em>"Om Stram Streem Stroum Sah Ketave Namah"</em>) to harmonize the lunar nodes.</li>
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
                    'What is Kaal Sarp Dosh in Vedic astrology?' => 'Kaal Sarp Dosh is formed when all seven primary celestial bodies (Sun, Moon, Mars, Mercury, Jupiter, Venus, and Saturn) are positioned between the lunar nodes Rahu and Ketu in the birth chart. It signifies a chart hemmed in by the serpent axis.',
                    'What is the difference between Purna and Anshik Kaal Sarp Dosh?' => 'When all seven planets are completely enclosed within the Rahu-Ketu axis, it is known as Purna (Full) Kaal Sarp Dosh. When six planets are caught but even one planet lies outside the axis, it is known as Anshik (Partial) Kaal Sarp Dosh, and its malefic effects are considerably reduced.',
                    'Does Kaal Sarp Dosh ruin a person\'s entire life?' => 'No, that is a complete myth. While it often brings struggles and delays during early youth, people with Kaal Sarp Yoga frequently rise to extraordinary leadership and worldwide fame (like Sachin Tendulkar and Jawaharlal Nehru). After the age of 32 to 36, the coiled energy often brings immense success.',
                    'Which is the most dangerous type of Kaal Sarp Dosh?' => 'There is no inherently "dangerous" type. However, Anant (1st-7th house axis), Kulik (2nd-8th house axis), and Ghatak (10th-4th house axis) are felt more intensely because they directly influence health, marital happiness, wealth, and career status.',
                    'How long does the effect of Kaal Sarp Dosh last?' => 'The combination remains present in your birth chart for life, but its effects are felt prominently during the Mahadasha or Antardasha of Rahu and Ketu. With age, personal maturity, and appropriate spiritual remedies like Shiva worship, the negative influence diminishes significantly.',
                    'Where is the Kaal Sarp Dosh Nivaran Puja usually conducted?' => 'The most renowned and sacred shrines for performing Kaal Sarp Shanti Puja are Trimbakeshwar Jyotirlinga (near Nashik, Maharashtra), Mahakaleshwar Jyotirlinga (Ujjain, Madhya Pradesh), and Sri Kalahasteeswara Temple (Sri Kalahasti, Andhra Pradesh).',
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
