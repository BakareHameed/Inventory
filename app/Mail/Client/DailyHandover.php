<?php

namespace App\Mail\Client;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class DailyHandover extends Mailable
{
    use Queueable, SerializesModels;
    public $clients;
    public $senderName;
    public $senderEmail;
    public $senderRole;
    public $service_type;
    public $count;
    public $today;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($clients, $senderName, $senderEmail, $senderRole, $service_type, $count, $today)
    {
        $this->clients = $clients;
        $this->senderName = $senderName;
        $this->senderEmail = $senderEmail;
        $this->senderRole = $senderRole;
        $this->service_type = $service_type;
        $this->count = $count;
        $this->today = $today;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address($this->senderEmail, $this->senderName),
            subject: $this->service_type . '-' . ' Daily Handover',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.client.dailyHandover',
            with: [
                'clients' => $this->clients,
                'senderName' => $this->senderName,
                'senderRole' => $this->senderRole,
                'service_type' => $this->service_type,
                'count' => $this->count,
                'today' => $this->today,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
