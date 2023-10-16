<?php

namespace App\Filament\Resources\NrcPostResource\Pages;

use App\Filament\Resources\NrcPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNrcPosts extends ListRecords
{
    protected static string $resource = NrcPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
