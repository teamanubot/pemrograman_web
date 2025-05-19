<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Status;
use App\Models\DataPenyewaBot;

class CekStatus extends Component
{
    public $search;          // Satu input untuk ID atau nama
    public $status;          // Data status hasil pencarian
    public $subscription;    // Data penyewa bot terkait
    public $error;

    public function cek()
    {
        $this->reset(['status', 'subscription', 'error']);

        if (!$this->search) {
            $this->error = 'Harap isi ID atau nama untuk cek status.';
            return;
        }

        // Jika input hanya angka, anggap sebagai ID
        if (ctype_digit($this->search)) {
            $this->status = Status::find($this->search);

            if (!$this->status) {
                $this->error = "Data dengan ID {$this->search} tidak ditemukan.";
                return;
            }
        } else {
            // Jika ada huruf, anggap sebagai nama
            $this->status = Status::where('name', $this->search)->first();

            if (!$this->status) {
                $this->error = "Data dengan nama '{$this->search}' tidak ditemukan.";
                return;
            }
        }

        // Setelah status ditemukan, cek payment_status
        if ($this->status->payment_status === 'approved') {
            $this->subscription = DataPenyewaBot::where('status_id', $this->status->id)
                ->where('jenisbot', $this->status->subscription_type)
                ->first();

            if (!$this->subscription) {
                $this->error = 'Data penyewa bot tidak ditemukan.';
            }
        } else {
            $this->error = 'Status pembayaran belum disetujui.';
        }
    }

    public function render()
    {
        return view('livewire.cek-status');
    }
}