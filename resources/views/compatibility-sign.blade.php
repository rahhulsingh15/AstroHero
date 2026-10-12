@extends('frontend.layouts.master')
@section('title', $sign . ' Compatibility | Best Matches for ' . $sign)
@section('content')

    <section class="nnc-banner-section">
        <div class="container nnc-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <a href="{{ route('compatibility') }}">COMPATIBILITY</a>
                <span class="separator">›</span>
                <span class="current">{{ strtoupper($sign) }}</span>
            </div>
            <div class="cp-pair-images">
                <img src="{{ asset('assets/images/' . $meta['img']) }}" alt="{{ $sign }}">
            </div>
            <h1>{{ $sign }}</h1>
            <p class="nnc-subtitle">{{ $meta['dates'] }}</p>
        </div>
    </section>

    <section class="nnc-content-section">
        <div class="container nnc-content-wrapper">
            <p>{{ $sign }} is a {{ $meta['modality'] }} {{ $meta['element'] }} sign ruled by {{ $ruler }}. People born under it are {{ $meta['nature'] }}. In love, {{ $sign }} {{ $meta['love'] }}, and what this sign looks for most in a partner is {{ $meta['need'] }}.</p>
            <p>Some signs give {{ $sign }} this easily and others need more understanding. By nature {{ $sign }} gets along best with {{ implode(', ', array_slice($best, 0, -1)) }} and {{ end($best) }}. Choose your partner's sign below to see how the two of you match in love, intimacy, friendship and communication.</p>

            <!-- Choose Your Partner Sign -->
            <h3>Choose Your Partner Sign</h3>
            <div class="zodiac-grid">
                @foreach ($signs as $name => $partner)
                    <a href="{{ route('compatibility.pair', ['sign' => strtolower($sign), 'partner' => strtolower($name)]) }}" class="zodiac-card">
                        <img src="{{ asset('assets/images/' . $partner['img']) }}" alt="{{ $name }}">
                        <h4>{{ $name }}</h4>
                        <span>{{ $partner['dates'] }}</span>
                    </a>
                @endforeach
            </div>

            <h3>{{ $sign }} at a Glance</h3>
            <div class="table-responsive">
                <table class="nnc-table">
                    <tbody>
                        <tr><td>Dates</td><td>{{ $meta['dates'] }}</td></tr>
                        <tr><td>Element</td><td>{{ ucfirst($meta['element']) }}</td></tr>
                        <tr><td>Quality</td><td>{{ ucfirst($meta['modality']) }}</td></tr>
                        <tr><td>Ruling Planet</td><td>{{ $meta['ruler'] }}</td></tr>
                        <tr><td>Nature</td><td>{{ ucfirst($meta['nature']) }}</td></tr>
                        <tr><td>Needs in a Partner</td><td>{{ ucfirst($meta['need']) }}</td></tr>
                        <tr><td>Most Compatible Signs</td><td>{{ implode(', ', $best) }}</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="nnc-promo-section">
        <div class="container">
            <div class="promo-banner">
                <div class="promo-text">
                    <h3>Connect with our Astrologers on Call or Chat for more personalized detailed predictions.</h3>
                </div>
                <div class="promo-actions">
                    <a href="{{ route('talk-to-astrologers') }}" class="btn-call">📞 Call Astrologer</a>
                    <a href="{{ route('chat-with-astrologers') }}" class="btn-chat">💬 Chat Astrologer</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Other free tools -->
    <section class="km-tools-section" style="padding-top: 40px;">
        <div class="container">
            <h2 class="km-heading">Other free tools</h2>
            <div class="km-tools">
                <a href="{{ route('kundli-matching') }}"><span>💞</span> Kundli Matching</a>
                <a href="{{ route('love-calculator') }}"><span>❤️</span> Love Calculator</a>
                <a href="{{ route('name-compatibility-calculator') }}"><span>🔤</span> Name Compatibility</a>
                <a href="{{ route('horoscope.detail', ['period' => 'daily', 'sign' => strtolower($sign)]) }}"><span>📅</span> {{ $sign }} Horoscope Today</a>
            </div>
        </div>
    </section>
@endsection
