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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'venue_id' => 'required_if:type,indoor,outdoor',
            'start_time' => 'required',
            'end_time' => 'nullable|after:start_time',
        ], [
            'end_time.after' => 'The end time should be set after the start time',
        ]);

        if ($validator->fails()) {
            return redirect('/event/create')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->input('target')) {
            $target = json_encode($request->input('target'));
        } else {
            $target = '[]';
        }

        if (! $request->input('attendees')) {
            $attendees = 0;
        } else {
            $attendees = $request->input('attendees');
        }

        $slug = rand(1001, 9999).'-'.Str::of($request->input('name'))->slug('-');

        $event = Event::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'start_date' => $request->input('start_date'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'target' => $target,
            'limited' => $request->input('limited'),
            'attendees' => $attendees,
            'venue_id' => $request->input('venue_id'),
            'user_id' => Auth::id(),
            'covid' => $request->input('covid'),
            'leader_name' => $request->input('leader_name'),
            'leader_phone' => $request->input('leader_phone'),
            'leader_email' => $request->input('leader_email'),
            'status' => 'pending',
            'is_private' => $request->input('is_private'),
        ]);

        if ($request->hasFile('file-upload')) {
            $event->addMediaFromRequest('file-upload')
                ->toMediaCollection('cover');
        }

        $admin = User::where('email', 'admin@kerrymentalhealthandwellbeingfest.com')->first();

        $admin->notify(new EventSubmitted($event));

        return redirect()->route('dashboard')->with('event_submitted', 'Event submitted');
    }

    public function saveDraft(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'venue_id' => 'required_if:type,indoor,outdoor',
            'start_time' => 'required',
            'end_time' => 'nullable|after:start_time',
        ], [
            'end_time.after' => 'The end time should be set after the start time',
            'venue_id.required_if' => "Don't forget to select a venue",
        ]);

        if ($validator->fails()) {
            return redirect('/event/create')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->input('target')) {
            $target = json_encode($request->input('target'));
        } else {
            $target = '[]';
        }


        if (! $request->input('attendees')) {
            $attendees = 0;
        } else {
            $attendees = $request->input('attendees');
        }

        $slug = rand(1001, 9999).'-'.Str::of($request->input('name'))->slug('-');

        $event = Event::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'start_date' => $request->input('start_date'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'target' => $target,
            'limited' => $request->input('limited'),
            'attendees' => $attendees,
            'venue_id' => $request->input('venue_id'),
            'user_id' => Auth::id(),
            'covid' => $request->input('covid'),
            'leader_name' => $request->input('leader_name'),
            'leader_phone' => $request->input('leader_phone'),
            'leader_email' => $request->input('leader_email'),
            'status' => 'draft',
            'is_private' => $request->input('is_private'),
        ]);

        if ($request->hasFile('file-upload')) {
            $event->addMediaFromRequest('file-upload')
                ->toMediaCollection('cover');
        }

        return redirect()->route('dashboard')->with('event_saved', 'Event saved');
    }

    public function saveAndSubmit(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'venue_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'nullable|after:start_time',
        ], [
            'end_time.after' => 'The end time should be set after the start time',
            'venue_id.required' => "Don't forget to select a venue",
        ]);

        if ($validator->fails()) {
            return redirect('/event/create')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->input('target')) {
            $target = json_encode($request->input('target'));
        } else {
            $target = '[]';
        }

        if (! $request->input('attendees')) {
            $attendees = 0;
        } else {
            $attendees = $request->input('attendees');
        }

        $slug = rand(1001, 9999).'-'.Str::of($request->input('name'))->slug('-');

        $event = Event::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'start_date' => $request->input('start_date'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'target' => $target,
            'limited' => $request->input('limited'),
            'attendees' => $attendees,
            'venue_id' => $request->input('venue_id'),
            'user_id' => Auth::id(),
            'covid' => $request->input('covid'),
            'leader_name' => $request->input('leader_name'),
            'leader_phone' => $request->input('leader_phone'),
            'leader_email' => $request->input('leader_email'),
            'status' => 'draft',
            'is_private' => $request->input('is_private'),
        ]);

        if ($request->hasFile('file-upload')) {
            $event->addMediaFromRequest('file-upload')
                ->toMediaCollection('cover');
        }

        $admin = User::where('email', 'admin@kerrymentalhealthandwellbeingfest.com')->first();
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

    public function showBySlug($slug)
    {
        $event = Event::where('slug', $slug)->withCount('attendee')->first();

        return view('event.show', compact('event'));
    }

    public function preview($slug)
    {
        $event = Event::where('slug', $slug)->first();

        return view('event.preview', compact('event'));
    }

    public function showAdmin($event_id)
    {
        $event = Event::has('document')->find($event_id);

        return view('event.show-admin', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Event $event)
    {
        if (Auth::user()->hasRole('admin')) {
            $venues = Venue::all();
            return view('admin.edit', compact('event', 'venues'));
        }

        if (Auth::id() != $event->user_id) {
            return abort(403);
        }

        return view('event.edit', compact('event'));
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

    public function cancel($id)
    {
        $event = Event::findOrFail($id);

        if (Auth::id() != $event->user_id) {
            return abort(403);
        }

        $event->update([
            'status' => 'cancelled',
        ]);
        $message = 'Event '.$event->name.' has been cancelled';

        return redirect()->back()->with('cancelled', $message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Event $event)
    {
        if (! $request->input('attendees')) {
            $attendees = 0;
        } else {
            $attendees = $request->input('attendees');
        }

        if ($request->input('target')) {
            $target = json_encode($request->input('target'));
        } else {
            $target = '[]';
        }

        if ($request->input('name') != $event->name) {
            $slug = rand(1001, 9999).'-'.Str::of($request->input('name'))->slug('-');
        } else {
            $slug = $event->slug;
        }

        $event->update([
            'name' => $request->input('name'),
            'slug' => $slug,
            'start_date' => $request->input('start_date'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'venue_id' => $request->input('venue_id'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'target' => $target,
            'limited' => $request->input('limited'),
            'attendees' => $attendees,
            'leader_name' => $request->input('leader_name'),
            'leader_phone' => $request->input('leader_phone'),
            'leader_email' => $request->input('leader_email'),
            'is_private' => $request->input('is_private'),
        ]);

        if ($request->hasFile('file-upload')) {
            $event->addMediaFromRequest('file-upload')
                ->toMediaCollection('cover');
        }

        return back()->with('saved', 'Record Successfully Updated!');
    }

    public function updateAndSubmit(Request $request, Event $event_not)
    {
        if (! $request->input('attendees')) {
            $attendees = 0;
        } else {
            $attendees = $request->input('attendees');
        }

        if ($request->input('type') == 'online') {
            $is_online = true;
        } else {
            $is_online = false;
        }

        if ($request->input('target')) {
            $target = json_encode($request->input('target'));
        } else {
            $target = '[]';
        }

        $event = Event::find($request->input('event_number'));
        $event->update([
            'name' => $request->input('name'),
            'start_date' => $request->input('start_date'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'venue_id' => $request->input('venue_id'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'target' => $target,
            'limited' => $request->input('limited'),
            'attendees' => $attendees,
            'leader_name' => $request->input('leader_name'),
            'leader_phone' => $request->input('leader_phone'),
            'leader_email' => $request->input('leader_email'),
            'status' => 'pending',
            'is_private' => $request->input('is_private'),
        ]);

        if ($request->hasFile('file-upload')) {
            $event->addMediaFromRequest('file-upload')
                ->toMediaCollection('cover');
        }

        $admin = User::where('email', 'admin@kerrymentalhealthandwellbeingfest.com')->first();
        $admin->notify(new EventSubmitted($event));

        return redirect()->route('dashboard')->with('event_submitted', 'Event submitted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Event $event)
    {
        $message = 'Event '.$event->name.' has been deleted';
        $event->delete();

        return back()->with('deleted', $message);
    }
}
