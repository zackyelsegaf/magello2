<?php

namespace App\Http\Controllers\Marketing;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SuratPerintahPembangunanController extends Controller
{
    public function SuratPerintahPembangunanList()
    {
        return view('marketing.suratperintahpembangunan.suratperintahpembangunan');
    }

    public function SuratPerintahPembangunanAddNew()
    {
        return view('marketing.suratperintahpembangunan.suratperintahpembangunanaddnew');
    }
}
