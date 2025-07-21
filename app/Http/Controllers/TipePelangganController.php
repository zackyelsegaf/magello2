<?php

namespace App\Http\Controllers;

use App\Models\TipePelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class TipePelangganController extends Controller
{

    public function tipePelangganList()
    {
        return view('tipepelanggan.listtipepelanggan');
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids; // Ambil ID dari checkbox
            TipePelanggan::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('tipepelanggan/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getTipePelanggan(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $tipe_pelanggan =  DB::table('tipe_pelanggan');
        $totalRecords = $tipe_pelanggan->count();

        if ($namaFilter) {
            $tipe_pelanggan->where('nama', 'like', '%' . $namaFilter . '%');
        }

        $totalRecordsWithFilter = $tipe_pelanggan->count();

        if($columnName != 'checkbox'){
            $tipe_pelanggan->orderBy($columnName, $columnSortOrder);
        }

        $records = $tipe_pelanggan
            ->skip($start)
            ->take($rowPerPage)
            ->get();

        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="tipe_pelanggan_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"     => $checkbox,
                "no"           => $start + $key + 1,
                "id"           => $record->id,
                "nama"         => $record->nama,
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
