<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;

        $this->from($data["email"], $data["name"]);

        $this->to('dewanshu.chapter247@gmail.com', 'Dewanshu Sharma');
    
        $this->subject($data["subject"]);

        return $this->view('emails.index')->with('data',$data);
    }
}
