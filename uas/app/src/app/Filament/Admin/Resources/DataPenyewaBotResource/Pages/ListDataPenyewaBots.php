<?php

namespace App\Filament\Admin\Resources\DataPenyewaBotResource\Pages;

use App\Filament\Admin\Resources\DataPenyewaBotResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataPenyewaBots extends ListRecords
{
    protected static string $resource = DataPenyewaBotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
