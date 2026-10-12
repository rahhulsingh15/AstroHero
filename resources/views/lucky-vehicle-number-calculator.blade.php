@extends('frontend.layouts.master')
@section('title', 'Lucky Vehicle Number Calculator - Is Your Vehicle Number Lucky for You?')
@section('content')

    <section class="nnc-banner-section">
        <div class="container nnc-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">LUCKY VEHICLE NUMBER CALCULATOR</span>
            </div>
            <h1>Lucky Vehicle Number Calculator - Is Your Vehicle Number Lucky for You?</h1>
            <p class="nnc-subtitle">Numerology reduces your vehicle's registration number to a single digit and compares it with your birth number. Enter your date of birth and vehicle number to check whether the two are in harmony.</p>
        </div>
    </section>

    <section class="nnc-form-section">
        <div class="container">
            <div class="nnc-card">
                <div class="card-header">
                    <span class="icon">📝</span>
                    <h2>Check your Lucky Vehicle Number here</h2>
                </div>
                <form class="nnc-form" method="GET" action="{{ route('lucky-vehicle-number-report') }}" autocomplete="off">
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
                        <label for="nnc-vehicle">Vehicle Number *</label>
                        <input type="text" id="nnc-vehicle" name="vehicle" value="{{ old('vehicle') }}" placeholder="Enter full vehicle number, e.g. DL3CAB1234" maxlength="15" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Check my Vehicle Number</button>
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
            <h3>What Is a Lucky Vehicle Number?</h3>
            <p>In numerology every number is ruled by a planet. A vehicle number that agrees with your destiny number, the number of your full date of birth, is considered supportive, and is believed to bring smoother journeys and fewer breakdowns.</p>

            <h3>How Is It Calculated?</h3>
            <ul class="nnc-list">
                <li><strong>Step 1:</strong> Find your destiny number by adding every digit of your date of birth. Born on 15-08-1990: the digits add up to 33, and 3 + 3 = 6.</li>
                <li><strong>Step 2:</strong> Add the last four digits of the vehicle number. For 1234: 1 + 2 + 3 + 4 = 10, and 1 + 0 = 1.</li>
                <li><strong>Step 3:</strong> Check the vehicle number against your destiny number. It is Fully Compatible, Compatible or Not Compatible.</li>
            </ul>

            <h3>Numbers and Their Ruling Planets</h3>
            <div class="table-responsive">
                <table class="nnc-table values-table">
                    <thead>
                        <tr><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Sun</td><td>Moon</td><td>Jupiter</td><td>Rahu</td><td>Mercury</td><td>Venus</td><td>Ketu</td><td>Saturn</td><td>Mars</td></tr>
                    </tbody>
                </table>
            </div>

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
                    'How is a vehicle number calculated in numerology?' => 'The last four digits of the registration number are added together and reduced to one digit. That digit is then compared with your destiny number, which comes from your full date of birth.',
                    'Should the letters of the number plate be counted?' => 'The most common method uses only the four-digit number. Some numerologists also add the values of the letters for a fuller reading.',
                    'What if my vehicle number is not lucky?' => 'It is only guidance. Many people simply keep a friendly colour for the vehicle or choose a compatible number the next time they buy one.',
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
