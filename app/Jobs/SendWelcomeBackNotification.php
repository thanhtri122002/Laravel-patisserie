<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\WelcomeBack;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendWelcomeBackNotification implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    public $userId;
   
    /**
     * Create a new job instance.
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {   
        
        $user = User::find($this->userId);
        $user->notify(new WelcomeBack('success'));
    }

    public function uniqueId(): string
    {
        return (string) $this->userId;
    }
}
