<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ContactConfirmationMail extends Mailable
{
    /**
     * @param  array<string, mixed>  $lead
     */
    public function __construct(public array $lead)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'We received your request — KodRank will be in touch within 24 hours',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact.confirmation',
        );
    }
}
