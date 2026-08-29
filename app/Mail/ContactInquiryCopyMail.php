<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ContactInquiryCopyMail extends Mailable
{
    /**
     * @param  array<string, mixed>  $lead
     */
    public function __construct(public array $lead)
    {
    }

    public function envelope(): Envelope
    {
        $name = trim((string) ($this->lead['name'] ?? 'Website visitor'));
        $email = trim((string) ($this->lead['email'] ?? ''));
        $source = trim((string) ($this->lead['source'] ?? 'website form'));

        $replyTo = [];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $replyTo[] = new Address($email, $name !== '' ? $name : $email);
        }

        return new Envelope(
            subject: 'New inquiry copy — '.$name.' via '.$source,
            replyTo: $replyTo,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact.admin-copy',
        );
    }
}
