<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
use App\Models\Village;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class PegawaiController extends Controller
{
    public function pegawaiList()
    {
        return view('pegawai.listpegawai');
    }

    public function pegawaiAddNew()
    {
        $data = DB::table('status_pemasok')->get();
        $provinces = Province::orderBy('name')->get(['code','name']);
        $kota = DB::table('kota')
            ->select('id', 'nama')
            ->union(
                DB::table('provinsi')->select('id', 'nama')
            )
            ->orderBy('nama')
            ->get();
        // $negara = DB::table('negara')->orderBy('nama', 'asc')->get();
        // $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        // $prefix = 'GMPSCR-';
        // $latest = Penjual::orderBy('pelanggan_id', 'desc')->first();
        // $nextID = $latest ? intval(substr($latest->pelanggan_id, strlen($prefix))) + 1 : 1;
        // $kodeBaru = $prefix . sprintf("%04d", $nextID);
        $status_pekerjaan = DB::table('status_pekerja')->orderBy('nama', 'asc')->get();
        $hubungan_pegawai = DB::table('status_keluarga')->orderBy('nama', 'asc')->get();
        $kartu_identitas = DB::table('kartu_identitas')->orderBy('nama', 'asc')->get();
        $golongan_darah = DB::table('golongan_darah')->orderBy('nama', 'asc')->get();
        $agama = DB::table('religion')->orderBy('nama', 'asc')->get();
        $gender = DB::table('gender')->orderBy('nama', 'asc')->get();
        return view('pegawai.pegawaiaddnew', compact('data', 'kota', 'gender', 'agama', 'golongan_darah', 'provinces', 'kartu_identitas', 'hubungan_pegawai', 'status_pekerjaan'));
    }

    public function citiesByProvince(Request $request)
    {
        $request->validate([
            'provinsi_code' => 'required|string|size:2',
        ]);

        $cities = City::where('province_code', $request->provinsi_code)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($cities);
    }

    public function districtsByCity(Request $request)
    {
        $request->validate([
            'kota_code' => 'required|string|size:4',
        ]);

        $districts = District::where('city_code', $request->kota_code)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($districts);
    }

    public function villagesByDistrict(Request $request)
    {
        $request->validate([
            'kecamatan_code' => 'required|string|size:6',
        ]);

        $villages = Village::where('district_code', $request->kecamatan_code)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($villages);
    }

    public function saveRecordPegawai(Request $request)
    {
        $rules = [
            'nik_pegawai' => 'required|string|max:255',
            'nama_pegawai' => 'required|string|max:255',
            'tempat_lahir_pegawai' => 'required|string|max:255',
            'tanggal_lahir_pegawai' => 'required|string|max:255',
            'jenis_kelamin_pegawai_id' => 'required|string|max:255',
            'agama_pegawai_id' => 'required|string|max:255',
            'status_pernikahan_pegawai_id' => 'required|string|max:255',
            'golongan_darah_id' => 'nullable|string|max:255',
            'email_pegawai' => 'required|string|max:255',
            'no_telp_pegawai' => 'required|string|max:255',
            'provinsi_code' => 'required|string|max:255',
            'kota_code' => 'required|string|max:255',
            'kecamatan_code' => 'required|string|max:255',
            'kelurahan_code' => 'required|string|max:255',
            'rt_pegawai' => 'required|string|max:255',
            'rw_pegawai' => 'required|string|max:255',
            'alamat_pegawai' => 'required|string|max:255',
            'nama_bank_pegawai' => 'nullable|string|max:255',
            'nomor_rekening_pegawai' => 'nullable|string|max:255',
            'atas_nama_pegawai' => 'nullable|string|max:255',
            'jenis_identitas_pegawai_id' => 'nullable|string|max:255',
            'nomor_identitas_pegawai' => 'nullable|string|max:255',
            'nama_ayah_pegawai' => 'required|string|max:255',
            'nama_ibu_pegawai' => 'required|string|max:255',
            'nama_kontak_darurat_pegawai' => 'required|string|max:255',
            'no_telp_darurat_pegawai' => 'required|string|max:255',
            'hubungan_pegawai' => 'required|string|max:255',
            'status_pekerjaan_pegawai_id' => 'nullable|string|max:255',
            'foto_pegawai' => 'nullable|file',
            'tanggal_masuk_pegawai' => 'nullable|string|max:255',
            'tanggal_keluar_pegawai' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
        ];

        $message = [
            'nik_pegawai.required' => 'NIK wajib diisi',
            'nama_pegawai.required' => 'Nama wajib diisi',
            'tempat_lahir_pegawai.required' => 'Tempat Lahir wajib diisi',
            'tanggal_lahir_pegawai.required' => 'Tanggal Lahir wajib diisi',
            'jenis_kelamin_pegawai_id.required' => 'Jenis Kelamin wajib diisi',
            'agama_pegawai_id.required' => 'Agama wajib diisi',
            'status_pernikahan_pegawai_id.required' => 'Status Pernikahan wajib diisi',
            'email_pegawai.required' => 'Email wajib diisi',
            'no_telp_pegawai.required' => 'No Telepon wajib diisi',
            'provinsi_code.required' => 'Provinsi wajib diisi',
            'kota_code.required' => 'Kota wajib diisi',
            'kecamatan_code.required' => 'Kecamatan wajib diisi',
            'kelurahan_code.required' => 'Kelurahan wajib diisi',
            'rt_pegawai.required' => 'RT wajib diisi',
            'rw_pegawai.required' => 'RW wajib diisi',
            'alamat_pegawai.required' => 'Alamat wajib diisi',
            'nama_ayah_pegawai.required' => 'Nama Ayah wajib diisi',
            'nama_ibu_pegawai.required' => 'Nama Ibu wajib diisi',
            'nama_kontak_darurat_pegawai.required' => 'Nama Kontak Darurat wajib diisi',
            'no_telp_darurat_pegawai.required' => 'No Telepon Darurat wajib diisi',
            'hubungan_pegawai.required' => 'Hubungan wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules);

        //debug
        // DB::enableQueryLog();
        // MataUang::create($request->all());
        // dd(DB::getQueryLog());

        DB::beginTransaction();
        try {

            // $photo= $request->foto_pegawai;
            // $file_name = rand() . '.' .$photo->getClientOriginalName();
            // $photo->move(public_path('/assets/upload/'), $file_name);

            $pegawai = new Pegawai($validator->validated());
            $pegawai->save();

            DB::commit();
            sweetalert()->success('Create new Penjual successfully :)');
            return redirect()->route('pegawai/list/page');

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $data = DB::table('status_pemasok')->get();
        $kota = DB::table('kota')
            ->select('id', 'nama')
            ->union(
                DB::table('provinsi')->select('id', 'nama')
            )
            ->orderBy('nama')
            ->get();
        // $negara = DB::table('negara')->orderBy('nama', 'asc')->get();
        // $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        // $prefix = 'GMPSCR-';
        // $latest = Penjual::orderBy('pelanggan_id', 'desc')->first();
        // $nextID = $latest ? intval(substr($latest->pelanggan_id, strlen($prefix))) + 1 : 1;
        // $kodeBaru = $prefix . sprintf("%04d", $nextID);
        $status_pekerjaan = DB::table('status_pekerja')->orderBy('nama', 'asc')->get();
        $hubungan_pegawai = DB::table('status_keluarga')->orderBy('nama', 'asc')->get();
        $kartu_identitas = DB::table('kartu_identitas')->orderBy('nama', 'asc')->get();
        $golongan_darah = DB::table('golongan_darah')->orderBy('nama', 'asc')->get();
        $agama = DB::table('religion')->orderBy('nama', 'asc')->get();
        $gender = DB::table('gender')->orderBy('nama', 'asc')->get();
        $Pegawai = Pegawai::findOrFail($id);
        $provinces = Province::orderBy('name')->get(['code','name']);
        $citySelected     = $Pegawai->kota_code ? City::where('code', $Pegawai->kota_code)->first(['code','name']) : null;
        $districtSelected = $Pegawai->kecamatan_code ? District::where('code', $Pegawai->kecamatan_code)->first(['code','name']) : null;
        $villageSelected  = $Pegawai->kelurahan_code ? Village::where('code', $Pegawai->kelurahan_code)->first(['code','name']) : null;
        return view('pegawai.pegawaiedit', compact('Pegawai', 'data', 'kota', 'gender', 'agama', 'golongan_darah', 'provinces', 'kartu_identitas', 'hubungan_pegawai', 'status_pekerjaan', 'citySelected', 'districtSelected', 'villageSelected'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nik_pegawai' => 'required|string|max:255',
            'nama_pegawai' => 'required|string|max:255',
            'tempat_lahir_pegawai' => 'required|string|max:255',
            'tanggal_lahir_pegawai' => 'required|string|max:255',
            'jenis_kelamin_pegawai_id' => 'required|string|max:255',
            'agama_pegawai_id' => 'required|string|max:255',
            'status_pernikahan_pegawai_id' => 'required|string|max:255',
            'golongan_darah_id' => 'nullable|string|max:255',
            'email_pegawai' => 'required|string|max:255',
            'no_telp_pegawai' => 'required|string|max:255',
            'provinsi_code' => 'required|string|max:255',
            'kota_code' => 'required|string|max:255',
            'kecamatan_code' => 'required|string|max:255',
            'kelurahan_code' => 'required|string|max:255',
            'rt_pegawai' => 'required|string|max:255',
            'rw_pegawai' => 'required|string|max:255',
            'alamat_pegawai' => 'required|string|max:255',
            'nama_bank_pegawai' => 'nullable|string|max:255',
            'nomor_rekening_pegawai' => 'nullable|string|max:255',
            'atas_nama_pegawai' => 'nullable|string|max:255',
            'jenis_identitas_pegawai_id' => 'nullable|string|max:255',
            'nomor_identitas_pegawai' => 'nullable|string|max:255',
            'nama_ayah_pegawai' => 'required|string|max:255',
            'nama_ibu_pegawai' => 'required|string|max:255',
            'nama_kontak_darurat_pegawai' => 'required|string|max:255',
            'no_telp_darurat_pegawai' => 'required|string|max:255',
            'hubungan_pegawai' => 'required|string|max:255',
            'status_pekerjaan_pegawai_id' => 'nullable|string|max:255',
            'foto_pegawai' => 'nullable|file',
            'tanggal_masuk_pegawai' => 'nullable|string|max:255',
            'tanggal_keluar_pegawai' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
        ];

        $message = [
            'nik_pegawai.required' => 'NIK wajib diisi',
            'nama_pegawai.required' => 'Nama wajib diisi',
            'tempat_lahir_pegawai.required' => 'Tempat Lahir wajib diisi',
            'tanggal_lahir_pegawai.required' => 'Tanggal Lahir wajib diisi',
            'jenis_kelamin_pegawai_id.required' => 'Jenis Kelamin wajib diisi',
            'agama_pegawai_id.required' => 'Agama wajib diisi',
            'status_pernikahan_pegawai_id.required' => 'Status Pernikahan wajib diisi',
            'email_pegawai.required' => 'Email wajib diisi',
            'no_telp_pegawai.required' => 'No Telepon wajib diisi',
            'provinsi_code.required' => 'Provinsi wajib diisi',
            'kota_code.required' => 'Kota wajib diisi',
            'kecamatan_code.required' => 'Kecamatan wajib diisi',
            'kelurahan_code.required' => 'Kelurahan wajib diisi',
            'rt_pegawai.required' => 'RT wajib diisi',
            'rw_pegawai.required' => 'RW wajib diisi',
            'alamat_pegawai.required' => 'Alamat wajib diisi',
            'nama_ayah_pegawai.required' => 'Nama Ayah wajib diisi',
            'nama_ibu_pegawai.required' => 'Nama Ibu wajib diisi',
            'nama_kontak_darurat_pegawai.required' => 'Nama Kontak Darurat wajib diisi',
            'no_telp_darurat_pegawai.required' => 'No Telepon Darurat wajib diisi',
            'hubungan_pegawai.required' => 'Hubungan wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            // $photo= $request->foto_pegawai;
            // $file_name = rand() . '.' .$photo->getClientOriginalName();
            // $photo->move(public_path('/assets/upload/'), $file_name);

            $pegawai = Pegawai::findOrFail($id);
            $pegawai->fill($validator->validated());
            $pegawai->save();

            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('pegawai/list/page');

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            Pegawai::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('pegawai/list/page');

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getPegawai(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $search_arr      = $request->get('search');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue     = $search_arr['value']; // Search value

        $pegawai =  Pegawai::with(['gender']);
        $totalRecords = Pegawai::count();

        $totalRecordsWithFilter = $pegawai->where(function ($query) use ($searchValue) {
            $query->where('nama_pegawai', 'like', '%' . $searchValue . '%');
            $query->orWhere('nik_pegawai', 'like', '%' . $searchValue . '%');
        })->count();

        if ($columnName == 'nama_pegawai') {
            $columnName = 'nama_pegawai';
        }
        // $records = $pegawai->orderBy($columnName, $columnSortOrder)
        //     ->where(function ($query) use ($searchValue) {
        //         $query->where('nama_pegawai', 'like', '%' . $searchValue . '%');
        //         $query->orWhere('nik_pegawai', 'like', '%' . $searchValue . '%');
        //     })
        //     ->skip($start)
        //     ->take($length)
        //     ->get();

        $tableName  = (new Pegawai)->getTable();
        $cols       = Schema::getColumnListing($tableName);
        $sortColumn = in_array($columnName, $cols, true) ? $columnName : 'id';
        $sortDir    = strtolower($columnSortOrder) === 'desc' ? 'desc' : 'asc';

        $records = $pegawai
            ->orderBy($sortColumn, $sortDir)
            ->where(function ($query) use ($searchValue) {
                $query->where('nama_pegawai', 'like', '%' . $searchValue . '%');
                $query->orWhere('nik_pegawai', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($length)
            ->get();
            
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="pegawai_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"               => $checkbox,
                "no"                     => $start + $key + 1,
                "id"                     => $record->id,
                // "pelanggan_id"   => $record->pelanggan_id,
                "nik_pegawai"            => $record->nik_pegawai,
                'nama_pegawai'           => $record->nama_pegawai,
                "email_pegawai"          => $record->email_pegawai,
                'jenis_kelamin_pegawai_id'  => $record->jenis_kelamin_pegawai_id,
                'jenis_kelamin_pegawai'  => $record->gender?->nama,
                'tanggal_masuk_pegawai'  => $record->tanggal_masuk_pegawai,
                'nomor_rekening_pegawai' => $record->nomor_rekening_pegawai,
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
