<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Status;
use App\Models\DataPenyewaBot;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class MidtransController extends Controller
{
    public function form()
    {
        if (!Auth::guard('akun')->check()) {
            return redirect()->route('akun.login');
        }

        $products = Product::all();
        return view('auth.product-page', compact('products'));
    }

    public function token(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $product = Product::findOrFail($request->product_id);
        $orderId = 'TeamAnuBot MID-' . uniqid();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $product->price,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json(['token' => $snapToken]);
    }

    
    public function handleSuccess(Request $request)
    {
        $akun = Auth::guard('akun')->user();

        $product = Product::findOrFail($request->product_id);
        $product->increment('order');

        $midtrans = is_array($request->midtrans_result)
            ? $request->midtrans_result
            : json_decode($request->midtrans_result, true) ?? $request->all();

        // 1️⃣ Buat PaymentTransaction
        $transaction = PaymentTransaction::create([
            'akun_id'                => $akun->id, // ⬅️ Tambahkan ini!
            'product_id'             => $product->id,
            'midtrans_order_id'      => $midtrans['order_id'] ?? null,
            'midtrans_transaction_id'=> $midtrans['transaction_id'] ?? null,
            'amount'                 => $product->price,
            'currency'               => 'IDR',
            'payment_method'         => $midtrans['payment_type'] ?? null,
            'transaction_status'     => $midtrans['transaction_status'] ?? 'settlement',
            'transaction_time'       => $midtrans['transaction_time'] ?? now(),
            'settlement_time'        => now(),
            'expiry_time'            => now()->addDays(1),
            'raw_response'           => json_encode($midtrans),
        ]);

        // 2️⃣ Buat Status dan sambungkan dengan transaksi
        $status = Status::create([
            'akun_id'                => $akun->id,
            'nama'                   => $akun->name,
            'whatsapp_number'        => $akun->whatsapp_number,
            'subscription_type'      => strtolower($product->name) === 'official bot' ? 'official bot' : 'selfbot',
            'payment_status'         => 'approved',
            'payment_transaction_id' => $transaction->id,
            'price'                  => $product->price,
        ]);

        // 3️⃣ Buat DataPenyewaBot
        $waktuBeli = Carbon::now();
        $waktuHabis = $waktuBeli->copy()->addDays(30);

        $penyewa = DataPenyewaBot::create([
            'akun_id'     => $akun->id,
            'status_id'   => $status->id,
            'nama'        => $status->nama,
            'jenisbot'    => $status->subscription_type,
            'waktu_beli'  => $waktuBeli,
            'waktu_habis' => $waktuHabis,
        ]);

        return response()->json(['status' => 'success']);
    }
}