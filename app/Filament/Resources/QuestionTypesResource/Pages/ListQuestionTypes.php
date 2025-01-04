<?php

namespace App\Filament\Resources\QuestionTypesResource\Pages;

use App\Filament\Resources\QuestionTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuestionTypes extends ListRecords
{
    protected static string $resource = QuestionTypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
