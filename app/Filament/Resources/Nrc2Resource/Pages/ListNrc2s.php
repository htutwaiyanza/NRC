<?php

namespace App\Filament\Resources\Nrc2Resource\Pages;

use App\Filament\Resources\Nrc2Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNrc2s extends ListRecords
{
    protected static string $resource = Nrc2Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
