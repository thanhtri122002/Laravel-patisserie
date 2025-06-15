<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\User;

abstract class Service {
    
    /**
     * @var null|User|Admin
     */
    protected $user = null;

    /**
     * A function that will attached the instance with a specifiec user
     * 
     * @param User|Admin|null
     * @return $this the current instance that is attached with the user
     */
    public function withUser($user) {

        $this->user = $user;
        return $this;
    }
    /**
     * Get the current user of that is attached to the service
     * 
     * @return User|Admin|null
     */
    public function getUser() {

        return $this->user;
    }

    /**
     * Create new service instance from Laravel's service container 
     * 
     * @return $this
     */
    public static function getInstance() {

        return app(static::class);
    }
    

}