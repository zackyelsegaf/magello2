<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasok;
use App\Http\Controllers\DependentDropdownController;
use App\Models\Dokumen;
use Illuminate\Support\Facades\DB;

class PemasokController extends Controller
{
    public function pemasokList()
    {
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        return view('pemasok.listpemasok', compact('mata_uang'));
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            foreach ($ids as $id) {
                $pemasok = Pemasok::find($id);
                Dokumen::destroy($pemasok->dokumen);
                $pemasok->delete();
            }
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('pemasok/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getPemasok(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter         = $request->get('nama');
        $pelangganIdFilter  = $request->get('pemasok_id');
        $pelangganMataUangFilter  = $request->get('mata_uang');
        $pelangganDihentikanFilter  = $request->get('dihentikan');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $pemasok =  DB::table('pemasok')
            ->select([
                "pemasok.id",
                "pemasok_id",
                "pemasok.nama",
                'alamat_1',
                'alamat_2',
                'kontak',
                'no_telp',
                DB::raw('mata_uang.nama as mata_uang'),
                'pemasok.dihentikan',
            ])
            ->join('mata_uang', 'mata_uang.id', '=', 'pemasok.mata_uang_id', 'left');
        $totalRecords = $pemasok->count();

        if ($namaFilter) {
            $pemasok->where('pemasok.nama', 'like', '%' . $namaFilter . '%');
        }

        if ($pelangganIdFilter) {
            $pemasok->where('pemasok_id', 'like', '%' . $pelangganIdFilter . '%');
        }

        if ($pelangganMataUangFilter) {
            $pemasok->where('mata_uang_id', $pelangganMataUangFilter);
        }

        if ($pelangganDihentikanFilter  !== null && $pelangganDihentikanFilter !== '') {
            $pemasok->where('dihentikan', $pelangganDihentikanFilter);
        }

        $totalRecordsWithFilter = $pemasok->count();

        if($columnName != 'checkbox'){
            $pemasok->orderBy($columnName, $columnSortOrder);
        }

        $records = $pemasok
            ->skip($start)
            ->take($rowPerPage)
            ->get();

        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="pemasok_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"     => $checkbox,
                "no"           => $start + $key + 1,
                "id"           => $record->id,
                "pemasok_id"   => $record->pemasok_id,
                "nama"         => $record->nama,
                'alamat_1'     => $record->alamat_1,
                'alamat_2'     => $record->alamat_2,
                'kontak'       => $record->kontak,
                'no_telp'      => $record->no_telp,
                'mata_uang'    => $record->mata_uang,
                'dihentikan'   => $record->dihentikan,
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
