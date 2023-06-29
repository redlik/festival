<?php

namespace App\Exports;

use App\Models\Organiser;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class OrganisersExport implements FromQuery, WithHeadings, WithTitle, ShouldAutoSize, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Organiser::query()->orderBy('status', 'asc')->orderBy('name', 'asc');
    }

    public function map($organiser): array
    {
        return [
            $organiser->name,
            $organiser->org,
            $organiser->email,
            $organiser->phone,
            $organiser->created_at,
            $organiser->status,
        ];
    }

    public function title(): string
    {
        return 'Organisers list';
    }

    public function headings(): array
    {
        return [
            'Name',
            'Org',
            'Email',
            'Phone',
            'Registered on',
            'Status',
        ];
    }
}
