<?php

namespace App\Livewire;

use App\Models\KategoriBarang;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class KategoriBarangForm extends Component
{
    public $kategoriId;
    public $nama;

    public function mount($id = null) {
        if ($id) {
            $kategori = KategoriBarang::findOrFail($id);
            $this->kategoriId = $id;
            $this->nama = $kategori->nama;
        }
    }

    public function save() {
        $data = $this->validate([
            'nama'          => 'required|string|max:255|unique:kategori_barang',
        ]);

        DB::beginTransaction();
        try {
            KategoriBarang::updateOrCreate(['id' => $this->kategoriId], $data);
            DB::commit();

            sweetalert()->success((isset($this->kategoriId) ? 'Edit' : 'Tambah') . ' data berhasil :)');
            return redirect()->route('kategoribarang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->kategoriId) ? 'Edit' : 'Tambah') . ' data gagal :(');
            return redirect()->back();
        }
    }

    #[Title('Kategori Barang')]
    public function render()
    {
        return view('kategoribarang.form');
    }
}
