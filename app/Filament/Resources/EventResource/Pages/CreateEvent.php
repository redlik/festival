<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['slug'] = Str::of($data['name'])->slug('-');
        dd($data);
        return $data;
    }

    protected function beforeCreate(): void
    {

        $this->data['slug'] = Str::of($this->data['name'])->slug('-');
        dd($this->data);
//        $this->data
    }
}
