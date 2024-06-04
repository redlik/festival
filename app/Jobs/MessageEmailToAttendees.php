<?php

namespace App\Jobs;

use App\Mail\MessageAttendees;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MessageEmailToAttendees implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $attendee;
    private $message = [];

    /**
     * Create a new job instance.
     */
    public function __construct($attendee, $message)
    {
        //
        $this->attendee = $attendee;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->attendee)->send(new MessageAttendees($this->message));
    }
}
