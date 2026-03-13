<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdvocateApplicationsResource\Pages;
use App\Models\AdvocateApplication;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Support\Colors\Color;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;

class AdvocateApplicationsResource extends Resource
{
    protected static ?string $model = AdvocateApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationGroup = 'User Management';

    protected static ?string $navigationLabel = 'Advocate Applications';

    protected static ?string $modelLabel = 'Advocate Application';

    protected static ?string $pluralModelLabel = 'Advocate Applications';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Application Details')
                    ->schema([
                        Forms\Components\TextInput::make('firstname')
                            ->label('First Name')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('lastname')
                            ->label('Last Name')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('phone')
                            ->label('Phone')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('university')
                            ->label('University')
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('course')
                            ->label('Course')
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('graduation_year')
                            ->label('Graduation Year')
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Application Information')
                    ->schema([
                        Forms\Components\Textarea::make('motivation')
                            ->label('Motivation')
                            ->required()
                            ->rows(4),
                        
                        Forms\Components\Textarea::make('experience')
                            ->label('Experience')
                            ->rows(4),
                        
                        Forms\Components\TagsInput::make('skills')
                            ->label('Skills')
                            ->placeholder('Add skills...'),
                    ]),

                Forms\Components\Section::make('Review Status')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending Review',
                                'under_review' => 'Under Review',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->required()
                            ->default('pending'),
                        
                        Forms\Components\Select::make('reviewed_by')
                            ->label('Reviewed By')
                            ->options(User::query()->pluck('name', 'id'))
                            ->searchable(),
                        
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Admin Notes')
                            ->rows(3),
                        
                        Forms\Components\DateTimePicker::make('reviewed_at')
                            ->label('Reviewed At'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Name')
                    ->searchable(['firstname', 'lastname'])
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable(),

                Tables\Columns\TextColumn::make('university')
                    ->label('University')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'under_review',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pending Review',
                        'under_review' => 'Under Review',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('reviewer.name')
                    ->label('Reviewed By')
                    ->sortable()
                    ->placeholder('Not reviewed'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Applied At')
                    ->dateTime()
                    ->sortable()
                    ->since(),

                Tables\Columns\TextColumn::make('reviewed_at')
                    ->label('Reviewed At')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('Not reviewed'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending Review',
                        'under_review' => 'Under Review',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Approve Application')
                    ->modalDescription('Are you sure you want to approve this advocate application?')
                    ->action(function (AdvocateApplication $record) {
                        $record->update([
                            'status' => 'approved',
                            'reviewed_at' => now(),
                            'reviewed_by' => Auth::id(),
                        ]);
                        
                        // TODO: Send approval email to applicant
                        // TODO: Potentially create a user account or assign advocate role
                    })
                    ->visible(fn (AdvocateApplication $record) => $record->status !== 'approved'),

                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Reject Application')
                    ->modalDescription('Are you sure you want to reject this advocate application?')
                    ->form([
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Reason for rejection')
                            ->required()
                            ->placeholder('Please provide a reason for rejection...')
                            ->rows(3),
                    ])
                    ->action(function (AdvocateApplication $record, array $data) {
                        $record->update([
                            'status' => 'rejected',
                            'reviewed_at' => now(),
                            'reviewed_by' => Auth::id(),
                            'admin_notes' => $data['admin_notes'],
                        ]);
                        
                        // TODO: Send rejection email to applicant
                    })
                    ->visible(fn (AdvocateApplication $record) => $record->status !== 'rejected'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Personal Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('full_name')
                            ->label('Full Name'),
                        Infolists\Components\TextEntry::make('email')
                            ->label('Email')
                            ->copyable(),
                        Infolists\Components\TextEntry::make('phone')
                            ->label('Phone'),
                    ])->columns(3),

                Infolists\Components\Section::make('Academic Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('university')
                            ->label('University'),
                        Infolists\Components\TextEntry::make('course')
                            ->label('Course'),
                        Infolists\Components\TextEntry::make('graduation_year')
                            ->label('Graduation Year'),
                    ])->columns(3),

                Infolists\Components\Section::make('Application Details')
                    ->schema([
                        Infolists\Components\TextEntry::make('motivation')
                            ->label('Motivation')
                            ->prose()
                            ->columnSpanFull(),
                        
                        Infolists\Components\TextEntry::make('experience')
                            ->label('Experience')
                            ->prose()
                            ->columnSpanFull()
                            ->placeholder('No experience provided'),
                        
                        Infolists\Components\TextEntry::make('skills')
                            ->label('Skills')
                            ->badge()
                            ->columnSpanFull()
                            ->placeholder('No skills provided'),
                    ]),

                Infolists\Components\Section::make('Review Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('status_label')
                            ->label('Status')
                            ->badge()
                            ->color(fn (AdvocateApplication $record) => $record->status_color),
                        
                        Infolists\Components\TextEntry::make('reviewer.name')
                            ->label('Reviewed By')
                            ->placeholder('Not reviewed'),
                        
                        Infolists\Components\TextEntry::make('reviewed_at')
                            ->label('Reviewed At')
                            ->dateTime()
                            ->placeholder('Not reviewed'),
                        
                        Infolists\Components\TextEntry::make('admin_notes')
                            ->label('Admin Notes')
                            ->prose()
                            ->columnSpanFull()
                            ->placeholder('No admin notes'),
                    ])->columns(3),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdvocateApplications::route('/'),
            'create' => Pages\CreateAdvocateApplications::route('/create'),
            'view' => Pages\ViewAdvocateApplications::route('/{record}'),
            'edit' => Pages\EditAdvocateApplications::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() > 0 ? 'warning' : null;
    }
}