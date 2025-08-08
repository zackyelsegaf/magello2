<?php

namespace App\Http\Controllers;

use App\Models\PindahBarang;
use App\Models\Barang;
use App\Models\StokBarang;
use App\Models\PindahBarangDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PindahBarangController extends Controller
{
    public function daftarPindahBarang(Request $request)
    {
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        return view('pindahbarang.datapindahbarang', compact('nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang'));
    }

    public function tambahPindahBarang()
    {
        $nama_barang = DB::table('barang')->orderBy('nomor_barang', 'asc')->get();
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
        $latest = PindahBarang::orderBy('no_pindah', 'desc')->first();
        $nextID = $latest ? intval(substr($latest->no_pindah, strlen($prefix))) + 1 : 1;
        $kodeBaru = $prefix . sprintf("%04d", $nextID);
        return view('pindahbarang.tambahpindahbarang', compact('nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'proyek', 'pemasok', 'satuan', 'mata_uang', 'kodeBaru', 'nama_akun'));
    }

    public function simpanPindahBarang(Request $request)
    {
        $rules = [
            'tgl_pindah'         => 'nullable|string|max:255',
            'dari_gudang'        => 'nullable|string|max:255',
            'ke_gudang'          => 'nullable|string|max:255',
            'dari_alamat'        => 'nullable|string|max:255',
            'ke_alamat'          => 'nullable|string|max:255',
            'deskripsi'          => 'nullable|string|max:255',
            'fileupload_1'       => 'nullable|string|max:255',
            'fileupload_2'       => 'nullable|string|max:255',
            'fileupload_3'       => 'nullable|string|max:255',
            'fileupload_4'       => 'nullable|string|max:255',
            'fileupload_5'       => 'nullable|string|max:255',
            'fileupload_6'       => 'nullable|string|max:255',
            'fileupload_7'       => 'nullable|string|max:255',
            'fileupload_8'       => 'nullable|string|max:255',
            'no_barang.*'        => 'nullable|string|max:255',
            'deskripsi_barang.*' => 'nullable|string|max:255',
            'kts_barang.*'       => 'required|numeric|min:0.01',
            'satuan.*'           => 'nullable|string|max:255',
        ];

        $validated = $request->validate($rules);

        DB::beginTransaction();
        try {
            $pindahBarang = new PindahBarang($validated);
            $pindahBarang->save();

            $jumlahBarang = count($request->no_barang);
            for ($i = 0; $i < $jumlahBarang; $i++) {
                $detail = new PindahBarangDetail();
                $detail->pindah_barang_id = $pindahBarang->id;
                $detail->no_barang        = $request->no_barang[$i];
                $detail->deskripsi_barang = $request->deskripsi_barang[$i];
                $detail->kts_barang       = $request->kts_barang[$i];
                $detail->satuan           = $request->satuan[$i];
                $detail->pengguna_pindah  = auth()->user()->email;
                $detail->save();

                $barang = Barang::find($request->no_barang[$i]);

                if ($barang) {
                    $jumlahPindah = (float) $request->kts_barang[$i];

                    $stokAsal = StokBarang::where('barang_id', $barang->id)
                        ->where('gudang_id', $validated['dari_gudang'])
                        ->first();

                    if ($stokAsal && $stokAsal->jumlah >= $jumlahPindah) {
                        $stokAsal->jumlah -= $jumlahPindah;
                        $stokAsal->save();
                    } else {
                        throw new \Exception("Stok tidak mencukupi di gudang asal untuk barang: {$barang->nama_barang}");
                    }

                    $stokTujuan = StokBarang::firstOrNew([
                        'barang_id' => $barang->id,
                        'gudang_id' => $validated['ke_gudang'],
                    ]);
                    $stokTujuan->jumlah = ($stokTujuan->jumlah ?? 0) + $jumlahPindah;
                    $stokTujuan->save();
                }
            }

            DB::commit();
            sweetalert()->success('Pindah barang berhasil disimpan :)');
            return redirect()->route('pindahbarang/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function editPindahBarang($id)
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
        $pindahBarang = PindahBarang::with('detail')->findOrFail($id);
        if (!$pindahBarang) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('pindahbarang.ubahpindahbarang', compact('pindahBarang','nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'proyek', 'pemasok', 'satuan', 'sub_barang', 'mata_uang', 'nama_akun'));
    }

    public function updatePindahBarang(Request $request, $id)
    {
        $rules = [
            'tgl_pindah'         => 'nullable|string|max:255',
            'dari_gudang'        => 'nullable|string|max:255',
            'ke_gudang'          => 'nullable|string|max:255',
            'dari_alamat'        => 'nullable|string|max:255',
            'ke_alamat'          => 'nullable|string|max:255',
            'deskripsi'          => 'nullable|string|max:255',
            'fileupload_1'       => 'nullable|string|max:255',
            'fileupload_2'       => 'nullable|string|max:255',
            'fileupload_3'       => 'nullable|string|max:255',
            'fileupload_4'       => 'nullable|string|max:255',
            'fileupload_5'       => 'nullable|string|max:255',
            'fileupload_6'       => 'nullable|string|max:255',
            'fileupload_7'       => 'nullable|string|max:255',
            'fileupload_8'       => 'nullable|string|max:255',
            'no_barang.*'        => 'nullable|string|max:255',
            'deskripsi_barang.*' => 'nullable|string|max:255',
            'kts_barang.*'       => 'nullable|string|max:255',
            'satuan.*'           => 'nullable|string|max:255',
        ];

        $validated = $request->validate($rules);

        DB::beginTransaction();
        try {
            $pindahBarang = PindahBarang::with('detail')->findOrFail($id);
            $pindahBarang->update($validated);

            PindahBarangDetail::where('pindah_barang_id', $pindahBarang->id)->delete();

            $jumlahBarang = count($request->no_barang);
            for ($i = 0; $i < $jumlahBarang; $i++) {
                $detail = new PindahBarangDetail();
                $detail->pindah_barang_id = $pindahBarang->id;
                $detail->no_barang        = $request->no_barang[$i];
                $detail->deskripsi_barang = $request->deskripsi_barang[$i];
                $detail->kts_barang       = $request->kts_barang[$i];
                $detail->satuan           = $request->satuan[$i];
                $detail->pengguna_pindah  = auth()->user()->email;
                $detail->save();
            }


            foreach ($request->no_barang as $i => $noBarang) {
                Barang::where('no_barang', $noBarang)
                    ->update([
                        'default_gudang' => $request->ke_gudang,
                        'satuan' => $request->satuan[$i] ?? null,
                    ]);
            }
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('pindahbarang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function hapusPindahBarang(Request $request)
    {
        try {
            $ids = $request->ids;
            PindahBarang::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('pindahbarang/list/page');    

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function dataPindahBarang(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter         = $request->get('nama_barang');
        $pindahBarangNoFilter  = $request->get('no_pindah');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $pindahBarang = DB::table('pindah_barang')
        ->join('pindah_barang_detail', 'pindah_barang.id', '=', 'pindah_barang_detail.pindah_barang_id')
        ->select(
            'pindah_barang.id',
            'pindah_barang.no_pindah',
            'pindah_barang.tgl_pindah',
            'pindah_barang.dari_gudang',
            'pindah_barang.ke_gudang',
            'pindah_barang.deskripsi',
            'pindah_barang.dari_alamat',
            'pindah_barang.ke_alamat',
            'pindah_barang_detail.no_barang',
            'pindah_barang_detail.deskripsi_barang',
            'pindah_barang_detail.kts_barang',
            'pindah_barang_detail.satuan',
            'pindah_barang_detail.pengguna_pindah'
        );
        $totalRecords = $pindahBarang->count();

        if ($pindahBarangNoFilter) {
            $pindahBarang->where('no_pindah', 'like', '%' . $pindahBarangNoFilter . '%');
        }

        // if ($pindahKategoriBarangFilter) {
        //     $pindah->where('kategori_barang', $pindahKategoriBarangFilter);
        // }

        // if ($pindahTipePersediaanFilter) {
        //     $pindah->where('tipe_persediaan', $pindahTipePersediaanFilter);
        // }

        // if ($pindahTipeBarangFilter) {
        //     $pindah->where('tipe_barang', $pindahTipeBarangFilter);
        // }

        // if ($pindahDihentikanFilter  !== null && $pindahDihentikanFilter !== '') {
        //     $pindah->where('dihentikan', $pindahDihentikanFilter);
        // }

        $totalRecordsWithFilter = $pindahBarang->count();

        $records = $pindahBarang
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="pindahbarang_checkbox" value="'.$record->id.'">';
        
            $data_arr[] = [
                "checkbox"         => $checkbox,
                "no"               => $start + $key + 1,
                "id"               => $record->id,
                "no_pindah"        => $record->no_pindah,
                "tgl_pindah"       => $record->tgl_pindah,
                "deskripsi_barang" => $record->deskripsi_barang,
                "dari_gudang"      => $record->dari_gudang,
                "ke_gudang"        => $record->ke_gudang,
                "pengguna_pindah"  => $record->pengguna_pindah,
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
