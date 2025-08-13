<?php

namespace App\Http\Controllers\Projek;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KemajuanPembangunanController extends Controller
{
        public function KemajuanPembangunanList()
    {
        return view("projek.kemajuanpembangunan.kemajuanpembangunan");
    }
    public function KemajuanPembangunanAddNew()
    {
        return view("projek.kemajuanpembangunan.kemajuanpembangunanaddnew");
    }
}
