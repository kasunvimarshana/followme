<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TWDevDateReachMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $tW;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tW)
    {
        //
        $this->tW = $tW;
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
        return $this->view('mail.tw_dev_date_reach_mail')->with([
            'tW' => $tW
        ]);
    }
}
