<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocationResource\Pages;
use App\Models\Location;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class LocationResource extends Resource
{
    protected static ?string $model = Location::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationGroup = 'Справочники';
    protected static ?string $label = 'Локация';
    protected static ?string $pluralLabel = 'Локации';

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('viewAny', Location::class);
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create', Location::class);
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('update', $record);
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete', $record);
    }


    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Название локации')
                    ->required()
                    ->maxLength(255),

                Select::make('city_id')
                    ->label('Город')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('city.name')
                    ->label('Город')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('city_id')
                    ->label('Фильтр по городу')
                    ->relationship('city', 'name')
                    ->searchable(),
            ])
            ->defaultSort('name');
    }

    public static function getRelations(): array
    {
        return [
            // Здесь можно добавить RelationManager для Tours
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLocations::route('/'),
            'create' => Pages\CreateLocation::route('/create'),
            'edit' => Pages\EditLocation::route('/{record}/edit'),
        ];
    }
}
