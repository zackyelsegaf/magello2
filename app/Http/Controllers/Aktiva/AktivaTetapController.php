<?php

namespace App\Http\Controllers\Aktiva;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AktivaTetap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AktivaTetapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AktivaTetapList()
    {
        return view('aktiva.aktivatetap.aktivatetap');
    }

    /**
     * Show the form for creating a new resource.
     */
        public function AktivaTetapAddNew()
        {
            $departemen = DB::table('departemen')->get();
            $tipeAktivaTetap = DB::table('tipe_aktiva_tetaps')->get();
            $penyusutan = DB::table('penyusutan')->get();
            $akunAktiva = DB::table('akun')
                ->whereIn('tipe_akun', ['Aktiva Tetap',])
                ->where('sub_akun_check', '1')
                ->orderBy('nama', 'asc')
                ->get();
            $akunAktivaAP = DB::table('akun')
                ->whereIn('tipe_akun', ['Akumulasi Penyusutan',])
                ->where('sub_akun_check', '1')
                ->orderBy('nama', 'asc')
                ->get();
            $akunAktivaBP = DB::table('akun')
                ->where(function ($query) {
                    $query->where('tipe_akun', 'Beban')
                        ->where('sub_akun_check', 0);
                })
                ->orWhere(function ($query) {
                    $query->where('tipe_akun', 'Harga Pokok Penjualan')
                        ->where('sub_akun_check', 1);
                })
                ->orderBy('nama', 'asc')
                ->get();
            return view('aktiva.aktivatetap.aktivatetapadd', compact('departemen', 'tipeAktivaTetap', 'penyusutan', 'akunAktiva', 'akunAktivaAP', 'akunAktivaBP'));
        }

    /**
     * Store a newly created resource in storage.
     */
    public function saveAktivaTetap(Request $request)
    {
        $rules = [
            'kode_aktiva' => 'required|string|max:255',
            'tipe_aktiva' => 'required|string|max:255',
            'deskripsi'   => 'required|string|max:255',
            'departemen'  => 'required|string|max:255',
            'penyusutan'  => 'required|string|max:255',
            'tanggal_akuisisi' => 'required|date',
            'tanggal_penggunaan' => 'nullable|date',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }   
        DB::beginTransaction();
        try {
            $aktivaTetap = new AktivaTetap($validator->validated());
            $aktivaTetap->save();   

            DB::commit();
            sweetalert()->success('Create new Aktiva Tetap successfully :)');
            return redirect()->route('aktivatetap/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Create new Aktiva Tetap failed :)' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function getAktivaTetap(string $id)
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

        $aktivaTetap =  DB::table('aktiva_tetaps');
        $totalRecords = $aktivaTetap->count();

        if ($namaAktivaTetapFilter) {
            $aktivaTetap->where('tipe_aktiva_tetap', 'like', '%' . $namaAktivaTetapFilter . '%');
        }

        $totalRecordsWithFilter = $aktivaTetap->count();

        $records = $aktivaTetap
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="aktivatetap_checkbox" value="'.$record->id.'">';

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
        return view('aktiva.aktiva_tetap.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->route('aktiva.aktiva_tetap.index')->with('success', 'Aktiva Tetap updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('aktiva.aktiva_tetap.index')->with('success', 'Aktiva Tetap deleted successfully.');
        // --- IGNORE ---
    }
}
