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
use App\Http\Controllers\DetailBeliController;
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
    Route::resource('supplier', SupplierController::class);
    Route::resource('bahanbaku', BahanBakuController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('pembelian', PembelianController::class);
    
    // ========== DETAIL BARANG ==========
    Route::get('/detail-barang', [DetailBarangController::class, 'index'])->name('detail-barang.index');
    Route::get('/detail-barang/create', [DetailBarangController::class, 'create'])->name('detail-barang.create');
    Route::post('/detail-barang', [DetailBarangController::class, 'store'])->name('detail-barang.store');
    Route::get('/detail-barang/{no_barang}', [DetailBarangController::class, 'show'])->name('detail-barang.show');
    Route::get('/detail-barang/{id}/edit', [DetailBarangController::class, 'edit'])->name('detail-barang.edit');  
    Route::put('/detail-barang/{id}', [DetailBarangController::class, 'update'])->name('detail-barang.update');
    Route::get('/detail-barang/{no_barang}/cetak', [DetailBarangController::class, 'cetak'])->name('detail-barang.cetak');
    Route::delete('/detail-barang/{id}', [DetailBarangController::class, 'destroy'])->name('detail-barang.destroy');
});

// ========== UPDATE DP VIA AJAX ==========
Route::post('/penjualan/{no_jual}/update-dp', [PenjualanController::class, 'updateDp'])->name('penjualan.updateDp');

// ========== CETAK PENJUALAN ==========
Route::get('/penjualan/{no_jual}/cetak', [PenjualanController::class, 'cetak'])->name('penjualan.cetak');

// ========== DETAIL PENJUALAN ==========
Route::prefix('penjualan/{no_jual}')->name('detailpenjualan.')->group(function () {
    Route::get('/detailpenjualan/create', [DetailPenjualanController::class, 'create'])->name('create');
    Route::post('/detailpenjualan', [DetailPenjualanController::class, 'store'])->name('store');
    Route::get('/detailpenjualan/{no_barang}/edit', [DetailPenjualanController::class, 'edit'])->name('edit');
    Route::put('/detailpenjualan/{no_barang}', [DetailPenjualanController::class, 'update'])->name('update');
    Route::delete('/detailpenjualan/{no_barang}', [DetailPenjualanController::class, 'destroy'])->name('destroy');
});

// ========== DETAIL PEMBELIAN ==========
Route::prefix('pembelian/{no_beli}')->name('detailbeli.')->group(function () {
    Route::get('/detailbeli/create', [DetailBeliController::class, 'create'])->name('create');
    Route::post('/detailbeli', [DetailBeliController::class, 'store'])->name('store');
    Route::get('/detailbeli/{no_bahan}/edit', [DetailBeliController::class, 'edit'])->name('edit');
    Route::put('/detailbeli/{no_bahan}', [DetailBeliController::class, 'update'])->name('update');
    Route::delete('/detailbeli/{no_bahan}', [DetailBeliController::class, 'destroy'])->name('destroy');
});

// ========== ROUTE UNTUK PEMILIK ==========
Route::middleware(['auth', 'role:pemilik'])->group(function () {
    Route::resource('pegawai', PegawaiController::class);
});