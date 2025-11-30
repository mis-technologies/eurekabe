<?php

namespace App\Filament\Resources\VolunteerApplicationResource\Pages;

use App\Filament\Resources\VolunteerApplicationResource;
use App\Mail\VolunteerApplicationStatus;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditVolunteerApplication extends EditRecord
{
    protected static string $resource = VolunteerApplicationResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Track if status is changing to approved or rejected
        $oldStatus = $this->record->status;
        $newStatus = $data['status'] ?? null;
        
        if ($newStatus && in_array($newStatus, ['approved', 'rejected']) && $oldStatus !== $newStatus) {
            $data['reviewed_at'] = now();
            $data['reviewed_by'] = auth()->id();
        }
        
        return $data;
    }

    protected function afterSave(): void
    {
        $record = $this->record;
        
        // Send email if status was changed to approved or rejected
        if (in_array($record->status, ['approved', 'rejected'])) {
            try {
                Mail::to($record->email)
                    ->send(new VolunteerApplicationStatus($record, $record->status));
                    
                \Filament\Notifications\Notification::make()
                    ->title('Email Sent')
                    ->body('Status notification email has been sent to ' . $record->email)
                    ->success()
                    ->send();
            } catch (\Exception $e) {
                \Log::error('Failed to send volunteer status email: ' . $e->getMessage());
                
                \Filament\Notifications\Notification::make()
                    ->title('Email Failed')
                    ->body('Failed to send notification email: ' . $e->getMessage())
                    ->danger()
                    ->send();
            }
        }
    }
}
