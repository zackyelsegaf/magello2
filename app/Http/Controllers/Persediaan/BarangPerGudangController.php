<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AktivaTetap;
use App\Models\Barang;
use App\Models\Gudang;
use App\Models\StokBarang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class BarangPerGudangController extends Controller
{
    function BarangPerGudangList()
    {
        $gudangs = Gudang::all(); // untuk thead kolom

        $barangs = Barang::all(); // untuk baris utama

        // Ambil semua stok per barang dan gudang
        $stokData = StokBarang::select('barang_id', 'gudang_id', 'jumlah')->get();

        // Bentuk array stok[barang_id][gudang_id] = jumlah
        $stok = [];
        foreach ($stokData as $item) {
            $stok[$item->barang_id][$item->gudang_id] = $item->jumlah;
        }

        return view('persediaan.barangpergudang.BarangperGudang', compact('gudangs', 'barangs', 'stok'));
    }
    function BarangPerGudangAddNew()
    {
        return view('persediaan.barangpergudang.addBarangperGudang');
    }
    
    public function getBarangPerGudangData(Request $request)
    {
        $draw       = $request->get('draw');
        $start      = $request->get("start");
        $length     = $request->get("length");
        $search     = $request->get('search')['value'];

        $gudangs = DB::table('gudang')->orderBy('id')->get();

        $barangQuery = DB::table('barang')
            ->select('id', 'no_barang', 'nama_barang');

        if ($search) {
            $barangQuery->where(function ($query) use ($search) {
                $query->where('no_barang', 'like', "%$search%")
                      ->orWhere('nama_barang', 'like', "%$search%");
            });
        }

        $totalRecords = DB::table('barang')->count();
        $filteredRecords = $barangQuery->count();

        $barangs = $barangQuery
            ->offset($start)
            ->limit($length)
            ->get();

        $data = [];

        foreach ($barangs as $barang) {
            $row = [
                'no_barang'      => $barang->no_barang,
                'nama_barang'    => $barang->nama_barang,
            ];

            foreach ($gudangs as $gudang) {
                $jumlah = DB::table('stok_barang')
                    ->where('barang_id', $barang->id)
                    ->where('gudang_id', $gudang->id)
                    ->value('jumlah');

                $row['gudang_' . $gudang->id] = $jumlah ?? 0;
            }

            $data[] = $row;
        }

        return response()->json([
            'draw'            => intval($draw),
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
            'columnsDynamic'  => $gudangs->pluck('nama_gudang', 'id'),
        ]);
    }
}
