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

    public function createAdmin(Admin $admin)
    {
        return $admin->role === 'superAdmin';
    }

    public function updateAdmin(Admin $admin)
    {
        return $admin->role === 'superAdmin';
    }

    public function manageUser(Admin $admin)
    {
       return in_array($admin->role, ['admin', 'superAdmin']);
    }

    public function seeInvoice
}
