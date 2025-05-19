<?php

namespace App\Http\Controllers;

use App\Models\PermintaanPembelian;
use App\Models\PermintaanPembelianDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PermintaanPembelianController extends Controller
{

    public function tambahPermintaan()
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
        $nama_akun = '';
        $prefix = 'GMP';
        $latest = PermintaanPembelian::orderBy('no_permintaan', 'desc')->first();
        $nextID = $latest ? intval(substr($latest->no_permintaan, strlen($prefix))) + 1 : 1;
        $kodeBaru = $prefix . sprintf("%04d", $nextID);
        return view('pembelian/permintaan.tambahpermintaan', compact('nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'proyek', 'pemasok', 'satuan', 'mata_uang', 'kodeBaru', 'nama_akun'));
    }

    public function simpanPermintaan(Request $request)
    {
        $rules = [
            'tgl_permintaan'            => 'nullable|string|max:255',
            'deskripsi_permintaan'      => 'nullable|string|max:255',
            'tindak_lanjut_check'       => 'nullable|boolean',
            'urgent_check'              => 'nullable|boolean',
            'deskripsi_1'               => 'nullable|string|max:255',
            'catatan_pemeriksaan_check' => 'nullable|boolean',
            'deskripsi_2'               => 'nullable|string|max:255',
            // 'status_permintaan'      => 'nullable|string|max:255',
            'pengguna_permintaan'       => 'nullable|string|max:255',
            'no_barang.*'               => 'nullable|string|max:255',
            'deskripsi_barang.*'        => 'nullable|string|max:255',
            'kts_permintaan.*'          => 'nullable|string|max:255',
            'satuan.*'                  => 'nullable|string|max:255',
            'catatan.*'                 => 'nullable|string|max:255',
            'tgl_diminta.*'             => 'nullable|string|max:255',
            'kts_dipesan.*'             => 'nullable|string|max:255',
            'kts_diterima.*'            => 'nullable|string|max:255',
            'proyek'                    => 'nullable|string|max:255',
            'gudang'                    => 'nullable|string|max:255',
            'departemen'                => 'nullable|string|max:255',
        ];

        $validated = $request->validate($rules);

        DB::beginTransaction();
        try {

            $jumlahBarang = count($request->no_barang);
            for ($i = 0; $i < $jumlahBarang; $i++){
                $permintaan = new PermintaanPembelian($validated);
                $permintaan->save();

                $detail = new PermintaanPembelianDetail();
                $detail->permintaan_pembelian_id = $permintaan->id;
                $detail->no_barang               = $request->no_barang[$i];
                $detail->deskripsi_barang        = $request->deskripsi_barang[$i];
                $detail->kts_permintaan          = $request->kts_permintaan[$i];
                $detail->satuan                  = $request->satuan[$i];
                $detail->catatan                 = $request->catatan[$i];
                $detail->tgl_diminta             = $request->tgl_diminta[$i];
                $detail->kts_dipesan             = $request->kts_dipesan[$i];
                $detail->kts_diterima            = $request->kts_diterima[$i];
                $detail->save();
            }
            
            // $checkboxAktif = $request->nilai_permintaan_check == 1;
            // $kts_baru = (int) str_replace(['.', ',', ' '], '', $request->kts_baru);
            // $kts_saat_ini = (int) str_replace(['.', ',', ' '], '', $request->kts_saat_ini);

            // if ($checkboxAktif && $kts_baru <= $kts_saat_ini) {
            //     sweetalert()->warning('Jika checkbox aktif, Kuantitas Baru harus lebih besar dari Saldo Sekarang.');
            //     return back()->withInput();
            // }

            // if (!$checkboxAktif && $kts_baru >= $kts_saat_ini) {
            //     sweetalert()->warning('Jika checkbox tidak aktif, Kuantitas Baru harus lebih kecil dari Saldo Sekarang.');
            //     return back()->withInput();
            // }
            $detail->save();

            // Barang::where('no_barang', $request->no_barang)
            //         ->update([
            //             'kuantitas_saldo_awal' => $kts_baru,
            //             'total_saldo_awal' => str_replace(['Rp', '.', ' '], '', $request->nilai_baru),
            //             'departemen' => $request->departemen,
            //             'proyek' => $request->proyek,
            //             'default_gudang' => $request->gudang,
            //         ]);

            DB::commit();
            sweetalert()->success('Create new Barang & Detail successfully :)');
            return redirect()->route('pembelian/permintaan/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function editPermintaan($id)
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
        $permintaanPembelian = PermintaanPembelian::with('detail')->findOrFail($id);
        if (!$permintaanPembelian) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('pembelian/permintaan.ubahpermintaan', compact('permintaanPembelian','nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'proyek', 'pemasok', 'satuan', 'sub_barang', 'mata_uang', 'nama_akun'));
    }

    public function updatePermintaan(Request $request, $id)
    {
        $rules = [
            'tgl_permintaan'            => 'nullable|string|max:255',
            'deskripsi_permintaan'      => 'nullable|string|max:255',
            'tindak_lanjut_check'       => 'nullable|boolean',
            'urgent_check'              => 'nullable|boolean',
            'deskripsi_1'               => 'nullable|string|max:255',
            'catatan_pemeriksaan_check' => 'nullable|boolean',
            'deskripsi_2'               => 'nullable|string|max:255',
            // 'status_permintaan'      => 'nullable|string|max:255',
            'pengguna_permintaan'       => 'nullable|string|max:255',
            'no_barang.*'               => 'nullable|string|max:255',
            'deskripsi_barang.*'        => 'nullable|string|max:255',
            'kts_permintaan.*'          => 'nullable|string|max:255',
            'satuan.*'                  => 'nullable|string|max:255',
            'catatan.*'                 => 'nullable|string|max:255',
            'tgl_diminta.*'             => 'nullable|string|max:255',
            'kts_dipesan.*'             => 'nullable|string|max:255',
            'kts_diterima.*'            => 'nullable|string|max:255',
            'proyek'                    => 'nullable|string|max:255',
            'gudang'                    => 'nullable|string|max:255',
            'departemen'                => 'nullable|string|max:255',
        ];

        $validated = $request->validate($rules);

        DB::beginTransaction();
        try {
            $permintaanPembelian = PermintaanPembelian::with('detail')->findOrFail($id);
            $permintaanPembelian->pengguna_permintaan = $request->pengguna_permintaan;
            $permintaanPembelian->update($validated);

            PermintaanPembelianDetail::where('permintaan_pembelian_id', $permintaanPembelian->id)->delete();

            $jumlahBarang = count($request->no_barang);
            for ($i = 0; $i < $jumlahBarang; $i++){
                $detail = new PermintaanPembelianDetail();
                $detail->permintaan_pembelian_id = $permintaanPembelian->id;
                $detail->no_barang               = $request->no_barang[$i];
                $detail->deskripsi_barang        = $request->deskripsi_barang[$i];
                $detail->kts_permintaan          = $request->kts_permintaan[$i];
                $detail->satuan                  = $request->satuan[$i];
                $detail->catatan                 = $request->catatan[$i];
                $detail->tgl_diminta             = $request->tgl_diminta[$i];
                $detail->kts_dipesan             = $request->kts_dipesan[$i];
                $detail->kts_diterima            = $request->kts_diterima[$i];
                $detail->save();
            }
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('pembelian/permintaan/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function hapusPermintaan(Request $request)
    {
        try {
            $ids = $request->ids;
            PermintaanPembelian::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('pembelian/permintaan/list/page');    

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function daftarPermintaan(Request $request)
    {
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        
        return view('pembelian/permintaan.datapermintaan', compact('routeFetch','nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang'));
    }

    public function dataPermintaan(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $permintaanNoFilter  = $request->get('no_permintaan');
        $permintaanTanggalFilter  = $request->get('tgl_permintaan');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $permintaan = DB::table('permintaan_pembelian')
        ->join('permintaan_pembelian_detail', 'permintaan_pembelian.id', '=', 'permintaan_pembelian_detail.permintaan_pembelian_id')
        ->select(
            'permintaan_pembelian.id',
            'permintaan_pembelian.no_permintaan',
            'permintaan_pembelian.tgl_permintaan',
            'permintaan_pembelian.deskripsi_permintaan',
            'permintaan_pembelian.pengguna_permintaan',
            'permintaan_pembelian.tindak_lanjut_check',
            'permintaan_pembelian.urgent_check',
            'permintaan_pembelian.catatan_pemeriksaan_check',
            'permintaan_pembelian_detail.no_barang',
            'permintaan_pembelian_detail.deskripsi_barang',
            'permintaan_pembelian_detail.kts_permintaan',
            'permintaan_pembelian_detail.satuan',
            'permintaan_pembelian_detail.catatan',
            'permintaan_pembelian_detail.tgl_diminta',
            'permintaan_pembelian_detail.kts_dipesan',
            'permintaan_pembelian_detail.kts_diterima',
            'permintaan_pembelian_detail.tutup_check_all',
            'permintaan_pembelian_detail.tutup_check_items',
        );
        $totalRecords = $permintaan->count();

        if ($permintaanNoFilter) {
            $permintaan->where('no_permintaan', 'like', '%' . $permintaanNoFilter . '%');
        }

        if ($permintaanTanggalFilter) {
            $permintaan->where('tgl_permintaan', $permintaanTanggalFilter);
        }
        
        if ($request->filled('tgl_mulai') && $request->filled('tgl_sampai')) {
            $permintaan->whereBetween('tgl_permintaan', [$request->tgl_mulai, $request->tgl_sampai]);
        } elseif ($request->filled('tgl_mulai')) {
            $permintaan->whereDate('tgl_permintaan', '>=', $request->tgl_mulai);
        } elseif ($request->filled('tgl_sampai')) {
            $permintaan->whereDate('tgl_permintaan', '<=', $request->tgl_sampai);
        }

        // if ($permintaanTipePersediaanFilter) {
        //     $permintaan->where('tipe_persediaan', $permintaanTipePersediaanFilter);
        // }

        // if ($permintaanTipeBarangFilter) {
        //     $permintaan->where('tipe_barang', $permintaanTipeBarangFilter);
        // }

        // if ($permintaanDihentikanFilter  !== null && $permintaanDihentikanFilter !== '') {
        //     $permintaan->where('dihentikan', $permintaanDihentikanFilter);
        // }

        $totalRecordsWithFilter = $permintaan->count();

        $records = $permintaan
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="permintaan_checkbox" value="'.$record->id.'">';
        
            $data_arr[] = [
                "checkbox"                  => $checkbox,
                "no"                        => $start + $key + 1,
                "id"                        => $record->id,
                "no_permintaan"             => $record->no_permintaan,
                "tgl_permintaan"            => $record->tgl_permintaan,
                "deskripsi_permintaan"      => $record->deskripsi_permintaan,
                "pengguna_permintaan"       => $record->pengguna_permintaan,
                "tindak_lanjut_check"       => $record->tindak_lanjut_check,
                "urgent_check"              => $record->urgent_check,
                "catatan_pemeriksaan_check" => $record->catatan_pemeriksaan_check,
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
