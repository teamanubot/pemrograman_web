<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses';

    protected $fillable = [
        'akun_id',
        'nama',
        'whatsapp_number',
        'subscription_type',
        'payment_status',
        'payment_transaction_id',
        'price',
    ];

    protected static function booted()
    {
        static::updated(function ($status) {
            if ($status->isDirty('payment_status') && $status->payment_status === 'approved') {
                $waktuBeli = now();
                $waktuHabis = $waktuBeli->copy()->addDays(30);

                \App\Models\DataPenyewaBot::updateOrCreate(
                    ['status_id' => $status->id],
                    [
                        'akun_id' => $status->akun_id,
                        'nama' => $status->nama,
                        'jenisbot' => $status->subscription_type,
                        'waktu_beli' => $waktuBeli,
                        'waktu_habis' => $waktuHabis,
                    ]
                );
            }
        });
    }


    /**
     * Relasi ke data penyewa bot.
     */
    public function penyewaBot()
    {
        return $this->hasOne(DataPenyewaBot::class, 'status_id');
    }

    /**
     * Akses URL bukti pembayaran.
     */
    public function getPaymentProofUrlAttribute()
    {
        return $this->payment_proof ? asset('storage/' . $this->payment_proof) : null;
    }

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }

    public function paymentTransaction()
    {
        return $this->belongsTo(PaymentTransaction::class);
    }
}