<?php

namespace App\Http\Controllers\ModulUtama;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function indexPermintaan() {}
    public function createPermintaan() {}
    public function storePermintaan(Request $request) {}
    public function editPermintaan($id) {}
    public function updatePermintaan(Request $request, $id) {}
    public function destroyPermintaan($id) {}

    // Pesanan Pembelian
    public function indexPesanan() {}
    public function createPesanan() {}
    public function storePesanan(Request $request) {}
    public function editPesanan($id) {}
    public function updatePesanan(Request $request, $id) {}
    public function destroyPesanan($id) {}

    // Penerimaan Barang
    public function indexPenerimaan() {}
    public function createPenerimaan() {}
    public function storePenerimaan(Request $request) {}
    public function editPenerimaan($id) {}
    public function updatePenerimaan(Request $request, $id) {}
    public function destroyPenerimaan($id) {}

    // Faktur
    public function indexFaktur() {}
    public function createFaktur() {}
    public function storeFaktur(Request $request) {}
    public function editFaktur($id) {}
    public function updateFaktur(Request $request, $id) {}
    public function destroyFaktur($id) {}

    // Pembayaran
    public function indexPembayaran() {}
    public function createPembayaran() {}
    public function storePembayaran(Request $request) {}
    public function editPembayaran($id) {}
    public function updatePembayaran(Request $request, $id) {}
    public function destroyPembayaran($id) {}

    // Retur
    public function indexRetur() {}
    public function createRetur() {}
    public function storeRetur(Request $request) {}
    public function editRetur($id) {}
    public function updateRetur(Request $request, $id) {}
    public function destroyRetur($id) {}
}
