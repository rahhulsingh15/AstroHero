@php
    $r = $report;
    $lagna = $r['lagna'];
    $all = $r['allPlanets'];
    $pan = $r['panchang'];
    $ava = $r['avakhada'];
    $charts = $r['charts'];
    $ord = \App\Helpers\KundliHelper::ORDINALS;
    $hindi = \App\Helpers\DashaHelper::HINDI;
    $birthTs = $r['birth']->timestamp;
    $tz = $r['birth']->getTimezone();
    $dateFmt = fn (int $ts) => $ts <= $birthTs ? 'Birth' : \Carbon\Carbon::createFromTimestamp($ts, $tz)->format('d-m-Y');
    $timeLabel = $r['timeUnknown'] ? 'Unknown (12:00 PM used)' : $r['birth']->format('h:i A');
    $latFmt = number_format(abs($r['lat']), 4) . '° ' . ($r['lat'] >= 0 ? 'N' : 'S');
    $lngFmt = number_format(abs($r['lng']), 4) . '° ' . ($r['lng'] >= 0 ? 'E' : 'W');
    $now = time();

    $colors = ['Asc' => 'purple', 'Su' => 'orange', 'Mo' => 'blue', 'Ma' => 'red', 'Me' => 'green', 'Ju' => 'gold',
               'Ve' => 'pink', 'Sa' => 'teal', 'Ra' => 'teal', 'Ke' => 'grey', 'Ur' => 'grey', 'Ne' => 'grey', 'Pl' => 'grey'];
    $numPos = [1 => [150, 136], 2 => [79, 66], 3 => [66, 79], 4 => [136, 150], 5 => [66, 221], 6 => [79, 236],
               7 => [150, 166], 8 => [221, 236], 9 => [236, 221], 10 => [164, 150], 11 => [236, 79], 12 => [221, 66]];
    $center = [1 => [150, 72], 2 => [79, 30], 3 => [42, 79], 4 => [78, 150], 5 => [42, 221], 6 => [79, 270],
               7 => [150, 228], 8 => [221, 270], 9 => [258, 221], 10 => [222, 150], 11 => [258, 79], 12 => [221, 30]];
    $frame = '<rect x="8" y="8" width="284" height="284" fill="#fcfbf7" stroke="#c29744" stroke-width="1.8"/>'
        . '<line x1="8" y1="8" x2="292" y2="292" stroke="#c29744" stroke-width="1.2"/>'
        . '<line x1="292" y1="8" x2="8" y2="292" stroke="#c29744" stroke-width="1.2"/>'
        . '<polygon points="150,8 292,150 150,292 8,150" fill="none" stroke="#c29744" stroke-width="1.4"/>';
    $north = function (array $chart, bool $deg = true) use ($numPos, $center, $colors, $frame) {
        $s = $frame;
        foreach ($chart['houses'] as $h => $house) {
            $num = !empty($chart['houseNumbers']) ? $h : $house['sign'] + 1;
            $s .= '<text x="' . $numPos[$h][0] . '" y="' . $numPos[$h][1] . '" class="pdf-svg-num">' . $num . '</text>';
            $items = $house['planets'];
            if (!$items) continue;
            $useDeg = $deg && count($items) <= 4;
            $lines = array_chunk($items, count($items) > 4 ? (in_array($h, [1, 4, 7, 10]) ? 3 : 2) : 1);
            $y0 = $center[$h][1] - (count($lines) - 1) * 6.5;
            foreach ($lines as $i => $line) {
                $s .= '<text x="' . $center[$h][0] . '" y="' . ($y0 + $i * 13) . '" class="pdf-svg-planet">';
                foreach ($line as $j => $p) {
                    $t = $p['abbr'] . ($useDeg && $p['deg'] !== null ? '-' . number_format($p['deg'], 2) . '°' : '')
                        . ($p['retro'] && !in_array($p['abbr'], ['Asc', 'Ra', 'Ke']) ? ' R' : '');
                    $s .= '<tspan class="pdf-c-' . ($colors[$p['abbr']] ?? 'grey') . '">' . e($t) . ($j < count($line) - 1 ? ' ' : '') . '</tspan>';
                }
                $s .= '</text>';
            }
        }
        return '<svg class="pdf-chart-svg" viewBox="0 0 300 300">' . $s . '</svg>';
    };
    $binduPos = [1 => [150, 80], 2 => [79, 36], 3 => [36, 79], 4 => [80, 150], 5 => [36, 221], 6 => [79, 264],
                 7 => [150, 222], 8 => [221, 264], 9 => [264, 221], 10 => [222, 150], 11 => [264, 79], 12 => [221, 36]];
    $bindu = function (array $values) use ($binduPos, $numPos, $frame, $lagna) {
        $s = $frame;
        foreach ($values as $h => $v) {
            $s .= '<text x="' . $numPos[$h][0] . '" y="' . $numPos[$h][1] . '" class="pdf-svg-num pdf-svg-small">' . (($lagna['signIndex'] + $h - 1) % 12 + 1) . '</text>';
            $s .= '<text x="' . $binduPos[$h][0] . '" y="' . $binduPos[$h][1] . '" class="pdf-svg-bindu">' . $v . '</text>';
        }
        return '<svg class="pdf-chart-svg" viewBox="0 0 300 300">' . $s . '</svg>';
    };
    $backQuery = request()->only(['name', 'gender', 'day', 'month', 'year', 'hour', 'minute', 'ampm', 'time_unknown', 'place', 'lat', 'lng', 'tz']);
    $mg = $r['doshas']['mangal'];
    $ks = $r['doshas']['kaalSarp'];
    $ss = $r['doshas']['sadeSati'];
    $rem = $r['remedies'];
    $tick = '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>';
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>{{ $name }}'s Kundli — Complete Vedic PDF Report | AstroHero</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/pdf-report.css') }}?v={{ filemtime(public_path('assets/css/pdf-report.css')) }}">
</head>
<body>
    <header class="pdf-top-bar" id="pdf-top-bar">
        <div class="pdf-bar-inner">
            <a href="{{ url('/') }}" class="pdf-brand">
                <img src="{{ asset('assets/images/logo.png') }}" alt="" width="28" height="28" onerror="this.style.display='none'">
                <span class="pdf-brand-text">AstroHero</span>
            </a>
            <div class="pdf-actions">
                <a href="{{ route('free-kundli-report', $backQuery) }}" class="btn-back-kundli">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"></path><polyline points="12 19 5 12 12 5"></polyline></svg>
                    Back to Kundli
                </a>
                <button type="button" onclick="window.print()" class="btn-download-pdf">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                    Download PDF
                </button>
            </div>
        </div>
    </header>

    <main class="pdf-page-wrapper">
        <article class="pdf-document">
            <svg class="pdf-watermark" viewBox="0 0 200 200">
                <circle cx="100" cy="100" r="90" fill="none" stroke="#b8862d" stroke-width="2" />
                <circle cx="100" cy="100" r="65" fill="none" stroke="#b8862d" stroke-width="1.5" />
                <polygon points="100,10 190,100 100,190 10,100" fill="none" stroke="#b8862d" stroke-width="1.5" />
                <polygon points="100,35 165,100 100,165 35,100" fill="none" stroke="#b8862d" stroke-width="1.5" />
            </svg>

            <div class="pdf-content">
                <header class="pdf-doc-header">
                    <div class="pdf-doc-logo">
                        <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="#b8862d" stroke-width="1.8" /><circle cx="12" cy="12" r="6" fill="#e3b568" fill-opacity="0.3" stroke="#b8862d" stroke-width="1.4" /><path d="M12 2L12 6M12 18L12 22M2 12L6 12M18 12L22 12" stroke="#b8862d" stroke-width="1.4" stroke-linecap="round" /><circle cx="12" cy="12" r="2.5" fill="#b8862d" /></svg>
                        <span class="pdf-doc-brand">ASTROHERO VEDIC REPORT</span>
                    </div>
                    <h1 class="pdf-doc-title">{{ $name }}'s Kundli</h1>
                    <p class="pdf-doc-meta">{{ $r['birth']->format('d M Y') }} · {{ $timeLabel }} · {{ $r['place'] }} ({{ $latFmt }}, {{ $lngFmt }})</p>
                    <div class="pdf-doc-badge-bar">
                        <span class="pdf-doc-tag">Full Kundli Report</span>
                        <span class="pdf-doc-tag">Ayanamsha: Lahiri</span>
                        <span class="pdf-doc-tag">Vedic Astrology</span>
                    </div>
                </header>

                {{-- 1. Birth details --}}
                <section class="pdf-section">
                    <div class="pdf-section-header">
                        <h2 class="pdf-section-title">Birth Details &amp; Panchang</h2>
                        <span class="pdf-section-sub">Basic Planetary Almanac</span>
                    </div>
                    <div class="pdf-grid-2col">
                        <div class="pdf-box">
                            <h3 class="pdf-box-title">Birth Details</h3>
                            @foreach (['Name' => $name, 'Gender' => ucfirst($r['gender']), 'Date of Birth' => $r['birth']->format('d M Y'), 'Time of Birth' => $timeLabel, 'Place of Birth' => $r['place'], 'Latitude' => $latFmt, 'Longitude' => $lngFmt, 'Timezone' => $r['timezone']] as $k => $v)
                                <div class="pdf-info-row"><span class="pdf-label">{{ $k }}</span><span class="pdf-value">{{ $v }}</span></div>
                            @endforeach
                        </div>
                        <div class="pdf-box">
                            <h3 class="pdf-box-title">Panchang</h3>
                            @foreach (['Tithi' => $pan['tithi'], 'Karana' => $pan['karana'], 'Yoga' => $pan['yoga'], 'Nakshatra' => $pan['nakshatra'] . ' (Pada ' . $pan['nakshatraPada'] . ')', 'Nakshatra Lord' => $pan['nakshatraLord'], 'Ascendant (Lagna)' => $pan['ascendant'], 'Ascendant Lord' => $pan['ascendantLord'], 'Sunrise / Sunset' => $pan['sunrise'] . ' / ' . $pan['sunset']] as $k => $v)
                                <div class="pdf-info-row"><span class="pdf-label">{{ $k }}</span><span class="pdf-value">{{ $v }}</span></div>
                            @endforeach
                        </div>
                    </div>
                    <div class="pdf-box">
                        <h3 class="pdf-box-title">Avakhada Chakra Details</h3>
                        <div class="pdf-grid-3col" style="margin-bottom: 0;">
                            @foreach ([['Varna' => 'varna', 'Gan' => 'gan', 'Sign Lord' => 'signLord', 'Name Alphabet' => 'nameAlphabet'], ['Vashya' => 'vashya', 'Nadi' => 'nadi', 'Charan' => 'charan', 'Paya' => 'paya'], ['Yoni' => 'yoni', 'Rashi (Moon Sign)' => 'sign', 'Tatva' => 'tatva', 'Yunja' => 'yunja']] as $col)
                                <div>
                                    @foreach ($col as $k => $key)
                                        <div class="pdf-info-row"><span class="pdf-label">{{ $k }}</span><span class="pdf-value">{{ $ava[$key] }}</span></div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                {{-- 2. Charts & planets --}}
                <section class="pdf-section">
                    <div class="pdf-section-header">
                        <h2 class="pdf-section-title">Lagna &amp; Navamsha Charts</h2>
                        <span class="pdf-section-sub">D-1 &amp; D-9 Birth Kundlis</span>
                    </div>
                    <div class="pdf-charts-pair">
                        <div class="pdf-chart-card"><div class="pdf-chart-label">Lagna Kundli (D-1 Rashi)</div>{!! $north($charts['lagna']) !!}</div>
                        <div class="pdf-chart-card"><div class="pdf-chart-label">Navamsha Kundli (D-9 Dharma)</div>{!! $north($charts['navamsa'], false) !!}</div>
                    </div>
                    <div class="pdf-box" style="padding: 12px;">
                        <h3 class="pdf-box-title">Planetary Positions &amp; Status</h3>
                        <div class="pdf-table-wrap">
                            <table class="pdf-table">
                                <thead><tr><th>Planet</th><th>Sign</th><th>Sign Lord</th><th>Nakshatra</th><th>Nakshatra Lord</th><th>Degree</th><th>House</th><th>Retro</th><th>Combust</th></tr></thead>
                                <tbody>
                                    <tr><td><strong>Ascendant</strong></td><td>{{ $lagna['sign'] }}</td><td>{{ $lagna['lord'] }}</td><td>{{ $lagna['nakshatra'] }}</td><td>{{ $lagna['nakLord'] }}</td><td>{{ \App\Helpers\FreeKundliHelper::dms($lagna['inSign']) }}</td><td>1st</td><td>—</td><td>—</td></tr>
                                    @foreach ($all as $n => $p)
                                        <tr><td><strong>{{ $n }}</strong></td><td>{{ $p['sign'] }}</td><td>{{ $p['lord'] }}</td><td>{{ $p['nakshatra'] }}</td><td>{{ $p['nakLord'] }}</td><td>{{ \App\Helpers\FreeKundliHelper::dms($p['inSign']) }}</td><td>{{ $ord[$p['house']] }}</td><td>{{ $p['retro'] ? 'Yes' : 'No' }}</td><td>{{ $p['combust'] ? 'Yes' : 'No' }}</td></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                {{-- 3. KP --}}
                <section class="pdf-section">
                    <div class="pdf-section-header">
                        <h2 class="pdf-section-title">KP Astrology (Krishnamurti Paddhati)</h2>
                        <span class="pdf-section-sub">Ruling Planets &amp; Placidus Cusps</span>
                    </div>
                    <div class="pdf-grid-2col">
                        <div class="pdf-chart-card"><div class="pdf-chart-label">KP Chalit Chart (Bhava Chalit)</div>{!! $north($charts['chalit']) !!}</div>
                        <div class="pdf-box">
                            <h3 class="pdf-box-title">KP Ruling Planets</h3>
                            @php $rp = $r['kp']['ruling']; @endphp
                            @foreach (['Day Lord' => 'dayLord', 'Ascendant Sign Lord' => 'ascSignLord', 'Ascendant Star Lord' => 'ascStarLord', 'Ascendant Sub Lord' => 'ascSubLord', 'Moon Sign Lord' => 'moonSignLord', 'Moon Star Lord' => 'moonStarLord', 'Moon Sub Lord' => 'moonSubLord'] as $k => $key)
                                <div class="pdf-info-row"><span class="pdf-label">{{ $k }}</span><span class="pdf-value gold">{{ $rp[$key] }}</span></div>
                            @endforeach
                        </div>
                    </div>
                    <div class="pdf-box" style="padding: 12px;">
                        <h3 class="pdf-box-title">KP 12 Bhava Cusps &amp; Sub Lords</h3>
                        <div class="pdf-table-wrap">
                            <table class="pdf-table">
                                <thead><tr><th>Cusp</th><th>Sign</th><th>Degree</th><th>Sign Lord</th><th>Star</th><th>Star Lord</th><th>Sub Lord</th></tr></thead>
                                <tbody>
                                    @foreach ($r['kp']['cusps'] as $c)
                                        <tr><td><strong>Cusp {{ $c['cusp'] }}</strong></td><td>{{ $c['sign'] }}</td><td>{{ $c['degree'] }}</td><td>{{ $c['signLord'] }}</td><td>{{ $c['star'] }}</td><td>{{ $c['starLord'] }}</td><td><strong>{{ $c['subLord'] }}</strong></td></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                {{-- 4. Ashtakvarga --}}
                <section class="pdf-section">
                    <div class="pdf-section-header">
                        <h2 class="pdf-section-title">Ashtakvarga System</h2>
                        <span class="pdf-section-sub">Total {{ $r['ashtakvarga']['total'] }} bindus · SAV &amp; Bhinna Ashtakvarga</span>
                    </div>
                    <div class="pdf-ashtak-grid">
                        <div class="pdf-ashtak-item"><div class="pdf-ashtak-title">SAV (Total: {{ $r['ashtakvarga']['total'] }})</div>{!! $bindu($r['ashtakvarga']['sav']) !!}</div>
                        @foreach ($r['ashtakvarga']['bhinna'] as $n => $vals)
                            <div class="pdf-ashtak-item"><div class="pdf-ashtak-title">{{ $n === 'Ascendant' ? 'Ascendant (Lagna)' : $n . ' (' . ($hindi[$n] ?? $n) . ')' }} - {{ array_sum($vals) }}</div>{!! $bindu($vals) !!}</div>
                        @endforeach
                    </div>
                </section>

                {{-- 5. Divisional charts --}}
                <section class="pdf-section">
                    <div class="pdf-section-header">
                        <h2 class="pdf-section-title">Divisional Charts (Shodashvarga)</h2>
                        <span class="pdf-section-sub">All 16 vargas</span>
                    </div>
                    <div class="pdf-grid-3col">
                        @foreach ($charts['vargas'] as $v)
                            <div class="pdf-chart-card"><div class="pdf-chart-label">{{ $v['key'] }} · {{ $v['title'] }}</div>{!! $north($v, false) !!}</div>
                        @endforeach
                    </div>
                </section>

                {{-- 6. Dashas --}}
                <section class="pdf-section">
                    <div class="pdf-section-header">
                        <h2 class="pdf-section-title">Vimshottari &amp; Yogini Dasha Timelines</h2>
                        <span class="pdf-section-sub">120-Year &amp; 36-Year Cycles</span>
                    </div>
                    <div class="pdf-box" style="padding: 12px; margin-bottom: 16px;">
                        <h3 class="pdf-box-title">Vimshottari Mahadasha Cycles</h3>
                        <div class="pdf-table-wrap">
                            <table class="pdf-table">
                                <thead><tr><th>Mahadasha</th><th>Duration</th><th>Start Date</th><th>End Date</th><th>Status</th></tr></thead>
                                <tbody>
                                    @foreach ($r['vimshottari'] as $d)
                                        <tr @if ($d['active']) style="background: rgba(227, 181, 104, 0.12);" @endif>
                                            <td><strong>{{ $d['planet'] }} ({{ $hindi[$d['planet']] }})</strong></td><td>{{ $d['years'] }} Years</td>
                                            <td>{{ $dateFmt($d['start']) }}</td><td>{{ $dateFmt($d['end']) }}</td>
                                            <td>@if ($d['active'])<strong style="color: #a86c0e;">Active (Current Period)</strong>@elseif ($d['end'] < $now)<span class="pdf-label">Completed</span>@else<span class="pdf-label">Upcoming</span>@endif</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pdf-box">
                        <h3 class="pdf-box-title">Yogini Dasha (36-Year Repeating Cycle)</h3>
                        @php $yList = array_values(array_filter($r['yogini'], fn ($y) => $y['end'] > $birthTs)); $yList = array_slice($yList, 0, 16); @endphp
                        <div class="pdf-grid-2col" style="margin-bottom: 0;">
                            @foreach (array_chunk($yList, (int) ceil(count($yList) / 2)) as $col)
                                <div>
                                    @foreach ($col as $y)
                                        <div class="pdf-info-row">
                                            <span class="pdf-label">{{ $y['name'] }} ({{ $y['lord'] }} - {{ $y['years'] }} {{ $y['years'] > 1 ? 'Years' : 'Year' }})</span>
                                            <span class="pdf-value {{ $y['active'] ? 'gold' : '' }}">{{ $dateFmt($y['start']) }} - {{ $dateFmt($y['end']) }}{{ $y['active'] ? ' (Active)' : '' }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                {{-- 7. Predictions --}}
                <section class="pdf-section">
                    <div class="pdf-section-header">
                        <h2 class="pdf-section-title">General Predictions &amp; Life Guidance</h2>
                        <span class="pdf-section-sub">Character, Career, Finance, Health &amp; Family</span>
                    </div>
                    <div class="pdf-prediction-grid">
                        @foreach (['PHYSICAL' => 'Physical & Personality', 'PROPERTY' => 'Property & Assets', 'FINANCE' => 'Finance & Wealth', 'HEALTH' => 'Health & Vitality', 'CAREER' => 'Career & Profession', 'FAMILY' => 'Family & Marriage'] as $k => $title)
                            <div class="pdf-pred-card"><h3 class="pdf-pred-title">{{ $title }}</h3><p class="pdf-pred-body">{{ $r['predictions']['general'][$k] }}</p></div>
                        @endforeach
                    </div>
                    <div class="pdf-prediction-grid">
                        @foreach ($r['predictions']['planets'] as $n => $text)
                            <div class="pdf-pred-card"><h3 class="pdf-pred-title">{{ $n }} in the {{ $ord[$r['planets'][$n]['house']] }} House</h3><p class="pdf-pred-body">{{ $text }}</p></div>
                        @endforeach
                    </div>
                    @if ($r['yogas'])
                        <div class="pdf-prediction-grid">
                            @foreach ($r['yogas'] as $y)
                                <div class="pdf-pred-card"><h3 class="pdf-pred-title">{{ $y['name'] }}</h3><p class="pdf-pred-body">{{ $y['desc'] }}</p></div>
                            @endforeach
                        </div>
                    @endif
                    <div class="pdf-box">
                        <h3 class="pdf-box-title">Lucky &amp; Unlucky Factors</h3>
                        <div class="pdf-grid-2col" style="margin-bottom: 0;">
                            <div>
                                <div class="pdf-info-row"><span class="pdf-label">Favourable Days</span><span class="pdf-value gold">{{ $r['lucky']['days'] }}</span></div>
                                <div class="pdf-info-row"><span class="pdf-label">Cautionary Day</span><span class="pdf-value" style="color: #c0451a;">{{ $r['lucky']['badDay'] }}</span></div>
                            </div>
                            <div>
                                <div class="pdf-info-row"><span class="pdf-label">Auspicious Colors</span><span class="pdf-value gold">{{ $r['lucky']['colors'] }}</span></div>
                                <div class="pdf-info-row"><span class="pdf-label">Lucky Number</span><span class="pdf-value gold">{{ $r['lucky']['number'] }}</span></div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- 8. Remedies --}}
                <section class="pdf-section">
                    <div class="pdf-section-header">
                        <h2 class="pdf-section-title">Vedic Remedies &amp; Gemstone Guidance</h2>
                        <span class="pdf-section-sub">Sacred Rudraksha &amp; Auspicious Ratnas</span>
                    </div>
                    @php $firstMukhi = reset($rem['mukhis']); @endphp
                    <div class="pdf-box" style="margin-bottom: 16px;">
                        <h3 class="pdf-box-title">Recommended Rudraksha: {{ implode(' & ', array_map(fn ($m) => $m . '-Mukhi', array_keys($rem['mukhis']))) }}</h3>
                        <p class="pdf-para">Having been born in the {{ $rem['nakshatra'] }} nakshatra, ruled by {{ $rem['nakLord'] }}, the most suitable Rudraksha for you is the {{ $firstMukhi['mukhi'] }}-Mukhi. {{ $firstMukhi['details'] }}</p>
                        <div class="pdf-grid-2col" style="margin-bottom: 0;">
                            <div class="pdf-info-row"><span class="pdf-label">Ruling Deity</span><span class="pdf-value">{{ $firstMukhi['deity'] }}</span></div>
                            <div class="pdf-info-row"><span class="pdf-label">Thread &amp; Ritual</span><span class="pdf-value">{{ ucfirst($firstMukhi['thread']) }} thread, {{ $firstMukhi['day'] }}, "{{ $firstMukhi['mantra'] }}"</span></div>
                        </div>
                    </div>
                    <div class="pdf-gemstones-grid">
                        @foreach (['life' => 'Life Stone (Lagna Lord)', 'lucky' => 'Lucky Stone (5th Lord)', 'fortune' => 'Fortune Stone (9th Lord)'] as $k => $title)
                            @php $g = $rem['gemstones'][$k]; @endphp
                            <div class="pdf-gemstone-card">
                                <div>
                                    <h3 class="pdf-gemstone-title">{{ $title }}</h3>
                                    <p class="pdf-gemstone-text">{{ $g['text'] }}</p>
                                </div>
                                <div>
                                    <div class="pdf-info-row"><span class="pdf-label">Gemstone</span><span class="pdf-value gold">{{ $g['gem'] }}</span></div>
                                    <div class="pdf-info-row"><span class="pdf-label">Metal &amp; Finger</span><span class="pdf-value">{{ $g['wear'] }}</span></div>
                                    <div class="pdf-info-row"><span class="pdf-label">Mantra</span><span class="pdf-value" style="font-size: 10.5px;">{{ $g['mantra'] }}</span></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                {{-- 9. Doshas --}}
                <section class="pdf-section">
                    <div class="pdf-section-header">
                        <h2 class="pdf-section-title">Dosha Analysis</h2>
                        <span class="pdf-section-sub">Manglik, Kalsarpa &amp; Shani Sade Sati</span>
                    </div>
                    @php
                        $rows = [
                            ['Manglik Dosha', $mg['summary'], !$mg['present'] || $mg['safe'], $mg['present'] ? strtoupper($mg['status']) : 'NON-MANGLIK (SAFE)'],
                            ['Kalsarpa Dosha', $ks['summary'], $ks['level'] === 'none', $ks['level'] === 'none' ? 'NOT PRESENT' : strtoupper($ks['status'])],
                            ['Shani Sade Sati Status', $ss['current'] ? 'Sade Sati is running now: Saturn is in ' . $ss['current']['sign'] . ' (' . $ss['current']['phase'] . ') until ' . $ss['current']['end']->format('d M Y') . '. ' . $ss['current']['text'] : 'Sade Sati is not active right now. Your Moon sign is ' . $ss['moon']['sign'] . ' and Saturn is in ' . $ss['saturnSign'] . '.', !$ss['current'], $ss['current'] ? 'ACTIVE' : 'NOT ACTIVE'],
                        ];
                    @endphp
                    @foreach ($rows as [$title, $desc, $ok, $badge])
                        <div class="pdf-dosha-row">
                            <div>
                                <h3 class="pdf-dosha-name">{{ $title }}</h3>
                                <p class="pdf-dosha-desc">{{ $desc }}</p>
                            </div>
                            <span class="{{ $ok ? 'pdf-badge-green' : 'pdf-badge-amber' }}">@if ($ok){!! $tick !!}@endif {{ $badge }}</span>
                        </div>
                    @endforeach
                </section>

                <footer class="pdf-doc-footer">
                    <div><span class="pdf-footer-brand">AstroHero Vedic Astrology Engine</span> · Lahiri Ayanamsha</div>
                    <div>Report Generated on {{ now()->setTimezone($tz)->format('d M Y') }}</div>
                </footer>
            </div>
        </article>
    </main>
    <script>
        if (new URLSearchParams(location.search).get('print') === 'true') {
            window.addEventListener('load', () => setTimeout(() => window.print(), 500));
        }
    </script>
</body>
</html>
