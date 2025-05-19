<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        Status::create([
            'name' => 'Ahmad Ramadhan',
            'whatsapp_number' => '6281234567890',
            'subscription_type' => 'selfbot',
            'payment_status' => 'approved',
            'payment_proof' => 'none',
        ]);

        Status::create([
            'name' => 'Sarah Intan',
            'whatsapp_number' => '6289876543210',
            'subscription_type' => 'official bot',
            'payment_status' => 'pending',
            'payment_proof' => 'none',
        ]);
    }
}