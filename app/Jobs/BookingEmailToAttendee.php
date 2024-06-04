<?php

namespace App\Jobs;

use App\Mail\WaitingListEmail;
use App\Models\Booking;
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

    private $waiting_status;
    private Booking $booking;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, Event $event, $names, $waiting_status, $booking)
    {
        $this->event = $event;
        $this->names = $names;
        $this->user = $user;
        $this->waiting_status = $waiting_status;
        $this->booking = $booking;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(!$this->waiting_status){
            Mail::to($this->user->email)->send(new BookingNotificationEmail($this->event, $this->names, $this->booking));
        }
        else {
            Mail::to($this->user->email)->send(new WaitingListEmail($this->event, $this->names));

        }
    }
}
