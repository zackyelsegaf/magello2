<?php

namespace App\Http\Controllers\Marketing;

use App\Models\Cluster;
use App\Models\Prospek;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ProspekController extends Controller
{
    public function ProspekList()
    {
        $cluster = Cluster::all('nama_cluster');
        return view('marketing.prospek.prospek', compact('cluster'));
    }

    public function ProspekAddNew()
    {
        return view('marketing.prospek.prospekaddnew');
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            Prospek::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('klusterperumahan/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getProspek(Request $request) {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama');
        $clusterFilter      = $request->get('cluster');
        $tanggalFilter      = $request->get('filter_tanggal');
        $tanggalAwalFilter  = $request->get('tanggal_awal');
        $tanggalAkhirFilter = $request->get('tanggal_akhir');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $prospek =  DB::table('prospek');
        $totalRecords = $prospek->count();

        if ($namaFilter) {
            $prospek->where('nama', 'like', '%' . $namaFilter . '%');
        }
        if ($clusterFilter) {
            $prospek->where('cluster', 'like', '%' . $clusterFilter . '%');
        }


        $totalRecordsWithFilter = $prospek->count();

        $records = $prospek
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();

        if($tanggalFilter && $tanggalAwalFilter && $tanggalAkhirFilter){
            $tanggalAwal = Carbon::parse($tanggalAwalFilter);
            $tanggalAkhir = Carbon::parse($tanggalAkhirFilter);

            $records = $records->filter(function ($prospek) use ($tanggalAwal, $tanggalAkhir) {
                $tanggal = Carbon::parse($prospek->created_at);
                return $tanggal->between($tanggalAwal, $tanggalAkhir);
            });
        }

        $data_arr = [];
        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="prospek_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"       => $checkbox,
                "no"             => $start + $key + 1,
                "id"             => $record->id,
                "calon_kustomer" => $record->nama,
                'marketing'      => $record->ditugaskan_ke,
                "status"         => $record->status,
                'sumber'         => $record->sumber_prospek,
                'klaster'        => $record->cluster,
                'dibuat_pada'    => date('d/m/Y', strtotime($record->created_at)),
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
