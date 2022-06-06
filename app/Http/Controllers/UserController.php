<?php

namespace App\Http\Controllers;

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
        $venues = Venue::where('user_id', Auth::id())->withCount('event')->get();
        $events = Event::where('user_id', Auth::id())->orderBy('name', 'asc')->withCount('attendee')->get();

        return view('user.dashboard', compact('events', 'venues'));
    }


}
