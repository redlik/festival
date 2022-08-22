<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organiser;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

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
        $organiser = Organiser::where('user_id', Auth::id())->select('id')->first();

        return view('user.dashboard', compact('events', 'organiser'));
    }

    public function documentsHide()
    {
        $cookie = Cookie::make('hide-document-reminder', 'true', 1800);

        return back()->withCookie($cookie);
    }
}
