<?php

namespace App\Mail;

use App\Http\Controllers\SurveyController;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Mail\SurveyRequest;
use App\Console\Commands;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FinanceReminderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $customers;

    public $pending;

    
 
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



    public function __construct($customers,$pending)
    {    
        $this->customers=$customers;

        $this->pending=$pending;



    }






    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()



    {
    




        return $this->markdown('emails.FinanceReminderMail')
                    ->with([
                        'customers' => $this->customers,
                        'pending' => $this->pending,
                  

                    ]);

    }


}
