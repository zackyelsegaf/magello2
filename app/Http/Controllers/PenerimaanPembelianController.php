<?php

namespace App\Http\Controllers;

use App\Models\PenerimaanPembelian;
use App\Models\Barang;
use App\Models\PenerimaanPembelianDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PenerimaanPembelianController extends Controller
{

    public function tambahPenerimaan(Request $request)
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
                DB::raw('MAX(pesanan_pembelian_detail.harga_satuan) as harga_satuan'),
                DB::raw('MAX(pesanan_pembelian_detail.diskon_barang) as diskon_barang'),
                DB::raw('MAX(pesanan_pembelian_detail.pajak) as pajak'),
                DB::raw('MAX(pesanan_pembelian_detail.jumlah_total_harga) as jumlah_total_harga'),
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
        $latest = PenerimaanPembelian::orderBy('no_penerimaan', 'desc')->first();
        $nextID = $latest ? intval(substr($latest->no_penerimaan, strlen($prefix))) + 1 : 1;
        $kodeBaru = $prefix . sprintf("%04d", $nextID);

        return view('pembelian.penerimaan.tambahpenerimaan', compact('barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'proyek', 'pemasok', 'satuan', 'mata_uang', 'kodeBaru', 'nama_akun', 'syarat', 'pesanan_pembelian'));
    }
    
    public function getDetailPenerimaan(Request $request)
    {
        $no_pesanan = $request->no_pesanan;

        $data = DB::table('pesanan_pembelian')
            ->join('pesanan_pembelian_detail', 'pesanan_pembelian.id', '=', 'pesanan_pembelian_detail.pesanan_pembelian_id')
            ->where('pesanan_pembelian.no_pesanan', $no_pesanan)
            ->select(
                'pesanan_pembelian.no_pesanan',
                'pesanan_pembelian_detail.no_barang',
                'pesanan_pembelian_detail.deskripsi_barang',
                'pesanan_pembelian_detail.kts_pesanan',
                'pesanan_pembelian_detail.no_permintaan',
                'pesanan_pembelian_detail.satuan',
                'pesanan_pembelian_detail.harga_satuan',
                'pesanan_pembelian_detail.diskon_barang',
                'pesanan_pembelian_detail.pajak',
                'pesanan_pembelian_detail.jumlah_total_harga'
            )
            ->get();

        return response()->json($data);
    }

    public function PenerimaanSearch(Request $request){
        if ($request->ajax()) {
            $pesanan_pembelian_2 = DB::table('pesanan_pembelian');

            if ($request->no_pesanan) {
                $pesanan_pembelian_2->where('no_pesanan', 'like', '%' . $request->no_pesanan . '%');
            }

            $result_2 = $pesanan_pembelian_2->get();
            return response()->json($result_2);
        }
        return view('pembelian.penerimaan.tambahpenerimaan', compact('pesanan_pembelian_2'));
    }

    public function simpanPenerimaan(Request $request)
    {
        $rules = [
            'no_pemasok' => 'nullable|string|max:255',
            'no_formulir' => 'nullable|string|max:255',
            'pemasok_penerimaan' => 'required|string|max:255',
            'tgl_penerimaan' => 'required|string|max:255',
            'deskripsi_penerimaan' => 'nullable|string|max:255',
            'departemen' => 'required|string|max:255',
            'gudang' => 'required|string|max:255',
            'proyek' => 'required|string|max:255',
            'tindak_lanjut_check' => 'nullable|boolean',
            'disetujui_check' => 'nullable|boolean',
            'urgent_check' => 'nullable|boolean',
            'deskripsi_1' => 'nullable|string|max:255',
            'catatan_pemeriksaan_check' => 'nullable|boolean',
            'deskripsi_2' => 'nullable|string|max:255',
            'status_penerimaan' => 'nullable|string|max:255',
            'pengguna_penerimaan' => 'nullable|string|max:255',
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
            'kts_penerimaan.*'   => 'nullable|string|max:255',
            'satuan.*'           => 'nullable|string|max:255',
            'no_pesanan.*'       => 'nullable|string|max:255',
            'no_permintaan.*'    => 'nullable|string|max:255',
            'kts_faktur.*'       => 'nullable|string|max:255',
            'serial_number.*'    => 'nullable|string|max:255',
            'harga_satuan.*'       => 'nullable|string|max:255',
            'diskon_barang.*'      => 'nullable|string|max:255',
            'kode_pajak.*'         => 'nullable|string|max:255',
            'jumlah_total_harga.*' => 'nullable|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $penerimaan = new PenerimaanPembelian($validator->validated());
            $penerimaan->save();

            $noBarang = $request->no_barang ?? [];
            $jumlahBarang = count($noBarang);

            for ($i = 0; $i < $jumlahBarang; $i++) {
                $kts_penerimaan = (int) str_replace(['.', ',', ' '], '', $request->kts_penerimaan[$i] ?? 0);
                $jumlah_total_harga = (int) str_replace(['Rp', '.', ',', ' '], '', $request->jumlah_total_harga[$i] ?? 0);

                $detail = new PenerimaanPembelianDetail();
                $detail->penerimaan_pembelian_id = $penerimaan->id;
                $detail->alamat_pemasok       = $request->alamat_pemasok;
                $detail->fob                  = $request->fob;
                $detail->tgl_kirim            = $request->tgl_kirim;
                $detail->no_barang            = $noBarang[$i] ?? null;
                $detail->deskripsi_barang     = $request->deskripsi_barang[$i] ?? null;
                $detail->kts_penerimaan       = $kts_penerimaan;
                $detail->satuan               = $request->satuan[$i] ?? null;
                $detail->kts_faktur           = $request->kts_faktur[$i] ?? null;
                $detail->harga_satuan         = $request->harga_satuan[$i] ?? null;
                $detail->diskon_barang        = $request->diskon_barang[$i] ?? null;
                $detail->kode_pajak           = $request->kode_pajak[$i] ?? null;
                $detail->jumlah_total_harga   = $jumlah_total_harga;
                $detail->no_pesanan           = $request->no_pesanan[$i] ?? null;
                $detail->no_permintaan        = $request->no_permintaan[$i] ?? null;
                $detail->serial_number        = $request->serial_number[$i] ?? null;
                $detail->save();

                if ($noBarang[$i]) {
                    $barang = Barang::where('no_barang', $noBarang[$i])->first();
                    if ($barang) {
                        $barang->kuantitas_saldo_awal += $kts_penerimaan;
                        $barang->total_saldo_awal += $jumlah_total_harga;
                        $barang->save();
                    }
                }
            }

            DB::commit();
            sweetalert()->success('Penerimaan barang berhasil disimpan.');
            return redirect()->route('pembelian/penerimaan/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function editPenerimaan($id)
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
        $penerimaanPembelian = PenerimaanPembelian::with(['detail', 'detail2'])->findOrFail($id);
        if (!$penerimaanPembelian) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        $penerimaan = $penerimaanPembelian;
        return view('pembelian.penerimaan.ubahpenerimaan', compact('penerimaanPembelian','nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'barang', 'proyek', 'syarat', 'pemasok', 'satuan', 'sub_barang', 'mata_uang', 'nama_akun', 'penerimaan'));
    }

    public function updatePenerimaan(Request $request, $id)
    {
        $rules = [
            'no_pemasok' => 'nullable|string|max:255',
            'no_formulir' => 'nullable|string|max:255',
            'pemasok_penerimaan' => 'required|string|max:255',
            'tgl_penerimaan' => 'required|string|max:255',
            'deskripsi_penerimaan' => 'nullable|string|max:255',
            'departemen' => 'required|string|max:255',
            'gudang' => 'required|string|max:255',
            'proyek' => 'required|string|max:255',
            'tindak_lanjut_check' => 'nullable|boolean',
            'disetujui_check' => 'nullable|boolean',
            'urgent_check' => 'nullable|boolean',
            'deskripsi_1' => 'nullable|string|max:255',
            'catatan_pemeriksaan_check' => 'nullable|boolean',
            'deskripsi_2' => 'nullable|string|max:255',
            'status_penerimaan' => 'nullable|string|max:255',
            'pengguna_penerimaan' => 'nullable|string|max:255',
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
            'kts_penerimaan.*'   => 'nullable|string|max:255',
            'satuan.*'           => 'nullable|string|max:255',
            'no_pesanan.*'       => 'nullable|string|max:255',
            'no_permintaan.*'    => 'nullable|string|max:255',
            'kts_faktur.*'       => 'nullable|string|max:255',
            'serial_number.*'    => 'nullable|string|max:255',
            'harga_satuan.*'       => 'nullable|string|max:255',
            'diskon_barang.*'      => 'nullable|string|max:255',
            'kode_pajak.*'         => 'nullable|string|max:255',
            'jumlah_total_harga.*' => 'nullable|string|max:255',
        ];

        $validated = $request->validate($rules);

        DB::beginTransaction();
        try {
            $penerimaanPembelian = PenerimaanPembelian::with(['detail', 'detail2'])->findOrFail($id);
            $penerimaanPembelian->pengguna_penerimaan = $request->pengguna_penerimaan;
            if ($request->disetujui_check && !$penerimaanPembelian->no_persetujuan) {
                $penerimaanPembelian->no_persetujuan = PenerimaanPembelian::generateNoPersetujuan();
            }
            $penerimaanPembelian->update($validated);

            PenerimaanPembelianDetail::where('penerimaan_pembelian_id', $penerimaanPembelian->id)->delete();

            $jumlahBarang = count($request->no_barang);
            for ($i = 0; $i < $jumlahBarang; $i++){
                
                $detail = new PenerimaanPembelianDetail();
                $detail->penerimaan_pembelian_id = $penerimaanPembelian->id;
                $detail->alamat_pemasok          = $request->alamat_pemasok;
                $detail->fob                     = $request->fob;
                $detail->tgl_kirim               = $request->tgl_kirim;
                $detail->no_barang               = $request->no_barang[$i];
                $detail->deskripsi_barang        = $request->deskripsi_barang[$i];
                $detail->kts_penerimaan          = $request->kts_penerimaan[$i];
                $detail->satuan                  = $request->satuan[$i];
                $detail->kts_faktur              = $request->kts_faktur[$i];
                $detail->harga_satuan            = $request->harga_satuan[$i];
                $detail->diskon_barang           = $request->diskon_barang[$i];
                $detail->kode_pajak              = $request->kode_pajak[$i];
                $detail->jumlah_total_harga      = $request->jumlah_total_harga[$i];
                $detail->no_pesanan              = $request->no_pesanan[$i];
                $detail->no_permintaan           = $request->no_permintaan[$i];
                $detail->serial_number           = $request->serial_number[$i];
                $detail->save();
            }
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('pembelian/penerimaan/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)'. $e->getMessage());
            return redirect()->back();
        }
    }
    
    public function hapusPenerimaan(Request $request)
    {
        try {
            $ids = $request->ids;
            PenerimaanPembelian::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('pembelian/penerimaan/list/page');    

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function daftarPenerimaan(Request $request)
    {
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $pemasok = DB::table('pemasok')->get();
        $pengguna_penerimaan = DB::table('penerimaan_pembelian')
            ->select('pengguna_penerimaan')
            ->distinct()
            ->get();

        return view('pembelian/penerimaan.datapenerimaan', compact('nama_barang','tipe_barang', 'tipe_persediaan','pengguna_penerimaan', 'pemasok'));
    }

    public function dataPenerimaan(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length          = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $penerimaanPembelianNoFilter  = $request->get('no_penerimaan');
        $penerimaanPembelianDeskripsiFilter  = $request->get('deskripsi_penerimaan');
        $penerimaanPembelianPenggunaFilter  = $request->get('pengguna_penerimaan');
        $penerimaanPembelianPemasokFilter  = $request->get('pemasok_penerimaan');
        $penerimaanPembelianCatatanPemeriksaanFilter = $request->get('catatan_pemeriksaan_check');
        $penerimaanPembelianPersetujuanFilter = $request->get('disetujui_check');
        $penerimaanPembelianUrgentFilter = $request->get('urgent_check');
        $penerimaanPembelianTindakLanjutFilter = $request->get('tindak_lanjut_check');
        $penerimaanPembelianStatusFilter = $request->get('status_penerimaan');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        // $penerimaan = DB::table('penerimaan_pembelian')
        // ->join('penerimaan_pembelian_detail', 'penerimaan_pembelian.id', '=', 'penerimaan_pembelian_detail.penerimaan_pembelian_id')
        // ->select(
        //     'penerimaan_pembelian.id',
        //     'penerimaan_pembelian.no_penerimaan',
        //     'penerimaan_pembelian.tgl_penerimaan',
        //     'penerimaan_pembelian.deskripsi_penerimaan',
        //     'penerimaan_pembelian.pengguna_penerimaan',
        //     'penerimaan_pembelian.tindak_lanjut_check',
        //     'penerimaan_pembelian.urgent_check',
        //     'penerimaan_pembelian.catatan_pemeriksaan_check',
        //     'penerimaan_pembelian.pemasok_penerimaan',
        //     'penerimaan_pembelian.no_pemasok',
        //     'penerimaan_pembelian.jumlah',
        //     'penerimaan_pembelian.sub_total',
        //     'penerimaan_pembelian_detail.uang_muka',
        //     'penerimaan_pembelian_detail.uang_muka_terpakai',
        //     'penerimaan_pembelian_detail.tgl_ekspektasi',
        //     // 'penerimaan_pembelian_detail.no_barang',
        //     // 'penerimaan_pembelian_detail.deskripsi_barang',
        //     // 'penerimaan_pembelian_detail.kts_pesanan',
        //     // 'penerimaan_pembelian_detail.satuan',
        // );
        $penerimaan = DB::table('penerimaan_pembelian');
        
        $totalRecords = $penerimaan->count();

        if ($penerimaanPembelianNoFilter) {
            $penerimaan->where('no_penerimaan', 'like', '%' . $penerimaanPembelianNoFilter . '%');
        }

        if ($penerimaanPembelianDeskripsiFilter) {
            $penerimaan->where('deskripsi_penerimaan', 'like', '%' . $penerimaanPembelianDeskripsiFilter . '%');
        }

        if ($penerimaanPembelianPenggunaFilter) {
            $penerimaan->where('pengguna_penerimaan', $penerimaanPembelianPenggunaFilter);
        }

        if ($penerimaanPembelianPemasokFilter) {
            $penerimaan->where('pemasok_penerimaan', $penerimaanPembelianPemasokFilter);
        }

        if ($penerimaanPembelianCatatanPemeriksaanFilter !== null && $penerimaanPembelianCatatanPemeriksaanFilter !== '') {
            $penerimaan->where('catatan_pemeriksaan_check', $penerimaanPembelianCatatanPemeriksaanFilter);
        }

        if ($penerimaanPembelianPersetujuanFilter !== null && $penerimaanPembelianPersetujuanFilter !== '') {
            $penerimaan->where('disetujui_check', $penerimaanPembelianPersetujuanFilter);
        }

        if ($penerimaanPembelianUrgentFilter !== null && $penerimaanPembelianUrgentFilter !== '') {
            $penerimaan->where('urgent_check', $penerimaanPembelianUrgentFilter);
        }

        if ($penerimaanPembelianTindakLanjutFilter !== null && $penerimaanPembelianTindakLanjutFilter !== '') {
            $penerimaan->where('tindak_lanjut_check', $penerimaanPembelianTindakLanjutFilter);
        }

        if ($penerimaanPembelianStatusFilter) {
            $penerimaan->where('status_penerimaan', $penerimaanPembelianStatusFilter);
        }

        // if ($penerimaanTipeBarangFilter) {
        //     $penerimaan->where('tipe_barang', $penerimaanTipeBarangFilter);
        // }

        // if ($penerimaanDihentikanFilter  !== null && $penerimaanDihentikanFilter !== '') {
        //     $penerimaan->where('dihentikan', $penerimaanDihentikanFilter);
        // }

        $totalRecordsWithFilter = $penerimaan->count();
        $totalRecords = DB::table('permintaan_pembelian')->count();

        $records = $penerimaan
            ->orderBy($columnName, $columnSortOrder)
            ->offset($start)
            ->limit($length)
            ->get();
        
        $data_arr = [];

        foreach ($records as $key => $record) {
            $detail = DB::table('penerimaan_pembelian_detail')
                ->where('penerimaan_pembelian_id', $record->id)
                ->first();

            $checkbox = '<input type="checkbox" class="penerimaan_checkbox" value="'.$record->id.'">';
        
            $data_arr[] = [
                "checkbox"                  => $checkbox,
                "no"                        => $start + $key + 1,
                "id"                        => $record->id,
                "no_penerimaan"             => $record->no_penerimaan,
                "no_persetujuan"            => $record->no_persetujuan,
                "tgl_penerimaan"            => $record->tgl_penerimaan,
                "deskripsi_penerimaan"      => $detail->deskripsi_penerimaan ?? null,
                "pengguna_penerimaan"       => $record->pengguna_penerimaan,
                "tindak_lanjut_check"       => $record->tindak_lanjut_check,
                "status_penerimaan"         => $record->status_penerimaan,
                "urgent_check"              => $record->urgent_check,
                "catatan_pemeriksaan_check" => $record->catatan_pemeriksaan_check,
                "disetujui_check"           => $record->disetujui_check,
                "pemasok_penerimaan"        => $record->pemasok_penerimaan,
                "no_pemasok"                => $record->no_pemasok,
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
