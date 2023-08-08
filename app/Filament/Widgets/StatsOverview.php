<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\EventResource;
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
            ->description("View all")
            ->url(EventResource::getUrl('index')),
            Card::make('Attendees', Attendee::all()->count()),
            Card::make('Organisers', Organiser::all()->count()),
        ];
    }
}
