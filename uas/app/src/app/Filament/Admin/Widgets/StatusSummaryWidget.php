<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Status;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatusSummaryWidget extends BaseWidget
{
    protected ?string $heading = 'Ringkasan Status Pembayaran';

    protected function getCards(): array
    {
        $totalPendapatan = Status::where('payment_status', 'approved')->sum('price');
        $approvedCount = Status::where('payment_status', 'approved')->count();
        $pendingCount = Status::where('payment_status', 'pending')->count();
        $rejectedCount = Status::where('payment_status', 'rejected')->count();
        $totalLangganan = Status::count();

        return [
            Card::make('Total Pendapatan', 'Rp ' . number_format($totalPendapatan, 0, ',', '.')),
            Card::make('Approved', $approvedCount),
            Card::make('Pending', $pendingCount),
            Card::make('Rejected', $rejectedCount),
            Card::make('Total Berlangganan', $totalLangganan),
        ];
    }
}