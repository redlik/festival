<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class AdminEvents extends Component
{
    public $events;

    public $pending;

    public $date;

    public function mount()
    {
        $this->pending = '';
        $this->date = '';
    }

    public function render()
    {
        ray($this->date);
        $this->events = Event::orderBy('status', 'desc')
            ->when($this->pending == 'pending', function($q) {
                $q->where('status', 'pending');
            })
            ->when($this->date, function($q){
                $q->where('start_date','>=', $this->date.'-01-01')
                    ->where('start_date','<=', $this->date.'-12-31');
            })
            ->withCount('attendee')
            ->with('attendee', 'venue', 'user.organiser')
            ->orderBy(\DB::raw("DATE_FORMAT(start_date,'%d-%M-%Y')"), 'DESC')
            ->get();

        return view('livewire.admin-events');
    }
}
