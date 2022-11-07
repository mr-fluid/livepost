<?php

namespace App\Listeners\Models\User;

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Events\Models\User\UserCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail
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
    public function handle(UserCreated $event)
    {
        Mail::to($event->getUser())
            ->send(new WelcomeMail($event->getUser()));
    }
}
