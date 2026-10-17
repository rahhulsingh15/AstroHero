@extends('frontend.layouts.master')
@section('title', 'Shani Sade Sati Calculator - Check If Sade Sati Is Running for You')
@section('content')

    <section class="ras-banner-section">
        <div class="container ras-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">SHANI SADE SATI CALCULATOR</span>
            </div>
            <h1>Shani Sade Sati Calculator - Check If Sade Sati Is Running for You</h1>
            <p class="ras-subtitle">Sade Sati is the period of about seven and a half years when Saturn passes through the sign before your Moon sign, your Moon sign and the sign after it. Enter your birth details to see whether you are in it and which phase is running.</p>
        </div>
    </section>

    <section class="ras-form-section">
        <div class="container">
            <div class="ras-card">
                <div class="card-header">
                    <h2>Check your Shani Sade Sati here</h2>
                </div>
                <form class="ras-form" method="GET" action="{{ route('shani-sade-sati-report') }}" autocomplete="off">
                    @if ($errors->any())
                        <div class="ras-form-error">{{ $errors->first() }}</div>
                    @endif
                    <div class="form-group">
                        <label for="ras-name">Name *</label>
                        <input type="text" id="ras-name" name="name" value="{{ old('name') }}" placeholder="Enter your full name" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="ras-gender">Gender *</label>
                        <select id="ras-gender" name="gender">
                            <option value="male" @selected(old('gender') === 'male')>Male</option>
                            <option value="female" @selected(old('gender') === 'female')>Female</option>
                        </select>
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
                        <label>Time of Birth *</label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="time_unknown" value="1" id="ras-time-unknown" @checked(old('time_unknown'))> I don't know my exact time of birth
                        </label>
                        <div class="time-inputs" id="ras-time-inputs">
                            <select name="hour" required aria-label="Hour">
                                <option value="">Hour</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" @selected(old('hour') == $i)>{{ sprintf('%02d', $i) }}</option>
                                @endfor
                            </select>
                            <select name="minute" required aria-label="Minute">
                                <option value="">Minute</option>
                                @for ($i = 0; $i <= 59; $i++)
                                    <option value="{{ $i }}" @selected(old('minute') !== null && old('minute') == $i)>{{ sprintf('%02d', $i) }}</option>
                                @endfor
                            </select>
                            <select name="ampm" required aria-label="AM or PM">
                                <option value="AM" @selected(old('ampm') === 'AM')>AM</option>
                                <option value="PM" @selected(old('ampm') === 'PM')>PM</option>
                            </select>
                        </div>
                        <small class="ras-hint" id="ras-time-hint" hidden>Without a birth time we will use 12:00 noon, so the result may be less accurate.</small>
                    </div>
                    <div class="form-group ras-place-group">
                        <label for="ras-place">Place of Birth *</label>
                        <input type="text" id="ras-place" name="place" value="{{ old('place') }}" placeholder="Type your city, e.g. New Delhi" maxlength="120" required>
                        <input type="hidden" name="lat" value="{{ old('lat') }}">
                        <input type="hidden" name="lng" value="{{ old('lng') }}">
                        <input type="hidden" name="tz" value="{{ old('tz') }}">
                        <ul class="ras-place-list" id="ras-place-list" hidden></ul>
                    </div>
                    <div class="form-actions center">
                        <button type="submit" class="btn-primary">Check Sade Sati</button>
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

    <section class="ras-content-section">
        <div class="container ras-content-wrapper">
            <h3>What Is Shani Sade Sati? The Cosmic Law of Karmic Transformation</h3>
            <p><strong>Shani Sade Sati</strong> is one of the most significant and profound planetary transit phases in Vedic astrology. The phrase literally translates to <em>"seven and a half"</em> in Hindi, representing the seven-and-a-half-year period during which <strong>Saturn (Shani Dev)</strong> traverses the signs immediately preceding, containing, and following your natal <strong>Moon sign (Janma Rashi)</strong>.</p>
            <p>Saturn is the slowest among the seven classical visible planets, taking approximately <strong>29.5 years</strong> to complete a full orbit around the 12 zodiac signs. Consequently, it spends roughly <strong>2.5 years (30 months)</strong> in each zodiac sign. When Saturn enters the 12th house from your natal Moon sign, your Sade Sati begins. It persists through its transit across your Moon sign itself (1st house) and culminates only when it exits the 2nd house from your Moon.</p>
            <p>In Vedic philosophy, the Moon governs the human mind (<em>Manas</em>), emotions, mental resilience, and subconscious memories. When Saturn—the cosmic taskmaster and divine arbiter of justice (<em>Nyayadhikari</em>)—transits in close proximity to the Moon, it places the emotional self under intense scrutiny. Far from being a mere harbinger of hardship, Sade Sati is a sacred spiritual crucible designed to strip away illusions, instil humility, rebuild character, and align your life path with your true soul purpose.</p>

            <h3>The Three Phases (Charans) of Shani Sade Sati Explained</h3>
            <p>Sade Sati operates across three distinct 2.5-year chapters, each activating different houses, psychological themes, and life dimensions:</p>

            <div class="table-responsive">
                <table class="nnc-table">
                    <thead>
                        <tr>
                            <th>Phase / Charan</th>
                            <th>Saturn's Transit Position</th>
                            <th>Key Life Focus</th>
                            <th>Core Themes & Experiences</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>1st Phase (Rising Phase / Aarohi)</strong></td>
                            <td>12th House from natal Moon</td>
                            <td>Expenditure, Sleep, Restlessness & Foreign Travel</td>
                            <td>Financial shifts, sudden unforeseen expenses, relocation or foreign journeys, sleeplessness, subconscious anxiety, and winding down outmoded commitments.</td>
                        </tr>
                        <tr>
                            <td><strong>2nd Phase (Peak Phase / Madhyama)</strong></td>
                            <td>Over natal Moon (1st House)</td>
                            <td>Physical Health, Mental Peace, Core Identity</td>
                            <td>Maximum emotional weight, domestic responsibilities, tests of endurance, career pressure, feeling isolated, and deep karmic restructuring of identity.</td>
                        </tr>
                        <tr>
                            <td><strong>3rd Phase (Setting Phase / Avarohi)</strong></td>
                            <td>2nd House from natal Moon</td>
                            <td>Finances, Family Dynamics & Speech (Vani)</td>
                            <td>Gradual lifting of mental gloom, rebuilding financial reserves, clearing ancestral debts, family obligations, and mastering thoughtful, disciplined speech.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h4>Phase 1: The Rising Phase (12th House Transit)</h4>
            <p>When Saturn enters the 12th house from your natal Moon, the first phase begins. The 12th house governs expenditures (<em>Vyaya</em>), overseas travel, sleep patterns, and spiritual surrender. During this period, individuals often experience sudden or unplanned expenses, disruptions to routine sleep, and a feeling of subtle dissatisfaction with status-quo achievements. It prompts you to shed superficial obligations, pay off lingering debts, and re-evaluate life priorities. Staying prudent with capital and avoiding speculative gambles is paramount during this chapter.</p>

            <h4>Phase 2: The Peak Phase (Transit Over the Natal Moon)</h4>
            <p>Widely regarded as the core of Sade Sati, the second phase occurs when Saturn conjuncts your natal Moon in your Janma Rashi. Because the Moon directly reflects your psychological atmosphere, Saturn's intense gaze can manifest as heavy mental fatigue, relationship strains, heightened career responsibilities, and emotional solitude. However, this is also the exact phase that builds monumental inner strength. Projects launched with steady, honest dedication during this time often become enduring pillars of lifelong achievement.</p>

            <h4>Phase 3: The Setting Phase (2nd House Transit)</h4>
            <p>In the final phase, Saturn moves into the 2nd house from your Moon sign, which signifies wealth accumulation (<em>Dhana</em>), family heritage (<em>Kutumbha</em>), and spoken expression (<em>Vani</em>). While the peak emotional pressure lifts substantially, the focus shifts to practical fiscal recovery and domestic harmony. Watchful communication is vital, as sharp or impulsive words can create unnecessary friction with family members. By the conclusion of this phase, Saturn rewards the native with seasoned maturity, financial discipline, and hard-earned wisdom.</p>

            <h3>Shani Sade Sati vs. Shani Dhaiya (Kantaka & Ashtama Shani)</h3>
            <p>Many people confuse <strong>Sade Sati</strong> with <strong>Shani Dhaiya</strong> (also known as <em>Chhoti Panoti</em> or <em>Kantaka Shani</em>). Here is how classical Vedic astrology differentiates between them:</p>

            <div class="table-responsive">
                <table class="nnc-table">
                    <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Shani Sade Sati</th>
                            <th>Shani Dhaiya (Kantaka / Ashtama)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Total Duration</strong></td>
                            <td>Approx. 7.5 Years (Three 2.5-year phases)</td>
                            <td>Approx. 2.5 Years (Single 30-month transit)</td>
                        </tr>
                        <tr>
                            <td><strong>Houses Activated</strong></td>
                            <td>12th, 1st, and 2nd houses from natal Moon</td>
                            <td>4th house (Kantaka / Ardha-Ashtama) or 8th house (Ashtama Shani) from natal Moon</td>
                        </tr>
                        <tr>
                            <td><strong>Primary Sphere of Impact</strong></td>
                            <td>Overall life orientation, mental resilience, personal identity, and long-term destiny</td>
                            <td><strong>4th House:</strong> Domestic peace, mother's health, property matters.<br><strong>8th House:</strong> Sudden transformations, health vigilance, joint finances.</td>
                        </tr>
                        <tr>
                            <td><strong>Frequency in Lifetime</strong></td>
                            <td>2 to 3 times in an average human lifespan (roughly every 29.5 years)</td>
                            <td>Occurs twice in every 29.5-year cycle (at the 4th and 8th sign intervals)</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h3>Is Sade Sati Always Harmful? The Astrological Truth</h3>
            <p>One of the greatest misconceptions in popular astrology is that Shani Sade Sati guarantees misfortune, poverty, or devastation. Classical texts such as <em>Brihat Parashara Hora Shastra</em> and <em>Saravali</em> affirm that Saturn’s results depend entirely on its role and dignity in your specific birth chart (Kundli):</p>
            <ul class="nnc-list">
                <li><strong>Yogakaraka Status:</strong> For <strong>Taurus (Vrishabh)</strong> and <strong>Libra (Tula)</strong> ascendants, Saturn is a premier <em>Yogakaraka</em> planet, owning both an auspicious Kendra and Trikona house. During Sade Sati, these natives frequently experience major career promotions, political elevation, property purchases, and prestigious public accolades.</li>
                <li><strong>Own & Exalted Signs:</strong> When Saturn occupies or transits through Libra (its exaltation sign), Capricorn (Makar), or Aquarius (Kumbh - its Moolatrikona), its benevolence shines brightly, bestowing authority, structural longevity, and financial stability.</li>
                <li><strong>Ascendant Lord:</strong> For <strong>Capricorn</strong> and <strong>Aquarius</strong> ascendants, Saturn is the Lagna lord (guardian of the self) and inherently protects the native's vitality.</li>
                <li><strong>The Karmic Mirror:</strong> Saturn strictly reflects your deeds. Those who live ethically, respect elders and laborers, maintain integrity, and work diligently discover that Sade Sati elevates them to heights they never imagined possible.</li>
            </ul>

            <h3>Authentic Vedic Remedies for Shani Sade Sati</h3>
            <p>Vedic wisdom teaches that propitiating Saturn is not about superstitious fear, but conscious behavioral alignment and selfless service (<em>Nishkama Seva</em>):</p>

            <ul class="nnc-list">
                <li><strong>Devotion to Lord Hanuman:</strong> Recite the <em>Hanuman Chalisa</em> or <em>Sundarkand</em> regularly, especially on Tuesdays and Saturdays. In Hindu tradition, Lord Shani promised that sincere devotees of Lord Hanuman would be protected from harsh malefic afflictions.</li>
                <li><strong>Mantra Sadhana:</strong> Chant the Shani Beej Mantra 108 times on a Rudraksha rosary on Saturdays:
                    <br><strong style="display:inline-block; margin: 6px 0; color: #1e293b;">"ॐ प्रां प्रीं प्रौं सः शनैश्चराय नमः"</strong> (<em>Om Praam Preem Proum Sah Shanaishcharaya Namah</em>) or recite the ancient <em>Dasharatha Shani Stotram</em>.</li>
                <li><strong>Peepal Tree Offering:</strong> Light an earthen lamp (<em>Diya</em>) with pure mustard or sesame oil beneath a Peepal tree on Saturday evenings after sunset.</li>
                <li><strong>Daan (Charity) & Compassion:</strong> Donate black mustard oil, whole black urad dal, black sesame seeds, iron cooking pans, or dark woollen blankets to underprivileged individuals, sanitary workers, or physically disabled persons on Saturdays.</li>
                <li><strong>Respect for Laborers & Subordinates:</strong> Saturn represents the working class, laborers, domestic staff, and the elderly. Treating them with dignity, paying fair wages promptly, and never exploiting the helpless immediately pleases Shani Dev.</li>
                <li><strong>Feed Stray Animals:</strong> Feeding sweet chapatis with mustard oil to black stray dogs and offering grains to crows on Saturday mornings helps neutralize Saturn's harsh rays.</li>
                <li><strong>Avoid Rash Gemstones:</strong> Never wear a <strong>Blue Sapphire (Neelam)</strong> without comprehensive examination of your natal Lagna, house lordships, and planetary periods by an expert astrologer. An unsuitable sapphire can exacerbate tension.</li>
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
                    'What is Shani Sade Sati and how is it calculated?' => 'Shani Sade Sati is the 7.5-year transit of Saturn through the 12th, 1st, and 2nd signs from your natal Moon sign. Because Saturn takes approximately 2.5 years to transit a single zodiac sign, passing through these three consecutive signs takes around seven and a half years.',
                    'Is Sade Sati always a period of suffering and misfortune?' => 'No, absolutely not. Sade Sati acts as a mirror of your karma. For ascendants where Saturn is benefic or Yogakaraka (such as Taurus, Libra, Capricorn, and Aquarius), it frequently brings monumental promotions, business expansion, property purchases, and social prestige. It only exposes what was built on weak or dishonest foundations.',
                    'Which phase of Sade Sati is usually considered the most intense?' => 'The 2nd Phase (Peak Phase)—when Saturn transits directly over your natal Moon sign—is generally felt most acutely. Since the Moon governs emotional equilibrium and the subconscious mind, this phase brings deep psychological tests, heightened responsibilities, and significant lifestyle adjustments.',
                    'How many times does Sade Sati occur in a person\'s lifetime?' => 'Saturn takes approximately 29.5 years to complete one full revolution around the zodiac. Consequently, an individual typically encounters Sade Sati 2 to 3 times in a lifespan: once during childhood/youth (focusing on education and health), once in adulthood (career and family milestones), and once in elder years (spiritual maturity and detachment).',
                    'What is the difference between Sade Sati and Shani Dhaiya?' => 'Sade Sati lasts 7.5 years and occurs when Saturn transits the 12th, 1st, and 2nd houses from your Moon sign. Shani Dhaiya (small Panoti) lasts only 2.5 years and occurs when Saturn transits the 4th house (Kantaka Shani) or the 8th house (Ashtama Shani) from your Moon.',
                    'Can I get married, change jobs, or purchase property during Sade Sati?' => 'Yes. Millions of people get married, buy homes, and achieve massive career heights during Sade Sati. The key is avoiding reckless shortcuts, taking proper astrological counsel, and approaching all major life commitments with careful due diligence and ethical honesty.',
                    'Can I wear a Blue Sapphire (Neelam) to ward off Sade Sati?' => 'Blue Sapphire is an exceptionally fast-acting and potent gemstone that should NEVER be worn blindly without an in-depth chart consultation. If Saturn is a functional malefic in your chart, wearing Neelam can intensify struggles. Safer remedial alternatives include chanting mantras, practicing charity, and worshipping Lord Hanuman.',
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
    <script>
        // Birth-time unknown: switch the time boxes off
        (function () {
            const unknown = document.getElementById('ras-time-unknown');
            const selects = document.querySelectorAll('#ras-time-inputs select');
            const hint = document.getElementById('ras-time-hint');
            const sync = () => {
                selects.forEach(s => s.disabled = unknown.checked);
                hint.hidden = !unknown.checked;
            };
            unknown.addEventListener('change', sync);
            sync();
        })();

        // Birth place: suggest matching cities and remember the chosen one's coordinates and timezone
        (function () {
            const input = document.getElementById('ras-place');
            const list = document.getElementById('ras-place-list');
            const form = input.form;
            const fields = { lat: form.elements.lat, lng: form.elements.lng, tz: form.elements.tz };
            let timer = null;

            const close = () => { list.hidden = true; list.innerHTML = ''; };

            input.addEventListener('input', () => {
                fields.lat.value = fields.lng.value = fields.tz.value = '';
                clearTimeout(timer);
                const q = input.value.trim();
                if (q.length < 2) return close();

                timer = setTimeout(async () => {
                    try {
                        const res = await fetch(@json(route('place-search')) + '?q=' + encodeURIComponent(q));
                        const places = await res.json();
                        if (input.value.trim() !== q) return;

                        list.innerHTML = '';
                        places.forEach(place => {
                            const li = document.createElement('li');
                            li.textContent = place.label;
                            li.addEventListener('mousedown', (e) => {
                                e.preventDefault();
                                input.value = place.label;
                                fields.lat.value = place.lat;
                                fields.lng.value = place.lng;
                                fields.tz.value = place.tz;
                                close();
                            });
                            list.appendChild(li);
                        });
                        list.hidden = places.length === 0;
                    } catch (e) {
                        close();
                    }
                }, 300);
            });

            input.addEventListener('blur', () => setTimeout(close, 150));
        })();
    </script>
@endsection
