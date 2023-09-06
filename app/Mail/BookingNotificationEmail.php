<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Event;

class BookingNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public Event $event;

    public array $names = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event, $names)
    {

        $this->event = $event;
        $this->names = $names;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Kerry Mental Health Fest booking',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'email.booking-email-attendee',
            with: [
                'event' => $this->event,
                'names' => $this->names,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}