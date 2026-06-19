<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DetailPembelianController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\DetailBarangController;


Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/tes-role', function () {
    return 'Middleware berhasil';
})->middleware(['auth', 'role:pemilik']);


// ========== ROUTE UNTUK SEMUA USER YANG LOGIN ==========
Route::middleware(['auth'])->group(function () {
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('penjualan', PenjualanController::class);
    Route::resource('detail-penjualan', DetailPenjualanController::class);
});

// ========== ROUTE UNTUK PEMILIK (BISA SEMUA) ==========
Route::middleware(['auth', 'role:pemilik'])->group(function () {
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('bahanbaku', BahanBakuController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('pembelian', PembelianController::class);
    Route::resource('detail-pembelian', DetailPembelianController::class);
    Route::resource('detail-barang', DetailBarangController::class);
});