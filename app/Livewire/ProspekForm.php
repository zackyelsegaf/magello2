<?php

namespace App\Livewire;

use App\Models\Prospek;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProspekForm extends Component
{
    public $prospekId;
    public $cluster;
    public $nama;
    public $email;
    public $no_hp;
    public $ditugaskan_ke;
    public $sumber_prospek;
    public $warm_meter;
    public $status = 'Walk In Customer';
    public $tags = []; 

    public function mount($id = null)
    {
        if ($id) {
            $prospek = Prospek::findOrFail($id);

            $this->prospekId      = $prospek->id;
            $this->cluster        = $prospek->cluster;
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
            'cluster'        => 'nullable|string|max:255',
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

    public function getProspek(Request $request)
    {
        $q = Prospek::query();

        if ($nama = $request->input('nama')) {
            $q->where('nama', 'like', "%{$nama}%");
        }
        if ($request->boolean('filter_tanggal')) {
            if ($request->filled('tanggal_awal')) {
                $q->whereDate('created_at', '>=', $request->input('tanggal_awal'));
            }
            if ($request->filled('tanggal_akhir')) {
                $q->whereDate('created_at', '<=', $request->input('tanggal_akhir'));
            }
        }
        if ($cluster = $request->input('cluster')) {
            $q->where('cluster', $cluster);
        }

        return DataTables::of($q)
            ->addIndexColumn()
            ->addColumn('checkbox', fn($r) =>
                '<input type="checkbox" class="prospek_checkbox" value="'.$r->id.'">'
            )
            ->addColumn('calon_kustomer', fn($r) => e($r->nama))
            ->addColumn('marketing', fn($r) => e($r->ditugaskan_ke))
            ->addColumn('status', fn($r) => e($r->status))
            ->addColumn('sumber', fn($r) => e($r->sumber_prospek))
            ->addColumn('klaster', fn($r) => e($r->cluster))
            ->addColumn('dibuat_pada', fn($r) =>
                optional($r->created_at)->format('d M Y H:i') ?? '-'
            )
            ->addColumn('tags_html', function ($r) {
                // normalisasi tags jadi array
                $tags = is_array($r->tags) ? $r->tags : (json_decode($r->tags, true) ?: []);
                if (empty($tags)) return '-';

                // render badges
                return collect($tags)->map(function ($t) {
                    $t = e($t);
                    return "<span class=\"badge badge-info mr-1\">{$t}</span>";
                })->implode(' ');
            })
            ->rawColumns(['checkbox', 'tags_html']) // izinkan HTML utk kolom ini
            ->make(true);
    }
}