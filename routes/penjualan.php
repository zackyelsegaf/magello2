<?php

use App\Livewire\Counter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModulUtama\PenjualanController;
use App\Http\Controllers\ModulUtama\Penjualan\ReturController;
use App\Http\Controllers\ModulUtama\Penjualan\FakturController;
use App\Http\Controllers\ModulUtama\Penjualan\PesananController;
use App\Http\Controllers\ModulUtama\Penjualan\PenawaranController;
use App\Http\Controllers\ModulUtama\Penjualan\PenerimaanController;
use App\Http\Controllers\ModulUtama\Penjualan\PengirimanController;
use App\Http\Controllers\ModulUtama\Penjualan\FakturPenagihanController;

Route::get('test', function(){
    
    return view('test.datapermintaan');
});

Route::prefix('modulutama')->group(function () {

    Route::prefix('penjualan')->group(function () {

        Route::prefix('penawaran')->controller(PenawaranController::class)->group(function () {
            Route::get('/', 'index')->name('penjualan.penawaran.index');
            Route::get('/create', 'create')->name('penjualan.penawaran.create');
            Route::post('/', 'store')->name('penjualan.penawaran.store');
            Route::get('/{id}/edit', 'edit')->name('penjualan.penawaran.edit');
            Route::put('/{id}', 'update')->name('penjualan.penawaran.update');
            Route::delete('/{id}', 'destroy')->name('penjualan.penawaran.destroy');
            Route::get('/fetch', 'fetch')->name('penjualan.penawaran.fetch');
        });

        Route::prefix('pesanan')->controller(PesananController::class)->group(function () {
            Route::get('/', 'index')->name('penjualan.pesanan.index');
            Route::get('/create', 'create')->name('penjualan.pesanan.create');
            Route::post('/', 'store')->name('penjualan.pesanan.store');
            Route::get('/{id}/edit', 'edit')->name('penjualan.pesanan.edit');
            Route::put('/{id}', 'update')->name('penjualan.pesanan.update');
            Route::delete('/{id}', 'destroy')->name('penjualan.pesanan.destroy');
            Route::get('/fetch', 'fetch')->name('penjualan.pesanan.fetch');
        });

        Route::prefix('pengiriman')->controller(PengirimanController::class)->group(function () {
            Route::get('/', 'index')->name('penjualan.pengiriman.index');
            Route::get('/create', 'create')->name('penjualan.pengiriman.create');
            Route::post('/', 'store')->name('penjualan.pengiriman.store');
            Route::get('/{id}/edit', 'edit')->name('penjualan.pengiriman.edit');
            Route::put('/{id}', 'update')->name('penjualan.pengiriman.update');
            Route::delete('/{id}', 'destroy')->name('penjualan.pengiriman.destroy');
            Route::get('/fetch', 'fetch')->name('penjualan.pengiriman.fetch');
        });

        Route::prefix('faktur-penjualan')->controller(FakturController::class)->group(function () {
            Route::get('/', 'index')->name('penjualan.fakturpenjualan.index');
            Route::get('/create', 'create')->name('penjualan.fakturpenjualan.create');
            Route::post('/', 'store')->name('penjualan.fakturpenjualan.store');
            Route::get('/{id}/edit', 'edit')->name('penjualan.fakturpenjualan.edit');
            Route::put('/{id}', 'update')->name('penjualan.fakturpenjualan.update');
            Route::delete('/{id}', 'destroy')->name('penjualan.fakturpenjualan.destroy');
            Route::get('/fetch', 'fetch')->name('penjualan.fakturpenjualan.fetch');
        });

        Route::prefix('faktur-penagihan')->controller(FakturPenagihanController::class)->group(function () {
            Route::get('/', 'index')->name('penjualan.fakturpenagihan.index');
            Route::get('/create', 'create')->name('penjualan.fakturpenagihan.create');
            Route::post('/', 'store')->name('penjualan.fakturpenagihan.store');
            Route::get('/{id}/edit', 'edit')->name('penjualan.fakturpenagihan.edit');
            Route::put('/{id}', 'update')->name('penjualan.fakturpenagihan.update');
            Route::delete('/{id}', 'destroy')->name('penjualan.fakturpenagihan.destroy');
            Route::get('/fetch', 'fetch')->name('penjualan.fakturpenagihan.fetch');
        });

        Route::prefix('penerimaan')->controller(PenerimaanController::class)->group(function () {
            Route::get('/', 'index')->name('penjualan.penerimaan.index');
            Route::get('/create', 'create')->name('penjualan.penerimaan.create');
            Route::post('/', 'store')->name('penjualan.penerimaan.store');
            Route::get('/{id}/edit', 'edit')->name('penjualan.penerimaan.edit');
            Route::put('/{id}', 'update')->name('penjualan.penerimaan.update');
            Route::delete('/{id}', 'destroy')->name('penjualan.penerimaan.destroy');
            Route::get('/fetch', 'fetch')->name('penjualan.penerimaan.fetch');
        });

        Route::prefix('retur')->controller(ReturController::class)->group(function () {
            Route::get('/', 'index')->name('penjualan.retur.index');
            Route::get('/create', 'create')->name('penjualan.retur.create');
            Route::post('/', 'store')->name('penjualan.retur.store');
            Route::get('/{id}/edit', 'edit')->name('penjualan.retur.edit');
            Route::put('/{id}', 'update')->name('penjualan.retur.update');
            Route::delete('/{id}', 'destroy')->name('penjualan.retur.destroy');
            Route::get('/fetch', 'fetch')->name('penjualan.retur.fetch');
        });

    });

});

// Route::prefix('penjualan')->controller(PenjualanController::class)->group(function () {

//     Route::prefix('fetch')->group(function () {
//         Route::get('penawaran', 'fetchPenawaran')->name('penjualan.penawaran.fetch');
//         Route::get('pesanan', 'fetchPesanan')->name('penjualan.pesanan.fetch');
//         Route::get('pengiriman', 'fetchPengiriman')->name('penjualan.pengiriman.fetch');
//         Route::get('faktur-penjualan', 'fetchFakturPenjualan')->name('penjualan.fakturpenjualan.fetch');
//         Route::get('faktur-penagihan', 'fetchFakturPenagihan')->name('penjualan.fakturpenagihan.fetch');
//         Route::get('penerimaan', 'fetchPenerimaan')->name('penjualan.penerimaan.fetch');
//         Route::get('retur', 'fetchRetur')->name('penjualan.retur.fetch');
//     });

//     Route::prefix('store')->group(function () {
//         Route::get('penawaran', 'storePenawaran')->name('penjualan.penawaran.store');
//         Route::get('pesanan', 'storePesanan')->name('penjualan.pesanan.store');
//         Route::get('pengiriman', 'storePengiriman')->name('penjualan.pengiriman.store');
//         Route::get('faktur-penjualan', 'storeFakturPenjualan')->name('penjualan.fakturpenjualan.store');
//         Route::get('faktur-penagihan', 'storeFakturPenagihan')->name('penjualan.fakturpenagihan.store');
//         Route::get('penerimaan', 'storePenerimaan')->name('penjualan.penerimaan.store');
//         Route::get('retur', 'storeRetur')->name('penjualan.retur.store');
//     });
//     // Penawaran Penjualan
//     Route::get('penawaran', 'indexPenawaran')->name('penjualan.penawaran.index');
//     Route::get('penawaran/create', 'createPenawaran')->name('penjualan.penawaran.create');
//     Route::post('penawaran', 'storePenawaran')->name('penjualan.penawaran.store');
//     Route::get('penawaran/{id}/edit', 'editPenawaran')->name('penjualan.penawaran.edit');
//     Route::put('penawaran/{id}', 'updatePenawaran')->name('penjualan.penawaran.update');
//     Route::delete('penawaran/{id}', 'destroyPenawaran')->name('penjualan.penawaran.destroy');

//     // Pesanan Penjualan
//     Route::get('pesanan', 'indexPesanan')->name('penjualan.pesanan.index');
//     Route::get('pesanan/create', 'createPesanan')->name('penjualan.pesanan.create');
//     Route::post('pesanan', 'storePesanan')->name('penjualan.pesanan.store');
//     Route::get('pesanan/{id}/edit', 'editPesanan')->name('penjualan.pesanan.edit');
//     Route::put('pesanan/{id}', 'updatePesanan')->name('penjualan.pesanan.update');
//     Route::delete('pesanan/{id}', 'destroyPesanan')->name('penjualan.pesanan.destroy');

//     // Pengiriman Penjualan
//     Route::get('pengiriman', 'indexPengiriman')->name('penjualan.pengiriman.index');
//     Route::get('pengiriman/create', 'createPengiriman')->name('penjualan.pengiriman.create');
//     Route::post('pengiriman', 'storePengiriman')->name('penjualan.pengiriman.store');
//     Route::get('pengiriman/{id}/edit', 'editPengiriman')->name('penjualan.pengiriman.edit');
//     Route::put('pengiriman/{id}', 'updatePengiriman')->name('penjualan.pengiriman.update');
//     Route::delete('pengiriman/{id}', 'destroyPengiriman')->name('penjualan.pengiriman.destroy');

//     // Faktur Penjualan
//     Route::get('faktur-penjualan', 'indexFakturPenjualan')->name('penjualan.fakturpenjualan.index');
//     Route::get('faktur-penjualan/create', 'createFakturPenjualan')->name('penjualan.fakturpenjualan.create');
//     Route::post('faktur-penjualan', 'storeFakturPenjualan')->name('penjualan.fakturpenjualan.store');
//     Route::get('faktur-penjualan/{id}/edit', 'editFakturPenjualan')->name('penjualan.fakturpenjualan.edit');
//     Route::put('faktur-penjualan/{id}', 'updateFakturPenjualan')->name('penjualan.fakturpenjualan.update');
//     Route::delete('faktur-penjualan/{id}', 'destroyFakturPenjualan')->name('penjualan.fakturpenjualan.destroy');

//     // Faktur Penagihan
//     Route::get('faktur-penagihan', 'indexFakturPenagihan')->name('penjualan.fakturpenagihan.index');
//     Route::get('faktur-penagihan/create', 'createFakturPenagihan')->name('penjualan.fakturpenagihan.create');
//     Route::post('faktur-penagihan', 'storeFakturPenagihan')->name('penjualan.fakturpenagihan.store');
//     Route::get('faktur-penagihan/{id}/edit', 'editFakturPenagihan')->name('penjualan.fakturpenagihan.edit');
//     Route::put('faktur-penagihan/{id}', 'updateFakturPenagihan')->name('penjualan.fakturpenagihan.update');
//     Route::delete('faktur-penagihan/{id}', 'destroyFakturPenagihan')->name('penjualan.fakturpenagihan.destroy');

//     // Penerimaan Pembayaran
//     Route::get('penerimaan', 'indexPenerimaan')->name('penjualan.penerimaan.index');
//     Route::get('penerimaan/create', 'createPenerimaan')->name('penjualan.penerimaan.create');
//     Route::post('penerimaan', 'storePenerimaan')->name('penjualan.penerimaan.store');
//     Route::get('penerimaan/{id}/edit', 'editPenerimaan')->name('penjualan.penerimaan.edit');
//     Route::put('penerimaan/{id}', 'updatePenerimaan')->name('penjualan.penerimaan.update');
//     Route::delete('penerimaan/{id}', 'destroyPenerimaan')->name('penjualan.penerimaan.destroy');

//     // Retur Penjualan
//     Route::get('retur', 'indexRetur')->name('penjualan.retur.index');
//     Route::get('retur/create', 'createRetur')->name('penjualan.retur.create');
//     Route::post('retur', 'storeRetur')->name('penjualan.retur.store');
//     Route::get('retur/{id}/edit', 'editRetur')->name('penjualan.retur.edit');
//     Route::put('retur/{id}', 'updateRetur')->name('penjualan.retur.update');
//     Route::delete('retur/{id}', 'destroyRetur')->name('penjualan.retur.destroy');

//     // Route::get('test-livewire', Counter::class)->name('test-livewire');
// });

