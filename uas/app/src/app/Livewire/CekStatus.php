<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Status;
use App\Models\DataPenyewaBot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CekStatus extends Component
{
    public $search;
    public $statuses = []; // Mengganti $status menjadi array
    public $subscriptionData = [];
    public $error;

    public function mount()
    {
        if (!Auth::guard('akun')->check()) {
            session()->flash('error', 'Silakan login terlebih dahulu untuk mengecek status.');
            return redirect()->route('akun.login');
        }

        $akun = Auth::guard('akun')->user();

        // Ambil semua status dengan nama sesuai nama akun
        $this->statuses = Status::where('nama', $akun->name)->get();

        // Ambil semua subscription terkait status yang ditemukan
        foreach ($this->statuses as $status) {
            if ($status->payment_status === 'approved') {
                $sub = DataPenyewaBot::where('status_id', $status->id)
                    ->where('jenisbot', $status->subscription_type)
                    ->first();

                $this->subscriptionData[$status->id] = $sub;
            }
        }

        if ($this->statuses->isEmpty()) {
            $this->error = 'Data status tidak ditemukan untuk akun ini.';
        }
    }


    public function cek()
    {
        $this->reset(['status', 'subscription', 'error']);

        if (!$this->search) {
            $this->error = 'Harap isi ID atau nama untuk cek status.';
            return;
        }

        // Cari berdasarkan ID atau nama
        if (ctype_digit($this->search)) {
            $this->status = Status::find($this->search);
        } else {
            $this->status = Status::where('nama', $this->search)->first();
        }

        if (!$this->status) {
            $this->error = 'Data tidak ditemukan.';
            return;
        }

        if ($this->status->payment_status !== 'approved') {
            $this->error = 'Status pembayaran belum disetujui.';
            return;
        }

        $this->subscription = DataPenyewaBot::where('status_id', $this->status->id)
            ->where('jenisbot', $this->status->subscription_type)
            ->first();

        if (!$this->subscription) {
            $this->error = 'Data penyewa bot tidak ditemukan.';
        }
    }

    private function normalisasiNomor($nomor)
    {
        $nomor = preg_replace('/[^0-9+]/', '', $nomor); // Hanya izinkan angka dan +

        if (strpos($nomor, '+62') === 0) {
            return '62' . substr($nomor, 3); // +62xxxx → 62xxxx
        }

        if (strpos($nomor, '08') === 0) {
            return '62' . substr($nomor, 1); // 08xxxx → 628xxxx
        }

        if (strpos($nomor, '62') === 0) {
            return $nomor; // Sudah dalam format benar
        }

        return ''; // Format tidak valid
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