<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pemasok;
use App\Models\PenerimaanPembelian;
use App\Models\PesananPembelian;
use App\Models\ReturPembelian;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanPembelian extends Controller
{
    public function index(){
        return view('laporan.pembelian.index', ['title' => 'Menu Laporan Pembelian']);
    }

    //Daftar Faktur Pembelian
    public function faktur(Request $req){
        $tanggal = $req->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        $tanggalAwal = Carbon::parse($tanggal['from']);
        $tanggalAkhir = Carbon::parse($tanggal['to']);

        $data = Pemasok::whereHas('fakturPembelian')->get();

        $data = $data->map(function ($pemasok) use ($tanggalAwal, $tanggalAkhir) {
            $filtered = $pemasok->fakturPembelian->filter(function ($pesanan) use ($tanggalAwal, $tanggalAkhir) {
                $tanggal = Carbon::createFromFormat('d/m/Y', $pesanan->tgl_faktur);
                return $tanggal->between($tanggalAwal, $tanggalAkhir);
            });

            $pemasok->setRelation('fakturPembelian', $filtered->values());
            return $pemasok;
        })->filter(function ($pemasok) {
            return $pemasok->fakturPembelian->isNotEmpty();
        })->values();
        
        $title = "Daftar Faktur Pembelian";
        $pdf = Pdf::loadView('laporan.pembelian.export_faktur', compact('data', 'tanggal', 'title'));
        return $pdf->stream();
    }
    //Daftar Penerimaan Barang
    public function penerimaan(Request $req){
        $tanggal = $req->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        $tanggalAwal = Carbon::parse($tanggal['from']);
        $tanggalAkhir = Carbon::parse($tanggal['to']);

        $data = Pemasok::whereHas('penerimaanPembelian')->get();

        $data = $data->map(function ($pemasok) use ($tanggalAwal, $tanggalAkhir) {
            $filtered = $pemasok->penerimaanPembelian->filter(function ($penerimaan) use ($tanggalAwal, $tanggalAkhir) {
                $tanggal = Carbon::createFromFormat('d/m/Y', $penerimaan->tgl_penerimaan);
                return $tanggal->between($tanggalAwal, $tanggalAkhir);
            });

            $pemasok->setRelation('penerimaanPembelian', $filtered->values());
            return $pemasok;
        })->filter(function ($pemasok) {
            return $pemasok->penerimaanPembelian->isNotEmpty();
        })->values();
        
        $title = "Daftar Penerimaan Barang";
        $pdf = Pdf::loadView('laporan.pembelian.export_penerimaan', compact('data', 'tanggal', 'title'));
        return $pdf->stream();
    }
    //Pembelian Per Pemasok - Ringkasan
    public function pemasok_ringkasan(Request $req){
        $tanggal = $req->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        $tanggalAwal = Carbon::parse($tanggal['from']);
        $tanggalAkhir = Carbon::parse($tanggal['to']);

        $data = DB::table('pemasok')
            ->select(['nama', DB::raw('sum(faktur_pembelian.sub_total) as jumlah'), 'tgl_faktur'])
            ->join('faktur_pembelian', 'faktur_pembelian.no_pemasok', '=', 'pemasok.pemasok_id')
            ->groupBy('nama')
            ->get();

        $data = $data->filter(function($pemasok) use($tanggalAwal, $tanggalAkhir){
            $tanggal = Carbon::createFromFormat('d/m/Y', $pemasok->tgl_faktur);
            return $tanggal->between($tanggalAwal, $tanggalAkhir);
        })->values();

        $title = "Pembelian Per Pemasok - Ringkasan";
        $pdf = Pdf::loadView('laporan.pembelian.export_pemasok_ringkasan', compact('data', 'tanggal', 'title'));
        return $pdf->stream();
    }
    //Pembelian Per Pemasok - Rincian
    public function pemasok_rincian(Request $req){
        $tanggal = $req->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        $tanggalAwal = Carbon::parse($tanggal['from']);
        $tanggalAkhir = Carbon::parse($tanggal['to']);

        $data = Pemasok::with(['fakturPembelian', 'returPembelian'])->get();

        $data = $data->map(function ($pemasok) use ($tanggalAwal, $tanggalAkhir) {
            $filtered = $pemasok->fakturPembelian->filter(function ($faktur) use ($tanggalAwal, $tanggalAkhir) {
                $tanggal = Carbon::createFromFormat('d/m/Y', $faktur->tgl_faktur);
                return $tanggal->between($tanggalAwal, $tanggalAkhir);
            });
            $pemasok->setRelation('fakturPembelian', $filtered->values());

            $filtered = $pemasok->returPembelian->filter(function ($retur) use ($tanggalAwal, $tanggalAkhir) {
                $tanggal = Carbon::createFromFormat('d/m/Y', $retur->tgl_retur);
                return $tanggal->between($tanggalAwal, $tanggalAkhir);
            });
            $pemasok->setRelation('returPembelian', $filtered->values());

            return $pemasok;
        })->filter(function ($pemasok) {
            return $pemasok->fakturPembelian->isNotEmpty() || $pemasok->returPembelian->isNotEmpty();
        })->values();
        
        $title = "Pembelian Per Pemasok - Rincian";
        $pdf = Pdf::loadView('laporan.pembelian.export_pemasok_rincian', compact('data', 'tanggal', 'title'));
        return $pdf->stream();
    }
    //Daftar Retur Pembelian
    public function retur(Request $req){
        $tanggal = $req->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        $tanggalAwal = Carbon::parse($tanggal['from']);
        $tanggalAkhir = Carbon::parse($tanggal['to']);

        $data = Pemasok::whereHas('returPembelian')->get();

        $data = $data->map(function ($pemasok) use ($tanggalAwal, $tanggalAkhir) {
            $filtered = $pemasok->returPembelian->filter(function ($retur) use ($tanggalAwal, $tanggalAkhir) {
                $tanggal = Carbon::createFromFormat('d/m/Y', $retur->tgl_retur);
                return $tanggal->between($tanggalAwal, $tanggalAkhir);
            });

            $pemasok->setRelation('returPembelian', $filtered->values());
            return $pemasok;
        })->filter(function ($pemasok) {
            return $pemasok->returPembelian->isNotEmpty();
        })->values();
        
        $title = "Daftar Retur Pembelian";
        $pdf = Pdf::loadView('laporan.pembelian.export_retur', compact('data', 'tanggal', 'title'));
        return $pdf->stream();
    }
    //Rincian Daftar Retur Pembelian
    public function retur_rincian(Request $req){
        $tanggal = $req->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        $tanggalAwal = Carbon::parse($tanggal['from']);
        $tanggalAkhir = Carbon::parse($tanggal['to']);

        $data = ReturPembelian::with(['detail'])->get();
        $data = $data->filter(function ($retur) use ($tanggalAwal, $tanggalAkhir) {
            $tanggal = Carbon::createFromFormat('d/m/Y', $retur->tgl_retur);
            return $tanggal->between($tanggalAwal, $tanggalAkhir);
        })->values();
        
        $title = "Rincian Daftar Retur Pembelian";
        $pdf = Pdf::loadView('laporan.pembelian.export_retur_rincian', compact('data', 'tanggal', 'title'));
        return $pdf->stream();
    }
    //Pesanan Pembelian Per Pemasok
    public function pesanan_pemasok(Request $req){
        $tanggal = $req->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        $tanggalAwal = Carbon::parse($tanggal['from']);
        $tanggalAkhir = Carbon::parse($tanggal['to']);

        $data = Pemasok::whereHas('pesananPembelian')->get();

        $data = $data->map(function ($pemasok) use ($tanggalAwal, $tanggalAkhir) {
            $filtered = $pemasok->pesananPembelian->filter(function ($pesanan) use ($tanggalAwal, $tanggalAkhir) {
                $tanggal = Carbon::createFromFormat('d/m/Y', $pesanan->tgl_pesanan);
                return $tanggal->between($tanggalAwal, $tanggalAkhir);
            });

            $pemasok->setRelation('pesananPembelian', $filtered->values());
            return $pemasok;
        })->filter(function ($pemasok) {
            return $pemasok->pesananPembelian->isNotEmpty();
        })->values();
        
        $title = "Pesanan Pembelian Per Pemasok";
        $pdf = Pdf::loadView('laporan.pembelian.export_pesanan_pemasok', compact('data', 'tanggal', 'title'));
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
        
        $title = "Pesanan Pembelian Per Barang";
        $pdf = Pdf::loadView('laporan.pembelian.export_pesanan_barang', compact('data', 'tanggal', 'title'));
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
        
            $title = "Permintaan Pembelian Per Barang";
        $pdf = Pdf::loadView('laporan.pembelian.export_permintaan_barang', compact('data', 'tanggal', 'title'));
        return $pdf->stream();
    }
    //Histori Penerimaan Barang
    public function histori_penerimaan(Request $req){
        $tanggal = $req->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        $tanggalAwal = Carbon::parse($tanggal['from']);
        $tanggalAkhir = Carbon::parse($tanggal['to']);

        $data = PenerimaanPembelian::with(['detail'])->get();
        $data = $data->filter(function ($penerimaan) use ($tanggalAwal, $tanggalAkhir) {
            $tanggal = Carbon::createFromFormat('d/m/Y', $penerimaan->tgl_penerimaan);
            return $tanggal->between($tanggalAwal, $tanggalAkhir);
        })->values();
        
        $title = "Histori Penerimaan Barang";
        $pdf = Pdf::loadView('laporan.pembelian.export_histori_penerimaan', compact('data', 'tanggal', 'title'));
        return $pdf->stream();
    }
    //Histori Pesanan Pembelian
    public function histori_pesanan(Request $req){
        $tanggal = $req->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        $tanggalAwal = Carbon::parse($tanggal['from']);
        $tanggalAkhir = Carbon::parse($tanggal['to']);

        $data = PesananPembelian::with(['detail', 'faktur'])->get();
        $data = $data->filter(function ($pesanan) use ($tanggalAwal, $tanggalAkhir) {
            $tanggal = Carbon::createFromFormat('d/m/Y', $pesanan->tgl_pesanan);
            return $tanggal->between($tanggalAwal, $tanggalAkhir);
        })->values();
        
        $title = "Histori Pesanan Pembelian";
        $pdf = Pdf::loadView('laporan.pembelian.export_histori_pesanan', compact('data', 'tanggal', 'title'));
        return $pdf->stream();
    }
}
