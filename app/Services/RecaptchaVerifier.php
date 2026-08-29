<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Throwable;

class RecaptchaVerifier
{
    public function passes(?string $token, ?string $ip = null): bool
    {
        $token = trim((string) $token);
        $secret = (string) config('services.recaptcha.secret_key');
        if ($token === '' || $secret === '') {
            return false;
        }

        try {
            $response = Http::asForm()
                ->timeout(8)
                ->post('https://www.google.com/recaptcha/api/siteverify', array_filter([
                    'secret' => $secret,
                    'response' => $token,
                    'remoteip' => $ip,
                ]));

            return (bool) $response->json('success');
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }
    }
}
