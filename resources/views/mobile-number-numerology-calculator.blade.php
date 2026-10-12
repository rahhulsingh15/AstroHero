@extends('frontend.layouts.master')
@section('title', 'Mobile Number Numerology Calculator - Is Your Phone Number Lucky?')
@section('content')

    <section class="nnc-banner-section">
        <div class="container nnc-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">MOBILE NUMBER NUMEROLOGY CALCULATOR</span>
            </div>
            <h1>Mobile Number Numerology Calculator - Is Your Phone Number Lucky?</h1>
            <p class="nnc-subtitle">You use your mobile number many times a day, so numerology treats it as a number that travels with you. Enter your date of birth and mobile number to check whether the two are in harmony.</p>
        </div>
    </section>

    <section class="nnc-form-section">
        <div class="container">
            <div class="nnc-card">
                <div class="card-header">
                    <span class="icon">📝</span>
                    <h2>Check your Lucky Mobile Number here</h2>
                </div>
                <form class="nnc-form" method="GET" action="{{ route('mobile-number-numerology-report') }}" autocomplete="off">
                    @if ($errors->any())
                        <div class="ras-form-error">{{ $errors->first() }}</div>
                    @endif
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
                        <label for="nnc-mobile">Mobile Number *</label>
                        <input type="tel" id="nnc-mobile" name="mobile" value="{{ old('mobile') }}" placeholder="Enter full mobile number (10 digits)" maxlength="10" pattern="[0-9]{10}" title="Enter a 10-digit mobile number" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Check my Mobile Number</button>
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
            <h3>What Is Mobile Number Numerology?</h3>
            <p>Mobile number numerology studies the total of your phone number and the digits that repeat in it. A number that agrees with your birth number is believed to support your communication, work and relationships, while a clashing one is believed to bring small, repeated obstacles.</p>

            <h3>How Is It Calculated?</h3>
            <p>Take the number <strong>9876543210</strong>:</p>
            <ul class="nnc-list">
                <li>9 + 8 + 7 + 6 + 5 + 4 + 3 + 2 + 1 + 0 = 45</li>
                <li>4 + 5 = 9</li>
                <li>The mobile number total is <strong>9</strong>, ruled by Mars.</li>
            </ul>
            <p>This total is then compared with your destiny number, which is your full date of birth reduced to one digit. Born on 15-08-1990: 1 + 5 + 0 + 8 + 1 + 9 + 9 + 0 = 33, and 3 + 3 = 6. A mobile total of 9 agrees with destiny number 6, so this number is compatible.</p>

            <h3>What Else Do Numerologists Look At?</h3>
            <ul class="nnc-list">
                <li>the digit that appears most often in the number</li>
                <li>digits that are missing completely</li>
                <li>the last four digits, which are used and seen the most</li>
                <li>whether the total is among the numbers that agree with your destiny number</li>
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
                    'How is a mobile number calculated in numerology?' => 'All ten digits are added together and reduced to a single digit. That digit is compared with your destiny number, which comes from your full date of birth.',
                    'Which mobile number total is considered lucky?' => 'It depends on your own destiny number. For destiny number 1 the totals 1, 2, 3 and 5 are compatible, for destiny number 6 the totals 2, 3, 5, 6 and 9, and so on.',
                    'Do I need to change my number if it is not lucky?' => 'No. It is guidance, not a rule. If you are choosing a new number anyway, you can pick one with a friendly total.',
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
