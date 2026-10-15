@extends('frontend.layouts.master')
@section('title', $content->meta_title ?: 'Numerology Calculator - Find Your Destiny, Personality & Soul Number')
@section('content')

    <section class="nnc-banner-section">
        <div class="container nnc-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">{{ $content->breadcrumb_label ?: 'NAME NUMEROLOGY CALCULATOR' }}</span>
            </div>
            <h1>{{ $content->hero_title ?: 'Name Numerology Calculator' }}</h1>
            @if($content->hero_intro)
                <p class="nnc-subtitle">{{ $content->hero_intro }}</p>
            @endif
        </div>
    </section>

    <section class="nnc-form-section">
        <div class="container">
            <div class="nnc-card">
                <div class="card-header">
                    <span class="icon">📝</span>
                    <h2>{{ $content->form_title ?: 'Enter Your Details' }}</h2>
                </div>
                <form class="nnc-form" method="GET" action="{{ route('numerology-report') }}">
                    <div class="form-group">
                        <label for="nnc-name">Name *</label>
                        <input type="text" id="nnc-name" name="name" placeholder="Enter Full Name (e.g. Rahul Singh)"
                            maxlength="50" pattern=".*[A-Za-z].*" title="Enter your name in English letters" required>
                    </div>
                    <div class="form-group">
                        <label for="nnc-system">Numerology System</label>
                        <select id="nnc-system" name="system">
                            <option value="chaldean">Chaldean Numerology</option>
                            <option value="pythagorean">Pythagorean Numerology</option>
                        </select>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Calculate</button>
                        <button type="reset" class="btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="nnc-promo-section">
        <div class="container">
            <div class="promo-banner">
                <div class="promo-text">
                    <h3>{{ $content->promo_text ?: 'Connect with our Astrologers on Call or Chat for more personalized detailed predictions.' }}</h3>
                </div>
                <div class="promo-actions">
                    <a href="{{ route('talk-to-astrologers') }}" class="btn-call">📞 Call Astrologer</a>
                    <a href="{{ route('chat-with-astrologers') }}" class="btn-chat">💬 Chat Astrologer</a>
                </div>
            </div>
        </div>
    </section>

    <section class="nnc-content-section">
        <div class="container nnc-content-wrapper">
            {{-- Admin > Numerology Calculator > Page Content > Main Content (Jodit) --}}
            {!! $content->main_content !!}

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
                    <a href="{{ route('mangal-dosha-calculator') }}" class="calc-card">
                        <span class="c-icon">🔥</span>
                        <h4>Mangal Dosha Calculator</h4>
                        <p>Check for Manglik dosha</p>
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

    @if($faqs->isNotEmpty())
    <section class="acording_section">
        <div class="acord-container">
            <!-- Left Side: Title -->
            <div class="acord-left">
                <span class="acord-subtitle">{{ $content->faq_subtitle }}</span>
                <h2 class="acord-title">{!! $content->faq_title !!}</h2>
            </div>

            <!-- Right Side: Accordion List (Admin > Numerology Calculator > FAQs) -->
            <div class="acord-right">
                @foreach($faqs as $faq)
                    <div class="acord-item">
                        <button class="acord-btn">
                            <span>{{ $faq->question }}</span>
                            <div class="acord-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </div>
                        </button>
                        <div class="acord-content">
                            {!! $faq->answer !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif


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
@endsection
