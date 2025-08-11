<?php

namespace App\Http\Controllers;

use App\Models\PenyesuaianBarang;
use App\Models\Barang;
use App\Models\PenyesuaianBarangDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenyesuaianBarangController extends Controller
{
    public function daftarPenyesuaian(Request $request)
    {
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        return view('penyesuaian.datapenyesuaian', compact('nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang'));
    }

    public function tambahPenyesuaian()
    {
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        $gudang = DB::table('gudang')->get();
        $departemen = DB::table('departemen')->get();
        $proyek = DB::table('proyek')->get();
        $pemasok = DB::table('pemasok')->get();
        $satuan = DB::table('satuan')->get();
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $nama_akun = DB::table('akun')->orderBy('nama', 'asc')->get();
        $prefix = 'GMP';
        $latest = PenyesuaianBarang::orderBy('no_penyesuaian', 'desc')->first();
        $nextID = $latest ? intval(substr($latest->no_penyesuaian, strlen($prefix))) + 1 : 1;
        $kodeBaru = $prefix . sprintf("%04d", $nextID);
        return view('penyesuaian.tambahpenyesuaian', compact('nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'proyek', 'pemasok', 'satuan', 'mata_uang', 'kodeBaru', 'nama_akun'));
    }

    // public function simpanPenyesuaian(Request $request)
    // {
    //     $rules = [
    //         'tgl_penyesuaian' => 'nullable|string|max:255',
    //         'akun_penyesuaian' => 'nullable|string|max:255',
    //         'no_akun_penyesuaian' => 'nullable|string|max:255',
    //         'deskripsi' => 'nullable|string|max:255',
    //         'nilai_penyesuaian_check' => 'nullable|boolean',
    //         'nilai_penyesuaian' => 'nullable|string|max:255',
    //         'pengguna_penyesuaian' => 'nullable|string|max:255',
    //         'total_nilai_penyesuaian' => 'nullable|string|max:255',
    //     ];

    //     $validated = $request->validate($rules);
    //     $validated['total_nilai_penyesuaian'] = str_replace(['Rp', '.', ' '], '', $request->total_nilai_penyesuaian);
    //     // $validated['total_saldo_awal'] = str_replace(['Rp', '.', ' '], '', $request->total_saldo_awal);
    //     // $validated['kuantitas_saldo_sekarang'] = str_replace(['Rp', '.', ' '], '', $request->kuantitas_saldo_sekarang);
    //     // $validated['harga_satuan_sekarang'] = str_replace(['Rp', '.', ' '], '', $request->harga_satuan_sekarang);
    //     // $validated['biaya_pokok_sekarang'] = str_replace(['Rp', '.', ' '], '', $request->biaya_pokok_sekarang);

    //     DB::beginTransaction();
    //     try {
    //         $penyesuaianBarang = new PenyesuaianBarang($validated);
    //         $penyesuaianBarang->save();

    //         $detail = new PenyesuaianBarangDetail();
    //         $detail->penyesuaian_barang_id = $penyesuaianBarang->id;
    //         $detail->no_barang = $request->no_barang;
    //         $detail->deskripsi_barang = $request->deskripsi_barang;
    //         $detail->kts_saat_ini = $request->kts_saat_ini;
    //         $detail->kts_baru = $request->kts_baru;
    //         $detail->nilai_saat_ini = $request->nilai_saat_ini;
    //         $detail->nilai_baru = $request->nilai_baru;
    //         $detail->departemen = $request->departemen;
    //         $detail->proyek = $request->proyek;
    //         $detail->gudang = $request->gudang;
    //         $checkboxAktif = $request->nilai_penyesuaian_check == 1;
    //         $kts_baru = (int) str_replace(['.', ',', ' '], '', $request->kts_baru);
    //         $kts_saat_ini = (int) str_replace(['.', ',', ' '], '', $request->kts_saat_ini);

    //         if ($checkboxAktif && $kts_baru <= $kts_saat_ini) {
    //             sweetalert()->warning('Jika checkbox aktif, Kuantitas Baru harus lebih besar dari Saldo Sekarang.');
    //             return back()->withInput();
    //         }

    //         if (!$checkboxAktif && $kts_baru >= $kts_saat_ini) {
    //             sweetalert()->warning('Jika checkbox tidak aktif, Kuantitas Baru harus lebih kecil dari Saldo Sekarang.');
    //             return back()->withInput();
    //         }
    //         $detail->save();

    //         Barang::where('no_barang', $request->no_barang)
    //                 ->update([
    //                     'kuantitas_saldo_awal' => $kts_baru,
    //                     'total_saldo_awal' => str_replace(['Rp', '.', ' '], '', $request->nilai_baru),
    //                     'departemen' => $request->departemen,
    //                     'proyek' => $request->proyek,
    //                     'default_gudang' => $request->gudang,
    //                 ]);

    //         DB::commit();
    //         sweetalert()->success('Create new Barang & Detail successfully :)');
    //         return redirect()->route('penyesuaian/list/page');

    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
    //         return redirect()->back()->withInput();
    //     }
    // }

    public function simpanPenyesuaian(Request $request)
    {
        $rules = [
            'tgl_penyesuaian' => 'required|string|max:255',
            'akun_penyesuaian' => 'nullable|string|max:255',
            'no_akun_penyesuaian' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
            'nilai_penyesuaian_check' => 'nullable|boolean',
            'nilai_penyesuaian' => 'nullable|string|max:255',
            'pengguna_penyesuaian' => 'nullable|string|max:255',
            'total_nilai_penyesuaian' => 'nullable|string|max:255',
        ];

        $message = [
            'tgl_penyesuaian.required' => 'Tanggal wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated['total_nilai_penyesuaian'] = str_replace(['Rp', '.', ' '], '', $request->total_nilai_penyesuaian);

        DB::beginTransaction();
        try {
            $penyesuaianBarang = new PenyesuaianBarang($validator->validated());
            $penyesuaianBarang->save();

            $kts_baru = (int) str_replace(['.', ',', ' '], '', $request->kts_baru);
            $kts_saat_ini = (int) str_replace(['.', ',', ' '], '', $request->kts_saat_ini);
            $nilai_baru = (int) str_replace(['Rp', '.', ',', ' '], '', $request->nilai_baru);
            $nilai_saat_ini = (int) str_replace(['Rp', '.', ',', ' '], '', $request->nilai_saat_ini);

            $selisih_kts = $kts_baru - $kts_saat_ini;
            $selisih_nilai = $nilai_baru - $nilai_saat_ini;

            $checkboxAktif = $request->nilai_penyesuaian_check == 1;

            if ($checkboxAktif && $kts_baru <= $kts_saat_ini) {
                sweetalert()->warning('Jika checkbox aktif, Kuantitas Baru harus lebih besar dari Saldo Sekarang.');
                return back()->withInput();
            }

            if (!$checkboxAktif && $kts_baru >= $kts_saat_ini) {
                sweetalert()->warning('Jika checkbox tidak aktif, Kuantitas Baru harus lebih kecil dari Saldo Sekarang.');
                return back()->withInput();
            }

            $detail = new PenyesuaianBarangDetail();
            $detail->penyesuaian_barang_id = $penyesuaianBarang->id;
            $detail->no_barang = $request->no_barang;
            $detail->deskripsi_barang = $request->deskripsi_barang;
            $detail->kts_saat_ini = $kts_saat_ini;
            $detail->kts_baru = $kts_baru;
            $detail->nilai_saat_ini = $nilai_saat_ini;
            $detail->nilai_baru = $nilai_baru;
            $detail->selisih_kts = $selisih_kts;
            $detail->selisih_nilai = $selisih_nilai;
            $detail->departemen = $request->departemen;
            $detail->proyek = $request->proyek;
            $detail->gudang = $request->gudang;
            $detail->save();

            Barang::where('no_barang', $request->no_barang)
                ->update([
                    'kuantitas_saldo_awal' => $kts_baru,
                    'total_saldo_awal' => $nilai_baru,
                    'departemen' => $request->departemen,
                    'proyek' => $request->proyek,
                    'default_gudang' => $request->gudang,
                ]);

            DB::commit();
            sweetalert()->success('Penyesuaian barang berhasil disimpan.');
            return redirect()->route('penyesuaian/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function editPenyesuaian($id)
    {
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        $gudang = DB::table('gudang')->get();
        $departemen = DB::table('departemen')->get();
        $proyek = DB::table('proyek')->get();
        $pemasok = DB::table('pemasok')->get();
        $satuan = DB::table('satuan')->get();
        $sub_barang = DB::table('barang')->get();
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $nama_akun = DB::table('akun')->orderBy('nama', 'asc')->get();
        // $penyesuaianBarangEdit = DB::table('penyesuaian_barang')->where('no_penyesuaian',$no_penyesuaian)->first();
        $penyesuaianBarang = PenyesuaianBarang::with('detail')->findOrFail($id);
        if (!$penyesuaianBarang) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('penyesuaian.ubahpenyesuaian', compact('penyesuaianBarang','nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'proyek', 'pemasok', 'satuan', 'sub_barang', 'mata_uang', 'nama_akun'));
    }

    public function updatePenyesuaian(Request $request, $id)
    {
        $rules = [
            'tgl_penyesuaian' => 'nullable|string|max:255',
            'akun_penyesuaian' => 'nullable|string|max:255',
            'no_akun_penyesuaian' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
            'nilai_penyesuaian_check' => 'nullable|boolean',
            'nilai_penyesuaian' => 'nullable|string|max:255',
            'pengguna_penyesuaian' => 'nullable|string|max:255',
            'total_nilai_penyesuaian' => 'nullable|string|max:255',
        ];

        $validated = $request->validate($rules);
        $validated['total_nilai_penyesuaian'] = str_replace(['Rp', '.', ' '], '', $request->total_nilai_penyesuaian);
        // $validated['total_saldo_awal'] = str_replace(['Rp', '.', ' '], '', $request->total_saldo_awal);
        // $validated['kuantitas_saldo_sekarang'] = str_replace(['Rp', '.', ' '], '', $request->kuantitas_saldo_sekarang);
        // $validated['harga_satuan_sekarang'] = str_replace(['Rp', '.', ' '], '', $request->harga_satuan_sekarang);
        // $validated['biaya_pokok_sekarang'] = str_replace(['Rp', '.', ' '], '', $request->biaya_pokok_sekarang);

        DB::beginTransaction();
        try {
            $penyesuaianBarang = PenyesuaianBarang::with('detail')->findOrFail($id);
            $penyesuaianBarang->update($validated);

            $detail = $penyesuaianBarang->detail ?? new PenyesuaianBarangDetail();
            $detail->penyesuaian_barang_id = $penyesuaianBarang->id;
            $detail->no_barang = $request->no_barang;
            $detail->deskripsi_barang = $request->deskripsi_barang;
            $detail->kts_saat_ini = $request->kts_baru;
            $detail->kts_baru = $request->kts_baru;
            $detail->nilai_saat_ini = $request->nilai_saat_ini;
            $detail->nilai_baru = $request->nilai_baru;
            $detail->departemen = $request->departemen;
            $detail->proyek = $request->proyek;
            $detail->gudang = $request->gudang;
            $checkboxAktif = $request->nilai_penyesuaian_check == 1;
            $kts_baru = (int) str_replace(['.', ',', ' '], '', $request->kts_baru);
            $kts_saat_ini = (int) str_replace(['.', ',', ' '], '', $request->kts_saat_ini);

            if ($checkboxAktif && $kts_baru <= $kts_saat_ini) {
                sweetalert()->warning('Jika checkbox aktif, Kuantitas Baru harus lebih besar dari Saldo Sekarang.');
                return back()->withInput();
            }

            if (!$checkboxAktif && $kts_baru >= $kts_saat_ini) {
                sweetalert()->warning('Jika checkbox tidak aktif, Kuantitas Baru harus lebih kecil dari Saldo Sekarang.');
                return back()->withInput();
            }
            $detail->save();

            Barang::where('no_barang', $request->no_barang)
                    ->update([
                        'kuantitas_saldo_awal' => $kts_baru,
                        'total_saldo_awal' => str_replace(['Rp', '.', ' '], '', $request->nilai_baru),
                        'departemen' => $request->departemen,
                        'proyek' => $request->proyek,
                        'default_gudang' => $request->gudang,
                    ]);
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('penyesuaian/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function hapusPenyesuaian(Request $request)
    {
        try {
            $ids = $request->ids;
            PenyesuaianBarang::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('penyesuaian/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function dataPenyesuaian(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $penyesuaianNoFilter  = $request->get('no_penyesuaian');
        $penyesuaianTanggalFilter  = $request->get('tgl_penyesuaian');


        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $penyesuaian = DB::table('penyesuaian_barang')
        ->join('penyesuaian_barang_detail', 'penyesuaian_barang.id', '=', 'penyesuaian_barang_detail.penyesuaian_barang_id')
        ->select(
            'penyesuaian_barang.id',
            'penyesuaian_barang.no_penyesuaian',
            'penyesuaian_barang.tgl_penyesuaian',
            'penyesuaian_barang.akun_penyesuaian',
            'penyesuaian_barang.nilai_penyesuaian',
            'penyesuaian_barang.deskripsi',
            'penyesuaian_barang.total_nilai_penyesuaian',
            'penyesuaian_barang.pengguna_penyesuaian',
            'penyesuaian_barang.no_persetujuan',
            'penyesuaian_barang_detail.no_barang',
            'penyesuaian_barang_detail.deskripsi_barang',
            'penyesuaian_barang_detail.kts_saat_ini',
            'penyesuaian_barang_detail.kts_baru',
            'penyesuaian_barang_detail.nilai_saat_ini',
            'penyesuaian_barang_detail.nilai_baru',
            'penyesuaian_barang_detail.departemen',
            'penyesuaian_barang_detail.proyek',
            'penyesuaian_barang_detail.gudang'
        );
        $totalRecords = $penyesuaian->count();

        if ($penyesuaianNoFilter) {
            $penyesuaian->where('no_penyesuaian', 'like', '%' . $penyesuaianNoFilter . '%');
        }

        if ($penyesuaianTanggalFilter) {
            $penyesuaian->where('tgl_penyesuaian', $penyesuaianTanggalFilter);
        }
        
        if ($request->filled('tgl_mulai') && $request->filled('tgl_sampai')) {
            $penyesuaian->whereBetween('tgl_penyesuaian', [$request->tgl_mulai, $request->tgl_sampai]);
        } elseif ($request->filled('tgl_mulai')) {
            $penyesuaian->whereDate('tgl_penyesuaian', '>=', $request->tgl_mulai);
        } elseif ($request->filled('tgl_sampai')) {
            $penyesuaian->whereDate('tgl_penyesuaian', '<=', $request->tgl_sampai);
        }

        // if ($penyesuaianTipePersediaanFilter) {
        //     $penyesuaian->where('tipe_persediaan', $penyesuaianTipePersediaanFilter);
        // }

        // if ($penyesuaianTipeBarangFilter) {
        //     $penyesuaian->where('tipe_barang', $penyesuaianTipeBarangFilter);
        // }

        // if ($penyesuaianDihentikanFilter  !== null && $penyesuaianDihentikanFilter !== '') {
        //     $penyesuaian->where('dihentikan', $penyesuaianDihentikanFilter);
        // }

        $totalRecordsWithFilter = $penyesuaian->count();

        $records = $penyesuaian
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="penyesuaian_checkbox" value="'.$record->id.'">';
        
            $data_arr[] = [
                "checkbox"                => $checkbox,
                "no"                      => $start + $key + 1,
                "id"                      => $record->id,
                "no_penyesuaian"          => $record->no_penyesuaian,
                "tgl_penyesuaian"         => $record->tgl_penyesuaian,
                "akun_penyesuaian"        => $record->akun_penyesuaian,
                "nilai_penyesuaian"       => $record->nilai_penyesuaian,
                "deskripsi"               => $record->deskripsi,
                'total_nilai_penyesuaian' => 'Rp ' . number_format((float) $record->total_nilai_penyesuaian, 0, ',', '.'),
                "pengguna_penyesuaian"    => $record->pengguna_penyesuaian,
                "no_persetujuan"          => $record->no_persetujuan,
                "no_barang"               => $record->no_barang,
                "deskripsi_barang"        => $record->deskripsi_barang,
                "kts_saat_ini"            => $record->kts_saat_ini,
                "kts_baru"                => $record->kts_baru,
                "nilai_saat_ini"          => $record->nilai_saat_ini,
                "nilai_baru"              => $record->nilai_baru,
                "departemen"              => $record->departemen,
                "proyek"                  => $record->proyek,
                "gudang"                  => $record->gudang,
            ];
        }        
        
        return response()->json([
            "draw"                 => intval($draw),
            "recordsTotal"         => $totalRecords,
            "recordsFiltered"      => $totalRecordsWithFilter,
            "data"                 => $data_arr
        ])->header('Content-Type', 'application/json');        
    }
}
