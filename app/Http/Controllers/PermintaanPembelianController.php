<?php

namespace App\Http\Controllers;

use App\Models\PermintaanPembelian;
use App\Models\PermintaanPembelianDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;


class PermintaanPembelianController extends Controller
{
    public function tambahPermintaan(Request $request)
    {
        if ($request->ajax()) {
            $nama_barang = DB::table('barang');

            if ($request->no_barang) {
                $nama_barang->where('no_barang', 'like', '%' . $request->no_barang . '%');
            }

            if ($request->nama_barang) {
                $nama_barang->where('nama_barang', 'like', '%' . $request->nama_barang . '%');
            }

            if ($request->kategori_barang) {
                $nama_barang->where('kategori_barang', $request->kategori_barang);
            }
        
            if ($request->tipe_persediaan) {
                $nama_barang->where('tipe_persediaan', $request->tipe_persediaan);
            }

            if ($request->default_gudang) {
                $nama_barang->where('default_gudang', $request->default_gudang);
            }

            $result = $nama_barang->get();
            return response()->json($result);
        }

        $tipe_barang = DB::table('tipe_barang')->get();
        $barang = DB::table('barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        $gudang = DB::table('gudang')->get();
        $departemen = DB::table('departemen')->get();
        $proyek = DB::table('proyek')->get();
        $pemasok = DB::table('pemasok')->get();
        $satuan = DB::table('satuan')->get();
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $nama_akun = DB::table('akun')->orderBy('nama_akun_indonesia', 'asc')->get();
        $prefix = 'GMP';
        $latest = PermintaanPembelian::orderBy('no_permintaan', 'desc')->first();
        $nextID = $latest ? intval(substr($latest->no_permintaan, strlen($prefix))) + 1 : 1;
        $kodeBaru = $prefix . sprintf("%04d", $nextID);

        return view('pembelian/permintaan.tambahpermintaan', compact('barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'proyek', 'pemasok', 'satuan', 'mata_uang', 'kodeBaru', 'nama_akun'));
    }

    public function simpanPermintaan(Request $request)
    {
        $rules = [
            'tgl_permintaan'            => 'required|string|max:255',
            'disetujui_check'           => 'nullable|boolean',
            'deskripsi_permintaan'      => 'nullable|string|max:255',
            'tindak_lanjut_check'       => 'nullable|boolean',
            'urgent_check'              => 'nullable|boolean',
            'deskripsi_1'               => 'nullable|string|max:255',
            'catatan_pemeriksaan_check' => 'nullable|boolean',
            'disetujui_check'           => 'nullable|boolean',
            'deskripsi_2'               => 'nullable|string|max:255',
            'status_permintaan'         => 'nullable|string|max:255',
            'pengguna_permintaan'       => 'nullable|string|max:255',
            'no_barang.*'               => 'nullable|string|max:255',
            'deskripsi_barang.*'        => 'nullable|string|max:255',
            'kts_permintaan.*'          => 'required|numeric|min:1',
            'satuan.*'                  => 'nullable|string|max:255',
            'catatan.*'                 => 'nullable|string|max:255',
            'tgl_diminta.*'             => 'nullable|string|max:255',
            'kts_dipesan.*'             => 'nullable|string|max:255',
            'kts_diterima.*'            => 'nullable|string|max:255',
            'proyek'                    => 'required|string|max:255',
            'gudang'                    => 'required|string|max:255',
            'departemen'                => 'required|string|max:255',
        ];

        $message = [
            'kts_permintaan.*.required' => 'Kuantitas wajib diisi untuk setiap barang',
            'kts_permintaan.*.numeric'  => 'Kuantitas harus berupa angka',
            'kts_permintaan.*.min'      => 'Kuantitas minimal 1',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            $permintaan = new PermintaanPembelian($validator->validated());
            $permintaan->save();

            $jumlahBarang = count($request->no_barang);
            for ($i = 0; $i < $jumlahBarang; $i++){
                $detail = new PermintaanPembelianDetail();
                $detail->permintaan_pembelian_id = $permintaan->id;
                $detail->no_barang               = $request->no_barang[$i];
                $detail->deskripsi_barang        = $request->deskripsi_barang[$i];
                $detail->kts_permintaan          = $request->kts_permintaan[$i];
                $detail->satuan                  = $request->satuan[$i];
                $detail->harga_satuan            = $request->harga_satuan[$i];
                $detail->jumlah_total_harga      = $request->jumlah_total_harga[$i];
                $detail->catatan                 = $request->catatan[$i];
                $detail->tgl_diminta             = $request->tgl_diminta[$i];
                $detail->kts_dipesan             = $request->kts_dipesan[$i];
                $detail->kts_diterima            = $request->kts_diterima[$i];
                $detail->save();
            }
    
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
        $nama_akun = DB::table('akun')->orderBy('nama_akun_indonesia', 'asc')->get();
        // $penyesuaianBarangEdit = DB::table('penyesuaian_barang')->where('no_penyesuaian',$no_penyesuaian)->first();
        $permintaanPembelian = PermintaanPembelian::with(['detail', 'detail2'])->findOrFail($id);
        if (!$permintaanPembelian) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('pembelian/permintaan.ubahpermintaan', compact('permintaanPembelian','nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'proyek', 'pemasok', 'satuan', 'sub_barang', 'mata_uang', 'nama_akun'));
    }

    public function updatePermintaan(Request $request, $id)
    {
        $rules = [
            'tgl_permintaan'            => 'required|string|max:255',
            'deskripsi_permintaan'      => 'nullable|string|max:255',
            'tindak_lanjut_check'       => 'nullable|boolean',
            'urgent_check'              => 'nullable|boolean',
            'deskripsi_1'               => 'nullable|string|max:255',
            'catatan_pemeriksaan_check' => 'nullable|boolean',
            'disetujui_check'           => 'nullable|boolean',
            'tutup_check_all'           => 'nullable|boolean',
            'deskripsi_2'               => 'nullable|string|max:255',
            'status_permintaan'         => 'nullable|string|max:255',
            'pengguna_permintaan'       => 'nullable|string|max:255',
            'no_barang.*'               => 'nullable|string|max:255',
            'deskripsi_barang.*'        => 'nullable|string|max:255',
            'kts_permintaan.*'          => 'nullable|string|max:255',
            'satuan.*'                  => 'nullable|string|max:255',
            'catatan.*'                 => 'nullable|string|max:255',
            'tgl_diminta.*'             => 'nullable|string|max:255',
            'kts_dipesan.*'             => 'nullable|string|max:255',
            'kts_diterima.*'            => 'nullable|string|max:255',
            'tutup_check_items.*'       => 'nullable|boolean',
            'proyek'                    => 'required|string|max:255',
            'gudang'                    => 'required|string|max:255',
            'departemen'                => 'required|string|max:255',
        ];

        $validated = $request->validate($rules);

        DB::beginTransaction();
        try {
            $permintaanPembelian = PermintaanPembelian::with('detail')->findOrFail($id);
            $permintaanPembelian->pengguna_permintaan = $request->pengguna_permintaan;
            if ($request->disetujui_check && !$permintaanPembelian->no_persetujuan) {
                $permintaanPembelian->no_persetujuan = PermintaanPembelian::generateNoPersetujuan();
            }
            $permintaanPembelian->update($validated);

            PermintaanPembelianDetail::where('permintaan_pembelian_id', $permintaanPembelian->id)->delete();

            $jumlahBarang = count($request->no_barang);
            for ($i = 0; $i < $jumlahBarang; $i++){
                $tutup_check_all = $request->tutup_check_all;

                $detail = new PermintaanPembelianDetail();
                $detail->permintaan_pembelian_id = $permintaanPembelian->id;
                $detail->tutup_check_all         = $tutup_check_all;
                $detail->no_barang               = $request->no_barang[$i];
                $detail->deskripsi_barang        = $request->deskripsi_barang[$i];
                $detail->kts_permintaan          = $request->kts_permintaan[$i];
                $detail->satuan                  = $request->satuan[$i];
                $detail->harga_satuan            = $request->harga_satuan[$i];
                $detail->jumlah_total_harga      = $request->jumlah_total_harga[$i];
                $detail->catatan                 = $request->catatan[$i];
                $detail->tgl_diminta             = $request->tgl_diminta[$i];
                $detail->kts_dipesan             = $request->kts_dipesan[$i];
                $detail->kts_diterima            = $request->kts_diterima[$i];
                $detail->tutup_check_items       = $request->tutup_check_items[$i];
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
        $pengguna_permintaan = DB::table('permintaan_pembelian')
            ->select('pengguna_permintaan')
            ->distinct()
            ->get();

        return view('pembelian/permintaan.datapermintaan', compact('nama_barang','tipe_barang', 'tipe_persediaan','pengguna_permintaan'));
    }
    
    public function dataPermintaan(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length          = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $permintaanPembelianNoFilter        = $request->get('no_permintaan');
        $permintaanPembelianDeskripsiFilter = $request->get('deskripsi_permintaan');
        $permintaanPembelianPenggunaFilter = $request->get('pengguna_permintaan');
        $permintaanPembelianCatatanPemeriksaanFilter = $request->get('catatan_pemeriksaan_check');
        $permintaanPembelianPersetujuanFilter = $request->get('disetujui_check');
        $permintaanPembelianUrgentFilter = $request->get('urgent_check');
        $permintaanPembelianRTindakLanjutFilter = $request->get('tindak_lanjut_check');
        $permintaanPembelianStatusFilter = $request->get('status_permintaan');


        $columnIndex     = $columnIndex_arr[0]['column'];
        $columnName      = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];

        $query = DB::table('permintaan_pembelian');

        if ($permintaanPembelianNoFilter) {
            $query->where('no_permintaan', 'like', '%' . $permintaanPembelianNoFilter . '%');
        }

        if ($permintaanPembelianDeskripsiFilter) {
            $query->where('deskripsi_permintaan', 'like', '%' . $permintaanPembelianDeskripsiFilter . '%');
        }

        if ($permintaanPembelianPenggunaFilter) {
            $query->where('pengguna_permintaan', $permintaanPembelianPenggunaFilter);
        }

        if ($permintaanPembelianCatatanPemeriksaanFilter !== null && $permintaanPembelianCatatanPemeriksaanFilter !== '') {
            $query->where('catatan_pemeriksaan_check', $permintaanPembelianCatatanPemeriksaanFilter);
        }

        if ($permintaanPembelianPersetujuanFilter !== null && $permintaanPembelianPersetujuanFilter !== '') {
            $query->where('disetujui_check', $permintaanPembelianPersetujuanFilter);
        }

        if ($permintaanPembelianUrgentFilter !== null && $permintaanPembelianUrgentFilter !== '') {
            $query->where('urgent_check', $permintaanPembelianUrgentFilter);
        }

        if ($permintaanPembelianRTindakLanjutFilter !== null && $permintaanPembelianRTindakLanjutFilter !== '') {
            $query->where('tindak_lanjut_check', $permintaanPembelianRTindakLanjutFilter);
        }

        if ($permintaanPembelianStatusFilter) {
            $query->where('status_permintaan', $permintaanPembelianStatusFilter);
        }

        $totalRecordsWithFilter = $query->count();
        $totalRecords = DB::table('permintaan_pembelian')->count();

        // $records = $query
        //     ->orderBy($columnName, $columnSortOrder)
        //     ->offset($start)
        //     ->limit($length)
        //     ->get();

        $tableName  = (new PermintaanPembelian)->getTable();
        $cols       = Schema::getColumnListing($tableName);
        $sortColumn = in_array($columnName, $cols, true) ? $columnName : 'id';
        $sortDir    = strtolower($columnSortOrder) === 'desc' ? 'desc' : 'asc';

        $records = $query->orderBy($sortColumn, $sortDir)->offset($start)->limit($length)->get();

        $data_arr = [];

        foreach ($records as $key => $record) {
            $detail = DB::table('permintaan_pembelian_detail')
                ->where('permintaan_pembelian_id', $record->id)
                ->first();

            $checkbox = '<input type="checkbox" class="permintaan_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"                  => $checkbox,
                "no"                        => $start + $key + 1,
                "id"                        => $record->id,
                "no_permintaan"             => $record->no_permintaan,
                "no_persetujuan"             => $record->no_persetujuan,
                "tgl_permintaan"            => $record->tgl_permintaan,
                "deskripsi_permintaan"      => $record->deskripsi_permintaan,
                "pengguna_permintaan"       => $record->pengguna_permintaan,
                "tindak_lanjut_check"       => $record->tindak_lanjut_check,
                "status_permintaan"         => $record->status_permintaan,
                "urgent_check"              => $record->urgent_check,
                "catatan_pemeriksaan_check" => $record->catatan_pemeriksaan_check,
                "disetujui_check"           => $record->disetujui_check,
                "deskripsi_barang"          => $detail->deskripsi_barang ?? null,
            ];
        }

        return response()->json([
            "draw"            => intval($draw),
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecordsWithFilter,
            "data"            => $data_arr
        ])->header('Content-Type', 'application/json');
    }

}
