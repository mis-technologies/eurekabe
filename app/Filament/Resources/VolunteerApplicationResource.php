<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VolunteerApplicationResource\Pages;
use App\Models\VolunteerApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class VolunteerApplicationResource extends Resource
{
    protected static ?string $model = VolunteerApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-hand-raised';

    protected static ?string $navigationLabel = 'Volunteer Applications';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Personal Information')
                    ->schema([
                        Forms\Components\TextInput::make('firstname')->required(),
                        Forms\Components\TextInput::make('lastname')->required(),
                        Forms\Components\TextInput::make('email')->email()->required(),
                        Forms\Components\TextInput::make('phone')->required(),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Education Background')
                    ->schema([
                        Forms\Components\TextInput::make('university'),
                        Forms\Components\TextInput::make('course'),
                        Forms\Components\TextInput::make('graduation_year'),
                    ])
                    ->columns(3),
                    
                Forms\Components\Section::make('Application Details')
                    ->schema([
                        Forms\Components\CheckboxList::make('skills')
                            ->options([
                                'Leadership' => 'Leadership',
                                'Communication' => 'Communication',
                                'Event Planning' => 'Event Planning',
                                'Teaching/Tutoring' => 'Teaching/Tutoring',
                                'Social Media' => 'Social Media',
                                'Marketing' => 'Marketing',
                                'Writing' => 'Writing',
                                'Public Speaking' => 'Public Speaking',
                                'Project Management' => 'Project Management',
                                'Graphic Design' => 'Graphic Design',
                                'Web Development' => 'Web Development',
                                'Photography' => 'Photography',
                                'Video Editing' => 'Video Editing',
                                'Research' => 'Research',
                                'Data Analysis' => 'Data Analysis',
                                'Other' => 'Other',
                            ])
                            ->columns(3),
                        Forms\Components\Textarea::make('motivation')->rows(4),
                        Forms\Components\Textarea::make('experience')->rows(4),
                    ]),
                    
                Forms\Components\Section::make('Admin Review')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'under_review' => 'Under Review',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('admin_notes')->rows(3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('firstname')->searchable()->sortable(),
                TextColumn::make('lastname')->searchable()->sortable(),
                TextColumn::make('email')->searchable()->sortable(),
                TextColumn::make('phone')->searchable(),
                TextColumn::make('university')->searchable()->limit(30),
                TextColumn::make('skills')
                    ->formatStateUsing(fn ($state) => is_array($state) ? implode(', ', $state) : $state)
                    ->limit(50)
                    ->tooltip(fn ($state) => is_array($state) ? implode(', ', $state) : $state),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'under_review' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    })
                    ->sortable(),
                TextColumn::make('created_at')->label('Applied')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'under_review' => 'Under Review',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVolunteerApplications::route('/'),
            'view' => Pages\ViewVolunteerApplication::route('/{record}'),
            'edit' => Pages\EditVolunteerApplication::route('/{record}/edit'),
        ];
    }
}
