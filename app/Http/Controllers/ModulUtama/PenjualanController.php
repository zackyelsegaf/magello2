<?php

namespace App\Http\Controllers\ModulUtama;

use App\Models\Pelanggan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\MataUang;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\ModulUtama\Penjualan\ReturPenjualan;
use App\Models\ModulUtama\Penjualan\FakturPenagihan;
use App\Models\ModulUtama\Penjualan\FakturPenjualan;
use App\Models\ModulUtama\Penjualan\PesananPenjualan;
use App\Models\ModulUtama\Penjualan\PenawaranPenjualan;
use App\Models\ModulUtama\Penjualan\PenerimaanPenjualan;
use App\Models\ModulUtama\Penjualan\PengirimanPenjualan;
use App\Models\ModulUtama\Penjualan\PenawaranPenjualanItem;
use App\Models\Penjual;

class PenjualanController extends Controller
{
    protected $menu, $model;

    public function dataUtama()
    {
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        $routeFetch = route("penjualan.$this->menu.fetch");
        $createRoute = route("penjualan.$this->menu.create");

        return view("modulutama.penjualan.$this->menu.data", compact('createRoute', 'routeFetch', 'nama_barang', 'tipe_barang', 'tipe_persediaan', 'kategori_barang'));
    }

    public function BaseCreate()
    {
        $data['nama_barang'] = DB::table('barang')->get();
        $data['title'] = ucwords("$this->menu");
        $data['no'] = $this->model::generateNo();
        $data['pelanggans'] = Pelanggan::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->nama_pelanggan];
        })->toArray();

        return view("modulutama.penjualan.$this->menu.add", $data);
    }
    // =====================
    // PENAWARAN PENJUALAN
    // =====================
    public function indexPenawaran()
    {
        $this->menu = 'penawaran';
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        $routeFetch = route("penjualan.$this->menu.fetch");
        $createRoute = route("penjualan.$this->menu.create");

        return view("modulutama.penjualan.$this->menu.data", compact('createRoute', 'routeFetch', 'nama_barang', 'tipe_barang', 'tipe_persediaan', 'kategori_barang'));
    }

    protected $recordId;

    public function checkbox($id): string
    {
        return '<input type="checkbox" class="permintaan_checkbox" value="' . $id . '">';
    }

    public function fetchPenawaran(Request $request)
    {
        $model = PenawaranPenjualan::with(['user'])
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

    public function fetchPesanan(Request $request)
    {
        $model = PesananPenjualan::with(['user', 'cabang'])
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

    public function fetchFakturPenjualan(Request $request)
    {
        $model = FakturPenjualan::with(['user', 'cabang'])
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

    public function fetchPengiriman(Request $request)
    {
        $model = PengirimanPenjualan::with(['user', 'cabang'])
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

    public function fetchFakturPenagihan(Request $request)
    {
        $model = FakturPenagihan::with(['user', 'cabang'])
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
    public function fetchPenerimaan(Request $request)
    {
        $model = PenerimaanPenjualan::with(['user', 'cabang'])
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
    public function fetchRetur(Request $request)
    {
        $model = ReturPenjualan::with(['user', 'cabang'])
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
    public function createPenawaran()
    {
        $data['nama_barang'] = DB::table('barang')->get();
        $data['title'] = "Penawaran";
        $data['no'] = PenawaranPenjualan::generateNo();
        $data['pelanggans'] = Pelanggan::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->nama_pelanggan];
        })->toArray();
        $data['penjuals'] = Penjual::all()->mapWithKeys(function ($item) {
            $nama = $item->nama_depan_penjual . " " . $item->nama_belakang_penjual;
            return [$item->id => $nama];
        })->toArray();

        return view("modulutama.penjualan.penawaran.add", $data);
    }
    public function storePenawaran(Request $request)
    {
        $auth = Auth::id();

        // return response()->json([
        //         'success' => false,
        //         'message' => 'Gagal menyimpan data: '.$auth,
        //     ], 500);

        DB::beginTransaction();


        // dd($request->all());

        try {
            $validated = Validator::make($request->all(), [
                'no_penawaran'        => 'required|string|unique:penawaran_penjualans,no_penawaran',
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

            $penawaran = PenawaranPenjualan::create([
                'no_penawaran'        => $validated['no_penawaran'],
                'tgl_penawaran'       => $validated['tgl_penawaran'] ?? now(),
                'pelanggan_id'        => $validated['pelanggan_id'] ?? null,
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
                'user_id'             => $auth,
            ]);

            // ... tambahkan penyimpanan detail barang di sini jika perlu
            $items = collect($request->barang_id)->map(function ($itemId, $i) use ($request) {
                return [
                    'item_id'        => $itemId,
                    'kts_permintaan' => $request->kts_permintaan[$i] ?? 0,
                    'satuan'         => $request->satuan[$i] ?? '',
                    'harga_satuan'   => $request->harga_satuan[$i] ?? 0,
                    'diskon'         => $request->diskon[$i] ?? 0,
                    'pajak'          => $request->pajak[$i] ?? 0,
                    'jumlah'         => $request->jumlah[$i] ?? 0,
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
    public function editPenawaran($id) {}
    public function updatePenawaran(Request $request, $id) {}
    public function destroyPenawaran($id) {}

    // =====================
    // PESANAN PENJUALAN
    // =====================
    public function indexPesanan()
    {
        $this->menu = 'pesanan';
        return $this->dataUtama();
    }
    public function createPesanan() {
        $data['nama_barang'] = DB::table('barang')->get();
        $data['title'] = "Penawaran";
        $data['no'] = PesananPenjualan::generateNo();
        $data['pelanggans'] = Pelanggan::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->nama_pelanggan];
        })->toArray();
        $data['penjuals'] = Penjual::all()->mapWithKeys(function ($item) {
            $nama = $item->nama_depan_penjual . " " . $item->nama_belakang_penjual;
            return [$item->id => $nama];
        })->toArray();

        return view("modulutama.penjualan.pesanan.add", $data);
    }
    public function storePesanan(Request $request) {}
    public function editPesanan($id) {}
    public function updatePesanan(Request $request, $id) {}
    public function destroyPesanan($id) {}

    // =====================
    // PENGIRIMAN PENJUALAN
    // =====================
    public function indexPengiriman()
    {
        $this->menu = 'pengiriman';
        return $this->dataUtama();
    }
    public function createPengiriman() {}
    public function storePengiriman(Request $request) {}
    public function editPengiriman($id) {}
    public function updatePengiriman(Request $request, $id) {}
    public function destroyPengiriman($id) {}

    // =====================
    // FAKTUR PENJUALAN
    // =====================
    public function indexFakturPenjualan()
    {
        $this->menu = 'fakturpenjualan';
        return $this->dataUtama();
    }
    public function createFakturPenjualan() {}
    public function storeFakturPenjualan(Request $request) {}
    public function editFakturPenjualan($id) {}
    public function updateFakturPenjualan(Request $request, $id) {}
    public function destroyFakturPenjualan($id) {}

    // =====================
    // FAKTUR PENAGIHAN
    // =====================
    public function indexFakturPenagihan()
    {
        $this->menu = 'fakturpenagihan';
        return $this->dataUtama();
    }
    public function createFakturPenagihan() {}
    public function storeFakturPenagihan(Request $request) {}
    public function editFakturPenagihan($id) {}
    public function updateFakturPenagihan(Request $request, $id) {}
    public function destroyFakturPenagihan($id) {}

    // =====================
    // PENERIMAAN PEMBAYARAN
    // =====================
    public function indexPenerimaan()
    {
        $this->menu = 'penerimaan';
        return $this->dataUtama();
    }
    public function createPenerimaan() {}
    public function storePenerimaan(Request $request) {}
    public function editPenerimaan($id) {}
    public function updatePenerimaan(Request $request, $id) {}
    public function destroyPenerimaan($id) {}

    // =====================
    // RETUR PENJUALAN
    // =====================
    public function indexRetur()
    {
        $this->menu = 'returpenjualan';
        return $this->dataUtama();
    }
    public function createRetur() {}
    public function storeRetur(Request $request) {}
    public function editRetur($id) {}
    public function updateRetur(Request $request, $id) {}
    public function destroyRetur($id) {}
}
