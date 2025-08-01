<?php

namespace App\Http\Controllers\Marketing\TiketKostumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriTiketKostumerController extends Controller
{
    public function KategoriTiketKostumerList()
    {
        return view('marketing.tiketkluster.kategoritiketkostumer.kategoritiketkostumer');
    }

    public function KategoriTiketKostumerAddNew()
    {
        return view('marketing.tiketkluster.kategoritiketkostumer.kategoritiketkostumeraddnew');
    }
}
