<?php 

namespace App\Services\Auth;

use App\Services\Service;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasswordResetLinkService extends Service 
{
    public function show()
    {
        return view('auth.forgot-password');
    }

    public function handle($email) 
    {
        $status = Password::sendResetLink(['email' => $email]);

        return $status === Password::RESET_LINK_SENT ?
        response()->json(['link' => $status])
        : response()->json(['error' => __($status)]);
    }
}
