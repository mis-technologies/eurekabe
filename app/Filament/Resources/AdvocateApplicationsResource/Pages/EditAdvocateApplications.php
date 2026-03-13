<?php

namespace App\Filament\Resources\AdvocateApplicationsResource\Pages;

use App\Filament\Resources\AdvocateApplicationsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdvocateApplications extends EditRecord
{
    protected static string $resource = AdvocateApplicationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}