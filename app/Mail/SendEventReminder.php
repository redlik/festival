<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\Venue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class SendEventReminder extends Mailable
{
    use Queueable, SerializesModels;

    public Event $event;

    public $venue = null;

    /**
     * Create a new message instance.
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->event->name.' - Event Reminder',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'email.sendeventreminder',
            with: [
                'event' => $this->event,
                'venue' => $this->getVenue() ?? null,
                'url' => route('event.show-by-slug', $this->event->slug)
            ]
        );
    }

    public function getVenue()
    {
        ray($this->event->type);
        if ($this->event->type != 'online') {
            $this->venue = Venue::find($this->event->venue_id);
        }
        return $this->venue;
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
