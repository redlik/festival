<?php

namespace App\Jobs;

use App\Mail\EventCancelled;
use App\Mail\EventCancelledEmail;
use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EventCancelledNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Event $event;

    public Attendee $attendee;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Event $event, Attendee $attendee)
    {
        $this->event = $event;

        $this->attendee = $attendee;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->attendee)->send(new EventCancelledEmail($this->event, $this->attendee));
    }
}
