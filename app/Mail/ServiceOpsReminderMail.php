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

class ServiceOpsReminderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $customers ;

    public $pending ;

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



    public function __construct($customers,$pending)
    {    
        $this->customers=$customers;

        $this->pending=$pending;
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
    



        
        return $this->markdown('emails.ServiceOpsReminderMail')
                    ->with([
                        'customers' => $this->customers,
                        'pending ' => $this->pending,
                        // 'customer_id'=>$this->customer_id

                    ]);

    }


}