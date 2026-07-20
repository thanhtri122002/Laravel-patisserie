<?php

namespace App\Listeners;

use App\Events\UserLogin;
use App\Jobs\SendWelcomeBackNotification;

class SendWelcomBackNotificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserLogin $event): void
    {      
        $userId = $event->user->id;
     
        SendWelcomeBackNotification::dispatch($userId)->onConnection('redis')->onQueue('notifications');
    }

    
}
