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

        <style>
            /* Card Container */
.astro-notify-card {
    position: fixed;
    top: 25px;
    right: 25px;
    width: 360px;
    background: linear-gradient(145deg, #181428, #0e0b18);
    border: 1px solid rgba(245, 197, 24, 0.28);
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.65), 0 0 20px rgba(245, 197, 24, 0.08);
    z-index: 999999;
    font-family: inherit;
    backdrop-filter: blur(10px);
    transform: translateY(-20px) scale(0.95);
    opacity: 0;
    pointer-events: none;
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
}

.astro-notify-card.show {
    transform: translateY(0) scale(1);
    opacity: 1;
    pointer-events: auto;
}

/* Header & Icon */
.astro-notify-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.astro-icon-glow {
    width: 44px;
    height: 44px;
    background: radial-gradient(circle, rgba(245, 197, 24, 0.22) 0%, rgba(20, 16, 35, 0.8) 100%);
    border: 1px solid rgba(245, 197, 24, 0.45);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #f5c518;
}

.astro-close-btn {
    background: transparent;
    border: none;
    color: #8c829e;
    font-size: 22px;
    cursor: pointer;
    line-height: 1;
    transition: color 0.2s;
}

.astro-close-btn:hover {
    color: #ffffff;
}

/* Body Content */
.astro-notify-body h4 {
    margin: 0 0 6px 0;
    font-size: 16px;
    font-weight: 600;
    color: #f5c518;
    letter-spacing: 0.3px;
}

.astro-notify-body p {
    margin: 0 0 18px 0;
    font-size: 13px;
    line-height: 1.5;
    color: #b7b0c8;
}

/* Action Buttons */
.astro-notify-actions {
    display: flex;
    gap: 10px;
}

.btn-astro-cancel {
    flex: 1;
    background: transparent;
    border: 1px solid rgba(255, 255, 255, 0.12);
    color: #b7b0c8;
    padding: 9px 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-astro-cancel:hover {
    background: rgba(255, 255, 255, 0.05);
    color: #ffffff;
}

.btn-astro-allow {
    flex: 1.4;
    background: linear-gradient(135deg, #f5c518, #d49a07);
    border: none;
    color: #120e1e;
    padding: 9px 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    box-shadow: 0 4px 14px rgba(245, 197, 24, 0.35);
    transition: all 0.2s ease;
}

.btn-astro-allow:hover {
    filter: brightness(1.1);
    transform: translateY(-1px);
}

/* Mobile responsive */
@media (max-width: 480px) {
    .astro-notify-card {
        top: auto;
        bottom: 20px;
        right: 15px;
        left: 15px;
        width: auto;
    }
}
        </style>
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


<!-- Astro Notification Permission Card -->
<div id="astroNotifyBanner" class="astro-notify-card">
    <div class="astro-notify-header">
        <div class="astro-icon-glow">
            <!-- Spiritual / Star Icon -->
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
        </div>
        <button type="button" class="astro-close-btn" id="dismissAstroNotify">&times;</button>
    </div>

    <div class="astro-notify-body">
        <h4>Daily Kundli & Nakshatra Updates</h4>
        <p>Get instant alerts when your daily rashifal and auspicious muhurat are published.</p>
    </div>

    <div class="astro-notify-actions">
        <button type="button" class="btn-astro-cancel" id="laterAstroNotify">Maybe Later</button>
        <button type="button" class="btn-astro-allow" id="enableAstroNotify">
            <span>Enable Updates</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>
    </div>
</div>




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
    <!-- Firebase push notifications -->
    <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-messaging-compat.js"></script>
    <script>
        // Browser ka FCM token lo aur DB mein save karo. Isi token par admin se notification jaata hai.
        window.astroSaveSubscriber = async function (permission) {
            let fcmToken = null;

            if (permission === "granted" && "serviceWorker" in navigator && window.firebase) {
                try {
                    if (!firebase.apps.length) {
                        firebase.initializeApp(@json(\App\Http\Controllers\SubscriberController::firebaseWebConfig()));
                    }
                    const registration = await navigator.serviceWorker.register("{{ route('firebase.sw') }}");
                    await navigator.serviceWorker.ready;
                    const messaging = firebase.messaging();
                    fcmToken = await messaging.getToken({
                        vapidKey: @json(config('services.firebase.vapid_key')),
                        serviceWorkerRegistration: registration
                    });

                    // Site khuli ho tab bhi notification dikhao
                    messaging.onMessage(function (payload) {
                        const n = payload.notification || {};
                        registration.showNotification(n.title || "Kundli", {
                            body: n.body || "",
                            icon: "/favicon.ico",
                            data: { link: (payload.fcmOptions && payload.fcmOptions.link) || "/" }
                        });
                    });
                } catch (e) {
                    console.error("Firebase token error:", e);
                }
            }

            // Token bina badle baar baar save na ho
            try {
                if (fcmToken && localStorage.getItem("astro_fcm_token") === fcmToken) return;
            } catch (e) {}

            return fetch("{{ route('subscriber.save') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ status: permission, fcm_token: fcmToken })
            })
            .then(res => res.json())
            .then(data => {
                if (fcmToken) {
                    try { localStorage.setItem("astro_fcm_token", fcmToken); } catch (e) {}
                }
                console.log("DB Saved:", data);
            })
            .catch(err => console.error("Error saving:", err));
        };

        // Jinhone pehle hi Allow kar diya hai unka token bhi save/refresh karo
        if ("Notification" in window && Notification.permission === "granted") {
            window.addEventListener("load", () => window.astroSaveSubscriber("granted"));
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const banner = document.getElementById("astroNotifyBanner");
            const allowBtn = document.getElementById("enableAstroNotify");
            const laterBtn = document.getElementById("laterAstroNotify");
            const dismissBtn = document.getElementById("dismissAstroNotify");

            // Agar browser permission reset ho chuki hai ("default"), to purana cached token hata do
            if ("Notification" in window && Notification.permission === "default") {
                try { localStorage.removeItem("astro_fcm_token"); } catch (e) {}
            }

            // Check if notifications are supported & not already granted/dismissed
            const isDismissed = localStorage.getItem("astro_notify_dismissed");

            if ("Notification" in window && Notification.permission === "default" && !isDismissed) {
                // Show after 2.5 seconds of page load smoothly
                setTimeout(() => {
                    banner.classList.add("show");
                }, 2500);
            }

            function hideBanner(permanently = false) {
                banner.classList.remove("show");
                if (permanently) {
                    localStorage.setItem("astro_notify_dismissed", "true");
                }
            }

            // User triggers the browser notification API via user click
            allowBtn.addEventListener("click", async function () {
            hideBanner(false);
            try {
                const permission = await Notification.requestPermission();
                
                // Backend Laravel Route par IP, permission aur FCM token send karein
                await window.astroSaveSubscriber(permission);

                if (permission === "granted") {
                    new Notification("Kundli Predictions Active ✨", {
                        body: "Namaste! Daily updates are now active.",
                        icon: "/favicon.ico"
                    });
                }
            } catch (e) {
                console.error("Notification permission error:", e);
            }
        });

            laterBtn.addEventListener("click", () => hideBanner(false));
            dismissBtn.addEventListener("click", () => hideBanner(true));
        });
</script>
</body>
</html>