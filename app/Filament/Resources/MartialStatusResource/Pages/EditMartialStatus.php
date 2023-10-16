<?php

namespace App\Filament\Resources\MartialStatusResource\Pages;

use App\Filament\Resources\MartialStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMartialStatus extends EditRecord
{
    protected static string $resource = MartialStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
