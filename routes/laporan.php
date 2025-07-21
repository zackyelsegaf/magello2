<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanSemua;
use Illuminate\Support\Facades\Route;

Route::get('laporan/', function(){
    return view('laporan.semua');
})->name('laporan');
Route::controller(LaporanController::class)->group(function(){
    Route::get('laporan/penjualan', 'viewPenjualan')->name('laporan/penjualan');
    Route::get('laporan/pembelian', 'viewPembelian')->name('laporan/pembelian');
});
