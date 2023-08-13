<?php

namespace App\Jobs;

use App\Mail\EventCancelledEmail;
use App\Mail\OrganiserEmailNewRegistration;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Type\Integer;

class BookingEmailToOrganiser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Event $event;
    private $person = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Event $event, int $person)
    {
        //
        $this->event = $event;
        $this->person = $person;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->event->user->email)
            ->send(new OrganiserEmailNewRegistration($this->event, $this->person));

    }
}
