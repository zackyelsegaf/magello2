<?php

namespace App\Http\Controllers\Projek;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RabrapController extends Controller
{
    public function RabrapList()
    {
        return view("projek.rabrap.rabrap");
    }
    public function RabrapAddNew()
    {
        return view("projek.rabrap.rabrapaddnew");
    }
}
