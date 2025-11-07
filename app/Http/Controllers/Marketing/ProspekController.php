<?php

namespace App\Http\Controllers\Marketing;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ProspekController extends Controller
{
    // public function ProspekList()
    // {
    //     $cluster = DB::table('cluster')->get();
    //     $rap_rab = DB::table('rap_rab')->get();
    //     return view('marketing.prospek.prospek', compact('cluster', 'rap_rab'));
    // }

    public function ProspekAddNew()
    {
        return view('marketing.prospek.prospekaddnew');
    }

    public function getProspek(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length          = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $kavlingNamaByClusterFilter = $request->get('cluster_id');
        $columnIndex     = $columnIndex_arr[0]['column'];
        $columnName      = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];

        $query = DB::table('kapling')
            ->leftJoin('cluster','cluster.id','=','kapling.cluster_id')
            ->select('kapling.*','cluster.nama_cluster');

        if ($kavlingNamaByClusterFilter) {
            $query->where('kapling.cluster_id', 'like', '%' . $kavlingNamaByClusterFilter . '%');
        }

        $totalRecordsWithFilter = $query->count();
        $totalRecords = DB::table('kapling')->count();

        $records = $query
            ->orderBy($columnName, $columnSortOrder)
            ->offset($start)
            ->limit($length)
            ->get();

        // $tableName  = (new PenerimaanPembelian)->getTable();
        // $cols       = Schema::getColumnListing($tableName);
        // $sortColumn = in_array($columnName, $cols, true) ? $columnName : 'id';
        // $sortDir    = strtolower($columnSortOrder) === 'desc' ? 'desc' : 'asc';

        // $records = $penerimaan->orderBy($sortColumn, $sortDir)->offset($start)->limit($length)->get();

        $data_arr = [];

        foreach ($records as $key => $record) {

            $checkbox = '<input type="checkbox" class="kavling_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"                  => $checkbox,
                "no"                        => $start + $key + 1,
                "id"                        => $record->id,
                "cluster_id"                => $record->nama_cluster,
                "rap_rab_id"                => $record->rap_rab_id,
                "tipe_model"                => $record->tipe_model,
                "blok_kapling"              => $record->blok_kapling,
                "nomor_unit_kapling"        => $record->nomor_unit_kapling,
                "jumlah_lantai"             => $record->jumlah_lantai,
                "luas_tanah"                => $record->luas_tanah,
                "luas_bangunan"             => $record->luas_bangunan,
                "harga_kapling"             => $record->harga_kapling,
                "spesifikasi"               => $record->spesifikasi,
                "status_penjualan"          => $record->status_penjualan,
                "status_pembangunan"        => $record->status_pembangunan,
            ];
        }

        return response()->json([
            "draw"            => intval($draw),
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecordsWithFilter,
            "data"            => $data_arr
        ])->header('Content-Type', 'application/json');
    }

}
