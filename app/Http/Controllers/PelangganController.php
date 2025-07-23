<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PelangganController extends Controller
{

    public function pelangganList(Request $request)
    {
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $tipe_pelanggan = DB::table('tipe_pelanggan')->orderBy('nama', 'asc')->get();
        return view('pelanggan.listpelanggan', compact('mata_uang', 'tipe_pelanggan'));
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            Pelanggan::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('pelanggan/list/page');    

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getPelanggan(Request $request)
    {
        $draw               = $request->get('draw');
        $start              = $request->get("start");
        $rowPerPage         = $request->get("length");
        $columnIndex_arr    = $request->get('order');
        $columnName_arr     = $request->get('columns');
        $order_arr          = $request->get('order');
        $namaFilter         = $request->get('nama_pelanggan');
        $pelangganIdFilter  = $request->get('kode_pelanggan');
        $pelangganMataUangFilter  = $request->get('mata_uang_id');
        $pelangganTipePelangganFilter  = $request->get('tipe_pelanggan_id');
        $pelangganDihentikanFilter  = $request->get('dihentikan');

        $columnIndex     = $columnIndex_arr[0]['column'];
        $columnName      = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];

        $query = DB::table('pelanggan')
            ->select([
                "pelanggan.id",
                "kode_pelanggan",
                "pelanggan.nama",
                'alamat_1',
                'alamat_2',
                'kontak',
                'no_telp',
                DB::raw('mata_uang.nama as mata_uang_pelanggan'),
                DB::raw('tipe_pelanggan.nama as tipe_pelanggan'),
                'pelanggan.dihentikan',
            ])
            ->join('mata_uang', 'mata_uang.id', '=', 'pelanggan.mata_uang_id', 'left')
            ->join('tipe_pelanggan', 'tipe_pelanggan.id', '=', 'pelanggan.tipe_pelanggan_id', 'left');

        $totalRecords = $query->count();

        if ($namaFilter) {
            $query->where('pelanggan.nama', 'like', '%' . $namaFilter . '%');
        }

        if ($pelangganIdFilter) {
            $query->where('kode_pelanggan', 'like', '%' . $pelangganIdFilter . '%');
        }

        if ($pelangganMataUangFilter) {
            $query->where('mata_uang_id', $pelangganMataUangFilter);
        }

        if ($pelangganTipePelangganFilter) {
            $query->where('tipe_pelanggan_id', $pelangganTipePelangganFilter);
        }

        if ($pelangganDihentikanFilter  !== null && $pelangganDihentikanFilter !== '') {
            $query->where('dihentikan', $pelangganDihentikanFilter);
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
            $checkbox = '<input type="checkbox" class="pelanggan_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"       => $checkbox,
                "no"             => $start + $key + 1,
                "id"             => $record->id,
                "kode_pelanggan" => $record->kode_pelanggan,
                "nama"           => $record->nama,
                'alamat_1'       => $record->alamat_1,
                'alamat_2'       => $record->alamat_2,
                'kontak'         => $record->kontak,
                'no_telp'        => $record->no_telp,
                'mata_uang_pelanggan' => $record->mata_uang_pelanggan,
                'tipe_pelanggan' => $record->tipe_pelanggan,
                'dihentikan'     => $record->dihentikan,
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
