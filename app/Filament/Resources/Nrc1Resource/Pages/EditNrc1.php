<?php

namespace App\Filament\Resources\Nrc1Resource\Pages;

use App\Filament\Resources\Nrc1Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNrc1 extends EditRecord
{
    protected static string $resource = Nrc1Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
