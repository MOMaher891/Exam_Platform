<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class accept_inspector extends Mailable
{
    use Queueable, SerializesModels;
    private $data = [];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->$data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("mohamedmagdymohamed982@gmail.com", 'MOhamed Magdy')
            ->subject($this->data['subject'])->view('emails.accept_mail')->with('data', $this->data);
    }
}
