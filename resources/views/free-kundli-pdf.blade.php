<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>{{ $name }}'s Kundli — Complete Vedic PDF Report | AstroHero</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/pdf-report.css') }}?v={{ time() }}">
</head>

<body>

    <!-- TOP STICKY ACTION BAR (Back to Kundli + Download PDF) -->
    <header class="pdf-top-bar" id="pdf-top-bar">
        <div class="pdf-bar-inner">
            <a href="{{ route('free-kundli-report', request()->all()) }}" class="pdf-brand">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="10" stroke="#e3b568" stroke-width="1.8" />
                    <circle cx="12" cy="12" r="6" fill="#e3b568" fill-opacity="0.25" stroke="#e3b568" stroke-width="1.4" />
                    <path d="M12 2L12 6M12 18L12 22M2 12L6 12M18 12L22 12" stroke="#e3b568" stroke-width="1.4" stroke-linecap="round" />
                    <circle cx="12" cy="12" r="2.5" fill="#f2d9a8" />
                </svg>
                <span class="pdf-brand-text">AstroHero</span>
            </a>

            <div class="pdf-actions">
                <a href="{{ route('free-kundli-report', request()->all()) }}" class="btn-back-kundli" id="btn-back-kundli">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5"></path>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Back to Kundli
                </a>

                <button onclick="window.print()" class="btn-download-pdf" id="btn-download-pdf">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                        <rect x="6" y="14" width="12" height="8"></rect>
                    </svg>
                    Download PDF
                </button>
            </div>
        </div>
    </header>

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

        // House slots [x, y, signX, signY] for North Indian chart
        $slots = [
            1  => [150, 75,  150, 38],  2  => [75, 38,   75, 24],   3  => [28, 75,   24, 75],
            4  => [75, 150,  40, 150],  5  => [28, 225,  24, 225],  6  => [75, 260,  75, 276],
            7  => [150, 225, 150, 260], 8  => [225, 260, 225, 276], 9  => [270, 225, 276, 225],
            10 => [225, 150, 260, 150], 11 => [270, 75,  276, 75],  12 => [225, 38,  225, 24],
        ];

        $planetColors = [
            'Sun' => 'orange', 'Moon' => 'yellow', 'Mars' => 'peach', 'Mercury' => 'green',
            'Jupiter' => 'yellow', 'Venus' => 'pink', 'Saturn' => 'yellow', 'Rahu' => 'blue',
            'Ketu' => 'blue', 'Uranus' => 'blue', 'Neptune' => 'pink', 'Pluto' => 'pink'
        ];
    @endphp

    <main class="pdf-page-wrapper">
        <article class="pdf-document" id="pdf-document">

            <!-- Decorative Watermark Emblem -->
            <svg class="pdf-watermark" viewBox="0 0 200 200">
                <circle cx="100" cy="100" r="90" fill="none" stroke="#b8862d" stroke-width="2" />
                <circle cx="100" cy="100" r="65" fill="none" stroke="#b8862d" stroke-width="1.5" />
                <polygon points="100,10 190,100 100,190 10,100" fill="none" stroke="#b8862d" stroke-width="1.5" />
                <polygon points="100,35 165,100 100,165 35,100" fill="none" stroke="#b8862d" stroke-width="1.5" />
            </svg>

            <div class="pdf-content">

                <!-- DOCUMENT HEADER -->
                <header class="pdf-doc-header">
                    <div class="pdf-doc-logo">
                        <svg viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="10" stroke="#b8862d" stroke-width="1.8" />
                            <circle cx="12" cy="12" r="6" fill="#e3b568" fill-opacity="0.3" stroke="#b8862d" stroke-width="1.4" />
                            <path d="M12 2L12 6M12 18L12 22M2 12L6 12M18 12L22 12" stroke="#b8862d" stroke-width="1.4" stroke-linecap="round" />
                            <circle cx="12" cy="12" r="2.5" fill="#b8862d" />
                        </svg>
                        <span class="pdf-doc-brand">ASTROHERO VEDIC REPORT</span>
                    </div>
                    <h1 class="pdf-doc-title" id="pdf-doc-title">{{ $name }}'s Kundli</h1>
                    <p class="pdf-doc-meta" id="pdf-doc-meta">
                        {{ $birth->format('d M Y') }} · {{ $timeUnknown ? '12:00 PM (Approx)' : $birth->format('h:i A') }} · {{ $place }} ({{ $latFmt }}, {{ $lngFmt }})
                    </p>
                    <div class="pdf-doc-badge-bar">
                        <span class="pdf-doc-tag">Full Vedic Kundli Report</span>
                        <span class="pdf-doc-tag">Ayanamsha: Lahiri</span>
                        <span class="pdf-doc-tag">Whole-Sign System</span>
                    </div>
                </header>

                <!-- SECTION 1: BIRTH DETAILS & PANCHANG -->
                <section class="pdf-section">
                    <div class="pdf-section-header">
                        <h2 class="pdf-section-title">01 · Birth Details &amp; Panchang</h2>
                        <span class="pdf-section-sub">Basic Planetary Almanac</span>
                    </div>

                    <div class="pdf-grid-2col">
                        <div class="pdf-box">
                            <h3 class="pdf-box-title">Birth Details</h3>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Name</span>
                                <span class="pdf-value">{{ $name }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Gender</span>
                                <span class="pdf-value">{{ ucfirst($gender) }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Date of Birth</span>
                                <span class="pdf-value">{{ $birth->format('d M Y') }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Time of Birth</span>
                                <span class="pdf-value">{{ $timeUnknown ? '12:00 PM (Noon)' : $birth->format('h:i A') }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Place of Birth</span>
                                <span class="pdf-value">{{ $place }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Latitude</span>
                                <span class="pdf-value">{{ $latFmt }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Longitude</span>
                                <span class="pdf-value">{{ $lngFmt }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Timezone</span>
                                <span class="pdf-value">GMT +05:30</span>
                            </div>
                        </div>

                        <div class="pdf-box">
                            <h3 class="pdf-box-title">Panchang</h3>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Tithi</span>
                                <span class="pdf-value">{{ $panchang['tithi'] }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Karana</span>
                                <span class="pdf-value">{{ $panchang['karana'] }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Yoga</span>
                                <span class="pdf-value">{{ $panchang['yoga'] }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Nakshatra</span>
                                <span class="pdf-value gold">{{ $panchang['nakshatra'] }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Nakshatra Lord</span>
                                <span class="pdf-value">{{ $panchang['nakshatraLord'] }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Ascendant (Lagna)</span>
                                <span class="pdf-value gold">{{ $lagna['sign'] }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Ascendant Lord</span>
                                <span class="pdf-value">{{ $lagna['lord'] }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Sunrise / Sunset</span>
                                <span class="pdf-value">{{ $panchang['sunrise'] }} / {{ $panchang['sunset'] }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Avakhada Details -->
                    <div class="pdf-box">
                        <h3 class="pdf-box-title">Avakhada Chakra Details</h3>
                        <div class="pdf-grid-3col" style="margin-bottom: 0;">
                            <div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Varna</span>
                                    <span class="pdf-value">{{ $avakhada['varna'] }}</span>
                                </div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Gan</span>
                                    <span class="pdf-value">{{ $avakhada['gan'] }}</span>
                                </div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Sign Lord</span>
                                    <span class="pdf-value">{{ $avakhada['signLord'] }}</span>
                                </div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Name Alphabet</span>
                                    <span class="pdf-value gold">{{ $avakhada['nameAlphabet'] }}</span>
                                </div>
                            </div>
                            <div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Vashya</span>
                                    <span class="pdf-value">{{ $avakhada['vashya'] }}</span>
                                </div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Nadi</span>
                                    <span class="pdf-value">{{ $avakhada['nadi'] }}</span>
                                </div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Charan</span>
                                    <span class="pdf-value">{{ $avakhada['charan'] }}</span>
                                </div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Paya</span>
                                    <span class="pdf-value">{{ $avakhada['paya'] }}</span>
                                </div>
                            </div>
                            <div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Yoni</span>
                                    <span class="pdf-value">{{ $avakhada['yoni'] }}</span>
                                </div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Rashi (Moon Sign)</span>
                                    <span class="pdf-value gold">{{ $avakhada['sign'] }}</span>
                                </div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Tatva</span>
                                    <span class="pdf-value">{{ $avakhada['tatva'] }}</span>
                                </div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Yunja</span>
                                    <span class="pdf-value">{{ $avakhada['yunja'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- SECTION 2: LAGNA & NAVAMSHA CHARTS -->
                <section class="pdf-section">
                    <div class="pdf-section-header">
                        <h2 class="pdf-section-title">02 · Lagna &amp; Navamsha Charts</h2>
                        <span class="pdf-section-sub">D-1 &amp; D-9 Birth Kundlis</span>
                    </div>

                    <div class="pdf-charts-pair">
                        <!-- Lagna Chart D-1 -->
                        <div class="pdf-chart-card">
                            <div class="pdf-chart-label">Lagna Kundli (D-1 Rashi)</div>
                            <svg class="pdf-chart-svg" viewBox="0 0 300 300">
                                <rect x="8" y="8" width="284" height="284" fill="#fcfbf7" stroke="#c29744" stroke-width="1.8" />
                                <line x1="8" y1="8" x2="292" y2="292" stroke="#c29744" stroke-width="1.2" />
                                <line x1="292" y1="8" x2="8" y2="292" stroke="#c29744" stroke-width="1.2" />
                                <polygon points="150,8 292,150 150,292 8,150" fill="none" stroke="#c29744" stroke-width="1.4" />

                                @foreach ($report['divisionalCharts']['vargas']['D1']['houses'] as $hNum => $hData)
                                    @php
                                        [$px, $py, $sx, $sy] = $slots[$hNum];
                                        $plText = collect($hData['planets'])->pluck('abbr')->implode(' ');
                                    @endphp
                                    <text x="{{ $sx }}" y="{{ $sy }}" class="pdf-svg-num">{{ $hData['signNum'] }}</text>
                                    @if ($plText)
                                        <text x="{{ $px }}" y="{{ $py }}" class="pdf-svg-planet yellow">{{ $plText }}</text>
                                    @endif
                                @endforeach
                            </svg>
                        </div>

                        <!-- Navamsha Chart D-9 -->
                        <div class="pdf-chart-card">
                            <div class="pdf-chart-label">Navamsha Kundli (D-9 Dharma)</div>
                            <svg class="pdf-chart-svg" viewBox="0 0 300 300">
                                <rect x="8" y="8" width="284" height="284" fill="#fcfbf7" stroke="#c29744" stroke-width="1.8" />
                                <line x1="8" y1="8" x2="292" y2="292" stroke="#c29744" stroke-width="1.2" />
                                <line x1="292" y1="8" x2="8" y2="292" stroke="#c29744" stroke-width="1.2" />
                                <polygon points="150,8 292,150 150,292 8,150" fill="none" stroke="#c29744" stroke-width="1.4" />

                                @foreach ($report['divisionalCharts']['vargas']['D9']['houses'] as $hNum => $hData)
                                    @php
                                        [$px, $py, $sx, $sy] = $slots[$hNum];
                                        $plText = collect($hData['planets'])->pluck('abbr')->implode(' ');
                                    @endphp
                                    <text x="{{ $sx }}" y="{{ $sy }}" class="pdf-svg-num">{{ $hData['signNum'] }}</text>
                                    @if ($plText)
                                        <text x="{{ $px }}" y="{{ $py }}" class="pdf-svg-planet green">{{ $plText }}</text>
                                    @endif
                                @endforeach
                            </svg>
                        </div>
                    </div>

                    <!-- Planetary Positions Table -->
                    <div class="pdf-box" style="padding: 12px;">
                        <h3 class="pdf-box-title">Planetary Positions &amp; Status</h3>
                        <div class="pdf-table-wrap">
                            <table class="pdf-table">
                                <thead>
                                    <tr>
                                        <th>Planet</th>
                                        <th>Sign</th>
                                        <th>Sign Lord</th>
                                        <th>Nakshatra</th>
                                        <th>Nakshatra Lord</th>
                                        <th>Degree</th>
                                        <th>House</th>
                                        <th>Retro</th>
                                        <th>Combust</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Ascendant</strong></td>
                                        <td>{{ $lagna['sign'] }}</td>
                                        <td>{{ $lagna['lord'] }}</td>
                                        <td>{{ $lagna['nakshatra'] }}</td>
                                        <td>{{ $lagna['nakLord'] }}</td>
                                        <td>{{ $lagna['degree'] }}° {{ sprintf('%02d', $lagna['minute']) }}'</td>
                                        <td>1st</td>
                                        <td>—</td>
                                        <td>—</td>
                                    </tr>
                                    @foreach ($allPlanets as $pName => $p)
                                        <tr>
                                            <td><strong>{{ $pName }}</strong></td>
                                            <td>{{ $p['sign'] }}</td>
                                            <td>{{ $p['lord'] }}</td>
                                            <td>{{ $p['nakshatra'] }}</td>
                                            <td>{{ $p['nakLord'] }}</td>
                                            <td>{{ $p['degree'] }}° {{ sprintf('%02d', $p['minute']) }}'</td>
                                            <td>{{ \App\Helpers\KundliHelper::ORDINALS[$p['house']] ?? $p['house'] }}</td>
                                            <td>{{ ($p['retro'] ?? false) ? 'Yes (R)' : 'No' }}</td>
                                            <td>{{ ($p['combust'] ?? false) ? 'Yes (Asta)' : 'No' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- SECTION 3: KP ASTROLOGY SYSTEM -->
                <section class="pdf-section">
                    <div class="pdf-section-header">
                        <h2 class="pdf-section-title">03 · KP Astrology (Krishnamurti Paddhati)</h2>
                        <span class="pdf-section-sub">Ruling Planets &amp; 12 Bhava Cusps</span>
                    </div>

                    <div class="pdf-grid-2col">
                        <!-- Bhav Chalit Chart -->
                        <div class="pdf-chart-card">
                            <div class="pdf-chart-label">KP Bhav Chalit Chart</div>
                            <svg class="pdf-chart-svg" viewBox="0 0 300 300">
                                <rect x="8" y="8" width="284" height="284" fill="#fcfbf7" stroke="#c29744" stroke-width="1.8" />
                                <line x1="8" y1="8" x2="292" y2="292" stroke="#c29744" stroke-width="1.2" />
                                <line x1="292" y1="8" x2="8" y2="292" stroke="#c29744" stroke-width="1.2" />
                                <polygon points="150,8 292,150 150,292 8,150" fill="none" stroke="#c29744" stroke-width="1.4" />

                                @foreach ($report['divisionalCharts']['vargas']['BhavChalit']['houses'] as $hNum => $hData)
                                    @php
                                        [$px, $py, $sx, $sy] = $slots[$hNum];
                                        $plText = collect($hData['planets'])->pluck('abbr')->implode(' ');
                                    @endphp
                                    <text x="{{ $sx }}" y="{{ $sy }}" class="pdf-svg-num">{{ $hData['signNum'] }}</text>
                                    @if ($plText)
                                        <text x="{{ $px }}" y="{{ $py }}" class="pdf-svg-planet yellow">{{ $plText }}</text>
                                    @endif
                                @endforeach
                            </svg>
                        </div>

                        <!-- KP Ruling Planets -->
                        <div class="pdf-box">
                            <h3 class="pdf-box-title">KP Ruling Planets</h3>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Day Lord (Vara Natha)</span>
                                <span class="pdf-value gold">{{ $kp['ruling']['dayLord'] }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Ascendant Sign Lord</span>
                                <span class="pdf-value">{{ $kp['ruling']['ascSignLord'] }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Ascendant Star Lord</span>
                                <span class="pdf-value">{{ $kp['ruling']['ascStarLord'] }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Ascendant Sub Lord</span>
                                <span class="pdf-value gold">{{ $kp['ruling']['ascSubLord'] }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Moon Sign Lord</span>
                                <span class="pdf-value">{{ $kp['ruling']['moonSignLord'] }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Moon Star Lord</span>
                                <span class="pdf-value">{{ $kp['ruling']['moonStarLord'] }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Moon Sub Lord</span>
                                <span class="pdf-value gold">{{ $kp['ruling']['moonSubLord'] }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- KP Cusps Table -->
                    <div class="pdf-box" style="padding: 12px;">
                        <h3 class="pdf-box-title">KP 12 Bhava Cusps &amp; Sub Lords</h3>
                        <div class="pdf-table-wrap">
                            <table class="pdf-table">
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
                                            <td><strong>Cusp {{ $c['cusp'] }}</strong></td>
                                            <td>{{ $c['sign'] }}</td>
                                            <td>{{ $c['degree'] }}°</td>
                                            <td>{{ $c['signLord'] }}</td>
                                            <td>{{ $c['star'] }}</td>
                                            <td>{{ $c['starLord'] }}</td>
                                            <td><strong style="color: var(--gold);">{{ $c['subLord'] }}</strong></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- SECTION 4: ASHTAKVARGA SYSTEM -->
                <section class="pdf-section">
                    <div class="pdf-section-header">
                        <h2 class="pdf-section-title">04 · Ashtakvarga System</h2>
                        <span class="pdf-section-sub">Total 337 Bindus &amp; Bhinna Ashtakvarga</span>
                    </div>

                    <div class="pdf-ashtak-grid">
                        <!-- SAV -->
                        <div class="pdf-ashtak-item">
                            <div class="pdf-ashtak-title">SAV (Total: {{ $ashtak['total'] }})</div>
                            <svg class="pdf-chart-svg" viewBox="0 0 260 260">
                                <rect x="4" y="4" width="252" height="252" fill="#faf8f5" stroke="#c29744" stroke-width="1.4" />
                                <line x1="4" y1="4" x2="256" y2="256" stroke="#c29744" stroke-width="1.1" />
                                <line x1="256" y1="4" x2="4" y2="256" stroke="#c29744" stroke-width="1.1" />
                                <polygon points="130,4 256,130 130,256 4,130" fill="none" stroke="#c29744" stroke-width="1.2" />

                                @php
                                    $ashtakCoords = [
                                        1 => [130, 65], 2 => [65, 24], 3 => [24, 65], 4 => [65, 130],
                                        5 => [24, 195], 6 => [65, 238], 7 => [130, 195], 8 => [195, 238],
                                        9 => [238, 195], 10 => [195, 130], 11 => [238, 65], 12 => [195, 24]
                                    ];
                                @endphp
                                @foreach ($ashtak['sav'] as $h => $pts)
                                    <text x="{{ $ashtakCoords[$h][0] }}" y="{{ $ashtakCoords[$h][1] }}" class="pdf-svg-bindu">{{ $pts }}</text>
                                @endforeach
                            </svg>
                        </div>

                        <!-- 8 Bhinna charts -->
                        @foreach ($ashtak['bhinna'] as $pName => $bPts)
                            <div class="pdf-ashtak-item">
                                <div class="pdf-ashtak-title">{{ $pName }} Ashtakvarga</div>
                                <svg class="pdf-chart-svg" viewBox="0 0 260 260">
                                    <rect x="4" y="4" width="252" height="252" fill="#faf8f5" stroke="#c29744" stroke-width="1.4" />
                                    <line x1="4" y1="4" x2="256" y2="256" stroke="#c29744" stroke-width="1.1" />
                                    <line x1="256" y1="4" x2="4" y2="256" stroke="#c29744" stroke-width="1.1" />
                                    <polygon points="130,4 256,130 130,256 4,130" fill="none" stroke="#c29744" stroke-width="1.2" />

                                    @foreach ($bPts as $h => $pts)
                                        <text x="{{ $ashtakCoords[$h][0] }}" y="{{ $ashtakCoords[$h][1] }}" class="pdf-svg-bindu">{{ $pts }}</text>
                                    @endforeach
                                </svg>
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- SECTION 5: DIVISIONAL CHARTS (HIGHLIGHTS) -->
                <section class="pdf-section">
                    <div class="pdf-section-header">
                        <h2 class="pdf-section-title">05 · Divisional Charts (Shodashvarga Highlights)</h2>
                        <span class="pdf-section-sub">D-1, D-9, D-10, D-7, D-4 &amp; D-60</span>
                    </div>

                    <div class="pdf-grid-3col">
                        @foreach (['D1', 'D9', 'D10', 'D7', 'D4', 'D60'] as $vKey)
                            @php $vChart = $report['divisionalCharts']['vargas'][$vKey]; @endphp
                            <div class="pdf-chart-card">
                                <div class="pdf-chart-label">{{ $vChart['num'] }} · {{ $vChart['title'] }}</div>
                                <svg class="pdf-chart-svg" viewBox="0 0 260 260">
                                    <rect x="4" y="4" width="252" height="252" fill="#fcfbf7" stroke="#c29744" stroke-width="1.4" />
                                    <line x1="4" y1="4" x2="256" y2="256" stroke="#c29744" stroke-width="1.1" />
                                    <line x1="256" y1="4" x2="4" y2="256" stroke="#c29744" stroke-width="1.1" />
                                    <polygon points="130,4 256,130 130,256 4,130" fill="none" stroke="#c29744" stroke-width="1.2" />

                                    @foreach ($vChart['houses'] as $hNum => $hData)
                                        @php
                                            $co = $ashtakCoords[$hNum];
                                            $plStr = collect($hData['planets'])->pluck('abbr')->implode(' ');
                                        @endphp
                                        <text x="{{ $co[0] }}" y="{{ $co[1] - 8 }}" class="pdf-svg-num">{{ $hData['signNum'] }}</text>
                                        @if ($plStr)
                                            <text x="{{ $co[0] }}" y="{{ $co[1] + 8 }}" class="pdf-svg-planet yellow">{{ $plStr }}</text>
                                        @endif
                                    @endforeach
                                </svg>
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- SECTION 6: DASHA TIMELINES -->
                <section class="pdf-section">
                    <div class="pdf-section-header">
                        <h2 class="pdf-section-title">06 · Vimshottari &amp; Yogini Dasha Timelines</h2>
                        <span class="pdf-section-sub">120-Year Vimshottari &amp; 36-Year Yogini</span>
                    </div>

                    <!-- Vimshottari Mahadasha Table -->
                    <div class="pdf-box" style="padding: 12px; margin-bottom: 16px;">
                        <h3 class="pdf-box-title">Vimshottari Mahadasha Cycles</h3>
                        <div class="pdf-table-wrap">
                            <table class="pdf-table">
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
                                            <td><strong>{{ $m['planet'] }} ({{ $m['hindi'] }})</strong></td>
                                            <td>{{ $m['years'] }} Years</td>
                                            <td>{{ $m['start']->format('d M Y') }}</td>
                                            <td>{{ $m['end']->format('d M Y') }}</td>
                                            <td>
                                                @if ($m['active'])
                                                    <strong style="color: #a86c0e;">ACTIVE PERIOD</strong>
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
                    </div>

                    <!-- Yogini Dasha Table -->
                    <div class="pdf-box" style="padding: 12px;">
                        <h3 class="pdf-box-title">Yogini Dasha Timeline</h3>
                        <div class="pdf-table-wrap">
                            <table class="pdf-table">
                                <thead>
                                    <tr>
                                        <th>Yogini</th>
                                        <th>Ruling Lord</th>
                                        <th>Span</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (array_slice($yogini, 0, 8) as $y)
                                        <tr style="{{ $y['active'] ? 'background: rgba(227, 181, 104, 0.15);' : '' }}">
                                            <td><strong>{{ ucfirst($y['name']) }}</strong></td>
                                            <td>{{ $y['lord'] }}</td>
                                            <td>{{ $y['years'] }} Yr</td>
                                            <td>{{ $y['start'] }}</td>
                                            <td>{{ $y['end'] }}</td>
                                            <td>{{ $y['active'] ? 'ACTIVE' : '—' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- SECTION 7: PREDICTIONS & GUIDANCE -->
                <section class="pdf-section">
                    <div class="pdf-section-header">
                        <h2 class="pdf-section-title">07 · General Predictions &amp; Vedic Yogas</h2>
                        <span class="pdf-section-sub">Ascendant, Personality &amp; Planetary Yogas</span>
                    </div>

                    <div class="pdf-prediction-grid">
                        <div class="pdf-pred-card">
                            <h3 class="pdf-pred-title">Physical &amp; Personality</h3>
                            <p class="pdf-pred-body">{{ $predictions['ascendant']['personality'] }}</p>
                        </div>
                        <div class="pdf-pred-card">
                            <h3 class="pdf-pred-title">Health &amp; Vitality</h3>
                            <p class="pdf-pred-body">{{ $predictions['ascendant']['health'] }}</p>
                        </div>
                        <div class="pdf-pred-card">
                            <h3 class="pdf-pred-title">Career &amp; Profession</h3>
                            <p class="pdf-pred-body">{{ $predictions['ascendant']['career'] }}</p>
                        </div>
                        <div class="pdf-pred-card">
                            <h3 class="pdf-pred-title">Family &amp; Relationships</h3>
                            <p class="pdf-pred-body">{{ $predictions['ascendant']['relationship'] }}</p>
                        </div>
                    </div>

                    <!-- Yoga Combinations -->
                    <div class="pdf-box" style="margin-top: 14px;">
                        <h3 class="pdf-box-title">Vedic Yoga Combinations in Chart</h3>
                        @foreach ($yogas as $yoga)
                            <div class="pdf-info-row" style="padding: 8px 0; align-items: flex-start;">
                                <span class="pdf-label" style="font-weight: 700; color: var(--gold); min-width: 160px;">{{ $yoga['name'] }}</span>
                                <span class="pdf-value" style="text-align: left; font-weight: normal; font-size: 12.5px; color: var(--text-secondary);">{{ $yoga['desc'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- SECTION 8: REMEDIES & GEMSTONES -->
                <section class="pdf-section">
                    <div class="pdf-section-header">
                        <h2 class="pdf-section-title">08 · Vedic Remedies &amp; Gemstone Guidance</h2>
                        <span class="pdf-section-sub">Sacred Rudraksha &amp; Auspicious Ratnas</span>
                    </div>

                    <div class="pdf-box" style="margin-bottom: 16px;">
                        <h3 class="pdf-box-title">Recommended Rudraksha: {{ $rudraksha['mukhis'] }}</h3>
                        <p style="font-size: 12px; line-height: 1.6; color: var(--text-secondary); margin: 0 0 10px 0;">
                            Having been born under <strong>{{ $panchang['nakshatra'] }}</strong> ruled by {{ $panchang['nakshatraLord'] }}, wearing {{ $rudraksha['primary'] }} Rudraksha (presided by {{ $rudraksha['deity'] }}) purges past karmic blocks and shields you against planetary afflictions. {{ $rudraksha['benefits'] }}
                        </p>
                        <div class="pdf-grid-2col" style="margin-bottom: 0;">
                            <div class="pdf-info-row">
                                <span class="pdf-label">Ruling Deity</span>
                                <span class="pdf-value">{{ $rudraksha['deity'] }}</span>
                            </div>
                            <div class="pdf-info-row">
                                <span class="pdf-label">Thread &amp; Purification</span>
                                <span class="pdf-value">Red/Yellow silk thread, Gangajal purification</span>
                            </div>
                        </div>
                    </div>

                    <!-- Gemstones 3-Grid -->
                    <div class="pdf-gemstones-grid">
                        <div class="pdf-gemstone-card">
                            <div>
                                <h3 class="pdf-gemstone-title">Life Stone (Lagna Lord)</h3>
                                <p class="pdf-gemstone-text">Worn for overall health, vitality, social honor, and self-growth.</p>
                            </div>
                            <div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Gemstone</span>
                                    <span class="pdf-value gold">{{ $gemstones['life']['gem'] }}</span>
                                </div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Metal &amp; Finger</span>
                                    <span class="pdf-value">{{ $gemstones['life']['metal'] }}, {{ $gemstones['life']['finger'] }}</span>
                                </div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Mantra</span>
                                    <span class="pdf-value" style="font-size: 10px;">{{ $gemstones['life']['mantra'] }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="pdf-gemstone-card">
                            <div>
                                <h3 class="pdf-gemstone-title">Lucky Stone (Bhagya Vardhak)</h3>
                                <p class="pdf-gemstone-text">Enhances divine grace, removes bottlenecks, and multiplies favorable opportunities.</p>
                            </div>
                            <div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Gemstone</span>
                                    <span class="pdf-value gold">{{ $gemstones['lucky']['gem'] }}</span>
                                </div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Metal &amp; Finger</span>
                                    <span class="pdf-value">{{ $gemstones['lucky']['metal'] }}, {{ $gemstones['lucky']['finger'] }}</span>
                                </div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Mantra</span>
                                    <span class="pdf-value" style="font-size: 10px;">{{ $gemstones['lucky']['mantra'] }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="pdf-gemstone-card">
                            <div>
                                <h3 class="pdf-gemstone-title">Fortune Stone (9th House)</h3>
                                <p class="pdf-gemstone-text">Governs fortune, spiritual growth, long-distance success, and academic triumph.</p>
                            </div>
                            <div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Gemstone</span>
                                    <span class="pdf-value gold">{{ $gemstones['fortune']['gem'] }}</span>
                                </div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Metal &amp; Finger</span>
                                    <span class="pdf-value">{{ $gemstones['fortune']['metal'] }}, {{ $gemstones['fortune']['finger'] }}</span>
                                </div>
                                <div class="pdf-info-row">
                                    <span class="pdf-label">Mantra</span>
                                    <span class="pdf-value" style="font-size: 10px;">{{ $gemstones['fortune']['mantra'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- SECTION 9: DOSHA ANALYSIS -->
                <section class="pdf-section">
                    <div class="pdf-section-header">
                        <h2 class="pdf-section-title">09 · Dosha Analysis &amp; Clearance</h2>
                        <span class="pdf-section-sub">Manglik, Kaal Sarp &amp; Shani Sade Sati</span>
                    </div>

                    <!-- Manglik -->
                    <div class="pdf-dosha-row">
                        <div>
                            <h3 class="pdf-dosha-name">Manglik Dosha</h3>
                            <p class="pdf-dosha-desc">
                                {{ $doshas['mangal']['summary'] }}
                            </p>
                        </div>
                        <span class="pdf-badge-green" style="{{ !$doshas['mangal']['safe'] ? 'color: #ff914d; border-color: #ff914d; background: rgba(255,145,77,0.1);' : '' }}">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            {{ strtoupper($doshas['mangal']['status']) }}
                        </span>
                    </div>

                    <!-- Kaal Sarp -->
                    <div class="pdf-dosha-row">
                        <div>
                            <h3 class="pdf-dosha-name">Kaal Sarp Dosha</h3>
                            <p class="pdf-dosha-desc">
                                {{ $doshas['kaalSarp']['summary'] }}
                            </p>
                        </div>
                        <span class="pdf-badge-green" style="{{ $doshas['kaalSarp']['level'] !== 'none' ? 'color: #ff914d; border-color: #ff914d; background: rgba(255,145,77,0.1);' : '' }}">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            {{ strtoupper($doshas['kaalSarp']['status']) }}
                        </span>
                    </div>

                    <!-- Sade Sati -->
                    <div class="pdf-dosha-row">
                        <div>
                            <h3 class="pdf-dosha-name">Shani Sade Sati Status</h3>
                            <p class="pdf-dosha-desc">
                                {{ !empty($doshas['sadeSati']['current']) ? 'Saturn is currently in ' . $doshas['sadeSati']['current']['sign'] . ' (' . $doshas['sadeSati']['current']['phase'] . ').' : 'Natal Moon is outside the influence of the current Saturn transit. Sade Sati is inactive.' }}
                            </p>
                        </div>
                        <span class="pdf-badge-green" style="{{ !empty($doshas['sadeSati']['current']) ? 'color: #ff914d; border-color: #ff914d; background: rgba(255,145,77,0.1);' : '' }}">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            {{ !empty($doshas['sadeSati']['current']) ? 'ACTIVE (' . strtoupper($doshas['sadeSati']['current']['phase']) . ')' : 'CURRENTLY INACTIVE (SAFE)' }}
                        </span>
                    </div>
                </section>

                <!-- SECTION 10: CERTIFIED FOOTER -->
                <footer class="pdf-doc-footer">
                    <div>
                        <span class="pdf-footer-brand">AstroHero Vedic Astrology Engine</span> · Precision Lahiri Ephemeris
                    </div>
                    <div>
                        Report Generated on {{ date('d M Y') }} · Confidential &amp; Certified
                    </div>
                </footer>

            </div>
        </article>
    </main>

    <script>
        // Automatic print trigger if ?print=true is present
        if (window.location.search.includes('print=true')) {
            window.addEventListener('load', () => {
                setTimeout(() => window.print(), 500);
            });
        }
    </script>
</body>

</html>
