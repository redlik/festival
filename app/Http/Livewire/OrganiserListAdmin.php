<?php

namespace App\Http\Livewire;

use App\Models\Organiser;
use Livewire\Component;

class OrganiserListAdmin extends Component
{
    public $organisers;

    public $search;

    public $year;

    public $status;

    public function mount()
    {
       $this->organisers = Organiser::all();
    }

    public function clear()
    {
        $this->search = '';
    }

    public function render()
    {
        $this->organisers = Organiser::when($this->search != '', function($q) {
            $q->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('org', 'LIKE', '%' . $this->search . '%');
        })->when($this->year != '', function($y) {
            $y->whereYear('created_at', $this->year);
        })->when($this->status != '', function($s) {
            $s->whereStatus($this->status);
        })
            ->get();
        return view('livewire.organiser-list-admin');
    }
}
