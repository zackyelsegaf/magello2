<?php

namespace App\Livewire;

use App\Models\Konsumen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class KonsumenForm extends Component
{
    public $konsumenId;
    public $nama_konsumen;
    public $nik_konsumen;
    public $no_hp;
    public $status_pengajuan;
    public $jenis_kelamin;
    public $cluster;
    public $provinsi;
    public $kota;
    public $kecamatan;
    public $kelurahan;
    public $alamat_konsumen;
    public $pekerjaan;
    public $marketing;
    public $nik_pasangan;
    public $nama_pasangan;
    public $no_hp_pasangan;

    public function mount($id = null){
        $this->marketing = Auth::user()->name;
        if($id){
            $konsumen = Konsumen::findOrFail($id);
            $this->konsumenId = $konsumen->id;
            $this->nama_konsumen = $konsumen->nama_konsumen;
            $this->nik_konsumen = $konsumen->nik_konsumen;
            $this->no_hp = $konsumen->no_hp;
            $this->status_pengajuan = $konsumen->status_pengajuan;
            $this->jenis_kelamin = $konsumen->jenis_kelamin;
            $this->cluster = $konsumen->cluster;
            $this->provinsi = $konsumen->provinsi;
            $this->kota = $konsumen->kota;
            $this->kecamatan = $konsumen->kecamatan;
            $this->kelurahan = $konsumen->kelurahan;
            $this->alamat_konsumen = $konsumen->alamat_konsumen;
            $this->pekerjaan = $konsumen->pekerjaan;
            $this->marketing = $konsumen->marketing;
            $this->nik_pasangan = $konsumen->nik_pasangan;
            $this->nama_pasangan = $konsumen->nama_pasangan;
            $this->no_hp_pasangan = $konsumen->no_hp_pasangan;
        }
    }

    public function save(){
        $data = $this->validate([
            'nama_konsumen'    => 'required|string|max:255',
            'nik_konsumen'     => 'required|numeric',
            'no_hp'            => 'required|numeric',
            'status_pengajuan' => 'required|string|max:255',
            'jenis_kelamin'    => 'required|string|max:255',
            'cluster'          => 'required|string|max:255',
            'provinsi'         => 'nullable|string|max:255',
            'kota'             => 'nullable|string|max:255',
            'kecamatan'        => 'nullable|string|max:255',
            'kelurahan'        => 'nullable|string|max:255',
            'alamat_konsumen'  => 'nullable|string|max:255',
            'pekerjaan'        => 'required|string|max:255',
            'marketing'        => 'nullable|string|max:255',
            'nik_pasangan'     => 'nullable|numeric',
            'nama_pasangan'    => 'nullable|string|max:255',
            'no_hp_pasangan'   => 'nullable|numeric',
        ]);

        DB::beginTransaction();
        try {
            Konsumen::updateOrCreate(['id' => $this->konsumenId], $data);

            DB::commit();
            sweetalert()->success((isset($this->konsumenId) ? 'Updated' : 'Create new') . ' konsumen successfully :)');
            return redirect()->route('konsumenmarketing/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->konsumenId) ? 'Edit' : 'Tambah') . ' Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    #[Title('Konsumen')]
    public function render() {
        $data_provinsi = DB::table('provinsi')->orderBy('nama', 'asc')->get();
        $data_jenis_kelamin = DB::table('gender')->orderBy('nama', 'asc')->get();
        $data_pekerjaan = DB::table('tipe_pelanggan')->orderBy('nama', 'asc')->get();
        $data_kota = DB::table('kota')->orderBy('nama', 'asc')->get();
        $data_cluster = DB::table('cluster')->orderBy('nama', 'asc')->get();
        $data_status_pengajuan = DB::table('status_pengajuan')->orderBy('nama', 'asc')->get();
        return view('marketing.konsumen.konsumenmarketingaddnew', compact('data_kota', 'data_provinsi', 'data_jenis_kelamin', 'data_pekerjaan', 'data_cluster', 'data_status_pengajuan'));
    }
}
