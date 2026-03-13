<?php

namespace App\Filament\Resources\AdvocateApplicationsResource\Pages;

use App\Filament\Resources\AdvocateApplicationsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdvocateApplications extends CreateRecord
{
    protected static string $resource = AdvocateApplicationsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}