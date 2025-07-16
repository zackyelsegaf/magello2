<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gudang;
use Illuminate\Support\Facades\DB;

class GudangController extends Controller
{
    public function gudangList()
    {
        return view('gudang.listgudang');
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            Gudang::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('gudang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getGudang(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama_gudang');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $gudang =  DB::table('gudang');
        $totalRecords = $gudang->count();

        if ($namaFilter) {
            $gudang->where('nama_gudang', 'like', '%' . $namaFilter . '%');
        }

        $totalRecordsWithFilter = $gudang->count();

        if($columnName != 'checkbox'){
            $gudang = $gudang->orderBy($columnName, $columnSortOrder);
        }

        $records = $gudang
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="gudang_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"              => $checkbox,
                "no"                    => $start + $key + 1,
                "id"                    => $record->id,
                "nama_gudang"           => $record->nama_gudang,
                'deskripsi'             => $record->deskripsi,
                'penanggung_jawab'      => $record->penanggung_jawab,
                'alamat_gudang_1'       => $record->alamat_gudang_1,
                "alamat_gudang_2"       => $record->alamat_gudang_2,
                'alamat_gudang_3'       => $record->alamat_gudang_3,
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
