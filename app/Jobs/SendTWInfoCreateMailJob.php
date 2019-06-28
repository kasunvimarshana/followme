<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Mail;
use App\Mail\TWInfoCreateMail;
use App\User;

class SendTWInfoCreateMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tWInfo;
    protected $tW;
    protected $tWUser;
    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $tWInfo = $this->tWInfo;
        $tW = $this->tW;
        $tWUser = $this->tWUser;
        $tWUserObj = new User();
        $tWUserObj->mail = $tWUser->own_user;
        $tWUserObj->getUser();
        
        //send mail
        if( isset($tWUserObj) ){
            Mail::to($tWUserObj->mail)
                //->subject("3W")
                //->cc($toTWUsersArray)
                //->bcc($toTWUsersArray)
                ->send(new TWInfoCreateMail($tWInfo, $tW, $tWUserObj));
        }
    }
}
