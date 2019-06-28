<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TWResubmitMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $tW;
    protected $tWUser;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tW, $tWUser)
    {
        //
        $this->tW = $tW;
        $this->tWUser = $tWUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        $tW = $this->tW;
        $tWUser = $this->tWUser;
        $message = $this;
        
        $message = $message->subject("3W Resubmit");
        $message = $message->view('mail.tw_resubmit_mail')->with([
            'tW' => $tW,
            'tWUser' => $tWUser
        ]);
        
        return $message;
    }
}
