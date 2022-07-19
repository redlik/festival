<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
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

        return view('pages.home', compact('events', 'towns', 'target'));
    }

    public function adminDashboard()
    {
        $events = Event::orderBy('start_date', 'asc')->withCount('attendee')->with('attendee', 'venue', 'user.organiser')->get();
        $attendees = Attendee::with('event')->get();
        $venues = Venue::withCount('event')->get();

        $organisers_count = Organiser::all()->count();

        return view('admin.dashboard', compact('events', 'venues', 'attendees', 'organisers_count'));
    }

    public function events()
    {
        return view('pages.events');
    }
}
