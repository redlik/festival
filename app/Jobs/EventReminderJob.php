<?php

namespace App\Jobs;

use App\Mail\SendEventReminder;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EventReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $attendeeEmail;

    public Event $event;

    public Booking $booking;

    /**
     * Create a new job instance.
     */
    public function __construct($attendeeEmail, $event, $booking)
    {

        $this->attendeeEmail = $attendeeEmail;
        $this->event = $event;
        $this->booking = $booking;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Email to {email} will be sent today', ['email' => $this->attendeeEmail]);
        Mail::to($this->attendeeEmail)->send(new SendEventReminder($this->event, $this->booking));
    }
}
