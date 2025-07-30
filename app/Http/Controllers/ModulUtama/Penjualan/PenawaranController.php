<?php

namespace App\Http\Controllers\ModulUtama\Penjualan;

use App\Http\Controllers\Controller;
use App\Models\ModulUtama\Penjualan\PenawaranPenjualan as Model;
use Illuminate\Http\Request;

class PenawaranController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
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
        //
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
