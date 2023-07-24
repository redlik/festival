<?php

namespace App\Http\Livewire;

use App\Models\Attendee;
use Livewire\Component;

class BookingPanel extends Component
{
    public $event;

    public $tickets = 1;

    public $people = 1;

    public $optin = false;

    public $waiting = false;

    public $places_left;

    public $names = [];

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
            $attendee = Attendee::create([
                'name' => $this->names['name-'.$n],
                'email' => $this->names['email-'.$n],
                'phone' => $this->names['phone-'.$n],
                'opt_in' => $this->optin,
                'event_id' => $this->event->id,
                'waiting_status' => false,
            ]);
        }

        return view('event.show');
    }
    public function render()
    {
        ray($this->names);
        ray($this->people);
        return view('livewire.booking-panel');
    }
}
