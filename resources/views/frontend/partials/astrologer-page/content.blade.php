{{-- Chat / Talk page ke neeche wale sections. Params: $content (AstrologerPage), $sections (section => items) --}}
@php
    $features    = $sections->get('feature', collect());
    $verifySteps = $sections->get('verify_step', collect());
    $topics      = $sections->get('topic', collect());
    $serviceTabs = $sections->get('service_tab', collect());
    $faqs        = $sections->get('faq', collect());
@endphp
<section class="why-astrotalk-section">
    <div class="why-container">
        <!-- Part 1: Features -->
        @if($features->isNotEmpty())
            <div class="features-wrapper">
                <h2 class="section-title-new">{{ $content->why_title }}</h2>
                <div class="features-grid">
                    @foreach($features as $feature)
                        <div class="feature-card">
                            <div class="f-icon">
                                @include('frontend.partials.home-icon', ['icon' => $feature->icon, 'size' => 24, 'stroke' => 2])
                            </div>
                            <h3>{{ $feature->title }}</h3>
                            <p>{!! $feature->description !!}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Part 2: Verification Process -->
        @if($verifySteps->isNotEmpty())
            <div class="verify-wrapper">
                <div class="verify-header">
                    <h3>{{ $content->verify_title }}</h3>
                    @if($content->verify_badge)
                        <div class="badge-new">{{ $content->verify_badge }}</div>
                    @endif
                </div>
                <div class="verify-grid">
                    @foreach($verifySteps as $step)
                        <div class="v-step">
                            <span class="v-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <div class="v-content">
                                <h4>{{ $step->title }}</h4>
                                <p>{!! $step->description !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Part 3: Bottom Information -->
        <div class="info-wrapper">
            <div class="info-left">
                <h2>{{ $content->connect_title }}</h2>
                {!! \App\Models\AstrologerPage::blocks($content->connect_description) !!}
            </div>
            @if($topics->isNotEmpty())
                <div class="info-right">
                    <h4>{{ $content->topics_title }}</h4>
                    <ul class="ask-list">
                        @foreach($topics as $topic)
                            <li><span class="tick">✔</span> {{ $topic->title }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</section>
@if($serviceTabs->isNotEmpty())
    <section class="why-astrotalk-content">
        <div class="content-tabs-container">
            <div class="content-header">
                <h2>{{ $content->services_title }}</h2>
                <p>{{ $content->services_subtitle }}</p>
            </div>

            <div class="content-tabs-wrapper">
                <!-- Left Side: Tabs Navigation -->
                <div class="side-tabs-nav">
                    @foreach($serviceTabs as $tab)
                        <button class="side-tab-btn {{ $loop->first ? 'active' : '' }}" data-target="topic-{{ $tab->id }}">{{ $tab->title }}</button>
                    @endforeach
                </div>

                <!-- Right Side: Content Display -->
                <div class="side-tabs-content">
                    @foreach($serviceTabs as $tab)
                        <div class="side-pane {{ $loop->first ? 'active' : '' }}" id="topic-{{ $tab->id }}">
                            <h3>{{ $tab->heading ?: $tab->title }}</h3>
                            {!! \App\Models\AstrologerPage::blocks($tab->description) !!}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
@if($faqs->isNotEmpty())
    <section class="acording_section">
        <div class="acord-container">
            <!-- Left Side: Title -->
            <div class="acord-left">
                <span class="acord-subtitle">FREQUENTLY ASKED</span>
                <h2 class="acord-title">Got doubts? <span class="highlight">Find</span> your answers<br>here.</h2>
            </div>

            <!-- Right Side: Accordion List -->
            <div class="acord-right">
                @foreach($faqs as $faq)
                    <div class="acord-item">
                        <button class="acord-btn">
                            <span>{{ $faq->title }}</span>
                            <div class="acord-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </div>
                        </button>
                        <div class="acord-content">
                            {!! \App\Models\AstrologerPage::blocks($faq->description) !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
