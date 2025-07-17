<?php

namespace App\Livewire;

use App\Models\StatusPemasok;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StatusPemasokForm extends Component
{
    public $statusId;
    public $nama;

    public function mount($id = null){
        if($id){
            $status = StatusPemasok::findOrFail($id);
            $this->statusId = $status->id;
            $this->nama = $status->nama;
        }
    }

    public function save(){
        $data = $this->validate([
            'nama' => 'required|string|max:255|unique:status_pemasok',
        ]);

        DB::beginTransaction();
        try {
            StatusPemasok::updateOrCreate(['id' => $this->statusId], $data);
            DB::commit();

            sweetalert()->success((isset($this->statusId) ? 'Edit' : 'Tambah') . ' Data Berhasil :)');
            return redirect()->route('statuspemasok/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->statusId) ? 'Edit' : 'Tambah') . ' Data Gagal :)');
            return redirect()->back();
        }
    }

    public function render() {
        return view('statuspemasok.form');
    }
}
