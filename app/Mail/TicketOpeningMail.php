<?php

namespace App\Mail;

use App\Http\Controllers\SurveyController;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketOpeningMail extends Mailable
{
    use Queueable, SerializesModels;
    public $client_name;
    public $engr_name;
    public $sender_role;
    public $sender_name;
    public $client_complaint;
  
 
  /**
     * The order instance.
     *
     * @var \App\Models\Appointment
     */
    // public $appointment;

    // public $name;

    // public $number;
 
    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */

    public function __construct($client_name,$engr_name,$sender_name,$sender_role,$client_complaint)
    {   
        $this->client_name=$client_name;
        $this->engr_name = $engr_name;
        $this->sender_name=$sender_name;
        $this->sender_role = $sender_role;
        $this->client_complaint = $client_complaint;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@syscodescomms.com')
                    ->subject('Ticket Opening Mail')
                    ->markdown('emails.open_ticket')
                    ->with([
                        'client_name' => $this->client_name,
                        'engr_name' => $this->engr_name,
                        'sender_name' => $this->sender_name,
                        'sender_role' => $this->sender_role,
                        'client_complaint' => $this->client_complaint
                    ]);

    }


}
