<?php

namespace App\Http\Controllers;

use App\Models\PesananPembelian;
use App\Models\PesananPembelianDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PesananPembelianController extends Controller
{
    public function tambahPesanan(Request $request)
    {
        if ($request->ajax()) {
            // dd(":dd");
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

        if ($request->ajax()) {
            $permintaan_pembelian = DB::table('permintaan_pembelian');

            if ($request->no_permintaan) {
                $permintaan_pembelian->where('no_permintaan', 'like', '%' . $request->no_permintaan . '%');
            }

            $result = $permintaan_pembelian->get();
            return response()->json($result);
        }

        $tipe_barang = DB::table('tipe_barang')->get();
        $barang = DB::table('barang')->get();
        $permintaan_pembelian = DB::table('permintaan_pembelian')
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
                DB::raw('MAX(permintaan_pembelian_detail.no_barang) as no_barang'),
                DB::raw('MAX(permintaan_pembelian_detail.deskripsi_barang) as deskripsi_barang'),
                DB::raw('MAX(permintaan_pembelian_detail.kts_permintaan) as kts_permintaan'),
                DB::raw('MAX(permintaan_pembelian_detail.harga_satuan) as harga_satuan'),
                DB::raw('MAX(permintaan_pembelian_detail.jumlah_total_harga) as jumlah_total_harga'),
                DB::raw('MAX(permintaan_pembelian_detail.satuan) as satuan'),
                DB::raw('MAX(permintaan_pembelian_detail.catatan) as catatan'),
                DB::raw('MAX(permintaan_pembelian_detail.tgl_diminta) as tgl_diminta'),
                DB::raw('MAX(permintaan_pembelian_detail.kts_dipesan) as kts_dipesan'),
                DB::raw('MAX(permintaan_pembelian_detail.kts_diterima) as kts_diterima'),
                DB::raw('MAX(permintaan_pembelian_detail.tutup_check_all) as tutup_check_all'),
                DB::raw('MAX(permintaan_pembelian_detail.tutup_check_items) as tutup_check_items')
            )->groupBy(
                'permintaan_pembelian.id',
                'permintaan_pembelian.no_permintaan',
                'permintaan_pembelian.tgl_permintaan',
                'permintaan_pembelian.deskripsi_permintaan',
                'permintaan_pembelian.pengguna_permintaan',
                'permintaan_pembelian.tindak_lanjut_check',
                'permintaan_pembelian.urgent_check',
                'permintaan_pembelian.catatan_pemeriksaan_check'
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
        $nama_akun = DB::table('akun')->orderBy('nama', 'asc')->get();
        $prefix = 'GMP';
        $latest = PesananPembelian::orderBy('no_pesanan', 'desc')->first();
        $nextID = $latest ? intval(substr($latest->no_pesanan, strlen($prefix))) + 1 : 1;
        $kodeBaru = $prefix . sprintf("%04d", $nextID);

        return view('pembelian.pesanan.tambahpesanan', compact('barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'proyek', 'pemasok', 'satuan', 'mata_uang', 'kodeBaru', 'nama_akun', 'syarat', 'permintaan_pembelian'));
    }
    
    public function getDetailPermintaan(Request $request)
    {
        $no_permintaan = $request->no_permintaan;

        $detail = DB::table('permintaan_pembelian')
            ->join('permintaan_pembelian_detail', 'permintaan_pembelian.id', '=', 'permintaan_pembelian_detail.permintaan_pembelian_id')
            ->where('permintaan_pembelian.no_permintaan', $no_permintaan)
            ->select(
                'permintaan_pembelian.no_permintaan',
                'permintaan_pembelian_detail.no_barang',
                'permintaan_pembelian_detail.deskripsi_barang',
                'permintaan_pembelian_detail.kts_permintaan',
                'permintaan_pembelian_detail.satuan',
                'permintaan_pembelian_detail.harga_satuan',
                'permintaan_pembelian_detail.jumlah_total_harga',
            )
            ->get();

        return response()->json($detail);
    }

    public function PermintaanSearch(Request $request){
        if ($request->ajax()) {
            $permintaan_pembelian_2 = DB::table('permintaan_pembelian');

            if ($request->no_permintaan) {
                $permintaan_pembelian_2->where('no_permintaan', 'like', '%' . $request->no_permintaan . '%');
            }

            $result_2 = $permintaan_pembelian_2->get();
            return response()->json($result_2);
        }
        return view('pembelian.pesanan.tambahpesanan', compact('permintaan_pembelian_2'));
    }

    public function simpanPesanan(Request $request)
    {
        $rules = [
            'no_cnt_pesanan' => 'nullable|string|max:255',
            'pemasok_pesanan' => 'required|string|max:255',
            'no_pemasok' => 'nullable|string|max:255',
            'tgl_pesanan' => 'required|string|max:255',
            'deskripsi_pesanan' => 'nullable|string|max:255',
            'tindak_lanjut_check' => 'nullable|boolean',
            'urgent_check' => 'nullable|boolean',
            'catatan_pemeriksaan_check' => 'nullable|boolean',
            'pajak_check' => 'nullable|boolean',
            'termasuk_pajak_check' => 'nullable|boolean',
            'tutup_check' => 'nullable|boolean',
            'disetujui_check' => 'nullable|boolean',
            'uang_muka_check' => 'nullable|boolean',
            'akun_uang_muka' => 'nullable|string|max:255',
            'deskripsi_1' => 'nullable|string|max:255',
            'deskripsi_2' => 'nullable|string|max:255',
            'status_pesanan' => 'nullable|string|max:255',
            'pengguna_pesanan' => 'nullable|string|max:255',
            'sub_total' => 'nullable|string|max:255',
            'diskon_left' => 'nullable|string|max:255',
            'total_diskon_right' => 'nullable|string|max:255',
            'ppn_11_persen' => 'nullable|string|max:255',
            'pajak_2' => 'nullable|string|max:255',
            'estimasi_biaya' => 'nullable|string|max:255',
            'jumlah' => 'nullable|string|max:255',
            'fileupload_1' => 'nullable|string|max:255',
            'fileupload_2' => 'nullable|string|max:255',
            'fileupload_3' => 'nullable|string|max:255',
            'fileupload_4' => 'nullable|string|max:255',
            'fileupload_5' => 'nullable|string|max:255',
            'fileupload_6' => 'nullable|string|max:255',
            'fileupload_7' => 'nullable|string|max:255',
            'fileupload_8' => 'nullable|string|max:255',
            'no_barang.*'               => 'nullable|string|max:255',
            'deskripsi_barang.*'        => 'nullable|string|max:255',
            'kts_permintaan.*'          => 'required|string|max:255',
            'satuan.*'                  => 'nullable|string|max:255',
            'catatan.*'                 => 'nullable|string|max:255',
            'tgl_diminta.*'             => 'nullable|string|max:255',
            'kts_dipesan.*'             => 'nullable|string|max:255',
            'kts_diterima.*'            => 'nullable|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            $pesanan = new PesananPembelian($validator->validated());
            $pesanan->save();

            $jumlahBarang = count($request->no_barang);
            // dd($jumlahBarang);
            for ($i = 0; $i < $jumlahBarang; $i++){
                $tgl_ekspektasi = $request->tgl_ekspektasi;
                $gudang = $request->gudang;
                $proyek = $request->proyek;
                $departemen = $request->departemen;
                $alamat_pemasok = $request->alamat_pemasok;
                $alamat_pengiriman = $request->alamat_pengiriman;
                $syarat = $request->syarat;
                $fob = $request->fob;
                $nilai_tukar = $request->nilai_tukar;
                $uang_muka = $request->uang_muka;
                $uang_muka_terpakai = $request->uang_muka_terpakai;
                $uang_muka_check = $request->uang_muka_check;
                $akun_uang_muka = $request->akun_uang_muka;
                
                $detail = new PesananPembelianDetail();
                $detail->pesanan_pembelian_id = $pesanan->id;
                $detail->gudang               = $gudang;
                $detail->proyek               = $proyek;
                $detail->departemen           = $departemen;
                $detail->alamat_pemasok       = $alamat_pemasok;
                $detail->alamat_pengiriman    = $alamat_pengiriman;
                $detail->syarat               = $syarat;
                $detail->fob                  = $fob;
                $detail->nilai_tukar          = $nilai_tukar;
                $detail->uang_muka            = $uang_muka;
                $detail->uang_muka_terpakai   = $uang_muka_terpakai;
                $detail->tgl_ekspektasi       = $tgl_ekspektasi;
                $detail->uang_muka_check      = $uang_muka_check;
                $detail->akun_uang_muka       = $akun_uang_muka;
                $detail->no_barang            = $request->no_barang[$i];
                $detail->deskripsi_barang     = $request->deskripsi_barang[$i];
                $detail->kts_pesanan          = $request->kts_pesanan[$i];
                $detail->satuan               = $request->satuan[$i];
                $detail->harga_satuan         = $request->harga_satuan[$i];
                $detail->diskon_barang        = $request->diskon_barang[$i];
                $detail->pajak                = $request->pajak[$i];
                $detail->jumlah_total_harga   = $request->jumlah_total_harga[$i];
                $detail->kts_diterima         = $request->kts_diterima[$i];
                $detail->no_permintaan        = $request->no_permintaan[$i];
                $detail->save();
            }

            DB::commit();
            sweetalert()->success('Create new Barang & Detail successfully :)');
            return redirect()->route('pembelian/pesanan/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function editPesanan($id)
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
        $pemasok = DB::table('pemasok')->get();
        $satuan = DB::table('satuan')->get();
        $sub_barang = DB::table('barang')->get();
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $nama_akun = DB::table('akun')->orderBy('nama', 'asc')->get();
        // $penyesuaianBarangEdit = DB::table('penyesuaian_barang')->where('no_penyesuaian',$no_penyesuaian)->first();
        $pesananPembelian = PesananPembelian::with(['detail', 'detail2'])->findOrFail($id);
        if (!$pesananPembelian) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        $pesanan = $pesananPembelian;
        return view('pembelian.pesanan.ubahpesanan', compact('pesananPembelian','nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'barang', 'proyek', 'syarat', 'pemasok', 'satuan', 'sub_barang', 'mata_uang', 'nama_akun', 'pesanan'));
    }

    public function updatePesanan(Request $request, $id)
    {
        $rules = [
            'no_cnt_pesanan' => 'nullable|string|max:255',
            'pemasok_pesanan' => 'nullable|string|max:255',
            'no_pemasok' => 'nullable|string|max:255',
            'tgl_pesanan' => 'nullable|string|max:255',
            'deskripsi_pesanan' => 'nullable|string|max:255',
            'tindak_lanjut_check' => 'nullable|boolean',
            'urgent_check' => 'nullable|boolean',
            'catatan_pemeriksaan_check' => 'nullable|boolean',
            'pajak_check' => 'nullable|boolean',
            'termasuk_pajak_check' => 'nullable|boolean',
            'tutup_check' => 'nullable|boolean',
            'disetujui_check' => 'nullable|boolean',
            'deskripsi_1' => 'nullable|string|max:255',
            'deskripsi_2' => 'nullable|string|max:255',
            'status_pesanan' => 'nullable|string|max:255',
            'pengguna_pesanan' => 'nullable|string|max:255',
            'sub_total' => 'nullable|string|max:255',
            'diskon_left' => 'nullable|string|max:255',
            'total_diskon_right' => 'nullable|string|max:255',
            'ppn_11_persen' => 'nullable|string|max:255',
            'pajak_2' => 'nullable|string|max:255',
            'estimasi_biaya' => 'nullable|string|max:255',
            'jumlah' => 'nullable|string|max:255',
            'fileupload_1' => 'nullable|string|max:255',
            'fileupload_2' => 'nullable|string|max:255',
            'fileupload_3' => 'nullable|string|max:255',
            'fileupload_4' => 'nullable|string|max:255',
            'fileupload_5' => 'nullable|string|max:255',
            'fileupload_6' => 'nullable|string|max:255',
            'fileupload_7' => 'nullable|string|max:255',
            'fileupload_8' => 'nullable|string|max:255',
            'no_barang.*'        => 'nullable|string|max:255',
            'deskripsi_barang.*' => 'nullable|string|max:255',
            'kts_permintaan.*'   => 'nullable|string|max:255',
            'satuan.*'           => 'nullable|string|max:255',
            'tutup_check_detail.*' => 'nullable|boolean',
            'catatan.*'          => 'nullable|string|max:255',
            'tgl_diminta.*'      => 'nullable|string|max:255',
            'kts_dipesan.*'      => 'nullable|string|max:255',
            'kts_diterima.*'     => 'nullable|string|max:255',
        ];

        $validated = $request->validate($rules);

        DB::beginTransaction();
        try {
            $pesananPembelian = PesananPembelian::with(['detail', 'detail2'])->findOrFail($id);
            $pesananPembelian->pengguna_pesanan = $request->pengguna_pesanan;
            if ($request->disetujui_check && !$pesananPembelian->no_persetujuan) {
                $pesananPembelian->no_persetujuan = PesananPembelian::generateNoPersetujuan();
            }
            $pesananPembelian->update($validated);

            PesananPembelianDetail::where('pesanan_pembelian_id', $pesananPembelian->id)->delete();

            $jumlahBarang = count($request->no_barang);
            for ($i = 0; $i < $jumlahBarang; $i++){
                $tgl_ekspektasi = $request->tgl_ekspektasi;
                $gudang = $request->gudang;
                $proyek = $request->proyek;
                $departemen = $request->departemen;
                $alamat_pemasok = $request->alamat_pemasok;
                $alamat_pengiriman = $request->alamat_pengiriman;
                $syarat = $request->syarat;
                $fob = $request->fob;
                $nilai_tukar = $request->nilai_tukar;
                $uang_muka = $request->uang_muka;
                $uang_muka_terpakai = $request->uang_muka_terpakai;
                
                $detail = new PesananPembelianDetail();
                $detail->pesanan_pembelian_id = $pesananPembelian->id;
                $detail->gudang               = $gudang;
                $detail->proyek               = $proyek;
                $detail->departemen           = $departemen;
                $detail->alamat_pemasok       = $alamat_pemasok;
                $detail->alamat_pengiriman    = $alamat_pengiriman;
                $detail->syarat               = $syarat;
                $detail->fob                  = $fob;
                $detail->nilai_tukar          = $nilai_tukar;
                $detail->uang_muka            = $uang_muka;
                $detail->uang_muka_terpakai   = $uang_muka_terpakai;
                $detail->tgl_ekspektasi       = $tgl_ekspektasi;
                $detail->no_barang            = $request->no_barang[$i];
                $detail->deskripsi_barang     = $request->deskripsi_barang[$i];
                $detail->kts_pesanan          = $request->kts_pesanan[$i];
                $detail->satuan               = $request->satuan[$i];
                $detail->harga_satuan         = $request->harga_satuan[$i];
                $detail->diskon_barang        = $request->diskon_barang[$i];
                $detail->pajak                = $request->pajak[$i];
                $detail->jumlah_total_harga   = $request->jumlah_total_harga[$i];
                $detail->kts_diterima         = $request->kts_diterima[$i];
                $detail->no_permintaan        = $request->no_permintaan[$i];
                $detail->tutup_check_detail   = $request->tutup_check_detail[$i];
                $detail->save();
            }
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('pembelian/pesanan/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)'. $e->getMessage());
            return redirect()->back();
        }
    }

    public function daftarPesanan(Request $request)
    {
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $pemasok = DB::table('pemasok')->get();
        $pengguna_pesanan = DB::table('pesanan_pembelian')
            ->select('pengguna_pesanan')
            ->distinct()
            ->get();

        return view('pembelian/pesanan.datapesanan', compact('nama_barang','tipe_barang', 'tipe_persediaan','pengguna_pesanan', 'pemasok'));
    }

    public function hapusPesanan(Request $request)
    {
        try {
            $ids = $request->ids;
            PesananPembelian::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('pembelian/pesanan/list/page');    

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function dataPesanan(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $pesananPembelianNoFilter  = $request->get('no_pesanan');
        $pesananPembelianDeskripsiFilter  = $request->get('deskripsi_pesanan');
        $pesananPembelianPenggunaFilter  = $request->get('pengguna_pesanan');
        $pesananPembelianPemasokFilter  = $request->get('pemasok_pesanan');
        $pesananPembelianCatatanPemeriksaanFilter = $request->get('catatan_pemeriksaan_check');
        $pesananPembelianPersetujuanFilter = $request->get('disetujui_check');
        $pesananPembelianUrgentFilter = $request->get('urgent_check');
        $pesananPembelianRTindakLanjutFilter = $request->get('tindak_lanjut_check');
        $pesananPembelianStatusFilter = $request->get('status_pesanan');


        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        // $pesanan = DB::table('pesanan_pembelian')
        // ->join('pesanan_pembelian_detail', 'pesanan_pembelian.id', '=', 'pesanan_pembelian_detail.pesanan_pembelian_id')
        // ->select(
        //     'pesanan_pembelian.id',
        //     'pesanan_pembelian.no_pesanan',
        //     'pesanan_pembelian.tgl_pesanan',
        //     'pesanan_pembelian.deskripsi_pesanan',
        //     'pesanan_pembelian.pengguna_pesanan',
        //     'pesanan_pembelian.tindak_lanjut_check',
        //     'pesanan_pembelian.urgent_check',
        //     'pesanan_pembelian.catatan_pemeriksaan_check',
        //     'pesanan_pembelian.pemasok_pesanan',
        //     'pesanan_pembelian.no_pemasok',
        //     'pesanan_pembelian.jumlah',
        //     'pesanan_pembelian.sub_total',
        //     'pesanan_pembelian_detail.uang_muka',
        //     'pesanan_pembelian_detail.uang_muka_terpakai',
        //     'pesanan_pembelian_detail.tgl_ekspektasi',
        //     // 'pesanan_pembelian_detail.no_barang',
        //     // 'pesanan_pembelian_detail.deskripsi_barang',
        //     // 'pesanan_pembelian_detail.kts_pesanan',
        //     // 'pesanan_pembelian_detail.satuan',
        // );
        $pesanan = DB::table('pesanan_pembelian');
        
        $totalRecords = $pesanan->count();

        if ($pesananPembelianNoFilter) {
            $pesanan->where('no_pesanan', 'like', '%' . $pesananPembelianNoFilter . '%');
        }

        if ($pesananPembelianDeskripsiFilter) {
            $pesanan->where('deskripsi_pesanan', 'like', '%' . $pesananPembelianDeskripsiFilter . '%');
        }

        if ($pesananPembelianPenggunaFilter) {
            $pesanan->where('pengguna_pesanan', $pesananPembelianPenggunaFilter);
        }

        if ($pesananPembelianPemasokFilter) {
            $pesanan->where('pemasok_pesanan', $pesananPembelianPemasokFilter);
        }

        if ($pesananPembelianCatatanPemeriksaanFilter !== null && $pesananPembelianCatatanPemeriksaanFilter !== '') {
            $pesanan->where('catatan_pemeriksaan_check', $pesananPembelianCatatanPemeriksaanFilter);
        }

        if ($pesananPembelianPersetujuanFilter !== null && $pesananPembelianPersetujuanFilter !== '') {
            $pesanan->where('disetujui_check', $pesananPembelianPersetujuanFilter);
        }

        if ($pesananPembelianUrgentFilter !== null && $pesananPembelianUrgentFilter !== '') {
            $pesanan->where('urgent_check', $pesananPembelianUrgentFilter);
        }

        if ($pesananPembelianRTindakLanjutFilter !== null && $pesananPembelianRTindakLanjutFilter !== '') {
            $pesanan->where('tindak_lanjut_check', $pesananPembelianRTindakLanjutFilter);
        }

        if ($pesananPembelianStatusFilter) {
            $pesanan->where('status_pesanan', $pesananPembelianStatusFilter);
        }

        // if ($pesananTipeBarangFilter) {
        //     $pesanan->where('tipe_barang', $pesananTipeBarangFilter);
        // }

        // if ($pesananDihentikanFilter  !== null && $pesananDihentikanFilter !== '') {
        //     $pesanan->where('dihentikan', $pesananDihentikanFilter);
        // }

        $totalRecordsWithFilter = $pesanan->count();
        $totalRecords = DB::table('permintaan_pembelian')->count();

        $records = $pesanan
            ->orderBy($columnName, $columnSortOrder)
            ->offset($start)
            ->limit($length)
            ->get();
        
        $data_arr = [];

        foreach ($records as $key => $record) {
            $detail = DB::table('pesanan_pembelian_detail')
                ->where('pesanan_pembelian_id', $record->id)
                ->first();

            $checkbox = '<input type="checkbox" class="pesanan_checkbox" value="'.$record->id.'">';
        
            $data_arr[] = [
                "checkbox"                  => $checkbox,
                "no"                        => $start + $key + 1,
                "id"                        => $record->id,
                "no_pesanan"                => $record->no_pesanan,
                "no_persetujuan"            => $record->no_persetujuan,
                "tgl_pesanan"               => $record->tgl_pesanan,
                "deskripsi_pesanan"         => $detail->deskripsi_pesanan ?? null,
                "pengguna_pesanan"          => $record->pengguna_pesanan,
                "tindak_lanjut_check"       => $record->tindak_lanjut_check,
                "urgent_check"              => $record->urgent_check,
                "catatan_pemeriksaan_check" => $record->catatan_pemeriksaan_check,
                "status_pesanan"            => $record->status_pesanan,
                "disetujui_check"           => $record->disetujui_check,
                "pemasok_pesanan"           => $record->pemasok_pesanan,
                "uang_muka"                 => 'Rp ' . number_format((float)$detail->uang_muka, 0, ',', '.'),
                "uang_muka_terpakai"        => 'Rp ' . number_format((float)$detail->uang_muka_terpakai, 0, ',', '.'),
                "tgl_ekspektasi"            => $detail->tgl_ekspektasi,
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
