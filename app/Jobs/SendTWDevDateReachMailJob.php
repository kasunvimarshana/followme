<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Mail;
use App\Mail\TWDevDateReachMail;

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
        $toTWUsersArray = array();
        foreach($twUsers as $key=>$value){
            //Mail::to($value->own_user)->send($email);
            $toUser = $value->own_user;
            $tempToUsers = array("email" => $toUser, "name" => $toUser);
            array_push($toTWUsersArray, $tempToUsers);
        }
        //send mail
        /*if( isset($toTWUsersArray) ){
            //$email = new TWDevDateReachMail($tW);
            $mailObj = new Mail();
            $mailObj = $mailObj->to($toTWUsersArray);
            //$mailObj->cc($toTWUsersArray);
            //$mailObj->bcc($toTWUsersArray);
            $mailObj->subject("3W");
            //$mailObj->send(new TWDevDateReachMail($tW));
            $mailObj->queue(new TWDevDateReachMail($tW));
            //unset($mailObj);
            //dd(Mail::failures());
        }*/
        if( isset($toTWUsersArray) ){
            Mail::to($toTWUsersArray)
                ->subject("3W")
                //->cc($toTWUsersArray)
                //->bcc($toTWUsersArray)
                ->queue(new TWDevDateReachMail($tW));
        }
    }
}
