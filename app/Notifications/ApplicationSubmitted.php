<?php

namespace App\Notifications;

use App\Models\Organiser;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationSubmitted extends Notification
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
            ->greeting('Hello admins,')
            ->line('New organiser application has been submitted, you can view the details below')
            ->action('New organiser', url(route('organiser.show', ['organiser' => $organiser->id])))
            ->line('They will star submitting events once they activate the account.');
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
