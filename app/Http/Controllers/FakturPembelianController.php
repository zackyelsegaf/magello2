<?php

namespace App\Http\Controllers;

use App\Models\FakturPembelian;
use App\Models\FakturPembelianDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FakturPembelianController extends Controller
{
    public function tambahFaktur(Request $request)
    {
        if ($request->ajax()) {
            if ($request->has('no_barang') || $request->has('nama_barang') || $request->has('kategori_barang')) {
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

                return response()->json($nama_barang->get());
            }

            if ($request->has('no_permintaan')) {
                $permintaan_pembelian = DB::table('permintaan_pembelian');

                if ($request->no_permintaan) {
                    $permintaan_pembelian->where('no_permintaan', 'like', '%' . $request->no_permintaan . '%');
                }

                return response()->json($permintaan_pembelian->get());
            }

            if ($request->has('no_pesanan') || $request->has('pemasok_pesanan')) {
                $pesanan_pembelian = DB::table('pesanan_pembelian')
                    ->join('pesanan_pembelian_detail', 'pesanan_pembelian.id', '=', 'pesanan_pembelian_detail.pesanan_pembelian_id')
                    ->select(
                        'pesanan_pembelian.id',
                        'pesanan_pembelian.no_pesanan',
                        'pesanan_pembelian.tgl_pesanan',
                        'pesanan_pembelian.deskripsi_pesanan',
                        'pesanan_pembelian.pengguna_pesanan',
                        'pesanan_pembelian.tindak_lanjut_check',
                        'pesanan_pembelian.urgent_check',
                        'pesanan_pembelian.catatan_pemeriksaan_check',
                        DB::raw('MAX(pesanan_pembelian_detail.no_barang) as no_barang'),
                        DB::raw('MAX(pesanan_pembelian_detail.deskripsi_barang) as deskripsi_barang'),
                        DB::raw('MAX(pesanan_pembelian_detail.kts_pesanan) as kts_pesanan'),
                        DB::raw('MAX(pesanan_pembelian_detail.no_permintaan) as no_permintaan'),
                        DB::raw('MAX(pesanan_pembelian_detail.satuan) as satuan'),
                        DB::raw('MAX(pesanan_pembelian_detail.diskon_barang) as diskon_barang'),
                        DB::raw('MAX(pesanan_pembelian_detail.kts_diterima) as kts_diterima')
                    )->groupBy(
                        'pesanan_pembelian.id',
                        'pesanan_pembelian.no_pesanan',
                        'pesanan_pembelian.tgl_pesanan',
                        'pesanan_pembelian.deskripsi_pesanan',
                        'pesanan_pembelian.pengguna_pesanan',
                        'pesanan_pembelian.tindak_lanjut_check',
                        'pesanan_pembelian.urgent_check',
                        'pesanan_pembelian.catatan_pemeriksaan_check'
                    );

                if ($request->no_pesanan) {
                    $pesanan_pembelian->where('pesanan_pembelian.no_pesanan', 'like', '%' . $request->no_pesanan . '%');
                }

                if ($request->pemasok_pesanan) {
                    $pesanan_pembelian->where('pesanan_pembelian.pemasok_pesanan', $request->pemasok_pesanan);
                }

                return response()->json($pesanan_pembelian->get());
            }


            if ($request->has('no_penerimaan') || $request->has('pemasok_penerimaan')) {
                $penerimaan_pembelian = DB::table('penerimaan_pembelian')
                    ->join('penerimaan_pembelian_detail', 'penerimaan_pembelian.id', '=', 'penerimaan_pembelian_detail.penerimaan_pembelian_id')
                    ->select(
                        'penerimaan_pembelian.id',
                        'penerimaan_pembelian.no_penerimaan',
                        'penerimaan_pembelian.tgl_penerimaan',
                        'penerimaan_pembelian.deskripsi_penerimaan',
                        'penerimaan_pembelian.pengguna_penerimaan',
                        'penerimaan_pembelian.tindak_lanjut_check',
                        'penerimaan_pembelian.urgent_check',
                        'penerimaan_pembelian.catatan_pemeriksaan_check',
                        DB::raw('MAX(penerimaan_pembelian_detail.no_barang) as no_barang'),
                        DB::raw('MAX(penerimaan_pembelian_detail.deskripsi_barang) as deskripsi_barang'),
                        DB::raw('MAX(penerimaan_pembelian_detail.kts_penerimaan) as kts_penerimaan'),
                        // DB::raw('MAX(penerimaan_pembelian_detail.harga_satuan) as harga_satuan'),
                        // DB::raw('MAX(penerimaan_pembelian_detail.diskon_barang) as diskon_barang'),
                        // DB::raw('MAX(penerimaan_pembelian_detail.kode_pajak) as kode_pajak'),
                        // DB::raw('MAX(penerimaan_pembelian_detail.jumlah_total_harga) as jumlah_total_harga'),
                        DB::raw('MAX(penerimaan_pembelian_detail.no_permintaan) as no_permintaan'),
                        DB::raw('MAX(penerimaan_pembelian_detail.no_pesanan) as no_pesanan'),
                        DB::raw('MAX(penerimaan_pembelian_detail.satuan) as satuan')
                    )->groupBy(
                        'penerimaan_pembelian.id',
                        'penerimaan_pembelian.no_penerimaan',
                        'penerimaan_pembelian.tgl_penerimaan',
                        'penerimaan_pembelian.deskripsi_penerimaan',
                        'penerimaan_pembelian.pengguna_penerimaan',
                        'penerimaan_pembelian.tindak_lanjut_check',
                        'penerimaan_pembelian.urgent_check',
                        'penerimaan_pembelian.catatan_pemeriksaan_check'
                    );

                if ($request->no_penerimaan) {
                    $penerimaan_pembelian->where('no_penerimaan', 'like', '%' . $request->no_penerimaan . '%');
                }

                if ($request->pemasok_penerimaan) {
                    $penerimaan_pembelian->where('pemasok_penerimaan', $request->pemasok_penerimaan);
                }

                return response()->json($penerimaan_pembelian->get());
            }

            return response()->json([]);
        }

        $tipe_barang = DB::table('tipe_barang')->get();
        $barang = DB::table('barang')->get();
        $pesanan_pembelian = DB::table('pesanan_pembelian')
            ->join('pesanan_pembelian_detail', 'pesanan_pembelian.id', '=', 'pesanan_pembelian_detail.pesanan_pembelian_id')
            ->select(
                'pesanan_pembelian.id',
                'pesanan_pembelian.no_pesanan',
                'pesanan_pembelian.tgl_pesanan',
                'pesanan_pembelian.deskripsi_pesanan',
                'pesanan_pembelian.pengguna_pesanan',
                'pesanan_pembelian.tindak_lanjut_check',
                'pesanan_pembelian.urgent_check',
                'pesanan_pembelian.catatan_pemeriksaan_check',
                DB::raw('MAX(pesanan_pembelian_detail.no_barang) as no_barang'),
                DB::raw('MAX(pesanan_pembelian_detail.deskripsi_barang) as deskripsi_barang'),
                DB::raw('MAX(pesanan_pembelian_detail.kts_pesanan) as kts_pesanan'),
                DB::raw('MAX(pesanan_pembelian_detail.no_permintaan) as no_permintaan'),
                DB::raw('MAX(pesanan_pembelian_detail.satuan) as satuan'),
                DB::raw('MAX(pesanan_pembelian_detail.diskon_barang) as diskon_barang'),
                DB::raw('MAX(pesanan_pembelian_detail.kts_diterima) as kts_diterima')
            )->groupBy(
                'pesanan_pembelian.id',
                'pesanan_pembelian.no_pesanan',
                'pesanan_pembelian.tgl_pesanan',
                'pesanan_pembelian.deskripsi_pesanan',
                'pesanan_pembelian.pengguna_pesanan',
                'pesanan_pembelian.tindak_lanjut_check',
                'pesanan_pembelian.urgent_check',
                'pesanan_pembelian.catatan_pemeriksaan_check'
            )
            ->get();
        
        $penerimaan_pembelian = DB::table('penerimaan_pembelian')
            ->join('penerimaan_pembelian_detail', 'penerimaan_pembelian.id', '=', 'penerimaan_pembelian_detail.penerimaan_pembelian_id')
            ->select(
                'penerimaan_pembelian.id',
                'penerimaan_pembelian.no_penerimaan',
                'penerimaan_pembelian.no_formulir',
                'penerimaan_pembelian.tgl_penerimaan',
                'penerimaan_pembelian.deskripsi_penerimaan',
                'penerimaan_pembelian.pengguna_penerimaan',
                'penerimaan_pembelian.tindak_lanjut_check',
                'penerimaan_pembelian.urgent_check',
                'penerimaan_pembelian.catatan_pemeriksaan_check',
                DB::raw('MAX(penerimaan_pembelian_detail.no_barang) as no_barang'),
                DB::raw('MAX(penerimaan_pembelian_detail.deskripsi_barang) as deskripsi_barang'),
                DB::raw('MAX(penerimaan_pembelian_detail.kts_penerimaan) as kts_penerimaan'),
                // DB::raw('MAX(penerimaan_pembelian_detail.harga_satuan) as harga_satuan'),
                // DB::raw('MAX(penerimaan_pembelian_detail.diskon_barang) as diskon_barang'),
                // DB::raw('MAX(penerimaan_pembelian_detail.kode_pajak) as kode_pajak'),
                // DB::raw('MAX(penerimaan_pembelian_detail.jumlah_total_harga) as jumlah_total_harga'),
                DB::raw('MAX(penerimaan_pembelian_detail.no_permintaan) as no_permintaan'),
                DB::raw('MAX(penerimaan_pembelian_detail.no_pesanan) as no_pesanan'),
                DB::raw('MAX(penerimaan_pembelian_detail.satuan) as satuan')
            )->groupBy(
                'penerimaan_pembelian.id',
                'penerimaan_pembelian.no_penerimaan',
                'penerimaan_pembelian.no_formulir',
                'penerimaan_pembelian.tgl_penerimaan',
                'penerimaan_pembelian.deskripsi_penerimaan',
                'penerimaan_pembelian.pengguna_penerimaan',
                'penerimaan_pembelian.tindak_lanjut_check',
                'penerimaan_pembelian.urgent_check',
                'penerimaan_pembelian.catatan_pemeriksaan_check'
            )
            ->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        $gudang = DB::table('gudang')->get();
        $departemen = DB::table('departemen')->get();
        $proyek = DB::table('proyek')->get();
        $pemasok = DB::table('pemasok')
            ->leftJoin('mata_uang', 'pemasok.mata_uang_id', '=', 'mata_uang.id')
            ->select('pemasok.*', 'mata_uang.nama as mata_uang_nama')
            ->get();
        $syarat = DB::table('syarat')->get();
        $satuan = DB::table('satuan')->get();
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $nama_akun = DB::table('akun')->orderBy('nama', 'asc')->get();
        $prefix = 'GMP';
        $latest = FakturPembelian::orderBy('no_faktur', 'desc')->first();
        $nextID = $latest ? intval(substr($latest->no_faktur, strlen($prefix))) + 1 : 1;
        $kodeBaru = $prefix . sprintf("%04d", $nextID);

        return view('pembelian.faktur.tambahfaktur', compact('barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'proyek', 'pemasok', 'satuan', 'mata_uang', 'kodeBaru', 'nama_akun', 'syarat', 'pesanan_pembelian', 'penerimaan_pembelian'));
    }

    public function getDetailFaktur(Request $request)
    {
        $no_pesanan = $request->no_pesanan;

        $detail = DB::table('pesanan_pembelian')
            ->join('pesanan_pembelian_detail', 'pesanan_pembelian.id', '=', 'pesanan_pembelian_detail.pesanan_pembelian_id')
            ->where('pesanan_pembelian.no_pesanan', $no_pesanan)
            ->select(
                'pesanan_pembelian.no_pesanan',
                'pesanan_pembelian_detail.no_barang',
                'pesanan_pembelian_detail.deskripsi_barang',
                'pesanan_pembelian_detail.kts_pesanan',
                'pesanan_pembelian_detail.satuan',
                'pesanan_pembelian_detail.harga_satuan',
                'pesanan_pembelian_detail.diskon_barang',
                'pesanan_pembelian_detail.pajak',
                'pesanan_pembelian_detail.no_permintaan',
                'pesanan_pembelian_detail.jumlah_total_harga'
            )
            ->get();

        return response()->json($detail);
    }

    public function getDetailPenerimaan2(Request $request)
    {
        $no_penerimaan = $request->no_penerimaan;

        $detail = DB::table('penerimaan_pembelian')
            ->join('penerimaan_pembelian_detail', 'penerimaan_pembelian.id', '=', 'penerimaan_pembelian_detail.penerimaan_pembelian_id')
            ->where('penerimaan_pembelian.no_penerimaan', $no_penerimaan)
            ->select(
                'penerimaan_pembelian.no_penerimaan',
                'penerimaan_pembelian.no_formulir',
                'penerimaan_pembelian.deskripsi_penerimaan',
                'penerimaan_pembelian_detail.no_barang',
                'penerimaan_pembelian_detail.deskripsi_barang',
                'penerimaan_pembelian_detail.kts_penerimaan',
                'penerimaan_pembelian_detail.harga_satuan',
                'penerimaan_pembelian_detail.diskon_barang',
                'penerimaan_pembelian_detail.kode_pajak',
                'penerimaan_pembelian_detail.jumlah_total_harga',
                'penerimaan_pembelian_detail.satuan',
                'penerimaan_pembelian_detail.no_pesanan',
                'penerimaan_pembelian_detail.no_permintaan'
            )
            ->get();

        return response()->json($detail);
    }

    public function simpanFaktur(Request $request)
    {
        $rules = [
            'no_pemasok' => 'nullable|string|max:255',
            'no_formulir' => 'nullable|string|max:255',
            'pemasok_faktur' => 'required|string|max:255',
            'tgl_faktur' => 'required|string|max:255',
            'deskripsi_faktur' => 'nullable|string|max:255',
            'tindak_lanjut_check' => 'nullable|boolean',
            'urgent_check' => 'nullable|boolean',
            'catatan_pemeriksaan_check' => 'nullable|boolean',
            'pajak_check' => 'nullable|boolean',
            'disetujui_check' => 'nullable|boolean',
            'termasuk_pajak_check' => 'nullable|boolean',
            'deskripsi_1' => 'nullable|string|max:255',
            'deskripsi_2' => 'nullable|string|max:255',
            'status_faktur' => 'nullable|string|max:255',
            'pengguna_faktur' => 'nullable|string|max:255',
            'sub_total' => 'nullable|string|max:255',
            'diskon_left' => 'nullable|string|max:255',
            'total_diskon_right' => 'nullable|string|max:255',
            'ppn_11_persen' => 'nullable|string|max:255',
            'pajak_2' => 'nullable|string|max:255',
            'jumlah_biaya' => 'nullable|string|max:255',
            'jumlah' => 'nullable|string|max:255',
            'departemen' => 'required|string|max:255',
            'proyek' => 'required|string|max:255',
            'gudang' => 'required|string|max:255',
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
            // 'kts_faktur.*'       => 'required|string|max:255',
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

            $faktur = new FakturPembelian($validator->validated());
            $faktur->save();

            $jumlahBarang = count($request->no_barang);
            // dd($jumlahBarang);
            for ($i = 0; $i < $jumlahBarang; $i++){
                
                $detail = new FakturPembelianDetail();
                $detail->faktur_pembelian_id   = $faktur->id;
                $detail->tgl_kirim             = $request->tgl_kirim;
                $detail->no_faktur_pajak       = $request->no_faktur_pajak;
                $detail->tgl_pajak             = $request->tgl_pajak;
                $detail->alamat_pemasok        = $request->alamat_pemasok;
                $detail->fob                   = $request->fob;
                $detail->nilai_tukar           = $request->nilai_tukar;
                $detail->nilai_tukar_pajak     = $request->nilai_tukar_pajak;
                $detail->no_barang             = $request->no_barang[$i]  ?? null;
                $detail->deskripsi_barang      = $request->deskripsi_barang[$i]  ?? null;
                $detail->kts_faktur            = $request->kts_faktur[$i]  ?? null;
                $detail->satuan                = $request->satuan[$i]  ?? null;
                $detail->harga_satuan          = $request->harga_satuan[$i]  ?? null;
                $detail->diskon_barang         = $request->diskon_barang[$i]  ?? null;
                $detail->kode_pajak            = $request->kode_pajak[$i]  ?? null;
                $detail->jumlah_total_harga    = $request->jumlah_total_harga[$i]  ?? null;
                $detail->no_permintaan         = $request->no_permintaan[$i]  ?? null;
                $detail->no_pesanan            = $request->no_pesanan[$i]  ?? null;
                $detail->no_penerimaan         = $request->no_penerimaan[$i]  ?? null;
                $detail->reserve_1             = $request->reserve_1[$i]  ?? null;
                $detail->reserve_2             = $request->reserve_2[$i]  ?? null;
                $detail->reserve_3             = $request->reserve_3[$i]  ?? null;
                $detail->tutup_check_detail    = $request->tutup_check_detail[$i]  ?? null;
                $detail->no_akun               = $request->no_akun;
                $detail->nama_akun             = $request->nama_akun;
                $detail->jumlah                = $request->jumlah;
                $detail->catatan               = $request->catatan;      
                $detail->alokasi_barang_check  = $request->alokasi_barang_check;
                $detail->alokasi_pemasok_check = $request->alokasi_pemasok_check;
                $detail->beban_tagihan_check   = $request->beban_tagihan_check;
                $detail->pajak_inklusif_check  = $request->pajak_inklusif_check;
                $detail->nama_pemasok_detail   = $request->nama_pemasok_detail;
                $detail->no_faktur_detail      = $request->no_faktur_detail;
                $detail->tanggal_detail        = $request->tanggal_detail;
                $detail->save();
            }

            DB::commit();
            sweetalert()->success('Create new Barang & Detail successfully :)');
            return redirect()->route('pembelian/faktur/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function editFaktur($id)
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
        $fakturPembelian = FakturPembelian::with(['detail', 'detail2'])->findOrFail($id);
        if (!$fakturPembelian) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        $faktur = $fakturPembelian;
        return view('pembelian.faktur.ubahfaktur', compact('fakturPembelian','nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'barang', 'proyek', 'syarat', 'pemasok', 'satuan', 'sub_barang', 'mata_uang', 'nama_akun', 'faktur'));
    }

    public function updateFaktur(Request $request, $id)
    {
        $rules = [
            'no_pemasok' => 'nullable|string|max:255',
            'no_formulir' => 'nullable|string|max:255',
            'pemasok_faktur' => 'nullable|string|max:255',
            'tgl_faktur' => 'nullable|string|max:255',
            'deskripsi_faktur' => 'nullable|string|max:255',
            'tindak_lanjut_check' => 'nullable|boolean',
            'urgent_check' => 'nullable|boolean',
            'catatan_pemeriksaan_check' => 'nullable|boolean',
            'pajak_check' => 'nullable|boolean',
            'disetujui_check' => 'nullable|boolean',
            'termasuk_pajak_check' => 'nullable|boolean',
            'deskripsi_1' => 'nullable|string|max:255',
            'deskripsi_2' => 'nullable|string|max:255',
            'status_faktur' => 'nullable|string|max:255',
            'pengguna_faktur' => 'nullable|string|max:255',
            'sub_total' => 'nullable|string|max:255',
            'diskon_left' => 'nullable|string|max:255',
            'total_diskon_right' => 'nullable|string|max:255',
            'ppn_11_persen' => 'nullable|string|max:255',
            'pajak_2' => 'nullable|string|max:255',
            'jumlah_biaya' => 'nullable|string|max:255',
            'jumlah' => 'nullable|string|max:255',
            'departemen' => 'nullable|string|max:255',
            'proyek' => 'nullable|string|max:255',
            'gudang' => 'nullable|string|max:255',
            'fileupload_1' => 'nullable|string|max:255',
            'fileupload_2' => 'nullable|string|max:255',
            'fileupload_3' => 'nullable|string|max:255',
            'fileupload_4' => 'nullable|string|max:255',
            'fileupload_5' => 'nullable|string|max:255',
            'fileupload_6' => 'nullable|string|max:255',
            'fileupload_7' => 'nullable|string|max:255',
            'fileupload_8' => 'nullable|string|max:255',
        ];

        $validated = $request->validate($rules);

        DB::beginTransaction();
        try {
            $fakturPembelian = FakturPembelian::with(['detail', 'detail2'])->findOrFail($id);
            $fakturPembelian->pengguna_faktur = $request->pengguna_faktur;
            if ($request->disetujui_check && !$fakturPembelian->no_persetujuan) {
                $fakturPembelian->no_persetujuan = FakturPembelian::generateNoPersetujuan();
            }
            $fakturPembelian->update($validated);

            FakturPembelianDetail::where('faktur_pembelian_id', $fakturPembelian->id)->delete();

            $jumlahBarang = count($request->no_barang);
            for ($i = 0; $i < $jumlahBarang; $i++){
                
                $detail = new FakturPembelianDetail();
                $detail->faktur_pembelian_id   = $fakturPembelian->id;
                $detail->tgl_kirim             = $request->tgl_kirim;
                $detail->no_faktur_pajak       = $request->no_faktur_pajak;
                $detail->tgl_pajak             = $request->tgl_pajak;
                $detail->alamat_pemasok        = $request->alamat_pemasok;
                $detail->fob                   = $request->fob;
                $detail->nilai_tukar           = $request->nilai_tukar;
                $detail->nilai_tukar_pajak     = $request->nilai_tukar_pajak;
                $detail->no_barang             = $request->no_barang[$i]  ?? null;
                $detail->deskripsi_barang      = $request->deskripsi_barang[$i]  ?? null;
                $detail->kts_faktur            = $request->kts_faktur[$i]  ?? null;
                $detail->satuan                = $request->satuan[$i]  ?? null;
                $detail->harga_satuan          = $request->harga_satuan[$i]  ?? null;
                $detail->diskon_barang         = $request->diskon_barang[$i]  ?? null;
                $detail->kode_pajak            = $request->kode_pajak[$i]  ?? null;
                $detail->jumlah_total_harga    = $request->jumlah_total_harga[$i]  ?? null;
                $detail->no_permintaan         = $request->no_permintaan[$i]  ?? null;
                $detail->no_pesanan            = $request->no_pesanan[$i]  ?? null;
                $detail->no_penerimaan         = $request->no_penerimaan[$i]  ?? null;
                $detail->reserve_1             = $request->reserve_1[$i]  ?? null;
                $detail->reserve_2             = $request->reserve_2[$i]  ?? null;
                $detail->reserve_3             = $request->reserve_3[$i]  ?? null;
                $detail->tutup_check_detail    = $request->tutup_check_detail[$i]  ?? null;
                $detail->no_akun               = $request->no_akun;
                $detail->nama_akun             = $request->nama_akun;
                $detail->jumlah                = $request->jumlah;
                $detail->catatan               = $request->catatan;      
                $detail->alokasi_barang_check  = $request->alokasi_barang_check;
                $detail->alokasi_pemasok_check = $request->alokasi_pemasok_check;
                $detail->beban_tagihan_check   = $request->beban_tagihan_check;
                $detail->pajak_inklusif_check  = $request->pajak_inklusif_check;
                $detail->nama_pemasok_detail   = $request->nama_pemasok_detail;
                $detail->no_faktur_detail      = $request->no_faktur_detail;
                $detail->tanggal_detail        = $request->tanggal_detail;
                $detail->save();
            }
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('pembelian/faktur/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)'. $e->getMessage());
            return redirect()->back();
        }
    }

    public function hapusFaktur(Request $request)
    {
        try {
            $ids = $request->ids;
            FakturPembelian::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('pembelian/faktur/list/page');    

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function daftarFaktur(Request $request)
    {
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $pemasok = DB::table('pemasok')->get();
        $pengguna_faktur = DB::table('faktur_pembelian')
            ->select('pengguna_faktur')
            ->distinct()
            ->get();

        return view('pembelian/faktur.datafaktur', compact('nama_barang','tipe_barang', 'tipe_persediaan','pengguna_faktur', 'pemasok'));
    }

    public function dataFaktur(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $fakturPembelianNoFilter  = $request->get('no_faktur');
        $fakturPembelianDeskripsiFilter  = $request->get('deskripsi_faktur');
        $fakturPembelianPenggunaFilter  = $request->get('pengguna_faktur');
        $fakturPembelianPemasokFilter  = $request->get('pemasok_faktur');
        $fakturPembelianCatatanPemeriksaanFilter = $request->get('catatan_pemeriksaan_check');
        $fakturPembelianPersetujuanFilter = $request->get('disetujui_check');
        $fakturPembelianUrgentFilter = $request->get('urgent_check');
        $fakturPembelianRTindakLanjutFilter = $request->get('tindak_lanjut_check');
        $statusFakturFilter = $request->get('status_faktur');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $faktur = DB::table('faktur_pembelian');
        
        $totalRecords = $faktur->count();

        if ($fakturPembelianNoFilter) {
            $faktur->where('no_faktur', 'like', '%' . $fakturPembelianNoFilter . '%');
        }

        if ($fakturPembelianDeskripsiFilter) {
            $faktur->where('deskripsi_faktur', 'like', '%' . $fakturPembelianDeskripsiFilter . '%');
        }

        if ($fakturPembelianPenggunaFilter) {
            $faktur->where('pengguna_faktur', $fakturPembelianPenggunaFilter);
        }

        if ($fakturPembelianPemasokFilter) {
            $faktur->where('pemasok_faktur', $fakturPembelianPemasokFilter);
        }

        if ($fakturPembelianCatatanPemeriksaanFilter !== null && $fakturPembelianCatatanPemeriksaanFilter !== '') {
            $faktur->where('catatan_pemeriksaan_check', $fakturPembelianCatatanPemeriksaanFilter);
        }

        if ($fakturPembelianPersetujuanFilter !== null && $fakturPembelianPersetujuanFilter !== '') {
            $faktur->where('disetujui_check', $fakturPembelianPersetujuanFilter);
        }

        if ($fakturPembelianUrgentFilter !== null && $fakturPembelianUrgentFilter !== '') {
            $faktur->where('urgent_check', $fakturPembelianUrgentFilter);
        }

        if ($fakturPembelianRTindakLanjutFilter !== null && $fakturPembelianRTindakLanjutFilter !== '') {
            $faktur->where('tindak_lanjut_check', $fakturPembelianRTindakLanjutFilter);
        }

        if ($statusFakturFilter) {
            $faktur->where('status_faktur', $statusFakturFilter);
        }


        // if ($fakturTipeBarangFilter) {
        //     $faktur->where('tipe_barang', $fakturTipeBarangFilter);
        // }

        // if ($fakturDihentikanFilter  !== null && $fakturDihentikanFilter !== '') {
        //     $faktur->where('dihentikan', $fakturDihentikanFilter);
        // }

        $totalRecordsWithFilter = $faktur->count();
        $totalRecords = DB::table('permintaan_pembelian')->count();

        $records = $faktur
            ->orderBy($columnName, $columnSortOrder)
            ->offset($start)
            ->limit($length)
            ->get();
        
        $data_arr = [];

        foreach ($records as $key => $record) {
            $detail = DB::table('faktur_pembelian_detail')
                ->where('faktur_pembelian_id', $record->id)
                ->first();

            $checkbox = '<input type="checkbox" class="faktur_checkbox" value="'.$record->id.'">';
        
            $data_arr[] = [
                "checkbox"                  => $checkbox,
                "no"                        => $start + $key + 1,
                "id"                        => $record->id,
                "no_faktur"                 => $record->no_faktur,
                "no_formulir"               => $record->no_formulir,
                "no_persetujuan"            => $record->no_persetujuan,
                "tgl_faktur"                => $record->tgl_faktur,
                "deskripsi_faktur"          => $detail->deskripsi_faktur ?? null,
                "pengguna_faktur"           => $record->pengguna_faktur,
                "tindak_lanjut_check"       => $record->tindak_lanjut_check,
                "urgent_check"              => $record->urgent_check,
                "catatan_pemeriksaan_check" => $record->catatan_pemeriksaan_check,
                "status_faktur"             => $record->status_faktur,
                "disetujui_check"           => $record->disetujui_check,
                "pemasok_faktur"            => $record->pemasok_faktur,
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
