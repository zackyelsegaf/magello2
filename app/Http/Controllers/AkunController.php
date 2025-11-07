<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;

class AkunController extends Controller
{
    public function akunList()
    {
        $tipe_akun = DB::table('tipe_akun')->get();
        return view('akun.listakun', compact('tipe_akun'));
    }

    public function akunAddNew()
    {
        // $prefix = 'GMPC-';
        // $latest = Akun::orderBy('pelanggan_id', 'desc')->first();
        // $nextID = $latest ? intval(substr($latest->pelanggan_id, strlen($prefix))) + 1 : 1;
        // $kodeBaru = $prefix . sprintf("%04d", $nextID);
        $mata_uang = DB::table('mata_uang')->get();
        $tipe_akun = DB::table('tipe_akun')->get();
        $nama_akun = DB::table('akun')
                ->whereIn('sub_akun_check', ['0'])
                ->orderBy('nama', 'asc')
                ->get();
        return view('akun.akunaddnew', compact('tipe_akun', 'nama_akun', 'mata_uang'));
    }

    public function saveRecordAkun(Request $request){
        
        $rules = [
            'no_akun'             => 'required|string|max:255|unique:akun,no_akun',
            'tipe_id'             => 'required|integer|exists:tipe_akun,id',
            'nama_akun_indonesia' => 'required|string|max:255',
            'nama_akun_inggris'   => 'nullable|string|max:255',
            'mata_uang_id'        => 'nullable|integer|exists:mata_uang,id',
            'parent_id'           => 'nullable|integer|exists:akun,id',
            'saldo_akun'          => 'nullable|string|max:255',
            'tanggal'             => 'nullable|string|max:255',
            'sub_akun_check'      => 'nullable|string|max:255',
            'dihentikan'          => 'nullable|boolean',
        ];

        $message = [
            'no_akun.unique'      => 'No akun sudah ada di dalam sistem.',
            'no_akun.required'    => 'No akun wajib diisi.',
            'tipe_id.required'  => 'Tipe akun wajib diisi.',
            'nama_akun_indonesia.required' => 'Nama akun (Indonesia) wajib diisi.',
            'tipe_akun.exists'      => 'Tipe akun tidak ditemukan di dalam sistem.',
            'mata_uang_id.exists' => 'Mata uang tidak ditemukan di dalam sistem.',
            'parent_id.exists'    => 'Akun induk tidak ditemukan di dalam sistem.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //debug
        // DB::enableQueryLog();
        // MataUang::create($request->all());
        // dd(DB::getQueryLog());

        DB::beginTransaction();
        try {

            // $photo= $request->fileupload_1;
            // $file_name = rand() . '.' .$photo->getClientOriginalName();
            // $photo->move(public_path('/assets/img/'), $file_name);

            $Akun = new Akun($validator->validated());
            $Akun->save();

            DB::commit();
            sweetalert()->success('Create new Proyek successfully :)');
            return redirect()->route('akun/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $mata_uang = DB::table('mata_uang')->get();
        $tipe_akun = DB::table('tipe_akun')->get();
        $nama_akun = DB::table('akun')
                ->whereIn('sub_akun_check', ['0'])
                ->orderBy('nama', 'asc')
                ->get();
        $Akun = Akun::findOrFail($id);
        if (!$Akun) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('akun.akunedit', compact('Akun', 'tipe_akun', 'nama_akun', 'mata_uang'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'no_akun'             => 'required|string|max:255',
            'tipe_id'             => 'required|integer|exists:tipe_akun,id',
            'nama_akun_indonesia' => 'required|string|max:255',
            'nama_akun_inggris'   => 'nullable|string|max:255',
            'mata_uang_id'        => 'nullable|integer|exists:mata_uang,id',
            'parent_id'           => 'nullable|integer|exists:akun,id',
            'saldo_akun'          => 'nullable|string|max:255',
            'tanggal'             => 'nullable|string|max:255',
            'sub_akun_check'      => 'nullable|string|max:255',
            'dihentikan'          => 'nullable|boolean',
        ];

        $message = [
            // 'no_akun.unique'      => 'No akun sudah ada di dalam sistem.',
            'no_akun.required'    => 'No akun wajib diisi.',
            'tipe_id.required'  => 'Tipe akun wajib diisi.',
            'nama_akun_indonesia.required' => 'Nama akun (Indonesia) wajib diisi.',
            'tipe_akun.exists'      => 'Tipe akun tidak ditemukan di dalam sistem.',
            'mata_uang_id.exists' => 'Mata uang tidak ditemukan di dalam sistem.',
            'parent_id.exists'    => 'Akun induk tidak ditemukan di dalam sistem.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $Akun = Akun::findOrFail($id);
            $Akun->fill($validator->validated());
            $Akun->save();
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('akun/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
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

    public function getAkun(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama_akun');
        $akunIdFilter  = $request->get('no_akun');
        $akunTipeAkunFilter  = $request->get('tipe_id');
        $akunDihentikanFilter  = $request->get('dihentikan');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $Akun =  Akun::with(['mataUang','tipe']);
        $totalRecords = Akun::count();

        if ($namaFilter) {
            $Akun->where('nama_akun', 'like', '%' . $namaFilter . '%');
        }

        if ($akunIdFilter) {
            $Akun->where('no_akun', 'like', '%' . $akunIdFilter . '%');
        }

        if ($akunTipeAkunFilter) {
            $Akun->where('tipe_id', 'like', '%' . $akunTipeAkunFilter . '%');
        }

        if ($akunDihentikanFilter  !== null && $akunDihentikanFilter !== '') {
            $Akun->where('dihentikan', $akunDihentikanFilter);
        }

        $totalRecordsWithFilter = $Akun->count();

        // $records = $Akun
        //     ->orderBy('no_akun', 'asc')            
        //     ->skip($start)
        //     ->take($length)
        //     ->get();

        $tableName  = (new Akun)->getTable();
        $cols       = Schema::getColumnListing($tableName);
        $sortColumn = in_array($columnName, $cols, true) ? $columnName : 'id';
        $sortDir    = strtolower($columnSortOrder) === 'desc' ? 'desc' : 'asc';

        $records = $Akun->orderBy($sortColumn, $sortDir)->skip($start)->take($length)->get();
            
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="akun_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"              => $checkbox,
                "no"                    => $start + $key + 1,
                "id"                    => $record->id,
                "no_akun"               => $record->sub_akun_check == 0 ? '<strong>' . $record->no_akun . '</strong>' : str_repeat('&nbsp;', 3) . $record->no_akun,
                "nama_akun_indonesia"   => $record->sub_akun_check == 0 ? '<strong>' . $record->nama_akun_indonesia . '</strong>' : str_repeat('&nbsp;', 3) . $record->nama_akun_indonesia,
                "tipe_id"               => $record->tipe_id,
                "tipe_nama"             => $record->sub_akun_check == 0 ? '<strong>' . $record->tipe?->nama . '</strong>' : $record->tipe?->nama,
                "mata_uang_id"          => $record->mata_uang_id,
                "mata_uang"             => $record->sub_akun_check == 0 ? '<strong>' . $record->mataUang?->nama . '</strong>' : $record->mataUang?->nama,
                "saldo_akun"            => $record->sub_akun_check == 0 ? '<strong>' . "Rp " . number_format($record->saldo_akun, 0, ',', '.') . '</strong>' : "Rp " . number_format($record->saldo_akun, 0, ',', '.'),
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
