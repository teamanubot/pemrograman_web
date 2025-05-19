<?php

namespace App\Filament\Admin\Resources\FooterResource\Pages;

use App\Filament\Admin\Resources\FooterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFooters extends ListRecords
{
    protected static string $resource = FooterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
