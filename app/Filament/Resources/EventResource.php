<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Filament\Resources\EventresourceResource\RelationManagers\VenuesRelationManager;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                Forms\Components\DatePicker::make('start_date')->minDate('2023-10-07')->maxDate('2023-10-14')
                    ->disabled(! auth()->user()->hasRole('admin')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable()->label('Event name')->limit(30),
                Tables\Columns\TextColumn::make('start_date')->sortable()->label('Event Date & Time')
                    ->getStateUsing(function (Event $record): string {
                        return $record->start_date .' - '. $record->start_time;
                    }),
                BadgeColumn::make('status')
                    ->sortable()
                    ->colors([
                        'primary',
                        'secondary' => 'draft',
                        'warning' => 'pending',
                        'success' => 'published',
                        'danger' => 'canceled',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'draft' => 'Draft',
                    'pending' => "Pending",
                    'activated' => "Activated",
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('name');
    }

    public static function getRelations(): array
    {
        return [
            VenuesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
