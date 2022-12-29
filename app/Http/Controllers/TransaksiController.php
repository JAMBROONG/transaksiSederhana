<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembeli;
use App\Models\Transaksi;
use Carbon\Carbon;
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

    // Config
    public function payment(Request $req)
    {
        $id = $req->id;
        $gross_amount = $req->gross_amount;
        $first_name = $req->nama;
        $snap_token = $req->snap_token;

        if ($snap_token) {
            return response()->json($snap_token);
        }

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-sEzT0WgHUF5kuiFGhy0PL6_g';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $id,
                'gross_amount' => $gross_amount,
            ),
            'customer_details' => array(
                'first_name' => $first_name,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        Transaksi::findOrFail($id)->update([
            'snap_token' => $snapToken
        ]);

        // Mengirim respone
        return response()->json($snapToken);
    }
}
