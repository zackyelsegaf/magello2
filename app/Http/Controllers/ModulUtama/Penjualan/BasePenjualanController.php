<?php

namespace App\Http\Controllers\ModulUtama\Penjualan;

use App\Models\Barang;
use App\Models\JasaPengiriman;
use App\Models\Syarat;
use App\Models\Penjual;
use App\Models\Pelanggan;
use App\Models\TipeBarang;
use Illuminate\Support\Str;
use App\Models\KategoriBarang;
use App\Models\TipePersediaan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BasePenjualanController extends Controller
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
        $this->title = ucwords(Str::headline($this->path));

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
        // $this->data['title'] = $this->route;
        // $this->data['snake'] = $this->path;
        // $this->data['segment'] = $this->segment;
        // $this->data['createRoute'] = $this->routeCreate();
        // $this->data['fetchRoute'] = $this->routefetch();
    }

    public function index()
    {
        $this->NeededIndex();
        $this->data['title'] = $this->title;
        $this->data['createRoute'] = $this->routeCreate();
        $this->data['fetchRoute'] = $this->routefetch();
        return view("modulutama.penjualan.$this->path.data", $this->data);
    }

    public function edit(string $id)
    {
        $data = $this->model::findOrFail($id);

        $this->data['data'] = $data;
        
        $data['selectedPelanggan'] = [
            'id' => $data->pelanggan_id,
            'name' => $data->pelanggan->nama_pelanggan,
            'alamat' => $data->pelanggan->alamat_1,
            'telepon' => $data->pelanggan->no_telp
        ];
        $this->NeededIndex();
        $this->data['title'] = $this->title;
        $this->data['createRoute'] = $this->routeCreate();
        $this->data['fetchRoute'] = $this->routefetch();
        $this->data['UpdateRoute'] = $this->routeUpdate($id);
        return view("modulutama.penjualan.$this->path.edit", $this->data);
    }

    public function create()
    {
        $this->RefCreate();
        $this->data['title'] = $this->title;
        $this->data['createRoute'] = $this->routeCreate();
        $this->data['fetchRoute'] = $this->routefetch();
        $this->data['indexRoute'] = $this->routeIndex();
        $this->data['storeRoute'] = $this->routeStore();
        return view("modulutama.penjualan.$this->path.add", $this->data);
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
        $this->data['syaratPembayaran'] = Syarat::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->nama];
        })->toArray();
        $this->data['fob'] = [1 => 'Shipping Point', 2=> 'Destination' ];
        $this->data['jasaPengiriman'] = JasaPengiriman::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->nama . ' - ' . $item->jasa_pengiriman];
        })->toArray();
    }

    protected function routeCreate(){
        return route("penjualan.$this->route.create");
    }
    protected function routefetch(){
        return route("penjualan.$this->route.fetch");
    }
    protected function routeIndex(){
        return route("penjualan.$this->route.index");
    }
    protected function routeStore(){
        return route("penjualan.$this->route.store");
    }
    protected function routeUpdate($id){
        return route("penjualan.$this->route.update", $id);
    }
}