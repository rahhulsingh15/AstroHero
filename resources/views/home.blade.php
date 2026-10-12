@extends('frontend.layouts.master')
@section('title', 'AstroHero — Talk to Astrologers, Free Kundli & Daily Horoscope')
@section('content')
<section class="hero_section">
    <div class="grid">
        <div class="left">
            <div class="eyebrow"><span class="dot"></span>{{ $hero->eyebrow_text ?? '' }}
            </div>
            <h1>Your stars, answered<br>by <em>India's finest astrologers</em>.</h1>
            <p class="lead">{{ $hero->lead_text ?? " " }}</p>
            <div class="cta-row">
                <a href="{{ $hero->btn1_link ?? '#' }}"
                    class="btn btn-primary">{{ $hero->btn1_title ?? '' }}</a>
                <a href="{{ $hero->btn2_link ?? '#' }}"
                    class="btn btn-outline">{{ $hero->btn2_title ?? '' }}</a>
            </div>
            <div class="stats">
                <div class="stat">
                    <b>{{ $hero->stat1_value ?? '' }}</b><span>{{ $hero->stat1_label ?? '' }}</span>
                </div>
                <div class="stat">
                    <b>{{ $hero->stat2_value ?? '' }}</b><span>{{ $hero->stat2_label ?? '' }}</span>
                </div>
                <div class="stat">
                    <b>{{ $hero->stat3_value ?? '' }}</b><span>{{ $hero->stat3_label ?? '' }}</span>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="kundli-wheel-container">
                <div class="kundli-wheel-wrapper">
                    <svg viewBox="0 0 500 500" class="kundli-svg" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <radialGradient id="kundliBg" cx="50%" cy="50%" r="50%">
                                <stop offset="0%" stop-color="#12163b" />
                                <stop offset="60%" stop-color="#090b21" />
                                <stop offset="100%" stop-color="#040511" />
                            </radialGradient>

                            <linearGradient id="goldRim" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#fff5dc" />
                                <stop offset="35%" stop-color="#e3b568" />
                                <stop offset="75%" stop-color="#c48f37" />
                                <stop offset="100%" stop-color="#8a611c" />
                            </linearGradient>

                            <radialGradient id="centerLotusGlow" cx="50%" cy="50%" r="50%">
                                <stop offset="0%" stop-color="rgba(242, 217, 168, 0.45)" />
                                <stop offset="50%" stop-color="rgba(227, 181, 104, 0.18)" />
                                <stop offset="100%" stop-color="rgba(8, 10, 31, 0)" />
                            </radialGradient>

                            <linearGradient id="lotusPetalGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#ffffff" />
                                <stop offset="30%" stop-color="#f2d9a8" />
                                <stop offset="70%" stop-color="#e3b568" />
                                <stop offset="100%" stop-color="#4a151b" />
                            </linearGradient>
                        </defs>

                        <!-- Background Disc with Gold Border -->
                        <circle cx="250" cy="250" r="242" fill="url(#kundliBg)" stroke="url(#goldRim)"
                            stroke-width="2" />
                        <circle cx="250" cy="250" r="236" stroke="url(#goldRim)" stroke-width="0.8"
                            stroke-dasharray="1 3" opacity="0.6" />

                        <!-- Today's Moon rashi: the sector for index 0 (मेष), turned 30° per sign -->
                        @php
                            $rashiHindi = ['Aries' => 'मेष', 'Taurus' => 'वृषभ', 'Gemini' => 'मिथुन', 'Cancer' => 'कर्क', 'Leo' => 'सिंह', 'Virgo' => 'कन्या', 'Libra' => 'तुला', 'Scorpio' => 'वृश्चिक', 'Sagittarius' => 'धनु', 'Capricorn' => 'मकर', 'Aquarius' => 'कुम्भ', 'Pisces' => 'मीन'];
                            $moonIndex = array_search($moonSign ?? '', array_keys($rashiHindi));
                        @endphp
                        @if ($moonIndex !== false)
                            <path class="kundli-moon-sector" transform="rotate({{ $moonIndex * 30 }} 250 250)"
                                d="M189.44,23.97 A234,234 0 0 1 310.56,23.97 L295.55,80 A176,176 0 0 0 204.45,80 Z" />
                            <style>
                                .kundli-rashi-names text:nth-child({{ $moonIndex + 1 }}) { fill: #f2d9a8; font-weight: 700; }
                            </style>
                        @endif

                        <!-- Outer Raashi Sector Divisions (12 lines from r=176 to r=234) -->
                        <g stroke="url(#goldRim)" stroke-width="1.2" opacity="0.65">
                            <line x1="419.0" y1="295.3" x2="478.0" y2="311.1" />
                            <line x1="373.7" y1="373.7" x2="416.9" y2="416.9" />
                            <line x1="295.3" y1="419.0" x2="311.1" y2="478.0" />
                            <line x1="204.7" y1="419.0" x2="188.9" y2="478.0" />
                            <line x1="126.3" y1="373.7" x2="83.1" y2="416.9" />
                            <line x1="81.0" y1="295.3" x2="22.0" y2="311.1" />
                            <line x1="81.0" y1="204.7" x2="22.0" y2="188.9" />
                            <line x1="126.3" y1="126.3" x2="83.1" y2="83.1" />
                            <line x1="204.7" y1="81.0" x2="188.9" y2="22.0" />
                            <line x1="295.3" y1="81.0" x2="311.1" y2="22.0" />
                            <line x1="373.7" y1="126.3" x2="416.9" y2="83.1" />
                            <line x1="419.0" y1="204.7" x2="478.0" y2="188.9" />
                        </g>

                        <!-- Outer & Inner Concentric Rings for Raashi Track -->
                        <circle cx="250" cy="250" r="234" stroke="url(#goldRim)" stroke-width="1.2" fill="none" />
                        <circle cx="250" cy="250" r="176" stroke="url(#goldRim)" stroke-width="1.2" fill="none" />

                        <!-- 12 Raashi Hindi Names -->
                        <g class="kundli-rashi-names" fill="#f3efe4" font-size="14" font-weight="600" text-anchor="middle"
                            dominant-baseline="central" font-family="'Inter', system-ui, sans-serif">
                            <text x="250" y="47.5">मेष</text>
                            <text x="351.2" y="74.6">वृषभ</text>
                            <text x="425.4" y="148.8">मिथुन</text>
                            <text x="452.5" y="250">कर्क</text>
                            <text x="425.4" y="351.2">सिंह</text>
                            <text x="351.2" y="425.4">कन्या</text>
                            <text x="250" y="452.5">तुला</text>
                            <text x="148.8" y="425.4">वृश्चिक</text>
                            <text x="74.6" y="351.2">धनु</text>
                            <text x="47.5" y="250">मकर</text>
                            <text x="74.6" y="148.8">कुम्भ</text>
                            <text x="148.8" y="74.6">मीन</text>
                        </g>

                        <!-- Middle Orbit Track & Border -->
                        <circle cx="250" cy="250" r="144" stroke="url(#goldRim)" stroke-width="1" stroke-dasharray="2 4"
                            opacity="0.6" fill="none" />
                        <circle cx="250" cy="250" r="118" stroke="url(#goldRim)" stroke-width="1.2" fill="none" />

                        <g class="kundli-planets">
                        <!-- Planetary Glyphs & Positions on Orbit (r=144) -->
                        <!-- ☉ Sun -->
                        <g transform="translate(250, 106)">
                            <circle cx="0" cy="0" r="10" fill="#080a1f" stroke="url(#goldRim)" stroke-width="1.5" />
                            <circle cx="0" cy="0" r="3" fill="#e3b568" />
                        </g>

                        <!-- ☽ Moon -->
                        <g transform="translate(375, 177)">
                            <text fill="#f2d9a8" font-size="18" text-anchor="middle"
                                dominant-baseline="central">☽</text>
                        </g>

                        <!-- ♂ Mars -->
                        <g transform="translate(394, 250)">
                            <text fill="#e3b568" font-size="17" text-anchor="middle"
                                dominant-baseline="central">♂</text>
                        </g>

                        <!-- ☋ Ketu -->
                        <g transform="translate(343, 343)">
                            <text fill="#f2d9a8" font-size="16" text-anchor="middle"
                                dominant-baseline="central">☋</text>
                        </g>

                        <!-- ☿ Mercury -->
                        <g transform="translate(290, 388)">
                            <text fill="#e3b568" font-size="17" text-anchor="middle"
                                dominant-baseline="central">☿</text>
                        </g>

                        <!-- ♃ Jupiter -->
                        <g transform="translate(250, 394)">
                            <text fill="#f2d9a8" font-size="18" text-anchor="middle"
                                dominant-baseline="central">♃</text>
                        </g>

                        <!-- ♀ Venus -->
                        <g transform="translate(157, 343)">
                            <text fill="#e3b568" font-size="17" text-anchor="middle"
                                dominant-baseline="central">♀</text>
                        </g>

                        <!-- ♄ Saturn -->
                        <g transform="translate(106, 250)">
                            <text fill="#b6a6ff" font-size="17" text-anchor="middle"
                                dominant-baseline="central">t</text>
                        </g>

                        <!-- ☊ Rahu -->
                        <g transform="translate(157, 157)">
                            <text fill="#f2d9a8" font-size="16" text-anchor="middle"
                                dominant-baseline="central">☊</text>
                        </g>

                        </g>

                        <!-- Sacred Geometry Mandala Core ($r \le 118$) -->
                        <circle cx="250" cy="250" r="106" stroke="rgba(227, 181, 104, 0.4)" stroke-width="1"
                            stroke-dasharray="2 3" fill="none" />

                        <!-- Intersecting 12-Pointed Star Lattice Polygons -->
                        <g class="kundli-mandala" stroke="url(#goldRim)" stroke-width="0.9" fill="none" opacity="0.45">
                            <rect x="175" y="175" width="150" height="150" transform="rotate(0 250 250)" />
                            <rect x="175" y="175" width="150" height="150" transform="rotate(30 250 250)" />
                            <rect x="175" y="175" width="150" height="150" transform="rotate(60 250 250)" />

                            <polygon points="250,140 345,305 155,305" transform="rotate(0 250 250)" />
                            <polygon points="250,140 345,305 155,305" transform="rotate(60 250 250)" />
                            <polygon points="250,140 345,305 155,305" transform="rotate(120 250 250)" />
                            <polygon points="250,140 345,305 155,305" transform="rotate(180 250 250)" />
                            <polygon points="250,140 345,305 155,305" transform="rotate(240 250 250)" />
                            <polygon points="250,140 345,305 155,305" transform="rotate(300 250 250)" />
                        </g>

                        <!-- Light travelling round the gold rim -->
                        <g class="kundli-shine">
                            <circle cx="250" cy="250" r="242" stroke="#e3b568" stroke-width="3" stroke-dasharray="170 1351" />
                            <circle cx="250" cy="250" r="242" stroke="#fff5dc" stroke-width="3.5" stroke-dasharray="60 1461" stroke-dashoffset="-110" />
                        </g>

                        <!-- Center Glow Base Circle -->
                        <circle class="kundli-glow" cx="250" cy="250" r="54" fill="url(#centerLotusGlow)" stroke="url(#goldRim)"
                            stroke-width="1.2" opacity="0.9" />

                        <!-- Center Sacred Lotus Blossom Icon -->
                        <g transform="translate(250, 250) scale(1.35)"><g class="kundli-center">
                            <path d="M0,-24 C6,-12 8,-4 0,4 C-8,-4 -6,-12 0,-24 Z" fill="url(#lotusPetalGrad)"
                                stroke="#ffffff" stroke-width="0.5" />
                            <path d="M-4,-20 C-14,-10 -16,-2 -8,4 C-2,-1 0,-8 -4,-20 Z" fill="url(#lotusPetalGrad)"
                                stroke="#f2d9a8" stroke-width="0.4" />
                            <path d="M4,-20 C14,-10 16,-2 8,4 C2,-1 0,-8 4,-20 Z" fill="url(#lotusPetalGrad)"
                                stroke="#f2d9a8" stroke-width="0.4" />
                            <path d="M-10,-14 C-22,-4 -22,6 -12,8 C-6,3 -4,-4 -10,-14 Z" fill="url(#lotusPetalGrad)"
                                opacity="0.9" />
                            <path d="M10,-14 C22,-4 22,6 12,8 C6,3 4,-4 10,-14 Z" fill="url(#lotusPetalGrad)"
                                opacity="0.9" />
                            <path d="M-18,4 C-10,12 10,12 18,4 C12,14 -12,14 -18,4 Z" fill="#2d0b12"
                                stroke="url(#goldRim)" stroke-width="0.8" />
                        </g></g>
                    </svg>
                </div>

                <!-- Floating Glass Cards Overlay -->
                <div class="glass-card chat-card">
                    <div class="avatar">RS</div>
                    <div>
                        <div class="name">Rahul Singh</div>
                        <div class="status"><i></i>Online · replies instantly</div>
                    </div>
                </div>
                @if ($moonIndex !== false)
                    <div class="glass-card moon-card">
                        <span class="moon-icon">☽</span>
                        <div>
                            <div class="label">Moon today</div>
                            <div class="sign">{{ $rashiHindi[$moonSign] }} <small>{{ $moonSign }}</small></div>
                        </div>
                    </div>
                @endif
                <div class="glass-card match-card">
                    <div class="label">Kundli Match</div>
                    <div class="score">{{ $hero->match_score ?? '' }}<small>/36
                            guna</small></div>
                    <div class="bar">
                        <i
                            style="width: {{ round((($hero->match_score ?? 30) / 36) * 100) }}%;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="today_is_yours">
    @php
        // Images mapping for the 12 signs in exact sequence
        $signImages = [
        'Aries' => 'horoscope-01.avif',
        'Taurus' => 'horoscope-02.avif',
        'Gemini' => 'horoscope-03.avif',
        'Cancer' => 'horoscope-04.avif',
        'Leo' => 'horoscope-05.avif',
        'Virgo' => 'horoscope-06.avif',
        'Libra' => 'horoscope-07.avif',
        'Scorpio' => 'horoscope-08.avif',
        'Sagittarius' => 'horoscope-09.avif',
        'Capricorn' => 'horoscope-10.avif',
        'Aquarius' => 'horoscope-11.avif',
        'Pisces' => 'horoscope-12.avif',
        ];
        $active = $activeHoroscope ?? ($allSigns->first() ?? null);
    @endphp
    <div class="container">
        <!-- Section Header Row -->
        <div class="horoscope-header-row">
            <div class="horoscope-header-left">
                <span class="horoscope-eyebrow">YOUR DAILY HOROSCOPE</span>
                <h2 class="horoscope-main-title">Your daily <em class="gold-text">horoscope</em> reading</h2>
                <p class="horoscope-subtitle">Pick your raashi to see today's pillars at a glance.</p>
            </div>
            <div class="horoscope-time-pills">
                <button class="time-pill active" data-period="Today">Today</button>
                <button class="time-pill" data-period="Tomorrow">Tomorrow</button>
                <button class="time-pill" data-period="Week">Week</button>
                <button class="time-pill" data-period="Month">Month</button>
            </div>
        </div>

        <!-- 12 Raashi Selector Cards Row -->
        <div class="raashi-selector-wrapper">
            <div class="raashi-cards-grid" id="raashi-cards-container">
                @foreach($allSigns as $index => $sign)
                    @php
                        $imgFile = $signImages[$sign->sign_name] ?? 'horoscope-01.avif';
                    @endphp
                    <div class="raashi-card {{ ($active && $active->sign_name == $sign->sign_name) ? 'active' : '' }}">
                        <div class="raashi-avatar">
                            <img src="{{ asset('assets/images/' . $imgFile) }}"
                                alt="{{ $sign->sign_name ?? '' }}">
                        </div>
                        <div class="raashi-name">{{ $sign->sign_name ?? '' }}</div>
                        <div class="raashi-hindi">{{ $sign->hindi_name ?? '' }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Auto Slider Progress Bar with Arrows -->
        <!-- <div class="raashi-progress-container" style="display: flex; align-items: center; gap: 10px; margin-top: 15px;">
                <button type="button" id="raashi-prev-btn" style="background: none; border: none; color: #e3b568; cursor: pointer; font-size: 14px;">&#9664;</button>
                <div style="flex-grow: 1; height: 3px; background: rgba(227, 181, 104, 0.2); border-radius: 4px; overflow: hidden; position: relative;">
                    <div id="raashi-progress-fill" style="width: 0%; height: 100%; background: #e3b568; transition: width 0.1s linear;"></div>
                </div>
                <button type="button" id="raashi-next-btn" style="background: none; border: none; color: #e3b568; cursor: pointer; font-size: 14px;">&#9654;</button>
            </div> -->
        @if($active)
            <!-- Detail Reading Box -->
            <div class="horoscope-detail-box" id="horoscope-detail-box">
                <div class="detail-header-row">
                    <div class="detail-sign-info">
                        <div class="detail-avatar">
                            <img id="detail-img"
                                src="{{ asset('assets/images/' . ($signImages[$active->sign_name] ?? 'horoscope-01.avif')) }}"
                                alt="{{ $active->sign_name }}">
                        </div>
                        <div class="detail-sign-text">
                            <h3 id="detail-title">{{ $active->sign_name ?? '' }} <span
                                    id="detail-hindi">{{ $active->hindi_name ?? '' }}</span>
                            </h3>
                            <span class="date-range"
                                id="detail-dates">{{ $active->date_range ?? '' }}</span>
                        </div>
                    </div>
                    <div class="detail-date-badge" id="detail-date-badge">
                        Today ·
                        {{ \Carbon\Carbon::parse($active->horoscope_date)->format('d M Y') }}
                    </div>
                </div>

                <div class="detail-body-grid">
                    <div class="detail-left-col">
                        <p class="reading-desc" id="detail-reading-text">
                            {{ \Illuminate\Support\Str::limit($active->reading ?? '', 20, '...') }}
                        </p>
                        <div class="meta-pills-row">
                            <span class="meta-item">Mood: <strong
                                    id="detail-mood">{{ $active->mood ?? '' }}</strong></span>
                            <span class="meta-item">Lucky #: <strong
                                    id="detail-lucky">{{ $active->lucky_number ?? '' }}</strong></span>
                            <span class="meta-item">Color: <span class="color-swatch" id="detail-color-swatch"
                                    style="background: {{ $active->lucky_color ?? '' }};"></span></span>
                        </div>
                        <div class="detail-action-buttons">
                            {{-- Jisme current sign ka variable ho --}}
                            <a href="{{ route('horoscope.detail', ['period' => 'daily', 'sign' => strtolower($activeHoroscope->sign_name ?? 'aries')]) }}"
                                id="detail-horoscope-btn"
                                class="btn btn-primary">
                                Get my detailed horoscope &rarr;
                            </a>
                            <a href="#" class="btn btn-outline">Talk to a specialist</a>
                        </div>
                    </div>

                    <div class="detail-right-col">
                        <div class="pillars-box">
                            <!-- Love -->
                            <div class="pillar-row">
                                <div class="pillar-meta">
                                    <span class="pillar-label">LOVE</span>
                                    <span class="pillar-status"
                                        id="status-love">{{ $active->love_status ?? '' }}
                                        ({{ $active->love_percent ?? '' }}%)</span>
                                </div>
                                <div class="pillar-bar-bg">
                                    <div class="pillar-bar-fill bar-love" id="bar-love"
                                        style="width: {{ $active->love_percent ?? '' }}%;">
                                    </div>
                                </div>
                            </div>
                            <!-- Career -->
                            <div class="pillar-row">
                                <div class="pillar-meta">
                                    <span class="pillar-label">CAREER</span>
                                    <span class="pillar-status"
                                        id="status-career">{{ $active->career_status ?? '' }}
                                        ({{ $active->career_percent ?? '' }}%)</span>
                                </div>
                                <div class="pillar-bar-bg">
                                    <div class="pillar-bar-fill bar-career" id="bar-career"
                                        style="width: {{ $active->career_percent ?? '' }}%;">
                                    </div>
                                </div>
                            </div>
                            <!-- Health -->
                            <div class="pillar-row">
                                <div class="pillar-meta">
                                    <span class="pillar-label">HEALTH</span>
                                    <span class="pillar-status"
                                        id="status-health">{{ $active->health_status ?? '' }}
                                        ({{ $active->health_percent ?? '' }}%)</span>
                                </div>
                                <div class="pillar-bar-bg">
                                    <div class="pillar-bar-fill bar-health" id="bar-health"
                                        style="width: {{ $active->health_percent ?? '' }}%;">
                                    </div>
                                </div>
                            </div>
                            <!-- Money -->
                            <div class="pillar-row">
                                <div class="pillar-meta">
                                    <span class="pillar-label">MONEY</span>
                                    <span class="pillar-status"
                                        id="status-money">{{ $active->money_status ?? '' }}
                                        ({{ $active->money_percent ?? '' }}%)</span>
                                </div>
                                <div class="pillar-bar-bg">
                                    <div class="pillar-bar-fill bar-money" id="bar-money"
                                        style="width: {{ $active->money_percent ?? '' }}%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
<section class="expert-astrologers">
    <div class="container">
        <div class="expert-astrologers-header">
            <span class="expert-astrologers-subtitle">Connect Instantly</span>
            <h2 class="expert-astrologers-title">Our Premium Astrologers</h2>
        </div>

        <div class="expert-marquee-container">
            <!-- Top Marquee (Left Scrolling) -->
            <div class="expert-marquee expert-marquee-left">
                <div class="marquee-content" id="mq-left">
                    <!-- Card 1 -->
                    <div class="expert-astrologers-card premium-card">
                        <div class="expert-badge">Top Rated</div>
                        <div class="expert-astrologers-avatar-wrapper">
                            <div class="expert-astrologers-avatar"><img
                                    src="{{ asset('assets/images/chatimg1.png') }}" alt="Astrologer"
                                    width="100%">
                            </div>
                            <span class="online-indicator"></span>
                        </div>
                        <h3 class="expert-astrologers-name">Dr. Aradhana</h3>
                        <p class="expert-astrologers-skills">Vedic, Tarot, Vastu</p>
                        <p class="expert-astrologers-lang">English, Hindi</p>
                        <div class="expert-astrologers-meta">
                            <span class="expert-astrologers-rating"><svg width="14" height="14" viewBox="0 0 24 24"
                                    fill="currentColor" stroke="none" style="vertical-align: middle; margin-top: -2px;">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg> 4.9 <small>(12k+)</small></span>
                            <span class="expert-astrologers-price">₹25/min</span>
                        </div>
                        <div class="expert-astrologers-actions">
                            <button class="btn-outline"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    style="vertical-align: middle; margin-right: 5px; margin-top:-2px;">
                                    <path
                                        d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                    </path>
                                </svg> Chat</button>
                            <button class="btn-primary"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    style="vertical-align: middle; margin-right: 5px; margin-top:-2px;">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg> Call</button>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="expert-astrologers-card">
                        <div class="expert-astrologers-avatar-wrapper">

                            <div class="expert-astrologers-avatar"
                                style="background: linear-gradient(135deg, #f2d9a8, #e3b568); color: var(--navy-deep);">
                                <img src="{{ asset('assets/images/chatimg2.png') }}" alt="Astrologer"
                                    width="100%">
                            </div>
                            <span class="online-indicator"></span>
                        </div>
                        <h3 class="expert-astrologers-name">Meera Sharma</h3>
                        <p class="expert-astrologers-skills">Vedic, Numerology</p>
                        <p class="expert-astrologers-lang">Hindi, Sanskrit</p>
                        <div class="expert-astrologers-meta">
                            <span class="expert-astrologers-rating"><svg width="14" height="14" viewBox="0 0 24 24"
                                    fill="currentColor" stroke="none" style="vertical-align: middle; margin-top: -2px;">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg> 4.8 <small>(8k+)</small></span>
                            <span class="expert-astrologers-price">₹20/min</span>
                        </div>
                        <div class="expert-astrologers-actions">
                            <button class="btn-outline"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    style="vertical-align: middle; margin-right: 5px; margin-top:-2px;">
                                    <path
                                        d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                    </path>
                                </svg> Chat</button>
                            <button class="btn-primary"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    style="vertical-align: middle; margin-right: 5px; margin-top:-2px;">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg> Call</button>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="expert-astrologers-card trending-card">
                        <div class="expert-badge trending">Trending</div>
                        <div class="expert-astrologers-avatar-wrapper">
                            <div class="expert-astrologers-avatar"
                                style="background: linear-gradient(135deg, #a7a4c2, #7a68d9);"> <img
                                    src="{{ asset('assets/images/chatimg3.png') }}" alt="Astrologer"
                                    width="100%"></div>
                            <span class="online-indicator"></span>





                        </div>
                        <h3 class="expert-astrologers-name">Riya Singh</h3>
                        <p class="expert-astrologers-skills">Tarot, Psychic Reading</p>
                        <p class="expert-astrologers-lang">English</p>
                        <div class="expert-astrologers-meta">
                            <span class="expert-astrologers-rating"><svg width="14" height="14" viewBox="0 0 24 24"
                                    fill="currentColor" stroke="none" style="vertical-align: middle; margin-top: -2px;">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg> 5.0 <small>(5k+)</small></span>
                            <span class="expert-astrologers-price">₹30/min</span>
                        </div>
                        <div class="expert-astrologers-actions">
                            <button class="btn-outline"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    style="vertical-align: middle; margin-right: 5px; margin-top:-2px;">
                                    <path
                                        d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                    </path>
                                </svg> Chat</button>
                            <button class="btn-primary"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    style="vertical-align: middle; margin-right: 5px; margin-top:-2px;">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg> Call</button>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="expert-astrologers-card">
                        <div class="expert-astrologers-avatar-wrapper">
                            <div class="expert-astrologers-avatar"
                                style="background: linear-gradient(135deg, #5fd8a0, #2a2960);"> <img
                                    src="{{ asset('assets/images/chatimg4.png') }}  " alt="Astrologer"
                                    width="100%"></div>
                            <span class="online-indicator"></span>
                        </div>
                        <h3 class="expert-astrologers-name">Kavya Verma</h3>
                        <p class="expert-astrologers-skills">Vedic, KP Astrology</p>
                        <p class="expert-astrologers-lang">English, Hindi, Marathi</p>
                        <div class="expert-astrologers-meta">
                            <span class="expert-astrologers-rating"><svg width="14" height="14" viewBox="0 0 24 24"
                                    fill="currentColor" stroke="none" style="vertical-align: middle; margin-top: -2px;">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg> 4.7 <small>(10k+)</small></span>
                            <span class="expert-astrologers-price">₹15/min</span>
                        </div>
                        <div class="expert-astrologers-actions">
                            <button class="btn-outline"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    style="vertical-align: middle; margin-right: 5px; margin-top:-2px;">
                                    <path
                                        d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                    </path>
                                </svg> Chat</button>
                            <button class="btn-primary"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    style="vertical-align: middle; margin-right: 5px; margin-top:-2px;">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg> Call</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
@if($categories->isNotEmpty())
<section class="astrologer_fiter_section">
    <div class="container">
        <div class="filter-section-header">
            <div class="filter-header-left">
                <span class="sub-title">BROWSE BY CATEGORY</span>
                <h2 class="section-title">Find the right astrologer, <span class="highlight">for You</span></h2>
            </div>
        </div>

        <div class="category-grid">
            @foreach($categories as $category)
                <a href="{{ route('chat-with-astrologers') }}" class="category-card card-{{ $category->color }}">
                    <div class="card-left">
                        <div class="card-icon-badge">
                            @include('frontend.partials.home-icon', ['icon' => $category->icon, 'size' => 22, 'stroke' => 2])
                        </div>
                        <div class="card-content">
                            <h3 class="category-name">{{ $category->name }}</h3>
                            <span class="astro-count">{{ $category->astro_count }}</span>
                        </div>
                    </div>
                    <div class="card-arrow">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@if($serviceRows->isNotEmpty())
<section class="services_slider_section">
    <div class="container">
        <div class="services-header">
            <span class="sub-title">OUR SERVICES</span>
            <h2 class="section-title">Our <span class="highlight">Services</span></h2>
        </div>
    </div>

    {{-- Row 1 left scroll karti hai, Row 2 right. Infinite loop ke liye har row ke cards do baar (kam cards hon to chaar baar) print hote hain --}}
    @foreach($serviceRows as $rowNumber => $rowServices)
        <div class="services-slider-wrapper">
            <div class="services-track {{ $rowNumber == 1 ? 'track-left' : 'track-right' }}">
                @foreach(range(1, $rowServices->count() < 5 ? 4 : 2) as $copy)
                    @foreach($rowServices as $service)
                        <a href="{{ $service->link ?: '#' }}" class="service-card">
                            <div class="service-card-left">
                                <div class="service-icon-box">
                                    @include('frontend.partials.home-icon', ['icon' => $service->icon, 'size' => 24, 'stroke' => 1.8])
                                </div>
                                <div class="service-info">
                                    <h3 class="service-title">{{ $service->title }}</h3>
                                    <p class="service-desc">{{ $service->description }}</p>
                                </div>
                            </div>
                            <div class="service-arrow">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </div>
                        </a>
                    @endforeach
                @endforeach
            </div>
        </div>
    @endforeach
</section>
@endif
<section class="testimonials_section">
    <!-- Decorative Background Glows -->
    <div class="testimonials-ambient-glow left-glow"></div>
    <div class="testimonials-ambient-glow right-glow"></div>

    <div class="container">
        <div class="testimonials-grid">
            <!-- Left Content Column -->
            <div class="testimonials-left">
                <span class="sub-title">TESTIMONIALS</span>
                <h2 class="section-title">Real people.<br><span class="highlight">Real</span> reviews.</h2>

                <div class="rating-overall-card">
                    <div class="rating-score">4.8</div>
                    <div class="rating-meta">
                        <div class="stars-row">★★★★★</div>
                        <span class="based-on">Based on 5L+ verified consultations</span>
                    </div>
                </div>

                <p class="testimonials-desc">
                    Join millions of satisfied users who trust our expert astrologers for accurate predictions and
                    life guidance.
                </p>

                <div class="testimonials-nav">
                    <button class="nav-btn prev-btn" id="prevReviewBtn" aria-label="Previous Review">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                    </button>
                    <div class="nav-dots-wrapper">
                        <div class="nav-dots" id="reviewDots">
                            <span class="dot active" data-index="0"></span>
                            <span class="dot" data-index="1"></span>
                            <span class="dot" data-index="2"></span>
                            <span class="dot" data-index="3"></span>
                        </div>
                        <span class="nav-counter" id="reviewCounter">1 / 4</span>
                    </div>
                    <button class="nav-btn next-btn" id="nextReviewBtn" aria-label="Next Review">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Right Review Card Column -->
            <div class="testimonials-right">
                <div class="review-card-container">
                    <div class="review-card active">
                        <div class="card-top-bar">
                            <div class="review-stars">★★★★★</div>
                            <span class="verified-tag">✓ Verified User</span>
                        </div>
                        <div class="quote-icon">“</div>
                        <p class="review-text">
                            “This app helped me to get a job in my dream company. I was stressed about not getting a
                            career opportunity after my graduation. One prediction from an astrologer gave me a ray
                            of hope and within a few months, I had a job offer in hand. Thank you so much for
                            helping me out.”
                        </p>
                        
                        <div class="review-user">
                            <div class="user-avatar">
                                <img src="{{ asset('assets/images/unsplash1.avif') }}"
                                    alt="Amar Thakur">
                            </div>
                            <div class="user-details">
                                <h4 class="user-name">Amar Thakur</h4>
                                <span class="user-location">Pune · India</span>
                            </div>
                        </div>
                    </div>

                    <div class="review-card">
                        <div class="card-top-bar">
                            <div class="review-stars">★★★★★</div>
                            <span class="verified-tag">✓ Verified User</span>
                        </div>
                        <div class="quote-icon">“</div>
                        <p class="review-text">
                            “I was having serious doubts regarding my marriage alignment. The detailed Kundli
                            analysis provided complete clarity and peace of mind. Everything predicted turned out
                            100% accurate!”
                        </p>
                        <div class="review-user">
                            <div class="user-avatar">
                                <img src="{{ asset('assets/images/unsplash2.avif') }}"
                                    alt="Priya Sharma">
                            </div>
                            <div class="user-details">
                                <h4 class="user-name">Priya Sharma</h4>
                                <span class="user-location">Delhi · India</span>
                            </div>
                        </div>
                    </div>

                    <div class="review-card">
                        <div class="card-top-bar">
                            <div class="review-stars">★★★★★</div>
                            <span class="verified-tag">✓ Verified User</span>
                        </div>
                        <div class="quote-icon">“</div>
                        <p class="review-text">
                            “The business guidance I received saved me from making a risky financial investment. The
                            astrologer's timing prediction for starting my new venture was spot on!”
                        </p>
                        <div class="review-user">
                            <div class="user-avatar">
                                <img src="{{ asset('assets/images/unsplash3.avif') }}"
                                    alt="Vikram Malhotra">
                            </div>
                            <div class="user-details">
                                <h4 class="user-name">Vikram Malhotra</h4>
                                <span class="user-location">Mumbai · India</span>
                            </div>
                        </div>
                    </div>

                    <div class="review-card">
                        <div class="card-top-bar">
                            <div class="review-stars">★★★★★</div>
                            <span class="verified-tag">✓ Verified User</span>
                        </div>
                        <div class="quote-icon">“</div>
                        <p class="review-text">
                            “Extremely authentic and trustworthy platform. The Vastu tips for my new house brought
                            noticeable positive energy and prosperity to our family within weeks.”
                        </p>
                        <div class="review-user">
                            <div class="user-avatar">
                                <img src="{{ asset('assets/images/unsplash4.avif') }}"
                                    alt="Ananya Roy">
                            </div>
                            <div class="user-details">
                                <h4 class="user-name">Ananya Roy</h4>
                                <span class="user-location">Bengaluru · India</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="blog_section">
    <div class="container">
        <div class="blog-section-header">
            <div class="blog-header-left">
                <span class="sub-title">EXPLORE COSMIC WISDOM</span>
                <h2 class="section-title">Unlocking the Secrets of the <span class="highlight">Universe</span></h2>
            </div>
            <a href="#" class="btn-view-blogs">Explore All Articles &rarr;</a>
        </div>

        <div class="blog-grid">
            <!-- Blog Card 1 -->
            <a href="#" class="blog-card">
                <div class="blog-img-box">
                    <img src="{{ asset('assets/images/blog1.png') }}" alt="5555 Angel Number">
                </div>
                <div class="blog-content">
                    <span class="blog-author">ASTROLOGY GUIDE</span>
                    <h3 class="blog-title">Decoding 5555 Angel Number: What the Universe is Telling You</h3>
                    <div class="blog-meta">
                        <span class="blog-views">12.4k views</span>
                        <span class="blog-date">25 Sept 2026</span>
                    </div>
                </div>
            </a>

            <!-- Blog Card 2 -->
            <a href="#" class="blog-card">
                <div class="blog-img-box">
                    <img src="{{ asset('assets/images/blog2.png') }}" alt="1919 Angel Number">
                </div>
                <div class="blog-content">
                    <span class="blog-author">TAROT & NUMEROLOGY</span>
                    <h3 class="blog-title">1919 Angel Number: Powerful Signs of New Beginnings & Destiny</h3>
                    <div class="blog-meta">
                        <span class="blog-views">18.2k views</span>
                        <span class="blog-date">23 Sept 2026</span>
                    </div>
                </div>
            </a>

            <!-- Blog Card 3 -->
            <a href="#" class="blog-card">
                <div class="blog-img-box">
                    <img src="{{ asset('assets/images/blog3.png') }}" alt="707 Angel Number">
                </div>
                <div class="blog-content">
                    <span class="blog-author">SPIRITUAL WISDOM</span>
                    <h3 class="blog-title">707 Angel Number Secrets: Love Alignment & Inner Awakening</h3>
                    <div class="blog-meta">
                        <span class="blog-views">14.8k views</span>
                        <span class="blog-date">22 Sept 2026</span>
                    </div>
                </div>
            </a>

            <!-- Blog Card 4 -->
            <a href="#" class="blog-card">
                <div class="blog-img-box">
                    <img src="{{ asset('assets/images/blog4.png') }}"
                        alt="Anant Chaturdashi 2026">
                </div>
                <div class="blog-content">
                    <span class="blog-author">SACRED RITUALS</span>
                    <h3 class="blog-title">Anant Chaturdashi 2026: Auspicious Muhurat, Puja Vidhi & Remedies</h3>
                    <div class="blog-meta">
                        <span class="blog-views">21.5k views</span>
                        <span class="blog-date">21 Sept 2026</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>



<script>
    // Duplicate marquee content safely if elements exist

    const mqLeft = document.getElementById('mq-left');
    if (mqLeft) mqLeft.innerHTML += mqLeft.innerHTML;

    const mqRight = document.getElementById('mq-right');
    if (mqRight) mqRight.innerHTML += mqRight.innerHTML;

    // 12 Rashi badges + orbital dashed ring around the center glyph
    const wrap = document.getElementById('rotating-wrapper');
    const linesSvg = document.getElementById('lines');
    if (wrap && linesSvg) {
        const rashis = [{
                symbol: '♈',
                name: 'Aries',
                hindi: 'Mesh'
            },
            {
                symbol: '♉',
                name: 'Taurus',
                hindi: 'Vrishabh'
            },
            {
                symbol: '♊',
                name: 'Gemini',
                hindi: 'Mithun'
            },
            {
                symbol: '♋',
                name: 'Cancer',
                hindi: 'Kark'
            },
            {
                symbol: '♌',
                name: 'Leo',
                hindi: 'Simha'
            },
            {
                symbol: '♍',
                name: 'Virgo',
                hindi: 'Kanya'
            },
            {
                symbol: '♎',
                name: 'Libra',
                hindi: 'Tula'
            },
            {
                symbol: '♏',
                name: 'Scorpio',
                hindi: 'Vrishchik'
            },
            {
                symbol: '♐',
                name: 'Sagittarius',
                hindi: 'Dhanu'
            },
            {
                symbol: '♑',
                name: 'Capricorn',
                hindi: 'Makar'
            },
            {
                symbol: '♒',
                name: 'Aquarius',
                hindi: 'Kumbh'
            },
            {
                symbol: '♓',
                name: 'Pisces',
                hindi: 'Meen'
            }
        ];

        const count = rashis.length;
        const radius = 40;

        rashis.forEach((rashi, i) => {
            const angle = (i / count) * 2 * Math.PI - Math.PI / 2;
            const x = 50 + radius * Math.cos(angle);
            const y = 50 + radius * Math.sin(angle);

            const badge = document.createElement('div');
            badge.className = 'rashi-badge';
            badge.style.left = x + '%';
            badge.style.top = y + '%';
            badge.setAttribute('title', `${rashi.name} (${rashi.hindi})`);
            badge.innerHTML = `<span class="rashi-symbol">${rashi.symbol}</span>`;
            wrap.appendChild(badge);
        });

        linesSvg.innerHTML = `
                    <circle cx="50%" cy="50%" r="40%" stroke="rgba(227, 181, 104, 0.4)" stroke-width="1.5" stroke-dasharray="4 4" fill="none"/>
                    <circle cx="50%" cy="50%" r="22%" stroke="rgba(227, 181, 104, 0.2)" stroke-width="1" fill="none"/>
                `;
    }

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

    const raashiData = @json($groupedRaashiData ?? []);
    let selectedRaashiIndex = 0;
    let selectedPeriod = 'Today';

    function updateHoroscopeView() {
        if (!raashiData || raashiData.length === 0) return;
        const sign = raashiData[selectedRaashiIndex];
        if (!sign) return;

        const periodData = (sign.periods && sign.periods[selectedPeriod]) ?
            sign.periods[selectedPeriod] :
            (sign.periods ? sign.periods['Today'] : null);

        if (!periodData) return;

        // 1. Highlight Active Raashi Card & prevent page vertical jumps
        document.querySelectorAll('.raashi-card').forEach((card, index) => {
            if (index === selectedRaashiIndex) {
                card.classList.add('active');
                const container = document.getElementById('raashi-cards-container');
                if (container) {
                    const cardLeft = card.offsetLeft;
                    const cardWidth = card.offsetWidth;
                    const containerWidth = container.offsetWidth;
                    container.scrollTo({
                        left: cardLeft - (containerWidth / 2) + (cardWidth / 2),
                        behavior: 'smooth'
                    });
                }
            } else {
                card.classList.remove('active');
            }
        });

        // 2. Highlight Active Time Pill
        document.querySelectorAll('.time-pill').forEach(pill => {
            if (pill.getAttribute('data-period') === selectedPeriod) {
                pill.classList.add('active');
            } else {
                pill.classList.remove('active');
            }
        });

        // 3. Update Title & Header Details
        const detailImg = document.getElementById('detail-img');
        if (detailImg) detailImg.src = sign.img;

        const detailTitle = document.getElementById('detail-title');
        if (detailTitle) detailTitle.innerHTML = `${sign.name} <span id="detail-hindi">${sign.hindi}</span>`;

        const detailDates = document.getElementById('detail-dates');
        if (detailDates) detailDates.textContent = sign.dates;

        const detailDateBadge = document.getElementById('detail-date-badge');
        if (detailDateBadge && periodData.dateLabel) {
            detailDateBadge.textContent = periodData.dateLabel;
        }

        // >>> YEH 4 LINES ADD KARNI HAIN <<<
        const detailBtn = document.getElementById('detail-horoscope-btn');
        if (detailBtn && sign.name) {
            // Jo sign aur period (Today/Week/...) chuna hai wahi page khulega
            const periodSlug = { Today: 'daily', Tomorrow: 'tomorrow', Week: 'weekly', Month: 'monthly', Year: 'yearly' }[selectedPeriod] || 'daily';
            detailBtn.href = "{{ url('/horoscope') }}/" + periodSlug + "-horoscope/" + sign.name.toLowerCase();
        }

        // 4. Update Long-form Reading Text with natural line breaks
        const detailReading = document.getElementById('detail-reading-text');
        if (detailReading) {
            detailReading.innerHTML = periodData.reading.replace(/\n/g, '<br>');
        }

        // 5. ASTROTALK EXACT LOGIC: Hide Mood / Lucky # / Color in Week, Month, and Year
        const metaPillsRow = document.querySelector('.meta-pills-row');
        if (metaPillsRow) {
            if (selectedPeriod === 'Week' || selectedPeriod === 'Month' || selectedPeriod === 'Year') {
                metaPillsRow.style.display = 'none'; // Completely hidden
            } else {
                metaPillsRow.style.display = 'flex'; // Visible only on Today / Tomorrow

                const detailMood = document.getElementById('detail-mood');
                if (detailMood) detailMood.textContent = periodData.mood;

                const detailLucky = document.getElementById('detail-lucky');
                if (detailLucky) detailLucky.textContent = periodData.lucky;

                const detailColorSwatch = document.getElementById('detail-color-swatch');
                if (detailColorSwatch) detailColorSwatch.style.background = periodData.color;
            }
        }

        // 6. Update Pillars
        const p = periodData.pillars;
        if (p) {
            const statusLove = document.getElementById('status-love');
            const barLove = document.getElementById('bar-love');
            if (statusLove) statusLove.textContent = p.love.status;
            if (barLove) barLove.style.width = p.love.percent + '%';

            const statusCareer = document.getElementById('status-career');
            const barCareer = document.getElementById('bar-career');
            if (statusCareer) statusCareer.textContent = p.career.status;
            if (barCareer) barCareer.style.width = p.career.percent + '%';

            const statusHealth = document.getElementById('status-health');
            const barHealth = document.getElementById('bar-health');
            if (statusHealth) statusHealth.textContent = p.health.status;
            if (barHealth) barHealth.style.width = p.health.percent + '%';

            const statusMoney = document.getElementById('status-money');
            const barMoney = document.getElementById('bar-money');
            if (statusMoney) statusMoney.textContent = p.money.status;
            if (barMoney) barMoney.style.width = p.money.percent + '%';
        }
    }

    // ==========================================
    // 3-SECOND AUTO SLIDER ENGINE
    // ==========================================
    const SLIDE_DURATION = 3000;
    let slideTimer = null;
    let progressInterval = null;
    let progressStartTime = 0;
    const progressFill = document.getElementById('raashi-progress-fill');

    // Click ke baad itni der slider ruka rahega
    const CLICK_PAUSE = 60000;
    let isHovering = false;
    let pausedUntil = 0;

    function stopAutoSlide() {
        clearInterval(progressInterval);
        clearTimeout(slideTimer);
    }

    function startAutoSlide() {
        stopAutoSlide();

        // Cursor upar hai to ruke raho; click wala pause chal raha hai to uske khatam hone par dobara try karo
        if (isHovering) return;
        const wait = pausedUntil - Date.now();
        if (wait > 0) {
            slideTimer = setTimeout(startAutoSlide, wait);
            return;
        }

        progressStartTime = Date.now();
        if (progressFill) progressFill.style.width = '0%';

        progressInterval = setInterval(() => {
            const elapsed = Date.now() - progressStartTime;
            const percent = Math.min((elapsed / SLIDE_DURATION) * 100, 100);
            if (progressFill) progressFill.style.width = percent + '%';

            if (elapsed >= SLIDE_DURATION) {
                clearInterval(progressInterval);
                selectedRaashiIndex = (selectedRaashiIndex + 1) % (raashiData.length || 12);
                updateHoroscopeView();
                startAutoSlide();
            }
        }, 50);
    }

    // User ne khud kuch chuna hai: 1 minute tak apne aap aage mat badho
    function resetTimer() {
        pausedUntil = Date.now() + CLICK_PAUSE;
        startAutoSlide();
    }

    // Raashi Card Click Handlers
    document.querySelectorAll('.raashi-card').forEach((card, index) => {
        card.addEventListener('click', () => {
            selectedRaashiIndex = index;
            updateHoroscopeView();
            resetTimer();
        });
    });

    // Time Pill Click Handlers
    document.querySelectorAll('.time-pill').forEach(pill => {
        pill.addEventListener('click', function () {
            selectedPeriod = this.getAttribute('data-period');
            updateHoroscopeView();
            resetTimer();
        });
    });

    // Arrow Buttons
    const prevBtnRaashi = document.getElementById('raashi-prev-btn');
    const nextBtnRaashi = document.getElementById('raashi-next-btn');

    if (prevBtnRaashi) {
        prevBtnRaashi.addEventListener('click', () => {
            selectedRaashiIndex = (selectedRaashiIndex - 1 + raashiData.length) % raashiData.length;
            updateHoroscopeView();
            resetTimer();
        });
    }

    if (nextBtnRaashi) {
        nextBtnRaashi.addEventListener('click', () => {
            selectedRaashiIndex = (selectedRaashiIndex + 1) % raashiData.length;
            updateHoroscopeView();
            resetTimer();
        });
    }

    // Hover Pause: sign wali row ya reading box par cursor ho to slider ruka rahe
    let hoverCount = 0;
    document.querySelectorAll('.raashi-selector-wrapper, #horoscope-detail-box').forEach(area => {
        area.addEventListener('mouseenter', () => {
            hoverCount++;
            isHovering = true;
            stopAutoSlide();
        });
        area.addEventListener('mouseleave', () => {
            hoverCount = Math.max(0, hoverCount - 1);
            isHovering = hoverCount > 0;
            startAutoSlide();
        });
    });

    // Review Slider
    const reviewCards = document.querySelectorAll('.review-card');
    const dots = document.querySelectorAll('#reviewDots .dot');
    const prevBtn = document.getElementById('prevReviewBtn');
    const nextBtn = document.getElementById('nextReviewBtn');
    const reviewCounter = document.getElementById('reviewCounter');
    let currentReviewIndex = 0;

    function updateReviewSlider(index) {
        reviewCards.forEach((card, idx) => {
            if (idx === index) {
                card.classList.add('active');
            } else {
                card.classList.remove('active');
            }
        });

        dots.forEach((dot, idx) => {
            if (idx === index) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });

        if (reviewCounter) {
            reviewCounter.textContent = `${index + 1} / ${reviewCards.length}`;
        }
    }

    if (prevBtn && nextBtn && reviewCards.length > 0) {
        prevBtn.addEventListener('click', () => {
            currentReviewIndex = (currentReviewIndex - 1 + reviewCards.length) % reviewCards.length;
            updateReviewSlider(currentReviewIndex);
        });

        nextBtn.addEventListener('click', () => {
            currentReviewIndex = (currentReviewIndex + 1) % reviewCards.length;
            updateReviewSlider(currentReviewIndex);
        });

        dots.forEach((dot, idx) => {
            dot.addEventListener('click', () => {
                currentReviewIndex = idx;
                updateReviewSlider(currentReviewIndex);
            });
        });
    }

    // Initial Trigger

    document.addEventListener('DOMContentLoaded', () => {
        updateHoroscopeView();
        startAutoSlide();
    });

</script>
@endsection
