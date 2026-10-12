@extends('frontend.layouts.master')
@section('title', $name . "'s Birth Chart - " . $report['lagna']['sign'] . ' Lagna')
@section('content')
    @php
        $lagna = $report['lagna'];
        $planets = $report['planets'];
        $moon = $planets['Moon'];
        $dasha = $report['dasha'];
        $ordinals = \App\Helpers\KundliHelper::ORDINALS;

        // North Indian chart: where each house writes its planets and its sign number [x, y, sign x, sign y, planets per line]
        $slots = [
            1  => [200, 100, 200, 178, 3], 2  => [100, 40, 100, 88, 3],  3  => [38, 104, 88, 104, 2],
            4  => [95, 205, 178, 205, 3],  5  => [38, 304, 88, 304, 2],  6  => [100, 370, 100, 322, 3],
            7  => [200, 310, 200, 238, 3], 8  => [300, 370, 300, 322, 3], 9  => [362, 304, 312, 304, 2],
            10 => [305, 205, 222, 205, 3], 11 => [362, 104, 312, 104, 2], 12 => [300, 40, 300, 88, 3],
        ];
    @endphp
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('birth-chart-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Name Title -->
            <div class="num-report-header">
                <h2>{{ $name }}'s <span class="highlight">Birth/Natal Report</span></h2>
                <span class="num-system-tag">Vedic Kundli · Lahiri Ayanamsa · Whole-sign houses</span>
            </div>

            <!-- The three pillars of the chart -->
            <div class="num-main-grid calc-grid-3">
                <div class="num-stat-card">
                    <div class="num-circle is-picture"><img src="{{ asset('assets/images/' . sprintf('horoscope-%02d.avif', array_search($lagna['sign'], \App\Helpers\TransitHelper::SIGNS) + 1)) }}" alt="{{ $lagna['sign'] }}"></div>
                    <h4>Lagna: {{ $lagna['hindi'] }}</h4>
                    <p>{{ $lagna['sign'] }} rising at {{ $lagna['degree'] }}° {{ sprintf('%02d', $lagna['minute']) }}′. Ruled by {{ $lagna['lord'] }}.</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle is-picture"><img src="{{ asset('assets/images/' . sprintf('horoscope-%02d.avif', array_search($moon['sign'], \App\Helpers\TransitHelper::SIGNS) + 1)) }}" alt="{{ $moon['sign'] }}"></div>
                    <h4>Rashi: {{ $moon['hindi'] }}</h4>
                    <p>Moon in {{ $moon['sign'] }}, in your {{ $ordinals[$moon['house']] }} house.</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-blue">☆</div>
                    <h4>Nakshatra: {{ $moon['nakshatra'] }}</h4>
                    <p>Pada {{ $moon['pada'] }}, ruled by {{ $moon['nakLord'] }}.</p>
                </div>
            </div>

            <div class="num-breakdown">
                <h4>Birth details used</h4>
                <p class="num-breakdown-note">
                    {{ $birth->format('d F Y') }}{{ $timeUnknown ? '' : ', ' . $birth->format('h:i A') }} · {{ $place }}
                </p>
                @if ($timeUnknown)
                    <p class="num-breakdown-note">Birth time was not given, so 12:00 noon was used. The Lagna changes about every two hours, so the Lagna and all the houses in this chart may be different for your real birth time. The signs of the planets are reliable, except possibly the Moon.</p>
                @elseif ($report['nearCusp'])
                    <p class="num-breakdown-note">Your Lagna is very close to the border between two signs. A birth time that is off by a few minutes could shift every house by one, so please confirm your exact time of birth.</p>
                @endif
            </div>

            <!-- The charts -->
            <div class="num-seo-content calc-reading">
                <h3>Your charts</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 30px; margin: 20px 0;">
                    @foreach ($report['charts'] as $title => $houses)
                        <div style="text-align: center;">
                            <h4 style="margin-bottom: 12px;">{{ $title }}</h4>
                            <svg viewBox="0 0 400 400" role="img" aria-label="{{ $title }}" style="width: 100%; max-width: 400px; height: auto;">
                                <g fill="none" stroke="var(--gold)" stroke-width="2">
                                    <rect x="1" y="1" width="398" height="398"></rect>
                                    <path d="M0 0L400 400M400 0L0 400M200 0L0 200L200 400L400 200Z"></path>
                                </g>
                                @foreach ($houses as $house => $data)
                                    @php
                                        [$x, $y, $sx, $sy, $perLine] = $slots[$house];
                                        $lines = array_chunk($data['planets'], $perLine);
                                    @endphp
                                    <text x="{{ $sx }}" y="{{ $sy }}" text-anchor="middle" dominant-baseline="middle" font-size="14" fill="var(--muted)">{{ $data['signIndex'] + 1 }}</text>
                                    @foreach ($lines as $i => $line)
                                        <text x="{{ $x }}" y="{{ $y + ($i - (count($lines) - 1) / 2) * 20 }}" text-anchor="middle" dominant-baseline="middle" font-size="17" font-weight="600" fill="var(--cream)">{{ implode(' ', $line) }}</text>
                                    @endforeach
                                @endforeach
                            </svg>
                        </div>
                    @endforeach
                </div>
                <p>The top diamond is the 1st house (Lagna) and the houses run anticlockwise. The small number in each house is its sign, counted from Aries as 1. Su = Sun, Mo = Moon, Ma = Mars, Me = Mercury, Ju = Jupiter, Ve = Venus, Sa = Saturn, Ra = Rahu, Ke = Ketu.</p>
            </div>

            <!-- Where each planet is -->
            <div class="num-seo-content calc-reading">
                <h3>Planetary positions at your birth</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Planet</th>
                            <th>Sign</th>
                            <th>Sign Lord</th>
                            <th>Nakshatra</th>
                            <th>Naksh Lord</th>
                            <th>Degree</th>
                            <th>Retro (R)</th>
                            <th>Combust</th>
                            <th>Avastha</th>
                            <th>House</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Ascendant</strong></td>
                            <td>{{ $lagna['sign'] }}</td>
                            <td>{{ $lagna['lord'] }}</td>
                            <td>{{ $lagna['nakshatra'] }} ({{ $lagna['pada'] }})</td>
                            <td>{{ $lagna['nakLord'] }}</td>
                            <td>{{ $lagna['degree'] }}° {{ sprintf('%02d', $lagna['minute']) }}′</td>
                            <td>Direct</td>
                            <td>No</td>
                            <td>--</td>
                            <td>1</td>
                            <td>--</td>
                        </tr>
                        @foreach ($planets as $planet => $row)
                            <tr>
                                <td><strong>{{ $planet }}</strong></td>
                                <td>{{ $row['sign'] }}</td>
                                <td>{{ $row['lord'] }}</td>
                                <td>{{ $row['nakshatra'] }} ({{ $row['pada'] }})</td>
                                <td>{{ $row['nakLord'] }}</td>
                                <td>{{ $row['degree'] }}° {{ sprintf('%02d', $row['minute']) }}′</td>
                                <td>{{ $row['retro'] || in_array($planet, ['Rahu', 'Ketu']) ? 'Retro' : 'Direct' }}</td>
                                <td>{{ $row['combust'] ? 'Yes' : 'No' }}</td>
                                <td>{{ $row['avastha'] }}</td>
                                <td>{{ $row['house'] }}</td>
                                <td>
                                    @if ($row['dignity'] && $row['dignity'] !== 'Neutral')
                                        <span class="calc-tag {{ in_array($row['dignity'], ['Debilitated', 'Enemy']) ? 'is-care' : 'is-good' }}">{{ $row['dignity'] }}</span>
                                    @else
                                        --
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>Rahu and Ketu are the mean lunar nodes and are always retrograde. Combust means the planet is too close to the Sun to be seen. Avastha is the stage of life of the planet (Bala, Kumara, Yuva, Vriddha, Mrita) from its degree in the sign. Status shows how the planet is placed: exalted, debilitated, in its own or Mooltrikona sign, or in the sign of a friend or an enemy.</p>
            </div>

            <!-- All nine periods -->
            <div class="num-seo-content calc-reading">
                <h3>Vimshottari Dasha</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Mahadasha</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Years</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dasha['mahadashas'] as $i => $row)
                            <tr>
                                <td><strong>{{ $row['planet'] }}</strong>{!! $row['current'] ? ' <span class="calc-tag is-good">Running now</span>' : '' !!}</td>
                                <td>{{ $i === 0 ? 'Birth' : $row['start']->format('d-M-Y') }}</td>
                                <td>{{ $row['end']->format('d-M-Y') }}</td>
                                <td>{{ $row['years'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>The first Mahadasha is decided by your birth nakshatra, {{ $moon['nakshatra'] }}, and only the part left at birth is counted. See the Antardashas inside each period in the <a href="{{ route('dasha-calculator') }}">Dasha Calculator</a>.</p>
            </div>

            <!-- What the chart says -->
            <div class="num-seo-content calc-reading">
                <h3>{{ $lagna['sign'] }} Lagna: who you are</h3>
                <p>{{ $report['lagnaText'] }}</p>

                <h3>What each planet does in your chart</h3>
                <ul>
                    @foreach ($report['readings'] as $planet => $text)
                        <li><strong>{{ $planet }} in the {{ $ordinals[$planets[$planet]['house']] }} house ({{ $planets[$planet]['sign'] }}):</strong> {{ $text }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- The period running now -->
            <div class="num-seo-content calc-reading">
                <h3>Your current Mahadasha</h3>
                <p>You are in the <strong>{{ $dasha['planet'] }} Mahadasha</strong>, from {{ $dasha['start']->format('d M Y') }} to {{ $dasha['end']->format('d M Y') }}@if ($dasha['currentAntar']), with the <strong>{{ $dasha['currentAntar']['lord'] }} Antardasha</strong> running until {{ $dasha['currentAntar']['end']->format('d M Y') }}@endif. {{ $dasha['profile']['ruling'] }}</p>
                <p>See every period of your life in the <a href="{{ route('dasha-calculator') }}">Dasha Calculator</a>, and check <a href="{{ route('mangal-dosha-calculator') }}">Mangal Dosha</a>, <a href="{{ route('kaal-sarp-dosh-calculator') }}">Kaal Sarp Dosh</a> and <a href="{{ route('shani-sade-sati-calculator') }}">Sade Sati</a> from the same birth details.</p>
            </div>

            <div class="calc-result-actions">
                <button type="button" class="btn-view-more" id="num-share-btn">Share It with others ↗</button>
                <a href="{{ route('birth-chart-calculator') }}" class="btn-primary">Calculate Again</a>
            </div>

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>Want your birth chart read by an expert?</h3>
                    <p>Talk to a Vedic astrologer about career, marriage, health and wealth in your kundli.</p>
                </div>
                <div class="banner-buttons">
                    <a href="{{ route('chat-with-astrologers') }}" class="btn-chat">Chat with Astrologer</a>
                    <a href="{{ route('talk-to-astrologers') }}" class="btn-call">Call Astrologer</a>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Share: phone share sheet where available, otherwise copy the report link
        const shareBtn = document.getElementById('num-share-btn');
        if (shareBtn) {
            shareBtn.addEventListener('click', async () => {
                const title = 'Check my Birth Chart';
                try {
                    if (navigator.share) {
                        await navigator.share({ title, url: location.href });
                    } else {
                        await navigator.clipboard.writeText(location.href);
                        shareBtn.textContent = 'Link copied ✓';
                        setTimeout(() => shareBtn.textContent = 'Share It with others ↗', 2000);
                    }
                } catch (e) {}
            });
        }
    </script>
@endsection
