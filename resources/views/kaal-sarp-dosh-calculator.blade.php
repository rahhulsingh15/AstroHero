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
            <h3>What Is Kaal Sarp Dosh?</h3>
            <p>Rahu and Ketu are always exactly opposite each other and divide the chart into two halves. When every other planet sits in one half, the chart is said to be hemmed in by the serpent, with Rahu as its head and Ketu as its tail. People with this yoga are often said to face delays and repeated struggle before they succeed.</p>

            <h3>The 12 Types of Kaal Sarp Dosh</h3>
            <p>The type depends on the house in which Rahu is placed.</p>
            <div class="table-responsive">
                <table class="nnc-table">
                    <thead>
                        <tr><th>Rahu in</th><th>Type</th><th>Rahu in</th><th>Type</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>1st house</td><td>Anant</td><td>7th house</td><td>Takshak</td></tr>
                        <tr><td>2nd house</td><td>Kulik</td><td>8th house</td><td>Karkotak</td></tr>
                        <tr><td>3rd house</td><td>Vasuki</td><td>9th house</td><td>Shankhachur</td></tr>
                        <tr><td>4th house</td><td>Shankhpal</td><td>10th house</td><td>Ghatak</td></tr>
                        <tr><td>5th house</td><td>Padma</td><td>11th house</td><td>Vishdhar</td></tr>
                        <tr><td>6th house</td><td>Mahapadma</td><td>12th house</td><td>Sheshnag</td></tr>
                    </tbody>
                </table>
            </div>

            <h3>Remedies Traditionally Suggested</h3>
            <ul class="nnc-list">
                <li>Kaal Sarp Dosh Nivaran puja, commonly performed at Trimbakeshwar or Ujjain</li>
                <li>worship of Lord Shiva and chanting the Maha Mrityunjaya mantra</li>
                <li>offering milk and prayers on Nag Panchami</li>
                <li>chanting the Rahu and Ketu mantras during their periods</li>
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
                    'What is Kaal Sarp Dosh?' => 'It is a combination in which the Sun, Moon, Mars, Mercury, Jupiter, Venus and Saturn are all placed between Rahu and Ketu in the birth chart.',
                    'What is partial Kaal Sarp Dosh?' => 'When even one planet lies outside the Rahu-Ketu axis, the yoga is called partial (Anshik) and its effect is considered much weaker.',
                    'Does Kaal Sarp Dosh last for the whole life?' => 'The combination stays in the chart, but its effect is felt mainly during the periods of Rahu and Ketu and is said to ease with age and the right remedies.',
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
