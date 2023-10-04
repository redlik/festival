<?php

namespace App\Mail;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingCancelledByAttendee extends Mailable
{
    use Queueable, SerializesModels;

    public Event $event;

    public Attendee $attendee;

    public $subject = 'Booking Cancelled By Attendee';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event, $attendee)
    {
        //
        $this->event = $event;
        $this->attendee = $attendee;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        if ($this->attendee->waiting_status)
        {
            $this->subject = 'Waiting list entry removed';
        }

        return new Envelope(
            subject: $this->subject,

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
            markdown: 'email.booking-cancelled-by-attendee',
            with: [
                'event' => $this->event,
                'attendee' => $this->attendee,

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
