<?php

namespace App\Services;

use App\Mail\ContactConfirmationMail;
use App\Mail\ContactInquiryCopyMail;
use App\Mail\NewsletterConfirmationMail;
use App\Mail\NewsletterNewPostMail;
use App\Models\BlogPost;
use App\Models\NewsletterSubscriber;
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
     * Email every active subscriber once, the first time a post is published.
     * Returns sent, failed, or skipped.
     */
    public function sendNewPostEmails(BlogPost $post): string
    {
        if ($post->newsletter_sent_at !== null || ! $post->is_published) {
            return 'skipped';
        }

        $emails = NewsletterSubscriber::query()
            ->where('is_active', true)
            ->orderBy('id')
            ->pluck('email');

        $sent = 0;
        $failed = 0;
        foreach ($emails as $email) {
            $email = mb_strtolower(trim((string) $email));
            if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                continue;
            }
            try {
                Mail::to($email)->send(new NewsletterNewPostMail($post));
                $sent++;
            } catch (Throwable $exception) {
                $failed++;
                report($exception);
            }
        }

        if ($failed > 0 && $sent === 0 && $emails->isNotEmpty()) {
            return 'failed';
        }

        $post->forceFill(['newsletter_sent_at' => now()])->saveQuietly();

        return $sent > 0 ? 'sent' : 'skipped';
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
