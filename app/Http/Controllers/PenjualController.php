<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use App\Models\Penjual;
use Illuminate\Support\Facades\DB;

class PenjualController extends Controller
{

    public function penjualList()
    {
        return view('penjual.listpenjual');
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            foreach ($ids as $id) {
                $penjual = Penjual::find($id);
                Dokumen::destroy($penjual->dokumen);
                $penjual->delete();
            }
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('penjual/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getPenjual(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter         = $request->get('nama_depan_penjual');
        $penjualDihentikanFilter  = $request->get('dihentikan');
        
        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $penjual =  DB::table('penjual');
        $totalRecords = $penjual->count();

        if ($namaFilter) {
            $penjual->where('nama_depan_penjual', 'like', '%' . $namaFilter . '%');
        }

        if ($penjualDihentikanFilter  !== null && $penjualDihentikanFilter !== '') {
            $penjual->where('dihentikan', $penjualDihentikanFilter);
        }

        $totalRecordsWithFilter = $penjual->count();

        if($columnName != 'checkbox'){
            $penjual->orderBy($columnName, $columnSortOrder);
        }

        $records = $penjual
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="penjual_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"              => $checkbox,
                "no"                    => $start + $key + 1,
                "id"                    => $record->id,
                "nama_depan_penjual"    => $record->nama_depan_penjual,
                'nama_belakang_penjual' => $record->nama_belakang_penjual,
                "jabatan"               => $record->jabatan,
                'no_kantor_1_penjual'   => $record->no_kantor_1_penjual,
                'dihentikan'            => $record->dihentikan,
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
