<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">{{ isset($pelangganId) ? 'Edit' : 'Tambah' }} Data Pelanggan</h3>
                </div>
            </div>
        </div>
        <form wire:submit.prevent='save'>
            <div class="tab-content profile-tab-cont">
                <div class="profile-menu">
                    <ul class="nav nav-tabs nav-tabs-solid">
                        <li class="nav-item"> 
                            <a class="nav-link @if($activeTab == 'detail') active @endif" data-toggle="tab" href="#detail">Detail</a> 
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link @if($activeTab == 'dokumen') active @endif" data-toggle="tab" href="#dokumen">Dokumen</a> 
                        </li>
                    </ul>
                </div>
                <div id="detail" class="tab-pane fade @if($activeTab == 'detail') show active @endif">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row formtype">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No</label>
                                                <input type="text" class="form-control @error('kode_pelanggan') is-invalid @enderror" wire:model="kode_pelanggan">
                                                @foreach ($errors->get('kode_pelanggan') as $err)
                                                    <div class="invalid-feedback">{{ $err }}</div>
                                                @endforeach
                                            </div>                                                
                                            <div class="form-group">
                                                <label>Nama Pelanggan</label>
                                                <input type="text" class="form-control @error('nama') is-invalid @enderror" wire:model="nama">
                                                @foreach ($errors->get('nama') as $err)
                                                    <div class="invalid-feedback">{{ $err }}</div>
                                                @endforeach
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control"  wire:model="status_id">
                                                    <option selected> --Pilih Status-- </option>
                                                    @foreach ($status as $items )
                                                    <option value="{{ $items->id }}">{{ $items->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>NIK</label>
                                                <input type="text" class="form-control @error('nik') is-invalid @enderror" wire:model="nik">
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
                            <a class="nav-link active font-weight-bold" data-toggle="tab" href="#info">Info</a> 
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link" data-toggle="tab" href="#penjualan">Penjualan</a> 
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link" data-toggle="tab" href="#syarat">Syarat</a> 
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link" data-toggle="tab" href="#memo">Memo</a> 
                        </li>
                    </ul>
                </div>
                <div id="info" class="tab-pane fade show active">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Change Password</h5> --}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row formtype">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input type="text" class="form-control mb-3 @error('alamat_1') is-invalid @enderror" wire:model="alamat_1">
                                                {{-- <label>Alamat 2</label> --}}
                                                <input type="text" class="form-control" wire:model="alamat_2">
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat Pajak</label>
                                                <input type="text" class="form-control mb-3" wire:model="alamatpajak_1">
                                                {{-- <label>Alamat Pajak 2</label> --}}
                                                <input type="text" class="form-control" wire:model="alamatpajak_2">
                                            </div>
                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <input type="text" class="form-control @error('provinsi') is-invalid @enderror"  wire:model="provinsi">
                                            </div>
                                            <div class="form-group">
                                                <label>Kota</label>
                                                <input type="text" class="form-control @error('kota') is-invalid @enderror"  wire:model="kota">
                                            </div>
                                            <div class="form-group">
                                                <label>Negara</label>
                                                <input type="text" class="form-control @error('negara') is-invalid @enderror"  wire:model="negara">
                                            </div>
                                            <div class="form-group">
                                                <label>Kode Pos</label>
                                                <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" wire:model="kode_pos">
                                            </div>
                                            <div class="form-group">
                                                <label>Kontak</label>
                                                <input type="text" class="form-control" wire:model="kontak">
                                            </div>
                                            <div class="form-group">
                                                <label>No. Telp</label>
                                                <input type="text" class="form-control @error('no_telp') is-invalid @enderror" wire:model="no_telp">
                                            </div><div class="form-group">
                                                <label>No. FAX</label>
                                                <input type="text" class="form-control"  wire:model="no_fax">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" wire:model="email">
                                            </div>
                                            <div class="form-group">
                                                <label>Website</label>
                                                <input type="text" class="form-control" wire:model="website">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="penjualan" class="tab-pane fade">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Change Password</h5> --}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row formtype">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>NPWP</label>
                                                <input type="text" class="form-control mb-3 @error('npwp') is-invalid @enderror" wire:model="npwp">
                                            </div>
                                            <div class="form-group">
                                                <label>NPPKP</label>
                                                <input type="text" class="form-control mb-3 @error('nppkp') is-invalid @enderror" wire:model="nppkp">
                                            </div>
                                            <div class="form-group">
                                                <label>Pajak 1</label>
                                                <select class="form-control @error('pajak_1_id') is-invalid @enderror" wire:model="pajak_1_id">
                                                    <option selected> --Pilih Pajak 1-- </option>
                                                    @foreach ($pajak as $items )
                                                        <option value="{{ $items->id }}">{{ $items->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Pajak 2</label>
                                                <select class="form-control @error('pajak_2_id') is-invalid @enderror" wire:model="pajak_2_id">
                                                    <option selected> --Pilih Pajak 2-- </option>
                                                    @foreach ($pajak as $items )
                                                        <option value="{{ $items->id }}">{{ $items->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Tipe Pelanggan</label>
                                                <select class="form-control @error('tipe_pelanggan_id') is-invalid @enderror" wire:model="tipe_pelanggan_id">
                                                    <option selected> --Pilih Tipe Pelanggan-- </option>
                                                    @foreach ($tipe_pelanggan as $items )
                                                        <option value="{{ $items->id }}">{{ $items->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Level Harga</label>
                                                <select class="form-control @error('level_harga') is-invalid @enderror" wire:model="level_harga">
                                                    @for ($i=0; $i<=5; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Diskon Penjualan</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control @error('diskon_penjualan') is-invalid @enderror" wire:model="diskon_penjualan" placeholder="Persentase Pajak">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="syarat" class="tab-pane fade">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row formtype">
                                        <div class="col-md-8">  
                                            <div class="form-group">
                                                <label>Syarat</label>
                                                <select class="form-control @error('syarat_id') is-invalid @enderror"  wire:model="syarat_id">
                                                    <option selected> --Pilih Syarat-- </option>
                                                    @foreach ($syarat as $items )
                                                        <option value="{{ $items->id }}">{{ $items->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>                                             
                                            <div class="form-group">
                                                <label>Batas Maksimal Hutang</label>
                                                <input type="text" class="form-control @error('batas_maks_hutang') is-invalid @enderror" wire:model="batas_maks_hutang">
                                            </div>
                                            <div class="form-group">
                                                <label>Batas Umur Hutang</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control @error('batas_umur_hutang') is-invalid @enderror" wire:model="batas_umur_hutang" placeholder="Batas Umur Hutang">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Hari</span>
                                                    </div>
                                                </div>                                
                                            </div>
                                            <div class="form-group">
                                                <label>Mata Uang</label>
                                                <select class="form-control @error('mata_uang_id') is-invalid @enderror" wire:model="mata_uang_id">
                                                    <option selected> --Pilih Mata Uang-- </option>
                                                    @foreach ($mata_uang as $items )
                                                        <option value="{{ $items->id }}">{{ $items->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Saldo Awal</label>
                                                        <input type="text" id="saldo_awal_pelanggan" class="form-control @error('saldo_awal') is-invalid @enderror" wire:model="saldo_awal">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal</label>
                                                        <div class="cal-icon">
                                                            <input type="text" class="form-control datetimepicker @error('tanggal_saldo_awal') is-invalid @enderror" wire:model="tanggal_saldo_awal"> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" wire:model="deskripsi"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="memo" class="tab-pane fade">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row formtype">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Memo</label>
                                                <textarea class="form-control @error('memo') is-invalid @enderror" wire:model="memo"></textarea>
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
                            <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-check mr-2"></i>Simpan</button>
                            <a href="{{ route('pelanggan/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('saldo_awal_pelanggan');

            input.addEventListener('input', () => {
                let angka = input.value.replace(/\D/g, '');
                input.value = formatRupiah(angka, 'Rp ');
            });

            function formatRupiah(angka, prefix = '') {
                return prefix + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
        });
    </script>
@endpush