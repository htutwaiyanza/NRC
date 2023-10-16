<?php

namespace App\Filament\Resources\Nrc1Resource\Pages;

use App\Filament\Resources\Nrc1Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNrc1s extends ListRecords
{
    protected static string $resource = Nrc1Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
