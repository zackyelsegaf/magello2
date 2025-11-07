<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsumen;
use App\Models\Cluster;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
use App\Models\Village;
use App\Models\KonsumenDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;


class KonsumenController extends Controller
{
    public function daftarKonsumen()
    {
        return view('marketing.konsumen.datakonsumen');
    }

    public function tambahKonsumen()
    {
        $data_jenis_kelamin = DB::table('gender')->get();
        $data_pekerjaan = DB::table('tipe_pelanggan')->get();
        $data_cluster = DB::table('cluster')->get();
        $kapling = DB::table('kapling')->get();
        $pajak = DB::table('pajak')->get();
        $syarat = DB::table('syarat')->get();
        $golongan_darah = DB::table('golongan_darah')->get();
        $level_harga = DB::table('level_harga')->get();
        $agama = DB::table('religion')->get();
        $status_pernikahan = DB::table('status_pemasok')->get();
        $data_status_pengajuan = DB::table('status_pengajuan')->get();
        $provinces = Province::orderBy('name')->get(['code','name']);
        $kota = DB::table('kota')
            ->select('id', 'nama')
            ->union(
                DB::table('provinsi')->select('id', 'nama')
            )
            ->orderBy('nama')
            ->get();
        return view('marketing.konsumen.konsumenaddnew', compact('kota', 'provinces', 'kapling', 'data_jenis_kelamin', 'data_pekerjaan', 'data_cluster', 'data_status_pengajuan','golongan_darah','syarat','agama','pajak','level_harga','status_pernikahan'));
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

    public function citiesByProvince_1(Request $request)
    {
        $request->validate([
            'provinsi_code_1' => 'required|string|size:2',
        ]);

        $cities = City::where('province_code', $request->provinsi_code_1)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($cities);
    }
    
    public function citiesByProvince_2(Request $request)
    {
        $request->validate([
            'provinsi_code_2' => 'required|string|size:2',
        ]);

        $cities = City::where('province_code', $request->provinsi_code_2)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($cities);
    }

    public function citiesByProvince_3(Request $request)
    {
        $request->validate([
            'provinsi_code_3' => 'required|string|size:2',
        ]);

        $cities = City::where('province_code', $request->provinsi_code_3)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($cities);
    }

    public function citiesByProvince_4(Request $request)
    {
        $request->validate([
            'provinsi_code_4' => 'required|string|size:2',
        ]);

        $cities = City::where('province_code', $request->provinsi_code_4)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($cities);
    }

    public function citiesByProvince_5(Request $request)
    {
        $request->validate([
            'provinsi_code_5' => 'required|string|size:2',
        ]);

        $cities = City::where('province_code', $request->provinsi_code_5)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($cities);
    }

    public function citiesByProvince_6(Request $request)
    {
        $request->validate([
            'provinsi_code_6' => 'required|string|size:2',
        ]);

        $cities = City::where('province_code', $request->provinsi_code_6)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($cities);
    }

    public function citiesByProvince_7(Request $request)
    {
        $request->validate([
            'provinsi_code_7' => 'required|string|size:2',
        ]);

        $cities = City::where('province_code', $request->provinsi_code_7)
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
    
    public function districtsByCity_1(Request $request)
    {
        $request->validate([
            'kota_code_1' => 'required|string|size:4',
        ]);

        $districts = District::where('city_code', $request->kota_code_1)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($districts);
    }

    public function districtsByCity_2(Request $request)
    {
        $request->validate([
            'kota_code_2' => 'required|string|size:4',
        ]);

        $districts = District::where('city_code', $request->kota_code_2)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($districts);
    }

    public function districtsByCity_3(Request $request)
    {
        $request->validate([
            'kota_code_3' => 'required|string|size:4',
        ]);

        $districts = District::where('city_code', $request->kota_code_3)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($districts);
    }

    public function districtsByCity_4(Request $request)
    {
        $request->validate([
            'kota_code_4' => 'required|string|size:4',
        ]);

        $districts = District::where('city_code', $request->kota_code_4)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($districts);
    }

    public function districtsByCity_5(Request $request)
    {
        $request->validate([
            'kota_code_5' => 'required|string|size:4',
        ]);

        $districts = District::where('city_code', $request->kota_code_5)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($districts);
    }

    public function districtsByCity_6(Request $request)
    {
        $request->validate([
            'kota_code_6' => 'required|string|size:4',
        ]);

        $districts = District::where('city_code', $request->kota_code_6)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($districts);
    }

    public function districtsByCity_7(Request $request)
    {
        $request->validate([
            'kota_code_7' => 'required|string|size:4',
        ]);

        $districts = District::where('city_code', $request->kota_code_7)
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

    public function villagesByDistrict_1(Request $request)
    {
        $request->validate([
            'kecamatan_code_1' => 'required|string|size:6',
        ]);

        $villages = Village::where('district_code', $request->kecamatan_code_1)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($villages);
    }

    public function villagesByDistrict_2(Request $request)
    {
        $request->validate([
            'kecamatan_code_2' => 'required|string|size:6',
        ]);

        $villages = Village::where('district_code', $request->kecamatan_code_2)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($villages);
    }

    public function villagesByDistrict_3(Request $request)
    {
        $request->validate([
            'kecamatan_code_3' => 'required|string|size:6',
        ]);

        $villages = Village::where('district_code', $request->kecamatan_code_3)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($villages);
    }

    public function villagesByDistrict_4(Request $request)
    {
        $request->validate([
            'kecamatan_code_4' => 'required|string|size:6',
        ]);

        $villages = Village::where('district_code', $request->kecamatan_code_4)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($villages);
    }

    public function villagesByDistrict_5(Request $request)
    {
        $request->validate([
            'kecamatan_code_5' => 'required|string|size:6',
        ]);

        $villages = Village::where('district_code', $request->kecamatan_code_5)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($villages);
    }

    public function villagesByDistrict_6(Request $request)
    {
        $request->validate([
            'kecamatan_code_6' => 'required|string|size:6',
        ]);

        $villages = Village::where('district_code', $request->kecamatan_code_6)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($villages);
    }

    public function villagesByDistrict_7(Request $request)
    {
        $request->validate([
            'kecamatan_code_7' => 'required|string|size:6',
        ]);

        $villages = Village::where('district_code', $request->kecamatan_code_7)
            ->orderBy('name')
            ->get(['code','name']);

        return response()->json($villages);
    }

    public function simpanKonsumen(Request $request){

        $rules = [
            'nama_1'                     => 'required|string|max:255',
            'nik_1'                      => 'required|string|max:255',
            'tempat_lahir_1'             => 'nullable|string|max:255',
            'tanggal_lahir_1'            => 'nullable|string|max:255',
            'no_hp_1'                    => 'required|string|max:255',
            'npwp_1'                     => 'nullable|string|max:255',
            'status_pengajuan_id'        => 'required|string|max:255',
            'jenis_kelamin_id'           => 'required|string|max:255',
            'cluster_id'                 => 'required|string|max:255',
            'provinsi_code'              => 'required|string|max:255',
            'kota_code'                  => 'required|string|max:255',
            'kecamatan_code'             => 'nullable|string|max:255',
            'kelurahan_code'             => 'nullable|string|max:255',
            'alamat_konsumen'            => 'required|string|max:255',
            'provinsi_code_1'            => 'nullable|string|max:255',
            'kota_code_1'                => 'nullable|string|max:255',
            'kecamatan_code_1'           => 'nullable|string|max:255',
            'kelurahan_code_1'           => 'nullable|string|max:255',
            'alamat_1'                   => 'nullable|string|max:255',
            'pekerjaan_1_id'             => 'required|string|max:255',
            'marketing'                  => 'required|string|max:255',
            'email'                      => 'required|string|max:255',
            'tanggal_booking'            => 'nullable|string|max:255',
            'booking_fee'                => 'nullable|string|max:255',
            'pajak_1_id'                 => 'nullable|string|max:255',
            'pajak_2_id'                 => 'nullable|string|max:255',
            'syarat_id'                  => 'nullable|string|max:255',
            'level_harga_id'             => 'nullable|string|max:255',
            'religion_id'                => 'required|string|max:255',
            'status_pernikahan_id'       => 'required|string|max:255',
            'nppkp_konsumen'             => 'nullable|string|max:255',
            'nama_ayah'                  => 'nullable|string|max:255',
            'nama_ibu'                   => 'nullable|string|max:255',
            'batas_maks_hutang'          => 'nullable|string|max:255',
            'batas_umur_hutang'          => 'nullable|string|max:255',
            'diskon_penjualan'           => 'nullable|string|max:255',
            'alamat_pajak_1'             => 'nullable|string|max:255',
            'alamat_pajak_2'             => 'nullable|string|max:255',
            'konsumen_id'                => 'nullable|string|max:255',
            'pekerjaan_2_id'             => 'nullable|string|max:255',
            'nama_2'                     => 'nullable|string|max:255',
            'nik_2'                      => 'nullable|string|max:255',
            'no_hp_2'                    => 'nullable|string|max:255',
            'tempat_lahir_2'             => 'nullable|string|max:255',
            'tanggal_lahir_2'            => 'nullable|string|max:255',
            'npwp_2'                     => 'nullable|string|max:255',
            'provinsi_code_2'            => 'nullable|string|max:255',
            'kota_code_2'                => 'nullable|string|max:255',
            'kecamatan_code_2'           => 'nullable|string|max:255',
            'kelurahan_code_2'           => 'nullable|string|max:255',
            'alamat_2'                   => 'nullable|string|max:255',
            'provinsi_code_3'            => 'nullable|string|max:255',
            'kota_code_3'                => 'nullable|string|max:255',
            'kecamatan_code_3'           => 'nullable|string|max:255',
            'kelurahan_code_3'           => 'nullable|string|max:255',
            'alamat_3'                   => 'nullable|string|max:255',
            'provinsi_code_4'            => 'nullable|string|max:255',
            'kota_code_4'                => 'nullable|string|max:255',
            'kecamatan_code_4'           => 'nullable|string|max:255',
            'kelurahan_code_4'           => 'nullable|string|max:255',
            'alamat_4'                   => 'nullable|string|max:255',
            'provinsi_code_5'            => 'nullable|string|max:255',
            'kota_code_5'                => 'nullable|string|max:255',
            'kecamatan_code_5'           => 'nullable|string|max:255',
            'kelurahan_code_5'           => 'nullable|string|max:255',
            'alamat_5'                   => 'nullable|string|max:255',
            'provinsi_code_6'            => 'nullable|string|max:255',
            'kota_code_6'                => 'nullable|string|max:255',
            'kecamatan_code_6'           => 'nullable|string|max:255',
            'kelurahan_code_6'           => 'nullable|string|max:255',
            'alamat_6'                   => 'nullable|string|max:255',
            'provinsi_code_7'            => 'nullable|string|max:255',
            'kota_code_7'                => 'nullable|string|max:255',
            'kecamatan_code_7'           => 'nullable|string|max:255',
            'kelurahan_code_7'           => 'nullable|string|max:255',
            'alamat_7'                   => 'nullable|string|max:255',
            'nama_perusahaan_1'          => 'nullable|string|max:255',
            'bidang_usaha_1'             => 'nullable|string|max:255',
            'jabatan_1'                  => 'nullable|string|max:255',
            'status_pekerjaan_1'         => 'nullable|string|max:255',
            'tanggal_mulai_kerja_1'      => 'nullable|string|max:255',
            'gaji_pokok_1'               => 'nullable|string|max:255',
            'cycle_gaji_pokok_1'         => 'nullable|string|max:255',
            'gaji_tambahan_1'            => 'nullable|string|max:255',
            'daftar_cicilan_1'           => 'nullable|string|max:255',
            'nama_usaha_1'               => 'nullable|string|max:255',
            'bidang_wirausaha_1'         => 'nullable|string|max:255',
            'lama_usaha_1'               => 'nullable|string|max:255',
            'legalitas_1'                => 'nullable|string|max:255',
            'pendapatan_kotor_1'         => 'nullable|string|max:255',
            'pendapatan_bersih_1'        => 'nullable|string|max:255',
            'pendapatan_tambahan_1'      => 'nullable|string|max:255',
            'daftar_cicilan_wirausaha_1' => 'nullable|string|max:255',
            'nama_perusahaan_2'          => 'nullable|string|max:255',
            'bidang_usaha_2'             => 'nullable|string|max:255',
            'jabatan_2'                  => 'nullable|string|max:255',
            'status_pekerjaan_2'         => 'nullable|string|max:255',
            'tanggal_mulai_kerja_2'      => 'nullable|string|max:255',
            'gaji_pokok_2'               => 'nullable|string|max:255',
            'cycle_gaji_pokok_2'         => 'nullable|string|max:255',
            'gaji_tambahan_2'            => 'nullable|string|max:255',
            'daftar_cicilan_2'           => 'nullable|string|max:255',
            'nama_usaha_2'               => 'nullable|string|max:255',
            'bidang_wirausaha_2'         => 'nullable|string|max:255',
            'lama_usaha_2'               => 'nullable|string|max:255',
            'legalitas_2'                => 'nullable|string|max:255',
            'pendapatan_kotor_2'         => 'nullable|string|max:255',
            'pendapatan_bersih_2'        => 'nullable|string|max:255',
            'pendapatan_tambahan_2'      => 'nullable|string|max:255',
            'daftar_cicilan_wirausaha_2' => 'nullable|string|max:255',
        ];

        $message = [
            'nama_1.required' => 'Nama konsumen wajib diisi',
            'nik_1.required' => 'NIK konsumen wajib diisi',
            'religion_id.required' => 'Agama wajib diisi',
            'status_pernikahan_id.required' => 'Status pernikahan wajib diisi',
            'no_hp_1.required' => 'No HP wajib diisi',
            'status_pengajuan_id.required' => 'Status pengajuan wajib diisi',
            'jenis_kelamin_id.required' => 'Jenis kelamin wajib diisi',
            'cluster_id.required' => 'Cluster wajib diisi',
            'provinsi_code.required' => 'Provinsi wajib diisi',
            'kota_code.required' => 'Kota wajib diisi',
            'email.required' => 'Email wajib diisi',
            'pekerjaan_1_id.required' => 'Pekerjaan wajib diisi',
            'marketing.required' => 'Marketing wajib diisi',
            'alamat_konsumen.required' => 'Alamat konsumen wajib diisi',

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

            $konsumen = new Konsumen($validator->validated());
            $konsumen->save();

            $detail = new KonsumenDetail();
            $detail->konsumen_id                = $konsumen->id;
            $detail->pekerjaan_2_id             = $request->pekerjaan_2_id;
            $detail->nama_2                     = $request->nama_2;
            $detail->nik_2                      = $request->nik_2;
            $detail->no_hp_2                    = $request->no_hp_2;
            $detail->tempat_lahir_2             = $request->tempat_lahir_2;
            $detail->tanggal_lahir_2            = $request->tanggal_lahir_2;
            $detail->npwp_2                     = $request->npwp_2;
            $detail->provinsi_code_2            = $request->provinsi_code_2;
            $detail->kota_code_2                = $request->kota_code_2;
            $detail->kecamatan_code_2           = $request->kecamatan_code_2;
            $detail->kelurahan_code_2           = $request->kelurahan_code_2;
            $detail->alamat_2                   = $request->alamat_2;
            $detail->provinsi_code_3            = $request->provinsi_code_3;
            $detail->kota_code_3                = $request->kota_code_3;
            $detail->kecamatan_code_3           = $request->kecamatan_code_3;
            $detail->kelurahan_code_3           = $request->kelurahan_code_3;
            $detail->alamat_3                   = $request->alamat_3;
            $detail->provinsi_code_4            = $request->provinsi_code_4;
            $detail->kota_code_4                = $request->kota_code_4;
            $detail->kecamatan_code_4           = $request->kecamatan_code_4;
            $detail->kelurahan_code_4           = $request->kelurahan_code_4;
            $detail->alamat_4                   = $request->alamat_4;
            $detail->provinsi_code_5            = $request->provinsi_code_5;
            $detail->kota_code_5                = $request->kota_code_5;
            $detail->kecamatan_code_5           = $request->kecamatan_code_5;
            $detail->kelurahan_code_5           = $request->kelurahan_code_5;
            $detail->alamat_5                   = $request->alamat_5;
            $detail->provinsi_code_6            = $request->provinsi_code_6;
            $detail->kota_code_6                = $request->kota_code_6;
            $detail->kecamatan_code_6           = $request->kecamatan_code_6;
            $detail->kelurahan_code_6           = $request->kelurahan_code_6;
            $detail->alamat_6                   = $request->alamat_6;
            $detail->provinsi_code_7            = $request->provinsi_code_7;
            $detail->kota_code_7                = $request->kota_code_7;
            $detail->kecamatan_code_7           = $request->kecamatan_code_7;
            $detail->kelurahan_code_7           = $request->kelurahan_code_7;
            $detail->alamat_7                   = $request->alamat_7;
            $detail->nama_perusahaan_1          = $request->nama_perusahaan_1;
            $detail->bidang_usaha_1             = $request->bidang_usaha_1;
            $detail->jabatan_1                  = $request->jabatan_1;
            $detail->status_pekerjaan_1         = $request->status_pekerjaan_1;
            $detail->tanggal_mulai_kerja_1      = $request->tanggal_mulai_kerja_1;
            $detail->gaji_pokok_1               = $request->gaji_pokok_1;
            $detail->cycle_gaji_pokok_1         = $request->cycle_gaji_pokok_1;
            $detail->gaji_tambahan_1            = $request->gaji_tambahan_1;
            $detail->daftar_cicilan_1           = $request->daftar_cicilan_1;
            $detail->nama_usaha_1               = $request->nama_usaha_1;
            $detail->bidang_wirausaha_1         = $request->bidang_wirausaha_1;
            $detail->lama_usaha_1               = $request->lama_usaha_1;
            $detail->legalitas_1                = $request->legalitas_1;
            $detail->pendapatan_kotor_1         = $request->pendapatan_kotor_1;
            $detail->pendapatan_bersih_1        = $request->pendapatan_bersih_1;
            $detail->pendapatan_tambahan_1      = $request->pendapatan_tambahan_1;
            $detail->daftar_cicilan_wirausaha_1 = $request->daftar_cicilan_wirausaha_1;
            $detail->nama_perusahaan_2          = $request->nama_perusahaan_2;
            $detail->bidang_usaha_2             = $request->bidang_usaha_2;
            $detail->jabatan_2                  = $request->jabatan_2;
            $detail->status_pekerjaan_2         = $request->status_pekerjaan_2;
            $detail->tanggal_mulai_kerja_2      = $request->tanggal_mulai_kerja_2;
            $detail->gaji_pokok_2               = $request->gaji_pokok_2;
            $detail->cycle_gaji_pokok_2         = $request->cycle_gaji_pokok_2;
            $detail->gaji_tambahan_2            = $request->gaji_tambahan_2;
            $detail->daftar_cicilan_2           = $request->daftar_cicilan_2;
            $detail->nama_usaha_2               = $request->nama_usaha_2;
            $detail->bidang_wirausaha_2         = $request->bidang_wirausaha_2;
            $detail->lama_usaha_2               = $request->lama_usaha_2;
            $detail->legalitas_2                = $request->legalitas_2;
            $detail->pendapatan_kotor_2         = $request->pendapatan_kotor_2;
            $detail->pendapatan_bersih_2        = $request->pendapatan_bersih_2;
            $detail->pendapatan_tambahan_2      = $request->pendapatan_tambahan_2;
            $detail->daftar_cicilan_wirausaha_2 = $request->daftar_cicilan_wirausaha_2;
            $detail->save();

            DB::commit();
            sweetalert()->success('Create new cluster successfully :)');
            return redirect()->route('konsumen/list/page');

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function editKonsumen($id)
    {
        $data_jenis_kelamin = DB::table('gender')->get();
        $data_pekerjaan = DB::table('tipe_pelanggan')->get();
        $data_cluster = DB::table('cluster')->get();
        $kapling = DB::table('kapling')->get();
        $pajak = DB::table('pajak')->get();
        $syarat = DB::table('syarat')->get();
        $golongan_darah = DB::table('golongan_darah')->get();
        $level_harga = DB::table('level_harga')->get();
        $agama = DB::table('religion')->get();
        $status_pernikahan = DB::table('status_pemasok')->get();
        $data_status_pengajuan = DB::table('status_pengajuan')->get();
        $Konsumen = Konsumen::findOrFail($id);
        if (!$Konsumen) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        $provinces = Province::orderBy('name')->get(['code','name']);
        $citySelected     = $Konsumen->kota ? City::where('code', $Konsumen->kota)->first(['code','name']) : null;
        $districtSelected = $Konsumen->kecamatan ? District::where('code', $Konsumen->kecamatan)->first(['code','name']) : null;
        $villageSelected  = $Konsumen->kelurahan ? Village::where('code', $Konsumen->kelurahan)->first(['code','name']) : null;
        return view('marketing.konsumen.ubahkonsumen', compact('Konsumen','provinces','citySelected', 'districtSelected', 'villageSelected', 'kapling', 'data_jenis_kelamin', 'data_pekerjaan', 'data_cluster', 'data_status_pengajuan','golongan_darah','syarat','agama','pajak','level_harga','status_pernikahan'));
    }

    public function konsumenDetail($id)
    {
        $konsumen = Konsumen::with([
            'gender:id,nama',
            'status_pengajuan:id,nama',
            'province:code,name',
            'city:code,name',
            'district:code,name',
            'village:code,name',
            'pekerjaan:id,nama',
            'pekerjaan_2:id,nama',
            'cluster:id,nama_cluster',
            'detail.province2:code,name',
            'detail.city2:code,name',
            'detail.district2:code,name',
            'detail.village2:code,name',
            'detail.province2:code,name',
            'detail.city2:code,name',
            'detail.district2:code,name',
            'detail.village2:code,name',
        ])->findOrFail($id);

        return view('marketing.konsumen.detailkonsumen', compact('konsumen'));
    }

    // public function konsumenDetail($id)
    // {
    //     $Konsumen = Konsumen::with([
    //         'konsumen:id,jenis_kelamin_id,cluster_id,status_pengajuan_id,provinsi_code,kota_code,kelurahan_code,kecamatan_code,pekerjaan_1_id,nama_konsumen,nik_konsumen,no_hp,alamat_konsumen,booking_fee',
    //         'konsumen.gender:id,nama',
    //         'konsumen.status_pengajuan:id,nama',
    //         'konsumen.province:code,name',
    //         'konsumen.city:code,name',
    //         'konsumen.district:code,name',
    //         'konsumen.village:code,name',
    //         'konsumen.pekerjaan:id,nama',
    //         'konsumen.cluster:id,nama_cluster',
    //     ])->findOrFail($id);

    //     if (!$Konsumen) {
    //         return redirect()->back()->with('error', 'Data tidak ditemukan');
    //     }

    //     $provinceSelected = $Konsumen->provinsi_code  ? Province::find($Konsumen->provinsi_code, ['name']) : null;
    //     $citySelected     = $Konsumen->kota_code      ? City::find($Konsumen->kota_code, ['name']) : null;
    //     $districtSelected = $Konsumen->kecamatan_code ? District::find($Konsumen->kecamatan_code, ['code','name']) : null;
    //     $villageSelected  = $Konsumen->kelurahan_code ? Village::find($Konsumen->kelurahan_code, ['code','name']) : null;
    //     return view('marketing.konsumen.detailkonsumen', compact('Konsumen','provinceSelected','citySelected', 'districtSelected', 'villageSelected'));
    // }

    public function cetakKonsumen($id)
    {
        $konsumen = Konsumen::with([
            'gender:id,nama',
            'status_pengajuan:id,nama',
            'province:code,name',
            'city:code,name',
            'district:code,name',
            'village:code,name',
            'pekerjaan:id,nama',
            'pekerjaan_2:id,nama',
            'cluster:id,nama_cluster',
            'detail.province2:code,name',
            'detail.city2:code,name',
            'detail.district2:code,name',
            'detail.village2:code,name',
            'detail.province2:code,name',
            'detail.city2:code,name',
            'detail.district2:code,name',
            'detail.village2:code,name',
        ])->findOrFail($id)->fresh();

        $pdf = Pdf::loadView('marketing.konsumen.konsumenpdf', compact('konsumen'))->setPaper('A4','portrait');

        return $pdf->stream('Detail Konsumen '.$konsumen->nama_1.'.pdf');
    }

    public function updateKonsumen(Request $request, $id)
    {
        $rules = [
            'nama_1'                     => 'required|string|max:255',
            'nik_1'                      => 'required|string|max:255',
            'tempat_lahir_1'             => 'nullable|string|max:255',
            'tanggal_lahir_1'            => 'nullable|string|max:255',
            'no_hp_1'                    => 'required|string|max:255',
            'npwp_1'                     => 'nullable|string|max:255',
            'status_pengajuan_id'        => 'required|string|max:255',
            'jenis_kelamin_id'           => 'required|string|max:255',
            'cluster_id'                 => 'required|string|max:255',
            'provinsi_code'              => 'required|string|max:255',
            'kota_code'                  => 'required|string|max:255',
            'kecamatan_code'             => 'nullable|string|max:255',
            'kelurahan_code'             => 'nullable|string|max:255',
            'alamat_konsumen'            => 'required|string|max:255',
            'provinsi_code_1'            => 'nullable|string|max:255',
            'kota_code_1'                => 'nullable|string|max:255',
            'kecamatan_code_1'           => 'nullable|string|max:255',
            'kelurahan_code_1'           => 'nullable|string|max:255',
            'alamat_1'                   => 'nullable|string|max:255',
            'pekerjaan_1_id'             => 'required|string|max:255',
            'marketing'                  => 'required|string|max:255',
            'email'                      => 'required|string|max:255',
            'tanggal_booking'            => 'nullable|string|max:255',
            'booking_fee'                => 'nullable|string|max:255',
            'pajak_1_id'                 => 'nullable|string|max:255',
            'pajak_2_id'                 => 'nullable|string|max:255',
            'syarat_id'                  => 'nullable|string|max:255',
            'level_harga_id'             => 'nullable|string|max:255',
            'religion_id'                => 'nullable|string|max:255',
            'status_pernikahan_id'       => 'nullable|string|max:255',
            'nppkp_konsumen'             => 'nullable|string|max:255',
            'nama_ayah'                  => 'nullable|string|max:255',
            'nama_ibu'                   => 'nullable|string|max:255',
            'batas_maks_hutang'          => 'nullable|string|max:255',
            'batas_umur_hutang'          => 'nullable|string|max:255',
            'diskon_penjualan'           => 'nullable|string|max:255',
            'alamat_pajak_1'             => 'nullable|string|max:255',
            'alamat_pajak_2'             => 'nullable|string|max:255',
            'konsumen_id'                => 'nullable|string|max:255',
            'pekerjaan_2_id'             => 'nullable|string|max:255',
            'nama_2'                     => 'nullable|string|max:255',
            'nik_2'                      => 'nullable|string|max:255',
            'no_hp_2'                    => 'nullable|string|max:255',
            'tempat_lahir_2'             => 'nullable|string|max:255',
            'tanggal_lahir_2'            => 'nullable|string|max:255',
            'npwp_2'                     => 'nullable|string|max:255',
            'provinsi_code_2'            => 'nullable|string|max:255',
            'kota_code_2'                => 'nullable|string|max:255',
            'kecamatan_code_2'           => 'nullable|string|max:255',
            'kelurahan_code_2'           => 'nullable|string|max:255',
            'alamat_2'                   => 'nullable|string|max:255',
            'provinsi_code_3'            => 'nullable|string|max:255',
            'kota_code_3'                => 'nullable|string|max:255',
            'kecamatan_code_3'           => 'nullable|string|max:255',
            'kelurahan_code_3'           => 'nullable|string|max:255',
            'alamat_3'                   => 'nullable|string|max:255',
            'provinsi_code_4'            => 'nullable|string|max:255',
            'kota_code_4'                => 'nullable|string|max:255',
            'kecamatan_code_4'           => 'nullable|string|max:255',
            'kelurahan_code_4'           => 'nullable|string|max:255',
            'alamat_4'                   => 'nullable|string|max:255',
            'provinsi_code_5'            => 'nullable|string|max:255',
            'kota_code_5'                => 'nullable|string|max:255',
            'kecamatan_code_5'           => 'nullable|string|max:255',
            'kelurahan_code_5'           => 'nullable|string|max:255',
            'alamat_5'                   => 'nullable|string|max:255',
            'provinsi_code_6'            => 'nullable|string|max:255',
            'kota_code_6'                => 'nullable|string|max:255',
            'kecamatan_code_6'           => 'nullable|string|max:255',
            'kelurahan_code_6'           => 'nullable|string|max:255',
            'alamat_6'                   => 'nullable|string|max:255',
            'provinsi_code_7'            => 'nullable|string|max:255',
            'kota_code_7'                => 'nullable|string|max:255',
            'kecamatan_code_7'           => 'nullable|string|max:255',
            'kelurahan_code_7'           => 'nullable|string|max:255',
            'alamat_7'                   => 'nullable|string|max:255',
            'nama_perusahaan_1'          => 'nullable|string|max:255',
            'bidang_usaha_1'             => 'nullable|string|max:255',
            'jabatan_1'                  => 'nullable|string|max:255',
            'status_pekerjaan_1'         => 'nullable|string|max:255',
            'tanggal_mulai_kerja_1'      => 'nullable|string|max:255',
            'gaji_pokok_1'               => 'nullable|string|max:255',
            'cycle_gaji_pokok_1'         => 'nullable|string|max:255',
            'gaji_tambahan_1'            => 'nullable|string|max:255',
            'daftar_cicilan_1'           => 'nullable|string|max:255',
            'nama_usaha_1'               => 'nullable|string|max:255',
            'bidang_wirausaha_1'         => 'nullable|string|max:255',
            'lama_usaha_1'               => 'nullable|string|max:255',
            'legalitas_1'                => 'nullable|string|max:255',
            'pendapatan_kotor_1'         => 'nullable|string|max:255',
            'pendapatan_bersih_1'        => 'nullable|string|max:255',
            'pendapatan_tambahan_1'      => 'nullable|string|max:255',
            'daftar_cicilan_wirausaha_1' => 'nullable|string|max:255',
            'nama_perusahaan_2'          => 'nullable|string|max:255',
            'bidang_usaha_2'             => 'nullable|string|max:255',
            'jabatan_2'                  => 'nullable|string|max:255',
            'status_pekerjaan_2'         => 'nullable|string|max:255',
            'tanggal_mulai_kerja_2'      => 'nullable|string|max:255',
            'gaji_pokok_2'               => 'nullable|string|max:255',
            'cycle_gaji_pokok_2'         => 'nullable|string|max:255',
            'gaji_tambahan_2'            => 'nullable|string|max:255',
            'daftar_cicilan_2'           => 'nullable|string|max:255',
            'nama_usaha_2'               => 'nullable|string|max:255',
            'bidang_wirausaha_2'         => 'nullable|string|max:255',
            'lama_usaha_2'               => 'nullable|string|max:255',
            'legalitas_2'                => 'nullable|string|max:255',
            'pendapatan_kotor_2'         => 'nullable|string|max:255',
            'pendapatan_bersih_2'        => 'nullable|string|max:255',
            'pendapatan_tambahan_2'      => 'nullable|string|max:255',
            'daftar_cicilan_wirausaha_2' => 'nullable|string|max:255',
        ];

        $message = [
            'nama_1.required' => 'Nama konsumen wajib diisi',
            'nik_1.required' => 'NIK konsumen wajib diisi',
            'religion_id.required' => 'Agama wajib diisi',
            'status_pernikahan_id.required' => 'Status pernikahan wajib diisi',
            'no_hp_1.required' => 'No HP wajib diisi',
            'status_pengajuan_id.required' => 'Status pengajuan wajib diisi',
            'jenis_kelamin_id.required' => 'Jenis kelamin wajib diisi',
            'cluster_id.required' => 'Cluster wajib diisi',
            'provinsi_code.required' => 'Provinsi wajib diisi',
            'kota_code.required' => 'Kota wajib diisi',
            'email.required' => 'Email wajib diisi',
            'pekerjaan_1_id.required' => 'Pekerjaan wajib diisi',
            'marketing.required' => 'Marketing wajib diisi',
            'alamat_konsumen.required' => 'Alamat konsumen wajib diisi',

        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $Konsumen = Konsumen::findOrFail($id);
            $Konsumen->fill($validator->validated());
            $Konsumen->save();

            KonsumenDetail::where('konsumen_id', $Konsumen->id)->delete();

            $detail = new KonsumenDetail();
            $detail->konsumen_id                = $Konsumen->id;
            $detail->pekerjaan_2_id             = $request->pekerjaan_2_id;
            $detail->nama_2                     = $request->nama_2;
            $detail->nik_2                      = $request->nik_2;
            $detail->no_hp_2                    = $request->no_hp_2;
            $detail->tempat_lahir_2             = $request->tempat_lahir_2;
            $detail->tanggal_lahir_2            = $request->tanggal_lahir_2;
            $detail->npwp_2                     = $request->npwp_2;
            $detail->provinsi_code_2            = $request->provinsi_code_2;
            $detail->kota_code_2                = $request->kota_code_2;
            $detail->kecamatan_code_2           = $request->kecamatan_code_2;
            $detail->kelurahan_code_2           = $request->kelurahan_code_2;
            $detail->alamat_2                   = $request->alamat_2;
            $detail->provinsi_code_3            = $request->provinsi_code_3;
            $detail->kota_code_3                = $request->kota_code_3;
            $detail->kecamatan_code_3           = $request->kecamatan_code_3;
            $detail->kelurahan_code_3           = $request->kelurahan_code_3;
            $detail->alamat_3                   = $request->alamat_3;
            $detail->provinsi_code_4            = $request->provinsi_code_4;
            $detail->kota_code_4                = $request->kota_code_4;
            $detail->kecamatan_code_4           = $request->kecamatan_code_4;
            $detail->kelurahan_code_4           = $request->kelurahan_code_4;
            $detail->alamat_4                   = $request->alamat_4;
            $detail->provinsi_code_5            = $request->provinsi_code_5;
            $detail->kota_code_5                = $request->kota_code_5;
            $detail->kecamatan_code_5           = $request->kecamatan_code_5;
            $detail->kelurahan_code_5           = $request->kelurahan_code_5;
            $detail->alamat_5                   = $request->alamat_5;
            $detail->provinsi_code_6            = $request->provinsi_code_6;
            $detail->kota_code_6                = $request->kota_code_6;
            $detail->kecamatan_code_6           = $request->kecamatan_code_6;
            $detail->kelurahan_code_6           = $request->kelurahan_code_6;
            $detail->alamat_6                   = $request->alamat_6;
            $detail->provinsi_code_7            = $request->provinsi_code_7;
            $detail->kota_code_7                = $request->kota_code_7;
            $detail->kecamatan_code_7           = $request->kecamatan_code_7;
            $detail->kelurahan_code_7           = $request->kelurahan_code_7;
            $detail->alamat_7                   = $request->alamat_7;
            $detail->nama_perusahaan_1          = $request->nama_perusahaan_1;
            $detail->bidang_usaha_1             = $request->bidang_usaha_1;
            $detail->jabatan_1                  = $request->jabatan_1;
            $detail->status_pekerjaan_1         = $request->status_pekerjaan_1;
            $detail->tanggal_mulai_kerja_1      = $request->tanggal_mulai_kerja_1;
            $detail->gaji_pokok_1               = $request->gaji_pokok_1;
            $detail->cycle_gaji_pokok_1         = $request->cycle_gaji_pokok_1;
            $detail->gaji_tambahan_1            = $request->gaji_tambahan_1;
            $detail->daftar_cicilan_1           = $request->daftar_cicilan_1;
            $detail->nama_usaha_1               = $request->nama_usaha_1;
            $detail->bidang_wirausaha_1         = $request->bidang_wirausaha_1;
            $detail->lama_usaha_1               = $request->lama_usaha_1;
            $detail->legalitas_1                = $request->legalitas_1;
            $detail->pendapatan_kotor_1         = $request->pendapatan_kotor_1;
            $detail->pendapatan_bersih_1        = $request->pendapatan_bersih_1;
            $detail->pendapatan_tambahan_1      = $request->pendapatan_tambahan_1;
            $detail->daftar_cicilan_wirausaha_1 = $request->daftar_cicilan_wirausaha_1;
            $detail->nama_perusahaan_2          = $request->nama_perusahaan_2;
            $detail->bidang_usaha_2             = $request->bidang_usaha_2;
            $detail->jabatan_2                  = $request->jabatan_2;
            $detail->status_pekerjaan_2         = $request->status_pekerjaan_2;
            $detail->tanggal_mulai_kerja_2      = $request->tanggal_mulai_kerja_2;
            $detail->gaji_pokok_2               = $request->gaji_pokok_2;
            $detail->cycle_gaji_pokok_2         = $request->cycle_gaji_pokok_2;
            $detail->gaji_tambahan_2            = $request->gaji_tambahan_2;
            $detail->daftar_cicilan_2           = $request->daftar_cicilan_2;
            $detail->nama_usaha_2               = $request->nama_usaha_2;
            $detail->bidang_wirausaha_2         = $request->bidang_wirausaha_2;
            $detail->lama_usaha_2               = $request->lama_usaha_2;
            $detail->legalitas_2                = $request->legalitas_2;
            $detail->pendapatan_kotor_2         = $request->pendapatan_kotor_2;
            $detail->pendapatan_bersih_2        = $request->pendapatan_bersih_2;
            $detail->pendapatan_tambahan_2      = $request->pendapatan_tambahan_2;
            $detail->daftar_cicilan_wirausaha_2 = $request->daftar_cicilan_wirausaha_2;
            $detail->save();

            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('konsumen/list/page');

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Updated record failed :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function hapusKonsumen(Request $request)
    {
        try {
            $ids = $request->ids;
            Konsumen::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('konsumen/list/page');

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function dataKonsumen(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama_konsumen');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $konsumen =  Konsumen::with(['cluster','city']);
        $totalRecords = Konsumen::count();

        if ($namaFilter) {
            $konsumen->where('nama_konsumen', 'like', '%' . $namaFilter . '%');
        }

        $totalRecordsWithFilter = $konsumen->count();

        // $records = $konsumen
        //     ->orderBy($columnName, $columnSortOrder)
        //     ->skip($start)
        //     ->take($length)
        //     ->get();

        $tableName  = (new Konsumen)->getTable();
        $cols       = Schema::getColumnListing($tableName);
        $sortColumn = in_array($columnName, $cols, true) ? $columnName : 'id';
        $sortDir    = strtolower($columnSortOrder) === 'desc' ? 'desc' : 'asc';

        $records = $konsumen->orderBy($sortColumn, $sortDir)->skip($start)->take($length)->get();

        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="konsumen_checkbox" value="'.$record->id.'">';

            $modify = '
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary buttonedit-sm konsumen-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Aksi</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="'.route('konsumen/detail', $record->id).'">
                                <div class="dropdown-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="dropdown-text">Detail Konsumen</div>
                            </a>
                        </div>
                    </div>
                </div>
            ';

            $data_arr[] = [
                "checkbox"      => $checkbox,
                "no"            => $start + $key + 1,
                "id"            => $record->id,
                "nik_1"  => $record->nik_1,
                "nama_1" => $record->nama_1,
                'no_hp_1'         => $record->no_hp_1,
                'email'      => $record->email,
                'cluster_id'    => $record->cluster_id,
                "cluster"       => $record->cluster?->nama_cluster,
                'kota_code'     => $record->kota_code,
                "kota"          => $record->city?->name,  
                'modify'        => $modify
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
