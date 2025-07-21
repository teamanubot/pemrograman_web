<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;
use App\Models\Akun;
use App\Models\Product;
use App\Models\PaymentTransaction;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $subscriptionTypes = ['official bot', 'selfbot'];
        $paymentStatuses = ['approved', 'pending', 'rejected'];

        $akunList = Akun::all();
        $products = Product::all();

        foreach ($akunList as $akun) {
            $subscriptionType = fake()->randomElement($subscriptionTypes);
            $paymentStatus = fake()->randomElement($paymentStatuses);

            // Ambil produk acak
            $product = $products->random();
            $price = $product->price;

            // Simulasi waktu transaksi
            $now = Carbon::now();

            // Buat data payment transaction
            $transaction = PaymentTransaction::create([
                'akun_id' => $akun->id,
                'product_id' => $product->id,
                'midtrans_order_id' => 'TeamAnuBot MID-' . Str::uuid(),
                'midtrans_transaction_id' => fake()->uuid(),
                'amount' => $paymentStatus === 'rejected' ? 0 : $price,
                'currency' => 'IDR',
                'payment_method' => fake()->randomElement(['qris', 'bca', 'bni']),
                'transaction_status' => $paymentStatus,
                'transaction_time' => $now,
                'settlement_time' => $paymentStatus === 'approved' ? $now->copy()->addMinutes(5) : null,
                'expiry_time' => $now->copy()->addHours(1),
                'raw_response' => json_encode(['fake' => 'response']),
            ]);

            // Buat status dan hubungkan ke transaksi
            Status::create([
                'akun_id' => $akun->id,
                'nama' => $akun->name,
                'whatsapp_number' => $akun->whatsapp_number,
                'subscription_type' => $subscriptionType,
                'payment_status' => $paymentStatus,
                'payment_transaction_id' => $transaction->id,
                'price' => $transaction->amount,
            ]);
        }
    }
}