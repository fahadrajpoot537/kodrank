<?php

namespace App\Mail;

use App\Models\BlogPost;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class NewsletterNewPostMail extends Mailable
{
    public function __construct(public BlogPost $post)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New on KodRank: '.$this->post->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter.new-post',
        );
    }
}
