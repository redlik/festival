<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganiserResource\Pages;
use App\Filament\Resources\OrganiserResource\RelationManagers;
use App\Models\Organiser;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrganiserResource extends Resource
{
    protected static ?string $model = Organiser::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrganisers::route('/'),
            'create' => Pages\CreateOrganiser::route('/create'),
            'edit' => Pages\EditOrganiser::route('/{record}/edit'),
        ];
    }
}
