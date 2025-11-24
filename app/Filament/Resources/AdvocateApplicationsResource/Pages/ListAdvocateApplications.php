<?php

namespace App\Filament\Resources\AdvocateApplicationsResource\Pages;

use App\Filament\Resources\AdvocateApplicationsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListAdvocateApplications extends ListRecords
{
    protected static string $resource = AdvocateApplicationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Applications'),
            'pending' => Tab::make('Pending')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending'))
                ->badge(fn () => \App\Models\AdvocateApplication::pending()->count()),
            'under_review' => Tab::make('Under Review')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'under_review'))
                ->badge(fn () => \App\Models\AdvocateApplication::underReview()->count()),
            'approved' => Tab::make('Approved')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'approved'))
                ->badge(fn () => \App\Models\AdvocateApplication::approved()->count()),
            'rejected' => Tab::make('Rejected')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'rejected'))
                ->badge(fn () => \App\Models\AdvocateApplication::rejected()->count()),
        ];
    }
}