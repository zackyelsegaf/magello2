<?php

namespace App\Http\Controllers\Aktiva;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Penyusutan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class PenyusutanController extends Controller
{
    public function penyusutanList()
    {
        return view('aktiva.penyusutan.listpenyusutan');
    }

    public function PenyusutanAddNew()
    {
        return view('aktiva.penyusutan.penyusutanaddnew');
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_penyusutan'      => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $penyusutan = Penyusutan::findOrFail($id);
            $penyusutan->nama_penyusutan = $request->nama_penyusutan;

            $penyusutan->save();

            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('penyusutan/list/page');    

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record failed :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $penyusutan = Penyusutan::findOrFail($id);
        if (!$penyusutan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('aktiva.penyusutan.penyusutanedit', compact('penyusutan'));
    }


    public function saveRecordPenyusutan(Request $request){
        $validated = $request->validate([
            'nama_penyusutan'      => 'nullable|string|max:255',
        ]);

        //debug
        // DB::enableQueryLog();
        // MataUang::create($request->all());
        // dd(DB::getQueryLog());

        DB::beginTransaction();
        try {
            $penyusutan = new Penyusutan([
                'nama_penyusutan' => $request->nama_penyusutan,
            ]);
            $penyusutan->save();
            
            DB::commit();
            sweetalert()->success('Create new Penyusutan successfully :)');
            return redirect()->route('penyusutan/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal :)');
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            Penyusutan::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('penyusutan/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getPenyusutan(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaPenyusutanFilter      = $request->get('nama_penyusutan'); // Filter by nama_penyusutan

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $penyusutan =  DB::table('penyusutan');
        $totalRecords = $penyusutan->count();

        if ($namaPenyusutanFilter) {
            $penyusutan->where('nama_penyusutan', 'like', '%' . $namaPenyusutanFilter . '%');
        }

        $totalRecordsWithFilter = $penyusutan->count();

        // $records = $penyusutan
        //     ->orderBy($columnName, $columnSortOrder)
            //->skip($start)
           // ->take($length)
            //->get();

        $tableName  = (new Penyusutan)->getTable();
        $cols       = Schema::getColumnListing($tableName);
        $sortColumn = in_array($columnName, $cols, true) ? $columnName : 'id';
        $sortDir    = strtolower($columnSortOrder) === 'desc' ? 'desc' : 'asc';

        $records = $penyusutan->orderBy($sortColumn, $sortDir)->skip($start)->take($length)->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="penyusutan_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"         => $checkbox,
                "no"               => $start + $key + 1,
                "id"               => $record->id,
                "nama_penyusutan"      => $record->nama_penyusutan,
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
