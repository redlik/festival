<?php

namespace App\Http\Livewire;

use App\Exports\EventExport;
use App\Models\Event;
use App\Models\Organiser;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class AdminEvents extends Component
{
    use WithPagination;

    public $events;

    public $pending;

    public $date = '';

    public $search = '';

    public $status = '';

    public $organisers;

    public $organiser;

    public $years = array();

    public function mount()
    {
        $this->pending = '';
        $this->organisers = Organiser::has('events')->get();
        for ($i = now()->year; $i >= 2022; $i--) {
            array_push($this->years, $i);
        }
        $this->date = now()->year;
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
                $q->whereYear('start_date',$this->date);
            })
            ->withCount('booked', 'waiting')
            ->when($this->organiser, function($o) {
                $o->where('user_id', $this->organiser);
            })
            ->with('booked', 'venue', 'user.organiser', 'waiting')
            ->orderBy(\DB::raw("DATE_FORMAT(start_date,'%d-%M-%Y')"), 'DESC')
            ->get();

        return view('livewire.admin-events');
    }

    public function export()
    {
        return Excel::download(new EventExport($this->events), 'events-export.xlsx');
    }
    public function exportAll()
    {
        $all_events = Event::all();

        return Excel::download(new EventExport($all_events), 'all-events-export.xlsx');
    }
}
