@extends('frontend.layouts.master')
@section('title', 'Lo Shu Grid Calculator - Make Your Numerology Grid from Date of Birth')
@section('content')

    <section class="nnc-banner-section">
        <div class="container nnc-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">LO SHU GRID CALCULATOR</span>
            </div>
            <h1>Lo Shu Grid Calculator - Make Your Numerology Grid from Date of Birth</h1>
            <p class="nnc-subtitle">The Lo Shu Grid is a 3 × 3 square from Chinese numerology. The digits of your date of birth are placed in it to show which numbers are strong in your life and which are missing. Enter your date of birth to draw your grid.</p>
        </div>
    </section>

    <section class="nnc-form-section">
        <div class="container">
            <div class="nnc-card">
                <div class="card-header">
                    <span class="icon">📝</span>
                    <h2>Create your Lo Shu Grid here</h2>
                </div>
                <form class="nnc-form" method="GET" action="{{ route('lo-shu-grid-report') }}" autocomplete="off">
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
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Create my Lo Shu Grid</button>
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
            <h3>What Is the Lo Shu Grid?</h3>
            <p>According to legend, the pattern was first seen on the shell of a turtle that rose from the Lo river in ancient China. The nine numbers always keep the same boxes, and your date of birth decides which boxes are filled.</p>

            <h3>The Fixed Positions of the Grid</h3>
            <div class="table-responsive">
                <table class="nnc-table values-table">
                    <tbody>
                        <tr><td>4</td><td>9</td><td>2</td></tr>
                        <tr><td>3</td><td>5</td><td>7</td></tr>
                        <tr><td>8</td><td>1</td><td>6</td></tr>
                    </tbody>
                </table>
            </div>

            <h3>How Is the Grid Filled?</h3>
            <ul class="nnc-list">
                <li>Write your full date of birth, for example 15-08-1990.</li>
                <li>Place every digit in its own box. Zero is not placed anywhere. This gives 1, 5, 8, 1, 9, 9.</li>
                <li>Add your Driver Number (Mulank), the day of birth reduced to one digit: 1 + 5 = 6.</li>
                <li>Add your Conductor Number (Bhagyank), the full date reduced to one digit: 33, then 3 + 3 = 6.</li>
                <li>The grid now holds two 1s, one 5, two 6s, one 8 and two 9s. The boxes for 2, 3, 4 and 7 stay empty. These are the missing numbers.</li>
            </ul>

            <h3>What Each Number Stands For</h3>
            <ul class="nnc-list">
                <li><strong>1 - Leadership:</strong> Sun, Water, North</li>
                <li><strong>2 - Cooperation:</strong> Moon, Earth, Southwest</li>
                <li><strong>3 - Expression:</strong> Jupiter, Wood, East</li>
                <li><strong>4 - Discipline:</strong> Rahu, Wood, Southeast</li>
                <li><strong>5 - Freedom:</strong> Mercury, Earth, Center</li>
                <li><strong>6 - Responsibility:</strong> Venus, Metal, Northwest</li>
                <li><strong>7 - Spirituality:</strong> Ketu, Metal, West</li>
                <li><strong>8 - Power:</strong> Saturn, Earth, Northeast</li>
                <li><strong>9 - Compassion:</strong> Mars, Fire, South</li>
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
                    'What is the Lo Shu Grid?' => 'It is a magic square in which the numbers 1 to 9 are arranged so that every row, column and diagonal adds up to 15.',
                    'What does a missing number mean?' => 'A number that does not appear in your date of birth is an empty box in the grid. It points to a quality you have to build with effort.',
                    'What does a repeated number mean?' => 'A digit that appears more than once makes its quality stronger. Too many repetitions can make that quality excessive.',
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
