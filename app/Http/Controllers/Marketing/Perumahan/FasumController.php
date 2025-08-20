<?php

namespace App\Http\Controllers\Marketing\Perumahan;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FasumController extends Controller
{
        public function FasumList()
    {
        return view('marketing.perumahan.fasum.fasum');
    }

    public function FasumAddNew()
    {
        $cluster = DB::table('cluster')->get();
        $rap_rab = DB::table('rap_rab')->get();
        return view('marketing.perumahan.fasum.fasumaddnew', compact('cluster', 'rap_rab'));
    }
}

