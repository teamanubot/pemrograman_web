<?php

namespace App\Filament\Admin\Resources\AkunResource\Pages;

use App\Filament\Admin\Resources\AkunResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAkuns extends ListRecords
{
    protected static string $resource = AkunResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
