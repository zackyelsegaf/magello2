<?php

namespace App\Http\Controllers\BukuBesar;

use App\Http\Controllers\Controller;
use App\Models\BukuBesar\DetailPembayaranLainnya;
use App\Models\BukuBesar\PembayaranLainnya;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranLainnyaController extends Controller
{
    public function pembayaranList() {
        return view('bukubesar.pembayaranlainnya.index');
    }

    public function delete(Request $request) {
        try {
            $ids = $request->ids;
            DetailPembayaranLainnya::whereIn('pembayaran_id', $ids)->delete();
            foreach ($ids as $id) {
                $pembayaran = PembayaranLainnya::find($id);
                Dokumen::destroy($pembayaran->dokumen);
                $pembayaran->delete();
            }
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('pembayaranlainnya/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getPembayaran(Request $request) {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $deskripsiFilter    = $request->get('deskripsi');
        $pembayaranIdFilter = $request->get('no_pembayaran');
        $tanggalAwalFilter  = $request->get('tanggal_awal');
        $tanggalAkhirFilter = $request->get('tanggal_akhir');
        $catatanPemeriksaan = $request->get('catatan_pemeriksaan');
        $disetujuiFilter    = $request->get('disetujui');
        $tindakLanjutFilter = $request->get('tindak_lanjut');
        $urgentFilter       = $request->get('urgent');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $Pembayaran =  DB::table('pembayaran_lainnya')
            ->select([
                'pembayaran_lainnya.id', 
                'no_pembayaran', 
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
            ->join('users', 'users.id', '=', 'pembayaran_lainnya.user_id', 'left');

        $totalRecords = $Pembayaran->count();

        if ($deskripsiFilter) {
            $Pembayaran->where('deskripsi', 'like', '%' . $deskripsiFilter . '%');
        }

        if ($pembayaranIdFilter) {
            $Pembayaran->where('no_pembayaran', 'like', '%' . $pembayaranIdFilter . '%');
        }

        if ($tanggalAwalFilter && $tanggalAkhirFilter) {
            $Pembayaran->whereBetween('tanggal', [$tanggalAwalFilter, $tanggalAkhirFilter]);
        }

        if ($catatanPemeriksaan && count($catatanPemeriksaan) === 1) {
            $Pembayaran->where('catatan_pemeriksaan', $catatanPemeriksaan[0] == 1 ? '!=' : '=', null);
        }
        if ($tindakLanjutFilter && count($tindakLanjutFilter) === 1) {
            $Pembayaran->where('tindak_lanjut', $tindakLanjutFilter[0] == 1 ? '!=' : '=', null);
        }
        if ($disetujuiFilter) {
            $Pembayaran->whereIn('disetujui', $disetujuiFilter);
        }
        if ($urgentFilter) {
            $Pembayaran->whereIn('urgent', $urgentFilter);
        }

        $totalRecordsWithFilter = $Pembayaran->count();

        if($columnName != 'checkbox'){
            $Pembayaran->orderBy($columnName, $columnSortOrder);
        }

        $records = $Pembayaran
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="pembayaran_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"            => $checkbox,
                "no"                  => $start + $key + 1,
                "id"                  => $record->id,
                "no_pembayaran"       => $record->no_pembayaran,
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
