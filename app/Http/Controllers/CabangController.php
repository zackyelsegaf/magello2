<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CabangController extends Controller
{
    public function cabangList()
    {
        return view('cabang.listcabang');
    }

    public function CabangAddNew()
    {
        $gudang = DB::table('gudang')->get();
        $users = DB::table('users')->get();
        return view('cabang.cabangaddnew', compact('gudang', 'users'));
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'cabang_id'      => 'nullable|string|max:255',
            'nama_cabang'    => 'nullable|string|max:255',
            'kode_transaksi' => 'nullable|string|max:255',
            'gudang'         => 'nullable|array',
            'pengguna'       => 'nullable|array',
        ]);

        DB::beginTransaction();
        try {
            $cabang = Cabang::findOrFail($id);

            // Update nilai biasa
            $cabang->cabang_id = $request->cabang_id;
            $cabang->nama_cabang = $request->nama_cabang;
            $cabang->kode_transaksi = $request->kode_transaksi;

            // Simpan array sebagai JSON
            $cabang->gudang = json_encode($request->gudang);
            $cabang->pengguna = json_encode($request->pengguna);

            $cabang->save();

            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('cabang/list/page');    

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record failed :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        $gudang = DB::table('gudang')->get();
        $users = DB::table('users')->get();
        $cabang = Cabang::findOrFail($id);

        // Decode JSON ke array agar bisa digunakan di view (selected)
        $cabang->gudang = json_decode($cabang->gudang, true);
        $cabang->pengguna = json_decode($cabang->pengguna, true);

        return view('cabang.cabangedit', compact('cabang', 'users', 'gudang'));
    }


    public function saveRecordCabang(Request $request){
        $validated = $request->validate([
            'cabang_id'      => 'nullable|string|max:255',
            'nama_cabang'    => 'nullable|string|max:255',
            'kode_transaksi' => 'nullable|string|max:255',
            'gudang'         => 'nullable|array',
            'pengguna'       => 'nullable|array',
        ]);

        //debug
        // DB::enableQueryLog();
        // MataUang::create($request->all());
        // dd(DB::getQueryLog());

        DB::beginTransaction();
        try {
            $cabang = new Cabang([
                'cabang_id'      => $request->cabang_id,
                'nama_cabang'    => $request->nama_cabang,
                'kode_transaksi' => $request->kode_transaksi,
                'gudang'         => json_encode($request->gudang),   // Simpan sebagai JSON string
                'pengguna'       => json_encode($request->pengguna), // Simpan sebagai JSON string
            ]);
            $cabang->save();
            
            DB::commit();
            sweetalert()->success('Create new Cabang successfully :)');
            return redirect()->route('cabang/list/page');    
            
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
            Cabang::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('cabang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getCabang(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaCabangFilter      = $request->get('nama_cabang');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $cabang =  DB::table('cabang');
        $totalRecords = $cabang->count();

        if ($namaCabangFilter) {
            $cabang->where('nama_cabang', 'like', '%' . $namaCabangFilter . '%');
        }

        $totalRecordsWithFilter = $cabang->count();

        $records = $cabang
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="cabang_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"         => $checkbox,
                "no"               => $start + $key + 1,
                "id"               => $record->id,
                "cabang_id"        => $record->cabang_id,
                "nama_cabang"      => $record->nama_cabang,
                "kode_transaksi"   => $record->kode_transaksi,
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
