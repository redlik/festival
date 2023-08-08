<?php

namespace App\Http\Livewire;

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

    public $waiting = false;

    public $places_left;

    public $names = [];

    public $message = '';

    public function mount()
    {
        $this->places_left = $this->event->attendees - $this->event->attendee_count;
    }

    public function tickets(): void
    {
        $this->people = $this->tickets;
    }

    public function register()
    {
        for($n = 1; $n <= $this->people; $n++) {
            $this->attendee = Attendee::create([
                'name' => $this->names['name-'.$n],
                'email' => $this->names['email-'.$n] ?? Auth::user()->email,
                'phone' => $this->names['phone-'.$n] ?? '',
                'opt_in' => $this->optin,
                'event_id' => $this->event->id,
                'user_id' => Auth::user()->id,
                'waiting_status' => false,
            ]);
        }

        $this->places_left = $this->places_left - $this->people;

        $this->people = 1;
        $this->tickets = 1;
        $this->names = [];

        session()->flash('registered', "Thank you for registering. See you at the event!") ;
    }
    public function render()
    {
        ray($this->names);
        ray($this->people);
        return view('livewire.booking-panel');
    }
}