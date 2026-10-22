@extends('frontend.layouts.master')
@section('title', $name . "'s Kundli — Free Kundli Online By Date of Birth | AstroHero")
@section('content')

@php
    $r = $report;
    $lagna = $r['lagna'];
    $planets = $r['planets'];
    $all = $r['allPlanets'];
    $pan = $r['panchang'];
    $ava = $r['avakhada'];
    $charts = $r['charts'];
    $ord = \App\Helpers\KundliHelper::ORDINALS;
    $birthTs = $r['birth']->timestamp;
    $tz = $r['birth']->getTimezone();
    $dateFmt = fn (int $ts, string $f = 'd M Y') => $ts <= $birthTs ? 'Birth' : \Carbon\Carbon::createFromTimestamp($ts, $tz)->format($f);
    $timeLabel = $r['timeUnknown'] ? 'Unknown (12:00 PM used)' : $r['birth']->format('h:i A');

    $colors = [
        'Asc' => 'purple', 'Su' => 'orange', 'Mo' => 'blue', 'Ma' => 'peach', 'Me' => 'green', 'Ju' => 'yellow',
        'Ve' => 'pink', 'Sa' => 'cyan', 'Ra' => 'cyan', 'Ke' => 'white', 'Ur' => 'white', 'Ne' => 'white', 'Pl' => 'white',
    ];
    $label = function (array $p, bool $deg) {
        $t = $p['abbr'];
        if ($deg && $p['deg'] !== null) $t .= '-' . number_format($p['deg'], 2) . '°';
        if ($p['retro'] && $p['abbr'] !== 'Asc' && !in_array($p['abbr'], ['Ra', 'Ke'])) $t .= ' R';
        return $t;
    };

    // North Indian chart (300 x 300): sign / house number near the centre point of each house, planets at the house centre
    $numPos = [1 => [150, 136], 2 => [79, 68], 3 => [72, 79], 4 => [136, 150], 5 => [72, 221], 6 => [79, 232],
               7 => [150, 166], 8 => [221, 232], 9 => [228, 221], 10 => [164, 150], 11 => [228, 79], 12 => [221, 68]];
    $center = [1 => [150, 70], 2 => [79, 26], 3 => [36, 79], 4 => [78, 150], 5 => [36, 221], 6 => [79, 274],
               7 => [150, 230], 8 => [221, 274], 9 => [264, 221], 10 => [222, 150], 11 => [264, 79], 12 => [221, 26]];
    $north = function (array $chart, bool $deg = true) use ($numPos, $center, $colors, $label) {
        $s = '<rect x="8" y="8" width="284" height="284" fill="#080913" stroke="#d4a753" stroke-width="2"/>'
            . '<line x1="8" y1="8" x2="292" y2="292" stroke="#d4a753" stroke-width="1.4"/>'
            . '<line x1="292" y1="8" x2="8" y2="292" stroke="#d4a753" stroke-width="1.4"/>'
            . '<polygon points="150,8 292,150 150,292 8,150" fill="none" stroke="#d4a753" stroke-width="1.5"/>';
        foreach ($chart['houses'] as $h => $house) {
            $num = !empty($chart['houseNumbers']) ? $h : $house['sign'] + 1;
            $s .= '<text x="' . $numPos[$h][0] . '" y="' . $numPos[$h][1] . '" class="kd-svg-house-num">' . $num . '</text>';
            $items = $house['planets'];
            if (!$items) continue;
            $useDeg = $deg && count($items) <= 4;
            $per = count($items) > 4 ? (in_array($h, [1, 4, 7, 10]) ? 3 : 2) : 1;
            $lines = array_chunk($items, $per);
            $place = \App\Helpers\FreeKundliHelper::northLayout($h, array_map(fn ($line) => implode(' ', array_map(fn ($p) => $label($p, $useDeg), $line)), $lines));
            foreach ($lines as $i => $line) {
                [$x, $y, $fs] = $place[$i];
                $s .= '<text x="' . $x . '" y="' . $y . '" class="kd-svg-planet"' . ($fs < 9.95 ? ' style="font-size:' . round($fs, 1) . 'px"' : '') . '>';
                foreach ($line as $j => $p) {
                    $s .= '<tspan class="kd-c-' . ($colors[$p['abbr']] ?? 'white') . '">' . e($label($p, $useDeg)) . ($j < count($line) - 1 ? ' ' : '') . '</tspan>';
                }
                $s .= '</text>';
            }
        }
        return '<svg class="kd-chart-svg" viewBox="0 0 300 300" role="img">' . $s . '</svg>';
    };

    // South Indian chart (320 x 320): fixed sign boxes, Pisces top-left
    $box = [0 => [84, 8], 1 => [160, 8], 2 => [236, 8], 3 => [236, 84], 4 => [236, 160], 5 => [236, 236],
            6 => [160, 236], 7 => [84, 236], 8 => [8, 236], 9 => [8, 160], 10 => [8, 84], 11 => [8, 8]];
    $south = function (array $chart, bool $deg = true) use ($box, $colors, $label) {
        $s = '<rect x="8" y="8" width="304" height="304" fill="#090b16" stroke="#d4a753" stroke-width="2" rx="2"/>';
        foreach ([[84, 8, 84, 312], [160, 8, 160, 84], [160, 236, 160, 312], [236, 8, 236, 312], [8, 84, 312, 84], [8, 160, 84, 160], [236, 160, 312, 160], [8, 236, 312, 236]] as [$x1, $y1, $x2, $y2]) {
            $s .= "<line x1=\"$x1\" y1=\"$y1\" x2=\"$x2\" y2=\"$y2\" stroke=\"#d4a753\" stroke-width=\"1.6\"/>";
        }
        $s .= '<rect x="84" y="84" width="152" height="152" fill="#060812" stroke="#d4a753" stroke-width="1.6"/>'
            . '<polygon points="160,116 204,160 160,204 116,160" fill="none" stroke="#d4a753" stroke-width="1.2" opacity="0.6"/>'
            . '<polygon points="160,132 188,160 160,188 132,160" fill="none" stroke="#d4a753" stroke-width="1" opacity="0.8"/>'
            . '<circle cx="160" cy="160" r="3.5" fill="#d4a753"/>';
        foreach ($chart['houses'] as $h => $house) {
            [$bx, $by] = $box[$house['sign']];
            $num = !empty($chart['houseNumbers']) ? $h : $house['sign'] + 1;
            $s .= '<text x="' . ($bx + 6) . '" y="' . ($by + 14) . '" class="kd-south-num">' . $num . '</text>';
            $items = $house['planets'];
            if (!$items) continue;
            $useDeg = $deg && count($items) <= 3;
            $lines = array_chunk($items, $useDeg ? 1 : (count($items) > 3 ? 2 : 1));
            foreach ($lines as $i => $line) {
                $s .= '<text x="' . ($bx + 38) . '" y="' . ($by + 32 + $i * 15) . '" class="kd-south-planet">';
                foreach ($line as $j => $p) {
                    $s .= '<tspan class="kd-c-' . ($colors[$p['abbr']] ?? 'white') . '">' . e($label($p, $useDeg)) . ($j < count($line) - 1 ? ' ' : '') . '</tspan>';
                }
                $s .= '</text>';
            }
        }
        return '<svg class="kd-chart-svg" viewBox="0 0 320 320" role="img">' . $s . '</svg>';
    };

    // Ashtakvarga chart: bindus at house centres, sign numbers small
    $binduPos = [1 => [150, 80], 2 => [79, 36], 3 => [36, 79], 4 => [80, 150], 5 => [36, 221], 6 => [79, 264],
                 7 => [150, 222], 8 => [221, 264], 9 => [264, 221], 10 => [222, 150], 11 => [264, 79], 12 => [221, 36]];
    $bindu = function (array $values) use ($binduPos, $numPos, $lagna) {
        $s = '<rect x="8" y="8" width="284" height="284" fill="#080913" stroke="#d4a753" stroke-width="2"/>'
            . '<line x1="8" y1="8" x2="292" y2="292" stroke="#d4a753" stroke-width="1.4"/>'
            . '<line x1="292" y1="8" x2="8" y2="292" stroke="#d4a753" stroke-width="1.4"/>'
            . '<polygon points="150,8 292,150 150,292 8,150" fill="none" stroke="#d4a753" stroke-width="1.5"/>';
        foreach ($values as $h => $v) {
            $s .= '<text x="' . $numPos[$h][0] . '" y="' . $numPos[$h][1] . '" class="kd-svg-house-num kd-svg-small-num">' . (($lagna['signIndex'] + $h - 1) % 12 + 1) . '</text>';
            $s .= '<text x="' . $binduPos[$h][0] . '" y="' . $binduPos[$h][1] . '" class="kd-svg-bindu">' . $v . '</text>';
        }
        return '<svg class="kd-ashtak-svg" viewBox="0 0 300 300" role="img">' . $s . '</svg>';
    };

    $pdfQuery = request()->only(['name', 'gender', 'day', 'month', 'year', 'hour', 'minute', 'ampm', 'time_unknown', 'place', 'lat', 'lng', 'tz']);
    $dashaJson = array_map(fn ($d) => ['p' => $d['planet'], 's' => $d['start'], 'e' => $d['end']], $r['vimshottari']);
    $yoginiJson = array_map(fn ($y) => ['c' => $y['code'], 'n' => $y['name'], 'l' => $y['lord'], 's' => $y['start'], 'e' => $y['end']], $r['yogini']);
    $doshaBadge = fn (bool $ok, string $text) => '<span class="kd-badge-status ' . ($ok ? 'success' : 'warning') . '"><span class="kd-badge-dot"></span>' . e($text) . '</span>';
@endphp

<link rel="stylesheet" href="{{ asset('assets/css/freekundli.css') }}?v={{ filemtime(public_path('assets/css/freekundli.css')) }}">

<section class="basic-detail">
    <div class="fk-wrapper">
        <div class="kd-report-header">
            <h1 class="kd-report-name">{{ $name }}'s Kundli</h1>
            <p class="kd-report-meta">{{ $r['birth']->format('d M Y') }} · {{ $timeLabel }} · {{ $r['place'] }}</p>
        </div>

        <div class="kd-tabs-nav-wrapper">
            <nav class="kd-tabs-nav" aria-label="Kundli Sections">
                <button class="kd-tab-btn active" data-tab="tab-basic">Basic</button>
                <button class="kd-tab-btn" data-tab="tab-kundli">Kundli</button>
                <button class="kd-tab-btn" data-tab="tab-kp">KP</button>
                <button class="kd-tab-btn" data-tab="tab-ashtakvarga">Ashtakvarga</button>
                <button class="kd-tab-btn" data-tab="tab-charts">Charts</button>
                <button class="kd-tab-btn" data-tab="tab-dasha">Dasha</button>
                <button class="kd-tab-btn" data-tab="tab-report">Free Report</button>
            </nav>
        </div>

        {{-- ================= TAB 1: BASIC ================= --}}
        <div class="kd-tab-pane active" id="tab-basic">
            <div class="kd-grid-2col">
                <div class="kd-card">
                    <div class="kd-card-header"><h2 class="kd-card-title">Birth Details</h2></div>
                    <div class="kd-card-split-2">
                        <div class="kd-info-grid">
                            <div class="kd-info-row"><span class="kd-info-label">Name</span><span class="kd-info-value">{{ $name }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Date of Birth</span><span class="kd-info-value">{{ $r['birth']->format('d M Y') }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Place of Birth</span><span class="kd-info-value">{{ $r['place'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Longitude</span><span class="kd-info-value">{{ number_format($r['lng'], 4) }}</span></div>
                        </div>
                        <div class="kd-info-grid">
                            <div class="kd-info-row"><span class="kd-info-label">Gender</span><span class="kd-info-value">{{ ucfirst($r['gender']) }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Time of Birth</span><span class="kd-info-value">{{ $timeLabel }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Latitude</span><span class="kd-info-value">{{ number_format($r['lat'], 4) }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Timezone</span><span class="kd-info-value">{{ $r['timezone'] }}</span></div>
                        </div>
                    </div>
                </div>

                <div class="kd-card">
                    <div class="kd-card-header"><h2 class="kd-card-title">Panchang</h2></div>
                    <div class="kd-card-split-2">
                        <div class="kd-info-grid">
                            <div class="kd-info-row"><span class="kd-info-label">Tithi</span><span class="kd-info-value">{{ $pan['tithi'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Yoga</span><span class="kd-info-value">{{ $pan['yoga'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Nakshatra Lord</span><span class="kd-info-value">{{ $pan['nakshatraLord'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Ascendant Lord</span><span class="kd-info-value">{{ $pan['ascendantLord'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Sunset</span><span class="kd-info-value">{{ $pan['sunset'] }}</span></div>
                        </div>
                        <div class="kd-info-grid">
                            <div class="kd-info-row"><span class="kd-info-label">Karana</span><span class="kd-info-value">{{ $pan['karana'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Nakshatra</span><span class="kd-info-value">{{ $pan['nakshatra'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Ascendant</span><span class="kd-info-value">{{ $pan['ascendant'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Sunrise</span><span class="kd-info-value">{{ $pan['sunrise'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Day</span><span class="kd-info-value">{{ $pan['weekday'] }}</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kd-card">
                <div class="kd-card-header"><h2 class="kd-card-title">Avakhada Details</h2></div>
                <div class="kd-card-split-3">
                    <div class="kd-info-grid">
                        <div class="kd-info-row"><span class="kd-info-label">Varna</span><span class="kd-info-value">{{ $ava['varna'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-info-label">Gan</span><span class="kd-info-value">{{ $ava['gan'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-info-label">Sign Lord</span><span class="kd-info-value">{{ $ava['signLord'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-info-label">Name Alphabet</span><span class="kd-info-value">{{ $ava['nameAlphabet'] }}</span></div>
                    </div>
                    <div class="kd-info-grid">
                        <div class="kd-info-row"><span class="kd-info-label">Vashya</span><span class="kd-info-value">{{ $ava['vashya'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-info-label">Nadi</span><span class="kd-info-value">{{ $ava['nadi'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-info-label">Charan</span><span class="kd-info-value">{{ $ava['charan'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-info-label">Paya</span><span class="kd-info-value">{{ $ava['paya'] }}</span></div>
                    </div>
                    <div class="kd-info-grid">
                        <div class="kd-info-row"><span class="kd-info-label">Yoni</span><span class="kd-info-value">{{ $ava['yoni'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-info-label">Sign</span><span class="kd-info-value">{{ $ava['sign'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-info-label">Tatva</span><span class="kd-info-value">{{ $ava['tatva'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-info-label">Yunja</span><span class="kd-info-value">{{ $ava['yunja'] }}</span></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= TAB 2: KUNDLI ================= --}}
        <div class="kd-tab-pane" id="tab-kundli">
            <div class="kd-card">
                <div class="kd-card-header">
                    <h2 class="kd-card-title">Birth Charts</h2>
                    <div class="kd-toggle-group">
                        <button type="button" class="kd-toggle-btn active" data-chart-mode="north">North</button>
                        <button type="button" class="kd-toggle-btn" data-chart-mode="south">South</button>
                    </div>
                </div>
                <div class="kd-charts-row kd-charts-north">
                    <div class="kd-chart-box"><div class="kd-chart-label">Lagna Chart</div>{!! $north($charts['lagna']) !!}</div>
                    <div class="kd-chart-box"><div class="kd-chart-label">Navamsha Chart</div>{!! $north($charts['navamsa'], false) !!}</div>
                </div>
                <div class="kd-charts-row kd-charts-south">
                    <div class="kd-chart-box"><div class="kd-chart-label">Lagna Chart</div>{!! $south($charts['lagna']) !!}</div>
                    <div class="kd-chart-box"><div class="kd-chart-label">Navamsha Chart</div>{!! $south($charts['navamsa'], false) !!}</div>
                </div>
            </div>

            <div class="kd-card">
                <div class="kd-card-header"><h2 class="kd-card-title">Planetary Positions</h2></div>
                <div class="kd-table-responsive">
                    <table class="kd-table">
                        <thead>
                            <tr><th>PLANET</th><th>SIGN</th><th>SIGN LORD</th><th>NAKSHATRA</th><th>NAKSHATRA LORD</th><th>DEGREE</th><th>HOUSE</th><th>RETRO</th><th>COMBUST</th></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Ascendant</strong></td><td>{{ $lagna['sign'] }}</td><td>{{ $lagna['lord'] }}</td><td>{{ $lagna['nakshatra'] }}</td>
                                <td>{{ $lagna['nakLord'] }}</td><td>{{ \App\Helpers\FreeKundliHelper::dms($lagna['inSign']) }}</td><td>1st</td><td>—</td><td>—</td>
                            </tr>
                            @foreach ($all as $n => $p)
                                <tr>
                                    <td><strong>{{ $n }}</strong></td><td>{{ $p['sign'] }}</td><td>{{ $p['lord'] }}</td><td>{{ $p['nakshatra'] }}</td>
                                    <td>{{ $p['nakLord'] }}</td><td>{{ \App\Helpers\FreeKundliHelper::dms($p['inSign']) }}</td><td>{{ $ord[$p['house']] }}</td>
                                    <td>{{ $p['retro'] ? 'Yes' : 'No' }}</td>
                                    @if ($p['combust'])<td class="kd-badge-combust">Combust</td>@else<td>—</td>@endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="kd-card" id="kd-vimshottari-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">Vimshottari Dasha</h2>
                        <p class="kd-card-subtitle" id="kd-dasha-subtitle">Showing major periods (Mahadasha)</p>
                    </div>
                </div>
                <div class="kd-stepper-wrap" id="kd-dasha-stepper">
                    <div class="kd-step-item active" data-step="1"><span class="kd-step-num">1</span><span>Mahadasha</span></div>
                    <span class="kd-step-divider">›</span>
                    <div class="kd-step-item" data-step="2"><span class="kd-step-num">2</span><span>Antardasha</span></div>
                    <span class="kd-step-divider">›</span>
                    <div class="kd-step-item" data-step="3"><span class="kd-step-num">3</span><span>Pratyantar</span></div>
                    <span class="kd-step-divider">›</span>
                    <div class="kd-step-item" data-step="4"><span class="kd-step-num">4</span><span>Sookshma</span></div>
                </div>
                <div class="kd-dasha-level-pane">
                    <div class="kd-table-responsive">
                        <table class="kd-table">
                            <thead><tr><th>PLANET</th><th>START DATE</th><th>END DATE</th><th id="kd-dasha-action-head">ACTION</th></tr></thead>
                            <tbody id="kd-dasha-tbody"></tbody>
                        </table>
                    </div>
                    <div class="kd-level-up-wrap" id="kd-dasha-levelup" style="display:none">
                        <button type="button" class="kd-btn-level-up">LEVEL UP</button>
                    </div>
                </div>
            </div>

            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">Shadbala</h2>
                        <p class="kd-card-subtitle">Six-fold planetary strength system in traditional Vedic astrology (in virupas)</p>
                    </div>
                </div>
                <div class="kd-table-responsive">
                    <table class="kd-table">
                        <thead><tr><th>STRENGTH TYPE</th>@foreach ($r['shadbala'] as $n => $s)<th>{{ strtoupper($n) }}</th>@endforeach</tr></thead>
                        <tbody>
                            @foreach (['sthana' => 'Sthana Bala', 'dig' => 'Dig Bala', 'kala' => 'Kala Bala', 'chesta' => 'Chesta Bala', 'naisargika' => 'Naisargika Bala', 'drik' => 'Drik Bala'] as $k => $lbl)
                                <tr><td>{{ $lbl }}</td>@foreach ($r['shadbala'] as $s)<td>{{ number_format($s[$k], 2) }}</td>@endforeach</tr>
                            @endforeach
                            <tr class="highlight-row"><td><strong>Total Shadbala</strong></td>@foreach ($r['shadbala'] as $s)<td><strong>{{ number_format($s['total'], 2) }}</strong></td>@endforeach</tr>
                            <tr><td>Shadbala in Rupa</td>@foreach ($r['shadbala'] as $s)<td>{{ number_format($s['rupa'], 2) }}</td>@endforeach</tr>
                            <tr><td>Shadbala Rank</td>@foreach ($r['shadbala'] as $s)<td>{{ $s['rank'] }}</td>@endforeach</tr>
                            <tr><td>Required Bala</td>@foreach ($r['shadbala'] as $s)<td>{{ $s['required'] }}</td>@endforeach</tr>
                            <tr><td>Strength Ratio</td>@foreach ($r['shadbala'] as $s)<td>{{ number_format($s['ratio'], 2) }}</td>@endforeach</tr>
                            <tr><td>Relative Rank</td>@foreach ($r['shadbala'] as $s)<td>{{ $s['relativeRank'] }}</td>@endforeach</tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">Bhavabala</h2>
                        <p class="kd-card-subtitle">House strength analysis — overall potency &amp; capacity of the 12 astrological houses</p>
                    </div>
                </div>
                <div class="kd-table-responsive">
                    <table class="kd-table">
                        <thead><tr><th>BHAVA (HOUSE)</th>@for ($h = 1; $h <= 12; $h++)<th>{{ $h }}</th>@endfor</tr></thead>
                        <tbody>
                            <tr class="highlight-row"><td><strong>Total Bhava Bala</strong></td>@foreach ($r['bhavabala'] as $b)<td>{{ round($b['total']) }}</td>@endforeach</tr>
                            <tr><td>Bhava Bala (Rupas)</td>@foreach ($r['bhavabala'] as $b)<td>{{ number_format($b['rupa'], 1) }}</td>@endforeach</tr>
                            <tr><td>Strength Ratio</td>@foreach ($r['bhavabala'] as $b)<td>{{ number_format($b['ratio'], 1) }}</td>@endforeach</tr>
                            <tr><td>Ranking</td>@foreach ($r['bhavabala'] as $b)<td>{{ $b['rank'] }}</td>@endforeach</tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ================= TAB 3: KP ================= --}}
        <div class="kd-tab-pane" id="tab-kp">
            <div class="kd-kp-top-row">
                <div class="kd-card" style="margin-bottom: 0;">
                    <div class="kd-card-header">
                        <h2 class="kd-card-title">Bhav Chalit Chart</h2>
                        <div class="kd-toggle-group">
                            <button type="button" class="kd-toggle-btn active" data-chart-mode="north">North</button>
                            <button type="button" class="kd-toggle-btn" data-chart-mode="south">South</button>
                        </div>
                    </div>
                    <div class="kd-chart-box kd-charts-north">{!! $north($charts['chalit']) !!}</div>
                    <div class="kd-chart-box kd-charts-south">{!! $south($charts['chalit']) !!}</div>
                </div>
                <div class="kd-card" style="margin-bottom: 0;">
                    <div class="kd-card-header"><h2 class="kd-card-title">Ruling Planets</h2></div>
                    @php $rp = $r['kp']['ruling']; @endphp
                    <div class="kd-card-split-2">
                        <div class="kd-info-grid">
                            <div class="kd-info-row"><span class="kd-info-label">Asc Sign Lord</span><span class="kd-info-value">{{ $rp['ascSignLord'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Asc Sub Lord</span><span class="kd-info-value">{{ $rp['ascSubLord'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Moon Star Lord</span><span class="kd-info-value">{{ $rp['moonStarLord'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Day Lord</span><span class="kd-info-value">{{ $rp['dayLord'] }}</span></div>
                        </div>
                        <div class="kd-info-grid">
                            <div class="kd-info-row"><span class="kd-info-label">Asc Star Lord</span><span class="kd-info-value">{{ $rp['ascStarLord'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Moon Sign Lord</span><span class="kd-info-value">{{ $rp['moonSignLord'] }}</span></div>
                            <div class="kd-info-row"><span class="kd-info-label">Moon Sub Lord</span><span class="kd-info-value">{{ $rp['moonSubLord'] }}</span></div>
                        </div>
                    </div>
                </div>
            </div>

            @php $ab = fn ($n) => \App\Helpers\KundliHelper::ABBR[$n] ?? $n; @endphp
            <div class="kd-card">
                <div class="kd-card-header"><h2 class="kd-card-title">KP Planets</h2></div>
                <div class="kd-table-responsive">
                    <table class="kd-table">
                        <thead><tr><th>PLANET</th><th>CUSP</th><th>SIGN</th><th>SIGN LORD</th><th>STAR</th><th>STAR LORD</th><th>SUB LORD</th></tr></thead>
                        <tbody>
                            @foreach ($r['kp']['planets'] as $row)
                                <tr><td><strong>{{ $row['planet'] }}</strong></td><td>{{ $row['cusp'] }}</td><td>{{ $row['sign'] }}</td><td>{{ $ab($row['signLord']) }}</td><td>{{ $row['star'] }}</td><td>{{ $ab($row['starLord']) }}</td><td>{{ $ab($row['subLord']) }}</td></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">KP Cusps</h2>
                        <p class="kd-card-subtitle">Placidus house cusps</p>
                    </div>
                </div>
                <div class="kd-table-responsive">
                    <table class="kd-table">
                        <thead><tr><th>CUSP</th><th>DEGREE</th><th>SIGN</th><th>SIGN LORD</th><th>STAR</th><th>STAR LORD</th><th>SUB LORD</th></tr></thead>
                        <tbody>
                            @foreach ($r['kp']['cusps'] as $c)
                                <tr><td><strong>{{ $c['cusp'] }}</strong></td><td>{{ $c['degree'] }}</td><td>{{ $c['sign'] }}</td><td>{{ $ab($c['signLord']) }}</td><td>{{ $c['star'] }}</td><td>{{ $ab($c['starLord']) }}</td><td>{{ $ab($c['subLord']) }}</td></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ================= TAB 4: ASHTAKVARGA ================= --}}
        <div class="kd-tab-pane" id="tab-ashtakvarga">
            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">Ashtakvarga</h2>
                        <p class="kd-card-subtitle">Each chart shows the bindus in every house (small numbers are the signs). SAV is the combined Sarvashtakvarga — total {{ $r['ashtakvarga']['total'] }}.</p>
                    </div>
                </div>
                <div class="kd-ashtak-grid">
                    <div class="kd-ashtak-card">
                        <div class="kd-ashtak-title">SAV (Sarvashtakvarga)</div>
                        {!! $bindu($r['ashtakvarga']['sav']) !!}
                    </div>
                    @foreach ($r['ashtakvarga']['bhinna'] as $n => $vals)
                        <div class="kd-ashtak-card">
                            <div class="kd-ashtak-title">{{ $n }} <span class="kd-ashtak-total">({{ array_sum($vals) }})</span></div>
                            {!! $bindu($vals) !!}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ================= TAB 5: CHARTS ================= --}}
        <div class="kd-tab-pane" id="tab-charts">
            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">Transit Charts</h2>
                        <p class="kd-card-subtitle">Planets in the sky right now ({{ $charts['transitDate']->copy()->setTimezone($tz)->format('d M Y, h:i A') }}) over your Lagna and Moon sign</p>
                    </div>
                    <div class="kd-toggle-group">
                        <button type="button" class="kd-toggle-btn active" data-chart-mode="north">North</button>
                        <button type="button" class="kd-toggle-btn" data-chart-mode="south">South</button>
                    </div>
                </div>
                <div class="kd-charts-row kd-charts-north">
                    <div class="kd-chart-box"><div class="kd-chart-label">Ascendant Sign (Lagna Kundli)</div>{!! $north($charts['transitLagna']) !!}</div>
                    <div class="kd-chart-box"><div class="kd-chart-label">Moon Sign (Chandra Kundli)</div>{!! $north($charts['transitMoon']) !!}</div>
                </div>
                <div class="kd-charts-row kd-charts-south">
                    <div class="kd-chart-box"><div class="kd-chart-label">Ascendant Sign (Lagna Kundli)</div>{!! $south($charts['transitLagna']) !!}</div>
                    <div class="kd-chart-box"><div class="kd-chart-label">Moon Sign (Chandra Kundli)</div>{!! $south($charts['transitMoon']) !!}</div>
                </div>
            </div>

            <div class="kd-card">
                <div class="kd-card-header">
                    <div>
                        <h2 class="kd-card-title">Divisional Charts</h2>
                        <p class="kd-card-subtitle">Divisional charts divide each sign into smaller parts to show one area of life in detail.</p>
                    </div>
                    <div class="kd-toggle-group">
                        <button type="button" class="kd-toggle-btn active" data-chart-mode="north">North</button>
                        <button type="button" class="kd-toggle-btn" data-chart-mode="south">South</button>
                    </div>
                </div>
                <div class="kd-ashtak-grid kd-charts-north">
                    @foreach ($charts['vargas'] as $v)
                        <div class="kd-ashtak-card"><div class="kd-ashtak-title">{{ $v['key'] }} · {{ $v['title'] }}</div>{!! str_replace('kd-chart-svg', 'kd-ashtak-svg', $north($v, false)) !!}</div>
                    @endforeach
                </div>
                <div class="kd-ashtak-grid kd-charts-south">
                    @foreach ($charts['vargas'] as $v)
                        <div class="kd-ashtak-card"><div class="kd-ashtak-title">{{ $v['key'] }} · {{ $v['title'] }}</div>{!! str_replace('kd-chart-svg', 'kd-ashtak-svg', $south($v, false)) !!}</div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ================= TAB 6: DASHA ================= --}}
        <div class="kd-tab-pane" id="tab-dasha">
            <div class="kd-subtabs-nav-wrapper">
                <div class="kd-subtabs-nav" aria-label="Dasha System">
                    <button class="kd-subtab-btn active" data-subtab="dasha-vimshottari">Vimshottari</button>
                    <button class="kd-subtab-btn" data-subtab="dasha-yogini">Yogini</button>
                </div>
            </div>

            <div class="kd-subtab-pane active" id="dasha-vimshottari">
                <div class="kd-card">
                    <div class="kd-card-header">
                        <div>
                            <h2 class="kd-card-title">Vimshottari Mahadasha Periods</h2>
                            <p class="kd-card-subtitle">Each card is one major period (Mahadasha) of the 120-year cycle, read from your own chart.</p>
                        </div>
                    </div>
                    <div class="kd-dasha-grid">
                        @foreach ($r['vimshottari'] as $d)
                            @php $t = $r['predictions']['dasha'][$d['planet']]; @endphp
                            <div class="kd-dasha-card {{ $d['active'] ? 'is-active-period' : '' }}">
                                <div class="kd-dasha-card-head">
                                    <h3 class="kd-dasha-planet-title">{{ $d['planet'] }} Mahadasha</h3>
                                    @if ($d['active'])<span class="kd-dasha-badge-active">ACTIVE</span>@endif
                                </div>
                                <div class="kd-dasha-dates">{{ $dateFmt($d['start'], 'd-m-Y') }} - {{ $dateFmt($d['end'], 'd-m-Y') }}</div>
                                <div class="kd-dasha-card-body">
                                    <p>{{ $t['house'] }}</p>
                                    <p>{{ $t['sign'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="kd-subtab-pane" id="dasha-yogini">
                <div class="kd-yogini-row">
                    <div class="kd-card" id="kd-yogini-card">
                        <div class="kd-card-header" style="margin-bottom: 2px;"><h2 class="kd-card-title">Yogini Dasha</h2></div>
                        <div class="kd-yogini-crumbs-wrap" id="kd-yogini-crumbs"></div>
                        <div class="kd-dasha-level-pane">
                            <div class="kd-table-responsive">
                                <table class="kd-table">
                                    <thead><tr><th>PLANET</th><th>START DATE</th><th>END DATE</th><th></th></tr></thead>
                                    <tbody id="kd-yogini-tbody"></tbody>
                                </table>
                            </div>
                            <div class="kd-level-up-wrap" id="kd-yogini-levelup" style="display:none">
                                <button type="button" class="kd-btn-level-up">LEVEL UP</button>
                            </div>
                        </div>
                    </div>
                    <div class="kd-card">
                        <div class="kd-card-header"><h2 class="kd-card-title">Rashi Chart</h2></div>
                        <div class="kd-chart-box">{!! $north($charts['lagna']) !!}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= TAB 7: FREE REPORT ================= --}}
        <div class="kd-tab-pane" id="tab-report">
            <div class="kd-subtabs-nav-wrapper">
                <div class="kd-subtabs-nav" aria-label="Free Report Sections">
                    <button class="kd-subtab-btn active" data-subtab="report-general">General</button>
                    <button class="kd-subtab-btn" data-subtab="report-remedies">Remedies</button>
                    <button class="kd-subtab-btn" data-subtab="report-dosha">Dosha</button>
                </div>
            </div>

            <div class="kd-subtab-pane active" id="report-general">
                <div class="kd-card">
                    <div class="kd-card-header"><h2 class="kd-card-title">General Predictions</h2></div>
                    <div class="kd-grid-2col">
                        @foreach ($r['predictions']['general'] as $title => $text)
                            <div class="kd-subcard"><h3 class="kd-subcard-title">{{ $title }}</h3><p>{{ $text }}</p></div>
                        @endforeach
                    </div>
                </div>

                <div class="kd-card">
                    <div class="kd-card-header">
                        <div>
                            <h2 class="kd-card-title">Planetary Predictions</h2>
                            <p class="kd-card-subtitle">Predictions based on planetary positions in your Kundli</p>
                        </div>
                    </div>
                    <div class="kd-grid-2col">
                        @foreach ($r['predictions']['planets'] as $n => $text)
                            <div class="kd-subcard"><h3 class="kd-subcard-title">{{ $n }} Prediction</h3><p>{{ $text }}</p></div>
                        @endforeach
                    </div>
                </div>

                <div class="kd-card">
                    <div class="kd-card-header">
                        <div>
                            <h2 class="kd-card-title">Current Vimshottari Dasha Predictions</h2>
                            <p class="kd-card-subtitle">Predictions for planetary Mahadashas</p>
                        </div>
                    </div>
                    <div class="kd-grid-2col">
                        @foreach ($r['vimshottari'] as $d)
                            <div class="kd-subcard" @if ($d['active']) style="border-color: rgba(227, 181, 104, 0.45);" @endif>
                                <h3 class="kd-subcard-title">{{ strtoupper($d['planet']) }} MAHADASHA ({{ $dateFmt($d['start'], 'd-m-Y') }} - {{ $dateFmt($d['end'], 'd-m-Y') }}){{ $d['active'] ? ' · CURRENT' : '' }}</h3>
                                <p>{{ $r['predictions']['dasha'][$d['planet']]['short'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if ($r['yogas'])
                    <div class="kd-card">
                        <div class="kd-card-header"><h2 class="kd-card-title">Yogas in Your Kundli</h2></div>
                        <div class="kd-grid-2col">
                            @foreach ($r['yogas'] as $y)
                                <div class="kd-subcard"><h3 class="kd-subcard-title">{{ $y['name'] }}</h3><p>{{ $y['desc'] }}</p></div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="kd-card">
                    <div class="kd-card-header"><h2 class="kd-card-title">Lucky and Unlucky Factors</h2></div>
                    <div class="kd-grid-2col">
                        <div class="kd-subcard">
                            <div class="kd-info-grid">
                                <div class="kd-info-row"><span class="kd-info-label">Lucky Day</span><span class="kd-info-value gold">{{ $r['lucky']['days'] }}</span></div>
                                <div class="kd-info-row"><span class="kd-info-label">Bad Day</span><span class="kd-info-value" style="color: #f87171;">{{ $r['lucky']['badDay'] }}</span></div>
                            </div>
                        </div>
                        <div class="kd-subcard">
                            <div class="kd-info-grid">
                                <div class="kd-info-row"><span class="kd-info-label">Lucky Color</span><span class="kd-info-value gold">{{ $r['lucky']['colors'] }}</span></div>
                                <div class="kd-info-row"><span class="kd-info-label">Lucky Number</span><span class="kd-info-value gold">{{ $r['lucky']['number'] }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kd-subtab-pane" id="report-remedies">
                @php $rem = $r['remedies']; $mukhiKeys = array_keys($rem['mukhis']); @endphp
                <div class="kd-card">
                    <div class="kd-card-header">
                        <div>
                            <h2 class="kd-card-title">Rudraksha Recommendation</h2>
                            <p class="kd-card-subtitle">Tap a Mukhi to read its benefits.</p>
                        </div>
                    </div>
                    <div class="kd-subcard" style="margin-bottom: 20px;">
                        <h3 class="kd-subcard-title">Rudraksha Suggestion Report</h3>
                        <p>This Rudraksha suggestion report helps you choose the Rudraksha best suited to you, to receive the blessings of Lord Shiva. It is based on the Nakshatra you were born in. Wearing the right Rudraksha shields you from negative energies and keeps positivity in your life.</p>
                        <h4 class="kd-subcard-h4">Rudraksha &amp; Its Importance</h4>
                        <p>Rudraksha beads are the seeds of the Elaeocarpus tree, which grows in the mountains, especially the Himalayas — the home of Lord Shiva. Scriptures say the wearer is blessed with Dharma, Artha, Kama and Moksha. Rudraksha come from 1-Mukhi to 21-Mukhi, each for a different purpose, so wearing the wrong one can disturb the energies of a planet. Consult an astrologer before you choose.</p>
                    </div>
                    <div class="kd-subcard" style="margin-bottom: 20px; border-color: rgba(227, 181, 104, 0.35);">
                        <h3 class="kd-subcard-title">Recommendation</h3>
                        <p>Having been born in the {{ $rem['nakshatra'] }} nakshatra, ruled by {{ $rem['nakLord'] }}, the most suitable Rudraksha for you {{ count($mukhiKeys) > 1 ? 'are' : 'is' }} {{ implode(' and ', array_map(fn ($m) => $m . '-Mukhi', $mukhiKeys)) }}.
                            @foreach ($rem['mukhis'] as $m => $info) The {{ $m }}-Mukhi is blessed by {{ $info['deity'] }}.@endforeach
                            Consult an astrologer before wearing any of them, as they can tell you the most suitable one for your current planetary periods.</p>
                    </div>

                    <div class="kd-mukhi-pills">
                        @foreach ($mukhiKeys as $i => $m)
                            <button type="button" class="kd-mukhi-pill {{ $i === 0 ? 'active' : '' }}" data-mukhi="{{ $m }}">{{ $m }}-Mukhi</button>
                        @endforeach
                    </div>
                    @foreach ($rem['mukhis'] as $m => $info)
                        <div class="kd-grid-2x2 kd-mukhi-pane" data-mukhi-pane="{{ $m }}" @if ($m !== $mukhiKeys[0]) style="display:none" @endif>
                            <div class="kd-subcard"><h3 class="kd-subcard-title">Details</h3><p>{{ $info['details'] }}</p><p>Ruling planet: {{ $info['planet'] }} · Deity: {{ $info['deity'] }}</p></div>
                            <div class="kd-subcard"><h3 class="kd-subcard-title">Benefits</h3>@foreach ($info['benefits'] as $b)<p>• {{ $b }}</p>@endforeach</div>
                            <div class="kd-subcard"><h3 class="kd-subcard-title">How to Wear</h3><p>Wear the {{ $m }}-Mukhi rudraksha on a {{ $info['day'] }} morning after your bath. Clean the bead with Gangajal and raw milk, place it on a clean plate facing east, offer flowers and incense, and chant "{{ $info['mantra'] }}" 108 times. Wear it in a {{ $info['thread'] }} thread or a gold or silver chain.</p></div>
                            <div class="kd-subcard"><h3 class="kd-subcard-title">Precautions</h3>@foreach ($rem['precautions'] as $pc)<p>• {{ $pc }}</p>@endforeach</div>
                        </div>
                    @endforeach
                </div>

                <div class="kd-card">
                    <div class="kd-card-header">
                        <div>
                            <h2 class="kd-card-title">Gemstone Recommendations</h2>
                            <p class="kd-card-subtitle">Each stone supports a different area of life. Consult an astrologer before wearing one.</p>
                        </div>
                    </div>
                    <div class="kd-gemstones-grid">
                        @foreach ($rem['gemstones'] as $g)
                            <div class="kd-gemstone-card">
                                <div>
                                    <h3 class="kd-gemstone-card-title">{{ $g['title'] }}</h3>
                                    <p class="kd-gemstone-desc">{{ $g['text'] }}</p>
                                </div>
                                <div class="kd-gemstone-specs">
                                    <div class="kd-info-row"><span class="kd-info-label">Gemstone</span><span class="kd-info-value gold">{{ $g['gem'] }}</span></div>
                                    <div class="kd-info-row"><span class="kd-info-label">How to Wear</span><span class="kd-info-value">{{ $g['wear'] }}, on {{ $g['day'] }}</span></div>
                                    <div class="kd-info-row"><span class="kd-info-label">Mantra</span><span class="kd-info-value" style="font-size: 11.5px;">{{ $g['mantra'] }}</span></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="kd-subtab-pane" id="report-dosha">
                @php $mg = $r['doshas']['mangal']; $ks = $r['doshas']['kaalSarp']; $ss = $r['doshas']['sadeSati']; @endphp
                <div class="kd-card">
                    <div class="kd-card-header">
                        <h2 class="kd-card-title">Manglik Dosha</h2>
                        {!! $doshaBadge(!$mg['present'] || $mg['safe'], strtoupper($mg['present'] ? $mg['status'] : 'Non-Manglik')) !!}
                    </div>
                    <p class="kd-dosha-text"><strong>{{ $name }}</strong> — {{ $mg['summary'] }}</p>
                    @foreach ($mg['formation'] ?? [] as $line)<p class="kd-dosha-sub">• {{ $line }}</p>@endforeach
                    @foreach ($mg['cancellations'] ?? [] as $c)<p class="kd-dosha-sub">✓ {{ $c['title'] }}</p>@endforeach
                </div>
                <div class="kd-card">
                    <div class="kd-card-header">
                        <h2 class="kd-card-title">Kalsarpa Dosha</h2>
                        {!! $doshaBadge($ks['level'] === 'none', $ks['level'] === 'none' ? 'NOT PRESENT' : strtoupper($ks['status'])) !!}
                    </div>
                    <p class="kd-dosha-text">{{ $ks['summary'] }}</p>
                    @if ($ks['level'] !== 'none')<p class="kd-dosha-sub">{{ $ks['effect'] }}</p>@endif
                </div>
                <div class="kd-card">
                    <div class="kd-card-header">
                        <h2 class="kd-card-title">Sade Sati</h2>
                        {!! $doshaBadge(!$ss['current'], $ss['current'] ? 'ACTIVE' : 'NOT ACTIVE') !!}
                    </div>
                    @if ($ss['current'])
                        <p class="kd-dosha-text">Sade Sati is running now: Saturn is in {{ $ss['current']['sign'] }} ({{ $ss['current']['phase'] }}) from {{ $ss['current']['start']->format('d M Y') }} to {{ $ss['current']['end']->format('d M Y') }}.</p>
                        <p class="kd-dosha-sub">{{ $ss['current']['text'] }}</p>
                        @if ($ss['currentCycle'])<p class="kd-dosha-sub">This Sade Sati cycle lasts until {{ $ss['currentCycle']['end']->format('d M Y') }}.</p>@endif
                    @else
                        <p class="kd-dosha-text">Sade Sati is not active right now. Your Moon sign is {{ $ss['moon']['sign'] }} and Saturn is in {{ $ss['saturnSign'] }}.</p>
                        @if ($ss['next'])<p class="kd-dosha-sub">Next phase: Saturn enters {{ $ss['next']['sign'] }} on {{ $ss['next']['start']->format('d M Y') }} ({{ $ss['next']['phase'] }}).</p>@endif
                    @endif
                </div>
            </div>
        </div>

        {{-- ================= COMMON BOTTOM ================= --}}
        <div class="kd-pdf-card">
            <div class="kd-pdf-left">
                <div class="kd-pdf-icon-badge">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                    <span class="kd-pdf-tag">PDF</span>
                </div>
                <div class="kd-pdf-text">
                    <h3>Get your full Kundli as a PDF</h3>
                    <p>Download every section — birth details, charts, dashas and predictions — in a single printable report.</p>
                </div>
            </div>
            <a href="{{ route('free-kundli-pdf', $pdfQuery) }}" class="kd-btn-view-pdf" target="_blank" rel="noopener">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                View PDF Report
            </a>
        </div>

        <div class="kd-deeper-card">
            <div class="kd-deeper-badge">🔮</div>
            <h2 class="kd-deeper-title">Want a deeper Kundli analysis?</h2>
            <p class="kd-deeper-desc">To know more about what your kundli says about your love, career, health and finance, consult our expert astrologers.</p>
            <a href="{{ Route::has('chat-with-astrologer') ? route('chat-with-astrologer') : url('/') }}" class="kd-btn-chat-astro">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 9h12v2H6V9zm8 5H6v-2h8v2zm4-6H6V6h12v2z" /></svg>
                Chat with Astrologer →
            </a>
        </div>

        <div class="kd-related-section">
            <div class="kd-related-label">RELATED GUIDES</div>
            <div class="kd-related-pills">
                <a href="{{ route('guide.read-kundli') }}" class="kd-guide-pill">How to Read Kundli →</a>
                <a href="{{ route('guide.read-houses') }}" class="kd-guide-pill">How to Read Houses in Kundli →</a>
                <a href="{{ route('guide.read-planets') }}" class="kd-guide-pill">How to Read Planets in Astrology →</a>
                <a href="{{ route('guide.planets-signs-houses') }}" class="kd-guide-pill">Planets, Signs &amp; Houses in Astrology →</a>
                <a href="{{ route('guide.planets-signs-significance') }}" class="kd-guide-pill">Planets, Signs and Their Significance →</a>
            </div>
        </div>
    </div>
</section>

<script>
(function () {
    const BIRTH = {{ $birthTs }};
    const NOW = Math.floor(Date.now() / 1000);
    const YEARS = { Ketu: 7, Venus: 20, Sun: 6, Moon: 10, Mars: 7, Rahu: 18, Jupiter: 16, Saturn: 19, Mercury: 17 };
    const ORDER = Object.keys(YEARS);
    const AB = { Ketu: 'KE', Venus: 'VE', Sun: 'SU', Moon: 'MO', Mars: 'MA', Rahu: 'RA', Jupiter: 'JU', Saturn: 'SA', Mercury: 'ME' };
    const MON = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const TZ_OFFSET = {{ $r['birth']->getOffset() }};
    const fmt = (ts) => {
        if (ts <= BIRTH) return 'Birth';
        const d = new Date((ts + TZ_OFFSET) * 1000);
        return String(d.getUTCDate()).padStart(2, '0') + ' ' + MON[d.getUTCMonth()] + ' ' + d.getUTCFullYear();
    };
    const esc = (s) => String(s).replace(/[&<>"]/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]));

    // ---------- Tabs ----------
    const tabButtons = document.querySelectorAll('.kd-tab-btn');
    const tabPanes = document.querySelectorAll('.kd-tab-pane');
    tabButtons.forEach(btn => btn.addEventListener('click', () => {
        tabButtons.forEach(b => b.classList.toggle('active', b === btn));
        tabPanes.forEach(p => p.classList.toggle('active', p.id === btn.dataset.tab));
        if (history.replaceState) history.replaceState(null, '', '#' + btn.dataset.tab);
    }));
    const hashBtn = location.hash && document.querySelector('.kd-tab-btn[data-tab="' + location.hash.slice(1) + '"]');
    if (hashBtn) { hashBtn.click(); setTimeout(() => window.scrollTo(0, 0), 0); }

    document.querySelectorAll('.kd-subtabs-nav').forEach(nav => {
        const buttons = nav.querySelectorAll('.kd-subtab-btn');
        const panes = nav.closest('.kd-tab-pane').querySelectorAll('.kd-subtab-pane');
        buttons.forEach(b => b.addEventListener('click', () => {
            buttons.forEach(x => x.classList.toggle('active', x === b));
            panes.forEach(p => p.classList.toggle('active', p.id === b.dataset.subtab));
        }));
    });

    document.querySelectorAll('.kd-toggle-group').forEach(group => {
        const btns = group.querySelectorAll('.kd-toggle-btn');
        const card = group.closest('.kd-card');
        btns.forEach(btn => btn.addEventListener('click', () => {
            btns.forEach(b => b.classList.toggle('active', b === btn));
            card.classList.toggle('show-south', btn.dataset.chartMode === 'south');
        }));
    });

    document.querySelectorAll('.kd-mukhi-pills').forEach(group => {
        const pills = group.querySelectorAll('.kd-mukhi-pill');
        const card = group.closest('.kd-card');
        pills.forEach(pill => pill.addEventListener('click', () => {
            pills.forEach(p => p.classList.toggle('active', p === pill));
            card.querySelectorAll('.kd-mukhi-pane').forEach(p => p.style.display = p.dataset.mukhiPane === pill.dataset.mukhi ? '' : 'none');
        }));
    });

    // ---------- Vimshottari drill-down ----------
    const MD = @json($dashaJson);
    const subPeriods = (lord, s, e) => {
        const out = [];
        let cur = s;
        const start = ORDER.indexOf(lord);
        for (let i = 0; i < 9; i++) {
            const p = ORDER[(start + i) % 9];
            const end = cur + (e - s) * YEARS[p] / 120;
            out.push({ p, s: cur, e: end });
            cur = end;
        }
        return out;
    };
    const dSubtitles = ['Showing major periods (Mahadasha)', 'Showing Antardasha sub-periods', 'Showing Pratyantar sub-sub periods', 'Showing Sookshma micro-periods'];
    let dStack = [];  // chosen parents: [{p, s, e, code}]
    const renderDasha = () => {
        const level = dStack.length + 1;
        const parent = dStack[dStack.length - 1];
        const rows = parent ? subPeriods(parent.p, parent.s, parent.e) : MD;
        const tbody = document.getElementById('kd-dasha-tbody');
        tbody.innerHTML = '';
        rows.filter(x => x.e > BIRTH).forEach(x => {
            const code = parent ? parent.code + '-' + AB[x.p] : AB[x.p];
            const current = NOW >= x.s && NOW < x.e;
            const label = parent ? code + ' (' + x.p + ')' : x.p + (current ? ' (Current)' : '');
            const tr = document.createElement('tr');
            if (current) tr.className = 'highlight-row';
            tr.innerHTML = '<td><strong>' + esc(label) + '</strong></td><td>' + fmt(x.s) + '</td><td>' + fmt(x.e) + '</td>'
                + (level < 4 ? '<td><button type="button" class="kd-table-btn">View Details →</button></td>' : '<td></td>');
            if (level < 4) {
                tr.style.cursor = 'pointer';
                tr.addEventListener('click', () => { dStack.push({ p: x.p, s: x.s, e: x.e, code }); renderDasha(); });
            }
            tbody.appendChild(tr);
        });
        document.querySelectorAll('#kd-dasha-stepper .kd-step-item').forEach(it => it.classList.toggle('active', +it.dataset.step === level));
        document.getElementById('kd-dasha-subtitle').textContent = dSubtitles[level - 1] + (parent ? ' of ' + parent.code : '');
        document.getElementById('kd-dasha-levelup').style.display = level > 1 ? '' : 'none';
        document.getElementById('kd-dasha-action-head').textContent = level < 4 ? 'ACTION' : '';
    };
    document.querySelector('#kd-dasha-levelup button').addEventListener('click', () => { dStack.pop(); renderDasha(); });
    document.querySelectorAll('#kd-dasha-stepper .kd-step-item').forEach(it => it.addEventListener('click', () => {
        const step = +it.dataset.step;
        // going deeper by stepper follows the current period
        while (dStack.length + 1 > step) dStack.pop();
        while (dStack.length + 1 < step) {
            const parent = dStack[dStack.length - 1];
            const rows = parent ? subPeriods(parent.p, parent.s, parent.e) : MD;
            const cur = rows.find(x => NOW >= x.s && NOW < x.e) || rows.find(x => x.e > BIRTH);
            dStack.push({ p: cur.p, s: cur.s, e: cur.e, code: (parent ? parent.code + '-' : '') + AB[cur.p] });
        }
        renderDasha();
    }));
    renderDasha();

    // ---------- Yogini drill-down ----------
    const YG = @json($yoginiJson);
    const YORDER = [['MAN', 'Mangala', 1], ['PIN', 'Pingala', 2], ['DHA', 'Dhanya', 3], ['BHR', 'Bhramari', 4], ['BHA', 'Bhadrika', 5], ['ULK', 'Ulka', 6], ['SID', 'Siddha', 7], ['SAN', 'Sankata', 8]];
    const ySub = (code, s, e) => {
        const start = YORDER.findIndex(y => y[0] === code);
        const out = [];
        let cur = s;
        for (let i = 0; i < 8; i++) {
            const y = YORDER[(start + i) % 8];
            const end = cur + (e - s) * y[2] / 36;
            out.push({ c: y[0], n: y[1], s: cur, e: end });
            cur = end;
        }
        return out;
    };
    let yStack = [];
    const renderYogini = () => {
        const parent = yStack[yStack.length - 1];
        const level = yStack.length + 1;
        const rows = parent ? ySub(parent.c, parent.s, parent.e) : YG;
        const tbody = document.getElementById('kd-yogini-tbody');
        tbody.innerHTML = '';
        rows.filter(x => x.e > BIRTH).forEach(x => {
            const code = parent ? parent.code + '-' + x.c : x.c;
            const tr = document.createElement('tr');
            if (NOW >= x.s && NOW < x.e) tr.className = 'highlight-row';
            tr.innerHTML = '<td><strong>' + esc(code) + '</strong> (' + esc(x.n.toLowerCase()) + ')</td><td>' + fmt(x.s) + '</td><td>' + fmt(x.e) + '</td>'
                + (level < 4 ? '<td><button type="button" class="kd-btn-drill-in">Drill in →</button></td>' : '<td></td>');
            if (level < 4) {
                tr.style.cursor = 'pointer';
                tr.addEventListener('click', () => { yStack.push({ c: x.c, n: x.n, s: x.s, e: x.e, code }); renderYogini(); });
            }
            tbody.appendChild(tr);
        });
        const wrap = document.getElementById('kd-yogini-crumbs');
        wrap.innerHTML = '';
        const crumbs = [{ label: 'Yogini', depth: 0 }].concat(yStack.map((y, i) => ({ label: y.n.toLowerCase(), depth: i + 1 })));
        crumbs.forEach((c, i) => {
            if (i) { const sep = document.createElement('span'); sep.className = 'kd-yogini-crumb-sep'; sep.textContent = '›'; wrap.appendChild(sep); }
            const b = document.createElement('button');
            b.type = 'button';
            b.className = 'kd-yogini-crumb-btn' + (i === crumbs.length - 1 ? ' active' : '');
            b.textContent = c.label;
            b.addEventListener('click', () => { yStack = yStack.slice(0, c.depth); renderYogini(); });
            wrap.appendChild(b);
        });
        document.getElementById('kd-yogini-levelup').style.display = level > 1 ? '' : 'none';
    };
    document.querySelector('#kd-yogini-levelup button').addEventListener('click', () => { yStack.pop(); renderYogini(); });
    renderYogini();
})();
</script>
@endsection
