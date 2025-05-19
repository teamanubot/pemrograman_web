<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Client extends Model
{
    use HasFactory;

    protected static function boot() {
        parent::boot();

        static::creating(function ($client) {
            if(empty($client->api_token)) {
                $client->api_token = Str::random(10);
            }
        });
    }

    protected $table = 'clients';
    protected $fillable = [
        'name',
        'api_token'
    ];
    
    public function products() {
        return $this->hasMany(Product::class);
    }
}
