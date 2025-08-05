<?php

namespace App\Http\Controllers\BukuBesar;

use App\Http\Controllers\Controller;
use App\Models\BukuBesar\Jurnal;
use App\Models\BukuBesar\JurnalDetail;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurnalController extends Controller
{
    public function jurnalList() {
        return view('bukubesar.jurnal.index');
    }

    public function delete(Request $request) {
        try {
            $ids = $request->ids;
            JurnalDetail::whereIn('jurnal_id', $ids)->delete();
            foreach ($ids as $id) {
                $jurnal = Jurnal::find($id);
                Dokumen::destroy($jurnal->dokumen);
                $jurnal->delete();
            }
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('jurnal/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getJurnal(Request $request) {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $deskripsiFilter    = $request->get('deskripsi');
        $jurnalIdFilter     = $request->get('no_jurnal');
        $tanggalAwalFilter  = $request->get('tanggal_awal');
        $tanggalAkhirFilter = $request->get('tanggal_akhir');
        $tipeJurnalFilter   = $request->get('tipe');
        $catatanPemeriksaan = $request->get('catatan_pemeriksaan');
        $disetujuiFilter    = $request->get('disetujui');
        $tindakLanjutFilter = $request->get('tindak_lanjut');
        $urgentFilter       = $request->get('urgent');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $Jurnal =  DB::table('jurnal')
            ->select([
                'jurnal.id', 
                'no_jurnal', 
                'deskripsi', 
                'sumber', 
                'tanggal', 
                'nilai', 
                DB::raw('users.name as user'), 
                'cabang',
                'no_persetujuan',
                DB::raw('case when catatan_pemeriksaan is null then 0 else 1 end as catatan_pemeriksaan'),
                DB::raw('case when tindak_lanjut is null then 0 else 1 end as tindak_lanjut'),
                'disetujui',
                'urgent',
            ])
            ->join('users', 'users.id', '=', 'jurnal.user_id', 'left');

        $totalRecords = $Jurnal->count();

        if ($deskripsiFilter) {
            $Jurnal->where('deskripsi', 'like', '%' . $deskripsiFilter . '%');
        }

        if ($jurnalIdFilter) {
            $Jurnal->where('no_jurnal', 'like', '%' . $jurnalIdFilter . '%');
        }

        if ($tanggalAwalFilter && $tanggalAkhirFilter) {
            $Jurnal->whereBetween('tanggal', [$tanggalAwalFilter, $tanggalAkhirFilter]);
        }

        if ($tipeJurnalFilter) {
            $Jurnal->whereIn('sumber', $tipeJurnalFilter);
        }
        if ($catatanPemeriksaan && count($catatanPemeriksaan) === 1) {
            $Jurnal->where('catatan_pemeriksaan', $catatanPemeriksaan[0] == 1 ? '!=' : '=', null);
        }
        if ($tindakLanjutFilter && count($tindakLanjutFilter) === 1) {
            $Jurnal->where('tindak_lanjut', $tindakLanjutFilter[0] == 1 ? '!=' : '=', null);
        }
        if ($disetujuiFilter) {
            $Jurnal->whereIn('disetujui', $disetujuiFilter);
        }
        if ($urgentFilter) {
            $Jurnal->whereIn('urgent', $urgentFilter);
        }

        $totalRecordsWithFilter = $Jurnal->count();

        if($columnName != 'checkbox'){
            $Jurnal->orderBy($columnName, $columnSortOrder);
        }

        $records = $Jurnal
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="jurnal_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"            => $checkbox,
                "no"                  => $start + $key + 1,
                "id"                  => $record->id,
                "no_jurnal"           => $record->no_jurnal,
                'sumber'              => $record->sumber,
                'tanggal'             => $record->tanggal,
                'deskripsi'           => $record->deskripsi,
                'nilai'               => 'Rp ' . number_format($record->nilai, 0, ',', '.'),
                'user'                => $record->user,
                'cabang'              => $record->cabang,
                'no_persetujuan'      => $record->no_persetujuan,
                'catatan_pemeriksaan' => $record->catatan_pemeriksaan,
                'tindak_lanjut'       => $record->tindak_lanjut,
                'disetujui'           => $record->disetujui,
                'urgensi'             => $record->urgent,
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
