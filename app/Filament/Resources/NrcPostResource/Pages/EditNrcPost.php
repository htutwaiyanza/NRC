<?php

namespace App\Filament\Resources\NrcPostResource\Pages;

use App\Filament\Resources\NrcPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNrcPost extends EditRecord
{
    protected static string $resource = NrcPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
