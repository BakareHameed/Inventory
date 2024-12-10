<?php

namespace App\Mail;

use App\Http\Controllers\SurveyController;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EditedJobOrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $client_name;
    public $sender_role;
    public $sender_name;
    public $survey_id;

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

    public function __construct($client_name,$sender_name,$sender_role,$survey_id)
    {   
        $this->client_name=$client_name;
        $this->sender_name=$sender_name;
        $this->sender_role = $sender_role;
        $this->survey_id = $survey_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('servicedelivery@syscodescomms.com')
                    ->subject('Edited Job Order')
                    ->markdown('emails.editedJobOrder')
                    ->with([
                        'client_name' => $this->client_name,
                        'sender_name' => $this->sender_name,
                        'sender_role' => $this->sender_role,
                        'survey_id'   =>$this->survey_id
                    ]);

    }


}
