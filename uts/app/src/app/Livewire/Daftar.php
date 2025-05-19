<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Models\Status;

class Daftar extends Component
{
    use WithFileUploads;

    public $name;
    public $whatsapp_number;
    public $subscription_type;
    public $payment_proof;

    protected function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('statuses', 'name'), // validasi unik nama
            ],
            'whatsapp_number' => 'required|string|max:20',
            'subscription_type' => ['required', Rule::in(['selfbot', 'official bot'])],
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }

    public function submit()
    {
        $this->validate();

        $path = $this->payment_proof->store('payment_proofs', 'public');

        $status = Status::create([
            'name' => $this->name,
            'whatsapp_number' => $this->whatsapp_number,
            'subscription_type' => $this->subscription_type,
            'payment_status' => 'pending',
            'payment_proof' => $path,
        ]);

        session()->flash('success', "Data berhasil dikirim. ID Anda: {$status->id}. Silakan tunggu verifikasi.");

        $this->reset(['name', 'whatsapp_number', 'subscription_type', 'payment_proof']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.daftar');
    }
}