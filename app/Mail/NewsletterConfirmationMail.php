<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class NewsletterConfirmationMail extends Mailable
{
    public function __construct(public string $subscriberEmail)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'You are subscribed to the KodRank insights list',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter.confirmation',
        );
    }
}
