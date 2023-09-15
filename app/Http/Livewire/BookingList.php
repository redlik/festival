<?php

namespace App\Http\Livewire;

use App\Models\Attendee;
use Livewire\Component;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class BookingList extends Component
{
    public $bookings;

    public $events;

    public $waiting_only = false;

    public $uniques;

    public $filter = '';

    public $dropdown;

    public function mount()
    {
    }
    public function render()
    {
        $this->bookings = Attendee::where('user_id',Auth::user()->id)
            ->when($this->filter != '', function($q){
                return $q->where('event_id', $this->filter);
            })
            ->when($this->waiting_only, function ($w) {
                return $w->where('waiting_status', 1);
            })
            ->orderBy('event_id', 'asc')
            ->with('event')->get();
        $this->dropdown = Attendee::where('user_id',Auth::user()->id)->get();
        $this->uniques = array_unique($this->dropdown->pluck('event_id')->toArray());
        $this->events = Event::whereIn('id', $this->uniques)->orderBy('name', 'asc')->get();

        return view('livewire.booking-list');
    }
}
