<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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

        // Simpan nama model dalam lowercase
        $this->model = $this->path;

        // Ambil segment kedua dari URL (misalnya: /admin/terapis -> "terapis")
        $this->segment = Request::segment(2);

        // Format segment jadi judul (misalnya "terapis" → "Terapis", "paket-pengobatan" → "Paket Pengobatan")
        $this->title = ucwords(str_replace('-', ' ', $this->segment));
    }
    public function index()
    {
        $this->getRoutePrefix();
        $data['model'] = $this->path;
        $data['title'] = $this->title;
        return view('layout.index', $data);
    }

}
