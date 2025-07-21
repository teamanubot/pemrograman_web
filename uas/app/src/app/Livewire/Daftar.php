<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Status;

class Daftar extends Component
{
    use WithFileUploads;

    public $name;
    public $whatsapp_number;
    public $subscription_type = '';
    public $payment_proof;
    public $price;
    public $showPopup = false;
    public $popupData = [];

    public function mount()
    {
        $akun = Auth::guard('akun')->user();

        if (!$akun) {
            session()->flash('error', 'Silakan login terlebih dahulu untuk mengecek status.');
            return redirect()->route('akun.login');
        }

        $this->name = $akun->name;
        $this->whatsapp_number = $akun->whatsapp_number;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:20',
            'subscription_type' => ['required', Rule::in(['selfbot', 'official bot'])],
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'price' => 'required|numeric|min:0',
        ];
    }

    public function submit()
    {
        $this->validate();

        $akun = Auth::guard('akun')->user();

        if (!$akun) {
            session()->flash('error', 'Silakan login terlebih dahulu.');
            return redirect()->route('akun.login');
        }

        // Simpan file bukti pembayaran
        $path = $this->payment_proof->store('payment_proofs', 'public');

        // Simpan data status
        $status = Status::create([
            'akun_id' => $akun->id,
            'nama' => $this->name,
            'whatsapp_number' => $this->whatsapp_number,
            'subscription_type' => $this->subscription_type,
            'payment_status' => 'pending',
            'payment_proof' => $path,
            'price' => (float) $this->price,
        ]);

        // Data untuk ditampilkan di popup sukses
        $this->popupData = [
            'id' => $status->id,
            'name' => $this->name,
            'whatsapp_number' => $this->whatsapp_number,
            'subscription_type' => $this->subscription_type,
            'payment_proof' => $path,
            'price' => $this->price,
        ];

        $this->showPopup = true;

        // Reset form kecuali nama, no WA, dan popup info
        $this->resetExcept('name', 'whatsapp_number', 'showPopup', 'popupData');
        $this->resetValidation();
    }


    public function render()
    {
        return view('livewire.daftar');
    }
}