<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Filament\Resources\QuestionResource\RelationManagers;
use Modules\Common\Models\Question;
use Modules\Common\Models\QuestionType;
use Modules\Common\Models\Exam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationGroup = 'Exam';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //

                Forms\Components\Select::make('exam_id')
                ->label('Exam Title')
                ->options(Exam::all()->pluck('title', 'id')->toArray()) // Fetch all subjects
                ->required()
                ->searchable()
                ->placeholder('Select a Exam'),

                Forms\Components\Textarea::make('question')
                ->label('Question')
                ->required(),

                Forms\Components\TextInput::make('marks')
                ->label('Marks')
                ->required(),


                Forms\Components\Select::make('question_type_id')
                ->label('Question Type')
                ->options(QuestionType::all()->pluck('name', 'id')->toArray()) // Fetch all subjects
                ->required()
                ->searchable()
                ->placeholder('Select a Question Type'),

                Forms\Components\Hidden::make('status')
                ->default(1), // Set default value to 1
                
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

                Tables\Columns\TextColumn::make('exam.title') // Use relationship to display exam title
                    ->label('Exam Name')
                    ->sortable()
                    ->searchable(),

                    Tables\Columns\TextColumn::make('question') // Use relationship to display exam title
                    ->label('Questions')
                    ->sortable()
                    ->searchable()
                    ->wrap(), // Ensure text wraps within the column
                    // ->extraAttributes(['style' => 'max-width: 800px; white-space: normal;']), // Set max-width and allow wrapping

                    Tables\Columns\TextColumn::make('marks') // Use relationship to display exam title
                    ->label('Marks')
                    ->sortable()
                    ->searchable(),

                    Tables\Columns\TextColumn::make('questionType.name') // Use relationship to display exam title
                    ->label('Question Type')
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
