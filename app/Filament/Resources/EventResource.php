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
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
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
                    ->disabled(!auth()->user()->hasRole('admin')),
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
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label('Event name')
                    ->limit(30),
                TextColumn::make('start_date')
                    ->sortable()
                    ->label('Event Date & Time')
                    ->getStateUsing(function (Event $record): string {
                        return $record->start_date . ' - ' . $record->start_time;
                    }),
                TextColumn::make('attendee_count')
                ->counts('attendee')
                ->label('Attendees')
                ->toggleable()
                ->sortable(),
                TextColumn::make('user.organiser.name')
                ->description('user.organiser.org')
                ->toggleable(),
                TextColumn::make('venue.name')
                    ->label("Venue")
                    ->toggleable(),
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
                SelectFilter::make('status')->options([
                    'draft' => 'Draft',
                    'pending' => "Pending",
                    'activated' => "Activated",
                ]),
                SelectFilter::make('created_at')->options([
                    '2023' => '2023',
                    '2022' => '2022',
                ])
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('name')
            ->filtersFormColumns(4);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Details')
                    ->description('Event details')
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                        ,
                    ]),
                Section::make('Description')
                    ->collapsible()
                    ->schema([
                        Infolists\Components\TextEntry::make('description')
                            ->hiddenLabel(),
                    ]),
            ]);
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
            'view' => Pages\ViewEvent::route('/{record}'),
        ];
    }
}
