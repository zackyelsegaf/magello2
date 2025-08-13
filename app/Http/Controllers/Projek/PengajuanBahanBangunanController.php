<?php

namespace App\Http\Controllers\Projek;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanBahanBangunanController extends Controller
{
    public function PengajuanBahanBangunanList()
    {
        return view("projek.pengajuanBahanbangunan.pengajuanBahanbangunan");
    }
    public function PengajuanBahanBangunanAddNew()
    {
        return view("projek.pengajuanBahanbangunan.pengajuanBahanbangunanaddnew");
    }
}
