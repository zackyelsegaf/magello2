<?php

namespace App\Http\Controllers\ModulUtama\Penjualan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Models\ModulUtama\Penjualan\PenerimaanPenjualan;
use App\Models\ModulUtama\Penjualan\PenerimaanPenjualan as Model;
use App\Http\Controllers\ModulUtama\Penjualan\BasePenjualanController;

class PenerimaanPenjualanController extends BasePenjualanController
{
    /**
     * Display a listing of the resource.
     */
    protected $model = Model::class;
    public function fetch(Request $request)
    {
        $model = $this->model::with(['user', 'cabang'])
            ->when($request->filled('no_pesanan'), function ($q) use ($request) {
                $q->where('no_pesanan', 'like', '%' . $request->no_pesanan . '%');
            })
            ->when($request->filled('tgl_pesanan'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', $request->tgl_pesanan);
            })
            ->when($request->filled('tgl_mulai') && $request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereBetween('tgl_pesanan', [$request->tgl_mulai, $request->tgl_sampai]);
            })
            ->when($request->filled('tgl_mulai') && !$request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', '>=', $request->tgl_mulai);
            })
            ->when(!$request->filled('tgl_mulai') && $request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', '<=', $request->tgl_sampai);
            });

        return DataTables::of($model)
            ->addIndexColumn()
            ->addColumn('pengguna', fn($row) => $row->user->name ?? '-')
            ->addColumn('cabang', fn($row) => $row->cabang->nama ?? '-')
            ->addColumn('catatan_pemeriksaan', fn($row) => $row->catatan_pemeriksaan ? true : false)
            ->addColumn('tindak_lanjut', fn($row) => $row->tindak_lanjut ? true : false)
            ->addColumn('disetujui', fn($row) => $row->disetujui ? true : false)
            ->make(true);
    }

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
