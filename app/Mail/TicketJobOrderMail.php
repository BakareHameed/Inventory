<?php

namespace App\Mail;

use App\Http\Controllers\SurveyController;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketJobOrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $client_name;
    public $engr_name;
    public $sender_name;
    public $sender_role;
    public $client_complaint;
    public $fault;
    public $fault_level;
    public $fault_details;
    public $started_at;
    public $client_address;
    public $client_phone;
    public $purpose;
    public $concat_verf_id;    
    public $resolution;
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

    public function __construct($client_name,$engr_name,$sender_name,$sender_role,$client_complaint,$fault,
                                $fault_level,$fault_details,$started_at,$client_address,$client_phone,$purpose,$concat_verf_id,$resolution)
    {   
        $this->client_name=$client_name;
        $this->engr_name = $engr_name;
        $this->sender_name=$sender_name;
        $this->sender_role = $sender_role;
        $this->client_complaint = $client_complaint;
        $this->fault=$fault;
        $this->fault_level = $fault_level;
        $this->fault_details = $fault_details;
        $this->started_at = $started_at;
        $this->client_address = $client_address;
        $this->client_phone = $client_phone;
        $this->purpose = $purpose;
        $this->concat_verf_id = $concat_verf_id;
        $this->resolution = $resolution;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@syscodescomms.com')
                    ->subject($this->purpose.'-'.$this->resolution.' Support Mail'.'  '.'('.'Ticket ID-'.$this->concat_verf_id.')')
                    ->markdown('emails.field_support_mail')
                    ->with([
                        'client_name' => $this->client_name,
                        'engr_name' => $this->engr_name,
                        'sender_name' => $this->sender_name,
                        'sender_role' => $this->sender_role,
                        'client_complaint' => $this->client_complaint,
                        'fault' =>  $this->fault,
                        'fault_level' =>  $this->fault_level,
                        'fault_details' =>  $this->fault_details,
                        'started_at' =>  $this->started_at,
                        'client_address' =>  $this->client_address,
                        'client_phone' =>  $this->client_phone,
                        'purpose' =>  $this->purpose,
                        'resolution' =>  $this->resolution,
                    ]);

    }


}
