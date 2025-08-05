<?php

namespace App\Http\Controllers\Marketing\Perumahan;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FasosController extends Controller
{
        public function FasosList()
    {
        return view('marketing.perumahan.fasos.fasos');
    }

    public function FasosAddNew()
    {
        return view('marketing.perumahan.fasos.fasosaddnew');
    }
}
