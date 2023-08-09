<?php

namespace App\Filament\Resources\TargetResource\Pages;

use App\Filament\Resources\TargetResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTargets extends ListRecords
{
    protected static string $resource = TargetResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
