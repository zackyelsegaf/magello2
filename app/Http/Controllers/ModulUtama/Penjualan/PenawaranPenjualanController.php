<?php

namespace App\Http\Controllers\ModulUtama\Penjualan;

use App\Http\Controllers\ModulUtama\Penjualan\BasePenjualanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ModulUtama\Penjualan\PenawaranPenjualan as Model;

class PenawaranPenjualanController extends BasePenjualanController
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


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validated = Validator::make($request->all(), [
                'no_penawaran'        => 'required|string',
                'tgl_penawaran'       => 'nullable|date',
                'pelanggan_id'        => 'required|exists:pelanggan,id',
                'no_pelanggan'        => 'nullable|string',
                'nama_pelanggan'      => 'nullable|string',
                'status'              => 'nullable|string|in:draft,diproses,disetujui',
                'nilai_diskon'        => 'nullable|numeric',
                'total_pajak'         => 'nullable|numeric',
                'nilai_pajak_1'       => 'nullable|numeric',
                'nilai_pajak_2'       => 'nullable|numeric',
                'nilai_penawaran'     => 'nullable|numeric',
                'deskripsi'           => 'nullable|string',
                'no_persetujuan'      => 'nullable|string',
                'catatan_pemeriksaan' => 'nullable|string',
                'tindak_lanjut'       => 'nullable|string',
                'disetujui'           => 'nullable|boolean',
                'urgensi'             => 'nullable|in:rendah,sedang,tinggi',
            ])->validate();

            // Update jika ada, create jika belum
            $penawaran = $this->model::updateOrCreate(
                ['no_penawaran' => $validated['no_penawaran']],
                [
                    'tgl_penawaran'       => $validated['tgl_penawaran'] ?? now(),
                    'pelanggan_id'        => $validated['pelanggan_id'],
                    'no_pelanggan'        => $validated['no_pelanggan'] ?? null,
                    'nama_pelanggan'      => $validated['nama_pelanggan'] ?? null,
                    'status'              => $validated['status'] ?? 'draft',
                    'nilai_diskon'        => $validated['nilai_diskon'] ?? 0,
                    'total_pajak'         => $validated['total_pajak'] ?? 0,
                    'nilai_pajak_1'       => $validated['nilai_pajak_1'] ?? 0,
                    'nilai_pajak_2'       => $validated['nilai_pajak_2'] ?? 0,
                    'nilai_penawaran'     => $validated['nilai_penawaran'] ?? 0,
                    'deskripsi'           => $validated['deskripsi'] ?? null,
                    'no_persetujuan'      => $validated['no_persetujuan'] ?? null,
                    'catatan_pemeriksaan' => $validated['catatan_pemeriksaan'] ?? null,
                    'tindak_lanjut'       => $validated['tindak_lanjut'] ?? null,
                    'disetujui'           => $validated['disetujui'] ?? false,
                    'urgensi'             => $validated['urgensi'] ?? null,
                    'user_id'             => $this->auth,
                ]
            );

            // Hapus item lama jika update
            $penawaran->items()->delete();

            // Simpan ulang item baru
            $items = collect($request->barang_id)->map(function ($itemId, $i) use ($request) {
                return [
                    'item_id'        => $itemId,
                    'kts_permintaan' => $request->kts_permintaan[$i] ?? 0,
                    'satuan'         => $request->satuan[$i] ?? '',
                    'harga_satuan'   => $request->harga_satuan[$i] ?? 0,
                    'diskon'         => $request->diskon[$i] ?? 0,
                    'pajak'          => $request->pajak[$i] ?? 0,
                    'jumlah'         => (int)str_replace('.', '', $request->jumlah[$i]) ?? 0,
                    'kts_dipesan'    => $request->kts_dipesan[$i] ?? 0,
                    'kts_dikirim'    => $request->kts_dikirim[$i] ?? 0,
                    'departemen'     => $request->departemen[$i] ?? '',
                    'proyek'         => $request->proyek[$i] ?? '',
                ];
            })->toArray();

            $penawaran->items()->createMany($items);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data penawaran berhasil disimpan.',
                'data'    => $penawaran
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ], 500);
        }
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
    // public function edit($id){
    //     $data = $this->model::findOrFail($id);
    //     if (!$data){
    //         return "tidak ada";
    //     }
    //     return $this->editref($data);
    // }

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
