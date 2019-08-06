<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Mail;
use App\Mail\TWDevDateReachMail;
use App\User;

class SendTWDevDateReachMailJob implements ShouldQueue
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
        
        $userObjectArray_1 = array();
        $toUserArray = array();
        $ccUserArray = array();
            
        foreach($twUsers as $key=>$value){
            $toUser = $value;
            
            $tWUserObj = new User();
            $tWUserObj->mail = $toUser->own_user;
            $tWUserObj = $tWUserObj->getUser();
            //$managerObj = $tWUserObj->getManager();
            
            array_push($userObjectArray_1, $tWUserObj);
            array_push($toUserArray, $toUser->own_user);
        }
        
        //send mail
        if( isset($tW) ){
            array_push($ccUserArray, $tW->created_user);
            
            $toUserArray = array_unique($toUserArray);
            $ccUserArray = array_unique($ccUserArray);
            
            Mail::to($toUserArray)
                //->subject("3W")
                //->cc($ccUserArray)
                //->bcc($ccUserArray)
                ->send(new TWDevDateReachMail($tW, $userObjectArray_1));
        }
    }
    
}
