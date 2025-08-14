<?php

namespace App\Http\Controllers;

use App\Models\JasaPengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JasaPengirimanController extends Controller
{
    public function jasaPengirimanList()
    {
        return view('jasapengiriman.listjasapengiriman');
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            JasaPengiriman::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('jasapengiriman/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getJasaPengiriman(Request $request)
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

        $jasa_pengiriman =  DB::table('jasa_pengiriman');
        $totalRecords = $jasa_pengiriman->count();

        if ($namaFilter) {
            $jasa_pengiriman->where('nama', 'like', '%' . $namaFilter . '%');
        }

        $totalRecordsWithFilter = $jasa_pengiriman->count();

        if($columnName != 'checkbox'){
            $jasa_pengiriman->orderBy($columnName, $columnSortOrder);
        }

        $records = $jasa_pengiriman
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="jasa_checkbox" value="'.$record->id.'">';

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
