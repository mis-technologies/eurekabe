<?php

namespace App\Filament\Resources\AdvocateApplicationsResource\Pages;

use App\Filament\Resources\AdvocateApplicationsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAdvocateApplications extends ViewRecord
{
    protected static string $resource = AdvocateApplicationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}