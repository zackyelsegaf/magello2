<?php

namespace App\Http\Controllers\ModulUtama\Penjualan;

use App\Models\Barang;
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
        // Contoh filter dinamis (jika perlu):
        $model = $this->model::with(['user'])
            ->when($request->filled('quoteno'), function ($q) use ($request) {
                $q->where('no_penawaran', 'like', '%' . $request->quoteno . '%');
            })
            ->when($request->filled('description'), function ($q) use ($request) {
                $q->where('deskripsi', 'like', '%' . $request->description . '%');
            })
            ->when($request->filled('pelanggan_id'), function ($q) use ($request) {
                $q->where('pelanggan_id', $request->pelanggan_id);
            })
            ->when($request->filled('matauang_id'), function ($q) use ($request) {
                $q->where('mata_uang', $request->matauang_id);
            })
            ->when($request->boolean('use_date'), function ($q) use ($request) {
                $q->when($request->filled('tgl_mulai') && $request->filled('tgl_sampai'), function ($q) use ($request) {
                    $q->whereBetween('tgl_penawaran', [$request->tgl_mulai, $request->tgl_sampai]);
                })
                    ->when($request->filled('tgl_mulai') && !$request->filled('tgl_sampai'), function ($q) use ($request) {
                        $q->whereDate('tgl_penawaran', '>=', $request->tgl_mulai);
                    })
                    ->when(!$request->filled('tgl_mulai') && $request->filled('tgl_sampai'), function ($q) use ($request) {
                        $q->whereDate('tgl_penawaran', '<=', $request->tgl_sampai);
                    });
            })
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->whereIn('status', $request->status);
            })
            ->when($request->filled('audit_notes'), function ($q) use ($request) {
                foreach ($request->audit_notes as $note) {
                    switch ($note) {
                        case 'catatan_pemeriksaan':
                            $q->whereNotNull('catatan_pemeriksaan');
                            break;
                        case 'belum_catatan_pemeriksaan':
                            $q->whereNull('catatan_pemeriksaan');
                            break;
                        case 'disetujui':
                            $q->where('disetujui', true);
                            break;
                        case 'belum_disetujui':
                            $q->where(function ($sub) {
                                $sub->whereNull('disetujui')->orWhere('disetujui', false);
                            });
                            break;
                        case 'tindak_lanjut':
                            $q->whereNotNull('tindak_lanjut');
                            break;
                        case 'belum_tindak_lanjut':
                            $q->whereNull('tindak_lanjut');
                            break;
                        case 'urgent':
                            $q->where('urgensi', 'urgent');
                            break;
                        case 'tidak_urgent':
                            $q->where('urgensi', '!=', 'urgent');
                            break;
                    }
                }
            });

        return datatables()->of($model)
            ->addIndexColumn()
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" name="selected_ids[]" value="' . $row->id . '">';
            })->rawColumns(['checkbox'])
            ->addColumn('pengguna', fn($row) => $row->user->name ?? '-')
            ->addColumn('catatan_pemeriksaan', fn($row) => $row->catatan_pemeriksaan ? true : false)
            ->addColumn('tindak_lanjut', fn($row) => $row->tindak_lanjut ? true : false)
            ->addColumn('disetujui', fn($row) => $row->disetujui ? true : false)
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
        DB::beginTransaction();

        try {
            // Buat entri pesanan penjualan (header)
            $pesanan = PesananPenjualan::create([
                'no_pesanan'        => $request->no_penawaran,
                'tgl_pesanan'       => now(),
                'pelanggan_id'      => $request->pelanggan_id,
                'status'            => 'draft',
                'nilai_diskon'      => floatval(str_replace(',', '', $request->cashdiscount ?? 0)),
                'total_pajak'       => floatval($request->ppn ?? 0) + floatval($request->pajak2 ?? 0),
                'nilai_pajak_1'     => floatval($request->ppn ?? 0),
                'nilai_pajak_2'     => floatval($request->pajak2 ?? 0),
                'nilai_pesanan'     => floatval(str_replace(',', '', $request->total ?? 0)),
                'deskripsi'         => $request->deskripsi_1,
                'catatan_pemeriksaan' => $request->catatan_pemeriksaan_check == "1" ? $request->deskripsi_2 : null,
                'tindak_lanjut'     => $request->tindak_lanjut_check == "1" ? $request->deskripsi_2 : null,
                'disetujui'         => false,
                'urgensi'           => $request->urgent_check == "1" ? 'tinggi' : 'rendah',
                'user_id'           => $this->auth,
                'cabang_id'         => $this->auth,
                'no_persetujuan'    => null,
            ]);

            // Loop dan simpan item pesanan
            foreach ($request->deskripsi_barang as $i => $deskripsi) {
                // Cari item_id berdasarkan deskripsi (jika ada, sesuaikan sesuai logika Anda)
                $barang = Barang::where('nama_barang', $deskripsi)->first();

                $pesanan->items()->create([
                    'pesanan_penjualan_id' => $pesanan->id,
                    'item_id'              => $barang?->id ?? 1, // fallback item_id = 1 jika tidak ditemukan
                    'deskripsi_barang'     => $deskripsi,
                    'kuantitas'            => intval($request->kts_permintaan[$i] ?? 0),
                    'satuan'               => $request->satuan[$i] ?? '',
                    'harga_satuan'         => floatval(str_replace('.', '', $request->harga_satuan[$i] ?? 0)),
                    'diskon_persen'        => floatval($request->diskon[$i] ?? 0),
                    'pajak'                => floatval($request->pajak[$i] ?? 0),
                    'jumlah'               => floatval(str_replace([',', '.'], ['', '.'], $request->jumlah[$i] ?? 0)),
                    'kuantitas_dikirim'    => intval($request->kuantitas_dikirim[$i] ?? 0),
                    'departemen'           => $request->departemen[$i] ?? null,
                    'proyek'               => $request->proyek[$i] ?? null,
                    'no_penawaran'         => $request->no_penawaran,
                    'reserve_1'            => null,
                    'reserve_2'            => null,
                ]);
            }

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Pesanan penjualan berhasil disimpan.']);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan pesanan.', 'error' => $e->getMessage()]);
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
