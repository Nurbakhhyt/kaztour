<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CityResource\Pages;
use App\Models\City;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'География';
    protected static ?int $navigationSort = 1;
    protected static ?string $label = 'Город';
    protected static ?string $pluralLabel = 'Города';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Название города'),

                TextInput::make('city_code')
                    ->label('Код города')
                    ->required(),

                FileUpload::make('img')
                    ->label('Изображение города')
                    ->directory('cities') // загружается в storage/app/public/cities
                    ->image()
                    ->imageEditor()
                    ->preserveFilenames()
                    ->required(),

                Textarea::make('description')
                    ->label('Описание')
                    ->rows(4)
                    ->maxLength(1000),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Название')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('city_code')
                    ->label('Код')
                    ->sortable(),

                ImageColumn::make('img')
                    ->label('Фото')
                    ->circular(),

                TextColumn::make('description')
                    ->label('Описание')
                    ->limit(50)
                    ->wrap()
            ])
            ->filters([
                Filter::make('has_locations')
                    ->label('С локациями')
                    ->query(fn (Builder $query) => $query->has('locations')),
            ])
            ->actions([
                // Добавляем кнопку для удаления
                DeleteAction::make()
                    ->label('Удалить'),
            ])
            ->defaultSort('name');
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
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
        ];
    }

}
