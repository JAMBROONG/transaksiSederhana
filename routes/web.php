<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/barang', [BarangController::class, 'index'])->name('barang');
Route::get('/pembeli', [PembeliController::class, 'index'])->name('pembeli');
Route::get('/tansaksi', [TransaksiController::class, 'index'])->name('transaksi');
Route::get('/tansaksi/add', [TransaksiController::class, 'add'])->name('addTransaksi');
Route::post('/tansaksi', [TransaksiController::class, 'store'])->name('storeTransaksi');
