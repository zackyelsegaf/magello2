<?php

namespace App\Http\Controllers\Aktiva;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipeAktivaTetap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TipeAktivaTetapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function TipeAktivaTetapList()
    {
        return view('aktiva.tipeaktivatetap.tipeaktivatetap');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function TipeAktivaTetapAddNew()
    {
        $penyusutan = DB::table('penyusutan')->get();
        $tipeAktivaTetapPajak = DB::table('tipe_aktiva_tetap_pajaks')->get();
        return view('aktiva.tipeaktivatetap.tipeaktivatetapadd', compact('penyusutan', 'tipeAktivaTetapPajak'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function saveRecordTipeAktivaTetap(Request $request)
    {
        $rules = [
            'tipe_aktiva_tetap' => 'required|string|max:255',
            'tipe_aktiva_tetap_pajak' => 'required|string|max:255',
            'metode_penyusutan' => 'required|string|max:255',
            'umur_perkiraan' => 'nullable|numeric',
            'nilai_penyusutan' => 'nullable|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $tipeAktivaTetap = new TipeAktivaTetap($validator->validated());
            $tipeAktivaTetap->save();

            DB::commit();
            sweetalert()->success('Create new Tipe Aktiva Tetap successfully :)');
            return redirect()->route('tipeaktivatetap/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Create new Tipe Aktiva Tetap failed :)' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function getTipeAktivaTetap(Request $request)
    {
        $draw             = $request->get('draw');
        $start            = $request->get("start");
        $rowPerPage       = $request->get("length"); // total number of rows per page
        $columnIndex_arr  = $request->get('order');
        $columnName_arr   = $request->get('columns');
        $order_arr        = $request->get('order');
        $namaAktivaTetapFilter = $request->get('tipe_aktiva_tetap');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $tipeAktivaTetap =  DB::table('tipe_aktiva_tetaps');
        $totalRecords = $tipeAktivaTetap->count();

        if ($namaAktivaTetapFilter) {
            $tipeAktivaTetap->where('tipe_aktiva_tetap', 'like', '%' . $namaAktivaTetapFilter . '%');
        }

        $totalRecordsWithFilter = $tipeAktivaTetap->count();

        $records = $tipeAktivaTetap
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="tipeaktivatetap_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"                => $checkbox,
                "no"                      => $start + $key + 1,
                "id"                      => $record->id,
                "tipe_aktiva_tetap"       => $record->tipe_aktiva_tetap,
                "tipe_aktiva_tetap_pajak" => $record->tipe_aktiva_tetap_pajak,
                "metode_penyusutan"       => $record->metode_penyusutan,
                "umur_perkiraan"          => $record->umur_perkiraan,
                "nilai_penyusutan"        => $record->nilai_penyusutan,
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
        $tipeAktivaTetap = TipeAktivaTetap::findOrFail($id);
        $penyusutan = DB::table('penyusutan')->get();
        $tipeAktivaTetapPajak = DB::table('tipe_aktiva_tetap_pajaks')->get();
        return view('aktiva.tipeaktivatetap.tipeaktivatetapedit', compact('tipeAktivaTetap', 'penyusutan', 'tipeAktivaTetapPajak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'tipe_aktiva_tetap' => 'required|string|max:255',
            'tipe_aktiva_tetap_pajak' => 'required|string|max:255',
            'metode_penyusutan' => 'required|string|max:255',
            'umur_perkiraan' => 'nullable|numeric',
            'nilai_penyusutan' => 'nullable|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $tipeAktivaTetap = TipeAktivaTetap::findOrFail($id);
            $tipeAktivaTetap->fill($validator->validated());
            $tipeAktivaTetap->save();

            DB::commit();
            sweetalert()->success('Update Tipe Aktiva Tetap successfully :)');
            return redirect()->route('tipeaktivatetap/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update Tipe Aktiva Tetap failed :)' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        try{
            $ids = $request->ids;
            TipeAktivaTetap::whereIn('id', $ids)->delete();
            sweetalert()->success('Delete record successfully :)');
            return redirect()->route('tipeaktivatetap/list/page');
        } catch (\Exception $e) {
            sweetalert()->error('Delete record failed :)' . $e->getMessage());
            return redirect()->back();
        }
    }
}
