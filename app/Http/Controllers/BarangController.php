<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokBarang;
use App\Models\PenyesuaianBarang;
use App\Models\PenyesuaianBarangDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function daftarBarang(Request $request)
    {
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        return view('barang.databarang', compact('nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang'));
    }

    public function tambahBarang()
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
        // $prefix = 'GMPSCR-';
        // $latest = Barang::orderBy('no_barang', 'desc')->first();
        // $nextID = $latest ? intval(substr($latest->no_barang, strlen($prefix))) + 1 : 1;
        // $kodeBaru = $prefix . sprintf("%04d", $nextID);
        return view('barang.tambahbarang', compact('nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'proyek', 'pemasok', 'satuan', 'mata_uang'));
    }

    public function simpanBarang(Request $request)
    {
        $rules = [
            'no_barang' => 'nullable|string|max:255',
            'nama_barang' => 'nullable|string|max:255',
            'tipe_barang' => 'nullable|string|max:255',
            'tipe_persediaan' => 'nullable|string|max:255',
            'kategori_barang' => 'nullable|string|max:255',
            'sub_barang_check' => 'nullable|boolean',
            'sub_barang' => 'nullable|string|max:255',
            'deskripsi_1' => 'nullable|string|max:255',
            'deskripsi_2' => 'nullable|string|max:255',
            'default_gudang' => 'nullable|exists:gudang,id',
            'departemen' => 'nullable|string|max:255',
            'proyek' => 'nullable|string|max:255',
            'dihentikan' => 'nullable|boolean',
            'diskon' => 'nullable|string|max:255',
            'kode_pajak' => 'nullable|string|max:255',
            'pemasok' => 'nullable|string|max:255',
            'minimum_kuantitas_pesan_ulang' => 'nullable|string|max:255',
            'kuantitas_saldo_awal' => 'nullable|numeric',
            'biaya_satuan_saldo_awal' => 'nullable|string|max:255',
            'total_saldo_awal' => 'nullable|string|max:255',
            'kuantitas_saldo_sekarang' => 'nullable|string|max:255',
            'harga_satuan_sekarang' => 'nullable|string|max:255',
            'biaya_pokok_sekarang' => 'nullable|string|max:255',
            'gudang' => 'nullable|string|max:255',
            'tanggal_mulai' => 'nullable|string|max:255',
            'minimal_harga_jual' => 'nullable|string|max:255',
            'maksimal_harga_jual' => 'nullable|string|max:255',
            'minimal_harga_beli' => 'nullable|string|max:255',
            'maksimal_harga_beli' => 'nullable|string|max:255',
            'nomor_upc' => 'nullable|string|max:255',
            'nilai_penyesuaian' => 'nullable|string|max:255',
            'nomor_plu' => 'nullable|string|max:255',
            'satuan' => 'nullable|string|max:255',
            'rasio' => 'nullable|string|max:255',
            'merk_barang' => 'nullable|string|max:255',
            'level_harga_1' => 'nullable|string|max:255',
            'level_harga_2' => 'nullable|string|max:255',
            'level_harga_3' => 'nullable|string|max:255',
            'level_harga_4' => 'nullable|string|max:255',
            'level_harga_5' => 'nullable|string|max:255',
        ];

        for ($i = 1; $i <= 7; $i++) {
            $rules["fileupload_{$i}"] = 'nullable|string|max:255';
        }

        $validated = $request->validate($rules);
        $validated['biaya_satuan_saldo_awal'] = str_replace(['Rp', '.', ' '], '', $validated['biaya_satuan_saldo_awal']);
        $validated['total_saldo_awal'] = str_replace(['Rp', '.', ' '], '', $validated['total_saldo_awal']);
        $validated['kuantitas_saldo_sekarang'] = str_replace(['Rp', '.', ' '], '', $validated['kuantitas_saldo_sekarang']);
        $validated['harga_satuan_sekarang'] = str_replace(['Rp', '.', ' '], '', $validated['harga_satuan_sekarang']);
        $validated['biaya_pokok_sekarang'] = str_replace(['Rp', '.', ' '], '', $validated['biaya_pokok_sekarang']);

        DB::beginTransaction();
        try {
            $barang = new Barang($validated);
            $barang->save();

            $stokBarang = new StokBarang();
            $stokBarang->barang_id = $barang->id;
            $stokBarang->gudang_id = $validated['default_gudang'];
            $stokBarang->jumlah = $validated['kuantitas_saldo_awal'] ?? 0;
            $stokBarang->save();
        
            $penyesuaian = new PenyesuaianBarang();
            $penyesuaian->tgl_penyesuaian = date('d/m/Y');
            $penyesuaian->akun_penyesuaian = 'Default Akun';
            $penyesuaian->nilai_penyesuaian = $validated['nilai_penyesuaian'];
            $penyesuaian->pengguna_penyesuaian = auth()->user()->email;
            $penyesuaian->total_nilai_penyesuaian = $validated['total_saldo_awal'];
            $penyesuaian->save();
        
            $barangPenyesuaian = new PenyesuaianBarangDetail();
            $barangPenyesuaian->penyesuaian_barang_id = $penyesuaian->id;
            $barangPenyesuaian->no_barang = $validated['no_barang'];
            $barangPenyesuaian->deskripsi_barang = $validated['nama_barang'];
            $barangPenyesuaian->departemen = $validated['departemen'];
            $barangPenyesuaian->proyek = $validated['proyek'];
            $barangPenyesuaian->gudang = $validated['default_gudang'];
            $barangPenyesuaian->kts_saat_ini = $validated['kuantitas_saldo_awal'];
            $barangPenyesuaian->nilai_saat_ini = $validated['biaya_satuan_saldo_awal'];
            $barangPenyesuaian->save();
        
            DB::commit();
            sweetalert()->success('Create new Barang + Penyesuaian berhasil :)');
            return redirect()->route('barang/list/page');
        
        }catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function editBarang($id)
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
        $Barang = Barang::findOrFail($id);
        if (!$Barang) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('barang.ubahbarang', compact('Barang','nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'proyek', 'pemasok', 'satuan', 'sub_barang', 'mata_uang'));
    }

    public function updateBarang(Request $request, $id)
    {
        $rules = [
            'no_barang' => 'nullable|string|max:255',
            'nama_barang' => 'nullable|string|max:255',
            'tipe_barang' => 'nullable|string|max:255',
            'tipe_persediaan' => 'nullable|string|max:255',
            'kategori_barang' => 'nullable|string|max:255',
            'sub_barang_check' => 'nullable|boolean',
            'sub_barang' => 'nullable|string|max:255',
            'deskripsi_1' => 'nullable|string|max:255',
            'deskripsi_2' => 'nullable|string|max:255',
            'default_gudang' => 'nullable|string|max:255',
            'departemen' => 'nullable|string|max:255',
            'proyek' => 'nullable|string|max:255',
            'dihentikan' => 'nullable|boolean',
            'diskon' => 'nullable|string|max:255',
            'kode_pajak' => 'nullable|string|max:255',
            'pemasok' => 'nullable|string|max:255',
            'minimum_kuantitas_pesan_ulang' => 'nullable|string|max:255',
            'kuantitas_saldo_awal' => 'nullable|string|max:255',
            'biaya_satuan_saldo_awal' => 'nullable|string|max:255',
            'total_saldo_awal' => 'nullable|string|max:255',
            'kuantitas_saldo_sekarang' => 'nullable|string|max:255',
            'harga_satuan_sekarang' => 'nullable|string|max:255',
            'biaya_pokok_sekarang' => 'nullable|string|max:255',
            'gudang' => 'nullable|string|max:255',
            'tanggal_mulai' => 'nullable|string|max:255',
            'minimal_harga_jual' => 'nullable|string|max:255',
            'maksimal_harga_jual' => 'nullable|string|max:255',
            'minimal_harga_beli' => 'nullable|string|max:255',
            'maksimal_harga_beli' => 'nullable|string|max:255',
            'nomor_upc' => 'nullable|string|max:255',
            'nomor_plu' => 'nullable|string|max:255',
            'satuan' => 'nullable|string|max:255',
            'rasio' => 'nullable|string|max:255',
            'merk_barang' => 'nullable|string|max:255',
            'level_harga_1' => 'nullable|string|max:255',
            'level_harga_2' => 'nullable|string|max:255',
            'level_harga_3' => 'nullable|string|max:255',
            'level_harga_4' => 'nullable|string|max:255',
            'level_harga_5' => 'nullable|string|max:255',
        ];

        for ($i = 1; $i <= 7; $i++) {
            $rules["fileupload_{$i}"] = 'nullable|string|max:255';
        }

        $validate = $request->validate($rules);

        DB::beginTransaction();
        try {
            $barang = Barang::findOrFail($id);
            $barang->update($validate);
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('barang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function hapusBarang(Request $request)
    {
        try {
            $ids = $request->ids;
            Barang::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('barang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function dataBarang(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter         = $request->get('nama_barang');
        $barangNoBarangFilter  = $request->get('no_barang');
        $barangKategoriBarangFilter  = $request->get('kategori_barang');
        $barangTipePersediaanFilter  = $request->get('tipe_persediaan');
        $barangTipeBarangFilter  = $request->get('tipe_barang');
        $barangDihentikanFilter  = $request->get('dihentikan');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $barang =  DB::table('barang');
        $totalRecords = $barang->count();

        if ($namaFilter) {
            $barang->where('nama_barang', 'like', '%' . $namaFilter . '%');
        }

        if ($barangNoBarangFilter) {
            $barang->where('no_barang', 'like', '%' . $barangNoBarangFilter . '%');
        }

        if ($barangKategoriBarangFilter) {
            $barang->where('kategori_barang', $barangKategoriBarangFilter);
        }

        if ($barangTipePersediaanFilter) {
            $barang->where('tipe_persediaan', $barangTipePersediaanFilter);
        }

        if ($barangTipeBarangFilter) {
            $barang->where('tipe_barang', $barangTipeBarangFilter);
        }

        if ($barangDihentikanFilter  !== null && $barangDihentikanFilter !== '') {
            $barang->where('dihentikan', $barangDihentikanFilter);
        }

        $totalRecordsWithFilter = $barang->count();

        $records = $barang
            ->orderBy('no_barang', 'asc')            
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="barang_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"                => $checkbox,
                "no"                      => $start + $key + 1,
                "id"                      => $record->id,
                "no_barang"               => $record->sub_barang_check == 0 ? '<strong>' . $record->no_barang . '</strong>' : str_repeat('&nbsp;', 3) . $record->no_barang,
                "nama_barang"             => $record->sub_barang_check == 0 ? '<strong>' . $record->nama_barang . '</strong>' : $record->nama_barang,
                'deskripsi_1'             => $record->sub_barang_check == 0 ? '<strong>' . $record->deskripsi_1 . '</strong>' : $record->deskripsi_1,
                'deskripsi_2'             => $record->sub_barang_check == 0 ? '<strong>' . $record->deskripsi_2 . '</strong>' : $record->deskripsi_2,
                'kuantitas_saldo_awal'    => $record->sub_barang_check == 0 ? '<strong>' . $record->kuantitas_saldo_awal . '</strong>' : $record->kuantitas_saldo_awal,
                'satuan'                  => $record->sub_barang_check == 0 ? '<strong>' . $record->satuan . '</strong>' : $record->satuan,
                'biaya_satuan_saldo_awal' => 'Rp ' . number_format((float) $record->biaya_satuan_saldo_awal, 0, ',', '.'),
                'tipe_barang'             => $record->sub_barang_check == 0 ? '<strong>' . $record->tipe_barang . '</strong>' : $record->tipe_barang,
                'kategori_barang'         => $record->sub_barang_check == 0 ? '<strong>' . $record->kategori_barang . '</strong>' : $record->kategori_barang,
                'tipe_persediaan'         => $record->sub_barang_check == 0 ? '<strong>' . $record->tipe_persediaan . '</strong>' : $record->tipe_persediaan,
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
