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
}
