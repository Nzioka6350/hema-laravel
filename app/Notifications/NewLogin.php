<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLogin extends Notification implements ShouldQueue
{
    use Queueable;

    private $ip;
    private $platform;

    /**
     * Create a new notification instance.
     */
    public function __construct(Request $request)
    {
        //
        $this->ip = $request->ip();
        $this->platform = $request->header('sec-ch-ua-platform');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['broadcast', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
            'title' => 'New Login',
            'description' => 'A new Login was made into your account' . ($this->platform ? ', on ' . $this->platform : '.') . '. Device ip is ' . $this->ip,
        ];
    }
}
