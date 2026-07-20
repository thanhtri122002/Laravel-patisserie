<?php 

namespace App\Services\admin;

use App\Models\User;
use App\Services\Service;

class UserService extends Service 
{

    public function getUserWithCart($id)
    {
        return User::with('cart')->findOrFail($id);
    }

    public function baseQuery()
    {
        return User::with('cart');
    }

    public function index($data, $perPage)
    {
        return $this->baseQuery()
            ->when(isset($data['role']), fn($q) => 
                $q->getUserWithRole($data['role'])
            )
            ->paginate($perPage);
    }

    public function update($data)
    {
        $user = $this->getUser();
        $updatedUser = $user->update($data);

        return $updatedUser;
    }

    public function delete($id)
    {
        $user = $this->getUser();
        $user->delete();

        return true;
    }


}