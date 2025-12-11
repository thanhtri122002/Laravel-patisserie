<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GuestContactSent extends Notification implements ShouldQueue
{
    use Queueable;
    
    public $contact;
    /**
     * Create a new notification instance.
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Contact Has Been Received')
            ->greeting('Hello ' . ($this->contact->name ?? 'Guest'))
            ->line('We have received your message:')
            ->line($this->contact->message ?? '')
            ->line('Our team will get back to you shortly.')
            ->action('Visit Our Site', url('/home'))
            ->line('Thank you for reaching out!');
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'contact_id' => $this->contact->id,
            'name' => $this->contact->name,
            'email' => $this->contact->email,
            'message' => $this->contact->message,
            'received_at' => $this->contact->created_at->toDateTimeString(),
        ]);
    }
}
