@extends('frontend.layouts.master')
@section('title', $boy['name'] . ' & ' . $girl['name'] . ' — Kundli Matching Report | AstroHero')
@section('content')

@php
    $people = ['boy' => $boy, 'girl' => $girl];
    $total = $match['total'];
    $pct = round($total / 36 * 100);
    $fmtNum = fn ($n) => rtrim(rtrim(number_format($n, 1), '0'), '.');
    $timeLabel = fn ($r) => $r['timeUnknown'] ? 'Unknown (12:00 PM used)' : $r['birth']->format('h:i A');
    $tone = $total >= 25 ? 'good' : ($total >= 18 ? 'ok' : 'low');

    $colors = ['Asc' => 'purple', 'Su' => 'orange', 'Mo' => 'blue', 'Ma' => 'peach', 'Me' => 'green', 'Ju' => 'yellow',
               'Ve' => 'pink', 'Sa' => 'cyan', 'Ra' => 'cyan', 'Ke' => 'white', 'Ur' => 'white', 'Ne' => 'white', 'Pl' => 'white'];
    $numPos = [1 => [150, 136], 2 => [79, 68], 3 => [72, 79], 4 => [136, 150], 5 => [72, 221], 6 => [79, 232],
               7 => [150, 166], 8 => [221, 232], 9 => [228, 221], 10 => [164, 150], 11 => [228, 79], 12 => [221, 68]];
    $center = [1 => [150, 70], 2 => [79, 26], 3 => [36, 79], 4 => [78, 150], 5 => [36, 221], 6 => [79, 274],
               7 => [150, 230], 8 => [221, 274], 9 => [264, 221], 10 => [222, 150], 11 => [264, 79], 12 => [221, 26]];
    $north = function (array $chart) use ($numPos, $center, $colors) {
        $s = '<rect x="8" y="8" width="284" height="284" fill="#080913" stroke="#d4a753" stroke-width="2"/>'
            . '<line x1="8" y1="8" x2="292" y2="292" stroke="#d4a753" stroke-width="1.4"/>'
            . '<line x1="292" y1="8" x2="8" y2="292" stroke="#d4a753" stroke-width="1.4"/>'
            . '<polygon points="150,8 292,150 150,292 8,150" fill="none" stroke="#d4a753" stroke-width="1.5"/>';
        foreach ($chart['houses'] as $h => $house) {
            $s .= '<text x="' . $numPos[$h][0] . '" y="' . $numPos[$h][1] . '" class="kd-svg-house-num">' . ($house['sign'] + 1) . '</text>';
            $items = array_values(array_filter($house['planets'], fn ($p) => !in_array($p['abbr'], ['Ur', 'Ne', 'Pl'])));
            if (!$items) continue;
            $lines = array_chunk($items, count($items) > 3 ? 2 : 1);
            $text = fn ($p) => $p['abbr'] . ($p['retro'] && !in_array($p['abbr'], ['Asc', 'Ra', 'Ke']) ? ' R' : '');
            $place = \App\Helpers\FreeKundliHelper::northLayout($h, array_map(fn ($line) => implode(' ', array_map($text, $line)), $lines));
            foreach ($lines as $i => $line) {
                [$x, $y, $fs] = $place[$i];
                $s .= '<text x="' . $x . '" y="' . $y . '" class="kd-svg-planet"' . ($fs < 9.95 ? ' style="font-size:' . round($fs, 1) . 'px"' : '') . '>';
                foreach ($line as $j => $p) {
                    $t = $text($p);
                    $s .= '<tspan class="kd-c-' . ($colors[$p['abbr']] ?? 'white') . '">' . e($t) . ($j < count($line) - 1 ? ' ' : '') . '</tspan>';
                }
                $s .= '</text>';
            }
        }
        return '<svg class="kd-chart-svg" viewBox="0 0 300 300" role="img">' . $s . '</svg>';
    };

    $kundliLink = function ($r) {
        $b = $r['birth'];
        $q = ['name' => $r['name'], 'gender' => $r['gender'], 'day' => $b->day, 'month' => $b->month, 'year' => $b->year,
              'place' => $r['place'], 'lat' => $r['lat'], 'lng' => $r['lng'], 'tz' => $b->getTimezone()->getName()];
        if ($r['timeUnknown']) {
            $q['time_unknown'] = 1;
        } else {
            $q += ['hour' => $b->format('g'), 'minute' => (int) $b->format('i'), 'ampm' => $b->format('A')];
        }
        return route('free-kundli-report', $q);
    };
@endphp

<link rel="stylesheet" href="{{ asset('assets/css/freekundli.css') }}?v={{ filemtime(public_path('assets/css/freekundli.css')) }}">

<section class="basic-detail km-report">
    <div class="fk-wrapper">
        <div class="kd-report-header">
            <h1 class="kd-report-name">{{ $boy['name'] }} &amp; {{ $girl['name'] }}</h1>
            <p class="kd-report-meta">Kundli Matching · Ashtakoot Guna Milan</p>
        </div>

        {{-- Score --}}
        <div class="kd-card km-score-card km-tone-{{ $tone }}">
            <div class="km-score-ring" style="--pct: {{ $pct }};">
                <div class="km-score-inner">
                    <span class="km-score-num">{{ $fmtNum($total) }}</span>
                    <span class="km-score-max">/ 36</span>
                </div>
            </div>
            <div class="km-score-text">
                <span class="km-score-label">{{ $match['verdict']['label'] }}</span>
                <h2>{{ $fmtNum($total) }} out of 36 gunas matched</h2>
                <p>{{ $match['verdict']['text'] }}</p>
                <p class="km-score-manglik">{{ $match['manglik']['ok'] ? '✓' : '!' }} {{ $match['manglik']['text'] }}</p>
            </div>
        </div>

        {{-- Basic details --}}
        <div class="kd-grid-2col">
            @foreach ($people as $role => $p)
                <div class="kd-card">
                    <div class="kd-card-header">
                        <h2 class="kd-card-title">{{ $role === 'boy' ? 'Boy' : 'Girl' }}: {{ $p['name'] }}</h2>
                    </div>
                    <div class="kd-info-grid">
                        <div class="kd-info-row"><span class="kd-info-label">Date of Birth</span><span class="kd-info-value">{{ $p['birth']->format('d M Y') }}</span></div>
                        <div class="kd-info-row"><span class="kd-info-label">Time of Birth</span><span class="kd-info-value">{{ $timeLabel($p) }}</span></div>
                        <div class="kd-info-row"><span class="kd-info-label">Place of Birth</span><span class="kd-info-value">{{ $p['place'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-info-label">Latitude / Longitude</span><span class="kd-info-value">{{ number_format($p['lat'], 2) }}, {{ number_format($p['lng'], 2) }}</span></div>
                        <div class="kd-info-row"><span class="kd-info-label">Timezone</span><span class="kd-info-value">{{ $p['timezone'] }}</span></div>
                        <div class="kd-info-row"><span class="kd-info-label">Ascendant (Lagna)</span><span class="kd-info-value">{{ $p['lagna']['sign'] }}</span></div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Astro details --}}
        <div class="kd-card">
            <div class="kd-card-header"><h2 class="kd-card-title">Astro Details</h2></div>
            <div class="kd-table-responsive">
                <table class="kd-table">
                    <thead><tr><th>DETAIL</th><th>{{ strtoupper($boy['name']) }} (BOY)</th><th>{{ strtoupper($girl['name']) }} (GIRL)</th></tr></thead>
                    <tbody>
                        @foreach (['Moon Sign (Rashi)' => fn ($r) => $r['avakhada']['sign'], 'Sign Lord' => fn ($r) => $r['avakhada']['signLord'], 'Nakshatra' => fn ($r) => $r['avakhada']['nakshatra'] . ' (Pada ' . $r['avakhada']['charan'] . ')', 'Nakshatra Lord' => fn ($r) => $r['planets']['Moon']['nakLord'], 'Varna' => fn ($r) => $r['avakhada']['varna'], 'Vashya' => fn ($r) => $r['avakhada']['vashya'], 'Yoni' => fn ($r) => $r['avakhada']['yoni'], 'Gan' => fn ($r) => $r['avakhada']['gan'], 'Nadi' => fn ($r) => $r['avakhada']['nadi'], 'Tatva' => fn ($r) => $r['avakhada']['tatva'], 'Paya' => fn ($r) => $r['avakhada']['paya'], 'Name Alphabet' => fn ($r) => $r['avakhada']['nameAlphabet']] as $label => $get)
                            <tr><td><strong>{{ $label }}</strong></td><td>{{ $get($boy) }}</td><td>{{ $get($girl) }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Ashtakoot --}}
        <div class="kd-card">
            <div class="kd-card-header">
                <div>
                    <h2 class="kd-card-title">Ashtakoot Milan</h2>
                    <p class="kd-card-subtitle">Eight kootas compared from the Moon of both partners — {{ $fmtNum($total) }} of 36 points</p>
                </div>
            </div>
            <div class="kd-table-responsive">
                <table class="kd-table">
                    <thead><tr><th>GUNA</th><th>BOY</th><th>GIRL</th><th>MAXIMUM</th><th>OBTAINED</th><th>AREA OF LIFE</th></tr></thead>
                    <tbody>
                        @foreach ($match['rows'] as $row)
                            <tr>
                                <td><strong>{{ $row['name'] }}</strong></td>
                                <td>{{ $row['boy'] }}</td>
                                <td>{{ $row['girl'] }}</td>
                                <td>{{ $row['max'] }}</td>
                                <td><span class="km-got {{ $row['got'] == 0 ? 'zero' : ($row['got'] >= $row['max'] ? 'full' : 'part') }}">{{ $fmtNum($row['got']) }}</span></td>
                                <td>{{ $row['area'] }}</td>
                            </tr>
                        @endforeach
                        <tr class="highlight-row"><td><strong>Total</strong></td><td></td><td></td><td><strong>36</strong></td><td><strong>{{ $fmtNum($total) }}</strong></td><td></td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="kd-card">
            <div class="kd-card-header"><h2 class="kd-card-title">What Each Koota Means for You</h2></div>
            <div class="kd-grid-2col">
                @foreach ($match['rows'] as $row)
                    <div class="kd-subcard">
                        <h3 class="kd-subcard-title">{{ strtoupper($row['name']) }} · {{ $fmtNum($row['got']) }}/{{ $row['max'] }}</h3>
                        <p>{{ $row['meaning'] }} {{ $row['boy'] }} (boy) and {{ $row['girl'] }} (girl) give {{ $fmtNum($row['got']) }} of {{ $row['max'] }} {{ $row['max'] > 1 ? 'points' : 'point' }}{{ $row['got'] == 0 ? ', so this area needs attention.' : ($row['got'] >= $row['max'] ? ', the full score.' : '.') }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        @if ($match['notes'])
            <div class="kd-card">
                <div class="kd-card-header"><h2 class="kd-card-title">Dosha in Guna Milan</h2></div>
                @foreach ($match['notes'] as $note)
                    <div class="km-note {{ $note['ok'] ? 'ok' : 'warn' }}">
                        <strong>{{ $note['title'] }}</strong>
                        <p>{{ $note['text'] }}</p>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Manglik --}}
        <div class="kd-card">
            <div class="kd-card-header">
                <h2 class="kd-card-title">Manglik Analysis</h2>
                <span class="kd-badge-status {{ $match['manglik']['ok'] ? 'success' : 'warning' }}"><span class="kd-badge-dot"></span>{{ $match['manglik']['ok'] ? 'COMPATIBLE' : 'NEEDS REVIEW' }}</span>
            </div>
            <div class="kd-grid-2col">
                @foreach ($people as $role => $p)
                    @php $mg = $p['doshas']['mangal']; @endphp
                    <div class="kd-subcard">
                        <h3 class="kd-subcard-title">{{ $p['name'] }} — {{ $mg['present'] ? $mg['status'] : 'Non-Manglik' }}</h3>
                        <p>{{ $mg['summary'] }}</p>
                    </div>
                @endforeach
            </div>
            <p class="kd-dosha-text" style="margin-top: 16px;">{{ $match['manglik']['text'] }}</p>
        </div>

        {{-- Charts --}}
        <div class="kd-card">
            <div class="kd-card-header"><h2 class="kd-card-title">Lagna Charts</h2></div>
            <div class="kd-charts-row">
                @foreach ($people as $role => $p)
                    <div class="kd-chart-box">
                        <div class="kd-chart-label">{{ $p['name'] }} ({{ $p['lagna']['sign'] }} Lagna)</div>
                        {!! $north($p['charts']['lagna']) !!}
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Conclusion --}}
        <div class="kd-card">
            <div class="kd-card-header"><h2 class="kd-card-title">Conclusion</h2></div>
            <p class="kd-dosha-text">{{ $boy['name'] }} and {{ $girl['name'] }} have {{ $fmtNum($total) }} out of 36 gunas matching — {{ strtolower($match['verdict']['label']) }}. {{ $match['verdict']['text'] }}</p>
            <p class="kd-dosha-sub">{{ $match['manglik']['text'] }}</p>
            <p class="kd-dosha-sub">Guna Milan is the first step. An astrologer also looks at the 7th house, the Navamsa chart and the running dashas of both partners before giving a final opinion.</p>
            <div class="km-actions">
                <a href="{{ $kundliLink($boy) }}" class="kd-guide-pill">{{ $boy['name'] }}'s Full Kundli →</a>
                <a href="{{ $kundliLink($girl) }}" class="kd-guide-pill">{{ $girl['name'] }}'s Full Kundli →</a>
                <a href="{{ route('kundli-matching') }}" class="kd-guide-pill">Match Another Kundli →</a>
            </div>
        </div>

        <div class="kd-deeper-card">
            <div class="kd-deeper-badge">💞</div>
            <h2 class="kd-deeper-title">Want an expert opinion on this match?</h2>
            <p class="kd-deeper-desc">Our astrologers can read both kundlis in full — 7th house, Navamsa, dashas and remedies — and guide you before marriage.</p>
            <a href="{{ route('chat-with-astrologers') }}" class="kd-btn-chat-astro">Chat with Astrologer →</a>
        </div>
    </div>
</section>
@endsection
