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
        $approvedStatuses = Status::where('payment_status', 'approved')->get();

        foreach ($approvedStatuses as $status) {
            $waktuBeli = Carbon::now();
            $waktuHabis = $waktuBeli->copy()->addDays(30);

            DataPenyewaBot::create([
                'status_id'    => $status->id,
                'nama'         => $status->name,
                'jenisbot'     => $status->subscription_type,
                'waktu_beli'   => $waktuBeli,
                'waktu_habis'  => $waktuHabis,
            ]);
        }
    }
}
