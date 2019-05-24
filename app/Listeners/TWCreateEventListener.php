<?php

namespace App\Listeners;

use App\Events\TWCreateEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TWCreateEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TWCreateEvent  $event
     * @return void
     */
    public function handle(TWCreateEvent $event)
    {
        //
    }
}
