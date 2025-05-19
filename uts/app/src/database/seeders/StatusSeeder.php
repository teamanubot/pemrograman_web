<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $sourcePath = public_path('front/images/BuktiTransfer.jpg');
        $destFilename = 'payment-proofs/' . Str::random(10) . '.jpg'; // nama acak supaya unik
        Storage::disk('public')->put($destFilename, file_get_contents($sourcePath));

        // Simpan ke database path sesuai disk public
        Status::create([
            'name' => 'Rivai',
            'whatsapp_number' => '081212566015',
            'subscription_type' => 'official bot',
            'payment_status' => 'approved',
            'payment_proof' => $destFilename, // tanpa public/storage, karena Filament pakai disk
        ]);

        Status::create([
            'name' => 'Ahmad Ramadhan',
            'whatsapp_number' => '081234567890',
            'subscription_type' => 'selfbot',
            'payment_status' => 'pending',
            'payment_proof' => $destFilename,
        ]);

        Status::create([
            'name' => 'Sarah Intan',
            'whatsapp_number' => '089876543210',
            'subscription_type' => 'official bot',
            'payment_status' => 'rejected',
            'payment_proof' => 'none',
        ]);
    }
}