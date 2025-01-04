<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResource\Pages;
use Modules\Exam\Models\Exam;
use Modules\Exam\Models\Subject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Exam Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('subject_id')
                    ->label('Subject')
                    ->options(Subject::all()->pluck('name', 'id')->toArray()) // Fetch all subjects
                    ->required()
                    ->searchable()
                    ->placeholder('Select a Subject'),



                Forms\Components\Textarea::make('instruction')
                    ->label('Instructions')
                    ->required()
                    ->maxLength(1000),

                Forms\Components\TextInput::make('exam_fee')
                    ->label('Exam Fee')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('totalmark')
                    ->label('Total Marks')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('pass_percentage')
                    ->label('Pass Percentage')
                    ->numeric()
                    ->required(),
                Forms\Components\DateTimePicker::make('start_date')
                    ->label('Start Date')
                    ->required(),
                Forms\Components\DateTimePicker::make('end_date')
                    ->label('End Date')
                    ->required(),

                Forms\Components\TextInput::make('duration')
                    ->label('Duration')
                    ->numeric()
                    ->required(),

                    Forms\Components\TextInput::make('value')
                    ->label('Value')
                    ->numeric()
                    ->default(2)
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        '1' => 'Active',
                        '2' => 'Inactive',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                
                Tables\Columns\TextColumn::make('title')
                    ->label('Exam Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('instruction')
                    ->label('Instructions')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start Date')
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('End Date')
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Duration')
                    ->sortable(),
                Tables\Columns\TextColumn::make('totalmark')
                    ->label('Total Marks')
                    ->sortable(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExams::route('/'),
            'create' => Pages\CreateExam::route('/create'),
            'edit' => Pages\EditExam::route('/{record}/edit'),
        ];
    }
}
