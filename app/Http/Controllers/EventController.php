<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Venue;
use App\Notifications\EventSubmitted;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'venue' => 'required',
            'start_time' => 'required',
            'end_time' => 'nullable|after:start_time',
        ],[
            'end_time.after' => 'The end time should be after the start time',
        ]);

        if ($validator->fails()) {
            return redirect('/event/create')
                ->withErrors($validator)
                ->withInput();
        }

        if(! $request->input('attendees')) {
            $attendees = 0;
        } else {
            $attendees = $request->input('attendees');
        }

        $slug = rand(1001,9999)."-".Str::of($request->input('name'))->slug('-');

        $event = Event::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'start_date' => $request->input('start_date'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'target' => json_encode($request->input('target')),
            'limited' => $request->input('limited'),
            'attendees' => $attendees,
            'venue_id' => $request->input('venue'),
            'user_id' => Auth::id(),
            'covid' => $request->input('covid'),
            'leader_name' => $request->input('leader_name'),
            'leader_phone' => $request->input('leader_phone'),
            'leader_email' => $request->input('leader_email'),
            'status' => 'pending',
        ]);

        if($request->hasFile('file-upload')) {
            $event->addMediaFromRequest('file-upload')
                ->toMediaCollection('cover');;
        }

        $admin = User::where('email', 'admin@kerryfest.com')->first();

        $admin->notify(new EventSubmitted($event));

        return redirect()->route('dashboard')->with('event_submitted', 'Event submitted');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('event.show', compact('event'));
    }

    public function showAdmin($event_id)
    {
        $event = Event::find($event_id);

        return view('event.show-admin', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    public function adminApproval($event_id)
    {
        $event = Event::find($event_id)->update(['status' => 'published']);

        return redirect()->back()->with('approved', 'Event has been approved.');
    }

    public function adminUnpublish($event_id)
    {
        $event = Event::find($event_id)->update(['status' => 'pending']);

        return redirect()->back()->with('pending', 'This event has been un-published.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
