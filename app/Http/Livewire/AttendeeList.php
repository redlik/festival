<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Auth;
use Livewire\Component;

class AttendeeList extends Component
{
    public $attendees;

    public $events_with_attendees;

    public $selected_event;

    public function mount()
    {
        $selected_event = '';
        $this->attendees = Auth::user()->attendees()->with('event')
            ->orderBy('event_id', 'asc')
            ->orderBy('waiting_status', 'asc')
            ->get();
        $this->events_with_attendees = Event::where('user_id', Auth::id())->has('attendee')->get();
    }

    public function render()
    {
        $this->attendees = Auth::user()->attendees()
            ->when($this->selected_event != '', function ($query) {
                $query->where('event_id', $this->selected_event);
            })
            ->with('event')
            ->orderBy('created_at', 'desc')
            ->orderBy('waiting_status', 'asc')
            ->get();

        return view('livewire.attendee-list');
    }
}
