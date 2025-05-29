<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $menu;

    public function dataUtama(){
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        $routeFetch = route("penjualan.$this->menu.fetch");
        $createRoute = route("penjualan.$this->menu.create");

        return view("modulutama.penjualan.$this->menu.data", compact('createRoute','routeFetch', 'nama_barang', 'tipe_barang', 'tipe_persediaan', 'kategori_barang'));
    }

    public function BaseCreate(){
        $data['nama_barang'] = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        $routeFetch = route("penjualan.$this->menu.fetch");
        $createRoute = route("penjualan.$this->menu.create");

        return view("modulutama.penjualan.$this->menu.add", $data);
    }
}
