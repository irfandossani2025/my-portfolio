<?php

namespace App\Mail;

use Carbon\CarbonInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JarvisLeadMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array{name: string, email: string, phone: string, question: string, summary: string, consent: bool, website?: string}  $lead
     */
    public function __construct(
        public array $lead,
        public CarbonInterface $receivedAt,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Jarvis lead: '.$this->lead['name'],
            replyTo: [new Address($this->lead['email'], $this->lead['name'])],
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.jarvis-lead');
    }
}
