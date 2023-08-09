<?php

namespace App\Filament\Resources\TargetResource\Pages;

use App\Filament\Resources\TargetResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTarget extends EditRecord
{
    protected static string $resource = TargetResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
