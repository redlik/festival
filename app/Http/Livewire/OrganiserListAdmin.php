<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Organiser;
use Livewire\Component;

class OrganiserListAdmin extends Component
{
    public $organisers;

    public $search;

    public $year;

    public $status;

    public $zero_count = false;

    public $years = array();
    public function mount()
    {
        $this->organisers = Organiser::all();
        for ($i = now()->year; $i >= 2022; $i--) {
            array_push($this->years, $i);
            ray('Year ' . $i);
        }
        $this->year = now()->year;
    }

    public function clear()
    {
        $this->search = '';
    }

    public function render()
    {



        $this->organisers = Organiser::when($this->search != '', function ($q) {
            $q->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('org', 'LIKE', '%' . $this->search . '%');
        })->when($this->year != '', function ($y) {
            $y->whereYear('created_at', $this->year);
        })->when($this->status != '', function ($s) {
            $s->whereStatus($this->status);
        })
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->withCount('events')
            ->when($this->zero_count, function ($z) {
                $z->has('events', '=', 0);
            })
            ->get();

        return view('livewire.organiser-list-admin');
    }
}
