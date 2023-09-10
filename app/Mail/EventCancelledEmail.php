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

class EventCancelledEmail extends Mailable
{
    use Queueable, SerializesModels;


    public Event $event;
    private Attendee $attendee;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event, Attendee $attendee)
    {
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
        return new Envelope(
            to: $this->attendee->email,
            subject: 'Cancellation of '.$this->event->name.' on '.\Carbon\Carbon::parse($this->event->start_date)->format('d M y'),
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
            markdown: 'email.event-cancelled',
            with: [
                'event' => $this->event,
                'url' => route('events'),
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
