<?php

namespace App\Http\Controllers\ModulUtama\Penjualan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\ModulUtama\Penjualan\PengirimanPenjualan as Model;
use App\Http\Controllers\ModulUtama\Penjualan\BasePenjualanController;

class PengirimanPenjualanController extends BasePenjualanController
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
                'no_pengiriman'        => 'required|string',
                'tanggal'       => 'required|date',
                'pelanggan_id'         => 'nullable|exists:pelanggan,id',
                'no_po'                => 'nullable|string',
                'status'               => 'nullable|string|in:draft,diproses,disetujui',

                'no_pelanggan'         => 'nullable|string',
                'nama_pelanggan'       => 'nullable|string',
                'deskripsi'            => 'nullable|string',

                'no_persetujuan'       => 'nullable|string',
                'catatan_pemeriksaan'  => 'nullable|string',
                'tindak_lanjut'        => 'nullable|string',
                'disetujui'            => 'nullable|boolean',
                'urgensi'              => 'nullable|in:rendah,sedang,tinggi',

                'cabang_id'            => 'nullable|numeric|exists:cabangs,id',
            ])->validate();

            $pengiriman = $this->model::create([
                'no_pengiriman'        => $validated['no_pengiriman'],
                'tgl_pengiriman' => \Carbon\Carbon::parse($validated['tanggal']),
                'pelanggan_id'         => $validated['pelanggan_id'] ?? null,
                'no_po'                => $validated['no_po'] ?? null,
                'status'               => $validated['status'] ?? 'draft',

                'no_pelanggan'         => $validated['no_pelanggan'] ?? null,
                'nama_pelanggan'       => $validated['nama_pelanggan'] ?? null,
                'deskripsi'            => $validated['deskripsi'] ?? null,

                'no_persetujuan'       => $validated['no_persetujuan'] ?? null,
                'catatan_pemeriksaan'  => $validated['catatan_pemeriksaan'] ?? null,
                'tindak_lanjut'        => $validated['tindak_lanjut'] ?? null,
                'disetujui'            => $validated['disetujui'] ?? false,
                'urgensi'              => $validated['urgensi'] ?? null,

                'cabang_id'            => $validated['cabang_id'] ?? null,
                'user_id'              => $this->auth, // pastikan ini tersedia di controller
            ]);

            // Jika ada relasi item, masukkan di sini seperti sebelumnya
            if ($request->has('barang_id')) {
                $items = collect($request->barang_id)->map(function ($itemId, $i) use ($request) {
                    return [
                        'no_barang'         => $request->no_barang[$i] ?? null,
                        'deskripsi_barang'  => $request->deskripsi_barang[$i] ?? null,
                        'kts'               => $request->kts_permintaan[$i] ?? 0,
                        'satuan'            => $request->satuan[$i] ?? null,
                        'diskon_persen'     => $request->diskon[$i] ?? 0,
                        'departemen'        => $request->departemen[$i] ?? null,
                        'proyek'            => $request->proyek[$i] ?? null,
                        'no_pesanan'        => $request->no_po ?? null, // diasumsikan berasal dari header
                        'no_penawaran'      => $request->no_penawaran ?? null, // juga dari header
                        'gudang'            => $request->gudang[$i] ?? null, // pastikan disediakan dari frontend
                    ];
                })->toArray();

                $pengiriman->items()->createMany($items); // pastikan relasi items() tersedia
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data pengiriman berhasil disimpan.',
                'data'    => $pengiriman
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
