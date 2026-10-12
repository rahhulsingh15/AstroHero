@extends('frontend.layouts.master')
@section('title', 'Moon Phase Calculator | Find Your Birth Moon Phase')
@section('content')
    <section class="nnc-banner-section">
        <div class="container nnc-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">MOON PHASE CALCULATOR</span>
            </div>
            <h1>Moon Phase Calculator</h1>
            <p class="nnc-subtitle">Discover the exact phase of the moon at the moment of your birth. The lunar phase reveals deep insights into your emotional nature, subconscious patterns, and spiritual path.</p>
        </div>
    </section>

    <section class="nnc-form-section">
        <div class="container">
            <div class="nnc-card">
                <div class="card-header">
                    <span class="icon">🌙</span>
                    <h2>Enter Birth Details</h2>
                </div>
                <form class="nnc-form" method="GET" action="{{ route('moon-phase-calculator-report') }}" autocomplete="off">
                    @if ($errors->any())
                        <div class="ras-form-error">{{ $errors->first() }}</div>
                    @endif
                    <div class="form-group">
                        <label for="mp-name">Name *</label>
                        <input type="text" id="mp-name" name="name" value="{{ old('name') }}" placeholder="Enter Full Name" maxlength="50" required>
                    </div>
                    <div class="form-group" style="display: flex; gap: 20px;">
                        <div style="flex: 1;">
                            <label for="mp-gender">Gender *</label>
                            <select id="mp-gender" name="gender">
                                <option value="male" @selected(old('gender') === 'male')>Male</option>
                                <option value="female" @selected(old('gender') === 'female')>Female</option>
                                <option value="other" @selected(old('gender') === 'other')>Other</option>
                            </select>
                        </div>
                        <div style="flex: 1;">
                            <label for="mp-dob">Date of Birth *</label>
                            <input type="date" id="mp-dob" name="dob" value="{{ old('dob') }}" min="1900-01-01" max="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="form-group" style="display: flex; gap: 20px;">
                        <div style="flex: 1;">
                            <label for="mp-tob">Time of Birth</label>
                            <input type="time" id="mp-tob" name="tob" value="{{ old('tob') }}">
                            <small class="ras-hint">Leave empty if you do not know it; 12:00 noon will be used.</small>
                        </div>
                        <div class="ras-place-group" style="flex: 1;">
                            <label for="ras-place">Place of Birth *</label>
                            <input type="text" id="ras-place" name="place" value="{{ old('place') }}" placeholder="Type your city, e.g. New Delhi" maxlength="120" required>
                            <input type="hidden" name="lat" value="{{ old('lat') }}">
                            <input type="hidden" name="lng" value="{{ old('lng') }}">
                            <input type="hidden" name="tz" value="{{ old('tz') }}">
                            <ul class="ras-place-list" id="ras-place-list" hidden></ul>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Calculate Moon Phase</button>
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
                    <button class="btn-call">📞 Call Astrologer</button>
                    <button class="btn-chat">💬 Chat Astrologer</button>
                </div>
            </div>
        </div>
    </section>

    <section class="nnc-content-section">
        <div class="container nnc-content-wrapper">
            <h3>What Are Moon Phases?</h3>
            <p>The moon phases, or lunar phases, refer to the shape of the moon's directly sunlit portion as viewed from Earth. As the moon orbits the Earth, its position relative to the Earth and Sun changes, causing it to go through a cycle of phases over approximately 29.5 days.</p>
            <p>Your natal moon phase (the phase the moon was in when you were born) is believed to deeply influence your core personality, emotional needs, and how you naturally process life's challenges. It provides a blueprint of your inner psychological landscape.</p>

            <h3>What are All the 8 Moon Phases?</h3>
            <p>The lunar cycle consists of eight distinct phases. Here is a detailed breakdown of each phase and what it signifies for those born under it:</p>

            <h4>1. New Moon</h4>
            <p>The New Moon occurs when the Moon is positioned between the Earth and the Sun, making the side facing Earth completely dark.</p>
            <ul class="nnc-list">
                <li><strong>Personality:</strong> Innovative, pioneering, impulsive, and full of fresh energy.</li>
                <li><strong>Traits:</strong> You love starting new projects, have a childlike curiosity, and tend to act on intuition rather than logic.</li>
                <li><strong>Challenge:</strong> You may struggle to finish what you start, constantly seeking the thrill of the "new."</li>
            </ul>

            <h4>2. Waxing Crescent</h4>
            <p>A sliver of the moon becomes visible on the right side as it begins its journey toward fullness.</p>
            <ul class="nnc-list">
                <li><strong>Personality:</strong> Determined, assertive, and focused on growth.</li>
                <li><strong>Traits:</strong> You have a strong drive to push forward, overcome obstacles, and establish yourself. You are highly motivated to succeed.</li>
                <li><strong>Challenge:</strong> You might feel a constant underlying tension or urgency to prove yourself.</li>
            </ul>

            <h4>3. First Quarter</h4>
            <p>The moon is exactly half-illuminated on its right side. This is a point of crisis and action in the lunar cycle.</p>
            <ul class="nnc-list">
                <li><strong>Personality:</strong> Action-oriented, strong-willed, and rebellious.</li>
                <li><strong>Traits:</strong> You thrive in high-pressure situations and love a good challenge. You are a natural manager and problem-solver.</li>
                <li><strong>Challenge:</strong> Prone to clashes with authority and impulsive decision-making during stressful times.</li>
            </ul>

            <h4>4. Waxing Gibbous</h4>
            <p>The moon is mostly illuminated, just a few days away from becoming a Full Moon.</p>
            <ul class="nnc-list">
                <li><strong>Personality:</strong> Analytical, nurturing, and perfectionist.</li>
                <li><strong>Traits:</strong> You have an innate desire to perfect your skills and contribute to society. You analyze situations deeply before acting.</li>
                <li><strong>Challenge:</strong> Overthinking and getting caught up in the details, leading to anxiety.</li>
            </ul>

            <h4>5. Full Moon</h4>
            <p>The Earth is between the Sun and the Moon, fully illuminating the Moon's face. This is the peak of the cycle.</p>
            <ul class="nnc-list">
                <li><strong>Personality:</strong> Expressive, highly emotional, dramatic, and relationship-oriented.</li>
                <li><strong>Traits:</strong> You are deeply affected by the people around you and seek meaning through relationships. You are likely highly intuitive, creative, and drawn to public life.</li>
                <li><strong>Challenge:</strong> Balancing your extreme emotional highs and lows. You may struggle with codependency.</li>
            </ul>

            <h4>6. Waning Gibbous</h4>
            <p>The moon begins to shrink, with darkness creeping in from the right side.</p>
            <ul class="nnc-list">
                <li><strong>Personality:</strong> Communicative, philosophical, and eager to share knowledge.</li>
                <li><strong>Traits:</strong> You feel a calling to teach, share experiences, and disseminate information. You want to leave a legacy based on what you've learned.</li>
                <li><strong>Challenge:</strong> Becoming too preachy or fanatical about your own beliefs.</li>
            </ul>

            <h4>7. Last Quarter</h4>
            <p>The moon is half-illuminated again, but this time on the left side.</p>
            <ul class="nnc-list">
                <li><strong>Personality:</strong> Transition-focused, introspective, and transformative.</li>
                <li><strong>Traits:</strong> You are going through an internal shift. You often evaluate what works and what needs to be discarded in life. You are independent and self-sufficient.</li>
                <li><strong>Challenge:</strong> Letting go of the past and embracing the unknown can be painful.</li>
            </ul>

            <h4>8. Waning Crescent (Balsamic Moon)</h4>
            <p>Only a tiny sliver remains visible on the left before the moon goes completely dark again.</p>
            <ul class="nnc-list">
                <li><strong>Personality:</strong> Spiritual, psychic, solitary, and wise.</li>
                <li><strong>Traits:</strong> You are an old soul, deeply connected to the spiritual realm. You possess innate wisdom and often act as a healer for others.</li>
                <li><strong>Challenge:</strong> Feelings of isolation or being misunderstood by the highly material world.</li>
            </ul>

            <h3>What is the Moon Cycle?</h3>
            <p>The moon cycle is the continuous orbit of the moon around the Earth, which takes approximately 29.5 days. This rhythm has guided agriculture, navigation, and astrology for thousands of years. Just as the moon controls the ocean's tides, astrology posits that the moon also governs our internal emotional tides, influencing our moods, instincts, and subconscious mind.</p>

            <div class="discover-more" style="margin-top: 50px;">
                <h3>Discover More about yourself</h3>
                <div class="calc-cards">
                    <div class="calc-card">
                        <span class="c-icon">🔮</span>
                        <h4>Birth Chart Calculator</h4>
                        <p>Generate your detailed Kundli</p>
                    </div>
                    <div class="calc-card">
                        <span class="c-icon">🔥</span>
                        <h4>Mangal Dosha Calculator</h4>
                        <p>Check Mars influence in your chart</p>
                    </div>
                    <div class="calc-card">
                        <span class="c-icon">❤️</span>
                        <h4>Love Calculator</h4>
                        <p>Check your compatibility</p>
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
                        <span>Is my moon phase the same as my Moon Sign?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>No, they are different. Your Moon Sign indicates which zodiac constellation the moon was passing through when you were born. Your Moon Phase indicates the angle between the Sun and the Moon (how illuminated the moon was).</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>Can moon phases affect my mood?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>Astrologically and culturally, it is widely believed that the moon impacts human emotions. Full moons are often associated with heightened emotions and climax, while new moons are associated with low energy and introspection.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>Which moon phase is best for starting something new?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>The New Moon phase is considered the best time for setting intentions, starting new projects, or beginning a new chapter in your life, as it represents a fresh cycle of energy.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>Why do I need to enter my time of birth?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>Because the moon moves very quickly (changing signs every 2.5 days and phases continuously), an exact time is necessary to calculate the precise angle between the Sun and Moon at the moment you were born.</p>
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
    </script>
    <script>
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
