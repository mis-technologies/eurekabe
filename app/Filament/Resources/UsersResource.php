<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsersResource\Pages;
use App\Filament\Resources\UsersResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        // dd('here');
        return $form
            ->schema([


                Forms\Components\TextInput::make('firstname')
                ->label('First Name')
                ->required()
                ->maxLength(255),

                Forms\Components\TextInput::make('lastname')
                ->label('Last Name')
                // ->required()
                ->maxLength(255),


                Forms\Components\TextInput::make('email')
                ->label('Email')
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

                Tables\Columns\TextColumn::make('firstname')
                ->label('First Name')
                ->sortable()
                ->searchable(),

                Tables\Columns\TextColumn::make('lastname')
                ->label('Last Name')
                ->sortable()
                ->searchable(),

                Tables\Columns\TextColumn::make('username')
                ->label('Username')
                ->sortable()
                ->searchable(),

                Tables\Columns\TextColumn::make('email')
                ->label('Email')
                ->sortable()
                ->searchable(),

                Tables\Columns\TextColumn::make('role')
                ->label('Role')
                ->sortable()
                ->searchable(),

                Tables\Columns\TextColumn::make('role')
                ->label('Role')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUsers::route('/create'),
            'edit' => Pages\EditUsers::route('/{record}/edit'),
        ];
    }
}
