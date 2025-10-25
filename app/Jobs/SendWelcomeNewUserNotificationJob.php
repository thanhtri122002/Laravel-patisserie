<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\WelComeNewUserNotification;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendWelcomeNewUserNotificationJob implements ShouldQueue, ShouldBeUniqueUntilProcessing
{
    use Queueable;
    
    public $user;

    public $tries = 5;
    public $uniqueFor = 8;
    public $backoff = 3;
    public $maxExceptions = 3;

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
        try {
            $this->user->notify(new WelComeNewUserNotification("success"));
        } catch (Throwable $e) {
            Log::error("Job failed for user {$this->user->id}: {$e->getMessage()}");
            throw $e;
        }
    }

    public function failed(?Throwable $exception): void
    {
        Log::critical("Job permanently failed for user {$this->user->id}: {$exception?->getMessage()}");
    }  
}
