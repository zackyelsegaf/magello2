<?php

namespace App\Http\Controllers;

use App\Models\BukuKas;
use App\Models\TransaksiBukuKas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class BukuKasController extends Controller
{
    public function bukuKasList()
    {
        $is_cashbook_dashboard = true;
        $bukuKas = DB::table('buku_kas')->get();
        $kategoriKas = DB::table('kategori_buku_kas')->get();
        $tipeKas = DB::table('tipe_buku_kas')->get();
        return view('keuangan.otorisasipembayaran.bukukas', compact('is_cashbook_dashboard', 'bukuKas', 'kategoriKas', 'tipeKas'));
    }

    public function storeBukuKas(Request $request)
    {
        $rules =  [
            'source'     => 'required|string|in:Payment,Manual,Transfer,Refund',
            'ref_id'     => 'nullable|integer',
            'tanggal'    => 'required|date',
            'total'      => 'required|numeric|min:1',
            'jenis'      => 'required|string|in:Pemasukan,Pengeluaran',
            'cash_id'    => 'required|integer|exists:cash,id',
            'keterangan' => 'nullable|string|max:255',
            'created_by' => 'nullable|integer|exists:users,id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            sweetalert()->warning('Lengkapi inputan wajib!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $data = $validator->validated();
            
            $data['created_by'] = Auth::id();

            $data['tanggal'] = Carbon::parse($data['tanggal'])->format('Y-m-d');

            $bukuKas = new TransaksiBukuKas($data);
            $bukuKas->save();

            DB::commit();
            sweetalert()->success('Transaksi berhasil dibuat!');
            return redirect()->route('buku-kas.list.page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah data transaksi gagal! ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function getBukuKasData(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length          = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $search_arr      = $request->get('search');
        $columnIndex     = $columnIndex_arr[0]['column'];
        $columnName      = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];
        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue     = $search_arr['value'];

        $query = TransaksiBukuKas::query()->with(['buku_kas','kategori_kas','tipe_kas']);
        $totalRecords = TransaksiBukuKas::count();

        $totalRecordsWithFilter = $query->count();

        $tableName  = (new TransaksiBukuKas)->getTable();
        $cols       = Schema::getColumnListing($tableName);
        $sortColumn = in_array($columnName, $cols, true) ? $columnName : 'id';
        $sortDir    = strtolower($columnSortOrder) === 'desc' ? 'desc' : 'asc';

        $records = $query->orderBy($sortColumn, $sortDir)
            ->where(function ($query) use ($searchValue) {
                $query->where('tanggal', 'like', '%' . $searchValue . '%');
                $query->orWhere('nominal', 'like', '%' . $searchValue . '%');
            })->offset($start)->limit($length)->get();

        $data_arr = [];

        foreach ($records as $key => $record) {
            $modify = '
            <td class="text-left">
                <div class="actions">
                    <a href="'.url('buku-kas/ubah/'.$record->id).'" class="btn btn-primary me-2">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-hapus" data-id="'.$record->id.'">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </td>
            ';

            $data_arr[] = [
                "no"           => $start + $key + 1,
                'id'           => $record->id,
                'buku_kas_id'  => $record->buku_kas_id,
                'buku_kas'     => $record->buku_kas?->nama_kas,
                'kategori_id'  => $record->kategori_id,
                'kategori_kas' => $record->kategori_kas?->nama_kategori,
                'tipe_id'      => $record->tipe_id,
                'tipe_kas'     => $record->tipe_kas?->nama,
                // 'tipe_barang'  => '<h5><span class="badge badge-soft-secondary">'.$record->tipe_barang.'</span></h5>',
                // 'kategori'     => '<h5><span class="badge badge-soft-primary">'.$record->kategori.'</span></h5>',
                'tanggal'      => $record->tanggal,
                'nominal'      => '<strong>Rp '. number_format($record->nominal ?? 0, 0, '.', ',') . '</strong>',
                'referensi'    => $record->referensi,
                'keterangan'         => $record->keterangan,
                'modify'       => $modify,
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
