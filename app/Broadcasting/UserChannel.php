<?php

namespace App\Broadcasting;

use App\Models\User;

class UserChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(User $user, int $id): array|bool
    {   
        \Log::info('🔐 Checking Broadcast channel', ['user_id' => $user->id, 'target_id' => $id]);
        return (int) $user->id === (int) $id;
    }
}
