<?php

namespace App\Http\Controllers\Marketing;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProspekController extends Controller
{
    public function ProspekList()
    {
        return view('marketing.prospek.prospek');
    }

    public function ProspekAddNew()
    {
        return view('marketing.prospek.prospekaddnew');
    }
}
