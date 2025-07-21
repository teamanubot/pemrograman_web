<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Status;
use App\Models\DataPenyewaBot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CekStatus extends Component
{
    public $statuses = [];
    public $subscriptionData = [];
    public $error;

    public function mount()
    {
        $akun = Auth::guard('akun')->user();

        if (!$akun) {
            session()->flash('error', 'Silakan login terlebih dahulu.');
            return redirect()->route('akun.login');
        }

        // Ambil semua status milik akun
        $this->statuses = Status::with('paymentTransaction')
            ->where('akun_id', $akun->id)
            ->get();

        foreach ($this->statuses as $status) {
            if ($status->payment_status === 'approved') {
                $this->subscriptionData[$status->id] = DataPenyewaBot::where('status_id', $status->id)
                    ->where('jenisbot', $status->subscription_type)
                    ->first();
            }
        }

        if ($this->statuses->isEmpty()) {
            $this->error = 'Data status tidak ditemukan untuk akun ini.';
        }
    }

    private function normalisasiNomor($nomor)
    {
        $nomor = preg_replace('/[^0-9+]/', '', $nomor);

        if (strpos($nomor, '+62') === 0) {
            return '62' . substr($nomor, 3);
        }

        if (strpos($nomor, '08') === 0) {
            return '62' . substr($nomor, 1);
        }

        if (strpos($nomor, '62') === 0) {
            return $nomor;
        }

        return '';
    }

    public function kirimInvoice($id)
    {
        $status = $this->statuses->firstWhere('id', $id);
        $subscription = $this->subscriptionData[$id] ?? null;

        if (!$status || !$subscription || $status->payment_status !== 'approved') {
            $this->addError('error', 'Status belum valid atau belum disetujui.');
            return;
        }

        $akun = Auth::guard('akun')->user();

        if (!$akun || empty($akun->whatsapp_number)) {
            $this->addError('error', 'Nomor WhatsApp dari akun tidak tersedia.');
            return;
        }

        $nomor = $this->normalisasiNomor($akun->whatsapp_number);

        if (!preg_match('/^628[1-9][0-9]{7,11}$/', $nomor)) {
            $this->addError('error', 'Format nomor WhatsApp tidak valid. Gunakan format 628xxxxxxxxxx.');
            return;
        }

        $fileUrl = route('invoice.download', ['id' => $status->id]);

        $response = Http::withHeaders([
            config('services.whatsapp_api_key_header') => config('services.whatsapp_api_key'),
        ])->post(config('services.whatsapp_api_url'), [
            'number'  => $nomor,
            'message' => "Halo {$akun->name}, berikut invoice kamu dari TeamAnuBot.",
            'fileUrl' => $fileUrl,
        ]);

        if ($response->successful()) {
            session()->flash('message', '✅ Invoice berhasil dikirim ke WhatsApp.');
        } else {
            logger()->error('❌ WhatsApp API Error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            $this->addError('error', 'Gagal kirim invoice ke WhatsApp: ' . $response->body());
        }
    }

    public function render()
    {
        return view('livewire.cek-status');
    }
}