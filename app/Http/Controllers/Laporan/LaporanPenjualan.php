<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanPenjualan extends Controller
{
    public function index(){
        return view('laporan.penjualan.index');
    }

    //Daftar Faktur Penjualan
    public function faktur(){
        //coming soon
    }
    //Daftar Pengiriman Pesanan
    public function pengiriman(){
        //coming soon
    }
    //Daftar Retur Penjualan
    public function retur(){
        //coming soon
    }
    //Penjualan Per Barang - Omset
    public function penjualan_barang_omset(){
        //coming soon
    }
    //Penjualan Per Pelanggan - Ringkasan
    public function pelanggan_ringkasan(){
        //coming soon
    }
    //Penjualan Per Pelanggan - Rincian
    public function pelanggan_rincian(){
        //coming soon
    }
    //Penjualan Pelanggan Per Barang
    public function pelanggan_barang(){
        //coming soon
    }
    //Penjualan Per Barang - Ringkasan
    public function barang_ringkasan(){
        //coming soon
    }
    //Penjualan Per Barang - Rincian
    public function barang_rincian(){
        //coming soon
    }
    //Penjualan Per Barang - Omset
    public function barang_omset(){
        //coming soon
    }
    //Penjualan Per Barang - Kuantitas
    public function barang_kuantitas(){
        //coming soon
    }
    //Retur Penjualan Per Pelanggan
    public function penjualan_pelanggan(){
        //coming soon
    }
    //Retur Penjualan Per Barang
    public function penjualan_barang(){
        //coming soon
    }
    //Rincian Daftar Retur Penjualan
    public function retur_rincian(){
        //coming soon
    }
    //Pesanan Penjualan Per Pelanggan
    public function pesanan_pelanggan(){
        //coming soon
    }
    //Pesanan Penjualan Per Barang
    public function pesanan_barang(){
        //coming soon
    }
    //Penawaran Penjualan Per Pelanggan
    public function penawaran_pelanggan(){
        //coming soon
    }
    //Penawaran Penjualan Per Barang
    public function penawaran_barang(){
        //coming soon
    }
    //Histori Pengiriman Pesanan
    public function histori_pengiriman(){
        //coming soon
    }
    //Histori Pesanan Penjualan
    public function histori_pesanan(){
        //coming soon
    }
}
