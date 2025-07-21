<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Status;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Daftar produk
        $products = [
            [
                'name' => 'Selfbot',
                'description' => 'A premium selfbot for LINE with advanced features.',
                'price' => 50000,
            ],
            [
                'name' => 'Official Bot',
                'description' => 'Subscription for the official LINE bot service.',
                'price' => 100000,
            ],
        ];

        // Loop & buat produk
        foreach ($products as $data) {
            // Hitung berapa status yang pakai subscription_type = nama produk
            $orderCount = Status::where('subscription_type', $data['name'])->count();

            Product::updateOrCreate(
                ['name' => $data['name']],
                [
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'order' => $orderCount,
                ]
            );
        }
    }
}