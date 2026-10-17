@extends('frontend.layouts.master')
@section('title', $name . "'s Transit Chart for " . $today->format('d F Y'))
@section('content')
    @php
        $ordinal = fn (int $n) => $n . (['th', 'st', 'nd', 'rd'][$n > 3 ? 0 : $n]);
    @endphp
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('transit-chart-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Name Title -->
            <div class="num-report-header">
                <h2>{{ strtr($content->heading ?: "{name}'s Transit Chart", ['{name}' => $name]) }}</h2>
                <span class="num-system-tag">Planets on {{ $today->format('d F Y') }}</span>
            </div>

            <!-- Birth chart points the transits are counted from -->
            <div class="num-main-grid calc-grid-3">
                <div class="num-stat-card">
                    <div class="num-circle is-picture"><img src="{{ asset('assets/images/' . sprintf('horoscope-%02d.avif', array_search($moon['sign'], \App\Helpers\TransitHelper::SIGNS) + 1)) }}" alt="{{ $moon['sign'] }}"></div>
                    <h4>Moon Sign: {{ $moon['sign'] }}</h4>
                    <p>{{ $moon['hindi'] }} rashi. Transits are read mainly from here.</p>
                </div>
                <div class="num-stat-card">
                    @if ($lagna)
                        <div class="num-circle is-picture"><img src="{{ asset('assets/images/' . sprintf('horoscope-%02d.avif', array_search($lagna['sign'], \App\Helpers\TransitHelper::SIGNS) + 1)) }}" alt="{{ $lagna['sign'] }}"></div>
                    @else
                        <div class="num-circle bg-pink">?</div>
                    @endif
                    <h4>Lagna: {{ $lagna['sign'] ?? 'Not known' }}</h4>
                    <p>{{ $lagna ? $lagna['hindi'] . ' lagna, your rising sign.' : 'A birth time is needed to find the Lagna.' }}</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-blue">☆</div>
                    <h4>Nakshatra: {{ $nakshatra }}</h4>
                    <p>The star the Moon was in when you were born.</p>
                </div>
            </div>

            <div class="num-breakdown">
                <h4>Birth details used</h4>
                <p class="num-breakdown-note">
                    {{ $birth->format('d F Y') }}{{ $timeUnknown ? '' : ', ' . $birth->format('h:i A') }} · {{ $place }}
                </p>
                @if ($timeUnknown)
                    <p class="num-breakdown-note">Birth time was not given, so 12:00 noon was used. If you were born close to the time the Moon changed sign, your Moon sign may be different.</p>
                @endif
            </div>

            <!-- Where each planet is today -->
            <div class="num-seo-content calc-reading">
                <h3>Where the planets are for you today</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Planet</th>
                            <th>Now in</th>
                            <th>House from Moon</th>
                            @if ($lagna)
                                <th>House from Lagna</th>
                            @endif
                            <th>Area of life it touches</th>
                            <th>Effect</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $planet => $row)
                            <tr>
                                <td><strong>{{ $planet }}</strong>{{ $row['retro'] ? ' (R)' : '' }}</td>
                                <td>{{ $row['sign'] }} {{ $row['degree'] }}°</td>
                                <td>{{ $ordinal($row['fromMoon']) }}</td>
                                @if ($lagna)
                                    <td>{{ $ordinal($row['fromLagna']) }}</td>
                                @endif
                                <td>{{ $row['area'] }}</td>
                                <td><span class="calc-tag {{ $row['good'] ? 'is-good' : 'is-care' }}">{{ $row['good'] ? 'Favourable' : 'Needs care' }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>(R) means the planet is retrograde. "Favourable" and "Needs care" follow the classical gochar rules, counted from your Moon sign.</p>
            </div>

            <!-- The slow planets, which shape the longer chapters -->
            <div class="num-seo-content calc-reading">
                <h3>The transits that matter most right now</h3>
                <ul>
                    <li><strong>Saturn in {{ $rows['Saturn']['sign'] }}:</strong> {{ $saturnNote }} Its focus for you is {{ strtolower($rows['Saturn']['area']) }}.</li>
                    <li><strong>Jupiter in {{ $rows['Jupiter']['sign'] }}:</strong> Jupiter is in your {{ $ordinal($rows['Jupiter']['fromMoon']) }} house, {{ $rows['Jupiter']['good'] ? 'a supportive position that brings growth in' : 'a position where growth comes slowly in' }} {{ strtolower($rows['Jupiter']['area']) }}.</li>
                    <li><strong>Rahu in {{ $rows['Rahu']['sign'] }} and Ketu in {{ $rows['Ketu']['sign'] }}:</strong> Rahu stirs up {{ strtolower($rows['Rahu']['area']) }} ({{ $ordinal($rows['Rahu']['fromMoon']) }} house), while Ketu asks you to let go a little in {{ strtolower($rows['Ketu']['area']) }} ({{ $ordinal($rows['Ketu']['fromMoon']) }} house).</li>
                    <li><strong>Moon in {{ $rows['Moon']['sign'] }} today:</strong> the Moon is in your {{ $ordinal($rows['Moon']['fromMoon']) }} house, so today your mind is on {{ strtolower($rows['Moon']['area']) }}.</li>
                </ul>
            </div>

            <div class="view-more-container">
                <button type="button" class="btn-view-more" id="num-share-btn">Share this report ↗</button>
            </div>

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>{{ $inSadeSati ? 'Going through Sade Sati? Get remedies that fit your chart.' : 'Want to know how these transits will affect you?' }}</h3>
                    <p>Talk to a Vedic astrologer for a reading of your birth chart and current transits together.</p>
                </div>
                <div class="banner-buttons">
                    <a href="{{ route('chat-with-astrologers') }}" class="btn-chat">Chat with Astrologer</a>
                    <a href="{{ route('talk-to-astrologers') }}" class="btn-call">Call Astrologer</a>
                </div>
            </div>

            <!-- What the houses stand for -->
            <div class="num-seo-content">
                <h3>How to read this chart</h3>
                <p>Houses are counted from your Moon sign: the sign your Moon is in is the 1st house, the next sign is the 2nd, and so on. A planet passing through a house brings its nature to that area of your life for as long as it stays in that sign.</p>

                <h4>What each house stands for</h4>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>House</th>
                            <th>Area of life</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($areas as $number => $area)
                            <tr>
                                <td>{{ $ordinal($number) }}</td>
                                <td>{{ $area }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(!empty($content->main_content))
                <div class="num-seo-content">
                    {!! strtr($content->main_content, ['{name}' => $name]) !!}
                </div>
            @endif
        </div>
    </section>

    @if(!empty($content->faq_content))
        <section class="acording_section">
            {!! $content->faq_content !!}
        </section>
    @endif

    <script>
        // Share: phone share sheet where available, otherwise copy the report link
        const shareBtn = document.getElementById('num-share-btn');
        if (shareBtn) {
            shareBtn.addEventListener('click', async () => {
                const title = 'Check my Transit Chart';
                try {
                    if (navigator.share) {
                        await navigator.share({ title, url: location.href });
                    } else {
                        await navigator.clipboard.writeText(location.href);
                        shareBtn.textContent = 'Link copied ✓';
                        setTimeout(() => shareBtn.textContent = 'Share this report ↗', 2000);
                    }
                } catch (e) {}
            });
        }

        // Accordion FAQ Logic
        document.querySelectorAll('.acord-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const item = btn.parentElement;
                const isActive = item.classList.contains('active');
                document.querySelectorAll('.acord-item').forEach(other => other.classList.remove('active'));
                if (!isActive) item.classList.add('active');
            });
        });
    </script>
@endsection
