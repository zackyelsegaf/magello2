<?php

namespace App\Http\Controllers\Marketing\Perumahan;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Fasum;
use App\Models\Arsip;

class FasumController extends Controller
{
        public function FasumList()
    {
        $cluster = DB::table('cluster')->get();
        $rap_rab = DB::table('rap_rab')->get();
        $fasum   = DB::table('fasum')->get();
        return view('marketing.perumahan.fasum.fasum', compact('cluster', 'rap_rab', 'fasum'));
    }

    public function FasumAddNew()
    {
        $cluster = DB::table('cluster')->get();
        $rap_rab = DB::table('rap_rab')->where('tipe_model', 'Fasum')->get();
        return view('marketing.perumahan.fasum.fasumaddnew', compact('cluster', 'rap_rab'));
    }

    public function saveRecordFasum(Request $request)
    {
        $rules =  [
            'cluster_id' => 'required|exists:cluster,id',
            'rap_rab_id' => 'required|exists:rap_rab,id',
            'tipe_model' => 'nullable|string|max:255',
            'blok_fasum' => 'required|string|max:255',
            'nomor_unit_fasum' => 'required|string|max:255',
            'jumlah_lantai' => 'required|string|max:255',
            'luas_tanah' => 'required|string|max:255',
            'luas_bangunan' => 'required|string|max:255',
            'harga_fasum' => 'required|string|max:255',
            'spesifikasi' => 'required|string|max:255',
            'status_penjualan' => 'nullable|string|max:255',
            'status_pembangunan' => 'nullable|string|max:255'
        ];

        $message = [
            'cluster_id.required' => 'Cluster is required.',
            'rap_rab_id.required' => 'RAP/RAB is required.',
            'blok_fasum.required' => 'Blok Fasum is required.',
            'nomor_unit_fasum.required' => 'Nomor Unit Fasum is required.',
            'jumlah_lantai.required' => 'Jumlah Lantai is required.',
            'luas_tanah.required' => 'Luas Tanah is required.',
            'luas_bangunan.required' => 'Luas Bangunan is required.',
            'harga_fasum.required' => 'Harga Fasum is required.',
            'spesifikasi.required' => 'Spesifikasi is required.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            $fasum = new Fasum($validator->validated());
            $fasum->save();

            DB::commit();
            sweetalert()->success('Create new Barang & Detail successfully :)');
            return redirect()->route('fasum/list/page');
            
        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $updateFasum = Fasum::findOrFail($id);
        $cluster = DB::table('cluster')->get();
        $rap_rab = DB::table('rap_rab')->where('tipe_model', 'Fasum')->get();

        $detail = DB::table('fasum as fasum')
            ->leftJoin('cluster as cluster', 'cluster.id', '=', 'fasum.cluster_id')
            ->where('fasum.id', $id)
            ->select('fasum.nomor_unit_fasum', 'fasum.blok_fasum', 'fasum.cluster_id', 'cluster.nama_cluster')
            ->first();

        $arsip = $updateFasum->arsip()->get()->map(function($a){
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

        return view('marketing.perumahan.fasum.fasumupdate', compact('updateFasum', 'cluster', 'rap_rab', 'detail', 'arsip'));
    }

    public function updateFasum(Request $request, $id)
    {
        $rules =  [
            'cluster_id' => 'required|exists:cluster,id',
            'rap_rab_id' => 'required|exists:rap_rab,id',
            'tipe_model' => 'nullable|string|max:255',
            'blok_fasum' => 'required|string|max:255',
            'nomor_unit_fasum' => 'required|string|max:255',
            'jumlah_lantai' => 'required|string|max:255',
            'luas_tanah' => 'required|string|max:255',
            'luas_bangunan' => 'required|string|max:255',
            'harga_fasum' => 'required|string|max:255',
            'spesifikasi' => 'required|string|max:255',
            'status_penjualan' => 'nullable|string|max:255',
            'status_pembangunan' => 'nullable|string|max:255'
        ];

        $message = [
            'cluster_id.required' => 'Cluster is required.',
            'rap_rab_id.required' => 'RAP/RAB is required.',
            'blok_fasum.required' => 'Blok Fasum is required.',
            'nomor_unit_fasum.required' => 'Nomor Unit Fasum is required.',
            'jumlah_lantai.required' => 'Jumlah Lantai is required.',
            'luas_tanah.required' => 'Luas Tanah is required.',
            'luas_bangunan.required' => 'Luas Bangunan is required.',
            'harga_fasum.required' => 'Harga Fasum is required.',
            'spesifikasi.required' => 'Spesifikasi is required.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $fasum = Fasum::findOrFail($id);
            $fasum->update($validator->validated());

            $disk    = config('filesystems.default', 'public');
            $baseDir = "arsip/fasum/{$fasum->id}";

            $ownedIds = $fasum->arsip()->pluck('id')->all();
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
                        throw new \RuntimeException("Arsip #{$idArsip} bukan milik Fasum #{$fasum->id}");
                    }
                    $arsip = $fasum->arsip()->whereKey($idArsip)->firstOrFail();

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

                $fasum->arsip()->create($dataCreate);
            }

            DB::commit();
            sweetalert()->success('Update Fasum successfully :)');
            return redirect()->route('fasum/list/page');
            
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
            Fasum::whereIn('id', $ids)->chunkById(200, function($rows){
                $rows->each->delete();
            });
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('fasum/list/page');    

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getFasum(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length          = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $fasumNamaByClusterFilter = $request->get('cluster_id');
        $fasumNamaBySearchFilter = $request->get('nama_cluster');
        $fasumNamaByBlokFilter = $request->get('blok_fasum');
        $columnIndex     = $columnIndex_arr[0]['column'];
        $columnName      = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];

        $query = DB::table('fasum')
            ->leftJoin('cluster','cluster.id','=','fasum.cluster_id')
            ->select('fasum.*','cluster.nama_cluster');

        if ($fasumNamaBySearchFilter) {
            $query->where('cluster.nama_cluster', 'like', '%' . $fasumNamaBySearchFilter . '%');
        }
        
        if ($fasumNamaByClusterFilter) {
            $query->where('fasum.cluster_id', $fasumNamaByClusterFilter);
        }

        if ($fasumNamaByBlokFilter) {
            $query->where('fasum.blok_fasum', 'like', '%'.$fasumNamaByBlokFilter.'%');
        }

        $totalRecordsWithFilter = $query->count();
        $totalRecords = DB::table('fasum')->count();

        $records = $query
            ->orderBy($columnName, $columnSortOrder)
            ->offset($start)
            ->limit($length)
            ->get();

        $data_arr = [];

        foreach ($records as $key => $record) {

            $checkbox = '<input type="checkbox" class="fasum_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"                  => $checkbox,
                "no"                        => $start + $key + 1,
                "id"                        => $record->id,
                "cluster_id"                => $record->nama_cluster,
                "rap_rab_id"                => $record->rap_rab_id,
                "tipe_model"                => $record->tipe_model,
                "blok_fasum"                => $record->blok_fasum,
                "nomor_unit_fasum"          => $record->nomor_unit_fasum,
                "jumlah_lantai"             => $record->jumlah_lantai,
                "luas_tanah"                => $record->luas_tanah,
                "luas_bangunan"             => $record->luas_bangunan,
                "harga_fasum"               => $record->harga_fasum,
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

