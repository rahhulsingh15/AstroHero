@extends('frontend.layouts.master')
@section('title', 'Lucky Name Numerology Calculator - Is Your Name Lucky for You?')
@section('content')

    <section class="nnc-banner-section">
        <div class="container nnc-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">LUCKY NAME NUMEROLOGY CALCULATOR</span>
            </div>
            <h1>Lucky Name Numerology Calculator - Is Your Name Lucky for You?</h1>
            <p class="nnc-subtitle">A name is considered lucky when its number is friendly with the number of your date of birth. Enter your name and date of birth to check whether your name supports you.</p>
        </div>
    </section>

    <section class="nnc-form-section">
        <div class="container">
            <div class="nnc-card">
                <div class="card-header">
                    <span class="icon">📝</span>
                    <h2>Check your Lucky Name here</h2>
                </div>
                <form class="nnc-form" method="GET" action="{{ route('lucky-name-numerology-report') }}" autocomplete="off">
                    @if ($errors->any())
                        <div class="ras-form-error">{{ $errors->first() }}</div>
                    @endif
                    <div class="form-group">
                        <label for="nnc-name">Full Name *</label>
                        <input type="text" id="nnc-name" name="name" value="{{ old('name') }}" placeholder="Enter your full name" maxlength="50" pattern=".*[A-Za-z].*" title="Enter the name in English letters" required>
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
                        <label for="nnc-system">Numerology Type</label>
                        <select id="nnc-system" name="system">
                            <option value="cheiro" @selected(old('system') === 'cheiro')>Cheiro Numerology</option>
                            <option value="chaldean" @selected(old('system') === 'chaldean')>Chaldean Numerology</option>
                            <option value="pythagorean" @selected(old('system') === 'pythagorean')>Pythagorean Numerology</option>
                        </select>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Check my Name</button>
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
            <h3>What Is a Lucky Name in Numerology?</h3>
            <p>Numerology treats your name as a vibration you carry everywhere. Your date of birth cannot be changed, but your name can. So the name is adjusted to agree with the birth date, and a name that agrees is called a lucky name.</p>

            <h3>How Is It Checked?</h3>
            <ul class="nnc-list">
                <li><strong>Step 1:</strong> Your date of birth gives two numbers: the Life Path Number from the full date and the Radical Number from the day.</li>
                <li><strong>Step 2:</strong> Your name gives three numbers: the Destiny Number from all the letters, the Heart Desire Number from the vowels and the Personality Number from the consonants.</li>
                <li><strong>Step 3:</strong> The five numbers are compared with each other, and the result is a score out of 100.</li>
            </ul>

            <h3>How to Read Your Score</h3>
            <div class="table-responsive">
                <table class="nnc-table">
                    <thead>
                        <tr><th>Score</th><th>Result</th><th>What it means</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>85% and above</td><td>Highly Compatible</td><td>The name agrees fully with the date of birth</td></tr>
                        <tr><td>70% to 84%</td><td>Compatible</td><td>The name supports you on most points</td></tr>
                        <tr><td>50% to 69%</td><td>Moderately Compatible</td><td>Some numbers agree and some do not</td></tr>
                        <tr><td>30% to 49%</td><td>Weak Compatibility</td><td>The main numbers are not working together</td></tr>
                        <tr><td>Below 30%</td><td>Not Compatible</td><td>A name correction is traditionally advised</td></tr>
                    </tbody>
                </table>
            </div>
            <p>You can check your name in three systems. Cheiro and Chaldean use the same letter values, from 1 to 8, but differ in which numbers they treat as compatible. Pythagorean gives the letters the values 1 to 9 in order.</p>
            <p>A name is part of your identity and your documents, so speak to a numerologist before making a real change.</p>

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
                    'How do I know if my name is lucky?' => 'The numbers of your name are compared with the numbers of your date of birth and scored out of 100. A score of 70% or more means the name is compatible with you.',
                    'What can I do if my name is not lucky?' => 'Numerologists usually suggest a small spelling change, such as adding or doubling a letter, so that the name total moves to a friendly number.',
                    'Does this work for a baby name or a business name?' => 'Yes. Enter the name you are considering along with the date of birth of the child, or of the owner in the case of a business.',
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
