<?php

namespace App\Livewire;

use App\Exports\AttendeeAdminExport;
use App\Models\Attendee;
use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class AdminAttendees extends Component
{
    use WithPagination;

    public $searchAttendee;
    public $events;
    public $attendeeEvent;

    protected $queryString = [
        'searchAttendee' => ['except' => ''],
        'attendeeEvent' => ['except' => ''],
    ];

    public function mount()
    {
        $this->events = Event::has('attendee')->orderBy('name', 'asc')->get();
    }

    public function clear()
    {
        $this->searchAttendee = '';
    }

    public function render()
    {
        $attendees = Attendee::with('event')
            ->when($this->searchAttendee != '', function ($s) {
                $s->where('name', 'LIKE', '%' . $this->searchAttendee . '%');
                $this->resetPage();
            })
            ->when($this->attendeeEvent, function($e){
                $e->whereEventId($this->attendeeEvent);
                $this->resetPage();
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('livewire.admin-attendees', with(['attendees' => $attendees]));
    }

    public function export()
    {
        $attendees = Attendee::when($this->searchAttendee != '', function ($s) {
                $s->where('name', 'LIKE', '%' . $this->searchAttendee . '%');
                $this->resetPage();
            })
            ->when($this->attendeeEvent, function($e){
                $e->whereEventId($this->attendeeEvent);
                $this->resetPage();
            })
            ->orderBy('id')
            ->select('id')
            ->get()
            ->pluck('id');
        return Excel::download(new AttendeeAdminExport($attendees), 'all-attendee-list.xlsx');
    }
}
