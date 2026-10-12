@extends('frontend.layouts.master')
@section('title', 'Destiny Number Calculator - Find Your Bhagyank from Date of Birth')
@section('content')

    <section class="nnc-banner-section">
        <div class="container nnc-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">DESTINY NUMBER CALCULATOR</span>
            </div>
            <h1>Destiny Number Calculator - Find Your Bhagyank from Date of Birth</h1>
            <p class="nnc-subtitle">Your destiny number, known as Bhagyank in Indian numerology, comes from your complete date of birth. It shows the direction your life tends to take and the opportunities that come your way. Enter your date of birth to find it.</p>
        </div>
    </section>

    <section class="nnc-form-section">
        <div class="container">
            <div class="nnc-card">
                <div class="card-header">
                    <span class="icon">📝</span>
                    <h2>Calculate your Destiny Number here</h2>
                </div>
                <form class="nnc-form" method="GET" action="{{ route('destiny-number-report') }}" autocomplete="off">
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
                        <button type="submit" class="btn-primary">Find My Destiny Number</button>
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
            <h3>What Is the Destiny Number?</h3>
            <p>If Mulank is who you are, Bhagyank is where you are going. Numerologists read it to understand the kind of work that suits you, how luck behaves in your life and the lessons that keep returning until they are learnt.</p>

            <h3>How Is the Destiny Number Calculated?</h3>
            <p>Add all the digits of the date of birth and keep adding until one digit remains. For someone born on <strong>15-08-1990</strong>:</p>
            <ul class="nnc-list">
                <li>1 + 5 + 0 + 8 + 1 + 9 + 9 + 0 = 33</li>
                <li>3 + 3 = 6</li>
                <li>The destiny number is <strong>6</strong>, ruled by Venus.</li>
            </ul>

            <h3>What Each Destiny Number Points To</h3>
            <ul class="nnc-list">
                <li><strong>1 (Sun):</strong> leadership, authority and work where you are in charge.</li>
                <li><strong>2 (Moon):</strong> caring roles, creativity and work involving people.</li>
                <li><strong>3 (Jupiter):</strong> teaching, advising, law and knowledge.</li>
                <li><strong>4 (Rahu):</strong> technology, research and unusual paths.</li>
                <li><strong>5 (Mercury):</strong> business, communication, travel and trade.</li>
                <li><strong>6 (Venus):</strong> arts, design, luxury and hospitality.</li>
                <li><strong>7 (Ketu):</strong> research, healing and spiritual pursuits.</li>
                <li><strong>8 (Saturn):</strong> administration, industry and slow, steady success.</li>
                <li><strong>9 (Mars):</strong> defence, sports, engineering and work that needs courage.</li>
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
                    'What is the destiny number?' => 'It is the single digit you get by adding every digit of your date of birth: day, month and year.',
                    'How is it different from Mulank?' => 'Mulank comes from the day of birth alone and shows your nature. The destiny number uses the full date and shows where life is leading you.',
                    'Is there also a destiny number from the name?' => 'Yes. Western numerology uses the same term for the number of your name. You can find that one with our Numerology Calculator.',
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
