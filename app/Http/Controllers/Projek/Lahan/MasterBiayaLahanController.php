<?php

namespace App\Http\Controllers\Projek\Lahan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MasterBiayaLahanController extends Controller
{
    public function MasterBiayaLahanList()
    {
        return view("projek.lahan.masterbiayalahan.masterbiayalahan");
    }
    public function MasterBiayaLahanAddNew()
    {
        $akun = DB::table('akun')->get();
        return view("projek.lahan.masterbiayalahan.masterbiayalahanaddnew", compact('akun'));
    }
}
