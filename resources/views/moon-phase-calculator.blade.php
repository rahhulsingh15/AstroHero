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
            <h1>{{ $content->heading ?: 'Moon Phase Calculator' }}</h1>
            <p class="nnc-subtitle">{{ $content->description ?? '' }}</p>
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
        {!! $content->main_content ?? '' !!}
    </section>

    <section class="acording_section">
        {!! $content->faq_content ?? '' !!}
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
