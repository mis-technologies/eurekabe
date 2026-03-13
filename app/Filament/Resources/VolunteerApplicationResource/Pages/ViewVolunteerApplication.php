<?php

namespace App\Filament\Resources\VolunteerApplicationResource\Pages;

use App\Filament\Resources\VolunteerApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVolunteerApplication extends ViewRecord
{
    protected static string $resource = VolunteerApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}