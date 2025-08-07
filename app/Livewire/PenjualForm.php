<?php

namespace App\Livewire;

use App\Models\Dokumen;
use App\Models\Penjual;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class PenjualForm extends Component
{
    public $penjualId;
    public $nama_depan_penjual;
	public $nama_belakang_penjual;
	public $jabatan;
	public $dihentikan = false;
	public $no_kantor_1_penjual;
	public $no_kantor_2_penjual;
	public $no_ekstensi_1_penjual;
	public $no_ekstensi_2_penjual;
	public $no_hp_penjual;
	public $no_telp_penjual;
	public $no_fax_penjual;
	public $pager_penjual;
	public $email_penjual;
	public $memo;
    public $dokumens = [];
    public $activeTab = 'detail';
    public $dokumenIds = [];

    public function mount($id = null){
        if($id){
            $penjual = Penjual::findOrFail($id);
            $this->penjualId = $penjual->id;
            $this->nama_depan_penjual = $penjual->nama_depan_penjual;
            $this->nama_belakang_penjual = $penjual->nama_belakang_penjual;
            $this->jabatan = $penjual->jabatan;
            $this->dihentikan = $penjual->dihentikan;
            $this->no_kantor_1_penjual = $penjual->no_kantor_1_penjual;
            $this->no_kantor_2_penjual = $penjual->no_kantor_2_penjual;
            $this->no_ekstensi_1_penjual = $penjual->no_ekstensi_1_penjual;
            $this->no_ekstensi_2_penjual = $penjual->no_ekstensi_2_penjual;
            $this->no_hp_penjual = $penjual->no_hp_penjual;
            $this->no_telp_penjual = $penjual->no_telp_penjual;
            $this->no_fax_penjual = $penjual->no_fax_penjual;
            $this->pager_penjual = $penjual->pager_penjual;
            $this->email_penjual = $penjual->email_penjual;
            $this->memo = $penjual->memo;
            foreach ($penjual->dokumen as $dok) {
                $this->dokumenIds[] = $dok->id;
                $this->dokumens[] = $dok->file_link;
            }
        }
    }

    public function save(){
        $data = $this->validate([
            'nama_depan_penjual'    => 'required|string|max:255',
            'nama_belakang_penjual' => 'required|string|max:255',
            'jabatan'               => 'nullable|string|max:255',
            'dihentikan'            => 'nullable|boolean',
            'no_kantor_1_penjual'   => 'nullable|string|max:255',
            'no_kantor_2_penjual'   => 'nullable|string|max:255',
            'no_ekstensi_1_penjual' => 'nullable|string|max:255',
            'no_ekstensi_2_penjual' => 'nullable|string|max:255',
            'no_hp_penjual'         => 'nullable|string|max:255',
            'no_telp_penjual'       => 'nullable|string|max:255',
            'no_fax_penjual'        => 'nullable|string|max:255',
            'pager_penjual'         => 'nullable|string|max:255',
            'email_penjual'         => 'nullable|string|max:255',
            'memo'                  => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $penjual = Penjual::updateOrCreate(['id' => $this->penjualId], $data);
            //dokumen
            if(!isset($this->penjualId)){
                //tambah dokumen
                foreach($this->dokumens as $dok){
                    $this->newDokumen($penjual, $dok);
                }
            }else{
                foreach($this->dokumens as $i => $dok){
                    //kalo idnya masih: edit, kalo habis: tambah
                    if(isset($this->dokumenIds[$i])){
                        $dokumen = Dokumen::find($this->dokumenIds[$i]);
                        $dokumen->file_link = $dok;
                        $dokumen->save();
                    }else{
                        $this->newDokumen($penjual, $dok);
                    }
                }
            }
            DB::commit();
            
            sweetalert()->success((isset($this->penjualId) ? 'Edit' : 'Tambah') . ' Data Berhasil');
            return redirect()->route('penjual/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->penjualId) ? 'Edit' : 'Tambah') . ' Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    protected function newDokumen($parent, $link){
        if($link != ''){
            $dokumen = new Dokumen();
            $dokumen->file_link = $link;
            $parent->dokumen()->save($dokumen);
        }
    }

    public function addField(){
        if(count($this->dokumens) < 7){
            $this->dokumens[] = '';
            $this->activeTab = 'dokumen';
        }else{
            sweetalert()->error('Dokumen maksimal 7 field!');
        }
    }
    public function hapusDokumen($index){
        array_splice($this->dokumens, $index , 1);

        if(isset($this->dokumenIds[$index])){
            $dokumenId = $this->dokumenIds[$index];
            Dokumen::destroy($dokumenId);
            array_splice($this->dokumenIds, $index , 1);
        }
        $this->activeTab = 'dokumen';
    }

    #[Title('Penjual')]
    public function render() {
        if(count($this->dokumens) < 1){
            $this->dokumens[] = '';
        }
        return view('penjual.form');
    }
}
