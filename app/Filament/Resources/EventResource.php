<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers\VenuesRelationManager;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                DatePicker::make('start_date')->minDate('2023-10-07')->maxDate('2023-10-14')
                    ->disabled(! auth()->user()->hasRole('admin')),
                TimePicker::make('start_time')
                    ->label('Start time')
                    ->withoutSeconds(),
                TimePicker::make('end_time')
                    ->label('End time')
                    ->withoutSeconds()
                    ->after('start_time'),
                Select::make('type')->label('Environment')->options([
                    'indoor' => 'Indoor',
                    'outdoor' => 'Outdoor',
                    'online' => 'Online',
                ]),
                Forms\Components\CheckboxList::make('target')
                ->relationship('target', 'name')
                ->columns(2),
                Select::make('venue_id')
                ->relationship('venue', 'name')->required(),
                MarkdownEditor::make('description')->required()->columnSpan(2),
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
                Tables\Columns\TextColumn::make('venue.name')
                    ->label("Venue"),
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
