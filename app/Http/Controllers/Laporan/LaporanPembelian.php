<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pemasok;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanPembelian extends Controller
{
    public function index(){
        return view('laporan.pembelian.index', ['title' => 'Menu Laporan Pembelian']);
    }

    //Daftar Faktur Pembelian
    public function faktur(Request $req){
        //coming soon
    }
    //Daftar Penerimaan Barang
    public function penerimaan(Request $req){
        //coming soon
    }
    //Pembelian Per Pemasok - Ringkasan
    public function pemasok_ringkasan(Request $req){
        //coming soon
    }
    //Pembelian Per Pemasok - Rincian
    public function pemasok_rincian(Request $req){
        //coming soon
    }
    //Daftar Retur Pembelian
    public function retur(Request $req){
        //coming soon
    }
    //Rincian Daftar Retur Pembelian
    public function retur_rincian(Request $req){
        //coming soon
    }
    //Pesanan Pembelian Per Pemasok
    public function pesanan_pemasok(Request $req){
        $tanggal = $req->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        $tanggalAwal = Carbon::parse($tanggal['from']);
        $tanggalAkhir = Carbon::parse($tanggal['to']);

        $data = Pemasok::whereHas('pesanan')->get();

        $data = $data->map(function ($pemasok) use ($tanggalAwal, $tanggalAkhir) {
            $filtered = $pemasok->pesanan->filter(function ($pesanan) use ($tanggalAwal, $tanggalAkhir) {
                $tanggal = Carbon::createFromFormat('d/m/Y', $pesanan->tgl_pesanan);
                return $tanggal->between($tanggalAwal, $tanggalAkhir);
            });

            $pemasok->setRelation('pesanan', $filtered->values());
            return $pemasok;
        })->filter(function ($pemasok) {
            return $pemasok->pesanan->isNotEmpty();
        })->values();
        
        $pdf = Pdf::loadView('laporan.pembelian.export_pesanan_pemasok', compact('data', 'tanggal'));
        return $pdf->stream();
    }
    //Pesanan Pembelian Per Barang
    public function pesanan_barang(Request $req){
        $tanggal = $req->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        $tanggalAwal = Carbon::parse($tanggal['from']);
        $tanggalAkhir = Carbon::parse($tanggal['to']);

        $data = Barang::with(['detailPesanan.rincian'])->get();

        $data = $data->map(function ($barang) use ($tanggalAwal, $tanggalAkhir) {
            $filtered = $barang->detailPesanan->filter(function ($detail) use ($tanggalAwal, $tanggalAkhir) {
                $tanggal = Carbon::createFromFormat('d/m/Y', $detail->rincian->tgl_pesanan);
                return $tanggal->between($tanggalAwal, $tanggalAkhir);
            });

            $barang->setRelation('detailPesanan', $filtered->values());
            return $barang;
        })->filter(function ($barang) {
            return $barang->detailPesanan->isNotEmpty();
        })->values();
        
        $pdf = Pdf::loadView('laporan.pembelian.export_pesanan_barang', compact('data', 'tanggal'));
        return $pdf->stream();
    }
    //Permintaan Pembelian Per Barang
    public function permintaan_barang(Request $req){
        $tanggal = $req->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        $data = Barang::whereHas('detailPermintaan.rincian', function ($query) use ($tanggal) {
                $query->whereBetween('tgl_diminta', [$tanggal['from'], $tanggal['to']]);
            })
            ->with(['detailPermintaan' => function ($query) use ($tanggal) {
                $query->whereBetween('tgl_diminta', [$tanggal['from'], $tanggal['to']]);
            }])
            ->get();
        
        $pdf = Pdf::loadView('laporan.pembelian.export_permintaan_barang', compact('data', 'tanggal'));
        return $pdf->stream();
    }
    //Histori Penerimaan Barang
    public function histori_penerimaan(Request $req){
        //coming soon
    }
    //Histori Pesanan Pembelian
    public function histori_pesanan(Request $req){
        //coming soon
    }
}
