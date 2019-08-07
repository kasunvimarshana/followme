<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Mail;
use App\Mail\TWCloseMail;
use App\User;
use App\TW;

class SendTWCloseMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tW;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($tW)
    {
        //
        $this->tW = $tW;
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
        $twUsers = $tW->twUsers;
        $ccUserArray = array();
            
        foreach($twUsers as $key=>$value){
            $toUser = $value;
            /*
            $tWUserObj = new User();
            $tWUserObj->mail = $toUser->own_user;
            $tWUserObj->getUser();
            array_push($ccUserArray, $tWUserObj->mail);
            */
            array_push($ccUserArray, $toUser->own_user);
        }
        
        //send mail
        if( isset($tW) ){
            
            //$twCreatedUser = $tW->createdUser()->mail;
            $twCreatedUser = $tW->created_user;
            $ccUserArray = array_unique($ccUserArray);
            
            Mail::to($twCreatedUser)
                //->subject("3W")
                ->cc($ccUserArray)
                //->bcc($toTWUsersArray)
                ->send(new TWCloseMail($tW));
        }
    }
}
