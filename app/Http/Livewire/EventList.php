<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Venue;
use Livewire\Component;

class EventList extends Component
{
    public $towns, $events, $target;
    public $selected_town = '';
    public $group = [];

    public function mount()
    {
        $this->towns = Venue::has('event')->select('id', 'town')->orderBy('town', 'asc')->get();
        $this->events = $events = Event::with('venue')->approved()->get();
        $this->target = [
            'teens' => "Teens",
            'young-adults' => "Young adults",
            'older-adults' => "Older adults",
            'family' => "Family",
            'workplace' => "Workplace",
        ];
    }

    public function render()
    {
        $this->events = Event::when($this->selected_town != '', function ($query) {
            $query->where('venue_id', $this->selected_town);
        })
            ->when($this->group != '', function ($query) {
                $query->whereJsonContains('target', $this->group);
            })
            ->approved()
            ->with('venue')
            ->get();

        return view('livewire.event-list');
    }
}
