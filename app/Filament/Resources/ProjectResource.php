<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;


class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return 'Проект';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Проекты';
    }

//title
//slug
//description
//image
//tech_stack
//is_featured
//order

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->autofocus()
                    ->label('Название')
                    ->required(),
                TextInput::make('slug')
                    ->unique(ignoreRecord: true)
                    ->label('Slug')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->nullable(),
                SpatieMediaLibraryFileUpload::make('image')
                    ->nullable()
                    ->label('Изображение')
                    ->collection('project')
                    ->disk('public'),
                Toggle::make('is_featured')
                    ->nullable()
                    ->label('Активный'),
                Select::make('order')
                    ->label('Порядок отображения')
                    ->options(function () {
                        $count = Project::count();
                        return ($count === 0)
                            ? [1 => '1']
                            : array_combine(range(1, $count + 1), range(1, $count + 1));
                    })
                    ->default(fn() => Project::count() + 1)
                    ->required()
                    ->helperText('Выберите позицию проекта в списке')


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Название')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Активный'),
                Tables\Columns\TextColumn::make('order')
                    ->label('Порядок')
                    ->sortable(),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->collection('project')
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
