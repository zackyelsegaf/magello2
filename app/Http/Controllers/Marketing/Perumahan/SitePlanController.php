<?php

namespace App\Http\Controllers\Marketing\Perumahan;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SitePlanController extends Controller
{
    public function SitePlanView()
    {
        return view('marketing.perumahan.siteplan.siteplan');
    }
}
