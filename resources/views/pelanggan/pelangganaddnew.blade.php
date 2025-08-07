@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Pelanggan</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/pelanggan/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#detail">Detail</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#dokumen">Dokumen</a>
                            </li>
                        </ul>
                    </div>
                    <div id="detail" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row formtype">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>No</label>
                                                    <input type="text" class="form-control form-control-sm " name="pelanggan_id" value="{{ $kodeBaru }}">

                                                    @error('pelanggan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Pelanggan</label>
                                                    <input type="text" class="form-control form-control-sm  @error('nama_pelanggan') is-invalid @enderror" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}">
                                                    @error('nama_pelanggan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control form-control-sm "  name="status">
                                                        <option selected disabled> --Pilih Status-- </option>
                                                        @foreach ($data as $items )
                                                        <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>NIK</label>
                                                    <input type="text" class="form-control form-control-sm  @error('nik_pelanggan') is-invalid @enderror" name="nik_pelanggan" value="{{ old('nik_pelanggan') }}">
                                                    @error('nik_pelanggan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <h7 class="font-weight-bold">Tempat dan Tanggal Lahir</h7>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Kota Kelahiran</label>
                                                            <select class="form-control form-control-sm  @error('tempat_lahir') is-invalid @enderror"  name="tempat_lahir">
                                                                <option selected disabled> --Pilih Kota-- </option>
                                                                @foreach ($kota as $items )
                                                                    <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal Lahir</label>
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control form-control-sm  datetimepicker @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                                                @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{-- <div class="form-group">
                                                            <label>Negara</label>
                                                            <select class="form-control form-control-sm  @error('negara') is-invalid @enderror"  name="negara">
                                                                <option selected disabled> --Pilih Negara-- </option>
                                                                @foreach ($negara as $items )
                                                                    <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('negara')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Agama</label>
                                                    <select class="form-control form-control-sm  @error('agama') is-invalid @enderror"  name="agama">
                                                        <option selected disabled> --Pilih Agama-- </option>
                                                        @foreach ($agama as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('agama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <select class="form-control form-control-sm  @error('gender') is-invalid @enderror"  name="gender">
                                                        <option selected disabled> --Pilih Gender-- </option>
                                                        @foreach ($gender as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Ayah</label>
                                                    <input type="text" class="form-control form-control-sm  @error('nama_ayah') is-invalid @enderror" name="nama_ayah" value="{{ old('nama_ayah') }}">
                                                    @error('nama_ayah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Ibu</label>
                                                    <input type="text" class="form-control form-control-sm  @error('nama_ibu') is-invalid @enderror" name="nama_ibu" value="{{ old('nama_ibu') }}">
                                                    @error('nama_ibu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="dihentikan">Dihentikan</label>
                                                    <label class="switch">
                                                        <input type="hidden" name="dihentikan" value="0">
                                                        @error('dihentikan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                        <input type="checkbox" name="dihentikan" id="dihentikan" value="1" {{ old('dihentikan') ? 'checked' : '' }}>

                                                        @error('dihentikan')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                    <div id="dokumen" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="page-header">
                                    <div class="row float-right">
                                        <button type="button" id="fileuploads_btn_add" class="btn btn-primary buttonedit1 float-right">
                                            <i class="fa fa-plus mr-2"></i>Tambah Field
                                        </button>
                                    </div>
                                </div>
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12" id="fileuploads_loop_add">
                                        <div class="row formtype">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fileupload_1">File 1</label>
                                                    <input type="text" class="form-control form-control-sm " name="fileupload_1" placeholder="Link dokumen Anda" value="{{ old('fileupload_1') }}">
                                                    @error('fileupload_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
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
                                                    <input type="text" class="form-control form-control-sm  mb-3 @error('alamat_1') is-invalid @enderror" name="alamat_1" value="{{ old('alamat_1') }}">
                                                    @error('alamat_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    {{-- <label>Alamat 2</label> --}}
                                                    <input type="text" class="form-control form-control-sm " name="alamat_2" value="{{ old('alamat_2') }}">

                                                    @error('alamat_2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat Pajak</label>
                                                    <input type="text" class="form-control form-control-sm  mb-3" name="alamatpajak_1" value="{{ old('alamatpajak_1') }}">
                                                    @error('alamatpajak_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    {{-- <label>Alamat Pajak 2</label> --}}
                                                    <input type="text" class="form-control form-control-sm " name="alamatpajak_2" value="{{ old('alamatpajak_2') }}">

                                                    @error('alamatpajak_2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Provinsi</label>
                                                    <select class="form-control form-control-sm  @error('provinsi') is-invalid @enderror"  name="provinsi">
                                                        <option selected disabled> --Pilih Provinsi-- </option>
                                                        @foreach ($provinsi as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('provinsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Kota</label>
                                                    <select class="form-control form-control-sm  @error('kota') is-invalid @enderror"  name="kota">
                                                        <option selected disabled> --Pilih Kota-- </option>
                                                        @foreach ($kota as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('kota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Negara</label>
                                                    <select class="form-control form-control-sm  @error('negara') is-invalid @enderror"  name="negara">
                                                        <option selected disabled> --Pilih Negara-- </option>
                                                        @foreach ($negara as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('negara')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Kode Pos</label>
                                                    <input type="text" class="form-control form-control-sm  @error('kode_pos') is-invalid @enderror" name="kode_pos" value="{{ old('kode_pos') }}">
                                                    @error('kode_pos')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Kontak</label>
                                                    <input type="text" class="form-control form-control-sm " name="kontak" value="{{ old('kontak') }}">
                                                    @error('kontak')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>No. Telp</label>
                                                    <input type="text" class="form-control form-control-sm  @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp') }}">
                                                    @error('no_telp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div><div class="form-group">
                                                    <label>No. FAX</label>
                                                    <input type="text" class="form-control form-control-sm "  name="no_fax" value="{{ old('no_fax') }}">
                                                    @error('no_fax')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control form-control-sm " name="email" value="{{ old('email') }}">
                                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Website</label>
                                                    <input type="text" class="form-control form-control-sm " name="website" value="{{ old('website') }}">
                                                    @error('website')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                                    <input type="text" class="form-control form-control-sm  mb-3 @error('npwp_pelanggan') is-invalid @enderror" name="npwp_pelanggan" value="{{ old('npwp_pelanggan') }}">
                                                    @error('npwp_pelanggan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>NPPKP</label>
                                                    <input type="text" class="form-control form-control-sm  mb-3 @error('nppkp_pelanggan') is-invalid @enderror" name="nppkp_pelanggan" value="{{ old('nppkp_pelanggan') }}">
                                                    @error('nppkp_pelanggan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Pajak 1</label>
                                                    <select class="form-control form-control-sm  @error('pajak_1_pelanggan') is-invalid @enderror"  name="pajak_1_pelanggan">
                                                        <option selected disabled> --Pilih Pajak 1-- </option>
                                                        @foreach ($pajak as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pajak_1_pelanggan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Pajak 2</label>
                                                    <select class="form-control form-control-sm  @error('pajak_2_pelanggan') is-invalid @enderror"  name="pajak_2_pelanggan">
                                                        <option selected disabled> --Pilih Pajak 2-- </option>
                                                        @foreach ($pajak as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pajak_2_pelanggan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label>Penjual</label>
                                                    <select class="form-control form-control-sm  @error('penjual') is-invalid @enderror"  name="penjual">
                                                        <option selected disabled> --Pilih Penjual-- </option>
                                                        @foreach ($penjual as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('penjual')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div> --}}
                                                <div class="form-group">
                                                    <label>Tipe Pelanggan</label>
                                                    <select class="form-control form-control-sm  @error('tipe_pelanggan') is-invalid @enderror"  name="tipe_pelanggan">
                                                        <option selected disabled> --Pilih Tipe Pelanggan-- </option>
                                                        @foreach ($tipe_pelanggan as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('tipe_pelanggan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Level Harga</label>
                                                    <select class="form-control form-control-sm  @error('level_harga_pelanggan') is-invalid @enderror"  name="level_harga_pelanggan">
                                                        <option selected disabled> --Pilih Level Harga-- </option>
                                                        @foreach ($level_harga as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('level_harga_pelanggan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Diskon Penjualan</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-sm  @error('diskon_penjualan_pelanggan') is-invalid @enderror" name="diskon_penjualan_pelanggan" placeholder="Persentase Pajak" value="{{ old('diskon_penjualan_pelanggan') }}">
                                                        @error('diskon_penjualan_pelanggan')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row formtype">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Syarat</label>
                                                    <select class="form-control form-control-sm  @error('syarat_pelanggan') is-invalid @enderror"  name="syarat_pelanggan">
                                                        <option selected disabled> --Pilih Syarat-- </option>
                                                        @foreach ($syarat as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('syarat_pelanggan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Batas Maksimal Hutang</label>
                                                    <input type="text" class="form-control form-control-sm  @error('batas_maks_hutang') is-invalid @enderror" name="batas_maks_hutang" value="{{ old('batas_maks_hutang') }}">
                                                    @error('batas_maks_hutang')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Batas Umur Hutang</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-sm  @error('batas_umur_hutang') is-invalid @enderror" name="batas_umur_hutang" placeholder="Batas Umur Hutang" value="{{ old('batas_umur_hutang') }}">
                                                        @error('batas_umur_hutang')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Hari</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mata Uang</label>
                                                    <select class="form-control form-control-sm  @error('mata_uang_pelanggan') is-invalid @enderror" name="mata_uang_pelanggan">
                                                        <option selected disabled> --Pilih Mata Uang-- </option>
                                                        @foreach ($mata_uang as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('mata_uang_pelanggan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Saldo Awal</label>
                                                            <input type="text" id="saldo_awal_pelanggan" class="form-control form-control-sm  @error('saldo_awal_pelanggan') is-invalid @enderror" name="saldo_awal_pelanggan" value="{{ old('saldo_awal_pelanggan') }}">
                                                            @error('saldo_awal_pelanggan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal</label>
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control form-control-sm  datetimepicker @error('tanggal_pelanggan') is-invalid @enderror" name="tanggal_pelanggan" value="{{ old('tanggal_pelanggan') }}">
                                                                @error('tanggal_pelanggan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Deskripsi</label>
                                                    <textarea class="form-control form-control-sm  @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}">{{ old('deskripsi') }}</textarea>
                                                    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                                    {{-- <label>Memo</label> --}}
                                                    <textarea class="form-control form-control-sm  @error('memo') is-invalid @enderror" name="memo" value="{{ old('memo') }}">{{ old('memo') }}</textarea>
                                                    @error('memo')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
    @section('script')
        @if ($errors->any())
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Silakan periksa kembali form yang Anda isi.',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('saldo_awal_pelanggan');

            input.addEventListener('input', () => {
                let angka = input.value.replace(/\D/g, '');
                input.value = formatRupiah(angka, 'Rp ');
            });

            input.closest('form').addEventListener('submit', () => {
                input.value = input.value.replace(/\D/g, '');
            });

            function formatRupiah(angka, prefix = '') {
                return prefix + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
        });
    </script>
    <script>
        let fieldIndex = 1;
        const maxFields = 7;

        document.getElementById('fileuploads_btn_add').addEventListener('click', function () {
            if (fieldIndex >= maxFields) {
                alert('Maksimal hanya boleh 7 file.');
                return;
            }

            fieldIndex++;

            const fieldContainer = document.getElementById('fileuploads_loop_add');

            const newField = document.createElement('div');
            newField.className = 'form-group';
            newField.innerHTML = `
                <div class="row formtype mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fileupload_${fieldIndex}">File ${fieldIndex}</label>
                            <input type="text" name="fileupload_${fieldIndex}" class="form-control form-control-sm " />
                            @error('fileupload_${fieldIndex}')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

            `;

            fieldContainer.appendChild(newField);
        });
    </script>
    @endsection
@endsection
