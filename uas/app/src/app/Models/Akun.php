<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Akun extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $table = 'akuns'; // nama tabel
    protected $guard = 'akun';  // guard kustom

    protected $fillable = [
        'name',
        'email',
        'whatsapp_number',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }
}
