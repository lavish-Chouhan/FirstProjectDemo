<?php

namespace App\Listeners;

use App\Events\EventDemo;
use App\Mail\EventDemoMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailOwnerAboutDemoLogin
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
     * @param  object  $event
     * @return void
     */
    public function handle(EventDemo $event)
    {
        DB::table('eventdemo')->insert([
            'email' => $event->email
        ]);

        Mail::to($event->email)->send(new EventDemoMessage());
    }
}
