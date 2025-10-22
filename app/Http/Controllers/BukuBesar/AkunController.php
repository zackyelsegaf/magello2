<?php

namespace App\Http\Controllers\BukuBesar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\DB;

class AkunController extends Controller
{
    public function akunList()
    {
        $tipe_akun = DB::table('tipe_akun')->get();
        return view('bukubesar.akun.listakun', compact('tipe_akun'));
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            Akun::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('akun/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getAKun(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama_akun');
        $akunIdFilter  = $request->get('no_akun');
        $akunTipeAkunFilter  = $request->get('tipe_akun');
        $akunDihentikanFilter  = $request->get('dihentikan');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $Akun = Akun::with(['mataUang','tipe']);
        $totalRecords = Akun::count();

        if ($namaFilter) {
            $Akun->where('nama_akun_indonesia', 'like', '%' . $namaFilter . '%');
            $Akun->orWhere('nama_akun_inggris', 'like', '%' . $namaFilter . '%');
        }

        if ($akunIdFilter) {
            $Akun->where('no_akun', 'like', '%' . $akunIdFilter . '%');
        }

        if ($akunTipeAkunFilter) {
            $Akun->where('tipe_id', $akunTipeAkunFilter);
        }

        if ($akunDihentikanFilter  !== null && $akunDihentikanFilter !== '') {
            $Akun->where('dihentikan', $akunDihentikanFilter);
        }

        $totalRecordsWithFilter = $Akun->count();

        if($columnName != 'checkbox'){
            $Akun->orderBy($columnName, $columnSortOrder);
        }

        $records = $Akun
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();

        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="akun_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"              => $checkbox,
                "no"                    => $start + $key + 1,
                "id"                    => $record->id,
                "no_akun"               => !isset($record->parent_id) ? '<strong>' . $record->no_akun . '</strong>' : str_repeat('&nbsp;', 3) . $record->no_akun,
                "nama_akun_indonesia"   => !isset($record->parent_id) ? '<strong>' . $record->nama_akun_indonesia . '</strong>' : $record->nama_akun_indonesia,
                "tipe_id"               => $record->tipe_id,
                "tipe_akun"             => $record->tipe?->nama,
                "mata_uang"             => !isset($record->parent_id) ? '<strong>' . $record->mata_uang . '</strong>' : $record->mata_uang,
                "saldo_akun"            => '<strong>' . "Rp " . number_format($record->saldo_akun, 0, ',', '.') . "</strong>",
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
