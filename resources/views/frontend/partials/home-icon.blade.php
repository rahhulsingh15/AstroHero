{{-- Home page card icon. Params: $icon (config/home_icons.php key), $size, $stroke --}}
@php
    $homeIcon = config('home_icons.' . $icon) ?? collect(config('home_icons'))->first();
@endphp
@if($homeIcon['filled'])
<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="currentColor">{!! $homeIcon['svg'] !!}</svg>
@else
<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor"
    stroke-width="{{ $stroke }}" stroke-linecap="round" stroke-linejoin="round">{!! $homeIcon['svg'] !!}</svg>
@endif
