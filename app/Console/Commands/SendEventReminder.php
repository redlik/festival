<?php

namespace App\Console\Commands;

use App\Jobs\EventReminderJob;
use App\Models\Attendee;
use App\Models\Booking;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendEventReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends event reminder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = Event::where('start_date', Carbon::now()->addDays(3)->format('Y-m-d'))->get();

        $ids = $events->pluck('id')->toArray();

        $attendees = Attendee::whereIn('event_id', $ids)
            ->where('waiting_status', false)
//            ->where('email' != '')
            ->get();

        Log::info('Sending reminder to {count} attendees', ['count' => $attendees->count()]);

        foreach ($attendees as $attendee) {
            $event = $events->filter(function ($event) use ($attendee) {
                return $event->id == $attendee->event_id;
            })->first();
            $booking = Booking::where('id', $attendee->booking_id)->first();
            EventReminderJob::dispatch($attendee->email, $event, $booking);
        }
    }
}
