<?php

namespace App\Services;

use Google\Client as GoogleClient;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class FirebaseService
{
    /**
     * Ek saath kitne tokens ko parallel request bhejni hai.
     */
    private const CHUNK_SIZE = 50;

    /**
     * Sab tokens par notification bhejo.
     * Return: ['sent' => int, 'failed' => int, 'invalid' => [tokens jo ab kaam nahi karte]]
     */
    public function sendToTokens(array $tokens, string $title, string $body, ?string $link = null): array
    {
        $url = 'https://fcm.googleapis.com/v1/projects/' . config('services.firebase.project_id') . '/messages:send';
        $accessToken = $this->accessToken();

        $result = ['sent' => 0, 'failed' => 0, 'invalid' => []];

        foreach (array_chunk($tokens, self::CHUNK_SIZE) as $chunk) {
            $responses = Http::pool(fn (Pool $pool) => array_map(
                fn ($token) => $pool->as($token)
                    ->withToken($accessToken)
                    ->timeout(15)
                    ->post($url, ['message' => $this->message($token, $title, $body, $link)]),
                $chunk
            ));

            foreach ($responses as $token => $response) {
                if ($response instanceof \Illuminate\Http\Client\Response && $response->successful()) {
                    $result['sent']++;
                    continue;
                }

                $result['failed']++;

                // Browser ne permission hata di ya token expire ho gaya: aise token ko DB se hata denge
                if ($response instanceof \Illuminate\Http\Client\Response) {
                    $errorCode = $response->json('error.details.0.errorCode');
                    if ($response->status() === 404 || in_array($errorCode, ['UNREGISTERED', 'INVALID_ARGUMENT'], true)) {
                        $result['invalid'][] = $token;
                    }
                }
            }
        }

        return $result;
    }

    private function message(string $token, string $title, string $body, ?string $link): array
    {
        $message = [
            'token' => $token,
            'notification' => [
                'title' => $title,
                'body' => $body,
            ],
            'webpush' => [
                'notification' => [
                    'icon' => url('/favicon.ico'),
                ],
            ],
        ];

        if ($link) {
            $message['webpush']['fcm_options'] = ['link' => $link];
        }

        return $message;
    }

    /**
     * Service account se Google OAuth token. Token ~1 ghanta chalta hai, isliye 50 minute cache.
     */
    private function accessToken(): string
    {
        return Cache::remember('firebase_access_token', now()->addMinutes(50), function () {
            $credentials = config('services.firebase.credentials');

            if (! is_file($credentials)) {
                throw new RuntimeException("Firebase service account file nahi mili: {$credentials}");
            }

            $client = new GoogleClient();
            $client->setAuthConfig($credentials);
            $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

            $token = $client->fetchAccessTokenWithAssertion();

            if (empty($token['access_token'])) {
                throw new RuntimeException('Firebase access token nahi mila: ' . json_encode($token));
            }

            return $token['access_token'];
        });
    }
}
