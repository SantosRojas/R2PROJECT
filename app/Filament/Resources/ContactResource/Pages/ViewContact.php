<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContact extends ViewRecord
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('markAsRead')
                ->label('Marcar como leído')
                ->icon('heroicon-o-check')
                ->action(fn () => $this->record->markAsRead())
                ->visible(fn () => $this->record->read_at === null),
            Actions\DeleteAction::make(),
        ];
    }
}
