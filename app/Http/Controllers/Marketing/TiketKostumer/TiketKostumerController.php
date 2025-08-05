<?php

namespace App\Http\Controllers\Marketing\TiketKostumer;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TiketKostumerController extends Controller
{
    public function TiketKostumerList()
    {
        return view('marketing.tiketkluster.tiketkostumer.tiketkostumer');
    }
}
