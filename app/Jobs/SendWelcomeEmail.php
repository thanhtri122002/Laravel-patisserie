<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\user\mail\MailToUserService;
use Illuminate\Contracts\Queue\ShouldBeEncrypted;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendWelcomeEmail implements ShouldQueue, ShouldBeUnique, ShouldBeEncrypted
{
    use Queueable;

   
    protected $userId;

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
    public function handle(MailToUserService $service): void
    {   
        $user = User::find($this->userId);
        
        $service->sendWelcomeNewUser($user);
    }

    public function uniqueId(): string
    {
        return (string) $this->userId;
    }
}
