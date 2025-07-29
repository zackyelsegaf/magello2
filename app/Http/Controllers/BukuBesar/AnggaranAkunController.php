<?php

namespace App\Http\Controllers\BukuBesar;

use App\Http\Controllers\Controller;
use App\Models\AnggaranAkun;
use App\Models\Dokumen;
use App\Models\TipeAkun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggaranAkunController extends Controller
{
    public function anggaranList() {
        $tipe_akun = TipeAkun::all();
        return view('bukubesar.anggaranakun.index', compact('tipe_akun'));
    }

    public function delete(Request $request) {
        try {
            $ids = $request->ids;
            foreach ($ids as $id) {
                $anggaran = AnggaranAkun::find($id);
                Dokumen::destroy($anggaran->dokumen);
                $anggaran->delete();
            }
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('anggaranakun/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getAnggaran(Request $request) {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $noAkunFilter    = $request->get('no_akun');
        $namaAkunFilter    = $request->get('nama_akun');
        $tipeAkunFilter    = $request->get('tipe_akun');
        $tahunFilter    = $request->get('tahun');
        $semuaTahunFilter    = $request->get('semua_tahun');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $Anggaran =  DB::table('anggaran_akuns')
            ->select([
                'anggaran_akuns.id', 
                'no_akun', 
                'nama_akun_indonesia', 
                'tahun', 
                'periode_1',
                'periode_2',
                'periode_3',
                'periode_4',
                'periode_5',
                'periode_6',
                'periode_7',
                'periode_8',
                'periode_9',
                'periode_10',
                'periode_11',
                'periode_12',
            ])
            ->join('akun', 'akun.id', '=', 'anggaran_akuns.akun_id', 'left');

        $totalRecords = $Anggaran->count();

        if ($noAkunFilter) {
            $Anggaran->where('no_akun', 'like', '%' . $noAkunFilter . '%');
        }
        if ($namaAkunFilter) {
            $Anggaran->where('nama_akun_indonesia', 'like', '%' . $namaAkunFilter . '%');
        }
        if ($tipeAkunFilter) {
            $Anggaran->where('akun.tipe_id', '=', $tipeAkunFilter);
        }
        if ($tahunFilter && $semuaTahunFilter == false) {
            $Anggaran->where('tahun', 'like', '%' . $tahunFilter . '%');
        }

        $totalRecordsWithFilter = $Anggaran->count();

        if($columnName != 'checkbox'){
            $Anggaran->orderBy($columnName, $columnSortOrder);
        }

        $records = $Anggaran
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="anggaran_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"   => $checkbox,
                "no"         => $start + $key + 1,
                "id"         => $record->id,
                'no_akun'    => $record->no_akun,
                'nama_akun'  => $record->nama_akun_indonesia,
                'tahun'      => $record->tahun,
                'periode_1'  => number_format($record->periode_1, 0, ',', '.'),
                'periode_2'  => number_format($record->periode_2, 0, ',', '.'),
                'periode_3'  => number_format($record->periode_3, 0, ',', '.'),
                'periode_4'  => number_format($record->periode_4, 0, ',', '.'),
                'periode_5'  => number_format($record->periode_5, 0, ',', '.'),
                'periode_6'  => number_format($record->periode_6, 0, ',', '.'),
                'periode_7'  => number_format($record->periode_7, 0, ',', '.'),
                'periode_8'  => number_format($record->periode_8, 0, ',', '.'),
                'periode_9'  => number_format($record->periode_9, 0, ',', '.'),
                'periode_10' => number_format($record->periode_10, 0, ',', '.'),
                'periode_11' => number_format($record->periode_11, 0, ',', '.'),
                'periode_12' => number_format($record->periode_12, 0, ',', '.'),
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
