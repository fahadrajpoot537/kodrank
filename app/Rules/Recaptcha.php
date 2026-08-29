<?php

namespace App\Rules;

use App\Services\RecaptchaVerifier;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Recaptcha implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $ok = app(RecaptchaVerifier::class)->passes(
            is_string($value) ? $value : null,
            request()->ip()
        );

        if (! $ok) {
            $fail('Please complete the captcha so we know you are human.');
        }
    }
}
