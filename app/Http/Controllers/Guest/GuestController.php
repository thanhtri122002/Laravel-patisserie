<?php

namespace App\Http\Controllers\Guest;

use App\Helpers\Response;
use App\Http\Requests\Guest\SendContactRequest;
use App\Services\Guest\GuestService;

class GuestController extends BaseController
{
    public function sendContact(SendContactRequest $request) 
    {
        $validated = $request->validated();
        $contact = GuestService::getInstance()->sendContact($validated);

        return $this->sendSuccessResponse($contact, "Check your email, your contact has been recorded for later reply", Response::OK);
    }
}
