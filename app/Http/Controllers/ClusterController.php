<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cluster;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
use App\Models\Village;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ClusterController extends Controller
{
    public function daftarCluster()
    {
        return view('cluster.datacluster');

    }

    public function tambahCluster()
    {
        $provinces = Province::orderBy('name')->get(['code','name']);
        return view('cluster.tambahcluster', compact('provinces'));
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

    public function simpanCluster(Request $request)
    {   
        $rules = [
            'nama_cluster'   => 'required|string|max:255',
            'no_hp'          => 'required|string|max:255',
            'luas_tanah'     => 'required|numeric',
            'total_unit'     => 'required|integer',
            'provinsi_code'  => 'required|string|size:2',
            'kota_code'      => 'required|string|size:4',
            'kecamatan_code'      => 'nullable|string|size:6',
            'kelurahan_code'      => 'nullable|string|size:10',
            'alamat_cluster' => 'required|string|max:255',
        ];

        $message = [
            'nama_cluster.required' => 'Nama cluster wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'luas_tanah.required' => 'Luas tanah wajib diisi.',
            'total_unit.required' => 'Total unit wajib diisi.',
            'provinsi_code.required' => 'Provinsi wajib dipilih.',
            'kota_code.required' => 'Kota wajib dipilih.',
            'alamat_cluster.required' => 'Alamat cluster wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $simpanCluster = new Cluster($validator->validated());
            $simpanCluster->save();

            DB::commit();
            sweetalert()->success('Create new cluster successfully :)');
            return redirect()->route('cluster/list/page');
        } catch (\Throwable $e) {
            DB::rollBack();
            sweetalert()->error('Tambah Data Gagal: '.$e->getMessage());
            return back()->withInput();
        }
    }

    public function editCluster($id)
    {
        $Cluster = Cluster::findOrFail($id);
        $provinces = Province::orderBy('name')->get(['code','name']);
        $citySelected     = $Cluster->kota_code ? City::where('code', $Cluster->kota_code)->first(['code','name']) : null;
        $districtSelected = $Cluster->kecamatan_code ? District::where('code', $Cluster->kecamatan_code)->first(['code','name']) : null;
        $villageSelected  = $Cluster->kelurahan_code ? Village::where('code', $Cluster->kelurahan_code)->first(['code','name']) : null;

        return view('cluster.ubahcluster', compact('Cluster','provinces','citySelected','districtSelected','villageSelected'));
    }

    public function updateCluster(Request $request, $id)
    {
        $rules = [
            'nama_cluster'   => 'required|string|max:255',
            'no_hp'          => 'required|string|max:255',
            'luas_tanah'     => 'required|numeric',
            'total_unit'     => 'required|integer',
            'provinsi_code'  => 'required|string|size:2',
            'kota_code'      => 'required|string|size:4',
            'kecamatan_code'      => 'nullable|string|size:6',
            'kelurahan_code'      => 'nullable|string|size:10',
            'alamat_cluster' => 'required|string|max:255',
        ];

        $message = [
            'nama_cluster.required' => 'Nama cluster wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'luas_tanah.required' => 'Luas tanah wajib diisi.',
            'total_unit.required' => 'Total unit wajib diisi.',
            'provinsi_code.required' => 'Provinsi wajib dipilih.',
            'kota_code.required' => 'Kota wajib dipilih.',
            'alamat_cluster.required' => 'Alamat cluster wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        DB::beginTransaction();
        try {
            $Cluster = Cluster::findOrFail($id);
            $Cluster->fill($validator->validated());
            $Cluster->save();

            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('cluster/list/page');

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function hapusCluster(Request $request)
    {
        try {
            $ids = $request->ids;
            Cluster::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('cluster/list/page');

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function dataCluster(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama_cluster');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $cluster =  Cluster::with(['city']);
        $totalRecords = Cluster::count();

        if ($namaFilter) {
            $cluster->where('nama_cluster', 'like', '%' . $namaFilter . '%');
        }

        $totalRecordsWithFilter = $cluster->count();

        $records = $cluster
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="cluster_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"     => $checkbox,
                "no"           => $start + $key + 1,
                "id"           => $record->id,
                "nama_cluster" => $record->nama_cluster,
                'kota_code'=> $record->kota_code,
                "kota"          => $record->city?->name, 
                "no_hp"        => $record->no_hp,
                'luas_tanah'   => $record->luas_tanah,
                'total_unit'   => $record->total_unit,
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
