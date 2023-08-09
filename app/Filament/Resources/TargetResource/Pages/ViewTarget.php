<?php

namespace App\Filament\Resources\TargetResource\Pages;

use App\Filament\Resources\TargetResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTarget extends ViewRecord
{
    protected static string $resource = TargetResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
