<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModulUtama\PenjualanController;

Route::prefix('penjualan')->controller(PenjualanController::class)->group(function () {
    // Permintaan Penjualan
    Route::get('permintaan', 'indexPermintaan')->name('permintaanpenjualan.index');
    Route::get('permintaan/create', 'createPermintaan')->name('permintaanpenjualan.create');
    Route::post('permintaan', 'storePermintaan')->name('permintaanpenjualan.store');
    Route::get('permintaan/{id}/edit', 'editPermintaan')->name('permintaanpenjualan.edit');
    Route::put('permintaan/{id}', 'updatePermintaan')->name('permintaanpenjualan.update');
    Route::delete('permintaan/{id}', 'destroyPermintaan')->name('permintaanpenjualan.destroy');

    // Pesanan Penjualan
    Route::get('pesanan', 'indexPesanan')->name('pesananpenjualan.index');
    Route::get('pesanan/create', 'createPesanan')->name('pesananpenjualan.create');
    Route::post('pesanan', 'storePesanan')->name('pesananpenjualan.store');
    Route::get('pesanan/{id}/edit', 'editPesanan')->name('pesananpenjualan.edit');
    Route::put('pesanan/{id}', 'updatePesanan')->name('pesananpenjualan.update');
    Route::delete('pesanan/{id}', 'destroyPesanan')->name('pesananpenjualan.destroy');

    // Pengiriman Barang
    Route::get('pengiriman', 'indexPengiriman')->name('pengirimanpenjualan.index');
    Route::get('pengiriman/create', 'createPengiriman')->name('pengirimanpenjualan.create');
    Route::post('pengiriman', 'storePengiriman')->name('pengirimanpenjualan.store');
    Route::get('pengiriman/{id}/edit', 'editPengiriman')->name('pengirimanpenjualan.edit');
    Route::put('pengiriman/{id}', 'updatePengiriman')->name('pengirimanpenjualan.update');
    Route::delete('pengiriman/{id}', 'destroyPengiriman')->name('pengirimanpenjualan.destroy');

    // Faktur Penjualan
    Route::get('faktur', 'indexFaktur')->name('fakturpenjualan.index');
    Route::get('faktur/create', 'createFaktur')->name('fakturpenjualan.create');
    Route::post('faktur', 'storeFaktur')->name('fakturpenjualan.store');
    Route::get('faktur/{id}/edit', 'editFaktur')->name('fakturpenjualan.edit');
    Route::put('faktur/{id}', 'updateFaktur')->name('fakturpenjualan.update');
    Route::delete('faktur/{id}', 'destroyFaktur')->name('fakturpenjualan.destroy');

    // Pembayaran Penjualan
    Route::get('pembayaran', 'indexPembayaran')->name('pembayaranpenjualan.index');
    Route::get('pembayaran/create', 'createPembayaran')->name('pembayaranpenjualan.create');
    Route::post('pembayaran', 'storePembayaran')->name('pembayaranpenjualan.store');
    Route::get('pembayaran/{id}/edit', 'editPembayaran')->name('pembayaranpenjualan.edit');
    Route::put('pembayaran/{id}', 'updatePembayaran')->name('pembayaranpenjualan.update');
    Route::delete('pembayaran/{id}', 'destroyPembayaran')->name('pembayaranpenjualan.destroy');

    // Retur Penjualan
    Route::get('retur', 'indexRetur')->name('returpenjualan.index');
    Route::get('retur/create', 'createRetur')->name('returpenjualan.create');
    Route::post('retur', 'storeRetur')->name('returpenjualan.store');
    Route::get('retur/{id}/edit', 'editRetur')->name('returpenjualan.edit');
    Route::put('retur/{id}', 'updateRetur')->name('returpenjualan.update');
    Route::delete('retur/{id}', 'destroyRetur')->name('returpenjualan.destroy');
});