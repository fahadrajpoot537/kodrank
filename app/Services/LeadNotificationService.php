<?php

namespace App\Services;

use App\Mail\ContactConfirmationMail;
use App\Mail\ContactInquiryCopyMail;
use App\Mail\NewsletterConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Throwable;

class LeadNotificationService
{
    /**
     * @param  array<string, mixed>  $lead
     */
    public function sendInquiryEmails(array $lead): void
    {
        $userEmail = trim((string) ($lead['email'] ?? ''));
        if (filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($userEmail)->send(new ContactConfirmationMail($lead));
            } catch (Throwable $exception) {
                report($exception);
            }
        }

        $this->sendAdminCopy($lead);
    }

    public function sendNewsletterEmails(string $subscriberEmail): void
    {
        $subscriberEmail = mb_strtolower(trim($subscriberEmail));
        if (filter_var($subscriberEmail, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($subscriberEmail)->send(new NewsletterConfirmationMail($subscriberEmail));
            } catch (Throwable $exception) {
                report($exception);
            }
        }

        $this->sendAdminCopy([
            'source' => 'Newsletter signup',
            'name' => 'Newsletter subscriber',
            'email' => $subscriberEmail,
            'message' => 'A visitor subscribed to the KodRank insights list.',
        ]);
    }

    /**
     * @param  array<string, mixed>  $lead
     */
    public function sendAdminCopy(array $lead): void
    {
        $recipient = (string) config('lead_notifications.recipient');
        if ($recipient === '') {
            return;
        }

        try {
            Mail::to($recipient)->send(new ContactInquiryCopyMail($lead));
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    public function send(string $subject, array $lines): void
    {
        $this->sendAdminCopy([
            'source' => $subject,
            'name' => 'KodRank notification',
            'email' => (string) config('lead_notifications.recipient'),
            'message' => implode("\n", array_filter($lines, fn ($line) => $line !== '')),
        ]);
    }
}
