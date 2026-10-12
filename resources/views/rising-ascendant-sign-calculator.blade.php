@extends('frontend.layouts.master')
@section('title', 'Rising Ascendant Sign Calculator | Find Your Ascendant Sign')
@section('content')
    <section class="ras-banner-section">
        <div class="container ras-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">RISING ASCENDANT SIGN CALCULATOR</span>
            </div>
            <h1>What is My Rising Sign? Find Your Ascendant</h1>
            <p class="ras-subtitle">Have you ever felt like you're completely different from your sun sign? That's because your rising sign, also known as your ascendant sign, plays a huge role in your personality. Discover your rising sign below!</p>
        </div>
    </section>

    <section class="ras-form-section">
        <div class="container">
            <div class="ras-card">
                <div class="card-header">
                    <h2>Calculate your Rising/Ascendant Sign here</h2>
                </div>
                <form class="ras-form" method="GET" action="{{ route('rising-ascendant-sign-report') }}" autocomplete="off">
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
                        <small class="ras-hint" id="ras-time-hint" hidden>Without a birth time we will use 12:00 noon, so your rising sign may not be correct.</small>
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
                        <button type="submit" class="btn-primary">Get Ascendant Sign</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="ras-content-section">
        <div class="container ras-content-wrapper">
            <h3>How to Calculate Rising/Ascendant Sign?</h3>
            <p>Your rising sign changes approximately every two hours, which is why having your exact time of birth is crucial for an accurate calculation. The ascendant is the zodiac sign that was rising on the eastern horizon at the exact moment and location of your birth.</p>

            <h3>What are the features of Twelve Rising Signs?</h3>
            <div class="signs-list">
                <div class="sign-item">
                    <h4><span class="sign-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21V9a4 4 0 0 1 4-4h.5a3.5 3.5 0 0 1 3.5 3.5v.5"/><path d="M12 21V9a4 4 0 0 0-4-4h-.5A3.5 3.5 0 0 0 4 8.5v.5"/></svg></span> Aries Rising</h4>
                    <p>People with Aries rising are energetic, bold, and quick to take action. They appear confident and are often seen as natural leaders. Their ruling planet is Mars.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="14" r="6"/><path d="M4 8c0-3 3-5 8-5s8 2 8 5"/></svg></span> Taurus Rising</h4>
                    <p>Taurus rising individuals exude a calm, steady presence. They value comfort, beauty, and security. Ruled by Venus, they have a natural appreciation for art and luxury.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 7h14M5 17h14M9 7v10M15 7v10"/></svg></span> Gemini Rising</h4>
                    <p>Curious, communicative, and adaptable, Gemini risings are always eager to learn and share information. Mercury is their ruling planet, making them quick-witted.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="17" cy="7" r="3"/><path d="M14 10s-3.5-3-2-7"/><circle cx="7" cy="17" r="3"/><path d="M10 14s3.5 3 2 7"/></svg></span> Cancer Rising</h4>
                    <p>Nurturing, sensitive, and intuitive, Cancer ascendants come across as gentle and protective. Ruled by the Moon, their emotions often guide their first impressions.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="6" cy="6" r="3"/><path d="M8.5 7.5C10.5 9.5 13 9.5 15 8s3.5-4 1.5-6S10 4 10 7c0 4 3 7.5 7 7.5a4.5 4.5 0 0 0 4.5-4.5"/></svg></span> Leo Rising</h4>
                    <p>Charismatic, proud, and warm, Leo risings naturally draw attention. Ruled by the Sun, they have a radiant and confident aura that lights up a room.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6v12M3 12h4c1 0 2-1 2-2V6M9 12h4c1 0 2-1 2-2V6M15 12h3c2 0 3 1 3 3v2c0 2-2 4-5 4H15"/></svg></span> Virgo Rising</h4>
                    <p>Analytical, observant, and helpful, Virgo ascendants approach the world with practicality. Mercury rules them, giving them a keen eye for detail.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17h18M5 12c1-3 4-5 7-5s6 2 7 5"/></svg></span> Libra Rising</h4>
                    <p>People with Libra rising are charming, graceful, and cooperative. They seek harmony in their relationships. Venus rules them, giving them an appreciation for art and beauty.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6v12M3 12h4c1 0 2-1 2-2V6M9 12h4c1 0 2-1 2-2V6M15 12c1 0 2 1 2 2v6l3-3"/></svg></span> Scorpio Rising</h4>
                    <p>Intense, magnetic, and perceptive, Scorpio ascendants often have a powerful presence. Pluto and Mars co-rule this sign, making them deeply passionate and driven.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 5L5 19M19 5v8M19 5h-8M14 10l-4 4"/></svg></span> Sagittarius Rising</h4>
                    <p>Optimistic, adventurous, and philosophical, Sagittarius risings are always seeking knowledge and new experiences. Jupiter is their ruling planet, bringing them luck and a love for travel.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6v12c0 1 1 2 2 2h2c1 0 2-1 2-2v-8c0-1 1-2 2-2s2 1 2 2v8M13 14c0 3 2 5 5 5s4-2 4-5v-6"/></svg></span> Capricorn Rising</h4>
                    <p>Ambitious, disciplined, and responsible, Capricorn ascendants are often seen as serious and hardworking. Saturn rules them, giving them a strong sense of duty and structure.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l3-3 3 3 3-3 3 3 3-3 3 3M3 17l3-3 3 3 3-3 3 3 3-3 3 3"/></svg></span> Aquarius Rising</h4>
                    <p>Unique, independent, and humanitarian, Aquarius risings often march to the beat of their own drum. Uranus and Saturn co-rule this sign, making them innovative and forward-thinking.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 3c-2 3-2 15 0 18M18 3c2 3 2 15 0 18M3 12h18"/></svg></span> Pisces Rising</h4>
                    <p>Compassionate, artistic, and intuitive, Pisces ascendants often seem dreamy and empathetic. Neptune and Jupiter co-rule them, giving them a strong connection to the spiritual and imaginative realms.</p>
                </div>
            </div>

            <h3 style="margin-top: 40px;">Conclusion</h3>
            <p>Understanding your rising sign is a powerful tool for self-discovery. It helps you understand how you present yourself to the world and how others perceive you. By knowing your ascendant, you can gain deeper insights into your personality, relationships, and life path. Remember that your rising sign is just one part of your complex astrological profile, working alongside your sun and moon signs to create the unique individual that you are.</p>

            <div class="discover-more">
                <h3>Discover More About Yourself</h3>
                <div class="calc-cards">
                    <div class="calc-card">
                        <span class="c-icon">❤️</span>
                        <h4>Love Calculator</h4>
                        <p>Check love percentage</p>
                    </div>
                    <div class="calc-card">
                        <span class="c-icon">🔢</span>
                        <h4>Name Numerology Calculator</h4>
                        <p>Find Destiny & Soul Number</p>
                    </div>
                    <div class="calc-card">
                        <span class="c-icon">☀️</span>
                        <h4>Sun Sign Calculator</h4>
                        <p>Discover your core identity</p>
                    </div>
                    <div class="calc-card">
                        <span class="c-icon">🌙</span>
                        <h4>Moon Sign Calculator</h4>
                        <p>Understand your emotions</p>
                    </div>
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

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>How accurate are online rising sign calculators?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>Online calculators are highly accurate provided you input the exact time, date, and place of birth. The mathematics used to calculate planetary positions is identical to what a professional astrologer uses.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>How do I find out my rising sign?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>Simply enter your birth details in the calculator above. The system will process your exact coordinates and birth time to determine which zodiac constellation was rising on the Eastern horizon when you were born.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>What is a rising sign?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>Your rising sign (or ascendant) is the zodiac sign that was ascending on the eastern horizon at the exact time of your birth. It represents your outer personality, physical appearance, and the first impression you make on others.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>Can I find my rising sign without a birth time?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>It is extremely difficult to find an accurate rising sign without a birth time because the rising sign changes roughly every two hours. You would need to consult an astrologer for birth time rectification.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>Is my birth date my rising sign?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>No, your birth date determines your Sun sign. Your rising sign is entirely dependent on your exact time and location of birth.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <script>

        const topTicker = document.getElementById('top-ticker');
        if (topTicker) {
            topTicker.innerHTML += topTicker.innerHTML;
        }

        const menuToggle = document.getElementById('menu-toggle');
        const navLinks = document.getElementById('nav-links');

        if (menuToggle && navLinks) {
            menuToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                navLinks.classList.toggle('open');
            });

            document.addEventListener('click', (e) => {
                if (!navLinks.contains(e.target) && !menuToggle.contains(e.target)) {
                    navLinks.classList.remove('open');
                }
            });

            navLinks.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => navLinks.classList.remove('open'));
            });
        }

        function toggleReadMore() {
            const moreText = document.querySelector('.more-text');
            const dots = document.querySelector('.more-dots');
            const btnText = document.querySelector('.read-more');

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Read more";
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Read less";
                moreText.style.display = "inline";
            }
        }



    document.addEventListener('DOMContentLoaded', () => {
    // New Accordion FAQ Logic
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
