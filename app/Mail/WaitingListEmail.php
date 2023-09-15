<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WaitingListEmail extends Mailable
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
            subject: 'Kerry Mental Health Fest - Waiting List',
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
            markdown: 'email.waiting-list-email',
            with: [
                'event' => $this->event,
                'names' => $this->names,
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