<?php

namespace App\Livewire;

use App\Models\Barang;
use App\Models\Dokumen;
use App\Models\PenyesuaianBarang;
use App\Models\PenyesuaianBarangDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BarangForm extends Component
{
    public $barangId;
    public $no_barang;
    public $nama_barang;
    public $tipe_barang;
    public $tipe_persediaan;
    public $kategori_barang;
    public $sub_barang_check = false;
    public $sub_barang;
    public $deskripsi_1;
    public $deskripsi_2;
    public $default_gudang;
    public $departemen;
    public $proyek;
    public $dihentikan = false;
    public $diskon;
    public $kode_pajak;
    public $pemasok;
    public $minimum_kuantitas_pesan_ulang;
    public $kuantitas_saldo_awal;
    public $biaya_satuan_saldo_awal;
    public $total_saldo_awal;
    public $kuantitas_saldo_sekarang;
    public $harga_satuan_sekarang;
    public $biaya_pokok_sekarang;
    public $gudang;
    public $tanggal_mulai;
    public $minimal_harga_jual;
    public $maksimal_harga_jual;
    public $minimal_harga_beli;
    public $maksimal_harga_beli;
    public $nomor_upc;
    public $merk_barang;
    public $nilai_penyesuaian;
    public $nomor_plu;
    public $satuan;
    public $rasio = 1;
    public $level_harga_1 = 0;
    public $level_harga_2 = 0;
    public $level_harga_3 = 0;
    public $level_harga_4 = 0;
    public $level_harga_5 = 0;
    public $dokumens = [];
    public $activeTab = 'umum';
    public $dokumenIds = [];

    public function mount($id = null){
        if($id){
            $barang = Barang::findOrFail($id);
            $this->barangId = $barang->id;
            $this->no_barang = $barang->no_barang;
            $this->nama_barang = $barang->nama_barang;
            $this->tipe_barang = $barang->tipe_barang;
            $this->tipe_persediaan = $barang->tipe_persediaan;
            $this->kategori_barang = $barang->kategori_barang;
            $this->sub_barang = $barang->sub_barang;
            $this->deskripsi_1 = $barang->deskripsi_1;
            $this->deskripsi_2 = $barang->deskripsi_2;
            $this->default_gudang = $barang->default_gudang;
            $this->departemen = $barang->departemen;
            $this->proyek = $barang->proyek;
            $this->dihentikan = $barang->dihentikan;
            $this->diskon = $barang->diskon;
            $this->kode_pajak = $barang->kode_pajak;
            $this->pemasok = $barang->pemasok;
            $this->minimum_kuantitas_pesan_ulang = $barang->minimum_kuantitas_pesan_ulang;
            $this->kuantitas_saldo_awal = $barang->kuantitas_saldo_awal;
            $this->biaya_satuan_saldo_awal = intval($barang->biaya_satuan_saldo_awal);
            $this->total_saldo_awal = intval($barang->total_saldo_awal);
            $this->kuantitas_saldo_sekarang = $barang->kuantitas_saldo_sekarang;
            $this->harga_satuan_sekarang = intval($barang->harga_satuan_sekarang);
            $this->biaya_pokok_sekarang = intval($barang->biaya_pokok_sekarang);
            $this->gudang = $barang->gudang;
            $this->tanggal_mulai = $barang->tanggal_mulai;
            $this->minimal_harga_jual = intval($barang->minimal_harga_jual);
            $this->maksimal_harga_jual = intval($barang->maksimal_harga_jual);
            $this->minimal_harga_beli = intval($barang->minimal_harga_beli);
            $this->maksimal_harga_beli = intval($barang->maksimal_harga_beli);
            $this->nomor_upc = $barang->nomor_upc;
            $this->merk_barang = $barang->merk_barang;
            $this->nilai_penyesuaian = $barang->nilai_penyesuaian;
            $this->nomor_plu = $barang->nomor_plu;
            $this->satuan = $barang->satuan;
            $this->rasio = $barang->rasio;
            $this->level_harga_1 = $barang->level_harga_1;
            $this->level_harga_2 = $barang->level_harga_2;
            $this->level_harga_3 = $barang->level_harga_3;
            $this->level_harga_4 = $barang->level_harga_4;
            $this->level_harga_5 = $barang->level_harga_5;
            foreach ($barang->dokumen as $dok) {
                $this->dokumenIds[] = $dok->id;
                $this->dokumens[] = $dok->file_link;
            }
        }
    }

    public function save(){
        $data = $this->validate([
            'no_barang' => 'nullable',
            'nama_barang' => 'required|string|max:255',
            'tipe_barang' => 'nullable|string|max:255',
            'tipe_persediaan' => 'nullable|string|max:255',
            'kategori_barang' => 'nullable|string|max:255',
            'sub_barang_check' => 'nullable|boolean',
            'sub_barang' => 'nullable|string|max:255',
            'deskripsi_1' => 'nullable|string',
            'deskripsi_2' => 'nullable|string',
            'default_gudang' => 'nullable|string|max:255',
            'departemen' => 'nullable|string|max:255',
            'proyek' => 'nullable|string|max:255',
            'dihentikan' => 'nullable|boolean',
            'diskon' => 'nullable|numeric',
            'kode_pajak' => 'nullable|string|max:255',
            'pemasok' => 'nullable|string|max:255',
            'minimum_kuantitas_pesan_ulang' => 'nullable|integer',
            'kuantitas_saldo_awal' => 'nullable|integer',
            'biaya_satuan_saldo_awal' => 'nullable',
            'total_saldo_awal' => 'nullable',
            'kuantitas_saldo_sekarang' => 'nullable|integer',
            'harga_satuan_sekarang' => 'nullable',
            'biaya_pokok_sekarang' => 'nullable',
            'gudang' => 'nullable|string|max:255',
            'tanggal_mulai' => 'nullable|string|max:255',
            'minimal_harga_jual' => 'nullable',
            'maksimal_harga_jual' => 'nullable',
            'minimal_harga_beli' => 'nullable',
            'maksimal_harga_beli' => 'nullable',
            'nomor_upc' => 'nullable',
            'nilai_penyesuaian' => 'nullable',
            'nomor_plu' => 'nullable',
            'satuan' => 'nullable|string|max:255',
            'rasio' => 'nullable|integer',
            'level_harga_1' => 'nullable|integer',
            'level_harga_2' => 'nullable|integer',
            'level_harga_3' => 'nullable|integer',
            'level_harga_4' => 'nullable|integer',
            'level_harga_5' => 'nullable|integer',
            'merk_barang' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            //prevent wrong values from javascript
            $data['biaya_satuan_saldo_awal'] = $data['biaya_satuan_saldo_awal'] == null ? 0 : str_replace(['Rp', '.', ' '], '', $data['biaya_satuan_saldo_awal']);
            $data['total_saldo_awal'] = $data['biaya_satuan_saldo_awal'] * $data['kuantitas_saldo_awal'];
            $data['kuantitas_saldo_sekarang'] = $data['kuantitas_saldo_sekarang'] == null ? 0 : str_replace(['Rp', '.', ' '], '', $data['kuantitas_saldo_sekarang']);
            $data['harga_satuan_sekarang'] = $data['harga_satuan_sekarang'] == null ? 0 : str_replace(['Rp', '.', ' '], '', $data['harga_satuan_sekarang']);
            $data['biaya_pokok_sekarang'] = $data['biaya_pokok_sekarang'] == null ? 0 : str_replace(['Rp', '.', ' '], '', $data['biaya_pokok_sekarang']);
            $data['minimal_harga_jual'] = $data['minimal_harga_jual'] == null ? 0 : str_replace(['Rp', '.', ' '], '', $data['minimal_harga_jual']);
            $data['maksimal_harga_jual'] = $data['maksimal_harga_jual'] == null ? 0 : str_replace(['Rp', '.', ' '], '', $data['maksimal_harga_jual']);
            $data['minimal_harga_beli'] = $data['minimal_harga_beli'] == null ? 0 : str_replace(['Rp', '.', ' '], '', $data['minimal_harga_beli']);
            $data['maksimal_harga_beli'] = $data['maksimal_harga_beli'] == null ? 0 : str_replace(['Rp', '.', ' '], '', $data['maksimal_harga_beli']);

            $barang = Barang::updateOrCreate(['id' => $this->barangId], $data);
            
            if(!isset($this->barangId)){
                //tambah dokumen
                foreach($this->dokumens as $dok){
                    $this->newDokumen($barang, $dok);
                }

                $penyesuaian = new PenyesuaianBarang();
                $penyesuaian->tgl_penyesuaian = date('d/m/Y');
                $penyesuaian->akun_penyesuaian = 'Default Akun';
                $penyesuaian->nilai_penyesuaian = $data['nilai_penyesuaian'];
                $penyesuaian->pengguna_penyesuaian = auth()->user()->email;
                $penyesuaian->total_nilai_penyesuaian = $data['total_saldo_awal'];
                $penyesuaian->save();
                
                $barangPenyesuaian = new PenyesuaianBarangDetail();
                $barangPenyesuaian->penyesuaian_barang_id = $penyesuaian->id;
                $barangPenyesuaian->no_barang = $data['no_barang'];
                $barangPenyesuaian->deskripsi_barang = $data['nama_barang'];
                $barangPenyesuaian->departemen = $data['departemen'];
                $barangPenyesuaian->proyek = $data['proyek'];
                $barangPenyesuaian->gudang = $data['default_gudang'];
                $barangPenyesuaian->kts_saat_ini = $data['kuantitas_saldo_awal'];
                $barangPenyesuaian->nilai_saat_ini = $data['biaya_satuan_saldo_awal'];
                $barangPenyesuaian->save();
            }else{
                foreach($this->dokumens as $i => $dok){
                    //kalo idnya masih: edit, kalo habis: tambah
                    if(isset($this->dokumenIds[$i])){
                        $dokumen = Dokumen::find($this->dokumenIds[$i]);
                        $dokumen->file_link = $dok;
                        $dokumen->save();
                    }else{
                        $this->newDokumen($barang, $dok);
                    }
                }
            }
        
            DB::commit();
            sweetalert()->success((isset($this->barangId) ? 'Update Barang' : 'Create new Barang + Penyesuaian').' berhasil :)');
            return redirect()->route('barang/list/page');
        
        }catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error((isset($this->barangId) ? 'Edit' : 'Tambah').' Data Gagal: ' . $e->getMessage());
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

    public function render() {
        $this->total_saldo_awal = $this->biaya_satuan_saldo_awal * $this->kuantitas_saldo_awal;
        if(count($this->dokumens) < 1){
            $this->dokumens[] = '';
        }
        $data = [
            'barang_data' => DB::table('barang')->get(),
            'tipe_barang_data' => DB::table('tipe_barang')->get(),
            'tipe_persediaan_data' => DB::table('tipe_persediaan')->get(),
            'kategori_barang_data' => DB::table('kategori_barang')->get(),
            'gudang_data' => DB::table('gudang')->get(),
            'departemen_data' => DB::table('departemen')->get(),
            'proyek_data' => DB::table('proyek')->get(),
            'pemasok_data' => DB::table('pemasok')->get(),
            'satuan_data' => DB::table('satuan')->get(),
        ];

        return view('barang.form', $data);
    }
}
