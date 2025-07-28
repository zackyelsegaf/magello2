<?php

namespace App\Http\Controllers;

use App\Models\PembayaranPembelian;
use App\Models\Akun;
use App\Models\PembayaranPembelianDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PembayaranPembelianController extends Controller
{
    public function tambahPembayaran(Request $request)
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
        $latest = PembayaranPembelian::orderBy('no_pembayaran', 'desc')->first();
        $nextID = $latest ? intval(substr($latest->no_pembayaran, strlen($prefix))) + 1 : 1;
        $kodeBaru = $prefix . sprintf("%04d", $nextID);

        return view('pembelian.pembayaran.tambahpembayaran', compact('barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'proyek', 'pemasok', 'satuan', 'mata_uang', 'kodeBaru', 'nama_akun', 'syarat', 'faktur_pembelian'));
    }

    public function getDetailPembayaran(Request $request)
    {
        $no_faktur = $request->no_faktur;

        $data = DB::table('faktur_pembelian')
            ->where('no_faktur', $no_faktur)
            ->select(
                'no_faktur',
                'tgl_faktur',
                'jumlah'
            )
            ->get();

        return response()->json($data);
    }


    public function simpanPembayaran(Request $request)
    {
        $rules = [
            'no_pemasok' => 'nullable|string|max:255',
            'no_formulir' => 'nullable|string|max:255',
            'pemasok_pembayaran' => 'required|string|max:255',
            'tgl_pembayaran' => 'required|string|max:255',
            'cek_kosong_check' => 'nullable|boolean',
            'disetujui_check' => 'nullable|boolean',
            'pajak_check' => 'nullable|boolean',
            'status_pembayaran' => 'nullable|string|max:255',
            'pengguna_pembayaran' => 'nullable|string|max:255',
            'sub_total' => 'nullable|string|max:255',
            'diskon_left' => 'nullable|string|max:255',
            'total_diskon_right' => 'nullable|string|max:255',
            'ppn_11_persen' => 'nullable|string|max:255',
            'pajak_2' => 'nullable|string|max:255',
            'jumlah_biaya' => 'nullable|string|max:255',
            'departemen' => 'required|string|max:255',
            'proyek' => 'required|string|max:255',
            'gudang' => 'required|string|max:255',
            'tindak_lanjut_check' => 'nullable|boolean',
            'urgent_check' => 'nullable|boolean',
            'deskripsi_1' => 'nullable|string|max:255',
            'catatan_pemeriksaan_check' => 'nullable|boolean',
            'deskripsi_2' => 'nullable|string|max:255',
            'fileupload_1' => 'nullable|string|max:255',
            'fileupload_2' => 'nullable|string|max:255',
            'fileupload_3' => 'nullable|string|max:255',
            'fileupload_4' => 'nullable|string|max:255',
            'fileupload_5' => 'nullable|string|max:255',
            'fileupload_6' => 'nullable|string|max:255',
            'fileupload_7' => 'nullable|string|max:255',
            'fileupload_8' => 'nullable|string|max:255',
            // 'no_barang.*'        => 'nullable|string|max:255',
            // 'deskripsi_barang.*' => 'nullable|string|max:255',
            // 'kts_faktur.*'       => 'nullable|string|max:255',
            // 'satuan.*'           => 'nullable|string|max:255',
            // 'catatan.*'          => 'nullable|string|max:255',
            // 'tgl_diminta.*'      => 'nullable|string|max:255',
            // 'kts_dipesan.*'      => 'nullable|string|max:255',
            // 'kts_diterima.*'     => 'nullable|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            $pembayaran = new PembayaranPembelian($validator->validated());
            $pembayaran->save();

            $jumlahBarang = count($request->no_faktur);
            // dd($jumlahBarang);
            for ($i = 0; $i < $jumlahBarang; $i++) {
                $detail = new PembayaranPembelianDetail();
                $detail->pembayaran_pembelian_id = $pembayaran->id;
                $detail->akun_bank               = $request->akun_bank;
                $detail->nilai_tukar             = $request->nilai_tukar;
                $detail->mata_uang               = $request->mata_uang;
                $detail->tgl_cek                 = $request->tgl_cek;
                $detail->no_cek                  = $request->no_cek;
                $detail->jumlah_check            = $request->jumlah_check;
                $detail->saldo_bank              = $request->saldo_bank;
                $detail->deskripsi               = $request->deskripsi;
                $detail->alamat_pemasok          = $request->alamat_pemasok;
                $detail->no_faktur               = $request->no_faktur[$i] ?? null;
                $detail->tgl_faktur              = $request->tgl_faktur[$i] ?? null;
                $detail->jatuh_tempo             = $request->jatuh_tempo[$i] ?? null;
                $detail->pph_23                  = $request->pph_23[$i] ?? null;
                $detail->diskon                  = $request->diskon[$i] ?? null;
                $detail->jumlah                  = $request->jumlah[$i] ?? null;
                $detail->terhutang               = $request->terhutang[$i] ?? null;
                $detail->jumlah_pembayaran       = $request->jumlah_pembayaran[$i] ?? null;
                $detail->deskripsi_rincian       = $request->deskripsi_rincian[$i] ?? null;
                $detail->bayar_check             = $request->bayar_check[$i] ?? null;

                $detail->save();

                if ($detail->akun_bank && $detail->saldo_bank !== null) {
                    Akun::where('no_akun', $detail->akun_bank)
                        ->update([
                            'saldo_akun' => $detail->saldo_bank
                        ]);
                }
            }
            DB::commit();
            sweetalert()->success('Create new Barang & Detail successfully :)');
            return redirect()->route('pembelian/pembayaran/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function editPembayaran($id)
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
        $nama_akun = DB::table('akun')
            ->whereIn('tipe_akun', ['Kas/Bank'])
            ->orderBy('nama', 'asc')
            ->get();
        // $penyesuaianBarangEdit = DB::table('penyesuaian_barang')->where('no_penyesuaian',$no_penyesuaian)->first();
        $pembayaranPembelian = PembayaranPembelian::with(['detail', 'detail2'])->findOrFail($id);
        if (!$pembayaranPembelian) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        $pembayaran = $pembayaranPembelian;
        return view('pembelian.pembayaran.ubahpembayaran', compact('pembayaranPembelian','nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'barang', 'proyek', 'syarat', 'pemasok', 'satuan', 'sub_barang', 'mata_uang', 'nama_akun', 'pembayaran'));
    }

    public function updatePembayaran(Request $request, $id)
    {
        $rules = [
            'no_pemasok'                => 'nullable|string|max:255',
            'no_formulir'               => 'nullable|string|max:255',
            'pemasok_pembayaran'        => 'required|string|max:255',
            'tgl_pembayaran'            => 'required|string|max:255',
            'cek_kosong_check'          => 'nullable|boolean',
            'disetujui_check'           => 'nullable|boolean',
            'pajak_check'               => 'nullable|boolean',
            'status_pembayaran'         => 'nullable|string|max:255',
            'pengguna_pembayaran'       => 'nullable|string|max:255',
            'sub_total'                 => 'nullable|string|max:255',
            'diskon_left'               => 'nullable|string|max:255',
            'total_diskon_right'        => 'nullable|string|max:255',
            'ppn_11_persen'             => 'nullable|string|max:255',
            'pajak_2'                   => 'nullable|string|max:255',
            'jumlah_biaya'              => 'nullable|string|max:255',
            'departemen'                => 'required|string|max:255',
            'proyek'                    => 'required|string|max:255',
            'gudang'                    => 'required|string|max:255',
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
            // 'no_barang.*'        => 'nullable|string|max:255',
            // 'deskripsi_barang.*' => 'nullable|string|max:255',
            // 'kts_faktur.*'       => 'nullable|string|max:255',
            // 'satuan.*'           => 'nullable|string|max:255',
            // 'catatan.*'          => 'nullable|string|max:255',
            // 'tgl_diminta.*'      => 'nullable|string|max:255',
            // 'kts_dipesan.*'      => 'nullable|string|max:255',
            // 'kts_diterima.*'     => 'nullable|string|max:255',
        ];

        $validated = $request->validate($rules);

        DB::beginTransaction();
        try {
            $pembayaranPembelian = PembayaranPembelian::with(['detail', 'detail2'])->findOrFail($id);
            $pembayaranPembelian->pengguna_pembayaran = $request->pengguna_pembayaran;
            if ($request->disetujui_check && !$pembayaranPembelian->no_persetujuan) {
                $pembayaranPembelian->no_persetujuan = PembayaranPembelian::generateNoPersetujuan();
            }
            $pembayaranPembelian->update($validated);

            PembayaranPembelianDetail::where('pembayaran_pembelian_id', $pembayaranPembelian->id)->delete();

            $jumlahBarang = count($request->no_faktur);
            for ($i = 0; $i < $jumlahBarang; $i++){
                
                $detail = new PembayaranPembelianDetail();
                $detail->pembayaran_pembelian_id = $pembayaranPembelian->id;
                $detail->akun_bank               = $request->akun_bank;
                $detail->nilai_tukar             = $request->nilai_tukar;
                $detail->mata_uang               = $request->mata_uang;
                $detail->tgl_cek                 = $request->tgl_cek;
                $detail->no_cek                  = $request->no_cek;
                $detail->jumlah_check            = $request->jumlah_check;
                $detail->saldo_bank              = $request->saldo_bank;
                $detail->deskripsi               = $request->deskripsi;
                $detail->alamat_pemasok          = $request->alamat_pemasok;
                $detail->no_faktur               = $request->no_faktur[$i] ?? null;
                $detail->tgl_faktur              = $request->tgl_faktur[$i] ?? null;
                $detail->jatuh_tempo             = $request->jatuh_tempo[$i] ?? null;
                $detail->pph_23                  = $request->pph_23[$i] ?? null;
                $detail->diskon                  = $request->diskon[$i] ?? null;
                $detail->jumlah                  = $request->jumlah[$i] ?? null;
                $detail->terhutang               = $request->terhutang[$i] ?? null;
                $detail->jumlah_pembayaran       = $request->jumlah_pembayaran[$i] ?? null;
                $detail->deskripsi_rincian       = $request->deskripsi_rincian[$i] ?? null;
                $detail->bayar_check             = $request->bayar_check[$i] ?? null;
                $detail->save();

                if ($detail->akun_bank && $detail->saldo_bank !== null) {
                    Akun::where('no_akun', $detail->akun_bank)
                        ->update([
                            'saldo_akun' => $detail->saldo_bank
                        ]);
                }

            }
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('pembelian/pembayaran/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)'. $e->getMessage());
            return redirect()->back();
        }
    }

    public function hapuspembayaran(Request $request)
    {
        try {
            $ids = $request->ids;
            PembayaranPembelian::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('pembelian/pembayaran/list/page');    

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }
    
    public function daftarPembayaran(Request $request)
    {
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $pemasok = DB::table('pemasok')->get();
        $pengguna_pembayaran = DB::table('pembayaran_pembelian')
            ->select('pengguna_pembayaran')
            ->distinct()
            ->get();

        return view('pembelian/pembayaran.datapembayaran', compact('nama_barang','tipe_barang', 'tipe_persediaan','pengguna_pembayaran', 'pemasok'));
    }

    public function dataPembayaran(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $pembayaranPembelianNoFilter  = $request->get('no_pembayaran');
        $pembayaranPembelianDeskripsiFilter  = $request->get('deskripsi_pembayaran');
        $pembayaranPembelianPenggunaFilter  = $request->get('pengguna_pembayaran');
        $pembayaranPembelianPemasokFilter  = $request->get('pemasok_pembayaran');
        $pembayaranPembelianCatatanPemeriksaanFilter = $request->get('catatan_pemeriksaan_check');
        $pembayaranPembelianPersetujuanFilter = $request->get('disetujui_check');
        $pembayaranPembelianUrgentFilter = $request->get('urgent_check');
        $pembayaranPembelianRTindakLanjutFilter = $request->get('tindak_lanjut_check');
        $pembayaranPembelianStatusFilter = $request->get('status_pembayaran');


        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        // $pesanan = DB::table('pembayaran_pembelian')
        // ->join('pembayaran_pembelian_detail', 'pembayaran_pembelian.id', '=', 'pembayaran_pembelian_detail.pembayaran_pembelian_id')
        // ->select(
        //     'pembayaran_pembelian.id',
        //     'pembayaran_pembelian.no_pembayaran',
        //     'pembayaran_pembelian.tgl_pembayaran',
        //     'pembayaran_pembelian.deskripsi_pembayaran',
        //     'pembayaran_pembelian.pengguna_pembayaran',
        //     'pembayaran_pembelian.tindak_lanjut_check',
        //     'pembayaran_pembelian.urgent_check',
        //     'pembayaran_pembelian.catatan_pemeriksaan_check',
        //     'pembayaran_pembelian.pemasok_pembayaran',
        //     'pembayaran_pembelian.no_pemasok',
        //     'pembayaran_pembelian.jumlah',
        //     'pembayaran_pembelian.sub_total',
        //     'pembayaran_pembelian_detail.uang_muka',
        //     'pembayaran_pembelian_detail.uang_muka_terpakai',
        //     'pembayaran_pembelian_detail.tgl_ekspektasi',
        //     // 'pembayaran_pembelian_detail.no_barang',
        //     // 'pembayaran_pembelian_detail.deskripsi_barang',
        //     // 'pembayaran_pembelian_detail.kts_pembayaran',
        //     // 'pembayaran_pembelian_detail.satuan',
        // );
        $pembayaran = DB::table('pembayaran_pembelian');
        
        $totalRecords = $pembayaran->count();

        if ($pembayaranPembelianNoFilter) {
            $pembayaran->where('no_pembayaran', 'like', '%' . $pembayaranPembelianNoFilter . '%');
        }

        if ($pembayaranPembelianDeskripsiFilter) {
            $pembayaran->where('deskripsi_pembayaran', 'like', '%' . $pembayaranPembelianDeskripsiFilter . '%');
        }

        if ($pembayaranPembelianPenggunaFilter) {
            $pembayaran->where('pengguna_pembayaran', $pembayaranPembelianPenggunaFilter);
        }

        if ($pembayaranPembelianPemasokFilter) {
            $pembayaran->where('pemasok_pembayaran', $pembayaranPembelianPemasokFilter);
        }

        if ($pembayaranPembelianCatatanPemeriksaanFilter !== null && $pembayaranPembelianCatatanPemeriksaanFilter !== '') {
            $pembayaran->where('catatan_pemeriksaan_check', $pembayaranPembelianCatatanPemeriksaanFilter);
        }

        if ($pembayaranPembelianPersetujuanFilter !== null && $pembayaranPembelianPersetujuanFilter !== '') {
            $pembayaran->where('disetujui_check', $pembayaranPembelianPersetujuanFilter);
        }

        if ($pembayaranPembelianUrgentFilter !== null && $pembayaranPembelianUrgentFilter !== '') {
            $pembayaran->where('urgent_check', $pembayaranPembelianUrgentFilter);
        }

        if ($pembayaranPembelianRTindakLanjutFilter !== null && $pembayaranPembelianRTindakLanjutFilter !== '') {
            $pembayaran->where('tindak_lanjut_check', $pembayaranPembelianRTindakLanjutFilter);
        }

        if ($pembayaranPembelianStatusFilter) {
            $pembayaran->where('status_pembayaran', $pembayaranPembelianStatusFilter);
        }

        // if ($pembayaranTipeBarangFilter) {
        //     $pembayaran->where('tipe_barang', $pembayaranTipeBarangFilter);
        // }

        // if ($pembayaranDihentikanFilter  !== null && $pembayaranDihentikanFilter !== '') {
        //     $pembayaran->where('dihentikan', $pembayaranDihentikanFilter);
        // }

        $totalRecordsWithFilter = $pembayaran->count();
        $totalRecords = DB::table('pembayaran_pembelian')->count();

        $records = $pembayaran
            ->orderBy($columnName, $columnSortOrder)
            ->offset($start)
            ->limit($length)
            ->get();
        
        $data_arr = [];

        foreach ($records as $key => $record) {
            $detail = DB::table('pembayaran_pembelian_detail')
                ->where('pembayaran_pembelian_id', $record->id)
                ->first();

            $checkbox = '<input type="checkbox" class="pembayaran_checkbox" value="'.$record->id.'">';
        
            $data_arr[] = [
                "checkbox"                  => $checkbox,
                "no"                        => $start + $key + 1,
                "id"                        => $record->id,
                "no_pembayaran"             => $record->no_pembayaran,
                "no_persetujuan"            => $record->no_persetujuan,
                "tgl_pembayaran"            => $record->tgl_pembayaran,
                "deskripsi_pembayaran"      => $detail->deskripsi_pembayaran ?? null,
                "pengguna_pembayaran"       => $record->pengguna_pembayaran,
                "no_formulir"               => $record->no_formulir,
                "no_cek"                    => $detail->no_cek,
                "tgl_cek"                   => $detail->tgl_cek,
                "deskripsi"                 => $detail->deskripsi,
                "jumlah_check"              => 'Rp ' . number_format((float)$detail->jumlah_check, 0, ',', '.'),
                "tindak_lanjut_check"       => $record->tindak_lanjut_check,
                "urgent_check"              => $record->urgent_check,
                "catatan_pemeriksaan_check" => $record->catatan_pemeriksaan_check,
                "status_pembayaran"         => $record->status_pembayaran,
                "disetujui_check"           => $record->disetujui_check,
                "pemasok_pembayaran"        => $record->pemasok_pembayaran,
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
