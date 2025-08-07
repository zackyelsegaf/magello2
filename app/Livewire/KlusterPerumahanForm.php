<?php

namespace App\Livewire;

use App\Models\Cluster;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class KlusterPerumahanForm extends Component
{
    public $clusterId;
    public $nama_cluster;
    public $no_hp;
    public $luas_tanah;
    public $total_unit;
    public $provinsi;
    public $kota;
    public $kecamatan;
    public $kelurahan;
    public $alamat_cluster;

    public function mount($id = null){
        if($id){
            $cluster = Cluster::findOrFail($id);
            $this->clusterId = $cluster->id;
            $this->nama_cluster = $cluster->nama_cluster;
            $this->no_hp = $cluster->no_hp;
            $this->luas_tanah = $cluster->luas_tanah;
            $this->total_unit = $cluster->total_unit;
            $this->provinsi = $cluster->provinsi;
            $this->kota = $cluster->kota;
            $this->kecamatan = $cluster->kecamatan;
            $this->kelurahan = $cluster->kelurahan;
            $this->alamat_cluster = $cluster->alamat_cluster;
        }
    }

    public function save(){
        $data = $this->validate([
            'nama_cluster'   => 'required|string|max:255',
            'no_hp'          => 'nullable|numeric',
            'luas_tanah'     => 'required|numeric',
            'total_unit'     => 'nullable|integer',
            'provinsi'       => 'nullable|string|max:255',
            'kota'           => 'nullable|string|max:255',
            'kecamatan'      => 'nullable|string|max:255',
            'kelurahan'      => 'nullable|string|max:255',
            'alamat_cluster' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            Cluster::updateOrCreate(['id' => $this->clusterId], $data);

            DB::commit();
            sweetalert()->success((isset($this->clusterId) ? 'Updated' : 'Create new').' cluster successfully :)');
            return redirect()->route('klusterperumahan/list/page');
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->clusterId) ? 'Edit' : 'Tambah').' Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    #[Title('Kluster / Perumahan')]
    public function render() {
        $data_provinsi = DB::table('provinsi')->orderBy('nama', 'asc')->get();
        $data_kota = DB::table('kota')->orderBy('nama', 'asc')->get();
        return view('marketing.perumahan.klusterperumahan.klusterperumahanaddnew', compact('data_kota', 'data_provinsi'));
    }
}
