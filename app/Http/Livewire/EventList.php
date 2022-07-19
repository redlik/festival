<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Venue;
use Livewire\Component;

class EventList extends Component
{
    public $towns;

    public $events;

    public $target;

    public $selected_town = '';

    public $group = [];

    public $unique_towns = [];

    public function mount()
    {
        $this->events = $events = Event::with('venue')->approved()->get();
        $this->target = [
            'everyone' => 'Everyone',
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

        $this->events = Event::when($this->selected_town != '', function ($query) {
            $query->whereHas('Venue', function ($q) {
                $q->where('town', $this->selected_town);
            });
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
