<?php

namespace App\Observers;

use App\Models\Attendee;
use Illuminate\Support\Facades\Mail;

class AttendeeObserver
{
    public function deleted(Attendee $attendee): void
    {
        // Only act when a confirmed (non-waiting) attendee is removed from a limited event
        if ($attendee->waiting_status) {
            return;
        }

        $event = $attendee->event;

        if (!$event || !$event->limited) {
            return;
        }

        $next = Attendee::where('event_id', $event->id)
            ->where('waiting_status', true)
            ->orderBy('created_at', 'asc')
            ->first();

        if (!$next) {
            return;
        }

        $next->update(['waiting_status' => false]);

        Mail::send('email.waiting-registration', ['attendee' => $next], function ($m) use ($next) {
            $m->from('admin@kerrymentalhealthandwellbeingfest.com', 'Kerry Fest Admins');
            $m->to($next->email, $next->name)->subject('Event registration');
        });
    }
}
