<?php

namespace App\Http\Controllers\Projek;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpkMandorPekerjaController extends Controller
{
        public function SpkMandorPekerjaList()
    {
        return view("projek.spkmandorpekerja.spkmandorpekerja");
    }
    public function SpkMandorPekerjaInternalAddNew()
    {
        return view("projek.spkmandorpekerja.spkmandorpekerjainternaladdnew");
    }
    public function SpkMandorPekerjaSubConAddNew()
    {
        return view("projek.spkmandorpekerja.spkmandorpekerjasubconaddnew");
    }
}
