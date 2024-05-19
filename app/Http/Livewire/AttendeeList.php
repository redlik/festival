<?php

namespace App\Http\Livewire;

use App\Exports\AttendeeExport;
use App\Models\Event;
use Auth;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class AttendeeList extends Component
{
    public $attendees;

    public $events_with_attendees;

    public $selected_event;

    public $events_to_export = [];

    public function mount()
    {
        $selected_event = '';
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

    public function exportSelected()
    {
        $this->events_to_export[] = $this->selected_event;
        $name = Str::slug(Event::find($this->selected_event)->name);
        return Excel::download(new AttendeeExport($this->events_to_export), $name.'-attendee-list.xlsx');
    }

    public function exportAll()
    {
        $events = Event::where('user_id', Auth::id())
            ->select('id')
            ->get()
            ->toArray();

        return Excel::download(new AttendeeExport($events), 'all-attendee-list.xlsx');
    }
}
