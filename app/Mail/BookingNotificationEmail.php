<?php

namespace App\Mail;

use App\Models\Booking;
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
    private Booking $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event, $names, Booking $booking)
    {

        $this->event = $event;
        $this->names = $names;
        $this->booking = $booking;
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
        $number_of_people = count($this->names)/3;

        return new Content(
            markdown: 'email.booking-email-attendee',
            with: [
                'event' => $this->event,
                'names' => $this->names,
                'count' => $number_of_people,
                'booking' => $this->booking,
                'url' => route('event.show-by-slug', $this->event->slug),
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
