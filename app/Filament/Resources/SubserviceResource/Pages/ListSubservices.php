<?php

namespace App\Filament\Resources\SubserviceResource\Pages;

use App\Filament\Resources\SubserviceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubservices extends ListRecords
{
    protected static string $resource = SubserviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
