@extends('frontend.layouts.master')
@section('title', $name . "'s Atmakaraka & Darakaraka Report")
@section('content')
    @php
        $symbols = \App\Helpers\DashaHelper::SYMBOLS;
        $atma = $report['atma'];
        $dara = $report['dara'];
        $amatya = $report['rows'][1];
    @endphp
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('atmakaraka-darakaraka-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Name Title -->
            <div class="num-report-header">
                <h2>{{ $name }}'s <span class="highlight">Karaka Analysis</span></h2>
                <span class="num-system-tag">Atmakaraka &amp; Darakaraka Overview · Vedic Astrology · Lahiri Ayanamsa</span>
            </div>

            <!-- Overview of the two karakas -->
            <div class="num-seo-content calc-reading">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Karaka</th>
                            <th>Planet</th>
                            <th>Degree</th>
                            <th>Sign</th>
                            <th>Sign Lord</th>
                            <th>Nakshatra</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ([$atma, $dara] as $row)
                            <tr>
                                <td><strong>{{ strtoupper($row['karaka']) }}</strong></td>
                                <td><strong>{{ strtoupper($row['planet']) }}</strong></td>
                                <td>{{ number_format($row['inSign'], 2) }}°</td>
                                <td>{{ $row['sign'] }}</td>
                                <td>{{ $row['lord'] }}</td>
                                <td>{{ $row['nakshatra'] }}, Pada {{ $row['pada'] }}</td>
                                <td><span class="calc-tag {{ in_array($row['status'], ['Debilitated', 'Enemy']) ? 'is-care' : 'is-good' }}">{{ strtoupper($row['status']) }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- The three main karakas -->
            <div class="num-main-grid calc-grid-3">
                <div class="num-stat-card">
                    <div class="num-circle bg-purple">{{ $symbols[$atma['planet']] }}</div>
                    <h4>Atmakaraka: {{ $atma['planet'] }}</h4>
                    <p>Your soul planet, at {{ $atma['degree'] }}° {{ sprintf('%02d', $atma['minute']) }}′ {{ $atma['sign'] }}. The highest degree in your chart.</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-pink">{{ $symbols[$dara['planet']] }}</div>
                    <h4>Darakaraka: {{ $dara['planet'] }}</h4>
                    <p>Your spouse planet, at {{ $dara['degree'] }}° {{ sprintf('%02d', $dara['minute']) }}′ {{ $dara['sign'] }}. The lowest degree in your chart.</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-blue">{{ $symbols[$amatya['planet']] }}</div>
                    <h4>Amatyakaraka: {{ $amatya['planet'] }}</h4>
                    <p>Your career planet, at {{ $amatya['degree'] }}° {{ sprintf('%02d', $amatya['minute']) }}′ {{ $amatya['sign'] }}. The second highest degree.</p>
                </div>
            </div>

            <div class="num-breakdown">
                <h4>Birth details used</h4>
                <p class="num-breakdown-note">
                    {{ $birth->format('d F Y') }}{{ $timeUnknown ? '' : ', ' . $birth->format('h:i A') }} · {{ $place }}
                </p>
                @if ($timeUnknown)
                    <p class="num-breakdown-note">Birth time was not given, so 12:00 noon was used. The Moon moves about one degree every two hours, so its place in the order below may be different for your real birth time.</p>
                @endif
                @if ($report['atmaClose'])
                    <p class="num-breakdown-note">{{ $atma['planet'] }} and {{ $amatya['planet'] }} are less than a quarter of a degree apart, so a small error in the birth time could make {{ $amatya['planet'] }} your Atmakaraka. Please confirm your exact time of birth.</p>
                @endif
                @if ($report['daraClose'])
                    <p class="num-breakdown-note">{{ $dara['planet'] }} and {{ $report['rows'][5]['planet'] }} are less than a quarter of a degree apart, so a small error in the birth time could make {{ $report['rows'][5]['planet'] }} your Darakaraka. Please confirm your exact time of birth.</p>
                @endif
            </div>

            <!-- What the two planets say -->
            <div class="num-seo-content calc-reading">
                <h3>Atmakaraka {{ $atma['planet'] }}: the lesson of your soul</h3>
                <p>{{ $report['atmaText'] }}</p>
                <p>Your Atmakaraka is in {{ $atma['sign'] }} ({{ $atma['hindi'] }}), in {{ $atma['nakshatra'] }} nakshatra, pada {{ $atma['pada'] }}.</p>

                <h3>Darakaraka {{ $dara['planet'] }}: your life partner</h3>
                <p>{{ $report['daraText'] }}</p>
                <p>Your Darakaraka is in {{ $dara['sign'] }} ({{ $dara['hindi'] }}), in {{ $dara['nakshatra'] }} nakshatra, pada {{ $dara['pada'] }}.</p>
            </div>

            <!-- All seven karakas -->
            <div class="num-seo-content calc-reading">
                <h3>All seven Chara Karakas in your chart</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Karaka</th>
                            <th>Planet</th>
                            <th>Degree in sign</th>
                            <th>Sign</th>
                            <th>Sign Lord</th>
                            <th>Nakshatra</th>
                            <th>Status</th>
                            <th>Stands for</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($report['rows'] as $row)
                            <tr>
                                <td><strong>{{ $row['karaka'] }}</strong></td>
                                <td>{{ $row['planet'] }}</td>
                                <td>{{ $row['degree'] }}° {{ sprintf('%02d', $row['minute']) }}′</td>
                                <td>{{ $row['sign'] }}</td>
                                <td>{{ $row['lord'] }}</td>
                                <td>{{ $row['nakshatra'] }} ({{ $row['pada'] }})</td>
                                <td>{{ $row['status'] }}</td>
                                <td>{{ $row['meaning'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>The seven planets from the Sun to Saturn are arranged by the degrees they have crossed inside their own sign, from the highest to the lowest. The sign itself is ignored.</p>
            </div>

            <div class="calc-result-actions">
                <button type="button" class="btn-view-more" id="num-share-btn">Share It with others ↗</button>
                <a href="{{ route('atmakaraka-darakaraka-calculator') }}" class="btn-primary">Calculate Again</a>
            </div>

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>Want to know when you will meet your life partner?</h3>
                    <p>Talk to a Vedic astrologer for a full reading of your Atmakaraka, Darakaraka and Navamsa chart.</p>
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
                const title = 'Check my Atmakaraka & Darakaraka Report';
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
