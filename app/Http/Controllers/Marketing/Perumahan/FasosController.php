<?php

namespace App\Http\Controllers\Marketing\Perumahan;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Fasos;
use App\Models\Arsip;

class FasosController extends Controller
{
        public function FasosList()
    {
        $cluster = DB::table('cluster')->get();
        $rap_rab = DB::table('rap_rab')->get();
        $fasos   = DB::table('fasos')->get();
        return view('marketing.perumahan.fasos.fasos', compact('cluster', 'rap_rab', 'fasos'));
    }

    public function FasosAddNew()
    {
        $cluster = DB::table('cluster')->get();
        $rap_rab = DB::table('rap_rab')->get();
        return view('marketing.perumahan.fasos.fasosaddnew', compact('cluster', 'rap_rab'));
    }

    public function saveRecordFasos(Request $request)
    {
        $rules =  [
            'cluster_id' => 'required|exists:cluster,id',
            'rap_rab_id' => 'required|exists:rap_rab,id',
            'tipe_model' => 'nullable|string|max:255',
            'blok_fasos' => 'required|string|max:255',
            'nomor_unit_fasos' => 'required|string|max:255',
            'jumlah_lantai' => 'required|string|max:255',
            'luas_tanah' => 'required|string|max:255',
            'luas_bangunan' => 'required|string|max:255',
            'harga_fasos' => 'required|string|max:255',
            'spesifikasi' => 'required|string|max:255',
            'status_penjualan' => 'nullable|string|max:255',
            'status_pembangunan' => 'nullable|string|max:255'
        ];

        $message = [
            'cluster_id.required' => 'Cluster is required.',
            'rap_rab_id.required' => 'RAP/RAB is required.',
            'blok_fasos.required' => 'Blok Fasos is required.',
            'nomor_unit_fasos.required' => 'Nomor Unit Fasos is required.',
            'jumlah_lantai.required' => 'Jumlah Lantai is required.',
            'luas_tanah.required' => 'Luas Tanah is required.',
            'luas_bangunan.required' => 'Luas Bangunan is required.',
            'harga_fasos.required' => 'Harga Fasos is required.',
            'spesifikasi.required' => 'Spesifikasi is required.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            $fasos = new Fasos($validator->validated());
            $fasos->save();

            DB::commit();
            sweetalert()->success('Create new Barang & Detail successfully :)');
            return redirect()->route('fasos/list/page');
            
        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $updateFasos = Fasos::findOrFail($id);
        $cluster = DB::table('cluster')->get();
        $rap_rab = DB::table('rap_rab')->get();

        $detail = DB::table('fasos as fasos')
            ->leftJoin('cluster as cluster', 'cluster.id', '=', 'fasos.cluster_id')
            ->where('fasos.id', $id)
            ->select('fasos.nomor_unit_fasos', 'fasos.blok_fasos', 'fasos.cluster_id', 'cluster.nama_cluster')
            ->first();

        $arsip = $updateFasos->arsip()->get()->map(function($a){
            return [
                'id'               => $a->id,
                'nama_arsip'       => $a->nama_arsip,
                'nomor_arsip'      => $a->nomor_arsip,
                'tanggal_arsip'    => $a->tanggal_arsip ? $a->tanggal_arsip->format('Y-m-d') : null,
                'keterangan_arsip' => $a->keterangan_arsip,
                'original_name'    => $a->original_name,
                'file_url'         => $a->file_arsip ? asset('storage/'.$a->file_arsip) : null,
                'file_label'       => 'Ganti File',
            ];
        });

        return view('marketing.perumahan.fasos.fasosupdate', compact('updateFasos', 'cluster', 'rap_rab', 'detail', 'arsip'));
    }

    public function updateFasos(Request $request, $id)
    {
        $rules =  [
            'cluster_id' => 'required|exists:cluster,id',
            'rap_rab_id' => 'required|exists:rap_rab,id',
            'tipe_model' => 'nullable|string|max:255',
            'blok_fasos' => 'required|string|max:255',
            'nomor_unit_fasos' => 'required|string|max:255',
            'jumlah_lantai' => 'required|string|max:255',
            'luas_tanah' => 'required|string|max:255',
            'luas_bangunan' => 'required|string|max:255',
            'harga_fasos' => 'required|string|max:255',
            'spesifikasi' => 'required|string|max:255',
            'status_penjualan' => 'nullable|string|max:255',
            'status_pembangunan' => 'nullable|string|max:255'
        ];

        $message = [
            'cluster_id.required' => 'Cluster is required.',
            'rap_rab_id.required' => 'RAP/RAB is required.',
            'blok_fasos.required' => 'Blok Fasos is required.',
            'nomor_unit_fasos.required' => 'Nomor Unit Fasos is required.',
            'jumlah_lantai.required' => 'Jumlah Lantai is required.',
            'luas_tanah.required' => 'Luas Tanah is required.',
            'luas_bangunan.required' => 'Luas Bangunan is required.',
            'harga_fasos.required' => 'Harga Fasos is required.',
            'spesifikasi.required' => 'Spesifikasi is required.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            $fasos = Fasos::findOrFail($id);
            $fasos->update($validator->validated());

            $disk    = config('filesystems.default', 'public');
            $baseDir = "arsip/fasos/{$fasos->id}";

            $ownedIds = $fasos->arsip()->pluck('id')->all();
            $owned    = array_fill_keys($ownedIds, true);

            $max = (int) $request->input('arsip_counter', 0);

            for ($i = 1; $i <= $max; $i++) {
                $idArsip   = $request->input("arsip_id_{$i}");
                $toDelete  = $request->input("arsip_delete_{$i}") === '1';
                $nama      = trim((string) $request->input("nama_arsip_{$i}"));
                $nomor     = trim((string) $request->input("nomor_arsip_{$i}"));
                $tanggal   = $request->input("tanggal_arsip_{$i}");
                $ket       = $request->input("keterangan_arsip_{$i}");
                $uploaded  = $request->file("file_arsip_{$i}");

                if ($uploaded) {
                    $ext = strtolower($uploaded->getClientOriginalExtension());
                    $size = $uploaded->getSize(); 

                    if (!in_array($ext, ['pdf','jpg','jpeg','png','doc','docx'])) {
                        DB::rollBack();
                        sweetalert()->warning("Tipe file pada baris #{$i} tidak diperbolehkan. Hanya PDF/JPG/PNG/DOC/DOCX.");
                        return redirect()->back()->withInput();
                    }

                    if ($size > 20 * 1024 * 1024) {
                        DB::rollBack();
                        sweetalert()->warning("Ukuran file pada baris #{$i} melebihi 20MB.");
                        return redirect()->back()->withInput();
                    }
                }

                if (!$idArsip && !$nama && !$nomor && !$tanggal && !$ket && !$uploaded) {
                    continue;
                }

                if ($idArsip) {
                    if (!isset($owned[$idArsip])) {
                        throw new \RuntimeException("Arsip #{$idArsip} bukan milik Fasos #{$fasos->id}");
                    }
                    $arsip = $fasos->arsip()->whereKey($idArsip)->firstOrFail();

                    if ($toDelete) {
                        if ($arsip->file_arsip && Storage::disk($disk)->exists($arsip->file_arsip)) {
                            Storage::disk($disk)->delete($arsip->file_arsip);
                        }
                        $arsip->delete();
                        continue;
                    }

                    if ($nama === '') {
                        throw new \RuntimeException("Nama arsip wajib diisi pada baris #{$i}.");
                    }

                    $arsip->nama_arsip       = $nama;
                    $arsip->nomor_arsip      = $nomor ?: null;
                    $arsip->tanggal_arsip    = $tanggal ?: null;
                    $arsip->keterangan_arsip = $ket ?: null;

                    if ($uploaded) {
                        $ext      = $uploaded->getClientOriginalExtension();
                        $filename = now()->format('Ymd_His') . '_' . Str::random(8) . ($ext ? ".{$ext}" : '');
                        $path     = $uploaded->storeAs($baseDir, $filename, $disk);

                        if ($arsip->file_arsip && Storage::disk($disk)->exists($arsip->file_arsip)) {
                            Storage::disk($disk)->delete($arsip->file_arsip);
                        }

                        $arsip->file_arsip    = $path;
                        $arsip->original_name = $uploaded->getClientOriginalName();
                        $arsip->mime_type     = $uploaded->getMimeType();
                        $arsip->file_size     = $uploaded->getSize();
                    }

                    $arsip->save();
                    continue;
                }

                if ($toDelete) {
                    continue;
                }
                if ($nama === '') {
                    throw new \RuntimeException("Nama arsip wajib diisi pada baris baru #{$i}.");
                }

                $dataCreate = [
                    'nama_arsip'       => $nama,
                    'nomor_arsip'      => $nomor ?: null,
                    'tanggal_arsip'    => $tanggal ?: null,
                    'keterangan_arsip' => $ket ?: null,
                ];

                if ($uploaded) {
                    $ext      = $uploaded->getClientOriginalExtension();
                    $filename = now()->format('Ymd_His') . '_' . Str::random(8) . ($ext ? ".{$ext}" : '');
                    $path     = $uploaded->storeAs($baseDir, $filename, $disk);

                    $dataCreate['file_arsip']    = $path;
                    $dataCreate['original_name'] = $uploaded->getClientOriginalName();
                    $dataCreate['mime_type']     = $uploaded->getMimeType();
                    $dataCreate['file_size']     = $uploaded->getSize();
                }

                $fasos->arsip()->create($dataCreate);
            }

            DB::commit();
            sweetalert()->success('Update Barang & Detail successfully :)');
            return redirect()->route('fasos/list/page');
            
        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            Fasos::whereIn('id', $ids)->chunkById(200, function($rows){
                $rows->each->delete();
            });
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('fasos/list/page');    

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getFasos(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length          = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $fasosNamaByClusterFilter = $request->get('cluster_id');
        $fasosNamaBySearchFilter = $request->get('nama_cluster');
        $fasosNamaByBlokFilter = $request->get('blok_fasos');
        $columnIndex     = $columnIndex_arr[0]['column'];
        $columnName      = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];

        $query = DB::table('fasos')
            ->leftJoin('cluster','cluster.id','=','fasos.cluster_id')
            ->select('fasos.*','cluster.nama_cluster');

        if ($fasosNamaBySearchFilter) {
            $query->where('cluster.nama_cluster', 'like', '%' . $fasosNamaBySearchFilter . '%');
        }
        
        if ($fasosNamaByClusterFilter) {
            $query->where('fasos.cluster_id', $fasosNamaByClusterFilter);
        }

        if ($fasosNamaByBlokFilter) {
            $query->where('fasos.blok_fasos', 'like', '%'.$fasosNamaByBlokFilter.'%');
        }

        $totalRecordsWithFilter = $query->count();
        $totalRecords = DB::table('fasos')->count();

        $records = $query
            ->orderBy($columnName, $columnSortOrder)
            ->offset($start)
            ->limit($length)
            ->get();

        $data_arr = [];

        foreach ($records as $key => $record) {

            $checkbox = '<input type="checkbox" class="fasos_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"                  => $checkbox,
                "no"                        => $start + $key + 1,
                "id"                        => $record->id,
                "cluster_id"                => $record->nama_cluster,
                "rap_rab_id"                => $record->rap_rab_id,
                "tipe_model"                => $record->tipe_model,
                "blok_fasos"                => $record->blok_fasos,
                "nomor_unit_fasos"          => $record->nomor_unit_fasos,
                "jumlah_lantai"             => $record->jumlah_lantai,
                "luas_tanah"                => $record->luas_tanah,
                "luas_bangunan"             => $record->luas_bangunan,
                "harga_fasos"               => $record->harga_fasos,
                "spesifikasi"               => $record->spesifikasi,
                "status_penjualan"          => $record->status_penjualan,
                "status_pembangunan"        => $record->status_pembangunan,
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
