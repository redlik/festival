<?php

namespace App\Http\Controllers;

use App\Jobs\AttendeeRegistration;
use App\Models\Attendee;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Organiser;
use App\Models\Venue;

class PagesController extends Controller
{
    public function home()
    {
        $events = Event::with('venue')->orderBy('start_date', 'asc')->get();
        $towns = Venue::has('event')->select('id', 'town')->get();
        $target = [
            'teens' => 'Teens',
            'young' => 'Young adults',
            'older' => 'Older adults',
            'family' => 'Family',
            'workplace' => 'Workplace',
        ];

        return view('pages.home-after', compact('events', 'towns', 'target'));
    }

    public function adminDashboard()
    {
        $events_count = Event::count();
        $new_events_count = Event::where('start_date','LIKE', '%'.now()->year.'%' )->count();

        $venues = Venue::withCount('event')->get();
        $attendees_count = Attendee::count();

        $organisers_count = Organiser::all()->count();
        $new_organisers = Organiser::where('created_at','LIKE', '%'.now()->year.'%' )->count();

        return view('admin.dashboard', compact('events_count', 'new_events_count', 'venues', 'organisers_count', 'new_organisers', 'attendees_count'));
    }

    public function events()
    {
        return view('pages.events');
    }

    public function booking_cancellation($uuid)
    {
        $booking = Booking::where('long_id', $uuid)->with('event', 'event.venue')->first();
        return view('pages.booking-cancellation', compact('booking'));
    }
}
