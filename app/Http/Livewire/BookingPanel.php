<?php

namespace App\Http\Livewire;

use App\Jobs\BookingEmailToAttendee;
use App\Jobs\BookingEmailToOrganiser;
use App\Models\Attendee;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BookingPanel extends Component
{
    public $event;

    public Attendee $attendee;

    public $tickets = 1;

    public $people = 1;

    public $optin = false;

    public $waiting_status = false;

    public $full = false;

    public $disabled_minus = true;
    public $disabled_plus = false;

    public $places_left;

    public $names = [];

    public $message = 'Thank you for registering. See you at the event!';

    public function mount()
    {
        if($this->event->limited) {
            $this->places_left = $this->event->attendees - $this->event->booked_count;
        } else {
            $this->places_left = 6;
        }

        if($this->places_left == 1) {
            $this->disabled_plus = true;
            $this->disabled_minus = true;
        }
        if($this->places_left <= 0 && $this->event->limited) {
            $this->full = true;
        }
    }

    public function minus()
    {
        if($this->tickets == 1 && $this->places_left == 1) {
            $this->disabled_plus = true;
            $this->disabled_minus = true;
            return;
        }

        if ($this->tickets == $this->places_left && $this->places_left != 2) {
            $this->disabled_plus = true;
        }

        if($this->tickets <= 2) {
            $this->disabled_minus = true;
            $this->disabled_plus = false;
            $this->tickets = 1;
        }
        else {
            $this->tickets--;
            $this->disabled_plus = false;
            $this->disabled_minus = false;
            ray('-three');


        }
    }

    public function plus()
    {
        if ($this->tickets === $this->places_left) {
            if($this->places_left > 1) {
                $this->disabled_minus = false;
            }
            $this->disabled_plus = true;
            return;
        }

        if ($this->tickets >= ($this->places_left - 1)) {
            $this->disabled_plus = true;
            $this->disabled_minus = false;
            $this->tickets = $this->places_left;
        } elseif ($this->tickets >= 5 ) {
            $this->disabled_plus = true;
            $this->tickets = 6;


        }
        else {
            $this->tickets++;
            $this->disabled_minus = false;
        }

        if($this->tickets >= 6) {
            $this->disabled_plus = true;
            $this->tickets = 6;

        }
    }

    public function register()
    {
        $this->people = $this->tickets;

        if($this->full) {
            $this->waiting_status = true;
            $this->message = "You've been added to the waiting list. If one of the attendees cancels we will get in touch.";
        }

        for($n = 1; $n <= $this->people; $n++) {
            $this->attendee = Attendee::create([
                'name' => $this->names['name-'.$n],
                'email' => $this->names['email-'.$n] ?? Auth::user()->email,
                'phone' => $this->names['phone-'.$n] ?? '',
                'opt_in' => $this->optin,
                'event_id' => $this->event->id,
                'user_id' => Auth::user()->id,
                'waiting_status' => $this->waiting_status,
            ]);
        }

        BookingEmailToOrganiser::dispatch($this->event, $this->people, $this->waiting_status);
        BookingEmailToAttendee::dispatch(Auth::user(), $this->event, $this->names, $this->waiting_status);

        if($this->waiting_status != true){
            $this->places_left = $this->places_left - $this->people;
        }

        $this->people = 1;
        $this->tickets = 1;
        $this->names = [];

        if($this->places_left == 0) {
            $this->full = true;
        }

        if($this->places_left <= 1) {
            $this->disabled_minus = true;
            $this->disabled_plus = true;
        } else {
            $this->disabled_minus = true;
        }

        session()->flash('registered', $this->message) ;

        return redirect(request()->header('Referer'));
    }
    public function render()
    {
        return view('livewire.booking-panel');
    }
}
