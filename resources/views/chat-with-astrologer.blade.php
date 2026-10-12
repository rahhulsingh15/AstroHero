@extends('frontend.layouts.master')
@section('title', 'Chat with Astrologers')
@section('content')
    @include('frontend.partials.astrologer-page.hero')
    <section class="chat-all-astrologer-section">

        <div class="astrologers-container">
            <div class="filters-row">
                <div class="search-box">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" id="searchInput" placeholder="Search name, skill, language.">
                </div>
                <button class="sort-btn" id="sortBtn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="7" y1="12" x2="17" y2="12"></line>
                        <line x1="10" y1="18" x2="14" y2="18"></line>
                    </svg>
                    Sort
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="category-scroll">
                    <button class="cat-btn active">All</button>
                    <button class="cat-btn">Love</button>
                    <button class="cat-btn">Education</button>
                    <button class="cat-btn">Career</button>
                    <button class="cat-btn">Marriage</button>
                    <button class="cat-btn">Health</button>
                    <button class="cat-btn">Wealth</button>
                    <button class="cat-btn">Legal</button>
                    <button class="cat-btn">Finance</button>
                    <button class="cat-btn">Remedies</button>
                    <button class="cat-btn">Parents</button>
                </div>
            </div>

            <div class="astro-grid" id="astroGrid">
                <!-- Astrologer Card 1 -->
                <div class="astro-card">
                    <div class="card-header">
                        <div class="astro-avatar">
                            <img src="{{asset('assets/images/chatimg1.png')}}" alt="Dr. Aradhana">
                            <div class="online-dot"></div>
                        </div>
                        <span class="celeb-tag">Celebrity</span>
                    </div>
                    <h3 class="astro-name">Dr. Aradhana <span class="verified-icon">✔</span></h3>
                    <div class="astro-skills">
                        <span class="skill-tag">Vedic</span>
                        <span class="skill-tag">Vastu</span>
                        <span class="skill-tag">Prashana</span>
                    </div>
                    <div class="astro-details">
                        Hindi • Sanskrit<br>
                        <strong>28 yrs exp</strong>
                    </div>
                    <div class="price-row">
                        <div class="rating-info"><span class="star">★</span> 5.0 <span>• 50k+</span></div>
                        <div class="price">₹123<span>/min</span></div>
                    </div>
                    <button class="btn-chat-outline">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                            </path>
                        </svg>
                        Chat now
                    </button>
                </div>

                <!-- Astrologer Card 2 -->
                <div class="astro-card">
                    <div class="card-header">
                        <div class="astro-avatar">
                            <img src="{{asset('assets/images/chatimg2.png')}}" alt="Meera Sharma">
                            <div class="online-dot"></div>
                        </div>
                    </div>
                    <h3 class="astro-name">Meera Sharma <span class="verified-icon">✔</span></h3>
                    <div class="astro-skills">
                        <span class="skill-tag">Vedic</span>
                        <span class="skill-tag">Vastu</span>
                        <span class="skill-tag">Tarot</span>
                    </div>
                    <div class="astro-details">
                        Hindi • Marwari<br>
                        <strong>24 yrs exp</strong>
                    </div>
                    <div class="price-row">
                        <div class="rating-info"><span class="star">★</span> 5.0 <span>• 10k+</span></div>
                        <div class="price">₹111<span>/min</span></div>
                    </div>
                    <button class="btn-chat-outline">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                            </path>
                        </svg>
                        Chat now
                    </button>
                </div>

                <!-- Astrologer Card 3 -->
                <div class="astro-card">
                    <div class="card-header">
                        <div class="astro-avatar">
                            <img src="{{asset('assets/images/chatimg3.png')}}" alt="Riya Singh">
                            <div class="online-dot"></div>
                        </div>
                    </div>
                    <h3 class="astro-name">Riya Singh <span class="verified-icon">✔</span></h3>
                    <div class="astro-skills">
                        <span class="skill-tag">Vedic</span>
                        <span class="skill-tag">Nadi</span>
                        <span class="skill-tag">Numerology</span>
                    </div>
                    <div class="astro-details">
                        English • Tamil<br>
                        <strong>3 yrs exp</strong>
                    </div>
                    <div class="price-row">
                        <div class="rating-info"><span class="star">★</span> 4.9 <span>• 1k+</span></div>
                        <div class="price">₹20<span>/min</span></div>
                    </div>
                    <button class="btn-chat-outline">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                            </path>
                        </svg>
                        Chat now
                    </button>
                </div>

                <!-- Astrologer Card 4 -->
                <div class="astro-card">
                    <div class="card-header">
                        <div class="astro-avatar">
                            <img src="{{ asset('assets/images/chatimg4.png') }}" alt="Kavya Verma">
                            <div class="online-dot"></div>
                        </div>
                    </div>
                    <h3 class="astro-name">Kavya Verma <span class="verified-icon">✔</span></h3>
                    <div class="astro-skills">
                        <span class="skill-tag">Vedic</span>
                        <span class="skill-tag">KP</span>
                        <span class="skill-tag">Tarot</span>
                    </div>
                    <div class="astro-details">
                        Hindi • English<br>
                        <strong>12 yrs exp</strong>
                    </div>
                    <div class="price-row">
                        <div class="rating-info"><span class="star">★</span> 4.8 <span>• 10k+</span></div>
                        <div class="price">₹35<span>/min</span></div>
                    </div>
                    <button class="btn-chat-outline">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                            </path>
                        </svg>
                        Chat now
                    </button>
                </div>

                <!-- Astrologer Card 5 -->
                <div class="astro-card">
                    <div class="card-header">
                        <div class="astro-avatar">
                            <span class="astro-initials">RS</span>
                            <div class="online-dot"></div>
                        </div>
                    </div>
                    <h3 class="astro-name">Pt. Rajesh Sharma <span class="verified-icon">✔</span></h3>
                    <div class="astro-skills">
                        <span class="skill-tag">Vedic</span>
                        <span class="skill-tag">Numerology</span>
                        <span class="skill-tag">Vastu</span>
                    </div>
                    <div class="astro-details">
                        Hindi • Sanskrit<br>
                        <strong>18 yrs exp</strong>
                    </div>
                    <div class="price-row">
                        <div class="rating-info"><span class="star">★</span> 4.9 <span>• 8k+</span></div>
                        <div class="price">₹45<span>/min</span></div>
                    </div>
                    <button class="btn-chat-outline">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                            </path>
                        </svg>
                        Chat now
                    </button>
                </div>

                <!-- Astrologer Card 6 -->
                <div class="astro-card">
                    <div class="card-header">
                        <div class="astro-avatar">
                            <span class="astro-initials">AD</span>
                            <div class="online-dot"></div>
                        </div>
                    </div>
                    <h3 class="astro-name">Acharya Dev <span class="verified-icon">✔</span></h3>
                    <div class="astro-skills">
                        <span class="skill-tag">Kundli</span>
                        <span class="skill-tag">Marriage</span>
                        <span class="skill-tag">Prashana</span>
                    </div>
                    <div class="astro-details">
                        Hindi • Gujarati<br>
                        <strong>15 yrs exp</strong>
                    </div>
                    <div class="price-row">
                        <div class="rating-info"><span class="star">★</span> 4.8 <span>• 12k+</span></div>
                        <div class="price">₹30<span>/min</span></div>
                    </div>
                    <button class="btn-chat-outline">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                            </path>
                        </svg>
                        Chat now
                    </button>
                </div>

                <!-- Astrologer Card 7 -->
                <div class="astro-card">
                    <div class="card-header">
                        <div class="astro-avatar">
                            <span class="astro-initials">PV</span>
                            <div class="online-dot"></div>
                        </div>
                    </div>
                    <h3 class="astro-name">Pt. Vashishtha <span class="verified-icon">✔</span></h3>
                    <div class="astro-skills">
                        <span class="skill-tag">Vedic</span>
                        <span class="skill-tag">Puja</span>
                        <span class="skill-tag">Remedies</span>
                    </div>
                    <div class="astro-details">
                        Hindi • Marathi<br>
                        <strong>22 yrs exp</strong>
                    </div>
                    <div class="price-row">
                        <div class="rating-info"><span class="star">★</span> 4.9 <span>• 15k+</span></div>
                        <div class="price">₹60<span>/min</span></div>
                    </div>
                    <button class="btn-chat-outline">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                            </path>
                        </svg>
                        Chat now
                    </button>
                </div>

                <!-- Astrologer Card 8 -->
                <div class="astro-card">
                    <div class="card-header">
                        <div class="astro-avatar">
                            <span class="astro-initials">AR</span>
                            <div class="online-dot"></div>
                        </div>
                    </div>
                    <h3 class="astro-name">Astro Rahul <span class="verified-icon">✔</span></h3>
                    <div class="astro-skills">
                        <span class="skill-tag">Tarot</span>
                        <span class="skill-tag">Love</span>
                        <span class="skill-tag">Career</span>
                    </div>
                    <div class="astro-details">
                        Hindi • English<br>
                        <strong>9 yrs exp</strong>
                    </div>
                    <div class="price-row">
                        <div class="rating-info"><span class="star">★</span> 4.7 <span>• 6k+</span></div>
                        <div class="price">₹25<span>/min</span></div>
                    </div>
                    <button class="btn-chat-outline">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                            </path>
                        </svg>
                        Chat now
                    </button>
                </div>
            </div>

            <button class="view-all-astro-btn">View all astrologers ↓</button>
        </div>
    </section>
    <section class="trending-astrologers-section">
        <div class="trending-container">
            <div class="trending-header">
                <span class="trending-badge">TRENDING NOW</span>
                <h2>Most consulted this week</h2>
                <p>The astrologers everyone is talking to right now.</p>
            </div>

            <div class="trending-list">
                <!-- Trending Item 1 -->
                <div class="trending-item">
                    <div class="t-left">
                        <div class="t-avatar">
                            <img src="{{asset('assets/images/chatimg1.png')}}" alt="Dr. Aradhana">
                        </div>
                        <div class="t-info">
                            <h4>Dr. Aradhana <span class="verified-icon">✔</span></h4>
                            <p>Vedic • KP</p>
                            <div class="t-price-row">
                                <span class="star">★</span> 5.0 <span class="dot">•</span> <span
                                    class="t-price">₹40/min</span>
                            </div>
                        </div>
                    </div>
                    <button class="t-btn chat-green">Chat</button>
                </div>


                <!-- Trending Item 2 -->
                <div class="trending-item">
                    <div class="t-left">
                        <div class="t-avatar">
                            <img src="{{asset('assets/images/chatimg3.png')}}" alt="Riya Singh">
                        </div>
                        <div class="t-info">
                            <h4>Riya Singh <span class="verified-icon">✔</span></h4>
                            <p>Vedic • Numerology</p>
                            <div class="t-price-row">
                                <span class="star">★</span> 5.0 <span class="dot">•</span> <span
                                    class="t-old-price">₹57/min</span> <span class="t-price">₹29/min</span>
                            </div>
                        </div>
                    </div>
                    <button class="t-btn chat-green">Chat</button>
                </div>

                <!-- Trending Item 3 -->
                <div class="trending-item">
                    <div class="t-left">
                        <div class="t-avatar">
                            <img src="{{asset('assets/images/chatimg4.png')}}" alt="Kavya Verma">
                        </div>
                        <div class="t-info">
                            <h4>Kavya Verma <span class="verified-icon">✔</span></h4>
                            <p>Vedic • Numerology</p>
                            <div class="t-price-row">
                                <span class="star">★</span> 5.0 <span class="dot">•</span> <span
                                    class="t-price">₹69/min</span>
                            </div>
                        </div>
                    </div>
                    <button class="t-btn chat-green">Chat</button>
                </div>

                <!-- Trending Item 4 -->
                <div class="trending-item">
                    <div class="t-left">
                        <div class="t-avatar">
                            <img src="{{asset('assets/images/chatimg2.png')}}" alt="Meera Sharma">
                        </div>
                        <div class="t-info">
                            <h4>Meera Sharma <span class="verified-icon">✔</span></h4>
                            <p>Vedic • Life Coach</p>
                            <div class="t-price-row">
                                <span class="star">★</span> 5.0 <span class="dot">•</span> <span
                                    class="t-price">₹20/min</span>
                            </div>
                        </div>
                    </div>
                    <button class="t-btn chat-red">Chat</button>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.partials.astrologer-page.content')
    <!-- Sort Modal -->
    <div class="modal-overlay" id="sortModalOverlay">
        <div class="sort-modal">
            <div class="modal-header">
                <h3>SORT</h3>
                <button class="close-btn" id="closeModalBtn">×</button>
            </div>
            <div class="modal-body">
                <div class="modal-sidebar">
                    <div class="modal-sidebar-item">Sorting</div>
                </div>
                <div class="modal-options">
                    <label class="radio-option">
                        <input type="radio" name="sort" checked>
                        <span>Popularity</span>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="sort">
                        <span>Experience: High to Low</span>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="sort">
                        <span>Experience: Low to High</span>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="sort">
                        <span>Total Orders: High to Low</span>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="sort">
                        <span>Total Orders: Low to High</span>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="sort">
                        <span>Price: High to Low</span>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="sort">
                        <span>Price: Low to High</span>
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-reset">Reset</button>
                <button class="btn-apply" id="applySortBtn">Apply</button>
            </div>
        </div>
    </div>

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
@endsection