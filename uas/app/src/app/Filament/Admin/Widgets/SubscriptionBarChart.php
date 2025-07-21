<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Product;

class SubscriptionBarChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Jumlah Berlangganan Per Subscription Type';

    protected function getData(): array
    {
        // Ambil semua produk dan urutkan berdasarkan nama atau sesuai kebutuhan
        $products = Product::orderBy('name')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Berlangganan',
                    'data' => $products->pluck('order')->toArray(), // pakai kolom 'order'
                ],
            ],
            'labels' => $products->pluck('name')->toArray(), // nama produk jadi label
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}