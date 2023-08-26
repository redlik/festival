<?php

namespace App\Http\Livewire;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Support\Collection;
use Livewire\Component;

class AdminAttendees extends Component
{
    public $attendees;
    public $search;
    public $events;
    public $event;

    public function mount()
    {
        $this->events = Event::has('attendee')->get();
    }

    public function clear()
    {
        $this->search = '';
    }

    public function render()
    {
        $this->attendees = Attendee::with('event')
            ->when($this->search != '', function ($s) {
                $s->where('name', 'LIKE', '%' . $this->search . '%');
            })
            ->when($this->event, function($e){
                $e->whereEventId($this->event);
            })
            ->get();

        return view('livewire.admin-attendees');
    }
}
