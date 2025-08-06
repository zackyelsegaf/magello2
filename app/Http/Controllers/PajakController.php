<?php

namespace App\Http\Controllers;

use App\Models\Pajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class PajakController extends Controller
{

    public function pajakList()
    {
        return view('pajak.listpajak');
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            Pajak::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('pajak/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getPajak(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama');
        $pajakKodePajakFilter = $request->get('kode');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $pajak =  DB::table('pajak');
        $totalRecords = $pajak->count();

        if ($namaFilter) {
            $pajak->where('nama', 'like', '%' . $namaFilter . '%');
        }

        if ($pajakKodePajakFilter) {
            $pajak->where('kode', 'like', '%' . $pajakKodePajakFilter . '%');
        }

        $totalRecordsWithFilter = $pajak->count();

        if($columnName != 'checkbox'){
            $pajak->orderBy($columnName, $columnSortOrder);
        }

        $records = $pajak
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="pajak_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"         => $checkbox,
                "no"               => $start + $key + 1,
                "id"               => $record->id,
                "nama"             => $record->nama,
                "kode"             => $record->kode,
                "deskripsi"        => $record->deskripsi,
                "nilai_persentase" => $record->nilai_persentase,
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
