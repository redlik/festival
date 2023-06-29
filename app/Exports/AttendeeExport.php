<?php

namespace App\Exports;

use App\Models\Attendee;
use App\Models\Event;
use Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class AttendeeExport implements FromQuery, WithHeadings, WithTitle, ShouldAutoSize, WithMapping
{
    /**
    * @return \Illuminate\Database\Eloquent\Builder|\LaravelIdea\Helper\App\Models\_IH_Attendee_QB
     */

    public function query()
    {
        $events = Event::where('user_id', Auth::id())->select('id')->get()->toArray();
        return Attendee::query()->whereIn('event_id', $events)->select('name', 'email', 'phone', 'event_id', 'created_at', 'waiting_status')->orderBy('event_id', 'asc')->orderBy('name', 'asc');
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
          $status,
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone (opt)',
            'Event',
            'Registered on',
            'Status',
        ];
    }
}
