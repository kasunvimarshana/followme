<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Mail;
use App\Mail\TWOwnerHODTWDevDateReachMail;
use App\User;
use App\TW;

class SendTWOwnerHODTWDevDateReachMailJob implements ShouldQueue
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
            
            $tWUserObj = new User();
            $tWUserObj->mail = $toUser->own_user;
            $tWUserObj = $tWUserObj->getUser();
            $managerObj = $tWUserObj->getManager();
            
            //array_push($ccUserArray, $toUser->own_user);
            array_push($ccUserArray, $tWUserObj->mail);
            if( ($managerObj) ){
                array_push($ccUserArray, $managerObj->mail);
            }
        }
        
        //send mail
        if( isset($tW) ){
            
            //$twCreatedUser = $tW->createdUser()->mail;
            $twCreatedUser = $tW->created_user;
            $ccUserArray = array_unique($ccUserArray);
            
            Mail::to($ccUserArray)
                //->subject("3W")
                //->cc($ccUserArray)
                //->bcc($toTWUsersArray)
                ->send(new TWOwnerHODTWDevDateReachMail($tW));
        }
    }
}
