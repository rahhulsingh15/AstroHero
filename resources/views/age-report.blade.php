@extends('frontend.layouts.master')
@section('title', 'Your Age: ' . $years . ' ' . Str::plural('Year', $years) . ', ' . $months . ' ' . Str::plural('Month', $months) . ' and ' . $days . ' ' . Str::plural('Day', $days))
@section('content')
    <section class="num-report-section">
        <div class="container">
            <a href="{{ route('age-calculator') }}" class="num-back-link">‹ Back to Calculator</a>

            <!-- Title -->
            <div class="num-report-header">
                <h2>{!! !empty($content->heading) ? e($content->heading) : 'Your <span class="highlight">Exact Age</span>' !!}</h2>
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

            @if(!empty($content->main_content))
                <div class="num-seo-content">
                    {!! $content->main_content !!}
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
