@extends('frontend.layouts.master')
@section('title', 'Name Compatibility Calculator - Check How Well Two Names Match')
@section('content')

    <section class="nnc-banner-section">
        <div class="container nnc-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">NAME COMPATIBILITY CALCULATOR</span>
            </div>
            <h1>Name Compatibility Calculator - Check How Well Two Names Match</h1>
            <p class="nnc-subtitle">Every name reduces to a number, and every number is ruled by a planet. This calculator compares the numbers of two names to show how naturally the two people fit together. Enter both names to check.</p>
        </div>
    </section>

    <section class="nnc-form-section">
        <div class="container">
            <div class="nnc-card">
                <div class="card-header">
                    <span class="icon">📝</span>
                    <h2>Check your Name Compatibility here</h2>
                </div>
                <form class="nnc-form" method="GET" action="{{ route('name-compatibility-report') }}" autocomplete="off">
                    @if ($errors->any())
                        <div class="ras-form-error">{{ $errors->first() }}</div>
                    @endif
                    <div class="form-group">
                        <label for="nnc-name1">Your Name *</label>
                        <input type="text" id="nnc-name1" name="name1" value="{{ old('name1') }}" placeholder="Enter your name" maxlength="50" pattern=".*[A-Za-z].*" title="Enter the name in English letters" required>
                    </div>
                    <div class="form-group">
                        <label for="nnc-name2">Your Partner's Name *</label>
                        <input type="text" id="nnc-name2" name="name2" value="{{ old('name2') }}" placeholder="Enter your partner's name" maxlength="50" pattern=".*[A-Za-z].*" title="Enter the name in English letters" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Check Name Compatibility</button>
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
                    <h3>Connect with our Astrologers on Call or Chat for more personalized detailed predictions.</h3>
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
            <h3>What Is Name Compatibility?</h3>
            <p>Name compatibility is a branch of numerology that looks at the relationship between two name numbers. When the planets ruling the two numbers are friends, the people are said to understand each other easily. When they are enemies, the relationship is believed to need more patience.</p>

            <h3>How Does It Work?</h3>
            <ul class="nnc-list">
                <li><strong>Step 1:</strong> Each letter is given its numerology value.</li>
                <li><strong>Step 2:</strong> The values of a name are added and reduced to a single digit, called the name number.</li>
                <li><strong>Step 3:</strong> The same is done for the second name.</li>
                <li><strong>Step 4:</strong> The two name numbers are compared. Equal numbers give 100%, and every step between them takes away 10%, down to a minimum of 40%.</li>
            </ul>

            <h3>Where Can You Use It?</h3>
            <ul class="nnc-list">
                <li>between partners, before or after marriage</li>
                <li>between business partners</li>
                <li>between friends or family members</li>
                <li>between your own name and the name of your business or brand</li>
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
                    'How is name compatibility calculated?' => 'The letters of each name are converted to numbers and added until one digit is left. The two digits are then compared using the friendship of their ruling planets.',
                    'Should I use my full name or the name I am called by?' => 'Use the name you are known by every day. That is the name numerology considers active in your life.',
                    'Is name compatibility enough to decide a marriage?' => 'No. It is a quick first look. Traditional kundli matching, which uses the birth charts of both people, is far more detailed.',
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
@endsection
