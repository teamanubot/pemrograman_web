<?php

namespace App\Filament\Admin\Widgets;

use App\Models\DataPenyewaBot;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class ActiveBotsLineChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Bot Aktif per Jenis Bot';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $now = Carbon::now();

        // Hitung jumlah bot aktif per jenis
        $selfbotCount = DataPenyewaBot::where('jenisbot', 'selfbot')
            ->where('waktu_beli', '<=', $now)
            ->where('waktu_habis', '>=', $now)
            ->count();

        $officialBotCount = DataPenyewaBot::where('jenisbot', 'official bot')
            ->where('waktu_beli', '<=', $now)
            ->where('waktu_habis', '>=', $now)
            ->count();

        return [
            'labels' => ['Selfbot', 'Official Bot'],
            'datasets' => [
                [
                    'label' => 'Bot Aktif',
                    'data' => [$selfbotCount, $officialBotCount],
                    'fill' => false,
                    'borderColor' => '#ef4444',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.4)',
                    'tension' => 0.3,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}