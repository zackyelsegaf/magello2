<?php

namespace App\Http\Controllers;

use App\Models\StatusPemasok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class StatusPemasokController extends Controller
{
    public function statusPemasokList()
    {
        return view('statuspemasok.liststatuspemasok');
    }

    public function StatusPemasokAddNew()
    {
        return view('statuspemasok.statuspemasokaddnew');
    }

    public function saveRecordStatusPemasok(Request $request){
        $request->validate([
            'nama'          => 'required|string|max:255',
        ]);

        //debug
        // DB::enableQueryLog();
        // MataUang::create($request->all());
        // dd(DB::getQueryLog());

        DB::beginTransaction();
        try {
            $statusPemasok = new StatusPemasok;
            $statusPemasok->nama         = $request->nama;
            $statusPemasok->save();
            
            DB::commit();
            sweetalert()->success('Create new Status Pemasok successfully :)');
            return redirect()->route('statuspemasok/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal :)');
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids; // Ambil ID dari checkbox
            StatusPemasok::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('statuspemasok/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $statusPemasok = StatusPemasok::findOrFail($id);
            $statusPemasok->nama = $request->nama;
            $statusPemasok->save();
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('statuspemasok/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $statusPemasok = StatusPemasok::findOrFail($id);
        if (!$statusPemasok) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('statuspemasok.statuspemasokedit', compact('statusPemasok'));
    }

    public function getStatusPemasok(Request $request)
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

        $status_pemasok =  DB::table('status_pemasok');
        $totalRecords = $status_pemasok->count();

        if ($namaFilter) {
            $status_pemasok->where('nama', 'like', '%' . $namaFilter . '%');
        }

        $totalRecordsWithFilter = $status_pemasok->count();

        if($columnName != 'checkbox'){
            $status_pemasok->orderBy($columnName, $columnSortOrder);
        }

        $records = $status_pemasok
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="status_pemasok_checkbox" value="'.$record->id.'">';

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
