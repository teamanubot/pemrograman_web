<?php

namespace App\Filament\Admin\Resources\PageConfigResource\Pages;

use App\Filament\Admin\Resources\PageConfigResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePageConfig extends CreateRecord
{
    protected static string $resource = PageConfigResource::class;
}
