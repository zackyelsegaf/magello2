<?php

namespace App\Http\Controllers\BukuBesar;

use App\Http\Controllers\Controller;
use App\Models\BukuBesar\DetailPenerimaanLainnya;
use App\Models\BukuBesar\PenerimaanLainnya;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaanLainnyaController extends Controller
{
    public function penerimaanList() {
        return view('bukubesar.penerimaanlainnya.index');
    }

    public function delete(Request $request) {
        try {
            $ids = $request->ids;
            DetailPenerimaanLainnya::whereIn('penerimaan_id', $ids)->delete();
            foreach ($ids as $id) {
                $penerimaan = PenerimaanLainnya::find($id);
                Dokumen::destroy($penerimaan->dokumen);
                $penerimaan->delete();
            }
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('penerimaanlainnya/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getPenerimaan(Request $request) {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $deskripsiFilter    = $request->get('deskripsi');
        $penerimaanIdFilter = $request->get('no_penerimaan');
        $tanggalAwalFilter  = $request->get('tanggal_awal');
        $tanggalAkhirFilter = $request->get('tanggal_akhir');
        $catatanPemeriksaan = $request->get('catatan_pemeriksaan');
        $disetujuiFilter    = $request->get('disetujui');
        $tindakLanjutFilter = $request->get('tindak_lanjut');
        $urgentFilter       = $request->get('urgent');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $Penerimaan =  DB::table('penerimaan_lainnya')
            ->select([
                'penerimaan_lainnya.id', 
                'no_penerimaan', 
                'deskripsi',
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
            ->join('users', 'users.id', '=', 'penerimaan_lainnya.user_id', 'left');

        $totalRecords = $Penerimaan->count();

        if ($deskripsiFilter) {
            $Penerimaan->where('deskripsi', 'like', '%' . $deskripsiFilter . '%');
        }

        if ($penerimaanIdFilter) {
            $Penerimaan->where('no_penerimaan', 'like', '%' . $penerimaanIdFilter . '%');
        }

        if ($tanggalAwalFilter && $tanggalAkhirFilter) {
            $Penerimaan->whereBetween('tanggal', [$tanggalAwalFilter, $tanggalAkhirFilter]);
        }

        if ($catatanPemeriksaan && count($catatanPemeriksaan) === 1) {
            $Penerimaan->where('catatan_pemeriksaan', $catatanPemeriksaan[0] == 1 ? '!=' : '=', null);
        }
        if ($tindakLanjutFilter && count($tindakLanjutFilter) === 1) {
            $Penerimaan->where('tindak_lanjut', $tindakLanjutFilter[0] == 1 ? '!=' : '=', null);
        }
        if ($disetujuiFilter) {
            $Penerimaan->whereIn('disetujui', $disetujuiFilter);
        }
        if ($urgentFilter) {
            $Penerimaan->whereIn('urgent', $urgentFilter);
        }

        $totalRecordsWithFilter = $Penerimaan->count();

        if($columnName != 'checkbox'){
            $Penerimaan->orderBy($columnName, $columnSortOrder);
        }

        $records = $Penerimaan
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="penerimaan_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"            => $checkbox,
                "no"                  => $start + $key + 1,
                "id"                  => $record->id,
                "no_penerimaan"       => $record->no_penerimaan,
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
