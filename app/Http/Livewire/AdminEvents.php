<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class AdminEvents extends Component
{
    public $events;

    public $pending;

    public function mount()
    {
        $this->pending = '';
    }

    public function render()
    {
        $this->events = $events = Event::orderBy('status', 'asc')->orderBy('start_date', 'asc')
            ->when($this->pending == 'pending', function($q) {
                $q->where('status', 'pending');
            })
            ->withCount('attendee')
            ->with('attendee', 'venue', 'user.organiser')
            ->get();

        return view('livewire.admin-events');
    }
}
