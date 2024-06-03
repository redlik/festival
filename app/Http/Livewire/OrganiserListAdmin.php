<?php

namespace App\Http\Livewire;

use App\Exports\OrganisersExport;
use App\Models\Organiser;
use Illuminate\Http\Request;
use Livewire\Component;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;

class OrganiserListAdmin extends Component
{
    public $selectedOrganisers = [];

    public $organisers;

    public $search;

    public $year;

    public $status;

    public $delete;

    public $organisersToExport = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'year' => ['except' => ''],
        'status',
    ];

    public $zero_count = false;

    public $years = array();
    public function mount(Request $request)
    {
        $this->organisers = Organiser::all();
        for ($i = now()->year; $i >= 2022; $i--) {
            $this->years[] = $i;
        }
        if(!$request->filled('year')) {
            $this->year = now()->year;
        }

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

    public function bulkDelete()
    {
        $organisers = Organiser::whereIn('id', $this->selectedOrganisers)->get();
        foreach ($organisers as $organiser) {
            $organiser->delete();
        }
    }

    public function export()
    {
        $this->organisersToExport = Organiser::whereIn('id', $this->organisers->select('id'))
            ->select('id')
            ->get();
        return Excel::download(new OrganisersExport($this->organisersToExport), 'organisers-list.xlsx');
    }
}
