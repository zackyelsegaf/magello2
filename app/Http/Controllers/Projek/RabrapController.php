<?php

namespace App\Http\Controllers\Projek;

use App\Models\RabRap;
use App\Models\RabRapItems;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RabrapController extends Controller
{
    public function RabrapList()
    {
        return view("projek.rabrap.rabrap");
    }

    public function RabrapAddNew(Request $request)
    {
        if ($request->ajax()) {
            $nama_barang = DB::table('barang');

            if ($request->no_barang) {
                $nama_barang->where('no_barang', 'like', '%' . $request->no_barang . '%');
            }

            if ($request->nama_barang) {
                $nama_barang->where('nama_barang', 'like', '%' . $request->nama_barang . '%');
            }

            if ($request->kategori_barang) {
                $nama_barang->where('kategori_barang', $request->kategori_barang);
            }
        
            if ($request->tipe_persediaan) {
                $nama_barang->where('tipe_persediaan', $request->tipe_persediaan);
            }

            if ($request->default_gudang) {
                $nama_barang->where('default_gudang', $request->default_gudang);
            }

            $result = $nama_barang->get();
            return response()->json($result);
        }

        $cluster = DB::table('cluster')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $barang = DB::table('barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        $gudang = DB::table('gudang')->get();
        $departemen = DB::table('departemen')->get();
        $proyek = DB::table('proyek')->get();
        $pemasok = DB::table('pemasok')->get();
        $satuan = DB::table('satuan')->get();
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $nama_akun = DB::table('akun')->orderBy('nama', 'asc')->get();
        return view('projek.rabrap.rabrapaddnew', compact('cluster', 'satuan', 'barang', 'tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'proyek', 'pemasok', 'satuan', 'mata_uang', 'nama_akun'));
    }

    public function simpanRabRap(Request $request)
    {
        $rules = [
            'judul_rap'            => 'required|string|max:255',
            'cluster'              => 'required|string|max:255',
            'tanggal_pencatatan'   => 'required|string|max:255',
            'persen_kenaikan_qty'  => 'nullable|string|max:255',
            'tipe_model'           => 'required|string|max:255',
            'total_rap'            => 'nullable|string|max:255',
            'total_rab'            => 'nullable|string|max:255',
            'no_item.*'            => 'nullable|string|max:255',
            'nama_item.*'          => 'nullable|string|max:255',
            'satuan.*'             => 'nullable|string|max:255',
            'rap_qty.*'            => 'required|string|max:255',
            'persen_naik.*'        => 'nullable|string|max:255',
            'rab_qty.*'            => 'nullable|string|max:255',
            'harga_item.*'         => 'nullable|string|max:255',
            'total_rap_item.*'     => 'nullable|string|max:255',
            'total_rab_item.*'     => 'nullable|string|max:255',
        ];

        $message = [
            'judul_rap.required' => 'Judul RAB RAP wajib diisi',
            'cluster.required' => 'Cluster wajib diisi',
            'tipe_model.required' => 'Tipe Model wajib diisi',
            'rap_qty.*.required' => 'Kuantitas RAP wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            $simpanRapRab = new RabRap($validator->validated());
            $simpanRapRab->save();

            $jumlahBarang = count($request->no_item);
            for ($i = 0; $i < $jumlahBarang; $i++){
                $detail = new RabRapItems();
                $detail->rap_rab_id     = $simpanRapRab->id;
                $detail->no_item        = $request->no_item[$i];
                $detail->nama_item      = $request->nama_item[$i];
                $detail->satuan         = $request->satuan[$i];
                $detail->rap_qty        = $request->rap_qty[$i];
                $detail->persen_naik    = $request->persen_naik[$i];
                $detail->rab_qty        = $request->rab_qty[$i];
                $detail->harga_item     = $request->harga_item[$i];
                $detail->total_rap_item = $request->total_rap_item[$i];
                $detail->total_rab_item = $request->total_rab_item[$i];
                $detail->save();
            }
    
            DB::commit();
            sweetalert()->success('Create new Barang & Detail successfully :)');
            return redirect()->route('rabrap/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $cluster = DB::table('cluster')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $barang = DB::table('barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        $gudang = DB::table('gudang')->get();
        $departemen = DB::table('departemen')->get();
        $proyek = DB::table('proyek')->get();
        $pemasok = DB::table('pemasok')->get();
        $satuan = DB::table('satuan')->get();
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $nama_akun = DB::table('akun')->orderBy('nama', 'asc')->get();
        // $penyesuaianBarangEdit = DB::table('penyesuaian_barang')->where('no_penyesuaian',$no_penyesuaian)->first();
        $updateRabRap = RabRap::with(['detail', 'detail2'])->findOrFail($id);
        if (!$updateRabRap) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('projek.rabrap.rabrapupdate', compact('updateRabRap','cluster', 'satuan', 'barang', 'tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'proyek', 'pemasok', 'satuan', 'mata_uang', 'nama_akun'));
    }

    public function updateRabRap(Request $request, $id)
    {
        $rules = [
            'judul_rap'            => 'required|string|max:255',
            'cluster'              => 'required|string|max:255',
            'tanggal_pencatatan'   => 'required|string|max:255',
            'persen_kenaikan_qty'  => 'nullable|string|max:255',
            'tipe_model'           => 'required|string|max:255',
            'total_rap'            => 'nullable|string|max:255',
            'total_rab'            => 'nullable|string|max:255',
            'no_item.*'            => 'nullable|string|max:255',
            'nama_item.*'          => 'nullable|string|max:255',
            'satuan.*'             => 'nullable|string|max:255',
            'rap_qty.*'            => 'required|string|max:255',
            'persen_naik.*'        => 'nullable|string|max:255',
            'rab_qty.*'            => 'nullable|string|max:255',
            'harga_item.*'         => 'nullable|string|max:255',
            'total_rap_item.*'     => 'nullable|string|max:255',
            'total_rab_item.*'     => 'nullable|string|max:255',
        ];

        $message = [
            'judul_rap.required' => 'Judul RAB RAP wajib diisi',
            'cluster.required' => 'Cluster wajib diisi',
            'tipe_model.required' => 'Tipe Model wajib diisi',
            'rap_qty.*.required' => 'Kuantitas RAP wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            $updateRabRap = RabRap::findOrFail($id);
            $updateRabRap->fill($validator->validated());
            $updateRabRap->save();

            RabRapItems::where('rap_rab_id', $id)->delete();

            $jumlahBarang = count($request->no_item);
            for ($i = 0; $i < $jumlahBarang; $i++){
                $detail = new RabRapItems();
                $detail->rap_rab_id     = $updateRabRap->id;
                $detail->no_item        = $request->no_item[$i];
                $detail->nama_item      = $request->nama_item[$i];
                $detail->satuan         = $request->satuan[$i];
                $detail->rap_qty        = $request->rap_qty[$i];
                $detail->persen_naik    = $request->persen_naik[$i];
                $detail->rab_qty        = $request->rab_qty[$i];
                $detail->harga_item     = $request->harga_item[$i];
                $detail->total_rap_item = $request->total_rap_item[$i];
                $detail->total_rab_item = $request->total_rab_item[$i];
                $detail->save();

            }

            DB::commit();
            sweetalert()->success('YUpdate RAP & RAB successfully :)');
            return redirect()->route('rabrap/list/page');

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
            RabRap::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('rabrap/list/page');
        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getRabrap(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length          = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $rapRabJudulRapFilter = $request->get('judul_rap');
        $columnIndex     = $columnIndex_arr[0]['column'];
        $columnName      = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];

        $query = DB::table('rap_rab');

        if ($rapRabJudulRapFilter) {
            $query->where('judul_rap', 'like', '%' . $rapRabJudulRapFilter . '%');
        }

        $totalRecordsWithFilter = $query->count();
        $totalRecords = DB::table('rap_rab')->count();

        $records = $query
            ->orderBy($columnName, $columnSortOrder)
            ->offset($start)
            ->limit($length)
            ->get();

        $data_arr = [];

        foreach ($records as $key => $record) {
            $detail = DB::table('rap_rab_items')
                ->where('rap_rab_id', $record->id)
                ->first();

            $checkbox = '<input type="checkbox" class="raprab_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"                  => $checkbox,
                "no"                        => $start + $key + 1,
                "id"                        => $record->id,
                "judul_rap"                 => $record->judul_rap,
                "tipe_model"                => $record->tipe_model,
                "tanggal_pencatatan"        => $record->tanggal_pencatatan,
                "total_rap"                 => $record->total_rap,
                "total_rab"                 => $record->total_rab,
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
