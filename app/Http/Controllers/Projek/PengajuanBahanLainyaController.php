<?php

namespace App\Http\Controllers\Projek;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanBahanLainyaController extends Controller
{
    public function PengajuanBahanLainyaList()
    {
        return view("projek.pengajuanbahanlainya.pengajuanbahanlainya");
    }
    public function PengajuanBahanLainyaAddNew()
    {
        return view("projek.pengajuanbahanlainya.pengajuanbahanlainyaaddnew");
    }
}
