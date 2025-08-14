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

<?php

namespace App\Http\Controllers\Aktiva;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AktivaTetap;
use App\Models\Akun;
use App\Models\AktivaTetapDetail;
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

    public function tambahAktivaTetap(Request $request)
    {
        if ($request->ajax()) {
            $akun = DB::table('akun');

            if ($request->no_akun) {
                $akun->where('no_akun', 'like', '%' . $request->no_akun . '%');
            }

            if ($request->nama_akun_indonesia) {
                $akun->where('nama_akun_indonesia', 'like', '%' . $request->nama_akun_indonesia . '%');
            }

            $result = $akun->get();
            return response()->json($result);
        }
        $akun = DB::table('akun')->get();

        return view('aktiva.aktivatetap.aktivatetapadd', compact('akun'));
    }

    public function AktivaTetapAddNew(Request $request)
    {
        $akun = DB::table('akun')->get();
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
        $prefix = 'AKT';
        $latest = AktivaTetap::orderBy('kode_aktiva', 'desc')->first();
        $nextID = $latest ? intval(substr($latest->kode_aktiva, strlen($prefix))) + 1 : 1;
        $kodeBaru = $prefix . sprintf("%04d", $nextID);

        return view('aktiva.aktivatetap.aktivatetapadd', compact('akun','departemen', 'tipeAktivaTetap', 'penyusutan', 'akunAktiva', 'akunAktivaAP', 'akunAktivaBP', 'kodeBaru'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function getDetailAktivaTetap(Request $request)
    {
        $no_akun = $request->no_akun;

        $data = DB::table('akun')
            ->where('no_akun', $no_akun)
            ->get();

        return response()->json($data);
    }

    public function saveRecordAktivaTetap(Request $request)
    {
        $rules = [
            'kode_aktiva'           => 'nullable|string|max:255',
            'tipe_aktiva'           => 'required|string|max:255',
            'departemen'            => 'required|string|max:255',
            'tgl_akuisisi'          => 'required|string|max:255',
            'deskripsi_aktiva'      => 'required|string|max:255',
            'tgl_penggunaan'        => 'required|string|max:255',
            'tahun'                 => 'nullable|string|max:255',
            'bulan'                 => 'nullable|string|max:255',
            'depresiasi'            => 'nullable|string|max:255',
            'metode_penyusutan'     => 'required|string|max:255',
            'akun_aktiva'           => 'required|string|max:255',
            'akun_akumulasi'        => 'nullable|string|max:255',
            'akun_biaya_penyusutan' => 'nullable|string|max:255',
            'umur_perkiraan'        => 'nullable|string|max:255',
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
            
            $Akun = count($request->no_akun);
            for ($i = 0; $i < $Akun; $i++){
                $nilai = $request->nilai[$i] ?? 0;
                $detail = new AktivaTetapDetail();
                $detail->aktiva_tetap_id     = $aktivaTetap->id;
                $detail->biaya_aktiva        = $request->biaya_aktiva;
                $detail->nilai_penyusutan    = $request->nilai_penyusutan;
                $detail->nilai_buku          = $request->nilai_buku;
                $detail->nilai_sisa          = $request->nilai_sisa;
                $detail->memo                = $request->memo;
                $detail->no_akun             = $request->no_akun[$i]  ?? null;
                $detail->tanggal             = $request->tanggal[$i]  ?? null;
                $detail->deskripsi           = $request->deskripsi[$i]  ?? null;
                $detail->nilai               = $nilai;
                $detail->rekonsiliasi_check  = $request->rekonsiliasi_check[$i]  ?? null;
                $detail->save();

                if (!empty($request->no_akun[$i])) {
                    $akun = Akun::where('no_akun', $request->no_akun[$i])->first();

                    if ($akun) {
                        $akun->saldo_akun = $akun->saldo_akun - floatval($nilai);
                        $akun->save();
                    }
                }
            }

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
    public function getAktivaTetap(Request $request)
    {
        $draw             = $request->get('draw');
        $start            = $request->get("start");
        $rowPerPage       = $request->get("length"); // total number of rows per page
        $columnIndex_arr  = $request->get('order');
        $columnName_arr   = $request->get('columns');
        $order_arr        = $request->get('order');
        $namaAktivaTetapFilter = $request->get('aktiva_tetap');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $aktivaTetap =  DB::table('aktiva_tetaps');
        $totalRecords = $aktivaTetap->count();

        if ($namaAktivaTetapFilter) {
            $aktivaTetap->where('aktiva_tetap', 'like', '%' . $namaAktivaTetapFilter . '%');
        }

        $totalRecordsWithFilter = $aktivaTetap->count();

        $records = $aktivaTetap
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $detail = DB::table('aktiva_tetap_details')
                ->where('aktiva_tetap_id', $record->id)
                ->first();

            $checkbox = '<input type="checkbox" class="aktivatetap_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"                => $checkbox,
                "no"                      => $start + $key + 1,
                "id"                      => $record->id,
                "kode_aktiva"             => $record->kode_aktiva,
                "deskripsi_aktiva"        => $record->deskripsi_aktiva,
                "tipe_aktiva"             => $record->tipe_aktiva,
                "akun_aktiva"             => $record->akun_aktiva,
                "biaya_aktiva"            => number_format($detail->biaya_aktiva, 0, ',', '.'),
                "tgl_penggunaan"          => $record->tgl_penggunaan,
                "tgl_akuisisi"            => $record->tgl_akuisisi,
                "tahun"                   => $record->tahun,
                "metode_penyusutan"       => $record->metode_penyusutan,
                "departemen"              => $record->departemen,
                "umur_perkiraan"          => $record->umur_perkiraan,
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
    public function edit($id)
    {
        $akun = DB::table('akun')->get();
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

        $aktivaTetap = AktivaTetap::with(['detail', 'detail2'])->findOrFail($id);
        if (!$aktivaTetap) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('aktiva.aktivatetap.aktivatetapedit', compact('akun','departemen', 'tipeAktivaTetap', 'penyusutan', 'akunAktiva', 'akunAktivaAP', 'akunAktivaBP', 'aktivaTetap'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'kode_aktiva'           => 'nullable|string|max:255',
            'tipe_aktiva'           => 'required|string|max:255',
            'departemen'            => 'required|string|max:255',
            'tgl_akuisisi'          => 'required|string|max:255',
            'deskripsi_aktiva'      => 'required|string|max:255',
            'tgl_penggunaan'        => 'required|string|max:255',
            'tahun'                 => 'nullable|string|max:255',
            'bulan'                 => 'nullable|string|max:255',
            'depresiasi'            => 'nullable|string|max:255',
            'metode_penyusutan'     => 'required|string|max:255',
            'akun_aktiva'           => 'required|string|max:255',
            'akun_akumulasi'        => 'nullable|string|max:255',
            'akun_biaya_penyusutan' => 'nullable|string|max:255',
            'umur_perkiraan'        => 'nullable|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $aktivaTetap = AktivaTetap::with(['detail', 'detail2'])->findOrFail($id);
            $aktivaTetap->update($validator->validated());

            AktivaTetapDetail::where('aktiva_tetap_id', $aktivaTetap->id)->delete();

            $Akun = count($request->no_akun);
            for ($i = 0; $i < $Akun; $i++){
                $nilai = $request->nilai[$i] ?? 0;
                $detail = new AktivaTetapDetail();
                $detail->aktiva_tetap_id     = $aktivaTetap->id;
                $detail->biaya_aktiva        = $request->biaya_aktiva;
                $detail->nilai_penyusutan    = $request->nilai_penyusutan;
                $detail->nilai_buku          = $request->nilai_buku;
                $detail->nilai_sisa          = $request->nilai_sisa;
                $detail->memo                = $request->memo;
                $detail->no_akun             = $request->no_akun[$i]  ?? null;
                $detail->tanggal             = $request->tanggal[$i]  ?? null;
                $detail->deskripsi           = $request->deskripsi[$i]  ?? null;
                $detail->nilai               = $nilai;
                $detail->rekonsiliasi_check  = $request->rekonsiliasi_check[$i]  ?? null;
                $detail->save();

                if (!empty($request->no_akun[$i])) {
                    $akun = Akun::where('no_akun', $request->no_akun[$i])->first();

                    if ($akun) {
                        $akun->saldo_akun = $akun->saldo_akun - floatval($nilai);
                        $akun->save();
                    }
                }
            }

            DB::commit();
            sweetalert()->success('Create new Aktiva Tetap successfully :)');
            return redirect()->route('aktivatetap/list/page');

        } catch(\Exception $e) {
            DB::rollBack();
            sweetalert()->error('Gagal Mengupdate Data' . $e->getMessage());
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
            AktivaTetap::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('aktivatetap/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }
}
