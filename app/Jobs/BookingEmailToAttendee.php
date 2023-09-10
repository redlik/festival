<?php

namespace App\Jobs;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingNotificationEmail;
class BookingEmailToAttendee implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Event $event;

    private User $user;

    private $names = [];


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, Event $event, $names)
    {
        $this->event = $event;
        $this->names = $names;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(new BookingNotificationEmail($this->event, $this->names));
    }
}
