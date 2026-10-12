@extends('frontend.layouts.master')
@section('title', 'Friendship Calculator - Test How Strong Your Friendship Is')
@section('content')

    <section class="nnc-banner-section">
        <div class="container nnc-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">FRIENDSHIP CALCULATOR</span>
            </div>
            <h1>Friendship Calculator - Test How Strong Your Friendship Is</h1>
            <p class="nnc-subtitle">Curious how well you and your friend click? Enter both names to get a friendship score based on the numbers hidden in your names.</p>
        </div>
    </section>

    <section class="nnc-form-section">
        <div class="container">
            <div class="nnc-card">
                <div class="card-header">
                    <span class="icon">📝</span>
                    <h2>Check your Friendship here</h2>
                </div>
                <form class="nnc-form" method="GET" action="{{ route('friendship-report') }}" autocomplete="off">
                    @if ($errors->any())
                        <div class="ras-form-error">{{ $errors->first() }}</div>
                    @endif
                    <div class="form-group">
                        <label for="nnc-name1">Your Name *</label>
                        <input type="text" id="nnc-name1" name="name1" value="{{ old('name1') }}" placeholder="Enter your name" maxlength="50" pattern=".*[A-Za-z].*" title="Enter the name in English letters" required>
                    </div>
                    <div class="form-group">
                        <label for="nnc-name2">Your Friend's Name *</label>
                        <input type="text" id="nnc-name2" name="name2" value="{{ old('name2') }}" placeholder="Enter your friend's name" maxlength="50" pattern=".*[A-Za-z].*" title="Enter the name in English letters" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Calculate our Friendship</button>
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
            <h3>What Is a Friendship Calculator?</h3>
            <p>A friendship calculator is a light-hearted tool that gives a compatibility score for two friends. It uses name numerology: every name is reduced to a single number with the Chaldean chart, and the closer the two numbers are, the higher the score. Equal numbers give 100%, and every step between them takes away 10%, down to a minimum of 40%.</p>

            <h3>How to Read Your Score</h3>
            <ul class="nnc-list">
                <li><strong>100% - Soul Friends:</strong> both names reduce to the same number. You think and feel alike.</li>
                <li><strong>90% - Excellent Pair:</strong> a lasting friendship built on trust.</li>
                <li><strong>80% - Strong Bond:</strong> you understand and support each other.</li>
                <li><strong>70% - Good Match:</strong> things flow easily and you enjoy each other's company.</li>
                <li><strong>60% - Mild Bond:</strong> you get along well, most of all over a shared interest.</li>
                <li><strong>50% - Neutral Ground:</strong> neither a strong pull nor a clash. Respect lets it grow.</li>
                <li><strong>40% - Fragile Tie:</strong> very different natures. Patience will matter most.</li>
            </ul>

            <h3>What Makes a Friendship Last?</h3>
            <ul class="nnc-list">
                <li>being honest even when it is uncomfortable</li>
                <li>showing up in difficult times, not only the happy ones</li>
                <li>respecting each other's space and choices</li>
                <li>forgiving small mistakes quickly</li>
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
                    'How does the friendship calculator work?' => 'Each letter of a name has a number in numerology. The numbers of both names are compared to see how naturally the two people get along.',
                    'Is the friendship score accurate?' => 'It is meant for fun. Real friendship depends on trust, time and effort, which no calculator can measure.',
                    'Can I check more than one friend?' => 'Yes. You can try as many names as you like.',
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
