<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Property;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PropertyResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PropertyResource\RelationManagers;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Tabs;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->schema(
            Tabs::make('Heading')
                ->tabs([
                    Tabs\Tab::make('Main Data')
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->maxLength(255),
                            RichEditor::make('description')
                                ->required()
                                ->maxLength(65535),
                            TextInput::make('country')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('city')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('address')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('price')
                                ->required(),
                            TextInput::make('sqm')
                                ->required(),
                            TextInput::make('bedrooms')
                                ->required(),
                            TextInput::make('bathrooms')
                                ->required(),
                            TextInput::make('garages')
                                ->required(),
                            Toggle::make('slider')
                                ->required(),

                        ]),
                    Tabs\Tab::make('Period')
                        ->schema([
                            DatePicker::make(name:'start_date'),
                            DatePicker::make(name:'end_date'),
                        ]),
                    Tabs\Tab::make('Picture')
                        ->schema([
                            // ...
                        ]),
                ])

            
        );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->sortable()->searchable(),
                IconColumn::make('slider')
                    ->boolean()->sortable(),
                TextColumn::make('country')->sortable()->searchable(),
                TextColumn::make('price')->sortable()->alignRight(),
                TextColumn::make('sqm')->sortable()->alignRight(),
                TextColumn::make('bedrooms')->alignRight()
                    ->sortable(),
                TextColumn::make('bathrooms')->alignRight()
                    ->sortable(),
                TextColumn::make('garages')->alignRight()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                //Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'view' => Pages\ViewProperty::route('/{record}'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }    
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
