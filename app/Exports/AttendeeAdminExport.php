<?php

namespace App\Exports;

use App\Models\Attendee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class AttendeeAdminExport implements FromQuery, WithHeadings, WithTitle, ShouldAutoSize, WithMapping
{
    private $attendees;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($attendees)
    {

        $this->attendees = $attendees;
    }

    public function query()
    {
        return Attendee::query()
            ->whereIn('id', $this->attendees)
            ->select('name', 'email', 'phone', 'event_id', 'created_at', 'waiting_status', 'opt_in')
            ->orderBy('event_id', 'asc')
            ->orderBy('name', 'asc');
    }

    public function title(): string
    {
        return 'Attendee list';
    }

    public function map($attendee): array
    {
        if($attendee->waiting_status) {
            $status = 'Waiting list';
        } else {
            $status = 'Attendee';
        }

        return [
            $attendee->name,
            $attendee->email,
            $attendee->phone,
            $attendee->event->name,
            $attendee->created_at->format('Y-m-d'),
            $attendee->waiting_status ? 'Waiting list' : 'Attendee',
            $attendee->opt_in ? 'Yes' : 'No',
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Event',
            'Registered on',
            'Status',
            'Contact Me'
        ];
    }
}
