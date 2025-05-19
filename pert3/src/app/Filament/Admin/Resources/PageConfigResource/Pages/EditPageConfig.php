<?php

namespace App\Filament\Admin\Resources\PageConfigResource\Pages;

use App\Filament\Admin\Resources\PageConfigResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPageConfig extends EditRecord
{
    protected static string $resource = PageConfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
