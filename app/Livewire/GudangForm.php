<?php

namespace App\Livewire;

use App\Models\Gudang;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class GudangForm extends Component
{
    public $gudangId;
    public $nama_gudang;
    public $alamat_gudang_1;
    public $alamat_gudang_2;
    public $alamat_gudang_3;
    public $penanggung_jawab;
    public $deskripsi;

    public function mount($id = null) {
        if ($id) {
            $gudang = Gudang::findOrFail($id);
            $this->gudangId = $id;
            $this->nama_gudang = $gudang->nama_gudang;
            $this->alamat_gudang_1 = $gudang->alamat_gudang_1;
            $this->alamat_gudang_2 = $gudang->alamat_gudang_2;
            $this->alamat_gudang_3 = $gudang->alamat_gudang_3;
            $this->penanggung_jawab = $gudang->penanggung_jawab;
            $this->deskripsi = $gudang->deskripsi;
        }
    }

    public function save() {
        $data = $this->validate([
            'nama_gudang'       => 'nullable|string|max:255',
            'alamat_gudang_1'   => 'nullable|string|max:255',
            'alamat_gudang_2'   => 'nullable|string|max:255',
            'alamat_gudang_3'   => 'nullable|string|max:255',
            'penanggung_jawab'  => 'nullable|string|max:255',
            'deskripsi'         => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            Gudang::updateOrCreate(['id' => $this->gudangId], $data);
            DB::commit();

            sweetalert()->success((isset($this->kategoriId) ? 'Edit' : 'Tambah') . ' data berhasil :)');
            return redirect()->route('gudang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->kategoriId) ? 'Edit' : 'Tambah') . ' data gagal :(');
            return redirect()->back();
        }
    }

    #[Title('Gudang')]
    public function render() {
        return view('gudang.form');
    }
}
