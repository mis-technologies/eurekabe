<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomePageResource\Pages;
use App\Filament\Resources\HomePageResource\RelationManagers;
use App\Models\HomePage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HomePageResource extends Resource
{
    protected static ?string $model = HomePage::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('General Settings')
                    ->schema([
                        Forms\Components\Toggle::make('show_volunteer_call')
                            ->label('Show Volunteer Call to Action')
                            ->helperText('Toggle to show/hide the volunteer recruitment banner on the homepage'),
                    ]),
                    
                Forms\Components\Section::make('Page Content')
                    ->schema([
                        Forms\Components\Textarea::make('herosection')
                            ->label('Hero Section (JSON)')
                            ->rows(4),
                            
                        Forms\Components\Textarea::make('whoarewe')
                            ->label('Who Are We Section (JSON)')
                            ->rows(4),
                            
                        Forms\Components\Textarea::make('socialsection')
                            ->label('Social Section (JSON)')
                            ->rows(4),
                            
                        Forms\Components\Textarea::make('whatweoffer')
                            ->label('What We Offer Section (JSON)')
                            ->rows(4),
                            
                        Forms\Components\Textarea::make('teamsection')
                            ->label('Team Section (JSON)')
                            ->rows(4),
                            
                        Forms\Components\Textarea::make('downloadsection')
                            ->label('Download Section (JSON)')
                            ->rows(4),
                            
                        Forms\Components\Textarea::make('engagementsection')
                            ->label('Engagement Section (JSON)')
                            ->rows(4),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\IconColumn::make('show_volunteer_call')
                    ->label('Volunteer CTA')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
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
            'index' => Pages\ListHomePages::route('/'),
            'create' => Pages\CreateHomePage::route('/create'),
            'edit' => Pages\EditHomePage::route('/{record}/edit'),
        ];
    }
}
