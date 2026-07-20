<?php 

namespace App\Services\Auth;

use App\Models\User;
use App\Services\Service;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordService extends Service 
{
    public function show($request) 
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    public function handle($data, $broker) 
    {
        $status = Password::broker($broker)->reset(collect($data)->only('email', 'password', 'password_confirmation', 'token')->toArray(),

            function (User $user , string $password) {

                $user->forceFill([
                    'password' => Hash::make($password),
                    ])->setRememberToken(Str::random(60));
                    
                $user->save();

                event(new PasswordReset($user));
            }
        );
        
        return $status === Password::PASSWORD_RESET ? 
           
        
    }
}