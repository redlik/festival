<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Ramsey\Uuid\Type\Integer;

class OrganiserEmailNewRegistration extends Mailable
{
    use Queueable, SerializesModels;

    private Event $event;
    private $person = 0;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event, $person)
    {
        //
        $this->event = $event;
        $this->person = $person;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'New registration for the event',
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
            markdown: 'email.organiser-email-new-registration',
            with: [
                'event' => $this->event,
                'person' => $this->person,
                'url' => route('event.show-by-slug', $this->event)
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
