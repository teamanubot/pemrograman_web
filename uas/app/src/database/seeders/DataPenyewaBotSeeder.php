<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;
use App\Models\DataPenyewaBot;
use Illuminate\Support\Carbon;

class DataPenyewaBotSeeder extends Seeder
{
    public function run(): void
    {
        $approvedStatuses = Status::with('akun')->where('payment_status', 'approved')->get();

        foreach ($approvedStatuses as $status) {
            $waktuBeli = Carbon::now();
            $waktuHabis = $waktuBeli->copy()->addDays(30);

            DataPenyewaBot::create([
                'akun_id'     => $status->akun_id,
                'status_id'   => $status->id,
                'nama'        => $status->nama,
                'jenisbot'    => $status->subscription_type,
                'waktu_beli'  => $waktuBeli,
                'waktu_habis' => $waktuHabis,
            ]);
        }
    }
}