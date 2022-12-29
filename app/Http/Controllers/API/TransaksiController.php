<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function handle()
    {
        
        // require_once(dirname(__FILE__) . '/Midtrans.php');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$serverKey = 'SB-Mid-server-sEzT0WgHUF5kuiFGhy0PL6_g';
        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            Transaksi::findOrFail($order_id)->update([
                'status' => 1
            ]);
        } 
    }
}
