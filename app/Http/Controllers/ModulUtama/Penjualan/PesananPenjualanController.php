<?php

namespace App\Http\Controllers\ModulUtama\Penjualan;

use App\Models\Syarat;
use App\Models\Penjual;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ModulUtama\Penjualan\PesananPenjualan;
use App\Models\ModulUtama\Penjualan\PesananPenjualan as Model;
use App\Http\Controllers\ModulUtama\Penjualan\BasePenjualanController;

class PesananPenjualanController extends BasePenjualanController
{
    /**
     * Display a listing of the resource.
     */
    protected $model = Model::class;
    public function fetch(Request $request)
    {
        $model = $this->model;

        $query = $model::query();

        // Contoh filter dinamis (jika perlu):
        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }

        // DataTables response
        return datatables()->of($query)
            ->addIndexColumn() // untuk No urutan
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" class="permintaan_checkbox" value="' . $row->id . '">';
            })
            ->addColumn('pengguna', function ($row) {
                return optional($row->user)->name ?? '-';
            })
            ->addColumn('cabang', function ($row) {
                return optional($row->cabang)->nama ?? '-';
            })
            ->addColumn('catatan_pemeriksaan', function ($row) {
                return $row->catatan_pemeriksaan ? true : false;
            })
            ->addColumn('tindak_lanjut', function ($row) {
                return $row->tindak_lanjut ? true : false;
            })
            ->addColumn('disetujui', function ($row) {
                return $row->disetujui ? true : false;
            })
            ->rawColumns(['checkbox']) // jika pakai HTML (checkbox)
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['nama_barang'] = DB::table('barang')->get();
        $data['title'] = "Pesanan";
        $data['no'] = PesananPenjualan::generateNo();
        $data['pelanggans'] = Pelanggan::all()->map(fn($item) => [
            'id' => $item->id,
            'name' => $item->nama,
            'alamat' => $item->alamat_1,
            'telepon' => $item->no_telp
        ])->toArray();
        $data['penjuals'] = Penjual::all()->mapWithKeys(function ($item) {
            $nama = $item->nama_depan_penjual . " " . $item->nama_belakang_penjual;
            return [$item->id => $nama];
        })->toArray();
        $data['syaratPembayaran'] = Syarat::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->nama];
        })->toArray();
        $data['storeRoute'] = route('penjualan.pesanan_penjualan.store');
        $data['routeIndex'] = $this->routeIndex();
        return view("modulutama.penjualan.pesanan-penjualan.add", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
