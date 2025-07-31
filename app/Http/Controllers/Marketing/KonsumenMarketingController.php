<?php

namespace App\Http\Controllers\Marketing;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KonsumenMarketingController extends Controller
{
    public function KonsumenMarketingList()
    {
        return view('marketing.konsumen.konsumenmarketing');
    }

    public function KonsumenMarketingAddNew()
    {
        return view('marketing.konsumen.konsumenmarketingaddnew');
    }
}
