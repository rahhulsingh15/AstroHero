@extends('frontend.layouts.master')
@section('title', $selectedSign . ' Horoscope ' . $periods[$period]['suffix'])
@section('content')

@php
    $currentMeta = $zodiacMeta[$selectedSign];
    $activePeriod = $periods[$period]['tab'];
@endphp

<!-- Banner & Breadcrumb Section -->
<section class="view-all-astrologers">
    <div class="view-all-astrologers-container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}">HOME</a>
            <span class="separator">›</span>
            <a href="{{ route('horoscope.landing', ['period' => $period]) }}" id="breadcrumb-period">{{ $periods[$period]['title'] }}</a>
            <span class="separator">›</span>
            <span class="current">{{ strtoupper($selectedSign) }}</span>
        </div>
        <div class="astrologers-banner">
            <div class="banner-content">
                <div class="banner-image">
                    <img src="{{ asset('assets/images/'.$currentMeta['img']) }}" alt="{{ $selectedSign }} Horoscope">
                </div>
                <div class="banner-text">
                    <h1 id="banner-heading">{{ $selectedSign }} Horoscope {{ $periods[$period]['suffix'] }}</h1>
                    <div class="zodiac-info">
                        <span class="zodiac-name">{{ $currentMeta['hindi'] }} <span class="zodiac-icon">{{ $currentMeta['icon'] }}</span></span>
                        <span class="zodiac-dates">{{ $currentMeta['dates'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tabs & Main Content -->
<section class="tab_section">
    <div class="tab_container">
        <!-- Tabs Nav -->
        <div class="tabs-nav">
            @foreach($periods as $slug => $p)
                <button type="button"
                        class="tab-btn {{ $slug === $period ? 'active' : '' }}"
                        data-tab-target="#tab-{{ strtolower($p['tab']) }}"
                        data-period="{{ $slug }}">
                    {{ $p['tab'] }}
                </button>
            @endforeach
        </div>

        @foreach($periodData as $periodKey => $data)
            <div class="tab-content {{ $periodKey === $activePeriod ? 'active' : '' }}" id="tab-{{ strtolower($periodKey) }}">
                <div class="daily-layout">
                    <div class="daily-main">
                        <!-- Row 1: Horoscope Reading & Lucky Details -->
                        <div class="horoscope-lucky-row {{ !in_array($periodKey, ['Daily', 'Tomorrow']) ? 'is-full-width' : '' }}">
                            <div class="horoscope-card {{ !in_array($periodKey, ['Daily', 'Tomorrow']) ? 'w-100' : '' }}">
                                <div class="date-badge">{{ $data['date_formatted'] }}</div>
                                <h2 class="section-title-small">
                                    {{ strtoupper($selectedSign) }} HOROSCOPE {{ strtoupper($periodKey) }}
                                </h2>
                                
                                <p class="reading-text">{!! nl2br(e($data['reading'])) !!}</p>

                                <button class="btn-primary">Talk to {{ $selectedSign }} expert</button>
                            </div>

                            {{-- Lucky section sirf Daily aur Tomorrow mein aayega --}}
                            @if(in_array($periodKey, ['Daily', 'Tomorrow']))
                                <div class="lucky-card">
                                    <h3>Lucky {{ strtolower($periodKey) }}</h3>
                                    <div class="lucky-grid">
                                        <div class="lucky-item">
                                            <span class="lucky-label">LUCKY COLOUR</span>
                                            <div class="color-blocks">
                                                <span class="color-box" style="background: {{ $data['lucky_color'] }};"></span>
                                            </div>
                                        </div>
                                        <div class="lucky-item">
                                            <span class="lucky-label">LUCKY NUMBER</span>
                                            <span class="lucky-val">{{ $data['lucky_number'] }}</span>
                                        </div>
                                        <div class="lucky-item">
                                            <span class="lucky-label">AUSPICIOUS TIME (IST)</span>
                                            <span class="lucky-val">{{ $data['auspicious_time'] }}</span>
                                        </div>
                                        <div class="lucky-item">
                                            <span class="lucky-label">MOOD</span>
                                            <span class="lucky-val">{{ $data['mood'] }}</span>
                                        </div>
                                        <div class="lucky-item">
                                            <span class="lucky-label">RULING PLANET</span>
                                            <span class="lucky-val">{{ $data['ruling_planet'] }}</span>
                                        </div>
                                        <div class="lucky-item">
                                            <span class="lucky-label">SYMBOL</span>
                                            <span class="lucky-val">{{ $data['symbol'] }}</span>
                                        </div>
                                        <div class="lucky-item">
                                            <span class="lucky-label">TAROT CARD</span>
                                            <span class="lucky-val">{{ $data['tarot_card'] }}</span>
                                        </div>
                                        <div class="lucky-item">
                                            <span class="lucky-label">LUCKY STONE</span>
                                            <span class="lucky-val">{{ $data['lucky_stone'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Area of Life (Love, Finance, Career, Health) sirf Daily aur Tomorrow mein aayega --}}
                        @if(in_array($periodKey, ['Daily', 'Tomorrow']))
                            <div class="area-of-life">
                                <h2 class="section-title">{{ $periodKey }} by area of life</h2>
                                <p class="section-subtitle">
                                    How {{ strtolower($periodKey) }} scores across your four key areas — love, finance, career and health.
                                </p>
                                <div class="area-grid">
                                    {{-- Love --}}
                                    <div class="area-card love">
                                        <div class="area-header">
                                            <div class="area-title"><span class="area-icon">💞</span> {{ $selectedSign }} Love</div>
                                            <div class="area-score">{{ $data['love_percent'] }}% <span class="arrow">›</span></div>
                                        </div>
                                        <div class="progress-bar">
                                            <div class="fill" style="width: {{ $data['love_percent'] }}%; background: #e05c5c;"></div>
                                        </div>
                                        <div class="reading-box">
                                            <p class="collapsed-text">{{ Str::limit($data['love_status'] ?: 'Love energies look steady today.', 110) }} 
                                                @if(strlen($data['love_status']) > 110)
                                                    <a href="javascript:void(0)" class="read-more-btn font-weight-bold">Read More</a>
                                                @endif
                                            </p>
                                            <p class="full-text d-none">{{ $data['love_status'] }}</p>
                                        </div>
                                    </div>

                                    {{-- Finance --}}
                                    <div class="area-card finance">
                                        <div class="area-header">
                                            <div class="area-title"><span class="area-icon">💸</span> {{ $selectedSign }} Finance</div>
                                            <div class="area-score">{{ $data['money_percent'] }}% <span class="arrow">›</span></div>
                                        </div>
                                        <div class="progress-bar">
                                            <div class="fill" style="width: {{ $data['money_percent'] }}%; background: #23a85e;"></div>
                                        </div>
                                        <div class="reading-box">
                                            <p class="collapsed-text">{{ Str::limit($data['money_status'] ?: 'Gradual financial stability is indicated.', 110) }} 
                                                @if(strlen($data['money_status']) > 110)
                                                    <a href="javascript:void(0)" class="read-more-btn font-weight-bold">Read More</a>
                                                @endif
                                            </p>
                                            <p class="full-text d-none">{{ $data['money_status'] }}</p>
                                        </div>
                                    </div>

                                    {{-- Career --}}
                                    <div class="area-card career">
                                        <div class="area-header">
                                            <div class="area-title"><span class="area-icon">💼</span> {{ $selectedSign }} Career</div>
                                            <div class="area-score">{{ $data['career_percent'] }}% <span class="arrow">›</span></div>
                                        </div>
                                        <div class="progress-bar">
                                            <div class="fill" style="width: {{ $data['career_percent'] }}%; background: #d98526;"></div>
                                        </div>
                                        <div class="reading-box">
                                            <p class="collapsed-text">{{ Str::limit($data['career_status'] ?: 'Focus on patience and long-term milestones.', 110) }} 
                                                @if(strlen($data['career_status']) > 110)
                                                    <a href="javascript:void(0)" class="read-more-btn font-weight-bold">Read More</a>
                                                @endif
                                            </p>
                                            <p class="full-text d-none">{{ $data['career_status'] }}</p>
                                        </div>
                                    </div>

                                    {{-- Health --}}
                                    <div class="area-card health">
                                        <div class="area-header">
                                            <div class="area-title"><span class="area-icon">🛡️</span> {{ $selectedSign }} Health</div>
                                            <div class="area-score">{{ $data['health_percent'] }}% <span class="arrow">›</span></div>
                                        </div>
                                        <div class="progress-bar">
                                            <div class="fill" style="width: {{ $data['health_percent'] }}%; background: #3c7ce6;"></div>
                                        </div>
                                        <div class="reading-box">
                                            <p class="collapsed-text">{{ Str::limit($data['health_status'] ?: 'Maintain mindful hydration and rest.', 110) }} 
                                                @if(strlen($data['health_status']) > 110)
                                                    <a href="javascript:void(0)" class="read-more-btn font-weight-bold">Read More</a>
                                                @endif
                                            </p>
                                            <p class="full-text d-none">{{ $data['health_status'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar: Astrologer Experts -->
                    <div class="daily-sidebar">
                        <div class="experts-widget">
                            <div class="widget-header">
                                <span class="sub-title">TALK TO EXPERTS</span>
                                <h2>Talk to Horoscope experts</h2>
                                <p>Get a live reading tuned to your birth chart — first consultation free.</p>
                            </div>
                            <div class="expert-list">
                                <div class="expert-item">
                                    <div class="expert-img"><img src="{{ asset('assets/images/chatimg1.png') }}" width="100%" alt="Expert"></div>
                                    <div class="expert-info">
                                        <h4>Vasunendra</h4>
                                        <p>Vedic, Nadi, Numerology</p>
                                        <div class="expert-rating"><span class="star">★</span> 4.92 <span>₹38/min</span></div>
                                    </div>
                                    <button class="chat-btn">Chat</button>
                                </div>
                                <div class="expert-item">
                                    <div class="expert-img"><img src="{{ asset('assets/images/chatimg2.png') }}" width="100%" alt="Expert"></div>
                                    <div class="expert-info">
                                        <h4>Deepakh</h4>
                                        <p>Vedic, Vastu, Life Coach</p>
                                        <div class="expert-rating"><span class="star">★</span> 4.86 <span>₹48/min</span></div>
                                    </div>
                                    <button class="chat-btn">Chat</button>
                                </div>
                                <div class="expert-item">
                                    <div class="expert-img"><img src="{{ asset('assets/images/chatimg3.png') }}" width="100%" alt="Expert"></div>
                                    <div class="expert-info">
                                        <h4>Madhusudhan</h4>
                                        <p>Numerology, Vedic, Palmistry</p>
                                        <div class="expert-rating"><span class="star">★</span> 4.93 <span>₹32/min</span></div>
                                    </div>
                                    <button class="chat-btn">Chat</button>
                                </div>
                            </div>
                            <button class="view-all-experts">View all astrologers</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @include('frontend.partials.zodiac-grid', [
            'title' => 'Other Zodiac Signs',
            'subtitle' => 'Read prediction for all 12 rashis',
        ])
    </div>
</section>

<!-- Dynamic Tab Switching & Breadcrumb Update Script -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".tab-btn");
    const contents = document.querySelectorAll(".tab-content");
    const breadcrumbPeriod = document.getElementById("breadcrumb-period");
    const bannerHeading = document.getElementById("banner-heading");
    const signName = "{{ $selectedSign }}";

    // Mapping for clean labels
    const periodMap = @json($periods);

    // Kisi period (aur sign) ka URL: /horoscope/weekly-horoscope/aries
    const landingUrl = "{{ route('horoscope.landing', ['period' => '__P__']) }}";
    function periodUrl(period, sign) {
        const base = landingUrl.replace("__P__", period);
        return sign ? base + "/" + sign : base;
    }

    tabs.forEach(tab => {
        tab.addEventListener("click", function () {
            const targetSelector = this.getAttribute("data-tab-target");
            const tabName = this.getAttribute("data-period");

            // Tab classes toggle
            tabs.forEach(t => t.classList.remove("active"));
            this.classList.add("active");

            // Content show/hide
            contents.forEach(c => c.classList.remove("active"));
            const activeContent = document.querySelector(targetSelector);
            if (activeContent) {
                activeContent.classList.add("active");
            }

            // Breadcrumb aur Banner Heading dynamic change
            if (periodMap[tabName]) {
                if (breadcrumbPeriod) {
                    breadcrumbPeriod.textContent = periodMap[tabName].title;
                    breadcrumbPeriod.href = periodUrl(tabName);
                }
                if (bannerHeading) {
                    bannerHeading.textContent = signName + " Horoscope " + periodMap[tabName].suffix;
                }

                // Tab badalne par URL aur rashi ke links bhi usi period ke ho jayein
                history.replaceState(null, "", periodUrl(tabName, signName.toLowerCase()));
                document.querySelectorAll(".zodiac-grid a").forEach(a => {
                    a.href = periodUrl(tabName, a.dataset.sign);
                });
            }
        });
    });

    // Real dynamic Read More toggle
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("read-more-btn")) {
            e.preventDefault();
            const parent = e.target.closest(".reading-box");
            if (parent) {
                parent.querySelector(".collapsed-text").classList.add("d-none");
                parent.querySelector(".full-text").classList.remove("d-none");
            }
        }
    });
});
</script>
@endsection