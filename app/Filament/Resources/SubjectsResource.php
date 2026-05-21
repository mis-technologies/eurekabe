<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubjectsResource\Pages;
use App\Filament\Resources\SubjectsResource\RelationManagers;
use Modules\Common\Models\Subject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use  Modules\Common\Models\Category;

class SubjectsResource extends Resource
{
    protected static ?string $model = Subject::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                    ->label('Subject Name')
                    ->required()
                    ->maxLength(255),

                  
                Forms\Components\Select::make('category_id')
                ->label('Category')
                ->relationship('category', 'name') // Use relationship to display category name
                ->required()
                ->searchable(),


                Forms\Components\TextInput::make('slug')
                    ->label('Slug Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('short_details')
                    ->label('Short Details')
                    ->required()
                    ->maxLength(255),

                    

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        '1' => 'Active',
                        '2' => 'Inactive',
                    ])
                    ->required(),

                    Forms\Components\Toggle::make('is_popular')
                    ->label('Is Popular')
                    ->default(1) // Set default value to 1
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Names')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable()
                    ->searchable(),

                    Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),

                    Tables\Columns\TextColumn::make('short_details')
                    ->label('Short Details')
                    ->sortable()
                    ->searchable(),

                    Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        return $state == 1 ? 'Active' : 'Inactive';
                    }),
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
            'index' => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubjects::route('/create'),
            'edit' => Pages\EditSubjects::route('/{record}/edit'),
        ];
    }
}
