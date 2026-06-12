<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProjectReadyMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Project $project)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu proyecto está listo — Darbin Tech',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.project-ready',
        );
    }
}
