<?php

namespace App\Livewire;

use App\Models\JasaPengiriman;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class JasaPengirimanForm extends Component
{
    public $jasaId;
    public $nama;
    public $jasa_pengiriman;

    public function mount($id = null){
        if($id){
            $jasa = JasaPengiriman::findOrFail($id);
            $this->jasaId = $jasa->id;
            $this->nama =  $jasa->nama;
            $this->jasa_pengiriman =  $jasa->jasa_pengiriman;
        }
    }

    public function save(){ 
        $data = $this->validate([
            'nama'              => 'required|string|max:255',
            'jasa_pengiriman'   => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            JasaPengiriman::updateOrCreate(['id' => $this->jasaId], $data);
            DB::commit();

            sweetalert()->success((isset($this->jasaId) ? 'Edit' : 'Tambah') . ' Data Berhasil');
            return redirect()->route('jasapengiriman/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->jasaId) ? 'Edit' : 'Tambah') . ' Data Gagal');
        }
    }

    #[Title('Jasa Pengiriman')]
    public function render() {
        return view('jasapengiriman.form');
    }
}
