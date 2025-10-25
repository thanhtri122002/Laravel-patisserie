<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeBack extends Notification
{
    
    public $status;
    /**
     * Create a new notification instance.
     */
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        \Log::info('📬 Notification via() called', ['user' => $notifiable->only(['id', 'name', 'email'])]);
        return ['broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        \Log::info('📧 toMail() called', ['user' => $notifiable->email]);
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {   
        \Log::info('📡 toBroadcast() called', ['user_id' => $notifiable->id, 'name' => $notifiable->name]);
        return new BroadcastMessage([
            "Name" => $notifiable->name,
            'status' => $this->status,
            'Message' => 'Welcom Back to our patisserie '. $notifiable->name
        ]);
    }
}
