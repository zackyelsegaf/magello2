<?php

namespace App\Livewire\BukuBesar;

use App\Models\Akun;
use App\Models\MataUang;
use App\Models\TipeAkun;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class AkunForm extends Component
{
    public $akunId;
    public $tipe_id;
    public $parent_id;
    public $no_akun;
    public $nama_akun_indonesia;
    public $nama_akun_inggris;
    public $mata_uang_id;
    public $saldo_akun;
    public $tanggal;
    public $dihentikan;

    public function mount($id = null){
        if($id){
            $akun = Akun::findOrFail($id);
            $this->akunId = $akun->id;
            $this->tipe_id = $akun->tipe_id;
            $this->parent_id = $akun->parent_id;
            $this->no_akun = $akun->no_akun;
            $this->nama_akun_indonesia = $akun->nama_akun_indonesia;
            $this->nama_akun_inggris = $akun->nama_akun_inggris;
            $this->mata_uang_id = $akun->mata_uang_id;
            $this->saldo_akun = $akun->saldo_akun;
            $this->tanggal = $akun->tanggal;
            $this->dihentikan = $akun->dihentikan;
        }
    }

    public function save(){
        $data = $this->validate([
            'no_akun'               => 'nullable|string|max:255',
            'tipe_id'               => 'required|integer',
            'nama_akun_indonesia'   => 'nullable|string|max:255',
            'nama_akun_inggris'     => 'nullable|string|max:255',
            'mata_uang_id'          => 'nullable|integer',
            'parent_id'             => 'nullable|integer',
            'saldo_akun'            => 'nullable|string|max:255',
            'tanggal'               => 'nullable|string|max:255',
            'dihentikan'            => 'nullable|boolean',
        ]);

        DB::beginTransaction();
        try {
            //prevent wrong values from javascript
            $data['saldo_akun'] = $data['saldo_akun'] == null ? 0 : preg_replace("/\D/", '', $data['saldo_akun']);

            Akun::updateOrCreate(['id' => $this->akunId], $data);
            DB::commit();

            sweetalert()->success((isset($this->akunId) ? 'Edit' : 'Tambah') . ' data berhasil :)');
            return redirect()->route('akun/list/page');
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->akunId) ? 'Edit' : 'Tambah') . ' Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    #[Title('Akun')]
    public function render() {
        $mata_uang = MataUang::all(['nama', 'id']);
        $tipe_akun = TipeAkun::all(['nama', 'id']);
        $nama_akun = Akun::all(['nama_akun_indonesia', 'id']);
        return view('bukubesar.akun.form', compact('mata_uang', 'nama_akun', 'tipe_akun'));
    }
}
