<?php

namespace App\Http\Controllers\Marketing\Perumahan;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KavlingController extends Controller
{
    public function kavlingList()
    {
        return view('marketing.perumahan.kavling.kavling');
    }

    public function kavlingAddNew()
    {
        return view('marketing.perumahan.kavling.kavlingaddnew');
    }
}
