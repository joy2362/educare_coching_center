<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccontCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $details , $name,$password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$details,$password)
    {
        $this->name = $name;
        $this->details = $details;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to Educare Family')->markdown('emails.student.details',['details'=>$this->details,'name'=>$this->name]);
    }
}
