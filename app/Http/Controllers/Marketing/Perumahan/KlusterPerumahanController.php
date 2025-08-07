<?php

namespace App\Http\Controllers\Marketing\Perumahan;

use App\Models\Cluster;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class KlusterPerumahanController extends Controller
{
    public function KlusterPerumahanList() {
        return view('marketing.perumahan.klusterperumahan.klusterperumahan');
    }

    public function KlusterPerumahanAddNew()
    {
        return view('marketing.perumahan.klusterperumahan.klusterperumahanaddnew');
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            Cluster::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('klusterperumahan/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function dataCluster(Request $request) {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama_cluster');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $cluster =  DB::table('cluster');
        $totalRecords = $cluster->count();

        if ($namaFilter) {
            $cluster->where('nama_cluster', 'like', '%' . $namaFilter . '%');
        }

        $totalRecordsWithFilter = $cluster->count();

        $records = $cluster
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="cluster_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"     => $checkbox,
                "no"           => $start + $key + 1,
                "id"           => $record->id,
                "nama_cluster" => $record->nama_cluster,
                'kota'         => $record->kota,
                "no_hp"        => $record->no_hp,
                'luas_tanah'   => $record->luas_tanah,
                'total_unit'   => $record->total_unit,
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
