<?php

namespace App\Exports;

use App\Models\Event;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class EventExport implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $events;
    public function __construct($events)
    {

        $this->events = $events;
    }

    public function collection()
    {

        return $this->events;
    }

    public function map($event): array
    {
        $venue = 'Online Event';
        $time = Carbon::parse($event->start_time)->format('H:i');

        if($event->end_time) {
            $time = $time.' - '.Carbon::parse($event->end_time)->format('H:i');
        }

        if($event->type != 'online') {
            $venue = $event->venue->name.', '.$event->venue->town.', '.$event->venue->eircode;
        }

        return [
            $event->name,
            $event->user->organiser->name,
            $event->start_date,
            $time,
            $venue,
            json_decode($event->target),
            $event->type,
            $event->status,
        ];
    }

    public function title(): string
    {
        return 'Events list';
    }

    public function headings(): array
    {
        return [
            'Name',
            'Organiser',
            'Date',
            'Time',
            'Venue',
            'Target',
            'Type',
            'Status',
        ];
    }
}
