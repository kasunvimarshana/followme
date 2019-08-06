<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Mail;
use App\Mail\TWResubmitMail;
use App\User;

class SendTWResubmitMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tW;
    protected $tWUser;
    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $tW = $this->tW;
        $tWUser = $this->tWUser;
        $tWUserObj = new User();
        $tWUserObj->mail = $tWUser->own_user;
        $tWUserObj = $tWUserObj->getUser();
        
        $toUserArray = array();
        $ccUserArray = array();
        
        //send mail
        if( isset($tWUserObj) ){
            
            $toUserArray = array($tWUserObj->mail);
            $ccUserArray = array($tW->created_user);
            
            Mail::to( $toUserArray )
                //->subject("3W")
                ->cc($ccUserArray)
                //->bcc($toTWUsersArray)
                ->send(new TWResubmitMail($tW, $tWUserObj));
        }
    }
}
