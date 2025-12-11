<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword as PasswordsCanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable, PasswordsCanResetPassword, HasApiTokens;

    const ROLE_ADMIN = 'admin';
    const ROLE_SUPER_ADMIN = 'superAdmin';
    const ROLE_MANAGER = 'manager';
    const ROLE_ACCOUNTANT = 'accountant';
    const ROLE_STORAGE_CHECKER = 'storage checker';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function profile(): MorphOne
    {
        return $this->morphOne(Profile::class, 'profilable');
    }
}
