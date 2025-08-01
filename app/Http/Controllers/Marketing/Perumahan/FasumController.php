<?php

namespace App\Http\Controllers\Marketing\Perumahan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FasumController extends Controller
{
        public function FasumList()
    {
        return view('marketing.perumahan.fasum.fasum');
    }

    public function FasumAddNew()
    {
        return view('marketing.perumahan.fasum.fasumaddnew');
    }
}
