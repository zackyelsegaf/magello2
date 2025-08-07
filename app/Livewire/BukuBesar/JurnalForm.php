<?php

namespace App\Livewire\BukuBesar;

use App\Models\Akun;
use App\Models\DetailJurnal;
use App\Models\Dokumen;
use App\Models\Jurnal;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class JurnalForm extends Component
{
    public $jurnalId;
    public $no_jurnal;
    public $tanggal;
	public $no_cek;
	public $sumber = 'Jurnal Umum';
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
            $jurnal = Jurnal::findOrFail($id);
            $this->jurnalId = $jurnal->id;
            $this->no_jurnal = $jurnal->no_jurnal;
            $this->tanggal = $jurnal->tanggal;
            $this->no_cek = $jurnal->no_cek;
            $this->sumber = $jurnal->sumber;
            $this->mata_uang_asing = $jurnal->mata_uang_asing;
            $this->urgent = $jurnal->urgent;
            $this->tindak_lanjut = $jurnal->tindak_lanjut;
            $this->catatan_pemeriksaan = $jurnal->catatan_pemeriksaan;
            $this->deskripsi = $jurnal->deskripsi;
            foreach ($jurnal->dokumen as $dok) {
                $this->dokumenIds[] = $dok->id;
                $this->dokumens[] = $dok->file_link;
            }
            foreach ($jurnal->entries as $detail) {
                $this->detailIds[] = $detail->id;
                $this->addAkun($detail->akun_id, $detail);
            }
        }
    }

    public function save(){
        $data = $this->validate([
            'no_jurnal'           => 'required|string|max:255|unique:jurnal,no_jurnal,'.$this->jurnalId,
            'tanggal'             => 'required|string|max:255',
            'no_cek'              => 'nullable',
            'sumber'              => 'nullable|string|max:255',
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

        $kredit = 0;
        $debit = 0;
        foreach($this->detail as $detail){
            $kredit += intval($detail['kredit']);
            $debit += intval($detail['debit']);
        }
        if($kredit != $debit){
            sweetalert()->error('Debit dan Kredit tidak seimbang!');
            return;
        }

        $data['nilai'] = $kredit;
        $data['user_id'] = auth()->id();

        DB::beginTransaction();
        try {
            $jurnal = Jurnal::updateOrCreate(['id' => $this->jurnalId], $data);
            foreach($this->detail as $i => $detail){
                DetailJurnal::updateOrCreate(
                    ['id' => isset($this->detailIds[$i]) ? $this->detailIds[$i] : null],
                    [
                        'jurnal_id' => $jurnal->id,
                        'akun_id' => $detail['akun_id'],
                        'debit' => intval($detail['debit']),
                        'kredit' => intval($detail['kredit']),
                        'catatan' => $detail['catatan'],
                        'departemen_id' => $detail['departemen_id'] == '' ? null : $detail['departemen_id'],
                        'proyek_id' => $detail['proyek_id'] == '' ? null : $detail['proyek_id'],
                    ]
                );
            }
            //dokumen
            if(!isset($this->jurnalId)){
                //tambah dokumen
                foreach($this->dokumens as $dok){
                    $this->newDokumen($jurnal, $dok);
                }
            }else{
                foreach($this->dokumens as $i => $dok){
                    //kalo idnya masih: edit, kalo habis: tambah
                    if(isset($this->dokumenIds[$i])){
                        $dokumen = Dokumen::find($this->dokumenIds[$i]);
                        $dokumen->file_link = $dok;
                        $dokumen->save();
                    }else{
                        $this->newDokumen($jurnal, $dok);
                    }
                }
            }
            DB::commit();
            
            sweetalert()->success((isset($this->jurnalId) ? 'Edit' : 'Tambah') . ' Data Berhasil');
            return redirect()->route('jurnal/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->jurnalId) ? 'Edit' : 'Tambah') . ' Data Gagal: ' . $e->getMessage());
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
        if(!isset($this->jurnalId)){
            $prefix = 'GMP-';
            $latest = Jurnal::orderBy('no_jurnal', 'desc')->first();
            $nextID = $latest ? intval(substr($latest->no_jurnal, strlen($prefix))) + 1 : 1;
            $this->no_jurnal = $prefix . sprintf("%04d", $nextID);
        }
    }

    public function addAkun($id, $data = null){
        $this->detail[] = [
            'akun_id' => $id,
            'akun' => Akun::find($id),
            'debit' => $data ? intval($data->debit) : '',
            'kredit' => $data ? intval($data->kredit) : '',
            'catatan' => $data ? $data->catatan : '',
            'departemen_id' => $data ? $data->departemen_id : '',
            'proyek_id' => $data ? $data->proyek_id : '',
        ];
    }
    public function hapusDetail($index){
        array_splice($this->detail, $index, 1);

        if(isset($this->detailIds[$index])){
            $detailId = $this->detailIds[$index];
            DetailJurnal::destroy($detailId);
            array_splice($this->detailIds, $index, 1);
        }
    }

    #[Title('Jurnal Umum')]
    public function render() {
        $this->refreshKode();
        if(count($this->dokumens) < 1){
            $this->dokumens[] = '';
        }
        $departemen = DB::table('departemen')->get(['id', 'nama_departemen']);
        $proyek = DB::table('proyek')->get(['id', 'nama_proyek']);

        return view('bukubesar.jurnal.form', compact('departemen', 'proyek'));
    }
}
