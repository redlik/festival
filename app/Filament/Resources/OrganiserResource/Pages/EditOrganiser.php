<?php

namespace App\Filament\Resources\OrganiserResource\Pages;

use App\Filament\Resources\OrganiserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrganiser extends EditRecord
{
    protected static string $resource = OrganiserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
