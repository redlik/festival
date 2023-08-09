<?php

namespace App\Filament\Resources\VenueResource\Pages;

use App\Filament\Resources\VenueResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVenue extends ViewRecord
{
    protected static string $resource = VenueResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
