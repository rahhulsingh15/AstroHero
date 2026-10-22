@extends('frontend.layouts.master')
@section('title', $name . "'s Lucky Name Numerology Report - " . $report['percent'] . '%')
@section('content')
    @php
        $n = $report['numbers'];
    @endphp
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('lucky-name-numerology-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Result card -->
            <div class="calc-result">
                <div class="calc-result-head">
                    <h2>{{ $name }}'s Lucky Name Numerology Report</h2>
                    <p>{{ $report['systemLabel'] }} · Born on {{ $birth->format('d F Y') }}</p>
                </div>
                <div class="calc-result-body">
                    <div class="calc-ring" style="--percent: {{ $report['percent'] }};">
                        <div class="calc-ring-inner">
                            <strong>{{ $report['percent'] }}%</strong>
                            <span>MATCH</span>
                        </div>
                    </div>
                    <span class="calc-pill {{ $report['good'] ? '' : 'is-care'  }}">{{ $report['good'] ? '✅' : '⚠️' }} {{ $report['title'] }}</span>

                    <div class="calc-number-row">
                        @foreach ([
                            'Life Path Number'     => $n['lifePath'],
                            'Radical Number'       => $n['radical'],
                            'Personality Number'   => $n['personality'],
                            'Destiny Number'       => $n['destiny'],
                            'Heart Desire Number'  => $n['heart'],
                        ] as $label => $value)
                            <div>
                                <strong>{{ $value ?: '-' }}</strong>
                                <span>{{ $label }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="calc-analysis">
                        <h4>Compatibility Assessment</h4>
                        <p>{{ $report['message'] }}</p>
                    </div>
                </div>
            </div>

            <div class="calc-result-actions">
                <button type="button" class="btn-view-more" id="num-share-btn">Share It with others ↗</button>
                <a href="{{ route('lucky-name-numerology-calculator') }}" class="btn-primary">Calculate Again</a>
            </div>

            <!-- Letter values -->
            <div class="num-breakdown">
                <h4>How your name adds up</h4>
                <div class="num-letters">
                    @foreach ($report['letters'] as $letter)
                        <div class="num-letter {{ $letter['vowel'] ? 'is-vowel' : '' }}">
                            <b>{{ $letter['char'] }}</b>
                            <span>{{ $letter['value'] }}</span>
                        </div>
                    @endforeach
                </div>
                <p class="num-breakdown-note">Total {{ $report['total'] }} → Destiny (Name) Number {{ $report['destiny'] }}</p>
                <p class="num-breakdown-note">
                    <span class="num-key is-vowel"></span> Vowels give the Heart Desire Number,
                    <span class="num-key"></span> consonants give the Personality Number.
                </p>
            </div>

            <!-- What the five numbers are -->
            <div class="num-seo-content calc-reading">
                <h3>Your five numbers</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Number</th>
                            <th>Yours</th>
                            <th>Comes from</th>
                            <th>What it shows</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td><strong>Life Path Number</strong></td><td>{{ $n['lifePath'] }}</td><td>Your full date of birth</td><td>The direction of your life</td></tr>
                        <tr><td><strong>Radical Number</strong></td><td>{{ $n['radical'] }}</td><td>Your day of birth</td><td>Your basic nature</td></tr>
                        <tr><td><strong>Destiny Number</strong></td><td>{{ $n['destiny'] }}</td><td>All the letters of your name</td><td>What your name brings you</td></tr>
                        <tr><td><strong>Heart Desire Number</strong></td><td>{{ $n['heart'] ?: '-' }}</td><td>The vowels of your name</td><td>What you want at heart</td></tr>
                        <tr><td><strong>Personality Number</strong></td><td>{{ $n['personality'] ?: '-' }}</td><td>The consonants of your name</td><td>How others see you</td></tr>
                    </tbody>
                </table>
                <p>The score is out of 100. Up to 40 points come from how well your name number agrees with your life path and radical numbers, up to 30 from your heart desire number, up to 20 from your personality number, and up to 10 from the agreement between your two birth numbers.</p>
                <ul>
                    <li><strong>85% and above:</strong> Highly Compatible</li>
                    <li><strong>70% to 84%:</strong> Compatible</li>
                    <li><strong>50% to 69%:</strong> Moderately Compatible</li>
                    <li><strong>30% to 49%:</strong> Weak Compatibility</li>
                    <li><strong>Below 30%:</strong> Not Compatible</li>
                </ul>
            </div>

            @unless ($report['good'])
                <div class="num-seo-content calc-reading">
                    <h3>Name numbers that would suit you better</h3>
                    <p>In the {{ $report['systemLabel'] }} system, the name numbers that agree with your life path number {{ $n['lifePath'] }} and radical number {{ $n['radical'] }} are <strong>{{ $report['suited'] }}</strong>. Numerologists usually suggest a small spelling change, such as adding or doubling a letter, so that the name total moves to one of these numbers.</p>
                    <p>A name is part of your identity and your documents, so speak to a numerologist before making a real change. You can test a new spelling here as many times as you like.</p>
                </div>
            @endunless

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>Want the right spelling for your name, baby or business?</h3>
                    <p>Talk to an expert numerologist for a personal reading.</p>
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
                const title = 'Check my Lucky Name Numerology Report';
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
