<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProfileEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $code;  
    /**
    * Create a new message instance.
*
    * @return void
    */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reset_password',['code'=>$this->code]);
    }
}
