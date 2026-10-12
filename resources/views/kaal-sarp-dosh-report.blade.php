@extends('frontend.layouts.master')
@section('title', $name . "'s Kaal Sarp Dosh Report - " . $report['status'])
@section('content')
    @php
        $planets = $report['planets'];
        $rahu = $planets['Rahu'];
        $ketu = $planets['Ketu'];
        $ordinals = \App\Helpers\KundliHelper::ORDINALS;
        $present = $report['level'] !== 'none';

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
            <a href="{{ route('kaal-sarp-dosh-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Name Title -->
            <div class="num-report-header">
                <h2>{{ $name }}'s <span class="highlight">Kaal Sarp Yog</span></h2>
                <span class="num-system-tag">Kaal Sarp Dosh Report</span>
            </div>

            <!-- Analysis result -->
            <div class="calc-result">
                <div class="calc-result-body">
                    <p class="calc-result-sub">Analysis Result</p>
                    <span class="calc-pill {{ $present ? 'is-care' : '' }}">{{ ['full' => 'Present', 'partial' => 'Partially Present', 'none' => 'Not Present'][$report['level']] }}</span>
                    <p class="calc-result-sub" style="margin: 14px 0 0;">
                        {{ ['full' => 'Your kundli has ' . $report['type'] . ' Kaal Sarp Dosh.', 'partial' => 'Your kundli has a partial (Anshik) Kaal Sarp Dosh.', 'none' => 'Your kundli is free from Kaal Sarp Dosh.'][$report['level']] }}
                    </p>
                </div>
            </div>

            <!-- Result and the axis -->
            <div class="num-main-grid calc-grid-3">
                <div class="num-stat-card">
                    <div class="num-circle {{ $report['level'] === 'none' ? 'bg-green' : 'bg-pink' }}">{{ $report['level'] === 'none' ? '✓' : '!' }}</div>
                    <h4>{{ $report['status'] }}</h4>
                    <p>{{ ['full' => 'All seven planets are on one side of the axis.', 'partial' => 'Six planets are on one side of the axis, one is outside.', 'none' => 'The planets are on both sides of the axis.'][$report['level']] }}</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-purple">☊</div>
                    <h4>Rahu: {{ $ordinals[$rahu['house']] }} House</h4>
                    <p>In {{ $rahu['sign'] }} at {{ $rahu['degree'] }}° {{ sprintf('%02d', $rahu['minute']) }}′. The head of the serpent.</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-blue">☋</div>
                    <h4>Ketu: {{ $ordinals[$ketu['house']] }} House</h4>
                    <p>In {{ $ketu['sign'] }} at {{ $ketu['degree'] }}° {{ sprintf('%02d', $ketu['minute']) }}′. The tail of the serpent.</p>
                </div>
            </div>

            <div class="num-breakdown">
                <h4>Birth details used</h4>
                <p class="num-breakdown-note">
                    {{ $birth->format('d F Y') }}{{ $timeUnknown ? '' : ', ' . $birth->format('h:i A') }} · {{ $place }} · {{ $report['lagna']['sign'] }} Lagna
                </p>
                @if ($timeUnknown)
                    <p class="num-breakdown-note">Birth time was not given, so 12:00 noon was used. Whether the dosha is present does not depend on the Lagna, but the houses of Rahu and Ketu, and so the type of the dosha, may be different for your real birth time.</p>
                @elseif ($report['nearCusp'])
                    <p class="num-breakdown-note">Your Lagna is very close to the border between two signs. A birth time that is off by a few minutes could change the houses of Rahu and Ketu, and so the type of the dosha.</p>
                @endif
            </div>

            <!-- What the result means -->
            <div class="num-seo-content calc-reading">
                <h3>Your result</h3>
                <p>{{ $report['summary'] }}</p>
                @if ($present)
                    <p><strong>Type: {{ $report['type'] }} Kaal Sarp{{ $report['level'] === 'partial' ? ' (partial)' : '' }}.</strong> {{ $report['effect'] }}</p>
                    <p>
                        @if ($report['towardsRahu'])
                            The planets lie between Ketu and Rahu and are moving towards Rahu, the mouth of the serpent. Many astrologers treat this as the stronger form of the yoga.
                        @else
                            The planets lie between Rahu and Ketu and are moving away from Rahu, towards Ketu. Some traditions treat this as the milder form of the yoga.
                        @endif
                    </p>
                    <p>Kaal Sarp Dosh does not deny success. It is said to bring delays and repeated effort in the first half of life, followed by a steady rise. This is a computer-generated result; consult an astrologer to confirm it against your full chart.</p>
                @else
                    <p>Rahu is in your {{ $ordinals[$rahu['house']] }} house and Ketu in your {{ $ordinals[$ketu['house']] }} house, but the other planets are not hemmed in between them, so the remedies for this dosha are not needed.</p>
                @endif
            </div>

            <!-- The birth chart the result is read from -->
            <div class="num-seo-content calc-reading">
                <h3>Lagna / Ascendant / Basic Birth Chart</h3>
                <div style="text-align: center; margin: 20px 0;">
                    <svg viewBox="0 0 400 400" role="img" aria-label="Lagna Chart" style="width: 100%; max-width: 400px; height: auto;">
                        <g fill="none" stroke="var(--gold)" stroke-width="2">
                            <rect x="1" y="1" width="398" height="398"></rect>
                            <path d="M0 0L400 400M400 0L0 400M200 0L0 200L200 400L400 200Z"></path>
                        </g>
                        @foreach ($report['houses'] as $house => $data)
                            @php
                                [$x, $y, $sx, $sy, $perLine] = $slots[$house];
                                $lines = array_chunk($data['planets'], $perLine);
                            @endphp
                            <text x="{{ $sx }}" y="{{ $sy }}" text-anchor="middle" dominant-baseline="middle" font-size="14" fill="var(--muted)">{{ $data['signIndex'] + 1 }}</text>
                            @foreach ($lines as $i => $line)
                                <text x="{{ $x }}" y="{{ $y + ($i - (count($lines) - 1) / 2) * 20 }}" text-anchor="middle" dominant-baseline="middle" font-size="17" font-weight="600" fill="{{ array_intersect($line, ['Ra', 'Ke']) ? 'var(--gold)' : 'var(--cream)' }}">{{ implode(' ', $line) }}</text>
                            @endforeach
                        @endforeach
                    </svg>
                </div>
                <p>The top diamond is the 1st house (Lagna) and the houses run anticlockwise. Ra (Rahu) and Ke (Ketu) mark the two ends of the axis. Su = Sun, Mo = Moon, Ma = Mars, Me = Mercury, Ju = Jupiter, Ve = Venus, Sa = Saturn.</p>
            </div>

            <!-- Which side each planet is on -->
            <div class="num-seo-content calc-reading">
                <h3>Where the planets are from the Rahu-Ketu axis</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Planet</th>
                            <th>Sign</th>
                            <th>Degree</th>
                            <th>House</th>
                            <th>Side of the axis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (['Sun', 'Moon', 'Mars', 'Mercury', 'Jupiter', 'Venus', 'Saturn'] as $planet)
                            <tr>
                                <td><strong>{{ $planet }}</strong></td>
                                <td>{{ $planets[$planet]['sign'] }}</td>
                                <td>{{ $planets[$planet]['degree'] }}° {{ sprintf('%02d', $planets[$planet]['minute']) }}′</td>
                                <td>{{ $ordinals[$planets[$planet]['house']] }}</td>
                                <td>
                                    <span class="calc-tag {{ $planet === $report['outside'] ? 'is-care' : 'is-good' }}">
                                        {{ in_array($planet, $report['afterRahu']) ? 'Rahu → Ketu' : 'Ketu → Rahu' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>Rahu and Ketu are always exactly opposite each other. "Rahu → Ketu" means the planet is in the half of the zodiac that runs forward from Rahu to Ketu; "Ketu → Rahu" is the other half. The dosha forms only when all seven are in the same half.</p>
            </div>

            @if ($present)
                <div class="num-seo-content calc-reading">
                    <h3>Remedies traditionally suggested</h3>
                    <ul>
                        <li>Kaal Sarp Dosh Nivaran puja, commonly performed at Trimbakeshwar or Ujjain.</li>
                        <li>Worship of Lord Shiva and chanting the Maha Mrityunjaya mantra.</li>
                        <li>Offering milk and prayers on Nag Panchami.</li>
                        <li>Chanting the Rahu mantra (Om Ram Rahave Namah) and the Ketu mantra (Om Kem Ketave Namah).</li>
                    </ul>
                </div>
            @endif

            <div class="calc-result-actions">
                <button type="button" class="btn-view-more" id="num-share-btn">Share It with others ↗</button>
                <a href="{{ route('kaal-sarp-dosh-calculator') }}" class="btn-primary">Calculate Again</a>
            </div>

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>{{ $present ? 'Get remedies for Kaal Sarp Dosh that fit your chart.' : 'Want a full reading of Rahu and Ketu in your chart?' }}</h3>
                    <p>Talk to a Vedic astrologer for a detailed reading of your kundli.</p>
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
                const title = 'Check my Kaal Sarp Dosh Report';
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
