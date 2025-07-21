<?php

namespace App\Livewire;

use App\Models\Syarat;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class SyaratForm extends Component
{
    public $syaratId;
    public $nama;
    public $batas_hutang;
    public $cash_on_delivery = 0;
    public $persentase_diskon;
    public $periode_diskon;

    public function mount($id = null){
        if($id){
            $syarat = Syarat::findOrFail($id);
            $this->syaratId = $syarat->id;
            $this->nama =  $syarat->nama;
            $this->batas_hutang =  $syarat->batas_hutang;
            $this->cash_on_delivery =  $syarat->cash_on_delivery;
            $this->persentase_diskon =  $syarat->persentase_diskon;
            $this->periode_diskon =  $syarat->periode_diskon;
        }
    }

    public function save(){ 
        $data = $this->validate([
            'nama'              => 'required|string|max:255',
            'batas_hutang'      => 'required|max:255',
            'cash_on_delivery'  => 'required|boolean',
            'persentase_diskon' => 'required|max:255',
            'periode_diskon'    => 'required|max:255',
        ]);

        DB::beginTransaction();
        try {
            Syarat::updateOrCreate(['id' => $this->syaratId], $data);
            DB::commit();

            sweetalert()->success((isset($this->syaratId) ? 'Edit' : 'Tambah') . ' Data Berhasil');
            return redirect()->route('syarat/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->syaratId) ? 'Edit' : 'Tambah') . ' Data Gagal');
        }
    }

    #[Title('Syarat Pembayaran')]
    public function render() {
        return view('syarat.form');
    }
}
