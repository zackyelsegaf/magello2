<?php

namespace App\Livewire;

use App\Models\Prospek;
use App\Models\Cluster;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Schema;

class ProspekForm extends Component
{
    

    public $prospekId;
    public $cluster_id;
    public $nama;
    public $email;
    public $no_hp;
    public $ditugaskan_ke;
    public $sumber_prospek;
    public $warm_meter;
    public $status = 'Walk In Customer';
    public $tags = []; 

    public function ProspekList()
    {
        $cluster_id = DB::table('cluster')->get();
        return view('marketing.prospek.prospek', compact('cluster_id'));
    }
    public function mount($id = null)
    {
        if ($id) {
            $prospek = Prospek::findOrFail($id);

            $this->prospekId      = $prospek->id;
            $this->cluster_id        = $prospek->cluster_id;
            $this->nama           = $prospek->nama;
            $this->email          = $prospek->email;
            $this->no_hp          = $prospek->no_hp;
            $this->ditugaskan_ke  = $prospek->ditugaskan_ke;
            $this->sumber_prospek = $prospek->sumber_prospek;
            $this->warm_meter     = $prospek->warm_meter;
            $this->status         = $prospek->status;            
            $this->tags = $this->normalizeTags($prospek->tags);
            $this->dispatch('reinit-selects');
        }
    }

    public function save()
    {
        $data = $this->validate([
            'cluster_id'     => 'nullable|string|max:255',
            'nama'           => 'nullable|string|max:255',
            'email'          => 'nullable|email',
            'no_hp'          => 'nullable|numeric',
            'ditugaskan_ke'  => 'nullable|string|max:255',
            'sumber_prospek' => 'nullable|string|max:255',
            'warm_meter'     => 'nullable|string|max:255',
        ]);

        $data['status'] = $this->status;
        $cleanTags      = array_values(array_unique(array_filter((array) $this->tags, fn ($v) => $v !== null && $v !== '')));
        $data['tags']   = json_encode($cleanTags, JSON_UNESCAPED_UNICODE);

        DB::beginTransaction();
        try {
            Prospek::updateOrCreate(['id' => $this->prospekId], $data);

            DB::commit();
            sweetalert()->success((isset($this->prospekId) ? 'Updated' : 'Create new') . ' prospek successfully :)');
            return redirect()->route('prospek/list/page');
        } catch (\Exception $e) {
            DB::rollBack();
            sweetalert()->error((isset($this->prospekId) ? 'Edit' : 'Tambah') . ' Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    #[Title('Prospek')]
    public function render()
    {
        $data_cluster = DB::table('cluster')->orderBy('nama_cluster', 'asc')->get();
        $data_user    = DB::table('users')->orderBy('name', 'asc')->get();
        $allTags = Prospek::pluck('tags')
            ->flatMap(function ($t) {
                if (is_array($t)) return $t;
                $decoded = json_decode($t, true);
                if (is_array($decoded)) return $decoded;
                if (is_string($t) && $t !== '') {
                    if (function_exists('str_contains') ? str_contains($t, ',') : (strpos($t, ',') !== false)) {
                        return array_map('trim', explode(',', $t));
                    }
                    return [trim($t)];
                }
                return [];
            })
            ->filter(fn ($v) => $v !== null && $v !== '')
            ->unique()
            ->sort()
            ->values()
            ->all();

        return view('marketing.prospek.prospekaddnew', compact('data_cluster', 'data_user', 'allTags'));
    }

    private function normalizeTags($value): array
    {
        if (is_array($value)) {
            return array_values(array_filter(array_map('trim', $value), fn ($v) => $v !== ''));
        }

        if (is_string($value) && $value !== '') {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                return array_values(array_filter(array_map('trim', $decoded), fn ($v) => $v !== ''));
            }
            if (function_exists('str_contains') ? str_contains($value, ',') : (strpos($value, ',') !== false)) {
                return array_values(array_filter(array_map('trim', explode(',', $value)), fn ($v) => $v !== ''));
            }
            return [trim($value)];
        }

        return [];
    }

    public function getProspek(Request $request) {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama');
        $clusterFilter      = $request->get('cluster');
        $tanggalFilter      = $request->get('filter_tanggal');
        $tanggalAwalFilter  = $request->get('tanggal_awal');
        $tanggalAkhirFilter = $request->get('tanggal_akhir');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $prospek = Prospek::query()
            ->with([
                'cluster',
            ]);
        $totalRecords = Prospek::count();

        if ($namaFilter) {
            $prospek->where('nama', 'like', '%' . $namaFilter . '%');
        }
        if ($clusterFilter) {
            $prospek->where('id', 'like', '%' . $clusterFilter . '%');
        }


        $totalRecordsWithFilter = $prospek->count();

        // $records = $prospek
        //     ->orderBy($columnName, $columnSortOrder)
        //     ->skip($start)
        //    ->take($length)
        //     ->get();

        $tableName  = (new Prospek)->getTable();
        $cols       = Schema::getColumnListing($tableName);
        $sortColumn = in_array($columnName, $cols, true) ? $columnName : 'id';
        $sortDir    = strtolower($columnSortOrder) === 'desc' ? 'desc' : 'asc';

        $records = $prospek->orderBy($sortColumn, $sortDir)->skip($start)->take($length)->get();

        if($tanggalFilter && $tanggalAwalFilter && $tanggalAkhirFilter){
            $tanggalAwal = Carbon::parse($tanggalAwalFilter);
            $tanggalAkhir = Carbon::parse($tanggalAkhirFilter);

            $records = $records->filter(function ($prospek) use ($tanggalAwal, $tanggalAkhir) {
                $tanggal = Carbon::parse($prospek->created_at);
                return $tanggal->between($tanggalAwal, $tanggalAkhir);
            });
        }

        $data_arr = [];
        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="prospek_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"       => $checkbox,
                "no"             => $start + $key + 1,
                "id"             => $record->id,
                "calon_kustomer" => $record->nama,
                'marketing'      => $record->ditugaskan_ke,
                "status"         => $record->status,
                'sumber'         => $record->sumber_prospek,
                'cluster_id'     => $record->cluster_id,
                'nama_cluster'   => $record->cluster?->nama_cluster,
                'dibuat_pada'    => date('d/m/Y', strtotime($record->created_at)),
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