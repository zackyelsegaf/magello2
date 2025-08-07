<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AktivaTetap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


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
