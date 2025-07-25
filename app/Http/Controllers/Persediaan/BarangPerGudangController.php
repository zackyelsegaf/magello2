<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarangPerGudangController extends Controller
{
    function BarangPerGudangList()
    {
        return view('persediaan.barangpergudang.barangpergudang');
    }
    function BarangPerGudangAddNew()
    {
        return view('persediaan.barangpergudang.barangpergudangadd');
    }

    
}
