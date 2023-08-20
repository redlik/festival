<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class AdminEvents extends Component
{
    public $events;

    public $pending;

    public $date;

    public $search = '';

    public $status = '';

    public $organisers;

    public function mount()
    {
        $this->pending = '';
        $this->date = '';
    }

    public function clear()
    {
        $this->search = '';
    }

    public function render()
    {
        $this->events = Event::orderBy('status', 'desc')
            ->when($this->search != '', function ($s) {
                $s->where('name', 'LIKE', '%' . $this->search . '%');
            })
            ->when($this->status != '', function($q) {
                $q->where('status', $this->status);
            })
            ->when($this->date, function($q){
                $q->where('start_date','>=', $this->date.'-01-01')
                    ->where('start_date','<=', $this->date.'-12-31');
            })
            ->withCount('attendee')
            ->with('attendee', 'venue', 'user.organiser')
            ->orderBy(\DB::raw("DATE_FORMAT(start_date,'%d-%M-%Y')"), 'DESC')
            ->get();

//            ray($this->events->user()->organiser());

        return view('livewire.admin-events');
    }
}
