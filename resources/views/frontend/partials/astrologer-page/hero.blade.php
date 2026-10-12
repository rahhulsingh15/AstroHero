{{-- Chat / Talk page ka top banner. Param: $content (AstrologerPage) --}}
<section class="chat-with-astrologer-section">
    <div class="container-chat">
        <!-- Left Side Content -->
        <div class="chat-banner-content">
            <div class="breadcrumb">
                <a href="{{ url('/') }}">HOME</a>
                <span class="separator">›</span>
                <span class="current">{{ $content->breadcrumb_label }}</span>
            </div>
            <h1>{{ $content->hero_title }}</h1>
            <p>{!! $content->hero_description !!}</p>
        </div>

        <!-- Right Side Animated UI -->
        @if($content->hero_astrologer_name)
            <div class="chat-banner-visual">
                @if($content->slug === 'talk')
                    <!-- Audio Waveform Pill -->
                    <div class="audio-pill">
                        <div class="waveform">
                            <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
                        </div>
                        <span class="timer">{{ $content->hero_pill_text }}</span>
                        <span class="recording-dot"></span>
                    </div>
                @else
                    <!-- Chat Bubbles -->
                    <div class="chat-bubbles">
                        @if($content->hero_pill_text)
                            <div class="chat-bubble">{{ $content->hero_pill_text }}</div>
                        @endif
                        <div class="chat-bubble typing-bubble">
                            <span></span><span></span><span></span>
                        </div>
                    </div>
                @endif

                <!-- Avatar with pulse -->
                <div class="avatar-container">
                    <div class="pulse-ring"></div>
                    <div class="pulse-ring delay"></div>
                    <img src="{{ $content->heroImageUrl() }}" alt="{{ $content->hero_astrologer_name }}" class="caller-avatar">
                    <div class="call-action-btn">
                        @if($content->slug === 'talk')
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="white" stroke="white" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                            </svg>
                        @else
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="white" stroke="white" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                </path>
                            </svg>
                        @endif
                    </div>
                </div>

                <div class="caller-info">
                    <h3>{{ $content->hero_astrologer_name }}</h3>
                    @if($content->hero_status_text)
                        <p>{{ $content->hero_status_text }} <span class="dots">...</span></p>
                    @endif
                </div>
            </div>
        @endif
    </div>
</section>
