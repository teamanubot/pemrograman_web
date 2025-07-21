<?php

namespace App\Filament\Admin\Resources\DataPenyewaBotResource\Pages;

use App\Filament\Admin\Resources\DataPenyewaBotResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataPenyewaBot extends EditRecord
{
    protected static string $resource = DataPenyewaBotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
