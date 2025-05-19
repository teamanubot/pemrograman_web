<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPenyewaBot extends Model
{
    use HasFactory;

    protected $table = 'data_penyewa_bots';

    protected $fillable = [
        'nama',
        'jenisbot',
        'waktu_beli',
        'waktu_habis',
        'status_id',
    ];

    /**
     * Relasi ke model Status.
     * Setiap penyewa bot berasal dari satu status.
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}