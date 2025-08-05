<?php

namespace App\Http\Controllers\Marketing;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DataBookingController extends Controller
{
    public function DataBookingList()
    {
        return view('marketing.databooking.databooking');
    }

}
