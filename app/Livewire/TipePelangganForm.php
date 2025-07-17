<?php

namespace App\Livewire;

use App\Models\TipePelanggan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TipePelangganForm extends Component
{
    public $tipeId;
    public $nama;

    public function mount($id = null){
        if($id){
            $tipe = TipePelanggan::findOrFail($id);
            $this->tipeId = $tipe->id;
            $this->nama = $tipe->nama;
        }
    }

    public function save(){
        $data = $this->validate([
            'nama' => 'required|string|max:255|unique:tipe_pelanggan',
        ]);

        DB::beginTransaction();
        try {
            TipePelanggan::updateOrCreate(['id' => $this->tipeId], $data);
            DB::commit();

            sweetalert()->success((isset($this->tipeId) ? 'Edit' : 'Tambah') . ' Data Berhasil :)');
            return redirect()->route('tipepelanggan/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->tipeId) ? 'Edit' : 'Tambah') . ' Data Gagal :)');
            return redirect()->back();
        }
    }

    public function render() {
        return view('tipepelanggan.form');
    }
}
