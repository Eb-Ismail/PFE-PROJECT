<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class profileMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Profile Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $body ='blabla';
        return new Content(
            view: 'emails.inscription',
            with:compact('body')
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromStorage('public/profile/GChrjw0bDNB7vAh7tkhZGr6xAR6qC2oHhfgTOsM5.jpg')
            ->as('image.jpeg')
            ->withMime('image/jpeg'),
        ];
    }
}
