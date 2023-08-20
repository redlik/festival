<?php

namespace App\Http\Controllers;

use App\Jobs\AttendeeRegistration;
use App\Models\Attendee;
use App\Models\Event;
use App\Models\Organiser;
use App\Models\Venue;

class PagesController extends Controller
{
    public function home()
    {
        AttendeeRegistration::dispatch();
        $events = Event::with('venue')->orderBy('start_date', 'asc')->get();
        $towns = Venue::has('event')->select('id', 'town')->get();
        $target = [
            'teens' => 'Teens',
            'young' => 'Young adults',
            'older' => 'Older adults',
            'family' => 'Family',
            'workplace' => 'Workplace',
        ];

        return view('pages.home', compact('events', 'towns', 'target'));
    }

    public function adminDashboard()
    {
        $events_count = Event::count();
        $attendees = Attendee::with('event')->get();
        $venues = Venue::withCount('event')->get();

        $organisers_count = Organiser::all()->count();
        $new_organisers = Organiser::where('created_at','LIKE', '%'.now()->year.'%' )->count();

        return view('admin.dashboard', compact('events_count', 'venues', 'attendees', 'organisers_count', 'new_organisers'));
    }

    public function events()
    {
        return view('pages.events');
    }
}
