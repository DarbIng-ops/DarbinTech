<?php

namespace App\Mail;

use App\Models\PreRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PreRegistrationReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly PreRegistration $preRegistration,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Recibimos tu idea — Darbin Tech',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pre-registration-received',
        );
    }
}
