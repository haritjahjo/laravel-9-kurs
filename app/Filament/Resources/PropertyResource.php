<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Property;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Tabs;
use Livewire\TemporaryUploadedFile;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PropertyResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\PropertyResource\RelationManagers;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $modelLabel = 'property';
    protected static ?string $pluralModelLabel = 'properties';

    public static function form(Form $form): Form
    {
        return $form->schema(
            Tabs::make('Heading')
                ->tabs([
                    Tabs\Tab::make('Main Data')
                        ->columns(columns:12)
                        ->schema([
                            TextInput::make('title')
                                ->columnSpan(span:12)
                                ->required()
                                ->maxLength(255),
                            RichEditor::make('description')
                                ->columnSpan(span:12)
                                ->required()
                                ->maxLength(65535),
                            TextInput::make('country')
                                ->columnSpan(span:6)
                                ->required()
                                ->maxLength(255),
                            TextInput::make('city')
                                ->columnSpan(span:6)
                                ->required()
                                ->maxLength(255),
                            TextInput::make('address')
                                ->columnSpan(span:6)
                                ->required()
                                ->maxLength(255),
                            TextInput::make('price')
                                ->columnSpan(span:6)
                                ->required(),
                            TextInput::make('sqm')
                                ->columnSpan(span:3)
                                ->required(),
                            TextInput::make('bedrooms')
                                ->columnSpan(span:3)
                                ->required(),
                            TextInput::make('bathrooms')
                                ->columnSpan(span:3)
                                ->required(),
                            TextInput::make('garages')
                                ->columnSpan(span:3)
                                ->required(),
                            Toggle::make('slider')
                                ->columnSpan(span:12)
                                ->required(),

                        ]),
                    Tabs\Tab::make('Period')
                        ->columns(columns:12)
                        ->schema([
                            DatePicker::make(name:'start_date')
                                ->columnSpan(span:6),
                            DatePicker::make(name:'end_date')
                                ->columnSpan(span:6),
                        ]),
                    Tabs\Tab::make('Picture')
                        ->schema([
                            SpatieMediaLibraryFileUpload::make(name:'Thumbnail Slider (Bitte speichren !)')
                                ->image()
                                ->multiple()
                                ->enableReordering()
                                ->collection(collection:'thumb-slider')
                                ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                                    return (string) str($file->getClientOriginalName())->prepend('real-invest-');
                                })
                                ->columnSpan(span: 6),
                            SpatieMediaLibraryFileUpload::make(name:'Slider Image')
                                ->image()
                                ->collection(collection:'slider')
                                ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                                    return (string) str($file->getClientOriginalName())->prepend('real-invest-');
                                })
                                ->columnSpan(span: 6),                            
                        ])->columns(columns: 12),
                ])

            
        );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->sortable()->searchable(),
                SpatieMediaLibraryImageColumn::make(name: 'main-images')
                    ->collection(collection:'thumb-slider')
                    ->width(width: 60)
                    ->height(height:80),
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
                SpatieMediaLibraryImageColumn::make(name: 'slider-image')
                    ->collection(collection:'slider')
                    ->width(width: 140)
                    ->height(height:80),
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
