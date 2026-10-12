@extends('frontend.layouts.master')
@section('title', 'FLAMES Calculator - Find the Bond Between Two Names')
@section('content')

    <section class="nnc-banner-section">
        <div class="container nnc-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">FLAMES CALCULATOR</span>
            </div>
            <h1>FLAMES Calculator - Find the Bond Between Two Names</h1>
            <p class="nnc-subtitle">FLAMES is the classic name game that tells you whether two people are Friends, Lovers, Affectionate, heading for Marriage, Enemies or like Siblings. Enter the two names to play.</p>
        </div>
    </section>

    <section class="nnc-form-section">
        <div class="container">
            <div class="nnc-card">
                <div class="card-header">
                    <span class="icon">📝</span>
                    <h2>Calculate your FLAMES here</h2>
                </div>
                <form class="nnc-form" method="GET" action="{{ route('flames-report') }}" autocomplete="off">
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
                        <button type="submit" class="btn-primary">Calculate FLAMES</button>
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
            <h3>What Is FLAMES?</h3>
            <p>FLAMES is a game that has been played in school notebooks for generations. It takes two names and, through a simple counting method, lands on one of six letters, each standing for a kind of relationship.</p>

            <h3>How Is FLAMES Calculated?</h3>
            <ul class="nnc-list">
                <li><strong>Step 1:</strong> Write both names and cross out the letters they have in common, one pair at a time.</li>
                <li><strong>Step 2:</strong> Count the letters that are left in both names.</li>
                <li><strong>Step 3:</strong> Write F, L, A, M, E, S and count along it using that number. Strike off the letter you land on.</li>
                <li><strong>Step 4:</strong> Start counting again from the next letter and repeat until only one letter remains.</li>
            </ul>

            <h3>What Each Letter Means</h3>
            <ul class="nnc-list">
                <li><strong>F - Friends:</strong> an easy, trusting friendship.</li>
                <li><strong>L - Lovers:</strong> a romantic attraction.</li>
                <li><strong>A - Affection:</strong> warmth and care for each other.</li>
                <li><strong>M - Marriage:</strong> a bond that could last a lifetime.</li>
                <li><strong>E - Enemies:</strong> frequent clashes and disagreements.</li>
                <li><strong>S - Siblings:</strong> a protective, family-like bond.</li>
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
                    'What does FLAMES stand for?' => 'F is Friends, L is Lovers, A is Affection, M is Marriage, E is Enemies and S is Siblings.',
                    'Is the FLAMES result accurate?' => 'FLAMES is a game played for fun and has no basis in astrology. For a real compatibility check, kundli matching uses the birth charts of both people.',
                    'Does the spelling of the name matter?' => 'Yes. The game works on letters, so a different spelling, a nickname or adding a surname can change the result.',
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
