<?php

namespace App\Http\Controllers\Persediaan;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PembiayaanPesananController extends Controller
{
    function PembiayaanPesananList()
    {
        return view('persediaan.pembiayaanpesanan.pembiayaanpesanan');
    }
    function PembiayaanPesananAddNew()
    {
        return view('persediaan.pembiayaanPesanan.pembiayaanpesananadd');
    }
}
