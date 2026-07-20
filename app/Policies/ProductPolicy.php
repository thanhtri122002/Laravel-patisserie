<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;

class ProductPolicy
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
        return in_array($admin->role, ['storage checker', 'admin', 'super admin']);
    }
    public function update(Admin $admin)
    {
        return in_array($admin->role, ['storage checker', 'admin', 'super admin']);
    }

    public function delete(Admin $admin)
    {
        return in_array($admin->role, ['storage checker', 'admin', 'super admin']);
    }
    
    public function 
}
