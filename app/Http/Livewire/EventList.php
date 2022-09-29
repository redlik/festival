<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Venue;
use Livewire\Component;

class EventList extends Component
{
    public $towns;

    public $days = [];

    public $day = '';

    public $events;

    public $type = '';

    public $inperson = ['indoor', 'outdoor'];

    public $target;

    public $selected_town = '';

    public $group = [];

    public $unique_towns = [];

    public function mount()
    {
        $this->events = $events = Event::with('venue')->approved()->get();
        $this->target = [
            'everyone' => 'Everyone',
            'children' => 'Children',
            'teens' => 'Teens',
            'young-adults' => 'Young adults',
            'older-adults' => 'Older adults',
            'family' => 'Family',
            'workplace' => 'Workplace',
        ];
    }

    public function render()
    {

        $this->towns = Venue::whereHas('event', function ($q) {
            $q->where('status', 'published');
        })->select('town')->orderBy('town', 'asc')->get();
        $this->unique_towns = $this->towns->unique('town');

        $this->days = Event::approved()
            ->select('start_date')
            ->get()
            ->unique('start_date');

        $this->events = Event::when($this->selected_town != '', function ($query) {
            $query->whereHas('Venue', function ($q) {
                $q->where('town', $this->selected_town);
            });
        })
            ->when($this->day != '', function($q) {
                $q->where('start_date', $this->day);
              })
            ->when($this->type == 'inperson', function($q) {
                $q->whereIn('type', $this->inperson);
            })
            ->when($this->type == 'online', function($q) {
                $q->where('type', 'online');
            })
            ->when($this->group, function ($query) {
                $query->whereJsonContains('target', $this->group);
            })
            ->approved()
            ->with('venue')
            ->get();

        return view('livewire.event-list');
    }
}
