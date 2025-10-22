<?php

namespace App\Http\Controllers\Marketing;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\SuratPerintahPembangunan;
use App\Models\Kapling;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratPerintahPembangunanController extends Controller
{
    public function SuratPerintahPembangunanList()
    {
        // $kaplingTerpakai = SuratPerintahPembangunan::pluck('kapling_id');
        // $kaplingTersedia = Kapling::whereNotIn('id', $kaplingTerpakai)
        //     ->orderBy('blok_kapling')
        //     ->get();
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

        $lastBookingPerKapling = DB::table('booking_kavling as b')
            ->selectRaw('b.kapling_id, MAX(b.id) as last_booking_id')
            ->groupBy('b.kapling_id');

        $cluster = DB::table('cluster')
            ->join('kapling', 'kapling.cluster_id', '=', 'cluster.id')
            ->joinSub($lastBookingPerKapling, 'lb', function($join){
                $join->on('lb.kapling_id', '=', 'kapling.id');
            })
            ->leftJoin('spp_kapling as spp', 'spp.kapling_id', '=', 'kapling.id')
            ->whereNull('spp.kapling_id')
            ->join('booking_kavling as b', 'b.id', '=', 'lb.last_booking_id')
            ->leftJoin('konsumen as k', 'k.id', '=', 'b.konsumen_id')
            ->select(
                'cluster.id as cluster_id',
                'cluster.nama_cluster',
                'kapling.id as kapling_id',
                'kapling.blok_kapling',
                'kapling.nomor_unit_kapling',
                'b.nomor_booking',
                'b.tanggal_booking',
                'k.nama_1 as konsumen_nama'
            )
            ->orderBy('cluster.nama_cluster')
            ->orderBy('kapling.blok_kapling')
            ->get()
            ->groupBy('cluster_id');

        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $nomorPreview = SuratPerintahPembangunan::generateNomorSpp($today);

        return view('marketing.suratperintahpembangunan.suratperintahpembangunanaddnew', compact('kapling', 'cluster', 'nomorPreview'));

    }

    public function edit($id)
    {
        $spp = SuratPerintahPembangunan::with(['kaplings:id'])->findOrFail($id);
        $kapling = DB::table('kapling')->get();
        $cluster = DB::table('cluster')
            ->leftJoin('kapling','kapling.cluster_id','=','cluster.id')
            ->leftJoin('spp_kapling as spp', 'spp.kapling_id', '=', 'kapling.id')
            ->leftJoin('booking_kavling as b', 'b.kapling_id', '=', 'kapling.id')
            ->leftJoin('konsumen as k', 'k.id', '=', 'b.konsumen_id')
            ->select(
                'cluster.id as cluster_id',
                'cluster.nama_cluster',
                'kapling.id as kapling_id',
                'kapling.blok_kapling',
                'kapling.nomor_unit_kapling'
                ,'k.nama_1 as konsumen_nama'
            )
            ->orderBy('cluster.nama_cluster')
            ->orderBy('kapling.blok_kapling')
            ->get()
            ->groupBy('cluster_id');
        $selectedKaplingIds = $spp->kaplings->pluck('id')->toArray();
        $tanggalSppForForm = $spp->tanggal_spp ? Carbon::parse($spp->tanggal_spp)->format('d/m/Y') : null;
        $tanggalSppHuman = $spp->tanggal_spp ? Carbon::parse($spp->tanggal_spp)->locale('id')->isoFormat('dddd, D MMMM Y') : null;
        return view('marketing.suratperintahpembangunan.suratperintahpembangunanedit', compact('spp', 'kapling', 'cluster', 'selectedKaplingIds', 'tanggalSppForForm', 'tanggalSppHuman'));
    }

    public function cetak($id)
    {
        $spp = SuratPerintahPembangunan::findOrFail($id);

        $spkSub = DB::table('surat_perintah_kerja')
            ->select('spp_id','dibuat_oleh','disetujui_oleh')
            ->where('spp_id', $spp->id)
            ->latest('tanggal_spk')
            ->limit(1);

        $konsumen = DB::table('konsumen')
            ->select('spp_id','dibuat_oleh','disetujui_oleh')
            ->where('spp_id', $spp->id)
            ->latest('tanggal_spk')
            ->limit(1);

        $cluster = DB::table('cluster')
            ->leftJoin('kapling','kapling.cluster_id','=','cluster.id')
            ->leftJoinSub($spkSub, 'spk', function($join){
            })
            ->select(
                'cluster.id as cluster_id',
                'cluster.nama_cluster',
                'kapling.id as kapling_id',
                'kapling.blok_kapling',
                'kapling.nomor_unit_kapling',
                'kapling.luas_tanah',
                'kapling.luas_bangunan',
                'spk.dibuat_oleh',
                'spk.disetujui_oleh'
            )
            ->orderBy('cluster.nama_cluster')
            ->orderBy('kapling.blok_kapling')
            ->get()
            ->groupBy('cluster_id');

        $selectedKaplingIds = $spp->kaplings->pluck('id')->toArray();
        $instruksi = $spp->konsumen ? 'Marketing' : 'Manajemen';
        $kaplingHuman = DB::table('kapling as k')
            ->leftJoin('cluster as c','c.id','=','k.cluster_id')
            ->whereIn('k.id', $selectedKaplingIds ?: [0])
            ->select('k.blok_kapling','k.nomor_unit_kapling','c.nama_cluster')
            ->orderBy('c.nama_cluster')->orderBy('k.blok_kapling')
            ->get()
            ->map(function($r){
                return ($r->blok_kapling ?? '-') . ' - ' . ($r->nomor_unit_kapling ?? '-') . ' \\ ' . ($r->nama_cluster ?? '-');
            })
            ->implode(', ');

        $konsumenNames = DB::table('booking_kavling as booking')
            ->join('konsumen as konsumen','konsumen.id','=','booking.konsumen_id')
            ->whereIn('booking.kapling_id', $selectedKaplingIds ?: [0])
            ->orderBy('konsumen.nama_1')
            ->pluck('konsumen.nama_1')
            ->unique()
            ->implode(', ');  

        $spp->nama_konsumen = $konsumenNames ?: 'Anonymous';

        // $latestKonsumen = DB::table('booking_kavling as b')
        //     ->join('konsumen as k','k.id','=','b.konsumen_id')
        //     ->whereIn('b.kapling_id', $selectedKaplingIds ?: [0])
        //     ->orderByDesc('b.tanggal_booking')
        //     ->value('k.nama_1');

        // $bkmax = DB::table('booking_kavling as b')
        //     ->selectRaw('b.kapling_id, MAX(b.tanggal_booking) as max_tanggal')
        //     ->whereIn('b.kapling_id', $selectedKaplingIds ?: [0])
        //     ->groupBy('b.kapling_id');

        // $cluster = DB::table('cluster')
        //     ->leftJoin('kapling','kapling.cluster_id','=','cluster.id')
        //     ->leftJoinSub($spkSub, 'spk', function($join){})
        //     ->leftJoinSub($bkmax, 'bkmax', function($join){
        //         $join->on('bkmax.kapling_id','=','kapling.id');
        //     })
        //     ->leftJoin('booking_kavling as b', function($join){
        //         $join->on('b.kapling_id','=','kapling.id')
        //             ->on('b.tanggal_booking','=','bkmax.max_tanggal');
        //     })
        //     ->leftJoin('konsumen as k','k.id','=','b.konsumen_id')
        //     ->select(
        //         'cluster.id as cluster_id',
        //         'cluster.nama_cluster',
        //         'kapling.id as kapling_id',
        //         'kapling.blok_kapling',
        //         'kapling.nomor_unit_kapling',
        //         'kapling.luas_tanah',
        //         'kapling.luas_bangunan',
        //         'spk.dibuat_oleh',
        //         'spk.disetujui_oleh',
        //         DB::raw('COALESCE(k.nama_1, "-") as nama_1')
        //     )
        //     ->orderBy('cluster.nama_cluster')
        //     ->orderBy('kapling.blok_kapling')
        //     ->get()
        //     ->groupBy('cluster_id');

        $tanggalSppForForm = $spp->tanggal_spp ? Carbon::parse($spp->tanggal_spp)->format('d/m/Y') : null;
        $tanggalSppHuman = $spp->tanggal_spp ? Carbon::parse($spp->tanggal_spp)->locale('id')->isoFormat('dddd, D MMMM Y') : null;

        $pdf = Pdf::loadView('marketing.suratperintahpembangunan.pdf', compact('spp','spkSub','cluster','selectedKaplingIds','tanggalSppForForm','tanggalSppHuman','kaplingHuman', 'instruksi'))->setPaper('A4','portrait');

        return $pdf->stream('SPP-'.$spp->nomor_spp.'.pdf');
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
            'tanggal_spp.date_format' => 'Tanggal SPP tidak valid',
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

    public function update(Request $request, $id)
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
            'tanggal_spp.date_format' => 'Tanggal SPP tidak valid',
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

            $spp = SuratPerintahPembangunan::findOrFail($id);
            $spp->update($data);

            $spp->kaplings()->sync($data['kapling_id']);

            DB::commit();
            sweetalert()->success('Update SPP successfully :)');
            return redirect()->route('suratperintahpembangunan/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['message' => 'Tidak ada data terpilih.'], 422);
        }

        $ids = array_values(array_unique(array_map('intval', $ids)));

        $deleted = [];
        $failed  = [];

        DB::beginTransaction();
        try {
            $items = SuratPerintahPembangunan::whereIn('id', $ids)->get();

            foreach ($items as $spp) {
                try {
                    DB::table('spp_kapling')->where('spp_id', $spp->id)->delete();
                    $spp->delete();
                    $deleted[] = $spp->id;

                } catch (QueryException $e) {
                    $failed[$spp->id] = 'Gagal hapus karena constraint: '.$e->getCode();
                }
            }

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
            $linkClass = $sudahDipakai ? 'data-toggle="tooltip" data-placement="top" title="Sudah SPK"' : 'data-toggle="tooltip" data-placement="top" title="Belum SPK"';
            $urlSpk = $sudahDipakai ? url('spkmandorpekerjainternal/edit/'.$spp->spkInternals()->latest('tanggal_spk')->value('id')) : '';

            $badges = '';
            foreach ($spp->kaplings as $k) {
                $label = trim(($k->blok_kapling ?? '-') . ' - ' . ($k->nomor_unit_kapling ?? '-') . ' \ ' . ($k->cluster)->nama_cluster);
                $badges .= '<a href="'.$urlSpk.'" '.$linkClass.'><strong><span class="badge '.$badgeClass.' m-1">'.$label.'</span></strong></a><br>';
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
