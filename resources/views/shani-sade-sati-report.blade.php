@extends('frontend.layouts.master')
@section('title', $name . "'s Shani Sade Sati Report")
@section('content')
    @php
        $moon = $report['moon'];
        $current = $report['current'];
        $cycle = $report['currentCycle'];
        $next = collect($report['cycles'])->firstWhere('status', 'upcoming');
        $statusTag = ['past' => 'Over', 'current' => 'Running now', 'upcoming' => 'Upcoming'];
        $from = fn ($row) => !empty($row['fromBirth']) ? 'Birth' : $row['start']->format('d M Y');
    @endphp
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('shani-sade-sati-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Name Title -->
            <div class="num-report-header">
                <h2>{{ $name }}'s <span class="highlight">Sade Sati Report</span></h2>
                <span class="num-system-tag">Complete analysis of Saturn's influence on your life journey</span>
            </div>

            <!-- Is it running now? -->
            <div class="calc-result">
                <div class="calc-result-body">
                    <span class="calc-pill {{ $current ? 'is-care' : '' }}">{{ $current ? 'Currently active: ' . $current['phase'] : 'Currently not active' }}</span>
                    <p class="calc-result-sub" style="margin: 14px 0 0;">
                        @if ($current)
                            Your Sade Sati runs from {{ $from($cycle) }} to {{ $cycle['end']->format('d-M-Y') }}
                        @elseif ($next)
                            Your next Sade Sati starts from {{ $next['start']->format('d-M-Y') }}
                        @else
                            No further Sade Sati falls within the first hundred years of life
                        @endif
                    </p>
                </div>
            </div>

            <!-- Moon sign, Saturn today, status -->
            <div class="num-main-grid calc-grid-3">
                <div class="num-stat-card">
                    <div class="num-circle is-picture"><img src="{{ asset('assets/images/' . sprintf('horoscope-%02d.avif', array_search($moon['sign'], \App\Helpers\TransitHelper::SIGNS) + 1)) }}" alt="{{ $moon['sign'] }}"></div>
                    <h4>Moon Sign: {{ $moon['hindi'] }}</h4>
                    <p>{{ $moon['sign'] }}. Sade Sati is counted from this sign.</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-pink">♄</div>
                    <h4>Saturn Today: {{ $report['saturnSign'] }}</h4>
                    <p>The sign Saturn (Shani) is passing through on {{ now()->format('d F Y') }}.</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle {{ $current ? 'bg-pink' : 'bg-green' }}">{{ $current ? '!' : '✓' }}</div>
                    <h4>{{ $current ? $current['phase'] : 'No Sade Sati' }}</h4>
                    <p>
                        @if ($current)
                            This Sade Sati runs from {{ $from($cycle) }} to {{ $cycle['end']->format('d M Y') }}.
                        @elseif ($next)
                            Your next Sade Sati begins on {{ $next['start']->format('d M Y') }}.
                        @else
                            No further Sade Sati falls within the first hundred years of life.
                        @endif
                    </p>
                </div>
            </div>

            <div class="num-breakdown">
                <h4>Birth details used</h4>
                <p class="num-breakdown-note">
                    {{ $birth->format('d F Y') }}{{ $timeUnknown ? '' : ', ' . $birth->format('h:i A') }} · {{ $place }}
                </p>
                @if ($timeUnknown)
                    <p class="num-breakdown-note">Birth time was not given, so 12:00 noon was used. If the Moon changed sign on your day of birth, your Moon sign and every date below may be different.</p>
                @elseif ($report['nearCusp'])
                    <p class="num-breakdown-note">The Moon was within one degree of the border between two signs. A birth time that is off by an hour or two could change your Moon sign and with it every date below.</p>
                @endif
            </div>

            <!-- Where you stand today -->
            <div class="num-seo-content calc-reading">
                <h3>Where you stand today</h3>
                @if ($current)
                    <p><strong>{{ $current['phase'] }}, Saturn in {{ $current['sign'] }}</strong> ({{ $from($current) }} to {{ $current['end']->format('d M Y') }}). {{ $current['text'] }}</p>
                    <p>Sade Sati is a time for patience, honest work and simple living. It rewards effort that is steady and removes what was built on weak ground.</p>
                @else
                    <p>Saturn is in {{ $report['saturnSign'] }}, which is not the 12th, 1st or 2nd sign from your Moon in {{ $moon['sign'] }}, so Sade Sati is not running for you now.</p>
                @endif
                @if ($report['currentDhaiya'])
                    <p><strong>Dhaiya is running:</strong> {{ $report['currentDhaiya']['phase'] }}, until {{ $report['currentDhaiya']['end']->format('d M Y') }}. This shorter period of Saturn touches {{ strtolower($report['currentDhaiya']['area']) }}.</p>
                @endif
            </div>

            <!-- Each complete Sade Sati -->
            <div class="num-seo-content calc-reading">
                <h3>Sade Sati periods in your life</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Sade Sati</th>
                            <th>Begins</th>
                            <th>Ends</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($report['cycles'] as $number => $row)
                            <tr>
                                <td><strong>{{ ['1st', '2nd', '3rd', '4th', '5th'][$number - 1] }} cycle</strong></td>
                                <td>{{ $from($row) }}</td>
                                <td>{{ $row['end']->format('d M Y') }}</td>
                                <td><span class="calc-tag {{ $row['status'] === 'current' ? 'is-care' : 'is-good' }}">{{ $statusTag[$row['status']] }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>The dates are the real days on which Saturn enters and leaves the three signs around your Moon, worked out for the first hundred years of life.</p>
            </div>

            <!-- Phase by phase -->
            <div class="num-seo-content calc-reading">
                <h3>Your Sade Sati Timeline</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Cycle</th>
                            <th>Phase</th>
                            <th>Saturn in</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($report['rows'] as $row)
                            <tr>
                                <td>{{ $row['cycle'] }}</td>
                                <td><strong>{{ $row['phase'] }}</strong></td>
                                <td>{{ $row['sign'] }}</td>
                                <td>{{ $from($row) }}</td>
                                <td>{{ $row['end']->format('d M Y') }}</td>
                                <td><span class="calc-tag {{ $row['status'] === 'current' ? 'is-care' : 'is-good' }}">{{ $statusTag[$row['status']] }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>A phase appears more than once when Saturn turns retrograde, steps back into the previous sign for a few months and then returns.</p>
            </div>

            <!-- What each phase brings -->
            <div class="num-seo-content calc-reading">
                <h3>The three phases of your Sade Sati</h3>
                <h4>Shani Sade Sati: Rising Phase</h4>
                <p>Saturn enters the 12th sign from your Moon, {{ \App\Helpers\TransitHelper::SIGNS[($moon['signIndex'] + 11) % 12] }}, and Sade Sati begins. Expenses rise, journeys and changes of place are common, and old matters come up to be settled. Watch your words at work, avoid risky investments and look after your sleep and your eyes. It is a time to simplify life and to clear what is pending.</p>
                <h4>Shani Sade Sati: Peak Phase</h4>
                <p>Saturn passes over your Moon sign, {{ $moon['sign'] }}. This phase is usually felt most strongly: the mind feels heavy, health needs attention and close relationships are tested. Work asks for more effort than usual and results come slowly. Regular routine, a simple diet, patience and honest work carry you through, and what you build now lasts for years.</p>
                <h4>Shani Sade Sati: Setting Phase</h4>
                <p>Saturn moves into the 2nd sign from your Moon, {{ \App\Helpers\TransitHelper::SIGNS[($moon['signIndex'] + 1) % 12] }}. The pressure eases, and attention turns to money, family and speech. Keep spending under control, avoid harsh words at home and take advice before large financial decisions. By the end of this phase the lessons of Sade Sati have turned into maturity and a steadier life.</p>
            </div>

            <!-- The two shorter periods -->
            <div class="num-seo-content calc-reading">
                <h3>Dhaiya (small Panoti) periods</h3>
                <p>Saturn's stay in the 4th and the 8th sign from the Moon is called Dhaiya, because each lasts about two and a half years.</p>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Dhaiya</th>
                            <th>Saturn in</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Touches</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($report['dhaiya'] as $row)
                            <tr>
                                <td><strong>{{ $row['phase'] }}</strong></td>
                                <td>{{ $row['sign'] }}</td>
                                <td>{{ $from($row) }}</td>
                                <td>{{ $row['end']->format('d M Y') }}</td>
                                <td>{{ $row['area'] }}</td>
                                <td><span class="calc-tag {{ $row['status'] === 'current' ? 'is-care' : 'is-good' }}">{{ $statusTag[$row['status']] }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="num-seo-content calc-reading">
                <h3>Vedic Remedies & Astrological Guidance for Shani Sade Sati</h3>
                <p>Lord Saturn (Shani Dev) is the cosmic administrator of divine justice (<em>Karma Phaldata</em>). The following authentic Vedic practices help soften the severity of challenging transits and channel Saturn’s grounding energy toward constructive growth:</p>

                <h4>1. Daily & Weekly Spiritual Upasana</h4>
                <ul>
                    <li><strong>Lord Hanuman Sadhana:</strong> Recite the <em>Hanuman Chalisa</em> daily, and read the <em>Sundarkand</em> or visit a Hanuman temple every Tuesday and Saturday. Traditional Vedic lore holds that Lord Hanuman grants shelter against malefic Saturn influences.</li>
                    <li><strong>Mantra Japa:</strong> Chant the Shani Beej Mantra 108 times using a Rudraksha mala on Saturdays:
                        <br><strong style="color: #1e293b; display:inline-block; margin: 4px 0;">"ॐ शं शनैश्चराय नमः"</strong> (<em>Om Sham Shanaishcharaya Namah</em>) or <strong style="color: #1e293b;">"ॐ प्रां प्रीं प्रौं सः शनैश्चराय नमः"</strong>.</li>
                    <li><strong>Peepal Tree Offering:</strong> Light an earthen lamp (<em>Diya</em>) with pure mustard or sesame oil under a Peepal tree on Saturday evenings after dusk. Circumambulate the tree clockwise 7 times if possible.</li>
                </ul>

                <h4>2. Compassionate Daan (Charity & Karma Alignment)</h4>
                <ul>
                    <li><strong>Saturday Donations:</strong> Donate black mustard oil, whole black urad dal, black sesame seeds, iron cookware (tawa/chimta), or dark blankets to elderly, impoverished, or physically challenged individuals.</li>
                    <li><strong>Seva to the Working Class:</strong> Saturn governs laborers, street sweepers, daily-wage workers, and subordinates. Treat them with respect, pay them promptly, and offer them warm meals or tea on Saturdays.</li>
                    <li><strong>Feeding Animals:</strong> Feed black stray dogs with bread/roti coated in mustard oil, and offer seeds or cooked rice to crows in the early morning.</li>
                </ul>

                <h4>3. Conduct & Lifestyle Principles (Karmic Discipline)</h4>
                <ul>
                    <li>Avoid hasty, speculative financial decisions, gambling, and unverified partnerships during active Sade Sati or Dhaiya periods.</li>
                    <li>Cultivate patience, humility, and disciplined punctuality. Saturn punishes deceit, arrogance, and corner-cutting, but showers long-lasting rewards on honest, diligent effort.</li>
                    <li>Maintain clean speech (<em>Vani Sanyam</em>), particularly within family circles, to prevent preventable domestic misunderstandings.</li>
                </ul>
            </div>

            <div class="calc-result-actions">
                <button type="button" class="btn-view-more" id="num-share-btn">Share It with others ↗</button>
                <a href="{{ route('shani-sade-sati-calculator') }}" class="btn-primary">Calculate Again</a>
            </div>

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>{{ $current ? 'Going through Sade Sati? Get remedies that fit your chart.' : 'Want to prepare for your next Sade Sati?' }}</h3>
                    <p>Talk to a Vedic astrologer about Saturn's place in your birth chart.</p>
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
                const title = 'Check my Sade Sati Report';
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
