<?php

use App\Http\Controllers\Laporan\LaporanPembelian;
use App\Http\Controllers\Laporan\LaporanPenjualan;
use Illuminate\Support\Facades\Route;

Route::get('laporan/', function(){
    return view('laporan.semua');
})->name('laporan');

//tampilan filter between date
$showFilter = function(){
    return view('laporan.filters');
};

//laporan penjualan
Route::prefix('laporan/penjualan')->group(function() use($showFilter){
    Route::name('laporan/penjualan/')->group(function() use($showFilter){
        Route::get('faktur', $showFilter)->name('faktur');
        Route::get('pengiriman', $showFilter)->name('pengiriman');
        Route::get('retur', $showFilter)->name('retur');
        Route::get('penjualanbarangomset', $showFilter)->name('penjualanbarangomset');
        Route::get('pelangganringkasan', $showFilter)->name('pelangganringkasan');
        Route::get('pelangganrincian', $showFilter)->name('pelangganrincian');
        Route::get('pelangganbarang', $showFilter)->name('pelangganbarang');
        Route::get('barangringkasan', $showFilter)->name('barangringkasan');
        Route::get('barangrincian', $showFilter)->name('barangrincian');
        Route::get('barangomset', $showFilter)->name('barangomset');
        Route::get('barangkuantitas', $showFilter)->name('barangkuantitas');
        Route::get('penjualanpelanggan', $showFilter)->name('penjualanpelanggan');
        Route::get('penjualanbarang', $showFilter)->name('penjualanbarang');
        Route::get('returrincian', $showFilter)->name('returrincian');
        Route::get('pesananpelanggan', $showFilter)->name('pesananpelanggan');
        Route::get('pesananbarang', $showFilter)->name('pesananbarang');
        Route::get('penawaranpelanggan', $showFilter)->name('penawaranpelanggan');
        Route::get('penawaranbarang', $showFilter)->name('penawaranbarang');
        Route::get('historipengiriman', $showFilter)->name('historipengiriman');
        Route::get('historipesanan', $showFilter)->name('historipesanan');
    });

    Route::controller(LaporanPenjualan::class)->group(function(){
        Route::get('/', 'index')->name('laporan/penjualan');
        Route::post('/faktur', 'faktur');
        Route::post('/pengiriman', 'pengiriman');
        Route::post('/retur', 'retur');
        Route::post('/penjualanbarangomset', 'penjualan_barang_omset');
        Route::post('/pelangganringkasan', 'pelanggan_ringkasan');
        Route::post('/pelangganrincian', 'pelanggan_rincian');
        Route::post('/pelangganbarang', 'pelanggan_barang');
        Route::post('/barangringkasan', 'barang_ringkasan');
        Route::post('/barangrincian', 'barang_rincian');
        Route::post('/barangomset', 'barang_omset');
        Route::post('/barangkuantitas', 'barang_kuantitas');
        Route::post('/penjualanpelanggan', 'penjualan_pelanggan');
        Route::post('/penjualanbarang', 'penjualan_barang');
        Route::post('/returrincian', 'retur_rincian');
        Route::post('/pesananpelanggan', 'pesanan_pelanggan');
        Route::post('/pesananbarang', 'pesanan_barang');
        Route::post('/penawaranpelanggan', 'penawaran_pelanggan');
        Route::post('/penawaranbarang', 'penawaran_barang');
        Route::post('/historipengiriman', 'histori_pengiriman');
        Route::post('/historipesanan', 'histori_pesanan');
    });
});

//laporan pembelian
Route::prefix('laporan/pembelian')->group(function() use($showFilter){
    Route::name('laporan/pembelian/')->group(function() use($showFilter){
        Route::get('/faktur', $showFilter)->name('faktur');
        Route::get('/penerimaan', $showFilter)->name('penerimaan');
        Route::get('/pemasokringkasan', $showFilter)->name('pemasokringkasan');
        Route::get('/pemasokrincian', $showFilter)->name('pemasokrincian');
        Route::get('/retur', $showFilter)->name('retur');
        Route::get('/returrincian', $showFilter)->name('returrincian');
        Route::get('/pesananpemasok', $showFilter)->name('pesananpemasok');
        Route::get('/pesananbarang', $showFilter)->name('pesananbarang');
        Route::get('/permintaanbarang', $showFilter)->name('permintaanbarang');
        Route::get('/historipenerimaan', $showFilter)->name('historipenerimaan');
        Route::get('/historipesanan', $showFilter)->name('historipesanan');
    });

    Route::controller(LaporanPembelian::class)->group(function(){
        Route::get('/', 'index')->name('laporan/pembelian');
        Route::post('/faktur', 'faktur');
        Route::post('/penerimaan', 'penerimaan');
        Route::post('/pemasokringkasan', 'pemasok_ringkasan');
        Route::post('/pemasokrincian', 'pemasok_rincian');
        Route::post('/retur', 'retur');
        Route::post('/returrincian', 'retur_rincian');
        Route::post('/pesananpemasok', 'pesanan_pemasok');
        Route::post('/pesananbarang', 'pesanan_barang');
        Route::post('/permintaanbarang', 'permintaan_barang');
        Route::post('/historipenerimaan', 'histori_penerimaan');
        Route::post('/historipesanan', 'histori_pesanan');
    });
});
