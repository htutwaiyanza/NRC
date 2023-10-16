<?php

namespace App\Filament\Resources\Nrc2Resource\Pages;

use App\Filament\Resources\Nrc2Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNrc2 extends EditRecord
{
    protected static string $resource = Nrc2Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
