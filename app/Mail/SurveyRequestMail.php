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

class SurveyRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $clients ;

    public $address;

    public $customer_id;
    public $user_role;
    public $user_name;
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



    public function __construct($clients,$address,$customer_id,$user_role,$user_name)
    {    
        $this->clients=$clients;

        $this->address = $address;

         $this->customer_id=$customer_id;
         $this->user_role=$user_role;
         $this->user_name=$user_name;
    }






    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()



    {
    




        return $this->markdown('emails.SurveyRequest')
                    ->with([
                        'clients' => $this->clients,
                        'number' => $this->address,
                        'customer_id'=>$this->customer_id,
                        'user_role'=>$this->user_role,
                        'user_name'=>$this->user_name
                    ]);

    }


}