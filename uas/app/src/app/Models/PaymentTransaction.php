<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    protected $fillable = [
        'akun_id',
        'product_id',
        'midtrans_order_id',
        'midtrans_transaction_id',
        'amount',
        'currency',
        'payment_method',
        'transaction_status',
        'transaction_time',
        'settlement_time',
        'expiry_time',
        'raw_response',
    ];

    public function status()
    {
        return $this->hasOne(Status::class);
    }
    
    public function akun()
    {
        return $this->belongsTo(\App\Models\Akun::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }
}