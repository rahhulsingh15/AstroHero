@extends('frontend.layouts.master')
@section('title', 'Love Report | Find Your Love Compatibility')
@section('content')

    <!-- Loading Popup -->
    <div id="report-loading-popup" class="loading-overlay">
        <div class="loading-hearts" aria-hidden="true">
            <span>❤</span><span>❤</span><span>❤</span><span>❤</span><span>❤</span><span>❤</span><span>❤</span><span>❤</span>
        </div>

        <div class="loading-content">
            <div class="loading-left">
                <div class="loading-circle">
                    <svg viewBox="0 0 100 100">
                        <defs>
                            <linearGradient id="loading-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#ff9fbe"></stop>
                                <stop offset="55%" stop-color="#ee4e6e"></stop>
                                <stop offset="100%" stop-color="#c81e48"></stop>
                            </linearGradient>
                        </defs>
                        <circle class="bg-circle" cx="50" cy="50" r="45"></circle>
                        <circle class="bg-circle-inner" cx="50" cy="50" r="37"></circle>
                        <circle class="progress-circle" id="anim-ring" cx="50" cy="50" r="45"></circle>
                    </svg>
                    <div class="loading-names-inner">
                        <div class="name-initial">{{ mb_substr($name1, 0, 1) }}</div>
                        <div class="loading-heart">❤️</div>
                        <div class="name-initial">{{ mb_substr($name2, 0, 1) }}</div>
                    </div>
                </div>
                <div class="loading-percentage"><span id="anim-percentage">0</span><small>%</small></div>
                <div class="loading-names">{{ $name1 }} <span>&amp;</span> {{ $name2 }}</div>
                <div class="loading-caption">Calculating your love compatibility…</div>
            </div>

            <div class="loading-steps" id="anim-steps">
                <div class="step active"><span class="dot"></span> Converting your names into numbers</div>
                <div class="step pending"><span class="dot"></span> Matching your numerology vibrations</div>
                <div class="step pending"><span class="dot"></span> Weighing the naam-milan letters</div>
                <div class="step pending"><span class="dot"></span> Sealing your compatibility score</div>
                <div class="loading-bar"><span id="anim-bar"></span></div>
            </div>
        </div>
    </div>
    <!-- Main Report Page -->
    <section class="report-main-section" style="display: none;" id="report-content-view">
        <div class="container">
            <div class="report-header">
                <a href="{{ route('love-calculator') }}" class="back-link">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                    Back to Calculator
                </a>
            </div>

            <div class="report-top-grid">
                <!-- Left: Gauge Card -->
                <div class="r-card gauge-card">
                    <div class="gauge-avatars">
                        <div class="g-avatar">
                            <div class="g-initial g-{{ $gender1 }}">{{ mb_substr($name1, 0, 1) }}</div>
                            <span class="g-name">{{ $name1 }}</span>
                        </div>
                        <div class="gauge-container">
                            <svg viewBox="0 0 200 120" class="report-gauge">
                                <defs>
                                    <linearGradient id="gauge-grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                        <stop offset="0%" stop-color="#ff9fbe"></stop>
                                        <stop offset="55%" stop-color="#ee4e6e"></stop>
                                        <stop offset="100%" stop-color="#c81e48"></stop>
                                    </linearGradient>
                                    <filter id="glow" x="-20%" y="-20%" width="140%" height="140%">
                                        <feGaussianBlur stdDeviation="4" result="blur" />
                                        <feComposite in="SourceGraphic" in2="blur" operator="over" />
                                    </filter>
                                </defs>
                                <path class="gauge-bg" d="M 20 100 A 80 80 0 0 1 180 100" fill="none"
                                    stroke="rgba(238,78,110,0.12)" stroke-width="15" stroke-linecap="round"></path>
                                <path class="gauge-fill" d="M 20 100 A 80 80 0 0 1 180 100" fill="none"
                                    stroke="url(#gauge-grad)" stroke-width="15" stroke-linecap="round"
                                    stroke-dasharray="251" stroke-dashoffset="251" filter="url(#glow)"></path>
                            </svg>
                            <div class="gauge-needle" style="transform: rotate(-90deg);">
                                <div class="needle-base"></div>
                            </div>
                            <div class="gauge-score">
                                <span class="score-num">{{ $percent }}%</span>
                                <span class="score-label">LOVE SCORE</span>
                            </div>
                            <div class="gauge-minmax">
                                <span>0%</span>
                                <span>100%</span>
                            </div>
                        </div>
                        <div class="g-avatar">
                            <div class="g-initial g-{{ $gender2 }}">{{ mb_substr($name2, 0, 1) }}</div>
                            <span class="g-name">{{ $name2 }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Description Card -->
                <div class="r-card desc-card">
                    <div class="desc-badge">❤ {{ $percent }}% — {{ $band['title'] }}</div>
                    <p class="desc-text">{{ $band['text'] }}</p>
                </div>
            </div>

            <!-- Banner Card -->
            <div class="banner-card">
                <div class="banner-content">
                    <div>
                        <span class="banner-tag">LIMITED-TIME OFFER</span>
                    <h2>Have Questions About Your Score?</h2>
                    <p>Ask our verified love astrologers anything about this calculation — what your numbers mean, where
                        the friction lies, and what to do next. Your first conversation is free.</p>
                    <a href="{{ route('chat-with-astrologers') }}" class="btn-primary banner-btn">Start a Free Chat →</a>
                    </div>
                </div>
                <div class="banner-images">
                    <div class="b-avatar pos-0"><img src="https://i.pravatar.cc/150?img=33" alt=""></div>
                    <div class="b-avatar pos-1 active"><img src="https://i.pravatar.cc/150?img=47" alt=""></div>
                    <div class="b-avatar pos-2"><img src="https://i.pravatar.cc/150?img=44" alt=""></div>
                </div>
            </div>

            <!-- Astrologer Grid -->
            <div class="astrologer-section">
                <div class="astro-header">
                    <h2>Talk to Love Experts</h2>
                    <a href="{{ route('talk-to-astrologers') }}" class="view-all">View all astrologers →</a>
                </div>
                <div class="astro-grid">
                    <!-- Astro Card 1 -->
                    <div class="astro-card">
                        <div class="ac-top">
                            <img src="https://i.pravatar.cc/150?img=33" class="ac-img" alt="">
                            <div class="ac-info">
                                <h4>Shatabisha <svg width="12" height="12" viewBox="0 0 24 24" fill="#e3b568">
                                        <path
                                            d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm-2 15l-5-5 1.4-1.4 3.6 3.6 7.6-7.6L19 8l-9 9z" />
                                    </svg></h4>
                                <p>English, Kannada</p>
                                <p>4 yrs</p>
                            </div>
                        </div>
                        <div class="ac-tags">
                            <span class="ac-tag">Vedic</span>
                        </div>
                        <div class="ac-stats">
                            <span><span class="ac-star">★</span> 5 · 500+</span>
                            <span class="ac-price"><strong>₹20</strong>/min</span>
                        </div>
                        <div class="ac-actions">
                            <button class="ac-btn"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg> Chat</button>
                            <button class="ac-btn"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg> Call</button>
                        </div>
                    </div>
                    <!-- Astro Card 2 -->
                    <div class="astro-card">
                        <div class="ac-top">
                            <img src="https://i.pravatar.cc/150?img=47" class="ac-img" alt="">
                            <div class="ac-info">
                                <h4>Voomika <svg width="12" height="12" viewBox="0 0 24 24" fill="#e3b568">
                                        <path
                                            d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm-2 15l-5-5 1.4-1.4 3.6 3.6 7.6-7.6L19 8l-9 9z" />
                                    </svg></h4>
                                <p>Hindi</p>
                                <p>8 yrs</p>
                            </div>
                        </div>
                        <div class="ac-tags">
                            <span class="ac-tag">Numerology</span><span class="ac-tag">Tarot</span>
                        </div>
                        <div class="ac-stats">
                            <span><span class="ac-star">★</span> 4.94 · 10k+</span>
                            <span class="ac-price"><strong>₹47</strong>/min</span>
                        </div>
                        <div class="ac-actions">
                            <button class="ac-btn"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg> Chat</button>
                            <button class="ac-btn"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg> Call</button>
                        </div>
                    </div>
                    <!-- Astro Card 3 -->
                    <div class="astro-card">
                        <div class="ac-top">
                            <img src="https://i.pravatar.cc/150?img=11" class="ac-img" alt="">
                            <div class="ac-info">
                                <h4>Senni <svg width="12" height="12" viewBox="0 0 24 24" fill="#e3b568">
                                        <path
                                            d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm-2 15l-5-5 1.4-1.4 3.6 3.6 7.6-7.6L19 8l-9 9z" />
                                    </svg></h4>
                                <p>English, Tamil</p>
                                <p>5 yrs</p>
                            </div>
                        </div>
                        <div class="ac-tags">
                            <span class="ac-tag">Vedic</span><span class="ac-tag">Life Coach</span>
                        </div>
                        <div class="ac-stats">
                            <span><span class="ac-star">★</span> 4.96 · 10k+</span>
                            <span class="ac-price"><strong>₹26</strong>/min</span>
                        </div>
                        <div class="ac-actions">
                            <button class="ac-btn"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg> Chat</button>
                            <button class="ac-btn"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg> Call</button>
                        </div>
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

        // Banner ki photos: har 2.5 second me ek jagah khisakti hain, agli photo beech me badi ho jaati hai
        (function () {
            const wrap = document.querySelector('.banner-images');
            if (!wrap) return;

            const avatars = Array.from(wrap.querySelectorAll('.b-avatar'));
            if (avatars.length !== 3) return;
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

            let step = 0;
            let timer = null;

            function slide() {
                step = (step + 1) % 3;
                avatars.forEach((avatar, i) => {
                    const pos = (i - step + 3) % 3;
                    avatar.classList.remove('pos-0', 'pos-1', 'pos-2');
                    avatar.classList.add('pos-' + pos);
                    avatar.classList.toggle('active', pos === 1);
                });
            }

            function start() {
                clearInterval(timer);
                timer = setInterval(slide, 2500);
            }

            // Cursor upar ho to ruk jaye
            wrap.addEventListener('mouseenter', () => clearInterval(timer));
            wrap.addEventListener('mouseleave', start);

            start();
        })();
    </script>
    <script>
        // Loading animation, then reveal the report
        const totalDuration = 3500;
        const targetPercent = {{ $percent }};

        // 1. Percentage counter, ring and bar move together
        const percentEl = document.getElementById('anim-percentage');
        const ringEl = document.getElementById('anim-ring');
        const barEl = document.getElementById('anim-bar');
        const ringLength = 283;
        let startTimestamp = null;
        const stepAnim = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / totalDuration, 1);
            // Easing function for smoother counter (ease-out cubic)
            const easeOutProgress = 1 - Math.pow(1 - progress, 3);
            percentEl.innerText = Math.floor(easeOutProgress * targetPercent);
            ringEl.style.strokeDashoffset = ringLength - ringLength * easeOutProgress * targetPercent / 100;
            barEl.style.width = (progress * 100) + '%';
            if (progress < 1) {
                window.requestAnimationFrame(stepAnim);
            }
        };
        window.requestAnimationFrame(stepAnim);

        // 2. Steps sequence animation
        const steps = document.querySelectorAll('#anim-steps .step');
        const timePerStep = totalDuration / steps.length;

        steps.forEach((step, index) => {
            if (index === 0) return; // first is already active
            setTimeout(() => {
                // Mark previous as done
                steps[index - 1].classList.remove('active');
                steps[index - 1].classList.add('done');

                // Mark current as active
                step.classList.remove('pending');
                step.classList.add('active');
            }, index * timePerStep);
        });

        // 3. Hide popup and show report after duration
        setTimeout(() => {
            const popup = document.getElementById('report-loading-popup');
            const contentView = document.getElementById('report-content-view');

            if (popup && contentView) {
                steps[steps.length - 1].classList.replace('active', 'done');

                // Fade out effect
                popup.style.transition = 'opacity 0.5s';
                popup.style.opacity = '0';

                setTimeout(() => {
                    popup.style.display = 'none';
                    contentView.style.display = 'block';

                    // Trigger gauge animation
                    setTimeout(() => {
                        const needle = document.querySelector('.gauge-needle');
                        const gaugeFill = document.querySelector('.gauge-fill');
                        if (needle) {
                            needle.style.transform = 'rotate(' + (targetPercent * 1.8 - 90) + 'deg)';
                        }
                        if (gaugeFill) {
                            gaugeFill.style.transition = 'stroke-dashoffset 1s ease-out';
                            gaugeFill.style.strokeDashoffset = 251 - 251 * targetPercent / 100;
                        }
                    }, 100);
                }, 500);
            }
        }, totalDuration);
    </script>
@endsection
