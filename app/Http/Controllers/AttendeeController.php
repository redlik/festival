<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\User;
use App\Notifications\NewAttendeeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\Honeypot\ProtectAgainstSpam;

class AttendeeController extends Controller
{
    public function __construct()
    {
        $this->middleware(ProtectAgainstSpam::class)->only('store');
    }

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:attendees,email,NULL,id,event_id,'.$request->input('event'),
        ], [
            'email.unique' => "Looks like you've already registered for this event",
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $attendee = Attendee::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'opt_in' => $request->input('opt_in'),
            'event_id' => $request->input('event'),
        ]);

        $organiser = User::where('id', $attendee->event->user_id)->first();
        $organiser->notify(new NewAttendeeNotification($attendee));

        Mail::send('email.event-registration', ['attendee' => $attendee], function ($m) use ($attendee) {
            $m->from('admin@kerrymentalhealthandwellbeingfest.com', 'Kerry Fest Admins');

            $m->to($attendee->email, $attendee->name)
                ->subject('Event registration');
        });

        return redirect()->back()->with('registered', 'Thank you for registering to the event');
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Attendee $attendee)
    {
        $message = 'Attendee '.$attendee->name.' has been unregistered from the event';
        $attendee->delete();

        return redirect()->to(url()->previous().'#attendees')->with('unregister', $message);
    }
}
