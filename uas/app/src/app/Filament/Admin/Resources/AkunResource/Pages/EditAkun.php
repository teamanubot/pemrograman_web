<?php

namespace App\Filament\Admin\Resources\AkunResource\Pages;

use App\Filament\Admin\Resources\AkunResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAkun extends EditRecord
{
    protected static string $resource = AkunResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
