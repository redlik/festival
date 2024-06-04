<?php

namespace App\Livewire;

use App\Models\Event;
use Auth;
use Livewire\Component;

class OrganiserEventList extends Component
{
    public $events;

    public $date;

    public $search = '';

    public $status = '';


    public function clear()
    {
        $this->search = '';
    }

    public function render()
    {
      $this->events = Event::where('user_id', Auth::id())
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
            ->with('venue')
            ->orderBy(\DB::raw("DATE_FORMAT(start_date,'%d-%M-%Y')"), 'DESC')
            ->get();

        return view('livewire.organiser-event-list');
    }
}
