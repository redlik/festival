<?php

namespace App\Notifications;

use App\Models\Organiser;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountActivation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Organiser $organiser)
    {
        $this->organiser = $organiser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $organiser = $this->organiser;

        return (new MailMessage)
            ->greeting('Hello,')
            ->line('Thank you for submitting your application! Click on the link below to finalise your registration.')
            ->action('Activate account', url(route('account.activate', ['account' => $organiser->id])))
            ->line('Thank you for being the part of our festival');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
