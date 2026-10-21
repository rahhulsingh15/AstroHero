@extends('frontend.layouts.master')
@section('title', $name . "'s Janam Kundli — Free Vedic Horoscope Report | AstroHero")
@section('content')

@php
    $lagna = $report['lagna'];
    $planets = $report['planets'];
    $allPlanets = $report['allPlanets'];
    $panchang = $report['panchang'];
    $avakhada = $report['avakhada'];
    $dasha = $report['dasha'];
    $yogini = $report['yogini'];
    $ashtak = $report['ashtakvarga'];
    $kp = $report['kp'];
    $doshas = $report['doshas'];
    $rudraksha = $report['rudraksha'];
    $gemstones = $report['gemstones'];
    $predictions = $report['predictions'];
    $yogas = $report['yogas'];

    $latFmt = ($lat >= 0 ? number_format($lat, 4) . '° N' : number_format(abs($lat), 4) . '° S');
    $lngFmt = ($lng >= 0 ? number_format($lng, 4) . '° E' : number_format(abs($lng), 4) . '° W');

    // North Indian diamond coordinate slots [x, y, signX, signY]
    $slots = [
        1  => [150, 75,  150, 38],  2  => [75, 38,   75, 24],   3  => [28, 75,   24, 75],
        4  => [75, 150,  40, 150],  5  => [28, 225,  24, 225],  6  => [75, 260,  75, 276],
        7  => [150, 225, 150, 260], 8  => [225, 260, 225, 276], 9  => [270, 225, 276, 225],
        10 => [225, 150, 260, 150], 11 => [270, 75,  276, 75],  12 => [225, 38,  225, 24],
    ];

    $ashtakCoords = [
        1 => [130, 65], 2 => [65, 24], 3 => [24, 65], 4 => [65, 130],
        5 => [24, 195], 6 => [65, 238], 7 => [130, 195], 8 => [195, 238],
        9 => [238, 195], 10 => [195, 130], 11 => [238, 65], 12 => [195, 24]
    ];

    // South Indian box coordinates
    $boxCoords = [
        12 => ['x' => 46,  'y' => 50],
        1  => ['x' => 122, 'y' => 50],
        2  => ['x' => 198, 'y' => 50],
        3  => ['x' => 274, 'y' => 50],
        4  => ['x' => 274, 'y' => 128],
        5  => ['x' => 274, 'y' => 202],
        6  => ['x' => 274, 'y' => 280],
        7  => ['x' => 198, 'y' => 280],
        8  => ['x' => 122, 'y' => 280],
        9  => ['x' => 46,  'y' => 278],
        10 => ['x' => 46,  'y' => 202],
        11 => ['x' => 46,  'y' => 126],
    ];
@endphp

<link rel="stylesheet" href="{{ asset('assets/css/freekundli.css') }}?v={{ time() }}">

<section class="kd-dashboard-section">
    <div class="container">

        <!-- Breadcrumb -->
        <nav class="fk-guide-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">HOME</a>
            <span class="sep">&gt;</span>
            <a href="{{ route('free-kundli') }}">FREE KUNDLI</a>
            <span class="sep">&gt;</span>
            <span class="active">{{ strtoupper($name) }}'S REPORT</span>
        </nav>

        <!-- Top Hero Card -->
        <div class="kd-hero-banner">
            <div class="kd-hero-flex">
                <div>
                    <h1 class="kd-hero-title"><span>{{ $name }}'s</span> Janam Kundli</h1>
                    <p class="kd-hero-meta">
                        🗓️ {{ $birth->format('d M Y') }} &nbsp;·&nbsp;
                        ⏰ {{ $timeUnknown ? '12:00 PM (Approx)' : $birth->format('h:i A') }} &nbsp;·&nbsp;
                        📍 {{ $place }} ({{ $latFmt }}, {{ $lngFmt }})
                    </p>
                    <div class="kd-hero-tags">
                        <span class="kd-hero-tag">Ayanamsha: Lahiri</span>
                        <span class="kd-hero-tag">Whole-Sign Houses</span>
                        <span class="kd-hero-tag">Vedic Astrology</span>
                        <span class="kd-hero-tag">{{ ucfirst($gender) }}</span>
                    </div>
                </div>

                <div class="kd-hero-actions">
                    <a href="{{ route('free-kundli-pdf', request()->all()) }}" target="_blank" class="kd-btn-pdf" id="btn-open-pdf">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 6 2 18 2 18 9"></polyline>
                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                            <rect x="6" y="14" width="12" height="8"></rect>
                        </svg>
                        Download PDF Report
                    </a>
                    <a href="{{ route('free-kundli') }}" class="kd-btn-outline">
                        + New Kundli
                    </a>
                </div>
            </div>
        </div>

        <!-- The 3 Pillars Summary Cards -->
        <div class="kd-summary-strip">
            <div class="kd-pillar-card">
                <div class="kd-pillar-icon">👑</div>
                <div>
                    <div class="kd-pillar-label">Lagna (Ascendant)</div>
                    <div class="kd-pillar-val">{{ $lagna['sign'] }}</div>
                    <div class="kd-pillar-sub">{{ $lagna['degree'] }}° {{ sprintf('%02d', $lagna['minute']) }}′ · Ruled by {{ $lagna['lord'] }}</div>
                </div>
            </div>

            <div class="kd-pillar-card">
                <div class="kd-pillar-icon">🌙</div>
                <div>
                    <div class="kd-pillar-label">Rashi (Moon Sign)</div>
                    <div class="kd-pillar-val">{{ $avakhada['sign'] }}</div>
                    <div class="kd-pillar-sub">Ruled by {{ $avakhada['signLord'] }} ({{ $avakhada['tatva'] }} Element)</div>
                </div>
            </div>

            <div class="kd-pillar-card">
                <div class="kd-pillar-icon">✨</div>
                <div>
                    <div class="kd-pillar-label">Nakshatra</div>
                    <div class="kd-pillar-val">{{ $panchang['nakshatra'] }}</div>
                    <div class="kd-pillar-sub">Lord: {{ $panchang['nakshatraLord'] }} · Pada {{ $avakhada['charan'] }}</div>
                </div>
            </div>

            <div class="kd-pillar-card">
                <div class="kd-pillar-icon">🪐</div>
                <div>
                    <div class="kd-pillar-label">Active Mahadasha</div>
                    @php
                        $activeDasha = collect($dasha)->firstWhere('active', true);
                    @endphp
                    <div class="kd-pillar-val">{{ $activeDasha['planet'] ?? 'Active' }}</div>
                    <div class="kd-pillar-sub">Until {{ $activeDasha ? $activeDasha['end']->format('M Y') : '—' }}</div>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs Bar -->
        <div class="kd-tabs-wrapper">
            <div class="kd-tabs-nav" id="kd-tabs-nav">
                <button type="button" class="kd-tab-btn active" data-tab="tab-basic">01 Basic &amp; Panchang</button>
                <button type="button" class="kd-tab-btn" data-tab="tab-charts">02 Kundli Charts</button>
                <button type="button" class="kd-tab-btn" data-tab="tab-planets">03 Planetary Positions</button>
                <button type="button" class="kd-tab-btn" data-tab="tab-kp">04 KP System</button>
                <button type="button" class="kd-tab-btn" data-tab="tab-ashtak">05 Ashtakvarga</button>
                <button type="button" class="kd-tab-btn" data-tab="tab-divisional">06 Divisional Charts (16)</button>
                <button type="button" class="kd-tab-btn" data-tab="tab-dasha">07 Dasha Timeline</button>
                <button type="button" class="kd-tab-btn" data-tab="tab-predictions">08 Predictions &amp; Remedies</button>
            </div>
        </div>

        <!-- ==============================================
             TAB 1: BASIC DETAILS & PANCHANG
             ============================================== -->
        <div class="kd-tab-content active" id="tab-basic">
            <div class="kd-grid-2">
                <div>
                    <div class="kd-card">
                        <div class="kd-card-header">
                            <h2 class="kd-card-title">Birth Details</h2>
                            <span class="kd-hero-tag">Almanac</span>
                        </div>
                        <div class="kd-info-row"><span class="kd-label">Full Name</span><span class="kd-value">{{ $name }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Gender</span><span class="kd-value">{{ ucfirst($gender) }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Date of Birth</span><span class="kd-value">{{ $birth->format('d M Y') }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Time of Birth</span><span class="kd-value">{{ $timeUnknown ? '12:00 PM (Approx)' : $birth->format('h:i A') }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Birth Place</span><span class="kd-value">{{ $place }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Latitude</span><span class="kd-value">{{ $latFmt }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Longitude</span><span class="kd-value">{{ $lngFmt }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Timezone</span><span class="kd-value">GMT +05:30</span></div>
                    </div>
                </div>

                <div>
                    <div class="kd-card">
                        <div class="kd-card-header">
                            <h2 class="kd-card-title">Panchang Details</h2>
                            <span class="kd-hero-tag">Cosmic Day</span>
                        </div>
                        <div class="kd-info-row"><span class="kd-label">Tithi</span><span class="kd-value">{{ $panchang['tithi'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Karana</span><span class="kd-value">{{ $panchang['karana'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Yoga</span><span class="kd-value">{{ $panchang['yoga'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Nakshatra</span><span class="kd-value gold">{{ $panchang['nakshatra'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Nakshatra Lord</span><span class="kd-value">{{ $panchang['nakshatraLord'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Ascendant (Lagna)</span><span class="kd-value gold">{{ $lagna['sign'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Ascendant Lord</span><span class="kd-value">{{ $lagna['lord'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Sunrise / Sunset</span><span class="kd-value">{{ $panchang['sunrise'] }} / {{ $panchang['sunset'] }}</span></div>
                    </div>
                </div>
            </div>

            <!-- Avakhada Chakra Details -->
            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">Avakhada Chakra (अव कहड़ा चक्र)</h2>
                        <p class="kd-card-subtitle">Essential astrological attributes calculated from your Moon's placement at birth.</p>
                    </div>
                </div>
                <div class="kd-grid-3">
                    <div>
                        <div class="kd-info-row"><span class="kd-label">Varna</span><span class="kd-value">{{ $avakhada['varna'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Vashya</span><span class="kd-value">{{ $avakhada['vashya'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Yoni</span><span class="kd-value">{{ $avakhada['yoni'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Gan</span><span class="kd-value">{{ $avakhada['gan'] }}</span></div>
                    </div>
                    <div>
                        <div class="kd-info-row"><span class="kd-label">Nadi</span><span class="kd-value">{{ $avakhada['nadi'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Moon Sign (Rashi)</span><span class="kd-value gold">{{ $avakhada['sign'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Sign Lord</span><span class="kd-value">{{ $avakhada['signLord'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Charan / Pada</span><span class="kd-value">{{ $avakhada['charan'] }}</span></div>
                    </div>
                    <div>
                        <div class="kd-info-row"><span class="kd-label">Tatva (Element)</span><span class="kd-value">{{ $avakhada['tatva'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Name Alphabet</span><span class="kd-value gold">{{ $avakhada['nameAlphabet'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Paya</span><span class="kd-value">{{ $avakhada['paya'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Yunja</span><span class="kd-value">{{ $avakhada['yunja'] }}</span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==============================================
             TAB 2: KUNDLI CHARTS (LAGNA, NAVAMSHA & TRANSITS)
             ============================================== -->
        <div class="kd-tab-content" id="tab-charts">
            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">Birth &amp; Harmonic Charts</h2>
                        <p class="kd-card-subtitle">Lagna Kundli (D-1) &amp; Navamsha Kundli (D-9) representing personality, karma, and destiny.</p>
                    </div>
                    <div class="kd-toggle-group">
                        <button type="button" class="kd-toggle-btn active" data-chart-mode="north">North Style</button>
                        <button type="button" class="kd-toggle-btn" data-chart-mode="south">South Style</button>
                    </div>
                </div>

                <!-- North Indian Birth Charts -->
                <div class="kd-charts-grid-2x2 kd-charts-north">
                    <div class="kd-chart-box">
                        <div class="kd-chart-label">Lagna Kundli (D-1 Rashi)</div>
                        <svg class="kd-chart-svg" viewBox="0 0 300 300">
                            <rect x="8" y="8" width="284" height="284" class="kd-chart-bg" stroke-width="2" />
                            <line x1="8" y1="8" x2="292" y2="292" class="kd-chart-line" stroke-width="1.4" />
                            <line x1="292" y1="8" x2="8" y2="292" class="kd-chart-line" stroke-width="1.4" />
                            <polygon points="150,8 292,150 150,292 8,150" fill="none" class="kd-chart-line" stroke-width="1.5" />

                            @foreach ($report['divisionalCharts']['vargas']['D1']['houses'] as $hNum => $hData)
                                @php
                                    [$px, $py, $sx, $sy] = $slots[$hNum];
                                    $plText = collect($hData['planets'])->pluck('abbr')->implode(' ');
                                @endphp
                                <text x="{{ $sx }}" y="{{ $sy }}" class="kd-svg-house-num">{{ $hData['signNum'] }}</text>
                                @if ($plText)
                                    <text x="{{ $px }}" y="{{ $py }}" class="kd-svg-planet yellow">{{ $plText }}</text>
                                @endif
                            @endforeach
                        </svg>
                    </div>

                    <div class="kd-chart-box">
                        <div class="kd-chart-label">Navamsha Kundli (D-9 Dharma)</div>
                        <svg class="kd-chart-svg" viewBox="0 0 300 300">
                            <rect x="8" y="8" width="284" height="284" class="kd-chart-bg" stroke-width="2" />
                            <line x1="8" y1="8" x2="292" y2="292" class="kd-chart-line" stroke-width="1.4" />
                            <line x1="292" y1="8" x2="8" y2="292" class="kd-chart-line" stroke-width="1.4" />
                            <polygon points="150,8 292,150 150,292 8,150" fill="none" class="kd-chart-line" stroke-width="1.5" />

                            @foreach ($report['divisionalCharts']['vargas']['D9']['houses'] as $hNum => $hData)
                                @php
                                    [$px, $py, $sx, $sy] = $slots[$hNum];
                                    $plText = collect($hData['planets'])->pluck('abbr')->implode(' ');
                                @endphp
                                <text x="{{ $sx }}" y="{{ $sy }}" class="kd-svg-house-num">{{ $hData['signNum'] }}</text>
                                @if ($plText)
                                    <text x="{{ $px }}" y="{{ $py }}" class="kd-svg-planet green">{{ $plText }}</text>
                                @endif
                            @endforeach
                        </svg>
                    </div>
                </div>

                <!-- South Indian Birth Charts -->
                <div class="kd-charts-grid-2x2 kd-charts-south">
                    <div class="kd-chart-box">
                        <div class="kd-chart-label">Lagna Kundli (South Indian)</div>
                        <svg class="kd-chart-svg" viewBox="0 0 320 320">
                            <rect x="8" y="8" width="304" height="304" class="kd-chart-bg" stroke-width="2" rx="2" />
                            <line x1="84" y1="8" x2="84" y2="312" class="kd-chart-line" stroke-width="1.6" />
                            <line x1="160" y1="8" x2="160" y2="84" class="kd-chart-line" stroke-width="1.6" />
                            <line x1="160" y1="236" x2="160" y2="312" class="kd-chart-line" stroke-width="1.6" />
                            <line x1="236" y1="8" x2="236" y2="312" class="kd-chart-line" stroke-width="1.6" />
                            <line x1="8" y1="84" x2="312" y2="84" class="kd-chart-line" stroke-width="1.6" />
                            <line x1="8" y1="160" x2="84" y2="160" class="kd-chart-line" stroke-width="1.6" />
                            <line x1="236" y1="160" x2="312" y2="160" class="kd-chart-line" stroke-width="1.6" />
                            <line x1="8" y1="236" x2="312" y2="236" class="kd-chart-line" stroke-width="1.6" />
                            <rect x="84" y="84" width="152" height="152" class="kd-south-center" stroke-width="1.6" />
                            <circle cx="160" cy="160" r="3.5" fill="var(--kd-gold)" />

                            @foreach ([12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] as $bNum)
                                <text x="{{ $boxCoords[$bNum]['x'] - 20 }}" y="{{ $boxCoords[$bNum]['y'] - 25 }}" class="kd-south-num">{{ $bNum }}</text>
                            @endforeach
                            @foreach ($report['divisionalCharts']['vargas']['D1']['houses'] as $hData)
                                @php
                                    $sNum = $hData['signNum'];
                                    $pl = collect($hData['planets'])->pluck('abbr')->implode(' ');
                                @endphp
                                @if ($pl)
                                    <text x="{{ $boxCoords[$sNum]['x'] }}" y="{{ $boxCoords[$sNum]['y'] }}" class="kd-south-planet yellow">{{ $pl }}</text>
                                @endif
                            @endforeach
                        </svg>
                    </div>

                    <div class="kd-chart-box">
                        <div class="kd-chart-label">Navamsha Kundli (South Indian)</div>
                        <svg class="kd-chart-svg" viewBox="0 0 320 320">
                            <rect x="8" y="8" width="304" height="304" class="kd-chart-bg" stroke-width="2" rx="2" />
                            <line x1="84" y1="8" x2="84" y2="312" class="kd-chart-line" stroke-width="1.6" />
                            <line x1="160" y1="8" x2="160" y2="84" class="kd-chart-line" stroke-width="1.6" />
                            <line x1="160" y1="236" x2="160" y2="312" class="kd-chart-line" stroke-width="1.6" />
                            <line x1="236" y1="8" x2="236" y2="312" class="kd-chart-line" stroke-width="1.6" />
                            <line x1="8" y1="84" x2="312" y2="84" class="kd-chart-line" stroke-width="1.6" />
                            <line x1="8" y1="160" x2="84" y2="160" class="kd-chart-line" stroke-width="1.6" />
                            <line x1="236" y1="160" x2="312" y2="160" class="kd-chart-line" stroke-width="1.6" />
                            <line x1="8" y1="236" x2="312" y2="236" class="kd-chart-line" stroke-width="1.6" />
                            <rect x="84" y="84" width="152" height="152" class="kd-south-center" stroke-width="1.6" />
                            <circle cx="160" cy="160" r="3.5" fill="var(--kd-gold)" />

                            @foreach ([12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] as $bNum)
                                <text x="{{ $boxCoords[$bNum]['x'] - 20 }}" y="{{ $boxCoords[$bNum]['y'] - 25 }}" class="kd-south-num">{{ $bNum }}</text>
                            @endforeach
                            @foreach ($report['divisionalCharts']['vargas']['D9']['houses'] as $hData)
                                @php
                                    $sNum = $hData['signNum'];
                                    $pl = collect($hData['planets'])->pluck('abbr')->implode(' ');
                                @endphp
                                @if ($pl)
                                    <text x="{{ $boxCoords[$sNum]['x'] }}" y="{{ $boxCoords[$sNum]['y'] }}" class="kd-south-planet green">{{ $pl }}</text>
                                @endif
                            @endforeach
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Transit Charts (Gochar) -->
            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">Live Planetary Transits (Gochar Charts)</h2>
                        <p class="kd-card-subtitle">Real astronomical planetary positions in the sky right now overlaid on your Ascendant &amp; Moon signs.</p>
                    </div>
                </div>

                <div class="kd-charts-grid-2x2 kd-charts-north">
                    <div class="kd-chart-box">
                        <div class="kd-chart-label">{{ $report['divisionalCharts']['transits']['lagnaTransit']['title'] }}</div>
                        <svg class="kd-chart-svg" viewBox="0 0 300 300">
                            <rect x="8" y="8" width="284" height="284" class="kd-chart-bg" stroke-width="2" />
                            <line x1="8" y1="8" x2="292" y2="292" class="kd-chart-line" stroke-width="1.4" />
                            <line x1="292" y1="8" x2="8" y2="292" class="kd-chart-line" stroke-width="1.4" />
                            <polygon points="150,8 292,150 150,292 8,150" fill="none" class="kd-chart-line" stroke-width="1.5" />

                            @foreach ($report['divisionalCharts']['transits']['lagnaTransit']['houses'] as $hNum => $hData)
                                @php
                                    [$px, $py, $sx, $sy] = $slots[$hNum];
                                    $plText = collect($hData['planets'])->pluck('abbr')->implode(' ');
                                @endphp
                                <text x="{{ $sx }}" y="{{ $sy }}" class="kd-svg-house-num">{{ $hData['signNum'] }}</text>
                                @if ($plText)
                                    <text x="{{ $px }}" y="{{ $py }}" class="kd-svg-planet yellow">{{ $plText }}</text>
                                @endif
                            @endforeach
                        </svg>
                    </div>

                    <div class="kd-chart-box">
                        <div class="kd-chart-label">{{ $report['divisionalCharts']['transits']['moonTransit']['title'] }}</div>
                        <svg class="kd-chart-svg" viewBox="0 0 300 300">
                            <rect x="8" y="8" width="284" height="284" class="kd-chart-bg" stroke-width="2" />
                            <line x1="8" y1="8" x2="292" y2="292" class="kd-chart-line" stroke-width="1.4" />
                            <line x1="292" y1="8" x2="8" y2="292" class="kd-chart-line" stroke-width="1.4" />
                            <polygon points="150,8 292,150 150,292 8,150" fill="none" class="kd-chart-line" stroke-width="1.5" />

                            @foreach ($report['divisionalCharts']['transits']['moonTransit']['houses'] as $hNum => $hData)
                                @php
                                    [$px, $py, $sx, $sy] = $slots[$hNum];
                                    $plText = collect($hData['planets'])->pluck('abbr')->implode(' ');
                                @endphp
                                <text x="{{ $sx }}" y="{{ $sy }}" class="kd-svg-house-num">{{ $hData['signNum'] }}</text>
                                @if ($plText)
                                    <text x="{{ $px }}" y="{{ $py }}" class="kd-svg-planet orange">{{ $plText }}</text>
                                @endif
                            @endforeach
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==============================================
             TAB 3: PLANETARY POSITIONS (GRAHA SPASHTA)
             ============================================== -->
        <div class="kd-tab-content" id="tab-planets">
            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">Planetary Positions &amp; Status (Graha Spashta)</h2>
                        <p class="kd-card-subtitle">Exact sidereal degrees, nakshatras, dignities, and houses of all celestial bodies at your birth.</p>
                    </div>
                </div>

                <div class="kd-table-responsive">
                    <table class="kd-table">
                        <thead>
                            <tr>
                                <th>Planet</th>
                                <th>Sign (Rashi)</th>
                                <th>Sign Lord</th>
                                <th>Nakshatra</th>
                                <th>Naksh Lord</th>
                                <th>Degree</th>
                                <th>House</th>
                                <th>Motion</th>
                                <th>Combust</th>
                                <th>Dignity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong style="color: #e3b568;">Ascendant (Lagna)</strong></td>
                                <td>{{ $lagna['sign'] }}</td>
                                <td>{{ $lagna['lord'] }}</td>
                                <td>{{ $lagna['nakshatra'] }} (Pada {{ $lagna['pada'] }})</td>
                                <td>{{ $lagna['nakLord'] }}</td>
                                <td>{{ $lagna['degree'] }}° {{ sprintf('%02d', $lagna['minute']) }}′</td>
                                <td>1st House</td>
                                <td>—</td>
                                <td>—</td>
                                <td>—</td>
                            </tr>
                            @foreach ($allPlanets as $name => $p)
                                <tr>
                                    <td><strong>{{ $name }}</strong></td>
                                    <td>{{ $p['sign'] }}</td>
                                    <td>{{ $p['lord'] }}</td>
                                    <td>{{ $p['nakshatra'] }} (Pada {{ $p['pada'] }})</td>
                                    <td>{{ $p['nakLord'] }}</td>
                                    <td>{{ $p['degree'] }}° {{ sprintf('%02d', $p['minute']) }}′</td>
                                    <td>{{ \App\Helpers\KundliHelper::ORDINALS[$p['house']] ?? $p['house'] }} House</td>
                                    <td>{{ ($p['retro'] ?? false) ? 'Retrograde (R)' : 'Direct' }}</td>
                                    <td>{{ ($p['combust'] ?? false) ? 'Combust (Asta)' : 'No' }}</td>
                                    <td>
                                        @if (!empty($p['dignity']))
                                            <span class="kd-badge-active">{{ $p['dignity'] }}</span>
                                        @else
                                            —
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ==============================================
             TAB 4: KP ASTROLOGY SYSTEM
             ============================================== -->
        <div class="kd-tab-content" id="tab-kp">
            <div class="kd-grid-2">
                <div>
                    <div class="kd-card">
                        <div class="kd-card-header">
                            <h2 class="kd-card-title">KP Bhav Chalit Chart</h2>
                            <span class="kd-hero-tag">Bhava Madhyam</span>
                        </div>
                        <div class="kd-chart-box">
                            <svg class="kd-chart-svg" viewBox="0 0 300 300">
                                <rect x="8" y="8" width="284" height="284" class="kd-chart-bg" stroke-width="2" />
                                <line x1="8" y1="8" x2="292" y2="292" class="kd-chart-line" stroke-width="1.4" />
                                <line x1="292" y1="8" x2="8" y2="292" class="kd-chart-line" stroke-width="1.4" />
                                <polygon points="150,8 292,150 150,292 8,150" fill="none" class="kd-chart-line" stroke-width="1.5" />

                                @foreach ($report['divisionalCharts']['vargas']['BhavChalit']['houses'] as $hNum => $hData)
                                    @php
                                        [$px, $py, $sx, $sy] = $slots[$hNum];
                                        $plText = collect($hData['planets'])->pluck('abbr')->implode(' ');
                                    @endphp
                                    <text x="{{ $sx }}" y="{{ $sy }}" class="kd-svg-house-num">{{ $hData['signNum'] }}</text>
                                    @if ($plText)
                                        <text x="{{ $px }}" y="{{ $py }}" class="kd-svg-planet yellow">{{ $plText }}</text>
                                    @endif
                                @endforeach
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="kd-card">
                        <div class="kd-card-header">
                            <h2 class="kd-card-title">KP Ruling Planets</h2>
                            <span class="kd-hero-tag">Key Drivers</span>
                        </div>
                        <div class="kd-info-row"><span class="kd-label">Day Lord (Vara Natha)</span><span class="kd-value gold">{{ $kp['ruling']['dayLord'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Ascendant Sign Lord</span><span class="kd-value">{{ $kp['ruling']['ascSignLord'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Ascendant Star Lord</span><span class="kd-value">{{ $kp['ruling']['ascStarLord'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Ascendant Sub Lord</span><span class="kd-value gold">{{ $kp['ruling']['ascSubLord'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Moon Sign Lord</span><span class="kd-value">{{ $kp['ruling']['moonSignLord'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Moon Star Lord</span><span class="kd-value">{{ $kp['ruling']['moonStarLord'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-label">Moon Sub Lord</span><span class="kd-value gold">{{ $kp['ruling']['moonSubLord'] }}</span></div>
                    </div>
                </div>
            </div>

            <!-- KP Cusps Table -->
            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">KP 12 Bhava Cusps &amp; Sub Lords</h2>
                        <p class="kd-card-subtitle">Placidus Bhava Cusps with exact star lords and sub lords according to Krishnamurti Paddhati.</p>
                    </div>
                </div>
                <div class="kd-table-responsive">
                    <table class="kd-table">
                        <thead>
                            <tr>
                                <th>Cusp</th>
                                <th>Sign</th>
                                <th>Degree</th>
                                <th>Sign Lord</th>
                                <th>Star</th>
                                <th>Star Lord</th>
                                <th>Sub Lord</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kp['cusps'] as $c)
                                <tr>
                                    <td><strong>House {{ $c['cusp'] }}</strong></td>
                                    <td>{{ $c['sign'] }}</td>
                                    <td>{{ $c['degree'] }}°</td>
                                    <td>{{ $c['signLord'] }}</td>
                                    <td>{{ $c['star'] }}</td>
                                    <td>{{ $c['starLord'] }}</td>
                                    <td><strong style="color: #e3b568;">{{ $c['subLord'] }}</strong></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ==============================================
             TAB 5: ASHTAKVARGA SYSTEM
             ============================================== -->
        <div class="kd-tab-content" id="tab-ashtak">
            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">Sarvashtakvarga (SAV) &amp; Bhinna Ashtakvarga</h2>
                        <p class="kd-card-subtitle">Classical numerical benefic point evaluation (337 Bindus). Houses with 28+ points yield sustained strength.</p>
                    </div>
                </div>

                <div class="kd-ashtak-grid">
                    <!-- SAV -->
                    <div class="kd-ashtak-card" style="border: 2px solid var(--kd-gold);">
                        <div class="kd-ashtak-title">SAV (Total: {{ $ashtak['total'] }} Bindus)</div>
                        <svg class="kd-ashtak-svg" viewBox="0 0 260 260">
                            <rect x="4" y="4" width="252" height="252" class="kd-chart-bg" stroke-width="1.6" />
                            <line x1="4" y1="4" x2="256" y2="256" class="kd-chart-line" stroke-width="1.3" />
                            <line x1="256" y1="4" x2="4" y2="256" class="kd-chart-line" stroke-width="1.3" />
                            <polygon points="130,4 256,130 130,256 4,130" fill="none" class="kd-chart-line" stroke-width="1.4" />

                            @foreach ($ashtak['sav'] as $h => $pts)
                                <text x="{{ $ashtakCoords[$h][0] }}" y="{{ $ashtakCoords[$h][1] }}" class="pdf-svg-bindu">{{ $pts }}</text>
                            @endforeach
                        </svg>
                    </div>

                    <!-- 8 Bhinna charts -->
                    @foreach ($ashtak['bhinna'] as $pName => $bPts)
                        <div class="kd-ashtak-card">
                            <div class="kd-ashtak-title">{{ $pName }} Ashtakvarga</div>
                            <svg class="kd-ashtak-svg" viewBox="0 0 260 260">
                                <rect x="4" y="4" width="252" height="252" class="kd-chart-bg" stroke-width="1.6" />
                                <line x1="4" y1="4" x2="256" y2="256" class="kd-chart-line" stroke-width="1.3" />
                                <line x1="256" y1="4" x2="4" y2="256" class="kd-chart-line" stroke-width="1.3" />
                                <polygon points="130,4 256,130 130,256 4,130" fill="none" class="kd-chart-line" stroke-width="1.4" />

                                @foreach ($bPts as $h => $pts)
                                    <text x="{{ $ashtakCoords[$h][0] }}" y="{{ $ashtakCoords[$h][1] }}" class="pdf-svg-bindu">{{ $pts }}</text>
                                @endforeach
                            </svg>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ==============================================
             TAB 6: DIVISIONAL CHARTS (SHODASHVARGA 16)
             ============================================== -->
        <div class="kd-tab-content" id="tab-divisional">
            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">16 Divisional Charts (Shodashvarga)</h2>
                        <p class="kd-card-subtitle">Parashari harmonic divisions examining wealth, marriage, progeny, career, vehicles, and spirituality.</p>
                    </div>
                    <div class="kd-toggle-group">
                        <button type="button" class="kd-toggle-btn active" data-chart-mode="north">North Style</button>
                        <button type="button" class="kd-toggle-btn" data-chart-mode="south">South Style</button>
                    </div>
                </div>

                <!-- North Indian Divisional Charts Grid -->
                <div class="kd-divisional-grid kd-charts-north">
                    @foreach ($report['divisionalCharts']['vargas'] as $vKey => $vChart)
                        <div class="kd-ashtak-card">
                            <div class="kd-ashtak-title">{{ $vChart['num'] }} · {{ $vChart['title'] }}</div>
                            <svg class="kd-ashtak-svg" viewBox="0 0 260 260">
                                <rect x="4" y="4" width="252" height="252" class="kd-chart-bg" stroke-width="1.6" />
                                <line x1="4" y1="4" x2="256" y2="256" class="kd-chart-line" stroke-width="1.3" />
                                <line x1="256" y1="4" x2="4" y2="256" class="kd-chart-line" stroke-width="1.3" />
                                <polygon points="130,4 256,130 130,256 4,130" fill="none" class="kd-chart-line" stroke-width="1.4" />

                                @foreach ($vChart['houses'] as $hNum => $hData)
                                    @php
                                        $co = $ashtakCoords[$hNum];
                                        $plStr = collect($hData['planets'])->pluck('abbr')->implode(' ');
                                    @endphp
                                    <text x="{{ $co[0] }}" y="{{ $co[1] - 8 }}" class="kd-svg-house-num">{{ $hData['signNum'] }}</text>
                                    @if ($plStr)
                                        <text x="{{ $co[0] }}" y="{{ $co[1] + 8 }}" class="kd-svg-planet yellow">{{ $plStr }}</text>
                                    @endif
                                @endforeach
                            </svg>
                        </div>
                    @endforeach
                </div>

                <!-- South Indian Divisional Charts Grid -->
                <div class="kd-divisional-grid kd-charts-south">
                    @foreach ($report['divisionalCharts']['vargas'] as $vKey => $vChart)
                        <div class="kd-ashtak-card">
                            <div class="kd-ashtak-title">{{ $vChart['num'] }} · {{ $vChart['title'] }}</div>
                            <svg class="kd-ashtak-svg" viewBox="0 0 320 320">
                                <rect x="8" y="8" width="304" height="304" class="kd-chart-bg" stroke-width="2" rx="2" />
                                <line x1="84" y1="8" x2="84" y2="312" class="kd-chart-line" stroke-width="1.6" />
                                <line x1="160" y1="8" x2="160" y2="84" class="kd-chart-line" stroke-width="1.6" />
                                <line x1="160" y1="236" x2="160" y2="312" class="kd-chart-line" stroke-width="1.6" />
                                <line x1="236" y1="8" x2="236" y2="312" class="kd-chart-line" stroke-width="1.6" />
                                <line x1="8" y1="84" x2="312" y2="84" class="kd-chart-line" stroke-width="1.6" />
                                <line x1="8" y1="160" x2="84" y2="160" class="kd-chart-line" stroke-width="1.6" />
                                <line x1="236" y1="160" x2="312" y2="160" class="kd-chart-line" stroke-width="1.6" />
                                <line x1="8" y1="236" x2="312" y2="236" class="kd-chart-line" stroke-width="1.6" />
                                <rect x="84" y="84" width="152" height="152" class="kd-south-center" stroke-width="1.6" />
                                <circle cx="160" cy="160" r="3.5" fill="var(--kd-gold)" />

                                @foreach ([12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] as $bNum)
                                    <text x="{{ $boxCoords[$bNum]['x'] - 20 }}" y="{{ $boxCoords[$bNum]['y'] - 25 }}" class="kd-south-num">{{ $bNum }}</text>
                                @endforeach
                                @foreach ($vChart['houses'] as $hData)
                                    @php
                                        $sNum = $hData['signNum'];
                                        $pl = collect($hData['planets'])->pluck('abbr')->implode(' ');
                                    @endphp
                                    @if ($pl)
                                        <text x="{{ $boxCoords[$sNum]['x'] }}" y="{{ $boxCoords[$sNum]['y'] }}" class="kd-south-planet yellow">{{ $pl }}</text>
                                    @endif
                                @endforeach
                            </svg>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ==============================================
             TAB 7: DASHA SYSTEM (VIMSHOTTARI & YOGINI)
             ============================================== -->
        <div class="kd-tab-content" id="tab-dasha">
            <!-- Vimshottari Mahadashas -->
            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">120-Year Vimshottari Mahadasha Timeline</h2>
                        <p class="kd-card-subtitle">Cycles calculated from your natal Moon's exact longitude at birth.</p>
                    </div>
                </div>

                <div class="kd-table-responsive mb-4">
                    <table class="kd-table">
                        <thead>
                            <tr>
                                <th>Mahadasha</th>
                                <th>Duration</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dasha as $m)
                                <tr style="{{ $m['active'] ? 'background: rgba(227, 181, 104, 0.15);' : '' }}">
                                    <td><strong style="color: #e3b568;">{{ $m['planet'] }} ({{ $m['hindi'] }})</strong></td>
                                    <td>{{ $m['years'] }} Years</td>
                                    <td>{{ $m['start']->format('d M Y') }}</td>
                                    <td>{{ $m['end']->format('d M Y') }}</td>
                                    <td>
                                        @if ($m['active'])
                                            <span class="kd-badge-active">ACTIVE MAHADASHA</span>
                                        @elseif ($m['end']->isPast())
                                            Completed
                                        @else
                                            Upcoming
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Active Antardashas -->
                @if ($activeDasha)
                    <div class="kd-subbox">
                        <h3 class="kd-subbox-title">
                            Current Active Antardashas (Under {{ $activeDasha['planet'] }} Mahadasha)
                        </h3>
                        <div class="kd-table-responsive">
                            <table class="kd-table">
                                <thead>
                                    <tr>
                                        <th>Antardasha Lord</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activeDasha['antardashas'] as $a)
                                        <tr class="{{ $a['active'] ? 'kd-row-active' : '' }}">
                                            <td><strong>{{ $activeDasha['planet'] }} - {{ $a['planet'] }}</strong></td>
                                            <td>{{ $a['start']->format('d M Y') }}</td>
                                            <td>{{ $a['end']->format('d M Y') }}</td>
                                            <td>
                                                @if ($a['active'])
                                                    <span class="kd-badge-active">RUNNING NOW</span>
                                                @elseif ($a['end']->isPast())
                                                    Completed
                                                @else
                                                    Upcoming
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Yogini Dasha -->
            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">Yogini Dasha (36-Year Repeating Cycle)</h2>
                        <p class="kd-card-subtitle">Eight Yogini periods representing distinct spiritual and material planetary phases.</p>
                    </div>
                </div>
                <div class="kd-table-responsive">
                    <table class="kd-table">
                        <thead>
                            <tr>
                                <th>Yogini</th>
                                <th>Governing Planet</th>
                                <th>Span</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($yogini as $y)
                                <tr class="{{ $y['active'] ? 'kd-row-active' : '' }}">
                                    <td><strong>{{ ucfirst($y['name']) }}</strong></td>
                                    <td>{{ $y['lord'] }}</td>
                                    <td>{{ $y['years'] }} Years</td>
                                    <td>{{ $y['start'] }}</td>
                                    <td>{{ $y['end'] }}</td>
                                    <td>
                                        @if ($y['active'])
                                            <span class="kd-badge-active">ACTIVE NOW</span>
                                        @else
                                            —
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ==============================================
             TAB 8: PREDICTIONS, YOGAS & REMEDIES
             ============================================== -->
        <div class="kd-tab-content" id="tab-predictions">
            <!-- Ascendant Predictions -->
            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">Ascendant Predictions ({{ $lagna['sign'] }} Lagna)</h2>
                        <p class="kd-card-subtitle">Vedic character, personality traits, career inclinations, and relationship outlook.</p>
                    </div>
                </div>
                <div class="kd-pred-grid">
                    <div class="kd-pred-card">
                        <h3 class="kd-pred-title">Personality &amp; Outlook</h3>
                        <p class="kd-pred-body">{{ $predictions['ascendant']['personality'] }}</p>
                    </div>
                    <div class="kd-pred-card">
                        <h3 class="kd-pred-title">Physical Appearance &amp; Vitality</h3>
                        <p class="kd-pred-body">{{ $predictions['ascendant']['physical'] }}</p>
                    </div>
                    <div class="kd-pred-card">
                        <h3 class="kd-pred-title">Career &amp; Professional Trajectory</h3>
                        <p class="kd-pred-body">{{ $predictions['ascendant']['career'] }}</p>
                    </div>
                    <div class="kd-pred-card">
                        <h3 class="kd-pred-title">Love, Marriage &amp; Partnerships</h3>
                        <p class="kd-pred-body">{{ $predictions['ascendant']['relationship'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Vedic Yogas -->
            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">Vedic Yoga Combinations</h2>
                        <p class="kd-card-subtitle">Special planetary conjunctions and alignments discovered in your Janam Kundli.</p>
                    </div>
                </div>
                <div class="kd-pred-grid">
                    @forelse ($yogas as $yoga)
                        <div class="kd-pred-card">
                            <h3 class="kd-pred-title">✨ {{ $yoga['name'] }}</h3>
                            <p class="kd-pred-body">{{ $yoga['desc'] }}</p>
                        </div>
                    @empty
                        <div class="kd-pred-card" style="grid-column: 1 / -1;">
                            <p class="kd-pred-body">Your planetary alignments create a well-balanced, harmonious flow across the houses.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Rudraksha & Gemstone Remedies -->
            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">Sacred Remedies &amp; Gemstones</h2>
                        <p class="kd-card-subtitle">Vedic recommendations tailored to your rising Ascendant and Janma Nakshatra.</p>
                    </div>
                </div>

                <!-- Rudraksha -->
                <div class="kd-rudraksha-box">
                    <h3 class="kd-rudraksha-title">
                        Recommended Rudraksha: {{ $rudraksha['mukhis'] }}
                    </h3>
                    <p class="kd-rudraksha-desc">
                        Having been born under <strong>{{ $panchang['nakshatra'] }}</strong> ruled by {{ $panchang['nakshatraLord'] }}, wearing {{ $rudraksha['primary'] }} Rudraksha (presided by {{ $rudraksha['deity'] }}) purges past karmic blocks and shields you against negative energies. {{ $rudraksha['benefits'] }}
                    </p>
                </div>

                <!-- Gemstones Grid -->
                <div class="kd-grid-3">
                    <div class="kd-gemstone-card">
                        <div>
                            <h3 class="kd-gemstone-title">Life Stone (Lagna Lord)</h3>
                            <p class="kd-gemstone-text">Strengthens physical vitality, personal confidence, social stature, and all-round growth.</p>
                        </div>
                        <div>
                            <div class="kd-info-row"><span class="kd-label">Gemstone</span><span class="kd-value gold">{{ $gemstones['life']['gem'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-label">Metal &amp; Finger</span><span class="kd-value">{{ $gemstones['life']['metal'] }}, {{ $gemstones['life']['finger'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-label">Beej Mantra</span><span class="kd-value" style="font-size: 11px;">{{ $gemstones['life']['mantra'] }}</span></div>
                        </div>
                    </div>

                    <div class="kd-gemstone-card">
                        <div>
                            <h3 class="kd-gemstone-title">Lucky Stone (Bhagya Vardhak)</h3>
                            <p class="kd-gemstone-text">Multiplies auspicious opportunities, resolves persistent hurdles, and invites divine grace.</p>
                        </div>
                        <div>
                            <div class="kd-info-row"><span class="kd-label">Gemstone</span><span class="kd-value gold">{{ $gemstones['lucky']['gem'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-label">Metal &amp; Finger</span><span class="kd-value">{{ $gemstones['lucky']['metal'] }}, {{ $gemstones['lucky']['finger'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-label">Beej Mantra</span><span class="kd-value" style="font-size: 11px;">{{ $gemstones['lucky']['mantra'] }}</span></div>
                        </div>
                    </div>

                    <div class="kd-gemstone-card">
                        <div>
                            <h3 class="kd-gemstone-title">Fortune Stone (9th House)</h3>
                            <p class="kd-gemstone-text">Fosters higher spiritual awareness, luck in ambitious commercial ventures, and lasting fortune.</p>
                        </div>
                        <div>
                            <div class="kd-info-row"><span class="kd-label">Gemstone</span><span class="kd-value gold">{{ $gemstones['fortune']['gem'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-label">Metal &amp; Finger</span><span class="kd-value">{{ $gemstones['fortune']['metal'] }}, {{ $gemstones['fortune']['finger'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-label">Beej Mantra</span><span class="kd-value" style="font-size: 11px;">{{ $gemstones['fortune']['mantra'] }}</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dosha Analysis -->
            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">Major Dosha Clearance Verification</h2>
                        <p class="kd-card-subtitle">Comprehensive Vedic verification of Mangal Dosha, Kaal Sarp Dosha, and Shani Sade Sati.</p>
                    </div>
                </div>

                <div class="kd-dosha-row">
                    <div>
                        <h3 class="kd-dosha-name">Manglik Dosha</h3>
                        <p class="kd-dosha-desc">
                            {{ $doshas['mangal']['summary'] }}
                        </p>
                    </div>
                    <span class="{{ $doshas['mangal']['safe'] ? 'kd-badge-safe' : 'kd-badge-alert' }}">
                        {{ strtoupper($doshas['mangal']['status']) }}
                    </span>
                </div>

                <div class="kd-dosha-row">
                    <div>
                        <h3 class="kd-dosha-name">Kaal Sarp Dosha</h3>
                        <p class="kd-dosha-desc">
                            {{ $doshas['kaalSarp']['summary'] }}
                        </p>
                    </div>
                    <span class="{{ $doshas['kaalSarp']['level'] === 'none' ? 'kd-badge-safe' : 'kd-badge-alert' }}">
                        {{ strtoupper($doshas['kaalSarp']['status']) }}
                    </span>
                </div>

                <div class="kd-dosha-row">
                    <div>
                        <h3 class="kd-dosha-name">Shani Sade Sati Status</h3>
                        <p class="kd-dosha-desc">
                            {{ !empty($doshas['sadeSati']['current']) ? 'Saturn is currently in ' . $doshas['sadeSati']['current']['sign'] . ' (' . $doshas['sadeSati']['current']['phase'] . ').' : 'Natal Moon is outside the influence of the current Saturn transit. Sade Sati is inactive.' }}
                        </p>
                    </div>
                    <span class="{{ !empty($doshas['sadeSati']['current']) ? 'kd-badge-alert' : 'kd-badge-safe' }}">
                        {{ !empty($doshas['sadeSati']['current']) ? 'ACTIVE (' . strtoupper($doshas['sadeSati']['current']['phase']) . ')' : 'CURRENTLY INACTIVE (CLEARED)' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Astrologer Promo Banner -->
        <div class="kd-astrologer-banner">
            <h3>Want deeper personalized insights into your Kundli?</h3>
            <p>Our verified Vedic astrologers decode your dasha transitions, career prospects, relationship compatibility, and remedial gemstones with complete confidentiality.</p>
            <div style="display: flex; justify-content: center; gap: 14px; flex-wrap: wrap;">
                <a href="{{ route('talk-to-astrologers') }}" class="kd-btn-pdf">
                    📞 Talk to Astrologer
                </a>
                <a href="{{ route('chat-with-astrologers') }}" class="kd-btn-outline">
                    💬 Chat with Astrologer
                </a>
            </div>
        </div>

        <!-- Cross-Linking: Related Guides & Free Astrology Tools -->
        <div class="fk-tags-section">
            <div class="fk-tags-cat-title">EXPLORE VEDIC ASTROLOGY GUIDES (5 CHAPTERS)</div>
            <div class="fk-tags-wrap" style="margin-bottom: 24px;">
                <a href="{{ route('guide.read-kundli') }}" class="fk-tag-pill">
                    How to Read Kundli Online <span class="fk-pill-arrow">→</span>
                </a>
                <a href="{{ route('guide.read-houses') }}" class="fk-tag-pill">
                    How to Read Houses in Kundli <span class="fk-pill-arrow">→</span>
                </a>
                <a href="{{ route('guide.read-planets') }}" class="fk-tag-pill">
                    How to Read Planets in Astrology <span class="fk-pill-arrow">→</span>
                </a>
                <a href="{{ route('guide.planets-signs-houses') }}" class="fk-tag-pill">
                    Planets, Signs &amp; Houses in Astrology <span class="fk-pill-arrow">→</span>
                </a>
                <a href="{{ route('guide.planets-signs-significance') }}" class="fk-tag-pill">
                    Planets, Signs and Their Significance <span class="fk-pill-arrow">→</span>
                </a>
            </div>

            <div class="fk-tags-cat-title">OTHER POPULAR FREE CALCULATORS &amp; SERVICES</div>
            <div class="fk-tags-wrap">
                <a href="{{ route('kundli-matching') }}" class="fk-tag-pill">💞 Kundli Matching</a>
                <a href="{{ route('compatibility') }}" class="fk-tag-pill">♊ Compatibility</a>
                <a href="{{ route('tarot') }}" class="fk-tag-pill">🔮 Tarot Reading</a>
                <a href="{{ route('love-calculator') }}" class="fk-tag-pill">❤️ Love Calculator</a>
                <a href="{{ route('mangal-dosha-calculator') }}" class="fk-tag-pill">🔥 Mangal Dosha</a>
                <a href="{{ route('shani-sade-sati-calculator') }}" class="fk-tag-pill">🪐 Shani Sade Sati</a>
                <a href="{{ route('kaal-sarp-dosh-calculator') }}" class="fk-tag-pill">🐍 Kaal Sarp Dosh</a>
                <a href="{{ route('dasha-calculator') }}" class="fk-tag-pill">⏳ Dasha Calculator</a>
                <a href="{{ route('nakshatra-calculator') }}" class="fk-tag-pill">✨ Nakshatra Finder</a>
                <a href="{{ route('sun-sign-calculator') }}" class="fk-tag-pill">☀️ Sun Sign</a>
                <a href="{{ route('rashi-calculator') }}" class="fk-tag-pill">🌙 Moon Sign (Rashi)</a>
                <a href="{{ route('numerology-calculator') }}" class="fk-tag-pill">🔢 Numerology Calculator</a>
                <a href="{{ route('atmakaraka-darakaraka-calculator') }}" class="fk-tag-pill">👑 Atmakaraka Calculator</a>
                <a href="{{ route('birth-chart-calculator') }}" class="fk-tag-pill">🗺️ Birth Chart</a>
            </div>
        </div>

    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Tab switching logic
        const tabBtns = document.querySelectorAll('.kd-tab-btn');
        const tabContents = document.querySelectorAll('.kd-tab-content');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const target = btn.dataset.tab;
                tabBtns.forEach(b => b.classList.remove('active'));
                tabContents.forEach(tc => tc.classList.remove('active'));

                btn.classList.add('active');
                const content = document.getElementById(target);
                if (content) {
                    content.classList.add('active');
                }
            });
        });

        // North vs South Indian Charts Toggle
        const toggleButtons = document.querySelectorAll('.kd-toggle-btn');
        toggleButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const mode = btn.dataset.chartMode;
                toggleButtons.forEach(b => {
                    b.classList.toggle('active', b.dataset.chartMode === mode);
                });
                if (mode === 'south') {
                    document.body.classList.add('show-south-charts');
                } else {
                    document.body.classList.remove('show-south-charts');
                }
            });
        });
    });
</script>

@endsection
