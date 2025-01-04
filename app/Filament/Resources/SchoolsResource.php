<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolsResource\Pages;
use App\Filament\Resources\SchoolsResource\RelationManagers;
use Modules\Common\Models\School;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolsResource extends Resource
{
    protected static ?string $model = School::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
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
                ->label('School Name')
                ->sortable()
                ->searchable(),

                Tables\Columns\TextColumn::make('acronym')
                ->label('School  Short Name')
                ->sortable()
                ->searchable(),

                Tables\Columns\TextColumn::make('about')
                ->label('About School')
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
            'index' => Pages\ListSchools::route('/'),
            'create' => Pages\CreateSchools::route('/create'),
            'edit' => Pages\EditSchools::route('/{record}/edit'),
        ];
    }
}
