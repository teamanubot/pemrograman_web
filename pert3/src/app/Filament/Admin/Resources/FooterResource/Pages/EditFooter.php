<?php

namespace App\Filament\Admin\Resources\FooterResource\Pages;

use App\Filament\Admin\Resources\FooterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFooter extends EditRecord
{
    protected static string $resource = FooterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
