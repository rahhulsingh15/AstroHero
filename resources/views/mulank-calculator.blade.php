@extends('frontend.layouts.master')
@section('title', 'Mulank Calculator - Find Your Birth Number from Date of Birth')
@section('content')

    <section class="nnc-banner-section">
        <div class="container nnc-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">MULANK CALCULATOR</span>
            </div>
            <h1>Mulank Calculator - Find Your Birth Number from Date of Birth</h1>
            <p class="nnc-subtitle">Mulank, also called the birth number or root number, is the day of the month you were born on reduced to a single digit. It describes your basic nature. Enter your date of birth to find your Mulank.</p>
        </div>
    </section>

    <section class="nnc-form-section">
        <div class="container">
            <div class="nnc-card">
                <div class="card-header">
                    <span class="icon">📝</span>
                    <h2>Calculate your Mulank here</h2>
                </div>
                <form class="nnc-form" method="GET" action="{{ route('mulank-report') }}" autocomplete="off">
                    @if ($errors->any())
                        <div class="ras-form-error">{{ $errors->first() }}</div>
                    @endif
                    <div class="form-group">
                        <label for="nnc-name">Name *</label>
                        <input type="text" id="nnc-name" name="name" value="{{ old('name') }}" placeholder="Enter Name in English Only" maxlength="50" pattern=".*[A-Za-z].*" title="Enter the name in English letters" required>
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
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Find My Mulank</button>
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
            <h3>What Is Mulank?</h3>
            <p>In Indian numerology the Mulank is the first number read for any person. It shows your natural temperament, the way you think and the first impression you leave. Each Mulank is ruled by a planet, and the qualities of that planet colour your personality.</p>

            <h3>Mulank by Date of Birth</h3>
            <div class="table-responsive">
                <table class="nnc-table">
                    <thead>
                        <tr><th>Mulank</th><th>Born on</th><th>Ruling Planet</th><th>Nature</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>1</td><td>1, 10, 19, 28</td><td>Sun</td><td>Leader, confident, independent</td></tr>
                        <tr><td>2</td><td>2, 11, 20, 29</td><td>Moon</td><td>Gentle, emotional, imaginative</td></tr>
                        <tr><td>3</td><td>3, 12, 21, 30</td><td>Jupiter</td><td>Wise, cheerful, disciplined</td></tr>
                        <tr><td>4</td><td>4, 13, 22, 31</td><td>Rahu</td><td>Practical, hard-working, unconventional</td></tr>
                        <tr><td>5</td><td>5, 14, 23</td><td>Mercury</td><td>Quick, sociable, adaptable</td></tr>
                        <tr><td>6</td><td>6, 15, 24</td><td>Venus</td><td>Charming, artistic, family-loving</td></tr>
                        <tr><td>7</td><td>7, 16, 25</td><td>Ketu</td><td>Thoughtful, spiritual, private</td></tr>
                        <tr><td>8</td><td>8, 17, 26</td><td>Saturn</td><td>Serious, patient, determined</td></tr>
                        <tr><td>9</td><td>9, 18, 27</td><td>Mars</td><td>Bold, energetic, generous</td></tr>
                    </tbody>
                </table>
            </div>

            <h3>What Is Mulank Used For?</h3>
            <ul class="nnc-list">
                <li>understanding your basic personality</li>
                <li>finding your lucky numbers, days and colours</li>
                <li>checking whether your name, mobile number or vehicle number suits you</li>
                <li>comparing compatibility with a partner</li>
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
                    'What is Mulank?' => 'Mulank is the single digit you get by adding the digits of your day of birth. Someone born on the 29th has 2 + 9 = 11, and 1 + 1 = 2, so the Mulank is 2.',
                    'Is Mulank the same as Bhagyank?' => 'No. Mulank uses only the day of birth. Bhagyank, the destiny number, uses the full date including the month and year.',
                    'Can two people have the same Mulank?' => 'Yes. Everyone born on the 1st, 10th, 19th or 28th of any month has Mulank 1, and so on for the other numbers.',
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
