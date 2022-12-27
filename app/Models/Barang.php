<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['nm_barang', 'harga', 'stok', 'created_at', 'updated_at'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
