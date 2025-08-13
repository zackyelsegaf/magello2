<?php

namespace App\Http\Controllers\Projek;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerencanaanPembangunanController extends Controller
{
    public function PerencanaanPembangunanList()
    {
        return view("projek.perencanaanPembangunan.perencanaanpembangunan");
    }
    public function PerencanaanPembangunanAddNew()
    {
        return view("projek.perencanaanPembangunan.perencanaanpembangunanaddnew");
    }
}
