<?php

namespace App\Livewire;

use App\Models\Dokumen;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class PelangganForm extends Component
{
    public $pelangganId;
    public $kode_pelanggan;
    public $nama;
    public $status_id;
    public $nik;
    public $tipe_pelanggan_id;
    public $penjual_id;
    public $npwp;
    public $nppkp;
    public $pajak_1_id;
    public $pajak_2_id;
    public $syarat_id;
    public $level_harga;
    public $diskon_penjualan;
    public $mata_uang_id;
    public $saldo_awal;
    public $tanggal_saldo_awal;
    public $batas_maks_hutang;
    public $batas_umur_hutang;
    public $deskripsi;
    public $alamat_1;
    public $alamat_2;
    public $alamatpajak_1;
    public $alamatpajak_2;
    public $provinsi;
    public $kota;
    public $negara;
    public $kode_pos;
    public $kontak;
    public $no_telp;
    public $no_fax;
    public $email;
    public $website;
    public $dihentikan = false;
    public $memo;
    public $dokumens = [];
    public $activeTab = 'detail';
    public $dokumenIds = [];

    public function mount($id = null){
        if($id){
            $pelanggan = Pelanggan::findOrFail($id);
            $this->pelangganId = $pelanggan->id;
            $this->kode_pelanggan = $pelanggan->kode_pelanggan;
            $this->nama = $pelanggan->nama;
            $this->status_id = $pelanggan->status_id;
            $this->nik = $pelanggan->nik;
            $this->tipe_pelanggan_id = $pelanggan->tipe_pelanggan_id;
            $this->penjual_id = $pelanggan->penjual_id;
            $this->npwp = $pelanggan->npwp;
            $this->nppkp = $pelanggan->nppkp;
            $this->pajak_1_id = $pelanggan->pajak_1_id;
            $this->pajak_2_id = $pelanggan->pajak_2_id;
            $this->syarat_id = $pelanggan->syarat_id;
            $this->level_harga = $pelanggan->level_harga;
            $this->diskon_penjualan = $pelanggan->diskon_penjualan;
            $this->mata_uang_id = $pelanggan->mata_uang_id;
            $this->saldo_awal = $pelanggan->saldo_awal;
            $this->tanggal_saldo_awal = $pelanggan->tanggal_saldo_awal;
            $this->batas_maks_hutang = $pelanggan->batas_maks_hutang;
            $this->batas_umur_hutang = $pelanggan->batas_umur_hutang;
            $this->deskripsi = $pelanggan->deskripsi;
            $this->alamat_1 = $pelanggan->alamat_1;
            $this->alamat_2 = $pelanggan->alamat_2;
            $this->alamatpajak_1 = $pelanggan->alamatpajak_1;
            $this->alamatpajak_2 = $pelanggan->alamatpajak_2;
            $this->provinsi = $pelanggan->provinsi;
            $this->kota = $pelanggan->kota;
            $this->negara = $pelanggan->negara;
            $this->kode_pos = $pelanggan->kode_pos;
            $this->kontak = $pelanggan->kontak;
            $this->no_telp = $pelanggan->no_telp;
            $this->no_fax = $pelanggan->no_fax;
            $this->email = $pelanggan->email;
            $this->website = $pelanggan->website;
            $this->dihentikan = $pelanggan->dihentikan;
            $this->memo = $pelanggan->memo;
            foreach ($pelanggan->dokumen as $dok) {
                $this->dokumenIds[] = $dok->id;
                $this->dokumens[] = $dok->file_link;
            }
        }
    }

    public function save(){
        $data = $this->validate([
            'kode_pelanggan'    => 'required|string|max:255|unique:pelanggan,kode_pelanggan,'.$this->pelangganId,
            'nama'              => 'required|string|max:255',
            'status_id'         => 'nullable',
            'nik'               => 'nullable|max:255',
            'tipe_pelanggan_id' => 'nullable',
            'penjual_id'        => 'nullable',
            'npwp'              => 'nullable|max:255',
            'nppkp'             => 'nullable|max:255',
            'pajak_1_id'        => 'nullable',
            'pajak_2_id'        => 'nullable',
            'syarat_id'         => 'nullable',
            'level_harga'       => 'nullable|integer|max:5',
            'diskon_penjualan'  => 'nullable|integer',
            'mata_uang_id'      => 'nullable',
            'saldo_awal'        => 'nullable|string|max:255',
            'tanggal_saldo_awal' => 'nullable|string|max:255',
            'batas_maks_hutang' => 'nullable|integer',
            'batas_umur_hutang' => 'nullable|integer',
            'deskripsi'         => 'nullable|string',
            'alamat_1'          => 'nullable|string|max:255',
            'alamat_2'          => 'nullable|string|max:255',
            'alamatpajak_1'     => 'nullable|string|max:255',
            'alamatpajak_2'     => 'nullable|string|max:255',
            'provinsi'          => 'nullable|string|max:255',
            'kota'              => 'nullable|string|max:255',
            'negara'            => 'nullable|string|max:255',
            'kode_pos'          => 'nullable|max:255',
            'kontak'            => 'nullable|string|max:255',
            'no_telp'           => 'nullable|max:255',
            'no_fax'            => 'nullable|max:255',
            'email'             => 'nullable|string|max:255',
            'website'           => 'nullable|string|max:255',
            'dihentikan'        => 'nullable|boolean',
            'memo'              => 'nullable|string|max:255',
        ]);

        $data['saldo_awal'] = str_replace(['Rp', '.', ' '], '', $data['saldo_awal']);

        DB::beginTransaction();
        try {
            $pelanggan = Pelanggan::updateOrCreate(['id' => $this->pelangganId], $data);
            //dokumen
            if(!isset($this->pelangganId)){
                //tambah dokumen
                foreach($this->dokumens as $dok){
                    $this->newDokumen($pelanggan, $dok);
                }
            }else{
                foreach($this->dokumens as $i => $dok){
                    //kalo idnya masih: edit, kalo habis: tambah
                    if(isset($this->dokumenIds[$i])){
                        $dokumen = Dokumen::find($this->dokumenIds[$i]);
                        $dokumen->file_link = $dok;
                        $dokumen->save();
                    }else{
                        $this->newDokumen($pelanggan, $dok);
                    }
                }
            }
            DB::commit();
            
            sweetalert()->success((isset($this->pelangganId) ? 'Edit' : 'Tambah') . ' Data Berhasil');
            return redirect()->route('pelanggan/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->pelangganId) ? 'Edit' : 'Tambah') . ' Data Gagal: ' . $e->getMessage());
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

    #[Title('Pelanggan')]
    public function render() {
        $data = [
            'status'            => DB::table('status_pemasok')->get(),
            'mata_uang'         => DB::table('mata_uang')->orderBy('nama', 'asc')->get(),
            'pajak'             => DB::table('pajak')->orderBy('nama', 'asc')->get(),
            'syarat'            => DB::table('syarat')->orderBy('nama', 'asc')->get(),
            'tipe_pelanggan'    => DB::table('tipe_pelanggan')->orderBy('nama', 'asc')->get(),
        ];

        if(!isset($this->pelangganId)){
            $prefix = 'GMPSCR-';
            $latest = Pelanggan::orderBy('kode_pelanggan', 'desc')->first();
            $nextID = $latest ? intval(substr($latest->kode_pelanggan, strlen($prefix))) + 1 : 1;
            $this->kode_pelanggan = $prefix . sprintf("%04d", $nextID);
        }
        if(count($this->dokumens) < 1){
            $this->dokumens[] = '';
        }

        return view('pelanggan.form', $data);
    }
}
