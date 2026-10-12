@extends('frontend.layouts.master')
@section('title', 'Dasha Calculator | Find Your Dasha')
@section('content')
    <section class="ras-banner-section">
        <div class="container ras-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">DASHA CALCULATOR</span>
            </div>
            <h1>What is My Current Dasha? Find Your Mahadasha & Antardasha</h1>
            <p class="ras-subtitle">Ever wondered when a major life event will happen? Vimshottari Dasha helps you understand the timing of events in your life. Discover your current Mahadasha and Antardasha below!</p>
        </div>
    </section>

    <section class="ras-form-section">
        <div class="container">
            <div class="ras-card">
                <div class="card-header">
                    <h2>Calculate your Dasha here</h2>
                </div>
                <form class="ras-form" method="GET" action="{{ route('dasha-calculator-report') }}" autocomplete="off">
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
                        <small class="ras-hint" id="ras-time-hint" hidden>Without a birth time we will use 12:00 noon, so your dasha dates may be off by a few months.</small>
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
                        <button type="submit" class="btn-primary">Get Dasha Details</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="ras-content-section">
        <div class="container ras-content-wrapper">
            <h3>How to Calculate Vimshottari Dasha?</h3>
            <p>Vimshottari Dasha is calculated based on the position of the Moon in a specific Nakshatra (lunar mansion) at the exact time of your birth. The entire cycle spans 120 years and is divided among nine planetary periods (Mahadashas), which give specific results based on your birth chart.</p>

            <h3>What are the Nine Planetary Dashas?</h3>
            <div class="signs-list">
                <div class="sign-item">
                    <h4><span class="sign-icon">☀️</span> Sun (Surya) Mahadasha</h4>
                    <p>A 6-year period of authority, career advancement, and self-realization. It brings focus on leadership, government connections, and overall vitality.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon">🌙</span> Moon (Chandra) Mahadasha</h4>
                    <p>A 10-year time of emotional growth, mental changes, and focus on home and mother. It brings emotional sensitivity and can lead to domestic changes.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon">☄️</span> Mars (Mangal) Mahadasha</h4>
                    <p>A 7-year energetic and action-oriented period. It brings courage, ambition, and sometimes conflict or property-related matters. A time to take initiative.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon">🌪️</span> Rahu Mahadasha</h4>
                    <p>An 18-year period of intense worldly desires, sudden changes, and unconventional paths. It can bring immense success or confusion, focusing on material gains.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon">🌟</span> Jupiter (Guru) Mahadasha</h4>
                    <p>A 16-year phase of wisdom, expansion, and spiritual growth. Often associated with marriage, wealth, and higher education. It generally brings optimism.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon">🪐</span> Saturn (Shani) Mahadasha</h4>
                    <p>A 19-year period of discipline, hard work, and karmic lessons. It demands patience and perseverance, bringing long-term stability through sustained effort.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon">🌠</span> Mercury (Budha) Mahadasha</h4>
                    <p>A 17-year time of learning, communication, and intellectual pursuits. It favors business, writing, trade, and analytical thinking.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon">🌫️</span> Ketu Mahadasha</h4>
                    <p>A 7-year deeply spiritual and introspective period. It brings detachment from materialistic desires, sudden spiritual insights, and sometimes a sense of isolation.</p>
                </div>
                <div class="sign-item">
                    <h4><span class="sign-icon">✨</span> Venus (Shukra) Mahadasha</h4>
                    <p>A 20-year phase of luxury, romance, and artistic pursuits. It brings focus on relationships, comforts, wealth, and aesthetic pleasures.</p>
                </div>
            </div>

            <h3 style="margin-top: 40px;">Conclusion</h3>
            <p>Vimshottari Dasha provides a profound timeline of your life's journey. By understanding your current planetary periods, you can align your actions with the cosmic flow, preparing for challenges and maximizing opportunities. Remember that the results of a Dasha heavily depend on the specific placement and strength of that planet in your unique birth chart.</p>

            <div class="discover-more">
                <h3>Explore More Astrology Tools</h3>
                <div class="calc-cards">
                    <div class="calc-card">
                        <span class="c-icon">🌅</span>
                        <h4>Rising Sign Calculator</h4>
                        <p>Discover your ascendant</p>
                    </div>
                    <div class="calc-card">
                        <span class="c-icon">📜</span>
                        <h4>Free Kundli (Birth Chart)</h4>
                        <p>Detailed astrological profile</p>
                    </div>
                    <div class="calc-card">
                        <span class="c-icon">🪐</span>
                        <h4>Sade Sati Calculator</h4>
                        <p>Check Saturn's impact</p>
                    </div>
                    <div class="calc-card">
                        <span class="c-icon">💞</span>
                        <h4>Kundli Matching</h4>
                        <p>Check marriage compatibility</p>
                    </div>
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

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>What is Vimshottari Dasha?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>Vimshottari Dasha is the most widely used planetary period system in Vedic Astrology. It assumes a maximum human lifespan of 120 years, divided into periods ruled by the nine planets, determining when specific events will unfold in your life.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>How is my starting Dasha determined?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>Your starting Mahadasha is determined by the Nakshatra (moon mansion) the Moon was placed in at the exact time of your birth. The lord of that Nakshatra becomes your first Dasha ruler.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>What are Mahadasha and Antardasha?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>Mahadasha is the major planetary period that can last from 6 to 20 years. Antardasha (or Bhukti) is a sub-period within the Mahadasha, ruled by another planet, which modifies the results of the major period.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>Do I need my exact birth time for Dasha calculation?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>Yes, since the Moon moves quickly, your exact birth time is essential to accurately calculate the degree of the Moon in its Nakshatra, which determines exactly how much of your first Dasha is left at birth.</p>
                    </div>
                </div>

                <div class="acord-item">
                    <button class="acord-btn">
                        <span>Will a bad planet's Dasha always give bad results?</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        <p>Not necessarily. The results depend on the planet's dignity, placement, and conjunctions in your individual birth chart. Even traditionally malefic planets like Saturn or Rahu can give excellent results if well-placed.</p>
                    </div>
                </div>

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
    </script>
    <script>

// view-all-astrologers page js start 


document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".tab-btn");
    const dailyTabContent = document.getElementById("daily-tab");
    const container = document.querySelector(".tab_container");

    // Create other tab contents dynamically by duplicating the daily tab content
    const tabNames = ["tomorrow", "weekly", "monthly", "yearly"];

    tabNames.forEach(name => {
        if (dailyTabContent) {
            const div = document.createElement("div");
            div.className = "tab-content";
            div.id = name + "-tab";

            // Replace text for the specific tab
            let content = dailyTabContent.innerHTML;

            // Basic text replacements to show different data for different tabs
            content = content.replace(/TODAY/g, name.toUpperCase());
            content = content.replace(/today/g, name);

            div.innerHTML = content;
            container.appendChild(div);
        }
    });

    const allContents = document.querySelectorAll(".tab-content");

    // Tab Switch Logic
    tabs.forEach((tab, index) => {
        tab.addEventListener("click", () => {
            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove("active"));
            tab.classList.add("active");

            // Hide all tab contents
            allContents.forEach(c => c.classList.remove("active"));

            // Show corresponding content based on index
            if (allContents[index]) {
                allContents[index].classList.add("active");
            }
        });
    });

    // Read More Logic
    document.body.addEventListener("click", function (e) {
        if (e.target.tagName === "STRONG" && e.target.textContent === "Read More") {
            const p = e.target.parentElement;

            // A simple logic to replace the truncated text with full text based on the card
            if (p.innerHTML.includes("Venus may make single Capricorn natives")) {
                p.innerHTML = "Venus may make single Capricorn natives think about an old lover today. Before letting your emotions take over and reach out to them, take your time to understand your feelings. Keep focusing on your self-growth.";
            } else if (p.innerHTML.includes("Venus shows a gradual improvement")) {
                p.innerHTML = "Venus shows a gradual improvement in your financial situation today. You could benefit from an old investment or something unexpected. Plan your budget wisely for the long term.";
            } else if (p.innerHTML.includes("Capricorn natives may hear something")) {
                p.innerHTML = "Capricorn natives may hear something related to work today that could leave them slightly disturbed. Instead of reacting immediately, stay calm and observe the situation before making any professional moves.";
            } else if (p.innerHTML.includes("A small change in your eating habits")) {
                p.innerHTML = "A small change in your eating habits could benefit your health today. AstroHero's astrologers advise you to focus on food that gives you energy and practice mindful eating throughout the day.";
            } else {
                p.innerHTML = p.innerHTML.replace("... <strong>Read More</strong>", " and focus on your long-term goals.");
            }
        }
    });
});

// view-all-astrologers page end js 

// chat-with-astrologer page start 
document.addEventListener('DOMContentLoaded', () => {
    // Sort Modal Logic
    const sortBtn = document.getElementById('sortBtn');
    const sortModalOverlay = document.getElementById('sortModalOverlay');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const applySortBtn = document.getElementById('applySortBtn');

    if (sortBtn && sortModalOverlay) {
        sortBtn.addEventListener('click', () => {
            sortModalOverlay.classList.add('active');
            sortBtn.classList.add('active');
        });

        const closeModal = () => {
            sortModalOverlay.classList.remove('active');
            sortBtn.classList.remove('active');
        };

        if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
        if (applySortBtn) applySortBtn.addEventListener('click', closeModal);

        sortModalOverlay.addEventListener('click', (e) => {
            if (e.target === sortModalOverlay) {
                closeModal();
            }
        });
    }

    // Category Scroll Active State Logic
    const catBtns = document.querySelectorAll('.category-scroll .cat-btn');
    catBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            catBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });
});

// Search and Filter Logic
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const cards = document.querySelectorAll('.astro-card');
    const catBtns = document.querySelectorAll('.category-scroll .cat-btn');

    // Add random data-categories for demo purposes since HTML doesn't have them
    const dummyCategories = ['love', 'education', 'career', 'marriage', 'health', 'wealth', 'legal', 'finance', 'remedies', 'parents'];
    cards.forEach((card, index) => {
        let cats = [];
        cats.push(dummyCategories[index % dummyCategories.length]);
        cats.push(dummyCategories[(index + 3) % dummyCategories.length]);
        cats.push(dummyCategories[(index + 5) % dummyCategories.length]);
        card.setAttribute('data-categories', cats.join(','));
    });

    let currentCategory = 'all';
    let currentSearch = '';

    function filterCards() {
        cards.forEach(card => {
            const cardText = card.innerText.toLowerCase();
            const cardCategories = card.getAttribute('data-categories') || '';

            const matchesSearch = currentSearch === '' || cardText.includes(currentSearch);
            const matchesCategory = currentCategory === 'all' || cardCategories.includes(currentCategory);

            if (matchesSearch && matchesCategory) {
                card.style.display = 'flex';
                // Trigger reflow for animation
                setTimeout(() => { card.style.opacity = '1'; card.style.transform = 'translateY(0)'; }, 50);
            } else {
                card.style.opacity = '0';
                card.style.transform = 'translateY(10px)';
                setTimeout(() => { card.style.display = 'none'; }, 300);
            }
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            currentSearch = e.target.value.toLowerCase().trim();
            filterCards();
        });
    }

    catBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            catBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            currentCategory = btn.innerText.toLowerCase().trim();
            filterCards();
        });
    });

    // Initial setup for animation
    cards.forEach(card => {
        card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
    });
});

document.addEventListener('DOMContentLoaded', () => {
    // Accordion Logic
    const accordionBtns = document.querySelectorAll('.accordion-btn');

    accordionBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const item = btn.parentElement;

            // Toggle current item
            item.classList.toggle('active');

            // Close other items (optional, but good for saving space)
            const allItems = document.querySelectorAll('.accordion-item');
            allItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    // Side-Tabs Logic
    const sideTabBtns = document.querySelectorAll('.side-tab-btn');
    const sidePanes = document.querySelectorAll('.side-pane');

    sideTabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active from all tabs and panes
            sideTabBtns.forEach(b => b.classList.remove('active'));
            sidePanes.forEach(p => p.classList.remove('active'));

            // Add active to clicked tab
            btn.classList.add('active');

            // Show corresponding pane
            const targetId = btn.getAttribute('data-target');
            const targetPane = document.getElementById(targetId);
            if (targetPane) {
                targetPane.classList.add('active');
            }
        });
    });
});

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
