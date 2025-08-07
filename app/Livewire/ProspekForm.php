<?php

namespace App\Livewire;

use App\Models\Prospek;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

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

    public function mount($id = null){
        if($id){
            $prospek = Prospek::findOrFail($id);
            $this->prospekId = $prospek->id;
            $this->cluster = $prospek->cluster;
            $this->nama = $prospek->nama;
            $this->email = $prospek->email;
            $this->no_hp = $prospek->no_hp;
            $this->ditugaskan_ke = $prospek->ditugaskan_ke;
            $this->sumber_prospek = $prospek->sumber_prospek;
            $this->warm_meter = $prospek->warm_meter;
            $this->status = $prospek->status;
            $this->tags = json_decode($prospek->tags);
        }
    }

    public function save(){
        $data = $this->validate([
            'cluster' => 'nullable|string|max:255',
            'nama' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'no_hp' => 'nullable|numeric',
            'ditugaskan_ke' => 'nullable|string|max:255',
            'sumber_prospek' => 'nullable|string|max:255',
            'warm_meter' => 'nullable|string|max:255',
        ]);
        $data['status'] = $this->status;
        $data['tags'] = json_encode($this->tags);

        DB::beginTransaction();
        try {
            Prospek::updateOrCreate(['id' => $this->prospekId], $data);

            DB::commit();
            sweetalert()->success((isset($this->prospekId) ? 'Updated' : 'Create new').' prospek successfully :)');
            return redirect()->route('prospek/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->clusterId) ? 'Edit' : 'Tambah').' Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    #[Title('Prospek')]
    public function render() {
        $data_cluster = DB::table('cluster')->orderBy('nama', 'asc')->get();
        $data_user = DB::table('users')->orderBy('nama', 'asc')->get();
        return view('marketing.prospek.prospekaddnew', compact('data_cluster', 'data_user'));
    }
}
