<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>@yield('title', 'AstroHero')</title>
    <meta name="description" content="@yield('meta_description', 'AstroHero: talk to verified Vedic astrologers, get your free kundli, kundli matching, daily horoscope and astrology calculators.')">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
    <script>
        // Pichhli baar chuni hui theme page dikhne se pehle laga do (warna dark se light ka jhatka dikhta hai)
        (function () {
            try {
                // ?theme=light ya ?theme=dark se bhi theme set ho sakti hai
                const asked = new URLSearchParams(location.search).get('theme');
                if (asked === 'light' || asked === 'dark') {
                    localStorage.setItem('theme', asked);
                }
                if (localStorage.getItem('theme') === 'light') {
                    document.documentElement.setAttribute('data-theme', 'light');
                }
            } catch (e) {}
        })();
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    {{-- ?v= file badalte hi badal jaata hai, taaki browser purani CSS cache se na dikhaye --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ filemtime(public_path('assets/css/style.css')) }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;0,800;1,500;1,600;1,700&family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="top-ticker-bar">
        <div class="ticker-track" id="top-ticker">
            <span class="ticker-item"><i class="dot-live"></i> <strong>Kavya</strong> from Jaipur just started a chat
                with <span>Astro Rahul</span> <small>· 1 min ago</small></span>
            <span class="ticker-star">✦</span>
            <span class="ticker-item"><i class="dot-live"></i> <strong>Rohan</strong> from Ahmedabad booked Rahu Ketu
                Puja with <span>Pt. Vashishtha</span> <small>· Just now</small></span>
            <span class="ticker-star">✦</span>
            <span class="ticker-item"><i class="dot-live"></i> <strong>Pooja</strong> from Chandigarh got Kundli
                matching done by <span>Acharya Dev</span> <small>· 3 min ago</small></span>
            <span class="ticker-star">✦</span>
            <span class="ticker-item"><i class="dot-live"></i> <strong>Amit</strong> from Kolkata consulted <span>Tarot
                    Riya</span> for Love & Relationship <small>· 2 min ago</small></span>
            <span class="ticker-star">✦</span>
            <span class="ticker-item"><i class="dot-live"></i> <strong>Simran</strong> from Lucknow booked Career
                Guidance with <span>Dr. Aradhana</span> <small>· 5 min ago</small></span>
            <span class="ticker-star">✦</span>
            <span class="ticker-item"><i class="dot-live"></i> <strong>Deepak</strong> from Indore booked Vastu
                Consultation with <span>Pt. Sharma</span> <small>· 4 min ago</small></span>
            <span class="ticker-star">✦</span>
        </div>
    </div>
    <!-- Header -->
    @include('frontend.layouts.header')
    @yield('content')
    <!-- Footer -->
    @include('frontend.layouts.footer')
    <!-- Night sky stars, shown behind every page -->
    <svg class="stars" width="100%" height="100%" aria-hidden="true"></svg>
    <script>
        (function () {
            const starsSvg = document.querySelector('svg.stars');
            if (!starsSvg) return;
            let starMarkup = '';
            for (let i = 0; i < 90; i++) {
                const x = Math.random() * 100,
                    y = Math.random() * 100,
                    r = Math.random() * 1.4 + 0.4,
                    o = Math.random() * 0.6 + 0.3,
                    fill = i % 6 === 0 ? '#f2d9a8' : '#fff',
                    dur = (Math.random() * 3 + 2.5).toFixed(1),
                    delay = (Math.random() * 5).toFixed(1);
                starMarkup += `<circle cx="${x}%" cy="${y}%" r="${r}" fill="${fill}" style="--o:${o};animation-duration:${dur}s;animation-delay:-${delay}s"/>`;
            }
            starsSvg.innerHTML = starMarkup;
        })();
    </script>
    <script>
        // Theme switch: dark <-> light, aur pasand yaad rakho
        (function () {
            const toggle = document.getElementById('theme-toggle');
            if (!toggle) return;
            toggle.addEventListener('click', function () {
                const light = document.documentElement.getAttribute('data-theme') !== 'light';
                if (light) {
                    document.documentElement.setAttribute('data-theme', 'light');
                } else {
                    document.documentElement.removeAttribute('data-theme');
                }
                try { localStorage.setItem('theme', light ? 'light' : 'dark'); } catch (e) {}
            });
        })();
    </script>
    
</body>
</html>