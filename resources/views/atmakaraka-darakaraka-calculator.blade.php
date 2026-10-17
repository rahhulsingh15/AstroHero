@extends('frontend.layouts.master')
@section('title', 'Atmakaraka & Darakaraka Calculator - Know Your Soul Planet and Spouse Planet')
@section('content')

    <section class="ras-banner-section">
        <div class="container ras-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">ATMAKARAKA &amp; DARAKARAKA CALCULATOR</span>
            </div>
            <h1>Atmakaraka &amp; Darakaraka Calculator - Know Your Soul Planet and Spouse Planet</h1>
            <p class="ras-subtitle">In Jaimini astrology the planet with the highest degree in your birth chart is your Atmakaraka, the significator of the soul, and the one with the lowest degree is your Darakaraka, the significator of your spouse. Enter your birth details to find both.</p>
        </div>
    </section>

    <section class="ras-form-section">
        <div class="container">
            <div class="ras-card">
                <div class="card-header">
                    <h2>Calculate your Atmakaraka &amp; Darakaraka here</h2>
                </div>
                <form class="ras-form" method="GET" action="{{ route('atmakaraka-darakaraka-report') }}" autocomplete="off">
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
                        <button type="submit" class="btn-primary">Find My Atmakaraka &amp; Darakaraka</button>
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
            <h3>What Are Atmakaraka and Darakaraka? The Jaimini Chara Karaka System</h3>
            <p>In classical Vedic astrology, Sage <strong>Maharishi Jaimini</strong>—the revered disciple of Maharishi Parashara—introduced the profound <em>Jaimini Upadesha Sutras</em>. While Parashari astrology assigns fixed, permanent roles to planets (such as the Sun always signifying the father or Venus always signifying the spouse), the Jaimini system utilizes <strong>Chara Karakas</strong> (variable planetary significators).</p>
            <p>In the Chara Karaka system, the planets from the Sun to Saturn (and optionally Rahu) are arranged in descending sequence based purely on their degree of advancement within their respective zodiac signs (from <strong>30° down to 0°</strong>), disregarding the sign itself. The planet holding the highest degree becomes the <strong>Atmakaraka (AK)</strong>, the sovereign king of the horoscope, while the planet with the lowest degree becomes the <strong>Darakaraka (DK)</strong>, signifying one's spouse and life partner.</p>

            <h3>The Sacred Hierarchy of the 7 Chara Karakas</h3>
            <p>Each ranking position in the degree hierarchy governs a critical sphere of human existence and karmic duty:</p>

            <div class="table-responsive">
                <table class="nnc-table">
                    <thead>
                        <tr>
                            <th>Chara Karaka</th>
                            <th>Degree Ranking</th>
                            <th>Symbolic Cosmic Role</th>
                            <th>Life Domain & Representation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Atmakaraka (AK)</strong></td>
                            <td>Highest Degree</td>
                            <td>The King (Soul)</td>
                            <td>The true soul essence, karmic mission, core life trial, and ultimate spiritual liberation (Moksha).</td>
                        </tr>
                        <tr>
                            <td><strong>Amatyakaraka (AmK)</strong></td>
                            <td>2nd Highest</td>
                            <td>The Chief Minister</td>
                            <td>Career, profession, social influence, advisors, livelihood, and executive intellect.</td>
                        </tr>
                        <tr>
                            <td><strong>Bhratrikaraka (BK)</strong></td>
                            <td>3rd Highest</td>
                            <td>The Noble Sibling</td>
                            <td>Siblings, spiritual gurus, mentors, trusted counselors, and fatherly guidance.</td>
                        </tr>
                        <tr>
                            <td><strong>Matrikaraka (MK)</strong></td>
                            <td>4th Highest</td>
                            <td>The Nurturing Mother</td>
                            <td>Mother, emotional happiness, formal education, domestic peace, and real estate properties.</td>
                        </tr>
                        <tr>
                            <td><strong>Putrakaraka (PK)</strong></td>
                            <td>5th Highest</td>
                            <td>The Child / Disciple</td>
                            <td>Children, creative imagination, artistic legacy, higher knowledge, and disciples.</td>
                        </tr>
                        <tr>
                            <td><strong>Gnatikaraka (GK)</strong></td>
                            <td>6th Highest</td>
                            <td>The Challenger / Kinsman</td>
                            <td>Rivals, competitors, disputes, debts, diseases, obstacles, and competitive stamina.</td>
                        </tr>
                        <tr>
                            <td><strong>Darakaraka (DK)</strong></td>
                            <td>Lowest Degree</td>
                            <td>The Beloved Partner</td>
                            <td>Spouse, matrimonial union, business partners, intimate relationships, and emotional mirror.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h3>The Soul's Karmic Lessons: What Each Atmakaraka Teaches</h3>
            <p>Your Atmakaraka is the spiritual taskmaster of your incarnation. It reveals the exact karmic test you have chosen to master in this lifetime:</p>
            <ul class="nnc-list">
                <li><strong>Sun as Atmakaraka:</strong> The soul must conquer pride, false ego, and arrogance. The native is challenged to lead with selfless humility, practice truthfulness, and realize that true authority is rooted in service rather than domination.</li>
                <li><strong>Moon as Atmakaraka:</strong> The soul must master emotional attachments and possessiveness. The lesson involves developing universal compassion, psychological equanimity, and nurturing others without expectation of emotional return.</li>
                <li><strong>Mars as Atmakaraka:</strong> The soul must master impulsive aggression, temper, and anger. The life lesson centers on practicing absolute non-violence (<em>Ahimsa</em>), channeling passion into courageous protection of the vulnerable, and maintaining patience.</li>
                <li><strong>Mercury as Atmakaraka:</strong> The soul must conquer deceptive speech, manipulation, and intellectual vanity. The lesson is to use communication strictly for truth, education, and ethical commerce, avoiding sarcastic or frivolous talk.</li>
                <li><strong>Jupiter as Atmakaraka:</strong> The soul must cultivate profound respect for spiritual teachers, ancient wisdom, and religious beliefs. The lesson involves shedding dogmatic self-righteousness, honoring elders, and embracing lifelong learning.</li>
                <li><strong>Venus as Atmakaraka:</strong> The soul must master sensual desires, vanity, and lust. The native is guided toward maintaining sacred purity in relationships, honoring the divine feminine, and elevating earthly love into unconditional spiritual devotion.</li>
                <li><strong>Saturn as Atmakaraka:</strong> The soul must embrace sorrow, loneliness, and heavy responsibility without becoming bitter or resentful. The lesson is self-discipline, endurance, and selfless service to the suffering and underprivileged.</li>
            </ul>

            <h3>Understanding Darakaraka: The Window Into Your Soulmate</h3>
            <p>While the 7th house in the birth chart reflects marriage contracts, the <strong>Darakaraka (DK)</strong> reveals the spiritual nature, personality, and energetic essence of your spouse:</p>
            <ul class="nnc-list">
                <li><strong>Sun as Darakaraka:</strong> Indicates a spouse from a respectable, dignified family who possesses natural leadership, high self-esteem, and executive ambition. Mutual respect is essential.</li>
                <li><strong>Moon as Darakaraka:</strong> Blesses you with an empathetic, gentle, emotionally sensitive, and caring spouse with a maternal touch and romantic nature.</li>
                <li><strong>Mars as Darakaraka:</strong> Points to an athletic, energetic, decisive, and passionate partner who is fiercely protective, proactive, and career-driven.</li>
                <li><strong>Mercury as Darakaraka:</strong> Brings a youthful, witty, communicative, and intellectually curious spouse with strong analytical, writing, or commercial skills.</li>
                <li><strong>Jupiter as Darakaraka:</strong> Signifies a wise, noble, spiritually inclined, and well-educated spouse who acts as a counselor, teacher, and pillar of morality in the family.</li>
                <li><strong>Venus as Darakaraka:</strong> Endows a charming, artistically inclined, aesthetically refined, and affectionate partner who values romance, luxury, and mutual harmony.</li>
                <li><strong>Saturn as Darakaraka:</strong> Brings a mature, grounded, hard-working, and highly dependable spouse who may be older or deeply pragmatic, ensuring enduring marital stability.</li>
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
                    'What is the meaning of Atmakaraka in Jaimini astrology?' => 'Atmakaraka (literally "significator of the soul") is the planet holding the highest astronomical degree within its sign in your birth chart. It signifies your core identity, the primary karmic lesson you are born to overcome, and your path to spiritual awakening.',
                    'What does the Darakaraka reveal about my future spouse?' => 'The Darakaraka is the planet holding the lowest degree in your birth chart. It acts as a cosmic mirror reflecting the physical appearance, psychological temperament, professions, and karmic dynamic of your husband or wife.',
                    'What is Karakamsa Lagna and why is it important?' => 'The sign occupied by your Atmakaraka in the 9th harmonic divisional chart (Navamsha / D9) is designated as the Karakamsa Lagna. Analyzing planets in and around the Karakamsa reveals your highest spiritual potential, your Ishta Devata (chosen deity), and your true soul calling.',
                    'Why is an accurate birth time necessary for calculating Chara Karakas?' => 'Planets move continuously across degrees throughout the day. Because the Moon moves approximately 1 degree every two hours, and inner planets like Mercury and Venus move fast, an inaccurate birth time can easily shift the highest or lowest degree to a different planet.',
                    'Does Rahu count as an Atmakaraka or Darakaraka?' => 'In the 8-Karaka scheme followed by some classical Jaimini traditions, Rahu is included. Because Rahu moves in retrograde motion, its degrees are calculated in reverse (subtracting its position from 30 degrees). In the 7-Karaka scheme from the Sun to Saturn, Rahu is omitted.',
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
