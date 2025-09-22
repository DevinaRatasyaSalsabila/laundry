<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('main');
// });

Route::get('/', [BerandaController::class, 'index'])->name('beranda');

Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
Route::post('/layanan/tambah', [LayananController::class, 'store'])->name('layananTambah');
Route::post('/layanan/update/{id_layanan}', [LayananController::class, 'update'])->name('layananUpdate');

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
Route::post('/transaksi/tambah', [TransaksiController::class, 'store'])->name('transaksiTambah');
Route::post('/transaksi/update/{id}', [TransaksiController::class, 'update'])->name('transaksiUpdate');
