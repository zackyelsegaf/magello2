<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function daftarBarang(Request $request)
    {
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        return view('barang.databarang', compact('nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang'));
    }

    public function hapusBarang(Request $request)
    {
        try {
            $ids = $request->ids;
            foreach ($ids as $id) {
                $barang = Barang::find($id);
                Dokumen::destroy($barang->dokumen);
                $barang->delete();
            }
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('barang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function dataBarang(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter         = $request->get('nama_barang');
        $barangNoBarangFilter  = $request->get('no_barang');
        $barangKategoriBarangFilter  = $request->get('kategori_barang');
        $barangTipePersediaanFilter  = $request->get('tipe_persediaan');
        $barangTipeBarangFilter  = $request->get('tipe_barang');
        $barangDihentikanFilter  = $request->get('dihentikan');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $barang =  DB::table('barang');
        $totalRecords = $barang->count();

        if ($namaFilter) {
            $barang->where('nama_barang', 'like', '%' . $namaFilter . '%');
        }

        if ($barangNoBarangFilter) {
            $barang->where('no_barang', 'like', '%' . $barangNoBarangFilter . '%');
        }

        if ($barangKategoriBarangFilter) {
            $barang->where('kategori_barang', $barangKategoriBarangFilter);
        }

        if ($barangTipePersediaanFilter) {
            $barang->where('tipe_persediaan', $barangTipePersediaanFilter);
        }

        if ($barangTipeBarangFilter) {
            $barang->where('tipe_barang', $barangTipeBarangFilter);
        }

        if ($barangDihentikanFilter  !== null && $barangDihentikanFilter !== '') {
            $barang->where('dihentikan', $barangDihentikanFilter);
        }

        $totalRecordsWithFilter = $barang->count();

        if($columnName != 'checkbox'){
            $barang->orderBy($columnName, $columnSortOrder);
        }

        $records = $barang         
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="barang_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"                => $checkbox,
                "no"                      => $start + $key + 1,
                "id"                      => $record->id,
                "no_barang"               => $record->sub_barang_check == 0 ? '<strong>' . $record->no_barang . '</strong>' : str_repeat('&nbsp;', 3) . $record->no_barang,
                "nama_barang"             => $record->sub_barang_check == 0 ? '<strong>' . $record->nama_barang . '</strong>' : $record->nama_barang,
                'deskripsi_1'             => $record->sub_barang_check == 0 ? '<strong>' . $record->deskripsi_1 . '</strong>' : $record->deskripsi_1,
                'deskripsi_2'             => $record->sub_barang_check == 0 ? '<strong>' . $record->deskripsi_2 . '</strong>' : $record->deskripsi_2,
                'kuantitas_saldo_awal'    => $record->sub_barang_check == 0 ? '<strong>' . $record->kuantitas_saldo_awal . '</strong>' : $record->kuantitas_saldo_awal,
                'satuan'                  => $record->sub_barang_check == 0 ? '<strong>' . $record->satuan . '</strong>' : $record->satuan,
                'biaya_satuan_saldo_awal' => 'Rp ' . number_format((float) $record->biaya_satuan_saldo_awal, 0, ',', '.'),
                'tipe_barang'             => $record->sub_barang_check == 0 ? '<strong>' . $record->tipe_barang . '</strong>' : $record->tipe_barang,
                'kategori_barang'         => $record->sub_barang_check == 0 ? '<strong>' . $record->kategori_barang . '</strong>' : $record->kategori_barang,
                'tipe_persediaan'         => $record->sub_barang_check == 0 ? '<strong>' . $record->tipe_persediaan . '</strong>' : $record->tipe_persediaan,
            ];
        }
        
        return response()->json([
            "draw"                 => intval($draw),
            "recordsTotal"         => $totalRecords,
            "recordsFiltered"      => $totalRecordsWithFilter,
            "data"                 => $data_arr
        ])->header('Content-Type', 'application/json');        
    }
}
