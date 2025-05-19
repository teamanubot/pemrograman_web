<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Product::count()==0) {
            Product::create([
                'name' => 'Sepatu',
                'description' => 'Adidas',
                'image' => '',
            ]);
        }
    }
}
