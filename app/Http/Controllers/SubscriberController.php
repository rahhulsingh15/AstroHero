<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'status'    => 'required|in:granted,denied,default',
            'fcm_token' => 'nullable|string|max:2000',
        ]);

        $ip = $request->ip();
        $token = $request->fcm_token;

        // Pehle token se dhundo, agar nahi mila to user ki IP se dhundo taaki NULL token wala record update ho jaye
        $subscriber = null;
        if (!empty($token)) {
            $subscriber = Subscriber::where('fcm_token', $token)->first();
        }
        if (!$subscriber && $ip) {
            $subscriber = Subscriber::where('ip_address', $ip)->first();
        }

        if ($subscriber) {
            $subscriber->update([
                'ip_address' => $ip,
                'status'     => $request->status,
                'fcm_token'  => $token ?: $subscriber->fcm_token,
                'user_agent' => $request->userAgent(),
            ]);
        } else {
            Subscriber::create([
                'ip_address' => $ip,
                'status'     => $request->status,
                'fcm_token'  => $token,
                'user_agent' => $request->userAgent(),
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Saved successfully']);
    }

    /**
     * Firebase service worker. Route se isliye diya taaki config .env se aaye.
     */
    public function serviceWorker()
    {
        $config = json_encode($this->firebaseWebConfig());

        $js = <<<JS
importScripts('https://www.gstatic.com/firebasejs/10.12.2/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.12.2/firebase-messaging-compat.js');

firebase.initializeApp({$config});

// Background message: notification payload Firebase SDK khud dikha deta hai
firebase.messaging();

// Site khuli hone par jo notification humne khud dikhaya, uske click par link kholo
self.addEventListener('notificationclick', function (event) {
    const link = event.notification.data && event.notification.data.link;
    if (!link) return;
    event.notification.close();
    event.waitUntil(clients.openWindow(link));
});
JS;

        return response($js, 200, [
            'Content-Type'  => 'application/javascript',
            'Cache-Control' => 'no-cache',
        ]);
    }

    public static function firebaseWebConfig(): array
    {
        return [
            'apiKey'            => config('services.firebase.api_key'),
            'authDomain'        => config('services.firebase.auth_domain'),
            'projectId'         => config('services.firebase.project_id'),
            'storageBucket'     => config('services.firebase.storage_bucket'),
            'messagingSenderId' => config('services.firebase.messaging_sender_id'),
            'appId'             => config('services.firebase.app_id'),
        ];
    }
}
