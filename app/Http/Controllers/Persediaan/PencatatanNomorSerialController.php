<?php

namespace App\Http\Controllers\Persediaan;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PencatatanNomorSerialController extends Controller
{
    function PencatatanNomorSerialList()
    {
        return view('persediaan.pencatatannomorserial.pencatatannomorserial');
    }
    function PencatatanNomorSerialAddNew()
    {
        return view('persediaan.pencatatannomorserial.pencatatannomorserialadd');
    }
}
