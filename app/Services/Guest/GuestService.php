<?php

namespace App\Services\Guest;

use App\Models\Contact;
use App\Notifications\GuestContactSent;
use App\Services\Service;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Notification;

class GuestService extends Service {
    
    /**
     * a service to store a contact for later reply in the admin dashboard
     * 
     * Description flow
     *  1/ Storing the contact in the contact database
     *  2/ Send sent successful notifications to the guest
     *  3/ Sent a confirmation email that is confirm the contact is delivered
     *  4/ Broadcast to the admin Dashboard
     */
    public function sendContact ($validated)
    {
        $contact = Contact::create($validated);
        Notification::route('mail', $validated['email'])->notify(new GuestContactSent($contact));

        return $contact;
    }
}