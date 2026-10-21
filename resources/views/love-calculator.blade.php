@extends('frontend.layouts.master')
@section('title', $content->meta_title ?: 'Love Calculator by Name | Love Compatibility Test')
@section('content')
<section class="love-calculator-section">
    <div class="lc-container">
        <div class="lc-content">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">{{ $content->breadcrumb_label ?: 'LOVE CALCULATOR' }}</span>
            </div>
            <h1>{{ $content->hero_title ?: 'Love Calculator' }} @if($content->hero_highlight)<span class="highlight-text">{{ $content->hero_highlight }}</span>@endif</h1>
            <div class="lc-description">
                <p>{{ $content->hero_intro }}@if($content->hero_more)<span
                        class="more-dots">...</span><span class="more-text" style="display: none;"> {{ $content->hero_more }}</span>@endif</p>
                @if($content->hero_more)
                    <button class="read-more" onclick="toggleReadMore()">Read more</button>
                @endif
            </div>
        </div>
        <div class="lc-visual">

            <svg viewBox="0 0 400 250" class="gauge-svg">
                <g transform="translate(200, 200) rotate(180)">
                    <circle cx="0" cy="0" r="160" fill="none" stroke="var(--meter-1)" stroke-width="36"
                        stroke-dasharray="59 1000" stroke-dashoffset="0" />
                    <circle cx="0" cy="0" r="160" fill="none" stroke="var(--meter-2)" stroke-width="36"
                        stroke-dasharray="59 1000" stroke-dashoffset="-62.8" />
                    <circle cx="0" cy="0" r="160" fill="none" stroke="var(--meter-3)" stroke-width="36"
                        stroke-dasharray="59 1000" stroke-dashoffset="-125.6" />
                    <circle cx="0" cy="0" r="160" fill="none" stroke="var(--meter-4)" stroke-width="36"
                        stroke-dasharray="59 1000" stroke-dashoffset="-188.4" />
                    <circle cx="0" cy="0" r="160" fill="none" stroke="var(--meter-5)" stroke-width="36"
                        stroke-dasharray="59 1000" stroke-dashoffset="-251.2" />
                    <circle cx="0" cy="0" r="160" fill="none" stroke="var(--meter-6)" stroke-width="36"
                        stroke-dasharray="59 1000" stroke-dashoffset="-314" />
                    <circle cx="0" cy="0" r="160" fill="none" stroke="var(--meter-7)" stroke-width="36"
                        stroke-dasharray="59 1000" stroke-dashoffset="-376.8" />
                    <circle cx="0" cy="0" r="160" fill="none" stroke="var(--meter-8)" stroke-width="36"
                        stroke-dasharray="59 1000" stroke-dashoffset="-439.6" />
                </g>
                <g class="needle-path">
                    <polygon points="196,200 204,200 200,60" fill="var(--meter-2)" />
                    <circle cx="200" cy="200" r="12" fill="var(--meter-2)" />
                </g>
            </svg>
        </div>
    </div>
</section>
<!-- Compatibility Form -->
<section class="compatibility-form-section">
    <div class="container lc-box">
        <h2><span class="heart-icon">❤️</span> {{ $content->form_title }} @if($content->form_highlight)<span class="highlight-text">{{ $content->form_highlight }}</span>@endif
        </h2>
        <form class="love-form" method="GET" action="{{ route('love-report') }}">
            <div class="form-inputs-row">
                <div class="form-group">
                    <label for="lc-name1">Your Name</label>
                    <input type="text" id="lc-name1" name="name1" placeholder="Enter your name" maxlength="30" pattern=".*[A-Za-z].*" title="Enter your name in English letters" required>
                    <input type="hidden" name="gender1" value="male">
                    <div class="gender-toggle">
                        <button type="button" class="gender-btn active" data-gender="male">♂ Male</button>
                        <button type="button" class="gender-btn" data-gender="female">♀ Female</button>
                    </div>
                </div>
                <div class="heart-divider">
                    <div class="heart-circle">❤️</div>
                </div>
                <div class="form-group">
                    <label for="lc-name2">Partner's Name</label>
                    <input type="text" id="lc-name2" name="name2" placeholder="Enter partner's name" maxlength="30" pattern=".*[A-Za-z].*" title="Enter partner's name in English letters" required>
                    <input type="hidden" name="gender2" value="female">
                    <div class="gender-toggle">
                        <button type="button" class="gender-btn" data-gender="male">♂ Male</button>
                        <button type="button" class="gender-btn active" data-gender="female">♀ Female</button>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-calculate">Calculate Love %</button>
                <button type="reset" class="btn-reset-form">Reset</button>
            </div>
        </form>
    </div>
</section>
<!-- Main Content & Sidebar -->
<section class="lc-main-section">
    <div class="container">
        <div class=" lc-split">
            <!-- Left Content -->
            <div class="lc-left">
                {{-- Admin > Love Calculator > Page Content > Main Content (Jodit, % cards samet) --}}
                {!! $content->main_content !!}


            </div>

            <!-- Right Sidebar -->
            <div class="lc-right">
                <div class="sidebar-widget">
                    <div class="widget-header">
                        <h4>Talk to Horoscope experts</h4>
                        <p>Our top rated astrologers to answer your queries</p>
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
                            <button class="btn-view">View</button>
                        </div>
                        <!-- Expert 2 -->
                        <div class="expert-item">
                            <img src="{{ asset('assets/images/chatimg3.webp') }}" alt="Nevibala" class="exp-img">
                            <div class="expert-info">
                                <h5>Nevibala</h5>
                                <p>Vedic, Tarot</p>
                                <span class="rate">₹ 29/min</span>
                            </div>
                            <button class="btn-view">View</button>
                        </div>
                        <!-- Expert 3 -->
                        <div class="expert-item">
                            <img src="{{ asset('assets/images/chatimg1.webp') }}" alt="Swarna" class="exp-img">
                            <div class="expert-info">
                                <h5>Swarna</h5>
                                <p>Vedic, Numerology</p>
                                <span class="rate">₹ 69/min</span>
                            </div>
                            <button class="btn-view">View</button>
                        </div>
                        <!-- Expert 4 -->
                        <div class="expert-item">
                            <img src="{{ asset('assets/images/chatimg2.webp') }}" alt="Supransh" class="exp-img">
                            <div class="expert-info">
                                <h5>Supransh</h5>
                                <p>Vedic, Life Coach</p>
                                <span class="rate">₹ 20/min</span>
                            </div>
                            <button class="btn-view">View</button>
                        </div>
                        <!-- Expert 5 -->
                        <div class="expert-item">
                            <img src="{{ asset('assets/images/chatimg3.webp') }}" alt="Aarav" class="exp-img">
                            <div class="expert-info">
                                <h5>Aarav</h5>
                                <p>Vedic, Vastu</p>
                                <span class="rate">₹ 35/min</span>
                            </div>
                            <button class="btn-view">View</button>
                        </div>
                    </div>
                    <button class="btn-view-all">View all astrologers</button>
                </div>
            </div>
        </div>


        <div class="lc-additional-content">
            {{-- Admin > Love Calculator > Page Content > More Content (Jodit, tools cards samet) --}}
            {!! $content->extra_content !!}
        </div>
    </div>

</section>
@if($faqs->isNotEmpty())
<section class="acording_section">
    <div class="acord-container">
        <!-- Left Side: Title -->
        <div class="acord-left">
            <span class="acord-subtitle">{{ $content->faq_subtitle }}</span>
            <h2 class="acord-title">{!! $content->faq_title !!}</h2>
        </div>

        <!-- Right Side: Accordion List (Admin > Love Calculator > FAQs) -->
        <div class="acord-right">

            @foreach($faqs as $faq)
                <div class="acord-item">
                    <button class="acord-btn">
                        <span>{{ $faq->question }}</span>
                        <div class="acord-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="acord-content">
                        {!! $faq->answer !!}
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
@endif
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

    // Gender toggle logic
    document.querySelectorAll('.gender-toggle').forEach(group => {
        const btns = group.querySelectorAll('.gender-btn');
        const hidden = group.parentElement.querySelector('input[type="hidden"]');
        const select = (gender) => {
            btns.forEach(b => b.classList.toggle('active', b.dataset.gender === gender));
            hidden.value = gender;
        };
        btns.forEach(btn => btn.addEventListener('click', () => select(btn.dataset.gender)));
        group.closest('form').addEventListener('reset', () => select(hidden.defaultValue));
    });

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
                    p.innerHTML =
                        "Venus may make single Capricorn natives think about an old lover today. Before letting your emotions take over and reach out to them, take your time to understand your feelings. Keep focusing on your self-growth.";
                } else if (p.innerHTML.includes("Venus shows a gradual improvement")) {
                    p.innerHTML =
                        "Venus shows a gradual improvement in your financial situation today. You could benefit from an old investment or something unexpected. Plan your budget wisely for the long term.";
                } else if (p.innerHTML.includes("Capricorn natives may hear something")) {
                    p.innerHTML =
                        "Capricorn natives may hear something related to work today that could leave them slightly disturbed. Instead of reacting immediately, stay calm and observe the situation before making any professional moves.";
                } else if (p.innerHTML.includes("A small change in your eating habits")) {
                    p.innerHTML =
                        "A small change in your eating habits could benefit your health today. AstroHero's astrologers advise you to focus on food that gives you energy and practice mindful eating throughout the day.";
                } else {
                    p.innerHTML = p.innerHTML.replace("... <strong>Read More</strong>",
                        " and focus on your long-term goals.");
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
        const dummyCategories = ['love', 'education', 'career', 'marriage', 'health', 'wealth', 'legal',
            'finance', 'remedies', 'parents'
        ];
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
                const matchesCategory = currentCategory === 'all' || cardCategories.includes(
                    currentCategory);

                if (matchesSearch && matchesCategory) {
                    card.style.display = 'flex';
                    // Trigger reflow for animation
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 50);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(10px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
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
