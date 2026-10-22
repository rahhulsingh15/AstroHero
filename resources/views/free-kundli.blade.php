@extends('frontend.layouts.master')
@section('title', 'Free Kundli Online by Date of Birth | Janam Kundli')
@section('content')

    <section class="ras-banner-section">
        <div class="container ras-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">FREE KUNDLI</span>
            </div>
            <h1>Free Kundli Online by Date of Birth</h1>
            <p class="ras-subtitle">Your Janam Kundli is the map of the sky at the moment you were born. It shows your lagna, rashi, nakshatra, the twelve houses and the place of every planet. Enter your birth details below to create your kundli.</p>
        </div>
    </section>

    <section class="km-form-section">
        <div class="container">
            <h2 class="km-heading">Create Your <span>Kundli</span></h2>
            <p class="km-sub">Enter your birth details. Accurate time and place give the sharpest reading.</p>
            @if (isset($errors) && $errors->any())
                <div class="alert alert-danger" style="background: rgba(220, 53, 69, 0.15); border: 1px solid #dc3545; color: #ff6b6b; padding: 12px 18px; border-radius: 8px; margin-bottom: 20px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="km-form" action="{{ route('free-kundli-report') }}" method="GET" autocomplete="off">
                <div class="km-grid">
                    <div class="km-person">
                        <div class="km-person-head">
                            <span class="km-badge">👤</span>
                            <h3>New Kundli</h3>
                        </div>
                        <div class="km-fields">
                            <div class="form-group">
                                <label for="km-name">Name *</label>
                                <input type="text" id="km-name" name="name" value="{{ old('name', request('name')) }}" placeholder="Enter full name, e.g. Rahul Sharma" maxlength="50" required>
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <input type="hidden" name="gender" id="km-gender-input" value="{{ old('gender', request('gender', 'male')) }}">
                                <div class="km-gender">
                                    <button type="button" class="{{ old('gender', request('gender', 'male')) === 'male' ? 'active' : '' }}" data-gender="male">Male</button>
                                    <button type="button" class="{{ old('gender', request('gender')) === 'female' ? 'active' : '' }}" data-gender="female">Female</button>
                                    <button type="button" class="{{ old('gender', request('gender')) === 'other' ? 'active' : '' }}" data-gender="other">Other</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="km-divider"></span>
                    <div class="km-person">
                        <div class="km-person-head">
                            <span class="km-badge">🗓️</span>
                            <h3>Birth Details</h3>
                        </div>
                        <div class="km-fields">
                            <div class="form-group">
                                <label>Birth Date *</label>
                                <div class="date-inputs">
                                    <select name="day" required aria-label="Day">
                                        <option value="">Day</option>
                                        @for ($i = 1; $i <= 31; $i++)
                                            <option value="{{ $i }}" @selected(old('day', request('day')) == $i)>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <select name="month" required aria-label="Month">
                                        <option value="">Month</option>
                                        @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $i => $monthName)
                                            <option value="{{ $i + 1 }}" @selected(old('month', request('month')) == $i + 1)>{{ $monthName }}</option>
                                        @endforeach
                                    </select>
                                    <select name="year" required aria-label="Year">
                                        <option value="">Year</option>
                                        @for ($i = date('Y'); $i >= 1900; $i--)
                                            <option value="{{ $i }}" @selected(old('year', request('year')) == $i)>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Birth Time <i class="km-optional">optional</i></label>
                                <div class="time-inputs" id="km-time-inputs">
                                    <select name="hour" aria-label="Hour">
                                        <option value="">Hour</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" @selected(old('hour', request('hour')) == $i)>{{ sprintf('%02d', $i) }}</option>
                                        @endfor
                                    </select>
                                    <select name="minute" aria-label="Minute">
                                        <option value="">Minute</option>
                                        @for ($i = 0; $i <= 59; $i++)
                                            <option value="{{ $i }}" @selected(old('minute', request('minute')) !== null && old('minute', request('minute')) == $i)>{{ sprintf('%02d', $i) }}</option>
                                        @endfor
                                    </select>
                                    <select name="ampm" aria-label="AM or PM">
                                        <option value="AM" @selected(old('ampm', request('ampm', 'AM')) === 'AM')>AM</option>
                                        <option value="PM" @selected(old('ampm', request('ampm')) === 'PM')>PM</option>
                                    </select>
                                </div>
                                <div style="margin-top: 8px;">
                                    <label style="font-size: 13px; font-weight: normal; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; color: var(--muted, #999);">
                                        <input type="checkbox" name="time_unknown" value="1" id="km-time-unknown" @checked(old('time_unknown', request('time_unknown')))>
                                        Don't know exact birth time (uses 12:00 PM)
                                    </label>
                                </div>
                            </div>
                            <div class="form-group" style="position: relative;">
                                <label for="km-place">Birth Place *</label>
                                <input type="text" id="km-place" name="place" value="{{ old('place', request('place')) }}" placeholder="Enter city, e.g. Jaipur, Rajasthan, India" maxlength="120" required autocomplete="off">
                                <input type="hidden" name="lat" id="km-lat" value="{{ old('lat', request('lat')) }}">
                                <input type="hidden" name="lng" id="km-lng" value="{{ old('lng', request('lng')) }}">
                                <input type="hidden" name="tz" id="km-tz" value="{{ old('tz', request('tz')) }}">
                                <ul class="ras-place-list" id="km-place-list" hidden style="position: absolute; top: 100%; left: 0; right: 0; background: #1c182d; border: 1px solid rgba(227, 181, 104, 0.3); border-radius: 8px; max-height: 220px; overflow-y: auto; list-style: none; padding: 0; margin: 4px 0 0; z-index: 9999; box-shadow: 0 8px 24px rgba(0,0,0,0.5);"></ul>
                                <small class="km-hint">Exact birth time fixes the Lagna and sharpens the reading.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="km-foot">
                    <p>Name, birth date and birth place are needed to make a kundli.</p>
                    <button type="submit" class="km-submit">Generate Kundli</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Main Content & Sidebar -->
    <section class="km-main-section">
        <div class="container">
            <div class="km-split">
                <!-- Left Content -->
                <div class="km-left nnc-content-wrapper">
                    <h3>What Is a Janam Kundli?</h3>
                    <p>The term <strong>Kundli</strong> originates from the Sanskrit word <em>"Kundali"</em>, meaning coiled, spiral, or circular. In Vedic astrology (Jyotish Shastra), a Janam Kundli (also known as a birth chart, natal chart, or Janam Patri) represents an exact cosmic snapshot of the celestial heavens at the precise minute and coordinate of your birth. It maps where the Sun, Moon, the seven planets (Grahas), the two karmic lunar nodes (Rahu and Ketu), and the twelve zodiac constellations (Rashis) were positioned in relation to the local eastern horizon.</p>
                    <p>Because the earth rotates on its axis continuously, the rising sign (Lagna) changes approximately every two hours, and the planetary degrees advance constantly. This astronomical reality explains why two individuals born on the very same calendar day possess entirely distinct horoscopes, psychological constitutions, life paths, and destiny timelines. A Janam Kundli serves as your personal energetic roadmap, illustrating your innate soul purpose, karmic lessons, vocational strengths, domestic life, and spiritual potential.</p>

                    <h3>The Three Cosmic Pillars: Lagna, Moon Sign &amp; Sun Sign</h3>
                    <p>When analyzing any Vedic horoscope, three primary coordinates establish the blueprint of your existence:</p>
                    <ul class="nnc-list">
                        <li><strong>Lagna (Ascendant / 1st House):</strong> The zodiac sign that was ascending on the eastern horizon at the moment you took your first breath. Your Lagna defines your physical constitution, vitality, natural temperament, outer persona, and the foundational framework of your entire chart. The planet ruling your Lagna becomes your <em>Lagnesh</em> (chart lord), serving as your primary life protector.</li>
                        <li><strong>Chandra Rashi (Moon Sign):</strong> The zodiac constellation the Moon was traversing at your birth. In Vedic astrology, the Moon governs the conscious and subconscious mind (Manas), emotional inclinations, instincts, inner peace, and maternal connections. Horoscopic predictions and the 120-year Vimshottari Dasha cycles are calculated directly from your natal Moon degree.</li>
                        <li><strong>Surya Rashi (Sun Sign):</strong> The sign occupied by the Sun at birth. The Sun signifies the immortal soul (Atman), life force, willpower, father figure, relationship with authority, ego, and professional self-expression.</li>
                    </ul>

                    <h3>The 12 Vedic Houses (Bhavas) and Their Life Spheres</h3>
                    <p>A Vedic birth chart is divided into twelve houses (Bhavas), each governing a 30-degree segment of life experience. The placements of planets within these houses and their mutual aspects (Drishti) reveal your karmic trajectory:</p>
                    
                    <div class="table-responsive">
                        <table class="nnc-table">
                            <thead>
                                <tr>
                                    <th>House</th>
                                    <th>Sanskrit Name</th>
                                    <th>Core Life Spheres Governed</th>
                                    <th>Natural Karaka</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>1st House</strong></td>
                                    <td>Tanu Bhava (Ascendant)</td>
                                    <td>Self, physical body, complexion, vitality, mindset, life path</td>
                                    <td>Sun</td>
                                </tr>
                                <tr>
                                    <td><strong>2nd House</strong></td>
                                    <td>Dhana Bhava</td>
                                    <td>Wealth accumulation, liquid savings, family values, speech, food habits</td>
                                    <td>Jupiter</td>
                                </tr>
                                <tr>
                                    <td><strong>3rd House</strong></td>
                                    <td>Sahaja Bhava</td>
                                    <td>Younger siblings, courage, mental valor, short travels, communication, arms/hands</td>
                                    <td>Mars</td>
                                </tr>
                                <tr>
                                    <td><strong>4th House</strong></td>
                                    <td>Sukha / Bandhu Bhava</td>
                                    <td>Mother, domestic happiness, ancestral lands, real estate, vehicles, peace of heart</td>
                                    <td>Moon, Venus</td>
                                </tr>
                                <tr>
                                    <td><strong>5th House</strong></td>
                                    <td>Putra / Purva Punya</td>
                                    <td>Children, intellect, higher learning, romance, creative arts, past-life karma (Punya)</td>
                                    <td>Jupiter</td>
                                </tr>
                                <tr>
                                    <td><strong>6th House</strong></td>
                                    <td>Ari / Shatru Bhava</td>
                                    <td>Health ailments, debts, litigations, daily routine, competitors, service</td>
                                    <td>Mars, Saturn</td>
                                </tr>
                                <tr>
                                    <td><strong>7th House</strong></td>
                                    <td>Yuvati / Kalatra Bhava</td>
                                    <td>Marriage, spouse, legal partnerships, commercial contracts, public relations</td>
                                    <td>Venus</td>
                                </tr>
                                <tr>
                                    <td><strong>8th House</strong></td>
                                    <td>Randhra / Ayur Bhava</td>
                                    <td>Longevity, sudden transformations, occult sciences, inheritance, marital stability</td>
                                    <td>Saturn</td>
                                </tr>
                                <tr>
                                    <td><strong>9th House</strong></td>
                                    <td>Dharma / Bhagya Bhava</td>
                                    <td>Good fortune (Luck), father figure, spiritual guru, pilgrimages, higher ethics</td>
                                    <td>Jupiter, Sun</td>
                                </tr>
                                <tr>
                                    <td><strong>10th House</strong></td>
                                    <td>Karma Bhava</td>
                                    <td>Career, profession, social status, fame, governmental leadership, life purpose</td>
                                    <td>Sun, Saturn, Mercury</td>
                                </tr>
                                <tr>
                                    <td><strong>11th House</strong></td>
                                    <td>Labha Bhava</td>
                                    <td>Incomes, profits, fulfilling ambitions, elder siblings, social networks, allies</td>
                                    <td>Jupiter</td>
                                </tr>
                                <tr>
                                    <td><strong>12th House</strong></td>
                                    <td>Vyaya Bhava</td>
                                    <td>Expenditures, foreign residence, hospitalizations, isolation, spiritual liberation (Moksha)</td>
                                    <td>Saturn, Ketu</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>Functional Classification of Houses</h3>
                    <p>In Vedic astrology, the 12 houses are grouped into distinct functional categories that describe how energy flows in your life:</p>
                    <ul class="nnc-list">
                        <li><strong>Kendra Houses (1st, 4th, 7th, 10th):</strong> Known as the Vishnu Sthanas, the Kendras are the four central pillars of life representing action, security, partnership, and vocation. Strong planets in Kendra bestow stability, leadership, and public success.</li>
                        <li><strong>Trikona Houses (1st, 5th, 9th):</strong> Known as the Lakshmi Sthanas, the Trikonas are the holy trine of luck, merit, divine grace, and dharma. They are universally auspicious; their lords always produce positive results.</li>
                        <li><strong>Upachaya Houses (3rd, 6th, 10th, 11th):</strong> Houses of continuous improvement. Planets placed here struggle initially but yield exponential growth and success over time through personal effort.</li>
                        <li><strong>Dusthana Houses (6th, 8th, 12th):</strong> The trik houses representing disease, debt, sudden transformations, loss, and spiritual detachment. While challenging for worldly affairs, they foster profound resilience and occult mastery.</li>
                        <li><strong>Maraka Houses (2nd &amp; 7th):</strong> Houses that represent the completion of cycles and physical departure when activated by difficult dasha periods.</li>
                    </ul>

                    <h3>The Navagrahas: 9 Celestial Cosmic Forces</h3>
                    <p>Planets in Vedic astrology are known as <em>Grahas</em> ("that which grasps"). They act as cosmic administrators distributing karmic fruits. Here is the breakdown of the Navagrahas:</p>
                    <div class="table-responsive">
                        <table class="nnc-table">
                            <thead>
                                <tr>
                                    <th>Graha</th>
                                    <th>Natural Nature</th>
                                    <th>Own Signs</th>
                                    <th>Exaltation</th>
                                    <th>Core Significations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Sun (Surya)</strong></td>
                                    <td>Mild Malefic (Krura)</td>
                                    <td>Leo</td>
                                    <td>Aries (10°)</td>
                                    <td>Soul, authority, father, government, vitality, willpower</td>
                                </tr>
                                <tr>
                                    <td><strong>Moon (Chandra)</strong></td>
                                    <td>Benefic (when waxing)</td>
                                    <td>Cancer</td>
                                    <td>Taurus (3°)</td>
                                    <td>Mind, mother, emotions, liquids, fertility, mental calm</td>
                                </tr>
                                <tr>
                                    <td><strong>Mars (Mangal)</strong></td>
                                    <td>Natural Malefic</td>
                                    <td>Aries, Scorpio</td>
                                    <td>Capricorn (28°)</td>
                                    <td>Courage, property, engineering, blood, younger siblings</td>
                                </tr>
                                <tr>
                                    <td><strong>Mercury (Budh)</strong></td>
                                    <td>Benefic (adaptable)</td>
                                    <td>Gemini, Virgo</td>
                                    <td>Virgo (15°)</td>
                                    <td>Intellect, business, speech, writing, analytical logic</td>
                                </tr>
                                <tr>
                                    <td><strong>Jupiter (Guru)</strong></td>
                                    <td>Supreme Benefic</td>
                                    <td>Sagittarius, Pisces</td>
                                    <td>Cancer (5°)</td>
                                    <td>Wisdom, dharma, wealth, progeny, guru, divine blessing</td>
                                </tr>
                                <tr>
                                    <td><strong>Venus (Shukra)</strong></td>
                                    <td>Natural Benefic</td>
                                    <td>Taurus, Libra</td>
                                    <td>Pisces (27°)</td>
                                    <td>Love, marriage, luxury, fine arts, romance, vehicles</td>
                                </tr>
                                <tr>
                                    <td><strong>Saturn (Shani)</strong></td>
                                    <td>Natural Malefic</td>
                                    <td>Capricorn, Aquarius</td>
                                    <td>Libra (20°)</td>
                                    <td>Karma, discipline, delay, hard labor, longevity, justice</td>
                                </tr>
                                <tr>
                                    <td><strong>Rahu (North Node)</strong></td>
                                    <td>Shadow Planet</td>
                                    <td>Co-rules Aquarius</td>
                                    <td>Taurus / Gemini</td>
                                    <td>Ambition, worldly desires, foreign connections, innovation</td>
                                </tr>
                                <tr>
                                    <td><strong>Ketu (South Node)</strong></td>
                                    <td>Shadow Planet</td>
                                    <td>Co-rules Scorpio</td>
                                    <td>Scorpio / Sagittarius</td>
                                    <td>Spirituality, Moksha, detachment, occult, past-life skills</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>Major Yogas in Vedic Astrology</h3>
                    <p>Yogas are special planetary combinations formed when planets sit in specific relationships, magnifying blessings or creating challenges:</p>
                    <ul class="nnc-list">
                        <li><strong>Raj Yoga:</strong> Formed when the lord of a Kendra (1, 4, 7, 10) joins or aspects the lord of a Trikona (1, 5, 9). It grants leadership, social respect, authority, and prosperity.</li>
                        <li><strong>Gajakesari Yoga:</strong> Formed when Jupiter is positioned in a Kendra (1st, 4th, 7th, or 10th) from the natal Moon. It bestows towering intellect, royal favor, moral integrity, and everlasting fame.</li>
                        <li><strong>Budhaditya Yoga:</strong> Created by the close conjunction of the Sun and Mercury. It confers extraordinary intellect, sharp eloquence, computational brilliance, and administrative acclaim.</li>
                        <li><strong>Pancha Mahapurusha Yogas:</strong> Five royal yogas formed when non-luminaries (Mars, Mercury, Jupiter, Venus, Saturn) occupy own or exaltation signs in a Kendra: Ruchaka, Bhadra, Hamsa, Malavya, and Sasa.</li>
                        <li><strong>Dhana Yogas:</strong> Connections between the lords of wealth (2nd), gains (11th), intelligence (5th), and fortune (9th), ensuring abundance and financial security.</li>
                    </ul>

                    <h3>Challenging Doshas &amp; Vedic Remedial Measures</h3>
                    <p>While positive yogas uplift a chart, certain planetary afflictions (Doshas) demand attention and remedial balance:</p>
                    <ul class="nnc-list">
                        <li><strong>Manglik Dosha (Kuja Dosha):</strong> Occurs when Mars resides in the 1st, 2nd, 4th, 7th, 8th, or 12th house from the Lagna, Moon, or Venus. It causes temperamental friction or delays in marriage. It can be harmonized through matching with a fellow Manglik, Kumbh Vivah, or chanting the Mangal Beej Mantra.</li>
                        <li><strong>Kaal Sarp Dosha:</strong> Occurs when all seven celestial bodies are hemmed between the Rahu-Ketu axis. Depending on which houses are occupied, 12 specific forms exist (such as Anant, Kulik, Vasuki, Shankhpal). Remedies include Maha Mrityunjaya Japa, Rudrabhisheka, and Rahu-Ketu Shanti.</li>
                        <li><strong>Shani Sade Sati:</strong> A 7.5-year transit of Saturn moving across the 12th, 1st, and 2nd houses from your natal Moon sign. Divided into Rising, Peak, and Setting phases, it teaches profound discipline and humility. Remedies include reciting the Hanuman Chalisa, lighting mustard oil lamps on Saturdays, and serving the needy.</li>
                        <li><strong>Pitra Dosha:</strong> Karmic ancestral debt identified when the Sun or 9th house is afflicted by Rahu or Saturn. It is pacified through annual Shraddha ceremonies, Gayatri Mantra chanting, and feeding cows and birds.</li>
                    </ul>

                    <h3>The Vimshottari Dasha: The Cosmic Clock of Karma</h3>
                    <p>A static birth chart only shows what is promised; the <strong>Vimshottari Dasha system</strong> determines <em>when</em> those promises manifest in physical reality. Spanning 120 solar years across the nine planets (Ketu 7y, Venus 20y, Sun 6y, Moon 10y, Mars 7y, Rahu 18y, Jupiter 16y, Saturn 19y, Mercury 17y), each dasha period activates the specific houses and planets ruled by the active dasha lord. By examining your active Mahadasha, Antardasha, and Pratyantardasha alongside current planetary transits (Gochara), an astrologer pinpoints exact time windows for marriage, job promotions, relocation, and investments.</p>

                    <h3>North Indian vs South Indian Kundli Styles</h3>
                    <p>While the mathematical calculations and planetary placements are 100% identical, Vedic astrologers illustrate horoscopes using two primary cartographic layouts:</p>
                    <div class="table-responsive">
                        <table class="nnc-table">
                            <thead>
                                <tr>
                                    <th>Feature</th>
                                    <th>North Indian Kundli (Diamond)</th>
                                    <th>South Indian Kundli (Square Grid)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Visual Format</strong></td>
                                    <td>Diamond and triangle compartments</td>
                                    <td>12-box square grid surrounding an open center</td>
                                </tr>
                                <tr>
                                    <td><strong>Fixed Component</strong></td>
                                    <td>The houses are fixed (1st house is always top center)</td>
                                    <td>The signs are fixed (Aries is always 2nd box on top row)</td>
                                </tr>
                                <tr>
                                    <td><strong>Ascendant Notation</strong></td>
                                    <td>Rashi numbers (1 to 12) written inside houses; Lagna is top diamond</td>
                                    <td>Ascendant marked with two diagonal lines or "ASC" in sign box</td>
                                </tr>
                                <tr>
                                    <td><strong>Reading Direction</strong></td>
                                    <td>Anti-clockwise progression of houses</td>
                                    <td>Clockwise progression of zodiac signs</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>Kundli Matching (Gun Milan) for Marriage Compatibility</h3>
                    <p>In Vedic tradition, prospective partners evaluate marriage compatibility through <strong>Ashtakoot Milan</strong>, assessing 36 total Guna points across eight psychological and spiritual dimensions:</p>
                    <ul class="nnc-list">
                        <li><strong>Varna (1 Point):</strong> Spiritual alignment and mutual ego compatibility.</li>
                        <li><strong>Vashya (2 Points):</strong> Mutual attraction and behavioral harmony.</li>
                        <li><strong>Tara (3 Points):</strong> Health, longevity, and destiny fortune of the couple.</li>
                        <li><strong>Yoni (4 Points):</strong> Physical, sexual, and instinctual compatibility.</li>
                        <li><strong>Graha Maitri (5 Points):</strong> Psychological connection and intellectual friendship.</li>
                        <li><strong>Gana (6 Points):</strong> Temperament and life values (Deva, Manushya, Rakshasa).</li>
                        <li><strong>Bhakoot (7 Points):</strong> Emotional bonding, prosperity, and family happiness.</li>
                        <li><strong>Nadi (8 Points):</strong> Physiological compatibility, genetic health, and progeny (most heavily weighted).</li>
                    </ul>
                    <p>A score of 18 or above out of 36 points indicates an auspicious foundation for marital harmony, especially when supported by balanced Manglik dosha and compatible 7th house lords.</p>

                    <h3>Why Create Your Janam Kundli on AstroHero?</h3>
                    <p>AstroHero combines ancient Vedic astrological principles with modern NASA-grade ephemeris computational engines:</p>
                    <ul class="nnc-list">
                        <li><strong>High-Precision Astronomical Coordinates:</strong> Accurate planetary longitudes, retrogrades, and combustions calculated using Swiss Ephemeris data and the authoritative Chitrapaksha Lahiri Ayanamsha.</li>
                        <li><strong>Complete 16 Divisional Charts (Shodashvarga):</strong> Includes Lagna (D-1), Navamsha (D-9), Dasamsa (D-10 for career), Saptamsa (D-7), and charts up to Shashtiamsa (D-60).</li>
                        <li><strong>Comprehensive KP System &amp; Ashtakvarga:</strong> Full Krishnamurti Paddhati cuspal sub-lords, ruling planets, and complete 337 Sarvashtakavarga point grids.</li>
                        <li><strong>Free 56-Page Downloadable PDF Report:</strong> Instant, print-ready, multi-colored PDF report complete with Vimshottari timelines, gemstone recommendations with beeja mantras, and tailored Vedic remedies.</li>
                    </ul>
                </div>

                <!-- Right Sidebar -->
                <div class="km-right">
                    <div class="sidebar-widget">
                        <div class="widget-header">
                            <h4>Talk to Horoscope Experts</h4>
                            <p>Connect live with verified Vedic astrologers for personal guidance</p>
                        </div>
                        <div class="expert-list">
                            <!-- Expert 1 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg1.webp') }}" alt="Prachesta" class="exp-img">
                                <div class="expert-info">
                                    <h5>Prachesta</h5>
                                    <p>Vedic Astrology, Numerology</p>
                                    <span class="rate">₹ 40/min</span>
                                </div>
                                <button class="btn-view">Consult</button>
                            </div>
                            <!-- Expert 2 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg3.webp') }}" alt="Nevibala" class="exp-img">
                                <div class="expert-info">
                                    <h5>Nevibala</h5>
                                    <p>Vedic, Tarot, KP System</p>
                                    <span class="rate">₹ 29/min</span>
                                </div>
                                <button class="btn-view">Consult</button>
                            </div>
                            <!-- Expert 3 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg1.webp') }}" alt="Swarna" class="exp-img">
                                <div class="expert-info">
                                    <h5>Swarna</h5>
                                    <p>Vedic, Marriage Specialist</p>
                                    <span class="rate">₹ 69/min</span>
                                </div>
                                <button class="btn-view">Consult</button>
                            </div>
                            <!-- Expert 4 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg2.webp') }}" alt="Supransh" class="exp-img">
                                <div class="expert-info">
                                    <h5>Supransh</h5>
                                    <p>Vedic, Career Astrologer</p>
                                    <span class="rate">₹ 20/min</span>
                                </div>
                                <button class="btn-view">Consult</button>
                            </div>
                            <!-- Expert 5 -->
                            <div class="expert-item">
                                <img src="{{ asset('assets/images/chatimg3.webp') }}" alt="Aarav" class="exp-img">
                                <div class="expert-info">
                                    <h5>Aarav</h5>
                                    <p>Vedic, Vastu &amp; Dosha Shanti</p>
                                    <span class="rate">₹ 35/min</span>
                                </div>
                                <button class="btn-view">Consult</button>
                            </div>
                        </div>
                        <a href="{{ route('chat-with-astrologers') }}" class="btn-view-all" style="display: block; text-align: center; text-decoration: none;">View All Astrologers</a>
                    </div>

                    <!-- Quick Guide Highlights Widget -->
                    <div class="sidebar-widget" style="margin-top: 24px;">
                        <div class="widget-header">
                            <h4>Kundli Reading Guides</h4>
                            <p>Master how to interpret your own horoscope step-by-step</p>
                        </div>
                        <ul class="nnc-list" style="margin: 0; padding: 0;">
                            <li style="margin-bottom: 14px;">
                                <a href="{{ route('guide.read-kundli') }}" style="color: var(--gold, #e3b568); text-decoration: none; font-weight: 600;">How to Read Kundli Online →</a>
                                <div style="font-size: 12px; color: var(--muted); margin-top: 3px;">Learn how to decode lagna, dasha, and house lords.</div>
                            </li>
                            <li style="margin-bottom: 14px;">
                                <a href="{{ route('guide.read-houses') }}" style="color: var(--gold, #e3b568); text-decoration: none; font-weight: 600;">How to Read Houses in Kundli →</a>
                                <div style="font-size: 12px; color: var(--muted); margin-top: 3px;">Full breakdown of the 12 Bhavas and their life results.</div>
                            </li>
                            <li style="margin-bottom: 14px;">
                                <a href="{{ route('guide.read-planets') }}" style="color: var(--gold, #e3b568); text-decoration: none; font-weight: 600;">How to Read Planets in Astrology →</a>
                                <div style="font-size: 12px; color: var(--muted); margin-top: 3px;">Exaltation, debilitation, and planetary aspects explained.</div>
                            </li>
                            <li style="margin-bottom: 14px;">
                                <a href="{{ route('guide.planets-signs-houses') }}" style="color: var(--gold, #e3b568); text-decoration: none; font-weight: 600;">Planets, Signs &amp; Houses in Astrology →</a>
                                <div style="font-size: 12px; color: var(--muted); margin-top: 3px;">The holy trinity of graha, rashi, and bhava synthesis.</div>
                            </li>
                            <li>
                                <a href="{{ route('guide.planets-signs-significance') }}" style="color: var(--gold, #e3b568); text-decoration: none; font-weight: 600;">Planets, Signs and Their Significance →</a>
                                <div style="font-size: 12px; color: var(--muted); margin-top: 3px;">Deep dive into the 12 signs and planetary archetypes.</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Master Vedic Astrology Guides (5 Guides Section Placed Above Calculators) -->
    <section class="km-guides-section">
        <div class="container">
            <h2 class="km-heading">Master <span>Vedic Astrology Guides</span></h2>
            <p class="km-sub" style="margin-bottom: 22px;">Explore our comprehensive 5-part master guides to decode your Janam Kundli, houses, planets, signs, and planetary significance like an expert Vedic astrologer.</p>
            <div class="fk-tags-wrap">
                <a href="{{ route('guide.read-kundli') }}" class="fk-tag-pill">
                    <span>📖</span> How to Read Kundli Online <span class="fk-pill-arrow">→</span>
                </a>
                <a href="{{ route('guide.read-houses') }}" class="fk-tag-pill">
                    <span>🏛️</span> How to Read Houses in Kundli <span class="fk-pill-arrow">→</span>
                </a>
                <a href="{{ route('guide.read-planets') }}" class="fk-tag-pill">
                    <span>🪐</span> How to Read Planets in Astrology <span class="fk-pill-arrow">→</span>
                </a>
                <a href="{{ route('guide.planets-signs-houses') }}" class="fk-tag-pill">
                    <span>♈</span> Planets, Signs &amp; Houses in Astrology <span class="fk-pill-arrow">→</span>
                </a>
                <a href="{{ route('guide.planets-signs-significance') }}" class="fk-tag-pill">
                    <span>✨</span> Planets, Signs and Their Significance <span class="fk-pill-arrow">→</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Cross-Linking Directory: Free Astrology Tools & Calculators -->
    <section class="km-tools-section" style="padding-top: 20px;">
        <div class="container">
            <h2 class="km-heading">Explore Our <span>Free Astrology Tools &amp; Calculators</span></h2>
            <p class="km-sub" style="margin-bottom: 24px;">Calculate your horoscope, check compatibility, uncover doshas, and discover auspicious muhurats with our 100% free Vedic calculators.</p>
            
            <!-- Category 1: Free Services & Compatibility -->
            <div style="margin-bottom: 24px;">
                <h4 style="font-size: 14px; letter-spacing: 0.08em; color: var(--gold, #e3b568); text-transform: uppercase; margin-bottom: 12px; font-weight: 700;">🌟 Free Astrology Services</h4>
                <div class="km-tools">
                    <a href="{{ route('free-kundli') }}"><span>📜</span> Free Janam Kundli</a>
                    <a href="{{ route('kundli-matching') }}"><span>💞</span> Kundli Matching (Gun Milan)</a>
                    <a href="{{ route('compatibility') }}"><span>♊</span> Zodiac Compatibility</a>
                    <a href="{{ route('tarot') }}"><span>🔮</span> Free Tarot Card Reading</a>
                </div>
            </div>

            <!-- Category 2: Planetary & Chart Calculators -->
            <div style="margin-bottom: 24px;">
                <h4 style="font-size: 14px; letter-spacing: 0.08em; color: var(--gold, #e3b568); text-transform: uppercase; margin-bottom: 12px; font-weight: 700;">🪐 Planetary &amp; Natal Chart Calculators</h4>
                <div class="km-tools">
                    <a href="{{ route('birth-chart-calculator') }}"><span>🗺️</span> Natal Chart Calculator</a>
                    <a href="{{ route('rising-ascendant-sign-calculator') }}"><span>🌅</span> Rising Sign Calculator</a>
                    <a href="{{ route('sun-sign-calculator') }}"><span>☀️</span> Sun Sign Calculator</a>
                    <a href="{{ route('rashi-calculator') }}"><span>🌙</span> Moon Sign (Rashi) Calculator</a>
                    <a href="{{ route('nakshatra-calculator') }}"><span>✨</span> Nakshatra Calculator</a>
                    <a href="{{ route('dasha-calculator') }}"><span>⏳</span> Vimshottari Dasha Calculator</a>
                    <a href="{{ route('atmakaraka-darakaraka-calculator') }}"><span>👑</span> Atmakaraka &amp; Darakaraka</a>
                    <a href="{{ route('moon-phase-calculator') }}"><span>🌗</span> Moon Phase Calculator</a>
                </div>
            </div>

            <!-- Category 3: Dosha & Transit Calculators -->
            <div style="margin-bottom: 24px;">
                <h4 style="font-size: 14px; letter-spacing: 0.08em; color: var(--gold, #e3b568); text-transform: uppercase; margin-bottom: 12px; font-weight: 700;">🔥 Dosha &amp; Shanti Calculators</h4>
                <div class="km-tools">
                    <a href="{{ route('mangal-dosha-calculator') }}"><span>🔴</span> Mangal Dosha Calculator</a>
                    <a href="{{ route('shani-sade-sati-calculator') }}"><span>🪐</span> Shani Sade Sati Calculator</a>
                    <a href="{{ route('kaal-sarp-dosh-calculator') }}"><span>🐍</span> Kaal Sarp Dosh Calculator</a>
                    <a href="{{ route('ishta-devata-calculator') }}"><span>🙏</span> Ishta Devata Calculator</a>
                </div>
            </div>

            <!-- Category 4: Numerology & Love Calculators -->
            <div>
                <h4 style="font-size: 14px; letter-spacing: 0.08em; color: var(--gold, #e3b568); text-transform: uppercase; margin-bottom: 12px; font-weight: 700;">🔢 Numerology &amp; Love Compatibility</h4>
                <div class="km-tools">
                    <a href="{{ route('love-calculator') }}"><span>❤️</span> Love Calculator</a>
                    <a href="{{ route('numerology-calculator') }}"><span>🔢</span> Numerology Calculator</a>
                    <a href="{{ route('name-compatibility-calculator') }}"><span>💑</span> Name Compatibility</a>
                    <a href="{{ route('destiny-number-calculator') }}"><span>🎯</span> Destiny Number Calculator</a>
                    <a href="{{ route('lo-shu-grid-calculator') }}"><span>🟩</span> Lo Shu Grid Calculator</a>
                    <a href="{{ route('mulank-calculator') }}"><span>📅</span> Mulank Calculator</a>
                    <a href="{{ route('flames-calculator') }}"><span>🔥</span> FLAMES Calculator</a>
                    <a href="{{ route('friendship-calculator') }}"><span>🤝</span> Friendship Calculator</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Comprehensive Astrotalk-grade FAQ Accordion -->
    <section class="acording_section">
        <div class="acord-container">
            <!-- Left Side: Title -->
            <div class="acord-left">
                <span class="acord-subtitle">FREQUENTLY ASKED QUESTIONS</span>
                <h2 class="acord-title">Got questions about <span class="highlight">Kundli</span>?<br>Find expert answers here.</h2>
                <p style="font-size: 14px; color: var(--muted); margin-top: 14px; line-height: 1.6;">Everything you need to know about generating, reading, and understanding your Vedic horoscope online.</p>
                <div style="margin-top: 24px;">
                    <a href="{{ route('chat-with-astrologers') }}" class="km-submit" style="display: inline-block; padding: 10px 22px; font-size: 13.5px; text-decoration: none;">Ask an Astrologer Live</a>
                </div>
            </div>

            <!-- Right Side: Accordion List -->
            <div class="acord-right">
                @foreach ([
                    'How to Make a Kundali Online?' => 'You can generate a free kundali online by inserting your accurate birth details (Full Name, Date of Birth, Time of Birth, and Place of Birth) into AstroHero’s Kundli Calculator. Our high-precision astronomical engine instantly maps the planetary degrees and calculates your complete Janam Kundli with Lagna, Rashi, Nakshatra, and Navamsha charts in seconds.',
                    'How to Generate a Janam Kundli by Date of Birth and Time Without Name?' => 'Your birth name is not needed for the astronomical calculations of a Kundli. The planetary placements and house cusps depend solely on your date of birth, exact time of birth, and birth coordinates (latitude and longitude). You can enter any name or pseudonym and still receive a 100% accurate horoscope.',
                    'How to Make a Kundali Chart?' => 'A Kundli chart is created by calculating the rising zodiac sign (Ascendant / Lagna) at your specific geographic location and time of birth, which fixes the 1st House. The remaining 11 houses follow sequentially in anti-clockwise order (in North Indian style) or clockwise order (in South Indian style). The planetary positions of Sun, Moon, Mars, Mercury, Jupiter, Venus, Saturn, Rahu, and Ketu are then placed into their respective signs and houses based on the Chitrapaksha Lahiri Ayanamsha.',
                    'How Can I Read My Own Kundli?' => 'To read your own Kundli, begin with the three primary pillars: (1) Identify your 1st House (Lagna) and its ruling planet to understand your nature and vitality; (2) Locate your Moon sign (Chandra Rashi) to understand your emotions and current Vimshottari Mahadasha; (3) Check the 10th House (Karma Bhava) for career tendencies, and the 7th House for relationships. For in-depth step-by-step guidance, explore our guide on How to Read Kundli Online.',
                    'What happens if I don\'t know my exact birth time for Kundli?' => 'If you do not know your exact birth time, you can check the "Don\'t know exact birth time" option on AstroHero, which generates a noon horoscope (12:00 PM). While planetary signs (such as your Sun sign and slow-moving planets) remain mostly reliable, the Ascendant (Lagna) changes sign every two hours and house placements cannot be finalized. For life-defining predictions, an experienced Vedic astrologer can perform "Birth Time Rectification" (Nashta Jataka) by matching key past life milestones with planetary dasha cycles.',
                    'What are the different types of Kundli?' => 'In Vedic astrology, there are three primary foundational charts: (1) Lagna Kundli (Ascendant Chart), representing your physical body, life path, and outer reality; (2) Chandra Kundli (Moon Chart), representing mental perception, emotional response, and inner experiences; and (3) Surya Kundli (Sun Chart), depicting soul vitality and public authority. Furthermore, classical Jyotish utilizes 16 Divisional Charts (Shodashvarga), such as Navamsha (D-9) for marital destiny and Dasamsa (D-10) for career.',
                    'Can I see a sample Kundli PDF before entering my birth details?' => 'Yes! AstroHero allows you to explore sample Kundli reports and preview the complete 56-page printable PDF format. The sample illustrates the full spectrum of data included—from birth panchang and avakhada chakra to 16 divisional charts, KP cusps, 337-point Ashtakvarga, Vimshottari dasha tables, and gemstone remedies.',
                    'How does AstroHero calculate and verify the accuracy of Kundli?' => 'AstroHero ensures supreme accuracy by utilizing Swiss Ephemeris astronomical algorithms verified against NASA JPL planetary ephemeris tables. We apply the Chitrapaksha (Lahiri) Ayanamsha, exact topocentric latitude and longitude coordinates, and precise time-zone corrections to ensure that planetary longitudes, retrogrades, and combustions are accurate to fractions of an arc-second.',
                    'Is it safe to enter my birth details online?' => 'Yes, it is 100% safe to enter your birth details on AstroHero. All transmissions are protected with end-to-end SSL/TLS encryption. Your birth coordinates and personal data are strictly private, never sold or shared with any third-party advertisers.',
                    'Can I edit my birth details after generating my Kundli?' => 'Yes, absolutely. Once your Kundli report is generated, you will find an "Edit Details" or "New Kundli" button on the dashboard header. You can modify your birth time, date, or city at any time and regenerate an updated horoscope instantly.',
                    'What is the difference between Lagna Chart and Navamsha Chart?' => 'The Lagna Chart (D-1) is the primary physical birth chart representing your outer circumstances, physical health, and the seeds of karma you are born with. The Navamsha Chart (D-9) is the 9th harmonic divisional chart representing how those karmic seeds bear fruit in the second half of life (especially after age 28 to 32), your marital compatibility, spouse\'s nature, and your inner spiritual dharma. A planet that is debilitated in D-1 but exalted in D-9 (Neecha Bhanga) ultimately grants spectacular success.',
                    'Which house in Kundli denotes career, status and government job?' => 'The 10th House (Karma Bhava) is the premier house of career, profession, reputation, and public authority. Additionally, the 6th House represents competitive exams and employment, while the 2nd and 11th houses govern income and business gains. For government jobs (Sarkari Naukri), a strong Sun (signifier of government), Mars (administrative authority), or Jupiter favorably connected to the 10th or 1st house is crucial.'
                ] as $question => $answer)
                    <div class="acord-item">
                        <button class="acord-btn" type="button">
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
                    document.querySelectorAll('.acord-item').forEach(otherItem => {
                        otherItem.classList.remove('active');
                    });
                    if (!isActive) {
                        item.classList.add('active');
                    }
                });
            });

            // Gender button toggles
            const genderButtons = document.querySelectorAll('.km-gender button');
            const genderInput = document.getElementById('km-gender-input');
            genderButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    genderButtons.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    genderInput.value = btn.dataset.gender;
                });
            });

            // Time unknown checkbox toggle
            const timeUnknown = document.getElementById('km-time-unknown');
            const timeInputs = document.getElementById('km-time-inputs');
            if (timeUnknown && timeInputs) {
                const syncTime = () => {
                    const selects = timeInputs.querySelectorAll('select');
                    selects.forEach(s => {
                        s.disabled = timeUnknown.checked;
                        s.style.opacity = timeUnknown.checked ? '0.5' : '1';
                    });
                };
                timeUnknown.addEventListener('change', syncTime);
                syncTime();
            }

            // Place search autocomplete
            const placeInput = document.getElementById('km-place');
            const placeList = document.getElementById('km-place-list');
            const latInput = document.getElementById('km-lat');
            const lngInput = document.getElementById('km-lng');
            const tzInput = document.getElementById('km-tz');
            let searchTimer = null;

            const closeList = () => {
                placeList.hidden = true;
                placeList.innerHTML = '';
            };

            if (placeInput && placeList) {
                placeInput.addEventListener('input', () => {
                    latInput.value = '';
                    lngInput.value = '';
                    tzInput.value = '';
                    clearTimeout(searchTimer);
                    const q = placeInput.value.trim();
                    if (q.length < 2) return closeList();

                    searchTimer = setTimeout(async () => {
                        try {
                            const res = await fetch(@json(route('place-search')) + '?q=' + encodeURIComponent(q));
                            const places = await res.json();
                            if (placeInput.value.trim() !== q) return;

                            placeList.innerHTML = '';
                            places.forEach(place => {
                                const li = document.createElement('li');
                                li.textContent = place.label;
                                li.style.padding = '10px 14px';
                                li.style.cursor = 'pointer';
                                li.style.color = '#fff';
                                li.style.borderBottom = '1px solid rgba(255,255,255,0.06)';
                                li.addEventListener('mouseenter', () => li.style.background = 'rgba(227, 181, 104, 0.15)');
                                li.addEventListener('mouseleave', () => li.style.background = 'transparent');
                                li.addEventListener('mousedown', (e) => {
                                    e.preventDefault();
                                    placeInput.value = place.label;
                                    latInput.value = place.lat;
                                    lngInput.value = place.lng;
                                    tzInput.value = place.tz;
                                    closeList();
                                });
                                placeList.appendChild(li);
                            });
                            placeList.hidden = places.length === 0;
                        } catch (e) {
                            closeList();
                        }
                    }, 280);
                });

                placeInput.addEventListener('blur', () => setTimeout(closeList, 180));
            }
        });
    </script>
@endsection
