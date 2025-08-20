<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function viewPenjualan(){
        return view('laporan.penjualan');
    }
    public function viewPembelian(){
        return view('laporan.pembelian');
    }
}
