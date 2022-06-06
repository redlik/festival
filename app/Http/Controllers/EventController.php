<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Venue;
use Auth;
use Illuminate\Http\Request;

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
        $venues = Venue::where('user_id', Auth::id())->orderBy('name', 'asc')->get();

        return view('event.create', compact('venues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(! $request->input('attendees')) {
            $attendees = 0;
        } else {
            $attendees = $request->input('attendees');
        }

        $event = Event::create([
            'name' => $request->input('name'),
            'start_date' => $request->input('start_date'),
            'start_time' => $request->input('start_time'),
            'end_date' => $request->input('start_date'),
            'end_time' => $request->input('end_time'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'target' => json_encode($request->input('target')),
            'categories' => json_encode($request->input('categories')),
            'limited' => $request->input('limited'),
            'attendees' => $attendees,
            'venue_id' => $request->input('venue'),
            'user_id' => Auth::id(),
            'covid' => $request->input('covid'),
        ]);

        return redirect()->route('dashboard');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
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
