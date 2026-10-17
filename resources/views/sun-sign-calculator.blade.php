@extends('frontend.layouts.master')
@section('title', 'Sun Sign Calculator - Find Your Zodiac Sign by Date of Birth')
@section('content')

    <section class="ras-banner-section">
        <div class="container ras-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">SUN SIGN CALCULATOR</span>
            </div>
            <h1>Sun Sign Calculator - Find Your Zodiac Sign by Date of Birth</h1>
            <p class="ras-subtitle">Your Sun sign is the zodiac sign the Sun was in on the day you were born. It describes your core nature, your will and the way you express yourself. Enter your birth details to find yours.</p>
        </div>
    </section>

    <section class="ras-form-section">
        <div class="container">
            <div class="ras-card">
                <div class="card-header">
                    <h2>Find your Sun Sign here</h2>
                </div>
                <form class="ras-form" method="GET" action="{{ route('sun-sign-report') }}" autocomplete="off">
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
                        <button type="submit" class="btn-primary">Find My Sun Sign</button>
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
            <h3>What Is a Sun Sign (Surya Rashi)? The Sovereign Light of the Soul</h3>
            <p>Your <strong>Sun Sign</strong> represents the specific zodiac constellation transited by the Sun at the moment of your birth. As our solar system’s central luminary, the Sun stays in each zodiac sign for approximately <strong>30 to 31 days</strong>, completing its journey across all 12 signs in one solar year (365.25 days).</p>
            <p>In Vedic astrology (<em>Jyotish</em>), the Sun is revered as <strong>Surya Deva</strong> and the supreme natural <strong>Atmakaraka</strong>—the significator of the eternal soul, life force (<em>Prana</em>), conscious willpower, paternal energy, self-respect, and executive leadership. While your Moon Sign reflects your private emotional atmosphere, your Sun Sign illuminates your outer life purpose, your professional drive, and the energetic legacy you project outward into society.</p>

            <h3>Vedic Sidereal (Nirayana) vs. Western Tropical (Sayana) Zodiac</h3>
            <p>One of the most frequent points of confusion for astrology enthusiasts is why their Vedic Sun sign often differs from their Western zodiac sign:</p>
            <ul class="nnc-list">
                <li><strong>Western Tropical System (Sayana):</strong> Anchored to the seasonal equinoxes (vernal equinox fixed at 0° Aries). It does not adjust for the slow astronomical wobble of Earth’s rotational axis.</li>
                <li><strong>Vedic Sidereal System (Nirayana):</strong> Anchored to the actual observable physical star constellations in the cosmos. Vedic astrology deducts an astronomical correction angle called <strong>Ayanamsha</strong> (currently around <strong>24 degrees</strong>).</li>
                <li><strong>The 23-Day Shift:</strong> Because of this 24-degree difference, your Sun enters each zodiac constellation roughly <strong>23 to 24 days later</strong> in the Vedic system than in Western astrology. For instance, the Sun enters sidereal Aries (Mesha Sankranti) around <strong>April 14</strong>, not March 21!</li>
            </ul>

            <h3>The 12 Sun Signs: Dates, Elements & Solar Archetypes</h3>
            <div class="table-responsive">
                <table class="nnc-table">
                    <thead>
                        <tr>
                            <th>Sign</th>
                            <th>Western Dates</th>
                            <th>Vedic Transit Dates</th>
                            <th>Element</th>
                            <th>Core Solar Strengths & Archetype</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td><strong>Aries (Mesha)</strong></td><td>Mar 21 – Apr 19</td><td>Apr 14 – May 14</td><td>Fire</td><td>Dynamic trailblazer, fearless initiative, executive bravery, direct action.</td></tr>
                        <tr><td><strong>Taurus (Vrishabh)</strong></td><td>Apr 20 – May 20</td><td>May 15 – Jun 14</td><td>Earth</td><td>Steadfast builder, financial stability, artistic taste, endurance, loyalty.</td></tr>
                        <tr><td><strong>Gemini (Mithun)</strong></td><td>May 21 – Jun 20</td><td>Jun 15 – Jul 15</td><td>Air</td><td>Communicative genius, intellectual wit, networking talent, versatile thinker.</td></tr>
                        <tr><td><strong>Cancer (Kark)</strong></td><td>Jun 21 – Jul 22</td><td>Jul 16 – Aug 16</td><td>Water</td><td>Nurturing protector, emotional leadership, empathetic intuition, loyalty.</td></tr>
                        <tr><td><strong>Leo (Singh)</strong></td><td>Jul 23 – Aug 22</td><td>Aug 17 – Sep 16</td><td>Fire</td><td>Magnanimous sovereign, innate authority, creative radiance, radiant warmth.</td></tr>
                        <tr><td><strong>Virgo (Kanya)</strong></td><td>Aug 23 – Sep 22</td><td>Sep 17 – Oct 16</td><td>Earth</td><td>Analytical strategist, precision mastery, selfless service, discernment.</td></tr>
                        <tr><td><strong>Libra (Tula)</strong></td><td>Sep 23 – Oct 22</td><td>Oct 17 – Nov 15</td><td>Air</td><td>Harmonious diplomat, legal fairness, refined aestheticism, social balance.</td></tr>
                        <tr><td><strong>Scorpio (Vrishchik)</strong></td><td>Oct 23 – Nov 21</td><td>Nov 16 – Dec 15</td><td>Water</td><td>Transformative mystic, emotional depth, investigative focus, resilience.</td></tr>
                        <tr><td><strong>Sagittarius (Dhanu)</strong></td><td>Nov 22 – Dec 21</td><td>Dec 16 – Jan 13</td><td>Fire</td><td>Philosophical seeker, global vision, infectious optimism, spiritual dharma.</td></tr>
                        <tr><td><strong>Capricorn (Makar)</strong></td><td>Dec 22 – Jan 19</td><td>Jan 14 – Feb 12</td><td>Earth</td><td>Master architect, disciplined endurance, executive ambition, long-term legacy.</td></tr>
                        <tr><td><strong>Aquarius (Kumbh)</strong></td><td>Jan 20 – Feb 18</td><td>Feb 13 – Mar 13</td><td>Air</td><td>Visionary reformer, humanitarian ideals, intellectual independence, original mind.</td></tr>
                        <tr><td><strong>Pisces (Meen)</strong></td><td>Feb 19 – Mar 20</td><td>Mar 14 – Apr 13</td><td>Water</td><td>Compassionate healer, boundless imagination, spiritual transcendence, empathy.</td></tr>
                    </tbody>
                </table>
            </div>

            <h3>How the Sun's Dignity Shapes Life & Destiny</h3>
            <p>In your personal Vedic Kundli, the Sun's placement indicates how effectively you command authority, handle adversity, and shine in your career:</p>
            <ul class="nnc-list">
                <li><strong>Exalted Sun (Uchcha in Aries):</strong> Bestows natural charisma, commanding administrative presence, fearless courage, high moral standards, and unshakeable self-confidence.</li>
                <li><strong>Moolatrikona & Own Sign (Leo):</strong> Gives royal grace, generosity of spirit, organizational supremacy, creative magnetism, and deep societal respect.</li>
                <li><strong>Debilitated Sun (Neecha in Libra):</strong> Suggests a tendency to compromise your core identity for external validation, challenges with fatherly figures, or digestive and bone vitality that requires mindful attention.</li>
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
                    'What is the difference between Western and Vedic Sun Signs?' => 'Western astrology uses the Tropical zodiac based on fixed seasons, while Vedic astrology uses the Sidereal zodiac based on the actual observable constellations. Due to the astronomical phenomenon known as Ayanamsha (precession of the equinoxes, roughly 24 degrees), your Vedic Sun sign usually falls about 23-24 days later than your Western sign.',
                    'What does my Sun sign represent in my daily life?' => 'Your Sun sign reveals your conscious ego, core character, innate leadership style, life mission, and physical vitality. It indicates where you derive true self-respect and what type of accomplishments grant you fulfillment.',
                    'What if I was born on the borderline (cusp) of two signs?' => 'The Sun transitions between zodiac signs (called a Sankranti) at a precise minute and second that varies slightly each year. If you were born on or near a transition date, your exact time and place of birth are crucial to calculate the exact astronomical degree and determine your true sign.',
                    'Can my Sun sign predict my marriage compatibility?' => 'While Sun sign harmony indicates mutual respect and shared lifestyle vision, Vedic astrology requires analyzing the Moon signs and Nakshatras (via Ashtakoota Milan) for genuine emotional and matrimonial compatibility.',
                    'How can I strengthen the positive vibrations of the Sun in my life?' => 'Traditional Vedic practices include performing Surya Namaskar at sunrise, offering fresh water to the rising Sun (Arghya) in a copper vessel while reciting the Gayatri Mantra, honoring your father and elders, and maintaining a dignified, truthful daily lifestyle.',
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
