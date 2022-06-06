<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use Illuminate\Http\Request;

class AttendeeController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attendee = Attendee::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'opt_in' => $request->input('opt_in'),
            'event_id' => $request->input('event'),
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendee  $attendee
     * @return \Illuminate\Http\Response
     */
    public function show(Attendee $attendee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendee  $attendee
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendee $attendee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendee  $attendee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendee $attendee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendee  $attendee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendee $attendee)
    {
        //
    }
}
