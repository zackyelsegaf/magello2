<?php

namespace App\Livewire\BukuBesar;

use App\Models\Akun;
use Livewire\Component;
use App\Models\AnggaranAkun;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;

class AnggaranAkunForm extends Component
{
    public $anggaranId;
    public $no_akun;
    public $nama_akun;
    public $akun_id;
	public $nilai_saldo_awal = 0;
	public $periode_1 = 0;
	public $periode_2 = 0;
	public $periode_3 = 0;
	public $periode_4 = 0;
	public $periode_5 = 0;
	public $periode_6 = 0;
	public $periode_7 = 0;
	public $periode_8 = 0;
	public $periode_9 = 0;
	public $periode_10 = 0;
	public $periode_11 = 0;
	public $periode_12 = 0;
	public $tampilkan_peringatan = false;
	public $tahun;

    public function mount($id = null){
        if($id){
            $anggaran = AnggaranAkun::findOrFail($id);
            $this->anggaranId = $anggaran->id;
            $this->nilai_saldo_awal = $anggaran->nilai_saldo_awal;
            $this->periode_1 = $anggaran->periode_1;
            $this->periode_2 = $anggaran->periode_2;
            $this->periode_3 = $anggaran->periode_3;
            $this->periode_4 = $anggaran->periode_4;
            $this->periode_5 = $anggaran->periode_5;
            $this->periode_6 = $anggaran->periode_6;
            $this->periode_7 = $anggaran->periode_7;
            $this->periode_8 = $anggaran->periode_8;
            $this->periode_9 = $anggaran->periode_9;
            $this->periode_10 = $anggaran->periode_10;
            $this->periode_11 = $anggaran->periode_11;
            $this->periode_12 = $anggaran->periode_12;
            $this->tampilkan_peringatan = $anggaran->tampilkan_peringatan;
            $this->tahun = $anggaran->tahun;
            $this->addAkun($anggaran->akun_id);
        }
    }

    public function save(){
        $data = $this->validate([
            'akun_id'               => 'required',
            'tahun'                 => 'required|integer',
            'nilai_saldo_awal'      => 'nullable',
            'periode_1'             => 'nullable|numeric',
            'periode_2'             => 'nullable|numeric',
            'periode_3'             => 'nullable|numeric',
            'periode_4'             => 'nullable|numeric',
            'periode_5'             => 'nullable|numeric',
            'periode_6'             => 'nullable|numeric',
            'periode_7'             => 'nullable|numeric',
            'periode_8'             => 'nullable|numeric',
            'periode_9'             => 'nullable|numeric',
            'periode_10'            => 'nullable|numeric',
            'periode_11'            => 'nullable|numeric',
            'periode_12'            => 'nullable|numeric',
            'tampilkan_peringatan'  => 'nullable|boolean',
        ]);

        DB::beginTransaction();
        try {
            //prevent wrong values from javascript
            $data['nilai_saldo_awal'] = $data['nilai_saldo_awal'] == null ? 0 : preg_replace("/\D/", '', $data['nilai_saldo_awal']);

            AnggaranAkun::updateOrCreate(['id' => $this->anggaranId], $data);
            DB::commit();

            sweetalert()->success((isset($this->anggaranId) ? 'Edit' : 'Tambah') . ' data berhasil :)');
            return redirect()->route('anggaranakun/list/page');
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->anggaranId) ? 'Edit' : 'Tambah') . ' Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function addAkun($id){
        $this->akun_id = $id;
        $akun = Akun::find($id);
        $this->no_akun = $akun->no_akun;
        $this->nama_akun = $akun->nama_akun_indonesia;
    }

    #[Title('Anggaran Akun')]
    public function render() {
        return view('bukubesar.anggaranakun.form');
    }
}
