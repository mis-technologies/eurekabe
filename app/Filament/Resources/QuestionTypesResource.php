<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionTypesResource\Pages;
use App\Filament\Resources\QuestionTypesResource\RelationManagers;
use Modules\Common\Models\QuestionType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionTypesResource extends Resource
{
    protected static ?string $model = QuestionType::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationGroup = 'Exam';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                ->label('Question type')
                ->required()
                ->maxLength(255),

                Forms\Components\TextInput::make('description')
                ->label('Description')
                ->required()
                ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //

                Tables\Columns\TextColumn::make('id')
                ->label('#')
                ->sortable()
                ->searchable(),

                Tables\Columns\TextColumn::make('name')
                ->label('Types')
                ->sortable()
                ->searchable(),

                Tables\Columns\TextColumn::make('description')
                ->label('Description')
                ->sortable()
                ->searchable(),
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
            'index' => Pages\ListQuestionTypes::route('/'),
            'create' => Pages\CreateQuestionTypes::route('/create'),
            'edit' => Pages\EditQuestionTypes::route('/{record}/edit'),
        ];
    }
}
