<?php

namespace App\Notifications;

use App\Models\Attendee;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAttendeeNotification extends Notification
{
    use Queueable;

    private Attendee $attendee;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Attendee $attendee)
    {
        $this->attendee = $attendee;
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
        return (new MailMessage)
                    ->greeting('Dear organiser,')
                    ->line('New participant has registered to your event: '.$this->attendee->event->name)
                    ->line('You can view all their details on your Dashboard');
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
