<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TourResource\Pages;
use App\Models\Tour;
use App\Models\Location;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class TourResource extends Resource
{
    protected static ?string $model = Tour::class;
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationLabel = 'Туры';
    protected static ?string $pluralModelLabel = 'Список туров';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Название тура')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Описание тура')
                    ->required(),

                Forms\Components\Select::make('location_id')
                    ->label('Локация')
                    ->relationship('location', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('user_id')
                    ->label('Ответственный пользователь')
                    ->relationship('user', 'name')
                    ->searchable(),

                Forms\Components\TextInput::make('price')
                    ->label('Цена')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('volume')
                    ->label('Кол-во мест')
                    ->numeric()
                    ->required(),

                Forms\Components\DatePicker::make('date')
                    ->label('Дата тура')
                    ->required(),

                Forms\Components\FileUpload::make('image')
                    ->label('Обложка тура')
                    ->image()
                    ->directory('tour-images')
                    ->preserveFilenames()
                    ->maxSize(1024),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Название')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('location.name')->label('Локация'),
                Tables\Columns\TextColumn::make('user.name')->label('Пользователь'),
                Tables\Columns\TextColumn::make('price')->label('Цена'),
                Tables\Columns\TextColumn::make('volume')->label('Места'),
                Tables\Columns\TextColumn::make('date')->label('Дата'),
            ])
            ->filters([
                SelectFilter::make('location_id')
                    ->label('Фильтр по локации')
                    ->relationship('location', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label('Удалить'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTours::route('/'),
            'create' => Pages\CreateTour::route('/create'),
            'edit' => Pages\EditTour::route('/{record}/edit'),
        ];
    }
}
