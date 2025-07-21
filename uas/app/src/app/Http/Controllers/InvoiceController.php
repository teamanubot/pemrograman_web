<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;

class InvoiceController extends Controller
{
    public function download($id)
    {
        $status = Status::with(['akun', 'penyewaBot'])->findOrFail($id);
        $penyewa = $status->penyewaBot;

        $waktu_beli = $penyewa?->waktu_beli
            ? Carbon::parse($penyewa->waktu_beli)->format('d M Y')
            : '-';

        $waktu_habis = $penyewa?->waktu_habis
            ? Carbon::parse($penyewa->waktu_habis)->format('d M Y')
            : '-';

        $pdf = Pdf::loadView('invoice', compact('status', 'waktu_beli', 'waktu_habis'));

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, "invoice {$status->nama} - {$status->id}.pdf", [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="invoice ' . $status->nama . ' - ' . $status->id . '.pdf"',
        ]);
    }
}