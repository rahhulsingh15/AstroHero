@extends('frontend.layouts.master')
@section('title', 'FLAMES Calculator - Find the Bond Between Two Names')
@section('content')

    <section class="nnc-banner-section">
        <div class="container nnc-header">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">FLAMES CALCULATOR</span>
            </div>
            <h1>{{ $content->heading ?: 'FLAMES Calculator - Find the Bond Between Two Names' }}</h1>
            @if(!empty($content->description))
                <p class="nnc-subtitle">{{ $content->description }}</p>
            @endif
        </div>
    </section>

    <section class="nnc-form-section">
        <div class="container">
            <div class="nnc-card">
                <div class="card-header">
                    <span class="icon">📝</span>
                    <h2>Calculate your FLAMES here</h2>
                </div>
                <form class="nnc-form" method="GET" action="{{ route('flames-report') }}" autocomplete="off">
                    @if ($errors->any())
                        <div class="ras-form-error">{{ $errors->first() }}</div>
                    @endif
                    <div class="form-group">
                        <label for="nnc-name1">Your Name *</label>
                        <input type="text" id="nnc-name1" name="name1" value="{{ old('name1') }}" placeholder="Enter your name" maxlength="50" pattern=".*[A-Za-z].*" title="Enter the name in English letters" required>
                    </div>
                    <div class="form-group">
                        <label for="nnc-name2">Your Partner's Name *</label>
                        <input type="text" id="nnc-name2" name="name2" value="{{ old('name2') }}" placeholder="Enter your partner's name" maxlength="50" pattern=".*[A-Za-z].*" title="Enter the name in English letters" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Calculate FLAMES</button>
                        <button type="reset" class="btn-secondary">Reset</button>
                    </div>
                </form>
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

    @if(!empty($content->main_content))
        <section class="nnc-content-section">
            {!! $content->main_content !!}
        </section>
    @endif

    @if(!empty($content->faq_content))
        <section class="acording_section">
            {!! $content->faq_content !!}
        </section>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Accordion FAQ Logic
            const acordBtns = document.querySelectorAll('.acord-btn');

            acordBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const item = btn.parentElement;
                    const isActive = item.classList.contains('active');

                    // Close all
                    document.querySelectorAll('.acord-item').forEach(otherItem => {
                        otherItem.classList.remove('active');
                    });

                    // Toggle current
                    if (!isActive) {
                        item.classList.add('active');
                    }
                });
            });
        });
    </script>
@endsection
