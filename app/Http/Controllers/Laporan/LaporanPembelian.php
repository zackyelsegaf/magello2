<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanPembelian extends Controller
{
    public function index(){
        return view('laporan.pembelian.index');
    }

    //Daftar Faktur Pembelian
    public function faktur(Request $req){
        //coming soon
    }
    //Daftar Penerimaan Barang
    public function penerimaan(Request $req){
        //coming soon
    }
    //Pembelian Per Pemasok - Ringkasan
    public function pemasok_ringkasan(Request $req){
        //coming soon
    }
    //Pembelian Per Pemasok - Rincian
    public function pemasok_rincian(Request $req){
        //coming soon
    }
    //Daftar Retur Pembelian
    public function retur(Request $req){
        //coming soon
    }
    //Rincian Daftar Retur Pembelian
    public function retur_rincian(Request $req){
        //coming soon
    }
    //Pesanan Pembelian Per Pemasok
    public function pesanan_pemasok(Request $req){
        //coming soon
    }
    //Pesanan Pembelian Per Barang
    public function pesanan_barang(Request $req){
        //coming soon
    }
    //Permintaan Pembelian Per Barang
    public function permintaan_barang(Request $req){
        //coming soon
    }
    //Histori Penerimaan Barang
    public function histori_penerimaan(Request $req){
        //coming soon
    }
    //Histori Pesanan Pembelian
    public function histori_pesanan(Request $req){
        //coming soon
    }
}
