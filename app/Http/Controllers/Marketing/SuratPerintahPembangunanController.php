<?php

namespace App\Http\Controllers\Marketing;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\SuratPerintahPembangunan;
use Illuminate\Support\Carbon;

class SuratPerintahPembangunanController extends Controller
{
    public function SuratPerintahPembangunanList()
    {
        $kapling = DB::table('kapling')->get();
        $cluster = DB::table('cluster')
            ->leftJoin('kapling','kapling.cluster_id','=','cluster.id')
            ->select(
                'cluster.id as cluster_id',
                'cluster.nama_cluster',
                'kapling.id as kapling_id',
                'kapling.blok_kapling',
                'kapling.nomor_unit_kapling'
            )
            ->orderBy('cluster.nama_cluster')
            ->orderBy('kapling.blok_kapling')
            ->get()
            ->groupBy('cluster_id');


        return view('marketing.suratperintahpembangunan.suratperintahpembangunan', compact('kapling', 'cluster'));
    }

    public function SuratPerintahPembangunanAddNew()
    {
        $kapling = DB::table('kapling')->get();

        $cluster = DB::table('cluster')
            ->leftJoin('kapling','kapling.cluster_id','=','cluster.id')
            ->select(
                'cluster.id as cluster_id',
                'cluster.nama_cluster',
                'kapling.id as kapling_id',
                'kapling.blok_kapling',
                'kapling.nomor_unit_kapling'
            )
            ->orderBy('cluster.nama_cluster')
            ->orderBy('kapling.blok_kapling')
            ->get()
            ->groupBy('cluster_id');

        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $nomorPreview = SuratPerintahPembangunan::generateNomorSpp($today);

        return view(
            'marketing.suratperintahpembangunan.suratperintahpembangunanaddnew',
            compact('kapling', 'cluster', 'nomorPreview')
        );

    }

    public function saveRecordSuratPerintahPembangunan(Request $request)
    {
        $rules = [
            'kapling_id'   => 'required|array',
            'kapling_id.*' => 'exists:kapling,id',
            'tanggal_spp'  => 'nullable|date_format:d/m/Y',
            'catatan'      => 'nullable|string',
            'konsumen'     => 'required|boolean',
            'stok'         => 'required|boolean',
        ];

        $messages = [
            'kapling_id.required'   => 'Kapling wajib diisi',
            'kapling_id.array'      => 'Format kapling tidak valid',
            'kapling_id.*.exists'   => 'Ada kapling yang tidak ditemukan',
            'tanggal_spp.date_format'      => 'Tanggal SPP tidak valid',
            'catatan.string'        => 'Catatan harus berupa teks',
            'konsumen.required'     => 'Konsumen harus 0/1',
            'stok.required'         => 'Stok harus 0/1',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            sweetalert()->error('Validasi gagal. Mohon periksa input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $data = $validator->validated();

            if (!empty($data['tanggal_spp'])) {
                $data['tanggal_spp'] = Carbon::createFromFormat('d/m/Y', $data['tanggal_spp'])->format('Y-m-d');
            }
            
            $SPP = new SuratPerintahPembangunan($data);
            $SPP->save();

            $SPP->kaplings()->sync($data['kapling_id']);

            DB::commit();
            sweetalert()->success('Surat Perintah Pembangunan berhasil disimpan.');
            return redirect()->route('suratperintahpembangunan/list/page');

        } catch (\Throwable $e) {
            DB::rollBack();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
    
    public function getDetailJson($id)
    {
        $spp = SuratPerintahPembangunan::with('kaplings:id')
                ->findOrFail($id);

        return response()->json([
            'id'         => $spp->id,
            'nomor_spp'  => $spp->nomor_spp,
            'tanggal_spp'=> $spp->tanggal_spp,
            'catatan'    => $spp->catatan,
            'konsumen'   => $spp->konsumen,
            'stok'       => $spp->stok,
            'kapling_ids'=> $spp->kaplings->pluck('id'),
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'id'          => 'required|exists:surat_perintah_pembangunan,id',
            'kapling_id'  => 'required|array',
            'kapling_id.*'=> 'exists:kapling,id',
            'tanggal_spp' => 'nullable|date_format:Y-m-d',
            'catatan'     => 'nullable|string',
            'instruksi'   => 'required|in:konsumen,stok',
        ];

        $data = $request->validate($rules);

        $spp = SuratPerintahPembangunan::findOrFail($data['id']);

        $spp->update([
            'tanggal_spp' => $data['tanggal_spp'],
            'catatan'     => $data['catatan'],
            'konsumen'    => $data['instruksi'] === 'konsumen' ? 1 : 0,
            'stok'        => $data['instruksi'] === 'stok' ? 1 : 0,
        ]);

        $spp->kaplings()->sync($data['kapling_id']);

        sweetalert()->success('Surat Perintah Pembangunan berhasil diperbarui.');
            return redirect()->route('suratperintahpembangunan/list/page');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['message' => 'Tidak ada data terpilih.'], 422);
        }

        // Normalisasi
        $ids = array_values(array_unique(array_map('intval', $ids)));

        $deleted = [];
        $failed  = []; // [id => pesan]

        DB::beginTransaction();
        try {
            // Ambil semua SPP yang diminta
            $items = SuratPerintahPembangunan::whereIn('id', $ids)->get();

            foreach ($items as $spp) {
                try {
                    // 1) Bersihkan pivot (aman untuk semua DB; kalau pivot sudah CASCADE ini cuma no-op)
                    DB::table('spp_kapling')->where('spp_id', $spp->id)->delete();

                    // 2) Hapus SPP; jika FK anak sudah CASCADE/NULL ON DELETE, ini akan lolos
                    $spp->delete();

                    $deleted[] = $spp->id;

                } catch (QueryException $e) {
                    // Kalau masih ada FK lain yang belum kamu ubah, tangkap di sini
                    $failed[$spp->id] = 'Gagal hapus karena constraint: '.$e->getCode();
                }
            }

            // Kalau ada yang gagal, tetap commit yang berhasil—biar pengguna nggak “semua gagal”
            DB::commit();

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal memproses hapus: '.$e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'Proses hapus selesai',
            'deleted' => $deleted,
            'failed'  => $failed,
        ]);
    }

    public function getSuratPerintahPembangunan(Request $request)
    {
        $draw            = intval($request->get('draw'));
        $start           = intval($request->get("start", 0));
        $length          = intval($request->get("length", 10));
        $order_arr       = $request->get('order', []);
        $columns_arr     = $request->get('columns', []);
        $columnIndex     = $order_arr[0]['column'] ?? 0;
        $columnName      = $columns_arr[$columnIndex]['data'] ?? 'created_at';
        $columnSortOrder = $order_arr[0]['dir'] ?? 'desc';

        $sortable = ['nomor_spp','tanggal_spp','created_at','id'];
        if (!in_array($columnName, $sortable)) {
            $columnName = 'created_at';
        }

        $baseQuery = SuratPerintahPembangunan::query()
            ->withCount('spkInternals');

        $totalRecords = (clone $baseQuery)->count();

        $records = (clone $baseQuery)
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($length)
            ->get(['id','nomor_spp','tanggal_spp','konsumen','stok','created_at']);

        $records->load([
            'kaplings:id,blok_kapling,nomor_unit_kapling,cluster_id'
        ]);

        $data_arr = [];
        foreach ($records as $idx => $spp) {
            $sudahDipakai = $spp->spk_internals_count > 0;
            $badgeClass = $sudahDipakai ? 'badge-info' : 'badge-secondary';
            $statusText = $sudahDipakai ? 'SPK' : 'Pending';

            $badges = '';
            foreach ($spp->kaplings as $k) {
                $label = trim(($k->blok_kapling ?? '-') . ' - ' . ($k->nomor_unit_kapling ?? '-') . ' \ ' . ($k->cluster)->nama_cluster);
                $badges .= '<strong><span class="badge '.$badgeClass.' m-1">'.$label.'</span></strong><br>';
            }

            $instruksi = $spp->konsumen ? 'Marketing' : 'Manajemen';
            $checkbox  = '<input type="checkbox" class="suratperintahpembangunan_checkbox" value="'.$spp->id.'">';

            $data_arr[] = [
                "checkbox"       => $checkbox,
                "no"             => $start + $idx + 1,
                "id"             => $spp->id,
                "nomor_spp"      => e($spp->nomor_spp),
                "tanggal_spp"    => $spp->tanggal_spp,
                "instruksi"      => $instruksi,
                "kapling_badges" => $badges,
                "status"         => $statusText,
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
