<?php

namespace App\Http\Controllers\Aktiva;

use App\Http\Controllers\Controller;
use App\Models\TipeAktivaTetapPajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;

class TipeAktivaTetapPajakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function TipeAktivaTetapPajakList()
    {
        return view('aktiva.tipeaktivatetappajak.tipeaktivatetappajak');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function TipeAktivaTetapPajakAddNew()
    {
        $penyusutan = DB::table('penyusutan')->get();
        return view('aktiva.tipeaktivatetappajak.tipeaktivatetappajakadd', compact('penyusutan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function saveRecordTipeAktivaTetapPajak(Request $request)
    {
        $rules = [
            'tipe_aktiva_tetap_pajak' => 'required|string|max:255',
            'metode_penyusutan'       => 'required|string|max:255',
            'umur_perkiraan'          => 'nullable|numeric',
            'nilai_penyusutan'        => 'nullable|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            $tipeAktivaTetapPajak = new TipeAktivaTetapPajak($validator->validated());
            $tipeAktivaTetapPajak->save();

            DB::commit();
            sweetalert()->success('Create new Barang & Detail successfully :)');
            return redirect()->route('tipeaktivatetappajak/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function getTipeAktivaTetapPajak(Request $request)
    {
        $draw             = $request->get('draw');
        $start            = $request->get("start");
        $length       = $request->get("length"); // total number of rows per page
        $columnIndex_arr  = $request->get('order');
        $columnName_arr   = $request->get('columns');
        $order_arr        = $request->get('order');
        $namaAktivaFilter = $request->get('tipe_aktiva_tetap_pajak');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $tipeAktivaTetapPajak =  DB::table('tipe_aktiva_tetap_pajaks');
        $totalRecords = $tipeAktivaTetapPajak->count();

        if ($namaAktivaFilter) {
            $tipeAktivaTetapPajak->where('tipe_aktiva_tetap_pajak', 'like', '%' . $namaAktivaFilter . '%');
        }

        $totalRecordsWithFilter = $tipeAktivaTetapPajak->count();

        // $records = $tipeAktivaTetapPajak
        //     ->orderBy($columnName, $columnSortOrder)
            //->skip($start)
           // ->take($length)
            //->get();

        $tableName  = (new TipeAktivaTetapPajak)->getTable();
        $cols       = Schema::getColumnListing($tableName);
        $sortColumn = in_array($columnName, $cols, true) ? $columnName : 'id';
        $sortDir    = strtolower($columnSortOrder) === 'desc' ? 'desc' : 'asc';

        $records = $tipeAktivaTetapPajak->orderBy($sortColumn, $sortDir)->skip($start)->take($length)->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="tipeaktivatetappajak_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"         => $checkbox,
                "no"               => $start + $key + 1,
                "id"               => $record->id,
                "tipe_aktiva_tetap_pajak" => $record->tipe_aktiva_tetap_pajak,
                "metode_penyusutan" => $record->metode_penyusutan,
                "umur_perkiraan" => $record->umur_perkiraan,
                "nilai_penyusutan" => $record->nilai_penyusutan,
            ];
        }
        
        return response()->json([
            "draw"                 => intval($draw),
            "recordsTotal"         => $totalRecords,
            "recordsFiltered"      => $totalRecordsWithFilter,
            "data"                 => $data_arr
        ])->header('Content-Type', 'application/json');        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tipeAktivaTetapPajak = TipeAktivaTetapPajak::findOrFail($id);
        $penyusutan = DB::table('penyusutan')->get();

        return view('aktiva.tipeaktivatetappajak.tipeaktivatetappajakedit', compact('tipeAktivaTetapPajak', 'penyusutan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'tipe_aktiva_tetap_pajak' => 'required|string|max:255',
            'metode_penyusutan'       => 'required|string|max:255',
            'umur_perkiraan'          => 'nullable|numeric',
            'nilai_penyusutan'        => 'nullable|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $tipeAktivaTetapPajak = TipeAktivaTetapPajak::findOrFail($id);

            $tipeAktivaTetapPajak->tipe_aktiva_tetap_pajak  = $request->tipe_aktiva_tetap_pajak;
            $tipeAktivaTetapPajak->metode_penyusutan        = $request->metode_penyusutan;
            $tipeAktivaTetapPajak->umur_perkiraan           = $request->umur_perkiraan;
            $tipeAktivaTetapPajak->nilai_penyusutan         = $request->nilai_penyusutan;

            $tipeAktivaTetapPajak->save();

            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('tipeaktivatetappajak/list/page');    

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record failed :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            TipeAktivaTetapPajak::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('tipeaktivatetappajak/list/page');    

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }
}
