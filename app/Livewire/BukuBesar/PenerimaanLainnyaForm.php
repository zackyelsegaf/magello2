<?php

namespace App\Livewire\BukuBesar;

use App\Models\Akun;
use App\Models\BukuBesar\DetailPenerimaanLainnya;
use App\Models\BukuBesar\PenerimaanLainnya;
use App\Models\Dokumen;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class PenerimaanLainnyaForm extends Component
{
    public $penerimaanId;
    public $no_penerimaan;
    public $tanggal;
	public $rancangan = 'Penerimaan Lainnya';
	public $diterima_ke_akun_id;
	public $nilai_tukar = 1;
	public $jumlah = 0;
	public $mata_uang_asing = false;
	public $urgent = false;
	public $tindak_lanjut;
	public $catatan_pemeriksaan;
	public $deskripsi;
    public $activeTab = 'detail';
    public $dokumens = [];
    public $dokumenIds = [];
    public $detail = [];
    public $detailIds = [];

    public function mount($id = null){
        if($id){
            $penerimaan = PenerimaanLainnya::findOrFail($id);
            $this->penerimaanId = $penerimaan->id;
            $this->no_penerimaan = $penerimaan->no_penerimaan;
            $this->tanggal = $penerimaan->tanggal;
            $this->rancangan = $penerimaan->rancangan;
            $this->diterima_ke_akun_id = $penerimaan->diterima_ke_akun_id;
            $this->nilai_tukar = $penerimaan->nilai_tukar;
            $this->jumlah = $penerimaan->jumlah;
            $this->mata_uang_asing = $penerimaan->mata_uang_asing;
            $this->urgent = $penerimaan->urgent;
            $this->tindak_lanjut = $penerimaan->tindak_lanjut;
            $this->catatan_pemeriksaan = $penerimaan->catatan_pemeriksaan;
            $this->deskripsi = $penerimaan->deskripsi;
            foreach ($penerimaan->dokumen as $dok) {
                $this->dokumenIds[] = $dok->id;
                $this->dokumens[] = $dok->file_link;
            }
            foreach ($penerimaan->entries as $detail) {
                $this->detailIds[] = $detail->id;
                $this->addAkun($detail->akun_id, $detail);
            }
        }
    }

    public function save(){
        $data = $this->validate([
            'no_penerimaan'       => 'required|string|max:255|unique:penerimaan_lainnya,no_penerimaan,'.$this->penerimaanId,
            'tanggal'             => 'required|string|max:255',
            'rancangan'           => 'nullable|string',
            'diterima_ke_akun_id'=> 'required',
            'nilai_tukar'         => 'nullable|integer',
            'jumlah'              => 'nullable|integer',
            'mata_uang_asing'     => 'nullable|boolean',
            'urgent'              => 'nullable|boolean',
            'tindak_lanjut'       => 'nullable|string',
            'catatan_pemeriksaan' => 'nullable|string',
            'deskripsi'           => 'nullable|string',
        ]);

        if(count($this->detail) === 0){
            sweetalert()->error('Tambahkan setidaknya 1 akun!');
            return;
        }

        $jumlah = 0;
        foreach($this->detail as $detail){
            $jumlah += intval($detail['jumlah']);
        }

        $data['nilai'] = $jumlah;
        $data['user_id'] = auth()->id();

        DB::beginTransaction();
        try {
            $penerimaan = PenerimaanLainnya::updateOrCreate(['id' => $this->penerimaanId], $data);
            foreach($this->detail as $i => $detail){
                DetailPenerimaanLainnya::updateOrCreate(
                    ['id' => isset($this->detailIds[$i]) ? $this->detailIds[$i] : null],
                    [
                        'penerimaan_id' => $penerimaan->id,
                        'akun_id' => $detail['akun_id'],
                        'jumlah' => intval($detail['jumlah']),
                        'catatan' => $detail['catatan'],
                        'departemen_id' => $detail['departemen_id'] == '' ? null : $detail['departemen_id'],
                        'proyek_id' => $detail['proyek_id'] == '' ? null : $detail['proyek_id'],
                    ]
                );
            }
            //dokumen
            if(!isset($this->penerimaanId)){
                //tambah dokumen
                foreach($this->dokumens as $dok){
                    $this->newDokumen($penerimaan, $dok);
                }
            }else{
                foreach($this->dokumens as $i => $dok){
                    //kalo idnya masih: edit, kalo habis: tambah
                    if(isset($this->dokumenIds[$i])){
                        $dokumen = Dokumen::find($this->dokumenIds[$i]);
                        $dokumen->file_link = $dok;
                        $dokumen->save();
                    }else{
                        $this->newDokumen($penerimaan, $dok);
                    }
                }
            }
            DB::commit();
            
            sweetalert()->success((isset($this->penerimaanId) ? 'Edit' : 'Tambah') . ' Data Berhasil');
            return redirect()->route('penerimaanlainnya/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->penerimaanId) ? 'Edit' : 'Tambah') . ' Data Gagal: ' . $e->getMessage());
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
    }

    public function refreshKode(){
        if(!isset($this->penerimaanId)){
            $prefix = 'GMP-';
            $latest = PenerimaanLainnya::orderBy('no_penerimaan', 'desc')->first();
            $nextID = $latest ? intval(substr($latest->no_penerimaan, strlen($prefix))) + 1 : 1;
            $this->no_penerimaan = $prefix . sprintf("%04d", $nextID);
        }
    }

    public function addAkun($id, $data = null){
        $this->detail[] = [
            'akun_id' => $id,
            'akun' => Akun::find($id),
            'jumlah' => $data ? intval($data->jumlah) : '',
            'catatan' => $data ? $data->catatan : '',
            'departemen_id' => $data ? $data->departemen_id : '',
            'proyek_id' => $data ? $data->proyek_id : '',
        ];
    }
    public function hapusDetail($index){
        array_splice($this->detail, $index, 1);

        if(isset($this->detailIds[$index])){
            $detailId = $this->detailIds[$index];
            DetailPenerimaanLainnya::destroy($detailId);
            array_splice($this->detailIds, $index, 1);
        }
    }

    #[Title('Penerimaan Lainnya')]
    public function render() {
        $this->refreshKode();
        if(count($this->dokumens) < 1){
            $this->dokumens[] = '';
        }
        $departemen = DB::table('departemen')->get(['id', 'nama_departemen']);
        $proyek = DB::table('proyek')->get(['id', 'nama_proyek']);
        $akun = DB::table('akun')->get(['id', 'nama_akun_indonesia']);

        return view('bukubesar.penerimaanlainnya.form', compact('departemen', 'proyek', 'akun'));
    }
}
