@extends('frontend.layouts.master')
@section('title', 'Your Age: ' . $years . ' ' . Str::plural('Year', $years) . ', ' . $months . ' ' . Str::plural('Month', $months) . ' and ' . $days . ' ' . Str::plural('Day', $days))
@section('content')
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('age-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Title -->
            <div class="num-report-header">
                <h2>Your <span class="highlight">Exact Age</span></h2>
                <span class="num-system-tag">As on {{ $on->format('d F Y') }}</span>
            </div>

            <!-- Years, months, days -->
            <div class="num-main-grid">
                <div class="num-stat-card">
                    <div class="num-circle bg-purple">{{ $years }}</div>
                    <h4>{{ Str::plural('Year', $years) }}</h4>
                    <p>Completed years</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-pink">{{ $months }}</div>
                    <h4>{{ Str::plural('Month', $months) }}</h4>
                    <p>Completed months after the last birthday</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-blue">{{ $days }}</div>
                    <h4>{{ Str::plural('Day', $days) }}</h4>
                    <p>Days after the last completed month</p>
                </div>
                <div class="num-stat-card">
                    <div class="num-circle bg-green">{{ $daysToNext }}</div>
                    <h4>{{ $daysToNext === 0 ? 'Happy Birthday!' : Str::plural('Day', $daysToNext) . ' to Birthday' }}</h4>
                    <p>{{ $daysToNext === 0 ? 'It is your birthday on this date' : 'Until you turn ' . $turning }}</p>
                </div>
            </div>

            <div class="num-breakdown">
                <h4>You are {{ $years }} {{ Str::plural('year', $years) }}, {{ $months }} {{ Str::plural('month', $months) }} and {{ $days }} {{ Str::plural('day', $days) }} old</h4>
                <p class="num-breakdown-note">
                    Counted from <strong>{{ $birth->format('d F Y') }}</strong> to <strong>{{ $on->format('d F Y') }}</strong>.
                </p>
            </div>

            <!-- The same age in other units -->
            <div class="traits-grid">
                @foreach ([
                    ['🎂', 'Date of Birth', $birth->format('d F Y')],
                    ['📅', 'Day You Were Born', $birth->format('l')],
                    ['🗓️', 'Age in Months', number_format($totalMonths) . ' months'],
                    ['📆', 'Age in Weeks', number_format($totalWeeks) . ' weeks'],
                    ['☀️', 'Age in Days', number_format($totalDays) . ' days'],
                    ['⏰', 'Age in Hours', number_format($totalHours) . ' hours'],
                    ['🎉', 'Next Birthday', $next->format('d F Y')],
                    ['📌', 'Next Birthday Falls On', $next->format('l')],
                ] as [$icon, $label, $value])
                    <div class="trait-card">
                        <span class="t-icon">{{ $icon }}</span>
                        <div class="t-info">
                            <span class="t-label">{{ $label }}</span>
                            <strong class="t-value">{{ $value }}</strong>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="view-more-container">
                <a href="{{ route('age-calculator') }}" class="btn-view-more">Calculate another age</a>
            </div>

            <!-- Banner / Action Card -->
            <div class="num-banner-card">
                <div class="banner-text">
                    <h3>Curious what this year of your life holds?</h3>
                    <p>Ask an astrologer about the dasha running at your current age.</p>
                </div>
                <div class="banner-buttons">
                    <a href="{{ route('chat-with-astrologers') }}" class="btn-chat">Chat with Astrologer</a>
                    <a href="{{ route('talk-to-astrologers') }}" class="btn-call">Call Astrologer</a>
                </div>
            </div>

            <!-- How it was counted -->
            <div class="num-seo-content">
                <h3>How this age was counted</h3>
                <p>Completed years are counted first, then the completed months after your last birthday, and then the remaining days. Months of different lengths and leap years are taken into account, so the result matches the way age is written on official forms.</p>
                <ul>
                    <li><strong>Age in days</strong> is the total number of days between the two dates.</li>
                    <li><strong>Age in weeks</strong> is the number of completed weeks in those days.</li>
                    <li><strong>Age in hours</strong> counts 24 hours for every completed day.</li>
                </ul>

                <h4>More calculators</h4>
                <p>
                    <a href="{{ route('mulank-calculator') }}">Mulank Calculator</a> ·
                    <a href="{{ route('dasha-calculator') }}">Dasha Calculator</a> ·
                    <a href="{{ route('numerology-calculator') }}">Numerology Calculator</a>
                </p>
            </div>
        </div>
    </section>
@endsection
