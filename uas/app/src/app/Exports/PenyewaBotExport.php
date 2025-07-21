<?php

namespace App\Exports;

use App\Models\DataPenyewaBot;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class PenyewaBotExport implements FromCollection, WithHeadings, WithColumnWidths
{
    public function collection()
    {
        return DataPenyewaBot::with(['akun', 'status'])->get()->map(function ($item) {
            return [
                'Nama Akun' => $item->akun->name ?? '-',
                'WhatsApp' => $item->akun->whatsapp_number ?? '-',
                'Nama Penyewa Bot' => $item->nama,
                'Jenis Bot' => $item->jenisbot,
                'Waktu Beli' => $item->waktu_beli ? date('Y-m-d H:i:s', strtotime($item->waktu_beli)) : '-',
                'Waktu Habis' => $item->waktu_habis ? date('Y-m-d H:i:s', strtotime($item->waktu_habis)) : '-',
                'Status Pembayaran' => $item->status->payment_status ?? '-',
                'Harga' => 'Rp ' . number_format($item->status->price ?? 0, 0, ',', '.'),
            ];
        }); 
    }

    public function headings(): array
    {
        return [
            'Nama Akun',
            'WhatsApp',
            'Nama Penyewa Bot',
            'Jenis Bot',
            'Waktu Beli',
            'Waktu Habis',
            'Status Pembayaran',
            'Harga',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 22,
            'B' => 22,
            'C' => 27,
            'D' => 17,
            'E' => 22,
            'F' => 22,
            'G' => 22,
            'H' => 17,
        ];
    }
}