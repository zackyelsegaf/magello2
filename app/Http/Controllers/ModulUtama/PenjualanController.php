<?php

namespace App\Http\Controllers\ModulUtama;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ModulUtama\Penjualan\FakturPenagihan;
use App\Models\ModulUtama\Penjualan\FakturPenjualan;
use Yajra\DataTables\Facades\DataTables;
use App\Models\ModulUtama\Penjualan\PenawaranPenjualan;
use App\Models\ModulUtama\Penjualan\PenerimaanPenjualan;
use App\Models\ModulUtama\Penjualan\PengirimanPenjualan;
use App\Models\ModulUtama\Penjualan\PesananPenjualan;
use App\Models\ModulUtama\Penjualan\ReturPenjualan;

class PenjualanController extends Controller
{
    // =====================
    // PENAWARAN PENJUALAN
    // =====================
    public function indexPenawaran()
    {
        $this->menu = 'penawaran';
        return $this->dataUtama();
    }

    public function fetchPenawaran(Request $request)
    {
        $model = PenawaranPenjualan::with(['user', 'cabang'])
            ->when($request->filled('no_penawaran'), function ($q) use ($request) {
                $q->where('no_penawaran', 'like', '%' . $request->no_penawaran . '%');
            })
            ->when($request->filled('tgl_penawaran'), function ($q) use ($request) {
                $q->whereDate('tgl_penawaran', $request->tgl_penawaran);
            })
            ->when($request->filled('tgl_mulai') && $request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereBetween('tgl_penawaran', [$request->tgl_mulai, $request->tgl_sampai]);
            })
            ->when($request->filled('tgl_mulai') && !$request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereDate('tgl_penawaran', '>=', $request->tgl_mulai);
            })
            ->when(!$request->filled('tgl_mulai') && $request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereDate('tgl_penawaran', '<=', $request->tgl_sampai);
            });

        return datatables()->of($model)
            ->addIndexColumn()
            ->addColumn('pengguna', fn($row) => $row->user->name ?? '-')
            ->addColumn('cabang', fn($row) => $row->cabang->nama ?? '-')
            ->addColumn('catatan_pemeriksaan', fn($row) => $row->catatan_pemeriksaan ? true : false)
            ->addColumn('tindak_lanjut', fn($row) => $row->tindak_lanjut ? true : false)
            ->addColumn('disetujui', fn($row) => $row->disetujui ? true : false)
            ->make(true);
    }

    public function fetchPesanan(Request $request)
    {
        $model = PesananPenjualan::with(['user', 'cabang'])
            ->when($request->filled('no_pesanan'), function ($q) use ($request) {
                $q->where('no_pesanan', 'like', '%' . $request->no_pesanan . '%');
            })
            ->when($request->filled('tgl_pesanan'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', $request->tgl_pesanan);
            })
            ->when($request->filled('tgl_mulai') && $request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereBetween('tgl_pesanan', [$request->tgl_mulai, $request->tgl_sampai]);
            })
            ->when($request->filled('tgl_mulai') && !$request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', '>=', $request->tgl_mulai);
            })
            ->when(!$request->filled('tgl_mulai') && $request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', '<=', $request->tgl_sampai);
            });

        return DataTables::of($model)
            ->addIndexColumn()
            ->addColumn('pengguna', fn($row) => $row->user->name ?? '-')
            ->addColumn('cabang', fn($row) => $row->cabang->nama ?? '-')
            ->addColumn('catatan_pemeriksaan', fn($row) => $row->catatan_pemeriksaan ? true : false)
            ->addColumn('tindak_lanjut', fn($row) => $row->tindak_lanjut ? true : false)
            ->addColumn('disetujui', fn($row) => $row->disetujui ? true : false)
            ->make(true);
    }

    public function fetchFakturPenjualan(Request $request)
    {
        $model = FakturPenjualan::with(['user', 'cabang'])
            ->when($request->filled('no_pesanan'), function ($q) use ($request) {
                $q->where('no_pesanan', 'like', '%' . $request->no_pesanan . '%');
            })
            ->when($request->filled('tgl_pesanan'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', $request->tgl_pesanan);
            })
            ->when($request->filled('tgl_mulai') && $request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereBetween('tgl_pesanan', [$request->tgl_mulai, $request->tgl_sampai]);
            })
            ->when($request->filled('tgl_mulai') && !$request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', '>=', $request->tgl_mulai);
            })
            ->when(!$request->filled('tgl_mulai') && $request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', '<=', $request->tgl_sampai);
            });

        return DataTables::of($model)
            ->addIndexColumn()
            ->addColumn('pengguna', fn($row) => $row->user->name ?? '-')
            ->addColumn('cabang', fn($row) => $row->cabang->nama ?? '-')
            ->addColumn('catatan_pemeriksaan', fn($row) => $row->catatan_pemeriksaan ? true : false)
            ->addColumn('tindak_lanjut', fn($row) => $row->tindak_lanjut ? true : false)
            ->addColumn('disetujui', fn($row) => $row->disetujui ? true : false)
            ->make(true);
    }

    public function fetchPengiriman(Request $request)
    {
        $model = PengirimanPenjualan::with(['user', 'cabang'])
            ->when($request->filled('no_pesanan'), function ($q) use ($request) {
                $q->where('no_pesanan', 'like', '%' . $request->no_pesanan . '%');
            })
            ->when($request->filled('tgl_pesanan'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', $request->tgl_pesanan);
            })
            ->when($request->filled('tgl_mulai') && $request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereBetween('tgl_pesanan', [$request->tgl_mulai, $request->tgl_sampai]);
            })
            ->when($request->filled('tgl_mulai') && !$request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', '>=', $request->tgl_mulai);
            })
            ->when(!$request->filled('tgl_mulai') && $request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', '<=', $request->tgl_sampai);
            });

        return DataTables::of($model)
            ->addIndexColumn()
            ->addColumn('pengguna', fn($row) => $row->user->name ?? '-')
            ->addColumn('cabang', fn($row) => $row->cabang->nama ?? '-')
            ->addColumn('catatan_pemeriksaan', fn($row) => $row->catatan_pemeriksaan ? true : false)
            ->addColumn('tindak_lanjut', fn($row) => $row->tindak_lanjut ? true : false)
            ->addColumn('disetujui', fn($row) => $row->disetujui ? true : false)
            ->make(true);
    }

    public function fetchFakturPenagihan(Request $request)
    {
        $model = FakturPenagihan::with(['user', 'cabang'])
            ->when($request->filled('no_pesanan'), function ($q) use ($request) {
                $q->where('no_pesanan', 'like', '%' . $request->no_pesanan . '%');
            })
            ->when($request->filled('tgl_pesanan'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', $request->tgl_pesanan);
            })
            ->when($request->filled('tgl_mulai') && $request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereBetween('tgl_pesanan', [$request->tgl_mulai, $request->tgl_sampai]);
            })
            ->when($request->filled('tgl_mulai') && !$request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', '>=', $request->tgl_mulai);
            })
            ->when(!$request->filled('tgl_mulai') && $request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', '<=', $request->tgl_sampai);
            });

        return DataTables::of($model)
            ->addIndexColumn()
            ->addColumn('pengguna', fn($row) => $row->user->name ?? '-')
            ->addColumn('cabang', fn($row) => $row->cabang->nama ?? '-')
            ->addColumn('catatan_pemeriksaan', fn($row) => $row->catatan_pemeriksaan ? true : false)
            ->addColumn('tindak_lanjut', fn($row) => $row->tindak_lanjut ? true : false)
            ->addColumn('disetujui', fn($row) => $row->disetujui ? true : false)
            ->make(true);
    }
    public function fetchPenerimaan(Request $request)
    {
        $model = PenerimaanPenjualan::with(['user', 'cabang'])
            ->when($request->filled('no_pesanan'), function ($q) use ($request) {
                $q->where('no_pesanan', 'like', '%' . $request->no_pesanan . '%');
            })
            ->when($request->filled('tgl_pesanan'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', $request->tgl_pesanan);
            })
            ->when($request->filled('tgl_mulai') && $request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereBetween('tgl_pesanan', [$request->tgl_mulai, $request->tgl_sampai]);
            })
            ->when($request->filled('tgl_mulai') && !$request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', '>=', $request->tgl_mulai);
            })
            ->when(!$request->filled('tgl_mulai') && $request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', '<=', $request->tgl_sampai);
            });

        return DataTables::of($model)
            ->addIndexColumn()
            ->addColumn('pengguna', fn($row) => $row->user->name ?? '-')
            ->addColumn('cabang', fn($row) => $row->cabang->nama ?? '-')
            ->addColumn('catatan_pemeriksaan', fn($row) => $row->catatan_pemeriksaan ? true : false)
            ->addColumn('tindak_lanjut', fn($row) => $row->tindak_lanjut ? true : false)
            ->addColumn('disetujui', fn($row) => $row->disetujui ? true : false)
            ->make(true);
    }
    public function fetchRetur(Request $request)
    {
        $model = ReturPenjualan::with(['user', 'cabang'])
            ->when($request->filled('no_pesanan'), function ($q) use ($request) {
                $q->where('no_pesanan', 'like', '%' . $request->no_pesanan . '%');
            })
            ->when($request->filled('tgl_pesanan'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', $request->tgl_pesanan);
            })
            ->when($request->filled('tgl_mulai') && $request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereBetween('tgl_pesanan', [$request->tgl_mulai, $request->tgl_sampai]);
            })
            ->when($request->filled('tgl_mulai') && !$request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', '>=', $request->tgl_mulai);
            })
            ->when(!$request->filled('tgl_mulai') && $request->filled('tgl_sampai'), function ($q) use ($request) {
                $q->whereDate('tgl_pesanan', '<=', $request->tgl_sampai);
            });

        return DataTables::of($model)
            ->addIndexColumn()
            ->addColumn('pengguna', fn($row) => $row->user->name ?? '-')
            ->addColumn('cabang', fn($row) => $row->cabang->nama ?? '-')
            ->addColumn('catatan_pemeriksaan', fn($row) => $row->catatan_pemeriksaan ? true : false)
            ->addColumn('tindak_lanjut', fn($row) => $row->tindak_lanjut ? true : false)
            ->addColumn('disetujui', fn($row) => $row->disetujui ? true : false)
            ->make(true);
    }
    public function createPenawaran() {
        $this->menu = "penawaran";
        return $this->BaseCreate();
    }
    public function storePenawaran(Request $request) {}
    public function editPenawaran($id) {}
    public function updatePenawaran(Request $request, $id) {}
    public function destroyPenawaran($id) {}

    // =====================
    // PESANAN PENJUALAN
    // =====================
    public function indexPesanan()
    {
        $this->menu = 'pesanan';
        return $this->dataUtama();
    }
    public function createPesanan() {}
    public function storePesanan(Request $request) {}
    public function editPesanan($id) {}
    public function updatePesanan(Request $request, $id) {}
    public function destroyPesanan($id) {}

    // =====================
    // PENGIRIMAN PENJUALAN
    // =====================
    public function indexPengiriman() {
        $this->menu = 'pengiriman';
        return $this->dataUtama();
    }
    public function createPengiriman() {}
    public function storePengiriman(Request $request) {}
    public function editPengiriman($id) {}
    public function updatePengiriman(Request $request, $id) {}
    public function destroyPengiriman($id) {}

    // =====================
    // FAKTUR PENJUALAN
    // =====================
    public function indexFakturPenjualan() {
        $this->menu = 'fakturpenjualan';
        return $this->dataUtama();
    }
    public function createFakturPenjualan() {}
    public function storeFakturPenjualan(Request $request) {}
    public function editFakturPenjualan($id) {}
    public function updateFakturPenjualan(Request $request, $id) {}
    public function destroyFakturPenjualan($id) {}

    // =====================
    // FAKTUR PENAGIHAN
    // =====================
    public function indexFakturPenagihan() {
        $this->menu = 'fakturpenagihan';
        return $this->dataUtama();
    }
    public function createFakturPenagihan() {}
    public function storeFakturPenagihan(Request $request) {}
    public function editFakturPenagihan($id) {}
    public function updateFakturPenagihan(Request $request, $id) {}
    public function destroyFakturPenagihan($id) {}

    // =====================
    // PENERIMAAN PEMBAYARAN
    // =====================
    public function indexPenerimaan() {
        $this->menu = 'penerimaan';
        return $this->dataUtama();
    }
    public function createPenerimaan() {}
    public function storePenerimaan(Request $request) {}
    public function editPenerimaan($id) {}
    public function updatePenerimaan(Request $request, $id) {}
    public function destroyPenerimaan($id) {}

    // =====================
    // RETUR PENJUALAN
    // =====================
    public function indexRetur() {
        $this->menu = 'returpenjualan';
        return $this->dataUtama();
    }
    public function createRetur() {}
    public function storeRetur(Request $request) {}
    public function editRetur($id) {}
    public function updateRetur(Request $request, $id) {}
    public function destroyRetur($id) {}
}
