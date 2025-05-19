<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModulUtama\PenjualanController;

Route::prefix('penjualan')->controller(PenjualanController::class)->group(function () {

    Route::prefix('fetch')->group(function () {
        Route::get('penawaran', 'fetchPenawaran')->name('penjualan.penawaran.fetch');
        Route::get('pesanan', 'fetchPesanan')->name('penjualan.pesanan.fetch');
        Route::get('pengiriman', 'fetchPengiriman')->name('penjualan.pengiriman.fetch');
        Route::get('faktur-penjualan', 'fetchFakturPenjualan')->name('penjualan.fakturpenjualan.fetch');
        Route::get('faktur-penagihan', 'fetchFakturPenagihan')->name('penjualan.fakturpenagihan.fetch');
        Route::get('penerimaan', 'fetchPenerimaan')->name('penjualan.penerimaan.fetch');
        Route::get('retur', 'fetchRetur')->name('penjualan.retur.fetch');
    });
    // Penawaran Penjualan
    Route::get('penawaran', 'indexPenawaran')->name('penjualan.penawaran.index');
    Route::get('penawaran/create', 'createPenawaran')->name('penjualan.penawaran.create');
    Route::post('penawaran', 'storePenawaran')->name('penjualan.penawaran.store');
    Route::get('penawaran/{id}/edit', 'editPenawaran')->name('penjualan.penawaran.edit');
    Route::put('penawaran/{id}', 'updatePenawaran')->name('penjualan.penawaran.update');
    Route::delete('penawaran/{id}', 'destroyPenawaran')->name('penjualan.penawaran.destroy');

    // Pesanan Penjualan
    Route::get('pesanan', 'indexPesanan')->name('penjualan.pesanan.index');
    Route::get('pesanan/create', 'createPesanan')->name('penjualan.pesanan.create');
    Route::post('pesanan', 'storePesanan')->name('penjualan.pesanan.store');
    Route::get('pesanan/{id}/edit', 'editPesanan')->name('penjualan.pesanan.edit');
    Route::put('pesanan/{id}', 'updatePesanan')->name('penjualan.pesanan.update');
    Route::delete('pesanan/{id}', 'destroyPesanan')->name('penjualan.pesanan.destroy');

    // Pengiriman Penjualan
    Route::get('pengiriman', 'indexPengiriman')->name('penjualan.pengiriman.index');
    Route::get('pengiriman/create', 'createPengiriman')->name('penjualan.pengiriman.create');
    Route::post('pengiriman', 'storePengiriman')->name('penjualan.pengiriman.store');
    Route::get('pengiriman/{id}/edit', 'editPengiriman')->name('penjualan.pengiriman.edit');
    Route::put('pengiriman/{id}', 'updatePengiriman')->name('penjualan.pengiriman.update');
    Route::delete('pengiriman/{id}', 'destroyPengiriman')->name('penjualan.pengiriman.destroy');

    // Faktur Penjualan
    Route::get('faktur-penjualan', 'indexFakturPenjualan')->name('penjualan.fakturpenjualan.index');
    Route::get('faktur-penjualan/create', 'createFakturPenjualan')->name('penjualan.fakturpenjualan.create');
    Route::post('faktur-penjualan', 'storeFakturPenjualan')->name('penjualan.fakturpenjualan.store');
    Route::get('faktur-penjualan/{id}/edit', 'editFakturPenjualan')->name('penjualan.fakturpenjualan.edit');
    Route::put('faktur-penjualan/{id}', 'updateFakturPenjualan')->name('penjualan.fakturpenjualan.update');
    Route::delete('faktur-penjualan/{id}', 'destroyFakturPenjualan')->name('penjualan.fakturpenjualan.destroy');

    // Faktur Penagihan
    Route::get('faktur-penagihan', 'indexFakturPenagihan')->name('penjualan.fakturpenagihan.index');
    Route::get('faktur-penagihan/create', 'createFakturPenagihan')->name('penjualan.fakturpenagihan.create');
    Route::post('faktur-penagihan', 'storeFakturPenagihan')->name('penjualan.fakturpenagihan.store');
    Route::get('faktur-penagihan/{id}/edit', 'editFakturPenagihan')->name('penjualan.fakturpenagihan.edit');
    Route::put('faktur-penagihan/{id}', 'updateFakturPenagihan')->name('penjualan.fakturpenagihan.update');
    Route::delete('faktur-penagihan/{id}', 'destroyFakturPenagihan')->name('penjualan.fakturpenagihan.destroy');

    // Penerimaan Pembayaran
    Route::get('penerimaan', 'indexPenerimaan')->name('penjualan.penerimaan.index');
    Route::get('penerimaan/create', 'createPenerimaan')->name('penjualan.penerimaan.create');
    Route::post('penerimaan', 'storePenerimaan')->name('penjualan.penerimaan.store');
    Route::get('penerimaan/{id}/edit', 'editPenerimaan')->name('penjualan.penerimaan.edit');
    Route::put('penerimaan/{id}', 'updatePenerimaan')->name('penjualan.penerimaan.update');
    Route::delete('penerimaan/{id}', 'destroyPenerimaan')->name('penjualan.penerimaan.destroy');

    // Retur Penjualan
    Route::get('retur', 'indexRetur')->name('penjualan.retur.index');
    Route::get('retur/create', 'createRetur')->name('penjualan.retur.create');
    Route::post('retur', 'storeRetur')->name('penjualan.retur.store');
    Route::get('retur/{id}/edit', 'editRetur')->name('penjualan.retur.edit');
    Route::put('retur/{id}', 'updateRetur')->name('penjualan.retur.update');
    Route::delete('retur/{id}', 'destroyRetur')->name('penjualan.retur.destroy');
});
