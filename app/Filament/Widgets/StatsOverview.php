<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\AttendeeResource;
use App\Filament\Resources\EventResource;
use App\Filament\Resources\OrganiserResource;
use App\Models\Attendee;
use App\Models\Event;
use App\Models\Organiser;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected int | string | array $columnSpan = [
        'md' => 2,
        'xl' => 3,
    ];

    protected function getCards(): array
    {
        return [
            Card::make('Events', Event::all()->count())
            ->descriptionIcon('heroicon-o-collection')
            ->url(EventResource::getUrl('index')),
            Card::make('Attendees', Attendee::all()->count())
                ->descriptionIcon('heroicon-o-user-circle')
            ->url(AttendeeResource::getUrl('index')),
            Card::make('Organisers', Organiser::all()->count())
            ->url(OrganiserResource::getUrl('index')),
        ];
    }
}
