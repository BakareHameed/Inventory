<?php

namespace App\Mail;

use App\Http\Controllers\SurveyController;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Mail\SurveyRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SurveyPaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $clients;

    public $address;

    public $customer_id;
    
 
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



    public function __construct($clients,$address,$customer_id)
    {    
        $this->clients=$clients;

        $this->address = $address;

         $this->customer_id=$customer_id;


    }






    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()



    {
    




        return $this->markdown('emails.surveypayment')
                    ->with([
                        'clients' => $this->clients,
                        'address' => $this->address,
                        'customer_id'=>$this->customer_id,
                  

                    ]);

    }


}
