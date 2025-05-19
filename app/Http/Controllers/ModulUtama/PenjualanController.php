<?php

namespace App\Http\Controllers\ModulUtama;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PenjualanController extends Controller
{
    // =====================
    // PENAWARAN PENJUALAN
    // =====================
    public function indexPenawaran() {
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        $routeFetch = route('penjualan.penawaran.fetch');
        return view('modulutama.penjualan.penawaran.data', compact('routeFetch','nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang'));
    }

    public function fetchPenawaran() {
        return response()->json('helo');
    }
    public function createPenawaran() {}
    public function storePenawaran(Request $request) {}
    public function editPenawaran($id) {}
    public function updatePenawaran(Request $request, $id) {}
    public function destroyPenawaran($id) {}

    // =====================
    // PESANAN PENJUALAN
    // =====================
    public function indexPesanan() {}
    public function createPesanan() {}
    public function storePesanan(Request $request) {}
    public function editPesanan($id) {}
    public function updatePesanan(Request $request, $id) {}
    public function destroyPesanan($id) {}

    // =====================
    // PENGIRIMAN PENJUALAN
    // =====================
    public function indexPengiriman() {}
    public function createPengiriman() {}
    public function storePengiriman(Request $request) {}
    public function editPengiriman($id) {}
    public function updatePengiriman(Request $request, $id) {}
    public function destroyPengiriman($id) {}

    // =====================
    // FAKTUR PENJUALAN
    // =====================
    public function indexFakturPenjualan() {}
    public function createFakturPenjualan() {}
    public function storeFakturPenjualan(Request $request) {}
    public function editFakturPenjualan($id) {}
    public function updateFakturPenjualan(Request $request, $id) {}
    public function destroyFakturPenjualan($id) {}

    // =====================
    // FAKTUR PENAGIHAN
    // =====================
    public function indexFakturPenagihan() {}
    public function createFakturPenagihan() {}
    public function storeFakturPenagihan(Request $request) {}
    public function editFakturPenagihan($id) {}
    public function updateFakturPenagihan(Request $request, $id) {}
    public function destroyFakturPenagihan($id) {}

    // =====================
    // PENERIMAAN PEMBAYARAN
    // =====================
    public function indexPenerimaan() {}
    public function createPenerimaan() {}
    public function storePenerimaan(Request $request) {}
    public function editPenerimaan($id) {}
    public function updatePenerimaan(Request $request, $id) {}
    public function destroyPenerimaan($id) {}

    // =====================
    // RETUR PENJUALAN
    // =====================
    public function indexRetur() {}
    public function createRetur() {}
    public function storeRetur(Request $request) {}
    public function editRetur($id) {}
    public function updateRetur(Request $request, $id) {}
    public function destroyRetur($id) {}

}
