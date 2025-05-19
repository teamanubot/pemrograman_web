<?php

namespace App\Filament\Admin\Resources\PageConfigResource\Pages;

use App\Filament\Admin\Resources\PageConfigResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPageConfigs extends ListRecords
{
    protected static string $resource = PageConfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
