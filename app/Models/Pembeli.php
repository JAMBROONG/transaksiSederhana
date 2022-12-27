<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasFactory;

    protected $fillable = ['nana', 'saldo', 'created_at', 'updated_at'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
