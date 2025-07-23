<?php

namespace App\Livewire;

use App\Models\Dokumen;
use App\Models\Pemasok;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class PemasokForm extends Component
{
    public $pemasokId;
    public $pemasok_id;
    public $nama;
	public $status_pemasok_id;
	public $dihentikan = false;
	public $alamat_1;
	public $alamat_2;
	public $alamatpajak_1;
	public $alamatpajak_2;
	public $kode_pos;
	public $provinsi;
	public $kota;
	public $negara;
	public $kontak;
	public $no_telp;
	public $no_fax;
	public $email;
	public $website;
	public $npwp;
	public $pajak_1_id;
	public $pajak_2_id;
	public $no_pkp;
	public $syarat_id;
	public $mata_uang_id;
	public $saldo_awal = 0;
	public $tanggal_saldo_awal;
	public $deskripsi;
    public $memo;
    public $dokumens = [];
    public $activeTab = 'detail';
    public $dokumenIds = [];

    public function mount($id = null){
        if($id){
            $pemasok = Pemasok::findOrFail($id);
            $this->pemasokId = $pemasok->id;
            $this->pemasok_id = $pemasok->pemasok_id;
            $this->nama = $pemasok->nama;
            $this->status_pemasok_id = $pemasok->status_pemasok_id;
            $this->dihentikan = $pemasok->dihentikan;
            $this->alamat_1 = $pemasok->alamat_1;
            $this->alamat_2 = $pemasok->alamat_2;
            $this->alamatpajak_1 = $pemasok->alamatpajak_1;
            $this->alamatpajak_2 = $pemasok->alamatpajak_2;
            $this->kode_pos = $pemasok->kode_pos;
            $this->provinsi = $pemasok->provinsi;
            $this->kota = $pemasok->kota;
            $this->negara = $pemasok->negara;
            $this->kontak = $pemasok->kontak;
            $this->no_telp = $pemasok->no_telp;
            $this->no_fax = $pemasok->no_fax;
            $this->email = $pemasok->email;
            $this->website = $pemasok->website;
            $this->npwp = $pemasok->npwp;
            $this->pajak_1_id = $pemasok->pajak_1_id;
            $this->pajak_2_id = $pemasok->pajak_2_id;
            $this->no_pkp = $pemasok->no_pkp;
            $this->syarat_id = $pemasok->syarat_id;
            $this->mata_uang_id = $pemasok->mata_uang_id;
            $this->saldo_awal = $pemasok->saldo_awal;
            $this->tanggal_saldo_awal = $pemasok->tanggal_saldo_awal;
            $this->deskripsi = $pemasok->deskripsi;
            $this->memo = $pemasok->memo;
            foreach ($pemasok->dokumen as $dok) {
                $this->dokumenIds[] = $dok->id;
                $this->dokumens[] = $dok->file_link;
            }
        }
    }

    public function save() {
        $data = $this->validate([
            'pemasok_id'        => 'required|string|max:255',
            'nama'              => 'required|string|max:255',
            'status_pemasok_id' => 'nullable',
            'dihentikan'        => 'nullable|boolean',
            'alamat_1'          => 'nullable|string|max:255',
            'alamat_2'          => 'nullable|string|max:255',
            'alamatpajak_1'     => 'nullable|string|max:255',
            'alamatpajak_2'     => 'nullable|string|max:255',
            'kode_pos'          => 'nullable|string|max:255',
            'provinsi'          => 'nullable|string|max:255',
            'kota'              => 'nullable|string|max:255',
            'negara'            => 'nullable|string|max:255',
            'kontak'            => 'nullable|string|max:255',
            'no_telp'           => 'nullable|max:255',
            'no_fax'            => 'nullable|max:255',
            'email'             => 'nullable|string|max:255',
            'website'           => 'nullable|string|max:255',
            'npwp'              => 'nullable|max:255',
            'pajak_1_id'        => 'nullable',
            'pajak_2_id'        => 'nullable',
            'no_pkp'            => 'nullable|max:255',
            'syarat_id'         => 'nullable',
            'mata_uang_id'      => 'nullable',
            'saldo_awal'        => 'nullable|string|max:255',
            'tanggal_saldo_awal' => 'nullable|string|max:255',
            'deskripsi'         => 'nullable|string',
            'memo'              => 'nullable|string',
        ]);

        $data['saldo_awal'] = str_replace(['Rp', '.', ' '], '', $data['saldo_awal']);

        DB::beginTransaction();
        try {
            $pemasok = Pemasok::updateOrCreate(['id' => $this->pemasokId], $data);
            //dokumen
            if(!isset($this->pemasokId)){
                //tambah dokumen
                foreach($this->dokumens as $dok){
                    $this->newDokumen($pemasok, $dok);
                }
            }else{
                foreach($this->dokumens as $i => $dok){
                    //kalo idnya masih: edit, kalo habis: tambah
                    if(isset($this->dokumenIds[$i])){
                        $dokumen = Dokumen::find($this->dokumenIds[$i]);
                        $dokumen->file_link = $dok;
                        $dokumen->save();
                    }else{
                        $this->newDokumen($pemasok, $dok);
                    }
                }
            }
            DB::commit();
            
            sweetalert()->success((isset($this->pemasokId) ? 'Edit' : 'Tambah') . ' Data Berhasil');
            return redirect()->route('pemasok/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->pemasokId) ? 'Edit' : 'Tambah') . ' Data Gagal: ' . $e->getMessage());
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

    #[Title('Pemasok')]
    public function render() {
        $data = [
            'status'            => DB::table('status_pemasok')->get(),
            'mata_uang'         => DB::table('mata_uang')->orderBy('nama', 'asc')->get(),
            'pajak'             => DB::table('pajak')->orderBy('nama', 'asc')->get(),
            'syarat'            => DB::table('syarat')->orderBy('nama', 'asc')->get(),
        ];

        if(!isset($this->pemasokId)){
            $latest = Pemasok::orderBy('pemasok_id', 'desc')->first();
            $nextID = $latest ? intval(substr($latest->pemasok_id, 3)) + 1 : 1;
            $this->pemasok_id = 'TB-' . sprintf("%04d", $nextID);
        }
        if(count($this->dokumens) < 1){
            $this->dokumens[] = '';
        }

        return view('pemasok.form', $data);
    }
}
