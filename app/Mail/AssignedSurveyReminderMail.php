<?php

namespace App\Mail;


use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Mail\SurveyRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AssignedSurveyReminderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $customers ;

    public $pending_assigned ;

    // public $address;

    // public $customer_id;
  
  /**
     * The order instance.
     *
     * @var \App\Models\Appointment
     */
    // public $appointment;

    // public ;

    // public $number;
 
    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */



    public function __construct($customers,$pending_assigned)
    {    
        $this->customers=$customers;

        $this->pending_assigned=$pending_assigned;
        // $this->address = $address;

        //  $this->customer_id=$customer_id;

    }






    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()



    {
    



        
        return $this->markdown('emails.AssignedSurveyReminderMail')
                    ->with([
                        'customers' => $this->customers,
                        'pending_assigned ' => $this->pending_assigned,
                        // 'customer_id'=>$this->customer_id

                    ]);

    }


}