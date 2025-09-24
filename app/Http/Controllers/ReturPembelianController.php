<?php

namespace App\Http\Controllers;

use App\Models\ReturPembelian;
use App\Models\Barang;
use App\Models\ReturPembelianDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ReturPembelianController extends Controller
{
    public function tambahRetur(Request $request)
    {
        if ($request->ajax()) {
            if ($request->has('no_faktur') || $request->has('pemasok_faktur')) {
                $faktur_pembelian = DB::table('faktur_pembelian')
                    ->join('faktur_pembelian_detail', 'faktur_pembelian.id', '=', 'faktur_pembelian_detail.faktur_pembelian_id')
                    ->select(
                        'faktur_pembelian.id',
                        'faktur_pembelian.no_faktur',
                        'faktur_pembelian.tgl_faktur',
                        'faktur_pembelian.deskripsi_faktur',
                        'faktur_pembelian.pengguna_faktur',
                        'faktur_pembelian.tindak_lanjut_check',
                        'faktur_pembelian.urgent_check',
                        'faktur_pembelian.catatan_pemeriksaan_check',
                        DB::raw('MAX(faktur_pembelian_detail.no_barang) as no_barang'),
                        DB::raw('MAX(faktur_pembelian_detail.deskripsi_barang) as deskripsi_barang'),
                        DB::raw('MAX(faktur_pembelian_detail.kts_faktur) as kts_faktur'),
                        DB::raw('MAX(faktur_pembelian_detail.no_permintaan) as no_permintaan'),
                        DB::raw('MAX(faktur_pembelian_detail.no_pesanan) as no_pesanan'),
                        DB::raw('MAX(faktur_pembelian_detail.no_penerimaan) as no_penerimaan'),
                        DB::raw('MAX(faktur_pembelian_detail.satuan) as satuan'),
                        DB::raw('MAX(faktur_pembelian_detail.harga_satuan) as harga_satuan'),
                        DB::raw('MAX(faktur_pembelian_detail.reserve_1) as reserve_1'),
                        DB::raw('MAX(faktur_pembelian_detail.reserve_2) as reserve_2'),
                        DB::raw('MAX(faktur_pembelian_detail.reserve_3) as reserve_3'),
                        DB::raw('MAX(faktur_pembelian_detail.diskon_barang) as diskon_barang')
                    )->groupBy(
                        'faktur_pembelian.id',
                        'faktur_pembelian.no_faktur',
                        'faktur_pembelian.tgl_faktur',
                        'faktur_pembelian.deskripsi_faktur',
                        'faktur_pembelian.pengguna_faktur',
                        'faktur_pembelian.tindak_lanjut_check',
                        'faktur_pembelian.urgent_check',
                        'faktur_pembelian.catatan_pemeriksaan_check'
                    );

                if ($request->no_faktur) {
                    $faktur_pembelian->where('faktur_pembelian.no_faktur', 'like', '%' . $request->no_faktur . '%');
                }

                if ($request->pemasok_faktur) {
                    $faktur_pembelian->where('faktur_pembelian.pemasok_faktur', $request->pemasok_faktur);
                }

                return response()->json($faktur_pembelian->get());
            }

            return response()->json([]);
        }

        $tipe_barang = DB::table('tipe_barang')->get();
        $barang = DB::table('barang')->get();
        $faktur_pembelian = DB::table('faktur_pembelian')
            ->join('faktur_pembelian_detail', 'faktur_pembelian.id', '=', 'faktur_pembelian_detail.faktur_pembelian_id')
            ->select(
                'faktur_pembelian.id',
                'faktur_pembelian.no_faktur',
                'faktur_pembelian.tgl_faktur',
                'faktur_pembelian.deskripsi_faktur',
                'faktur_pembelian.pengguna_faktur',
                'faktur_pembelian.tindak_lanjut_check',
                'faktur_pembelian.urgent_check',
                'faktur_pembelian.catatan_pemeriksaan_check',
                DB::raw('MAX(faktur_pembelian_detail.no_barang) as no_barang'),
                DB::raw('MAX(faktur_pembelian_detail.deskripsi_barang) as deskripsi_barang'),
                DB::raw('MAX(faktur_pembelian_detail.kts_faktur) as kts_faktur'),
                DB::raw('MAX(faktur_pembelian_detail.no_permintaan) as no_permintaan'),
                DB::raw('MAX(faktur_pembelian_detail.no_pesanan) as no_pesanan'),
                DB::raw('MAX(faktur_pembelian_detail.no_penerimaan) as no_penerimaan'),
                DB::raw('MAX(faktur_pembelian_detail.satuan) as satuan'),
                DB::raw('MAX(faktur_pembelian_detail.harga_satuan) as harga_satuan'),
                DB::raw('MAX(faktur_pembelian_detail.reserve_1) as reserve_1'),
                DB::raw('MAX(faktur_pembelian_detail.reserve_2) as reserve_2'),
                DB::raw('MAX(faktur_pembelian_detail.reserve_3) as reserve_3'),
                DB::raw('MAX(faktur_pembelian_detail.diskon_barang) as diskon_barang')
            )->groupBy(
                'faktur_pembelian.id',
                'faktur_pembelian.no_faktur',
                'faktur_pembelian.tgl_faktur',
                'faktur_pembelian.deskripsi_faktur',
                'faktur_pembelian.pengguna_faktur',
                'faktur_pembelian.tindak_lanjut_check',
                'faktur_pembelian.urgent_check',
                'faktur_pembelian.catatan_pemeriksaan_check'
            )
            ->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        $gudang = DB::table('gudang')->get();
        $departemen = DB::table('departemen')->get();
        $proyek = DB::table('proyek')->get();
        $pemasok = DB::table('pemasok')->get();
        $syarat = DB::table('syarat')->get();
        $satuan = DB::table('satuan')->get();
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $nama_akun = DB::table('akun')
            ->whereIn('tipe_akun', ['Kas/Bank'])
            ->orderBy('nama', 'asc')
            ->get();
        $prefix = 'GMP';
        $latest = ReturPembelian::orderBy('no_retur', 'desc')->first();
        $nextID = $latest ? intval(substr($latest->no_retur, strlen($prefix))) + 1 : 1;
        $kodeBaru = $prefix . sprintf("%04d", $nextID);

        return view('pembelian.retur.tambahretur', compact('barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'proyek', 'pemasok', 'satuan', 'mata_uang', 'kodeBaru', 'nama_akun', 'syarat', 'faktur_pembelian'));
    }

    public function getDetailRetur(Request $request)
    {
        $no_faktur = $request->no_faktur;

        $detail = DB::table('faktur_pembelian')
            ->join('faktur_pembelian_detail', 'faktur_pembelian.id', '=', 'faktur_pembelian_detail.faktur_pembelian_id')
            ->where('faktur_pembelian.no_faktur', $no_faktur)
            ->select(
                'faktur_pembelian.no_faktur',
                'faktur_pembelian_detail.no_barang',
                'faktur_pembelian_detail.deskripsi_barang',
                'faktur_pembelian_detail.kts_faktur',
                'faktur_pembelian_detail.satuan',
                'faktur_pembelian_detail.harga_satuan',
                'faktur_pembelian_detail.diskon_barang',
                'faktur_pembelian_detail.kode_pajak',
                'faktur_pembelian_detail.no_permintaan',
                'faktur_pembelian_detail.no_pesanan',
                'faktur_pembelian_detail.jumlah_total_harga',
                'faktur_pembelian_detail.reserve_1',
                'faktur_pembelian_detail.reserve_2',
                'faktur_pembelian_detail.reserve_3'
            )
            ->get();

        return response()->json($detail);
    }

    public function daftarRetur(Request $request)
    {
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $pemasok = DB::table('pemasok')->get();
        $pengguna_retur = DB::table('retur_pembelian')
            ->select('pengguna_retur')
            ->distinct()
            ->get();

        return view('pembelian/retur.dataretur', compact('nama_barang','tipe_barang', 'tipe_persediaan','pengguna_retur', 'pemasok'));
    }

    // public function simpanRetur(Request $request)
    // {
    //     $rules = [
    //         'no_retur' => 'nullable|string|max:255',
    //         'tgl_retur' => 'required|string|max:255',
    //         'no_formulir' => 'nullable|string|max:255',
    //         'no_pemasok' => 'nullable|string|max:255',
    //         'pemasok_retur' => 'required|string|max:255', 
    //         'departemen' => 'required|string|max:255',
    //         'gudang' => 'required|string|max:255',
    //         'proyek' => 'required|string|max:255',
    //         'sub_total' => 'nullable|string|max:255',
    //         'ppn_11_persen' => 'nullable|string|max:255',
    //         'pajak_2' => 'nullable|string|max:255',
    //         'jumlah' => 'nullable|string|max:255',
    //         'status_retur' => 'nullable|string|max:255', 
    //         'pengguna_retur' => 'nullable|string|max:255', 
    //         'pajak_check' => 'nullable|boolean',
    //         'termasuk_pajak_check' => 'nullable|boolean',
    //         'disetujui_check' => 'nullable|boolean',
    //         'deskripsi' => 'nullable|string|max:255',
    //         'no_faktur' => 'nullable|string|max:255',
    //         'nilai_tukar_pajak' => 'nullable|string|max:255',
    //         'nilai_tukar' => 'nullable|string|max:255',
    //         'fileupload_1' => 'nullable|string|max:255',
    //         'fileupload_2' => 'nullable|string|max:255',
    //         'fileupload_3' => 'nullable|string|max:255',
    //         'fileupload_4' => 'nullable|string|max:255',
    //         'fileupload_5' => 'nullable|string|max:255',
    //         'fileupload_6' => 'nullable|string|max:255',
    //         'fileupload_7' => 'nullable|string|max:255', 
    //         'fileupload_8' => 'nullable|string|max:255',
    //     ];

    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->fails()) {
    //         sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     DB::beginTransaction();
    //     try {

    //         $retur = new ReturPembelian($validator->validated());
    //         $retur->save();

    //         $jumlahBarang = count($request->no_barang);
    //         // dd($jumlahBarang);
    //         for ($i = 0; $i < $jumlahBarang; $i++){
                
    //             $detail = new ReturPembelianDetail();
    //             $detail->retur_pembelian_id = $retur->id;
    //             $detail->alamat_pajak       = $request->alamat_pajak;
    //             $detail->no_barang          = $request->no_barang[$i]  ?? null;
    //             $detail->deskripsi_barang   = $request->deskripsi_barang[$i]  ?? null;
    //             $detail->kts_barang         = $request->kts_barang[$i]  ?? null;
    //             $detail->satuan             = $request->satuan[$i]  ?? null;
    //             $detail->harga_satuan       = $request->harga_satuan[$i]  ?? null;
    //             $detail->diskon_barang      = $request->diskon_barang[$i]  ?? null;
    //             $detail->kode_pajak         = $request->kode_pajak[$i]  ?? null;
    //             $detail->jumlah_total_harga = $request->jumlah_total_harga[$i]  ?? null;
    //             $detail->reserve_1          = $request->reserve_1[$i]  ?? null;
    //             $detail->reserve_2          = $request->reserve_2[$i]  ?? null;
    //             $detail->reserve_3          = $request->reserve_3[$i]  ?? null;
    //             $detail->save();
    //         }

    //         DB::commit();
    //         sweetalert()->success('Create new Barang & Detail successfully :)');
    //         return redirect()->route('pembelian/retur/list/page');

    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
    //         return redirect()->back()->withInput();
    //     }
    // }

    public function simpanRetur(Request $request)
    {
        $rules = [
            'tgl_retur'                 => 'required|string|max:255',
            'no_formulir'               => 'nullable|string|max:255',
            'no_pemasok'                => 'nullable|string|max:255',
            'pemasok_retur'             => 'required|string|max:255',
            'departemen'                => 'required|string|max:255',
            'gudang'                    => 'required|string|max:255',
            'proyek'                    => 'required|string|max:255',
            'sub_total'                 => 'nullable|string|max:255',
            'ppn_11_persen'             => 'nullable|string|max:255',
            'pajak_2'                   => 'nullable|string|max:255',
            'jumlah'                    => 'nullable|string|max:255',
            'status_retur'              => 'nullable|string|max:255',
            'pengguna_retur'            => 'nullable|string|max:255',
            'pajak_check'               => 'nullable|boolean',
            'termasuk_pajak_check'      => 'nullable|boolean',
            'disetujui_check'           => 'nullable|boolean',
            'deskripsi'                 => 'nullable|string|max:255',
            'no_faktur'                 => 'nullable|string|max:255',
            'nilai_tukar_pajak'         => 'nullable|string|max:255',
            'nilai_tukar'               => 'nullable|string|max:255',
            'tindak_lanjut_check'       => 'nullable|boolean',
            'urgent_check'              => 'nullable|boolean',
            'deskripsi_1'               => 'nullable|string|max:255',
            'catatan_pemeriksaan_check' => 'nullable|boolean',
            'deskripsi_2'               => 'nullable|string|max:255',
            'fileupload_1'              => 'nullable|string|max:255',
            'fileupload_2'              => 'nullable|string|max:255',
            'fileupload_3'              => 'nullable|string|max:255',
            'fileupload_4'              => 'nullable|string|max:255',
            'fileupload_5'              => 'nullable|string|max:255',
            'fileupload_6'              => 'nullable|string|max:255',
            'fileupload_7'              => 'nullable|string|max:255',
            'fileupload_8'              => 'nullable|string|max:255',
            'kts_barang.*'              => 'required|numeric|min:1',
        ];

        $message = [
            'kts_barang.*.required' => 'Kuantitas wajib diisi untuk setiap barang',
            'kts_barang.*.numeric'  => 'Kuantitas harus berupa angka',
            'kts_barang.*.min'      => 'Kuantitas minimal 1',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            $retur = new ReturPembelian($validator->validated());
            $retur->save();

            $jumlahBarang = count($request->no_barang);

            for ($i = 0; $i < $jumlahBarang; $i++) {

                $detail = new ReturPembelianDetail();
                $detail->retur_pembelian_id = $retur->id;
                $detail->alamat_pajak       = $request->alamat_pajak;
                $detail->no_barang          = $request->no_barang[$i]  ?? null;
                $detail->deskripsi_barang   = $request->deskripsi_barang[$i]  ?? null;
                $detail->kts_barang         = $request->kts_barang[$i]  ?? null;
                $detail->satuan             = $request->satuan[$i]  ?? null;
                $detail->harga_satuan       = $request->harga_satuan[$i]  ?? null;
                $detail->diskon_barang      = $request->diskon_barang[$i]  ?? null;
                $detail->kode_pajak         = $request->kode_pajak[$i]  ?? null;
                $detail->jumlah_total_harga = $request->jumlah_total_harga[$i]  ?? null;
                $detail->reserve_1          = $request->reserve_1[$i]  ?? null;
                $detail->reserve_2          = $request->reserve_2[$i]  ?? null;
                $detail->reserve_3          = $request->reserve_3[$i]  ?? null;
                $detail->save();

                $barang = Barang::where('no_barang', $request->no_barang[$i])->first();
                if ($barang) {
                    $qtyRetur = (float) $request->kts_barang[$i] ?? 0;
                    $totalRetur = (float) $request->jumlah_total_harga[$i] ?? 0;

                    $barang->kuantitas_saldo_awal = max(0, $barang->kuantitas_saldo_awal - $qtyRetur);
                    $barang->total_saldo_awal = max(0, $barang->total_saldo_awal - $totalRetur);
                    $barang->save();
                }
            }

            DB::commit();
            sweetalert()->success('Retur Pembelian berhasil disimpan dan stok diperbarui :)');
            return redirect()->route('pembelian/retur/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function editRetur($id)
    {
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $barang = DB::table('barang')->get();
        // $permintaan_pembelian = DB::table('permintaan_pembelian')
        //     ->join('permintaan_pembelian_detail', 'permintaan_pembelian.id', '=', 'permintaan_pembelian_detail.permintaan_pembelian_id')
        //     ->select('permintaan_pembelian.*', 'permintaan_pembelian_detail.*')
        //     ->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        $gudang = DB::table('gudang')->get();
        $departemen = DB::table('departemen')->get();
        $proyek = DB::table('proyek')->get();
        $syarat = DB::table('syarat')->get();
        $pemasok = DB::table('pemasok')
            ->leftJoin('mata_uang', 'pemasok.mata_uang_id', '=', 'mata_uang.id')
            ->select('pemasok.*', 'mata_uang.nama as mata_uang_nama')
            ->get();
        $satuan = DB::table('satuan')->get();
        $sub_barang = DB::table('barang')->get();
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $nama_akun = DB::table('akun')->orderBy('nama', 'asc')->get();
        // $penyesuaianBarangEdit = DB::table('penyesuaian_barang')->where('no_penyesuaian',$no_penyesuaian)->first();
        $returPembelian = ReturPembelian::with(['detail', 'detail2'])->findOrFail($id);
        if (!$returPembelian) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        $faktur = $returPembelian;
        return view('pembelian.retur.ubahretur', compact('returPembelian','nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'barang', 'proyek', 'syarat', 'pemasok', 'satuan', 'sub_barang', 'mata_uang', 'nama_akun', 'faktur'));
    }

    public function updateRetur(Request $request, $id)
    {
        $rules = [
            'tgl_retur'                 => 'required|string|max:255',
            'no_formulir'               => 'nullable|string|max:255',
            'no_pemasok'                => 'nullable|string|max:255',
            'pemasok_retur'             => 'required|string|max:255', 
            'departemen'                => 'required|string|max:255',
            'gudang'                    => 'required|string|max:255',
            'proyek'                    => 'required|string|max:255',
            'sub_total'                 => 'nullable|string|max:255',
            'ppn_11_persen'             => 'nullable|string|max:255',
            'pajak_2'                   => 'nullable|string|max:255',
            'jumlah'                    => 'nullable|string|max:255',
            'status_retur'              => 'nullable|string|max:255', 
            'pengguna_retur'            => 'nullable|string|max:255', 
            'pajak_check'               => 'nullable|boolean',
            'termasuk_pajak_check'      => 'nullable|boolean',
            'disetujui_check'           => 'nullable|boolean',
            'deskripsi'                 => 'nullable|string|max:255',
            'no_faktur'                 => 'nullable|string|max:255',
            'nilai_tukar_pajak'         => 'nullable|string|max:255',
            'nilai_tukar'               => 'nullable|string|max:255',
            'tindak_lanjut_check'       => 'nullable|boolean',
            'urgent_check'              => 'nullable|boolean',
            'deskripsi_1'               => 'nullable|string|max:255',
            'catatan_pemeriksaan_check' => 'nullable|boolean',
            'deskripsi_2'               => 'nullable|string|max:255',
            'fileupload_1'              => 'nullable|string|max:255',
            'fileupload_2'              => 'nullable|string|max:255',
            'fileupload_3'              => 'nullable|string|max:255',
            'fileupload_4'              => 'nullable|string|max:255',
            'fileupload_5'              => 'nullable|string|max:255',
            'fileupload_6'              => 'nullable|string|max:255',
            'fileupload_7'              => 'nullable|string|max:255', 
            'fileupload_8'              => 'nullable|string|max:255',
        ];

        $validated = $request->validate($rules);

        DB::beginTransaction();
        try {
            $returPembelian = ReturPembelian::with(['detail', 'detail2'])->findOrFail($id);
            $returPembelian->pengguna_retur = $request->pengguna_retur;
            if ($request->disetujui_check && !$returPembelian->no_persetujuan) {
                $returPembelian->no_persetujuan = ReturPembelian::generateNoPersetujuan();
            }
            $returPembelian->update($validated);

            ReturPembelianDetail::where('retur_pembelian_id', $returPembelian->id)->delete();

            $jumlahBarang = count($request->no_barang);
            for ($i = 0; $i < $jumlahBarang; $i++){
                
                $detail = new ReturPembelianDetail();
                $detail->retur_pembelian_id    = $returPembelian->id;
                $detail->alamat_pajak       = $request->alamat_pajak;
                $detail->no_barang          = $request->no_barang[$i]  ?? null;
                $detail->deskripsi_barang   = $request->deskripsi_barang[$i]  ?? null;
                $detail->kts_barang         = $request->kts_barang[$i]  ?? null;
                $detail->satuan             = $request->satuan[$i]  ?? null;
                $detail->harga_satuan       = $request->harga_satuan[$i]  ?? null;
                $detail->diskon_barang      = $request->diskon_barang[$i]  ?? null;
                $detail->kode_pajak         = $request->kode_pajak[$i]  ?? null;
                $detail->jumlah_total_harga = $request->jumlah_total_harga[$i]  ?? null;
                $detail->reserve_1          = $request->reserve_1[$i]  ?? null;
                $detail->reserve_2          = $request->reserve_2[$i]  ?? null;
                $detail->reserve_3          = $request->reserve_3[$i]  ?? null;
                $detail->save();
            }
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('pembelian/retur/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)'. $e->getMessage());
            return redirect()->back();
        }
    }

    public function hapusRetur(Request $request)
    {
        try {
            $ids = $request->ids;
            ReturPembelian::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('pembelian/retur/list/page');    

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function dataRetur(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $returPembelianNoFilter  = $request->get('no_retur');
        $returPembelianDeskripsiFilter  = $request->get('deskripsi');
        $returPembelianPenggunaFilter  = $request->get('pengguna_retur');
        $returPembelianPemasokFilter  = $request->get('pemasok_retur');
        $returPembelianCatatanPemeriksaanFilter = $request->get('catatan_pemeriksaan_check');
        $returPembelianPersetujuanFilter = $request->get('disetujui_check');
        $returPembelianUrgentFilter = $request->get('urgent_check');
        $returPembelianRTindakLanjutFilter = $request->get('tindak_lanjut_check');
        $statusReturFilter = $request->get('status_retur');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $retur = DB::table('retur_pembelian');
        
        $totalRecords = $retur->count();

        if ($returPembelianNoFilter) {
            $retur->where('no_retur', 'like', '%' . $returPembelianNoFilter . '%');
        }

        if ($returPembelianDeskripsiFilter) {
            $retur->where('deskripsi', 'like', '%' . $returPembelianDeskripsiFilter . '%');
        }

        if ($returPembelianPenggunaFilter) {
            $retur->where('pengguna_retur', $returPembelianPenggunaFilter);
        }

        if ($returPembelianPemasokFilter) {
            $retur->where('pemasok_retur', $returPembelianPemasokFilter);
        }

        if ($returPembelianCatatanPemeriksaanFilter !== null && $returPembelianCatatanPemeriksaanFilter !== '') {
            $retur->where('catatan_pemeriksaan_check', $returPembelianCatatanPemeriksaanFilter);
        }

        if ($returPembelianPersetujuanFilter !== null && $returPembelianPersetujuanFilter !== '') {
            $retur->where('disetujui_check', $returPembelianPersetujuanFilter);
        }

        if ($returPembelianUrgentFilter !== null && $returPembelianUrgentFilter !== '') {
            $retur->where('urgent_check', $returPembelianUrgentFilter);
        }

        if ($returPembelianRTindakLanjutFilter !== null && $returPembelianRTindakLanjutFilter !== '') {
            $retur->where('tindak_lanjut_check', $returPembelianRTindakLanjutFilter);
        }

        if ($statusReturFilter) {
            $retur->where('status_retur', $statusReturFilter);
        }


        // if ($returTipeBarangFilter) {
        //     $retur->where('tipe_barang', $returTipeBarangFilter);
        // }

        // if ($returDihentikanFilter  !== null && $returDihentikanFilter !== '') {
        //     $retur->where('dihentikan', $returDihentikanFilter);
        // }

        $totalRecordsWithFilter = $retur->count();
        $totalRecords = DB::table('permintaan_pembelian')->count();

        $records = $retur
            ->orderBy($columnName, $columnSortOrder)
            ->offset($start)
            ->limit($length)
            ->get();
        
        $data_arr = [];

        foreach ($records as $key => $record) {
            $detail = DB::table('retur_pembelian_detail')
                ->where('retur_pembelian_id', $record->id)
                ->first();

            $checkbox = '<input type="checkbox" class="retur_checkbox" value="'.$record->id.'">';
        
            $data_arr[] = [
                "checkbox"                  => $checkbox,
                "no"                        => $start + $key + 1,
                "id"                        => $record->id,
                "no_retur"                  => $record->no_retur,
                "no_faktur"                 => $record->no_faktur,
                "no_persetujuan"            => $record->no_persetujuan,
                "tgl_retur"                 => $record->tgl_retur,
                "deskripsi"                 => $record->deskripsi ?? null,
                "pengguna_retur"            => $record->pengguna_retur,
                // "tindak_lanjut_check"       => $record->tindak_lanjut_check,
                // "urgent_check"              => $record->urgent_check,
                // "catatan_pemeriksaan_check" => $record->catatan_pemeriksaan_check,
                "status_retur"              => $record->status_retur,
                "disetujui_check"           => $record->disetujui_check,
                "pemasok_retur"             => $record->pemasok_retur,
                // "uang_muka"                 => 'Rp ' . number_format((float)$detail->uang_muka, 0, ',', '.'),
                // "uang_muka_terpakai"        => 'Rp ' . number_format((float)$detail->uang_muka_terpakai, 0, ',', '.'),
                // "tgl_ekspektasi"            => $detail->tgl_ekspektasi,
                "no_pemasok"                => $record->no_pemasok,
                "jumlah"                    => 'Rp ' . number_format((float)$record->jumlah, 0, ',', '.'),
            ];
        }        
        // dd($data_arr);
        return response()->json([
            "draw"                 => intval($draw),
            "recordsTotal"         => $totalRecords,
            "recordsFiltered"      => $totalRecordsWithFilter,
            "data"                 => $data_arr
        ])->header('Content-Type', 'application/json');        
        
    }
}
