<?php

namespace App\Http\Controllers\Projek\Lahan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DataLahanController extends Controller
{
    public function DataLahanList()
    {
        return view("projek.lahan.datalahan.datalahan");
    }
    public function DataLahanAddNew()
    {
        $cluster = DB::table('cluster')->get();
        $pemasok = DB::table('pemasok')->get();
        return view("projek.lahan.datalahan.datalahanaddnew", compact('cluster', 'pemasok'));
    }
}
