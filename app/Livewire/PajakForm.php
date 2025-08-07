<?php

namespace App\Livewire;

use App\Models\Akun;
use App\Models\Pajak;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class PajakForm extends Component
{
    public $pajakId;
    public $nama;
    public $kode;
    public $nilai_persentase;
    public $akun_pajak_penjualan_id;
    public $akun_pajak_pembelian_id;
    public $deskripsi;

    public function mount($id = null){
        if($id){
            $pajak = Pajak::findOrFail($id);
            $this->pajakId = $pajak->id;
            $this->nama = $pajak->nama;
            $this->kode = $pajak->kode;
            $this->nilai_persentase = $pajak->nilai_persentase;
            $this->akun_pajak_penjualan_id = $pajak->akun_pajak_penjualan_id;
            $this->akun_pajak_pembelian_id = $pajak->akun_pajak_pembelian_id;
            $this->deskripsi = $pajak->deskripsi;
        }
    }

    public function save(){ 
        $data = $this->validate([
            'nama'                      => 'required|string|max:255',
            'kode'                      => 'required|string|max:255|unique:pajak,kode,'.$this->pajakId,
            'nilai_persentase'          => 'required|numeric',
            'akun_pajak_penjualan_id'   => 'nullable',
            'akun_pajak_pembelian_id'   => 'nullable',
            'deskripsi'                 => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            Pajak::updateOrCreate(['id' => $this->pajakId], $data);
            DB::commit();

            sweetalert()->success((isset($this->pajakId) ? 'Edit' : 'Tambah') . ' Data Berhasil');
            return redirect()->route('pajak/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->pajakId) ? 'Edit' : 'Tambah') . ' Data Gagal');
        }
    }

    #[Title('Pajak')]
    public function render() {
        $akun = Akun::all(['nama_akun_indonesia', 'id', 'no_akun']);
        return view('pajak.form', compact('akun'));
    }
}
