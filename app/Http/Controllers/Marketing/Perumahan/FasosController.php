<?php

namespace App\Http\Controllers\Marketing\Perumahan;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FasosController extends Controller
{
        public function FasosList()
    {
        return view('marketing.perumahan.fasos.fasos');
    }

    public function FasosAddNew()
    {
        $cluster = DB::table('cluster')->get();
        $rap_rab = DB::table('rap_rab')->get();
        return view('marketing.perumahan.fasos.fasosaddnew', compact('cluster', 'rap_rab'));
    }
}
