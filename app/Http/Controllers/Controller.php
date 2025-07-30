<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjual;
use App\Models\Pelanggan;
use App\Models\TipeBarang;
use Illuminate\Support\Str;
use App\Models\KategoriBarang;
use App\Models\ModulUtama\Penjualan\PengirimanPenjualan;
use App\Models\TipePersediaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $auth;

    public function __construct()
    {
        $this->getRoutePrefix();
        $this->auth = Auth::id();
    }

    protected $segment;

    protected $editRoute;

    protected $route;

    protected $path;

    protected $model;

    protected $title;
    public function getRoutePrefix()
    {
        // Ambil nama model dari FQCN
        $modelName = class_basename($this->model); // contoh: "Terapis" atau "PaketPengobatan"

        // Tentukan apakah satu kata atau dua kata
        if (preg_match('/^[A-Z][a-z]+$/', $modelName)) {
            // Satu kata seperti "Terapis"
            $this->route = strtolower($modelName); // jadi "terapis"

            $this->path = strtolower($modelName);
        } else {
            // Lebih dari satu kata seperti "PaketPengobatan"
            $this->route = Str::snake($modelName); // jadi "paket_pengobatan"

            $this->path = Str::kebab($modelName);
        }

        // Ambil segment kedua dari URL (misalnya: /admin/terapis -> "terapis")
        $this->segment = Request::segment(3);

        // Format segment jadi judul (misalnya "terapis" → "Terapis", "paket-pengobatan" → "Paket Pengobatan")
    }
    protected $data = [];

    protected function NeededIndex()
    {
        $this->data['no'] = $this->model::generateNo();
        $this->data['pelanggans'] = Pelanggan::all()->map(fn($item) => [
            'id' => $item->id,
            'name' => $item->nama_pelanggan,
            'alamat' => $item->alamat_1,
            'telepon' => $item->no_telp
        ])->toArray();
        $this->data['penjuals'] = Penjual::all()->mapWithKeys(function ($item) {
            $nama = $item->nama_depan_penjual . " " . $item->nama_belakang_penjual;
            return [$item->id => $nama];
        })->toArray();
        $this->data['nama_barang'] = Barang::get();
        $this->data['tipe_barang'] = TipeBarang::get();
        $this->data['kategori_barang'] = KategoriBarang::get();
        $this->data['tipe_persediaan'] = TipePersediaan::get();
        $this->data['title'] = $this->route;
        $this->data['snake'] = $this->path;
        $this->data['segment'] = $this->segment;
        // $this->data['createRoute'] = $this->routeCreate();
        // $this->data['fetchRoute'] = $this->routefetch();
    }

    public function index()
    {
        $this->NeededIndex();
        return dd("modulutama.penjualan.$this->path.data", $this->data);
    }

    protected function RefCreate()
    {
        $this->data['nama_barang'] = DB::table('barang')->get();
        $this->data['title'] = "Penawaran";
        $this->data['no'] = $this->model::generateNo();
        $this->data['pelanggans'] = Pelanggan::all()->map(fn($item) => [
            'id' => $item->id,
            'name' => $item->nama,
            'alamat' => $item->alamat_1,
            'telepon' => $item->no_telp
        ])->toArray();
        $this->data['penjuals'] = Penjual::all()->mapWithKeys(function ($item) {
            $nama = $item->nama_depan_penjual . " " . $item->nama_belakang_penjual;
            return [$item->id => $nama];
        })->toArray();
    }

    protected function routeCreate(){
        return route("penjualan.$this->model.create");
    }
    protected function routeEdit(){
        
    }
    protected function routefetch(){
        
    }
}
