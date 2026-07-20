<?php

namespace App\Services\user\mail;

use App\Mail\SendPriceUpdatedMail;
use App\Mail\WelcomeEmail;
use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailToUserService extends Service
{


    public function sendWelcomeNewUser($user)
    {
        Mail::to($user)->send(new WelcomeEmail($user));
    }

    public function sendMailPriceUpdated($user, $product)
    {
        if ($user) {
            Mail::to($user)->send(new SendPriceUpdatedMail($product));
        }
    }
}
