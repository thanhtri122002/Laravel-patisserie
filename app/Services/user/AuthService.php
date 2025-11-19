<?php
namespace App\Services\user;

use App\Events\UserLogin;
<<<<<<< HEAD
=======
use App\Http\Requests\user\Auth\LoginRequest;
>>>>>>> master
use App\Models\User;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService extends Service {
    /**
     * A service method handling login logic
     * 
     * First validated the formRequest and then first try to find the user by email and then attemp to log in 
     * if success return true, failed return false
     * 
     * @param \App\Http\Requests\user\Auth\RegisterRequest
     * 
     * @return boolean
     */
    public function login($request) 
    {
        $credentials = $request->validated();
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) return false;
        
<<<<<<< HEAD
=======
        if (!Hash::check($credentials['password'], $user->password)) return false;
        
>>>>>>> master
        if (Auth::guard('web')->attempt($credentials)) {

            $request->session()->regenerate();
            UserLogin::dispatch(Auth::guard('web')->user());
            
            return true;
        }
<<<<<<< HEAD

        return false;
=======
>>>>>>> master
    }

    /**
     * Log out service
     * 
     * @param \Illuminate\Http\Request
     * 
     * @return boolean 
     */
    public function logout(Request $request) 
    {
        Auth::guard('web')->logout();
        $request->session()->regenerateToken();
        $request->session()->invalidate();
<<<<<<< HEAD

        return true;
=======
>>>>>>> master
    }

    /**
     * Registering user service
     * first hash the request password and then create the new user
     * After that, create a auth session for the user
     * 
     * @param \App\Http\Requests\user\Auth\RegisterRequest
     * 
     * @return \App\Models\User
     */
    public function register($validate) 
    {
        $validate['password'] = Hash::make($validate['password']);
        $user = User::create($validate);
        Auth::login($user);
        
        return $user;
    }
}