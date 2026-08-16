<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Throwable;

class LeadNotificationService
{
    public function send(string $subject, array $lines): void
    {
        $recipient = (string) config('lead_notifications.recipient');
        if ($recipient === '') {
            return;
        }

        $body = implode("\n", array_filter($lines, fn ($line) => $line !== ''));

        try {
            Mail::raw($body, function ($message) use ($recipient, $subject): void {
                $message->to($recipient)->subject($subject);
            });
        } catch (Throwable $exception) {
            report($exception);
        }
    }
}
