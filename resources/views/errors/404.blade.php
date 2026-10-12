@extends('frontend.layouts.master')
@section('title', 'Page Not Found | AstroHero')
@section('content')

    <section class="error-page-section">
        <div class="error-page-box">
            <span class="error-page-code">404</span>
            <h1>This page is lost among the stars</h1>
            <p>The page you are looking for does not exist or has been moved. Let us take you back to something useful.</p>
            <div class="error-page-actions">
                <a href="{{ route('home') }}" class="btn-login">Back to Home</a>
                <a href="{{ route('horoscope.landing', ['period' => 'daily']) }}" class="error-page-link">Today's Horoscope</a>
                <a href="{{ route('free-kundli') }}" class="error-page-link">Free Kundli</a>
            </div>
        </div>
    </section>

@endsection
