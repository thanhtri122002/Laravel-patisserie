<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;

class AdminPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(Admin $admin)
    {
        return $admin->role === 'superAdmin';
    }

    public function update(Admin $admin)
    {
        return $admin->role === 'superAdmin';
    }

    public function manageUsers(Admin $admin)
    {
       return in_array($admin->role, ['admin', 'superAdmin']);
    }

    
}
