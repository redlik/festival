<?php

namespace App\Livewire;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class AdminAttendees extends Component
{
    use WithPagination;

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
        $attendees = Attendee::with('event')
            ->when($this->search != '', function ($s) {
                $s->where('name', 'LIKE', '%' . $this->search . '%');
                $this->resetPage();
            })
            ->when($this->event, function($e){
                $e->whereEventId($this->event);
            })
            ->paginate(20);

        return view('livewire.admin-attendees', compact('attendees'));
    }
}
