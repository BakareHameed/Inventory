<?php

namespace App\Mail;


use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TechHandOverMail extends Mailable
{
    use Queueable, SerializesModels;

    public $clients;
    public $address;
    public $user_role;
    public $user_name;

    public function __construct($clients, $address, $user_role, $user_name)
    {
        $this->clients = $clients;
        $this->address = $address;
        $this->user_role = $user_role;
        $this->user_name = $user_name;
    }

    public function build()
    {
        return $this
            ->from('servicedelivery@syscodescomms.com')
            ->subject('NEW LINK HANDOVER' . '-' . $this->clients)
            ->markdown('emails.TechnicalHandover.HOmail')
            ->with([
                'client' => $this->clients,
                'address' => $this->address,
                'sender_role' => $this->user_role,
                'sender_name' => $this->user_name
            ]);
    }
}
