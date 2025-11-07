<?php

namespace App\Http\Controllers\Projek;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\SuratPerintahKerjaInternal;
use App\Models\SuratPerintahKerjaInternalListFee;
use App\Models\ArsipFile;
use App\Models\DokumenBooking;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Schema;


class SpkMandorPekerjaController extends Controller
{
        public function SpkMandorPekerjaList()
    {
        return view("projek.spkmandorpekerja.spkmandorpekerja");
    }

    public function SpkMandorPekerjaInternalAddNew()
    {
        // $kapling = DB::table('kapling')->get();
        $pekerja = DB::table('pekerja_simandor')
            ->select('id','nama_pekerja','no_hp')
            ->orderBy('nama_pekerja')->get();

        $spp = DB::table('surat_perintah_pembangunan as spp')
            ->leftJoin('surat_perintah_kerja as spk', 'spk.spp_id', '=', 'spp.id')
            ->whereNull('spk.spp_id')                                             
            ->select(
                'spp.id',
                'spp.nomor_spp',
                'spp.tanggal_spp',
                'spp.konsumen',
                'spp.stok',
                DB::raw("CASE WHEN spp.konsumen = 1 THEN '(Marketing)' ELSE '(Manajemen)' END AS instruksi")
            )
            ->orderBy('spp.tanggal_spp', 'desc')
            ->orderBy('spp.nomor_spp', 'desc')
            ->get();
            
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $nomorPreview = SuratPerintahKerjaInternal::generateNomorSpk($today);

        return view("projek.spkmandorpekerja.spkmandorpekerjainternaladdnew", compact('spp', 'pekerja', 'nomorPreview'));
    }

    public function SpkMandorPekerjaSubconAddNew()
    {
        // $kapling = DB::table('kapling')->get();
        $pekerja = DB::table('pekerja_simandor')
            ->select('id','nama_pekerja','no_hp')
            ->orderBy('nama_pekerja')->get();

        $spp = DB::table('surat_perintah_pembangunan as spp')
            ->leftJoin('surat_perintah_kerja as spk', 'spk.spp_id', '=', 'spp.id')
            ->whereNull('spk.spp_id')                                             
            ->select(
                'spp.id',
                'spp.nomor_spp',
                'spp.tanggal_spp',
                'spp.konsumen',
                'spp.stok',
                DB::raw("CASE WHEN spp.konsumen = 1 THEN '(Marketing)' ELSE '(Manajemen)' END AS instruksi")
            )
            ->orderBy('spp.tanggal_spp', 'desc')
            ->orderBy('spp.nomor_spp', 'desc')
            ->get();

        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $nomorPreview = SuratPerintahKerjaInternal::generateNomorSpk($today);

        return view("projek.spkmandorpekerja.spkmandorpekerjasubconaddnew", compact('spp', 'pekerja', 'nomorPreview'));
    }

    public function saveRecordSpkMandorPekerja(Request $request)
    {
        $rules = [
            'judul_spk'         => 'required|string|max:200',
            'tanggal_spk'       => 'required|date_format:d/m/Y',
            'fileupload'        => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png,doc,docx',
            'pekerja_id'        => 'required|exists:pekerja_simandor,id',
            'tanggal_mulai'     => 'required|date_format:d/m/Y',
            'lama_pengerjaan'   => 'required|integer|min:1',
            'dibuat_oleh'       => 'nullable|string|max:255',
            'status_spk'        => 'nullable|string|max:255',
            'siklus_pembayaran' => 'required|in:Harian,Mingguan,2 Mingguan,3 Mingguan,Bulanan',
            'spp_id'            => 'required|exists:surat_perintah_pembangunan,id',
            'kapling_id'        => 'required|array|min:1',
            'kapling_id.*'      => 'integer|exists:kapling,id',
            'fee'                     => 'required|array|min:1',
            'fee.*.nama_kapling'      => 'required|string|max:150', // disimpan NAMA (label), bukan id
            'fee.*.pekerjaan'         => 'required|string|max:150',
            'fee.*.upah'              => 'required|numeric|min:0',
            'fee.*.retensi'           => 'nullable|integer|min:0|max:100', // default 5 di server jika null
        ];

        $message = [
            'judul_spk.required'        => 'Judul SPK wajib diisi',
            'tanggal_spk.required'      => 'Tanggal SPK wajib diisi',
            'tanggal_spk.date_format'   => 'Tanggal SPK tidak valid (gg/bb/tttt)',
            'fileupload.mimes'          => 'Lampiran harus PDF/JPG/PNG/DOC/DOCX',
            'fileupload.max'            => 'Lampiran maksimal 5 MB',
            'pekerja_id.required'       => 'Pekerja wajib dipilih',
            'tanggal_mulai.required'    => 'Tanggal mulai wajib diisi',
            'tanggal_mulai.date_format' => 'Tanggal mulai tidak valid (gg/bb/tttt)',
            'lama_pengerjaan.required'  => 'Lama pengerjaan wajib diisi',
            'lama_pengerjaan.min'       => 'Lama pengerjaan minimal 1 hari',
            'siklus_pembayaran.required'=> 'Siklus pembayaran wajib dipilih',
            'spp_id.required'           => 'Nomor SPP wajib dipilih',
            'kapling_id.required'       => 'Minimal pilih satu kapling',
            'kapling_id.*.exists'       => 'Ada kapling yang tidak ditemukan',
            'fee.required'              => 'Minimal satu baris fee wajib diisi.',
            'fee.*.nama_kapling.required'=> 'Nama kapling pada baris fee wajib diisi.',
            'fee.*.pekerjaan.required'  => 'Pekerjaan pada baris fee wajib diisi.',
            'fee.*.upah.required'       => 'Upah pada baris fee wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            sweetalert()->error('Validasi gagal. Mohon periksa input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $data = $validator->validated();

            $data['tanggal_spk']   = Carbon::createFromFormat('d/m/Y', $data['tanggal_spk'])->format('Y-m-d');
            $data['tanggal_mulai'] = Carbon::createFromFormat('d/m/Y', $data['tanggal_mulai'])->format('Y-m-d');

            $allowedKaplings = DB::table('spp_kapling')
                ->where('spp_id', $data['spp_id'])
                ->pluck('kapling_id')->all();

            if (array_diff($data['kapling_id'], $allowedKaplings)) {
                throw ValidationException::withMessages([
                    'kapling_id' => 'Ada kapling yang tidak termasuk dalam SPP yang dipilih.'
                ]);
            }

            $path = null;
            if ($request->hasFile('fileupload')) {
                $path = $request->file('fileupload')->store('spk_files', 'public');
            }

            $spk = new SuratPerintahKerjaInternal([
                'judul_spk'         => $data['judul_spk'],
                'tanggal_spk'       => $data['tanggal_spk'],
                'fileupload'        => $path,
                'pekerja_id'        => $data['pekerja_id'],
                'tanggal_mulai'     => $data['tanggal_mulai'],
                'status_spk'        => $data['status_spk'],
                'lama_pengerjaan'   => $data['lama_pengerjaan'],
                'siklus_pembayaran' => $data['siklus_pembayaran'],
                'dibuat_oleh'       => $data['dibuat_oleh'],
                'spp_id'            => $data['spp_id'],
            ]);
            $spk->save();

            if ($path) { 
                $uploaded = $request->file('fileupload');
                ArsipFile::create([
                    'arsipmultimenu_type' => get_class($spk),
                    'arsipmultimenu_id'   => $spk->id,
                    'nama_arsip'          => $data['judul_spk'] ?? 'Lampiran SPK',
                    'nomor_arsip'         => null,
                    'tanggal_arsip'       => $data['tanggal_spk'],
                    'disk'                => 'public',
                    'file_arsip'          => $path,
                    'keterangan_arsip'    => 'Lampiran SPK Mandor/Pekerja Internal',
                    'original_name'       => $uploaded?->getClientOriginalName(),
                    'mime_type'           => $uploaded?->getClientMimeType(),
                    'file_size'           => $uploaded?->getSize(),
                    'uploaded_by'         => optional($request->user())->id,
                ]);
            }

            $spk->kaplings()->sync($data['kapling_id']);

            $now = now();
            $rows = [];
            foreach ($data['fee'] as $row) {
                $rows[] = [
                    'spk_id'            => $spk->id,
                    'nama_kapling'      => $row['nama_kapling'],
                    'pekerjaan'         => $row['pekerjaan'],
                    'upah'              => $row['upah'],
                    'retensi'           => $row['retensi'] ?? 5,
                    'created_at'        => $now,
                    'updated_at'        => $now,
                ];
            }
            if (!empty($rows)) {
                DB::table('spk_list_fee')->insert($rows);
            }

            DB::commit();
            sweetalert()->success('SPK Mandor/Pekerja Internal berhasil disimpan.');
            return redirect()->route('spkmandorpekerja/list/page');

        } catch (\Throwable $e) {
            DB::rollBack();
            sweetalert()->error('Tambah Data Gagal: '.$e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function saveRecordSpkMandorPekerjaSubcon(Request $request)
    {
        $rules = [
            'judul_spk'          => 'required|string|max:200',
            'tanggal_spk'        => 'required|date_format:d/m/Y',
            'fileupload'         => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png,doc,docx',
            'pekerja_id'         => 'required|exists:pekerja_simandor,id',
            'tanggal_mulai'      => 'required|date_format:d/m/Y',
            'lama_pengerjaan'    => 'required|integer|min:1',
            'dibuat_oleh'        => 'nullable|string|max:255',
            'status_spk'         => 'nullable|string|max:255',
            'tipe_pembayaran'    => 'required|string|max:255',
            'spp_id'             => 'required|exists:surat_perintah_pembangunan,id',
            'kapling_id'         => 'required|array|min:1',
            'kapling_id.*'       => 'integer|exists:kapling,id',
            'nominal_perjanjian' => 'nullable|string|max:255',
            'tipe_pembayaran'    => 'nullable|string|max:255',
            'total_persentase_pembayaran' => 'nullable|string|max:255',
            'total_nilai_termin' => 'nullable|string|max:255',
            'grand_total_persentase_pembayaran' => 'nullable|string|max:255',
            'grand_total_nilai_termin' => 'nullable|string|max:255',
            'fee'                => 'required|array|min:1',
            'fee.*.nama_kapling' => 'nullable|string|max:150',
            'fee.*.nama_termin'  => 'nullable|string|max:255',
            'fee.*.persen_pekerjaan'  => 'nullable|string|max:255',
            'fee.*.persen_pembayaran'  => 'nullable|string|max:255',
            'fee.*.nilai_termin'  => 'nullable|string|max:255',
            'fee.*.retensi'      => 'nullable|integer|min:0|max:100', 
        ];

        $message = [
            'judul_spk.required'        => 'Judul SPK wajib diisi',
            'tanggal_spk.required'      => 'Tanggal SPK wajib diisi',
            'tanggal_spk.date_format'   => 'Tanggal SPK tidak valid (gg/bb/tttt)',
            'fileupload.mimes'          => 'Lampiran harus PDF/JPG/PNG/DOC/DOCX',
            'fileupload.max'            => 'Lampiran maksimal 5 MB',
            'pekerja_id.required'       => 'Pekerja wajib dipilih',
            'tanggal_mulai.required'    => 'Tanggal mulai wajib diisi',
            'tanggal_mulai.date_format' => 'Tanggal mulai tidak valid (gg/bb/tttt)',
            'lama_pengerjaan.required'  => 'Lama pengerjaan wajib diisi',
            'lama_pengerjaan.min'       => 'Lama pengerjaan minimal 1 hari',
            'tipe_pembayaran.required'=> 'Siklus pembayaran wajib dipilih',
            'spp_id.required'           => 'Nomor SPP wajib dipilih',
            'kapling_id.required'       => 'Minimal pilih satu kapling',
            'kapling_id.*.exists'       => 'Ada kapling yang tidak ditemukan',
            'fee.required'              => 'Minimal satu baris fee wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            sweetalert()->error('Validasi gagal. Mohon periksa input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $data = $validator->validated();

            $data['tanggal_spk']   = Carbon::createFromFormat('d/m/Y', $data['tanggal_spk'])->format('Y-m-d');
            $data['tanggal_mulai'] = Carbon::createFromFormat('d/m/Y', $data['tanggal_mulai'])->format('Y-m-d');

            $allowedKaplings = DB::table('spp_kapling')
                ->where('spp_id', $data['spp_id'])
                ->pluck('kapling_id')->all();

            if (array_diff($data['kapling_id'], $allowedKaplings)) {
                throw ValidationException::withMessages([
                    'kapling_id' => 'Ada kapling yang tidak termasuk dalam SPP yang dipilih.'
                ]);
            }

            $path = null;
            if ($request->hasFile('fileupload')) {
                $path = $request->file('fileupload')->store('spk_files', 'public');
            }

            $spk = new SuratPerintahKerjaInternal([
                'judul_spk'         => $data['judul_spk'],
                'tanggal_spk'       => $data['tanggal_spk'],
                'fileupload'        => $path,
                'pekerja_id'        => $data['pekerja_id'],
                'tanggal_mulai'     => $data['tanggal_mulai'],
                'status_spk'        => $data['status_spk'],
                'lama_pengerjaan'   => $data['lama_pengerjaan'],
                'tipe_pembayaran'   => $data['tipe_pembayaran'],
                'dibuat_oleh'       => $data['dibuat_oleh'],
                'spp_id'            => $data['spp_id'],
            ]);
            $spk->save();

            if ($path) { 
                $uploaded = $request->file('fileupload');
                ArsipFile::create([
                    'arsipmultimenu_type' => get_class($spk),
                    'arsipmultimenu_id'   => $spk->id,
                    'nama_arsip'          => $data['judul_spk'] ?? 'Lampiran SPK',
                    'nomor_arsip'         => null,
                    'tanggal_arsip'       => $data['tanggal_spk'],
                    'disk'                => 'public',
                    'file_arsip'          => $path,
                    'keterangan_arsip'    => 'Lampiran SPK Mandor/Pekerja Subcon',
                    'original_name'       => $uploaded?->getClientOriginalName(),
                    'mime_type'           => $uploaded?->getClientMimeType(),
                    'file_size'           => $uploaded?->getSize(),
                    'uploaded_by'         => optional($request->user())->id,
                ]);
            }

            $spk->kaplings()->sync($data['kapling_id']);

            $now  = now();
            $detail = $spk;
            $detail->nominal_perjanjian                 = $request->nominal_perjanjian ?? null;
            $detail->tipe_pembayaran                    = $request->tipe_pembayaran ?? null;
            $detail->total_nilai_termin                 = $request->total_nilai_termin ?? null;
            $detail->grand_total_nilai_termin           = $request->grand_total_nilai_termin ?? null;
            $detail->grand_total_persentase_pembayaran = $request->grand_total_persentase_pembayaran ?? null;
            $detail->total_persentase_pembayaran        = $request->total_persentase_pembayaran ?? null;
            $rows = [];

            foreach ($data['fee'] as $row) {
                $rows[] = [
                    'spk_id'            => $spk->id,
                    'nama_kapling'      => $row['nama_kapling'] ?? null,
                    'nama_termin'       => $row['nama_termin'] ?? null,
                    'persen_pekerjaan'  => $row['persen_pekerjaan'] ?? null,
                    'persen_pembayaran' => $row['persen_pembayaran'] ?? null,
                    'nilai_termin'      => $row['nilai_termin'] ?? 0,
                    'retensi'           => $row['retensi'] ?? 5,
                    'nominal_perjanjian' => $detail->nominal_perjanjian ?? null,
                    'total_nilai_termin' => $detail->total_nilai_termin ?? null,
                    'total_persentase_pembayaran' => $data['total_persentase_pembayaran'] ?? null,
                    'grand_total_nilai_termin' => $data['grand_total_nilai_termin'] ?? null,
                    'grand_total_persentase_pembayaran' => $data['grand_total_persentase_pembayaran'] ?? null,
                    'created_at'        => $now,
                    'updated_at'        => $now,
                ];
            }
            DB::table('spk_list_fee')->insert($rows);

            DB::commit();
            sweetalert()->success('SPK Mandor/Pekerja Internal berhasil disimpan.');
            return redirect()->route('spkmandorpekerja/list/page');

        } catch (\Throwable $e) {
            DB::rollBack();
            sweetalert()->error('Tambah Data Gagal: '.$e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function approve($id)
    {
        $spk = SuratPerintahKerjaInternal::findOrFail($id);

        if ($spk->disetujui_oleh) {
            return response()->json([
                'status'  => 'warning',
                'title'   => 'Sudah Disetujui',
                'message' => 'SPK ini sudah disetujui oleh '.$spk->disetujui_oleh,
                'id'      => $spk->id,
                'disetujui_oleh' => $spk->disetujui_oleh,
            ], 400);
        }

        $spk->disetujui_oleh = Auth::user()->name ?? 'Unknown User';
        $spk->save();

        return response()->json([
            'status'  => 'success',
            'title'   => 'Berhasil!',
            'message' => 'Disetujui oleh '.$spk->disetujui_oleh,
            'id'      => $spk->id,
            'disetujui_oleh' => $spk->disetujui_oleh,
        ]);
    }

    public function editInternal($id)
    {
        $updateSpk = SuratPerintahKerjaInternal::with(['kaplings:id','fees'])->findOrFail($id);

        $tanggal_spk = $updateSpk->tanggal_spk ? Carbon::parse($updateSpk->tanggal_spk)->format('d/m/Y') : null;
        $tanggal_mulai = $updateSpk->tanggal_mulai ? Carbon::parse($updateSpk->tanggal_mulai)->format('d/m/Y') : null;

        $updateKavling = SuratPerintahKerjaInternal::find($id);
        $arsip = $updateKavling->arsipFiles()->get()->map(function($a){
                return [
                    'id'               => $a->id,
                    'nama_arsip'       => $a->nama_arsip,
                    'nomor_arsip'      => $a->nomor_arsip,
                    // 'tanggal_arsip'    => $a->tanggal_arsip ? $a->tanggal_arsip->format('Y-m-d') : null,
                    'keterangan_arsip' => $a->keterangan_arsip,
                    'original_name'    => $a->original_name,
                    'file_url'         => $a->file_arsip ? asset('storage/'.$a->file_arsip) : null,
                    'file_label'       => 'Ganti File',
                ];
            });

        if (!$updateSpk) {
            return redirect()
                ->route('spkmandorpekerja/list/page')
                ->with('error', 'Data SPK tidak ditemukan.');
        }

        $pekerja = DB::table('pekerja_simandor')
            ->select('id','nama_pekerja','no_hp')
            ->orderBy('nama_pekerja')
            ->get();

        $spp = DB::table('surat_perintah_pembangunan')
            ->select(
                'id',
                'nomor_spp',
                'tanggal_spp',
                'konsumen',
                'stok',
                DB::raw("CASE WHEN konsumen = 1 THEN '(Marketing)' ELSE '(Manajemen)' END AS instruksi")
            )
            ->orderBy('tanggal_spp', 'desc')
            ->orderBy('nomor_spp', 'desc')
            ->get();

        $kaplingOptions = DB::table('spp_kapling')
            ->join('kapling','kapling.id','=','spp_kapling.kapling_id')
            ->leftJoin('cluster','cluster.id','=','kapling.cluster_id')
            ->where('spp_kapling.spp_id', $updateSpk->spp_id)
            ->orderBy('kapling.blok_kapling')
            ->select(
                'kapling.id',
                DB::raw("kapling.blok_kapling || ' - ' || kapling.nomor_unit_kapling || ' \ ' || IFNULL(cluster.nama_cluster,'') as text")
            )->get();

        $selectedKaplingIds = $updateSpk->kaplings->pluck('id')->values();

        $feeRows = DB::table('spk_list_fee')
            ->where('spk_id', $updateSpk->id)
            ->select('id','nama_kapling','pekerjaan','upah','retensi')
            ->orderBy('id')
            ->get();

        

        return view('projek.spkmandorpekerja.spkmandorpekerjainternaledit', compact('updateSpk','pekerja','spp','kaplingOptions','selectedKaplingIds','feeRows', 'arsip', 'tanggal_spk', 'tanggal_mulai'));
    }

    public function deleteFile(ArsipFile $file)
    {
        try {
            $disk      = $file->disk ?? config('filesystems.default', 'public');
            $path      = $file->file_arsip;
            $parent    = $file->arsipmultimenu;
            $parentDir = $path ? dirname($path) : null;

            if ($path && Storage::disk($disk)->exists($path)) {
                Storage::disk($disk)->delete($path);
            }

            $file->delete();

            if ($parent instanceof DokumenBooking && $parent->files()->count() === 0) {
                $parent->delete();
            }

            if ($parentDir && empty(Storage::disk($disk)->files($parentDir)) && empty(Storage::disk($disk)->directories($parentDir))) {
                Storage::disk($disk)->deleteDirectory($parentDir);
            }

            sweetalert()->success('File berhasil dihapus.');
        } catch (\Throwable $e) {
            sweetalert()->warning('Gagal menghapus file: '.$e->getMessage());
        }

        return back();
    }

    public function editSubcon($id)
    {
        $updateSpk = SuratPerintahKerjaInternal::with(['kaplings:id','fees'])->findOrFail($id);

        $tanggal_spk = $updateSpk->tanggal_spk ? Carbon::parse($updateSpk->tanggal_spk)->format('d/m/Y') : null;
        $tanggal_mulai = $updateSpk->tanggal_mulai ? Carbon::parse($updateSpk->tanggal_mulai)->format('d/m/Y') : null;

        $updateKavling = SuratPerintahKerjaInternal::find($id);
        $arsip = $updateKavling->arsipFiles()->get()->map(function($a){
                return [
                    'id'               => $a->id,
                    'nama_arsip'       => $a->nama_arsip,
                    'nomor_arsip'      => $a->nomor_arsip,
                    // 'tanggal_arsip'    => $a->tanggal_arsip ? $a->tanggal_arsip->format('Y-m-d') : null,
                    'keterangan_arsip' => $a->keterangan_arsip,
                    'original_name'    => $a->original_name,
                    'file_url'         => $a->file_arsip ? asset('storage/'.$a->file_arsip) : null,
                    'file_label'       => 'Ganti File',
                ];
            });

        if (!$updateSpk) {
            return redirect()
                ->route('spkmandorpekerja/list/page')
                ->with('error', 'Data SPK tidak ditemukan.');
        }

        $pekerja = DB::table('pekerja_simandor')
            ->select('id','nama_pekerja','no_hp')
            ->orderBy('nama_pekerja')
            ->get();

        $spp = DB::table('surat_perintah_pembangunan')
            ->select(
                'id',
                'nomor_spp',
                'tanggal_spp',
                'konsumen',
                'stok',
                DB::raw("CASE WHEN konsumen = 1 THEN '(Marketing)' ELSE '(Manajemen)' END AS instruksi")
            )
            ->orderBy('tanggal_spp', 'desc')
            ->orderBy('nomor_spp', 'desc')
            ->get();

        $kaplingOptions = DB::table('spp_kapling')
            ->join('kapling','kapling.id','=','spp_kapling.kapling_id')
            ->leftJoin('cluster','cluster.id','=','kapling.cluster_id')
            ->where('spp_kapling.spp_id', $updateSpk->spp_id)
            ->orderBy('kapling.blok_kapling')
            ->select(
                'kapling.id',
                DB::raw("kapling.blok_kapling || ' - ' || kapling.nomor_unit_kapling || ' \ ' || IFNULL(cluster.nama_cluster,'') as text")
            )->get();

        $selectedKaplingIds = $updateSpk->kaplings->pluck('id')->values();

        $feeRows = DB::table('spk_list_fee')
            ->where('spk_id', $updateSpk->id)
            ->select(
                'id',
                'nama_kapling',
                'nama_termin',
                'persen_pekerjaan',
                'persen_pembayaran',
                'nilai_termin',
                'retensi',
                'nominal_perjanjian',
                'total_nilai_termin',
                'total_persentase_pembayaran',
                'grand_total_nilai_termin',
                'grand_total_persentase_pembayaran'
            )
            ->orderBy('id')
            ->get();

        return view('projek.spkmandorpekerja.spkmandorpekerjasubconedit', compact('updateSpk','pekerja','spp','kaplingOptions','selectedKaplingIds','feeRows', 'arsip', 'tanggal_spk', 'tanggal_mulai'));
    }


    public function updateInternal(Request $request)
    {
        $rules = [
            'judul_spk'         => 'nullable|string|max:200',
            'tanggal_spk'       => 'nullable|date_format:Y-m-d',
            'fileupload'        => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png,doc,docx',
            'pekerja_id'        => 'nullable|exists:pekerja_simandor,id',
            'tanggal_mulai'     => 'nullable|date_format:Y-m-d',
            'lama_pengerjaan'   => 'nullable|integer|min:1',
            'siklus_pembayaran' => 'nullable|in:Harian,Mingguan,2 Mingguan,3 Mingguan,Bulanan',
            'spp_id'            => 'nullable|exists:surat_perintah_pembangunan,id',
            'kapling_id'        => 'nullable|array',           // <-- tanpa min
            'kapling_id.*'      => 'integer|exists:kapling,id',
            'fee'                     => 'nullable|array',     // <-- tanpa min
            'fee.*.nama_kapling'      => 'nullable|string|max:150',
            'fee.*.pekerjaan'         => 'nullable|string|max:150',
            'fee.*.upah'              => 'nullable|numeric|min:0',
            'fee.*.retensi'           => 'nullable|integer|min:0|max:100',
        ];
        $data = $request->validate($rules);

        $id         = $request->input('id');
        $sppId      = $request->input('spp_id');
        $kaplingIds = $request->input('kapling_id', []);           // selalu array
        $fees       = $request->input('fee', []);                   // selalu array

        if (!$id) {
            sweetalert()->error('ID SPK tidak ditemukan.');
            return back()->withInput();
        }

        DB::beginTransaction();
        try {
            $spk = SuratPerintahKerjaInternal::findOrFail($id);
            if ($sppId && !empty($kaplingIds)) {
                $allowedKaplings = DB::table('spp_kapling')
                    ->where('spp_id', $sppId)
                    ->pluck('kapling_id')->all();

                if (array_diff($kaplingIds, $allowedKaplings)) {
                    throw ValidationException::withMessages([
                        'kapling_id' => 'Ada kapling yang tidak termasuk dalam SPP yang dipilih.'
                    ]);
                }
            }

            $path = null;
            if ($request->hasFile('fileupload')) {
                $path = $request->file('fileupload')->store('spk_files', 'public');
            }

            if ($path) { 
                $uploaded = $request->file('fileupload');
                ArsipFile::create([
                    'arsipmultimenu_type' => get_class($spk),
                    'arsipmultimenu_id'   => $spk->id,
                    'nama_arsip'          => $data['judul_spk'] ?? 'Lampiran SPK',
                    'nomor_arsip'         => null,
                    'tanggal_arsip'       => $data['tanggal_spk'],
                    'disk'                => 'public',
                    'file_arsip'          => $path,
                    'keterangan_arsip'    => 'Lampiran SPK Mandor/Pekerja Internal',
                    'original_name'       => $uploaded?->getClientOriginalName(),
                    'mime_type'           => $uploaded?->getClientMimeType(),
                    'file_size'           => $uploaded?->getSize(),
                    'uploaded_by'         => optional($request->user())->id,
                ]);
            }

            $update = [];
            foreach ([
                'judul_spk','pekerja_id','lama_pengerjaan',
                'siklus_pembayaran','spp_id'
            ] as $fld) {
                if ($request->filled($fld)) $update[$fld] = $data[$fld];
            }
            if ($request->filled('tanggal_spk'))   $update['tanggal_spk']   = $data['tanggal_spk'];
            if ($request->filled('tanggal_mulai')) $update['tanggal_mulai'] = $data['tanggal_mulai'];
            $update['fileupload'] = $path;
            $spk->update($update);

            if ($request->has('kapling_id')) {
                $spk->kaplings()->sync($kaplingIds);
            }

            if ($request->has('fee')) {
                DB::table('spk_list_fee')->where('spk_id', $spk->id)->delete();

                $now  = now();
                $rows = [];
                foreach ($fees as $row) {
                    if (empty($row['nama_kapling']) && empty($row['pekerjaan']) && empty($row['upah'])) {
                        continue;
                    }
                    $rows[] = [
                        'spk_id'       => $spk->id,
                        'nama_kapling' => $row['nama_kapling'] ?? '',
                        'pekerjaan'    => $row['pekerjaan'] ?? '',
                        'upah'         => $row['upah'] ?? 0,
                        'retensi'      => $row['retensi'] ?? 5,
                        'created_at'   => $now,
                        'updated_at'   => $now,
                    ];
                }
                if ($rows) {
                    DB::table('spk_list_fee')->insert($rows);
                }
            }

            DB::commit();
            sweetalert()->success('SPK Mandor/Pekerja Internal berhasil diperbarui.');
            return redirect()->route('spkmandorpekerja/list/page');

        } catch (\Throwable $e) {
            DB::rollBack();
            sweetalert()->error('Update Gagal: '.$e->getMessage());
            return back()->withInput();
        }
    }

    // public function updateSubcon(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'id'   => 'required|exists:surat_perintah_kerja,id',
    //         'fee'  => 'nullable|array',
    //         'fee.*.nama_kapling'      => 'nullable|string|max:150',
    //         'fee.*.nama_termin'       => 'nullable|string|max:255',
    //         'fee.*.persen_pekerjaan'  => 'nullable|string|max:255',
    //         'fee.*.persen_pembayaran' => 'nullable|string|max:255',
    //         'fee.*.nilai_termin'      => 'nullable|string|max:255',
    //         'fee.*.retensi'           => 'nullable|integer|min:0|max:100',

    //         // induk lain kalau ada:
    //         'judul_spk'                    => 'nullable|string|max:200',
    //         'tanggal_spk'                  => 'nullable|date_format:d/m/Y',
    //         'fileupload'                   => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png,doc,docx',
    //         'pekerja_id'                   => 'nullable|exists:pekerja_simandor,id',
    //         'tanggal_mulai'                => 'nullable|date_format:d/m/Y',
    //         'lama_pengerjaan'              => 'nullable|integer|min:1',
    //         'dibuat_oleh'                  => 'nullable|string|max:255',
    //         'status_spk'                   => 'nullable|string|max:255',
    //         'tipe_pembayaran'              => 'nullable|string|max:255',
    //         'spp_id'                       => 'nullable|exists:surat_perintah_pembangunan,id',
    //         'nominal_perjanjian'           => 'nullable|string|max:255',
    //         'total_persentase_pembayaran'  => 'nullable|string|max:255',
    //         'total_nilai_termin'           => 'nullable|string|max:255',
    //         'grand_total_persentase_pembayaran' => 'nullable|string|max:255',
    //         'grand_total_nilai_termin'     => 'nullable|string|max:255',
    //     ]);

    //     if ($validator->fails()) {
    //         sweetalert()->error('Validasi gagal.');
    //         return back()->withErrors($validator)->withInput();
    //     }

    //     DB::beginTransaction();
    //     try {
    //         $data = $validator->validated();
    //         $spk  = SuratPerintahKerjaInternal::findOrFail($data['id']);

    //         $update = [];
    //         foreach ([
    //             'judul_spk','pekerja_id','lama_pengerjaan','tipe_pembayaran',
    //             'dibuat_oleh','status_spk','spp_id',
    //             'nominal_perjanjian','total_nilai_termin','grand_total_nilai_termin',
    //             'total_persentase_pembayaran','grand_total_persentase_pembayaran'
    //         ] as $f) {
    //             if ($request->filled($f)) $update[$f] = $request->input($f);
    //         }
    //         if ($request->filled('tanggal_spk'))   $update['tanggal_spk']   = Carbon::createFromFormat('d/m/Y', $request->input('tanggal_spk'))->format('Y-m-d');
    //         if ($request->filled('tanggal_mulai')) $update['tanggal_mulai'] = Carbon::createFromFormat('d/m/Y', $request->input('tanggal_mulai'))->format('Y-m-d');

    //         $path = $spk->fileupload;
    //         if ($request->hasFile('fileupload')) {
    //             if ($path) Storage::disk('public')->delete($path);
    //             $path = $request->file('fileupload')->store('spk_files', 'public');
    //         }
    //         if ($path !== $spk->fileupload) $update['fileupload'] = $path;
    //         if ($update) $spk->update($update);

    //         if ($request->has('kapling_id')) {
    //             $spk->kaplings()->sync($request->input('kapling_id', []));
    //         }

    //         // HAPUS semua detail lama
    //         DB::table('spk_list_fee')->where('spk_id', $spk->id)->delete();

    //         // INSERT ulang SEMUA baris fee (pakai foreach biar nggak masalah index bolong)
    //         if (is_array($request->fee)) {
    //             foreach ($request->fee as $row) {
    //                 $detail = new SuratPerintahKerjaInternalListFee();
    //                 $detail->spk_id            = $spk->id;
    //                 $detail->nama_kapling      = $row['nama_kapling']      ?? null;
    //                 $detail->nama_termin       = $row['nama_termin']       ?? null;
    //                 $detail->persen_pekerjaan  = $row['persen_pekerjaan']  ?? null;
    //                 $detail->persen_pembayaran = $row['persen_pembayaran'] ?? null;
    //                 $detail->nilai_termin      = isset($row['nilai_termin']) ? preg_replace('/[^\d.-]/','', $row['nilai_termin']) : 0;
    //                 $detail->retensi           = $row['retensi'] ?? 5;

    //                 // salin total & nominal (kalau skema-mu memang menyimpan per baris)
    //                 $detail->nominal_perjanjian                = $request->input('nominal_perjanjian');
    //                 $detail->total_nilai_termin                = $request->input('total_nilai_termin');
    //                 $detail->total_persentase_pembayaran       = $request->input('total_persentase_pembayaran');
    //                 $detail->grand_total_nilai_termin          = $request->input('grand_total_nilai_termin');
    //                 $detail->grand_total_persentase_pembayaran = $request->input('grand_total_persentase_pembayaran');

    //                 $detail->save();
    //             }
    //         }

    //         DB::commit();
    //         sweetalert()->success('SPK Subcon berhasil diperbarui.');
    //         return redirect()->route('spkmandorpekerja/list/page');

    //     } catch (\Throwable $e) {
    //         DB::rollBack();
    //         sweetalert()->error('Update Gagal: '.$e->getMessage());
    //         return back()->withInput();
    //     }
    // }

    public function updateSubcon(Request $request)
    {
        $rules = [
            'id'                           => 'nullable|exists:surat_perintah_kerja,id',
            'judul_spk'                    => 'nullable|string|max:200',
            'tanggal_spk'                  => 'nullable|date_format:d/m/Y',
            'fileupload'                   => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png,doc,docx',
            'pekerja_id'                   => 'nullable|exists:pekerja_simandor,id',
            'tanggal_mulai'                => 'nullable|date_format:d/m/Y',
            'lama_pengerjaan'              => 'nullable|integer|min:1',
            'dibuat_oleh'                  => 'nullable|string|max:255',
            'status_spk'                   => 'nullable|string|max:255',
            'tipe_pembayaran'              => 'nullable|string|max:255',
            'spp_id'                       => 'nullable|exists:surat_perintah_pembangunan,id',
            'kapling_id'                   => 'nullable|array',
            'kapling_id.*'                 => 'integer|exists:kapling,id',
            'nominal_perjanjian'           => 'nullable|string|max:255',
            'total_persentase_pembayaran'  => 'nullable|string|max:255',
            'total_nilai_termin'           => 'nullable|string|max:255',
            'grand_total_persentase_pembayaran' => 'nullable|string|max:255',
            'grand_total_nilai_termin'     => 'nullable|string|max:255',
            'fee'                          => 'nullable|array',
            'fee.*.nama_kapling'           => 'nullable|string|max:150',
            'fee.*.nama_termin'            => 'nullable|string|max:255',
            'fee.*.persen_pekerjaan'       => 'nullable|string|max:255',
            'fee.*.persen_pembayaran'      => 'nullable|string|max:255',
            'fee.*.nilai_termin'           => 'nullable|string|max:255',
            'fee.*.retensi'                => 'nullable|integer|min:0|max:100',
        ];
        $data = $request->validate($rules);

        $id         = $request->input('id');
        $sppId      = $request->input('spp_id');
        $kaplingIds = $request->input('kapling_id', []);
        $fees       = $request->input('fee', []);

        if (!$id) {
            sweetalert()->error('ID SPK tidak ditemukan.');
            return back()->withInput();
        }

        DB::beginTransaction();
        try {
            $spk = SuratPerintahKerjaInternal::findOrFail($id);

            if ($sppId && !empty($kaplingIds)) {
                $allowedKaplings = DB::table('spp_kapling')
                    ->where('spp_id', $sppId)
                    ->pluck('kapling_id')->all();

                if (array_diff($kaplingIds, $allowedKaplings)) {
                    throw ValidationException::withMessages([
                        'kapling_id' => 'Ada kapling yang tidak termasuk dalam SPP yang dipilih.'
                    ]);
                }
            }

            $path = null;
            if ($request->hasFile('fileupload')) {
                $path = $request->file('fileupload')->store('spk_files', 'public');
            }

            if ($path) { 
                $uploaded = $request->file('fileupload');
                ArsipFile::create([
                    'arsipmultimenu_type' => get_class($spk),
                    'arsipmultimenu_id'   => $spk->id,
                    'nama_arsip'          => $data['judul_spk'] ?? 'Lampiran SPK',
                    'nomor_arsip'         => null,
                    'tanggal_arsip'       => $data['tanggal_spk'],
                    'disk'                => 'public',
                    'file_arsip'          => $path,
                    'keterangan_arsip'    => 'Lampiran SPK Mandor/Pekerja Subcon',
                    'original_name'       => $uploaded?->getClientOriginalName(),
                    'mime_type'           => $uploaded?->getClientMimeType(),
                    'file_size'           => $uploaded?->getSize(),
                    'uploaded_by'         => optional($request->user())->id,
                ]);
            }

            $update = [];
            foreach ([
                'judul_spk','pekerja_id','lama_pengerjaan','tipe_pembayaran','tanggal_mulai',
                'dibuat_oleh','status_spk','spp_id',
                'nominal_perjanjian','total_nilai_termin','grand_total_nilai_termin',
                'total_persentase_pembayaran','grand_total_persentase_pembayaran'
            ] as $fld) {
                if ($request->filled($fld)) $update[$fld] = $data[$fld];
            }


            if ($request->filled('tanggal_spk')) {
                $update['tanggal_spk'] = Carbon::createFromFormat('d/m/Y', $data['tanggal_spk'])->format('Y-m-d');
            }
            if ($request->filled('tanggal_mulai')) {
                $update['tanggal_mulai'] = Carbon::createFromFormat('d/m/Y', $data['tanggal_mulai'])->format('Y-m-d');
            }

            $update['fileupload'] = $path;
            $spk->update($update);

            if ($request->has('kapling_id')) {
                $spk->kaplings()->sync($kaplingIds);
            }

            if ($request->has('fee')) {
                DB::table('spk_list_fee')->where('spk_id', $spk->id)->delete();

                $now  = now();
                $rows = [];
                foreach ($fees as $row) {
                    $rows[] = [
                        'spk_id'                           => $spk->id,
                        'nama_kapling'                     => $row['nama_kapling'] ?? null,
                        'nama_termin'                      => $row['nama_termin'] ?? null,
                        'persen_pekerjaan'                 => $row['persen_pekerjaan'] ?? null,
                        'persen_pembayaran'                => $row['persen_pembayaran'] ?? null,
                        'nilai_termin'                     => $row['nilai_termin'] ?? 0,
                        'retensi'                          => $row['retensi'] ?? 5,
                        'nominal_perjanjian'               => $request->nominal_perjanjian ?? null,
                        'total_nilai_termin'               => $request->total_nilai_termin ?? null,
                        'total_persentase_pembayaran'      => $request->total_persentase_pembayaran ?? null,
                        'grand_total_nilai_termin'         => $request->grand_total_nilai_termin ?? null,
                        'grand_total_persentase_pembayaran'=> $request->grand_total_persentase_pembayaran ?? null,
                        'created_at'                       => $now,
                        'updated_at'                       => $now,
                    ];
                }
                if ($rows) {
                    DB::table('spk_list_fee')->insert($rows);
                }
            }

            DB::commit();
            sweetalert()->success('SPK Mandor/Pekerja Internal berhasil diperbarui.');
            return redirect()->route('spkmandorpekerja/list/page');

        } catch (\Throwable $e) {
            DB::rollBack();
            sweetalert()->error('Update Gagal: '.$e->getMessage());
            return back()->withInput();
        }
    }


    public function storeAjax(Request $request)
    {
        $data = $request->validate([
            'nama_pekerja'   => 'required|string|max:100',
            'alamat' => 'nullable|string|max:255',
            'no_hp'  => 'required|string|max:30',
        ]);

        $id = DB::table('pekerja_simandor')->insertGetId([
            'nama_pekerja' => $data['nama_pekerja'],
            'alamat' => $data['alamat'] ?? null,
            'no_hp' => $data['no_hp'],
            'created_at' => now(), 'updated_at' => now()
        ]);

        return response()->json([
            'id' => $id,
            'text' => $data['nama_pekerja'].' ('.$data['no_hp'].')'
        ]);
    }

    public function kaplingBySpp(Request $request)
    {
        $request->validate(['spp_id' => 'required|exists:surat_perintah_pembangunan,id']);

        $rows = DB::table('spp_kapling')
            ->join('kapling','kapling.id','=','spp_kapling.kapling_id')
            ->leftJoin('cluster','cluster.id','=','kapling.cluster_id')
            ->where('spp_kapling.spp_id', $request->spp_id)
            ->orderBy('kapling.blok_kapling')
            ->select(
                'kapling.id',
                'kapling.blok_kapling',
                'kapling.nomor_unit_kapling',
                'cluster.nama_cluster'
            )->get();

        $options = $rows->map(function($r){
            return [
                'id' => $r->id,
                'text' => "{$r->blok_kapling} - {$r->nomor_unit_kapling} \\ {$r->nama_cluster}"
            ];
        });

        return response()->json($options);
    }

    public function kaplingsBySpp(Request $request)
    {
        $request->validate(['spp_id' => 'required|exists:surat_perintah_pembangunan,id']);

        $rows = DB::table('spp_kapling')
            ->join('kapling','kapling.id','=','spp_kapling.kapling_id')
            ->leftJoin('cluster','cluster.id','=','kapling.cluster_id')
            ->where('spp_kapling.spp_id', $request->spp_id)
            ->orderBy('kapling.blok_kapling')
            ->select(
                'kapling.id',
                'kapling.blok_kapling',
                'kapling.nomor_unit_kapling',
                'cluster.nama_cluster'
            )->get();

        $options = $rows->map(function($r){
            return [
                'id' => $r->id,
                'text' => "{$r->blok_kapling} - {$r->nomor_unit_kapling} \\ {$r->nama_cluster}"
            ];
        });

        return response()->json($options);
    }

    public function delete(Request $request): JsonResponse
    {
        $data = $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'integer|exists:surat_perintah_kerja,id',
        ], [
            'ids.required'   => 'Tidak ada data yang dipilih.',
            'ids.array'      => 'Format data tidak valid.',
            'ids.*.exists'   => 'Ada data SPP yang tidak ditemukan.',
        ]);

        try {
            DB::beginTransaction();
            $list = SuratPerintahKerjaInternal::whereIn('id', $data['ids'])->get();
            foreach ($list as $spp) {
                $spp->kaplings()->detach();
                $spp->delete();
            }

            DB::commit();

            return response()->json(['status' => 'success']);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal menghapus: '.$e->getMessage()
            ], 500);
        }
    }

    public function getSpkMandorPekerja(Request $request)
    {
        $draw            = intval($request->get('draw'));
        $start           = intval($request->get("start", 0));
        $length          = intval($request->get("length", 10));
        $order_arr       = $request->get('order', []);
        $columns_arr     = $request->get('columns', []);
        $columnIndex     = $order_arr[0]['column'] ?? 0;
        $columnName      = $columns_arr[$columnIndex]['data'] ?? 'created_at';
        $columnSortOrder = $order_arr[0]['dir'] ?? 'desc';

        $sortable = ['nomor_spk','tanggal_spk','created_at','id'];
        if (!in_array($columnName, $sortable)) {
            $columnName = 'created_at';
        }

        $baseQuery = SuratPerintahKerjaInternal::query();

        $totalRecords = (clone $baseQuery)->count();

        $tableName  = (new SuratPerintahKerjaInternal)->getTable();
        $cols       = Schema::getColumnListing($tableName);
        $sortColumn = in_array($columnName, $cols, true) ? $columnName : 'id';
        $sortDir    = strtolower($columnSortOrder) === 'desc' ? 'desc' : 'asc';

        $records = (clone $baseQuery)
            ->orderBy($sortColumn, $sortDir)
            ->skip($start)
            ->take($length)
            ->get(['id','nomor_spk','tanggal_spk','status_spk','dibuat_oleh', 'disetujui_oleh','created_at']);

        $records->load([
            'kaplings:id,blok_kapling,nomor_unit_kapling,cluster_id'
        ]);

        $data_arr = [];
        foreach ($records as $idx => $spk) {
            $badges = '';
            foreach ($spk->kaplings as $k) {
                $label = trim(($k->blok_kapling ?? '-') . ' - ' . ($k->nomor_unit_kapling ?? '-') . ' \ ' . ($k->cluster)->nama_cluster);
                $badges .= '<strong><span class="badge badge-info m-1">'.$label.'</span></strong><br>';
            }

            $instruksi = $spk->status_spk ? '<strong><span class="badge badge-info m-1">INTERNAL</span></strong>' : '<strong><span class="badge badge-warning font-weight-bold">SUBCON</span></strong>';

            $checkbox = '<input type="checkbox" class="spkinternal_checkbox" value="'.$spk->id.'">';

            $data_arr[] = [
                "checkbox"       => $checkbox,
                "no"             => $start + $idx + 1,
                "id"             => $spk->id,
                "nomor_spk"      => e($spk->nomor_spk),
                "tanggal_spk"    => $spk->tanggal_spk,
                "status_spk"     => $instruksi,
                "dibuat_oleh"    => $spk->dibuat_oleh,
                "disetujui_oleh" => $spk->disetujui_oleh,
                "kapling_badges" => $badges,
                "aksi" => $spk->disetujui_oleh ? '<strong><span class="badge badge-secondary m-1">Disetujui</span></strong>' : '<button class="btn btn-sm btn-primary buttonedit-sm approve-btn" data-id="'.$spk->id.'"><i class="fas fa-check mr-2"></i>Setujui</button>'
            ];

        }

        return response()->json([
            "draw"            => $draw,
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecords, 
            "data"            => $data_arr
        ])->header('Content-Type', 'application/json');
    }
}
