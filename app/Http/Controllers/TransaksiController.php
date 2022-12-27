<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembeli;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = Transaksi::all();
        return view('transaksi', compact('data'));
    }

    public function add()
    {
        $pembeli = Pembeli::all();
        $barang = Barang::all();
        return view('tansaksiAdd', compact('pembeli', 'barang'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'pembeli' => 'required',
            'barang' => 'required',
            'jumlah' => 'required',
        ]);
        $pembeli = Pembeli::find($req->pembeli);
        $barang = Barang::find($req->barang);
        DB::transaction(function () use ($req, $pembeli, $barang) {
            Transaksi::create([
                'pembeli_id' => $req->pembeli,
                'barang_id' => $req->barang,
                'jumlah' => $req->jumlah,
                'total' => $req->jumlah * $barang->harga,
            ]);
            $barang->stok = $barang->stok - $req->jumlah;
            $barang->save();
            $pembeli->saldo = ($pembeli->saldo) - ($req->jumlah * $barang->harga);
            $pembeli->save();
        });

        return redirect()->route('transaksi')->with('success', 'Transaksi Berhasil!');
    }
}
