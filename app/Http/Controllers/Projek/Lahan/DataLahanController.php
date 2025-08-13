<?php

namespace App\Http\Controllers\Projek\Lahan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataLahanController extends Controller
{
    public function DataLahanList()
    {
        return view("projek.lahan.datalahan.datalahan");
    }
    public function DataLahanAddNew()
    {
        return view("projek.lahan.datalahan.datalahanaddnew");
    }
}
