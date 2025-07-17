<?php

namespace App\Http\Controllers;

use App\Models\MataUang;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Http\Request;

class MataUangController extends Controller
{
    public function matauangList()
    {
        return view('matauang.listmatauang');
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids; // Ambil ID dari checkbox
            MataUang::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil Dihapus');
            return redirect()->route('matauang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Hapus Data Gagal');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
        // $ids = $request->ids; // Ambil ID dari checkbox
        // if ($ids) {
        //     MataUang::whereIn('id', $ids)->delete();
        //     flash()->success('Updated record successfully :)');
        //     return response()->json(['success' => true]);
        // } else {
        //     return response()->json(['error' => 'Tidak ada data yang dipilih!'], 400);
        // }
    }

    /** Get Mata Uang Data */
    public function getMataUang(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama'); // dari input form pencarian

        $columnIndex     = $columnIndex_arr[0]['column'];
        $columnName      = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];

        $query = DB::table('mata_uang');
        $totalRecords = $query->count();

        if ($namaFilter) {
            $query->where(function ($q) use ($namaFilter) {
                $q->where('nama', 'like', '%' . $namaFilter . '%')
                ->orWhere('nilai_tukar', 'like', '%' . $namaFilter . '%');
            });
        }

        $totalRecordsWithFilter = $query->count();

        if($columnName != 'checkbox'){
            $query->orderBy($columnName, $columnSortOrder);
        }

        $records = $query
            ->skip($start)
            ->take($rowPerPage)
            ->get();

        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="matauang_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"     => $checkbox,
                "no"           => $start + $key + 1,
                "id"           => $record->id,
                "nama"         => $record->nama,
                "nilai_tukar"  => 'Rp ' . number_format($record->nilai_tukar, 0, ',', '.'),
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
