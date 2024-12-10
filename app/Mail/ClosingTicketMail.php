<?php

namespace App\Mail;


use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClosingTicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $client;
    public $fault;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message,$client,$fault)
    {
       $this->message = $message;
       $this->client = $client;
       $this->fault = $fault;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@syscodescomms.com')->subject('Ticket Closure'.'-'.$this->client.'['.$this->fault.']')->markdown('emails.ticket_closure')->with('details',$this->message);
    }
}
