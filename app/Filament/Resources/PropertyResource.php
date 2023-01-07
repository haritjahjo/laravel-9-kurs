<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Property;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PropertyResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PropertyResource\RelationManagers;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Toggle::make('slider')
                    ->required(),
                Forms\Components\TextInput::make('country')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required(),
                Forms\Components\TextInput::make('sqm')
                    ->required(),
                Forms\Components\Toggle::make('bedrooms')
                    ->required(),
                Forms\Components\Toggle::make('bathrooms')
                    ->required(),
                Forms\Components\Toggle::make('garages')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->sortable()->searchable(),
//                Tables\Columns\TextColumn::make('description'),
                IconColumn::make('slider')
                    ->boolean()->sortable(),
                TextColumn::make('country')->sortable()->searchable(),
//                Tables\Columns\TextColumn::make('city'),
//                Tables\Columns\TextColumn::make('address'),
                TextColumn::make('price')->sortable()->alignRight(),
                TextColumn::make('sqm')->sortable()->alignRight(),
                IconColumn::make('bedrooms')->alignCenter()
                    ->boolean()->sortable(),
                IconColumn::make('bathrooms')->alignCenter()
                    ->boolean()->sortable(),
                IconColumn::make('garages')->alignCenter()
                    ->boolean()->sortable(),
//                Tables\Columns\TextColumn::make('deleted_at')
//                    ->dateTime(),
//                Tables\Columns\TextColumn::make('created_at')
//                    ->dateTime(),
//                Tables\Columns\TextColumn::make('updated_at')
//                    ->dateTime(),
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
