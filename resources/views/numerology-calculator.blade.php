@extends('frontend.layouts.master')
@section('title', 'Numerology Calculator - Find Your Destiny, Personality & Soul Number')
@section('content')

    <section class="nnc-banner-section">
        <div class="container nnc-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">NAME NUMEROLOGY CALCULATOR</span>
            </div>
            <h1>Name Numerology Calculator - Find Your Destiny, Personality & Soul Number</h1>
            <p class="nnc-subtitle">Name Numerology helps you uncover the hidden numbers in your name that influence your personality and destiny. Discover your Expression Number, Soul Urge Number, and Personality Number by simply entering your details below.</p>
        </div>
    </section>

    <section class="nnc-form-section">
        <div class="container">
            <div class="nnc-card">
                <div class="card-header">
                    <span class="icon">📝</span>
                    <h2>Enter Your Details</h2>
                </div>
                <form class="nnc-form" method="GET" action="{{ route('numerology-report') }}">
                    <div class="form-group">
                        <label for="nnc-name">Name *</label>
                        <input type="text" id="nnc-name" name="name" placeholder="Enter Full Name (e.g. Rahul Singh)"
                            maxlength="50" pattern=".*[A-Za-z].*" title="Enter your name in English letters" required>
                    </div>
                    <div class="form-group">
                        <label for="nnc-system">Numerology System</label>
                        <select id="nnc-system" name="system">
                            <option value="chaldean">Chaldean Numerology</option>
                            <option value="pythagorean">Pythagorean Numerology</option>
                        </select>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Calculate</button>
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
            <h3>What Is Name Numerology?</h3>
            <p>Name numerology is the study of the numbers hidden in your name. Each letter of the alphabet is linked to a number, and when the letters of a name are added together they give a small set of numbers that numerologists read as a picture of your nature, your strengths and the kind of life you are drawn towards.</p>
            <p>Because you hear, write and sign your name every day, numerology treats it as a vibration that travels with you. A name whose numbers sit well with your date of birth is believed to support you, while a mismatch is believed to make the same effort feel heavier.</p>

            <h3>What Is the Difference Between the Name Numerology Systems?</h3>
            <p>Our calculator supports the two systems that are used most often. They give different results for the same name because they number the letters differently.</p>
            <div class="table-responsive">
                <table class="nnc-table">
                    <thead>
                        <tr>
                            <th>Feature</th>
                            <th>Chaldean System</th>
                            <th>Pythagorean System</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Origin</td>
                            <td>Ancient Babylon</td>
                            <td>Ancient Greece</td>
                        </tr>
                        <tr>
                            <td>How letters get their number</td>
                            <td>By the sound and vibration of each letter</td>
                            <td>By the order of the alphabet (A=1, B=2 … then repeat)</td>
                        </tr>
                        <tr>
                            <td>Numbers used</td>
                            <td>1 to 8 (9 is kept sacred and given to no letter)</td>
                            <td>1 to 9</td>
                        </tr>
                        <tr>
                            <td>Name usually taken</td>
                            <td>The name you are known by</td>
                            <td>Your full birth name</td>
                        </tr>
                        <tr>
                            <td>Best known for</td>
                            <td>Name correction and spelling changes</td>
                            <td>Personality and life-path readings</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h3>What Are the 3 Numbers in Your Name?</h3>
            <p>Every name gives three numbers: the <strong>Destiny (Expression) Number</strong>, the <strong>Soul Urge (Heart's Desire) Number</strong> and the <strong>Personality (Dream) Number</strong>. All three come from the same letter chart, shown below for both systems.</p>

            <h4>Chaldean letter chart</h4>
            <div class="table-responsive">
                <table class="nnc-table values-table">
                    <thead>
                        <tr>
                            <th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>A, I, J, Q, Y</td>
                            <td>B, K, R</td>
                            <td>C, G, L, S</td>
                            <td>D, M, T</td>
                            <td>E, H, N, X</td>
                            <td>U, V, W</td>
                            <td>O, Z</td>
                            <td>F, P</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h4>Pythagorean letter chart</h4>
            <div class="table-responsive">
                <table class="nnc-table values-table">
                    <thead>
                        <tr>
                            <th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>A, J, S</td>
                            <td>B, K, T</td>
                            <td>C, L, U</td>
                            <td>D, M, V</td>
                            <td>E, N, W</td>
                            <td>F, O, X</td>
                            <td>G, P, Y</td>
                            <td>H, Q, Z</td>
                            <td>I, R</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h3>What Is the Destiny / Expression Number?</h3>
            <p>The Destiny Number is the main number of your name. It describes the direction your life tends to take and the abilities you bring with you. It is read to understand:</p>
            <ul class="nnc-list">
                <li>the purpose you keep returning to in life</li>
                <li>the natural talents you can build a career on</li>
                <li>the kind of obstacles you are likely to meet, and how you deal with them</li>
                <li>the work and goals that suit you best</li>
            </ul>

            <h3>How Is the Destiny Number Calculated?</h3>
            <p>Write your name, put the chart number under each letter, add them all, and keep adding the digits until one digit is left. Take the name <strong>ANJALI</strong> in the Chaldean system:</p>
            <div class="table-responsive">
                <table class="nnc-table values-table">
                    <thead>
                        <tr><th>A</th><th>N</th><th>J</th><th>A</th><th>L</th><th>I</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>1</td><td>5</td><td>1</td><td>1</td><td>3</td><td>1</td></tr>
                    </tbody>
                </table>
            </div>
            <p>1 + 5 + 1 + 1 + 3 + 1 = 12, and 1 + 2 = 3. So the Numerology Total is 12 and the Destiny Number is <strong>3</strong>.</p>

            <h3>What Is the Personality / Dream Number?</h3>
            <p>The Personality Number is the side of you that other people see first. It is read to understand:</p>
            <ul class="nnc-list">
                <li>the first impression you make</li>
                <li>how you carry yourself in public</li>
                <li>the qualities strangers notice in you before they know you</li>
                <li>the mood you bring into a room</li>
            </ul>

            <h3>How Is the Personality Number Calculated?</h3>
            <p>Add only the consonants of the name. In ANJALI the consonants are N (5), J (1) and L (3), which add up to 9. The Personality Number is <strong>9</strong>.</p>

            <h3>What Is the Soul Urge / Heart's Desire Number?</h3>
            <p>The Soul Urge Number is the most private of the three. It points to what you want deep down, even when you do not say it. It is read to understand:</p>
            <ul class="nnc-list">
                <li>what truly motivates you</li>
                <li>the kind of relationship you long for</li>
                <li>what brings you peace of mind</li>
                <li>what makes life feel meaningful to you</li>
            </ul>

            <h3>How Is the Soul Urge Number Calculated?</h3>
            <p>Add only the vowels (A, E, I, O, U) of the name. In ANJALI the vowels are A (1), A (1) and I (1), which add up to 3. The Soul Urge Number is <strong>3</strong>.</p>

            <h3>Name Numerology: What Each Number Means</h3>
            <p>Whether it appears as your Destiny, Soul Urge or Personality Number, each number carries the nature of the planet that rules it.</p>
            <ul class="nnc-list">
                <li><strong>Number 1 (Sun):</strong> a leader. Confident, self-reliant, driven and happiest when in charge.</li>
                <li><strong>Number 2 (Moon):</strong> a nurturer. Gentle, feeling, imaginative and good at reading people.</li>
                <li><strong>Number 3 (Jupiter):</strong> an optimist. Expressive, cheerful, good with words and eager to learn.</li>
                <li><strong>Number 4 (Rahu):</strong> a builder. Practical, steady, dependable and unconventional in thinking.</li>
                <li><strong>Number 5 (Mercury):</strong> a quick mind. Curious, flexible, sociable and fond of change and travel.</li>
                <li><strong>Number 6 (Venus):</strong> a harmoniser. Warm, attractive, artistic and devoted to home and loved ones.</li>
                <li><strong>Number 7 (Ketu):</strong> a seeker. Thoughtful, private, spiritual and drawn to deeper questions.</li>
                <li><strong>Number 8 (Saturn):</strong> an achiever. Serious, patient, determined and able to carry responsibility.</li>
                <li><strong>Number 9 (Mars):</strong> a fighter. Bold, energetic, generous and quick to act.</li>
            </ul>

            <h3>When Should You Change Your Name?</h3>
            <p>Numerologists compare the Destiny Number of your name with your <strong>Birth Number</strong>, which is your date of birth reduced to one digit (born on the 19th: 1 + 9 = 10, 1 + 0 = 1). When the planets that rule the two numbers are friends, the name is said to support you. When they are natural enemies, a small spelling change is often suggested. The table follows the natural friendship of the ruling planets.</p>
            <div class="table-responsive">
                <table class="nnc-table">
                    <thead>
                        <tr>
                            <th>Birth Number</th>
                            <th>Friendly Destiny Numbers</th>
                            <th>Destiny Numbers to Avoid</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>1 (Sun)</td><td>1, 2, 3, 9</td><td>6, 8</td></tr>
                        <tr><td>2 (Moon)</td><td>1, 2, 5</td><td>4, 7</td></tr>
                        <tr><td>3 (Jupiter)</td><td>1, 2, 3, 9</td><td>5, 6</td></tr>
                        <tr><td>4 (Rahu)</td><td>4, 5, 6, 8</td><td>1, 2, 9</td></tr>
                        <tr><td>5 (Mercury)</td><td>1, 5, 6</td><td>2</td></tr>
                        <tr><td>6 (Venus)</td><td>5, 6, 8</td><td>1, 2</td></tr>
                        <tr><td>7 (Ketu)</td><td>6, 7, 8, 9</td><td>1, 2</td></tr>
                        <tr><td>8 (Saturn)</td><td>5, 6, 8</td><td>1, 2, 9</td></tr>
                        <tr><td>9 (Mars)</td><td>1, 2, 3, 9</td><td>5</td></tr>
                    </tbody>
                </table>
            </div>
            <p><strong>Note:</strong> in the Chaldean system no letter is given the number 9, but a name can still reduce to 9 when its letters are added.</p>
            <p>Here is how a correction works. Suppose Pooja is born on the 1st, so her Birth Number is 1 (Sun). In the Chaldean system POOJA adds up to 24, which reduces to 6 (Venus), a number the table says to avoid for Birth Number 1. Adding an H at the end changes the total to 29, which reduces to 2 (Moon), a friendly number.</p>
            <div class="table-responsive">
                <table class="nnc-table values-table">
                    <thead>
                        <tr><th></th><th>P</th><th>O</th><th>O</th><th>J</th><th>A</th><th>H</th><th>Total</th><th>Destiny</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Before</td><td>8</td><td>7</td><td>7</td><td>1</td><td>1</td><td>–</td><td>24</td><td>6</td></tr>
                        <tr><td>After</td><td>8</td><td>7</td><td>7</td><td>1</td><td>1</td><td>5</td><td>29</td><td>2</td></tr>
                    </tbody>
                </table>
            </div>
            <p>A name is part of your identity and your documents, so treat this as guidance and speak to a numerologist before making a real change.</p>

            <h3>How Does the Name Numerology Calculator Work?</h3>
            <p>Besides your three numbers, the report also lists what is traditionally linked with your Destiny Number: favourable sign, alphabets, days, dates and numbers, gemstone, direction, colour, ruling planet, deity, fast and mantra.</p>
            <ul class="nnc-list">
                <li><strong>Step 1:</strong> Type your name in English letters.</li>
                <li><strong>Step 2:</strong> Choose Chaldean or Pythagorean numerology.</li>
                <li><strong>Step 3:</strong> Click Calculate.</li>
                <li><strong>Step 4:</strong> Read your numbers, see how each letter was counted, and go through the details for your Destiny Number.</li>
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
                    <a href="{{ route('mangal-dosha-calculator') }}" class="calc-card">
                        <span class="c-icon">🔥</span>
                        <h4>Mangal Dosha Calculator</h4>
                        <p>Check for Manglik dosha</p>
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
                    'What is the name number in astrology?' => 'Your name gives three numbers. The Destiny Number shows the path your life tends to follow, the Personality Number shows how others see you, and the Soul Urge Number shows what you want at heart. Together they are called your name numbers.',
                    'Which number is good in name numerology?' => 'Numbers 1, 3, 5 and 6 are widely regarded as fortunate name numbers. Still, a number is only good for you if it is friendly with your Birth Number, so always check the two together.',
                    'What is the best number in name numerology?' => 'There is no single best number for everyone. 5, ruled by Mercury, is often called the most adaptable because it gets along with many Birth Numbers, but the right number for you is the one that suits your own date of birth.',
                    'How do I check my name numerology?' => 'Enter your name in the calculator above to get your Destiny Number. Then reduce your date of birth to one digit to get your Birth Number and compare the two using the table on this page.',
                    'Which numerology system is more accurate?' => 'Both are respected. Chaldean is older and is preferred for name correction, while Pythagorean is simpler and more common in the West. Trying both gives you a fuller picture.',
                    'Is this name numerology calculator free?' => 'Yes. You can check as many names as you like, in both systems, without paying or signing up.',
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

        const topTicker = document.getElementById('top-ticker');
        if (topTicker) {
            topTicker.innerHTML += topTicker.innerHTML;
        }

        const menuToggle = document.getElementById('menu-toggle');
        const navLinks = document.getElementById('nav-links');

        if (menuToggle && navLinks) {
            menuToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                navLinks.classList.toggle('open');
            });

            document.addEventListener('click', (e) => {
                if (!navLinks.contains(e.target) && !menuToggle.contains(e.target)) {
                    navLinks.classList.remove('open');
                }
            });

            navLinks.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => navLinks.classList.remove('open'));
            });
        }

        function toggleReadMore() {
            const moreText = document.querySelector('.more-text');
            const dots = document.querySelector('.more-dots');
            const btnText = document.querySelector('.read-more');

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Read more";
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Read less";
                moreText.style.display = "inline";
            }
        }



        document.addEventListener('DOMContentLoaded', () => {
    // New Accordion FAQ Logic
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
