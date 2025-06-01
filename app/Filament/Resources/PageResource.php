<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return 'Страницы';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Страницы';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->required()
                ->label('Заголовок'),
            TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true),
            Textarea::make('content')
                ->rows(8)
                ->label('Контент')
                ->nullable(),

            TextInput::make('meta_title')
                ->label('Мета заголовок')
                ->nullable(),
            TextInput::make('meta_description')
                ->label('Мета описание')
                ->nullable(),
            TextInput::make('meta_keywords')
                ->label('Мета ключевые слова')
                ->nullable(),

            Toggle::make('is_visible')
                ->label('Отображать на сайте')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable(),

                Tables\Columns\TextColumn::make('meta_title')
                    ->label('Мета заголовок')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('meta_description')
                    ->label('Мета описание')
                    ->limit(50)
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Показывать')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
