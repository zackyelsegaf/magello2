<?php

use App\Livewire\Counter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;


Route::get('test', function(){
    
    return view('test.datapermintaan');
});

// Route::prefix('modulutama')->group(function () {

//     Route::prefix('penjualan')->group(function () {

//         Route::prefix('penawaran')->controller(PenawaranController::class)->group(function () {
//             Route::get('/', 'index')->name('penjualan.penawaran.index');
//             Route::get('/create', 'create')->name('penjualan.penawaran.create');
//             Route::post('/', 'store')->name('penjualan.penawaran.store');
//             Route::get('/{id}/edit', 'edit')->name('penjualan.penawaran.edit');
//             Route::put('/{id}', 'update')->name('penjualan.penawaran.update');
//             Route::delete('/{id}', 'destroy')->name('penjualan.penawaran.destroy');
//             Route::get('/fetch', 'fetch')->name('penjualan.penawaran.fetch');
//         });

//         Route::prefix('pesanan')->controller(PesananController::class)->group(function () {
//             Route::get('/', 'index')->name('penjualan.pesanan.index');
//             Route::get('/create', 'create')->name('penjualan.pesanan.create');
//             Route::post('/', 'store')->name('penjualan.pesanan.store');
//             Route::get('/{id}/edit', 'edit')->name('penjualan.pesanan.edit');
//             Route::put('/{id}', 'update')->name('penjualan.pesanan.update');
//             Route::delete('/{id}', 'destroy')->name('penjualan.pesanan.destroy');
//             Route::get('/fetch', 'fetch')->name('penjualan.pesanan.fetch');
//         });

//         Route::prefix('pengiriman')->controller(PengirimanController::class)->group(function () {
//             Route::get('/', 'index')->name('penjualan.pengiriman.index');
//             Route::get('/create', 'create')->name('penjualan.pengiriman.create');
//             Route::post('/', 'store')->name('penjualan.pengiriman.store');
//             Route::get('/{id}/edit', 'edit')->name('penjualan.pengiriman.edit');
//             Route::put('/{id}', 'update')->name('penjualan.pengiriman.update');
//             Route::delete('/{id}', 'destroy')->name('penjualan.pengiriman.destroy');
//             Route::get('/fetch', 'fetch')->name('penjualan.pengiriman.fetch');
//         });

//         Route::prefix('faktur-penjualan')->controller(FakturController::class)->group(function () {
//             Route::get('/', 'index')->name('penjualan.fakturpenjualan.index');
//             Route::get('/create', 'create')->name('penjualan.fakturpenjualan.create');
//             Route::post('/', 'store')->name('penjualan.fakturpenjualan.store');
//             Route::get('/{id}/edit', 'edit')->name('penjualan.fakturpenjualan.edit');
//             Route::put('/{id}', 'update')->name('penjualan.fakturpenjualan.update');
//             Route::delete('/{id}', 'destroy')->name('penjualan.fakturpenjualan.destroy');
//             Route::get('/fetch', 'fetch')->name('penjualan.fakturpenjualan.fetch');
//         });

//         Route::prefix('faktur-penagihan')->controller(FakturPenagihanController::class)->group(function () {
//             Route::get('/', 'index')->name('penjualan.fakturpenagihan.index');
//             Route::get('/create', 'create')->name('penjualan.fakturpenagihan.create');
//             Route::post('/', 'store')->name('penjualan.fakturpenagihan.store');
//             Route::get('/{id}/edit', 'edit')->name('penjualan.fakturpenagihan.edit');
//             Route::put('/{id}', 'update')->name('penjualan.fakturpenagihan.update');
//             Route::delete('/{id}', 'destroy')->name('penjualan.fakturpenagihan.destroy');
//             Route::get('/fetch', 'fetch')->name('penjualan.fakturpenagihan.fetch');
//         });

//         Route::prefix('penerimaan')->controller(PenerimaanController::class)->group(function () {
//             Route::get('/', 'index')->name('penjualan.penerimaan.index');
//             Route::get('/create', 'create')->name('penjualan.penerimaan.create');
//             Route::post('/', 'store')->name('penjualan.penerimaan.store');
//             Route::get('/{id}/edit', 'edit')->name('penjualan.penerimaan.edit');
//             Route::put('/{id}', 'update')->name('penjualan.penerimaan.update');
//             Route::delete('/{id}', 'destroy')->name('penjualan.penerimaan.destroy');
//             Route::get('/fetch', 'fetch')->name('penjualan.penerimaan.fetch');
//         });

//         Route::prefix('retur')->controller(ReturController::class)->group(function () {
//             Route::get('/', 'index')->name('penjualan.retur.index');
//             Route::get('/create', 'create')->name('penjualan.retur.create');
//             Route::post('/', 'store')->name('penjualan.retur.store');
//             Route::get('/{id}/edit', 'edit')->name('penjualan.retur.edit');
//             Route::put('/{id}', 'update')->name('penjualan.retur.update');
//             Route::delete('/{id}', 'destroy')->name('penjualan.retur.destroy');
//             Route::get('/fetch', 'fetch')->name('penjualan.retur.fetch');
//         });

//     });

// });

$modelsPath = app_path('Models/ModulUtama/Penjualan/');
$models = array_diff(scandir($modelsPath), ['..', '.', 'Traits']);

Route::prefix('penjualan')->name('penjualan.')->group(function () use ($models) {
    foreach ($models as $modelFile) {
        $modelName = pathinfo($modelFile, PATHINFO_FILENAME); // Pemeriksaan
        $slug = Str::kebab($modelName);                        // pemeriksaan
        $routeName = Str::snake($modelName);                   // pemeriksaan
        $controllerClass = "App\\Http\\Controllers\\ModulUtama\\Penjualan\\{$modelName}Controller";

        if (class_exists($controllerClass)) {
            Route::prefix($slug)->name("$routeName.")->controller($controllerClass)->group(function () use ($routeName) {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{id}/edit', 'edit')->name('edit');
                Route::put('/{id}', 'update')->name('update');
                Route::delete('/{id}', 'destroy')->name('destroy');
                Route::get('/fetch', 'fetch')->name('fetch');
            });
        }
    }
});