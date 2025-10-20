<?php

use App\Exports\LayananExport;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
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
Route::delete('/layanan/hapus/{id_layanan}', [LayananController::class, 'destroy'])->name('layananDestroy');
Route::post('/layanan/import', [LayananController::class, 'import'])->name('layananImport');
Route::get('/layanan/export', [LayananController::class, 'exportExcel'])->name('layananExport');

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
Route::post('/transaksi/tambah', [TransaksiController::class, 'store'])->name('transaksiTambah');
Route::post('/transaksi/update/{id}', [TransaksiController::class, 'update'])->name('transaksiUpdate');
Route::delete('/transaksi/hapus/{id}', [TransaksiController::class, 'destroy'])->name('transaksiDestroy');
Route::post('/transaksi/import', [TransaksiController::class, 'import'])->name('TransaksiImport');
Route::get('/transaksi/export', [TransaksiController::class, 'exportExcel'])->name('transaksiExport');
Route::get('/transaksi/cetak/{id}', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');


Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
Route::get('/laporan/export', [LaporanController::class, 'exportExcel'])->name('LaporanExport');
