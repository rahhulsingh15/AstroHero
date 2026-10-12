@extends('frontend.layouts.master')
@section('title', $a . ' & ' . $b . ' Zodiac Compatibility | Love, Friendship & More')
@section('content')

    <section class="nnc-banner-section">
        <div class="container nnc-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <a href="{{ route('compatibility') }}">COMPATIBILITY</a>
                <span class="separator">›</span>
                <a href="{{ route('compatibility.sign', ['sign' => strtolower($a)]) }}">{{ strtoupper($a) }}</a>
                <span class="separator">›</span>
                <span class="current">{{ strtoupper($b) }}</span>
            </div>
            <h1>{{ $a }} <span class="amp">&amp;</span> {{ $b }} Zodiac Compatibility</h1>
            <p class="nnc-subtitle">Love, sex, friendship &amp; more</p>
            <div class="cp-pair-images">
                <img src="{{ asset('assets/images/' . $metaA['img']) }}" alt="{{ $a }}">
                <img src="{{ asset('assets/images/' . $metaB['img']) }}" alt="{{ $b }}">
            </div>
            <p class="cp-pair-name">{{ $a }} &amp; {{ $b }}</p>
        </div>
    </section>

    <!-- Main Content & Sidebar -->
    <section class="km-main-section">
        <div class="container">
            <div class="km-split">
                <!-- Left Content -->
                <div class="km-left">
                    @foreach ($sections as $section)
                        <div class="cp-block">
                            <h2>{{ $section['title'] }}</h2>
                            <div class="cp-bar">
                                <div class="cp-bar-fill" style="width: {{ $section['percent'] }}%;"></div>
                                <span class="cp-bar-value">{{ $section['percent'] }}%</span>
                            </div>
                            @foreach ($section['text'] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>
                    @endforeach

                    <div class="cp-block">
                        <h2>Relationship Tips</h2>
                        <ul class="nnc-list">
                            @foreach ($tips as $tip)
                                <li>{{ $tip }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <p class="cp-note">This reading compares Sun signs only. Not sure of your sign? Use the <a href="{{ route('sun-sign-calculator') }}">Sun Sign Calculator</a>, or try <a href="{{ route('kundli-matching') }}">Kundli Matching</a> for a comparison of both birth charts.</p>
                </div>

                <!-- Right Sidebar -->
                <div class="km-right">
                    <div class="sidebar-widget">
                        <div class="widget-header">
                            <h4>Are you compatible?</h4>
                            <p>Choose your and your partner's zodiac sign to check compatibility</p>
                        </div>
                        <form class="cp-filter" id="cp-filter" data-url="{{ url('/compatibility') }}">
                            <div class="form-group">
                                <label for="cp-your-sign">Your Sign</label>
                                <select id="cp-your-sign" name="sign">
                                    @foreach ($signs as $name => $meta)
                                        <option value="{{ strtolower($name) }}" @selected($name === $a)>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cp-partner-sign">Partner's Sign</label>
                                <select id="cp-partner-sign" name="partner">
                                    @foreach ($signs as $name => $meta)
                                        <option value="{{ strtolower($name) }}" @selected($name === $b)>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="km-submit">Submit</button>
                            <a href="{{ route('love-calculator') }}" class="btn-view-all" style="display: block; text-align: center; text-decoration: none; margin-top: 0;">Love Calculator</a>
                        </form>
                    </div>

                    <div class="sidebar-widget" style="margin-top: 20px;">
                        <div class="widget-header">
                            <h4>Talk to an Astrologer</h4>
                            <p>Connect on Call or Chat for more personalised detailed predictions.</p>
                        </div>
                        <div class="cp-contact">
                            <a href="{{ route('talk-to-astrologers') }}" class="btn-call">📞 Call Astrologer</a>
                            <a href="{{ route('chat-with-astrologers') }}" class="btn-chat">💬 Chat Astrologer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Compatibility With Other Signs -->
    <section class="km-tools-section">
        <div class="container">
            <h2 class="km-heading">{{ $a }} Compatibility With <span>Other Signs</span></h2>
            <p class="km-sub">Check your relationship compatibility</p>
            <div class="cp-pairs">
                @foreach ($signs as $name => $meta)
                    <a href="{{ route('compatibility.pair', ['sign' => strtolower($a), 'partner' => strtolower($name)]) }}" class="cp-pair-card {{ $name === $b ? 'active' : '' }}">
                        <span class="cp-pair-card-images">
                            <img src="{{ asset('assets/images/' . $metaA['img']) }}" alt="{{ $a }}">
                            <img src="{{ asset('assets/images/' . $meta['img']) }}" alt="{{ $name }}">
                        </span>
                        {{ $a }} &amp; {{ $name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        // "Are you compatible?" : chuni hui dono rashiyon ka page kholo
        document.getElementById('cp-filter').addEventListener('submit', function (e) {
            e.preventDefault();
            window.location.href = this.dataset.url + '/' + this.elements.sign.value + '/' + this.elements.partner.value;
        });
    </script>
@endsection
