<?php

namespace App\Filament\Admin\Resources\LogoResource\Pages;

use App\Filament\Admin\Resources\LogoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLogos extends ListRecords
{
    protected static string $resource = LogoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
