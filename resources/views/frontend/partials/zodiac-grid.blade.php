<!-- 12 Zodiac Signs Links Grid -->
<div class="other-zodiacs">
    <h2 class="section-title">{{ $title }}</h2>
    <p class="section-subtitle">{{ $subtitle }}</p>
    <div class="zodiac-grid">
        @foreach($zodiacMeta as $name => $meta)
            <a href="{{ route('horoscope.detail', ['period' => $period, 'sign' => strtolower($name)]) }}"
               data-sign="{{ strtolower($name) }}"
               class="zodiac-card {{ $name === ($selectedSign ?? null) ? 'border-primary' : '' }}">
                <img src="{{ asset('assets/images/' . $meta['img']) }}" alt="{{ $name }}">
                <h4>{{ $name }}</h4>
                <span>{{ $meta['dates'] }}</span>
            </a>
        @endforeach
    </div>
</div>
