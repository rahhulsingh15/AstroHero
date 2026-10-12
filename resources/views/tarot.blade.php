@extends('frontend.layouts.master')
@section('title', 'Tarot Card Reading | Free Online Tarot')
@section('content')

    <section class="nnc-banner-section">
        <div class="container nnc-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">TAROT</span>
            </div>
            <h1>Tarot Card Reading</h1>
            <p class="nnc-subtitle">A tarot deck is a book of 78 pictures, each one a mirror for a part of life. A reading does not fix your future. It shows the energy around a question so that you can choose your next step with a clearer mind.</p>
        </div>
    </section>

    <!-- Main Content & Sidebar -->
    <section class="km-main-section">
        <div class="container">
            <div class="km-split">
                <!-- Left Content -->
                <div class="km-left nnc-content-wrapper">
                    <!-- Tarot Readings -->
                    <div class="discover-more" style="margin-top: 0;">
                        <h3>Tarot Readings</h3>
                        <div class="calc-cards">
                            <a href="#" class="calc-card">
                                <span class="c-icon">🃏</span>
                                <h4>One Card Reading</h4>
                                <p>Draw a single card for quick guidance on one question or on the day ahead.</p>
                            </a>
                            <a href="#" class="calc-card">
                                <span class="c-icon">🔮</span>
                                <h4>Three Card Reading</h4>
                                <p>Three cards for the past, the present and the future of a situation.</p>
                            </a>
                            <a href="#" class="calc-card">
                                <span class="c-icon">💖</span>
                                <h4>Love Card Reading</h4>
                                <p>Cards drawn only for matters of the heart and your relationship.</p>
                            </a>
                            <a href="#" class="calc-card">
                                <span class="c-icon">✅</span>
                                <h4>Yes / No Card Reading</h4>
                                <p>One card for a straight yes or no to a clear question.</p>
                            </a>
                        </div>
                    </div>

                    <h3>What Is Tarot?</h3>
                    <p>Tarot is a way of seeking guidance through a deck of 78 illustrated cards. The reader shuffles the deck while holding a question in mind, draws the cards and lays them in a pattern called a spread. The meaning comes from the cards that appear, the position each one falls in and how they relate to one another.</p>
                    <p>People turn to tarot for questions about love, career, money, health and personal growth. It works best with open questions such as "What should I know about this decision?"</p>

                    <h3>Major Arcana and Minor Arcana</h3>
                    <div class="table-responsive">
                        <table class="nnc-table">
                            <thead>
                                <tr><th>Feature</th><th>Major Arcana</th><th>Minor Arcana</th></tr>
                            </thead>
                            <tbody>
                                <tr><td>Number of cards</td><td>22</td><td>56</td></tr>
                                <tr><td>What they show</td><td>Big life lessons and turning points</td><td>Everyday events, moods and choices</td></tr>
                                <tr><td>How they are arranged</td><td>Numbered 0 to 21, from The Fool to The World</td><td>Four suits of 14 cards each</td></tr>
                                <tr><td>Weight in a reading</td><td>Long-lasting influence</td><td>Short-term influence</td></tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>The Four Suits of the Minor Arcana</h3>
                    <div class="table-responsive">
                        <table class="nnc-table">
                            <thead>
                                <tr><th>Suit</th><th>Element</th><th>Area of Life</th></tr>
                            </thead>
                            <tbody>
                                <tr><td>Wands</td><td>Fire</td><td>Action, ambition, energy</td></tr>
                                <tr><td>Cups</td><td>Water</td><td>Emotions, love, relationships</td></tr>
                                <tr><td>Swords</td><td>Air</td><td>Thoughts, decisions, conflict</td></tr>
                                <tr><td>Pentacles</td><td>Earth</td><td>Money, work, health</td></tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>The 22 Major Arcana Cards and Their Meaning</h3>
                    <div class="table-responsive">
                        <table class="nnc-table">
                            <thead>
                                <tr><th>No.</th><th>Card</th><th>Meaning</th></tr>
                            </thead>
                            <tbody>
                                <tr><td>0</td><td>The Fool</td><td>New beginnings, trust, a leap of faith</td></tr>
                                <tr><td>1</td><td>The Magician</td><td>Skill, willpower, making things happen</td></tr>
                                <tr><td>2</td><td>The High Priestess</td><td>Intuition, secrets, inner knowing</td></tr>
                                <tr><td>3</td><td>The Empress</td><td>Abundance, care, creativity</td></tr>
                                <tr><td>4</td><td>The Emperor</td><td>Authority, structure, stability</td></tr>
                                <tr><td>5</td><td>The Hierophant</td><td>Tradition, teaching, guidance</td></tr>
                                <tr><td>6</td><td>The Lovers</td><td>Love, union, an important choice</td></tr>
                                <tr><td>7</td><td>The Chariot</td><td>Determination, control, victory</td></tr>
                                <tr><td>8</td><td>Strength</td><td>Courage, patience, gentle power</td></tr>
                                <tr><td>9</td><td>The Hermit</td><td>Solitude, reflection, inner search</td></tr>
                                <tr><td>10</td><td>Wheel of Fortune</td><td>Change, cycles, a turn of luck</td></tr>
                                <tr><td>11</td><td>Justice</td><td>Fairness, truth, consequences</td></tr>
                                <tr><td>12</td><td>The Hanged Man</td><td>Pause, surrender, a new point of view</td></tr>
                                <tr><td>13</td><td>Death</td><td>Endings, transformation, a fresh chapter</td></tr>
                                <tr><td>14</td><td>Temperance</td><td>Balance, moderation, healing</td></tr>
                                <tr><td>15</td><td>The Devil</td><td>Attachment, temptation, feeling trapped</td></tr>
                                <tr><td>16</td><td>The Tower</td><td>Sudden upheaval, truth revealed</td></tr>
                                <tr><td>17</td><td>The Star</td><td>Hope, renewal, peace</td></tr>
                                <tr><td>18</td><td>The Moon</td><td>Illusion, fear, the subconscious</td></tr>
                                <tr><td>19</td><td>The Sun</td><td>Joy, success, vitality</td></tr>
                                <tr><td>20</td><td>Judgement</td><td>Awakening, reckoning, a calling</td></tr>
                                <tr><td>21</td><td>The World</td><td>Completion, fulfilment, wholeness</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <p>A card that appears upside down is called reversed. It usually points to the same theme being blocked, delayed or turned inward.</p>

                    <h3>How to Read Tarot Cards</h3>
                    <ul class="nnc-list">
                        <li><strong>Step 1:</strong> Sit quietly and decide on one clear question.</li>
                        <li><strong>Step 2:</strong> Shuffle the deck while keeping the question in mind.</li>
                        <li><strong>Step 3:</strong> Draw the cards and place them in the spread you have chosen.</li>
                        <li><strong>Step 4:</strong> Read each card for its own meaning and for the position it is in.</li>
                        <li><strong>Step 5:</strong> Put the cards together into one story and note what it asks you to do.</li>
                    </ul>

                    <h3>Popular Tarot Spreads</h3>
                    <ul class="nnc-list">
                        <li><strong>One card pull:</strong> a single card for the day or for a simple question. Best for beginners.</li>
                        <li><strong>Three card spread:</strong> past, present and future, or situation, action and outcome.</li>
                        <li><strong>Celtic Cross:</strong> ten cards that look at a question from every side, including hidden influences and the likely result.</li>
                    </ul>
                </div>

                <!-- Right Sidebar -->
                <div class="km-right">
                    <div class="sidebar-widget">
                        <div class="widget-header">
                            <h4>Talk to Horoscope experts</h4>
                            <p>Our top rated astrologers to answer your queries</p>
                        </div>
                        <div class="expert-list">
                            <!-- Expert 1 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg1.png') }}" alt="Prachesta" class="exp-img">
                                <div class="expert-info">
                                    <h5>Prachesta</h5>
                                    <p>Vedic Astrology, Numerology</p>
                                    <span class="rate">₹ 40/min</span>
                                </div>
                                <button class="btn-view">View</button>
                            </div>
                            <!-- Expert 2 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg3.png') }}" alt="Nevibala" class="exp-img">
                                <div class="expert-info">
                                    <h5>Nevibala</h5>
                                    <p>Vedic, Tarot</p>
                                    <span class="rate">₹ 29/min</span>
                                </div>
                                <button class="btn-view">View</button>
                            </div>
                            <!-- Expert 3 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg1.png') }}" alt="Swarna" class="exp-img">
                                <div class="expert-info">
                                    <h5>Swarna</h5>
                                    <p>Vedic, Numerology</p>
                                    <span class="rate">₹ 69/min</span>
                                </div>
                                <button class="btn-view">View</button>
                            </div>
                            <!-- Expert 4 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg2.png') }}" alt="Supransh" class="exp-img">
                                <div class="expert-info">
                                    <h5>Supransh</h5>
                                    <p>Vedic, Life Coach</p>
                                    <span class="rate">₹ 20/min</span>
                                </div>
                                <button class="btn-view">View</button>
                            </div>
                            <!-- Expert 5 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg3.png') }}" alt="Aarav" class="exp-img">
                                <div class="expert-info">
                                    <h5>Aarav</h5>
                                    <p>Vedic, Vastu</p>
                                    <span class="rate">₹ 35/min</span>
                                </div>
                                <button class="btn-view">View</button>
                            </div>
                        </div>
                        <a href="{{ route('chat-with-astrologers') }}" class="btn-view-all" style="display: block; text-align: center; text-decoration: none;">View all astrologers</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Other free tools -->
    <section class="km-tools-section">
        <div class="container">
            <h2 class="km-heading">Other free tools</h2>
            <div class="km-tools">
                <a href="{{ route('free-kundli') }}"><span>📜</span> Free Kundli</a>
                <a href="{{ route('kundli-matching') }}"><span>💞</span> Kundli Matching</a>
                <a href="{{ route('compatibility') }}"><span>♊</span> Zodiac Compatibility</a>
                <a href="{{ route('love-calculator') }}"><span>❤️</span> Love Calculator</a>
                <a href="{{ route('mangal-dosha-calculator') }}"><span>🔥</span> Mangal Dosha Calculator</a>
                <a href="{{ route('dasha-calculator') }}"><span>🪐</span> Dasha Calculator</a>
                <a href="{{ route('numerology-calculator') }}"><span>🔢</span> Numerology Calculator</a>
                <a href="{{ route('rising-ascendant-sign-calculator') }}"><span>🌅</span> Rising Sign Calculator</a>
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
                    'Can tarot predict the future?' => 'Tarot shows where things are heading if nothing changes. It is guidance, not a fixed prediction, and your choices can change the outcome.',
                    'How many cards are there in a tarot deck?' => 'A standard deck has 78 cards: 22 Major Arcana and 56 Minor Arcana.',
                    'What kind of question should I ask?' => 'Open questions work best, such as "What do I need to know about my career right now?" For a yes or no reading, ask one clear question at a time.',
                    'Is the Death card a bad sign?' => 'No. It almost never means physical death. It points to an ending that makes room for something new.',
                    'How is tarot different from astrology?' => 'Astrology reads your birth chart, which is fixed. Tarot reads the energy of the present moment around a question, so no birth details are needed.',
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
