<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TWInfoCreateMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $tWInfo;
    protected $tW;
    protected $tWUser;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tWInfo, $tW, $tWUser)
    {
        //
        $this->tWInfo = $tWInfo;
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
        $tWInfo = $this->tWInfo;
        $tW = $this->tW;
        $tWUser = $this->tWUser;
        $message = $this;
        
        $message = $message->subject("3W Info");
        $message = $message->view('mail.tw_info_create_mail')->with([
            'tWInfo' => $tWInfo,
            'tW' => $tW,
            'tWUser' => $tWUser
        ]);
        
        return $message;
    }
}
