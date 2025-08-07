<?php

namespace App\Livewire;

use App\Models\Departemen;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class DepartemenForm extends Component
{
    public $departemenId;
    public $departemen_id;
    public $nama_departemen;
    public $nama_kontak;
    public $tipe_departemen;
    public $deskripsi;
    public $dihentikan = false;

    public function mount($id = null){
        if($id){
            $departemen = Departemen::findOrFail($id);
            $this->departemenId = $departemen->id;
            $this->departemen_id = $departemen->departemen_id;
            $this->nama_departemen = $departemen->nama_departemen;
            $this->nama_kontak = $departemen->nama_kontak;
            $this->tipe_departemen = $departemen->tipe_departemen;
            $this->deskripsi = $departemen->deskripsi;
            $this->dihentikan = $departemen->dihentikan;
        }
    }

    public function save(){ 
        $data = $this->validate([
            'departemen_id'   => 'required|string|max:255|unique:departemen,departemen_id,'.$this->departemenId,
            'nama_departemen' => 'nullable|string|max:255',
            'nama_kontak'     => 'nullable|string|max:255',
            'tipe_departemen' => 'required|string|max:255',
            'dihentikan'      => 'nullable|boolean',
            'deskripsi'       => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            Departemen::updateOrCreate(['id' => $this->departemenId], $data);
            DB::commit();

            sweetalert()->success((isset($this->departemenId) ? 'Edit' : 'Tambah') . ' Data Berhasil');
            return redirect()->route('departemen/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->departemenId) ? 'Edit' : 'Tambah') . ' Data Gagal');
        }
    }

    #[Title('Departemen')]
    public function render() {
        $tipe = DB::table('tipe_departemen')->orderBy('nama', 'asc')->get();
        if(!isset($this->departemen_id)){
            $prefix = 'GMP-';
            $latest = Departemen::orderBy('departemen_id', 'desc')->first();
            $nextID = $latest ? intval(substr($latest->departemen_id, strlen($prefix))) + 1 : 1;
            $this->departemen_id = $prefix . sprintf("%04d", $nextID);
        }
        
        return view('departemen.form', compact('tipe'));
    }
}
