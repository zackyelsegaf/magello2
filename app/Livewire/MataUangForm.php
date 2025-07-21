<?php

namespace App\Livewire;

use App\Models\MataUang;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class MataUangForm extends Component
{
    public $mataUangId;
    public $nama;
    public $kode;
    public $nilai_tukar;

    public function mount($id = null){
        if($id){
            $matauang = MataUang::findOrFail($id);
            $this->mataUangId = $matauang->id;
            $this->nama =  $matauang->nama;
            $this->kode =  $matauang->kode;
            $this->nilai_tukar =  $matauang->nilai_tukar;
        }
    }

    public function save(){ 
        $data = $this->validate([
            'nama'          => 'required|string|max:255',
            'kode'          => 'required|string|max:255|unique:mata_uang,kode,'.$this->mataUangId,
            'nilai_tukar'   => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            MataUang::updateOrCreate(['id' => $this->mataUangId], $data);
            DB::commit();

            sweetalert()->success((isset($this->mataUangId) ? 'Edit' : 'Tambah') . ' Data Berhasil');
            return redirect()->route('matauang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->mataUangId) ? 'Edit' : 'Tambah') . ' Data Gagal');
        }
    }

    #[Title('Mata Uang')]
    public function render() {
        return view('matauang.form');
    }
}
