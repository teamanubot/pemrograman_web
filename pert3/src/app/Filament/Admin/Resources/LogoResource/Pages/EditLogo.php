<?php

namespace App\Filament\Admin\Resources\LogoResource\Pages;

use App\Filament\Admin\Resources\LogoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLogo extends EditRecord
{
    protected static string $resource = LogoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
