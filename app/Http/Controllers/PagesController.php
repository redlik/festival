<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Event;
use App\Models\Organiser;
use App\Models\Venue;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $events = Event::with('venue')->orderBy('start_date', 'asc')->get();

        return view('pages.home', compact('events'));
    }

    public function adminDashboard()
    {
        $events = Event::orderBy('start_date', 'asc')->withCount('attendee')->with('attendee', 'venue', 'user.organiser')->get();
        $attendees = Attendee::with('event')->get();
        $venues = Venue::all();

        $organisers_count = Organiser::all()->count();

        return view('admin.dashboard', compact('events',  'venues', 'attendees', 'organisers_count'));
    }
}
