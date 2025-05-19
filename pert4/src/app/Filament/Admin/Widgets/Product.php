<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Product as ModelsProduct;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Product extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total of product', ModelsProduct::count())
                ->description('Total of product')
                ->icon('heroicon-o-shopping-bag')
                ->color('danger')
        ];
    }
}
