<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Event;
use App\Models\Organiser;
use App\Models\Venue;
use Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function activate(Request $request)
    {
        $user = Organiser::find($request->get('account'));

        return view('user.registration', compact('user'));
    }

    public function dashboard()
    {
        $events = Event::where('user_id', Auth::id())->orderBy('start_date', 'asc')->withCount('attendee')->with('attendee', 'venue', 'user.organiser')->get();

        return view('user.dashboard', compact('events'));
    }


}
