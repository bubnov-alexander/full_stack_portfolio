<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StackResource\Pages;
use App\Models\Stack;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StackResource extends Resource
{
    protected static ?string $model = Stack::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return 'Навыки';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Навыки';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Название')
                    ->maxLength(255),
                SpatieMediaLibraryFileUpload::make('image')
                    ->required()
                    ->label('Изображение')
                    ->collection('stack')
                    ->disk('public'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->collection('stack')
                    ->label('Изображение')
                    ->circular(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListStacks::route('/'),
            'create' => Pages\CreateStack::route('/create'),
            'edit' => Pages\EditStack::route('/{record}/edit'),
        ];
    }
}
