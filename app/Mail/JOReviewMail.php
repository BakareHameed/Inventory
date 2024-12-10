<?php

namespace App\Mail;

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JOReviewMail extends Mailable
{
    use Queueable, SerializesModels;
    public $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message,)
    {
       $this->message = $message;
          
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('serviceoperation@syscodescomms.com')->subject('Job Order Review Mail')->markdown('emails.JOReview')->with('details',$this->message);
    }
}
