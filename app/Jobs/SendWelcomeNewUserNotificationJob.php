<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\WelComeNewUserNotification;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendWelcomeNewUserNotificationJob implements ShouldQueue, ShouldBeUnique
{
    use Queueable;
    
    public $user;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->notify(new WelComeNewUserNotification());
    }
}
