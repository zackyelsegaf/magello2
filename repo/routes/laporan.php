<?php

use App\Http\Controllers\Laporan\LaporanPembelian;
use App\Http\Controllers\Laporan\LaporanPenjualan;
use Illuminate\Support\Facades\Route;

Route::get('laporan/', function(){
    return view('laporan.semua');
})->name('laporan');

//tampilan filter between date
function showFilter($title){
    return function() use($title){
        return view('laporan.filters', compact('title'));
    };
}

//laporan penjualan
Route::prefix('laporan/penjualan')->group(function(){
    Route::name('laporan/penjualan/')->group(function(){
        Route::get('faktur', showFilter('Daftar Faktur Penjualan'))->name('faktur');
        Route::get('pengiriman', showFilter('Daftar Pengiriman Pesanan'))->name('pengiriman');
        Route::get('retur', showFilter('Daftar Retur Penjualan'))->name('retur');
        Route::get('penjualanbarangomset', showFilter('Penjualan Per Barang - Omset'))->name('penjualanbarangomset');
        Route::get('pelangganringkasan', showFilter('Penjualan Per Pelanggan - Ringkasan'))->name('pelangganringkasan');
        Route::get('pelangganrincian', showFilter('Penjualan Per Pelanggan - Rincian'))->name('pelangganrincian');
        Route::get('pelangganbarang', showFilter('Penjualan Pelanggan Per Barang'))->name('pelangganbarang');
        Route::get('barangringkasan', showFilter('Penjualan Per Barang - Ringkasan'))->name('barangringkasan');
        Route::get('barangrincian', showFilter('Penjualan Per Barang - Rincian'))->name('barangrincian');
        Route::get('barangomset', showFilter('Penjualan Per Barang - Omset'))->name('barangomset');
        Route::get('barangkuantitas', showFilter('Penjualan Per Barang - Kuantitas'))->name('barangkuantitas');
        Route::get('penjualanpelanggan', showFilter('Retur Penjualan Per Pelaggan'))->name('penjualanpelanggan');
        Route::get('penjualanbarang', showFilter('Retur Penjualan Per Barang'))->name('penjualanbarang');
        Route::get('returrincian', showFilter('Rincian Daftar Retur Penjualan'))->name('returrincian');
        Route::get('pesananpelanggan', showFilter('Pesanan Penjualan Per Pelanggan'))->name('pesananpelanggan');
        Route::get('pesananbarang', showFilter('Penjualan Penjualan Per Barang'))->name('pesananbarang');
        Route::get('penawaranpelanggan', showFilter('Penawaran Penjualan Per Pelanggan'))->name('penawaranpelanggan');
        Route::get('penawaranbarang', showFilter('Penawaran Penjualan Per Barang'))->name('penawaranbarang');
        Route::get('historipengiriman', showFilter('Histori Pengiriman Pesanan'))->name('historipengiriman');
        Route::get('historipesanan', showFilter('Histori Pesanan Penjualan'))->name('historipesanan');
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
Route::prefix('laporan/pembelian')->group(function(){
    Route::name('laporan/pembelian/')->group(function(){
        Route::get('/faktur', showFilter('Daftar Faktur Pembelian'))->name('faktur');
        Route::get('/penerimaan', showFilter('Daftar Penerimaan Pembelian'))->name('penerimaan');
        Route::get('/pemasokringkasan', showFilter('Pembelian Per Pemasok - Ringkasan'))->name('pemasokringkasan');
        Route::get('/pemasokrincian', showFilter('Pembelian Per Pemasok - Rincian'))->name('pemasokrincian');
        Route::get('/retur', showFilter('Daftar Retur Pembelian'))->name('retur');
        Route::get('/returrincian', showFilter('Rincian Daftar Retur Pembelian'))->name('returrincian');
        Route::get('/pesananpemasok', showFilter('Pesanan Pembelian Per Pemasok'))->name('pesananpemasok');
        Route::get('/pesananbarang', showFilter('Pesanan Pembelian Per Barang'))->name('pesananbarang');
        Route::get('/permintaanbarang', showFilter('Permintaan Pembelian Per Barang'))->name('permintaanbarang');
        Route::get('/historipenerimaan', showFilter('Histori Penerimaan Barang'))->name('historipenerimaan');
        Route::get('/historipesanan', showFilter('Histori Pesanan Pembelian'))->name('historipesanan');
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
