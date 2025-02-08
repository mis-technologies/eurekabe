<?php

namespace App\Filament\Resources\QuestionTypesResource\Pages;

use App\Filament\Resources\QuestionTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuestionTypes extends EditRecord
{
    protected static string $resource = QuestionTypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
