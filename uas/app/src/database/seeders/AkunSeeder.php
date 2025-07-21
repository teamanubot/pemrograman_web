<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Akun;
use Illuminate\Support\Facades\Hash;

class AkunSeeder extends Seeder
{
    public function run(): void
    {
        $akunList = [
            ['name' => 'Rivai', 'email' => 'rivaimunthe02@gmail.com', 'whatsapp_number' => '081297355541'],
            ['name' => 'Ahmad Ramadhan', 'email' => 'ahmad@example.com', 'whatsapp_number' => '081234567890'],
            ['name' => 'Sarah Intan', 'email' => 'sarah@example.com', 'whatsapp_number' => '089876543210'],
            ['name' => 'Dina Fauziah', 'email' => 'dina@example.com', 'whatsapp_number' => '082111223344'],
            ['name' => 'Budi Santoso', 'email' => 'budi@example.com', 'whatsapp_number' => '085700112233'],
            ['name' => 'Siti Aminah', 'email' => 'siti@example.com', 'whatsapp_number' => '088812345678'],
            ['name' => 'Rudi Hartono', 'email' => 'rudi@example.com', 'whatsapp_number' => '081234512345'],
            ['name' => 'Intan Permata', 'email' => 'intan@example.com', 'whatsapp_number' => '087700998877'],
            ['name' => 'Andi Wijaya', 'email' => 'andi@example.com', 'whatsapp_number' => '089900112211'],
            ['name' => 'Tari Nurhaliza', 'email' => 'tari@example.com', 'whatsapp_number' => '081800334455'],
            ['name' => 'Rangga Saputra', 'email' => 'rangga@example.com', 'whatsapp_number' => '082222334455'],
            ['name' => 'Nadia Rahma', 'email' => 'nadia@example.com', 'whatsapp_number' => '085677889900'],
            ['name' => 'Fikri Maulana', 'email' => 'fikri@example.com', 'whatsapp_number' => '081566778899'],
            ['name' => 'Zahra Lestari', 'email' => 'zahra@example.com', 'whatsapp_number' => '087766554433'],
            ['name' => 'Dimas Aditya', 'email' => 'dimas@example.com', 'whatsapp_number' => '085511223344'],
            ['name' => 'Yuni Kartika', 'email' => 'yuni@example.com', 'whatsapp_number' => '089822334455'],
            ['name' => 'Ilham Pratama', 'email' => 'ilham@example.com', 'whatsapp_number' => '082144556677'],
            ['name' => 'Raisa Andriana', 'email' => 'raisa@example.com', 'whatsapp_number' => '081299887766'],
            ['name' => 'Galang Nugroho', 'email' => 'galang@example.com', 'whatsapp_number' => '087844332211'],
            ['name' => 'Anisa Putri', 'email' => 'anisa@example.com', 'whatsapp_number' => '088899776655'],
        ];

        foreach ($akunList as $akun) {
            Akun::updateOrCreate(
                ['email' => $akun['email']],
                [
                    'name' => $akun['name'],
                    'whatsapp_number' => $akun['whatsapp_number'],
                    'password' => Hash::make('password'), // default password
                ]
            );
        }
    }
}