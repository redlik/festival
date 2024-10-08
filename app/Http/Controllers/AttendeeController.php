<?php

namespace App\Http\Controllers;

use App\Exports\AttendeeExport;
use App\Jobs\MessageEmailToAttendees;
use App\Models\Attendee;
use App\Models\Event;
use App\Models\User;
use App\Notifications\NewAttendeeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Honeypot\ProtectAgainstSpam;
use Auth;

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
        $waiting = 0;
        $message = 'Thank you for registering to the event';

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'name' => 'required',
        ]);

        if($request->input('waiting')) {
            $waiting = 1;
            $message = "You've been added to the waiting list. If one of the attendees cancels we will get in touch.";
        }

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
            'waiting_status' => $waiting,
        ]);



        $organiser = User::where('id', $attendee->event->user_id)->first();
        $organiser->notify(new NewAttendeeNotification($attendee));

        if($waiting) {
            Mail::send('email.waiting-list', ['attendee' => $attendee], function ($m) use ($attendee) {
                $m->from('admin@kerrymentalhealthandwellbeingfest.com', 'Kerry Fest Admins');

                $m->to($attendee->email, $attendee->name)
                    ->subject('Event waiting list registration');
            });
        } else {
            Mail::send('email.event-registration', ['attendee' => $attendee], function ($m) use ($attendee) {
                $m->from('admin@kerrymentalhealthandwellbeingfest.com', 'Kerry Fest Admins');

                $m->to($attendee->email, $attendee->name)
                    ->subject('Event registration');
            });
        }


        return redirect()->back()->with('registered', $message);
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

    public function registerWaiting(Attendee $attendee)
    {
        $attendee->update([
            'waiting_status' => false,
        ]);

        Mail::send('email.waiting-registration', ['attendee' => $attendee], function ($m) use ($attendee) {
            $m->from('admin@kerrymentalhealthandwellbeingfest.com', 'Kerry Fest Admins');

            $m->to($attendee->email, $attendee->name)
                ->subject('Event registration');
        });

        return redirect()->back()->withFragment('attendees');


    }

    public function export(Request $request)
    {
        return Excel::download(new AttendeeExport(), 'attendee-list.xlsx');
    }

    public function bookings()
    {
        return view('attendee.bookings');
    }

    public function messageToAttendees(Request $request)
    {
        $attendees = Attendee::where('event_id', $request->input('event'))->select('email')->distinct()->get()->toArray();
        $event = Event::find($request->input('event'));
        $message['subject'] = $request->input('subject');
        $message['message'] = $request->input('message');
        $message['event'] = $request->input('eventName');
        $message['date'] = $event->start_date.' at '.\Carbon\Carbon::parse($event->start_time)->format('H:i');
        foreach($attendees as $attendee) {
            ray($attendee);
            if ($attendee['email'] != '') {
                MessageEmailToAttendees::dispatch($attendee, $message);
            } else {
                Log::info('Empty email field');
            }
        }
        return redirect()->back();
    }

    public function deleteByYear($year)
    {
        $attendees = Attendee::whereYear('created_at', $year)->get();
        if ($attendees->count() < 1) {
            echo('There are no attendees left to delete');
            die();
        } else {
            foreach ($attendees as $attendee) {
                $attendee->delete();
            }
        }
        return view('admin.attendees-delete-by-year', compact('attendees', 'year'));
    }
}
