<?php

namespace App\Mail;

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JOApprovalMail extends Mailable
{
    use Queueable, SerializesModels;
    public $message;
    public $from;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message)
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
        return $this->from('sbabatunde@syscodescomms.com')
            ->subject('Job Order Review' . '-' . $this->message['client'] . '(' . $this->message['survey_id'] . ')')
            ->markdown('emails.JOApproval')->with('details', $this->message);
    }
}
