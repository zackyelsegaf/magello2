<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">{{ isset($this->barangId) ? 'Edit' : 'Tambah' }} Data Barang</h3>
                </div>
            </div>
        </div>
        <form wire:submit.prevent='save'>
            <div class="tab-content profile-tab-cont">
                <div class="profile-menu">
                    <ul class="nav nav-tabs nav-tabs-solid">
                        <li class="nav-item"> 
                            <a class="nav-link @if($activeTab == 'umum') active @endif" data-toggle="tab" href="#umum">Umum</a> 
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link @if($activeTab == 'dokumen') active @endif" data-toggle="tab" href="#dokumen">Dokumen</a> 
                        </li>
                    </ul>
                </div>
                <div id="umum" class="tab-pane fade @if($activeTab == 'umum') show active @endif">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Change Password</h5> --}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row formtype">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tipe Barang</label>
                                                <select class="form-control @error('tipe_barang') is-invalid @enderror" wire:model="tipe_barang">
                                                    <option selected value="">-- Pilih --</option>
                                                    @foreach ($tipe_barang_data as $items )
                                                    <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Tipe Persediaan</label>
                                                <select class="form-control @error('tipe_persediaan') is-invalid @enderror"  wire:model="tipe_persediaan">
                                                    <option selected value="">-- Pilih --</option>
                                                    @foreach ($tipe_persediaan_data as $items )
                                                    <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kategori Barang</label>
                                                <select class="form-control @error('kategori_barang') is-invalid @enderror"  wire:model="kategori_barang">
                                                    <option selected value="">-- Pilih --</option>
                                                    @foreach ($kategori_barang_data as $items )
                                                    <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>No. Barang</label>
                                                <input type="hidden" wire:model="nilai_penyesuaian" value="Barang Baru Masuk">
                                                <input type="text" class="form-control @error('no_barang') is-invalid @enderror" wire:model="no_barang">
                                            </div>                                                
                                            <div class="form-group">
                                                <label>Nama Barang</label>
                                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" wire:model="nama_barang">
                                            </div>
                                            <div class="form-group">
                                                <label for="sub_barang_check">Sub Barang Dari</label>
                                                <label class="switch">
                                                    <input type="hidden" wire:model="sub_barang_check" value="0">
                                                    <input type="checkbox" wire:model="sub_barang_check" id="sub_barang_check" value="1" @checked($sub_barang_check)>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                            <div class="form-group" id="tipe_barang_form" style="display: none">
                                                {{-- <label>Subdari</label> --}}
                                                <select class="form-control" wire:model="sub_barang">
                                                    <option selected value=""> --Pilih Sub-- </option>
                                                    @foreach ($barang_data as $items )
                                                        <option value="{{ $items->no_barang }}">{{ $items->no_barang .' - '. $items->nama_barang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi 1</label>
                                                <textarea class="form-control @error('deskripsi_1') is-invalid @enderror" wire:model="deskripsi_1"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi 2</label>
                                                <textarea class="form-control @error('deskripsi_2') is-invalid @enderror" wire:model="deskripsi_2"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Default Gudang</label>
                                                <select class="form-control @error('default_gudang') is-invalid @enderror"  wire:model="default_gudang">
                                                    <option selected value="">-- Pilih --</option>
                                                    @foreach ($gudang_data as $items )
                                                    <option value="{{ $items->nama_gudang }}">{{ $items->nama_gudang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Departemen</label>
                                                <select class="form-control @error('departemen') is-invalid @enderror"  wire:model="departemen">
                                                    <option selected value="">-- Pilih --</option>
                                                    @foreach ($departemen_data as $items )
                                                    <option value="{{ $items->nama_departemen }}">{{ $items->nama_departemen }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Proyek</label>
                                                <select class="form-control @error('proyek') is-invalid @enderror"  wire:model="proyek">
                                                    <option selected value="">-- Pilih --</option>
                                                    @foreach ($proyek_data as $items )
                                                    <option value="{{ $items->nama_proyek }}">{{ $items->nama_proyek }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Merk</label>
                                                <input class="form-control @error('merk_barang') is-invalid @enderror" wire:model="merk_barang">
                                            </div>
                                            <div class="form-group">
                                                <label for="dihentikan">Dihentikan</label>
                                                <label class="switch">
                                                    <input type="hidden" wire:model="dihentikan" value="0">
                                                    <input type="checkbox" wire:model="dihentikan" id="dihentikan" value="1" @checked($dihentikan)>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="dokumen" class="tab-pane fade @if($activeTab == 'dokumen') show active @endif">
                    <div class="card">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="row float-right">
                                    <button type="button" id="fileuploads_btn_add" class="btn btn-primary buttonedit1 float-right" wire:click='addField'>
                                        <i class="fa fa-plus mr-2"></i>Tambah Field
                                    </button>
                                </div>
                            </div>
                            {{-- <h5 class="card-title">Change Password</h5> --}}
                            <div class="row">
                                <div class="col-lg-12" id="fileuploads_loop_add">
                                    <div class="row formtype">
                                        <div class="col-md-6">
                                            @foreach ($dokumens as $i => $dok)
                                                <div class="form-group">
                                                    <label>File {{ $i+1 }}</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" wire:model="dokumens.{{$i}}" placeholder="Link dokumen Anda">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-danger" type="button" wire:click='hapusDokumen({{ $i }})'>Hapus</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content profile-tab-cont">
                <div class="profile-menu">
                    <ul class="nav nav-tabs nav-tabs-solid">
                        <li class="nav-item"> 
                            <a class="nav-link active font-weight-bold" data-toggle="tab" href="#detail">Detail</a> 
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link" data-toggle="tab" href="#satuan">Satuan</a> 
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link" data-toggle="tab" href="#bebandanharga">Beban dan Harga</a> 
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link" data-toggle="tab" href="#upc">UPC dan PLU</a> 
                        </li>
                    </ul>
                </div>
                <div id="detail" class="tab-pane fade show active">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <h5 class="card-title">Informasi Penjualan</h5>
                                            <label>Diskon</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" wire:model="diskon">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Pajak</label>
                                            <input type="text" class="form-control @error('kode_pajak') is-invalid @enderror" wire:model="kode_pajak">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <h5 class="card-title">Informasi Pembelian</h5>
                                            <label>Pemasok</label>
                                            <select class="form-control @error('pemasok') is-invalid @enderror"  wire:model="pemasok">
                                                <option selected value="">-- Pilih --</option>
                                                @foreach ($pemasok_data as $items )
                                                <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Min. Kts Pesan Ulang</label>
                                            <input type="text" class="form-control @error('minimum_kuantitas_pesan_ulang') is-invalid @enderror" wire:model="minimum_kuantitas_pesan_ulang">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-8">
                                        <h5 class="card-title">Informasi Persediaan</h5>
                                        <h7 class="font-weight-bold">Saldo Awal</h7>
                                        <div class="form-group">
                                            <label>KTS</label>
                                            <input type="number" id="kuantitas_saldo_awal" class="form-control @error('kuantitas_saldo_awal') is-invalid @enderror" wire:model.live="kuantitas_saldo_awal">
                                        </div>
                                        <div class="form-group">
                                            <label>Biaya/Satuan</label>
                                            <input type="text" id="biaya_satuan_saldo_awal" class="form-control @error('biaya_satuan_saldo_awal') is-invalid @enderror" wire:model.live="biaya_satuan_saldo_awal">
                                        </div>
                                        <div class="form-group">
                                            <label>Total</label>
                                            <input type="text" id="total_saldo" class="form-control" readonly value="{{ $total_saldo_awal }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Gudang</label>
                                            <select class="form-control @error('gudang') is-invalid @enderror" wire:model="gudang">
                                                <option selected value=""></option>
                                                @foreach ($gudang_data as $items )
                                                <option value="{{ $items->nama_gudang }}">{{ $items->nama_gudang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <div class="cal-icon">
                                                <input type="text" class="form-control datetimepicker @error('tanggal_mulai') is-invalid @enderror" wire:model="tanggal_mulai"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-8">
                                        <h7 class="font-weight-bold">Saldo Saat ini</h7>
                                        <div class="form-group">
                                            <label>KTS</label>
                                            <input type="text" id="kuantitas_saldo_sekarang" class="form-control" wire:model="kuantitas_saldo_sekarang">
                                        </div>
                                        <div class="form-group">
                                            <label>Harga/Satuan</label>
                                            <input type="text" id="harga_satuan_sekarang" class="form-control" wire:model="harga_satuan_sekarang">
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Pokok</label>
                                            <input type="text" id="biaya_pokok_sekarang" class="form-control" wire:model="biaya_pokok_sekarang">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="satuan" class="tab-pane fade">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-center mb-0" id="DataBarangAddSatuan">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Nama Satuan</th>
                                            <th>Ratio</th>
                                            <th>Level Harga 1</th>
                                            <th>Level Harga 2</th>
                                            <th>Level Harga 3</th>
                                            <th>Level Harga 4</th>
                                            <th>Level Harga 5</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select style="width: 150px;" class="form-control @error('satuan') is-invalid @enderror" wire:model="satuan">
                                                    <option selected value=""></option>
                                                    @foreach ($satuan_data as $items)
                                                        <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('rasio') is-invalid @enderror" wire:model="rasio">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('level_harga_1') is-invalid @enderror" wire:model="level_harga_1">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('level_harga_2') is-invalid @enderror" wire:model="level_harga_2">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('level_harga_3') is-invalid @enderror" wire:model="level_harga_3">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('level_harga_4') is-invalid @enderror" wire:model="level_harga_4">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('level_harga_5') is-invalid @enderror" wire:model="level_harga_5">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>                    
                <div id="bebandanharga" class="tab-pane fade">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Change Password</h5> --}}
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row formtype">
                                        <div class="col-md-8">                                              
                                            <div class="form-group">
                                                <label>Minimal Harga Jual</label>
                                                <input type="text" class="form-control @error('minimal_harga_jual') is-invalid @enderror" wire:model="minimal_harga_jual">
                                            </div>
                                            <div class="form-group">
                                                <label>Maksimal Harga Jual</label>
                                                <input type="text" class="form-control @error('maksimal_harga_jual') is-invalid @enderror" wire:model="maksimal_harga_jual">
                                            </div>
                                            <div class="form-group">
                                                <label>Minimal Harga Beli</label>
                                                <input type="text" class="form-control @error('minimal_harga_beli') is-invalid @enderror" wire:model="minimal_harga_beli">
                                            </div>
                                            <div class="form-group">
                                                <label>Maksimal Harga Beli</label>
                                                <input type="text" class="form-control @error('maksimal_harga_beli') is-invalid @enderror" wire:model="maksimal_harga_beli">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="upc" class="tab-pane fade">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row formtype">
                                        <div class="col-md-8">                                              
                                            <div class="form-group">
                                                <label>No. UPC/Barcode</label>
                                                <input type="text" class="form-control @error('nomor_upc') is-invalid @enderror" wire:model="nomor_upc">
                                            </div>
                                            <div class="form-group">
                                                <label>No. PLU</label>
                                                <input type="text" class="form-control @error('nomor_plu') is-invalid @enderror" wire:model="nomor_plu">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-header">
                <div class="mb-15 row align-items-center">
                    <div class="col">
                        <div class="">
                            <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-save mr-2"></i>Simpan</button>
                            <a href="{{ route('barang/list/page') }}" class="btn btn-primary float-left veiwbutton ml-2"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById("sub_barang_check");
            const tipeAkunForm = document.getElementById("tipe_barang_form");
    
            function toggleTipeAkunForm() {
                if (checkbox.checked) {
                    tipeAkunForm.style.display = "block";
                } else {
                    tipeAkunForm.style.display = "none";
                }
            }
    
            toggleTipeAkunForm();
    
            checkbox.addEventListener("change", toggleTipeAkunForm);
        });
    </script>
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>
@endpush