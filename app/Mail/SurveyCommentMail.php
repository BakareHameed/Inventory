<?php

namespace App\Mail;


use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Mail\SurveyComment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SurveyCommentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
       $this->details = $details;
          
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('servicedelivery@syscodescomms.com')->subject('New Survey Details')->view('survey_details.surveycomment')->with('details',$this->details);
    }
}
