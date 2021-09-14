<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $message)
    {
        $this->subject = $subject;
        $this->message = $message;
    }   

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $e_message = $this->message;
        $e_subject = $this->subject; 
        return $this->view('mail.SendMail',compact("e_message"))->subject($e_subject);
    }
}
