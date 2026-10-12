   <style>
/* =========================================================
   NAV DROPDOWN - BASE
========================================================= */

.nav-dropdown {
    position: relative;
}

.nav-dropdown > .dropdown-toggle {
    display: flex;
    align-items: center;
    gap: 7px;
    white-space: nowrap;
    cursor: pointer;
}

.dropdown-toggle span {
    display: flex;
    align-items: center;
    color: var(--gold);
}

.dropdown-arrow {
    width: 12px;
    height: 12px;
    flex-shrink: 0;
    opacity: 0.5;
    transition:
        transform 0.25s ease,
        opacity 0.25s ease;
}

.nav-dropdown.active .dropdown-arrow {
    transform: rotate(180deg);
    opacity: 0.8;
}


/* =========================================================
   DROPDOWN BOX - DESKTOP BASE
========================================================= */

.dropdown-menu {
    position: absolute;

    top: calc(100% + 15px);
    left: 50%;

    width: 240px;
    max-width: calc(100vw - 30px);

    height: auto;
    max-height: 320px;

    overflow-y: auto;
    overflow-x: hidden;

    padding: 10px;
    box-sizing: border-box;

    background: var(--navy-deep);

    border: 1px solid rgba(var(--gold-rgb), 0.35);
    border-radius: 16px;

    box-shadow:
        0 15px 40px rgba(0, 0, 0, 0.55),
        0 0 25px rgba(var(--gold-rgb), 0.05);

    opacity: 0;
    visibility: hidden;
    pointer-events: none;

    transform: translateX(-50%) translateY(8px);

    transition:
        opacity 0.2s ease,
        transform 0.2s ease,
        visibility 0.2s ease;

    z-index: 9999;
}


/* =========================================================
   CUSTOM SCROLLBAR
========================================================= */

.dropdown-menu::-webkit-scrollbar {
    width: 5px;
}

.dropdown-menu::-webkit-scrollbar-track {
    background: transparent;
}

.dropdown-menu::-webkit-scrollbar-thumb {
    background: var(--gold);
    border-radius: 10px;
}

.dropdown-menu {
    scrollbar-width: thin;
    scrollbar-color: var(--gold) transparent;
}


/* =========================================================
   INVISIBLE HOVER BRIDGE
========================================================= */

.nav-dropdown::after {
    content: "";

    position: absolute;

    left: -10px;
    right: -10px;

    top: 100%;

    height: 16px;

    z-index: 9998;
}


/* =========================================================
   TOP DIAMOND
========================================================= */

.dropdown-menu::before {
    content: "";

    position: absolute;

    top: -6px;
    left: 50%;

    width: 10px;
    height: 10px;

    background: var(--navy-deep);

    border-left: 1px solid rgba(var(--gold-rgb), 0.35);
    border-top: 1px solid rgba(var(--gold-rgb), 0.35);

    transform: translateX(-50%) rotate(45deg);

    pointer-events: none;
}


/* =========================================================
   DROPDOWN LINKS
========================================================= */

.dropdown-menu a {
    display: flex;
    align-items: center;
    justify-content: space-between;

    width: 100%;
    min-width: 0;

    box-sizing: border-box;

    padding: 12px 14px;

    color: var(--cream);
    text-decoration: none;

    font-size: 14px;
    line-height: 1.4;

    overflow-wrap: anywhere;

    border-radius: 9px;

    transition:
        color 0.2s ease,
        background 0.2s ease;
}

.dropdown-menu a::after {
    content: "→";

    flex-shrink: 0;

    margin-left: 5px;

    color: var(--gold);

    opacity: 0;

    transform: translateX(-5px);

    transition:
        opacity 0.2s ease,
        transform 0.2s ease;
}

.dropdown-menu a:hover {
    color: var(--gold-soft);
    background: rgba(var(--gold-rgb), 0.08);
}

.dropdown-menu a:hover::after {
    opacity: 1;
    transform: translateX(0);
}


/* =========================================================
   CALCULATOR DROPDOWN
========================================================= */

.calculator-menu {
    width: 480px;
    max-width: calc(100vw - 30px);

    max-height: 350px;

    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    align-content: start;

    gap: 3px;
}

.calculator-menu a {
    padding: 10px 8px;
    font-size: 13px;
}


/* =========================================================
   DESKTOP - 769px AND ABOVE
========================================================= */

@media (min-width: 769px) {

    .nav-dropdown {
        width: auto;
    }

    .nav-dropdown > .dropdown-toggle {
        width: auto;
        justify-content: flex-start;
    }

    /* Hover dropdown */
    .nav-dropdown:hover .dropdown-menu,
    .nav-dropdown.active .dropdown-menu {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;

        transform:
            translateX(-50%)
            translateY(0);
    }

    /* Arrow */
    .nav-dropdown:hover .dropdown-arrow,
    .nav-dropdown.active .dropdown-arrow {
        transform: rotate(180deg);
        opacity: 0.8;
    }

    /* Calculator */
    .calculator-menu {
        display: grid;
    }
}


/* =========================================================
   MOBILE - 768px AND BELOW
========================================================= */

@media (max-width: 768px) {

    .nav-dropdown {
        width: 100%;
    }

    .nav-dropdown > .dropdown-toggle {
        width: 100%;

        justify-content: space-between;

        cursor: pointer;
    }


    /* Remove desktop hover bridge */
    .nav-dropdown::after {
        display: none;
    }


    /* -----------------------------------------
       Normal Dropdown
    ----------------------------------------- */

    .dropdown-menu {
        position: static;

        width: 100%;
        max-width: none;

        height: auto;
        max-height: 300px;

        margin-top: 8px;

        padding: 8px;

        box-sizing: border-box;

        border-radius: 12px;

        transform: none;

        box-shadow: none;

        display: none;

        opacity: 1;
        visibility: visible;

        pointer-events: auto;

        overflow-y: auto;
        overflow-x: hidden;
    }


    /* Open */
    .nav-dropdown.active .dropdown-menu {
        display: block;
    }


    /* Remove top diamond */
    .dropdown-menu::before {
        display: none;
    }


    /* Links */
    .dropdown-menu a {
        padding: 11px 14px;
        font-size: 14px;
    }


    /* -----------------------------------------
       Calculator Mobile
    ----------------------------------------- */

    .calculator-menu {
        width: 100%;
        max-width: none;

        max-height: 300px;

        display: none;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        align-content: start;

        gap: 3px;
    }


    /* Calculator Open */
    .nav-dropdown.active .calculator-menu {
        display: grid;
    }


    .calculator-menu a {
        padding: 10px 8px;
        font-size: 12px;
    }


    /* Mobile arrow */
    .nav-dropdown.active .dropdown-arrow {
        transform: rotate(180deg);
    }
}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 480px) {

    .dropdown-menu {
        max-height: 280px;
    }

    .calculator-menu {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 2px;
    }

    .calculator-menu a {
        padding: 9px 6px;
        font-size: 11px;
    }
}


/* =========================================================
   LANGUAGE SWITCH
========================================================= */

.lang-switch {
    position: relative;
}

.lang-toggle {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    height: 40px;
    padding: 0 14px;

    border: 1px solid var(--line);
    border-radius: 99px;

    background: transparent;
    color: var(--cream);

    font-family: inherit;
    font-size: 14px;
    font-weight: 500;
    white-space: nowrap;

    cursor: pointer;

    transition: border-color 0.2s, color 0.2s;
}

.lang-toggle:hover,
.lang-switch.active .lang-toggle {
    border-color: var(--gold);
    color: var(--gold);
}

.lang-switch.active .dropdown-arrow {
    transform: rotate(180deg);
    opacity: 0.8;
}

.lang-menu {
    position: absolute;

    top: calc(100% + 15px);
    right: 0;

    width: 380px;
    max-width: calc(100vw - 30px);
    max-height: 360px;

    overflow-y: auto;
    overflow-x: hidden;

    display: none;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    align-content: start;
    gap: 3px;

    padding: 10px;
    box-sizing: border-box;

    background: var(--navy-deep);

    border: 1px solid rgba(var(--gold-rgb), 0.35);
    border-radius: 16px;

    box-shadow:
        0 15px 40px rgba(0, 0, 0, 0.55),
        0 0 25px rgba(var(--gold-rgb), 0.05);

    scrollbar-width: thin;
    scrollbar-color: var(--gold) transparent;

    z-index: 9999;
}

.lang-switch.active .lang-menu {
    display: grid;
}

.lang-menu::-webkit-scrollbar {
    width: 5px;
}

.lang-menu::-webkit-scrollbar-thumb {
    background: var(--gold);
    border-radius: 10px;
}

.lang-menu button {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 2px;

    min-width: 0;
    padding: 9px 12px;

    border: 0;
    border-radius: 9px;

    background: transparent;
    color: var(--cream);

    font-family: inherit;
    font-size: 14px;
    line-height: 1.35;
    text-align: left;

    cursor: pointer;

    transition:
        color 0.2s ease,
        background 0.2s ease;
}

.lang-menu button small {
    color: var(--muted);
    font-size: 11px;
}

.lang-menu button:hover,
.lang-menu button.active {
    color: var(--gold-soft);
    background: rgba(var(--gold-rgb), 0.08);
}

.lang-menu button.active {
    box-shadow: inset 0 0 0 1px rgba(var(--gold-rgb), 0.35);
}

@media (max-width: 1200px) {

    .lang-toggle {
        width: 40px;
        padding: 0;
        justify-content: center;
    }

    .lang-toggle .lang-current,
    .lang-toggle .dropdown-arrow {
        display: none;
    }
}

@media (max-width: 768px) {

    /* Menu poore header ki chaudai le, button ke niche nahi */
    .lang-switch {
        position: static;
    }

    .lang-menu {
        top: calc(100% + 8px);
        left: 15px;
        right: 15px;

        width: auto;
        max-width: none;
        max-height: 320px;
    }
}


/* =========================================================
   GOOGLE TRANSLATE - apna bar/tooltip chhupao
========================================================= */

#google_translate_element,
.goog-te-banner-frame,
iframe.skiptranslate,
body > .skiptranslate,
#goog-gt-tt,
.goog-te-balloon-frame,
.VIpgJd-ZVi9od-aZ2wEe-wOHMyf {
    display: none !important;
}

body {
    top: 0 !important;
}

.goog-text-highlight {
    background: none !important;
    box-shadow: none !important;
}
</style>





    <header class="site-header">
        <div class="header-container">
            <a href="{{ route('home') }}" class="logo">
                <span class="logo-icon">
                    <svg viewBox="0 0 40 40" width="36" height="36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="logoGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#F8F3E7" />
                                <stop offset="45%" stop-color="#F4D77D" />
                                <stop offset="100%" stop-color="#D4AF37" />
                            </linearGradient>
                        </defs>
                        <!-- Outer Orbit Circle -->
                        <circle cx="20" cy="20" r="17.5" stroke="url(#logoGrad)" stroke-width="1.2"
                            stroke-dasharray="6 3" opacity="0.8" />
                        <circle cx="20" cy="20" r="14" stroke="url(#logoGrad)" stroke-width="0.8" opacity="0.4" />
                        <!-- Sun Cardinal Points -->
                        <path d="M20 2 L20 5 M20 35 L20 38 M2 20 L5 20 M35 20 L38 20" stroke="url(#logoGrad)"
                            stroke-width="1.5" stroke-linecap="round" />
                        <!-- Crescent Moon -->
                        <path d="M25 12 A9 9 0 1 1 14 26 A10 10 0 0 0 25 12 Z" fill="url(#logoGrad)" />
                        <!-- Center Sparkle Star -->
                        <polygon points="20,13 21.2,17.2 25.5,18.5 21.2,19.8 20,24 18.8,19.8 14.5,18.5 18.8,17.2"
                            fill="#FFFFFF" />
                    </svg>
                </span>
                <span class="logo-text notranslate" translate="no">AstroHero</span>
            </a>
            <nav class="nav-links" id="nav-links">

                <a href="{{ route('home') }}" class="active">Home</a>

                <!-- Talk to Astrologer -->
                <div class="nav-dropdown">
                    <span class="dropdown-toggle">
                        Talk to Astrologer
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" class="dropdown-arrow">
                            <path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </span>


                    <div class="dropdown-menu">
                        <a href="{{ route('chat-with-astrologers') }}">Chat with Astrologer</a>
                        <a href="{{ route('talk-to-astrologers') }}">Call with Astrologer</a>
                    </div>
                </div>

                <!-- Free Kundli -->
                <div class="nav-dropdown">
                    <span class="dropdown-toggle">
                        Free Services
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" class="dropdown-arrow">
                            <path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </span>

                    <div class="dropdown-menu">
                        <a href="{{ route('free-kundli') }}">Free Kundli</a>
                        <a href="{{ route('kundli-matching') }}">Kundli Matching</a>
                        <a href="{{ route('compatibility') }}">Compatibility</a>
                        <a href="{{ route('tarot') }}">Tarot</a>
                    </div>
                </div>


                <!-- Calculators -->
                <div class="nav-dropdown">
                    <span class="dropdown-toggle">
                        Calculators
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" class="dropdown-arrow">
                            <path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </span>

                    <div class="dropdown-menu calculator-menu">
                        <a href="{{ route('love-calculator') }}">Love Calculator</a>
                        <a href="{{ route('atmakaraka-darakaraka-calculator') }}">Atmakaraka &amp; Darakaraka Calculator</a>
                        <a href="{{ route('numerology-calculator') }}">Numerology Calculator</a>
                        <a href="{{ route('sun-sign-calculator') }}">Sun Sign Calculator</a>
                        <a href="{{ route('rising-ascendant-sign-calculator') }}">Rising Sign Calculator</a>
                        <a href="{{ route('rashi-calculator') }}">Rashi Calculator</a>
                        <a href="{{ route('dasha-calculator') }}">Dasha Calculator</a>
                        <a href="{{ route('nakshatra-calculator') }}">Nakshatra Calculator</a>
                        <a href="{{ route('mangal-dosha-calculator') }}">Mangal Dosha Calculator</a>
                        <a href="{{ route('shani-sade-sati-calculator') }}">Shani Sade Sati Calculator</a>
                        <a href="{{ route('moon-phase-calculator') }}">Moon Phase Calculator</a>
                        <a href="{{ route('birth-chart-calculator') }}">Birth/Natal Chart Calculator</a>
                        <a href="{{ route('flames-calculator') }}">Flames Calculator</a>
                        <a href="{{ route('lucky-vehicle-number-calculator') }}">Lucky Vehicle Number Calculator</a>
                        <a href="{{ route('friendship-calculator') }}">Friendship Calculator</a>
                        <a href="{{ route('kaal-sarp-dosh-calculator') }}">Kaal Sarp Dosh Calculator</a>
                        <a href="{{ route('ishta-devata-calculator') }}">Ishta Devata Calculator</a>
                        <a href="{{ route('lo-shu-grid-calculator') }}">Lo Shu Grid Calculator</a>
                        <a href="{{ route('transit-chart-calculator') }}">Transit Chart Calculator</a>
                        <a href="{{ route('name-compatibility-calculator') }}">Name Compatibility Calculator</a>
                        <a href="{{ route('mulank-calculator') }}">Mulank Calculator</a>
                        <a href="{{ route('destiny-number-calculator') }}">Destiny Number Calculator</a>
                        <a href="{{ route('age-calculator') }}">Age Calculator</a>
                        <a href="{{ route('mobile-number-numerology-calculator') }}">Mobile Number Numerology Calculator</a>
                        <a href="{{ route('lucky-name-numerology-calculator') }}">Lucky Name Numerology Calculator</a>
                    </div>
                </div>


                <!-- Horoscope -->
                <div class="nav-dropdown">
                    <span class="dropdown-toggle">
                        Horoscope
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" class="dropdown-arrow">
                            <path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </span>

                    <div class="dropdown-menu horoscope-menu">
                        <a href="{{ route('horoscope.landing', ['period' => 'daily']) }}">Daily Horoscope</a>
                        <a href="{{ route('horoscope.landing', ['period' => 'tomorrow']) }}">Tomorrow's Horoscope</a>
                        <a href="{{ route('horoscope.landing', ['period' => 'weekly']) }}">Weekly Horoscope</a>
                        <a href="{{ route('horoscope.landing', ['period' => 'monthly']) }}">Monthly Horoscope</a>
                        <a href="{{ route('horoscope.landing', ['period' => 'yearly']) }}">Yearly Horoscope</a>
                    </div>
                </div>

                <a href="#">Contact Us</a>

            </nav>

            <div class="header-actions">
                <!-- Language switch (Google Translate se poori site translate hoti hai) -->
                @php
                    $languages = [
                        'en' => ['English', 'English'],
                        'hi' => ['हिन्दी', 'Hindi'],
                        'bn' => ['বাংলা', 'Bengali'],
                        'te' => ['తెలుగు', 'Telugu'],
                        'mr' => ['मराठी', 'Marathi'],
                        'ta' => ['தமிழ்', 'Tamil'],
                        'gu' => ['ગુજરાતી', 'Gujarati'],
                        'kn' => ['ಕನ್ನಡ', 'Kannada'],
                        'ml' => ['മലയാളം', 'Malayalam'],
                        'pa' => ['ਪੰਜਾਬੀ', 'Punjabi'],
                        'or' => ['ଓଡ଼ିଆ', 'Odia'],
                        'as' => ['অসমীয়া', 'Assamese'],
                        'ur' => ['اردو', 'Urdu'],
                        'sa' => ['संस्कृतम्', 'Sanskrit'],
                        'mai' => ['मैथिली', 'Maithili'],
                        'bho' => ['भोजपुरी', 'Bhojpuri'],
                        'awa' => ['अवधी', 'Awadhi'],
                        'mwr' => ['मारवाड़ी', 'Marwadi'],
                        'doi' => ['डोगरी', 'Dogri'],
                        'gom' => ['कोंकणी', 'Konkani'],
                        'ne' => ['नेपाली', 'Nepali'],
                        'sd' => ['سنڌي', 'Sindhi'],
                        'tcy' => ['ತುಳು', 'Tulu'],
                        'mni-Mtei' => ['ꯃꯩꯇꯩꯂꯣꯟ', 'Manipuri'],
                        'sat' => ['ᱥᱟᱱᱛᱟᱲᱤ', 'Santali'],
                        'lus' => ['Mizo ṭawng', 'Mizo'],
                        'kha' => ['Ka Ktien Khasi', 'Khasi'],
                        'trp' => ['Kokborok', 'Kokborok'],
                    ];
                @endphp
                <div class="lang-switch notranslate" id="lang-switch" translate="no">
                    <button type="button" class="lang-toggle" id="lang-toggle" aria-haspopup="true" aria-expanded="false"
                        aria-label="Change language" title="Change language">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M2 12h20M12 2a15.3 15.3 0 0 1 0 20M12 2a15.3 15.3 0 0 0 0 20"></path>
                        </svg>
                        <span class="lang-current" id="lang-current">English</span>
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" class="dropdown-arrow">
                            <path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </button>

                    <div class="lang-menu" id="lang-menu">
                        @foreach ($languages as $code => $names)
                            <button type="button" data-lang="{{ $code }}" data-label="{{ $names[0] }}">
                                {{ $names[0] }}
                                <small>{{ $names[1] }}</small>
                            </button>
                        @endforeach
                    </div>
                </div>
                <div id="google_translate_element"></div>

                <!-- Theme switch: dark <-> light -->
                <button type="button" class="theme-toggle" id="theme-toggle" aria-label="Switch between dark and light theme" title="Switch theme">
                    <svg class="icon-moon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"></path>
                    </svg>
                    <svg class="icon-sun" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="4"></circle>
                        <path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"></path>
                    </svg>
                </button>
                <a href="#" class="btn-login">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Login
                </a>
                <button class="menu-toggle" id="menu-toggle" aria-label="Toggle Menu">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const dropdowns = document.querySelectorAll(".nav-dropdown");

            dropdowns.forEach(function (dropdown) {

                const toggle = dropdown.querySelector(".dropdown-toggle");

                toggle.addEventListener("click", function (e) {

                    e.preventDefault();
                    e.stopPropagation();

                    // Mobile par dropdown click se chalega
                    if (window.innerWidth <= 768) {

                        // Baaki dropdown close
                        dropdowns.forEach(function (item) {
                            if (item !== dropdown) {
                                item.classList.remove("active");
                            }
                        });

                        // Current dropdown toggle
                        dropdown.classList.toggle("active");
                    }

                });
            });


            // Dropdown ke bahar click karne par close
            document.addEventListener("click", function (e) {

                if (!e.target.closest(".nav-dropdown")) {

                    dropdowns.forEach(function (dropdown) {
                        dropdown.classList.remove("active");
                    });

                }

            });


            // Resize hone par mobile/desktop state clean
            window.addEventListener("resize", function () {

                if (window.innerWidth > 768) {

                    dropdowns.forEach(function (dropdown) {
                        dropdown.classList.remove("active");
                    });

                }

            });

        });

    </script>

    <script>
        // Language switch: chuni hui bhasha "googtrans" cookie me rehti hai, Google Translate usi se poora page badalta hai
        (function () {
            const wrap = document.getElementById('lang-switch');
            if (!wrap) return;

            const toggle = document.getElementById('lang-toggle');
            const items = wrap.querySelectorAll('.lang-menu button');

            const match = document.cookie.match(/(?:^|;\s*)googtrans=\/[^\/]*\/([^;]+)/);
            const current = match ? decodeURIComponent(match[1]) : 'en';

            items.forEach(function (item) {
                if (item.dataset.lang === current) {
                    item.classList.add('active');
                    document.getElementById('lang-current').textContent = item.dataset.label;
                }
            });

            // Google khud cookie parent domain par bhi rakhta hai, isliye har jagah se hatao
            function clearCookie() {
                const expired = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/';
                const parts = location.hostname.split('.');
                document.cookie = expired;
                for (let i = 0; i < parts.length - 1; i++) {
                    const domain = parts.slice(i).join('.');
                    document.cookie = expired + '; domain=' + domain;
                    document.cookie = expired + '; domain=.' + domain;
                }
            }

            items.forEach(function (item) {
                item.addEventListener('click', function () {
                    const lang = item.dataset.lang;
                    if (lang === current) {
                        wrap.classList.remove('active');
                        return;
                    }
                    clearCookie();
                    if (lang !== 'en') {
                        document.cookie = 'googtrans=/en/' + lang + '; path=/; max-age=31536000';
                    }
                    location.reload();
                });
            });

            toggle.addEventListener('click', function (e) {
                e.stopPropagation();
                const open = wrap.classList.toggle('active');
                toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            });

            document.addEventListener('click', function (e) {
                if (!e.target.closest('#lang-switch')) {
                    wrap.classList.remove('active');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    wrap.classList.remove('active');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });

            // English par Google ka script load hi nahi hota
            if (current !== 'en') {
                window.googleTranslateElementInit = function () {
                    new google.translate.TranslateElement({ pageLanguage: 'en', autoDisplay: false }, 'google_translate_element');
                };
                const script = document.createElement('script');
                script.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
                document.body.appendChild(script);
            }
        })();
    </script>
