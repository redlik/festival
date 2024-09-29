<?php

namespace App\Jobs;

use App\Mail\SendEventReminder;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EventReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $attendeeEmail;

    public Event $event;

    /**
     * Create a new job instance.
     */
    public function __construct($attendeeEmail, $event)
    {

        $this->attendeeEmail = $attendeeEmail;
        $this->event = $event;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->attendeeEmail)->send(new SendEventReminder($this->event));
    }
}
