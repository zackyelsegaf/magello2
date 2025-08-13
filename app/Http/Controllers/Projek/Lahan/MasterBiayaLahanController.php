<?php

namespace App\Http\Controllers\Projek\Lahan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasterBiayaLahanController extends Controller
{
    public function MasterBiayaLahanList()
    {
        return view("projek.lahan.masterbiayalahan.masterbiayalahan");
    }
    public function MasterBiayaLahanAddNew()
    {
        return view("projek.lahan.masterbiayalahan.masterbiayalahanaddnew");
    }
}
