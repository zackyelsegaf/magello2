<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsumen;
use App\Models\Cluster;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
use App\Models\Village;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class KonsumenController extends Controller
{
    public function daftarKonsumen()
    {
        return view('marketing.konsumen.datakonsumen');
    }

    public function tambahKonsumen()
    {
        $data_jenis_kelamin = DB::table('gender')->orderBy('nama', 'asc')->get();
        $data_pekerjaan = DB::table('tipe_pelanggan')->orderBy('nama', 'asc')->get();
        $data_cluster = DB::table('cluster')->orderBy('nama', 'asc')->get();
        $kapling = DB::table('kapling')->get();
        $data_status_pengajuan = DB::table('status_pengajuan')->orderBy('nama', 'asc')->get();
        $provinces = Province::orderBy('name')->get(['code','name']);
        $kota = DB::table('kota')
            ->select('id', 'nama')
            ->union(
                DB::table('provinsi')->select('id', 'nama')
            )
            ->orderBy('nama')
            ->get();
        return view('marketing.konsumen.konsumenaddnew', compact('kota', 'provinces', 'kapling', 'data_jenis_kelamin', 'data_pekerjaan', 'data_cluster', 'data_status_pengajuan'));
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

    public function simpanKonsumen(Request $request){

        $rules = [
            'nama_konsumen'    => 'required|string|max:255',
            'nik_konsumen'     => 'required|string|max:255',
            'no_hp'            => 'required|string|max:255',
            'status_pengajuan_id' => 'nullable|string|max:255',
            'jenis_kelamin_id'    => 'required|string|max:255',
            'cluster_id'          => 'required|string|max:255',
            'provinsi_code'         => 'required|string|max:255',
            'kota_code'             => 'required|string|max:255',
            'kecamatan_code'        => 'required|string|max:255',
            'kelurahan_code'        => 'required|string|max:255',
            'alamat_konsumen'  => 'required|string|max:255',
            'pekerjaan_id'        => 'required|string|max:255',
            'marketing'        => 'required|string|max:255',
            'tanggal_booking'     => 'nullable|string|max:255',
            'booking_fee'      => 'nullable|string|max:255',
            'email'      => 'nullable|string|max:255',
            'nik_pasangan'     => 'nullable|string|max:255',
            'nama_pasangan'    => 'nullable|string|max:255',
            'no_hp_pasangan'   => 'nullable|string|max:255',
        ];

        $message = [
            'nama_konsumen.required' => 'Nama konsumen wajib diisi',
            'nik_konsumen.required' => 'NIK konsumen wajib diisi',
            'no_hp.required' => 'No HP wajib diisi',
            'jenis_kelamin_id.required' => 'Jenis kelamin wajib diisi',
            'cluster_id.required' => 'Cluster wajib diisi',
            'provinsi_code.required' => 'Provinsi wajib diisi',
            'kota_code.required' => 'Kota wajib diisi',
            'kecamatan_code.required' => 'Kecamatan wajib diisi',
            'kelurahan_code.required' => 'Kelurahan wajib diisi',
            'alamat_konsumen.required' => 'Alamat konsumen wajib diisi',
            'pekerjaan_id.required' => 'Pekerjaan wajib diisi',
            'marketing.required' => 'Marketing wajib diisi',
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
        $data_jenis_kelamin = DB::table('gender')->orderBy('nama', 'asc')->get();
        $data_pekerjaan = DB::table('tipe_pelanggan')->orderBy('nama', 'asc')->get();
        $data_cluster = DB::table('cluster')->orderBy('nama', 'asc')->get();
        $kapling = DB::table('kapling')->get();
        $data_status_pengajuan = DB::table('status_pengajuan')->orderBy('nama', 'asc')->get();
        $Konsumen = Konsumen::findOrFail($id);
        if (!$Konsumen) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        $provinces = Province::orderBy('name')->get(['code','name']);
        $citySelected     = $Konsumen->kota ? City::where('code', $Konsumen->kota)->first(['code','name']) : null;
        $districtSelected = $Konsumen->kecamatan ? District::where('code', $Konsumen->kecamatan)->first(['code','name']) : null;
        $villageSelected  = $Konsumen->kelurahan ? Village::where('code', $Konsumen->kelurahan)->first(['code','name']) : null;
        return view('marketing.konsumen.ubahkonsumen', compact('Konsumen','provinces','citySelected', 'districtSelected', 'villageSelected', 'kapling', 'data_jenis_kelamin', 'data_pekerjaan', 'data_cluster', 'data_status_pengajuan'));
    }

    public function konsumenDetail($id)
    {
        $Konsumen = Konsumen::with([
            'konsumen:id,jenis_kelamin_id,cluster_id,status_pengajuan_id,provinsi_code,kota_code,kelurahan_code,kecamatan_code,pekerjaan_id,nama_konsumen,nik_konsumen,no_hp,alamat_konsumen,booking_fee',
            'konsumen.gender:id,nama',
            'konsumen.status_pengajuan:id,nama',
            'konsumen.province:code,name',
            'konsumen.city:code,name',
            'konsumen.district:code,name',
            'konsumen.village:code,name',
            'konsumen.pekerjaan:id,nama',
            'konsumen.cluster:id,nama_cluster',
        ])->findOrFail($id);
        if (!$Konsumen) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $provinceSelected = $Konsumen->provinsi_code  ? Province::find($Konsumen->provinsi_code, ['name']) : null;
        $citySelected     = $Konsumen->kota_code      ? City::find($Konsumen->kota_code, ['name']) : null;
        $districtSelected = $Konsumen->kecamatan_code ? District::find($Konsumen->kecamatan_code, ['code','name']) : null;
        $villageSelected  = $Konsumen->kelurahan_code ? Village::find($Konsumen->kelurahan_code, ['code','name']) : null;
        return view('marketing.konsumen.detailkonsumen', compact('Konsumen','provinceSelected','citySelected', 'districtSelected', 'villageSelected'));
    }

    public function cetakKonsumen($id)
    {
        $Konsumen = Konsumen::with([
            'konsumen:id,jenis_kelamin_id,cluster_id,status_pengajuan_id,provinsi_code,kota_code,kelurahan_code,kecamatan_code,pekerjaan_id,nama_konsumen,nik_konsumen,no_hp,alamat_konsumen,booking_fee',
            'konsumen.gender:id,nama',
            'konsumen.status_pengajuan:id,nama',
            'konsumen.province:code,name',
            'konsumen.city:code,name',
            'konsumen.district:code,name',
            'konsumen.village:code,name',
            'konsumen.pekerjaan:id,nama',
            'konsumen.cluster:id,nama_cluster',
        ])->findOrFail($id);
        if (!$Konsumen) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $provinceSelected = $Konsumen->provinsi_code  ? Province::find($Konsumen->provinsi_code, ['name']) : null;
        $citySelected     = $Konsumen->kota_code      ? City::find($Konsumen->kota_code, ['name']) : null;
        $districtSelected = $Konsumen->kecamatan_code ? District::find($Konsumen->kecamatan_code, ['code','name']) : null;
        $villageSelected  = $Konsumen->kelurahan_code ? Village::find($Konsumen->kelurahan_code, ['code','name']) : null;

        $pdf = Pdf::loadView('marketing.konsumen.konsumenpdf', compact('Konsumen','provinceSelected','citySelected','districtSelected','villageSelected'))->setPaper('A4','portrait');

        return $pdf->stream('Detail Konsumen '.$Konsumen->nama_konsumen.'.pdf');
    }

    public function updateKonsumen(Request $request, $id)
    {
        $rules = [
            'nama_konsumen'    => 'required|string|max:255',
            'nik_konsumen'     => 'required|string|max:255',
            'no_hp'            => 'required|string|max:255',
            'status_pengajuan_id' => 'nullable|string|max:255',
            'jenis_kelamin_id'    => 'required|string|max:255',
            'cluster_id'          => 'required|string|max:255',
            'provinsi_code'         => 'required|string|max:255',
            'kota_code'             => 'required|string|max:255',
            'kecamatan_code'        => 'required|string|max:255',
            'kelurahan_code'        => 'required|string|max:255',
            'alamat_konsumen'  => 'required|string|max:255',
            'pekerjaan_id'        => 'required|string|max:255',
            'marketing'        => 'required|string|max:255',
            'tanggal_booking'     => 'nullable|string|max:255',
            'booking_fee'      => 'nullable|string|max:255',
            'email'      => 'nullable|string|max:255',
            'nik_pasangan'     => 'nullable|string|max:255',
            'nama_pasangan'    => 'nullable|string|max:255',
            'no_hp_pasangan'   => 'nullable|string|max:255',
        ];

        $message = [
            'nama_konsumen.required' => 'Nama konsumen wajib diisi',
            'nik_konsumen.required' => 'NIK konsumen wajib diisi',
            'no_hp.required' => 'No HP wajib diisi',
            'jenis_kelamin_id.required' => 'Jenis kelamin wajib diisi',
            'cluster_id.required' => 'Cluster wajib diisi',
            'provinsi_code.required' => 'Provinsi wajib diisi',
            'kota_code.required' => 'Kota wajib diisi',
            'kecamatan_code.required' => 'Kecamatan wajib diisi',
            'kelurahan_code.required' => 'Kelurahan wajib diisi',
            'alamat_konsumen.required' => 'Alamat konsumen wajib diisi',
            'pekerjaan_id.required' => 'Pekerjaan wajib diisi',
            'marketing.required' => 'Marketing wajib diisi',
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
        $rowPerPage      = $request->get("length"); // total number of rows per page
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

        $records = $konsumen
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();

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
                "nik_konsumen"  => $record->nik_konsumen,
                "nama_konsumen" => $record->nama_konsumen,
                'no_hp'         => $record->no_hp,
                // 'email'      => $record->email,
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
