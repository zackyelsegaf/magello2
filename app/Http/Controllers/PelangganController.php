<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class PelangganController extends Controller
{

    public function pelangganList(Request $request)
    {
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $tipe_pelanggan = DB::table('tipe_pelanggan')->orderBy('nama', 'asc')->get();
        return view('pelanggan.listpelanggan', compact('mata_uang', 'tipe_pelanggan'));
    }

    public function pelangganAddNew()
    {
        $data = DB::table('status_pemasok')->get();
        $provinsi = Province::orderBy('name')->get(['code','name']);
        $kota = DB::table('kota')
            ->select('id', 'nama')
            ->union(
                DB::table('provinsi')->select('id', 'nama')
            )
            ->orderBy('nama')
            ->get();
        $negara = DB::table('negara')->orderBy('nama', 'asc')->get();
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $prefix = 'GMPSCR-';
        $latest = Pelanggan::orderBy('pelanggan_id', 'desc')->first();
        $nextID = $latest ? intval(substr($latest->pelanggan_id, strlen($prefix))) + 1 : 1;
        $kodeBaru = $prefix . sprintf("%04d", $nextID);
        $pajak = DB::table('pajak')->orderBy('nama', 'asc')->get();
        $syarat = DB::table('syarat')->orderBy('nama', 'asc')->get();
        $tipe_pelanggan = DB::table('tipe_pelanggan')->orderBy('nama', 'asc')->get();
        $level_harga = DB::table('level_harga')->orderBy('nama', 'asc')->get();
        $agama = DB::table('religion')->orderBy('nama', 'asc')->get();
        $gender = DB::table('gender')->orderBy('nama', 'asc')->get();
        return view('pelanggan.pelangganaddnew', compact('data', 'provinsi', 'kota', 'negara', 'mata_uang', 'kodeBaru', 'pajak', 'syarat', 'tipe_pelanggan', 'level_harga','agama','gender'));
    }

    public function citiesByProvince(Request $request)
    {
        $request->validate([
            'provinsi' => 'required|string|size:2',
        ]);

        $cities = City::where('province_code', $request->provinsi)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($cities);
    }

    public function districtsByCity(Request $request)
    {
        $request->validate([
            'kota' => 'required|string|size:4',
        ]);

        $districts = District::where('city_code', $request->kota)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($districts);
    }

    public function villagesByDistrict(Request $request)
    {
        $request->validate([
            'kecamatan' => 'required|string|size:6',
        ]);

        $villages = Village::where('district_code', $request->kecamatan)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($villages);
    }

    public function saveRecordPelanggan(Request $request)
    {
        $rules = [
            'nama'                       => 'required|string|max:255',
            'nik'                        => 'required|string|max:255',
            'tanggal_lahir'              => 'required|string|max:255',
            'tempat_lahir'               => 'required|string|max:255',
            'religion_id'                => 'required|string|max:255',
            'gender_id'                  => 'required|string|max:255',
            'nama_ayah'                  => 'required|string|max:255',
            'nama_ibu'                   => 'required|string|max:255',
            'npwp'                       => 'required|string|max:255',
            'nppkp'                      => 'required|string|max:255',
            'pajak_1_id'                 => 'required|string|max:255',
            'pajak_2_id'                 => 'required|string|max:255',
            'penjual_id'                 => 'nullable|string|max:255',
            'tipe_pelanggan_id'          => 'required|string|max:255',
            'level_harga'                => 'nullable|string|max:255',
            'diskon_penjualan_pelanggan' => 'nullable|string|max:255',
            'syarat_id'                  => 'required|string|max:255',
            'batas_maks_hutang'          => 'nullable|string|max:255',
            'batas_umur_hutang'          => 'nullable|string|max:255',
            'mata_uang_id'               => 'required|string|max:255',
            'saldo_awal'                 => 'required|string|max:255',
            'tanggal_pelanggan'          => 'nullable|string|max:255',
            'deskripsi'                  => 'nullable|string|max:255',
            'status_id'                  => 'required|string|max:255',
            'dihentikan'                 => 'nullable|boolean',
            'alamat_1'                   => 'required|string|max:255',
            'alamat_2'                   => 'nullable|string|max:255',
            'alamatpajak_1'              => 'nullable|string|max:255',
            'alamatpajak_2'              => 'nullable|string|max:255',
            'negara'                     => 'nullable|string|max:255',
            'provinsi_code'              => 'required|string|max:255',
            'kota_code'                  => 'required|string|max:255',
            'kecamatan_code'             => 'required|string|max:255',      
            'kelurahan_code'             => 'required|string|max:255',      
            'kode_pos'                   => 'nullable|string|max:255',
            'kontak'                     => 'nullable|string|max:255',
            'no_telp'                    => 'nullable|string|max:255',
            'no_fax'                     => 'nullable|string|max:255',
            'email'                      => 'nullable|string|max:255',
            'website'                    => 'nullable|string|max:255',
            'memo'                       => 'nullable|string|max:255',
        ];

        $message = [
            'nama.required' => 'Nama pelanggan wajib diisi',
            'nik.required' => 'NIK pelanggan wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi',
            'religion_id.required' => 'Agama wajib diisi',
            'gender_id.required' => 'Jenis kelamin wajib diisi',
            'nama_ayah.required' => 'Nama ayah wajib diisi',
            'nama_ibu.required' => 'Nama ibu wajib diisi',
            'provinsi_code.required' => 'Provinsi wajib diisi',
            'kota_code.required' => 'Kota wajib diisi',
            'kecamatan_code.required' => 'Kecamatan wajib diisi',
            'kelurahan_code.required' => 'Kelurahan wajib diisi',
            'mata_uang_id.required' => 'Mata uang wajib diisi',
            'saldo_awal.required' => 'Saldo awal pelanggan wajib diisi',
            'status_id.required' => 'Status pelanggan wajib diisi',
            'alamat_1.required' => 'Alamat pelanggan wajib diisi',
            'npwp.required' => 'NPWP wajib diisi',
            'nppkp.required' => 'NPPKP wajib diisi',
            'pajak_1_id.required' => 'Pajak 1 wajib diisi',
            'pajak_2_id.required' => 'Pajak 2 wajib diisi',
            'tipe_pelanggan_id.required' => 'Tipe pelanggan wajib diisi',
            'syarat_id.required' => 'Syarat pelanggan wajib diisi',
        ];

        for ($i = 1; $i <= 7; $i++) {
            $rules["fileupload_{$i}"] = 'nullable|string|max:255';
        }

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $pelanggan = new Pelanggan($validator->validated());
            $pelanggan->save();

            DB::commit();
            sweetalert()->success('Create new Pelanggan successfully :)');
            return redirect()->route('pelanggan/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id, $pelanggan_id)
    {
        $data = DB::table('status_pemasok')->get();
        $kota = DB::table('kota')->orderBy('nama', 'asc')->get();
        $negara = DB::table('negara')->orderBy('nama', 'asc')->get();
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $pelangganEdit = DB::table('pelanggan')->where('pelanggan_id',$pelanggan_id)->first();
        $pajak = DB::table('pajak')->orderBy('nama', 'asc')->get();
        $syarat = DB::table('syarat')->orderBy('nama', 'asc')->get();
        $tipe_pelanggan = DB::table('tipe_pelanggan')->orderBy('nama', 'asc')->get();
        $level_harga = DB::table('level_harga')->orderBy('nama', 'asc')->get();
        $agama = DB::table('religion')->orderBy('nama', 'asc')->get();
        $gender = DB::table('gender')->orderBy('nama', 'asc')->get();
        $Pelanggan = Pelanggan::findOrFail($id);
        if (!$Pelanggan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        $provinsi = Province::orderBy('name')->get(['code','name']);
        $citySelected     = $Pelanggan->kota_code ? City::where('code', $Pelanggan->kota_code)->first(['code','name']) : null;
        $districtSelected = $Pelanggan->kecamatan_code ? District::where('code', $Pelanggan->kecamatan_code)->first(['code','name']) : null;
        $villageSelected  = $Pelanggan->kelurahan_code ? Village::where('code', $Pelanggan->kelurahan_code)->first(['code','name']) : null;
        return view('pelanggan.pelangganedit', compact('Pelanggan','pelangganEdit','data','provinsi','kota','negara','mata_uang','pajak','syarat','tipe_pelanggan','level_harga','agama','gender'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nama'                       => 'required|string|max:255',
            'nik'                        => 'required|string|max:255',
            'tanggal_lahir'              => 'required|string|max:255',
            'tempat_lahir'               => 'required|string|max:255',
            'religion_id'                => 'required|string|max:255',
            'gender_id'                  => 'required|string|max:255',
            'nama_ayah'                  => 'required|string|max:255',
            'nama_ibu'                   => 'required|string|max:255',
            'npwp'                       => 'required|string|max:255',
            'nppkp'                      => 'required|string|max:255',
            'pajak_1_id'                 => 'required|string|max:255',
            'pajak_2_id'                 => 'required|string|max:255',
            'penjual_id'                 => 'nullable|string|max:255',
            'tipe_pelanggan_id'          => 'required|string|max:255',
            'level_harga'                => 'nullable|string|max:255',
            'diskon_penjualan_pelanggan' => 'nullable|string|max:255',
            'syarat_id'                  => 'required|string|max:255',
            'batas_maks_hutang'          => 'nullable|string|max:255',
            'batas_umur_hutang'          => 'nullable|string|max:255',
            'mata_uang_id'               => 'required|string|max:255',
            'saldo_awal'                 => 'required|string|max:255',
            'tanggal_pelanggan'          => 'nullable|string|max:255',
            'deskripsi'                  => 'nullable|string|max:255',
            'status_id'                  => 'required|string|max:255',
            'dihentikan'                 => 'nullable|boolean',
            'alamat_1'                   => 'required|string|max:255',
            'alamat_2'                   => 'nullable|string|max:255',
            'alamatpajak_1'              => 'nullable|string|max:255',
            'alamatpajak_2'              => 'nullable|string|max:255',
            'negara'                     => 'nullable|string|max:255',
            'provinsi_code'              => 'required|string|max:255',
            'kota_code'                  => 'required|string|max:255',
            'kecamatan_code'             => 'required|string|max:255',      
            'kelurahan_code'             => 'required|string|max:255',      
            'kode_pos'                   => 'nullable|string|max:255',
            'kontak'                     => 'nullable|string|max:255',
            'no_telp'                    => 'nullable|string|max:255',
            'no_fax'                     => 'nullable|string|max:255',
            'email'                      => 'nullable|string|max:255',
            'website'                    => 'nullable|string|max:255',
            'memo'                       => 'nullable|string|max:255',
        ];

        $message = [
            'nama.required' => 'Nama pelanggan wajib diisi',
            'nik.required' => 'NIK pelanggan wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi',
            'religion_id.required' => 'Agama wajib diisi',
            'gender_id.required' => 'Jenis kelamin wajib diisi',
            'nama_ayah.required' => 'Nama ayah wajib diisi',
            'nama_ibu.required' => 'Nama ibu wajib diisi',
            'provinsi_code.required' => 'Provinsi wajib diisi',
            'kota_code.required' => 'Kota wajib diisi',
            'kecamatan_code.required' => 'Kecamatan wajib diisi',
            'kelurahan_code.required' => 'Kelurahan wajib diisi',
            'mata_uang_id.required' => 'Mata uang wajib diisi',
            'saldo_awal.required' => 'Saldo awal pelanggan wajib diisi',
            'status_id.required' => 'Status pelanggan wajib diisi',
            'alamat_1.required' => 'Alamat pelanggan wajib diisi',
            'npwp.required' => 'NPWP wajib diisi',
            'nppkp.required' => 'NPPKP wajib diisi',
            'pajak_1_id.required' => 'Pajak 1 wajib diisi',
            'pajak_2_id.required' => 'Pajak 2 wajib diisi',
            'tipe_pelanggan_id.required' => 'Tipe pelanggan wajib diisi',
            'syarat_id.required' => 'Syarat pelanggan wajib diisi',
        ];

        for ($i = 1; $i <= 7; $i++) {
            $rules["fileupload_{$i}"] = 'nullable|string|max:255';
        }

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $Pelanggan = Pelanggan::findOrFail($id);
            $Pelanggan->fill($validator->validated());
            $Pelanggan->save();

            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('pelanggan/list/page');

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
        $length         = $request->get("length");
        $columnIndex_arr    = $request->get('order');
        $columnName_arr     = $request->get('columns');
        $order_arr          = $request->get('order');
        $namaFilter         = $request->get('nama');
        $pelangganIdFilter  = $request->get('pelanggan_id');
        $pelangganMataUangFilter  = $request->get('mata_uang_id');
        $pelangganTipePelangganFilter  = $request->get('tipe_pelanggan_id');
        $pelangganDihentikanFilter  = $request->get('dihentikan');

        $columnIndex     = $columnIndex_arr[0]['column'];
        $columnName      = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];

        $query = Pelanggan::with(['tipePelanggan', 'mataUang']);
        $totalRecords = Pelanggan::count();

        if ($namaFilter) {
            $query->where('nama', 'like', '%' . $namaFilter . '%');
        }

        if ($pelangganIdFilter) {
            $query->where('pelanggan_id', 'like', '%' . $pelangganIdFilter . '%');
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

        // $records = $query
        //     ->orderBy($columnName, $columnSortOrder)
        //     ->skip($start)
        //     ->take($length)
        //     ->get();

        $tableName  = (new Pelanggan)->getTable();
        $cols       = Schema::getColumnListing($tableName);
        $sortColumn = in_array($columnName, $cols, true) ? $columnName : 'id';
        $sortDir    = strtolower($columnSortOrder) === 'desc' ? 'desc' : 'asc';

        $records = $query->orderBy($sortColumn, $sortDir)->skip($start)->take($length)->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="pelanggan_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"       => $checkbox,
                "no"             => $start + $key + 1,
                "id"             => $record->id,
                "pelanggan_id"   => $record->pelanggan_id,
                "nama" => $record->nama,
                'alamat_1'       => $record->alamat_1,
                'alamat_2'       => $record->alamat_2,
                'kontak'         => $record->kontak,
                'no_telp'        => $record->no_telp,
                'mata_uang_id' => $record->mata_uang_id,
                'mata_uang'      => $record->mataUang?->nama,
                'tipe_pelanggan_id' => $record->tipe_pelanggan_id,
                'tipe_pelanggan' => $record->tipePelanggan?->nama,
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
