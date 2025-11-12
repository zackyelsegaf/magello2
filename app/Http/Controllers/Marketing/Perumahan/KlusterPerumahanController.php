<?php

namespace App\Http\Controllers\Marketing\Perumahan;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KlusterPerumahanController extends Controller
{
    public function KlusterPerumahanList()
    {
        return view('marketing.perumahan.klusterperumahan.klusterperumahan');
    }

    public function KlusterPerumahanAddNew()
    {
        return view('marketing.perumahan.klusterperumahan.klusterperumahanaddnew');
    }
}
