<?php

namespace App\Livewire;

use App\Models\Satuan;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class SatuanForm extends Component
{
    public $satuanId;
    public $nama;

    public function mount($id = null) {
        if ($id) {
            $satuan = Satuan::findOrFail($id);
            $this->satuanId = $id;
            $this->nama = $satuan->nama;
        }
    }

    public function save() {
        $data = $this->validate([
            'nama'          => 'required|string|max:255|unique:satuan',
        ]);

        DB::beginTransaction();
        try {
            Satuan::updateOrCreate(['id' => $this->satuanId], $data);

            DB::commit();
            sweetalert()->success('Create new satuan successfully :)');
            return redirect()->route('satuan/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal :)');
            return redirect()->back();
        }
    }

    #[Title('Satuan')]
    public function render() {
        return view('satuan.form');
    }
}
