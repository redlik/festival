<?php

namespace App\Livewire;

use App\Exports\EventExport;
use App\Helpers\EventDates;
use App\Models\Event;
use App\Models\Organiser;
use DB;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class AdminEvents extends Component
{
    use WithPagination;

    public $events;

    public $events_dates;

    public $pending;

    public $date = '';

    public $selectedEvents = [];
    public $searchEvent = '';

    public $status = '';
    public $selectedStatus;

    public $organisers;

    public $organiser;

    public $event;

    protected $queryString = [
        'searchEvent' => ['except' => ''],
        'date' => ['except' => ''],
        'status' => ['except' => ''],
        'organiser' => ['except' => ''],
    ];

    public $years = array();

    public function mount(Request $request)
    {
        $this->pending = '';
        $this->organisers = Organiser::has('events')->get();
        for ($i = now()->year; $i >= 2022; $i--) {
            array_push($this->years, $i);
        }
        if(!$request->filled('date')) {
            $this->date = now()->year;
        }

        $this->events_dates = EventDates::getEventsDates();

    }

    public function clear()
    {
        $this->searchEvent = '';
    }

    public function render()
    {
        $this->getEvents();

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

    public function bulkDelete()
    {
        $events = Event::whereIn('id', $this->selectedEvents)->get();
        foreach ($events as $event) {
            $event->delete();
        }
    }

    public function changeStatus()
    {
        $eventsForChange = Event::whereIn('id', $this->selectedEvents)->get();
        foreach ($eventsForChange as $event) {
            $event->update(['status' => $this->selectedStatus]);
        }

        return redirect(request()->header('Referer'));
    }

    /**
     * @return void
     */
    public function getEvents(): void
    {
        $this->events = Event::orderBy('status', 'desc')
            ->when($this->searchEvent != '', function ($s) {
                $s->where('name', 'LIKE', '%' . $this->searchEvent . '%');
            })
            ->when($this->status != '', function ($q) {
                $q->where('status', $this->status);
            })
            ->when($this->date, function ($q) {
                $q->whereYear('start_date', $this->date);
            })
            ->withCount('booked', 'waiting')
            ->when($this->organiser, function ($o) {
                $o->where('user_id', $this->organiser);
            })
            ->with('booked', 'venue', 'user.organiser', 'waiting')
            ->orderBy(DB::raw("DATE_FORMAT(start_date,'%Y-%M-%d')"), 'DESC')
            ->get();
    }

  public function publishEvent($event)
  {
      $this->event=Event::find($event);
      $this->event->update(['status' => 'published']);
    }

  public function unpublishEvent($event)
  {
    $this->event=Event::find($event);
    $this->event->update(['status' => 'draft']);
  }
}
