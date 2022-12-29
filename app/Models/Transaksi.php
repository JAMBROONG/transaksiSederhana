<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['pembeli_id', 'barang_id', 'jumlah', 'total', 'snap_token', 'status', 'created_at', 'updated_at'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class);
    }
}
