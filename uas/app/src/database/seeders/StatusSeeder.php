<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;
use App\Models\Akun;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $sourcePath = public_path('front/images/BuktiTransfer.jpg');
        $destFilename = 'payment-proofs/' . Str::random(10) . '.jpg';
        Storage::disk('public')->put($destFilename, file_get_contents($sourcePath));

        $subscriptionTypes = ['official bot', 'selfbot'];
        $paymentStatuses = ['approved', 'pending', 'rejected'];

        $akunList = Akun::all();

        foreach ($akunList as $akun) {
            $subscriptionType = fake()->randomElement($subscriptionTypes);
            $paymentStatus = fake()->randomElement($paymentStatuses);

            $price = $subscriptionType === 'official bot' ? 100000 : 50000;

            Status::create([
                'akun_id' => $akun->id,
                'nama' => $akun->name,
                'whatsapp_number' => $akun->whatsapp_number,
                'subscription_type' => $subscriptionType,
                'payment_status' => $paymentStatus,
                'payment_proof' => $paymentStatus === 'rejected' ? null : $destFilename,
                'price' => $paymentStatus === 'rejected' ? 0 : $price,
            ]);
        }
    }
}
