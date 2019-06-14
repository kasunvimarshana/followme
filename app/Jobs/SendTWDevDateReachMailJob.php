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
        $email = new TWDevDateReachMail($tW);
        
        $twUsers = $tW->twUsers;
        foreach($twUsers as $key=>$value){
            //Mail::to($value->own_user)->send($email);
            $toUsers = $value->own_user;
            $mailObj = Mail::to($value->own_user);
            $mailObj->send($email);
            //dd(Mail::failures());
        }
    }
}
